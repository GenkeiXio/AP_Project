<?php

namespace App\Http\Controllers\Student\Module3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module_3\Module3Explore;

class Module3ExploreController extends Controller
{
    public function index()
    {
        return view('Students.Module3.Explore');
    }

    public function store(Request $request)
    {
        $studentId = Session::get('student_id');

        if (!$studentId) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $data = Module3Explore::updateOrCreate(
            ['student_id' => $studentId],
            [
                'xp' => $request->xp ?? 0,
                'badge' => $request->badge,
                'is_completed' => true
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
