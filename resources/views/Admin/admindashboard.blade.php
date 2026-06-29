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

    /* ── Tables (shared: teacher + admin) ── */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
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

    .data-table tbody tr {
        transition: background 0.15s;
    }
    .data-table tbody tr:hover { background: #fdfaf5; }

    .data-table tbody td {
        padding: 14px;
        font-size: 0.9rem;
        border-bottom: 1px solid #f5ede0;
        color: #5a4030;
        vertical-align: middle;
    }

    .data-table tbody tr:last-child td { border-bottom: none; }

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
    .badge-purple   { background: #f3e8ff; color: #6a2dc0; }

    /* Row number */
    .row-num {
        font-size: 0.78rem;
        font-weight: 800;
        color: #c0ad90;
        width: 36px;
        text-align: center;
    }

    /* Name cell */
    .teacher-name, .admin-name  { font-weight: 800; color: #3d2a1a; }
    .teacher-email, .admin-email { font-size: 0.8rem; color: #9a8060; margin-top: 1px; }

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

    /* ── Edit Modals (Teacher + Admin share styling) ── */
    #editTeacherOverlay, #editAdminOverlay {
        position: fixed; inset: 0;
        background: rgba(61,42,26,0.45);
        backdrop-filter: blur(3px);
        z-index: 1000;
        display: flex; align-items: center; justify-content: center;
        opacity: 0; pointer-events: none;
        transition: opacity 0.25s;
    }
    #editTeacherOverlay.open, #editAdminOverlay.open { opacity: 1; pointer-events: all; }

    #editTeacherOverlay .modal-box, #editAdminOverlay .modal-box {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        width: 100%; max-width: 460px;
        box-shadow: 0 16px 48px rgba(0,0,0,0.18);
        transform: translateY(20px) scale(0.97);
        transition: transform 0.25s;
    }
    #editTeacherOverlay.open .modal-box, #editAdminOverlay.open .modal-box { transform: translateY(0) scale(1); }

    .modal-title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.2rem;
        font-weight: 800;
        color: #3d2a1a;
        margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
    }

    .form-group { margin-bottom: 16px; }
    .form-group label {
        display: block;
        font-size: 0.78rem;
        font-weight: 800;
        color: #9a8060;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #e0d0ba;
        border-radius: 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.9rem;
        color: #3d2a1a;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
        background: #fdfaf5;
    }
    .form-group input:focus,
    .form-group select:focus { border-color: #6dbf7e; background: #fff; }
    .form-group .hint {
        font-size: 0.74rem;
        color: #b5a48a;
        margin-top: 4px;
    }

    .modal-actions {
        display: flex; gap: 10px; justify-content: flex-end; margin-top: 24px;
    }
    .modal-actions.with-delete { justify-content: space-between; }
    .btn-cancel {
        padding: 9px 20px;
        border-radius: 10px;
        border: 2px solid #e0d0ba;
        background: transparent;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        font-weight: 700;
        color: #9a8060;
        cursor: pointer;
        transition: border-color 0.2s, color 0.2s;
    }
    .btn-cancel:hover { border-color: #c0392b; color: #c0392b; }
    .btn-save {
        padding: 9px 22px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(135deg, #6dbf7e, #4da862);
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        font-weight: 800;
        color: #fff;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
    }
    .btn-save:hover   { opacity: 0.88; transform: scale(0.97); }
    .btn-save:disabled { opacity: 0.5; cursor: not-allowed; }

    .btn-delete-admin {
        padding: 9px 16px;
        border-radius: 10px;
        border: 2px solid #fde8e8;
        background: #fff5f5;
        font-family: 'Nunito', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        color: #c0392b;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
    }
    .btn-delete-admin:hover { background: #fde8e8; transform: scale(0.97); }
    .btn-delete-admin:disabled { opacity: 0.5; cursor: not-allowed; }

    /* Action buttons group in table */
    .action-group { display: flex; gap: 6px; align-items: center; }
    .btn-edit {
        padding: 6px 14px;
        border-radius: 8px;
        border: 2px solid #e0d0ba;
        background: #fdfaf5;
        font-size: 0.78rem;
        font-weight: 700;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s, transform 0.15s;
        font-family: 'Nunito', sans-serif;
        color: #7a5a30;
        white-space: nowrap;
    }
    .btn-edit:hover { border-color: #6dbf7e; background: #e8f8ed; color: #2a7a40; transform: scale(0.97); }

    .access-code-chip {
        font-family: monospace;
        font-size: 0.82rem;
        font-weight: 800;
        background: #f0f4ec;
        color: #2d5a1e;
        padding: 4px 10px;
        border-radius: 8px;
        letter-spacing: 1px;
        border: 1px solid #c8dfc8;
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
            <div class="value" id="statAdmins">{{ $stats['total_admins'] }}</div>
            <div class="label">Total Admins</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

    <div>
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
                <table class="data-table" id="teacherTable">
                    <thead>
                        <tr>
                            <th class="row-num">#</th>
                            <th>Teacher</th>
                            <th>Avatar</th>
                            <th>Access Code</th>
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
                                <span class="access-code-chip">{{ $teacher->access_code ?? '—' }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $teacher->is_active ? 'badge-active' : 'badge-inactive' }}" id="badge-{{ $teacher->id }}">
                                    {{ $teacher->is_active ? '● Active' : '● Inactive' }}
                                </span>
                            </td>
                            <td class="date-cell">{{ $teacher->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-group">
                                    <button
                                        class="btn-edit"
                                        onclick="openEditTeacherModal({{ $teacher->id }}, '{{ addslashes($teacher->name) }}', '{{ $teacher->email }}', '{{ $teacher->avatar }}')"
                                    >
                                        ✏️ Edit
                                    </button>
                                    <button
                                        class="toggle-btn {{ $teacher->is_active ? 'btn-deactivate' : 'btn-activate' }}"
                                        id="toggleBtn-{{ $teacher->id }}"
                                        onclick="toggleTeacher({{ $teacher->id }}, {{ $teacher->is_active ? 'true' : 'false' }}, this)"
                                    >
                                        {{ $teacher->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- No results from search --}}
                <div id="noResults" style="display:none;" class="empty-state">
                    <p>🔍 No teachers found matching your search.</p>
                </div>
            @endif
        </div>

        {{-- ── Admin Table ── --}}
        <div class="section-card">
            <div class="section-header">
                <h2>👑 Admin Accounts
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
                    <button class="btn btn-orange" style="font-size:0.82rem; padding:8px 16px;" onclick="openCreateAdminModal()">
                        + Add Admin
                    </button>
                </div>
            </div>

            @if($admins->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">👑</div>
                    <p>No admins yet. Click <strong>+ Add Admin</strong> to get started!</p>
                </div>
            @else
                <table class="data-table" id="adminTable">
                    <thead>
                        <tr>
                            <th class="row-num">#</th>
                            <th>Admin</th>
                            <th>Access Code</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        @foreach($admins as $i => $admin)
                        <tr data-name="{{ strtolower($admin->name) }}" data-email="{{ strtolower($admin->email) }}" data-id="{{ $admin->id }}">
                            <td class="row-num">{{ $i + 1 }}</td>
                            <td>
                                <div class="admin-name">{{ $admin->name }}</div>
                                <div class="admin-email">{{ $admin->email }}</div>
                            </td>
                            <td>
                                <span class="access-code-chip">{{ $admin->access_code ?? '—' }}</span>
                            </td>
                            <td class="date-cell">{{ $admin->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-group">
                                    <button
                                        class="btn-edit"
                                        onclick="openEditAdminModal({{ $admin->id }}, '{{ addslashes($admin->name) }}', '{{ $admin->email }}')"
                                    >
                                        ✏️ Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="noAdminResults" style="display:none;" class="empty-state">
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

{{-- Edit Teacher Modal --}}
<div class="modal-overlay" id="editTeacherOverlay" onclick="closeEditTeacherModal(event)">
    <div class="modal-box">
        <div class="modal-title">✏️ Edit Teacher Account</div>

        <input type="hidden" id="editTeacherId">

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" id="editTeacherName" placeholder="e.g. Maria Santos" maxlength="100">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="editTeacherEmail" placeholder="e.g. maria@school.edu">
        </div>

        <div class="form-group">
            <label>Avatar</label>
            <select id="editTeacherAvatar">
                <option value="teacher_male">👨‍🏫 Male Teacher</option>
                <option value="teacher_female">👩‍🏫 Female Teacher</option>
                <option value="scientist">🔬 Scientist</option>
                <option value="explorer">🧭 Explorer</option>
            </select>
        </div>

        <div class="form-group">
            <label>New Password <span style="font-weight:400; text-transform:none;">(optional)</span></label>
            <input type="password" id="editTeacherPassword" placeholder="Leave blank to keep current password" minlength="8">
            <div class="hint">Minimum 8 characters. Only fill this if you want to change the password.</div>
        </div>

        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeEditTeacherModal()">Cancel</button>
            <button class="btn-save" id="editSaveBtn" onclick="saveTeacherEdit()">Save Changes</button>
        </div>
    </div>
</div>

{{-- Edit Admin Modal --}}
<div class="modal-overlay" id="editAdminOverlay" onclick="closeEditAdminModal(event)">
    <div class="modal-box">
        <div class="modal-title">✏️ Edit Admin Account</div>

        <input type="hidden" id="editAdminId">

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" id="editAdminName" placeholder="e.g. Maria Santos" maxlength="100">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="editAdminEmail" placeholder="e.g. admin@school.edu">
        </div>

        <div class="form-group">
            <label>New Password <span style="font-weight:400; text-transform:none;">(optional)</span></label>
            <input type="password" id="editAdminPassword" placeholder="Leave blank to keep current password" minlength="8">
            <div class="hint">Minimum 8 characters. Only fill this if you want to change the password.</div>
        </div>

        <div class="modal-actions with-delete">
            <button class="btn-delete-admin" id="adminDeleteBtn" onclick="deleteAdminAccount()">🗑️ Delete</button>
            <div style="display:flex; gap:10px;">
                <button class="btn-cancel" onclick="closeEditAdminModal()">Cancel</button>
                <button class="btn-save" id="editAdminSaveBtn" onclick="saveAdminEdit()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
    // Use window scope to avoid re-declaration conflicts with layout
    window.CSRF = window.CSRF || document.querySelector('meta[name="csrf-token"]').content;
    window.CURRENT_ADMIN_ID = {{ Auth::guard('admin')->id() }};

    // ── Search / filter: Teachers ──
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

    // ── Search / filter: Admins ──
    function filterAdmins() {
        const q    = document.getElementById('adminSearch').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#adminTableBody tr');
        let visible = 0;

        rows.forEach(row => {
            const name  = row.dataset.name  || '';
            const email = row.dataset.email || '';
            const match = name.includes(q) || email.includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        const noResults = document.getElementById('noAdminResults');
        if (noResults) noResults.style.display = visible === 0 ? 'block' : 'none';
    }

    // ── Toggle active/inactive (teachers) ──
    async function toggleTeacher(id, isCurrentlyActive, btn) {
        btn.disabled    = true;
        btn.textContent = '...';

        try {
            const res  = await fetch(`/admin/teacher/${id}/toggle`, {
                method:  'PATCH',
                headers: { 'X-CSRF-TOKEN': window.CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();

            if (data.success) {
                const nowActive = data.is_active;

                const badge = document.getElementById(`badge-${id}`);
                badge.textContent = nowActive ? '● Active' : '● Inactive';
                badge.className   = `badge ${nowActive ? 'badge-active' : 'badge-inactive'}`;

                btn.textContent = nowActive ? 'Deactivate' : 'Activate';
                btn.className   = `toggle-btn ${nowActive ? 'btn-deactivate' : 'btn-activate'}`;
                btn.onclick     = () => toggleTeacher(id, nowActive, btn);

                updateActiveCount(nowActive ? 1 : -1);
                showToast(nowActive ? '✅ Teacher activated!' : '🔴 Teacher deactivated.', nowActive ? 'success' : 'error');
            }
        } catch(e) {
            showToast('Something went wrong.', 'error');
        }

        btn.disabled = false;
    }

    function updateActiveCount(delta) {
        const el = document.getElementById('statActive');
        if (el) el.textContent = Math.max(0, parseInt(el.textContent) + delta);
    }

    function updateAdminCount(delta) {
        const el = document.getElementById('statAdmins');
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

    // ── After teacher created (called from adminlayout after AJAX create) ──
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
            <td><span class="access-code-chip">${accessCode}</span></td>
            <td><span class="badge badge-active" id="badge-${teacher.id}">● Active</span></td>
            <td class="date-cell">${today}</td>
            <td>
                <div class="action-group">
                    <button class="btn-edit"
                        onclick="openEditTeacherModal(${teacher.id}, '${teacher.name.replace(/'/g,"\\'")}', '${teacher.email}', '${teacher.avatar}')">
                        ✏️ Edit
                    </button>
                    <button class="toggle-btn btn-deactivate" id="toggleBtn-${teacher.id}"
                        onclick="toggleTeacher(${teacher.id}, true, this)">
                        Deactivate
                    </button>
                </div>
            </td>`;
        tbody.appendChild(tr);

        const statTeachers = document.getElementById('statTeachers');
        if (statTeachers) statTeachers.textContent = parseInt(statTeachers.textContent) + 1;
        updateActiveCount(1);

        showToast(`✅ Teacher created! Access Code: ${accessCode}`, 'success');
    };

    // ── After admin created (called from adminlayout after AJAX create) ──
    window.onAdminCreated = function(admin, accessCode) {
        const tbody = document.getElementById('adminTableBody');
        const today = new Date().toLocaleDateString('en-US', { month:'short', day:'2-digit', year:'numeric' });

        // If the table doesn't exist yet (was empty-state), rebuild the section.
        if (!tbody) {
            location.reload();
            return;
        }

        const rowNum = tbody.querySelectorAll('tr').length + 1;
        const tr = document.createElement('tr');
        tr.dataset.name  = admin.name.toLowerCase();
        tr.dataset.email = admin.email.toLowerCase();
        tr.dataset.id    = admin.id;
        tr.innerHTML = `
            <td class="row-num">${rowNum}</td>
            <td>
                <div class="admin-name">${admin.name}</div>
                <div class="admin-email">${admin.email}</div>
            </td>
            <td><span class="access-code-chip">${accessCode}</span></td>
            <td class="date-cell">${today}</td>
            <td>
                <div class="action-group">
                    <button class="btn-edit"
                        onclick="openEditAdminModal(${admin.id}, '${admin.name.replace(/'/g,"\\'")}', '${admin.email}')">
                        ✏️ Edit
                    </button>
                </div>
            </td>`;
        tbody.appendChild(tr);

        updateAdminCount(1);
        showToast(`✅ Admin created! Access Code: ${accessCode}`, 'success');
    };

    // ── Edit Teacher Modal ──
    function openEditTeacherModal(id, name, email, avatar) {
        document.getElementById('editTeacherId').value     = id;
        document.getElementById('editTeacherName').value   = name;
        document.getElementById('editTeacherEmail').value  = email;
        document.getElementById('editTeacherAvatar').value = avatar;
        document.getElementById('editTeacherPassword').value = '';
        document.getElementById('editTeacherOverlay').classList.add('open');
    }

    function closeEditTeacherModal(event) {
        if (event && event.target !== document.getElementById('editTeacherOverlay')) return;
        document.getElementById('editTeacherOverlay').classList.remove('open');
    }

    // ── Edit Admin Modal ──
    function openEditAdminModal(id, name, email) {
        document.getElementById('editAdminId').value       = id;
        document.getElementById('editAdminName').value     = name;
        document.getElementById('editAdminEmail').value    = email;
        document.getElementById('editAdminPassword').value = '';

        const deleteBtn = document.getElementById('adminDeleteBtn');
        deleteBtn.style.display = (parseInt(id) === window.CURRENT_ADMIN_ID) ? 'none' : 'inline-block';

        document.getElementById('editAdminOverlay').classList.add('open');
    }

    function closeEditAdminModal(event) {
        if (event && event.target !== document.getElementById('editAdminOverlay')) return;
        document.getElementById('editAdminOverlay').classList.remove('open');
    }

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('editTeacherOverlay').classList.remove('open');
            document.getElementById('editAdminOverlay').classList.remove('open');
        }
    });

    async function saveTeacherEdit() {
        const id       = document.getElementById('editTeacherId').value;
        const name     = document.getElementById('editTeacherName').value.trim();
        const email    = document.getElementById('editTeacherEmail').value.trim();
        const avatar   = document.getElementById('editTeacherAvatar').value;
        const password = document.getElementById('editTeacherPassword').value;

        if (!name || !email) {
            showToast('Name and email are required.', 'error');
            return;
        }

        const saveBtn = document.getElementById('editSaveBtn');
        saveBtn.disabled    = true;
        saveBtn.textContent = 'Saving...';

        try {
            const body = { name, email, avatar };
            if (password) body.password = password;

            const res  = await fetch(`/admin/teacher/${id}/update`, {
                method:  'PATCH',
                headers: {
                    'X-CSRF-TOKEN': window.CSRF,
                    'Accept':       'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body),
            });
            const data = await res.json();

            if (data.success) {
                const teacher = data.teacher;
                const row = document.querySelector(`#teacherTableBody tr[data-id="${id}"]`);

                if (row) {
                    const icons  = { teacher_male:'👨‍🏫', teacher_female:'👩‍🏫', scientist:'🔬', explorer:'🧭' };
                    const labels = { teacher_male:'Male', teacher_female:'Female', scientist:'Scientist', explorer:'Explorer' };

                    row.dataset.name  = teacher.name.toLowerCase();
                    row.dataset.email = teacher.email.toLowerCase();

                    row.querySelector('.teacher-name').textContent  = teacher.name;
                    row.querySelector('.teacher-email').textContent = teacher.email;
                    row.querySelector('.avatar-chip').innerHTML =
                        `${icons[teacher.avatar] ?? '👤'} ${labels[teacher.avatar] ?? teacher.avatar}`;

                    row.querySelector('.btn-edit').setAttribute(
                        'onclick',
                        `openEditTeacherModal(${teacher.id}, '${teacher.name.replace(/'/g,"\\'")}', '${teacher.email}', '${teacher.avatar}')`
                    );
                }

                document.getElementById('editTeacherOverlay').classList.remove('open');
                showToast('✅ Teacher updated successfully!', 'success');
            } else {
                const errors = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : (data.message || 'Update failed.');
                showToast(errors, 'error');
            }
        } catch (e) {
            showToast('Something went wrong.', 'error');
        }

        saveBtn.disabled    = false;
        saveBtn.textContent = 'Save Changes';
    }

    async function saveAdminEdit() {
        const id       = document.getElementById('editAdminId').value;
        const name     = document.getElementById('editAdminName').value.trim();
        const email    = document.getElementById('editAdminEmail').value.trim();
        const password = document.getElementById('editAdminPassword').value;

        if (!name || !email) {
            showToast('Name and email are required.', 'error');
            return;
        }

        const saveBtn = document.getElementById('editAdminSaveBtn');
        saveBtn.disabled    = true;
        saveBtn.textContent = 'Saving...';

        try {
            const body = { name, email };
            if (password) body.password = password;

            const res  = await fetch(`/admin/admin/${id}/update`, {
                method:  'PATCH',
                headers: {
                    'X-CSRF-TOKEN': window.CSRF,
                    'Accept':       'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body),
            });
            const data = await res.json();

            if (data.success) {
                const admin = data.admin;
                const row = document.querySelector(`#adminTableBody tr[data-id="${id}"]`);

                if (row) {
                    row.dataset.name  = admin.name.toLowerCase();
                    row.dataset.email = admin.email.toLowerCase();

                    row.querySelector('.admin-name').textContent  = admin.name;
                    row.querySelector('.admin-email').textContent = admin.email;

                    row.querySelector('.btn-edit').setAttribute(
                        'onclick',
                        `openEditAdminModal(${admin.id}, '${admin.name.replace(/'/g,"\\'")}', '${admin.email}')`
                    );
                }

                document.getElementById('editAdminOverlay').classList.remove('open');
                showToast('✅ Admin updated successfully!', 'success');
            } else {
                const errors = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : (data.message || 'Update failed.');
                showToast(errors, 'error');
            }
        } catch (e) {
            showToast('Something went wrong.', 'error');
        }

        saveBtn.disabled    = false;
        saveBtn.textContent = 'Save Changes';
    }

    async function deleteAdminAccount() {
        const id = document.getElementById('editAdminId').value;

        if (!confirm('Delete this admin account? This cannot be undone.')) return;

        const delBtn = document.getElementById('adminDeleteBtn');
        delBtn.disabled    = true;
        delBtn.textContent = 'Deleting...';

        try {
            const res  = await fetch(`/admin/admin/${id}/delete`, {
                method:  'DELETE',
                headers: { 'X-CSRF-TOKEN': window.CSRF, 'Accept': 'application/json' },
            });
            const data = await res.json();

            if (data.success) {
                const row = document.querySelector(`#adminTableBody tr[data-id="${id}"]`);
                if (row) row.remove();

                updateAdminCount(-1);
                document.getElementById('editAdminOverlay').classList.remove('open');
                showToast('🗑️ Admin account deleted.', 'success');
            } else {
                showToast(data.message || 'Could not delete admin.', 'error');
            }
        } catch (e) {
            showToast('Something went wrong.', 'error');
        }

        delBtn.disabled    = false;
        delBtn.textContent = '🗑️ Delete';
    }
</script>
@endpush
