<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use App\Models\Module_4\Module4GameResult;
use App\Models\Module_4\Module4Explore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class Module4GameResultController extends Controller
{
    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $validated = $request->validate([
            'game_type' => ['required', Rule::in(['rolly', 'baha', 'lindol', 'mayon', 'landslide'])],
            'score' => ['required', 'integer', 'min:0'],
            'total_items' => ['required', 'integer', 'min:1'],
            'rank' => ['nullable', 'string', 'max:120'],
            'is_completed' => ['required', 'boolean'],
        ]);

        $data = Module4GameResult::updateOrCreate(
            [
                'student_id' => $studentId,
                'game_type' => $validated['game_type'],
            ],
            [
                'score' => $validated['score'],
                'total_items' => $validated['total_items'],
                'rank' => $validated['rank'] ?? null,
                'is_completed' => $validated['is_completed'],
            ]
        );

        if ($validated['is_completed']) {
            $completedGames = Module4GameResult::where('student_id', $studentId)
                ->where('is_completed', true)
                ->pluck('game_type')
                ->unique()
                ->toArray();

            Module4Explore::updateOrCreate(
                ['student_id' => $studentId],
                [
                    'completed_stories' => array_values($completedGames),
                    'progress_percent' => min(count($completedGames) * 20, 100),
                    'is_completed' => count($completedGames) >= 5,
                ]
            );
        }

        return response()->json(['success' => true, 'data' => $data]);
    }
}
