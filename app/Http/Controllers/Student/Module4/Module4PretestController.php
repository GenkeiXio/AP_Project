<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4Pretest;
use App\Models\Module_4\Module4PretestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Module4PretestController extends Controller
{
    const MAX_ATTEMPTS = 3;
    const TOTAL_ITEMS = 15;

    private function studentId()
    {
        return Session::get('student_id');
    }

    public function index()
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return redirect()->route('home');
        }

        // Check if student has existing pretest record
        $pretest = Module4Pretest::where('student_id', $studentId)->first();
        $attempts = $pretest->attempts ?? 0;
        $highestScore = $pretest->score ?? 0;
        $hasAttemptsRemaining = $attempts < self::MAX_ATTEMPTS;
        $isLocked = !$hasAttemptsRemaining;

        return view('Students.module4.module4_pretest', compact(
            'attempts', 
            'highestScore', 
            'hasAttemptsRemaining',
            'isLocked'
        ));
    }

    public function store(Request $request)
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        // Get existing record
        $pretest = Module4Pretest::where('student_id', $studentId)->first();
        $currentAttempts = $pretest->attempts ?? 0;

        // Check if max attempts reached
        if ($currentAttempts >= self::MAX_ATTEMPTS) {
            return response()->json([
                'error' => 'Maximum attempts reached',
                'max_attempts_reached' => true
            ], 403);
        }

        // ✅ VALIDATION
        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'total_items' => ['required', 'integer', 'min:1'],
            'level' => ['nullable', 'string'],
            'answers' => ['required', 'array'],
            'answers.*.question_number' => ['required', 'integer'],
            'answers.*.selected_option' => ['required', 'integer'],
            'answers.*.correct_option' => ['required', 'integer'],
            'answers.*.is_correct' => ['required', 'boolean'],
        ]);

        // Calculate new attempts
        $newAttempts = $currentAttempts + 1;
        $existingScore = $pretest->score ?? 0;
        $highestScore = max($validated['score'], $existingScore);

        // 🔥 SAVE
        $result = DB::transaction(function () use ($studentId, $validated, $highestScore, $newAttempts) {

            $pretest = Module4Pretest::updateOrCreate(
                ['student_id' => $studentId],
                [
                    'score' => $highestScore,
                    'total_items' => $validated['total_items'],
                    'level' => $validated['level'] ?? null,
                    'is_completed' => true,
                    'attempts' => $newAttempts,
                    'last_score' => $validated['score'],
                ]
            );

            // clear old answers
            Module4PretestAnswer::where('module4_pretest_id', $pretest->id)->delete();

            foreach ($validated['answers'] as $answer) {
                Module4PretestAnswer::create([
                    'module4_pretest_id' => $pretest->id,
                    'question_number' => $answer['question_number'],
                    'selected_option' => $answer['selected_option'],
                    'correct_option' => $answer['correct_option'],
                    'is_correct' => $answer['is_correct'],
                ]);
            }

            return $pretest;
        });

        $hasAttemptsRemaining = $newAttempts < self::MAX_ATTEMPTS;

        return response()->json([
            'success' => true,
            'attempts_used' => $newAttempts,
            'attempts_remaining' => self::MAX_ATTEMPTS - $newAttempts,
            'has_attempts_remaining' => $hasAttemptsRemaining,
            'max_attempts_reached' => !$hasAttemptsRemaining,
            'highest_score' => $highestScore,
            'score' => $validated['score'],
        ]);
    }

    /**
     * Check attempts status via AJAX
     */
    public function checkAttempts()
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $pretest = Module4Pretest::where('student_id', $studentId)->first();
        $attempts = $pretest->attempts ?? 0;
        $highestScore = $pretest->score ?? 0;
        $hasAttemptsRemaining = $attempts < self::MAX_ATTEMPTS;

        return response()->json([
            'attempts' => $attempts,
            'highest_score' => $highestScore,
            'has_attempts_remaining' => $hasAttemptsRemaining,
            'max_attempts_reached' => !$hasAttemptsRemaining,
            'is_locked' => !$hasAttemptsRemaining,
            'max_attempts' => self::MAX_ATTEMPTS,
            'total_items' => self::TOTAL_ITEMS,
        ]);
    }
}