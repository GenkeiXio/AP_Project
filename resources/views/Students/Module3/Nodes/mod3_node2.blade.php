{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module3\Nodes\mod3_node2.blade.php --}}
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

.hud{
    margin:10px auto 12px;
    display:inline-flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
    position:relative;
    z-index:2;
    padding:8px;
    background:linear-gradient(135deg,rgba(70,48,30,.95),rgba(97,66,42,.95));
    border:1px solid #9f7a4a;
    border-radius:999px;
    box-shadow:0 10px 24px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.14);
    backdrop-filter:blur(6px);
}
.pill{
    border-radius:999px;
    padding:7px 11px;
    font-size:.8rem;
    font-weight:800;
    font-family:'Nunito',sans-serif;
    border:1px solid #b49670;
    background:linear-gradient(135deg,#f7e9d2,#ecd7b6);
    color:#4e351f;
}
.pill.gold{
    border-color:#d3ae62;
    background:linear-gradient(135deg,#f8e5b9,#eacb89);
    color:#5f430e;
}

@media (max-width:760px){
    .hud{
        width:auto;
        max-width:100%;
        justify-content:center;
        border-radius:16px;
    }
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
    width:140px;   /* bigger */
    height:140px;  /* bigger */
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

.section-title{
    margin:18px 0 8px;
    color:#4b2f1b;
    font-size:1.02rem;
    font-weight:800;
    font-family:'Poppins',sans-serif;
    border-left:4px solid #b68b4b;
    padding-left:10px;
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
    border:1px solid #d0bca1;
    background:linear-gradient(135deg,#fffdf8,#f4e8d5);
    padding:14px;
    transition:.22s ease;
    position:relative;
}
.choice-card:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 24px rgba(0,0,0,.10);
}
.choice-card.active{
    border-color:#b99058;
    box-shadow:0 0 0 4px rgba(185,144,88,.2);
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
    background:linear-gradient(135deg,#735131,#8d633c);
    color:#f8efe2;
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
    border:1px dashed #b99564;
    border-radius:18px;
    background:linear-gradient(135deg,#fbf2e3,#f2e5d2);
    padding:18px;
    animation:popIn .35s ease;
}
@keyframes popIn{
    from{ opacity:0; transform:scale(.96); }
    to{ opacity:1; transform:scale(1); }
}

/* Pinahusay na ayos para sa Hakbang 2 */

.step-title{
    margin:0 0 12px;
    font-weight:800;
    font-size:1.1rem;
    color:#3d2f26;
}

.elegant-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

@media (max-width:760px){
    .elegant-grid{ grid-template-columns:1fr; }
}

.elegant-btn{
    position:relative;
    border:none;
    border-radius:20px;
    padding:20px;
    cursor:pointer;
    overflow:hidden;
    transition:all .25s ease;
    backdrop-filter: blur(10px);
    background:rgba(255,247,232,0.82);
    box-shadow:0 15px 35px rgba(0,0,0,0.18);
}

.elegant-btn:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:0 25px 50px rgba(0,0,0,0.18);
}

.elegant-btn:active{
    transform:scale(.98);
}

.btn-content{
    display:flex;
    gap:16px;
    align-items:center;
    position:relative;
    z-index:2;
}

.icon-wrap{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#fff9ee,#f2e2c8);
    box-shadow:inset 0 2px 4px rgba(0,0,0,0.08), 0 0 0 1px rgba(153,113,64,.25);
}

.icon-svg{
    width:30px;
    height:30px;
    display:block;
}

.icon-svg path,
.icon-svg circle,
.icon-svg rect,
.icon-svg line{
    stroke:currentColor;
}

.text-wrap{
    display:flex;
    flex-direction:column;
    gap:4px;
    text-align:left;
}

.btn-title{
    font-size:1.1rem;
    font-weight:800;
}

.btn-desc{
    font-size:.9rem;
    opacity:.85;
    font-weight:600;
    line-height:1.4;
}

.top-style{
    background:linear-gradient(135deg,#f9e4da,#efd0c2);
    color:#7e342c;
}

.bottom-style{
    background:linear-gradient(135deg,#edf4e2,#dce8cf);
    color:#45633e;
}

.btn-glow{
    position:absolute;
    inset:0;
    background:radial-gradient(circle at 30% 20%, rgba(255,255,255,0.6), transparent 60%);
    opacity:.6;
    z-index:1;
}

.game-btn{
    position:relative;
    width:100%;
    border:none;
    border-radius:18px;
    padding:16px 16px;
    margin:0;
    cursor:pointer;
    font-weight:800;
    transition:.18s, transform .18s ease, box-shadow .18s ease;
    box-shadow:0 12px 24px rgba(0,0,0,.08);
    text-align:left;
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

.choice-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
    margin-top:14px;
}
@media (max-width:760px){
    .choice-grid{ grid-template-columns:1fr; }
}

.choice-card-btn{
    display:flex;
    gap:14px;
    align-items:flex-start;
    justify-content:flex-start;
}

.choice-badge{
    flex:0 0 56px;
    width:56px;
    height:56px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.5rem;
    background:rgba(255,255,255,.72);
    box-shadow:inset 0 1px 0 rgba(255,255,255,.8);
}

.choice-copy{
    display:flex;
    flex-direction:column;
    gap:4px;
}

.choice-title{
    font-size:1.02rem;
    font-weight:800;
}

.choice-desc{
    font-size:.9rem;
    line-height:1.45;
    font-weight:600;
    opacity:.9;
}

.btn-top .choice-desc,
.btn-bottom .choice-desc{
    color:inherit;
}

.challenge{
    display:none;
    margin-top:16px;
    border:1px solid #ccb79c;
    border-radius:16px;
    background:linear-gradient(180deg,#fffcf5,#f4e7d2);
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
    border:1px solid #c5aa84;
    background:#e9d8be;
    overflow:hidden;
}
.progress-fill{
    width:0%;
    height:100%;
    background:linear-gradient(90deg,#b57d2c,#5a7c4b);
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
    border:1px solid #d1bea3;
    background:linear-gradient(135deg,#fffcf6,#f1e4d0);
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
    border:1px solid #ccb79b;
    background:linear-gradient(135deg,#f8efdf,#efe0c8);
    padding:14px;
    text-align:center;
}
.result h3{
    margin:0 0 6px;
    color:#5f4627;
}

.cons-wrap{
    text-align:left;
    margin-top:12px;
    border-radius:12px;
    padding:12px;
    border:1px solid #d7c3a5;
    background:#fff8eb;
}
.cons-wrap.bad{
    border-color:#d9a9a2;
    background:#fff1ee;
}
.cons-wrap.good{
    border-color:#b7cba8;
    background:#f4f8ee;
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
.act-retry{ background:linear-gradient(135deg,#8e643d,#6e4d2e); border:1px solid #a98353; color:#f8efe2; }
.act-map{ background:linear-gradient(135deg,#f6ead8,#e8d8bf); border:1px solid #c9b08a; color:#59422c; }
.act-next{ background:linear-gradient(135deg,#587a4a,#3f5f36); color:#fff; }

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
    background:linear-gradient(180deg,#fff7e9,#f2e3cc);
    border-radius:16px;
    border:1px solid #cdb596;
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
.btn-close{ background:linear-gradient(135deg,#efe0cb,#e2cfb2); color:#4f3a26; }
.btn-next{ background:linear-gradient(135deg,#597b4a,#416236); color:#fff; }

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

            <h3 class="section-title">📘 Hakbang 1: Basahin muna ang dalawang pamamaraan</h3>

            <div class="choice-container">
                <div class="choice-card active" id="topCard">
                    <div class="choice-head">
                        <h3>Top-down Approach</h3>
                        <button class="read-btn" onclick="reveal('top')">Basahin</button>
                    </div>
                    <div id="topText" class="hidden-text show">
                        Ang pamamaraang ito ay umaasa sa mas mataas na antas ng pamahalaan sa lahat ng aspeto ng pagharap sa sakuna,
                        mula pagpaplano hanggang pagtugon. Gayunman, madalas itong mabagal dahil hindi agad natutugunan ang
                        pangangailangan ng mga mamamayan, lalo na ang mga pinakaapektado. Karaniwan ding limitado ang mga plano dahil
                        nakabatay lamang ito sa pananaw ng mga pinuno, habang napapabayaan ang karanasan at boses ng komunidad. Bukod dito,
                        ang hindi pagkakasundo ng pambansa at lokal na pamahalaan ay nagiging sanhi ng pagkaantala sa maayos na pagtugon.
                    </div>
                </div>

                <div class="choice-card active" id="bottomCard">
                    <div class="choice-head">
                        <h3>Bottom-up Approach</h3>
                        <button class="read-btn" onclick="reveal('bottom')">Basahin</button>
                    </div>
                    <div id="bottomText" class="hidden-text show">
                        Ang pamamaraang ito ay nakatuon sa aktibong pakikilahok ng mga mamamayan at iba’t ibang sektor ng pamayanan
                        sa pagtukoy, pag-aanalisa, at paglutas ng mga suliranin. Mahalaga ang pamumuno ng lokal na komunidad, kasama
                        ang lokal na pamahalaan, pribadong sektor, at mga organisasyong hindi pangkalakalan, upang maisulong ang
                        epektibong pag-unlad mula sa ibaba. Sa paraang ito, nabibigyang-halaga ang iba’t ibang pananaw at karanasan
                        ng mga taong nakatira sa mga lugar na madalas tamaan ng sakuna, na nagsisilbing batayan ng mas angkop at
                        makabuluhang plano. Nakatutulong din ang maayos na pamamahala ng pondo at pagkilala sa matagumpay na pagpapatupad
                        upang mapanatili ang bisa ng programa, kung saan ang tagumpay ay nakasalalay sa malawakang pakikilahok ng
                        komunidad sa pagpaplano at pagdedesisyon.
                    </div>
                </div>
            </div>

            <div class="choose-section" id="chooseSection" style="display:block;">
                <h3 class="step-title">👉 Hakbang 2: Piliin ang iyong panig</h3>

                <div class="choice-grid elegant-grid">

                    <!-- TOP DOWN -->
                    <button class="elegant-btn top-style" onclick="chooseSide('top')">
                        <div class="btn-glow"></div>

                        <div class="btn-content">
                            <div class="icon-wrap" aria-hidden="true">
                                <svg class="icon-svg" viewBox="0 0 24 24" fill="none">
                                    <rect x="4" y="4" width="16" height="4" rx="2" fill="currentColor" opacity="0.2"></rect>
                                    <rect x="4" y="10" width="10" height="4" rx="2" fill="currentColor" opacity="0.35"></rect>
                                    <rect x="4" y="16" width="6" height="4" rx="2" fill="currentColor" opacity="0.5"></rect>
                                    <path d="M18 8V18" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M16 10L18 8L20 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="text-wrap">
                                <span class="btn-title">Top-down Approach</span>
                                <span class="btn-desc">
                                    Mabilis ang utos mula sa taas, pero sapat ba ito?
                                </span>
                            </div>
                        </div>
                    </button>

                    <!-- BOTTOM UP -->
                    <button class="elegant-btn bottom-style" onclick="chooseSide('bottom')">
                        <div class="btn-glow"></div>

                        <div class="btn-content">
                            <div class="icon-wrap" aria-hidden="true">
                                <svg class="icon-svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 19V8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path>
                                    <path d="M12 8C12 5.8 10.2 4 8 4C8 6.2 9.8 8 12 8Z" fill="currentColor" opacity="0.45"></path>
                                    <path d="M12 8C12 5.8 13.8 4 16 4C16 6.2 14.2 8 12 8Z" fill="currentColor" opacity="0.65"></path>
                                    <path d="M7 19H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M12 15L10 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M12 15L14 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </div>
                            <div class="text-wrap">
                                <span class="btn-title">Bottom-up Approach</span>
                                <span class="btn-desc">
                                    Komunidad ang sentro ng desisyon — mas epektibo ba?
                                </span>
                            </div>
                        </div>
                    </button>

                </div>
            </div>

            <div class="challenge" id="challengeBox">
                <h3 style="margin:0;">⚖️ Hakbang 3: Mga Ikot ng Pagtatalo</h3>
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
            </div>

            <div class="result" id="resultBox"></div>
        </div>
    </div>
</div>

<div id="wrongModal" class="modal-overlay">
    <div class="modal-box">
        <h3>❌ Naku!</h3>
                <p id="wrongText">Naubos ang oras. Sa pagtatalo, mahalaga ang bilis at linaw.</p>
        <button class="modal-btn btn-close" onclick="closeModal('wrongModal')">Subukang muli</button>
    </div>
</div>

<div id="successModal" class="modal-overlay">
    <div class="modal-box">
        <h3>🎉 Binabati Ka, Punong-Bayan!</h3>
        <p>Naipakita mo ang mas matibay na argumento sa mga pamamaraang pangkahandaan sa sakuna.</p>
        <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('inner.map3') }}"><button class="modal-btn btn-close">🗺 Bumalik sa Mapa</button></a>
        </div>
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

    const narratorMessage = "Ikaw ang punong-bayan ngayon. Basahin ang dalawang pamamaraan, piliin ang panig, at manalo sa mga ikot ng pagtatalo.";

const approachConsequences = {
    top: [
        "❌ Hindi narinig ang komunidad kaya hindi tugma ang plano sa tunay nilang pangangailangan.",
        "❌ Mabagal ang pagtugon dahil nakaasa sa desisyon ng mas mataas na pamahalaan.",
        "❌ Kulang sa pakikilahok ng mamamayan kaya mahina ang pagpapatupad.",
        "❌ Mas mataas ang pinsala dahil hindi handa ang komunidad."
    ],
    bottom: [
        "✅ Mas naging epektibo ang plano dahil nakabatay sa karanasan ng komunidad.",
        "✅ Mabilis ang pagtugon dahil aktibo ang mga mamamayan.",
        "✅ Mas mataas ang pakikilahok kaya mas maayos ang pagpapatupad.",
        "✅ Mas nababawasan ang pinsala dahil handa at may kaalaman ang komunidad."
    ]
};

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
            { side: "top", text: "Iisang plano lamang mula sa taas para sa lahat ng lugar.", points: 0, feedback: "Maaaring hindi tugma sa iba’t ibang pangangailangan ng mga lugar." },
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
    statusText.textContent = `✅ Napili ang panig: ${side === 'bottom' ? 'Bottom-up Approach' : 'Top-down Approach'}. Simulan ang mga ikot ng pagtatalo.`;
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
    promptText.textContent = `Ikot ${roundIndex + 1}: ${r.prompt}`;
    argGrid.innerHTML = '';

    r.options.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = 'arg-btn';
        btn.textContent = opt.text;
        btn.onclick = () => answer(i);
        argGrid.appendChild(btn);
    });

    const pct = (roundIndex / rounds.length) * 100;
    progressFill.style.width = `${pct}%`;
    startTimer();
}

function startTimer(){
    timerLabel.textContent = `⏱ ${timeLeft} segundo`;
    timer = setInterval(() => {
        timeLeft--;
        timerLabel.textContent = `⏱ ${timeLeft} segundo`;
        if (timeLeft <= 5) timerLabel.style.color = '#a7392f';
        if (timeLeft <= 0){
            clearInterval(timer);
            loseLife("⏰ Naubos ang oras! Walang naipiling argumento.");
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
        statusText.textContent = `✅ ${pick.feedback} (+${gained} puntos)`;
    } else {
        statusText.className = 'status bad';
        statusText.textContent = `❌ ${pick.feedback} (+${gained} puntos)`;
        loseLife("Mas mahina ang napiling argumento sa ikot na ito.");
    }

    updateHUD();
    setTimeout(nextRound, 950);
}

function loseLife(msg){
    lives = Math.max(0, lives - 1);
    updateHUD();
    if (lives === 0){
        document.getElementById('wrongText').textContent = msg + " Wala ka nang natitirang buhay.";
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
    roundPill.textContent = `Ikot ${Math.min(roundIndex + 1, rounds.length)}/${rounds.length}`;
    scorePill.textContent = `Iskor: ${score}`;
    lifePill.textContent = `Buhay: ${'❤️'.repeat(lives)}${'🖤'.repeat(3 - lives)}`;
    timerLabel.style.color = '#7a4d2b';
}

function getConsequencesHTML(side){
    const isBottom = side === 'bottom';
    const label = isBottom ? 'Bottom-up Approach' : 'Top-down Approach';
    const list = approachConsequences[side] ?? [];

    return `
        <div class="cons-wrap ${isBottom ? 'good' : 'bad'}">
            <h4>👉 Kung ${label}:</h4>
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

    // ✅ I-save ang progreso sa talaan
    saveGameProgress(passed);
    
    const reviewSide = (chosenSide === 'bottom' && passed) ? 'bottom' : 'top';

    // Mark node as completed once end-game screen is reached.
    sessionStorage.setItem('m3v2_node2', 'true');
    localStorage.setItem('m3v2_node2', 'true');

    if (passed){
        burstConfetti();
        document.getElementById('successModal').style.display = 'flex';
    }

    resultBox.innerHTML = `
        <h3>${passed ? '🏆 Napanalunan ang Pagtatalo!' : '📌 Kailangan Pa ng Pagsusuri sa Pagtatalo'}</h3>
        <p style="margin:0 0 8px;">Huling Iskor: <b>${score}</b> / ${maxScore}</p>
        <p style="margin:0; color:#5b4e44;">
            ${passed
                ? 'Magaling! Naipakita mo ang matibay na argumento.'
                : 'Subukan muli. Basahin uli ang dalawang pamamaraan at piliin ang mas akma sa sitwasyon.'}
        </p>
        ${getConsequencesHTML(reviewSide)}
        <div class="actions">
            <a class="act-retry" href="{{ route('module3.node2') }}">🔁 Ulitin</a>
            <a class="act-map" href="{{ route('inner.map3') }}">🗺 Bumalik sa Mapa</a>
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

function saveGameProgress(passed){
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
    .then(data => {
        console.log("Saved:", data);
    })
    .catch(err => console.error(err));
}

</script>

@endsection