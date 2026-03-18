<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    private function teacher()
    {
        return Auth::guard('teacher')->user();
    }

    public function create(SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);
        return view('Teachers.quiz-builder', compact('class'));
    }

    public function store(Request $request, SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);

        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:pre_test,quiz',
            'game_format' => 'required|in:mcq,drag_drop,fill_blank,word_scramble',
            'time_limit'  => 'nullable|integer|min:1|max:180',
            'questions'   => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request, $class) {
            $quiz = Quiz::create([
                'class_id'    => $class->id,
                'teacher_id'  => $this->teacher()->id,
                'title'       => $request->title,
                'description' => $request->description,
                'type'        => $request->type,
                'game_format' => $request->game_format,
                'time_limit'  => $request->time_limit,
                'is_published'=> false,
            ]);

            foreach ($request->questions as $i => $q) {
                $question = Question::create([
                    'quiz_id'       => $quiz->id,
                    'question_text' => $q['question_text'],
                    'correct_answer'=> $q['correct_answer'],
                    'points'        => $q['points'] ?? 1,
                    'order'         => $i,
                    'extra_data'    => $q['extra_data'] ?? null,
                ]);

                if (!empty($q['options'])) {
                    foreach ($q['options'] as $j => $opt) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $opt['text'],
                            'is_correct'  => $opt['is_correct'] ?? false,
                            'order'       => $j,
                        ]);
                    }
                }
            }
        });

        return response()->json(['success' => true]);
    }

    public function edit(Quiz $quiz)
    {
        abort_if($quiz->teacher_id !== $this->teacher()->id, 403);
        $quiz->load(['questions.options', 'schoolClass']);
        return view('Teachers.quiz-builder', ['class' => $quiz->schoolClass, 'quiz' => $quiz]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        abort_if($quiz->teacher_id !== $this->teacher()->id, 403);

        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'time_limit'  => 'nullable|integer|min:1|max:180',
            'questions'   => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request, $quiz) {
            $quiz->update($request->only('title', 'description', 'time_limit'));

            // Remove old questions and re-create
            $quiz->questions()->each(fn($q) => $q->options()->delete());
            $quiz->questions()->delete();

            foreach ($request->questions as $i => $q) {
                $question = Question::create([
                    'quiz_id'       => $quiz->id,
                    'question_text' => $q['question_text'],
                    'correct_answer'=> $q['correct_answer'],
                    'points'        => $q['points'] ?? 1,
                    'order'         => $i,
                    'extra_data'    => $q['extra_data'] ?? null,
                ]);

                if (!empty($q['options'])) {
                    foreach ($q['options'] as $j => $opt) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $opt['text'],
                            'is_correct'  => $opt['is_correct'] ?? false,
                            'order'       => $j,
                        ]);
                    }
                }
            }
        });

        return response()->json(['success' => true]);
    }

    public function togglePublish(Quiz $quiz)
    {
        abort_if($quiz->teacher_id !== $this->teacher()->id, 403);
        $quiz->update(['is_published' => !$quiz->is_published]);
        return response()->json(['success' => true, 'is_published' => $quiz->is_published]);
    }

    public function destroy(Quiz $quiz)
    {
        abort_if($quiz->teacher_id !== $this->teacher()->id, 403);
        $quiz->delete();
        return response()->json(['success' => true]);
    }
}
