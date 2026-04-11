<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{
    public function index()
    {
        $totalModules = 3;

        $totalStudents = DB::table('students')->count();

        // Example: average completion (you can refine this later)
        $avgCompletion = DB::table('module2_posttest_table')
            ->avg('percentage');

        return view('Teachers.results.results', compact(
            'totalModules',
            'totalStudents',
            'avgCompletion'
        ));
    }
}
