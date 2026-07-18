@extends('Students.studentslayout')
@section('title', 'Modyul 3 - Yugto 2')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

:root{
    --brown-1:#3e2818;
    --brown-2:#6b452a;
    --paper:#f7f0e3;
    --paper-2:#efe4d2;
    --mint:#8ea97b;
    --mint-dark:#5f7f58;
    --mint-soft:#e9efdf;
    --line:#cdbda6;
    --text:#342417;
    --muted:#665647;
    --ok:#3f7b4b;
    --bad:#934038;
    --gold:#b88b33;
    --green-dark: #1b5e20;
    --green-mid: #2e7d32;
    --wood-dark: #3d2b1f;
}

.sr-only{
    position:absolute;
    width:1px;
    height:1px;
    padding:0;
    margin:-1px;
    overflow:hidden;
    clip:rect(0,0,0,0);
    white-space:nowrap;
    border:0;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:
        linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
        url("{{ asset('pictures/mod3_innermap.png') }}") center center / cover no-repeat fixed;
    min-height:100vh;
}

.back-btn{
    position:fixed;
    top:90px;
    left:20px;
    z-index:30;
    text-decoration:none;
    color:#f7efdf;
    font-weight:800;
    background:linear-gradient(135deg,#5f3f24,#7e5532);
    border:1px solid #a8834c;
    border-radius:12px;
    padding:10px 14px;
    box-shadow:0 10px 20px rgba(0,0,0,.32), inset 0 1px 0 rgba(255,255,255,.2);
    transition:.2s ease;
}
.back-btn:hover{ transform:translateY(-2px); }

.wrapper{
    max-width:1100px;
    margin:auto;
    padding:30px 18px 26px;
}

.card{
    background:
        repeating-linear-gradient(135deg, rgba(140,105,66,.05) 0 8px, rgba(255,255,255,0) 8px 16px),
        linear-gradient(180deg,var(--paper),var(--paper-2));
    border-radius:24px;
    border:1px solid #d7c4ab;
    box-shadow:0 26px 58px rgba(0,0,0,.34);
    overflow:hidden;
}

.top{
    padding:20px;
    border-bottom:1px solid #d7c7b4;
    background:
        linear-gradient(180deg, rgba(255,255,255,.58), rgba(255,255,255,0)),
        linear-gradient(135deg,#f4eadb,#ecdfca);
}
.title{
    font-size:1.8rem;
    font-weight:800;
    font-family:'Poppins',sans-serif;
    margin:0;
    letter-spacing:.04em;
    color:#51361f;
    text-shadow:0 1px 0 rgba(255,255,255,.5);
}
.subtitle{
    margin:6px 0 0;
    color:var(--muted);
    font-size:.92rem;
    font-family:'Poppins',sans-serif;
    font-weight:600;
}

.body{
    padding:18px;
}

.hero{
    display:grid;
    grid-template-columns:180px 1fr;
    gap:14px;
    align-items:start;
    border:1px solid #d4c2ab;
    border-radius:16px;
    padding:14px;
    background:
        linear-gradient(180deg, rgba(255,255,255,.58), rgba(255,255,255,0)),
        linear-gradient(135deg,#fbf2e3,#f2e5d2);
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
    width:140px;
    height:140px;
    object-fit:contain;
    border-radius:50%;
    background:linear-gradient(135deg,#f7efdf,#e9dcc7);
    border:1px solid #cdb89a;
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
    background:linear-gradient(180deg,#fffdf8,#f7eddc);
    border:1px solid #d5c2a3;
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

/* ===== STEP CONTAINER ===== */
.step-container {
    margin-top: 18px;
}

.step-indicators {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 16px;
}

.step-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #cdbda6;
    transition: all 0.3s ease;
    cursor: pointer;
}

.step-dot.active {
    background: var(--green-mid);
    transform: scale(1.3);
    box-shadow: 0 0 12px rgba(46, 125, 50, 0.4);
}

.step-dot.completed {
    background: var(--gold);
}

.step-content {
    display: none;
    animation: fadeInUp 0.4s ease;
}

.step-content.active {
    display: block;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.step-card {
    border-radius: 16px;
    border: 1px solid #d0bca1;
    background: linear-gradient(135deg, #fffdf8, #f4e8d5);
    padding: 18px;
    position: relative;
}

.step-number {
    display: inline-block;
    background: var(--green-mid);
    color: white;
    font-weight: 800;
    font-size: 0.8rem;
    padding: 4px 12px;
    border-radius: 999px;
    margin-bottom: 10px;
}

.step-title {
    font-size: 1.1rem;
    font-weight: 800;
    color: #3d2f26;
    margin: 0 0 10px 0;
}

.step-description {
    color: #5f5349;
    line-height: 1.6;
    font-size: 0.95rem;
    margin-bottom: 12px;
}

/* ===== CHOICE CARDS ===== */
.choice-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
@media (max-width:760px){
    .choice-container { grid-template-columns: 1fr; }
}

.choice-card {
    border-radius: 16px;
    border: 1px solid #d0bca1;
    background: linear-gradient(135deg, #fffdf8, #f4e8d5);
    padding: 14px;
    transition: 0.22s ease;
    cursor: default;
}
.choice-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 24px rgba(0,0,0,.10);
}
.choice-card.selected {
    border-color: var(--green-mid);
    box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.2);
    background: linear-gradient(135deg, #f0f7ed, #e8f0e2);
}

.choice-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
}
.choice-head h3 {
    margin: 0;
    font-size: 1.05rem;
    color: #3f3026;
}

.choice-text {
    margin-top: 10px;
    color: #5f5349;
    line-height: 1.58;
    font-size: 0.92rem;
    padding-top: 10px;
    border-top: 1px dashed #d5ebe3;
}

/* ===== GREEN BUTTON ===== */
.btn-green {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 30px;
    background: var(--green-mid) !important;
    border: 3px solid var(--wood-dark) !important;
    box-shadow: 0 5px 0 var(--wood-dark) !important;
    color: #fff !important;
    border-radius: 12px;
    font-weight: 800;
    font-family: 'Nunito', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.95rem;
    text-decoration: none;
    transition: 0.18s ease;
    cursor: pointer;
}

.btn-green:hover {
    background: var(--green-dark) !important;
    transform: translateY(-2px);
    color: #fff !important;
}

.btn-green:active {
    transform: translateY(3px);
    box-shadow: 0 2px 0 var(--wood-dark) !important;
}

.btn-green:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
}

/* ===== GAME BUTTONS ===== */
.arg-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
@media (max-width:760px){
    .arg-grid { grid-template-columns: 1fr; }
}
.arg-btn {
    border: 1px solid #d1bea3;
    background: linear-gradient(135deg, #fffcf6, #f1e4d0);
    color: #3f2f24;
    text-align: left;
    border-radius: 12px;
    padding: 12px;
    cursor: pointer;
    font-weight: 700;
    transition: .18s ease;
    font-size: 0.92rem;
}
.arg-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 18px rgba(0,0,0,.08);
}
.arg-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.hud {
    margin: 10px 0 12px;
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
    padding: 8px;
    background: linear-gradient(135deg, rgba(70,48,30,.95), rgba(97,66,42,.95));
    border: 1px solid #9f7a4a;
    border-radius: 999px;
    box-shadow: 0 10px 24px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.14);
    backdrop-filter: blur(6px);
}
.pill {
    border-radius: 999px;
    padding: 7px 11px;
    font-size: .8rem;
    font-weight: 800;
    font-family: 'Nunito', sans-serif;
    border: 1px solid #b49670;
    background: linear-gradient(135deg, #f7e9d2, #ecd7b6);
    color: #4e351f;
}
.pill.gold {
    border-color: #d3ae62;
    background: linear-gradient(135deg, #f8e5b9, #eacb89);
    color: #5f430e;
}

.progress {
    height: 10px;
    border-radius: 999px;
    border: 1px solid #c5aa84;
    background: #e9d8be;
    overflow: hidden;
    margin-top: 8px;
}
.progress-fill {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #b57d2c, #5a7c4b);
    transition: width .35s ease;
}

.timer {
    margin-top: 8px;
    font-weight: 800;
    color: #7a4d2b;
    font-size: .88rem;
    text-align: center;
}

.status {
    margin-top: 10px;
    min-height: 22px;
    font-weight: 700;
    font-size: .9rem;
    text-align: center;
}
.status.ok { color: var(--ok); }
.status.bad { color: var(--bad); }

.prompt {
    font-weight: 700;
    color: #433429;
    margin: 10px 0;
    font-size: 0.98rem;
}

/* ===== STEP NAVIGATION ===== */
.step-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 16px;
    gap: 12px;
    flex-wrap: wrap;
}

.step-nav .btn-green {
    min-width: 120px;
}

.step-nav .btn-green:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* ===== MODAL ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.75);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}
.modal-box {
    width: min(450px,92vw);
    background: linear-gradient(180deg, #fff7e9, #f2e3cc);
    border-radius: 24px;
    border: 2px solid #c5a059;
    padding: 24px 20px;
    text-align: center;
    animation: pop .25s ease;
    box-shadow: 0 30px 50px rgba(0,0,0,.4);
}
@keyframes pop {
    from { transform: scale(.92); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.modal-box h3 {
    font-size: 1.6rem;
    margin-bottom: 12px;
    color: #5f3e1a;
    font-family: 'Nunito', sans-serif;
}
.modal-box p {
    color: #4a3a2a;
    margin-bottom: 20px;
    line-height: 1.6;
}
.modal-buttons {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}
.modal-btn {
    border: none;
    border-radius: 40px;
    padding: 12px 24px;
    font-weight: 800;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}
.modal-btn:hover {
    transform: translateY(-2px);
}
.btn-map { 
    background: linear-gradient(135deg, #8e643d, #6e4d2e); 
    border: 1px solid #a98353; 
    color: #f8efe2; 
}
.btn-retry { 
    background: linear-gradient(135deg, #f6ead8, #e8d8bf); 
    border: 1px solid #c9b08a; 
    color: #59422c; 
}

#confettiLayer {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 1000;
}
.confetti-piece {
    position: absolute;
    width: 10px;
    height: 16px;
    opacity: .95;
    animation: fall 1.8s linear forwards;
}
@keyframes fall {
    to { transform: translateY(400px) rotate(360deg); opacity: 0; }
}

.completion-badge {
    display: inline-block;
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    padding: 8px 16px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 0.85rem;
    margin-top: 10px;
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.4);
}
</style>

<a href="{{ route('inner.map3') }}" class="back-btn">⬅ Bumalik</a>

<div class="wrapper">
    <div class="card">
        <div class="top">
            <h1 class="title">🟦 MGA PAMAMARAAN → LARO NG PAGTATALO</h1>
            <p class="subtitle">
                Tanong na Gabay: Paano nakaaapekto ang panganib, kahinaan, at banta sa paglitaw ng sakuna?
            </p>
        </div>

        <div class="body">
            <div class="hero">
                <div class="mayor-wrap">
                    <img
                        class="mayor-icon"
                        alt="Larawan ng punong-bayan"
                        src="{{ asset('pictures/mayor.png') }}"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22%3E%3Ccircle cx=%2264%22 cy=%2264%22 r=%2262%22 fill=%22%23e9f7f2%22/%3E%3Ccircle cx=%2264%22 cy=%2242%22 r=%2220%22 fill=%22%23f1c27d%22/%3E%3Crect x=%2238%22 y=%2264%22 width=%2252%22 height=%2238%22 rx=%2212%22 fill=%22%233f8e7f%22/%3E%3C/svg%3E';"
                    />
                </div>
                <div class="speech">
                    <span class="typing" id="narratorText"></span>
                </div>
            </div>

            <!-- ===== STEP CONTAINER ===== -->
            <div class="step-container">
                <!-- Step Indicators -->
                <div class="step-indicators" id="stepIndicators">
                    <div class="step-dot active" data-step="1"></div>
                    <div class="step-dot" data-step="2"></div>
                    <div class="step-dot" data-step="3"></div>
                </div>

                <!-- ===== STEP 1: READ APPROACHES ===== -->
                <div class="step-content active" id="step1">
                    <div class="step-card">
                        <div class="step-number">HAKBANG 1</div>
                        <h3 class="step-title">📘 Basahin ang dalawang pamamaraan</h3>
                        <p class="step-description">Basahin ang bawat pamamaraan upang maunawaan ang pagkakaiba ng Top-down at Bottom-up approach.</p>

                        <div class="choice-container">
                            <div class="choice-card active" id="topCard">
                                <div class="choice-head">
                                    <h3>Top-down Approach</h3>
                                </div>
                                <div class="choice-text" id="topText">
                                    Ang pamamaraang ito ay umaasa sa mas mataas na antas ng pamahalaan sa lahat ng aspeto ng pagharap sa sakuna,
                                    mula pagpaplano hanggang pagtugon. Gayunman, madalas itong mabagal dahil hindi agad natutugunan ang
                                    pangangailangan ng mga mamamayan, lalo na ang mga pinakaapektado. Karaniwan ding limitado ang mga plano dahil
                                    nakabatay lamang ito sa pananaw ng mga pinuno, habang napapabayaan ang karanasan at boses ng komunidad.
                                </div>
                            </div>

                            <div class="choice-card active" id="bottomCard">
                                <div class="choice-head">
                                    <h3>Bottom-up Approach</h3>
                                </div>
                                <div class="choice-text" id="bottomText">
                                    Ang pamamaraang ito ay nakatuon sa aktibong pakikilahok ng mga mamamayan at iba't ibang sektor ng pamayanan
                                    sa pagtukoy, pag-aanalisa, at paglutas ng mga suliranin. Mahalaga ang pamumuno ng lokal na komunidad, kasama
                                    ang lokal na pamahalaan, pribadong sektor, at mga organisasyong hindi pangkalakalan, upang maisulong ang
                                    epektibong pag-unlad mula sa ibaba. Sa paraang ito, nabibigyang-halaga ang iba't ibang pananaw at karanasan
                                    ng mga taong nakatira sa mga lugar na madalas tamaan ng sakuna.
                                </div>
                            </div>
                        </div>

                        <div class="step-nav">
                            <span></span>
                            <button class="btn-green" onclick="goToStep(2)">Magpatuloy →</button>
                        </div>
                    </div>
                </div>

                <!-- ===== STEP 2: CHOOSE YOUR SIDE ===== -->
                <div class="step-content" id="step2">
                    <div class="step-card">
                        <div class="step-number">HAKBANG 2</div>
                        <h3 class="step-title">👉 Piliin ang iyong panig</h3>
                        <p class="step-description">Pumili ng panig na sa tingin mo ay mas epektibo sa pagharap sa sakuna.</p>

                        <div class="choice-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:10px;">
                            <button class="arg-btn" style="text-align:center; padding:16px; font-size:1rem;" onclick="chooseSide('top')">
                                🏛️ Top-down Approach
                            </button>
                            <button class="arg-btn" style="text-align:center; padding:16px; font-size:1rem;" onclick="chooseSide('bottom')">
                                🌱 Bottom-up Approach
                            </button>
                        </div>

                        <div id="sideStatus" class="status" style="margin-top:10px;"></div>

                        <div class="step-nav">
                            <button class="btn-green" onclick="goToStep(1)">← Bumalik</button>
                            <button class="btn-green" id="step2NextBtn" onclick="goToStep(3)" disabled>Magpatuloy →</button>
                        </div>
                    </div>
                </div>

                <!-- ===== STEP 3: GAME ===== -->
                <div class="step-content" id="step3">
                    <div class="step-card">
                        <div class="step-number">HAKBANG 3</div>
                        <h3 class="step-title">⚖️ Mga Ikot ng Pagtatalo</h3>
                        <p class="step-description">Sagutin ang mga tanong gamit ang iyong napiling panig.</p>

                        <div class="hud">
                            <div class="pill" id="roundPill">Ikot 1/3</div>
                            <div class="pill gold" id="scorePill">Iskor: 0</div>
                            <div class="pill" id="lifePill">Buhay: ❤️❤️❤️</div>
                        </div>
                        <div class="progress"><div class="progress-fill" id="progressFill"></div></div>
                        <div class="timer" id="timerLabel">⏱ 15 segundo</div>
                        <div class="prompt" id="promptText"></div>
                        <div class="arg-grid" id="argGrid"></div>
                        <div class="status" id="statusText"></div>

                        <div style="text-align:center; margin-top:12px; font-size:0.85rem; color:#7a6a5a;">
                            ⚡ Sagutin ang bawat tanong sa loob ng 15 segundo
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WRONG MODAL -->
<div id="wrongModal" class="modal-overlay">
    <div class="modal-box">
        <h3>❌ Naku!</h3>
        <p id="wrongText">Naubos ang oras. Sa pagtatalo, mahalaga ang bilis at linaw.</p>
        <div class="modal-buttons">
            <button class="modal-btn btn-retry" onclick="closeWrongModal()">🔄 Subukang Muli</button>
            <a href="{{ route('inner.map3') }}" class="modal-btn btn-map">🗺 Bumalik sa Mapa</a>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="successModal" class="modal-overlay">
    <div class="modal-box">
        <h3>🎉 Binabati Ka, Punong-Bayan!</h3>
        <p id="successText">Naipakita mo ang mas matibay na argumento sa mga pamamaraang pangkahandaan sa sakuna.</p>
        <div class="modal-buttons">
            <button class="modal-btn btn-retry" onclick="closeSuccessAndRetry()">🔄 Subukan Muli</button>
            <a href="{{ route('inner.map3') }}" class="modal-btn btn-map">🗺 Bumalik sa Mapa</a>
        </div>
    </div>
</div>

<div id="confettiLayer"></div>

<script>
const narratorMessage = "Ikaw ang punong-bayan ngayon. Basahin ang dalawang pamamaraan, piliin ang panig, at manalo sa mga ikot ng pagtatalo.";

let chosenSide = null;
let score = 0;
let lives = 3;
let roundIndex = 0;
let timeLeft = 15;
let timer = null;
let isGameCompleted = false;
let gameStarted = false;

const rounds = [
    {
        prompt: "May paparating na bagyo sa baybaying barangay. Ano ang mas epektibong unang hakbang?",
        options: [
            { side: "top", text: "Hintayin muna ang utos mula sa itaas bago kumilos ang barangay.", points: 0, feedback: "Mabagal ang unang pagtugon." },
            { side: "bottom", text: "Agad na buhayin ang mga boluntaryo ng barangay at ang planong paglilikas.", points: 2, feedback: "Tama: mabilis at angkop sa sitwasyon ang aksyon." }
        ]
    },
    {
        prompt: "Pagkatapos ng baha, alin ang mas makakatulong sa pangmatagalang pagbangon?",
        options: [
            { side: "top", text: "Iisang plano lamang mula sa taas para sa lahat ng lugar.", points: 0, feedback: "Maaaring hindi tugma sa iba't ibang pangangailangan ng mga lugar." },
            { side: "bottom", text: "Pagmamapa ng komunidad at sama-samang pagpaplano sa pinakaapektadong purok.", points: 2, feedback: "Tama: mas inklusibo at mas pangmatagalan." }
        ]
    },
    {
        prompt: "Sa paglalaan ng badyet para sa kahandaan sa sakuna, alin ang mas may mataas na pag-aari ng komunidad?",
        options: [
            { side: "top", text: "Mga prayoridad sa badyet na puro sentralisado at isang direksiyon lamang.", points: 0, feedback: "Mababa ang pagmamay-ari ng komunidad." },
            { side: "bottom", text: "May pampublikong konsultasyon bago pinal ang paggasta sa lokal na kahandaan sa sakuna.", points: 2, feedback: "Tama: mas malinaw at mas sinusuportahan." }
        ]
    }
];

// ===== STEP NAVIGATION =====
function goToStep(step) {
    document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.step-dot').forEach(el => el.classList.remove('active'));
    
    document.getElementById(`step${step}`).classList.add('active');
    document.querySelector(`.step-dot[data-step="${step}"]`).classList.add('active');
    
    window.scrollTo({ top: document.querySelector('.step-container').offsetTop - 100, behavior: 'smooth' });
}

function updateStepDots() {
    document.querySelectorAll('.step-dot').forEach(el => {
        const step = parseInt(el.dataset.step);
        if (step < 3) {
            el.classList.add('completed');
        }
    });
}

// ===== STEP 2: CHOOSE SIDE =====
function chooseSide(side) {
    chosenSide = side;
    const status = document.getElementById('sideStatus');
    status.className = 'status ok';
    status.textContent = `✅ Napili mo ang: ${side === 'bottom' ? 'Bottom-up Approach' : 'Top-down Approach'}`;
    
    document.getElementById('step2NextBtn').disabled = false;
    
    // Highlight selected
    document.querySelectorAll('.arg-btn').forEach(btn => {
        btn.style.borderColor = '#d1bea3';
        btn.style.background = 'linear-gradient(135deg, #fffcf6, #f1e4d0)';
    });
    
    const btns = document.querySelectorAll('.arg-btn');
    if (side === 'top') {
        btns[0].style.borderColor = 'var(--green-mid)';
        btns[0].style.background = 'linear-gradient(135deg, #f0f7ed, #e8f0e2)';
    } else {
        btns[1].style.borderColor = 'var(--green-mid)';
        btns[1].style.background = 'linear-gradient(135deg, #f0f7ed, #e8f0e2)';
    }
}

// ===== STEP 3: GAME =====
function startGame() {
    if (!chosenSide) return;
    gameStarted = true;
    score = 0;
    lives = 3;
    roundIndex = 0;
    renderRound();
}

function renderRound() {
    if (roundIndex >= rounds.length) {
        endGame(true);
        return;
    }

    clearInterval(timer);
    timeLeft = 15;
    updateHUD();

    const r = rounds[roundIndex];
    document.getElementById('promptText').textContent = `Ikot ${roundIndex + 1}: ${r.prompt}`;
    const argGrid = document.getElementById('argGrid');
    argGrid.innerHTML = '';

    r.options.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = 'arg-btn';
        btn.textContent = opt.text;
        btn.onclick = () => answer(i);
        argGrid.appendChild(btn);
    });

    const pct = (roundIndex / rounds.length) * 100;
    document.getElementById('progressFill').style.width = `${pct}%`;
    startTimer();
}

function startTimer() {
    document.getElementById('timerLabel').textContent = `⏱ ${timeLeft} segundo`;
    timer = setInterval(() => {
        timeLeft--;
        document.getElementById('timerLabel').textContent = `⏱ ${timeLeft} segundo`;
        if (timeLeft <= 5) document.getElementById('timerLabel').style.color = '#a7392f';
        if (timeLeft <= 0) {
            clearInterval(timer);
            loseLife("⏰ Naubos ang oras! Walang naipiling argumento.");
            setTimeout(() => {
                roundIndex++;
                renderRound();
            }, 800);
        }
    }, 1000);
}

function answer(index) {
    clearInterval(timer);
    const r = rounds[roundIndex];
    const pick = r.options[index];

    let gained = pick.points;
    if (pick.side === chosenSide) gained += 1;

    score += gained;

    const statusText = document.getElementById('statusText');
    if (pick.points > 0 || pick.side === chosenSide) {
        statusText.className = 'status ok';
        statusText.textContent = `✅ ${pick.feedback} (+${gained} puntos)`;
    } else {
        statusText.className = 'status bad';
        statusText.textContent = `❌ ${pick.feedback} (+${gained} puntos)`;
        loseLife("Mas mahina ang napiling argumento sa ikot na ito.");
    }

    updateHUD();
    
    // Disable all buttons
    document.querySelectorAll('.arg-btn').forEach(btn => btn.disabled = true);
    
    setTimeout(() => {
        roundIndex++;
        renderRound();
    }, 1200);
}

function loseLife(msg) {
    lives = Math.max(0, lives - 1);
    updateHUD();
    if (lives === 0) {
        document.getElementById('wrongText').textContent = msg + " Wala ka nang natitirang buhay.";
        document.getElementById('wrongModal').style.display = 'flex';
        clearInterval(timer);
        // Game over - failed
        setTimeout(() => endGame(false), 500);
    }
}

function updateHUD() {
    document.getElementById('roundPill').textContent = `Ikot ${Math.min(roundIndex + 1, rounds.length)}/${rounds.length}`;
    document.getElementById('scorePill').textContent = `Iskor: ${score}`;
    document.getElementById('lifePill').textContent = `Buhay: ${'❤️'.repeat(lives)}${'🖤'.repeat(3 - lives)}`;
    document.getElementById('timerLabel').style.color = '#7a4d2b';
}

function endGame(passed) {
    clearInterval(timer);
    
    // Disable all game buttons
    document.querySelectorAll('.arg-btn').forEach(btn => btn.disabled = true);
    
    if (passed) {
        // Check if score meets passing criteria
        const maxScore = rounds.length * 3;
        const isPassed = score >= 5;
        
        if (isPassed) {
            markNodeComplete();
            burstConfetti();
            document.getElementById('successText').textContent = 
                `Naipakita mo ang mas matibay na argumento sa mga pamamaraang pangkahandaan sa sakuna. (Iskor: ${score}/${maxScore})`;
            document.getElementById('successModal').style.display = 'flex';
            saveGameProgress(true);
        } else {
            // Not enough points
            document.getElementById('wrongText').textContent = 
                `Hindi sapat ang iyong iskor (${score}/${maxScore}) upang manalo. Kailangan mo ng hindi bababa sa 5 puntos. Subukan muli!`;
            document.getElementById('wrongModal').style.display = 'flex';
            saveGameProgress(false);
        }
    } else {
        // Failed from losing lives
        saveGameProgress(false);
    }
}

function markNodeComplete() {
    sessionStorage.setItem('m3v2_node2', 'true');
    localStorage.setItem('m3v2_node2', 'true');
    localStorage.setItem('m3_node2_completed', 'true');
    localStorage.setItem('m3_node2_completed_at', Date.now().toString());
    isGameCompleted = true;
    updateStepDots();
    document.querySelector('.step-dot[data-step="3"]').classList.add('completed');
}

function saveGameProgress(passed) {
    fetch("{{ route('module3.node2.save') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            chosen_side: chosenSide,
            score: score,
            lives_remaining: lives,
            is_passed: passed ? 1 : 0
        })
    })
    .then(res => res.json())
    .then(data => console.log("Saved:", data))
    .catch(err => console.error(err));
}

// ===== MODAL FUNCTIONS =====
function closeWrongModal() {
    document.getElementById('wrongModal').style.display = 'none';
    location.reload();
}

function closeSuccessAndRetry() {
    document.getElementById('successModal').style.display = 'none';
    location.reload();
}

function burstConfetti() {
    const layer = document.getElementById('confettiLayer');
    layer.innerHTML = '';
    const colors = ['#2ecc71','#3498db','#f1c40f','#e74c3c','#9b59b6','#1abc9c'];

    for (let i = 0; i < 60; i++) {
        const piece = document.createElement('div');
        piece.className = 'confetti-piece';
        piece.style.left = Math.random() * 100 + '%';
        piece.style.top = '-20px';
        piece.style.background = colors[Math.floor(Math.random() * colors.length)];
        piece.style.transform = `rotate(${Math.random() * 360}deg)`;
        piece.style.animationDelay = `${Math.random() * 0.5}s`;
        piece.style.width = `${Math.random() * 8 + 6}px`;
        piece.style.height = `${Math.random() * 12 + 8}px`;
        layer.appendChild(piece);
    }

    setTimeout(() => { layer.innerHTML = ''; }, 2000);
}

// ===== TYPEWRITER =====
function typeNarrator(text, speed = 32) {
    const el = document.getElementById('narratorText');
    el.textContent = '';
    let i = 0;
    const write = () => {
        if (i <= text.length) {
            el.textContent = text.slice(0, i);
            i++;
            setTimeout(write, speed);
        }
    };
    write();
}

// ===== INIT =====
document.addEventListener('DOMContentLoaded', function() {
    typeNarrator(narratorMessage, 30);
    
    // Check if already completed
    const alreadyCompleted = localStorage.getItem('m3v2_node2') === 'true' || 
                           localStorage.getItem('m3_node2_completed') === 'true';
    
    if (alreadyCompleted) {
        updateStepDots();
        document.querySelector('.step-dot[data-step="3"]').classList.add('completed');
        // Auto-redirect to map if already completed
        // Uncomment below to auto-redirect
        // setTimeout(() => {
        //     window.location.href = "{{ route('inner.map3') }}";
        // }, 2000);
    }
    
    // Start game when step 3 becomes visible
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.target.id === 'step3' && mutation.target.classList.contains('active')) {
                if (!gameStarted && chosenSide) {
                    startGame();
                }
            }
        });
    });
    
    observer.observe(document.getElementById('step3'), { attributes: true, attributeFilter: ['class'] });
});

// Override goToStep to handle step 3 game start
const originalGoToStep = goToStep;
goToStep = function(step) {
    originalGoToStep(step);
    if (step === 3 && chosenSide && !gameStarted) {
        setTimeout(startGame, 300);
    }
};
</script>

@endsection