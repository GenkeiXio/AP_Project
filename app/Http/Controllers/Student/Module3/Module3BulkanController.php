<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Bulkan;

class Module3BulkanController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.bulkan');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'selected_answers' => 'nullable|array',
        ]);

        $existing = Module3Bulkan::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'score' => $request->score,
                'is_completed' => true,
                'selected_answers' => $request->selected_answers,
            ]);
        } else {
            Module3Bulkan::create([
                'student_id' => $studentId,
                'score' => $request->score,
                'is_completed' => true,
                'selected_answers' => $request->selected_answers,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
