@extends('Admin.adminlayout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }

    .stat-icon {
        width: 54px; height: 54px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }
    .stat-icon.green  { background: #e8f8ed; }
    .stat-icon.orange { background: #fff3e0; }
    .stat-icon.blue   { background: #e8f0ff; }
    .stat-icon.purple { background: #f3e8ff; }

    .stat-info .value { font-family: 'Baloo 2', cursive; font-size: 2rem; font-weight: 800; color: #3d2a1a; line-height: 1; }
    .stat-info .label { font-size: 0.82rem; color: #9a8060; font-weight: 600; margin-top: 2px; }

    .section-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        margin-bottom: 24px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .section-header h2 {
        font-family: 'Baloo 2', cursive;
        font-size: 1.1rem;
        font-weight: 800;
        color: #3d2a1a;
    }

    .search-input {
        padding: 8px 16px;
        border: 2px solid #e0d0ba;
        border-radius: 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
        width: 220px;
    }
    .search-input:focus { border-color: #6dbf7e; }

    /* ── Teacher Table ── */
    .teacher-table {
        width: 100%;
        border-collapse: collapse;
    }

    .teacher-table thead th {
        text-align: left;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #9a8060;
        padding: 0 14px 12px;
        border-bottom: 2px solid #f0e8d8;
        white-space: nowrap;
    }

    .teacher-table tbody tr {
        transition: background 0.15s;
    }
    .teacher-table tbody tr:hover { background: #fdfaf5; }

    .teacher-table tbody td {
        padding: 14px;
        font-size: 0.9rem;
        border-bottom: 1px solid #f5ede0;
        color: #5a4030;
        vertical-align: middle;
    }

    .teacher-table tbody tr:last-child td { border-bottom: none; }

    /* Avatar chip */
    .avatar-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f5f0e8;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #7a5a30;
        text-transform: capitalize;
        white-space: nowrap;
    }

    /* Status badge */
    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-active   { background: #e8f8ed; color: #1a7a38; }
    .badge-inactive { background: #fde8e8; color: #c0392b; }

    /* Teacher row number */
    .row-num {
        font-size: 0.78rem;
        font-weight: 800;
        color: #c0ad90;
        width: 36px;
        text-align: center;
    }

    /* Teacher name cell */
    .teacher-name  { font-weight: 800; color: #3d2a1a; }
    .teacher-email { font-size: 0.8rem; color: #9a8060; margin-top: 1px; }

    /* Toggle button */
    .toggle-btn {
        padding: 6px 14px;
        border-radius: 8px;
        border: none;
        font-size: 0.78rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
        font-family: 'Nunito', sans-serif;
        white-space: nowrap;
    }
    .toggle-btn:hover   { opacity: 0.8; transform: scale(0.97); }
    .toggle-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-deactivate { background: #fde8e8; color: #c0392b; }
    .btn-activate   { background: #e8f8ed; color: #1a7a38; }

    /* Date cell */
    .date-cell { font-size: 0.8rem; color: #b5a48a; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #c0ad90;
    }
    .empty-state .empty-icon { font-size: 3rem; margin-bottom: 12px; }
    .empty-state p { font-size: 0.9rem; }

    /* Quick actions + info sidebar */
    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

    .action-card {
        background: linear-gradient(135deg, #f8f4ee, #fff);
        border: 2px solid #e8dcc8;
        border-radius: 14px;
        padding: 18px 12px;
        cursor: pointer;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }
    .action-card:hover {
        border-color: #6dbf7e;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(109,191,126,0.2);
    }
    .action-card .action-icon  { font-size: 2rem; margin-bottom: 8px; }
    .action-card .action-title { font-weight: 800; font-size: 0.88rem; color: #3d2a1a; }
    .action-card .action-desc  { font-size: 0.75rem; color: #9a8060; margin-top: 2px; }

    .info-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #f5ede0; font-size: 0.87rem; }
    .info-row:last-child { border-bottom: none; }
    .info-row .info-label { color: #9a8060; font-weight: 600; }
    .info-row .info-val   { color: #3d2a1a; font-weight: 700; }

    /* Toast notification */
    .toast {
        position: fixed;
        bottom: 28px;
        right: 28px;
        padding: 14px 22px;
        border-radius: 14px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #fff;
        box-shadow: 0 6px 24px rgba(0,0,0,0.18);
        z-index: 9999;
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.3s, transform 0.3s;
        pointer-events: none;
    }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: linear-gradient(135deg, #4da862, #3a8050); }
    .toast.error   { background: linear-gradient(135deg, #e05050, #c03030); }

    .pagination-container nav {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
        margin-top: 15px;
    }

    .pagination-container .pagination {
        display: flex !important;
        flex-direction: row !important;
        list-style-type: none !important; /* Ito ang tatanggal sa mga tuldok */
        padding: 0 !important;
        margin: 0 !important;
        gap: 8px !important;
    }

    /* 3. Siguraduhing pantay ang mga list items */
    .pagination-container .page-item {
        display: flex !important;
        align-items: center;
        margin: 0 !important;
    }

    .pagination-container .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        border: 2px solid #e0d0ba;
        background: #fff;
        color: #9a8060;
        padding: 0 12px;
        border-radius: 8px;
        font-weight: 800;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .pagination-container .page-item.active .page-link,
    .pagination-container .page-item.active span {
        background: #3d2a1a !important; /* Dark brown */
        color: #fff !important;
        border-color: #3d2a1a !important;
    }

    .pagination-container .page-item:not(.active):not(.disabled) .page-link:hover {
        background: #fdfaf5 !important;
        border-color: #6dbf7e !important; /* Green highlight */
        color: #3d2a1a !important;
    }

    .pagination-container .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8f4ee;
        border-color: #e8dcc8;
    }

    .pagination-container .text-muted, 
    .pagination-container p {
        font-size: 0.85rem !important;
        color: #9a8060 !important;
        font-weight: 600 !important;
        margin: 0 !important;
    }

    .pagination-container .page-item:first-child .page-link,
    .pagination-container .page-item:last-child .page-link {
        font-size: 1.2rem; /* Palakihin nang konti ang arrow */
        line-height: 1;
        padding: 4px 12px;
    }
</style>
@endpush

@section('content')

{{-- Stats Row --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">🎒</div>
        <div class="stat-info">
            <div class="value">{{ $stats['total_students'] }}</div>
            <div class="label">Total Students</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">👩‍🏫</div>
        <div class="stat-info">
            <div class="value" id="statTeachers">{{ $stats['total_teachers'] }}</div>
            <div class="label">Total Teachers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">✅</div>
        <div class="stat-info">
            <div class="value" id="statActive">{{ $stats['active_teachers'] }}</div>
            <div class="label">Active Teachers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">👑</div>
        <div class="stat-info">
            <div class="value">{{ $stats['total_admins'] }}</div>
            <div class="label">Total Admins</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

    <div style="display: flex; flex-direction: column; gap: 24px;">
        {{-- ── Teacher Table ── --}}
        <div class="section-card">
            <div class="section-header">
                <h2>👩‍🏫 Teacher Accounts
                    <span style="font-family:'Nunito',sans-serif; font-size:0.8rem; font-weight:600; color:#9a8060; margin-left:6px;">
                        ({{ $teachers->count() }} total)
                    </span>
                </h2>
                <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <input
                        type="text"
                        class="search-input"
                        id="teacherSearch"
                        placeholder="🔍 Search teachers..."
                        oninput="filterTeachers()"
                    />
                    <button class="btn btn-green" style="font-size:0.82rem; padding:8px 16px;" onclick="openCreateTeacherModal()">
                        + Add Teacher
                    </button>
                </div>
            </div>

            @if($teachers->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">👩‍🏫</div>
                    <p>No teachers yet. Click <strong>+ Add Teacher</strong> to get started!</p>
                </div>
            @else
                <table class="teacher-table" id="teacherTable">
                    <thead>
                        <tr>
                            <th class="row-num">#</th>
                            <th>Teacher</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="teacherTableBody">
                        @foreach($teachers as $i => $teacher)
                        <tr data-name="{{ strtolower($teacher->name) }}" data-email="{{ strtolower($teacher->email) }}" data-id="{{ $teacher->id }}">
                            <td class="row-num">{{ $i + 1 }}</td>
                            <td>
                                <div class="teacher-name">{{ $teacher->name }}</div>
                                <div class="teacher-email">{{ $teacher->email }}</div>
                            </td>
                            <td>
                                @php
                                    $avatarIcons = [
                                        'teacher_male'   => '👨‍🏫',
                                        'teacher_female' => '👩‍🏫',
                                        'scientist'      => '🔬',
                                        'explorer'       => '🧭',
                                    ];
                                    $avatarLabels = [
                                        'teacher_male'   => 'Male',
                                        'teacher_female' => 'Female',
                                        'scientist'      => 'Scientist',
                                        'explorer'       => 'Explorer',
                                    ];
                                @endphp
                                <span class="avatar-chip">
                                    {{ $avatarIcons[$teacher->avatar] ?? '👤' }}
                                    {{ $avatarLabels[$teacher->avatar] ?? $teacher->avatar }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $teacher->is_active ? 'badge-active' : 'badge-inactive' }}" id="badge-{{ $teacher->id }}">
                                    {{ $teacher->is_active ? '● Active' : '● Inactive' }}
                                </span>
                            </td>
                            <td class="date-cell">{{ $teacher->created_at->format('M d, Y') }}</td>
                            <td>
                                <button
                                    class="toggle-btn {{ $teacher->is_active ? 'btn-deactivate' : 'btn-activate' }}"
                                    id="toggleBtn-{{ $teacher->id }}"
                                    onclick="toggleTeacher({{ $teacher->id }}, {{ $teacher->is_active ? 'true' : 'false' }}, this)"
                                >
                                    {{ $teacher->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-container">
                    {{ $teachers->appends(['teachers_page' => request('teachers_page')])->links('pagination::bootstrap-4') }}
                </div>

                {{-- No results from search --}}
                <div id="noResults" style="display:none;" class="empty-state" style="padding:20px;">
                    <p>🔍 No teachers found matching your search.</p>
                </div>
            @endif
        </div>

        {{-- ── Admins Table ── --}}
        <div class="section-card">
            <div class="section-header">
                <h2>👩‍🏫 Admin Accounts
                    <span style="font-family:'Nunito',sans-serif; font-size:0.8rem; font-weight:600; color:#9a8060; margin-left:6px;">
                        ({{ $admins->count() }} total)
                    </span>
                </h2>
                <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <input
                        type="text"
                        class="search-input"
                        id="adminSearch"
                        placeholder="🔍 Search admins..."
                        oninput="filterAdmins()"
                    />
                    <button class="btn btn-green" style="font-size:0.82rem; padding:8px 16px;" onclick="openCreateAdminModal()">
                        + Add Admin
                    </button>
                </div>
            </div>

            @if($admins->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">👩‍🏫</div>
                    <p>No admins yet. Click <strong>+ Add Admin</strong> to get started!</p>
                </div>
            @else
                <table class="teacher-table" id="teacherTable">
                    <thead>
                        <tr>
                            <th class="row-num">#</th>
                            <th>Admin</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="teacherTableBody">
                        @foreach($admins as $i => $admin)
                        <tr data-name="{{ strtolower($admin->name) }}" data-email="{{ strtolower($admin->email) }}" data-id="{{ $admin->id }}">
                            <td class="row-num">{{ $i + 1 }}</td>
                            <td>
                                <div class="teacher-name">{{ $admin->name }}</div>
                                <div class="teacher-email">{{ $admin->email }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $teacher->is_active ? 'badge-active' : 'badge-inactive' }}" id="badge-{{ $teacher->id }}">
                                    {{ $teacher->is_active ? '● Active' : '● Inactive' }}
                                </span>
                            </td>
                            <td class="date-cell">{{ $teacher->created_at->format('M d, Y') }}</td>
                            <td>
                                <button
                                    class="toggle-btn {{ $teacher->is_active ? 'btn-deactivate' : 'btn-activate' }}"
                                    id="toggleBtn-{{ $teacher->id }}"
                                    onclick="toggleTeacher({{ $teacher->id }}, {{ $teacher->is_active ? 'true' : 'false' }}, this)"
                                >
                                    {{ $teacher->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-container">
                    {{ $admins->appends(['teachers_page' => request('teachers_page')])->links('pagination::bootstrap-4') }}
                </div>

                {{-- No results from search --}}
                <div id="noResults" style="display:none;" class="empty-state" style="padding:20px;">
                    <p>🔍 No admins found matching your search.</p>
                </div>
            @endif
        </div>
    </div>
    

    {{-- ── Sidebar: Quick Actions + Admin Info ── --}}
    <div>
        {{-- Quick Actions --}}
        <div class="section-card">
            <div class="section-header"><h2>⚡ Quick Actions</h2></div>
            <div class="quick-actions">
                <div class="action-card" onclick="openCreateTeacherModal()">
                    <div class="action-icon">👩‍🏫</div>
                    <div class="action-title">Add Teacher</div>
                    <div class="action-desc">Create account</div>
                </div>
                <div class="action-card" onclick="openCreateAdminModal()">
                    <div class="action-icon">👤</div>
                    <div class="action-title">Add Admin</div>
                    <div class="action-desc">Create account</div>
                </div>
            </div>
        </div>

        {{-- Admin Info --}}
        <div class="section-card">
            <div class="section-header"><h2>👑 Your Account</h2></div>
            <div>
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-val">{{ Auth::guard('admin')->user()->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-val" style="font-size:0.82rem;">{{ Auth::guard('admin')->user()->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Role</span>
                    <span class="badge badge-active">Administrator</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Joined</span>
                    <span class="info-val">{{ Auth::guard('admin')->user()->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Toast --}}
<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    // ── Search / filter ──
    function filterTeachers() {
        const q    = document.getElementById('teacherSearch').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#teacherTableBody tr');
        let visible = 0;

        rows.forEach(row => {
            const name  = row.dataset.name  || '';
            const email = row.dataset.email || '';
            const match = name.includes(q) || email.includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        const noResults = document.getElementById('noResults');
        if (noResults) noResults.style.display = visible === 0 ? 'block' : 'none';
    }

    // ── Toggle active/inactive ──
    async function toggleTeacher(id, isCurrentlyActive, btn) {
        btn.disabled = true;
        btn.textContent = '...';

        try {
            const res  = await fetch(`/admin/teacher/${id}/toggle`, {
                method:  'PATCH',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();

            if (data.success) {
                const nowActive = data.is_active;

                // Update badge
                const badge = document.getElementById(`badge-${id}`);
                badge.textContent = nowActive ? '● Active' : '● Inactive';
                badge.className   = `badge ${nowActive ? 'badge-active' : 'badge-inactive'}`;

                // Update button
                btn.textContent = nowActive ? 'Deactivate' : 'Activate';
                btn.className   = `toggle-btn ${nowActive ? 'btn-deactivate' : 'btn-activate'}`;
                btn.onclick     = () => toggleTeacher(id, nowActive, btn);

                // Update active teacher count in stat card
                updateActiveCount(nowActive ? 1 : -1);

                showToast(nowActive ? '✅ Teacher activated!' : '🔴 Teacher deactivated.', nowActive ? 'success' : 'error');
            }
        } catch(e) {
            showToast('Something went wrong.', 'error');
        }

        btn.disabled = false;
    }

    function updateActiveCount(delta) {
        const el  = document.getElementById('statActive');
        if (el) el.textContent = Math.max(0, parseInt(el.textContent) + delta);
    }

    // ── Toast ──
    let toastTimer;
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className   = `toast ${type} show`;
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.classList.remove('show'), 3000);
    }

    // ── After teacher created — append new row without reload ──
    // (called from adminlayout.blade.php after successful AJAX create)
    window.onTeacherCreated = function(teacher, accessCode) {
        const tbody = document.getElementById('teacherTableBody');
        if (!tbody) return;

        const icons  = { teacher_male:'👨‍🏫', teacher_female:'👩‍🏫', scientist:'🔬', explorer:'🧭' };
        const labels = { teacher_male:'Male', teacher_female:'Female', scientist:'Scientist', explorer:'Explorer' };
        const rowNum = tbody.querySelectorAll('tr').length + 1;
        const today  = new Date().toLocaleDateString('en-US', { month:'short', day:'2-digit', year:'numeric' });

        const tr = document.createElement('tr');
        tr.dataset.name  = teacher.name.toLowerCase();
        tr.dataset.email = teacher.email.toLowerCase();
        tr.dataset.id    = teacher.id;
        tr.innerHTML = `
            <td class="row-num">${rowNum}</td>
            <td>
                <div class="teacher-name">${teacher.name}</div>
                <div class="teacher-email">${teacher.email}</div>
            </td>
            <td><span class="avatar-chip">${icons[teacher.avatar] ?? '👤'} ${labels[teacher.avatar] ?? teacher.avatar}</span></td>
            <td><span class="badge badge-active" id="badge-${teacher.id}">● Active</span></td>
            <td class="date-cell">${today}</td>
            <td>
                <button class="toggle-btn btn-deactivate" id="toggleBtn-${teacher.id}"
                    onclick="toggleTeacher(${teacher.id}, true, this)">
                    Deactivate
                </button>
            </td>`;
        tbody.appendChild(tr);

        // Update stat counts
        const statTeachers = document.getElementById('statTeachers');
        if (statTeachers) statTeachers.textContent = parseInt(statTeachers.textContent) + 1;
        updateActiveCount(1);

        showToast(`✅ Teacher created! Access Code: ${accessCode}`, 'success');
    };
</script>
@endpush
