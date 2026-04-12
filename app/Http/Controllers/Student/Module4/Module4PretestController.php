<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4Pretest;
use App\Models\Module_4\Module4PretestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Module4PretestController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'total_items' => ['required', 'integer', 'min:1'],
            'level' => ['nullable', 'string', 'max:100'],
            'answers' => ['required', 'array'],
            'answers.*.question_number' => ['required', 'integer', 'min:1'],
            'answers.*.selected_option' => ['required', 'integer', 'min:0'],
            'answers.*.correct_option' => ['required', 'integer', 'min:0'],
            'answers.*.is_correct' => ['required', 'boolean'],
        ]);

        $result = DB::transaction(function () use ($studentId, $validated) {
            $pretest = Module4Pretest::updateOrCreate(
                ['student_id' => $studentId],
                [
                    'score' => $validated['score'],
                    'total_items' => $validated['total_items'],
                    'level' => $validated['level'] ?? null,
                    'is_completed' => true,
                ]
            );

            Module4PretestAnswer::where('module4_pretest_id', $pretest->id)->delete();

            foreach ($validated['answers'] as $answer) {
                Module4PretestAnswer::create([
                    'module4_pretest_id' => $pretest->id,
                    'question_number' => $answer['question_number'],
                    'selected_option' => $answer['selected_option'],
                    'correct_option' => $answer['correct_option'],
                    'is_correct' => $answer['is_correct'],
                ]);
            }

            return $pretest;
        });

        return response()->json(['success' => true, 'data' => $result]);
    }
}
