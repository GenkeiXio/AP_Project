@extends('Students.studentslayout')

@section('title', $quiz->title)

@push('styles')
<style>
    * { box-sizing:border-box; }
    .game-wrap { max-width:760px; margin:0 auto; }
    .back-link { display:inline-flex; align-items:center; gap:6px; color:#6dbf7e; font-weight:700; font-size:0.88rem; text-decoration:none; margin-bottom:20px; }

    /* Header */
    .game-header { background:rgba(255,255,255,0.9); border-radius:18px; padding:20px 24px; margin-bottom:22px; box-shadow:0 4px 16px rgba(80,50,10,0.08); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
    .game-title  { font-family:'Baloo 2',cursive; font-size:1.3rem; font-weight:800; color:#3d2a1a; }
    .game-meta   { font-size:0.82rem; color:#9a8060; margin-top:2px; }
    .timer-display { font-family:'Baloo 2',cursive; font-size:1.6rem; font-weight:800; color:#3d2a1a; min-width:60px; text-align:center; }
    .timer-display.warning { color:#c0392b; animation:pulse 1s ease-in-out infinite; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.5} }

    /* Progress */
    .progress-bar-wrap { background:rgba(255,255,255,0.7); border-radius:12px; padding:14px 20px; margin-bottom:20px; }
    .progress-track { background:#e8dcc8; border-radius:8px; height:10px; overflow:hidden; margin-bottom:6px; }
    .progress-fill  { height:100%; border-radius:8px; background:linear-gradient(90deg,#6dbf7e,#4da862); transition:width 0.4s ease; }
    .progress-label { font-size:0.8rem; font-weight:700; color:#9a8060; text-align:right; }

    /* Question Card */
    .question-card { background:rgba(255,255,255,0.92); border-radius:20px; padding:28px; box-shadow:0 6px 24px rgba(80,50,10,0.1); margin-bottom:18px; animation:slideIn 0.35s cubic-bezier(.22,1,.36,1); }
    @keyframes slideIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
    .question-text { font-family:'Baloo 2',cursive; font-size:1.25rem; font-weight:700; color:#3d2a1a; margin-bottom:22px; line-height:1.4; }
    .blank-highlight { background:#fffbe6; border-bottom:3px solid #e8922a; padding:0 4px; font-weight:800; }

    /* MCQ Options */
    .mcq-options { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    @media(max-width:520px){ .mcq-options{grid-template-columns:1fr;} }
    .mcq-opt { padding:14px 18px; border:2.5px solid #e8dcc8; border-radius:14px; background:#fff; cursor:pointer; font-family:'Nunito',sans-serif; font-size:0.95rem; font-weight:700; color:#3d2a1a; transition:border-color 0.2s,background 0.2s,transform 0.15s; text-align:left; display:flex; align-items:center; gap:10px; }
    .mcq-opt:hover:not(:disabled) { border-color:#6dbf7e; background:#f0faf5; transform:scale(1.02); }
    .mcq-opt.selected { border-color:#4da862; background:#e8f8ed; }
    .mcq-opt.correct  { border-color:#1e7a3a; background:#c8f0d8; pointer-events:none; }
    .mcq-opt.wrong    { border-color:#c0392b; background:#fde8e8; pointer-events:none; }
    .opt-letter { width:28px; height:28px; border-radius:50%; background:#f0e8d8; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:800; color:#9a8060; flex-shrink:0; }
    .mcq-opt.selected .opt-letter { background:#4da862; color:#fff; }

    /* Fill in the Blank */
    .fill-input { width:100%; padding:16px 20px; border:2.5px solid #e8dcc8; border-radius:14px; font-family:'Nunito',sans-serif; font-size:1.1rem; outline:none; transition:border-color 0.2s; text-align:center; }
    .fill-input:focus { border-color:#6dbf7e; }
    .fill-input.correct { border-color:#1e7a3a; background:#c8f0d8; color:#1e7a3a; }
    .fill-input.wrong   { border-color:#c0392b; background:#fde8e8; color:#c0392b; }

    /* Word Scramble */
    .scramble-area { display:flex; flex-wrap:wrap; gap:8px; justify-content:center; margin-bottom:18px; min-height:52px; border:2px dashed #e8dcc8; border-radius:14px; padding:12px; transition:border-color 0.2s; }
    .scramble-area.drag-over { border-color:#6dbf7e; background:#f0faf5; }
    .letter-tile { width:46px; height:52px; border:2px solid #e8dcc8; border-radius:10px; background:#fff; display:flex; align-items:center; justify-content:center; font-family:'Baloo 2',cursive; font-size:1.4rem; font-weight:800; color:#3d2a1a; cursor:pointer; transition:transform 0.15s,border-color 0.2s,background 0.2s; user-select:none; }
    .letter-tile:hover { transform:scale(1.08); border-color:#6dbf7e; }
    .letter-tile.in-answer { background:#e8f8ed; border-color:#4da862; }
    .answer-slots { display:flex; flex-wrap:wrap; gap:8px; justify-content:center; margin-bottom:18px; }
    .answer-slot { width:46px; height:52px; border:2.5px solid #c0ad90; border-radius:10px; background:#fdfaf5; display:flex; align-items:center; justify-content:center; font-family:'Baloo 2',cursive; font-size:1.4rem; font-weight:800; color:#3d2a1a; cursor:pointer; transition:border-color 0.2s; }
    .answer-slot.filled { border-color:#4da862; background:#e8f8ed; }
    .answer-slot:hover { border-color:#e8922a; }

    /* Drag & Drop */
    .drag-columns { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    @media(max-width:520px){ .drag-columns{grid-template-columns:1fr;} }
    .drag-col h4 { font-size:0.78rem; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; color:#9a8060; margin-bottom:10px; }
    .drag-item { padding:12px 16px; border:2px solid #e8dcc8; border-radius:12px; background:#fff; cursor:grab; font-weight:700; font-size:0.92rem; color:#3d2a1a; margin-bottom:8px; transition:border-color 0.2s,transform 0.15s; }
    .drag-item:hover { border-color:#6dbf7e; transform:scale(1.02); }
    .drag-item.dragging { opacity:0.4; }
    .drop-zone { padding:12px 16px; border:2.5px dashed #c0ad90; border-radius:12px; background:#fdfaf5; min-height:48px; margin-bottom:8px; font-size:0.88rem; color:#b5a48a; font-weight:600; transition:border-color 0.2s,background 0.2s; display:flex; align-items:center; }
    .drop-zone.drag-over { border-color:#6dbf7e; background:#f0faf5; }
    .drop-zone.filled { border-color:#4da862; background:#e8f8ed; color:#1e7a3a; font-weight:700; }
    .drop-zone .term-label { font-size:0.75rem; color:#9a8060; font-weight:600; margin-right:8px; }

    /* Next / Submit buttons */
    .action-area { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; }
    .btn-next { padding:14px 28px; background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; border:none; border-radius:13px; font-family:'Baloo 2',cursive; font-size:1rem; font-weight:700; cursor:pointer; box-shadow:0 3px 14px rgba(77,168,98,0.32); transition:transform 0.15s,box-shadow 0.15s; }
    .btn-next:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(77,168,98,0.4); }
    .btn-next:disabled { opacity:0.5; cursor:not-allowed; transform:none; }
    .feedback-msg { font-weight:800; font-size:0.95rem; }
    .feedback-msg.correct { color:#1e7a3a; }
    .feedback-msg.wrong   { color:#c0392b; }

    /* Results screen */
    .results-card { background:rgba(255,255,255,0.92); border-radius:22px; padding:40px 36px; box-shadow:0 8px 32px rgba(80,50,10,0.12); text-align:center; animation:slideIn 0.5s cubic-bezier(.22,1,.36,1); }
    .results-emoji { font-size:5rem; margin-bottom:16px; display:block; }
    .results-title { font-family:'Baloo 2',cursive; font-size:2rem; font-weight:800; color:#3d2a1a; margin-bottom:8px; }
    .results-sub   { color:#9a8060; font-size:0.95rem; margin-bottom:28px; }
    .score-big { font-family:'Baloo 2',cursive; font-size:4rem; font-weight:800; line-height:1; margin-bottom:4px; }
    .score-label { font-size:0.88rem; color:#9a8060; margin-bottom:28px; }
    .results-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:28px; }
    .result-stat { background:#f8f4ee; border-radius:14px; padding:16px 10px; }
    .result-stat .rv { font-family:'Baloo 2',cursive; font-size:1.6rem; font-weight:800; color:#3d2a1a; }
    .result-stat .rl { font-size:0.75rem; color:#9a8060; font-weight:600; margin-top:2px; }
    .btn-results { padding:13px 26px; border:none; border-radius:13px; font-family:'Baloo 2',cursive; font-size:0.95rem; font-weight:700; cursor:pointer; transition:opacity 0.2s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .btn-results-green { background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; box-shadow:0 3px 14px rgba(77,168,98,0.3); }
    .btn-results-outline { background:transparent; border:2px solid #e8dcc8; color:#5a4030; }
    .btn-results:hover { opacity:0.88; }
</style>
@endpush

@section('content')

<div class="game-wrap">
    <a href="{{ route('student.class.detail', $quiz->schoolClass) }}" class="back-link">← Back to {{ $quiz->schoolClass->name }}</a>

    {{-- Game Screen --}}
    <div id="gameScreen">
        <div class="game-header">
            <div>
                <div class="game-title">{{ $quiz->title }}</div>
                <div class="game-meta">
                    {{ $quiz->type === 'pre_test' ? '📋 Pre-Test' : '🎯 Quiz' }} &nbsp;·&nbsp;
                    {{ ['mcq'=>'Multiple Choice','drag_drop'=>'Drag & Drop','fill_blank'=>'Fill in Blank','word_scramble'=>'Word Scramble'][$quiz->game_format] }}
                    &nbsp;·&nbsp; {{ $quiz->questions->count() }} questions
                </div>
            </div>
            @if($quiz->time_limit)
            <div class="timer-display" id="timerDisplay">{{ str_pad($quiz->time_limit, 2, '0', STR_PAD_LEFT) }}:00</div>
            @endif
        </div>

        <div class="progress-bar-wrap">
            <div class="progress-track"><div class="progress-fill" id="progressFill" style="width:0%"></div></div>
            <div class="progress-label" id="progressLabel">Question 1 of {{ $quiz->questions->count() }}</div>
        </div>

        <div id="questionContainer"></div>
    </div>

    {{-- Results Screen (hidden) --}}
    <div id="resultsScreen" style="display:none;"></div>
</div>

@endsection

@push('scripts')
<script>
const CSRF      = document.querySelector('meta[name="csrf-token"]').content;
const quizId    = {{ $quiz->id }};
const classId   = {{ $quiz->schoolClass->id }};
const format    = '{{ $quiz->game_format }}';
const timeLimit = {{ $quiz->time_limit ?? 'null' }};

const questions = {!! json_encode($quiz->questions->map(function($q){
    return [
        'id'            => $q->id,
        'question_text' => $q->question_text,
        'correct_answer'=> $q->correct_answer,
        'points'        => $q->points,
        'extra_data'    => $q->extra_data,
        'options'       => $q->options->map(fn($o)=>['text'=>$o->option_text,'is_correct'=>$o->is_correct])->toArray(),
    ];
})) !!};

let currentQ   = 0;
let answers    = {};
let answered   = false;
let timerInt   = null;
let timeLeft   = timeLimit ? timeLimit * 60 : null;

// Word scramble state
let scrambleLetters = [];
let answerSlots     = [];

// Drag state
let draggedEl = null;
let dragAnswers = {};

// ── Timer ──
if (timeLimit) {
    timerInt = setInterval(() => {
        timeLeft--;
        const m = Math.floor(timeLeft/60), s = timeLeft%60;
        const el = document.getElementById('timerDisplay');
        el.textContent = `${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        if (timeLeft <= 60) el.classList.add('warning');
        if (timeLeft <= 0) { clearInterval(timerInt); submitAll(); }
    }, 1000);
}

// ── Render question ──
function renderQuestion() {
    if (currentQ >= questions.length) { submitAll(); return; }
    const q   = questions[currentQ];
    const pct = Math.round((currentQ / questions.length) * 100);
    document.getElementById('progressFill').style.width  = pct+'%';
    document.getElementById('progressLabel').textContent = `Question ${currentQ+1} of ${questions.length}`;
    answered = false;

    const container = document.getElementById('questionContainer');

    let html = `<div class="question-card">
        <div class="question-text">${formatQuestionText(q.question_text)}</div>`;

    if (format === 'mcq') {
        const letters = ['A','B','C','D','E','F'];
        html += `<div class="mcq-options" id="mcqOpts">`;
        (q.options||[]).forEach((opt,i) => {
            html += `<button class="mcq-opt" id="opt-${i}" onclick="selectMCQ(${i}, '${escJs(opt.text)}')"
                ><span class="opt-letter">${letters[i]}</span>${escHtml(opt.text)}</button>`;
        });
        html += `</div>`;

    } else if (format === 'fill_blank') {
        html += `<input type="text" class="fill-input" id="fillInput" placeholder="Type your answer here..." autocomplete="off" />`;

    } else if (format === 'word_scramble') {
        const word     = (q.correct_answer||'').toUpperCase();
        const letters  = word.split('').sort(()=>Math.random()-0.5);
        scrambleLetters = letters.map((l,i)=>({letter:l,id:i,used:false}));
        answerSlots     = Array(word.length).fill(null);

        html += `<div class="answer-slots" id="answerSlots">`;
        for (let i=0;i<word.length;i++) html += `<div class="answer-slot" id="slot-${i}" onclick="removeFromSlot(${i})"></div>`;
        html += `</div>
        <div class="scramble-area" id="scrambleArea">`;
        scrambleLetters.forEach((lt,i) => {
            html += `<div class="letter-tile" id="tile-${i}" onclick="addToSlot(${i})">${lt.letter}</div>`;
        });
        html += `</div>`;

    } else if (format === 'drag_drop') {
        const pairs  = q.extra_data||[];
        const terms  = pairs.map(p=>p.term);
        const matches= [...pairs.map(p=>p.match)].sort(()=>Math.random()-0.5);
        dragAnswers  = {};

        html += `<div class="drag-columns">
            <div>
                <h4>Terms</h4>`;
        pairs.forEach((p,i) => {
            html += `<div class="drop-zone" id="dz-${i}" data-term="${escHtml(p.term)}"
                ondragover="event.preventDefault();this.classList.add('drag-over')"
                ondragleave="this.classList.remove('drag-over')"
                ondrop="dropOnZone(event,${i},'${escJs(p.term)}')">
                <span class="term-label">${escHtml(p.term)}</span>
                <span id="dzLabel-${i}" style="flex:1;text-align:center;">Drop here</span>
            </div>`;
        });
        html += `</div><div>
                <h4>Matches</h4>`;
        matches.forEach((m,i) => {
            html += `<div class="drag-item" draggable="true" id="dm-${i}" data-match="${escHtml(m)}"
                ondragstart="dragStart(event,'${escJs(m)}',this)"
                ondragend="this.classList.remove('dragging')"
                >${escHtml(m)}</div>`;
        });
        html += `</div></div>`;
    }

    html += `<div class="action-area" style="margin-top:20px;">
        <div class="feedback-msg" id="feedbackMsg"></div>
        <button class="btn-next" id="nextBtn" onclick="handleNext()"
            ${format==='word_scramble'||format==='drag_drop'?'':'disabled'}>
            ${currentQ+1===questions.length ? '✅ Submit' : 'Next →'}
        </button>
    </div></div>`;

    container.innerHTML = html;

    // Auto-enable fill blank on input
    if (format === 'fill_blank') {
        document.getElementById('fillInput').addEventListener('input', function(){
            document.getElementById('nextBtn').disabled = !this.value.trim();
        });
        document.getElementById('fillInput').addEventListener('keydown', e => {
            if (e.key==='Enter') handleNext();
        });
    }
}

function formatQuestionText(txt) {
    return escHtml(txt).replace(/___/g, '<span class="blank-highlight">___</span>');
}

// ── MCQ ──
function selectMCQ(i, answer) {
    if (answered) return;
    answered = true;
    answers[questions[currentQ].id] = answer;
    const isCorrect = answer.toLowerCase().trim() === questions[currentQ].correct_answer.toLowerCase().trim();
    document.querySelectorAll('.mcq-opt').forEach((btn,j) => {
        btn.disabled = true;
        const optText = btn.textContent.replace(/^[A-F]/,'').trim();
        if (j===i) btn.classList.add(isCorrect?'correct':'wrong');
        if (optText.toLowerCase().trim()===questions[currentQ].correct_answer.toLowerCase().trim() && !isCorrect) btn.classList.add('correct');
    });
    document.getElementById('feedbackMsg').textContent = isCorrect ? '✅ Correct!' : `❌ Correct: ${questions[currentQ].correct_answer}`;
    document.getElementById('feedbackMsg').className   = `feedback-msg ${isCorrect?'correct':'wrong'}`;
    document.getElementById('nextBtn').disabled = false;
}

// ── Fill Blank ──
function handleFillSubmit() {
    const val = document.getElementById('fillInput').value.trim();
    const ok  = val.toLowerCase() === questions[currentQ].correct_answer.toLowerCase().trim();
    answers[questions[currentQ].id] = val;
    const inp = document.getElementById('fillInput');
    inp.classList.add(ok?'correct':'wrong'); inp.disabled=true;
    document.getElementById('feedbackMsg').textContent = ok ? '✅ Correct!' : `❌ Answer: ${questions[currentQ].correct_answer}`;
    document.getElementById('feedbackMsg').className   = `feedback-msg ${ok?'correct':'wrong'}`;
}

// ── Word Scramble ──
function addToSlot(tileIdx) {
    const lt = scrambleLetters[tileIdx];
    if (lt.used) return;
    const slotIdx = answerSlots.findIndex(s=>s===null);
    if (slotIdx===-1) return;
    lt.used = true;
    answerSlots[slotIdx] = {letter:lt.letter, tileIdx};
    document.getElementById(`tile-${tileIdx}`).classList.add('in-answer');
    document.getElementById(`slot-${slotIdx}`).textContent = lt.letter;
    document.getElementById(`slot-${slotIdx}`).classList.add('filled');
    const filled = answerSlots.filter(s=>s!==null).length;
    if (filled === answerSlots.length) {
        const word = answerSlots.map(s=>s.letter).join('');
        answers[questions[currentQ].id] = word;
        document.getElementById('nextBtn').disabled = false;
    }
}
function removeFromSlot(slotIdx) {
    const s = answerSlots[slotIdx];
    if (!s) return;
    scrambleLetters[s.tileIdx].used = false;
    document.getElementById(`tile-${s.tileIdx}`).classList.remove('in-answer');
    answerSlots[slotIdx] = null;
    document.getElementById(`slot-${slotIdx}`).textContent='';
    document.getElementById(`slot-${slotIdx}`).classList.remove('filled');
    document.getElementById('nextBtn').disabled = true;
    delete answers[questions[currentQ].id];
}

// ── Drag & Drop ──
function dragStart(event, match, el) { draggedEl={el,match}; el.classList.add('dragging'); }
function dropOnZone(event, idx, term) {
    event.preventDefault();
    event.currentTarget.classList.remove('drag-over');
    if (!draggedEl) return;
    dragAnswers[term] = draggedEl.match;
    document.getElementById(`dzLabel-${idx}`).textContent = draggedEl.match;
    event.currentTarget.classList.add('filled');
    draggedEl.el.style.opacity='0.3'; draggedEl.el.style.pointerEvents='none';
    draggedEl = null;
    const pairs = questions[currentQ].extra_data||[];
    if (Object.keys(dragAnswers).length === pairs.length) {
        answers[questions[currentQ].id] = JSON.stringify(dragAnswers);
        document.getElementById('nextBtn').disabled = false;
    }
}

// ── Next handler ──
function handleNext() {
    if (format === 'fill_blank' && !answered) { handleFillSubmit(); answered=true; setTimeout(()=>{ currentQ++; renderQuestion(); },1200); return; }
    if (format === 'mcq' && !answered) return;
    currentQ++;
    renderQuestion();
}

// ── Submit all ──
async function submitAll() {
    if (timerInt) clearInterval(timerInt);
    // Capture fill blank if still unanswered
    if (format==='fill_blank') {
        const inp = document.getElementById('fillInput');
        if (inp && !answers[questions[currentQ]?.id]) {
            answers[questions[Math.min(currentQ,questions.length-1)].id] = inp.value.trim();
        }
    }

    try {
        const res  = await fetch(`/student/quiz/${quizId}/submit`, {
            method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
            body: JSON.stringify({answers}),
        });
        const data = await res.json();
        if (data.success) showResults(data);
    } catch(e) { console.error(e); }
}

function showResults(data) {
    document.getElementById('gameScreen').style.display  = 'none';
    const rs = document.getElementById('resultsScreen');
    rs.style.display = 'block';
    const pct = data.percentage;
    const emoji = pct>=80?'🎉':pct>=60?'😊':pct>=40?'😐':'😅';
    const grade = pct>=80?'Excellent!':pct>=60?'Good job!':pct>=40?'Keep practicing!':'Keep trying!';
    const scoreColor = pct>=75?'#1e7a3a':pct>=50?'#b05800':'#c0392b';
    rs.innerHTML = `<div class="results-card">
        <span class="results-emoji">${emoji}</span>
        <div class="results-title">${grade}</div>
        <div class="results-sub">You completed: <strong>${escHtml('{{ $quiz->title }}')}</strong></div>
        <div class="score-big" style="color:${scoreColor}">${pct}%</div>
        <div class="score-label">${data.score} out of ${data.total_points} points</div>
        <div class="results-grid">
            <div class="result-stat"><div class="rv" style="color:#1e7a3a">${data.correct_answers}</div><div class="rl">Correct</div></div>
            <div class="result-stat"><div class="rv" style="color:#c0392b">${data.total_questions-data.correct_answers}</div><div class="rl">Wrong</div></div>
            <div class="result-stat"><div class="rv">${data.total_questions}</div><div class="rl">Total</div></div>
        </div>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="/student/classes/${classId}" class="btn-results btn-results-green">← Back to Class</a>
            <a href="/student/quiz/${quizId}/play" class="btn-results btn-results-outline">🔄 Play Again</a>
        </div>
    </div>`;
}

function escHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function escJs(s)  { return String(s||'').replace(/'/g,"\\'"); }

// Start!
renderQuestion();
</script>
@endpush
