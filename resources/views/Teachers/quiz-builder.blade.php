@extends('Teachers.teacherslayout')

@section('title', isset($quiz) ? 'Edit Quiz' : 'Create Quiz')
@section('page-title', isset($quiz) ? 'Edit Quiz' : 'New Quiz')

@push('styles')
<style>
    .back-link { display:inline-flex; align-items:center; gap:6px; color:#3a9e8c; font-weight:700; font-size:0.88rem; text-decoration:none; margin-bottom:20px; }
    .back-link:hover { text-decoration:underline; }

    .builder-layout { display:grid; grid-template-columns:320px 1fr; gap:22px; align-items:start; }
    @media(max-width:960px){ .builder-layout{grid-template-columns:1fr;} }

    .section-card { background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 16px rgba(0,0,0,0.06); }
    .section-card h3 { font-family:'Baloo 2',cursive; font-size:1.05rem; font-weight:800; color:#3d2a1a; margin-bottom:16px; }

    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:0.82rem; font-weight:800; margin-bottom:6px; color:#5a4030; text-transform:uppercase; letter-spacing:0.4px; }
    .form-group input, .form-group textarea, .form-group select {
        width:100%; padding:10px 13px; border:2px solid #e0d0ba; border-radius:10px;
        font-family:'Nunito',sans-serif; font-size:0.9rem; outline:none; transition:border-color 0.2s; resize:none;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color:#3a9e8c; }

    /* Format selector */
    .format-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    .format-opt { border:2px solid #e0d0ba; border-radius:10px; padding:10px; text-align:center; cursor:pointer; transition:border-color 0.2s,background 0.2s; }
    .format-opt:hover { border-color:#3a9e8c; background:#f0faf8; }
    .format-opt.selected { border-color:#3a9e8c; background:#e0f5f2; }
    .format-opt .f-icon { font-size:1.5rem; margin-bottom:4px; }
    .format-opt .f-name { font-size:0.75rem; font-weight:800; color:#3d2a1a; }

    /* Questions area */
    .questions-area { min-height:200px; }
    .question-card { border:2px solid #e8dcc8; border-radius:14px; padding:20px; margin-bottom:16px; position:relative; transition:border-color 0.2s; }
    .question-card:hover { border-color:#3a9e8c; }
    .question-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
    .question-num { font-family:'Baloo 2',cursive; font-size:1rem; font-weight:800; color:#3a9e8c; }
    .q-delete { background:#fde8e8; border:none; border-radius:7px; padding:5px 10px; color:#c0392b; font-size:0.78rem; font-weight:700; cursor:pointer; }
    .q-delete:hover { background:#f5c0c0; }

    .option-row { display:flex; align-items:center; gap:8px; margin-bottom:8px; }
    .option-row input[type="text"] { flex:1; padding:9px 12px; border:1.5px solid #e0d0ba; border-radius:8px; font-family:'Nunito',sans-serif; font-size:0.88rem; outline:none; }
    .option-row input[type="text"]:focus { border-color:#3a9e8c; }
    .correct-check { width:18px; height:18px; accent-color:#4da862; cursor:pointer; flex-shrink:0; }
    .correct-label { font-size:0.75rem; color:#4da862; font-weight:700; flex-shrink:0; }
    .add-opt-btn { background:none; border:1.5px dashed #c0ad90; border-radius:8px; padding:7px 14px; color:#9a8060; font-family:'Nunito',sans-serif; font-size:0.82rem; font-weight:700; cursor:pointer; transition:border-color 0.2s,color 0.2s; width:100%; margin-top:4px; }
    .add-opt-btn:hover { border-color:#3a9e8c; color:#3a9e8c; }

    .del-opt-btn { background:#fde8e8; border:none; border-radius:6px; padding:4px 8px; color:#c0392b; font-size:0.75rem; cursor:pointer; flex-shrink:0; }

    .add-question-btn { width:100%; padding:13px; border:2px dashed #c0ad90; border-radius:13px; background:none; font-family:'Baloo 2',cursive; font-size:1rem; font-weight:700; color:#9a8060; cursor:pointer; transition:border-color 0.2s,color 0.2s; margin-top:4px; }
    .add-question-btn:hover { border-color:#3a9e8c; color:#3a9e8c; }

    .btn { display:inline-flex; align-items:center; gap:7px; padding:12px 22px; border-radius:11px; border:none; font-family:'Nunito',sans-serif; font-size:0.92rem; font-weight:700; cursor:pointer; transition:opacity 0.2s,transform 0.15s; }
    .btn:hover { opacity:0.88; transform:translateY(-1px); }
    .btn-green { background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; box-shadow:0 3px 12px rgba(77,168,98,0.3); width:100%; justify-content:center; font-size:1rem; padding:14px; margin-top:14px; }
    .btn-teal  { background:#3a9e8c; color:#fff; }

    @keyframes spin{to{transform:rotate(360deg)}}
    .btn-spinner { display:inline-block; width:15px; height:15px; border:2px solid rgba(255,255,255,0.4); border-top-color:#fff; border-radius:50%; animation:spin 0.7s linear infinite; }

    .alert { padding:10px 14px; border-radius:10px; font-size:0.87rem; margin-top:12px; font-weight:600; display:none; }
    .alert.error   { background:#fde8e8; color:#c0392b; display:block; }
    .alert.success { background:#e8f8ed; color:#1e7a3a; display:block; }

    /* Drag & Drop specific */
    .pair-row { display:flex; align-items:center; gap:8px; margin-bottom:8px; }
    .pair-row input { flex:1; }
    .pair-arrow { color:#9a8060; font-weight:800; flex-shrink:0; }

    /* Points input */
    .points-input { width:70px !important; text-align:center; }

    .tip-box { background:#f0faf8; border:1.5px solid #c0ece6; border-radius:10px; padding:12px 14px; font-size:0.82rem; color:#2a6a60; margin-bottom:14px; }
    .tip-box strong { display:block; margin-bottom:3px; }
</style>
@endpush

@section('content')

<a href="{{ route('teacher.classes.show', $class) }}" class="back-link">← Back to {{ $class->name }}</a>

<div class="builder-layout">

    {{-- LEFT: Quiz Settings --}}
    <div>
        <div class="section-card">
            <h3>⚙️ Quiz Settings</h3>

            <div class="form-group">
                <label>Quiz Title *</label>
                <input type="text" id="qTitle" placeholder="e.g. Unit 1 Pre-Test" value="{{ $quiz->title ?? '' }}" />
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea id="qDesc" rows="2" placeholder="Optional...">{{ $quiz->description ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label>Type</label>
                <div style="display:flex; gap:10px;">
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;font-weight:600;cursor:pointer;text-transform:none;letter-spacing:0;">
                        <input type="radio" name="qType" value="quiz" {{ (!isset($quiz)||$quiz->type==='quiz')?'checked':'' }}> 🎯 Quiz
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;font-weight:600;cursor:pointer;text-transform:none;letter-spacing:0;">
                        <input type="radio" name="qType" value="pre_test" {{ (isset($quiz)&&$quiz->type==='pre_test')?'checked':'' }}> 📋 Pre-Test (MCQ only)
                    </label>
                </div>
            </div>

            <div class="form-group" id="formatGroup">
                <label>Game Format</label>
                <div class="format-grid">
                    <div class="format-opt {{ (!isset($quiz)||$quiz->game_format==='mcq')?'selected':'' }}" onclick="selectFormat('mcq',this)">
                        <div class="f-icon">❓</div><div class="f-name">Multiple Choice</div>
                    </div>
                    <div class="format-opt {{ (isset($quiz)&&$quiz->game_format==='drag_drop')?'selected':'' }}" onclick="selectFormat('drag_drop',this)">
                        <div class="f-icon">🧲</div><div class="f-name">Drag & Drop</div>
                    </div>
                    <div class="format-opt {{ (isset($quiz)&&$quiz->game_format==='fill_blank')?'selected':'' }}" onclick="selectFormat('fill_blank',this)">
                        <div class="f-icon">✏️</div><div class="f-name">Fill in the Blank</div>
                    </div>
                    <div class="format-opt {{ (isset($quiz)&&$quiz->game_format==='word_scramble')?'selected':'' }}" onclick="selectFormat('word_scramble',this)">
                        <div class="f-icon">🔤</div><div class="f-name">Word Scramble</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Time Limit (minutes) — leave empty for no limit</label>
                <input type="number" id="qTime" min="1" max="180" placeholder="e.g. 30" value="{{ $quiz->time_limit ?? '' }}" />
            </div>

            <div class="alert" id="builderAlert"></div>

            <button class="btn btn-green" id="saveBtn" onclick="saveQuiz()">
                {{ isset($quiz) ? '💾 Save Changes' : '✅ Save Quiz' }}
            </button>
        </div>
    </div>

    {{-- RIGHT: Questions --}}
    <div class="section-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3>📝 Questions <span id="qCount" style="font-size:0.85rem;color:#9a8060;font-weight:600;">(0)</span></h3>
            <div id="formatHint" style="font-size:0.78rem;color:#3a9e8c;font-weight:700;"></div>
        </div>

        <div id="tipBox" class="tip-box" style="display:none;"></div>
        <div id="questionsArea" class="questions-area"></div>
        <button class="add-question-btn" onclick="addQuestion()">+ Add Question</button>
    </div>

</div>

@endsection

@push('scripts')
<script>
const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
const classId = {{ $class->id }};
const quizId  = {{ $quiz->id ?? 'null' }};
let selectedFormat = '{{ $quiz->game_format ?? "mcq" }}';
let questions = [];

// Pre-load existing questions if editing
@if(isset($quiz) && $quiz->questions->count())
questions = {!! json_encode($quiz->questions->map(function($q){
    return [
        'id'            => $q->id,
        'question_text' => $q->question_text,
        'correct_answer'=> $q->correct_answer,
        'points'        => $q->points,
        'extra_data'    => $q->extra_data,
        'options'       => $q->options->map(fn($o)=>['text'=>$o->option_text,'is_correct'=>$o->is_correct])->toArray(),
    ];
})) !!};
renderAll();
@endif

// Format logic
document.querySelectorAll('input[name="qType"]').forEach(r => r.addEventListener('change', function(){
    const isPre = this.value === 'pre_test';
    document.getElementById('formatGroup').style.opacity = isPre ? '0.4' : '1';
    document.getElementById('formatGroup').style.pointerEvents = isPre ? 'none' : '';
    if (isPre) selectFormat('mcq', document.querySelector('.format-opt'));
}));

function selectFormat(fmt, el) {
    document.querySelectorAll('.format-opt').forEach(o=>o.classList.remove('selected'));
    el.classList.add('selected');
    selectedFormat = fmt;
    updateFormatHint();
    renderAll();
}

function updateFormatHint() {
    const hints = {
        mcq:          '❓ Multiple choice — set options and mark the correct one.',
        drag_drop:    '🧲 Drag & Drop — create term → match pairs.',
        fill_blank:   '✏️ Fill in the Blank — student types the answer.',
        word_scramble:'🔤 Word Scramble — enter the word; it will be scrambled for students.',
    };
    const tips = {
        mcq:          '<strong>💡 Tip:</strong> Add at least 2 options per question. Check ✅ for the correct one.',
        drag_drop:    '<strong>💡 Tip:</strong> Each pair is a term and its matching answer (e.g. Term → Definition).',
        fill_blank:   '<strong>💡 Tip:</strong> Use ___ in the question text to show where the blank is.',
        word_scramble:'<strong>💡 Tip:</strong> Enter the correct word. Students will see scrambled letters.',
    };
    document.getElementById('formatHint').textContent = hints[selectedFormat] || '';
    document.getElementById('tipBox').innerHTML        = tips[selectedFormat] || '';
    document.getElementById('tipBox').style.display    = tips[selectedFormat] ? 'block' : 'none';
}

updateFormatHint();

function addQuestion() {
    questions.push({ question_text:'', correct_answer:'', points:1, options:[{text:'',is_correct:true},{text:'',is_correct:false}], extra_data:[] });
    renderAll();
    document.querySelector('.question-card:last-child')?.scrollIntoView({behavior:'smooth',block:'nearest'});
}

function removeQuestion(i) {
    questions.splice(i,1);
    renderAll();
}

function renderAll() {
    const area = document.getElementById('questionsArea');
    area.innerHTML = '';
    questions.forEach((q,i) => {
        area.appendChild(renderQuestion(q,i));
    });
    document.getElementById('qCount').textContent = `(${questions.length})`;
}

function renderQuestion(q, i) {
    const card = document.createElement('div');
    card.className = 'question-card';
    card.id = `qcard-${i}`;

    let innerHtml = `
        <div class="question-header">
            <span class="question-num">Question ${i+1}</span>
            <div style="display:flex;align-items:center;gap:10px;">
                <label style="font-size:0.8rem;font-weight:700;color:#9a8060;display:flex;align-items:center;gap:5px;">
                    Pts: <input type="number" class="points-input" min="1" max="10" value="${q.points||1}" onchange="questions[${i}].points=parseInt(this.value)||1" style="width:55px;padding:5px 8px;border:1.5px solid #e0d0ba;border-radius:7px;font-family:'Nunito',sans-serif;text-align:center;outline:none;">
                </label>
                <button class="q-delete" onclick="removeQuestion(${i})">🗑️ Remove</button>
            </div>
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label style="text-transform:none;letter-spacing:0;font-size:0.85rem;">Question Text *</label>
            <textarea rows="2" style="width:100%;padding:10px 12px;border:2px solid #e0d0ba;border-radius:10px;font-family:'Nunito',sans-serif;font-size:0.9rem;outline:none;resize:none;"
                onchange="questions[${i}].question_text=this.value"
                oninput="questions[${i}].question_text=this.value"
                placeholder="${selectedFormat==='fill_blank'?'e.g. The capital of the Philippines is ___.':'Enter question here...'}"
            >${escHtml(q.question_text)}</textarea>
        </div>`;

    if (selectedFormat === 'mcq') {
        innerHtml += `<div id="opts-${i}">`;
        (q.options||[]).forEach((opt,j) => {
            innerHtml += `
            <div class="option-row" id="opt-${i}-${j}">
                <input type="checkbox" class="correct-check" title="Mark as correct" ${opt.is_correct?'checked':''} onchange="setCorrect(${i},${j},this.checked)">
                <span class="correct-label" style="opacity:${opt.is_correct?1:0};">✓</span>
                <input type="text" placeholder="Option ${j+1}" value="${escHtml(opt.text)}" oninput="questions[${i}].options[${j}].text=this.value">
                <button class="del-opt-btn" onclick="removeOption(${i},${j})">✕</button>
            </div>`;
        });
        innerHtml += `</div>
        <button class="add-opt-btn" onclick="addOption(${i})">+ Add Option</button>`;

    } else if (selectedFormat === 'drag_drop') {
        const pairs = q.extra_data||[];
        innerHtml += `<div id="pairs-${i}">`;
        pairs.forEach((p,j) => {
            innerHtml += `
            <div class="pair-row" id="pair-${i}-${j}">
                <input type="text" placeholder="Term" value="${escHtml(p.term||'')}" oninput="questions[${i}].extra_data[${j}].term=this.value;questions[${i}].correct_answer=JSON.stringify(questions[${i}].extra_data)">
                <span class="pair-arrow">→</span>
                <input type="text" placeholder="Match" value="${escHtml(p.match||'')}" oninput="questions[${i}].extra_data[${j}].match=this.value;questions[${i}].correct_answer=JSON.stringify(questions[${i}].extra_data)">
                <button class="del-opt-btn" onclick="removePair(${i},${j})">✕</button>
            </div>`;
        });
        innerHtml += `</div><button class="add-opt-btn" onclick="addPair(${i})">+ Add Pair</button>`;

    } else if (selectedFormat === 'fill_blank') {
        innerHtml += `
        <div class="form-group" style="margin-bottom:0;">
            <label style="text-transform:none;letter-spacing:0;font-size:0.85rem;">Correct Answer *</label>
            <input type="text" placeholder="Type the exact correct answer" value="${escHtml(q.correct_answer)}" oninput="questions[${i}].correct_answer=this.value">
        </div>`;

    } else if (selectedFormat === 'word_scramble') {
        innerHtml += `
        <div class="form-group" style="margin-bottom:0;">
            <label style="text-transform:none;letter-spacing:0;font-size:0.85rem;">The Word (students will see it scrambled) *</label>
            <input type="text" placeholder="e.g. KALAYAAN" value="${escHtml(q.correct_answer)}" oninput="questions[${i}].correct_answer=this.value.toUpperCase();this.value=this.value.toUpperCase()">
        </div>`;
    }

    card.innerHTML = innerHtml;
    return card;
}

function setCorrect(qi, oi, val) {
    questions[qi].options.forEach((o,j) => o.is_correct = j===oi ? val : false);
    questions[qi].correct_answer = questions[qi].options.find(o=>o.is_correct)?.text || '';
    renderAll();
}

function addOption(qi) {
    questions[qi].options.push({text:'',is_correct:false});
    renderAll();
}

function removeOption(qi, oi) {
    questions[qi].options.splice(oi,1);
    renderAll();
}

function addPair(qi) {
    if (!questions[qi].extra_data) questions[qi].extra_data = [];
    questions[qi].extra_data.push({term:'',match:''});
    renderAll();
}

function removePair(qi, pi) {
    questions[qi].extra_data.splice(pi,1);
    renderAll();
}

function escHtml(str) { return String(str||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

async function saveQuiz() {
    const btn   = document.getElementById('saveBtn');
    const alert = document.getElementById('builderAlert');
    const title = document.getElementById('qTitle').value.trim();
    const type  = document.querySelector('input[name="qType"]:checked').value;
    const fmt   = type==='pre_test' ? 'mcq' : selectedFormat;

    if (!title) { showAlert(alert,'error','Please enter a quiz title.'); return; }
    if (questions.length === 0) { showAlert(alert,'error','Please add at least one question.'); return; }

    // Validate questions
    for (let i=0;i<questions.length;i++) {
        const q = questions[i];
        if (!q.question_text.trim()) { showAlert(alert,'error',`Question ${i+1} needs text.`); return; }
        if (fmt==='mcq') {
            if (!q.options||q.options.length<2) { showAlert(alert,'error',`Question ${i+1} needs at least 2 options.`); return; }
            if (!q.options.some(o=>o.is_correct)) { showAlert(alert,'error',`Question ${i+1} needs a correct answer marked.`); return; }
            q.correct_answer = q.options.find(o=>o.is_correct)?.text||'';
        }
        if ((fmt==='fill_blank'||fmt==='word_scramble') && !q.correct_answer.trim()) {
            showAlert(alert,'error',`Question ${i+1} needs a correct answer.`); return;
        }
        if (fmt==='drag_drop') {
            if (!q.extra_data||q.extra_data.length<1) { showAlert(alert,'error',`Question ${i+1} needs at least one pair.`); return; }
            q.correct_answer = JSON.stringify(q.extra_data);
        }
    }

    btn.disabled=true; btn.innerHTML='<span class="btn-spinner"></span> Saving...';

    const payload = {
        title: title,
        description: document.getElementById('qDesc').value.trim(),
        type: type,
        game_format: fmt,
        time_limit: document.getElementById('qTime').value || null,
        questions: questions,
    };

    try {
        const url    = quizId ? `/teacher/quizzes/${quizId}` : `/teacher/classes/${classId}/quizzes`;
        const method = quizId ? 'PUT' : 'POST';
        const res    = await fetch(url, { method, headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify(payload) });
        const data   = await res.json();
        if (data.success) {
            showAlert(alert,'success','✅ Quiz saved successfully!');
            setTimeout(() => { window.location.href = `/teacher/classes/${classId}`; }, 1000);
        } else {
            const msg = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message||'Error saving quiz.');
            showAlert(alert,'error',msg);
        }
    } catch(e) { showAlert(alert,'error','Something went wrong. Please try again.'); }
    btn.disabled=false; btn.innerHTML='{{ isset($quiz) ? "💾 Save Changes" : "✅ Save Quiz" }}';
}

function showAlert(el,type,msg) { el.className=`alert ${type}`; el.textContent=msg; el.scrollIntoView({behavior:'smooth',block:'nearest'}); }
</script>
@endpush
