<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Node2;

class Module3Node2Controller extends Controller
{
    private function studentId()
    {
        return Session::get('student_id');
    }

    // Show page
    public function index()
    {
        if (!$this->studentId()) {
            return redirect()->route('home');
        }

        return view('module3.node2');
    }

    // Save progress (AJAX)
    public function save(Request $request)
    {
        $request->validate([
            'chosen_side'    => 'nullable|in:top,bottom',
            'score'          => 'required|integer',
            'lives_remaining'=> 'required|integer',
            'is_passed'      => 'required|boolean',
        ]);

        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['success' => false], 401);
        }

        // Check if existing record
        $record = Module3Node2::where('student_id', $studentId)->first();

        if ($record) {
            // Update existing
            $record->update([
                'chosen_side'     => $request->chosen_side,
                'score'           => $request->score,
                'lives_remaining' => $request->lives_remaining,
                'is_passed'       => $request->is_passed,
                'attempts'        => $record->attempts + 1,
            ]);
        } else {
            // Create new
            $record = Module3Node2::create([
                'student_id'      => $studentId,
                'chosen_side'     => $request->chosen_side,
                'score'           => $request->score,
                'lives_remaining' => $request->lives_remaining,
                'is_passed'       => $request->is_passed,
                'attempts'        => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'data'    => $record
        ]);
    }
}
