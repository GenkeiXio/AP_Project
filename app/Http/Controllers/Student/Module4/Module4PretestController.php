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
    private function studentId()
    {
        return Session::get('student_id');
    }

    public function index()
    {
        if (!$this->studentId()) {
            return redirect()->route('home');
        }

        $attempts = session('module4_pretest_attempts', 0);

        return view('Pretest', compact('attempts'));
    }

    public function store(Request $request)
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        // 🔥 ATTEMPTS
        $attempts = session()->get('module4_pretest_attempts', 0);

        if ($attempts >= 3) {
            return response()->json([
                'error' => 'Maximum attempts reached'
            ], 403);
        }

        // ✅ VALIDATION (NOW MATCHES FRONTEND)
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

        // 🔥 SAVE
        $result = DB::transaction(function () use ($studentId, $validated) {

            $pretest = Module4Pretest::updateOrCreate(
                ['student_id' => $studentId],
                [
                    'score' => $validated['score'],
                    'total_items' => $validated['total_items'],
                    'level' => $validated['level'] ?? null,
                    'is_completed' => true,
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

        // ✅ UPDATE SESSION ATTEMPTS
        session()->put('module4_pretest_attempts', $attempts + 1);

        return response()->json([
            'success' => true,
            'attempt_used' => $attempts + 1,
            'remaining_attempts' => 3 - ($attempts + 1)
        ]);
    }
}