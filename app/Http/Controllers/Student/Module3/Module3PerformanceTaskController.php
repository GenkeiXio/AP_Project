<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3PerformanceTask;

class Module3PerformanceTaskController extends Controller
{
    public function show()
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return redirect()->route('home');
        }

        return view('Students.Module3.performance-task');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'badges' => 'required|array',
            'completionTime' => 'required|integer',
        ]);

        // Save Performance Task Result
        $performanceTask = Module3PerformanceTask::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'badges_earned' => json_encode($request->badges),
            'completion_time' => $request->completionTime,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Performance Task saved successfully',
            'id' => $performanceTask->id
        ]);
    }
}
