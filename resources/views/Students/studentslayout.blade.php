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
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(12px);
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(80,50,10,0.08);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topnav .brand {
            font-family: 'Baloo 2', cursive;
            font-size: 1.2rem;
            font-weight: 800;
            color: #3d2a1a;
        }
        .topnav .brand span { color: #e8922a; }

        .topnav-right { display: flex; align-items: center; gap: 14px; }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(109,191,126,0.15);
            border: 1.5px solid rgba(109,191,126,0.3);
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 0.88rem;
            font-weight: 700;
            color: #2d6a3c;
        }

        .logout-btn {
            padding: 8px 16px;
            background: rgba(255,80,80,0.1);
            border: 1.5px solid rgba(255,80,80,0.25);
            border-radius: 10px;
            color: #c0392b;
            font-family: 'Nunito', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.2); }

        .page-content {
            padding: 36px 32px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .deco { position: fixed; pointer-events: none; font-size: 2rem; animation: float 5s ease-in-out infinite; z-index: 0; }
        .deco-1 { top: 15%; left: 2%;  animation-delay: 0s; }
        .deco-2 { top: 60%; right: 2%; animation-delay: 1.5s; }
        .deco-3 { bottom: 10%; left: 5%; animation-delay: 1s; }

        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
    @stack('styles')
</head>
<body>
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>

    <nav class="topnav">
        <div class="brand">Araling <span>Panlipunan</span> 🧭</div>
        <div class="topnav-right">
            <div class="user-chip">
                🎒 {{ session('student_username') }}
            </div>
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
