<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Module4HomeController extends Controller
{
    public function storePoll(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $validated = $request->validate([
            'selected_options' => ['array'],
            'selected_options.*' => ['string'],
            'selected_count' => ['nullable', 'integer', 'min:0'],
        ]);

        $selectedOptions = $validated['selected_options'] ?? [];

        $data = Module4Poll::updateOrCreate(
            ['student_id' => $studentId],
            [
                'selected_options' => $selectedOptions,
                'selected_count' => $validated['selected_count'] ?? count($selectedOptions),
            ]
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
