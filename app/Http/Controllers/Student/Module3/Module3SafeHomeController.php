<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3SafeHome;

class Module3SafeHomeController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.safe_home');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'correct_count' => 'required|integer',
            'wrong_count' => 'required|integer',
            'total_clicks' => 'required|integer',
            'selected_options' => 'nullable|array'
        ]);

        $isPerfect = $request->correct_count == 5 && $request->wrong_count == 0;

        $existing = Module3SafeHome::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'correct_count' => $request->correct_count,
                'wrong_count' => $request->wrong_count,
                'total_clicks' => $request->total_clicks,
                'is_perfect' => $isPerfect,
                'is_completed' => true,
                'selected_options' => $request->selected_options,
                'attempts' => $existing->attempts + 1,
            ]);
        } else {
            Module3SafeHome::create([
                'student_id' => $studentId,
                'correct_count' => $request->correct_count,
                'wrong_count' => $request->wrong_count,
                'total_clicks' => $request->total_clicks,
                'is_perfect' => $isPerfect,
                'is_completed' => true,
                'selected_options' => $request->selected_options,
                'attempts' => 1,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
