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

        // RESET attempts every visit
        session()->forget('module2_posttest_attempts');

        return view('module2_posttest');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 🔥 SESSION LIMIT
        $attempts = session()->get('module2_posttest_attempts', 0);

        if ($attempts >= 2) {
            return response()->json([
                'error' => 'Maximum attempts reached'
            ], 403);
        }

        session()->put('module2_posttest_attempts', $attempts + 1);

        $request->validate([
            'score' => 'required|integer',
            'percentage' => 'required|numeric',
            'answers' => 'required|array',
        ]);

        // SAVE MAIN RESULT
        $posttest = Module2Posttest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
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

        return response()->json([
            'success' => true,
            'message' => 'Post-test saved successfully',
            'attempt_used' => $attempts + 1,
            'remaining_attempts' => 2 - ($attempts + 1)
        ]);
    }
}
