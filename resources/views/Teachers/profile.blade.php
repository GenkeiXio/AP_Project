@extends('Teachers.teacherslayout')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@push('styles')
<style>
    .profile-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media(max-width: 900px) { .profile-layout { grid-template-columns: 1fr; } }

    /* ── Left: Avatar Card ── */
    .avatar-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px 22px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        text-align: center;
        position: sticky;
        top: 90px;
    }

    .current-avatar {
        width: 100px; height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0f5f2, #c0ece6);
        display: flex; align-items: center; justify-content: center;
        font-size: 3.2rem;
        margin: 0 auto 14px;
        border: 4px solid #a0e6d8;
        box-shadow: 0 6px 20px rgba(58,158,140,0.2);
        transition: transform 0.3s;
    }
    .current-avatar:hover { transform: scale(1.06); }

    .teacher-display-name { font-family: 'Baloo 2', cursive; font-size: 1.2rem; font-weight: 800; color: #3d2a1a; margin-bottom: 2px; }
    .teacher-display-role { font-size: 0.82rem; color: #9a8060; margin-bottom: 18px; }

    .gender-toggle { display: flex; gap: 8px; justify-content: center; margin-bottom: 20px; }
    .gender-btn {
        flex: 1; padding: 10px 8px; border: 2px solid #e0d0ba; border-radius: 11px;
        background: #fff; cursor: pointer; font-family: 'Nunito', sans-serif;
        font-size: 0.85rem; font-weight: 700; color: #9a8060;
        transition: border-color 0.2s, background 0.2s, color 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .gender-btn.active { border-color: #3a9e8c; background: #e0f5f2; color: #1a5a50; }
    .gender-btn:hover:not(.active) { border-color: #3a9e8c; }

    .section-label { font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #9a8060; margin-bottom: 10px; text-align: left; }

    /* Avatar grid */
    .avatar-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
    .av-opt {
        border: 2.5px solid #e8dcc8; border-radius: 13px; padding: 12px 8px;
        text-align: center; cursor: pointer;
        transition: border-color 0.2s, transform 0.15s, background 0.2s;
        background: #fdfaf5;
    }
    .av-opt:hover { border-color: #3a9e8c; transform: scale(1.04); background: #f0faf8; }
    .av-opt.selected { border-color: #3a9e8c; background: #e0f5f2; }
    .av-opt .av-emoji { font-size: 2rem; display: block; margin-bottom: 4px; }
    .av-opt .av-name  { font-size: 0.72rem; font-weight: 700; color: #5a4030; }

    .btn-save-avatar {
        width: 100%; padding: 12px; background: linear-gradient(135deg, #3a9e8c, #2a7a6c);
        color: #fff; border: none; border-radius: 11px;
        font-family: 'Baloo 2', cursive; font-size: 0.95rem; font-weight: 700;
        cursor: pointer; transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 3px 12px rgba(58,158,140,0.3);
    }
    .btn-save-avatar:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(58,158,140,0.38); }

    /* ── Right: Info sections ── */
    .section-card {
        background: #fff; border-radius: 18px; padding: 26px 28px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06); margin-bottom: 20px;
    }
    .section-card h2 {
        font-family: 'Baloo 2', cursive; font-size: 1.1rem; font-weight: 800;
        color: #3d2a1a; margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
        padding-bottom: 14px; border-bottom: 2px solid #f0e8d8;
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width: 600px) { .form-row { grid-template-columns: 1fr; } }

    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 0.82rem; font-weight: 800; color: #9a8060; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 7px; }
    .form-group input, .form-group textarea, .form-group select {
        width: 100%; padding: 11px 14px; border: 2px solid #e0d0ba; border-radius: 11px;
        font-family: 'Nunito', sans-serif; font-size: 0.92rem; color: #3d2a1a;
        outline: none; transition: border-color 0.2s, box-shadow 0.2s; resize: none;
        background: #fff;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
        border-color: #3a9e8c; box-shadow: 0 0 0 3px rgba(58,158,140,0.12);
    }
    .form-group textarea { line-height: 1.5; }
    .char-count { font-size: 0.72rem; color: #b5a48a; text-align: right; margin-top: 4px; }

    .btn-submit {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 26px; border: none; border-radius: 11px;
        font-family: 'Nunito', sans-serif; font-size: 0.92rem; font-weight: 700;
        cursor: pointer; transition: opacity 0.2s, transform 0.15s;
    }
    .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-teal   { background: linear-gradient(135deg, #3a9e8c, #2a7a6c); color: #fff; box-shadow: 0 3px 12px rgba(58,158,140,0.28); }
    .btn-orange { background: linear-gradient(135deg, #f0a040, #e07020); color: #fff; box-shadow: 0 3px 12px rgba(224,112,32,0.28); }
    .btn-submit:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }

    .alert { padding: 11px 16px; border-radius: 11px; font-size: 0.87rem; font-weight: 600; margin-top: 14px; display: none; }
    .alert.success { background: #e8f8ed; color: #1e7a3a; border: 1.5px solid #b8e0c4; display: block; }
    .alert.error   { background: #fde8e8; color: #c0392b; border: 1.5px solid #f5c6cb; display: block; }

    /* Stats row */
    .stats-mini { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 20px; }
    .stat-mini { background: #f8f4ee; border-radius: 13px; padding: 14px; text-align: center; }
    .stat-mini .sv { font-family: 'Baloo 2', cursive; font-size: 1.5rem; font-weight: 800; color: #3d2a1a; line-height: 1; }
    .stat-mini .sl { font-size: 0.72rem; color: #9a8060; font-weight: 600; margin-top: 2px; }

    /* Password strength */
    .pw-strength { height: 5px; border-radius: 3px; margin-top: 6px; transition: width 0.3s, background 0.3s; background: #e0d0ba; }
    .pw-fill     { height: 100%; border-radius: 3px; transition: width 0.3s, background 0.3s; }

    @keyframes spin { to { transform: rotate(360deg); } }
    .btn-spinner { display: inline-block; width: 14px; height: 14px; border: 2px solid rgba(255,255,255,0.4); border-top-color: #fff; border-radius: 50%; animation: spin 0.7s linear infinite; }

    .toast { position: fixed; bottom: 28px; right: 28px; padding: 13px 22px; border-radius: 13px; font-size: 0.9rem; font-weight: 700; color: #fff; box-shadow: 0 6px 24px rgba(0,0,0,0.18); z-index: 9999; opacity: 0; transform: translateY(12px); transition: opacity 0.3s, transform 0.3s; pointer-events: none; }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: linear-gradient(135deg, #3a9e8c, #2a7a6c); }
    .toast.error   { background: linear-gradient(135deg, #e05050, #c03030); }
</style>
@endpush

@section('content')

@php
    $totalClasses  = $teacher->classes()->count();
    $totalStudents = $teacher->classes()->withCount('students')->get()->sum('students_count');
    $totalQuizzes  = \App\Models\Quiz::where('teacher_id', $teacher->id)->count();

    // Avatar map based on gender
    $gender = $teacher->gender ?? 'male';
    $avatarOptions = [
        ['key' => 'teacher_male',   'emoji_m' => '👨‍🏫', 'emoji_f' => '👩‍🏫', 'name' => 'Teacher'],
        ['key' => 'teacher_female', 'emoji_m' => '👨‍🏫', 'emoji_f' => '👩‍🏫', 'name' => 'Teacher Alt'],
        ['key' => 'scientist',      'emoji_m' => '👨‍🔬', 'emoji_f' => '👩‍🔬', 'name' => 'Scientist'],
        ['key' => 'explorer',       'emoji_m' => '🧭',   'emoji_f' => '🧭',   'name' => 'Explorer'],
    ];
    $currentEmoji = match($teacher->avatar) {
        'teacher_male'   => $gender === 'female' ? '👩‍🏫' : '👨‍🏫',
        'teacher_female' => $gender === 'female' ? '👩‍🏫' : '👨‍🏫',
        'scientist'      => $gender === 'female' ? '👩‍🔬' : '👨‍🔬',
        'explorer'       => '🧭',
        default          => '👤',
    };
@endphp

<div class="profile-layout">

    {{-- ── LEFT: Avatar Card ── --}}
    <div>
        <div class="avatar-card">
            <div class="current-avatar" id="previewAvatar">{{ $currentEmoji }}</div>
            <div class="teacher-display-name">{{ $teacher->name }}</div>
            <div class="teacher-display-role">{{ $teacher->subject_specialization ?? 'Teacher' }}</div>

            {{-- Gender Toggle --}}
            <div class="section-label">I am a...</div>
            <div class="gender-toggle" id="genderToggle">
                <button type="button" class="gender-btn {{ $gender === 'male' ? 'active' : '' }}" onclick="setGender('male', this)">
                    👨 Male
                </button>
                <button type="button" class="gender-btn {{ $gender === 'female' ? 'active' : '' }}" onclick="setGender('female', this)">
                    👩 Female
                </button>
            </div>

            {{-- Avatar Options --}}
            <div class="section-label">Choose Avatar</div>
            <div class="avatar-grid" id="avatarGrid">
                @foreach($avatarOptions as $av)
                <div class="av-opt {{ $teacher->avatar === $av['key'] ? 'selected' : '' }}"
                     data-key="{{ $av['key'] }}"
                     data-emoji-m="{{ $av['emoji_m'] }}"
                     data-emoji-f="{{ $av['emoji_f'] }}"
                     onclick="selectAvatar('{{ $av['key'] }}', this)">
                    <span class="av-emoji" id="avEmoji-{{ $av['key'] }}">
                        {{ $gender === 'female' ? $av['emoji_f'] : $av['emoji_m'] }}
                    </span>
                    <div class="av-name">{{ $av['name'] }}</div>
                </div>
                @endforeach
            </div>

            <button class="btn-save-avatar" onclick="saveAvatar()">💾 Save Avatar</button>
            <div class="alert" id="avatarAlert" style="margin-top:12px;"></div>
        </div>
    </div>

    {{-- ── RIGHT: Info sections ── --}}
    <div>

        {{-- Stats --}}
        <div class="stats-mini">
            <div class="stat-mini">
                <div class="sv">{{ $totalClasses }}</div>
                <div class="sl">🏫 Classes</div>
            </div>
            <div class="stat-mini">
                <div class="sv">{{ $totalStudents }}</div>
                <div class="sl">🎒 Students</div>
            </div>
            <div class="stat-mini">
                <div class="sv">{{ $totalQuizzes }}</div>
                <div class="sl">🎮 Quizzes</div>
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="section-card">
            <h2>👤 Personal Information</h2>
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" id="infoName" value="{{ $teacher->name }}" placeholder="Your full name" maxlength="100" />
                </div>
                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" id="infoEmail" value="{{ $teacher->email }}" placeholder="your@email.com" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Subject Specialization</label>
                    <input type="text" id="infoSubject" value="{{ $teacher->subject_specialization ?? '' }}" placeholder="e.g. Araling Panlipunan" maxlength="100" />
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" id="infoPhone" value="{{ $teacher->phone ?? '' }}" placeholder="e.g. 09XX XXX XXXX" maxlength="20" />
                </div>
            </div>
            <div class="form-group">
                <label>School Name</label>
                <input type="text" id="infoSchool" value="{{ $teacher->school_name ?? '' }}" placeholder="Your school or institution" maxlength="150" />
            </div>
            <div class="form-group">
                <label>Bio / About Me</label>
                <textarea id="infoBio" rows="3" maxlength="500" placeholder="Tell your students a little about yourself..." oninput="updateCharCount(this, 'bioCount', 500)">{{ $teacher->bio ?? '' }}</textarea>
                <div class="char-count"><span id="bioCount">{{ strlen($teacher->bio ?? '') }}</span>/500</div>
            </div>
            <button class="btn-submit btn-teal" id="infoBtn" onclick="saveInfo()">
                💾 Save Information
            </button>
            <div class="alert" id="infoAlert"></div>
        </div>

        {{-- Change Password --}}
        <div class="section-card">
            <h2>🔒 Change Password</h2>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" id="pwCurrent" placeholder="Enter your current password" />
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="pwNew" placeholder="Min. 8 characters" oninput="checkStrength(this.value)" />
                    <div class="pw-strength"><div class="pw-fill" id="pwBar" style="width:0%; background:#e0d0ba;"></div></div>
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" id="pwConfirm" placeholder="Repeat new password" />
                </div>
            </div>
            <button class="btn-submit btn-orange" id="pwBtn" onclick="savePassword()">
                🔑 Change Password
            </button>
            <div class="alert" id="pwAlert"></div>
        </div>

        {{-- Account Info (read-only) --}}
        <div class="section-card">
            <h2>ℹ️ Account Details</h2>
            <div class="form-row">
                <div class="form-group">
                    <label>Account Created</label>
                    <input type="text" value="{{ $teacher->created_at->format('F d, Y') }}" readonly style="background:#f8f4ee; color:#9a8060; cursor:default;" />
                </div>
                <div class="form-group">
                    <label>Account Status</label>
                    <input type="text" value="{{ $teacher->is_active ? '✅ Active' : '❌ Inactive' }}" readonly style="background:#f8f4ee; color:{{ $teacher->is_active ? '#1e7a3a' : '#c0392b' }}; cursor:default; font-weight:700;" />
                </div>
            </div>
            <div class="form-group">
                <label>Access Code (used for login)</label>
                <input type="text" id="accessCodeField" value="••••••" readonly style="background:#f8f4ee; font-family:monospace; font-size:1.1rem; letter-spacing:4px; cursor:pointer;" onclick="toggleAccessCode(this)" title="Click to reveal" />
                <div class="char-count">Click to reveal / hide your access code</div>
            </div>
        </div>

    </div>
</div>

<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
const realAccessCode = '{{ $teacher->access_code }}';

let selectedAvatar = '{{ $teacher->avatar ?? "teacher_male" }}';
let selectedGender  = '{{ $teacher->gender ?? "male" }}';

// ── Gender toggle ──
function setGender(gender, btn) {
    selectedGender = gender;
    document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateAllAvatarEmojis();
    updatePreview();
}

function updateAllAvatarEmojis() {
    document.querySelectorAll('.av-opt').forEach(el => {
        const emoji = selectedGender === 'female' ? el.dataset.emojiF : el.dataset.emojiM;
        el.querySelector('.av-emoji').textContent = emoji;
    });
}

// ── Avatar select ──
function selectAvatar(key, el) {
    document.querySelectorAll('.av-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    selectedAvatar = key;
    updatePreview();
}

function updatePreview() {
    const el   = document.querySelector(`.av-opt[data-key="${selectedAvatar}"]`);
    const emoji = el ? (selectedGender === 'female' ? el.dataset.emojiF : el.dataset.emojiM) : '👤';
    document.getElementById('previewAvatar').textContent = emoji;
}

// ── Save avatar ──
async function saveAvatar() {
    const alert = document.getElementById('avatarAlert');
    try {
        const res  = await fetch('{{ route("teacher.profile.avatar") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ avatar: selectedAvatar }),
        });
        const data = await res.json();
        if (data.success) {
            showToast('✅ Avatar updated!', 'success');
            showAlert(alert, 'success', '✅ Avatar saved!');
            // Also update gender via info save
            saveGenderSilently();
        } else {
            showAlert(alert, 'error', data.message || 'Error saving avatar.');
        }
    } catch(e) {
        showAlert(alert, 'error', 'Something went wrong.');
    }
}

async function saveGenderSilently() {
    // Save gender alongside avatar — piggyback on info update
    const name    = document.getElementById('infoName').value.trim();
    const email   = document.getElementById('infoEmail').value.trim();
    if (!name || !email) return;
    await fetch('{{ route("teacher.profile.info") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({
            name, email, gender: selectedGender,
            subject_specialization: document.getElementById('infoSubject').value.trim(),
            phone: document.getElementById('infoPhone').value.trim(),
            school_name: document.getElementById('infoSchool').value.trim(),
            bio: document.getElementById('infoBio').value.trim(),
        }),
    });
}

// ── Save info ──
async function saveInfo() {
    const btn   = document.getElementById('infoBtn');
    const alert = document.getElementById('infoAlert');
    const body  = {
        name:                    document.getElementById('infoName').value.trim(),
        email:                   document.getElementById('infoEmail').value.trim(),
        gender:                  selectedGender,
        subject_specialization:  document.getElementById('infoSubject').value.trim(),
        phone:                   document.getElementById('infoPhone').value.trim(),
        school_name:             document.getElementById('infoSchool').value.trim(),
        bio:                     document.getElementById('infoBio').value.trim(),
    };

    if (!body.name || !body.email) { showAlert(alert, 'error', 'Name and email are required.'); return; }

    btn.disabled = true; btn.innerHTML = '<span class="btn-spinner"></span> Saving...';
    try {
        const res  = await fetch('{{ route("teacher.profile.info") }}', {
            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify(body),
        });
        const data = await res.json();
        if (data.success) { showToast('✅ Profile updated!', 'success'); showAlert(alert, 'success', '✅ Information saved successfully!'); }
        else { showAlert(alert, 'error', data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Error saving.')); }
    } catch(e) { showAlert(alert, 'error', 'Something went wrong.'); }
    btn.disabled = false; btn.innerHTML = '💾 Save Information';
}

// ── Change password ──
async function savePassword() {
    const btn   = document.getElementById('pwBtn');
    const alert = document.getElementById('pwAlert');
    const curr  = document.getElementById('pwCurrent').value;
    const newPw = document.getElementById('pwNew').value;
    const conf  = document.getElementById('pwConfirm').value;

    if (!curr || !newPw || !conf) { showAlert(alert, 'error', 'Please fill in all password fields.'); return; }
    if (newPw.length < 8)         { showAlert(alert, 'error', 'New password must be at least 8 characters.'); return; }
    if (newPw !== conf)            { showAlert(alert, 'error', 'Passwords do not match.'); return; }

    btn.disabled = true; btn.innerHTML = '<span class="btn-spinner"></span> Changing...';
    try {
        const res  = await fetch('{{ route("teacher.profile.password") }}', {
            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ current_password: curr, new_password: newPw, new_password_confirmation: conf }),
        });
        const data = await res.json();
        if (data.success) {
            showToast('🔑 Password changed!', 'success');
            showAlert(alert, 'success', '✅ Password changed successfully!');
            document.getElementById('pwCurrent').value = '';
            document.getElementById('pwNew').value     = '';
            document.getElementById('pwConfirm').value = '';
            document.getElementById('pwBar').style.width = '0%';
        } else {
            showAlert(alert, 'error', data.message || 'Error changing password.');
        }
    } catch(e) { showAlert(alert, 'error', 'Something went wrong.'); }
    btn.disabled = false; btn.innerHTML = '🔑 Change Password';
}

// ── Password strength ──
function checkStrength(pw) {
    const bar = document.getElementById('pwBar');
    let score = 0;
    if (pw.length >= 8)          score++;
    if (/[A-Z]/.test(pw))        score++;
    if (/[0-9]/.test(pw))        score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    const colors = ['#e05050','#e8922a','#f0c040','#4da862'];
    const widths = ['25%','50%','75%','100%'];
    bar.style.width      = score ? widths[score-1] : '0%';
    bar.style.background = score ? colors[score-1] : '#e0d0ba';
}

// ── Access code reveal ──
let codeVisible = false;
function toggleAccessCode(el) {
    codeVisible = !codeVisible;
    el.value = codeVisible ? realAccessCode : '••••••';
}

// ── Helpers ──
function updateCharCount(el, countId, max) {
    document.getElementById(countId).textContent = el.value.length;
}

let toastTimer;
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg; t.className = `toast ${type} show`;
    clearTimeout(toastTimer); toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
}
function showAlert(el, type, msg) { el.className = `alert ${type}`; el.textContent = msg; }
</script>
@endpush
