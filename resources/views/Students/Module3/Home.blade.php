{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 3\Home.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Module 3 Home')

@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800;900&family=Baloo+2:wght@700;800&display=swap');

:root{
    --green:#1f7a47;
    --green-2:#2f9b57;
    --mint:#7fd46a;
    --sky:#5bc0ff;
    --soft:#f4fff6;
    --text:#163020;
    --muted:#4f6b5b;
    --border:#d7e9d8;
}

html, body{
    scroll-behavior:smooth;
    background:
        radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
        radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
        radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
        linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
}

body{
    overflow-x:hidden;
    color:var(--text);
    font-family:'Poppins', sans-serif;
}

.m3-wrap{
    max-width:1120px;
    margin:0 auto;
    padding:24px 16px 40px;
    min-height:calc(100vh - 70px);
    display:flex;
    align-items:center;
    justify-content:center;
}

.m3-shell{
    position:relative;
    z-index:2;
    width:100%;
    display:flex;
    flex-direction:column;
    align-items:center;
}

.m3-icon{
    width:42px;
    height:42px;
    border-radius:12px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:1.2rem;
    background:linear-gradient(135deg, #dcf7e2, #e9f8ff);
    border:1px solid #cde7d3;
    box-shadow:0 8px 18px rgba(0,0,0,.08);
    flex:0 0 42px;
}

.m3-title-wrap{
    display:flex;
    align-items:flex-start;
    justify-content:center;
    gap:10px;
}

.m3-hero{
    width:min(980px, 100%);
    position:relative;
    background: rgba(255,255,255,.93);
    border:1px solid rgba(215,233,216,.95);
    border-radius:24px;
    padding:26px;
    box-shadow:0 20px 50px rgba(0,0,0,.18);
    backdrop-filter: blur(10px);
}

.m3-hero::after{
    content:"";
    position:absolute;
    inset:0;
    pointer-events:none;
    border-radius:24px;
    background:radial-gradient(circle at top right, rgba(91,192,255,.16), transparent 38%);
}

.m3-title{
    font-family:'Baloo 2', cursive;
    font-size:clamp(1.55rem,3.2vw,2.15rem);
    font-weight:800;
    color:#123725;
    line-height:1.16;
    margin:0;
    text-align:center;
}

.m3-sub{
    margin-top:12px;
    color:#496856;
    line-height:1.7;
    max-width:900px;
    text-align:center;
    margin-left:auto;
    margin-right:auto;
}

.m3-badges{
    margin-top:14px;
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    justify-content:center;
}

.m3-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:8px 12px;
    border-radius:999px;
    font-size:.84rem;
    font-weight:800;
    color:#17472f;
    background:linear-gradient(135deg,#e9f8ec,#eef8ff);
    border:1px solid #cde6d3;
    box-shadow:0 6px 14px rgba(0,0,0,.06);
}

.m3-actions{
    margin-top:18px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    justify-content:center;
}

.m3-btn{
    padding:12px 18px;
    border-radius:14px;
    font-weight:800;
    border:none;
    cursor:pointer;
    transition:.2s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.5rem;
    text-decoration:none;
}

.m3-primary{
    position:relative;
    overflow:hidden;
    background:linear-gradient(135deg,#8ce274,#2f9b57);
    color:#0f311f;
    box-shadow:0 10px 24px rgba(47,155,87,.25);
}

.m3-primary:hover{ transform:translateY(-2px); }

.m3-primary::before{
    content:"";
    position:absolute;
    top:0;
    left:-120%;
    width:100%;
    height:100%;
    background:linear-gradient(100deg, transparent 0%, rgba(255,255,255,.38) 50%, transparent 100%);
    transition:left .45s ease;
}

.m3-primary:hover::before{ left:120%; }

.m3-ghost{
    background:#eef8ef;
    border:1px solid #dcecdf;
    color:#1b4f35;
}

.m3-btn[disabled],
.m3-btn.m3-disabled{
    opacity:.55;
    cursor:not-allowed;
    pointer-events:none;
    box-shadow:none;
    transform:none !important;
}

.m3-start-note{
    margin-top:10px;
    font-size:.92rem;
    color:#345445;
    background:#eef8ef;
    border:1px solid #dcecdf;
    border-radius:10px;
    padding:8px 10px;
    display:inline-block;
    margin-left:auto;
    margin-right:auto;
}

.m3-modal{
    position:fixed;
    inset:0;
    background:linear-gradient(135deg, rgba(4,14,10,.70), rgba(7,40,22,.52));
    display:none;
    align-items:center;
    justify-content:center;
    z-index:999;
    padding:18px;
}

.m3-modal.show{ display:flex; }

.m3-modal-content{
    width:min(930px,96%);
    max-height:88vh;
    overflow:auto;
    border-radius:24px;
    background:linear-gradient(180deg,#ffffff 0%,#f6fff8 100%);
    padding:18px;
    box-shadow:0 30px 60px rgba(0,0,0,.28);
    border:1px solid #d6ebda;
}

.m3-modal-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    margin-bottom:12px;
    padding:14px;
    border-radius:16px;
    border:1px solid #d2ead7;
    background:linear-gradient(135deg,#e8f9eb,#def3e3);
}

.m3-modal-title{
    margin:0;
    font-size:1.45rem;
    font-family:'Baloo 2', cursive;
    font-weight:800;
    color:#155e3c;
    display:flex;
    align-items:center;
    gap:8px;
}

.m3-modal-sub{
    margin-top:6px;
    color:#3f6a50;
    line-height:1.65;
}

.m3-modal-close{
    border:none;
    background:#1f7a47;
    color:#fff;
    border-radius:12px;
    padding:9px 14px;
    font-weight:800;
    cursor:pointer;
}

.m3-modal-close:hover{ background:#185f37; }

.m3-goals-inline{ margin-top:8px; }

.m3-goal{
    margin-top:14px;
    padding:14px;
    border-radius:16px;
    background:var(--soft);
    border:1px solid #dcecdf;
    box-shadow:0 8px 20px rgba(31,122,71,.08);
}

.m3-goal h4{
    margin:0 0 8px;
    font-size:1.04rem;
    font-weight:900;
    color:#157347;
    display:flex;
    align-items:center;
    gap:8px;
}

.m3-goal p, .m3-goal li{
    color:#345445;
    line-height:1.72;
}

.m3-competency{
    margin-top:8px;
    padding:11px 12px;
    border-radius:12px;
    background:#fff;
    border:1px solid #d8e9dc;
    color:#274939;
    line-height:1.6;
    display:flex;
    gap:8px;
    align-items:flex-start;
}

.m3-competency:hover{
    background:#f2fff4;
    border-color:#bfe1c6;
}

.m3-panel{
    width:min(980px, 100%);
    margin-top:22px;
    background: rgba(255,255,255,.94);
    border:1px solid rgba(215,233,216,.95);
    border-radius:24px;
    padding:22px;
    box-shadow:0 16px 36px rgba(0,0,0,.12);
}

.m3-section-title{
    font-size:1.2rem;
    font-weight:900;
    color:#163423;
    margin-bottom:8px;
    display:flex;
    align-items:center;
    gap:8px;
}

.m3-section-sub{
    color:#516b5c;
    line-height:1.65;
    margin-bottom:14px;
}

.m3-steps{
    display:grid;
    gap:12px;
}

.m3-step{
    display:grid;
    grid-template-columns:110px 1fr;
    gap:14px;
    align-items:stretch;
    border:1px solid #e0eee2;
    border-radius:18px;
    padding:12px;
    background:#fff;
    cursor:pointer;
    transition:.18s ease;
    overflow:hidden;
}

.m3-step:hover{
    transform:translateY(-1px);
    border-color:#c3e2ca;
}

.m3-step.active{
    border-color:var(--green);
    background:#eefaf0;
    box-shadow:0 10px 22px rgba(31,122,71,.10);
}

.m3-step-media{
    width:100%;
    min-height:110px;
    height:100%;
    border-radius:14px;
    border:2px solid #d4ead7;
    background:linear-gradient(135deg,#f6fbf7,#eaf6ee);
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    position:relative;
}

.m3-step-media img{
    width:100%;
    height:100%;
    object-fit:contain;
    object-position:center;
    display:block;
    padding:6px;
}

.m3-step-body{
    display:flex;
    flex-direction:column;
    justify-content:center;
    min-width:0;
}

.m3-step h4{
    margin:0 0 4px;
    color:#173423;
    font-weight:900;
    line-height:1.25;
}

.m3-step p{
    margin:0;
    color:#4f6457;
    line-height:1.55;
}

.m3-footer-actions{
    margin-top:14px;
    display:flex;
    justify-content:flex-end;
}

.m3-goals-actions{
    margin-top:16px;
    display:flex;
    justify-content:flex-end;
}

.hidden{ display:none; }
.m3-hidden{ display:none !important; }

@media (max-width:640px){
    .m3-wrap{ padding:14px 10px 28px; }
    .m3-hero, .m3-panel, .m3-modal-content{ border-radius:18px; }
    .m3-title-wrap{ align-items:center; }
    .m3-badge{ font-size:.78rem; }
    .m3-step{
        grid-template-columns:88px 1fr;
    }
    .m3-step-media{
        min-height:88px;
    }
    .m3-icon{
        width:38px;
        height:38px;
        font-size:1.05rem;
    }
}
</style>
@endpush

@section('content')
<div class="m3-wrap">
    <div class="m3-shell">

        <!-- HERO -->
        <div class="m3-hero" id="heroCard">
            <div class="m3-title-wrap">
                <span class="m3-icon">🛡️</span>
                <h1 class="m3-title">
                    Mission Prep: Paghahandang Nararapat Gawin sa Harap ng Panganib na Dulot ng Suliraning Pangkapaligiran
                </h1>
            </div>

            <p class="m3-sub">
                Tuklasin ang mga wastong paghahanda upang maging ligtas at handa sa panahon ng kalamidad.
                Basahin muna ang mga layunin sa ibaba bago pindutin ang Simulan.
            </p>

            <div class="m3-actions">
                <button type="button" class="m3-btn m3-ghost" id="openGoalsBtn">📜 Mga Layunin</button>
                <button class="m3-btn m3-primary m3-disabled" id="startBtn" type="button" disabled>🔒 Simulan</button>
            </div>


        </div>

        <!-- GOALS MODAL -->
        <div class="m3-modal" id="goalsModal">
            <div class="m3-modal-content" id="goalsScrollArea">
                <div class="m3-modal-head">
                    <div>
                        <h2 class="m3-modal-title">🎯 Mga Layunin ng Aralin</h2>
                        <p class="m3-modal-sub">
                            Basahin ang buong nilalaman, pagkatapos ay pindutin ang <strong>Naiintindihan ko</strong> para ma-unlock ang Simulan.
                        </p>
                    </div>
                    <button class="m3-modal-close" id="closeGoalsBtn" type="button">❎ Isara</button>
                </div>

                <div class="m3-goals-inline">
                    <div class="m3-goal">
                        <h4>🧠 a. PAMANTAYANG PANGNILALAMAN</h4>
                        <p>
                            Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.
                        </p>
                    </div>

                    <div class="m3-goal">
                        <h4>🏆 b. PAMANTAYAN SA PAGGANAP</h4>
                        <p>
                            Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.
                        </p>
                    </div>

                    <div class="m3-goal">
                        <h4>🎮 c. KASANAYAN SA PAGKATUTO</h4>
                        <div class="m3-competency"><span>✅</span><span>Natutukoy ang mga paghahandang nararapat gawin sa harap ng panganib na dulot ng mga suliraning pangkapaligiran. (MELC3)</span></div>
                        <div class="m3-competency"><span>✅</span><span>Naibibigay ang katuturan ng Disaster Management;</span></div>
                        <div class="m3-competency"><span>✅</span><span>Nasusuri ang mga konsepto o termino na may kaugnayan sa disaster management;</span></div>
                        <div class="m3-competency"><span>✅</span><span>Naipaliliwanag ang katangian ng top-down approach sa pagharap sa suliraning pangkapaligiran;</span></div>
                        <div class="m3-competency"><span>✅</span><span>Napaghahambing ang top-down at bottom-up approach;</span></div>
                        <div class="m3-competency"><span>✅</span><span>Nasusuri ang mga layunin ng Community Based-Disaster and Risk Management;</span></div>
                        <div class="m3-competency"><span>✅</span><span>Natutukoy ang mga paghahanda na nararapat gawin sa harap ng mga panganib na dulot ng suliraning pangkapaligiran; at</span></div>
                        <div class="m3-competency"><span>✅</span><span>Napahahalagahan ang bahaging ginagampanan bilang isang mamamayan para sa ligtas na pamayanang kaniyang kinabibilangan.</span></div>
                    </div>

                    <div class="m3-goal">
                        <h4>🧭 d. PAKSANG ARALIN</h4>
                        <ul style="padding-left: 1.2rem; margin:0;">
                            <li>Ang Disaster Management</li>
                            <li>Mga Paghahandang Nararapat Gawin sa Harap ng Panganib/Kalamidad</li>
                        </ul>
                    </div>
                </div>

                <div class="m3-goals-actions">
                    <button type="button" class="m3-btn m3-primary m3-disabled" id="goalsUnderstandBtn" disabled>✅ Naiintindihan ko</button>
                </div>
            </div>
        </div>

        <!-- STEP PANEL -->
        <div class="m3-panel hidden" id="stepPanel">
            <div class="m3-section-title">🧩 Paghahanda</div>
            <div class="m3-section-sub">
               Tanong: Ano ang pinakamahalagang paghahanda na ginagawa sa inyong lugar kapag may paparating na kalamidad?
            </div>

            <div class="m3-steps">
                <div class="m3-step active">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/Emergency supplies kit illustration.png') }}" alt="Paghahanda ng emergency kit">
                    </div>
                    <div class="m3-step-body">
                        <h4>Paghahanda ng emergency kit</h4>
                        <p>Mga gamit na kailangang ihanda bago pa dumating ang kalamidad.</p>
                    </div>
                </div>

                <div class="m3-step">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/pakikinig_sa_balitapng.png') }}" alt="Pakikinig sa balita at babala">
                    </div>
                    <div class="m3-step-body">
                        <h4>Pakikinig sa balita at babala</h4>
                        <p>Pag-alam sa mga opisyal na anunsyo at alerto mula sa awtoridad.</p>
                    </div>
                </div>

                <div class="m3-step">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/paglipat_sa_ligtas_na_lugar.png') }}" alt="Paglikas sa ligtas na lugar">
                    </div>
                    <div class="m3-step-body">
                        <h4>Paglikas sa ligtas na lugar</h4>
                        <p>Pagpunta sa mas ligtas na lugar kapag may banta ng sakuna.</p>
                    </div>
                </div>

                <div class="m3-step">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/paglilinis_kapaligiran.png') }}" alt="Paglilinis ng kanal at kapaligiran">
                    </div>
                    <div class="m3-step-body">
                        <h4>Paglilinis ng kanal at kapaligiran</h4>
                        <p>Pag-alis ng bara at basura upang mabawasan ang pagbaha at pinsala.</p>
                    </div>
                </div>
            </div>

            <div class="m3-footer-actions">
                <a href="{{ route('module3.pretest') }}" class="m3-btn m3-primary">
                    🎯 Magpatuloy
                </a>
            </div>
        </div>

    </div>
</div>

<script>
const startBtn = document.getElementById('startBtn');
const startNote = document.getElementById('startNote');
const heroCard = document.getElementById('heroCard');
const stepPanel = document.getElementById('stepPanel');

const openGoalsBtn = document.getElementById('openGoalsBtn');
const closeGoalsBtn = document.getElementById('closeGoalsBtn');
const goalsModal = document.getElementById('goalsModal');
const goalsScrollArea = document.getElementById('goalsScrollArea');
const goalsUnderstandBtn = document.getElementById('goalsUnderstandBtn');

let hasReadGoals = false;

function unlockStart() {
    if (hasReadGoals) return;
    hasReadGoals = true;

    startBtn.disabled = false;
    startBtn.classList.remove('m3-disabled');
    startBtn.innerHTML = '🚀 Simulan';

    startNote.textContent = '✅ Nabasa mo na ang Mga Layunin. Maaari mo nang pindutin ang Simulan.';
}

function enableUnderstandButton() {
    if (!goalsUnderstandBtn || hasReadGoals) return;
    goalsUnderstandBtn.disabled = false;
    goalsUnderstandBtn.classList.remove('m3-disabled');
}

function checkReadProgress() {
    const nearBottom = goalsScrollArea.scrollTop + goalsScrollArea.clientHeight >= goalsScrollArea.scrollHeight - 24;
    if (nearBottom) enableUnderstandButton();
}

openGoalsBtn.addEventListener('click', () => {
    goalsModal.classList.add('show');

    if (hasReadGoals) {
        goalsUnderstandBtn.disabled = false;
        goalsUnderstandBtn.classList.remove('m3-disabled');
    } else {
        goalsUnderstandBtn.disabled = true;
        goalsUnderstandBtn.classList.add('m3-disabled');
        setTimeout(checkReadProgress, 50);
    }
});

closeGoalsBtn.addEventListener('click', () => goalsModal.classList.remove('show'));

goalsUnderstandBtn.addEventListener('click', () => {
    if (goalsUnderstandBtn.disabled) return;
    unlockStart();
    goalsModal.classList.remove('show');
});

goalsModal.addEventListener('click', (e) => {
    if (e.target === goalsModal) goalsModal.classList.remove('show');
});

goalsScrollArea.addEventListener('scroll', checkReadProgress);

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') goalsModal.classList.remove('show');
});

startBtn.addEventListener('click', () => {
    if (!hasReadGoals) {
        goalsModal.classList.add('show');
        return;
    }

    heroCard.classList.add('m3-hidden');
    stepPanel.classList.remove('hidden');
    stepPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
</script>
@endsection