<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Module3ResultsController extends Controller
{
    /* ──────────────────────────────────────────────────────────
     │  INDEX  –  List all students
     ─────────────────────────────────────────────────────────── */
    public function index()
    {
        $activityTables = [
            'pretest'     => 'module3_pretests',
            'node1'       => 'module3_node1_table',
            'node2'       => 'module3_node2_table',
            'node3'       => 'module3_node3_table',
            'balikaral'   => 'module3_balikaral_table',
            'bulkan'      => 'module3_bulkan_table',
            'elnino'      => 'module3_elnino_table',
            'explore'     => 'module3_explore_table',
            'flood'       => 'module3_flood_table',
            'gabay'       => 'module3_gabay_table',
            'gobagact'    => 'module3_gobagact_table',
            'lindol'      => 'module3_lindol_table',
            'safehome'    => 'module3_safehome_table',
            'posttest'    => 'module3_posttest_table',
            'performance' => 'module3_performance_tasks',
        ];

        $students = DB::table('students')->orderBy('username')->get()->map(function ($student) use ($activityTables) {
            $id = $student->id;
            $done = 0;

            foreach ($activityTables as $key => $table) {
                $has = DB::table($table)->where('student_id', $id)->exists();
                $student->{"has_{$key}"} = $has;
                if ($has) $done++;
            }

            $student->activities_done  = $done;
            $student->total_activities = count($activityTables);
            $student->completion_pct   = round(($done / count($activityTables)) * 100);

            // Quick score summary
            $pre  = DB::table('module3_pretests')      ->where('student_id', $id)->latest()->value('percentage') ?? null;
            $post = DB::table('module3_posttest_table') ->where('student_id', $id)->latest()->value('score')      ?? null;
            $student->pretest_pct   = $pre;
            $student->posttest_score = $post;

            return $student;
        });

        return view('Teachers.results.module3_results', compact('students'));
    }

    /* ──────────────────────────────────────────────────────────
     │  SHOW  –  Single student detail
     ─────────────────────────────────────────────────────────── */
    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->firstOrFail();

        // ── PRETEST ──────────────────────────────────────────
        $pretest = DB::table('module3_pretests')
            ->where('student_id', $id)->latest()->first();

        $pretestAnswers = DB::table('module3_pretest_answers')
            ->where('module3_pretest_id', $pretest->id ?? 0)
            ->orderBy('question_number')->get();

        // ── NODES ─────────────────────────────────────────────
        $node1 = DB::table('module3_node1_table')->where('student_id', $id)->latest()->first();
        $node2 = DB::table('module3_node2_table')->where('student_id', $id)->latest()->first();
        $node3 = DB::table('module3_node3_table')->where('student_id', $id)->latest()->first();

        // ── ACTIVITIES ────────────────────────────────────────
        $balikaral = DB::table('module3_balikaral_table')->where('student_id', $id)->latest()->first();
        $bulkan    = DB::table('module3_bulkan_table')   ->where('student_id', $id)->latest()->first();
        $elnino    = DB::table('module3_elnino_table')   ->where('student_id', $id)->latest()->first();
        $explore   = DB::table('module3_explore_table') ->where('student_id', $id)->latest()->first();
        $flood     = DB::table('module3_flood_table')   ->where('student_id', $id)->latest()->first();
        $gabay     = DB::table('module3_gabay_table')   ->where('student_id', $id)->latest()->first();
        $gobagact  = DB::table('module3_gobagact_table')->where('student_id', $id)->latest()->first();
        $lindol    = DB::table('module3_lindol_table')  ->where('student_id', $id)->latest()->first();
        $safehome  = DB::table('module3_safehome_table')->where('student_id', $id)->latest()->first();

        // ── POSTTEST ──────────────────────────────────────────
        $posttest = DB::table('module3_posttest_table')->where('student_id', $id)->latest()->first();
        $posttestAnswers = $posttest ? json_decode($posttest->answers ?? '[]', true) : [];

        // ── PERFORMANCE TASK ──────────────────────────────────
        $performance = DB::table('module3_performance_tasks')->where('student_id', $id)->latest()->first();

        if ($performance) {
            $performance->total_score =
                ($performance->kit_score           ?? 0) +
                ($performance->evacuation_score    ?? 0) +
                ($performance->communication_score ?? 0) +
                ($performance->safe_score          ?? 0);
        }

        // ── DERIVED STATS ─────────────────────────────────────
        $activityList = [
            $pretest, $node1, $node2, $node3, $balikaral, $bulkan,
            $elnino, $explore, $flood, $gabay, $gobagact, $lindol,
            $safehome, $posttest, $performance,
        ];
        $activitiesDone = collect($activityList)->filter()->count();

        $prePct  = (float) ($pretest->percentage  ?? 0);
        $postPct = $posttest
            ? ($posttest->total_items > 0
                ? round(($posttest->score / $posttest->total_items) * 100)
                : 0)
            : null;

        $stats = [
            'pre_correct'        => $pretestAnswers->where('is_correct', 1)->count(),
            'pre_total'          => $pretestAnswers->count(),
            'post_correct'       => collect($posttestAnswers)->where('is_correct', true)->count(),
            'post_total'         => count($posttestAnswers),
            'improvement'        => $postPct !== null ? round($postPct - $prePct, 1) : null,
            'activities_done'    => $activitiesDone,
            'total_activities'   => count($activityList),
            'completion_pct'     => round(($activitiesDone / count($activityList)) * 100),
            'perf_total'         => $performance->total_score ?? 0,
            'post_pct'           => $postPct,
        ];

        return view('Teachers.results.module3_student', compact(
            'student',
            'pretest', 'pretestAnswers',
            'node1', 'node2', 'node3',
            'balikaral', 'bulkan', 'elnino', 'explore',
            'flood', 'gabay', 'gobagact', 'lindol', 'safehome',
            'posttest', 'posttestAnswers',
            'performance',
            'stats'
        ));
    }

    /* ──────────────────────────────────────────────────────────
     │  EXPORT  –  Full CSV download
     ─────────────────────────────────────────────────────────── */
    public function export($id)
    {
        $student     = DB::table('students')->where('id', $id)->firstOrFail();
        $pretest     = DB::table('module3_pretests')        ->where('student_id', $id)->latest()->first();
        $pretestAns  = DB::table('module3_pretest_answers') ->where('module3_pretest_id', $pretest->id ?? 0)->orderBy('question_number')->get();
        $node1       = DB::table('module3_node1_table')     ->where('student_id', $id)->latest()->first();
        $node2       = DB::table('module3_node2_table')     ->where('student_id', $id)->latest()->first();
        $node3       = DB::table('module3_node3_table')     ->where('student_id', $id)->latest()->first();
        $balikaral   = DB::table('module3_balikaral_table') ->where('student_id', $id)->latest()->first();
        $bulkan      = DB::table('module3_bulkan_table')    ->where('student_id', $id)->latest()->first();
        $elnino      = DB::table('module3_elnino_table')    ->where('student_id', $id)->latest()->first();
        $explore     = DB::table('module3_explore_table')   ->where('student_id', $id)->latest()->first();
        $flood       = DB::table('module3_flood_table')     ->where('student_id', $id)->latest()->first();
        $gabay       = DB::table('module3_gabay_table')     ->where('student_id', $id)->latest()->first();
        $gobagact    = DB::table('module3_gobagact_table')  ->where('student_id', $id)->latest()->first();
        $lindol      = DB::table('module3_lindol_table')    ->where('student_id', $id)->latest()->first();
        $safehome    = DB::table('module3_safehome_table')  ->where('student_id', $id)->latest()->first();
        $posttest    = DB::table('module3_posttest_table')  ->where('student_id', $id)->latest()->first();
        $performance = DB::table('module3_performance_tasks')->where('student_id', $id)->latest()->first();

        $perfTotal = $performance
            ? (($performance->kit_score ?? 0) + ($performance->evacuation_score ?? 0)
               + ($performance->communication_score ?? 0) + ($performance->safe_score ?? 0))
            : 0;

        $filename = 'module3_' . preg_replace('/\s+/', '_', $student->username) . '_' . now()->format('Ymd') . '.csv';

        return response()->stream(function () use (
            $student, $pretest, $pretestAns, $node1, $node2, $node3,
            $balikaral, $bulkan, $elnino, $explore, $flood, $gabay,
            $gobagact, $lindol, $safehome, $posttest, $performance, $perfTotal
        ) {
            $f    = fopen('php://output', 'w');
            $bool = fn($v) => $v ? 'Yes' : 'No';
            $sec  = function (string $title) use ($f) {
                fputcsv($f, []);
                fputcsv($f, ["=== {$title} ==="]);
            };
            $row = fn($label, $value) => fputcsv($f, [$label, $value ?? 'N/A']);

            fputs($f, "\xEF\xBB\xBF"); // UTF-8 BOM

            $sec('STUDENT INFORMATION');
            $row('Name', $student->username);
            $row('ID', $student->id);
            $row('Module', 'Module 3');
            $row('Exported At', now()->format('Y-m-d H:i:s'));

            $sec('PRETEST');
            $row('Score', optional($pretest)->score ?? 0);
            $row('Percentage', (optional($pretest)->percentage ?? 0) . '%');
            fputcsv($f, ['Q#', 'Selected', 'Correct', 'Result']);
            foreach ($pretestAns as $a) {
                fputcsv($f, [$a->question_number, $a->selected_answer, $a->correct_answer, $a->is_correct ? 'Correct' : 'Wrong']);
            }

            $sec('NODE 1');
            $row('Score',            optional($node1)->score           ?? 0);
            $row('Correct',          optional($node1)->correct_answers  ?? 0);
            $row('Wrong',            optional($node1)->wrong_answers    ?? 0);
            $row('Accuracy',         (optional($node1)->accuracy ?? 0) . '%');
            $row('Time (s)',          optional($node1)->time_spent       ?? 0);
            $row('Attempts',         optional($node1)->attempts         ?? 0);
            $row('Perfect',          $bool(optional($node1)->is_perfect));
            $row('Completed',        $bool(optional($node1)->is_completed));

            $sec('NODE 2');
            $row('Score',           optional($node2)->score           ?? 0);
            $row('Chosen Side',     optional($node2)->chosen_side      ?? 'N/A');
            $row('Lives Remaining', optional($node2)->lives_remaining  ?? 0);
            $row('Attempts',        optional($node2)->attempts         ?? 0);
            $row('Passed',          $bool(optional($node2)->is_passed));

            $sec('NODE 3');
            $row('Choices Selected', optional($node3)->choices_selected ?? 0);
            $row('Remaining Budget', '₱' . number_format(optional($node3)->remaining_budget ?? 0));
            $row('Readiness Score',  optional($node3)->readiness_score  ?? 0);
            $row('Attempts',         optional($node3)->attempts         ?? 0);
            $row('Passed',           $bool(optional($node3)->is_passed));
            $row('Completed',        $bool(optional($node3)->is_completed));

            foreach ([
                ['BALIK-ARAL', $balikaral, ['Health'=>'health','Budget'=>'budget','Trust'=>'trust','Time (s)'=>'time_spent'], 'is_success', 'completed'],
                ['BULKAN',     $bulkan,    ['Progress'=>'progress','Mistakes'=>'mistakes'], 'is_success', 'completed'],
                ['EL NIÑO',    $elnino,    ['Completed Points'=>'completed_points'], 'is_success', 'completed'],
                ['EXPLORE',    $explore,   ['XP'=>'xp','Badge'=>'badge'], 'is_completed', null],
                ['FLOOD',      $flood,     ['Score'=>'score','HP Remaining'=>'hp_remaining','Total Questions'=>'total_questions'], 'is_completed', null],
                ['GABAY',      $gabay,     ['Score'=>'score','Total Items'=>'total_items','Accuracy'=>'accuracy','Attempts'=>'attempts'], 'is_completed', null],
                ['GO BAG',     $gobagact,  ['Score'=>'score','Total Items'=>'total_items','Time (s)'=>'time_taken','Rating'=>'rating','Attempts'=>'attempts'], 'is_completed', null],
                ['LINDOL',     $lindol,    ['Score'=>'score','Total Items'=>'total_items','Correct Items'=>'correct_items','Time (s)'=>'time_spent'], null, 'completed'],
                ['SAFE HOME',  $safehome,  ['Correct'=>'correct_count','Wrong'=>'wrong_count','Clicks'=>'total_clicks','Attempts'=>'attempts'], 'is_completed', null],
            ] as [$title, $rec, $fields, $passKey, $doneKey]) {
                $sec($title);
                foreach ($fields as $label => $col) {
                    $row($label, optional($rec)->{$col} ?? 0);
                }
                if ($passKey) $row('Status', optional($rec)->{$passKey} ? 'Passed/Completed' : 'Failed/Incomplete');
                if ($doneKey) $row('Completed', $bool(optional($rec)->{$doneKey}));
            }

            $sec('POSTTEST');
            $row('Score',      optional($posttest)->score             ?? 0);
            $row('Total Items',optional($posttest)->total_items        ?? 0);
            $row('Level',      optional($posttest)->performance_level  ?? 'N/A');
            $row('Passed',     $bool(optional($posttest)->is_passed));

            $sec('PERFORMANCE TASK');
            $row('Kit Score',           optional($performance)->kit_score           ?? 0);
            $row('Evacuation Score',    optional($performance)->evacuation_score    ?? 0);
            $row('Communication Score', optional($performance)->communication_score ?? 0);
            $row('Safe Score',          optional($performance)->safe_score          ?? 0);
            $row('Total',               $perfTotal);
            $row('Completed',           $bool(optional($performance)->is_completed));

            fclose($f);
        }, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'must-revalidate',
        ]);
    }
}