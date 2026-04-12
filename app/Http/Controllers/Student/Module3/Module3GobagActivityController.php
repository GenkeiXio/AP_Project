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
            'time_taken' => 'required|integer',
        ]);

        // 🎯 Rating logic
        $rating = 'needs_improvement';

        if ($request->time_taken <= 25) {
            $rating = 'excellent';
        } elseif ($request->time_taken <= 45) {
            $rating = 'good';
        }

        $existing = Module3GobagActivity::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'score' => $request->score,
                'time_taken' => $request->time_taken,
                'rating' => $rating,
                'is_completed' => true,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3GobagActivity::create([
                'student_id' => $studentId,
                'score' => $request->score,
                'time_taken' => $request->time_taken,
                'rating' => $rating,
                'is_completed' => true,
                'attempts' => 1,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
