<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') – Araling Panlipunan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:     #6dbf7e;
            --green-dark:#4da862;
            --orange:    #e8922a;
            --brown:     #3d2a1a;
            --cream:     #fdf9f0;
            --sidebar-w: 260px;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: #f0f4ec;
            color: var(--brown);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(180deg, #2d5a1e 0%, #3d7a2a 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 28px 0;
            position: fixed;
            top: 0; left: 0;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            z-index: 50;
        }

        .sidebar-brand {
            padding: 0 24px 28px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-brand .logo {
            font-family: 'Baloo 2', cursive;
            font-size: 1.4rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
        }
        .sidebar-brand .logo span { color: #a8e6b0; }
        .sidebar-brand p { font-size: 0.75rem; color: rgba(255,255,255,0.55); margin-top: 3px; }

        .sidebar nav { flex: 1; padding: 20px 0; }

        .nav-section-title {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            padding: 12px 24px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 24px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
            border-left: 3px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #a8e6b0;
        }
        .nav-link .icon { font-size: 1.1rem; width: 22px; text-align: center; }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255,255,255,0.12);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }
        .user-avatar {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .user-info .info .name { font-size: 0.88rem; font-weight: 700; color: #fff; }
        .user-info .info .role { font-size: 0.72rem; color: rgba(255,255,255,0.5); }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: rgba(255,80,80,0.15);
            border: 1px solid rgba(255,80,80,0.3);
            border-radius: 10px;
            color: #ffaaaa;
            font-family: 'Nunito', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.28); }

        /* ── Main content ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar h1 {
            font-family: 'Baloo 2', cursive;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--brown);
        }

        .topbar .breadcrumb {
            font-size: 0.8rem;
            color: #9a8060;
        }

        .page-content {
            padding: 32px;
            flex: 1;
        }

        /* ── Modal base (reused) ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(20,10,5,0.5);
            backdrop-filter: blur(6px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }

        .modal {
            background: #fff;
            border-radius: 20px;
            padding: 32px 36px;
            width: min(460px, 92vw);
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            position: relative;
            animation: modalIn 0.3s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.92) translateY(16px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-close {
            position: absolute; top: 14px; right: 16px;
            background: none; border: none; font-size: 1.2rem;
            cursor: pointer; color: #9a8060;
        }

        .modal h2 {
            font-family: 'Baloo 2', cursive;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--brown);
        }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block; font-size: 0.85rem;
            font-weight: 700; margin-bottom: 6px; color: #5a4030;
        }
        .form-group input, .form-group select {
            width: 100%; padding: 11px 14px;
            border: 2px solid #e0d0ba; border-radius: 10px;
            font-family: 'Nunito', sans-serif; font-size: 0.93rem;
            outline: none; transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: var(--green);
        }

        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 11px 20px; border-radius: 10px; border: none; font-family: 'Nunito', sans-serif; font-size: 0.9rem; font-weight: 700; cursor: pointer; transition: opacity 0.2s, transform 0.15s; }
        .btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-green  { background: linear-gradient(135deg, #6dbf7e, #4da862); color: #fff; box-shadow: 0 3px 12px rgba(77,168,98,0.3); }
        .btn-orange { background: linear-gradient(135deg, #f0a040, #e07020); color: #fff; }
        .btn-full   { width: 100%; justify-content: center; padding: 13px; font-size: 1rem; }

        .alert { padding: 10px 14px; border-radius: 10px; font-size: 0.87rem; margin-bottom: 14px; font-weight: 600; display: none; }
        .alert.error   { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6cb; display: block; }
        .alert.success { background: #e8f8ed; color: #1e7a3a; border: 1px solid #b8e0c4; display: block; }

        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-spinner { display: inline-block; width: 14px; height: 14px; border: 2px solid rgba(255,255,255,0.4); border-top-color: #fff; border-radius: 50%; animation: spin 0.7s linear infinite; }
    </style>
    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="logo">Araling <span>Panlipunan</span></div>
            <p>Grade 10 Adventure – Admin</p>
        </div>

        <nav>
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span> Dashboard
            </a>

            <div class="nav-section-title">Management</div>
            <a href="#" class="nav-link" onclick="openCreateTeacherModal()">
                <span class="icon">👩‍🏫</span> Add Teacher
            </a>
            <a href="#" class="nav-link" onclick="openCreateAdminModal()">
                <span class="icon">👤</span> Add Admin
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">👑</div>
                <div class="info">
                    <div class="name">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="main">
        <div class="topbar">
            <div>
                <div class="breadcrumb">Admin Portal</div>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
        </div>
        <div class="page-content">
            @yield('content')
        </div>
    </div>

    {{-- Create Teacher Modal --}}
    <div class="modal-overlay" id="createTeacherModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('createTeacherModal')">✕</button>
            <h2>👩‍🏫 Add New Teacher</h2>
            <div class="alert" id="teacherAlert"></div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="tName" placeholder="Juan dela Cruz" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="tEmail" placeholder="teacher@school.com" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="tPassword" placeholder="Min. 8 characters" />
            </div>
            <div class="form-group">
                <label>Avatar</label>
                <select id="tAvatar">
                    <option value="teacher_male">Teacher Male</option>
                    <option value="teacher_female">Teacher Female</option>
                    <option value="scientist">Scientist</option>
                    <option value="explorer">Explorer</option>
                </select>
            </div>
            <button class="btn btn-green btn-full" id="createTeacherBtn" onclick="submitCreateTeacher()">
                ✅ Create Teacher Account
            </button>
        </div>
    </div>

    {{-- Create Admin Modal --}}
    <div class="modal-overlay" id="createAdminModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('createAdminModal')">✕</button>
            <h2>👤 Add New Admin</h2>
            <div class="alert" id="adminAlert"></div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="aName" placeholder="Maria Santos" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="aEmail" placeholder="admin2@school.com" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="aPassword" placeholder="Min. 8 characters" />
            </div>
            <button class="btn btn-orange btn-full" id="createAdminBtn" onclick="submitCreateAdmin()">
                ✅ Create Admin Account
            </button>
        </div>
    </div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        function openCreateTeacherModal() { document.getElementById('createTeacherModal').classList.add('active'); }
        function openCreateAdminModal()   { document.getElementById('createAdminModal').classList.add('active'); }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        document.querySelectorAll('.modal-overlay').forEach(el => {
            el.addEventListener('click', e => { if (e.target === el) el.classList.remove('active'); });
        });

        async function submitCreateTeacher() {
            const btn   = document.getElementById('createTeacherBtn');
            const alert = document.getElementById('teacherAlert');
            const body  = {
                name:     document.getElementById('tName').value.trim(),
                email:    document.getElementById('tEmail').value.trim(),
                password: document.getElementById('tPassword').value,
                avatar:   document.getElementById('tAvatar').value,
            };

            if (!body.name || !body.email || !body.password) {
                showAlert(alert, 'error', 'Please fill in all fields.'); return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner"></span> Creating...';

            try {
                const res  = await fetch('{{ route("admin.create-teacher") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                    body: JSON.stringify(body),
                });
                const data = await res.json();
                if (data.success) {
                    showAlert(alert, 'success', `✅ Teacher created! Access Code: ${data.access_code} — Save this!`);
                    document.getElementById('tName').value = '';
                    document.getElementById('tEmail').value = '';
                    document.getElementById('tPassword').value = '';
                    // Append to table live
                    if (typeof window.onTeacherCreated === 'function') {
                        window.onTeacherCreated(data.teacher, data.access_code);
                        closeModal('createTeacherModal');
                    }
                } else {
                    const msg = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Error creating teacher.');
                    showAlert(alert, 'error', msg);
                }
            } catch(e) {
                showAlert(alert, 'error', 'Something went wrong.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '✅ Create Teacher Account';
            }
        }

        async function submitCreateAdmin() {
            const btn   = document.getElementById('createAdminBtn');
            const alert = document.getElementById('adminAlert');
            const body  = {
                name:     document.getElementById('aName').value.trim(),
                email:    document.getElementById('aEmail').value.trim(),
                password: document.getElementById('aPassword').value,
            };

            if (!body.name || !body.email || !body.password) {
                showAlert(alert, 'error', 'Please fill in all fields.'); return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner"></span> Creating...';

            try {
                const res  = await fetch('{{ route("admin.create-admin") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                    body: JSON.stringify(body),
                });
                const data = await res.json();
                if (data.success) {
                    showAlert(alert, 'success', `✅ Admin created! Access Code: ${data.access_code} — Save this!`);
                    document.getElementById('aName').value = '';
                    document.getElementById('aEmail').value = '';
                    document.getElementById('aPassword').value = '';
                } else {
                    const msg = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Error creating admin.');
                    showAlert(alert, 'error', msg);
                }
            } catch(e) {
                showAlert(alert, 'error', 'Something went wrong.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '✅ Create Admin Account';
            }
        }

        function showAlert(el, type, msg) {
            el.className   = 'alert ' + type;
            el.textContent = msg;
        }
    </script>

    @stack('scripts')
</body>
</html>
