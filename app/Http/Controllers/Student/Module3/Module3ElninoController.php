<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Elnino;

class Module3ElninoController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Activities.el_niño');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'score' => 'required|integer',
            'zone1' => 'nullable|string',
            'zone2' => 'nullable|string',
            'zone3' => 'nullable|string',
            'zone4' => 'nullable|string',
            'zone5' => 'nullable|string',
        ]);

        $existing = Module3Elnino::where('student_id', $studentId)->first();

        if ($existing) {
            $existing->update([
                'score' => $request->score,
                'is_completed' => true,
                'zone1' => $request->zone1,
                'zone2' => $request->zone2,
                'zone3' => $request->zone3,
                'zone4' => $request->zone4,
                'zone5' => $request->zone5,
            ]);
        } else {
            Module3Elnino::create([
                'student_id' => $studentId,
                'score' => $request->score,
                'is_completed' => true,
                'zone1' => $request->zone1,
                'zone2' => $request->zone2,
                'zone3' => $request->zone3,
                'zone4' => $request->zone4,
                'zone5' => $request->zone5,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
