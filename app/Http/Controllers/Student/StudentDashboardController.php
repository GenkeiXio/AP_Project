<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Student::find(Session::get('student_id'));
        if (!$student) {
            return redirect()->route('home');
        }
        return view('Students.studentsdashboard', compact('student'));
    }

    public function saveAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|in:explorer_boy,explorer_girl,scientist,adventurer',
        ]);

        $student = Student::find(Session::get('student_id'));
        if ($student) {
            $student->update(['avatar' => $request->avatar]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
