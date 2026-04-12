<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4BalikAral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Module4BalikAralController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'correct_answers' => ['required', 'integer', 'min:0'],
            'total_items' => ['required', 'integer', 'min:1'],
            'time_spent' => ['nullable', 'integer', 'min:0'],
            'completed' => ['required', 'boolean'],
        ]);

        $data = Module4BalikAral::updateOrCreate(
            ['student_id' => $studentId],
            $validated
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
