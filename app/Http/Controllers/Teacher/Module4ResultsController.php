<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Module4ResultsController extends Controller
{
    public function index()
    {
        $students = DB::table('students')->get();
        return view('Teachers.results.module4_results', compact('students'));
    }

    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        // PRETEST
        $pretest = DB::table('module4_pretest_table')
            ->where('student_id', $id)->latest()->first();

        $pretestAnswers = DB::table('module4_pretest_answers_table')
            ->where('module4_pretest_id', $pretest->id ?? 0)->get();

        // BALIK ARAL
        $balikaral = DB::table('module4_balikaral_table')
            ->where('student_id', $id)->latest()->first();

        // EXPLORE
        $explore = DB::table('module4_explore_table')
            ->where('student_id', $id)->latest()->first();

        // GAMES
        $games = DB::table('module4_game_results_table')
            ->where('student_id', $id)->get();

        // POLL
        $poll = DB::table('module4_poll_table')
            ->where('student_id', $id)->latest()->first();

        // ✅ PERFORMANCE
        $performance = DB::table('module4_performance_table')
            ->where('student_id', $id)->latest()->first();

        // ✅ POSTTEST
        $posttest = DB::table('module4_posttest_table')
            ->where('student_id', $id)->latest()->first();

        return view('Teachers.results.module4_student', compact(
            'student',
            'pretest',
            'pretestAnswers',
            'balikaral',
            'explore',
            'games',
            'poll',
            'performance',
            'posttest'
        ));
    }

    public function export($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        // PRETEST
        $pretest = DB::table('module4_pretest_table')
            ->where('student_id', $id)->latest()->first();

        $pretestAnswers = DB::table('module4_pretest_answers_table')
            ->where('module4_pretest_id', $pretest->id ?? 0)->get();

        // BALIK ARAL
        $balikaral = DB::table('module4_balikaral_table')
            ->where('student_id', $id)->latest()->first();

        // EXPLORE
        $explore = DB::table('module4_explore_table')
            ->where('student_id', $id)->latest()->first();

        // GAMES
        $games = DB::table('module4_game_results_table')
            ->where('student_id', $id)->get();

        // POLL
        $poll = DB::table('module4_poll_table')
            ->where('student_id', $id)->latest()->first();

        // ✅ ADD THESE (FIX)
        $performance = DB::table('module4_performance_table')
            ->where('student_id', $id)->latest()->first();

        $posttest = DB::table('module4_posttest_table')
            ->where('student_id', $id)->latest()->first();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=module4_{$student->username}.csv",
        ];

        $callback = function () use (
            $student, $pretest, $pretestAnswers,
            $balikaral, $explore, $games, $poll,
            $performance, $posttest
        ) {
            $file = fopen('php://output', 'w');

            // STUDENT
            fputcsv($file, ['Student Name', $student->username]);
            fputcsv($file, ['Student ID', $student->id]);
            fputcsv($file, []);

            // PRETEST
            fputcsv($file, ['PRETEST']);
            fputcsv($file, ['Score', $pretest->score ?? 0]);
            fputcsv($file, ['Total', $pretest->total_items ?? 0]);
            fputcsv($file, ['Level', $pretest->level ?? 'N/A']);

            fputcsv($file, []);
            fputcsv($file, ['Answers']);
            fputcsv($file, ['Q#','Selected','Correct','Result']);

            foreach ($pretestAnswers as $a) {
                fputcsv($file, [
                    $a->question_number,
                    $a->selected_option,
                    $a->correct_option,
                    $a->is_correct ? 'Correct' : 'Wrong'
                ]);
            }

            // BALIK ARAL
            fputcsv($file, []);
            fputcsv($file, ['BALIK ARAL']);
            fputcsv($file, ['Score', $balikaral->score ?? 0]);
            fputcsv($file, ['Correct', $balikaral->correct_answers ?? 0]);
            fputcsv($file, ['Total', $balikaral->total_items ?? 0]);

            // EXPLORE
            fputcsv($file, []);
            fputcsv($file, ['EXPLORE']);
            fputcsv($file, ['Progress', ($explore->progress_percent ?? 0) . '%']);
            fputcsv($file, ['Status', ($explore && $explore->is_completed) ? 'Completed' : 'Not Completed']);

            // GAMES
            fputcsv($file, []);
            fputcsv($file, ['GAMES']);
            fputcsv($file, ['Game','Score','Total','Rank']);

            foreach ($games as $g) {
                fputcsv($file, [
                    $g->game_type,
                    $g->score,
                    $g->total_items,
                    $g->rank
                ]);
            }

            // POLL
            fputcsv($file, []);
            fputcsv($file, ['POLL']);
            fputcsv($file, ['Selected Count', $poll->selected_count ?? 0]);
            fputcsv($file, ['Options', $poll ? json_encode($poll->selected_options) : 'N/A']);

            // ✅ PERFORMANCE
            fputcsv($file, []);
            fputcsv($file, ['PERFORMANCE TASK']);

            if ($performance) {
                fputcsv($file, ['Status', $performance->is_submitted ? 'Submitted' : 'Not Submitted']);
                fputcsv($file, ['Format', $performance->format ?? 'N/A']);
                fputcsv($file, ['Reflection', $performance->reflection ?? 'N/A']);
                fputcsv($file, ['File', $performance->file_path ?? 'N/A']);
                fputcsv($file, ['Submitted At', $performance->created_at]);
            } else {
                fputcsv($file, ['No performance task submitted']);
            }

            // ✅ POST TEST
            fputcsv($file, []);
            fputcsv($file, ['POST TEST']);

            if ($posttest) {
                fputcsv($file, ['Score', $posttest->score . ' / ' . $posttest->total_items]);
                fputcsv($file, ['Status', strtoupper($posttest->status)]);
                fputcsv($file, ['Attempt', $posttest->attempt]);
                fputcsv($file, ['Date Taken', $posttest->created_at]);

                fputcsv($file, []);
                fputcsv($file, ['Answers']);
                fputcsv($file, ['#', 'Selected']);

                foreach (json_decode($posttest->answers ?? '[]') as $i => $ans) {
                    fputcsv($file, [$i + 1, $ans]);
                }
            } else {
                fputcsv($file, ['No post-test record']);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}