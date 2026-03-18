<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    private function teacher()
    {
        return Auth::guard('teacher')->user();
    }

    public function index()
    {
        $classes = SchoolClass::where('teacher_id', $this->teacher()->id)
            ->withCount('students')
            ->with('quizzes')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Teachers.classes', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'grade_level' => 'nullable|string|max:50',
        ]);

        $class = SchoolClass::create([
            'teacher_id'  => $this->teacher()->id,
            'name'        => $request->name,
            'description' => $request->description,
            'grade_level' => $request->grade_level ?? 'Grade 10',
            'class_code'  => strtoupper(Str::random(6)),
        ]);

        return response()->json(['success' => true, 'class' => $class->load('teacher')]);
    }

    public function update(Request $request, SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'grade_level' => 'nullable|string|max:50',
        ]);

        $class->update($request->only('name', 'description', 'grade_level'));
        return response()->json(['success' => true]);
    }

    public function destroy(SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);
        $class->delete();
        return response()->json(['success' => true]);
    }

    public function show(SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);
        $class->load(['students', 'quizzes' => fn($q) => $q->withCount('questions')]);
        return view('Teachers.class-detail', compact('class'));
    }

    public function removeStudent(SchoolClass $class, Student $student)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);
        $class->students()->detach($student->id);
        return response()->json(['success' => true]);
    }

    public function regenerateCode(SchoolClass $class)
    {
        abort_if($class->teacher_id !== $this->teacher()->id, 403);
        $class->update(['class_code' => strtoupper(Str::random(6))]);
        return response()->json(['success' => true, 'class_code' => $class->class_code]);
    }
}
