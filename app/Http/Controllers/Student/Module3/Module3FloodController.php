<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Flood;

class Module3FloodController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.flood_activity');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'hp_remaining' => 'required|integer',
            'answers' => 'nullable|array',
            'is_game_over' => 'required|boolean',
        ]);

        $existing = Module3Flood::where('student_id', $studentId)->first();

        $data = [
            'score' => $request->score,
            'hp_remaining' => $request->hp_remaining,
            'answers' => $request->answers,
            'is_completed' => !$request->is_game_over,
            'is_game_over' => $request->is_game_over,
        ];

        if ($existing) {
            $existing->update($data);
        } else {
            Module3Flood::create(array_merge($data, [
                'student_id' => $studentId
            ]));
        }

        return response()->json(['success' => true]);
    }
}
