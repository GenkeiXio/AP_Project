@extends('Teachers.teacherslayout')

@section('title', 'My Classes')
@section('page-title', 'My Classes')

@push('styles')
<style>
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
    .page-header h2 { font-family:'Baloo 2',cursive; font-size:1.4rem; font-weight:800; color:#3d2a1a; }

    .classes-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; }

    .class-card {
        background:#fff; border-radius:18px; padding:24px;
        box-shadow:0 4px 16px rgba(0,0,0,0.07);
        border:2px solid transparent;
        transition:border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        position:relative; overflow:hidden;
    }
    .class-card:hover { border-color:#3a9e8c; transform:translateY(-3px); box-shadow:0 10px 28px rgba(0,0,0,0.1); }
    .class-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,#3a9e8c,#6dbf7e); }

    .class-code-chip {
        display:inline-flex; align-items:center; gap:6px;
        background:#e0f5f2; border-radius:8px; padding:5px 12px;
        font-size:1rem; font-weight:800; color:#1a5a50;
        font-family:'Baloo 2',cursive; letter-spacing:2px;
        margin-bottom:14px; cursor:pointer;
        transition:background 0.2s;
    }
    .class-code-chip:hover { background:#c0ece6; }

    .class-title { font-family:'Baloo 2',cursive; font-size:1.25rem; font-weight:800; color:#3d2a1a; margin-bottom:4px; }
    .class-desc  { font-size:0.85rem; color:#9a8060; margin-bottom:14px; min-height:20px; }

    .class-meta { display:flex; gap:14px; margin-bottom:16px; flex-wrap:wrap; }
    .meta-chip { display:inline-flex; align-items:center; gap:5px; font-size:0.78rem; font-weight:700; color:#5a4030; background:#f5f0e8; border-radius:8px; padding:4px 10px; }

    .class-actions { display:flex; gap:8px; flex-wrap:wrap; }
    .btn-sm { padding:7px 14px; border-radius:9px; border:none; font-family:'Nunito',sans-serif; font-size:0.8rem; font-weight:700; cursor:pointer; transition:opacity 0.2s,transform 0.15s; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
    .btn-sm:hover { opacity:0.85; transform:translateY(-1px); }
    .btn-teal   { background:#3a9e8c; color:#fff; }
    .btn-outline { background:transparent; border:1.5px solid #e0d0ba; color:#5a4030; }
    .btn-outline:hover { border-color:#3a9e8c; color:#3a9e8c; }
    .btn-danger { background:#fde8e8; color:#c0392b; }

    .empty-state { text-align:center; padding:60px 20px; }
    .empty-state .emoji { font-size:4rem; margin-bottom:16px; }
    .empty-state h3 { font-family:'Baloo 2',cursive; font-size:1.4rem; color:#3d2a1a; margin-bottom:8px; }
    .empty-state p  { color:#9a8060; font-size:0.9rem; margin-bottom:20px; }

    .btn { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:11px; border:none; font-family:'Nunito',sans-serif; font-size:0.92rem; font-weight:700; cursor:pointer; transition:opacity 0.2s,transform 0.15s; }
    .btn:hover { opacity:0.88; transform:translateY(-1px); }
    .btn-green { background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; box-shadow:0 3px 12px rgba(77,168,98,0.3); }

    /* Modal */
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
    .btn-spinner { display:inline-block; width:14px; height:14px; border:2px solid rgba(255,255,255,0.4); border-top-color:#fff; border-radius:50%; animation:spin 0.7s linear infinite; }

    .toast { position:fixed; bottom:28px; right:28px; padding:13px 20px; border-radius:13px; font-size:0.88rem; font-weight:700; color:#fff; box-shadow:0 6px 24px rgba(0,0,0,0.18); z-index:9999; opacity:0; transform:translateY(12px); transition:opacity 0.3s,transform 0.3s; pointer-events:none; }
    .toast.show { opacity:1; transform:translateY(0); }
    .toast.success { background:linear-gradient(135deg,#4da862,#3a8050); }
    .toast.error   { background:linear-gradient(135deg,#e05050,#c03030); }
</style>
@endpush

@section('content')

<div class="page-header">
    <h2>🏫 My Classes <span style="font-size:0.9rem;color:#9a8060;font-weight:600;">({{ $classes->count() }})</span></h2>
    <button class="btn btn-green" onclick="openCreateModal()">+ Create Class</button>
</div>

@if($classes->isEmpty())
    <div class="empty-state">
        <div class="emoji">🏫</div>
        <h3>No classes yet</h3>
        <p>Create your first class and start adding students and quizzes!</p>
        <button class="btn btn-green" onclick="openCreateModal()">+ Create My First Class</button>
    </div>
@else
    <div class="classes-grid">
        @foreach($classes as $class)
        <div class="class-card" id="classCard-{{ $class->id }}">
            <div class="class-code-chip" onclick="copyCode('{{ $class->class_code }}')" title="Click to copy class code">
                🔑 {{ $class->class_code }}
            </div>
            <div class="class-title">{{ $class->name }}</div>
            <div class="class-desc">{{ $class->description ?: 'No description.' }}</div>
            <div class="class-meta">
                <span class="meta-chip">🎒 {{ $class->students_count }} students</span>
                <span class="meta-chip">🎮 {{ $class->quizzes->count() }} quizzes</span>
                <span class="meta-chip">📚 {{ $class->grade_level }}</span>
            </div>
            <div class="class-actions">
                <a href="{{ route('teacher.classes.show', $class) }}" class="btn-sm btn-teal">👁️ View</a>
                <button class="btn-sm btn-outline" onclick="openEditModal({{ $class->id }}, '{{ addslashes($class->name) }}', '{{ addslashes($class->description) }}', '{{ $class->grade_level }}')">✏️ Edit</button>
                <button class="btn-sm btn-outline" onclick="regenerateCode({{ $class->id }})">🔄 New Code</button>
                <button class="btn-sm btn-danger" onclick="deleteClass({{ $class->id }})">🗑️</button>
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- Create Modal --}}
<div class="modal-overlay" id="createModal">
    <div class="modal">
        <button class="modal-close" onclick="closeModal('createModal')">✕</button>
        <h2>🏫 Create New Class</h2>
        <div class="alert" id="createAlert"></div>
        <div class="form-group"><label>Class Name *</label><input type="text" id="cName" placeholder="e.g. Section A – AP 10" /></div>
        <div class="form-group"><label>Description</label><textarea id="cDesc" rows="2" placeholder="Optional description..."></textarea></div>
        <div class="form-group"><label>Grade Level</label>
            <select id="cGrade">
                <option value="Grade 10">Grade 10</option>
                <option value="Grade 9">Grade 9</option>
                <option value="Grade 8">Grade 8</option>
                <option value="Grade 7">Grade 7</option>
            </select>
        </div>
        <button class="btn btn-green" style="width:100%;justify-content:center;" id="createBtn" onclick="submitCreate()">✅ Create Class</button>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
    <div class="modal">
        <button class="modal-close" onclick="closeModal('editModal')">✕</button>
        <h2>✏️ Edit Class</h2>
        <div class="alert" id="editAlert"></div>
        <input type="hidden" id="editId" />
        <div class="form-group"><label>Class Name *</label><input type="text" id="eName" /></div>
        <div class="form-group"><label>Description</label><textarea id="eDesc" rows="2"></textarea></div>
        <div class="form-group"><label>Grade Level</label>
            <select id="eGrade">
                <option value="Grade 10">Grade 10</option>
                <option value="Grade 9">Grade 9</option>
                <option value="Grade 8">Grade 8</option>
                <option value="Grade 7">Grade 7</option>
            </select>
        </div>
        <button class="btn btn-green" style="width:100%;justify-content:center;" id="editBtn" onclick="submitEdit()">💾 Save Changes</button>
    </div>
</div>

<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function openCreateModal() { document.getElementById('createModal').classList.add('active'); setTimeout(()=>document.getElementById('cName').focus(),100); }
function openEditModal(id, name, desc, grade) {
    document.getElementById('editId').value  = id;
    document.getElementById('eName').value   = name;
    document.getElementById('eDesc').value   = desc;
    document.getElementById('eGrade').value  = grade;
    document.getElementById('editModal').classList.add('active');
}
function closeModal(id) { document.getElementById(id).classList.remove('active'); }
document.querySelectorAll('.modal-overlay').forEach(el => el.addEventListener('click', e => { if(e.target===el) el.classList.remove('active'); }));

async function submitCreate() {
    const btn  = document.getElementById('createBtn');
    const alrt = document.getElementById('createAlert');
    const body = { name: document.getElementById('cName').value.trim(), description: document.getElementById('cDesc').value.trim(), grade_level: document.getElementById('cGrade').value };
    if (!body.name) { showAlert(alrt,'error','Class name is required.'); return; }
    btn.disabled = true; btn.innerHTML = '<span class="btn-spinner"></span> Creating...';
    try {
        const res  = await fetch('{{ route("teacher.classes.store") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify(body) });
        const data = await res.json();
        if (data.success) { showToast('✅ Class created!','success'); setTimeout(()=>location.reload(),800); }
        else showAlert(alrt,'error', data.message || 'Error creating class.');
    } catch(e) { showAlert(alrt,'error','Something went wrong.'); }
    btn.disabled=false; btn.innerHTML='✅ Create Class';
}

async function submitEdit() {
    const id   = document.getElementById('editId').value;
    const btn  = document.getElementById('editBtn');
    const alrt = document.getElementById('editAlert');
    const body = { name: document.getElementById('eName').value.trim(), description: document.getElementById('eDesc').value.trim(), grade_level: document.getElementById('eGrade').value };
    if (!body.name) { showAlert(alrt,'error','Class name is required.'); return; }
    btn.disabled=true; btn.innerHTML='<span class="btn-spinner"></span> Saving...';
    try {
        const res  = await fetch(`/teacher/classes/${id}`, { method:'PUT', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify(body) });
        const data = await res.json();
        if (data.success) { showToast('✅ Class updated!','success'); setTimeout(()=>location.reload(),800); }
        else showAlert(alrt,'error','Error updating class.');
    } catch(e) { showAlert(alrt,'error','Something went wrong.'); }
    btn.disabled=false; btn.innerHTML='💾 Save Changes';
}

async function deleteClass(id) {
    if (!confirm('Delete this class? This will also remove all quizzes in it.')) return;
    const res = await fetch(`/teacher/classes/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) { document.getElementById(`classCard-${id}`)?.remove(); showToast('🗑️ Class deleted.','error'); }
}

async function regenerateCode(id) {
    if (!confirm('Generate a new class code? The old code will no longer work.')) return;
    const res  = await fetch(`/teacher/classes/${id}/regenerate-code`, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF} });
    const data = await res.json();
    if (data.success) { showToast(`🔑 New code: ${data.class_code}`,'success'); setTimeout(()=>location.reload(),1200); }
}

function copyCode(code) {
    navigator.clipboard.writeText(code).then(()=>showToast(`📋 Copied: ${code}`,'success'));
}

let toastTimer;
function showToast(msg, type='success') {
    const t = document.getElementById('toast');
    t.textContent=msg; t.className=`toast ${type} show`;
    clearTimeout(toastTimer); toastTimer=setTimeout(()=>t.classList.remove('show'),3000);
}
function showAlert(el,type,msg) { el.className=`alert ${type}`; el.textContent=msg; }
</script>
@endpush
