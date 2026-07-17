<?php

namespace App\Http\Controllers\Student\Module2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_2\Module2Posttest;
use App\Models\Module_2\Module2PosttestAnswer;

class Module2_PosttestController extends Controller
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

        // Get the highest score and attempt count from database
        $studentId = $this->studentId();
        
        $highestScore = Module2Posttest::where('student_id', $studentId)
            ->max('score');
            
        $attemptCount = Module2Posttest::where('student_id', $studentId)
            ->count();

        // Pass to view if needed
        return view('module2_posttest', compact('highestScore', 'attemptCount'));
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Get attempts from DATABASE (not session)
        $attemptCount = Module2Posttest::where('student_id', $studentId)->count();

        if ($attemptCount >= 2) {
            return response()->json([
                'error' => 'Maximum attempts reached',
                'remaining_attempts' => 0
            ], 403);
        }

        $request->validate([
            'score' => 'required|integer',
            'percentage' => 'required|numeric',
            'answers' => 'required|array',
        ]);

        // SAVE MAIN RESULT with attempt number
        $attemptNumber = $attemptCount + 1;
        
        $posttest = Module2Posttest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
            'attempts' => $attemptNumber, // Save the attempt number
        ]);

        // SAVE ANSWERS
        foreach ($request->answers as $answer) {
            Module2PosttestAnswer::create([
                'module2_posttest_id' => $posttest->id,
                'question_number' => $answer['question_number'],
                'selected_answer' => $answer['selected_answer'],
                'correct_answer' => $answer['correct_answer'],
                'is_correct' => $answer['is_correct'],
            ]);
        }

        $remainingAttempts = 2 - $attemptNumber;

        return response()->json([
            'success' => true,
            'message' => 'Post-test saved successfully',
            'attempt_used' => $attemptNumber,
            'remaining_attempts' => $remainingAttempts,
            'highest_score' => Module2Posttest::where('student_id', $studentId)->max('score')
        ]);
    }

    public function checkAttempts()
    {
        $studentId = $this->studentId();
        
        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $attemptCount = Module2Posttest::where('student_id', $studentId)->count();
        $remainingAttempts = 2 - $attemptCount;
        $highestScore = Module2Posttest::where('student_id', $studentId)->max('score');

        return response()->json([
            'attempts' => $attemptCount,
            'remaining' => $remainingAttempts,
            'can_retry' => $remainingAttempts > 0,
            'highest_score' => $highestScore
        ]);
    }
}