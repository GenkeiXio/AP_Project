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

        $validated = $request->validate([
            'choices_selected' => 'required|integer|min:0',
            'remaining_budget' => 'required|integer|min:0',
            'readiness_score' => 'required|integer|min:0|max:100',
            'is_passed' => 'required|boolean',
        ]);

        $existing = Module3Node3::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'choices_selected' => $validated['choices_selected'],
                'remaining_budget' => $validated['remaining_budget'],
                'readiness_score' => $validated['readiness_score'],
                'is_passed' => $validated['is_passed'],
                'is_completed' => true,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3Node3::create([
                'student_id' => $studentId,
                'choices_selected' => $validated['choices_selected'],
                'remaining_budget' => $validated['remaining_budget'],
                'readiness_score' => $validated['readiness_score'],
                'is_passed' => $validated['is_passed'],
                'is_completed' => true,
                'attempts' => 1,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
