<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pretest\Module3Pretest;
use App\Models\Pretest\Module3PretestAnswer;

class Module3_PretestController extends Controller
{
    private function studentId()
    {
        return Session::get('student_id');
    }

    public function index()
    {
        if (!$this->studentId()) {
            return redirect()->route('home');
        }

        return view('module3_pretest');
    }

    public function store(Request $request)
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $answers = $request->answers;

        $correctAnswers = [
            1,2,1,1,1,
            1,1,1,1,1,
            1,1,1,1,1
        ];

        $score = 0;

        // Create Pretest Record
        $pretest = Module3Pretest::create([
            'student_id' => $studentId,
            'score' => 0,
            'percentage' => 0,
        ]);

        foreach ($answers as $index => $selected) {
            $correct = $correctAnswers[$index];
            $isCorrect = $selected == $correct;

            if ($isCorrect) $score++;

            Module3PretestAnswer::create([
                'module3_pretest_id' => $pretest->id,
                'question_number' => $index + 1,
                'selected_answer' => $selected,
                'correct_answer' => $correct,
                'is_correct' => $isCorrect,
            ]);
        }

        $percentage = ($score / count($correctAnswers)) * 100;

        $pretest->update([
            'score' => $score,
            'percentage' => $percentage,
        ]);

        return response()->json([
            'success' => true,
            'score' => $score,
            'percentage' => $percentage,
        ]);
    }
}
