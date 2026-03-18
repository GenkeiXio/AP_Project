<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\GameSession;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $teachers  = Teacher::with('classes')->get();
        $classes   = SchoolClass::with('teacher')->get();

        // Filters
        $teacherId = $request->get('teacher_id');
        $classId   = $request->get('class_id');

        $sessionsQuery = GameSession::with(['student', 'quiz.schoolClass.teacher'])
            ->where('status', 'completed');

        if ($classId) {
            $sessionsQuery->whereHas('quiz', fn($q) => $q->where('class_id', $classId));
        } elseif ($teacherId) {
            $sessionsQuery->whereHas('quiz.schoolClass', fn($q) => $q->where('teacher_id', $teacherId));
        }

        $sessions = $sessionsQuery->get();

        // Chart data: average score per class
        $chartData = SchoolClass::with(['quizzes.gameSessions' => fn($q) => $q->where('status', 'completed')])
            ->when($teacherId, fn($q) => $q->where('teacher_id', $teacherId))
            ->when($classId,   fn($q) => $q->where('id', $classId))
            ->get()
            ->map(function ($class) {
                $allSessions = $class->quizzes->flatMap->gameSessions;
                $avg = $allSessions->count()
                    ? round($allSessions->avg(fn($s) => $s->total_points > 0 ? ($s->score / $s->total_points) * 100 : 0), 1)
                    : 0;
                return ['label' => $class->name, 'avg' => $avg, 'count' => $allSessions->count()];
            });

        // Top students
        $topStudents = GameSession::where('status', 'completed')
            ->when($classId,   fn($q) => $q->whereHas('quiz', fn($q2) => $q2->where('class_id', $classId)))
            ->when($teacherId, fn($q) => $q->whereHas('quiz.schoolClass', fn($q2) => $q2->where('teacher_id', $teacherId)))
            ->selectRaw('student_id, AVG(score/NULLIF(total_points,0)*100) as avg_pct, COUNT(*) as attempts')
            ->groupBy('student_id')
            ->orderByDesc('avg_pct')
            ->with('student')
            ->limit(10)
            ->get();

        $stats = [
            'total_sessions'  => $sessions->count(),
            'avg_score'       => $sessions->count() ? round($sessions->avg(fn($s) => $s->total_points > 0 ? ($s->score / $s->total_points) * 100 : 0), 1) : 0,
            'total_students'  => Student::count(),
            'total_classes'   => SchoolClass::count(),
        ];

        return view('Admin.analytics', compact(
            'teachers', 'classes', 'sessions', 'chartData',
            'topStudents', 'stats', 'teacherId', 'classId'
        ));
    }

    public function export(Request $request)
    {
        $classId   = $request->get('class_id');
        $teacherId = $request->get('teacher_id');

        $sessions = GameSession::with(['student', 'quiz.schoolClass.teacher'])
            ->where('status', 'completed')
            ->when($classId,   fn($q) => $q->whereHas('quiz', fn($q2) => $q2->where('class_id', $classId)))
            ->when($teacherId, fn($q) => $q->whereHas('quiz.schoolClass', fn($q2) => $q2->where('teacher_id', $teacherId)))
            ->get();

        $csv  = "Student,Class,Teacher,Quiz,Score,Total Points,Percentage,Date\n";
        foreach ($sessions as $s) {
            $pct     = $s->total_points > 0 ? round(($s->score / $s->total_points) * 100, 1) : 0;
            $teacher = $s->quiz->schoolClass->teacher->name ?? 'N/A';
            $class   = $s->quiz->schoolClass->name ?? 'N/A';
            $csv    .= "\"{$s->student->username}\",\"{$class}\",\"{$teacher}\",\"{$s->quiz->title}\",{$s->score},{$s->total_points},{$pct}%,{$s->completed_at}\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics_export.csv"',
        ]);
    }
}
