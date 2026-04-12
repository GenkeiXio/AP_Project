<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4Explore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Module4ExploreController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $validated = $request->validate([
            'completed_stories' => ['nullable', 'array'],
            'completed_stories.*' => ['string', 'max:50'],
            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'is_completed' => ['required', 'boolean'],
        ]);

        $data = Module4Explore::updateOrCreate(
            ['student_id' => $studentId],
            [
                'completed_stories' => $validated['completed_stories'] ?? [],
                'progress_percent' => $validated['progress_percent'],
                'is_completed' => $validated['is_completed'],
            ]
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
