<?php

namespace App\Http\Controllers\Student\Module2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module_2\Module2Node1;
use Illuminate\Support\Facades\Session;

class Module2_Node1Controller extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json([
                'error' => 'Unauthorized',
                'session' => Session::all() // 🔥 DEBUG
            ], 401);
        }

        if (!$request->has('records')) {
            return response()->json([
                'error' => 'No records received',
                'data' => $request->all()
            ], 400);
        }

        foreach ($request->records as $record) {
            Module2Node1::create([
                'student_id' => $studentId,
                'problem_number' => $record['problem_number'],

                'sanhi_image' => $record['sanhi_image'] ?? null,
                'sanhi_text' => $record['sanhi_text'] ?? null,

                'bunga_image' => $record['bunga_image'] ?? null,
                'bunga_text' => $record['bunga_text'] ?? null,

                'solusyon_image' => $record['solusyon_image'] ?? null,
                'solusyon_text' => $record['solusyon_text'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'received' => $request->records
        ]);
    }
}
