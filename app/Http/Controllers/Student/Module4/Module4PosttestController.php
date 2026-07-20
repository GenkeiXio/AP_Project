<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_4\Module4Posttest;

class Module4PosttestController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'score'      => 'required|integer',
            'percentage' => 'required|integer',
            'answers'    => 'required|array',
        ]);

        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Get all attempts for this student
        $attempts = Module4Posttest::where('student_id', $studentId)
            ->orderBy('attempt', 'asc')
            ->get();

        $attemptCount = $attempts->count();
        $maxAttempts = 2;

        // Check if user has reached max attempts
        if ($attemptCount >= $maxAttempts) {
            return response()->json([
                'error' => 'You have reached the maximum number of attempts (2).',
                'max_attempts_reached' => true,
                'highest_score' => $attempts->max('score'),
                'status' => $attempts->max('score') >= 13 ? 'passed' : 'failed'
            ], 403);
        }

        $status = $request->score >= 13 ? 'passed' : 'failed';

        // Determine attempt number (1 or 2)
        $attempt = $attemptCount + 1;

        // Save the attempt
        Module4Posttest::create([
            'student_id'  => $studentId,
            'score'       => $request->score,
            'total_items' => count($request->answers),
            'status'      => $status,
            'answers'     => json_encode($request->answers),
            'attempt'     => $attempt,
        ]);

        // Get updated attempts to check highest score
        $updatedAttempts = Module4Posttest::where('student_id', $studentId)->get();
        $highestScore = $updatedAttempts->max('score');
        $highestStatus = $highestScore >= 13 ? 'passed' : 'failed';
        
        return response()->json([
            'success' => true,
            'status'  => $status,
            'attempt' => $attempt,
            'attempts_remaining' => $maxAttempts - ($attemptCount + 1),
            'highest_score' => $highestScore,
            'highest_status' => $highestStatus,
            'is_final_attempt' => ($attemptCount + 1) >= $maxAttempts,
            'score' => $request->score,
            'total_items' => count($request->answers),
        ]);
    }

    public function getExamStatus(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $attempts = Module4Posttest::where('student_id', $studentId)
            ->orderBy('attempt', 'asc')
            ->get();

        $attemptCount = $attempts->count();
        $maxAttempts = 2;

        // Check if user has no attempts (can take exam)
        if ($attemptCount === 0) {
            return response()->json([
                'can_take_exam' => true,
                'has_attempts' => false,
                'attempts_remaining' => $maxAttempts,
                'attempts_used' => 0,
                'highest_score' => null,
                'status' => null,
                'message' => 'You can take the posttest. You have 2 attempts.'
            ]);
        }

        // Check if user has reached max attempts
        if ($attemptCount >= $maxAttempts) {
            return response()->json([
                'can_take_exam' => false,
                'has_attempts' => true,
                'attempts_remaining' => 0,
                'attempts_used' => $attemptCount,
                'highest_score' => $attempts->max('score'),
                'highest_status' => $attempts->max('score') >= 13 ? 'passed' : 'failed',
                'max_attempts_reached' => true,
                'attempts' => $attempts->pluck('score', 'attempt'),
                'message' => 'You have used all your attempts. Your highest score is ' . $attempts->max('score') . '/' . $attempts->first()->total_items,
            ]);
        }

        // User has attempts remaining (1 attempt done, 1 remaining)
        return response()->json([
            'can_take_exam' => true,
            'has_attempts' => true,
            'attempts_remaining' => $maxAttempts - $attemptCount,
            'attempts_used' => $attemptCount,
            'highest_score' => $attempts->max('score'),
            'highest_status' => $attempts->max('score') >= 13 ? 'passed' : 'failed',
            'attempts' => $attempts->pluck('score', 'attempt'),
            'message' => 'You have ' . ($maxAttempts - $attemptCount) . ' attempt(s) remaining. Your highest score is ' . $attempts->max('score') . '/' . $attempts->first()->total_items,
        ]);
    }

    public function getHighestScore(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $attempts = Module4Posttest::where('student_id', $studentId)->get();
        
        if ($attempts->isEmpty()) {
            return response()->json([
                'has_attempts' => false,
                'highest_score' => null,
                'status' => null,
            ]);
        }

        $highest = $attempts->max('score');
        $totalItems = $attempts->first()->total_items;
        $status = $highest >= 13 ? 'passed' : 'failed';

        return response()->json([
            'has_attempts' => true,
            'highest_score' => $highest,
            'total_items' => $totalItems,
            'status' => $status,
            'attempts_used' => $attempts->count(),
            'max_attempts' => 2,
        ]);
    }
}