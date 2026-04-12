<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Gabay;

class Module3GabayController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.gabay');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'placements' => 'nullable|array'
        ]);

        $total = 12;
        $accuracy = ($request->score / $total) * 100;

        // PERFORMANCE LOGIC
        if ($accuracy >= 90) {
            $level = 'excellent';
        } elseif ($accuracy >= 70) {
            $level = 'good';
        } else {
            $level = 'needs_improvement';
        }

        $existing = Module3Gabay::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'score' => $request->score,
                'accuracy' => $accuracy,
                'performance_level' => $level,
                'placements' => $request->placements,
                'is_completed' => true,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3Gabay::create([
                'student_id' => $studentId,
                'score' => $request->score,
                'accuracy' => $accuracy,
                'performance_level' => $level,
                'placements' => $request->placements,
                'is_completed' => true,
                'attempts' => 1,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
