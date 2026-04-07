{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module3\Nodes\mod3_node2.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Module 3 - Node 2')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

:root{
    --brown-1:#4b3729;
    --brown-2:#6a4c3a;
    --paper:#fffdf9;
    --paper-2:#f8f4ee;
    --mint:#6fb7a8;
    --mint-dark:#3f8e7f;
    --mint-soft:#e8f6f2;
    --line:#dccfbe;
    --text:#3d2f26;
    --muted:#726459;
    --ok:#2f8f71;
    --bad:#b44a3f;
    --gold:#c9972f;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:
        radial-gradient(circle at 8% 10%, rgba(111,183,168,.18), transparent 28%),
        radial-gradient(circle at 92% 88%, rgba(201,151,47,.18), transparent 30%),
        linear-gradient(145deg,var(--brown-1),var(--brown-2));
    min-height:100vh;
}

.back-btn{
    position:fixed;
    top:90px;
    left:20px;
    z-index:30;
    text-decoration:none;
    color:#3b2d23;
    font-weight:800;
    background:linear-gradient(135deg,#fff,#ecf8f4);
    border:1px solid #bee4da;
    border-radius:12px;
    padding:10px 14px;
    box-shadow:0 10px 20px rgba(0,0,0,.2);
    transition:.2s ease;
}
.back-btn:hover{ transform:translateY(-2px); }

.wrapper{
    max-width:1100px;
    margin:auto;
    padding:30px 18px 26px;
}

.card{
    background:linear-gradient(180deg,var(--paper),var(--paper-2));
    border-radius:24px;
    border:1px solid rgba(255,255,255,.4);
    box-shadow:0 25px 55px rgba(0,0,0,.26);
    overflow:hidden;
}

.top{
    padding:20px;
    border-bottom:1px solid #e8dccb;
    background:linear-gradient(135deg,#fff,#eef8f5);
}
.title{
    font-size:1.8rem;
    font-weight:800;
    margin:0;
    background:linear-gradient(90deg,#5d3f2f,#3f8e7f,#72bba9);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.subtitle{
    margin:6px 0 0;
    color:var(--muted);
    font-size:.92rem;
}

.hud{
    margin-top:12px;
    display:flex;
    gap:8px;
    flex-wrap:wrap;
}
.pill{
    border-radius:999px;
    padding:7px 11px;
    font-size:.8rem;
    font-weight:800;
    font-family:'Nunito',sans-serif;
    border:1px solid #d4ebe4;
    background:#f3fbf8;
    color:#2f6559;
}
.pill.gold{
    border-color:#e5d39d;
    background:linear-gradient(135deg,#fff9e7,#f7edd0);
    color:#6e4f14;
}

.body{
    padding:18px;
}

.hero{
    display:grid;
    grid-template-columns:180px 1fr;
    gap:14px;
    align-items:start;
    border:1px solid var(--line);
    border-radius:16px;
    padding:14px;
    background:linear-gradient(135deg,#fff,#f0faf7);
}
@media (max-width:760px){
    .hero{
        grid-template-columns:1fr;
        text-align:center;
    }
}

.mayor-wrap{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:160px;
}
.mayor-icon{
    width:140px;   /* bigger */
    height:140px;  /* bigger */
    object-fit:contain;
    border-radius:50%;
    background:linear-gradient(135deg,#f2fffb,#e7f6f1);
    border:1px solid #cde9e0;
    padding:10px;
    box-shadow:0 8px 14px rgba(0,0,0,.14);
}
@media (max-width:760px){
    .mayor-icon{
        width:128px;
        height:128px;
    }
}

.speech{
    background:#fff;
    border:1px solid #dcefe8;
    border-radius:14px;
    padding:12px 14px;
    color:#4f4138;
    font-size:.92rem;
    font-weight:600;
    box-shadow:0 8px 18px rgba(0,0,0,.06);
    min-height:58px;
    display:flex;
    align-items:center;
}
.typing{
    display:block;
    width:100%;
    white-space:normal;
    line-height:1.5;
    position:relative;
}
.typing::after{
    content:'|';
    margin-left:2px;
    color:#3f8e7f;
    animation:caretBlink .7s step-end infinite;
}
@keyframes caretBlink{
    50%{ opacity:0; }
}

.section-title{
    margin:18px 0 8px;
    color:#4a3a2f;
    font-size:1.02rem;
    font-weight:800;
}

.choice-container{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}
@media (max-width:900px){
    .choice-container{ grid-template-columns:1fr; }
}

.choice-card{
    border-radius:16px;
    border:1px solid #d9ece6;
    background:linear-gradient(135deg,#fff,#f5fbf9);
    padding:14px;
    transition:.22s ease;
    position:relative;
}
.choice-card:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 24px rgba(0,0,0,.10);
}
.choice-card.active{
    border-color:#9ed5c7;
    box-shadow:0 0 0 4px rgba(111,183,168,.16);
}

.choice-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
}
.choice-head h3{
    margin:0;
    font-size:1.05rem;
    color:#3f3026;
}
.read-btn{
    border:none;
    border-radius:10px;
    padding:8px 11px;
    cursor:pointer;
    font-weight:700;
    background:#e9f7f2;
    color:#2b6759;
    transition:.18s;
}
.read-btn:hover{ transform:translateY(-1px); }

.hidden-text{
    max-height:220px;
    overflow-y:auto;
    opacity:1;
    margin-top:10px;
    transition:max-height .35s ease, opacity .25s ease, margin-top .2s ease;
    color:#5f5349;
    line-height:1.58;
    font-size:.92rem;
    padding-right:6px;
    border-top:1px dashed #d5ebe3;
    padding-top:10px;
}
.hidden-text.show{
    max-height:220px;
    opacity:1;
    margin-top:10px;
}

.hidden-text::-webkit-scrollbar{
    width:8px;
}
.hidden-text::-webkit-scrollbar-track{
    background:#edf6f3;
    border-radius:999px;
}
.hidden-text::-webkit-scrollbar-thumb{
    background:linear-gradient(#8fcdbc,#5cae9d);
    border-radius:999px;
}
.hidden-text{
    scrollbar-color:#5cae9d #edf6f3;
    scrollbar-width:thin;
}

.choose-section{
    display:none;
    margin-top:14px;
    text-align:center;
    border:1px dashed #bfded5;
    border-radius:14px;
    background:#f5fbf9;
    padding:14px;
    animation:popIn .35s ease;
}
@keyframes popIn{
    from{ opacity:0; transform:scale(.96); }
    to{ opacity:1; transform:scale(1); }
}

.game-btn{
    position:relative;
    border:none;
    border-radius:12px;
    padding:11px 14px;
    margin:6px;
    cursor:pointer;
    font-weight:800;
    transition:.18s;
}
.game-btn:hover{ transform:translateY(-2px); }
.btn-top{
    background:linear-gradient(135deg,#fff2ef,#ffe6e0);
    color:#9b3c33;
}
.btn-bottom{
    background:linear-gradient(135deg,#ecfff9,#dff7f0);
    color:#23685a;
}

.challenge{
    display:none;
    margin-top:16px;
    border:1px solid var(--line);
    border-radius:16px;
    background:#fff;
    padding:14px;
    animation:fadeIn .35s ease;
}
@keyframes fadeIn{
    from{ opacity:0; transform:translateY(10px); }
    to{ opacity:1; transform:translateY(0); }
}

.progress{
    height:10px;
    border-radius:999px;
    border:1px solid #d9ccb9;
    background:#f2e8d8;
    overflow:hidden;
}
.progress-fill{
    width:0%;
    height:100%;
    background:linear-gradient(90deg,#c9972f,#59ad9b);
    transition:width .35s ease;
}

.timer{
    margin-top:10px;
    font-weight:800;
    color:#7a4d2b;
    font-size:.88rem;
}

.prompt{
    margin:12px 0 10px;
    font-weight:700;
    color:#433429;
}

.arg-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
}
@media (max-width:760px){
    .arg-grid{ grid-template-columns:1fr; }
}
.arg-btn{
    border:1px solid #dceee8;
    background:linear-gradient(135deg,#fff,#eef8f5);
    color:#3f2f24;
    text-align:left;
    border-radius:12px;
    padding:12px;
    cursor:pointer;
    font-weight:700;
    transition:.18s ease;
}
.arg-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 18px rgba(0,0,0,.08);
}

.status{
    margin-top:12px;
    min-height:22px;
    font-weight:700;
    font-size:.9rem;
}
.status.ok{ color:var(--ok); }
.status.bad{ color:var(--bad); }

.result{
    display:none;
    margin-top:16px;
    border-radius:14px;
    border:1px solid #cbe7dd;
    background:linear-gradient(135deg,#effbf7,#e4f6f0);
    padding:14px;
    text-align:center;
}
.result h3{
    margin:0 0 6px;
    color:#2a6b5d;
}

.cons-wrap{
    text-align:left;
    margin-top:12px;
    border-radius:12px;
    padding:12px;
    border:1px solid #d7e9e3;
    background:#f8fffc;
}
.cons-wrap.bad{
    border-color:#f0d0cb;
    background:#fff8f6;
}
.cons-wrap.good{
    border-color:#c8e7dd;
    background:#f4fcf8;
}
.cons-wrap h4{
    margin:0 0 8px;
    font-size:.95rem;
}
.cons-wrap ul{
    margin:0;
    padding-left:18px;
}
.cons-wrap li{
    margin:6px 0;
    color:#4f4138;
    line-height:1.45;
    font-size:.9rem;
}

.actions a{
    display:inline-block;
    text-decoration:none;
    font-weight:800;
    margin:6px 4px 0;
    padding:10px 12px;
    border-radius:10px;
}
.act-retry{ background:#edf8f5; border:1px solid #c8e8de; color:#2d6d5f; }
.act-map{ background:#f5f1ea; border:1px solid #e0d2be; color:#5f4f3f; }
.act-next{ background:linear-gradient(135deg,#5cae9d,#3f8e7f); color:#fff; }

.modal-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:40;
}
.modal-box{
    width:min(420px,92vw);
    background:#fff;
    border-radius:16px;
    padding:18px;
    text-align:center;
    animation:pop .25s ease;
}
@keyframes pop{
    from{ transform:scale(.92); opacity:0; }
    to{ transform:scale(1); opacity:1; }
}
.modal-btn{
    margin-top:10px;
    border:none;
    border-radius:10px;
    padding:10px 14px;
    font-weight:700;
    cursor:pointer;
}
.btn-close{ background:#f0f0f0; color:#333; }
.btn-next{ background:#2f8f71; color:#fff; }

#confettiLayer{
    position:fixed;
    inset:0;
    pointer-events:none;
    z-index:50;
}
.confetti-piece{
    position:absolute;
    width:8px;
    height:14px;
    opacity:.95;
    animation:fall 1.5s linear forwards;
}
@keyframes fall{
    to{ transform:translateY(320px) rotate(360deg); opacity:0; }
}
</style>

<a href="{{ route('inner.map3') }}" class="back-btn">⬅ Bumalik</a>

<div class="wrapper">
    <div class="card">
        <div class="top">
            <h1 class="title">🟦 APPROACHES → DEBATE GAME</h1>
            <p class="subtitle">
                Guiding Question: Paano nakaaapekto ang hazard, vulnerability, at risk sa pagkakaroon ng disaster?
            </p>
            <div class="hud">
                <div class="pill" id="roundPill">Round 1/3</div>
                <div class="pill gold" id="scorePill">Score: 0</div>
                <div class="pill" id="lifePill">Buhay: ❤️❤️❤️</div>
            </div>
        </div>

        <div class="body">
            <div class="hero">
                <div class="mayor-wrap">
                    <img
                        class="mayor-icon"
                        alt="Mayor icon"
                        src="{{ asset('pictures/mayor.png') }}"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22%3E%3Ccircle cx=%2264%22 cy=%2264%22 r=%2262%22 fill=%22%23e9f7f2%22/%3E%3Ccircle cx=%2264%22 cy=%2242%22 r=%2220%22 fill=%22%23f1c27d%22/%3E%3Crect x=%2238%22 y=%2264%22 width=%2252%22 height=%2238%22 rx=%2212%22 fill=%22%233f8e7f%22/%3E%3C/svg%3E';"
                    />
                </div>
                <div class="speech">
                    <span class="typing" id="narratorText"></span>
                </div>
            </div>

            <h3 class="section-title">📘 Step 1: Basahin muna ang dalawang approach</h3>

            <div class="choice-container">
                <div class="choice-card active" id="topCard">
                    <div class="choice-head">
                        <h3>🔥 Top-down Approach</h3>
                        <button class="read-btn" onclick="reveal('top')">Basahin</button>
                    </div>
                    <div id="topText" class="hidden-text show">
                        Ang sistemang ito ay nakatuon sa pag-asa ng mga komunidad sa mas mataas na antas ng pamahalaan
                        (pambayan, panlungsod, o pambansa) sa lahat ng aspeto ng disaster management, mula pagpaplano hanggang
                        pagtugon. Gayunpaman, madalas itong nababatikos dahil nagiging mabagal ang aksyon at hindi agad
                        natutugunan ang pangangailangan ng mga mamamayan, lalo na ang mga pinakaapektado. Karaniwan ding
                        limitado ang mga plano dahil nakabatay lamang sa pananaw ng mga namumuno, habang napapabayaan ang
                        karanasan at boses ng komunidad. Bukod dito, ang hindi pagkakasundo ng pambansa at lokal na
                        pamahalaan ay nagiging sanhi ng pagkaantala sa epektibong pagtugon sa kalamidad.
                    </div>
                </div>

                <div class="choice-card active" id="bottomCard">
                    <div class="choice-head">
                        <h3>🌱 Bottom-up Approach</h3>
                        <button class="read-btn" onclick="reveal('bottom')">Basahin</button>
                    </div>
                    <div id="bottomText" class="hidden-text show">
                        Ang bottom-up approach sa pagtugon sa mga suliraning pangkapaligiran ay nakatuon sa aktibong
                        partisipasyon ng mga mamamayan at iba’t ibang sektor ng pamayanan sa pagtukoy, pag-aanalisa, at
                        paglutas ng mga problema. Mahalaga ang pamumuno ng lokal na komunidad, kasama ang lokal na
                        pamahalaan, pribadong sektor, at mga NGO, upang maisulong ang epektibong grassroots development.
                        Sa paraang ito, nabibigyang-halaga ang iba’t ibang pananaw at karanasan ng mga taong nakatira sa
                        disaster-prone areas, na nagsisilbing batayan ng mas angkop at makabuluhang plano. Nakatutulong din
                        ang maayos na pamamahala ng pondo at pagkilala sa matagumpay na implementasyon upang mapanatili ang
                        bisa ng programa, kung saan ang tagumpay ay nakasalalay sa malawakang pakikilahok ng komunidad sa
                        pagpaplano at pagdedesisyon.
                    </div>
                </div>
            </div>

            <div class="choose-section" id="chooseSection" style="display:block;">
                <h3 style="margin:0 0 6px;">👉 Step 2: Piliin ang debate side mo</h3>
                <button class="game-btn btn-top" onclick="chooseSide('top')">🔥 I-defend ang Top-down</button>
                <button class="game-btn btn-bottom" onclick="chooseSide('bottom')">🌱 I-defend ang Bottom-up</button>
            </div>

            <div class="challenge" id="challengeBox">
                <h3 style="margin:0;">⚖️ Step 3: Debate Rounds</h3>
                <div class="progress"><div class="progress-fill" id="progressFill"></div></div>
                <div class="timer" id="timerLabel">⏱ 15s</div>
                <div class="prompt" id="promptText"></div>
                <div class="arg-grid" id="argGrid"></div>
                <div class="status" id="statusText"></div>
            </div>

            <div class="result" id="resultBox"></div>
        </div>
    </div>
</div>

<div id="wrongModal" class="modal-overlay">
    <div class="modal-box">
        <h3>❌ Oops!</h3>
        <p id="wrongText">Nauubos ang oras. Sa debate, mahalaga ang bilis at linaw.</p>
        <button class="modal-btn btn-close" onclick="closeModal('wrongModal')">Subukan muli</button>
    </div>
</div>

<div id="successModal" class="modal-overlay">
    <div class="modal-box">
        <h3>🎉 Congrats, Mayor!</h3>
        <p>Naipakita mo ang mas matibay na argumento sa DRRM approaches.</p>
        <a href="{{ route('module3.node3') }}"><button class="modal-btn btn-next">Magpatuloy ➡</button></a>
    </div>
</div>

<div id="confettiLayer"></div>

<script>
const viewed = { top: true, bottom: true };
let chosenSide = null;
let score = 0;
let lives = 3;
let roundIndex = 0;
let timeLeft = 15;
let timer = null;

const narratorMessage = "Mayor ka ngayon. Basahin ang dalawang approach, piliin ang panig, at manalo sa debate rounds.";

const approachConsequences = {
    top: [
        "❌ Hindi narinig ang komunidad kaya hindi tugma ang plano sa kanilang tunay na pangangailangan.",
        "❌ Mabagal ang pagtugon dahil nakaasa sa desisyon ng mas mataas na pamahalaan.",
        "❌ Kulang sa partisipasyon ng mamamayan kaya mahina ang implementasyon.",
        "❌ Mas mataas ang pinsala dahil hindi handa ang komunidad."
    ],
    bottom: [
        "✅ Mas naging epektibo ang plano dahil nakabatay sa karanasan ng komunidad.",
        "✅ Mabilis ang pagtugon dahil aktibo ang mga mamamayan.",
        "✅ Mas mataas ang partisipasyon kaya mas maayos ang implementasyon.",
        "✅ Mas nababawasan ang pinsala dahil handa at may kaalaman ang komunidad."
    ]
};

const rounds = [
    {
        prompt: "May bagyo na paparating sa coastal barangay. Ano ang mas epektibong unang hakbang?",
        options: [
            { side: "top", text: "Hintayin muna ang central order bago kumilos ang barangay.", points: 0, feedback: "Mabagal ang initial response." },
            { side: "bottom", text: "I-activate agad ang barangay volunteers at local evacuation plan.", points: 2, feedback: "Tama: mabilis at context-based ang aksyon." }
        ]
    },
    {
        prompt: "Pagkatapos ng flood, anong approach ang mas makakatulong sa long-term recovery?",
        options: [
            { side: "top", text: "Iisang plano lang mula taas para sa lahat ng lugar.", points: 0, feedback: "Maaaring hindi tugma sa iba't ibang local needs." },
            { side: "bottom", text: "Community mapping + participatory planning sa pinakaapektadong purok.", points: 2, feedback: "Tama: inclusive at mas sustainable." }
        ]
    },
    {
        prompt: "Sa budgeting ng DRRM, ano ang mas may mataas na ownership?",
        options: [
            { side: "top", text: "Budget priorities na purely centralized at one-way.", points: 0, feedback: "Mababa ang community ownership." },
            { side: "bottom", text: "May public consultation bago i-finalize ang local DRRM spending.", points: 2, feedback: "Tama: mas transparent at mas suportado." }
        ]
    }
];

const roundPill = document.getElementById('roundPill');
const scorePill = document.getElementById('scorePill');
const lifePill = document.getElementById('lifePill');
const chooseSection = document.getElementById('chooseSection');
const challengeBox = document.getElementById('challengeBox');
const promptText = document.getElementById('promptText');
const argGrid = document.getElementById('argGrid');
const statusText = document.getElementById('statusText');
const progressFill = document.getElementById('progressFill');
const timerLabel = document.getElementById('timerLabel');
const resultBox = document.getElementById('resultBox');
const narratorText = document.getElementById('narratorText');

function typeNarrator(text, speed = 32){
    narratorText.textContent = '';
    let i = 0;
    const write = () => {
        if (i <= text.length){
            narratorText.textContent = text.slice(0, i);
            i++;
            setTimeout(write, speed);
        }
    };
    write();
}

function reveal(type){
    document.getElementById(type + 'Text').classList.add('show');
    document.getElementById(type + 'Card').classList.add('active');
    viewed[type] = true;

    if (viewed.top && viewed.bottom){
        chooseSection.style.display = 'block';
    }
}

function chooseSide(side){
    chosenSide = side;
    chooseSection.style.display = 'none';
    challengeBox.style.display = 'block';
    statusText.className = 'status';
    statusText.textContent = `✅ Side selected: ${side === 'bottom' ? 'Bottom-up' : 'Top-down'}. Simulan ang debate rounds.`;
    roundIndex = 0;
    score = 0;
    lives = 3;
    renderRound();
}

function renderRound(){
    if (roundIndex >= rounds.length){
        endGame();
        return;
    }

    clearInterval(timer);
    timeLeft = 15;
    updateHUD();

    const r = rounds[roundIndex];
    promptText.textContent = `Round ${roundIndex + 1}: ${r.prompt}`;
    argGrid.innerHTML = '';

    r.options.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = 'arg-btn';
        btn.innerHTML = `${opt.side === 'bottom' ? '🌱' : '🔥'} ${opt.text}`;
        btn.onclick = () => answer(i);
        argGrid.appendChild(btn);
    });

    const pct = (roundIndex / rounds.length) * 100;
    progressFill.style.width = `${pct}%`;
    startTimer();
}

function startTimer(){
    timerLabel.textContent = `⏱ ${timeLeft}s`;
    timer = setInterval(() => {
        timeLeft--;
        timerLabel.textContent = `⏱ ${timeLeft}s`;
        if (timeLeft <= 5) timerLabel.style.color = '#a7392f';
        if (timeLeft <= 0){
            clearInterval(timer);
            loseLife("⏰ Time out! Walang naipiling argumento.");
            nextRound();
        }
    }, 1000);
}

function answer(index){
    clearInterval(timer);
    const r = rounds[roundIndex];
    const pick = r.options[index];

    let gained = pick.points;
    if (pick.side === chosenSide) gained += 1;

    score += gained;

    if (pick.points > 0){
        statusText.className = 'status ok';
        statusText.textContent = `✅ ${pick.feedback} (+${gained} pts)`;
    } else {
        statusText.className = 'status bad';
        statusText.textContent = `❌ ${pick.feedback} (+${gained} pts)`;
        loseLife("Mas mahina ang napiling argumento sa round na ito.");
    }

    updateHUD();
    setTimeout(nextRound, 950);
}

function loseLife(msg){
    lives = Math.max(0, lives - 1);
    updateHUD();
    if (lives === 0){
        document.getElementById('wrongText').textContent = msg + " Wala ka nang lives.";
        document.getElementById('wrongModal').style.display = 'flex';
        clearInterval(timer);
        setTimeout(endGame, 350);
    }
}

function nextRound(){
    if (lives === 0){
        endGame();
        return;
    }
    roundIndex++;
    renderRound();
}

function updateHUD(){
    roundPill.textContent = `Round ${Math.min(roundIndex + 1, rounds.length)}/${rounds.length}`;
    scorePill.textContent = `Score: ${score}`;
    lifePill.textContent = `Lives: ${'❤️'.repeat(lives)}${'🖤'.repeat(3 - lives)}`;
    timerLabel.style.color = '#7a4d2b';
}

function getConsequencesHTML(side){
    const isBottom = side === 'bottom';
    const label = isBottom ? 'Bottom-up' : 'Top-down';
    const list = approachConsequences[side] ?? [];

    return `
        <div class="cons-wrap ${isBottom ? 'good' : 'bad'}">
            <h4>👉 If ${label}:</h4>
            <ul>
                ${list.map(item => `<li>${item}</li>`).join('')}
            </ul>
        </div>
    `;
}

function endGame(){
    clearInterval(timer);
    challengeBox.style.display = 'none';
    resultBox.style.display = 'block';

    const maxScore = rounds.length * 3;
    const passed = score >= 5;
    const reviewSide = (chosenSide === 'bottom' && passed) ? 'bottom' : 'top';

    if (passed) {
        sessionStorage.setItem('m3_node2', 'true');
    }

    if (passed){
        burstConfetti();
        document.getElementById('successModal').style.display = 'flex';
    }

    resultBox.innerHTML = `
        <h3>${passed ? '🏆 Debate Won!' : '📌 Debate Review Needed'}</h3>
        <p style="margin:0 0 8px;">Final Score: <b>${score}</b> / ${maxScore}</p>
        <p style="margin:0; color:#5b4e44;">
            ${passed
                ? 'Magaling! Naipakita mo ang matibay na argumento.'
                : 'Subukan muli. Basahin ulit ang dalawang approach at piliin ang mas context-based na argumento.'}
        </p>
        ${getConsequencesHTML(reviewSide)}
        <div class="actions">
            <a class="act-retry" href="{{ route('module3.node2') }}">🔁 Ulitin</a>
            <a class="act-map" href="{{ route('inner.map3') }}">🗺 Bumalik sa Map</a>
            <a class="act-next" href="{{ route('module3.node3') }}">➡ Magpatuloy</a>
        </div>
    `;
    progressFill.style.width = '100%';
}

function closeModal(id){
    document.getElementById(id).style.display = 'none';
}

function burstConfetti(){
    const layer = document.getElementById('confettiLayer');
    layer.innerHTML = '';
    const colors = ['#2ecc71','#3498db','#f1c40f','#e74c3c','#9b59b6','#1abc9c'];

    for (let i = 0; i < 45; i++){
        const piece = document.createElement('span');
        piece.className = 'confetti-piece';
        piece.style.left = Math.random() * 100 + '%';
        piece.style.top = '-12px';
        piece.style.background = colors[Math.floor(Math.random() * colors.length)];
        piece.style.transform = `rotate(${Math.random() * 180}deg)`;
        piece.style.animationDelay = `${Math.random() * .25}s`;
        layer.appendChild(piece);
    }

    setTimeout(() => { layer.innerHTML = ''; }, 1800);
}

document.getElementById('topText').classList.add('show');
document.getElementById('bottomText').classList.add('show');
document.getElementById('topCard').classList.add('active');
document.getElementById('bottomCard').classList.add('active');
chooseSection.style.display = 'block';

typeNarrator(narratorMessage, 30);
</script>

@endsection