<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        /* ---------------- STATS ---------------- */

        $totalStudents = DB::table('students')->count();

        $totalAttempts =
            DB::table('module2_pretest_table')->count() +
            DB::table('module2_posttest_table')->count() +
            DB::table('module2_final_activity_table')->count();

        $avgPre = DB::table('module2_pretest_table')->avg('percentage') ?? 0;
        $avgPost = DB::table('module2_posttest_table')->avg('percentage') ?? 0;

        $avgScore = round(($avgPre + $avgPost) / 2);

        $totalModules = DB::table('module2_pretest_table')
            ->distinct('student_id')
            ->count('student_id');

        $stats = [
            'total_sessions' => $totalAttempts,
            'total_students' => $totalStudents,
            'avg_score' => $avgScore,
            'total_quizzes' => $totalModules
        ];

        /* ---------------- CHART DATA ---------------- */

        $monthlyRaw = DB::table('module2_pretest_table')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $monthlyRaw[$i] ?? 0;
        }

        /* ---------- MONTHLY ---------- */
        $barLabelsMonthly = [];
        $barDataMonthly = [];

        for ($i = 1; $i <= 12; $i++) {
            $barLabelsMonthly[] = date("M", mktime(0,0,0,$i,1));
            $barDataMonthly[] = $monthlyData[$i];
        }

        /* ---------- QUARTERLY ---------- */
        $barLabelsQuarterly = ['Q1','Q2','Q3','Q4'];
        $barDataQuarterly = [
            $monthlyData[1] + $monthlyData[2] + $monthlyData[3],
            $monthlyData[4] + $monthlyData[5] + $monthlyData[6],
            $monthlyData[7] + $monthlyData[8] + $monthlyData[9],
            $monthlyData[10] + $monthlyData[11] + $monthlyData[12],
        ];

        /* ---------- YEARLY ---------- */
        $barLabelsYearly = ['This Year'];
        $barDataYearly = [array_sum($monthlyData)];

        /* ---------- SCORE DISTRIBUTION ---------- */
        $scoreDistribution = DB::table('module2_posttest_table')
            ->selectRaw('ROUND(percentage/25)*25 as range_group, COUNT(*) as total')
            ->groupBy('range_group')
            ->pluck('total', 'range_group');

        $lineData = [
            $scoreDistribution[0] ?? 0,
            $scoreDistribution[25] ?? 0,
            $scoreDistribution[50] ?? 0,
            $scoreDistribution[75] ?? 0,
            $scoreDistribution[100] ?? 0,
        ];

        /* ---------------- TOP STUDENTS ---------------- */

        $topStudents = DB::table('module2_posttest_table as pt')
            ->join('students as s', 'pt.student_id', '=', 's.id')
            ->select(
                's.username',
                DB::raw('COUNT(pt.id) as attempts'),
                DB::raw('AVG(pt.percentage) as avg_pct')
            )
            ->groupBy('s.username')
            ->orderByDesc('avg_pct')
            ->limit(5)
            ->get();

        return view('Teachers.analytics', compact(
            'stats',
            'topStudents',

            'barLabelsMonthly',
            'barDataMonthly',

            'barLabelsQuarterly',
            'barDataQuarterly',

            'barLabelsYearly',
            'barDataYearly',

            'lineData'
        ));
    }
}
