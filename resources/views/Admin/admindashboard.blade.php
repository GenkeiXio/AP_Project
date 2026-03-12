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
    }

    .section-header h2 {
        font-family: 'Baloo 2', cursive;
        font-size: 1.1rem;
        font-weight: 800;
        color: #3d2a1a;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #9a8060;
        padding: 0 12px 10px;
        border-bottom: 2px solid #f0e8d8;
    }

    td {
        padding: 13px 12px;
        font-size: 0.9rem;
        border-bottom: 1px solid #f5ede0;
        color: #5a4030;
    }

    tr:last-child td { border-bottom: none; }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .badge-green  { background: #e8f8ed; color: #1e7a3a; }
    .badge-red    { background: #fde8e8; color: #c0392b; }
    .badge-orange { background: #fff3e0; color: #b05800; }

    .toggle-btn {
        padding: 5px 14px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s;
        font-family: 'Nunito', sans-serif;
    }
    .toggle-btn:hover { opacity: 0.8; }
    .toggle-btn.deactivate { background: #fde8e8; color: #c0392b; }
    .toggle-btn.activate   { background: #e8f8ed; color: #1e7a3a; }

    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .action-card {
        background: linear-gradient(135deg, #f8f4ee, #fff);
        border: 2px solid #e8dcc8;
        border-radius: 14px;
        padding: 20px;
        cursor: pointer;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }
    .action-card:hover {
        border-color: #6dbf7e;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(109,191,126,0.2);
    }
    .action-card .action-icon { font-size: 2rem; margin-bottom: 8px; }
    .action-card .action-title { font-weight: 800; font-size: 0.9rem; color: #3d2a1a; }
    .action-card .action-desc  { font-size: 0.78rem; color: #9a8060; margin-top: 3px; }

    .empty-state { text-align: center; padding: 30px; color: #b5a48a; font-size: 0.9rem; }
</style>
@endpush

@section('content')

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">🎒</div>
        <div class="stat-info">
            <div class="value" id="statStudents">{{ $stats['total_students'] }}</div>
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
            <div class="value" id="statAdmins">{{ $stats['total_admins'] }}</div>
            <div class="label">Total Admins</div>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns: 1fr 320px; gap: 24px;">

    {{-- Teachers Table --}}
    <div class="section-card">
        <div class="section-header">
            <h2>👩‍🏫 Teacher Accounts</h2>
            <button class="btn btn-green" style="font-size:0.82rem; padding:8px 16px;" onclick="openCreateTeacherModal()">
                + Add Teacher
            </button>
        </div>
        <div id="teacherTableWrap">
            <div class="empty-state">Loading teachers...</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div>
        <div class="section-card">
            <div class="section-header"><h2>⚡ Quick Actions</h2></div>
            <div class="quick-actions">
                <div class="action-card" onclick="openCreateTeacherModal()">
                    <div class="action-icon">👩‍🏫</div>
                    <div class="action-title">Add Teacher</div>
                    <div class="action-desc">Create teacher account</div>
                </div>
                <div class="action-card" onclick="openCreateAdminModal()">
                    <div class="action-icon">👤</div>
                    <div class="action-title">Add Admin</div>
                    <div class="action-desc">Create admin account</div>
                </div>
            </div>
        </div>

        <div class="section-card" style="margin-top:0;">
            <div class="section-header"><h2>ℹ️ Your Info</h2></div>
            <div style="font-size:0.88rem; color:#5a4030; line-height:2;">
                <div><strong>Name:</strong> {{ Auth::guard('admin')->user()->name }}</div>
                <div><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</div>
                <div><strong>Role:</strong> <span class="badge badge-orange">Administrator</span></div>
                <div><strong>Joined:</strong> {{ Auth::guard('admin')->user()->created_at->format('M d, Y') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    async function loadTeachers() {
        try {
            const res  = await fetch('{{ route("admin.teachers") }}');
            const data = await res.json();
            renderTeachers(data);
        } catch(e) {
            document.getElementById('teacherTableWrap').innerHTML = '<div class="empty-state">Failed to load teachers.</div>';
        }
    }

    function renderTeachers(teachers) {
        if (!teachers.length) {
            document.getElementById('teacherTableWrap').innerHTML = '<div class="empty-state">No teachers yet. Add one to get started!</div>';
            return;
        }
        let html = `<table>
            <thead><tr>
                <th>Name</th><th>Email</th><th>Avatar</th><th>Status</th><th>Action</th>
            </tr></thead><tbody>`;

        teachers.forEach(t => {
            const badge  = t.is_active ? '<span class="badge badge-green">Active</span>' : '<span class="badge badge-red">Inactive</span>';
            const togBtn = t.is_active
                ? `<button class="toggle-btn deactivate" onclick="toggleTeacher(${t.id}, this)">Deactivate</button>`
                : `<button class="toggle-btn activate"   onclick="toggleTeacher(${t.id}, this)">Activate</button>`;
            html += `<tr>
                <td><strong>${t.name}</strong></td>
                <td>${t.email}</td>
                <td><span style="text-transform:capitalize; font-size:0.82rem;">${t.avatar.replace('_',' ')}</span></td>
                <td>${badge}</td>
                <td>${togBtn}</td>
            </tr>`;
        });

        html += '</tbody></table>';
        document.getElementById('teacherTableWrap').innerHTML = html;
    }

    async function toggleTeacher(id, btn) {
        btn.disabled = true;
        try {
            const res  = await fetch(`/admin/teacher/${id}/toggle`, {
                method:  'PATCH',
                headers: { 'X-CSRF-TOKEN': CSRF },
            });
            const data = await res.json();
            if (data.success) loadTeachers();
        } catch(e) {}
        btn.disabled = false;
    }

    async function loadStats() {
        // Reload page stats on teacher create
        const res  = await fetch(window.location.href);
        // Simple reload
        loadTeachers();
    }

    loadTeachers();
</script>
@endpush
