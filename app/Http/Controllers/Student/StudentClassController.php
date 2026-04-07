<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use App\Models\Quiz;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentClassController extends Controller
{
	private function student(): ?Student
	{
		return Student::find(Session::get('student_id'));
	}

	public function saveAvatar(Request $request)
	{
		$request->validate([
			'avatar' => 'required|in:boy_uniform,girl_uniform',
		]);

		$student = $this->student();
		if (!$student) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}

		$student->update(['avatar' => $request->avatar]);

		return response()->json(['success' => true]);
	}

	public function index()
	{
		$student = $this->student();
		if (!$student) {
			return redirect()->route('home');
		}

		$joinedClasses = SchoolClass::query()
			->whereHas('students', fn ($q) => $q->where('students.id', $student->id))
			->with(['teacher'])
			->withCount('students')
			->latest('id')
			->get();

		return view('Students.classes', compact('joinedClasses'));
	}

	public function search(Request $request)
	{
		$student = $this->student();
		if (!$student) {
			return response()->json([], 401);
		}

		$q = trim((string) $request->query('q', ''));
		if ($q === '' || mb_strlen($q) < 2) {
			return response()->json([]);
		}

		$classes = SchoolClass::query()
			->with('teacher')
			->withCount('students')
			->where('is_active', true)
			->where(function ($builder) use ($q) {
				$builder->where('name', 'like', "%{$q}%")
					->orWhere('class_code', 'like', "%{$q}%");
			})
			->whereDoesntHave('students', fn ($b) => $b->where('students.id', $this->student()->id))
			->orderBy('name')
			->limit(20)
			->get();

		return response()->json($classes);
	}

	public function join(Request $request)
	{
		$student = $this->student();
		if (!$student) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}

		$request->validate([
			'class_code' => 'required|string|max:50',
		]);

		$code = trim((string) $request->input('class_code'));

		$class = SchoolClass::query()
			->where('class_code', $code)
			->where('is_active', true)
			->first();

		if (!$class) {
			return response()->json(['success' => false, 'message' => 'Class not found or inactive.'], 404);
		}

		if ($class->students()->where('students.id', $student->id)->exists()) {
			return response()->json(['success' => false, 'message' => 'You are already in this class.'], 422);
		}

		$class->students()->attach($student->id, ['joined_at' => now()]);

		return response()->json(['success' => true]);
	}

	public function leave(SchoolClass $class)
	{
		$student = $this->student();
		if (!$student) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}

		$class->students()->detach($student->id);

		return response()->json(['success' => true]);
	}

	public function classDetail(SchoolClass $class)
	{
		$student = $this->student();
		if (!$student) {
			return redirect()->route('home');
		}

		if (!$class->students()->where('students.id', $student->id)->exists()) {
			return redirect()->route('student.classes');
		}

		$quizzes = Quiz::query()
			->where('class_id', $class->id)
			->where('is_published', true)
			->withCount('questions')
			->with([
				'gameSessions' => function ($query) use ($student) {
					$query->where('student_id', $student->id)
						->where('status', 'completed')
						->orderByDesc('completed_at');
				},
			])
			->orderBy('type')
			->orderByDesc('id')
			->get();

		$quizzes->each(function ($quiz) {
			$quiz->setAttribute('last_session', $quiz->gameSessions->first());
		});

		return view('Students.class-detail', compact('class', 'quizzes'));
	}

	public function playQuiz(Quiz $quiz)
	{
		$student = $this->student();
		if (!$student) {
			return redirect()->route('home');
		}

		$class = $quiz->schoolClass;
		if (!$class || !$class->students()->where('students.id', $student->id)->exists()) {
			return redirect()->route('student.classes');
		}

		$quiz->load(['questions.options', 'schoolClass']);

		return view('Students.Games.play', compact('quiz'));
	}

	public function submitQuiz(Request $request, Quiz $quiz)
	{
		$student = $this->student();
		if (!$student) {
			return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
		}

		$class = $quiz->schoolClass;
		if (!$class || !$class->students()->where('students.id', $student->id)->exists()) {
			return response()->json(['success' => false, 'message' => 'Not enrolled in this class.'], 403);
		}

		$answers = (array) $request->input('answers', []);
		$timeSpent = (int) $request->input('time_spent', 0);

		$quiz->load('questions');

		$totalPoints = 0;
		$score = 0;
		$correctAnswers = 0;

		foreach ($quiz->questions as $question) {
			$totalPoints += (int) $question->points;
			$studentAnswer = $answers[$question->id] ?? '';

			$expected = mb_strtolower(trim((string) $question->correct_answer));
			$actual = mb_strtolower(trim((string) $studentAnswer));
			$isCorrect = ($actual !== '' && $actual === $expected);

			if ($isCorrect) {
				$correctAnswers++;
				$score += (int) $question->points;
			}
		}

		$session = GameSession::create([
			'quiz_id' => $quiz->id,
			'student_id' => $student->id,
			'score' => $score,
			'total_points' => $totalPoints,
			'correct_answers' => $correctAnswers,
			'total_questions' => $quiz->questions->count(),
			'status' => 'completed',
			'started_at' => now()->subSeconds(max($timeSpent, 0)),
			'completed_at' => now(),
		]);

		foreach ($quiz->questions as $question) {
			$studentAnswer = (string) ($answers[$question->id] ?? '');
			$expected = mb_strtolower(trim((string) $question->correct_answer));
			$actual = mb_strtolower(trim($studentAnswer));
			$isCorrect = ($actual !== '' && $actual === $expected);

			StudentScore::create([
				'game_session_id' => $session->id,
				'question_id' => $question->id,
				'student_answer' => $studentAnswer,
				'is_correct' => $isCorrect,
				'points_earned' => $isCorrect ? (int) $question->points : 0,
			]);
		}

		return response()->json([
			'success' => true,
			'score' => $score,
			'total_points' => $totalPoints,
			'correct_answers' => $correctAnswers,
			'total_questions' => $quiz->questions->count(),
			'percentage' => $totalPoints > 0 ? (int) round(($score / $totalPoints) * 100) : 0,
			'class_id' => $quiz->class_id,
		]);
	}
}
