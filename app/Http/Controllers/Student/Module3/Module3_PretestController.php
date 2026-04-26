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

        // ALWAYS reset attempts when student visits/revisits the pretest page.
        // This means 3 fresh tries any time they load the page (navigate away and back = reset).
        session()->put('module3_pretest_attempts', 0);

        return view('Students.Module3.Test.module3_pretest');
    }

    public function store(Request $request)
    {
        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check current attempt count (0 = no attempts yet, 3 = exhausted)
        $attempts = session()->get('module3_pretest_attempts', 0);

        if ($attempts >= 3) {
            return response()->json([
                'error' => 'Naabot mo na ang pinakamataas na 3 pagsubok.'
            ], 403);
        }

        $answers = $request->input('answers', []);

        if (empty($answers) || !is_array($answers)) {
            return response()->json(['error' => 'Walang sagot na natanggap.'], 400);
        }

        $score = 0;
        $total = count($answers);

        // Create the parent pretest record (score/percentage updated after loop)
        $pretest = Module3Pretest::create([
            'student_id' => $studentId,
            'score'      => 0,
            'percentage' => 0,
        ]);

        foreach ($answers as $answer) {
            $selected  = $answer['selected']         ?? null;  // e.g. 'a', 'b', 'c', 'd'
            $correct   = $answer['correct']          ?? null;  // e.g. 'a'
            $isCorrect = ($selected !== null && $selected === $correct);

            if ($isCorrect) {
                $score++;
            }

            Module3PretestAnswer::create([
                'module3_pretest_id' => $pretest->id,
                'question_number'    => $answer['question_number'],
                'selected_answer'    => $selected,   // stored as string: 'a','b','c','d'
                'correct_answer'     => $correct,    // stored as string: 'a','b','c','d'
                'is_correct'         => $isCorrect,
            ]);
        }

        $percentage = $total > 0 ? round(($score / $total) * 100, 2) : 0;

        $pretest->update([
            'score'      => $score,
            'percentage' => $percentage,
        ]);

        // Increment attempts AFTER a successful save
        $attempts++;
        session()->put('module3_pretest_attempts', $attempts);

        $remaining = 3 - $attempts; // e.g. after 1st submit → remaining = 2

        return response()->json([
            'success'    => true,
            'score'      => $score,
            'total'      => $total,
            'percentage' => $percentage,
            'attempts'   => $attempts,   // how many used (1, 2, or 3)
            'remaining'  => $remaining,  // how many left (2, 1, or 0)
        ]);
    }
}
