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
                'health' => $request->health ?? 0,
                'budget' => $request->budget ?? 0,
                'trust' => $request->trust ?? 0,

                'is_success' => $request->is_success ?? false,

                'final_state' => [
                    'health' => $request->health,
                    'budget' => $request->budget,
                    'trust' => $request->trust
                ],

                'time_spent' => $request->time_spent ?? 0,
                'completed' => true
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
