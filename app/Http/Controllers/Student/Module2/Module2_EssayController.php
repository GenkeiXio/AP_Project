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
            return redirect()->route('home')->with('error', 'Please login first.');
        }

        // ✅ VALIDATION
        $request->validate([
            'essay_answer' => 'required|string',
            'evidence'     => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', // 20MB
        ]);

        $file = $request->file('evidence');

        // Detect type
        $mime = $file->getMimeType();
        $type = str_contains($mime, 'video') ? 'video' : 'image';

        // Save file
        $path = $file->store('module2_evidence', 'public');

        // Save to DB
        Module2Essay::create([
            'student_id'    => $student->id,
            'essay_answer'  => $request->essay_answer,
            'evidence_path' => $path,
            'evidence_type' => $type,
            'submitted_by'  => $student->username,
            'submitted_at'  => now(),
        ]);

        return back()->with('success', '✅ Matagumpay na naisumite ang iyong sagot!');
    }
}
