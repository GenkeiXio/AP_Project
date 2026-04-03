<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard') – Araling Panlipunan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #d4edaa 0%, #f5e8c0 50%, #fde3a3 100%);
            min-height: 100vh;
            color: #3d2a1a;
        }
        .topnav {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(12px);
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(80,50,10,0.08);
            position: sticky; top: 0; z-index: 50;
            height: 60px;
        }
        .topnav .brand {
            font-family: 'Baloo 2', cursive;
            font-size: 1.1rem; font-weight: 800;
            color: #3d2a1a; flex-shrink: 0; text-decoration: none;
        }
        .topnav .brand span { color: #e8922a; }

        .nav-links {
            display: flex; align-items: center;
            gap: 2px; flex: 1; padding: 0 18px;
        }
        .nav-link {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 12px; border-radius: 10px;
            font-size: 0.86rem; font-weight: 700;
            color: #7a6040; text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .nav-link:hover  { background: rgba(109,191,126,0.12); color: #3d2a1a; }
        .nav-link.active { background: rgba(109,191,126,0.2); color: #2d6a3c; }

        .topnav-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

        /* Profile chip — clickable link to profile */
        .profile-chip {
            display: flex; align-items: center; gap: 8px;
            background: rgba(109,191,126,0.15);
            border: 1.5px solid rgba(109,191,126,0.3);
            border-radius: 20px; padding: 5px 14px 5px 8px;
            font-size: 0.85rem; font-weight: 700; color: #2d6a3c;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }
        .profile-chip:hover { background: rgba(109,191,126,0.28); border-color: rgba(77,168,98,0.5); }
        .profile-chip .chip-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, #c8f0d0, #a0e0b0);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem; flex-shrink: 0;
            border: 1.5px solid rgba(77,168,98,0.3);
        }

        .logout-btn {
            padding: 7px 14px;
            background: rgba(255,80,80,0.1);
            border: 1.5px solid rgba(255,80,80,0.25);
            border-radius: 10px; color: #c0392b;
            font-family: 'Nunito', sans-serif;
            font-size: 0.82rem; font-weight: 700;
            cursor: pointer; transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.2); }

        .page-content {
            padding: 28px 32px;
            max-width: 1060px; margin: 0 auto;
        }

        .deco { position: fixed; pointer-events: none; animation: float 5s ease-in-out infinite; z-index: 0; }
        .deco-1 { top: 15%; left: 2%;  font-size: 2rem; animation-delay: 0s;   }
        .deco-2 { top: 60%; right: 2%; font-size: 2rem; animation-delay: 1.5s; }
        .deco-3 { bottom: 10%; left: 5%; font-size: 1.8rem; animation-delay: 1s; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
    @stack('styles')
</head>
<body>
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>

    @php
        $student = \App\Models\Student::find(session('student_id'));
        $avatarEmoji = match($student?->avatar) {
            'boy_uniform'  => '🧑‍🎓',
            'girl_uniform' => '👩‍🎓',
            default        => '🎒',
        };
    @endphp

    <nav class="topnav">
        <a href="{{ route('student.map') }}" class="brand">
            Araling <span>Panlipunan</span> 10 🧭
        </a>

        <!-- <div class="nav-links">
            <a href="{{ route('student.map') }}"
               class="nav-link {{ request()->routeIs('student.map') ? 'active' : '' }}">
               🗺️ Map
            </a>
            <a href="{{ route('student.profile') }}"
               class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
               👤 Profile
            </a>
        </div> -->

        <div class="topnav-right">
            {{-- Profile chip — shows avatar + username, links to profile --}}
            <a href="{{ route('student.profile') }}" class="profile-chip">
                <span class="chip-avatar">{{ $avatarEmoji }}</span>
                {{ session('student_username') }}
            </a>
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>
    </nav>

    <div class="page-content" style="position:relative; z-index:1;">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
