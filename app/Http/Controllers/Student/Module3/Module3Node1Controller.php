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

    // Show page
    public function index()
    {
        if (!$this->studentId()) {
            return redirect()->route('home');
        }

        return view('module3.node1');
    }

    // Save result (AJAX)
    public function save(Request $request)
    {
        $request->validate([
            'score'        => 'required|integer',
            'total_items'  => 'required|integer',
        ]);

        $studentId = $this->studentId();

        if (!$studentId) {
            return response()->json(['success' => false], 401);
        }

        $accuracy = $request->total_items > 0
            ? ($request->score / $request->total_items) * 100
            : 0;

        $record = Module3Node1::where('student_id', $studentId)->first();

        if ($record) {
            $record->update([
                'score'        => $request->score,
                'total_items'  => $request->total_items,
                'accuracy'     => $accuracy,
                'is_completed' => true,
                'attempts'     => $record->attempts + 1,
            ]);
        } else {
            $record = Module3Node1::create([
                'student_id'   => $studentId,
                'score'        => $request->score,
                'total_items'  => $request->total_items,
                'accuracy'     => $accuracy,
                'is_completed' => true,
                'attempts'     => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }
}
