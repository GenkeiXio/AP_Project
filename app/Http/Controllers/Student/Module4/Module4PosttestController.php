<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_4\Module4Posttest;

class Module4PosttestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'score'        => 'required|integer',
            'total_items'  => 'required|integer',
            'answers'      => 'nullable|array',
        ]);

        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $status = $request->score >= 12 ? 'passed' : 'failed';

        // Check existing attempt
        $existing = Module4Posttest::where('student_id', $studentId)->latest()->first();

        $attempt = $existing ? $existing->attempt + 1 : 1;

        Module4Posttest::create([
            'student_id'  => $studentId,
            'score'       => $request->score,
            'total_items' => $request->total_items,
            'status'      => $status,
            'answers'     => $request->answers,
            'attempt'     => $attempt,
        ]);

        return response()->json([
            'success' => true,
            'status'  => $status,
        ]);
    }
}
