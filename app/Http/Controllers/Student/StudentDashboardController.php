<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Student::find(Session::get('student_id'));
        if (!$student) {
            return redirect()->route('home');
        }
        // Update last_played on every dashboard visit
        $student->update(['last_played' => now()]);
        return view('Students.studentsdashboard', compact('student'));
    }
}
