@extends('Students.studentslayout')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body { height: 100%; }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                    url("{{ asset('pictures/mod3_innermap.png') }}") center center / cover no-repeat fixed;
        min-height: 100vh;
    }

    .wooden-card {
        background: #e0c9a6;
        background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
        border: 6px solid #5d4037;
        border-radius: 18px;
        box-shadow: inset 0 0 40px rgba(0,0,0,0.1), 0 10px 25px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .task-container { min-height: 100vh; padding: 30px 40px; }
    @media (max-width: 768px) { .task-container { padding: 15px; } }

    .task-header { text-align: center; margin-bottom: 20px; }
    .task-header h1 {
        font-family: 'Nunito', sans-serif;
        font-size: clamp(1.6rem, 4vw, 2.3rem);
        font-weight: 800;
        color: #ffefc0;
        text-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }
    .task-header p { color: #f6e5c9; font-size: 0.95rem; margin-top: 6px; }

    /* ===== TOP STATUS BAR ===== */
    .status-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 20px;
        margin-bottom: 20px;
        gap: 15px;
        flex-wrap: wrap;
    }
    .status-chip { text-align: center; }
    .status-chip .label { font-size: 0.7rem; color: #f6e5c9; display: block; }
    .status-chip .value { font-size: 1.2rem; font-weight: 800; color: #ffefc0; font-family: 'Nunito', sans-serif; }

    .progress-track {
        flex: 1 1 200px;
        height: 10px;
        border-radius: 20px;
        background: #3b2a1a;
        border: 1px solid #5d4037;
        overflow: hidden;
        min-width: 150px;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #5d4037, #8b5e3c);
        width: 0%;
        transition: width 0.4s ease;
    }

    /* ===== SINGLE STEP CARD (the whole point of "bite size") ===== */
    .step-stage {
        max-width: 640px;
        margin: 0 auto;
        min-height: 440px;
        display: flex;
        flex-direction: column;
        padding: 30px;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #5d4037;
        color: #f1f5f9;
        font-size: 0.75rem;
        font-weight: 800;
        padding: 6px 14px;
        border-radius: 20px;
        width: fit-content;
        margin-bottom: 14px;
        font-family: 'Nunito', sans-serif;
    }

    .step-counter {
        font-size: 0.8rem;
        color: #6b5a4a;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .step-body { flex: 1; display: flex; flex-direction: column; justify-content: center; text-align: center; }

    .step-icon { font-size: 3rem; margin-bottom: 12px; }

    .step-title {
        font-family: 'Nunito', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: #3d2b1f;
        margin-bottom: 8px;
    }

    .step-sub { color: #6b5a4a; font-size: 0.9rem; margin-bottom: 22px; }

    .choice-list { display: flex; flex-direction: column; gap: 12px; }

    .choice-btn {
        background: rgba(255,255,255,0.55);
        border: 2px solid #5d4037;
        border-radius: 14px;
        padding: 14px 18px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #3a2a1a;
        cursor: pointer;
        text-align: left;
        transition: all 0.15s ease;
    }
    .choice-btn:hover { background: rgba(255,255,255,0.85); transform: translateY(-2px); }
    .choice-btn.chosen { background: #5d4037; color: #fff; border-color: #3d2b1f; }

    .choice-points {
        float: right;
        font-size: 0.75rem;
        font-weight: 800;
        opacity: 0.8;
    }

    /* yes/no style for kit items */
    .kit-choice-row { display: flex; gap: 12px; justify-content: center; }
    .kit-choice-row .choice-btn { flex: 1; max-width: 180px; text-align: center; }

    .step-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 26px;
        padding-top: 18px;
        border-top: 2px solid rgba(93,64,55,0.3);
    }

    .nav-btn {
        border: 1px solid #8b5e3c;
        border-radius: 50px;
        padding: 10px 24px;
        font-weight: 800;
        font-family: 'Nunito', sans-serif;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .nav-btn.back { background: transparent; color: #5d4037; }
    .nav-btn.back:hover { background: rgba(93,64,55,0.15); }
    .nav-btn.next {
        background: linear-gradient(135deg, #3d2b1f, #5d4037);
        color: #f1f5f9;
    }
    .nav-btn.next:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(0,0,0,0.3); }
    .nav-btn:disabled { opacity: 0.4; cursor: not-allowed; }
    .nav-btn.invisible { visibility: hidden; }

    /* dot map of overall sequence, shown under the card */
    .dot-track {
        display: flex;
        justify-content: center;
        gap: 5px;
        flex-wrap: wrap;
        margin-top: 16px;
    }
    .dot {
        width: 9px; height: 9px; border-radius: 50%;
        background: rgba(255,255,255,0.3);
        border: 1px solid rgba(93,64,55,0.5);
    }
    .dot.done { background: #8b5e3c; }
    .dot.current { background: #ffefc0; border-color: #3d2b1f; }

    /* ===== REVIEW SCREEN ===== */
    .review-list { display: flex; flex-direction: column; gap: 10px; text-align: left; margin: 20px 0; max-height: 320px; overflow-y: auto; padding-right: 6px; }
    .review-row {
        display: flex;
        justify-content: space-between;
        background: rgba(93,64,55,0.12);
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        color: #3d2b1f;
    }
    .review-row .pts { font-weight: 800; }

    /* ===== MODAL ===== */
    .modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 1000; justify-content: center; align-items: center; padding: 20px; }
    .modal.show { display: flex; }
    .modal-content {
        background: #e0c9a6;
        background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
        border: 6px solid #5d4037;
        border-radius: 18px;
        max-width: 600px;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        box-shadow: 0 30px 50px rgba(0,0,0,0.5);
    }
    .modal-header { padding: 20px; border-bottom: 3px solid #5d4037; text-align: center; background: rgba(93,64,55,0.2); }
    .modal-header h2 { color: #3d2b1f; font-family: 'Nunito', sans-serif; font-size: 1.4rem; }
    .modal-body { padding: 25px; }
    .modal-footer { padding: 20px; border-top: 3px solid #5d4037; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }

    .save-btn {
        background: #3d2b1f; color: #f1f5f9; border: 1px solid #5d4037;
        padding: 10px 25px; border-radius: 30px; font-weight: 700;
        font-family: 'Nunito', sans-serif; cursor: pointer; text-decoration: none; display: inline-block;
        transition: all 0.2s;
    }
    .save-btn:hover { background: #5d4037; transform: translateY(-2px); }

    .score-circle {
        width: 110px; height: 110px; border-radius: 50%;
        background: linear-gradient(135deg, #5d4037, #8b5e3c);
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        margin: 0 auto 16px; border: 3px solid #3d2b1f;
    }
    .score-value { font-size: 1.8rem; font-weight: 800; color: white; }
    .score-max { font-size: 0.75rem; color: #f1f5f9; }

    .badges-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 10px; margin-top: 12px; }
    .badge-chip { background: linear-gradient(135deg, #5d4037, #8b5e3c); padding: 10px; border-radius: 12px; text-align: center; color: white; }
    .badge-chip .emoji { font-size: 1.4rem; display: block; }
    .badge-chip .name { font-size: 0.65rem; font-weight: 700; }

    .result-feedback {
        background: rgba(93,64,55,0.1); padding: 14px; border-radius: 12px;
        border-left: 4px solid #5d4037; color: #3a2a1a; line-height: 1.5; margin-top: 14px;
    }
</style>

<div class="task-container">

    <header class="task-header">
        <h1>🎮 Gawain sa Pagganap: Hamon sa Paghahanda sa Sakuna</h1>
        <p>Isang hakbang sa bawat pagkakataon — kumpletuhin ang plano ng kaligtasan ng iyong pamilya.</p>
    </header>

    <div class="wooden-card status-bar">
        <div class="status-chip">
            <span class="label">🏆 ISKOR</span>
            <span class="value" id="statScore">0</span>
        </div>
        <div class="progress-track"><div class="progress-fill" id="progressFill"></div></div>
        <div class="status-chip">
            <span class="label">📍 HAKBANG</span>
            <span class="value" id="statStep">0/0</span>
        </div>
        <div class="status-chip">
            <span class="label">🎖️ BADGE</span>
            <span class="value" id="statBadges">0/5</span>
        </div>
    </div>

    <!-- THE ONE CARD THE STUDENT EVER LOOKS AT -->
    <div class="wooden-card step-stage" id="stepStage"></div>
    <div class="dot-track" id="dotTrack"></div>
</div>

<!-- RESULTS MODAL -->
<div class="modal" id="resultsModal">
    <div class="modal-content">
        <div class="modal-header"><h2>🎉 Natapos ang Gawain!</h2></div>
        <div class="modal-body">
            <div class="score-circle">
                <div class="score-value" id="finalScore">0</div>
                <div class="score-max">/100</div>
            </div>
            <p style="text-align:center; color:#3d2b1f;"><strong id="resultBadges">0</strong>/5 badge natamo &middot; <span id="resultTime">0m 0s</span></p>
            <div class="result-feedback" id="resultFeedback"></div>
            <div class="badges-row" id="resultBadgesDisplay"></div>
        </div>
        <div class="modal-footer">
            <button class="save-btn" id="saveResultBtn">💾 I-save at Magpatuloy</button>
        </div>
    </div>
</div>

<!-- RUBRICS MODAL (first time only) -->
<div class="modal" id="rubricsModal">
    <div class="modal-content">
        <div class="modal-header"><h2>📊 Rubrics sa Pagganap</h2></div>
        <div class="modal-body">
            <img src="{{ asset('pictures/Module 3/mod3_rubrics.jpg') }}" alt="Module 3 Rubrics" style="width:100%; border-radius:12px;">
        </div>
        <div class="modal-footer">
            <button class="save-btn" onclick="closeRubrics()">✔ Naiintindihan ko, Simulan na!</button>
        </div>
    </div>
</div>

<script>
/* =========================================================================
   1) CONFIG — the ONLY place content lives. Add/edit items or questions
      here and nothing else needs to change.
   ========================================================================= */
const SECTIONS = [
    {
        id: 'kit',
        icon: '🎒',
        title: 'Emergency Kit',
        badgeKey: 'kitmaster',
        badgeName: 'Dalubhasa sa Kit',
        badgeEmoji: '🎒',
        type: 'pick', // yes/no per item
        minRequired: 5,
        items: [
            { key: 'tubig', icon: '💧', name: 'Tubig', info: '1-2 litro bawat tao', points: 5 },
            { key: 'pagkain', icon: '🥫', name: 'Pagkaing Hindi Napapanis', info: 'De-lata, biskwit', points: 5 },
            { key: 'firstaid', icon: '⚕️', name: 'First Aid Kit', info: 'Mga benda, gamot', points: 5 },
            { key: 'flashlight', icon: '🔦', name: 'Flashlight', info: 'May ekstrang baterya', points: 5 },
            { key: 'dokumento', icon: '📄', name: 'Mahahalagang Dokumento', info: 'Mga ID, papeles', points: 5 },
            { key: 'pera', icon: '💵', name: 'Pera at Card', info: 'Para sa emerhensiya', points: 5 },
            { key: 'radyo', icon: '📻', name: 'Radyo/Charger', info: 'Manatiling may impormasyon', points: 5 },
            { key: 'babyitems', icon: '👶', name: 'Gamit ng Sanggol', info: 'Diaper, gatas', points: 5 },
            { key: 'petsupplies', icon: '🐾', name: 'Gamit ng Alagang Hayop', info: 'Pagkain, tali', points: 5 },
        ],
    },
    {
        id: 'evacuation',
        icon: '🚪',
        title: 'Plano sa Paglikas',
        badgeKey: 'evacuationexpert',
        badgeName: 'Eksperto sa Paglikas',
        badgeEmoji: '🚪',
        type: 'quiz',
        questions: [
            { text: 'Saan ang iyong itinalagang lugar ng paglikas?', options: [
                { value: 'school', text: '🏫 Pinakamalapit na paaralan/center ng komunidad', points: 5 },
                { value: 'relative', text: '👥 Bahay ng kamag-anak sa mas mataas na lugar', points: 5 },
                { value: 'unknown', text: '❓ Hindi ko pa alam', points: 0 },
            ]},
            { text: 'Paano kayo makakarating doon?', options: [
                { value: 'walk', text: '🚶 Nakaplano ang paglalakad na ruta', points: 5 },
                { value: 'vehicle', text: '🚗 Handa ang sasakyan na may sapat na gasolina', points: 5 },
                { value: 'unsure', text: '❓ Hindi pa napagdesisyunan', points: 0 },
            ]},
            { text: 'Mayroon ka bang mapa ng ruta ng paglikas?', options: [
                { value: 'yes', text: '✅ Oo, nakamarka sa mapa', points: 5 },
                { value: 'planning', text: '📋 Nagpaplanong gumawa', points: 3 },
                { value: 'no', text: '❌ Wala pa', points: 0 },
            ]},
            { text: 'Sino ang mamumuno sa paglikas?', options: [
                { value: 'designated', text: '👤 Itinalagang miyembro ng pamilya', points: 5 },
                { value: 'unclear', text: '❓ Hindi pa napagdesisyunan', points: 0 },
            ]},
            { text: 'Gaano katagal dapat ang paglikas?', options: [
                { value: 'estimated', text: '⏱️ May tinatayang oras na nakalkula', points: 5 },
                { value: 'unknown', text: '❓ Hindi pa nakalkula', points: 0 },
            ]},
        ],
    },
    {
        id: 'communication',
        icon: '📱',
        title: 'Komunikasyon',
        badgeKey: 'communicationpro',
        badgeName: 'Dalubhasa sa Komunikasyon',
        badgeEmoji: '📱',
        type: 'quiz',
        questions: [
            { text: 'Mayroon ba kayong pangunahing taong kokontakin sa labas ng inyong lugar?', options: [
                { value: 'yes', text: '✅ Oo, may itinalagang kontak', points: 5 },
                { value: 'no', text: '❌ Wala', points: 0 },
            ]},
            { text: 'Alam ba ng lahat ng miyembro ng pamilya ang numerong ito?', options: [
                { value: 'yes', text: '✅ Oo, alam ng lahat', points: 5 },
                { value: 'partial', text: '🟡 Ilan lamang', points: 3 },
                { value: 'no', text: '❌ Hindi', points: 0 },
            ]},
            { text: 'Paano kayo makikipag-ugnayan kung hindi gumagana ang mga telepono?', options: [
                { value: 'planned', text: '📍 May nakaplanong tagpuan o radyo', points: 5 },
                { value: 'unsure', text: '❓ Hindi pa napag-isipan', points: 0 },
            ]},
            { text: 'Mayroon ba kayong nakasulat na listahan ng emergency contacts?', options: [
                { value: 'yes', text: '✅ Nakasulat at naipamahagi', points: 5 },
                { value: 'phone', text: '📱 Nasa telepono lamang', points: 3 },
                { value: 'no', text: '❌ Wala', points: 0 },
            ]},
            { text: 'Gaano kadalas ninyo nire-review ang inyong plano sa komunikasyon?', options: [
                { value: 'monthly', text: '🔄 Buwan-buwan o regular', points: 5 },
                { value: 'rarely', text: '❓ Bihira o hindi kailanman', points: 0 },
            ]},
        ],
    },
    {
        id: 'safe',
        icon: '🏠',
        title: 'Ligtas na Lugar',
        badgeKey: 'safehaven',
        badgeName: 'Ligtas na Kanlungan',
        badgeEmoji: '🏠',
        type: 'quiz',
        questions: [
            { text: 'Saan ang pinakaligtas na silid sa inyong tahanan?', options: [
                { value: 'interior', text: '🛡️ Loob na silid na malayo sa bintana', points: 5 },
                { value: 'basement', text: '🏚️ Basement/pinakamababang bahagi', points: 5 },
                { value: 'unknown', text: '❓ Hindi pa natutukoy', points: 0 },
            ]},
            { text: 'Ang inyong bahay ba ay malayo sa mga lugar na madaling bahain?', options: [
                { value: 'yes', text: '✅ Nasa mataas na lugar, ligtas sa baha', points: 5 },
                { value: 'partial', text: '🟡 Bahagyang nanganganib', points: 3 },
                { value: 'risk', text: '⚠️ Lugar na madaling bahain', points: 0 },
            ]},
            { text: 'Alam mo ba kung saan matatagpuan ang mga pampublikong evacuation center?', options: [
                { value: 'yes', text: '✅ Oo, napuntahan at natukoy na', points: 5 },
                { value: 'vague', text: '🟡 May kaunting ideya sa lokasyon', points: 3 },
                { value: 'no', text: '❌ Hindi alam', points: 0 },
            ]},
            { text: 'Mayroon bang ligtas na lugar para sa mga alagang hayop tuwing sakuna?', options: [
                { value: 'yes', text: '✅ Oo, may itinalagang lugar', points: 5 },
                { value: 'flexible', text: '🟡 Maaaring makahanap ng pansamantalang matutuluyan', points: 3 },
                { value: 'no', text: '❌ Wala pang plano', points: 0 },
            ]},
            { text: 'Nasubukan na ba ninyong pumunta sa inyong ligtas na lugar?', options: [
                { value: 'yes', text: '✅ Oo, regular na isinasagawa', points: 5 },
                { value: 'once', text: '🟡 Isa o dalawang beses pa lamang', points: 3 },
                { value: 'no', text: '❌ Hindi pa nasusubukan', points: 0 },
            ]},
        ],
    },
];

const MASTER_BADGE = { key: 'preparednessmaster', name: 'Ganap na Handa', emoji: '🌟', threshold: 90 };

/* =========================================================================
   2) FLATTEN config into one linear list of steps.
      Each step knows its section + the item/question it renders.
   ========================================================================= */
function buildSteps() {
    const steps = [];
    SECTIONS.forEach(section => {
        if (section.type === 'pick') {
            section.items.forEach((item, idx) => {
                steps.push({ section, kind: 'pick', item, idx, respKey: `${section.id}:${item.key}` });
            });
        } else {
            section.questions.forEach((q, idx) => {
                steps.push({ section, kind: 'quiz', question: q, idx, respKey: `${section.id}:${idx}` });
            });
        }
    });
    return steps;
}

const STEPS = buildSteps();

/* =========================================================================
   3) STATE — single source of truth. Every score/badge/progress value is
      DERIVED from `responses`, never stored redundantly.
   ========================================================================= */
const state = {
    current: 0,
    responses: {}, // respKey -> points earned (0 if not yet answered/skipped-out)
    answered: {},  // respKey -> true once the student has made a choice
    startTime: Date.now(),
};

function totalScore() {
    return Object.values(state.responses).reduce((sum, pts) => sum + pts, 0);
}

function answeredCountFor(sectionId) {
    return STEPS.filter(s => s.section.id === sectionId && state.answered[s.respKey]).length;
}

function sectionComplete(section) {
    if (section.type === 'pick') {
        const chosen = section.items.filter(item => state.responses[`${section.id}:${item.key}`] > 0).length;
        return chosen >= section.minRequired;
    }
    return answeredCountFor(section.id) >= section.questions.length;
}

function earnedBadges() {
    const earned = SECTIONS.filter(sectionComplete).map(s => ({ key: s.badgeKey, name: s.badgeName, emoji: s.badgeEmoji }));
    if (totalScore() >= MASTER_BADGE.threshold) earned.push(MASTER_BADGE);
    return earned;
}

function allComplete() {
    return SECTIONS.every(sectionComplete);
}

/* =========================================================================
   4) RENDER — one function draws whatever the current step is.
   ========================================================================= */
function render() {
    renderStatusBar();
    renderDots();
    if (state.current >= STEPS.length) {
        renderReview();
    } else {
        renderStep(STEPS[state.current]);
    }
}

function renderStatusBar() {
    document.getElementById('statScore').textContent = totalScore();
    document.getElementById('statStep').textContent = `${Math.min(state.current + 1, STEPS.length)}/${STEPS.length}`;
    document.getElementById('statBadges').textContent = `${earnedBadges().length}/5`;
    const pct = Math.round((Math.min(state.current, STEPS.length) / STEPS.length) * 100);
    document.getElementById('progressFill').style.width = pct + '%';
}

function renderDots() {
    const track = document.getElementById('dotTrack');
    track.innerHTML = '';
    STEPS.forEach((s, i) => {
        const dot = document.createElement('span');
        dot.className = 'dot' + (i < state.current ? ' done' : i === state.current ? ' current' : '');
        track.appendChild(dot);
    });
}

function renderStep(step) {
    const stage = document.getElementById('stepStage');
    const sectionIdxWithin = step.idx + 1;
    const sectionTotal = step.section.type === 'pick' ? step.section.items.length : step.section.questions.length;
    const already = state.responses[step.respKey];
    const isAnswered = !!state.answered[step.respKey];

    let bodyHtml = '';
    if (step.kind === 'pick') {
        const item = step.item;
        bodyHtml = `
            <div class="step-icon">${item.icon}</div>
            <div class="step-title">${item.name}</div>
            <div class="step-sub">${item.info}</div>
            <div class="kit-choice-row">
                <button class="choice-btn ${isAnswered && already > 0 ? 'chosen' : ''}" data-choice="yes">Isama sa Kit <span class="choice-points">+${item.points}</span></button>
                <button class="choice-btn ${isAnswered && already === 0 ? 'chosen' : ''}" data-choice="no">Laktawan</button>
            </div>`;
    } else {
        const q = step.question;
        bodyHtml = `
            <div class="step-title" style="font-size:1.15rem; text-align:left;">${q.text}</div>
            <div class="choice-list" style="margin-top:14px;">
                ${q.options.map(opt => `
                    <button class="choice-btn ${isAnswered && state.responses[step.respKey + ':' + opt.value] !== undefined ? '' : ''}"
                            data-choice="${opt.value}" data-points="${opt.points}">
                        ${opt.text}
                    </button>
                `).join('')}
            </div>`;
    }

    stage.innerHTML = `
        <div class="section-tag">${step.section.icon} ${step.section.title}</div>
        <div class="step-counter">Item ${sectionIdxWithin} ng ${sectionTotal} sa bahaging ito</div>
        <div class="step-body">${bodyHtml}</div>
        <div class="step-nav">
            <button class="nav-btn back ${state.current === 0 ? 'invisible' : ''}" id="backBtn">⬅ Bumalik</button>
            <button class="nav-btn next" id="nextBtn" ${isAnswered ? '' : 'disabled'}>Susunod ➡</button>
        </div>
    `;

    // wire up choice buttons
    stage.querySelectorAll('.choice-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (step.kind === 'pick') {
                const chosenYes = btn.dataset.choice === 'yes';
                state.responses[step.respKey] = chosenYes ? step.item.points : 0;
            } else {
                const q = step.question;
                const opt = q.options.find(o => o.value === btn.dataset.choice);
                state.responses[step.respKey] = opt.points;
            }
            state.answered[step.respKey] = true;
            renderStep(step); // re-render this same step to show selection + enable Next
            renderStatusBar();
        });
    });

    document.getElementById('backBtn').addEventListener('click', () => {
        if (state.current > 0) { state.current--; render(); }
    });
    document.getElementById('nextBtn').addEventListener('click', () => {
        if (!state.answered[step.respKey]) return;
        state.current++;
        render();
    });
}

function renderReview() {
    const stage = document.getElementById('stepStage');
    const rows = STEPS.map(s => {
        const label = s.kind === 'pick' ? s.item.name : `${s.section.title} #${s.idx + 1}`;
        const pts = state.responses[s.respKey] ?? 0;
        return `<div class="review-row"><span>${label}</span><span class="pts">+${pts}</span></div>`;
    }).join('');

    stage.innerHTML = `
        <div class="section-tag">✅ Buod</div>
        <div class="step-title">Suriin ang Iyong Sagot</div>
        <div class="step-sub">Kabuuang Iskor: ${totalScore()}/100</div>
        <div class="review-list">${rows}</div>
        <div class="step-nav">
            <button class="nav-btn back" id="backBtn">⬅ Bumalik</button>
            <button class="nav-btn next" id="submitBtn" ${allComplete() ? '' : 'disabled'}>📤 Ipasa ang Gawain</button>
        </div>
        ${allComplete() ? '' : '<p style="text-align:center; color:#8a3b2b; font-size:0.8rem; margin-top:10px;">Kumpletuhin muna ang lahat ng bahagi (bumalik at sagutan ang natitira).</p>'}
    `;

    document.getElementById('backBtn').addEventListener('click', () => {
        state.current = STEPS.length - 1;
        render();
    });
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) submitBtn.addEventListener('click', submitTask);
}

/* =========================================================================
   5) SUBMIT / SAVE
   ========================================================================= */
function submitTask() {
    const modal = document.getElementById('resultsModal');
    const timeTaken = Math.floor((Date.now() - state.startTime) / 1000);
    const minutes = Math.floor(timeTaken / 60);
    const seconds = timeTaken % 60;
    const score = totalScore();
    const badges = earnedBadges();

    document.getElementById('finalScore').textContent = score;
    document.getElementById('resultBadges').textContent = badges.length;
    document.getElementById('resultTime').textContent = `${minutes}m ${seconds}s`;

    let feedback;
    if (score >= 90) feedback = '🌟 Napakahusay! Ang iyong plano ay kumpleto at pinag-isipang mabuti!';
    else if (score >= 75) feedback = '👍 Magaling! Saklaw ng iyong plano ang mahahalagang bahagi.';
    else if (score >= 60) feedback = '📋 Magandang simula! Suriin ang mga bahaging nakaligtaan.';
    else feedback = '💡 Nagsisimula ka pa lamang. Kumpletuhin ang lahat ng bahagi para sa ganap na kaligtasan.';
    document.getElementById('resultFeedback').textContent = feedback;

    const badgesDisplay = document.getElementById('resultBadgesDisplay');
    badgesDisplay.innerHTML = badges.map(b => `
        <div class="badge-chip"><div class="emoji">${b.emoji}</div><div class="name">${b.name}</div></div>
    `).join('');

    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

document.getElementById('saveResultBtn').addEventListener('click', function () {
    const timeTaken = Math.floor((Date.now() - state.startTime) / 1000);

    // Build section score breakdown from the single responses map — no recomputation elsewhere.
    const sectionScores = {};
    SECTIONS.forEach(section => {
        sectionScores[section.id] = STEPS
            .filter(s => s.section.id === section.id)
            .reduce((sum, s) => sum + (state.responses[s.respKey] ?? 0), 0);
    });

    const selectedItems = SECTIONS.find(s => s.id === 'kit').items
        .filter(item => (state.responses[`kit:${item.key}`] ?? 0) > 0)
        .map(item => ({ item: item.name, points: item.points }));

    fetch("{{ route('student.module3.performance-task.store') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({
            score: totalScore(),
            badges: earnedBadges().map(b => b.key),
            completionTime: timeTaken,
            selectedItems: selectedItems,
            answers: state.responses,
            kitScore: sectionScores.kit,
            evacuationScore: sectionScores.evacuation,
            communicationScore: sectionScores.communication,
            safeScore: sectionScores.safe,
        }),
    })
    .then(res => res.json())
    .then(() => {
        window.location.href = "{{ route('module3.buod') }}";
    })
    .catch(err => console.error(err));
});

/* =========================================================================
   6) INIT
   ========================================================================= */
document.addEventListener('DOMContentLoaded', function () {
    render();

    if (!sessionStorage.getItem('module3RubricsShown')) {
        document.getElementById('rubricsModal').classList.add('show');
        document.body.style.overflow = 'hidden';
        sessionStorage.setItem('module3RubricsShown', 'true');
    }
});

function closeRubrics() {
    document.getElementById('rubricsModal').classList.remove('show');
    document.body.style.overflow = '';
}
</script>

@endsection