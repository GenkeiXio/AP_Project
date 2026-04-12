<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Node3;

class Module3Node3Controller extends Controller
{
    public function index()
    {
        return view('Students.Module3.Nodes.mod3_node3');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'final_budget' => 'required|integer',
            'safety_score' => 'required|integer',
            'status' => 'required|in:not_ready,partially_ready,ready',
            'selected_strategies' => 'nullable|array',
        ]);

        $existing = Module3Node3::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'final_budget' => $request->final_budget,
                'safety_score' => $request->safety_score,
                'status' => $request->status,
                'selected_strategies' => $request->selected_strategies,
                'is_completed' => true,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3Node3::create([
                'student_id' => $studentId,
                'final_budget' => $request->final_budget,
                'safety_score' => $request->safety_score,
                'status' => $request->status,
                'selected_strategies' => $request->selected_strategies,
                'is_completed' => true,
                'attempts' => 1,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
