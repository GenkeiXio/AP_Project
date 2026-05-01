<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Node1;

class Module3Node1Controller extends Controller
{
    private function studentId()
    {
        return Session::get('student_id');
    }

    public function index()
    {
        if (!$this->studentId()) {
            return redirect()->route('home');
        }

        return view('Students.Module3.Nodes.mod3_node1');
    }

    public function save(Request $request)
    {
        $request->validate([
            'score'           => 'required|integer',
            'total_items'     => 'required|integer',
            'correct_answers' => 'required|integer',
            'wrong_answers'   => 'required|integer',
            'time_spent'      => 'required|integer',
        ]);

        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['success' => false], 401);
        }

        // Compute metrics
        $accuracy = $request->total_items > 0
            ? ($request->correct_answers / $request->total_items) * 100
            : 0;

        $isPerfect = $request->correct_answers == $request->total_items;

        $record = Module3Node1::where('student_id', $studentId)->first();

        if ($record) {

            $attempts = $record->attempts + 1;

            $record->update([
                'score'               => max($record->score, $request->score), // keep best
                'total_items'         => $request->total_items,
                'correct_answers'     => $request->correct_answers,
                'wrong_answers'       => $request->wrong_answers,
                'accuracy'            => $accuracy,
                'time_spent'          => $request->time_spent,
                'is_completed'        => true,
                'is_perfect'          => $isPerfect,
                'attempts'            => $attempts,
                'max_attempt_reached' => $attempts >= 3,
            ]);

        } else {

            $record = Module3Node1::create([
                'student_id'          => $studentId,
                'score'               => $request->score,
                'total_items'         => $request->total_items,
                'correct_answers'     => $request->correct_answers,
                'wrong_answers'       => $request->wrong_answers,
                'accuracy'            => $accuracy,
                'time_spent'          => $request->time_spent,
                'is_completed'        => true,
                'is_perfect'          => $isPerfect,
                'attempts'            => 1,
                'max_attempt_reached' => false,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }
}
