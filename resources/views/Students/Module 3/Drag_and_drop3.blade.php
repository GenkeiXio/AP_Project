@extends('Students.studentslayout')
@section('title', 'Balik-Aral Module 3')

@push('styles')
<style>
:root {
    --green:#1f7a47;
    --green2:#59ab44;
    --soft:#f4fff6;
    --blue:#e8f4ff;
    --red:#ffe7e7;
    --ink:#23422c;
    --shadow:0 14px 30px rgba(27, 73, 41, 0.12);
}

body, html {
    margin: 0;
    padding: 0;
    min-height: 100%;
    background: linear-gradient(145deg, #eefaf1 0%, #f7fff7 45%, #fffaf0 100%);
}

.dd-wrap {
    max-width: 1200px;
    margin: 24px auto;
    padding: 0 16px 28px;
}

.dd-hero {
    background: rgba(255,255,255,0.92);
    border: 2px solid #d8eadb;
    border-radius: 20px;
    padding: 20px;
    box-shadow: var(--shadow);
}

.dd-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 999px;
    background: linear-gradient(180deg, #245e3b, #1f4f32);
    color: #fff;
    font-weight: 900;
    letter-spacing: .04em;
}

.dd-title {
    margin: 14px 0 10px;
    color: var(--ink);
    font-size: clamp(1.35rem, 2.8vw, 2.2rem);
    line-height: 1.25;
    font-weight: 900;
}

.dd-sub {
    margin: 0;
    color: #496d54;
    line-height: 1.55;
}

.dd-meta {
    margin-top: 14px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

.dd-pill {
    background: #f6fbf4;
    border: 1px solid #d7e8d3;
    border-radius: 999px;
    padding: 8px 12px;
    font-weight: 800;
    color: #31523d;
}

.dd-time {
    color: #c0392b;
    font-weight: 900;
}

.dd-layout {
    margin-top: 16px;
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 16px;
}

.panel {
    background: rgba(255,255,255,0.92);
    border: 2px solid #dfece2;
    border-radius: 18px;
    box-shadow: var(--shadow);
    padding: 16px;
}

.panel h3 {
    margin: 0 0 10px;
    color: #235038;
}

.cards,
.zones {
    display: grid;
    gap: 12px;
}

.card-item {
    border-radius: 16px;
    border: 2px solid #d8e7d8;
    background: linear-gradient(180deg, #fff, #f8fff7);
    overflow: hidden;
    cursor: grab;
    transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease, opacity .16s ease;
    box-shadow: 0 10px 18px rgba(54, 79, 43, .08);
    user-select: none;
}

.card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 22px rgba(54, 79, 43, .12);
}

.card-item.dragging {
    opacity: .6;
    transform: scale(.98);
}

.card-item.correct {
    border-color: #27ae60;
    box-shadow: 0 0 0 4px rgba(39, 174, 96, .15), 0 12px 22px rgba(39, 174, 96, .12);
}

.card-item.wrong {
    border-color: #e74c3c;
    box-shadow: 0 0 0 4px rgba(231, 76, 60, .18), 0 12px 22px rgba(231, 76, 60, .10);
    animation: shake .35s ease;
}

.card-img {
    width: 100%;
    height: 170px;
    object-fit: contain;
    display: block;
    background: #fff;
}

.card-label {
    padding: 10px 12px 12px;
    font-weight: 900;
    color: #294c35;
    text-align: center;
}

.zone {
    min-height: 170px;
    border-radius: 18px;
    border: 3px dashed #a8c9ad;
    background: linear-gradient(180deg, rgba(250,255,248,.98), rgba(240,248,236,.98));
    padding: 12px;
    transition: transform .16s ease, border-color .16s ease, box-shadow .16s ease;
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: relative;
}

.zone.over {
    transform: translateY(-2px);
    border-color: #59ab44;
    box-shadow: 0 0 0 4px rgba(89, 171, 68, .14);
}

.zone.correct-zone {
    border-style: solid;
}

.zone-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}

.zone-name {
    font-weight: 900;
    color: #264b34;
}

.zone-status {
    font-size: .78rem;
    font-weight: 900;
    color: #7c6a4c;
    background: #fffdf4;
    border: 1px solid #d8dfc2;
    padding: 6px 10px;
    border-radius: 999px;
}

.zone-body {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    border: 1px dashed #d4e3d6;
    padding: 10px;
    position: relative;
    overflow: hidden;
}

.zone-placeholder {
    text-align: center;
    color: #7a8a72;
    font-weight: 800;
    line-height: 1.45;
}

.zone-card {
    width: 100%;
    max-width: 320px;
    border-radius: 14px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #d9e7dc;
    box-shadow: 0 8px 16px rgba(0,0,0,.08);
}

.zone-card img {
    width: 100%;
    height: 140px;
    object-fit: contain;
    display: block;
    background: #fff;
}

.zone-card .zone-card-label {
    padding: 8px 10px 10px;
    font-weight: 900;
    text-align: center;
    color: #23422c;
}

.dd-actions {
    margin-top: 14px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.dd-btn {
    border: none;
    border-radius: 12px;
    padding: 11px 16px;
    font-weight: 900;
    cursor: pointer;
    transition: transform .16s ease, box-shadow .16s ease, opacity .16s ease;
}

.dd-btn:hover {
    transform: translateY(-2px);
}

.dd-primary {
    background: linear-gradient(180deg, #7fd46a, #59ab44);
    color: #103620;
}

.dd-ghost {
    background: #eef8ef;
    color: #27563b;
    border: 1px solid #cfe2d1;
}

.dd-result {
    margin-top: 16px;
    background: rgba(255,255,255,0.95);
    border: 2px solid #dcecdf;
    border-radius: 18px;
    padding: 16px;
    box-shadow: var(--shadow);
}

.dd-feedback {
    margin: 0;
    font-weight: 900;
    color: #254b35;
}

.dd-key {
    margin-top: 12px;
    display: grid;
    gap: 8px;
}

.dd-key-item {
    padding: 10px 12px;
    border-radius: 12px;
    background: #f8fff8;
    border: 1px solid #d9e8dc;
    color: #345844;
    line-height: 1.45;
}

.dd-next {
    margin-top: 12px;
}

.dd-next[disabled] {
    opacity: .55;
    cursor: not-allowed;
}

@keyframes shake {
    0%,100% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    75% { transform: translateX(6px); }
}

@media (max-width: 900px) {
    .dd-layout { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="dd-wrap">
    <section class="dd-hero">
        <div class="dd-badge">III. BALIK-ARAL</div>
        <h1 class="dd-title">Iugnay Mo Ako!</h1>
        <p class="dd-sub">Guiding Question: “Paano nagiging sanhi ng sakuna ang mga suliraning pangkapaligiran?”</p>
        <div class="dd-meta">
            <div class="dd-pill">⏱️ Timer: <span class="dd-time" id="timerText">30</span>s</div>
            <div class="dd-pill">⭐ Points: <span id="scoreText">0</span></div>
            <div class="dd-pill">🟢 Correct: <span id="correctText">0</span>/3</div>
        </div>
        <div class="dd-actions">
            <button class="dd-btn dd-primary" id="checkBtn" type="button">Ipakita ang Iskor at Tamang Sagot</button>
            <button class="dd-btn dd-ghost" id="resetBtn" type="button">🔁 Reset</button>
            <a class="dd-btn dd-ghost" href="{{ route('module3.home') }}" style="text-decoration:none;display:inline-flex;align-items:center;">⬅ Bumalik</a>
        </div>
    </section>

    <section class="dd-layout">
        <div class="panel">
            <h3>🧩 DRAG ITEMS</h3>
            <div class="cards" id="cardsRoot">
                <div class="card-item" draggable="true" data-id="solid" data-zone="flood">
                    <img class="card-img" src="{{ asset('pictures/solidwaste.png') }}" alt="Solid Waste">
                    <div class="card-label">🗑️ Solid Waste</div>
                </div>
                <div class="card-item" draggable="true" data-id="forest" data-zone="landslide">
                    <img class="card-img" src="{{ asset('pictures/deforestation.png') }}" alt="Deforestation">
                    <div class="card-label">🌳 Deforestation</div>
                </div>
                <div class="card-item" draggable="true" data-id="climate" data-zone="storm">
                    <img class="card-img" src="{{ asset('pictures/climate_change.jpg') }}" alt="Climate Change">
                    <div class="card-label">🌍 Climate Change</div>
                </div>
            </div>
        </div>

        <div class="panel">
            <h3>📥 DROP ZONES</h3>
            <div class="zones" id="zonesRoot">
                <div class="zone" data-zone="flood">
                    <div class="zone-header">
                        <div class="zone-name">🌊 Pagbaha at paglaganap ng sakit</div>
                        <div class="zone-status" id="status-flood">Hintay...</div>
                    </div>
                    <div class="zone-body">
                        <div class="zone-placeholder">I-drop dito ang tamang suliranin</div>
                    </div>
                </div>

                <div class="zone" data-zone="landslide">
                    <div class="zone-header">
                        <div class="zone-name">⛰️ Pagguho ng lupa at pagbaha</div>
                        <div class="zone-status" id="status-landslide">Hintay...</div>
                    </div>
                    <div class="zone-body">
                        <div class="zone-placeholder">I-drop dito ang tamang suliranin</div>
                    </div>
                </div>

                <div class="zone" data-zone="storm">
                    <div class="zone-header">
                        <div class="zone-name">🌪️ Mas malalakas na bagyo at matinding init</div>
                        <div class="zone-status" id="status-storm">Hintay...</div>
                    </div>
                    <div class="zone-body">
                        <div class="zone-placeholder">I-drop dito ang tamang suliranin</div>
                    </div>
                </div>
            </div>

            <div class="dd-result" id="resultBox">
                <p class="dd-feedback" id="feedbackText">Panuto: I-drag ang bawat suliranin papunta sa tamang epekto.</p>
                <div class="dd-key" id="answerKey" style="display:none;"></div>
                <div class="dd-actions dd-next">
                    <button class="dd-btn dd-primary" id="nextBtn" type="button">Magpatuloy</button>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
const mapping = {
    solid: {
        zone: 'flood',
        label: '🗑️ Solid Waste → 🌊 Pagbaha at paglaganap ng sakit'
    },
    forest: {
        zone: 'landslide',
        label: '🌳 Deforestation → ⛰️ Pagguho ng lupa at pagbaha'
    },
    climate: {
        zone: 'storm',
        label: '🌍 Climate Change → 🌪️ Mas malalakas na bagyo at matinding init'
    }
};
  
let audioCtx = null;

function getAudioContext() {
    if (!(window.AudioContext || window.webkitAudioContext)) return null;
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    if (audioCtx.state === 'suspended') {
        audioCtx.resume();
    }
    return audioCtx;
}

function playTone({ type = 'sine', frequency = 440, duration = 0.12, volume = 0.05, delay = 0 }) {
    const ctx = getAudioContext();
    if (!ctx) return;

    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    const startAt = ctx.currentTime + delay;

    osc.type = type;
    osc.frequency.setValueAtTime(frequency, startAt);
    gain.gain.setValueAtTime(volume, startAt);
    gain.gain.exponentialRampToValueAtTime(0.0001, startAt + duration);

    osc.connect(gain);
    gain.connect(ctx.destination);
    osc.start(startAt);
    osc.stop(startAt + duration);
}

const correctSound = () => {
    playTone({ type: 'sine', frequency: 640, duration: 0.12, volume: 0.05 });
    playTone({ type: 'sine', frequency: 820, duration: 0.12, volume: 0.05, delay: 0.12 });
};

const errorSound = () => {
    playTone({ type: 'square', frequency: 180, duration: 0.16, volume: 0.055 });
};

const timerWarningSound = () => {
    playTone({ type: 'triangle', frequency: 900, duration: 0.1, volume: 0.05 });
    playTone({ type: 'triangle', frequency: 700, duration: 0.1, volume: 0.05, delay: 0.11 });
    playTone({ type: 'triangle', frequency: 900, duration: 0.1, volume: 0.05, delay: 0.22 });
};

const cardsRoot = document.getElementById('cardsRoot');
const zonesRoot = document.getElementById('zonesRoot');
const scoreText = document.getElementById('scoreText');
const correctText = document.getElementById('correctText');
const timerText = document.getElementById('timerText');
const feedbackText = document.getElementById('feedbackText');
const answerKey = document.getElementById('answerKey');
const checkBtn = document.getElementById('checkBtn');
const resetBtn = document.getElementById('resetBtn');
const nextBtn = document.getElementById('nextBtn');

let score = 0;
let correctCount = 0;
let seconds = 30;
let timerId = null;
let gameEnded = false;
let placed = {};
let warnedAtTen = false;

function renderKey() {
    answerKey.innerHTML = Object.values(mapping).map(item => `<div class="dd-key-item">${item.label}</div>`).join('');
}

function startTimer() {
    clearInterval(timerId);
    timerId = setInterval(() => {
        seconds -= 1;
        timerText.textContent = seconds;

        if (seconds === 10 && correctCount < 3 && !warnedAtTen) {
            warnedAtTen = true;
            timerWarningSound();
            feedbackText.textContent = 'Babala: 10 segundo na lang! Kumpletuhin ang tamang pag-uugnay.';
        }

        if (seconds <= 0) {
            clearInterval(timerId);
            finalizeQuiz(true);
        }
    }, 1000);
}

function resetTimer() {
    clearInterval(timerId);
    seconds = 30;
    timerText.textContent = seconds;
    startTimer();
}

function updateStats() {
    scoreText.textContent = score;
    correctText.textContent = correctCount;
}

function clearZone(zoneEl) {
    const placeholder = zoneEl.querySelector('.zone-placeholder');
    zoneEl.querySelectorAll('.zone-card').forEach(n => n.remove());
    if (!placeholder) {
        const body = zoneEl.querySelector('.zone-body');
        body.innerHTML = '<div class="zone-placeholder">I-drop dito ang tamang suliranin</div>';
    }
}

function setZoneCard(zoneEl, card, labelText) {
    const body = zoneEl.querySelector('.zone-body');
    body.innerHTML = '';
    card.classList.remove('dragging', 'wrong');
    card.classList.add('correct');
    card.setAttribute('draggable', 'false');
    card.querySelector('.card-label').textContent = labelText;
    card.style.cursor = 'default';
    card.style.width = '100%';
    body.appendChild(card);
}

function markStatus(zoneName, state) {
    const el = document.getElementById(`status-${zoneName}`);
    if (!el) return;
    el.textContent = state;
}

function handleDrop(card, zoneEl) {
    if (gameEnded) return;
    const cardId = card.dataset.id;
    const expected = mapping[cardId].zone;
    const zoneName = zoneEl.dataset.zone;

    if (zoneName === expected) {
        placed[cardId] = true;
        correctCount += 1;
        score += 1;
        updateStats();
        markStatus(zoneName, 'Tama ✓');
        card.classList.add('correct');
        setZoneCard(zoneEl, card, card.querySelector('.card-label').textContent);
        feedbackText.textContent = 'Magaling! 🎉 Natukoy mo ang tamang ugnayan ng suliranin at epekto.';
        correctSound();
    } else {
        card.classList.add('wrong');
        errorSound();
        feedbackText.textContent = 'Subukan muli! May ilang hindi tugma. Basahing muli ang mga konsepto at i-drag ulit.';
        setTimeout(() => card.classList.remove('wrong'), 350);
    }

    if (correctCount === 3) {
        finalizeQuiz(false);
    }
}

function finalizeQuiz(fromTimer) {
    if (gameEnded) return;
    gameEnded = true;
    clearInterval(timerId);

    // reveal all correct answers
    answerKey.style.display = 'grid';
    renderKey();
    answerKey.style.display = 'grid';

    if (fromTimer) {
        feedbackText.textContent = 'Natapos ang oras. Narito ang tamang sagot at ang iyong iskor.';
    }

    nextBtn.disabled = false;
    nextBtn.textContent = 'Magpatuloy';
}

function resetGame() {
    gameEnded = false;
    score = 0;
    correctCount = 0;
    placed = {};
    warnedAtTen = false;
    updateStats();
    resetTimer();
    feedbackText.textContent = 'Panuto: I-drag ang bawat suliranin papunta sa tamang epekto.';
    answerKey.style.display = 'none';
    nextBtn.disabled = false;
    nextBtn.textContent = 'Magpatuloy';

    document.querySelectorAll('.zone').forEach(zone => {
        const body = zone.querySelector('.zone-body');
        body.innerHTML = '<div class="zone-placeholder">I-drop dito ang tamang suliranin</div>';
        markStatus(zone.dataset.zone, 'Hintay...');
    });

    document.querySelectorAll('.card-item').forEach(card => {
        card.classList.remove('dragging', 'wrong', 'correct');
        card.setAttribute('draggable', 'true');
        cardsRoot.appendChild(card);
    });
}

// drag events
let draggedCard = null;

document.querySelectorAll('.card-item').forEach(card => {
    card.addEventListener('dragstart', () => {
        draggedCard = card;
        card.classList.add('dragging');
    });

    card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        draggedCard = null;
    });
});

document.querySelectorAll('.zone').forEach(zone => {
    zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.classList.add('over');
    });

    zone.addEventListener('dragleave', () => zone.classList.remove('over'));

    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('over');
        if (!draggedCard) return;
        handleDrop(draggedCard, zone);
    });
});

checkBtn.addEventListener('click', () => {
    finalizeQuiz(false);
    feedbackText.textContent = `Magaling! 🎉 Natukoy mo ang tamang ugnayan ng suliranin at epekto. Iskor: ${score}/3.`;
});

nextBtn.addEventListener('click', () => {
    window.location.href = '{{ route("module3.iv_explore") }}';
});

renderKey();
resetGame();
startTimer();
</script>
@endsection
