<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3BalikAral;

class Module3BalikAralController extends Controller
{
    public function index()
    {
        return view('Students.module3.Activities.balik-aral');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $data = Module3BalikAral::updateOrCreate(
            ['student_id' => $studentId],
            [
                'score' => $request->score ?? 0,
                'correct_answers' => $request->correct_answers ?? 0,
                'total_items' => $request->total_items ?? 3,
                'completed' => true,
                'time_spent' => $request->time_spent ?? 0
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
