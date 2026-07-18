<?php

namespace App\Http\Controllers\Student\Pretest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pretest\Module3Pretest;
use App\Models\Pretest\Module3PretestAnswer;
use Illuminate\Support\Facades\Session;

class Module3PretestController extends Controller
{
    public function index()
    {
        if (!Session::get('student_id')) {
            return redirect()->route('home');
        }

        return view('Students.Module3.Test.module3_pretest');
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
        $attemptCount = Module3Pretest::where('student_id', $studentId)->count();

        // Check if exceeded maximum attempts (3)
        if ($attemptCount >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Naabot mo na ang maximum na 3 attempts.',
                'can_retry' => false
            ], 403);
        }

        // ✅ SAVE RESULT
        $pretest = Module3Pretest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
            'attempts' => $attemptCount + 1, // If you have attempts column
        ]);

        foreach ($request->answers as $answer) {
            Module3PretestAnswer::create([
                'module3_pretest_id' => $pretest->id,
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
        
        $attemptCount = Module3Pretest::where('student_id', $studentId)->count();
        $remainingAttempts = 3 - $attemptCount;
        
        // Get last score
        $lastPretest = Module3Pretest::where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->first();
        
        return response()->json([
            'attempts' => $attemptCount,
            'remaining' => $remainingAttempts,
            'can_retry' => $remainingAttempts > 0,
            'last_score' => $lastPretest ? $lastPretest->score : null,
            'last_percentage' => $lastPretest ? $lastPretest->percentage : null
        ]);
    }

    public function getAttemptHistory()
    {
        $studentId = Session::get('student_id');
        
        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $attempts = Module3Pretest::where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'score', 'percentage', 'attempts', 'created_at']);
        
        return response()->json([
            'attempts' => $attempts,
            'total_attempts' => $attempts->count()
        ]);
    }
}