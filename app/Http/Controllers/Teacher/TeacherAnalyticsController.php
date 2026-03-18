<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\GameSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAnalyticsController extends Controller
{
    private function teacher()
    {
        return Auth::guard('teacher')->user();
    }

    public function index(Request $request)
    {
        $teacher = $this->teacher();
        $classes = SchoolClass::where('teacher_id', $teacher->id)->get();
        $classId = $request->get('class_id');

        $sessionsQuery = GameSession::with(['student', 'quiz.schoolClass'])
            ->whereHas('quiz.schoolClass', fn($q) => $q->where('teacher_id', $teacher->id))
            ->where('status', 'completed');

        if ($classId) {
            $sessionsQuery->whereHas('quiz', fn($q) => $q->where('class_id', $classId));
        }

        $sessions = $sessionsQuery->get();

        $chartData = SchoolClass::where('teacher_id', $teacher->id)
            ->with(['quizzes.gameSessions' => fn($q) => $q->where('status', 'completed')])
            ->when($classId, fn($q) => $q->where('id', $classId))
            ->get()
            ->map(function ($class) {
                $allSessions = $class->quizzes->flatMap->gameSessions;
                $avg = $allSessions->count()
                    ? round($allSessions->avg(fn($s) => $s->total_points > 0 ? ($s->score / $s->total_points) * 100 : 0), 1)
                    : 0;
                return ['label' => $class->name, 'avg' => $avg, 'count' => $allSessions->count()];
            });

        $topStudents = GameSession::where('status', 'completed')
            ->whereHas('quiz.schoolClass', fn($q) => $q->where('teacher_id', $teacher->id))
            ->when($classId, fn($q) => $q->whereHas('quiz', fn($q2) => $q2->where('class_id', $classId)))
            ->selectRaw('student_id, AVG(score/NULLIF(total_points,0)*100) as avg_pct, COUNT(*) as attempts')
            ->groupBy('student_id')
            ->orderByDesc('avg_pct')
            ->with('student')
            ->limit(10)
            ->get();

        $stats = [
            'total_sessions' => $sessions->count(),
            'avg_score'      => $sessions->count()
                ? round($sessions->avg(fn($s) => $s->total_points > 0 ? ($s->score / $s->total_points) * 100 : 0), 1)
                : 0,
            'total_students' => $sessions->pluck('student_id')->unique()->count(),
            'total_quizzes'  => $sessions->pluck('quiz_id')->unique()->count(),
        ];

        return view('Teachers.analytics', compact(
            'classes', 'sessions', 'chartData', 'topStudents', 'stats', 'classId'
        ));
    }

    public function export(Request $request)
    {
        $teacher = $this->teacher();
        $classId = $request->get('class_id');

        $sessions = GameSession::with(['student', 'quiz.schoolClass'])
            ->whereHas('quiz.schoolClass', fn($q) => $q->where('teacher_id', $teacher->id))
            ->where('status', 'completed')
            ->when($classId, fn($q) => $q->whereHas('quiz', fn($q2) => $q2->where('class_id', $classId)))
            ->get();

        $csv = "Student,Class,Quiz,Type,Score,Total Points,Percentage,Date\n";
        foreach ($sessions as $s) {
            $pct  = $s->total_points > 0 ? round(($s->score / $s->total_points) * 100, 1) : 0;
            $csv .= "\"{$s->student->username}\",\"{$s->quiz->schoolClass->name}\",\"{$s->quiz->title}\",\"{$s->quiz->type}\",{$s->score},{$s->total_points},{$pct}%,{$s->completed_at}\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="my_analytics_export.csv"',
        ]);
    }
}
