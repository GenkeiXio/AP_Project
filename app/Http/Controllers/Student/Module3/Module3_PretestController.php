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

        // 🔥 Reset attempts every visit
        session()->forget('module3_pretest_attempts');

        return view('module3_pretest');
    }

    public function store(Request $request)
    {
       $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 🔥 OPTIONAL: Limit submissions per session (not DB)
        $attempts = session()->get('module3_pretest_attempts', 0);

        if ($attempts >= 3) {
            return response()->json([
                'error' => 'Maximum attempts reached'
            ], 403);
        }

        session()->put('module3_pretest_attempts', $attempts + 1);

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

        foreach ($answers as $answer) {
            $selected = $answer['selected']; // 'a','b','c','d'
            $correct = $answer['correct'];

            $isCorrect = $selected === $correct;

            if ($isCorrect) $score++;

            Module3PretestAnswer::create([
                'module3_pretest_id' => $pretest->id,
                'question_number' => $answer['question_number'],
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
