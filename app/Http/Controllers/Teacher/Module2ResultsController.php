<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Module2ResultsController extends Controller
{
    public function index()
    {
        $students = DB::table('students')

            ->leftJoin('module2_pretest_table as pre',   'students.id', '=', 'pre.student_id')
            ->leftJoin('module2_posttest_table as post',  'students.id', '=', 'post.student_id')
            ->leftJoin('module2_final_activity_table as final', 'students.id', '=', 'final.student_id')
            ->leftJoin('module2_essay_table as essay',   'students.id', '=', 'essay.student_id')

            // Count node submissions
            ->leftJoin(
                DB::raw('(SELECT student_id, COUNT(DISTINCT problem_number) as count FROM module2_node1_table GROUP BY student_id) as n1'),
                'students.id', '=', 'n1.student_id'
            )
            ->leftJoin(
                DB::raw('(SELECT student_id, COUNT(DISTINCT problem_number) as count FROM module2_node2_table GROUP BY student_id) as n2'),
                'students.id', '=', 'n2.student_id'
            )
            ->leftJoin(
                DB::raw('(SELECT student_id, COUNT(DISTINCT problem_number) as count FROM module2_node3_table GROUP BY student_id) as n3'),
                'students.id', '=', 'n3.student_id'
            )

            ->select(
                'students.id',
                'students.username',
                'students.avatar',

                // Pretest
                'pre.score as pre_score',
                'pre.percentage as pre_percentage',
                'pre.created_at as pre_submitted_at',

                // Posttest
                'post.score as post_score',
                'post.percentage as post_percentage',
                'post.created_at as post_submitted_at',

                // Final
                'final.score as final_score',
                'final.total_xp',
                'final.correct_answers',
                'final.total_questions',
                'final.time_taken',

                // Essay
                DB::raw('CASE WHEN essay.id IS NOT NULL THEN 1 ELSE 0 END as has_essay'),
                DB::raw("LEFT(essay.essay_answer, 120) as essay_preview"),

                // Node progress
                DB::raw('COALESCE(n1.count, 0) as node1_count'),
                DB::raw('COALESCE(n2.count, 0) as node2_count'),
                DB::raw('COALESCE(n3.count, 0) as node3_count')
            )
            ->orderBy('students.username')
            ->get()
            ->map(function ($s) {
                // Completion score: how many of 7 activities done
                $done = 0;
                if ($s->pre_score !== null)   $done++;
                if ($s->post_score !== null)  $done++;
                if ($s->final_score !== null) $done++;
                if ($s->has_essay)            $done++;
                if ($s->node1_count > 0)      $done++;
                if ($s->node2_count > 0)      $done++;
                if ($s->node3_count > 0)      $done++;

                $s->completion = round(($done / 7) * 100);

                // Grade (average of pre+post+final as % of max possible)
                $scores = array_filter([
                    $s->pre_percentage,
                    $s->post_percentage,
                    $s->final_score !== null ? round(($s->correct_answers / max($s->total_questions, 1)) * 100) : null,
                ], fn($v) => $v !== null);

                $s->avg_score = count($scores) ? round(array_sum($scores) / count($scores)) : 0;

                return $s;
            });

        // Summary stats
        $summary = [
            'total'           => $students->count(),
            'completed'       => $students->where('completion', 100)->count(),
            'avg_score'       => $students->avg('avg_score'),
            'avg_pre'         => $students->whereNotNull('pre_percentage')->avg('pre_percentage'),
            'avg_post'        => $students->whereNotNull('post_percentage')->avg('post_percentage'),
            'essay_submitted' => $students->where('has_essay', 1)->count(),
        ];

        return view('Teachers.results.module2_results', compact('students', 'summary'));
    }

    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        abort_if(! $student, 404);

        // ---------- PRETEST ----------
        $pretest        = DB::table('module2_pretest_table')->where('student_id', $id)->latest()->first();
        $pretestAnswers = $pretest
            ? DB::table('module2_pretest_answers_table')->where('module2_pretest_id', $pretest->id)->orderBy('question_number')->get()
            : collect();

        // ---------- POSTTEST ----------
        $posttest        = DB::table('module2_posttest_table')->where('student_id', $id)->latest()->first();
        $posttestAnswers = $posttest
            ? DB::table('module2_posttest_answers_table')->where('module2_posttest_id', $posttest->id)->orderBy('question_number')->get()
            : collect();

        // ---------- FINAL ACTIVITY ----------
        $final        = DB::table('module2_final_activity_table')->where('student_id', $id)->latest()->first();
        $finalAnswers = $final
            ? DB::table('module2_final_activity_answers_table')->where('module2_final_activity_id', $final->id)->get()
            : collect();

        // ---------- NODES ----------
        $node1 = DB::table('module2_node1_table')->where('student_id', $id)->orderBy('problem_number')->get();
        $node2 = DB::table('module2_node2_table')->where('student_id', $id)->orderBy('problem_number')->get();
        $node3 = DB::table('module2_node3_table')->where('student_id', $id)->orderBy('problem_number')->get();

        // ---------- ESSAY ----------
        $essay = DB::table('module2_essay_table')->where('student_id', $id)->latest()->first();

        // ---------- DERIVED STATS ----------
        $stats = [
            'pre_correct'   => $pretestAnswers->where('is_correct', 1)->count(),
            'pre_total'     => $pretestAnswers->count(),
            'post_correct'  => $posttestAnswers->where('is_correct', 1)->count(),
            'post_total'    => $posttestAnswers->count(),
            'improvement'   => round(($posttest->percentage ?? 0) - ($pretest->percentage ?? 0), 1),
            'nodes_done'    => (int)($node1->count() > 0) + (int)($node2->count() > 0) + (int)($node3->count() > 0),
        ];

        return view('Teachers.results.student_module2', compact(
            'student',
            'pretest',  'pretestAnswers',
            'posttest', 'posttestAnswers',
            'final',    'finalAnswers',
            'node1',    'node2', 'node3',
            'essay',
            'stats'
        ));
    }

    public function exportFull($id)
    {
        $student = DB::table('students')->where('id', $id)->firstOrFail();
        $filename = 'module2_' . str_replace(' ', '_', $student->username) . '_' . now()->format('Ymd') . '.csv';

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate',
        ];

        $callback = function () use ($id) {
            $file = fopen('php://output', 'w');

            $this->writeCsvSection($file, 'PRETEST', function () use ($id, $file) {
                $pre = DB::table('module2_pretest_table')->where('student_id', $id)->first();
                if (! $pre) { fputcsv($file, ['No data']); return; }

                fputcsv($file, ['Score', 'Percentage', 'Submitted At']);
                fputcsv($file, [$pre->score, $pre->percentage . '%', $pre->created_at]);
                fputcsv($file, []);
                fputcsv($file, ['Q#', 'Selected', 'Correct Answer', 'Result']);

                DB::table('module2_pretest_answers_table')
                    ->where('module2_pretest_id', $pre->id)
                    ->orderBy('question_number')
                    ->get()
                    ->each(fn($a) => fputcsv($file, [
                        $a->question_number,
                        $a->selected_answer,
                        $a->correct_answer,
                        $a->is_correct ? '✓ Correct' : '✗ Wrong',
                    ]));
            });

            $this->writeCsvSection($file, 'POSTTEST', function () use ($id, $file) {
                $post = DB::table('module2_posttest_table')->where('student_id', $id)->first();
                if (! $post) { fputcsv($file, ['No data']); return; }

                fputcsv($file, ['Score', 'Percentage', 'Submitted At']);
                fputcsv($file, [$post->score, $post->percentage . '%', $post->created_at]);
                fputcsv($file, []);
                fputcsv($file, ['Q#', 'Selected', 'Correct Answer', 'Result']);

                DB::table('module2_posttest_answers_table')
                    ->where('module2_posttest_id', $post->id)
                    ->orderBy('question_number')
                    ->get()
                    ->each(fn($a) => fputcsv($file, [
                        $a->question_number,
                        $a->selected_answer,
                        $a->correct_answer,
                        $a->is_correct ? '✓ Correct' : '✗ Wrong',
                    ]));
            });

            $this->writeCsvSection($file, 'FINAL ACTIVITY', function () use ($id, $file) {
                $final = DB::table('module2_final_activity_table')->where('student_id', $id)->first();
                if (! $final) { fputcsv($file, ['No data']); return; }

                fputcsv($file, ['Score', 'XP Earned', 'Correct', 'Total Questions', 'Time (s)']);
                fputcsv($file, [
                    $final->score,
                    $final->total_xp,
                    $final->correct_answers,
                    $final->total_questions,
                    $final->time_taken,
                ]);
            });

            foreach ([1, 2, 3] as $n) {
                $table = "module2_node{$n}_table";
                $this->writeCsvSection($file, "NODE $n", function () use ($id, $file, $table, $n) {
                    $rows = DB::table($table)->where('student_id', $id)->orderBy('problem_number')->get();
                    if ($rows->isEmpty()) { fputcsv($file, ['No data']); return; }

                    fputcsv($file, ['Problem #', 'Sanhi', 'Bunga', 'Solusyon']);
                    foreach ($rows as $r) {
                        fputcsv($file, [
                            $r->problem_number,
                            $n === 1 ? $r->sanhi_image : $r->sanhi,
                            $n === 1 ? $r->bunga_image : $r->bunga,
                            $n === 1 ? $r->solusyon_image : $r->solusyon,
                        ]);
                    }
                });
            }

            $this->writeCsvSection($file, 'ESSAY', function () use ($id, $file) {
                $essay = DB::table('module2_essay_table')->where('student_id', $id)->first();
                if (! $essay) { fputcsv($file, ['No submission']); return; }

                fputcsv($file, ['Submitted At', $essay->submitted_at ?? $essay->created_at]);
                fputcsv($file, [$essay->essay_answer]);
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function writeCsvSection($file, string $title, callable $body): void
    {
        fputcsv($file, []);
        fputcsv($file, ["=== $title ==="]);
        $body();
        fputcsv($file, []);
    }
}