<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Bulkan;

class Module3BulkanController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.bulkan');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = Module3Bulkan::updateOrCreate(
            ['student_id' => $studentId],
            [
                'progress' => $request->progress ?? 0,
                'is_success' => $request->is_success ?? false,
                'mistakes' => $request->mistakes ?? 0,

                'final_state' => [
                    'progress' => $request->progress,
                    'mistakes' => $request->mistakes
                ],

                'completed' => true
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
