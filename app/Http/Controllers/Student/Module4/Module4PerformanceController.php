<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_4\Module4Performance;

class Module4PerformanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reflection' => 'required|string',
            'format'     => 'nullable|string',
        ]);

        $studentId = Session::get('student_id');

        if (!$studentId) {
            return redirect()->route('home');
        }

        // Save or update (one per student)
        Module4Performance::updateOrCreate(
            ['student_id' => $studentId],
            [
                'reflection'   => $request->reflection,
                'format'       => $request->format,
                'is_submitted' => true,
            ]
        );

        return back()->with('success', 'Task submitted successfully!');
    }
}
