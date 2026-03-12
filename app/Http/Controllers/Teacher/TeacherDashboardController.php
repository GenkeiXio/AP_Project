<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('last_played', 'desc')->get();
        $teacher  = Auth::guard('teacher')->user();
        return view('Teachers.teachersdashboard', compact('students', 'teacher'));
    }
}
