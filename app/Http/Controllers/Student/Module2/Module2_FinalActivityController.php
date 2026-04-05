<?php

namespace App\Http\Controllers\Student\Module2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module_2\Module2FinalActivity;
use App\Models\Module_2\Module2FinalActivityAnswer;
use Illuminate\Support\Facades\Session;

class Module2_FinalActivityController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->validate([
            'total_xp' => 'required|integer',
            'score' => 'required|integer',
            'total_questions' => 'required|integer',
            'correct_answers' => 'required|integer',
            'time_taken' => 'required|integer',
            'answers' => 'required|array',
        ]);

        // SAVE MAIN RECORD
        $activity = Module2FinalActivity::create([
            'student_id' => $studentId,
            'total_xp' => $data['total_xp'],
            'score' => $data['score'],
            'total_questions' => $data['total_questions'],
            'correct_answers' => $data['correct_answers'],
            'time_taken' => $data['time_taken'],
        ]);

        // SAVE ANSWERS (MULTIPLE PER SCENARIO)
        foreach ($data['answers'] as $answer) {
            Module2FinalActivityAnswer::create([
                'module2_final_activity_id' => $activity->id,
                'scenario_number' => $answer['scenario_number'],
                'choice_text' => $answer['choice_text'],
                'selected' => $answer['selected'],
                'is_correct' => $answer['is_correct'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Final activity saved successfully!',
        ]);
    }
}
