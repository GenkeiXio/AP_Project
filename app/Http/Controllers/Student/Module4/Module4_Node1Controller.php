<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module_4\Module4Node1; // ✅ IMPORTANT (you must create this model)
use Illuminate\Support\Facades\Session;

class Module4_Node1Controller extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        // ❌ Not logged in
        if (!$studentId) {
            return response()->json([
                'error' => 'Unauthorized',
                'session' => Session::all()
            ], 401);
        }

        // ❌ No data
        if (!$request->has('records')) {
            return response()->json([
                'error' => 'No records received',
                'data' => $request->all()
            ], 400);
        }

        // ✅ Save each record
        foreach ($request->records as $record) {
            Module4Node1::create([
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