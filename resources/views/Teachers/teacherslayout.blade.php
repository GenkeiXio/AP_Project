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
        :root {
            --teal:#3a9e8c; --teal-dark:#2a7a6c; --orange:#e8922a; --brown:#3d2a1a;
            --sidebar-w:260px; --topbar-h:64px;
        }
        html { scroll-behavior:smooth; }
        body { font-family:'Nunito',sans-serif; background:#eef4f3; color:var(--brown); display:flex; min-height:100vh; overflow-x:hidden; }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width:var(--sidebar-w); background:linear-gradient(180deg,#1a5a50 0%,#2a7a6a 100%);
            min-height:100vh; height:100vh; display:flex; flex-direction:column; padding:24px 0;
            position:fixed; top:0; left:0; box-shadow:4px 0 20px rgba(0,0,0,0.15); z-index:100;
            transition:transform 0.28s ease;
        }
        .sidebar-brand { padding:0 24px 24px; border-bottom:1px solid rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:space-between; }
        .sidebar-brand .logo { font-family:'Baloo 2',cursive; font-size:1.35rem; font-weight:800; color:#fff; }
        .sidebar-brand .logo span { color:#a0e6d8; }
        .sidebar-brand p { font-size:0.72rem; color:rgba(255,255,255,0.5); margin-top:3px; }
        .sidebar-close-btn {
            display:none; background:rgba(255,255,255,0.1); border:none; color:#fff; width:32px; height:32px;
            border-radius:8px; align-items:center; justify-content:center; cursor:pointer; flex-shrink:0;
        }

        .sidebar nav { flex:1; padding:14px 0; overflow-y:auto; }
        .sidebar nav::-webkit-scrollbar { width:5px; }
        .sidebar nav::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.15); border-radius:10px; }

        .nav-section-title { font-size:0.63rem; font-weight:800; text-transform:uppercase; letter-spacing:1.5px; color:rgba(255,255,255,0.4); padding:14px 24px 6px; }
        .nav-link {
            display:flex; align-items:center; gap:12px; padding:11px 24px; color:rgba(255,255,255,0.75);
            text-decoration:none; font-size:0.91rem; font-weight:600; transition:background 0.18s,color 0.18s,border-color 0.18s;
            border-left:3px solid transparent; position:relative;
        }
        .nav-link:hover { background:rgba(255,255,255,0.08); color:#fff; }
        .nav-link.active { background:rgba(255,255,255,0.12); color:#fff; border-left-color:#a0e6d8; }
        .nav-link .icon { font-size:1.1rem; width:22px; text-align:center; flex-shrink:0; }

        /* Profile mini card in sidebar */
        .sidebar-profile { padding:16px 20px 18px; border-bottom:1px solid rgba(255,255,255,0.12); margin-bottom:4px; }
        .profile-mini {
            display:flex; align-items:center; gap:12px; background:rgba(255,255,255,0.08);
            border-radius:13px; padding:12px 14px; text-decoration:none; transition:background 0.2s,transform 0.15s;
        }
        .profile-mini:hover { background:rgba(255,255,255,0.16); transform:translateY(-1px); }
        .profile-avatar-wrap {
            width:42px; height:42px; border-radius:50%; background:rgba(255,255,255,0.18);
            display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0;
            border:2px solid rgba(255,255,255,0.25);
        }
        .profile-info { min-width:0; }
        .profile-info .pname { font-size:0.88rem; font-weight:800; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:140px; }
        .profile-info .prole { font-size:0.72rem; color:rgba(255,255,255,0.55); margin-top:1px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .profile-edit-hint { font-size:0.65rem; color:rgba(255,255,255,0.35); margin-top:2px; }

        .sidebar-footer { padding:16px 24px; border-top:1px solid rgba(255,255,255,0.12); }
        .logout-btn {
            width:100%; padding:10px; background:rgba(255,80,80,0.15); border:1px solid rgba(255,80,80,0.3);
            border-radius:10px; color:#ffaaaa; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700;
            cursor:pointer; transition:background 0.2s; display:flex; align-items:center; justify-content:center; gap:8px;
        }
        .logout-btn:hover { background:rgba(255,80,80,0.28); }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display:none; position:fixed; inset:0; background:rgba(20,30,25,0.45);
            z-index:90; opacity:0; transition:opacity 0.25s ease;
        }
        .sidebar-overlay.show { display:block; opacity:1; }

        /* ============ MAIN ============ */
        .main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; width:calc(100% - var(--sidebar-w)); transition:margin-left 0.28s ease; }
        .topbar {
            background:#fff; height:var(--topbar-h); padding:0 28px; display:flex; align-items:center;
            justify-content:space-between; box-shadow:0 2px 10px rgba(0,0,0,0.06); position:sticky; top:0; z-index:40; gap:16px;
        }
        .topbar-left { display:flex; align-items:center; gap:14px; min-width:0; }
        .topbar h1 { font-family:'Baloo 2',cursive; font-size:1.2rem; font-weight:800; color:var(--brown); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .topbar .breadcrumb { font-size:0.75rem; color:#9a8060; }

        .menu-toggle-btn {
            display:none; background:#f0f9f5; border:none; width:38px; height:38px; border-radius:10px;
            align-items:center; justify-content:center; cursor:pointer; color:var(--teal-dark); flex-shrink:0;
        }
        .menu-toggle-btn:active { background:#daf0e9; }

        .topbar-profile { display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0; }
        .topbar-avatar { width:34px; height:34px; border-radius:50%; background:#e0f5f2; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
        .topbar-name { font-size:0.85rem; font-weight:700; color:#3d2a1a; }

        .page-content { padding:26px 28px; flex:1; width:100%; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 900px) {
            .sidebar { transform:translateX(-100%); }
            .sidebar.open { transform:translateX(0); }
            .sidebar-close-btn { display:flex; }
            .main { margin-left:0; width:100%; }
            .menu-toggle-btn { display:flex; }
            .topbar-name { display:none; }
        }
        @media (max-width: 560px) {
            .topbar { padding:0 16px; }
            .page-content { padding:18px 16px; }
            .topbar h1 { font-size:1.05rem; }
            .breadcrumb { display:none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="teacherSidebar">
        <div class="sidebar-brand">
            <div>
                <div class="logo">Araling <span>Panlipunan</span></div>
                <p>Grade 10 Adventure – Teacher</p>
            </div>
            <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close menu">
                <i data-lucide="x" style="width:18px;height:18px;"></i>
            </button>
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
                <i data-lucide="layout-dashboard" class="icon"></i>
                <span>Dashboard</span>
            </a>

            <div class="nav-section-title">Teaching</div>
            <a href="{{ route('teacher.analytics') }}" class="nav-link {{ request()->routeIs('teacher.analytics*') ? 'active' : '' }}">
                <i data-lucide="bar-chart-3" class="icon"></i>
                <span>Analytics</span>
            </a>
            <a href="{{ route('teacher.results') }}" class="nav-link {{ request()->routeIs('teacher.results*') ? 'active' : '' }}">
                <i data-lucide="file-text" class="icon"></i>
                <span>Results</span>
            </a>
            <a href="{{ route('teacher.classes') }}" class="nav-link {{ request()->routeIs('teacher.classes*') ? 'active' : '' }}">
                <i data-lucide="grid" class="icon"></i>
                <span>Classes</span>
            </a>
            <a href="{{ route('teacher.modules') }}" class="nav-link {{ request()->routeIs('teacher.modules') ? 'active' : '' }}">
                <i data-lucide="book" class="icon"></i>
                <span>Modules</span>
            </a>

            <div class="nav-section-title">Students</div>
            <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                <i data-lucide="user-pen" class="icon"></i>
                <span>All Students</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-lucide="log-out" style="width:16px;height:16px;"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle-btn" id="menuToggleBtn" aria-label="Open menu">
                    <i data-lucide="menu" style="width:20px;height:20px;"></i>
                </button>
                <div style="min-width:0;">
                    <div class="breadcrumb">Teacher Portal</div>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
            </div>
            <a href="{{ route('teacher.profile') }}" class="topbar-profile">
                <div class="topbar-avatar">{{ $avatarEmoji }}</div>
                <div class="topbar-name">{{ $t->name }}</div>
            </a>
        </div>
        <div class="page-content">@yield('content')</div>
    </div>

    @stack('scripts')

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        (function () {
            const sidebar   = document.getElementById('teacherSidebar');
            const overlay   = document.getElementById('sidebarOverlay');
            const openBtn   = document.getElementById('menuToggleBtn');
            const closeBtn  = document.getElementById('sidebarCloseBtn');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            openBtn?.addEventListener('click', openSidebar);
            closeBtn?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            // Close sidebar automatically when a nav link is tapped on mobile
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 900) closeSidebar();
                });
            });

            // Reset state if the viewport is resized back to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 900) closeSidebar();
            });
        })();
    </script>
</body>
</html>