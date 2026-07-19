<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Posttest;

class Module3PosttestController extends Controller
{
    const MAX_ATTEMPTS = 2;
    const PASSING_SCORE = 13;
    const TOTAL_ITEMS = 15;

    public function index()
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $viewData = $this->buildViewData($studentId);

        return response()
            ->view('Students.module3.module3_posttest', $viewData)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $score = $request->input('score', 0);

        $existing = Module3Posttest::where('student_id', $studentId)->first();
        $currentAttempts = $existing->attempts ?? 0;

        if ($currentAttempts >= self::MAX_ATTEMPTS) {
            return response()->json([
                'error' => 'Maximum attempts reached',
                'max_attempts_reached' => true
            ], 403);
        }

        $newAttempts = $currentAttempts + 1;
        $existingScore = $existing->score ?? 0;
        $highestScore = max($score, $existingScore);

        [$performance, $passed] = $this->getPerformanceLevel($highestScore);

        Module3Posttest::updateOrCreate(
            ['student_id' => $studentId],
            [
                'score' => $highestScore,
                'total_items' => self::TOTAL_ITEMS,
                'performance_level' => $performance,
                'is_passed' => $passed,
                'answers' => $request->input('answers'),
                'attempts' => $newAttempts,
                'last_score' => $score,
            ]
        );

        $hasAttemptsRemaining = $newAttempts < self::MAX_ATTEMPTS;

        return response()->json([
            'success' => true,
            'performance' => $performance,
            'score' => $score,
            'highest_score' => $highestScore,
            'attempts_used' => $newAttempts,
            'attempts_remaining' => self::MAX_ATTEMPTS - $newAttempts,
            'has_attempts_remaining' => $hasAttemptsRemaining,
            'is_passed' => $passed,
            'max_attempts_reached' => !$hasAttemptsRemaining,
        ]);
    }

    /**
     * Builds all data the Blade view needs, with safe defaults,
     * regardless of whether a posttest record exists yet.
     *
     * This is the ONLY place that decides "locked" state — the
     * view uses $isLocked directly, so there is one source of truth
     * for both the quiz page and the store() endpoint to agree on.
     */
    private function buildViewData(?string $studentId): array
    {
        $attempts = 0;
        $highestScore = 0;
        $hasAttemptsRemaining = true;
        $isPassed = false;
        $performanceLevel = 'Needs Improvement';

        if ($studentId) {
            $posttest = Module3Posttest::where('student_id', $studentId)->first();

            if ($posttest) {
                $attempts = $posttest->attempts ?? 0;
                $highestScore = $posttest->score ?? 0;
                $hasAttemptsRemaining = $attempts < self::MAX_ATTEMPTS;
                $isPassed = $posttest->is_passed ?? false;
                $performanceLevel = $posttest->performance_level ?? 'Needs Improvement';
            }
        }

        $isLocked = !$hasAttemptsRemaining;

        return [
            'attempts' => $attempts,
            'highestScore' => $highestScore,
            'hasAttemptsRemaining' => $hasAttemptsRemaining,
            'isLocked' => $isLocked,
            'totalItems' => self::TOTAL_ITEMS,
            'isPassed' => $isPassed,
            'performanceLevel' => $performanceLevel,
        ];
    }

    private function getPerformanceLevel(int $highestScore): array
    {
        if ($highestScore >= self::PASSING_SCORE) {
            return ['Disaster Commander', true];
        }

        if ($highestScore >= 9) {
            return ['Resilient Learner', true];
        }

        return ['Needs Improvement', false];
    }

    public function check()
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $viewData = $this->buildViewData($studentId);

        return response()->json([
            'attempts' => $viewData['attempts'],
            'highest_score' => $viewData['highestScore'],
            'has_attempts_remaining' => $viewData['hasAttemptsRemaining'],
            'is_locked' => $viewData['isLocked'],
            'is_passed' => $viewData['isPassed'],
            'performance_level' => $viewData['performanceLevel'],
            'total_items' => $viewData['totalItems'],
        ]);
    }
}