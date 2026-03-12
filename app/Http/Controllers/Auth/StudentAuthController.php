<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2'
        ]);

        $student = Student::firstOrCreate([
            'username' => $request->username
        ]);

        session([
            'student_id' => $student->id
        ]);

        return response()->json([
            'success' => true,
            'redirect' => 'student-login'
        ]);
    }
}