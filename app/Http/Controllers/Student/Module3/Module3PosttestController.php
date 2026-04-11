<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Posttest;


class Module3PosttestController extends Controller
{
    public function index()
    {
        return view('Students.module3.module3_posttest');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $score = $request->score;
        $total = 15;

        // 🎯 PERFORMANCE LOGIC
        if ($score >= 12) {
            $performance = "Disaster Commander";
            $passed = true;
        } elseif ($score >= 8) {
            $performance = "Resilient Learner";
            $passed = true;
        } else {
            $performance = "Needs Improvement";
            $passed = false;
        }

        Module3Posttest::updateOrCreate(
            ['student_id' => $studentId],
            [
                'score' => $score,
                'total_items' => $total,
                'performance_level' => $performance,
                'is_passed' => $passed,
                'answers' => $request->answers
            ]
        );

        return response()->json([
            'success' => true,
            'performance' => $performance
        ]);
    }
}
