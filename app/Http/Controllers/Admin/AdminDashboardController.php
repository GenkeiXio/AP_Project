<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_admins'   => Admin::count(),
            'active_teachers'=> Teacher::where('is_active', true)->count(),
        ];
        return view('Admin.admindashboard', compact('stats'));
    }

    public function createTeacher(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:8',
            'avatar'   => 'nullable|in:teacher_male,teacher_female,scientist,explorer',
        ]);

        $accessCode = strtoupper(Str::random(6));

        $teacher = Teacher::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'access_code' => $accessCode,
            'avatar'      => $request->avatar ?? 'teacher_male',
            'is_active'   => true,
        ]);

        return response()->json([
            'success'     => true,
            'message'     => 'Teacher account created successfully!',
            'access_code' => $accessCode,
            'teacher'     => $teacher,
        ]);
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        $accessCode = strtoupper(Str::random(6));

        $admin = Admin::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'access_code' => $accessCode,
        ]);

        return response()->json([
            'success'     => true,
            'message'     => 'Admin account created successfully!',
            'access_code' => $accessCode,
        ]);
    }

    public function getTeachers()
    {
        $teachers = Teacher::select('id', 'name', 'email', 'avatar', 'is_active', 'created_at')->get();
        return response()->json($teachers);
    }

    public function toggleTeacher(Teacher $teacher)
    {
        $teacher->update(['is_active' => !$teacher->is_active]);
        return response()->json(['success' => true, 'is_active' => $teacher->is_active]);
    }
}
