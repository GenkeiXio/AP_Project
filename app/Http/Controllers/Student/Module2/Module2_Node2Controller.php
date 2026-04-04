<?php

namespace App\Http\Controllers\Student\Module2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module_2\Module2Node2;
use Illuminate\Support\Facades\Session;

class Module2_Node2Controller extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'records' => 'required|array',
        ]);

        foreach ($request->records as $record) {
            Module2Node2::create([
                'student_id' => $studentId,
                'problem_number' => $record['problem_number'],
                'sanhi' => $record['sanhi'] ?? null,
                'bunga' => $record['bunga'] ?? null,
                'solusyon' => $record['solusyon'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Node2 data saved successfully!'
        ]);
    }
}
