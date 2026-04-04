<?php

namespace App\Http\Controllers\Student\Pretest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pretest\Module2Pretest;
use App\Models\Pretest\Module2PretestAnswer;
use Illuminate\Support\Facades\Session;

class Module2PretestController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'percentage' => 'required|numeric',
            'answers' => 'required|array',
        ]);

        // Save main result
        $pretest = Module2Pretest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
        ]);

        // Save answers
        foreach ($request->answers as $answer) {
            Module2PretestAnswer::create([
                'module2_pretest_id' => $pretest->id,
                'question_number' => $answer['question_number'],
                'selected_answer' => $answer['selected'],
                'correct_answer' => $answer['correct'],
                'is_correct' => $answer['is_correct'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pretest saved successfully!',
        ]);
    }
}
