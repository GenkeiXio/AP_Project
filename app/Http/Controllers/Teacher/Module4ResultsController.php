<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            ->where('student_id', $id)
            ->latest()
            ->first();

        $pretestAnswers = DB::table('module4_pretest_answers_table')
            ->where('module4_pretest_id', $pretest->id ?? 0)
            ->get();

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

        return view('Teachers.results.module4_student', compact(
            'student',
            'pretest',
            'pretestAnswers',
            'balikaral',
            'explore',
            'games',
            'poll'
        ));
    }

    public function export($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        // PRETEST
        $pretest = DB::table('module4_pretest_table')
            ->where('student_id', $id)->latest()->first();

        $pretestAnswers = DB::table('module4_pretest_answers_table')
            ->where('module4_pretest_id', $pretest->id ?? 0)
            ->get();

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

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=module4_{$student->username}.csv",
        ];

        $callback = function () use (
            $student, $pretest, $pretestAnswers,
            $balikaral, $explore, $games, $poll
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

            // BALIKARAL
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

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
