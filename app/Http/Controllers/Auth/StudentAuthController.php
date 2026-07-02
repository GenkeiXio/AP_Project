<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_\s]+$/',
            'password' => 'required|string|min:6|max:60',
        ], [
            'username.required' => 'Pakiusap ilagay ang iyong username.',
            'username.regex'    => 'Ang username ay maaari lamang maglaman ng mga letra, numero, at underscore.',
            'password.required' => 'Pakiusap ilagay ang iyong password.',
            'password.min'      => 'Ang password ay dapat may hindi bababa sa 6 na karakter.',
        ]);

        $username = trim($request->username);
        $student  = Student::where('username', $username)->first();

        if (!$student || !$student->password || !Hash::check($request->password, $student->password)) {
            return redirect()->back()->withInput($request->only('username'))->withErrors([
                'auth' => 'Maling username o password. Kung bago ka, magrehistro muna.',
            ]);
        }

        $student->update(['last_played' => now()]);
        Session::put('student_id',       $student->id);
        Session::put('student_username', $student->username);

        // New accounts have no avatar yet send them to character selection
        if (!$student->avatar) {
            return redirect()->route('student.select-character');
        }

        return redirect()->route('narration');
    }

    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_\s]+$/',
        ], [
            'username.required' => 'Pakiusap ilagay ang iyong username.',
            'username.regex'    => 'Ang username ay maaari lamang maglaman ng mga letra, numero, at underscore.',
        ]);

        $username = trim((string) $request->query('username', ''));
        $isTaken = Student::whereRaw('LOWER(username) = ?', [mb_strtolower($username)])->exists();

        return response()->json([
            'available' => !$isTaken,
            'message' => $isTaken
                ? 'Ang username na ito ay ginagamit na ng ibang mag-aaral.'
                : 'Available',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_\s]+$/|unique:students,username',
            'password' => 'required|string|min:6|max:60|confirmed',
        ], [
            'username.required'  => 'Pakiusap ilagay ang iyong username.',
            'username.regex'     => 'Ang username ay maaari lamang maglaman ng mga letra, numero, at underscore.',
            'username.unique'    => 'Ang username na ito ay ginagamit na ng ibang mag-aaral.',
            'password.required'  => 'Pakiusap ilagay ang iyong password.',
            'password.min'       => 'Ang password ay dapat may hindi bababa sa 6 na karakter.',
            'password.confirmed' => 'Hindi magkatugma ang password at kumpirmasyon.',
        ]);

        $student = Student::create([
            'username'         => trim($request->username),
            'password'         => Hash::make($request->password),
            'last_played'      => now(),
            'unlocked_avatars' => ['boy_uniform', 'girl_uniform', 'neutral_hero'],
        ]);

        return redirect()->route('home')
            ->with('registration_success', true)
            ->with('registered_username', trim($request->username));
    }

    public function logout(Request $request)
    {
        Session::forget(['student_id', 'student_username']);
        return redirect()->route('home');
    }
}
