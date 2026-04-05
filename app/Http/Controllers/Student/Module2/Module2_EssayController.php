<?php

namespace App\Http\Controllers\Student\Module2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module_2\Module2Essay;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Module2_EssayController extends Controller
{
    private function student(): ?Student
    {
        return Student::find(Session::get('student_id'));
    }

    public function submit(Request $request)
    {
        $student = $this->student();
        if (!$student) {
            return redirect()->route('home');
        }

        Module2Essay::create([
            'student_id'    => $student->id,
            'essay_answer'  => $request->essay_answer,
            'submitted_by'  => $student->username,
            'submitted_at'  => now(),
        ]);

        return back()->with('success', '✅ Essay submitted successfully!');
    }
}
