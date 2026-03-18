<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Quiz;
use App\Models\GameSession;
use App\Models\StudentScore;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentClassController extends Controller
{
    private function student(): Student
    {
        return Student::findOrFail(Session::get('student_id'));
    }

    // ── Classes page ──
    public function index()
    {
        $student       = $this->student();
        $joinedClasses = $student->classes()->with('teacher')->withCount('students')->get();
        return view('Students.classes', compact('student', 'joinedClasses'));
    }

    // ── Search classes by name or code ──
    public function search(Request $request)
    {
        $query   = $request->get('q', '');
        $student = $this->student();

        $classes = SchoolClass::where('is_active', true)
            ->where(fn($q) =>
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('class_code', 'like', "%{$query}%")
            )
            ->whereNotIn('id', $student->classes()->pluck('classes.id'))
            ->with('teacher')
            ->withCount('students')
            ->limit(10)
            ->get();

        return response()->json($classes);
    }

    // ── Join a class ──
    public function join(Request $request)
    {
        $student = $this->student();
        $class   = SchoolClass::where('class_code', strtoupper($request->class_code))
                              ->where('is_active', true)
                              ->firstOrFail();

        if ($student->classes()->where('class_id', $class->id)->exists()) {
            return response()->json(['success' => false, 'message' => 'You are already in this class.']);
        }

        $student->classes()->attach($class->id, ['joined_at' => now()]);
        return response()->json(['success' => true, 'class' => $class->load('teacher')]);
    }

    // ── Leave a class ──
    public function leave(SchoolClass $class)
    {
        $this->student()->classes()->detach($class->id);
        return response()->json(['success' => true]);
    }

    // ── Class quizzes ──
    public function classDetail(SchoolClass $class)
    {
        $student = $this->student();
        abort_unless($student->classes()->where('class_id', $class->id)->exists(), 403);

        $quizzes = $class->quizzes()
            ->where('is_published', true)
            ->withCount('questions')
            ->get()
            ->map(function ($quiz) use ($student) {
                $lastSession = GameSession::where('quiz_id', $quiz->id)
                    ->where('student_id', $student->id)
                    ->where('status', 'completed')
                    ->latest('completed_at')
                    ->first();
                $quiz->last_session = $lastSession;
                return $quiz;
            });

        return view('Students.class-detail', compact('class', 'quizzes', 'student'));
    }

    // ── Play a quiz ──
    public function playQuiz(Quiz $quiz)
    {
        $student = $this->student();
        abort_unless(
            $quiz->is_published &&
            $student->classes()->where('class_id', $quiz->class_id)->exists(),
            403
        );

        $quiz->load(['questions.options', 'schoolClass']);
        return view('Students.Games.play', compact('quiz', 'student'));
    }

    // ── Submit quiz answers ──
    public function submitQuiz(Request $request, Quiz $quiz)
    {
        $student = $this->student();
        $quiz->load('questions.options');

        $session = GameSession::create([
            'quiz_id'        => $quiz->id,
            'student_id'     => $student->id,
            'total_questions'=> $quiz->questions->count(),
            'total_points'   => $quiz->questions->sum('points'),
            'status'         => 'started',
            'started_at'     => now(),
        ]);

        $score   = 0;
        $correct = 0;
        $answers = $request->get('answers', []);

        foreach ($quiz->questions as $question) {
            $studentAnswer = $answers[$question->id] ?? '';
            $isCorrect     = strtolower(trim($studentAnswer)) === strtolower(trim($question->correct_answer));

            if ($isCorrect) {
                $score += $question->points;
                $correct++;
            }

            StudentScore::create([
                'game_session_id' => $session->id,
                'question_id'     => $question->id,
                'student_answer'  => $studentAnswer,
                'is_correct'      => $isCorrect,
                'points_earned'   => $isCorrect ? $question->points : 0,
            ]);
        }

        $session->update([
            'score'           => $score,
            'correct_answers' => $correct,
            'status'          => 'completed',
            'completed_at'    => now(),
        ]);

        $pct = $session->total_points > 0 ? round(($score / $session->total_points) * 100) : 0;

        return response()->json([
            'success'         => true,
            'score'           => $score,
            'total_points'    => $session->total_points,
            'correct_answers' => $correct,
            'total_questions' => $session->total_questions,
            'percentage'      => $pct,
            'session_id'      => $session->id,
        ]);
    }

    // ── Avatar update ──
    public function saveAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|in:explorer_boy,explorer_girl,scientist,adventurer']);
        $this->student()->update(['avatar' => $request->avatar]);
        return response()->json(['success' => true]);
    }
}
