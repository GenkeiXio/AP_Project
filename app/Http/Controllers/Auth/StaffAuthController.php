<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StaffAuthController extends Controller
{
    /**
     * Step 1: Verify email + password
     */
    public function verifyCredentials(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $email    = $request->email;
        $password = $request->password;

        // Check Admin first
        $admin = Admin::where('email', $email)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Session::put('staff_pending_id',   $admin->id);
            Session::put('staff_pending_type', 'admin');
            Session::put('staff_pending_name', $admin->name);
            return response()->json(['success' => true, 'name' => $admin->name]);
        }

        // Check Teacher
        $teacher = Teacher::where('email', $email)->where('is_active', true)->first();
        if ($teacher && Hash::check($password, $teacher->password)) {
            Session::put('staff_pending_id',   $teacher->id);
            Session::put('staff_pending_type', 'teacher');
            Session::put('staff_pending_name', $teacher->name);
            return response()->json(['success' => true, 'name' => $teacher->name]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password.'
        ], 401);
    }

    /**
     * Step 2: Verify access code
     */
    public function verifyAccessCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string',
        ]);

        $pendingId   = Session::get('staff_pending_id');
        $pendingType = Session::get('staff_pending_type');

        if (!$pendingId || !$pendingType) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please login again.'
            ], 401);
        }

        if ($pendingType === 'admin') {
            $staff = Admin::find($pendingId);
            if ($staff && $staff->access_code === $request->access_code) {
                Session::forget(['staff_pending_id', 'staff_pending_type', 'staff_pending_name']);
                Auth::guard('admin')->login($staff);
                return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
            }
        } elseif ($pendingType === 'teacher') {
            $staff = Teacher::find($pendingId);
            if ($staff && $staff->access_code === $request->access_code) {
                Session::forget(['staff_pending_id', 'staff_pending_type', 'staff_pending_name']);
                Auth::guard('teacher')->login($staff);
                return response()->json(['success' => true, 'redirect' => route('teacher.dashboard')]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid access code. Please try again.'
        ], 401);
    }

    /**
     * Clear pending session (back to credentials)
     */
    public function clearPending(Request $request)
    {
        Session::forget(['staff_pending_id', 'staff_pending_type', 'staff_pending_name']);
        return response()->json(['success' => true]);
    }

    /**
     * Logout admin
     */
    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }

    /**
     * Logout teacher
     */
    public function logoutTeacher(Request $request)
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('home');
    }
}
