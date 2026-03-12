<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AdminTeacherAuthController extends Controller
{

    public function verifyCredentials(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if($admin && Hash::check($request->password,$admin->password)){

            session([
                'temp_user_id'=>$admin->id,
                'temp_role'=>'admin'
            ]);

            return response()->json(['step'=>'access_code']);
        }

        $teacher = Teacher::where('email',$request->email)->first();

        if($teacher && Hash::check($request->password,$teacher->password)){

            session([
                'temp_user_id'=>$teacher->id,
                'temp_role'=>'teacher'
            ]);

            return response()->json(['step'=>'access_code']);
        }

        return response()->json([
            'error'=>'Invalid credentials'
        ],401);
    }


    public function verifyAccessCode(Request $request)
    {
        $request->validate([
            'access_code'=>'required'
        ]);

        $role = session('temp_role');
        $id = session('temp_user_id');

        if($role == 'admin'){

            $admin = Admin::find($id);

            if($admin && $admin->access_code == $request->access_code){

                session([
                    'admin_id'=>$admin->id
                ]);

                return response()->json([
                    'redirect'=>'/admin/dashboard'
                ]);
            }
        }

        if($role == 'teacher'){

            $teacher = Teacher::find($id);

            if($teacher && $teacher->access_code == $request->access_code){

                session([
                    'teacher_id'=>$teacher->id
                ]);

                return response()->json([
                    'redirect'=>'/teacher/dashboard'
                ]);
            }
        }

        return response()->json([
            'error'=>'Invalid access code'
        ],401);
    }

}