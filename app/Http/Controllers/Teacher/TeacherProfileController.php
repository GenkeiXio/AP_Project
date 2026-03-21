<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherProfileController extends Controller
{
    private function teacher()
    {
        return Auth::guard('teacher')->user();
    }

    public function index()
    {
        $teacher = $this->teacher();
        return view('Teachers.profile', compact('teacher'));
    }

    public function updateInfo(Request $request)
    {
        $teacher = $this->teacher();

        $request->validate([
            'name'                   => 'required|string|max:100',
            'email'                  => 'required|email|unique:teachers,email,' . $teacher->id,
            'gender'                 => 'required|in:male,female',
            'subject_specialization' => 'nullable|string|max:100',
            'phone'                  => 'nullable|string|max:20',
            'school_name'            => 'nullable|string|max:150',
            'bio'                    => 'nullable|string|max:500',
        ]);

        $teacher->update($request->only([
            'name', 'email', 'gender',
            'subject_specialization', 'phone', 'school_name', 'bio',
        ]));

        return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|in:teacher_male,teacher_female,scientist,explorer',
        ]);

        $this->teacher()->update(['avatar' => $request->avatar]);

        return response()->json(['success' => true, 'message' => 'Avatar updated!']);
    }

    public function updatePassword(Request $request)
    {
        $teacher = $this->teacher();

        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $teacher->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 422);
        }

        $teacher->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['success' => true, 'message' => 'Password changed successfully!']);
    }
}
