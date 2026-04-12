<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Module3ResultsController extends Controller
{
    public function index()
    {
        $students = DB::table('students')->get();

        return view('Teachers.results.module3_results', compact('students'));
    }

    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        // PRETEST
        $pretest = DB::table('module3_pretests')
            ->where('student_id', $id)
            ->latest()
            ->first();

        $pretestAnswers = DB::table('module3_pretest_answers')
            ->where('module3_pretest_id', $pretest->id ?? 0)
            ->get();

        // NODES
        $node1 = DB::table('module3_node1_table')->where('student_id', $id)->latest()->first();
        $node2 = DB::table('module3_node2_table')->where('student_id', $id)->latest()->first();
        $node3 = DB::table('module3_node3_table')->where('student_id', $id)->latest()->first();

        // ACTIVITIES
        $balikaral = DB::table('module3_balikaral_table')->where('student_id', $id)->latest()->first();
        $bulkan = DB::table('module3_bulkan_table')->where('student_id', $id)->latest()->first();
        $elnino = DB::table('module3_elnino_table')->where('student_id', $id)->latest()->first();
        $explore = DB::table('module3_explore_table')->where('student_id', $id)->latest()->first();
        $flood = DB::table('module3_flood_table')->where('student_id', $id)->latest()->first();
        $gabay = DB::table('module3_gabay_table')->where('student_id', $id)->latest()->first();
        $gobagact = DB::table('module3_gobagact_table')->where('student_id', $id)->latest()->first();
        $lindol = DB::table('module3_lindol_table')->where('student_id', $id)->latest()->first();
        $safehome = DB::table('module3_safehome_table')->where('student_id', $id)->latest()->first();

        // FINAL PERFORMANCE
        $performance = DB::table('module3_performance_tasks')
            ->where('student_id', $id)
            ->latest()
            ->first();

        return view('Teachers.results.module3_student', compact(
            'student',
            'pretest',
            'pretestAnswers',
            'node1','node2','node3',
            'balikaral','bulkan','elnino','explore','flood',
            'gabay','gobagact','lindol','safehome',
            'performance'
        ));
    }

    public function export($id)
{
    $student = DB::table('students')->where('id', $id)->first();

    $pretest = DB::table('module3_pretests')->where('student_id', $id)->latest()->first();
    $pretestAnswers = DB::table('module3_pretest_answers')
        ->where('module3_pretest_id', $pretest->id ?? 0)
        ->get();

    $node1 = DB::table('module3_node1_table')->where('student_id', $id)->latest()->first();
    $node2 = DB::table('module3_node2_table')->where('student_id', $id)->latest()->first();
    $node3 = DB::table('module3_node3_table')->where('student_id', $id)->latest()->first();

    $balikaral = DB::table('module3_balikaral_table')->where('student_id', $id)->latest()->first();
    $bulkan = DB::table('module3_bulkan_table')->where('student_id', $id)->latest()->first();
    $elnino = DB::table('module3_elnino_table')->where('student_id', $id)->latest()->first();
    $explore = DB::table('module3_explore_table')->where('student_id', $id)->latest()->first();
    $flood = DB::table('module3_flood_table')->where('student_id', $id)->latest()->first();
    $gabay = DB::table('module3_gabay_table')->where('student_id', $id)->latest()->first();
    $gobagact = DB::table('module3_gobagact_table')->where('student_id', $id)->latest()->first();
    $lindol = DB::table('module3_lindol_table')->where('student_id', $id)->latest()->first();
    $safehome = DB::table('module3_safehome_table')->where('student_id', $id)->latest()->first();

    $performance = DB::table('module3_performance_tasks')->where('student_id', $id)->latest()->first();

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=module3_{$student->username}.csv",
    ];

    $callback = function () use (
        $student, $pretest, $pretestAnswers,
        $node1, $node2, $node3,
        $balikaral, $bulkan, $elnino, $explore, $flood,
        $gabay, $gobagact, $lindol, $safehome,
        $performance
    ) {
        $file = fopen('php://output', 'w');

        // STUDENT
        fputcsv($file, ['Student Name', $student->username]);
        fputcsv($file, ['Student ID', $student->id]);
        fputcsv($file, []);

        // PRETEST
        fputcsv($file, ['PRETEST']);
        fputcsv($file, ['Score', optional($pretest)->score ?? 0]);
        fputcsv($file, ['Percentage', optional($pretest)->percentage ?? 0]);

        fputcsv($file, []);
        fputcsv($file, ['Pretest Answers']);
        fputcsv($file, ['Q#','Selected','Correct','Result']);

        foreach ($pretestAnswers as $ans) {
            fputcsv($file, [
                $ans->question_number,
                $ans->selected_answer,
                $ans->correct_answer,
                $ans->is_correct ? 'Correct' : 'Wrong'
            ]);
        }

        // NODE 1
        fputcsv($file, []);
        fputcsv($file, ['NODE 1']);
        fputcsv($file, ['Score', optional($node1)->score ?? 0]);
        fputcsv($file, ['Accuracy', optional($node1)->accuracy ?? 0]);

        // NODE 2
        fputcsv($file, ['NODE 2']);
        fputcsv($file, ['Score', optional($node2)->score ?? 0]);
        fputcsv($file, ['Lives', optional($node2)->lives_remaining ?? 0]);

        // NODE 3
        fputcsv($file, ['NODE 3']);
        fputcsv($file, ['Budget', optional($node3)->final_budget ?? 0]);
        fputcsv($file, ['Status', optional($node3)->status ?? 'N/A']);

        // ACTIVITIES
        fputcsv($file, []);
        fputcsv($file, ['ACTIVITIES']);

        fputcsv($file, ['Balikaral', optional($balikaral)->score ?? 0]);
        fputcsv($file, ['Bulkan', optional($bulkan)->total_correct ?? 0]);
        fputcsv($file, ['El Niño', optional($elnino)->score ?? 0]);
        fputcsv($file, ['Explore XP', optional($explore)->xp ?? 0]);
        fputcsv($file, ['Flood', optional($flood)->score ?? 0]);
        fputcsv($file, ['Gabay', optional($gabay)->score ?? 0]);
        fputcsv($file, ['Go Bag', optional($gobagact)->score ?? 0]);
        fputcsv($file, ['Lindol', optional($lindol)->score ?? 0]);
        fputcsv($file, ['Safe Home', optional($safehome)->correct_count ?? 0]);

        // FINAL
        fputcsv($file, []);
        fputcsv($file, ['FINAL']);
        fputcsv($file, ['Score', optional($performance)->score ?? 0]);

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}
