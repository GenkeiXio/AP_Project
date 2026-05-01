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

            'selectedItems' => 'required|array',
            'answers' => 'required|array',

            'kitScore' => 'required|integer',
            'evacuationScore' => 'required|integer',
            'communicationScore' => 'required|integer',
            'safeScore' => 'required|integer',
        ]);

        $performanceTask = Module3PerformanceTask::create([
            'student_id' => $studentId,

            'score' => $request->score,
            'completion_time' => $request->completionTime,

            'badges_earned' => $request->badges,
            'selected_items' => $request->selectedItems,
            'answers' => $request->answers,

            'kit_score' => $request->kitScore,
            'evacuation_score' => $request->evacuationScore,
            'communication_score' => $request->communicationScore,
            'safe_score' => $request->safeScore,

            'is_completed' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Performance Task saved successfully',
            'id' => $performanceTask->id
        ]);
    }
}
