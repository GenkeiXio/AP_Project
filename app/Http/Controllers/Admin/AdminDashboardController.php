<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students'  => Student::count(),
            'total_teachers'  => Teacher::count(),
            'total_admins'    => Admin::count(),
            'active_teachers' => Teacher::where('is_active', true)->count(),
        ];
        $teachers = Teacher::select('id', 'name', 'email', 'avatar', 'access_code', 'is_active', 'created_at')
                           ->orderBy('created_at', 'desc')
                           ->get();
        $admins = Admin::select('id', 'name', 'email', 'access_code', 'created_at')
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('Admin.admindashboard', compact('stats', 'teachers', 'admins'));
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

    public function updateTeacher(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'nullable|string|min:8',
            'avatar'   => 'nullable|in:teacher_male,teacher_female,scientist,explorer',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'avatar' => $request->avatar ?? $teacher->avatar,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $teacher->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Teacher account updated successfully!',
            'teacher' => $teacher->fresh(),
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
            'admin'       => $admin,
        ]);
    }

    public function updateAdmin(Request $request, Admin $admin)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Admin account updated successfully!',
            'admin'   => $admin->fresh(),
        ]);
    }

    public function deleteAdmin(Admin $admin)
    {
        if ($admin->id === Auth::guard('admin')->id()) {
            return response()->json([
                'success' => false,
                'message' => "You can't delete your own account while logged in.",
            ], 422);
        }

        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin account deleted.',
        ]);
    }

    public function getTeachers()
    {
        $teachers = Teacher::select('id', 'name', 'email', 'avatar', 'access_code', 'is_active', 'created_at')->get();
        return response()->json($teachers);
    }

    public function getAdmins()
    {
        $admins = Admin::select('id', 'name', 'email', 'access_code', 'created_at')->get();
        return response()->json($admins);
    }

    public function toggleTeacher(Teacher $teacher)
    {
        $teacher->update(['is_active' => !$teacher->is_active]);
        return response()->json(['success' => true, 'is_active' => $teacher->is_active]);
    }
}