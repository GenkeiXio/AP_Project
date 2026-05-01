<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Elnino;

class Module3ElninoController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.el_niño');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = Module3Elnino::updateOrCreate(
            ['student_id' => $studentId],
            [
                'completed_points' => $request->completed_points ?? 0,
                'is_success' => $request->is_success ?? false,
                'selections' => $request->selections ?? [],
                'completed' => true
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
