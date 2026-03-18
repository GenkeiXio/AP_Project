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
                <button class="btn btn-danger btn-sm" onclick="removeStudent({{ $class->id }}, {{ $student->id }})">Remove</button>
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
</script>
@endpush
