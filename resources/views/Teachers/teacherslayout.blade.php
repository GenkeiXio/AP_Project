<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Teacher Dashboard') – Araling Panlipunan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        :root { --teal:#3a9e8c; --teal-dark:#2a7a6c; --orange:#e8922a; --brown:#3d2a1a; --sidebar-w:260px; }
        body { font-family:'Nunito',sans-serif; background:#eef4f3; color:var(--brown); display:flex; min-height:100vh; }

        .sidebar { width:var(--sidebar-w); background:linear-gradient(180deg,#1a5a50 0%,#2a7a6a 100%); min-height:100vh; display:flex; flex-direction:column; padding:28px 0; position:fixed; top:0; left:0; box-shadow:4px 0 20px rgba(0,0,0,0.15); z-index:50; }
        .sidebar-brand { padding:0 24px 28px; border-bottom:1px solid rgba(255,255,255,0.12); }
        .sidebar-brand .logo { font-family:'Baloo 2',cursive; font-size:1.4rem; font-weight:800; color:#fff; }
        .sidebar-brand .logo span { color:#a0e6d8; }
        .sidebar-brand p { font-size:0.75rem; color:rgba(255,255,255,0.5); margin-top:3px; }

        .sidebar nav { flex:1; padding:16px 0; overflow-y:auto; }
        .nav-section-title { font-size:0.65rem; font-weight:800; text-transform:uppercase; letter-spacing:1.5px; color:rgba(255,255,255,0.4); padding:10px 24px 5px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 24px; color:rgba(255,255,255,0.75); text-decoration:none; font-size:0.91rem; font-weight:600; transition:background 0.2s,color 0.2s; border-left:3px solid transparent; }
        .nav-link:hover, .nav-link.active { background:rgba(255,255,255,0.1); color:#fff; border-left-color:#a0e6d8; }
        .nav-link .icon { font-size:1.1rem; width:22px; text-align:center; flex-shrink:0; }

        /* Profile mini card in sidebar */
        .sidebar-profile {
            padding:18px 20px;
            border-bottom:1px solid rgba(255,255,255,0.12);
            margin-bottom:6px;
        }
        .profile-mini {
            display:flex; align-items:center; gap:12px;
            background:rgba(255,255,255,0.08);
            border-radius:13px; padding:12px 14px;
            text-decoration:none;
            transition:background 0.2s;
        }
        .profile-mini:hover { background:rgba(255,255,255,0.16); }
        .profile-avatar-wrap {
            width:42px; height:42px; border-radius:50%;
            background:rgba(255,255,255,0.18);
            display:flex; align-items:center; justify-content:center;
            font-size:1.4rem; flex-shrink:0;
            border:2px solid rgba(255,255,255,0.25);
        }
        .profile-info .pname { font-size:0.88rem; font-weight:800; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:140px; }
        .profile-info .prole { font-size:0.72rem; color:rgba(255,255,255,0.5); margin-top:1px; }
        .profile-edit-hint { font-size:0.65rem; color:rgba(255,255,255,0.35); margin-top:2px; }

        .sidebar-footer { padding:16px 24px; border-top:1px solid rgba(255,255,255,0.12); }
        .logout-btn { width:100%; padding:10px; background:rgba(255,80,80,0.15); border:1px solid rgba(255,80,80,0.3); border-radius:10px; color:#ffaaaa; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:background 0.2s; }
        .logout-btn:hover { background:rgba(255,80,80,0.28); }

        .main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .topbar { background:#fff; padding:14px 32px; display:flex; align-items:center; justify-content:space-between; box-shadow:0 2px 10px rgba(0,0,0,0.06); position:sticky; top:0; z-index:40; }
        .topbar h1 { font-family:'Baloo 2',cursive; font-size:1.25rem; font-weight:800; color:var(--brown); }
        .topbar .breadcrumb { font-size:0.78rem; color:#9a8060; }

        /* Profile shortcut in topbar */
        .topbar-profile { display:flex; align-items:center; gap:10px; }
        .topbar-avatar { width:34px; height:34px; border-radius:50%; background:#e0f5f2; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
        .topbar-name { font-size:0.85rem; font-weight:700; color:#3d2a1a; }

        .page-content { padding:28px 32px; flex:1; }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="logo">Araling <span>Panlipunan</span></div>
            <p>Grade 10 Adventure – Teacher</p>
        </div>

        {{-- Profile Mini Card --}}
        <div class="sidebar-profile">
            <a href="{{ route('teacher.profile') }}" class="profile-mini">
                @php
                    $t = Auth::guard('teacher')->user();
                    $avatarEmoji = match($t->avatar ?? 'teacher_male') {
                        'teacher_male'   => '👨‍🏫',
                        'teacher_female' => '👩‍🏫',
                        'scientist'      => ($t->gender ?? 'male') === 'female' ? '👩‍🔬' : '👨‍🔬',
                        'explorer'       => '🧭',
                        default          => '👤',
                    };
                @endphp
                <div class="profile-avatar-wrap">{{ $avatarEmoji }}</div>
                <div class="profile-info">
                    <div class="pname">{{ $t->name }}</div>
                    <div class="prole">{{ $t->subject_specialization ?? 'Teacher' }}</div>
                    <div class="profile-edit-hint">Click to edit profile →</div>
                </div>
            </a>
        </div>

        <nav>
            <div class="nav-section-title">Main</div>
            <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span> Dashboard
            </a>

            <div class="nav-section-title">Teaching</div>
            <a href="{{ route('teacher.classes') }}" class="nav-link {{ request()->routeIs('teacher.classes*') ? 'active' : '' }}">
                <span class="icon">🏫</span> My Classes
            </a>
            <a href="{{ route('teacher.analytics') }}" class="nav-link {{ request()->routeIs('teacher.analytics*') ? 'active' : '' }}">
                <span class="icon">📊</span> Analytics
            </a>

            <div class="nav-section-title">Students</div>
            <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                <span class="icon">🎒</span> All Students
            </a>

            <div class="nav-section-title">Account</div>
            <a href="{{ route('teacher.profile') }}" class="nav-link {{ request()->routeIs('teacher.profile') ? 'active' : '' }}">
                <span class="icon">👤</span> My Profile
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <div class="breadcrumb">Teacher Portal</div>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="topbar-profile">
                <div class="topbar-avatar">{{ $avatarEmoji }}</div>
                <a href="{{ route('teacher.profile') }}" style="text-decoration:none;">
                    <div class="topbar-name">{{ $t->name }}</div>
                </a>
            </div>
        </div>
        <div class="page-content">@yield('content')</div>
    </div>

    @stack('scripts')
</body>
</html>
