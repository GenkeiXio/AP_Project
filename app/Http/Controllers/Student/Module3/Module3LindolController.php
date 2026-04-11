<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Lindol;


class Module3LindolController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.lindol');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        Module3Lindol::updateOrCreate(
            ['student_id' => $studentId],
            [
                'score' => $request->score,
                'total_items' => $request->total_items,
                'correct_items' => $request->correct_items,
                'completed' => true,
                'time_spent' => $request->time_spent
            ]
        );

        return response()->json(['success' => true]);
    }
}
