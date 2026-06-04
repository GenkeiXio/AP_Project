@extends('Students.studentslayout')

@section('title', 'My Classes')

@push('styles')
<style>
    .page-title { font-family:'Baloo 2',cursive; font-size:1.8rem; font-weight:800; color:#3d2a1a; margin-bottom:6px; }
    .page-sub   { color:#9a8060; font-size:0.92rem; margin-bottom:28px; }

    /* Search bar */
    .search-card { background:rgba(255,255,255,0.88); backdrop-filter:blur(12px); border-radius:18px; padding:24px; box-shadow:0 6px 24px rgba(80,50,10,0.1); border:1.5px solid rgba(255,255,255,0.7); margin-bottom:28px; }
    .search-card h3 { font-family:'Baloo 2',cursive; font-size:1.1rem; font-weight:800; color:#3d2a1a; margin-bottom:12px; }
    .search-wrap { display:flex; gap:10px; }
    .search-input { flex:1; padding:13px 18px; border:2px solid #e0d0ba; border-radius:13px; font-family:'Nunito',sans-serif; font-size:0.95rem; outline:none; transition:border-color 0.2s; background:#fff; }
    .search-input:focus { border-color:#6dbf7e; }
    .search-btn { padding:13px 22px; background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; border:none; border-radius:13px; font-family:'Nunito',sans-serif; font-size:0.92rem; font-weight:700; cursor:pointer; transition:opacity 0.2s; }
    .search-btn:hover { opacity:0.88; }

    .search-results { margin-top:14px; }
    .result-item { background:#fff; border:1.5px solid #e8dcc8; border-radius:13px; padding:16px 18px; margin-bottom:10px; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; transition:border-color 0.2s; }
    .result-item:hover { border-color:#6dbf7e; }
    .result-info .rname { font-weight:800; font-size:0.95rem; color:#3d2a1a; }
    .result-info .rmeta { font-size:0.78rem; color:#9a8060; margin-top:2px; }
    .join-btn { padding:9px 18px; background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; border:none; border-radius:10px; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:opacity 0.2s; white-space:nowrap; }
    .join-btn:hover { opacity:0.85; }
    .join-btn:disabled { opacity:0.5; cursor:not-allowed; }

    .no-results { text-align:center; padding:20px; color:#b5a48a; font-size:0.9rem; }

    /* Joined classes */
    .classes-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:18px; }

    .class-card {
        background:rgba(255,255,255,0.88); backdrop-filter:blur(12px);
        border-radius:18px; padding:22px;
        box-shadow:0 6px 20px rgba(80,50,10,0.08);
        border:2px solid rgba(255,255,255,0.7);
        transition:transform 0.2s,box-shadow 0.2s,border-color 0.2s;
        position:relative; overflow:hidden;
    }
    .class-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,#6dbf7e,#e8922a); }
    .class-card:hover { transform:translateY(-3px); box-shadow:0 12px 32px rgba(80,50,10,0.13); border-color:rgba(109,191,126,0.4); }

    .class-title { font-family:'Baloo 2',cursive; font-size:1.15rem; font-weight:800; color:#3d2a1a; margin-bottom:4px; }
    .class-teacher { font-size:0.82rem; color:#9a8060; margin-bottom:12px; }
    .class-meta { display:flex; gap:10px; margin-bottom:14px; flex-wrap:wrap; }
    .meta-chip { font-size:0.75rem; font-weight:700; padding:3px 10px; border-radius:7px; background:rgba(109,191,126,0.15); color:#3d6a40; }

    .class-actions { display:flex; gap:8px; flex-wrap:wrap; }
    .btn-view  { padding:9px 16px; background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; border:none; border-radius:10px; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:5px; transition:opacity 0.2s; }
    .btn-view:hover { opacity:0.88; }
    .btn-leave { padding:9px 14px; background:#fde8e8; color:#c0392b; border:none; border-radius:10px; font-family:'Nunito',sans-serif; font-size:0.82rem; font-weight:700; cursor:pointer; transition:opacity 0.2s; }
    .btn-leave:hover { opacity:0.85; }

    .empty-state { text-align:center; padding:50px 20px; }
    .empty-state .emoji { font-size:3.5rem; margin-bottom:14px; }
    .empty-state h3 { font-family:'Baloo 2',cursive; font-size:1.3rem; color:#3d2a1a; margin-bottom:8px; }
    .empty-state p  { color:#9a8060; font-size:0.9rem; }

    .toast { position:fixed; bottom:28px; right:28px; padding:13px 20px; border-radius:13px; font-size:0.88rem; font-weight:700; color:#fff; box-shadow:0 6px 24px rgba(0,0,0,0.18); z-index:9999; opacity:0; transform:translateY(12px); transition:opacity 0.3s,transform 0.3s; pointer-events:none; }
    .toast.show { opacity:1; transform:translateY(0); }
    .toast.success { background:linear-gradient(135deg,#4da862,#3a8050); }
    .toast.error   { background:linear-gradient(135deg,#e05050,#c03030); }

    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(20,10,5,0.5); backdrop-filter:blur(4px); z-index:200; align-items:center; justify-content:center; }
    .modal-overlay.active { display:flex; }
    .join-modal { display:flex; flex-direction:column; background:#fff; border-radius:20px; padding:28px 26px; width:min(420px,92vw); box-shadow:0 20px 60px rgba(0,0,0,0.18); position:relative; z-index:210; }
    .modal-close { position:absolute; top:14px; right:16px; background:none; border:none; font-size:1.2rem; cursor:pointer; color:#9a8060; }
    .form-group { margin-bottom:16px; }
    .form-group label { display:block; margin-bottom:8px; font-weight:700; color:#5a4030; font-size:0.88rem; }
    .form-group input { width:100%; padding:12px 14px; border:2px solid #e0d0ba; border-radius:12px; font-family:'Nunito',sans-serif; font-size:0.95rem; transition:border-color 0.2s; }
    .form-group input:focus { border-color:#6dbf7e; outline:none; }

    @keyframes spin{to{transform:rotate(360deg)}}
    .btn-spinner { display:inline-block; width:13px; height:13px; border:2px solid rgba(255,255,255,0.4); border-top-color:#fff; border-radius:50%; animation:spin 0.7s linear infinite; }
</style>
@endpush

@section('content')

<div class="page-title">🏫 My Classes</div>
<div class="page-sub">Join a class using the class name or code, then play quizzes your teacher has set!</div>

{{-- Search & Join --}}
<div class="search-card">
    <h3>🔍 Find & Join a Class</h3>
    <div class="search-wrap">
        <input type="text" class="search-input" id="classSearch" placeholder="Search by class name or enter class code..." oninput="searchClasses()" />
    </div>
    <div class="search-results" id="searchResults">
        @if(isset($availableClasses) && $availableClasses->isNotEmpty())
            @foreach($availableClasses as $class)
                <div class="result-item">
                    <div class="result-info">
                        <div class="rname">🏫 {{ $class->name }}</div>
                        <div class="rmeta">👩‍🏫 {{ $class->teacher->name ?? 'Teacher' }} · 🎒 {{ $class->students_count }} students · {{ $class->grade_level ?? 'Grade 10' }}</div>
                    </div>
                    <button class="join-btn" type="button" data-class-id="{{ $class->id }}" data-class-name="{{ $class->name }}" onclick="openJoinModalFromButton(this)">+ Join</button>
                </div>
            @endforeach
        @else
            <div class="no-results">No classes found. Try a different name or class code.</div>
        @endif
    </div>
</div>

{{-- Join Modal --}}
<div class="modal-overlay" id="joinModal">
    <div class="join-modal">
        <button class="modal-close" onclick="closeModal('joinModal')">✕</button>
        <h2>🔑 Join Class</h2>
        <p id="joinModalText" style="margin-bottom:14px;color:#5a4030;font-size:0.95rem;"></p>
        <div class="form-group">
            <label>Class Code</label>
            <input type="text" id="joinCode" placeholder="Enter class code" />
        </div>
        <button class="btn btn-green" style="width:100%;justify-content:center;" id="joinSubmitBtn" onclick="submitJoin()">✅ Join Class</button>
    </div>
</div>

{{-- Joined Classes --}}
<div style="margin-bottom:16px;">
    <div class="page-title" style="font-size:1.3rem;">📚 Joined Classes ({{ $joinedClasses->count() }})</div>
</div>

@if($joinedClasses->isEmpty())
    <div class="empty-state">
        <div class="emoji">🏫</div>
        <h3>No classes yet!</h3>
        <p>Search for your class above and join to access quizzes and games.</p>
    </div>
@else
    <div class="classes-grid" id="classesGrid">
        @foreach($joinedClasses as $class)
        <div class="class-card" id="cc-{{ $class->id }}">
            <div class="class-title">{{ $class->name }}</div>
            <div class="class-teacher">👩‍🏫 {{ $class->teacher->name ?? 'Unknown Teacher' }}</div>
            <div class="class-meta">
                <span class="meta-chip">🎒 {{ $class->students_count }} students</span>
                <span class="meta-chip">📚 {{ $class->grade_level ?? 'Grade 10' }}</span>
            </div>
            <div class="class-actions">
                <a href="{{ route('student.class.detail', $class) }}" class="btn-view">👁️ View Class</a>
                <button class="btn-leave" onclick="leaveClass({{ $class->id }})">Leave</button>
            </div>
        </div>
        @endforeach
    </div>
@endif

<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let searchTimer;

function searchClasses() {
    const q = document.getElementById('classSearch').value.trim();
    clearTimeout(searchTimer);
    searchTimer = setTimeout(async () => {
        try {
            const res  = await fetch(`{{ route('student.classes.search') }}?q=${encodeURIComponent(q)}`);
            const data = await res.json();
            renderResults(data);
        } catch(e) {
            document.getElementById('searchResults').innerHTML = '<div class="no-results">Unable to load classes right now.</div>';
        }
    }, 300);
}

window.addEventListener('DOMContentLoaded', () => {
    searchClasses();
});

function renderResults(classes) {
    const el = document.getElementById('searchResults');
    if (!classes.length) {
        el.innerHTML = '<div class="no-results">No classes found. Try a different name or class code.</div>';
        return;
    }

    el.innerHTML = '';
    classes.forEach(c => {
        const item = document.createElement('div');
        item.className = 'result-item';

        const info = document.createElement('div');
        info.className = 'result-info';

        const name = document.createElement('div');
        name.className = 'rname';
        name.textContent = `🏫 ${c.name}`;

        const meta = document.createElement('div');
        meta.className = 'rmeta';
        const teacherName = c.teacher && c.teacher.name ? c.teacher.name : '?';
        const gradeLabel = c.grade_level ? c.grade_level : 'Grade 10';
        meta.textContent = '👩‍🏫 ' + teacherName + ' · 🎒 ' + (c.students_count || 0) + ' students · ' + gradeLabel;

        info.appendChild(name);
        info.appendChild(meta);

        const button = document.createElement('button');
        button.className = 'join-btn';
        button.textContent = '+ Join';
        button.type = 'button';
        button.addEventListener('click', () => openJoinModal(c.id, c.name));

        item.appendChild(info);
        item.appendChild(button);
        el.appendChild(item);
    });
}

let selectedClassId = null;

function openJoinModal(classId, className) {
    selectedClassId = classId;
    document.getElementById('joinModalText').textContent = 'Enter the class code for "' + className + '" to join.';
    document.getElementById('joinCode').value = '';
    document.getElementById('joinSubmitBtn').disabled = false;
    document.getElementById('joinModal').classList.add('active');
    setTimeout(function() { document.getElementById('joinCode').focus(); }, 120);
}

function openJoinModalFromButton(button) {
    openJoinModal(button.dataset.classId, button.dataset.className);
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}

document.getElementById('joinModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal('joinModal');
    }
});

async function submitJoin() {
    const codeInput = document.getElementById('joinCode');
    const code = codeInput.value.trim();
    const btn = document.getElementById('joinSubmitBtn');

    if (!code) {
        showToast('Please enter the class code.','error');
        codeInput.focus();
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Joining...';

    try {
        const res = await fetch('{{ route("student.classes.join") }}', {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
            body: JSON.stringify({ class_code: code }),
        });
        const data = await res.json();

        if (data.success) {
            showToast('✅ Joined class!','success');
            closeModal('joinModal');
            setTimeout(() => location.reload(), 900);
        } else {
            showToast(data.message || 'Could not join class.','error');
            btn.disabled = false;
            btn.textContent = '✅ Join Class';
        }
    } catch (e) {
        showToast('Unable to join class right now.','error');
        btn.disabled = false;
        btn.textContent = '✅ Join Class';
    }
}

async function leaveClass(id) {
    if (!confirm('Leave this class? You can rejoin anytime.')) return;
    const res  = await fetch(`/student/classes/${id}/leave`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) { document.getElementById(`cc-${id}`)?.remove(); showToast('👋 Left class.','error'); }
}

let toastTimer;
function showToast(msg,type='success') { const t=document.getElementById('toast'); t.textContent=msg; t.className=`toast ${type} show`; clearTimeout(toastTimer); toastTimer=setTimeout(()=>t.classList.remove('show'),3000); }
</script>
@endpush
