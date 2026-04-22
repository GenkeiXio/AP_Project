<?php

namespace App\Http\Controllers\Student\Pretest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pretest\Module2Pretest;
use App\Models\Pretest\Module2PretestAnswer;
use Illuminate\Support\Facades\Session;

class Module2PretestController extends Controller
{
    public function index()
    {
        if (!Session::get('student_id')) {
            return redirect()->route('home');
        }

        // 🔥 RESET attempts EVERY VISIT
        session()->forget('module2_pretest_attempts');

        return view('module2');
    }

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

        // ✅ SESSION-BASED ATTEMPTS (NOT DATABASE)
        $attempts = session()->get('module2_pretest_attempts', 0);

        if ($attempts >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Naabot mo na ang maximum na 3 attempts.'
            ], 403);
        }

        session()->put('module2_pretest_attempts', $attempts + 1);

        // ✅ SAVE RESULT
        $pretest = Module2Pretest::create([
            'student_id' => $studentId,
            'score' => $request->score,
            'percentage' => $request->percentage,
        ]);

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
            'remaining_attempts' => 3 - ($attempts + 1)
        ]);
    }

    public function checkAttempts()
	{
		$studentId = Session::get('student_id');

		return response()->json([
			'remaining' => 3 - $attemptCount
		]);
	}
}