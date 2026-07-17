<?php

namespace App\Http\Controllers\Student\Pretest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pretest\Module2Pretest;
use App\Models\Pretest\Module2PretestAnswer;
use Illuminate\Support\Facades\Session;

class Module2PretestController extends Controller
{
    public function index()
    {
        if (!Session::get('student_id')) {
            return redirect()->route('home');
        }

        return view('module2');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'percentage' => 'required|numeric',
            'answers' => 'required|array',
        ]);

        // ✅ GET ATTEMPTS FROM DATABASE
        $attemptCount = Module2Pretest::where('student_id', $studentId)->count();

        // Check if exceeded maximum attempts (3)
        if ($attemptCount >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Naabot mo na ang maximum na 3 attempts.',
                'can_retry' => false
            ], 403);
        }

        // ✅ SAVE RESULT
        $pretest = Module2Pretest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
        ]);

        foreach ($request->answers as $answer) {
            Module2PretestAnswer::create([
                'module2_pretest_id' => $pretest->id,
                'question_number' => $answer['question_number'],
                'selected_answer' => $answer['selected'],
                'correct_answer' => $answer['correct'],
                'is_correct' => $answer['is_correct'],
            ]);
        }

        $remainingAttempts = 3 - ($attemptCount + 1);

        return response()->json([
            'success' => true,
            'attempt' => $attemptCount + 1,
            'remaining_attempts' => $remainingAttempts,
            'can_retry' => $remainingAttempts > 0
        ]);
    }

    public function checkAttempts()
    {
        $studentId = Session::get('student_id');
        
        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $attemptCount = Module2Pretest::where('student_id', $studentId)->count();
        $remainingAttempts = 3 - $attemptCount;
        
        // Get last score
        $lastPretest = Module2Pretest::where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->first();
        
        return response()->json([
            'attempts' => $attemptCount,
            'remaining' => $remainingAttempts,
            'can_retry' => $remainingAttempts > 0,
            'last_score' => $lastPretest ? $lastPretest->score : null
        ]);
    }
}