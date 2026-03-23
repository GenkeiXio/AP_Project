<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_\s]+$/',
        ], [
            'username.required' => 'Pakiusap ilagay ang iyong username.',
            'username.regex'    => 'Ang username ay maaari lamang maglaman ng mga letra, numero, at underscore.',
        ]);

        $username = trim($request->username);

        // Check if student exists
        $student = Student::where('username', $username)->first();

        if ($student) {
            // Existing student — log them in
            $student->update(['last_played' => now()]);
            Session::put('student_id', $student->id);
            Session::put('student_username', $student->username);
            return redirect()->route('narration');
        }

        // New student — register them
        $student = Student::create([
            'username'    => $username,
            'last_played' => now(),
        ]);

        Session::put('student_id', $student->id);
        Session::put('student_username', $student->username);

        return redirect()->route('narration');
    }

    public function logout(Request $request)
    {
        Session::forget(['student_id', 'student_username']);
        return redirect()->route('home');
    }
}
