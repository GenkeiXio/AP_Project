<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3GobagActivity;

class Module3GobagActivityController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.gobag_activity');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'correct_items' => 'required|integer',
            'wrong_attempts' => 'required|integer',
            'time_taken' => 'required|integer',
            'is_success' => 'required|boolean',
        ]);

        // 🎯 Accuracy formula
        $totalAttempts = $request->correct_items + $request->wrong_attempts;
        $accuracy = $totalAttempts > 0
            ? ($request->correct_items / $totalAttempts) * 100
            : 0;

        // ⭐ Rating logic (based on time + success)
        $rating = 'needs_improvement';

        if ($request->is_success) {
            if ($request->time_taken <= 25) {
                $rating = 'excellent';
            } elseif ($request->time_taken <= 45) {
                $rating = 'good';
            }
        }

        $existing = Module3GobagActivity::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'score' => $request->score,
                'correct_items' => $request->correct_items,
                'wrong_attempts' => $request->wrong_attempts,
                'time_taken' => $request->time_taken,
                'accuracy' => $accuracy,
                'rating' => $rating,
                'is_completed' => true,
                'is_success' => $request->is_success,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3GobagActivity::create([
                'student_id' => $studentId,
                'score' => $request->score,
                'correct_items' => $request->correct_items,
                'wrong_attempts' => $request->wrong_attempts,
                'time_taken' => $request->time_taken,
                'accuracy' => $accuracy,
                'rating' => $rating,
                'is_completed' => true,
                'is_success' => $request->is_success,
                'attempts' => 1,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
