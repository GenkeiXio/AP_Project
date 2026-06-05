<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\GameSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    private function student(): ?Student
    {
        return Student::find(Session::get('student_id'));
    }

    // ── Character Selection (new students only) ──
    public function selectCharacter()
    {
        $student = $this->student();
        if (!$student) return redirect()->route('home');

        if ($student->avatar) return redirect()->route('narration');

        $unlockedAvatars = $student->unlocked_avatars ?? ['boy_uniform', 'girl_uniform', 'neutral_hero'];

        return view('Students.select-character', compact('student', 'unlockedAvatars'));
    }

    // ── Save selected character (first time) ──
    public function saveCharacter(Request $request)
    {
        $request->validate([
            'avatar' => 'required|in:rizal,bonifacio,gabriela,boy_uniform,girl_uniform,neutral_hero',
        ]);

        $student = $this->student();
        if (!$student) return redirect()->route('home');

        if (!$student->hasUnlockedAvatar($request->avatar)) {
            return redirect()->back()->withErrors(['avatar' => 'Pumili ng karakter na na-unlock na o bilhin ito sa shop.']);
        }

        $student->update(['avatar' => $request->avatar]);
        return redirect()->route('narration');
    }

    // ── Shop ──
    public function shop()
    {
        $student = $this->student();
        if (!$student) return redirect()->route('home');

        $shopItems = [
            'rizal' => [
                'label' => 'Jose Rizal',
                'description' => 'Unlock ang pambansang bayani para sa iyong avatar.',
                'image' => 'pictures/Jose Rizal.png',
                'theme' => 'rizal-theme',
            ],
            'bonifacio' => [
                'label' => 'Andres Bonifacio',
                'description' => 'Unlock ang Ama ng Katipunan.',
                'image' => 'pictures/Bonifacio.png',
                'theme' => 'bonifacio-theme',
            ],
            'gabriela' => [
                'label' => 'Gabriela Silang',
                'description' => 'Unlock ang lakas ng babae bilang avatar.',
                'image' => 'pictures/Gabriela silang (2).png',
                'theme' => 'gabriela-theme',
            ],
        ];

        return view('Students.shop', [
            'student' => $student,
            'shopItems' => $shopItems,
            'unlockedAvatars' => $student->unlocked_avatars,
        ]);
    }

    public function buyAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|in:rizal,bonifacio,gabriela',
        ]);

        $student = $this->student();
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Una kang mag-login.'], 401);
        }

        if ($student->hasUnlockedAvatar($request->avatar)) {
            return response()->json(['success' => false, 'message' => 'Naka-unlock na ang avatar.']);
        }

        $student->unlockAvatar($request->avatar);

        return response()->json(['success' => true, 'avatar' => $request->avatar]);
    }

    // ── Student Profile ──
    public function profile()
    {
        $student = $this->student();
        if (!$student) return redirect()->route('home');

        $totalClasses = $student->classes()->count();
        $totalQuizzes = GameSession::where('student_id', $student->id)
                            ->where('status', 'completed')->count();
        $sessions     = GameSession::where('student_id', $student->id)
                            ->where('status', 'completed')->get();
        $avgScore     = $sessions->count()
            ? round($sessions->avg(fn($s) => $s->total_points > 0
                ? ($s->score / $s->total_points) * 100 : 0))
            : 0;

        $unlockedAvatars = $student->unlocked_avatars ?? ['boy_uniform', 'girl_uniform', 'neutral_hero'];

        return view('Students.profile', compact(
            'student', 'totalClasses', 'totalQuizzes', 'avgScore', 'unlockedAvatars'
        ));
    }

    // ── Update avatar from profile (AJAX) ──
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|in:rizal,bonifacio,gabriela,boy_uniform,girl_uniform,neutral_hero',
        ]);

        $student = $this->student();
        if (!$student) return response()->json(['success' => false], 401);

        if (!$student->hasUnlockedAvatar($request->avatar)) {
            return response()->json(['success' => false, 'message' => 'Hindi na-unlock ang avatar na ito.'], 403);
        }

        $student->update(['avatar' => $request->avatar]);
        return response()->json(['success' => true]);
    }

    // ── Update username from profile (AJAX) ──
    public function updateUsername(Request $request)
    {
        $student = $this->student();
        if (!$student) return response()->json(['success' => false], 401);

        $request->validate([
            'username' => [
                'required', 'string', 'max:50',
                'regex:/^[a-zA-Z0-9_\s]+$/',
                'unique:students,username,' . $student->id,
            ],
        ], [
            'username.unique' => 'Ang username na ito ay ginagamit na ng ibang mag-aaral.',
            'username.regex'  => 'Mga letra, numero, at underscore lamang ang pinapayagan.',
        ]);

        $newUsername = trim($request->username);
        $student->update(['username' => $newUsername]);
        Session::put('student_username', $newUsername);

        return response()->json(['success' => true, 'username' => $newUsername]);
    }
}
