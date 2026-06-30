@extends('Teachers.teacherslayout')

@section('title', $class->name)
@section('page-title', $class->name)

@push('styles')
<style>
    .back-link { display:inline-flex; align-items:center; gap:6px; color:#3a9e8c; font-weight:700; font-size:0.88rem; text-decoration:none; margin-bottom:20px; transition:gap 0.2s; }
    .back-link:hover { gap:10px; }

    .class-hero { background:linear-gradient(135deg,#1a5a50,#3a9e8c); border-radius:18px; padding:28px 32px; color:#fff; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; }
    .class-hero h2 { font-family:'Baloo 2',cursive; font-size:1.6rem; font-weight:800; margin-bottom:4px; }
    .class-hero p  { font-size:0.9rem; opacity:0.8; }
    .code-display { background:rgba(255,255,255,0.15); border-radius:12px; padding:14px 22px; text-align:center; cursor:pointer; transition:background 0.2s; }
    .code-display:hover { background:rgba(255,255,255,0.25); }
    .code-label { font-size:0.72rem; opacity:0.7; text-transform:uppercase; letter-spacing:1px; margin-bottom:2px; }
    .code-val   { font-family:'Baloo 2',cursive; font-size:1.8rem; font-weight:800; letter-spacing:4px; }
    .code-hint  { font-size:0.7rem; opacity:0.6; margin-top:2px; }

    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:22px; }
    @media(max-width:900px){ .grid-2{grid-template-columns:1fr;} }

    .section-card { background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 16px rgba(0,0,0,0.06); }
    .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; flex-wrap:wrap; gap:10px; }
    .section-header h3 { font-family:'Baloo 2',cursive; font-size:1.05rem; font-weight:800; color:#3d2a1a; }

    .btn { display:inline-flex; align-items:center; gap:6px; padding:9px 16px; border-radius:10px; border:none; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:opacity 0.2s,transform 0.15s; text-decoration:none; }
    .btn:hover { opacity:0.88; transform:translateY(-1px); }
    .btn-teal   { background:#3a9e8c; color:#fff; }
    .btn-orange { background:linear-gradient(135deg,#f0a040,#e07020); color:#fff; }
    .btn-danger { background:#fde8e8; color:#c0392b; font-size:0.78rem; padding:6px 12px; }
    .btn-outline { background:transparent; border:1.5px solid #e0d0ba; color:#5a4030; }
    .btn-outline:hover { border-color:#3a9e8c; color:#3a9e8c; }
    .btn-sm { padding:6px 12px; font-size:0.78rem; }

    /* Students list */
    .student-item { display:flex; align-items:center; justify-content:space-between; padding:11px 0; border-bottom:1px solid #f5ede0; }
    .student-item:last-child { border-bottom:none; }
    .student-left  { display:flex; align-items:center; gap:10px; }
    .student-avatar-chip { width:34px; height:34px; border-radius:50%; background:#e0f5f2; display:flex; align-items:center; justify-content:center; font-size:1rem; }
    .student-name  { font-weight:700; font-size:0.9rem; color:#3d2a1a; }
    .student-joined { font-size:0.75rem; color:#b5a48a; }

    /* Quiz cards */
    .quiz-item { border:1.5px solid #e8dcc8; border-radius:13px; padding:16px; margin-bottom:12px; transition:border-color 0.2s; }
    .quiz-item:last-child { margin-bottom:0; }
    .quiz-item:hover { border-color:#3a9e8c; }
    .quiz-title { font-weight:800; font-size:0.95rem; color:#3d2a1a; margin-bottom:6px; }
    .quiz-meta  { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:10px; }
    .quiz-chip  { font-size:0.72rem; font-weight:700; padding:3px 9px; border-radius:6px; background:#f5f0e8; color:#7a5a30; }
    .quiz-chip.pretest { background:#fff3e0; color:#b05800; }
    .quiz-chip.published { background:#e8f8ed; color:#1a7a38; }
    .quiz-chip.draft    { background:#f5e8e8; color:#9a3030; }
    .quiz-actions { display:flex; gap:8px; flex-wrap:wrap; }

    .empty-state { text-align:center; padding:32px; color:#c0ad90; }
    .empty-state .emoji { font-size:2.2rem; margin-bottom:8px; }

    .toast { position:fixed; bottom:28px; right:28px; padding:13px 20px; border-radius:13px; font-size:0.88rem; font-weight:700; color:#fff; box-shadow:0 6px 24px rgba(0,0,0,0.18); z-index:9999; opacity:0; transform:translateY(12px); transition:opacity 0.3s,transform 0.3s; pointer-events:none; }
    .toast.show { opacity:1; transform:translateY(0); }
    .toast.success { background:linear-gradient(135deg,#4da862,#3a8050); }
    .toast.error   { background:linear-gradient(135deg,#e05050,#c03030); }

    .search-input { padding:8px 14px; border:1.5px solid #e0d0ba; border-radius:9px; font-family:'Nunito',sans-serif; font-size:0.85rem; outline:none; transition:border-color 0.2s; width:180px; }
    .search-input:focus { border-color:#3a9e8c; }

    /* Edit Student Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(20,10,5,0.5); backdrop-filter:blur(6px); z-index:200; align-items:center; justify-content:center; }
    .modal-overlay.active { display:flex; }
    .modal { background:#fff; border-radius:20px; padding:32px 34px; width:min(440px,92vw); box-shadow:0 20px 60px rgba(0,0,0,0.2); position:relative; animation:modalIn 0.3s cubic-bezier(.22,1,.36,1) both; }
    @keyframes modalIn { from{opacity:0;transform:scale(0.92) translateY(16px)} to{opacity:1;transform:scale(1) translateY(0)} }
    .modal-close { position:absolute; top:14px; right:16px; background:none; border:none; font-size:1.2rem; cursor:pointer; color:#9a8060; }
    .modal h2 { font-family:'Baloo 2',cursive; font-size:1.2rem; font-weight:800; margin-bottom:20px; color:#3d2a1a; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:0.84rem; font-weight:700; margin-bottom:6px; color:#5a4030; }
    .form-group input, .form-group textarea, .form-group select { width:100%; padding:11px 14px; border:2px solid #e0d0ba; border-radius:10px; font-family:'Nunito',sans-serif; font-size:0.93rem; outline:none; transition:border-color 0.2s; resize:none; }
    .form-group input:focus, .form-group textarea:focus { border-color:#3a9e8c; }
    .alert { padding:10px 14px; border-radius:10px; font-size:0.87rem; margin-bottom:12px; font-weight:600; display:none; }
    .alert.error   { background:#fde8e8; color:#c0392b; display:block; }
    .alert.success { background:#e8f8ed; color:#1e7a3a; display:block; }
    @keyframes spin{to{transform:rotate(360deg)}}
    .btn-spinner { display:inline-block; width:13px; height:13px; border:2px solid rgba(255,255,255,0.4); border-top-color:#fff; border-radius:50%; animation:spin 0.7s linear infinite; }
</style>
@endpush

@section('content')

<a href="{{ route('teacher.classes') }}" class="back-link">← Back to Classes</a>

{{-- Hero --}}
<div class="class-hero">
    <div>
        <h2>{{ $class->name }}</h2>
        <p>{{ $class->description ?: 'No description.' }} &nbsp;·&nbsp; {{ $class->grade_level }}</p>
    </div>
    <div class="code-display" onclick="copyCode('{{ $class->class_code }}')" title="Click to copy">
        <div class="code-label">Class Code</div>
        <div class="code-val">{{ $class->class_code }}</div>
        <div class="code-hint">Click to copy 📋</div>
    </div>
</div>

<div class="grid-2">

    {{-- Students --}}
    <div class="section-card">
        <div class="section-header">
            <h3>🎒 Students ({{ $class->students->count() }})</h3>
            <input type="text" class="search-input" placeholder="🔍 Search..." oninput="filterStudents(this.value)" />
        </div>

        @if($class->students->isEmpty())
            <div class="empty-state"><div class="emoji">🌱</div><p>No students yet. Share the class code!</p></div>
        @else
            <div id="studentList">
            @foreach($class->students as $student)
            @php
                $icons = ['explorer_boy'=>'🧭','explorer_girl'=>'🗺️','scientist'=>'🔬','adventurer'=>'⚔️'];
            @endphp
            <div class="student-item" data-name="{{ strtolower($student->username) }}" id="si-{{ $student->id }}">
                <div class="student-left">
                    <div class="student-avatar-chip">{{ $icons[$student->avatar??''] ?? '🎒' }}</div>
                    <div>
                        <div class="student-name">{{ $student->username }}</div>
                        <div class="student-joined">Joined {{ \Carbon\Carbon::parse($student->pivot->joined_at)->format('M d, Y') }}</div>
                    </div>
                </div>
                <div style="display:flex; gap:6px;">
                    <button class="btn btn-outline btn-sm" onclick="openEditStudentModal({{ $student->id }}, '{{ addslashes($student->username) }}')">✏️ Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="removeStudent({{ $class->id }}, {{ $student->id }})">Remove</button>
                </div>
            </div>
            @endforeach
            </div>
        @endif
    </div>

    {{-- Quizzes --}}
    <div class="section-card">
        <div class="section-header">
            <h3>🎮 Quizzes & Games</h3>
            <a href="{{ route('teacher.quizzes.create', $class) }}" class="btn btn-orange">+ Add Quiz</a>
        </div>

        @if($class->quizzes->isEmpty())
            <div class="empty-state"><div class="emoji">🎮</div><p>No quizzes yet. Create your first!</p></div>
        @else
            @foreach($class->quizzes as $quiz)
            @php
                $formatIcons = ['mcq'=>'❓','drag_drop'=>'🧲','fill_blank'=>'✏️','word_scramble'=>'🔤'];
                $formatLabels = ['mcq'=>'MCQ','drag_drop'=>'Drag & Drop','fill_blank'=>'Fill Blank','word_scramble'=>'Word Scramble'];
            @endphp
            <div class="quiz-item" id="quizItem-{{ $quiz->id }}">
                <div class="quiz-title">{{ $formatIcons[$quiz->game_format]??'🎮' }} {{ $quiz->title }}</div>
                <div class="quiz-meta">
                    <span class="quiz-chip {{ $quiz->type==='pre_test'?'pretest':'' }}">{{ $quiz->type==='pre_test'?'📋 Pre-Test':'🎯 Quiz' }}</span>
                    <span class="quiz-chip">{{ $formatLabels[$quiz->game_format]??$quiz->game_format }}</span>
                    <span class="quiz-chip">{{ $quiz->questions_count ?? $quiz->questions->count() }} questions</span>
                    <span class="quiz-chip {{ $quiz->is_published?'published':'draft' }}">{{ $quiz->is_published?'● Published':'● Draft' }}</span>
                </div>
                <div class="quiz-actions">
                    <a href="{{ route('teacher.quizzes.edit', $quiz) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
                    <button class="btn btn-outline btn-sm" onclick="togglePublish({{ $quiz->id }}, {{ $quiz->is_published?'true':'false' }}, this)">
                        {{ $quiz->is_published ? '🔒 Unpublish' : '🚀 Publish' }}
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteQuiz({{ $quiz->id }})">🗑️</button>
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>

{{-- Edit Student / Reset Password Modal --}}
<div class="modal-overlay" id="editStudentModal">
    <div class="modal" style="width:min(420px,92vw);">
        <button class="modal-close" onclick="closeModal('editStudentModal')">✕</button>
        <h2 style="margin-bottom:6px;">🔑 Reset Password</h2>
        <p style="font-size:0.88rem; color:#9a8060; margin-bottom:18px;">
            For student: <strong id="esStudentName" style="color:#3d2a1a;"></strong>
        </p>

        <div class="alert" id="editStudentAlert"></div>

        <div id="esResultBox" style="display:none; background:#e8f8ed; border:1.5px solid #b8e6c4; border-radius:12px; padding:14px 16px; margin-bottom:16px;">
            <div style="font-size:0.78rem; font-weight:700; color:#1e7a3a; margin-bottom:4px;">New password (copy this now — it won't be shown again):</div>
            <div style="display:flex; align-items:center; gap:8px;">
                <code id="esNewPasswordText" style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:#1a5a30; background:#fff; padding:6px 10px; border-radius:8px; flex:1;"></code>
                <button class="btn-sm btn-outline" type="button" onclick="copyGeneratedPassword()">📋 Copy</button>
            </div>
        </div>

        <div style="display:flex; gap:8px; margin-bottom:16px;">
            <button type="button" class="btn-sm" id="esTabManual" onclick="switchPasswordTab('manual')" style="flex:1; justify-content:center; background:#3a9e8c; color:#fff; border-radius:9px; padding:8px; border:none;">Type New Password</button>
            <button type="button" class="btn-sm" id="esTabGenerate" onclick="switchPasswordTab('generate')" style="flex:1; justify-content:center; background:transparent; border:1.5px solid #e0d0ba; color:#5a4030; border-radius:9px; padding:8px;">Auto-Generate</button>
        </div>

        <div id="esManualPanel">
            <div class="form-group">
                <label>New Password</label>
                <input type="text" id="esNewPasswordInput" placeholder="Minimum 6 characters" />
            </div>
            <button class="btn btn-green" style="width:100%; justify-content:center;" id="esManualBtn" onclick="submitManualPassword()">💾 Set Password</button>
        </div>

        <div id="esGeneratePanel" style="display:none;">
            <p style="font-size:0.85rem; color:#5a4030; margin-bottom:14px;">
                Generates a random 8-character password for this student. Make sure to copy it and share it with them — it can't be retrieved again later.
            </p>
            <button class="btn btn-orange" style="width:100%; justify-content:center;" id="esGenerateBtn" onclick="generatePassword()">🎲 Generate Password</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function copyCode(code) { navigator.clipboard.writeText(code).then(()=>showToast(`📋 Copied: ${code}`,'success')); }

function filterStudents(q) {
    document.querySelectorAll('#studentList .student-item').forEach(el => {
        el.style.display = el.dataset.name.includes(q.toLowerCase()) ? '' : 'none';
    });
}

async function removeStudent(classId, studentId) {
    if (!confirm('Remove this student from the class?')) return;
    const res  = await fetch(`/teacher/classes/${classId}/students/${studentId}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) { document.getElementById(`si-${studentId}`)?.remove(); showToast('✅ Student removed.','success'); }
}

async function togglePublish(id, isPublished, btn) {
    const res  = await fetch(`/teacher/quizzes/${id}/publish`, { method:'PATCH', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) {
        const now = data.is_published;
        btn.textContent = now ? '🔒 Unpublish' : '🚀 Publish';
        const chip = document.querySelector(`#quizItem-${id} .quiz-chip.published, #quizItem-${id} .quiz-chip.draft`);
        if (chip) { chip.textContent = now?'● Published':'● Draft'; chip.className=`quiz-chip ${now?'published':'draft'}`; }
        showToast(now ? '🚀 Quiz published!' : '🔒 Quiz unpublished.', now?'success':'error');
    }
}

async function deleteQuiz(id) {
    if (!confirm('Delete this quiz? All student scores will also be deleted.')) return;
    const res  = await fetch(`/teacher/quizzes/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) { document.getElementById(`quizItem-${id}`)?.remove(); showToast('🗑️ Quiz deleted.','error'); }
}

let toastTimer;
function showToast(msg,type='success') { const t=document.getElementById('toast'); t.textContent=msg; t.className=`toast ${type} show`; clearTimeout(toastTimer); toastTimer=setTimeout(()=>t.classList.remove('show'),3000); }

function closeModal(id) { document.getElementById(id).classList.remove('active'); }
document.querySelectorAll('.modal-overlay').forEach(el => el.addEventListener('click', e => { if(e.target===el) el.classList.remove('active'); }));

function showAlert(el, type, msg) { el.className = `alert ${type}`; el.textContent = msg; }

/* ---- Edit Student / Reset Password ---- */

let esCurrentStudentId = null;

function openEditStudentModal(studentId, username) {
    esCurrentStudentId = studentId;
    document.getElementById('esStudentName').textContent = username;
    document.getElementById('esNewPasswordInput').value = '';
    document.getElementById('esResultBox').style.display = 'none';
    document.getElementById('editStudentAlert').className = 'alert';
    document.getElementById('editStudentAlert').textContent = '';
    switchPasswordTab('manual');
    document.getElementById('editStudentModal').classList.add('active');
}

function switchPasswordTab(tab) {
    const manualBtn = document.getElementById('esTabManual');
    const generateBtn = document.getElementById('esTabGenerate');
    const manualPanel = document.getElementById('esManualPanel');
    const generatePanel = document.getElementById('esGeneratePanel');

    if (tab === 'manual') {
        manualPanel.style.display = '';
        generatePanel.style.display = 'none';
        manualBtn.style.background = '#3a9e8c';
        manualBtn.style.color = '#fff';
        manualBtn.style.border = 'none';
        generateBtn.style.background = 'transparent';
        generateBtn.style.color = '#5a4030';
        generateBtn.style.border = '1.5px solid #e0d0ba';
    } else {
        manualPanel.style.display = 'none';
        generatePanel.style.display = '';
        generateBtn.style.background = '#3a9e8c';
        generateBtn.style.color = '#fff';
        generateBtn.style.border = 'none';
        manualBtn.style.background = 'transparent';
        manualBtn.style.color = '#5a4030';
        manualBtn.style.border = '1.5px solid #e0d0ba';
    }

    document.getElementById('esResultBox').style.display = 'none';
}

async function submitManualPassword() {
    const input = document.getElementById('esNewPasswordInput');
    const pwd = input.value.trim();
    const btn = document.getElementById('esManualBtn');
    const alertEl = document.getElementById('editStudentAlert');

    if (pwd.length < 6) {
        showAlert(alertEl, 'error', 'Password must be at least 6 characters.');
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Saving...';

    try {
        const res = await fetch(`/teacher/classes/{{ $class->id }}/students/${esCurrentStudentId}/reset-password`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ mode: 'manual', new_password: pwd }),
        });
        const data = await res.json();

        if (data.success) {
            showAlert(alertEl, 'success', '✅ Password updated successfully.');
            input.value = '';
            showToast('🔑 Password updated.', 'success');
        } else {
            showAlert(alertEl, 'error', data.message || 'Could not update password.');
        }
    } catch (e) {
        showAlert(alertEl, 'error', 'Something went wrong.');
    }

    btn.disabled = false;
    btn.textContent = '💾 Set Password';
}

async function generatePassword() {
    const btn = document.getElementById('esGenerateBtn');
    const alertEl = document.getElementById('editStudentAlert');

    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Generating...';

    try {
        const res = await fetch(`/teacher/classes/{{ $class->id }}/students/${esCurrentStudentId}/reset-password`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ mode: 'generate' }),
        });
        const data = await res.json();

        if (data.success) {
            document.getElementById('esNewPasswordText').textContent = data.new_password;
            document.getElementById('esResultBox').style.display = '';
            showAlert(alertEl, 'success', '✅ New password generated.');
            showToast('🔑 Password generated.', 'success');
        } else {
            showAlert(alertEl, 'error', data.message || 'Could not generate password.');
        }
    } catch (e) {
        showAlert(alertEl, 'error', 'Something went wrong.');
    }

    btn.disabled = false;
    btn.textContent = '🎲 Generate Password';
}

function copyGeneratedPassword() {
    const text = document.getElementById('esNewPasswordText').textContent;
    navigator.clipboard.writeText(text).then(() => showToast('📋 Password copied.', 'success'));
}
</script>
@endpush