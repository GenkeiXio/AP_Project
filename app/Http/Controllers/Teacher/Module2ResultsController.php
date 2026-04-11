<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Module2ResultsController extends Controller
{

    public function index()
    {
        $students = DB::table('students')

            // PRETEST
            ->leftJoin('module2_pretest_table as pre', 'students.id', '=', 'pre.student_id')

            // POSTTEST
            ->leftJoin('module2_posttest_table as post', 'students.id', '=', 'post.student_id')

            // FINAL ACTIVITY
            ->leftJoin('module2_final_activity_table as final', 'students.id', '=', 'final.student_id')

            // ESSAY
            ->leftJoin('module2_essay_table as essay', 'students.id', '=', 'essay.student_id')

            ->select(
                'students.id',
                'students.username',

                // PRETEST
                'pre.score as pre_score',
                'pre.percentage as pre_percentage',

                // POSTTEST
                'post.score as post_score',
                'post.percentage as post_percentage',

                // FINAL
                'final.score as final_score',
                'final.total_xp',
                'final.time_taken',

                // ESSAY
                'essay.essay_answer'
            )
            ->get();

        return view('Teachers.results.module2_results', compact('students'));
    }

    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        // PRETEST
        $pretest = DB::table('module2_pretest_table')
            ->where('student_id', $id)->first();

        $pretestAnswers = DB::table('module2_pretest_answers_table')
            ->where('module2_pretest_id', $pretest->id ?? 0)
            ->get();

        // POSTTEST
        $posttest = DB::table('module2_posttest_table')
            ->where('student_id', $id)->first();

        $posttestAnswers = DB::table('module2_posttest_answers_table')
            ->where('module2_posttest_id', $posttest->id ?? 0)
            ->get();

        // FINAL
        $final = DB::table('module2_final_activity_table')
            ->where('student_id', $id)->first();

        $finalAnswers = DB::table('module2_final_activity_answers_table')
            ->where('module2_final_activity_id', $final->id ?? 0)
            ->get();

        // NODES
        $node1 = DB::table('module2_node1_table')->where('student_id', $id)->get();
        $node2 = DB::table('module2_node2_table')->where('student_id', $id)->get();
        $node3 = DB::table('module2_node3_table')->where('student_id', $id)->get();

        // ESSAY
        $essay = DB::table('module2_essay_table')
            ->where('student_id', $id)->first();

        return view('Teachers.results.student_module2', compact(
            'student',
            'pretest','pretestAnswers',
            'posttest','posttestAnswers',
            'final','finalAnswers',
            'node1','node2','node3',
            'essay'
        ));
    }

    public function exportFull($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        $filename = 'module2_full_'.$student->username.'.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function() use ($id) {

            $file = fopen('php://output', 'w');

            // ========================
            // PRETEST
            // ========================
            fputcsv($file, ['PRETEST']);

            $pretest = DB::table('module2_pretest_table')
                ->where('student_id', $id)->first();

            if ($pretest) {
                fputcsv($file, ['Score', 'Percentage']);
                fputcsv($file, [$pretest->score, $pretest->percentage]);

                fputcsv($file, []);
                fputcsv($file, ['Q#','Selected','Correct','Result']);

                $answers = DB::table('module2_pretest_answers_table')
                    ->where('module2_pretest_id', $pretest->id)
                    ->get();

                foreach ($answers as $a) {
                    fputcsv($file, [
                        $a->question_number,
                        $a->selected_answer,
                        $a->correct_answer,
                        $a->is_correct ? 'Correct' : 'Wrong'
                    ]);
                }
            }

            fputcsv($file, []);
            fputcsv($file, []);

            // ========================
            // POSTTEST
            // ========================
            fputcsv($file, ['POSTTEST']);

            $posttest = DB::table('module2_posttest_table')
                ->where('student_id', $id)->first();

            if ($posttest) {
                fputcsv($file, ['Score', 'Percentage']);
                fputcsv($file, [$posttest->score, $posttest->percentage]);

                fputcsv($file, []);
                fputcsv($file, ['Q#','Selected','Correct','Result']);

                $answers = DB::table('module2_posttest_answers_table')
                    ->where('module2_posttest_id', $posttest->id)
                    ->get();

                foreach ($answers as $a) {
                    fputcsv($file, [
                        $a->question_number,
                        $a->selected_answer,
                        $a->correct_answer,
                        $a->is_correct ? 'Correct' : 'Wrong'
                    ]);
                }
            }

            fputcsv($file, []);
            fputcsv($file, []);

            // ========================
            // FINAL ACTIVITY
            // ========================
            fputcsv($file, ['FINAL ACTIVITY']);

            $final = DB::table('module2_final_activity_table')
                ->where('student_id', $id)->first();

            if ($final) {
                fputcsv($file, ['Score','XP','Correct Answers','Time']);
                fputcsv($file, [
                    $final->score,
                    $final->total_xp,
                    $final->correct_answers,
                    $final->time_taken
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, []);

            // ========================
            // NODE 1
            // ========================
            fputcsv($file, ['NODE 1']);

            $node1 = DB::table('module2_node1_table')
                ->where('student_id', $id)->get();

            foreach ($node1 as $n) {
                fputcsv($file, ['Problem', $n->problem_number]);
                fputcsv($file, ['Sanhi', $n->sanhi_text]);
                fputcsv($file, ['Bunga', $n->bunga_text]);
                fputcsv($file, ['Solusyon', $n->solusyon_text]);
                fputcsv($file, []);
            }

            // ========================
            // NODE 2
            // ========================
            fputcsv($file, ['NODE 2']);

            $node2 = DB::table('module2_node2_table')
                ->where('student_id', $id)->get();

            foreach ($node2 as $n) {
                fputcsv($file, [$n->sanhi, $n->bunga, $n->solusyon]);
            }

            fputcsv($file, []);
            fputcsv($file, []);

            // ========================
            // NODE 3
            // ========================
            fputcsv($file, ['NODE 3']);

            $node3 = DB::table('module2_node3_table')
                ->where('student_id', $id)->get();

            foreach ($node3 as $n) {
                fputcsv($file, [$n->sanhi, $n->bunga, $n->solusyon]);
            }

            fputcsv($file, []);
            fputcsv($file, []);

            // ========================
            // ESSAY
            // ========================
            fputcsv($file, ['ESSAY']);

            $essay = DB::table('module2_essay_table')
                ->where('student_id', $id)->first();

            if ($essay) {
                fputcsv($file, [$essay->essay_answer]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
