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

.burger-menu {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1000;
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    cursor: pointer;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.burger-menu span {
    display: block;
    width: 24px;
    height: 2.5px;
    background-color: #2e7d32;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.burger-menu.open span:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.burger-menu.open span:nth-child(2) {
    opacity: 0;
}

.burger-menu.open span:nth-child(3) {
    transform: rotate(-45deg) translate(5px, -5px);
}

/* Mobile Navigation Drawer */
.mobile-nav {
    position: fixed;
    top: 0;
    left: -280px;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #1b5e20, #0d3b12);
    z-index: 999;
    transition: left 0.3s ease;
    padding-top: 70px;
    box-shadow: 2px 0 20px rgba(0,0,0,0.3);
}

.mobile-nav.open {
    left: 0;
}

.mobile-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-nav li {
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.mobile-nav a {
    display: block;
    padding: 15px 20px;
    color: white;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.2s;
}

.mobile-nav a:hover {
    background: rgba(255,255,255,0.2);
}

/* Overlay when menu is open */
.nav-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 998;
    display: none;
}

.nav-overlay.show {
    display: block;
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

/* Shield icon at the very top */
.m3-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    background: linear-gradient(135deg, #f5f9f0, #eaf6e6);
    border: 2px solid #cde7d3;
    box-shadow: 0 12px 25px rgba(0,0,0,.12);
    margin-bottom: 20px;
}

.m3-title-wrap{
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
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
    text-align: center;
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
    margin:0 0 8px 0;
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

/* ===== BUTTON LAYOUT - Mga Layunin ABOVE, Simulan BELOW ===== */
.m3-actions {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 15px;
    width: 100%;
}

.m3-actions .m3-btn {
    width: auto;
    min-width: 200px;
    padding: 14px 28px;
    font-size: 1rem;
    border-radius: 40px;
}

/* For larger screens */
@media (min-width: 769px) {
    .m3-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .m3-actions .m3-btn {
        min-width: 220px;
        padding: 14px 32px;
        font-size: 1.05rem;
    }
}

.m3-btn{
    padding:12px 18px;
    border-radius:40px;
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

/* Ghost button style for Mga Layunin */
.m3-ghost{
    background: #eef8ef;
    border: 2px solid #2f9b57;
    color: #1b4f35;
}

.m3-ghost:hover {
    background: #e0f2e3;
    transform: translateY(-2px);
}

/* Primary button style for Simulan - initially disabled/locked */
.m3-primary{
    position:relative;
    overflow:hidden;
    background: linear-gradient(135deg, #cce5d0, #b8dcbe);
    color: #8aa88e;
    box-shadow: none;
    border: none;
}

/* When enabled/unlocked */
.m3-primary:not(:disabled):not(.m3-disabled) {
    background: linear-gradient(135deg, #8ce274, #2f9b57);
    color: #0f311f;
    box-shadow: 0 10px 24px rgba(47,155,87,.25);
    cursor: pointer;
}

.m3-primary:not(:disabled):not(.m3-disabled):hover { 
    transform: translateY(-2px); 
}

.m3-primary:not(:disabled):not(.m3-disabled)::before{
    content:"";
    position:absolute;
    top:0;
    left:-120%;
    width:100%;
    height:100%;
    background:linear-gradient(100deg, transparent 0%, rgba(255,255,255,.38) 50%, transparent 100%);
    transition:left .45s ease;
}

.m3-primary:not(:disabled):not(.m3-disabled):hover::before{ left:120%; }

.m3-btn[disabled],
.m3-btn.m3-disabled{
    opacity: 0.7;
    cursor: not-allowed;
    pointer-events: none;
    box-shadow: none;
    transform: none !important;
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
    border:2px solid #e0eee2;
    border-radius:18px;
    padding:12px;
    background:#fff;
    cursor:pointer;
    transition:.18s ease;
    overflow:hidden;
}

.m3-step:hover{
    transform:translateY(-2px);
    border-color:#a8d4b2;
    background:#f9fff9;
}

.m3-step.selected{
    border-color:var(--green);
    background:#eefaf0;
    box-shadow:0 10px 22px rgba(31,122,71,.15);
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
    display:flex;
    align-items:center;
    gap:10px;
}

.m3-step h4 .select-indicator {
    font-size: 1.2rem;
    opacity: 0;
    transition: opacity 0.2s;
}

.m3-step.selected h4 .select-indicator {
    opacity: 1;
}

.m3-step p{
    margin:0;
    color:#4f6457;
    line-height:1.55;
}

.m3-step input[type="radio"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--green);
    margin-right: 10px;
}

.m3-radio-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.m3-footer-actions{
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}

.m3-footer-actions .m3-btn {
    padding: 12px 28px;
    min-width: 160px;
}

.m3-footer-actions .m3-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.m3-goals-actions{
    margin-top:16px;
    display:flex;
    justify-content:flex-end;
}

.hidden{ display:none; }
.m3-hidden{ display:none !important; }

/* Poll confirmation toast */
.poll-toast {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: #1f7a47;
    color: white;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: bold;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    animation: fadeInUp 0.3s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* ===== MOBILE RESPONSIVE STYLES ===== */
@media (max-width: 768px) {
    .burger-menu {
        display: flex;
    }
    
    .m3-wrap {
        padding: 70px 12px 28px;
    }
    
    .m3-icon {
        width: 55px;
        height: 55px;
        font-size: 2rem;
        margin-bottom: 15px;
    }
    
    .m3-hero, .m3-panel {
        border-radius: 20px;
        padding: 18px;
    }
    
    .m3-title {
        font-size: 1.35rem;
    }
    
    .m3-sub {
        font-size: 0.9rem;
        margin-top: 10px;
    }
    
    .m3-actions {
        margin-top: 18px;
        gap: 12px;
    }
    
    .m3-actions .m3-btn {
        min-width: 170px;
        padding: 12px 24px;
        font-size: 0.9rem;
    }
    
    .m3-step {
        grid-template-columns: 85px 1fr;
        gap: 10px;
        padding: 10px;
    }
    
    .m3-step-media {
        min-height: 85px;
    }
    
    .m3-step h4 {
        font-size: 0.95rem;
    }
    
    .m3-step p {
        font-size: 0.8rem;
    }
    
    .m3-modal-content {
        max-height: 85vh;
        padding: 14px;
    }
    
    .m3-modal-head {
        flex-direction: column;
        padding: 12px;
    }
    
    .m3-modal-title {
        font-size: 1.2rem;
    }
    
    .m3-modal-close {
        align-self: flex-end;
        padding: 6px 12px;
        font-size: 0.8rem;
    }
    
    .m3-goal {
        padding: 12px;
    }
    
    .m3-goal h4 {
        font-size: 0.95rem;
    }
    
    .m3-goal p, .m3-goal li {
        font-size: 0.85rem;
    }
    
    .m3-competency {
        padding: 8px 10px;
        font-size: 0.8rem;
    }
    
    .m3-section-title {
        font-size: 1rem;
    }
    
    .m3-section-sub {
        font-size: 0.85rem;
    }
    
    .m3-footer-actions .m3-btn {
        padding: 10px 20px;
        min-width: 140px;
        font-size: 0.85rem;
    }
}

@media (max-width: 480px) {
    .burger-menu {
        width: 40px;
        height: 40px;
        top: 12px;
        left: 12px;
    }
    
    .burger-menu span {
        width: 20px;
        height: 2px;
    }
    
    .m3-wrap {
        padding: 65px 10px 20px;
    }
    
    .m3-icon {
        width: 48px;
        height: 48px;
        font-size: 1.8rem;
        margin-bottom: 12px;
    }
    
    .m3-hero, .m3-panel {
        padding: 14px;
        border-radius: 16px;
    }
    
    .m3-title {
        font-size: 1.2rem;
    }
    
    .m3-sub {
        font-size: 0.8rem;
    }
    
    .m3-actions .m3-btn {
        min-width: 150px;
        padding: 10px 20px;
        font-size: 0.85rem;
    }
    
    .m3-step {
        grid-template-columns: 70px 1fr;
        gap: 8px;
        padding: 8px;
    }
    
    .m3-step-media {
        min-height: 70px;
    }
    
    .m3-step h4 {
        font-size: 0.85rem;
    }
    
    .m3-step p {
        font-size: 0.72rem;
        line-height: 1.4;
    }
    
    .m3-modal-content {
        padding: 12px;
    }
    
    .m3-modal-title {
        font-size: 1rem;
    }
    
    .m3-modal-sub {
        font-size: 0.75rem;
    }
    
    .m3-goal {
        padding: 10px;
    }
    
    .m3-goal h4 {
        font-size: 0.85rem;
    }
    
    .mobile-nav {
        width: 240px;
        left: -240px;
    }
    
    .mobile-nav a {
        padding: 12px 18px;
        font-size: 14px;
    }
    
    .m3-footer-actions .m3-btn {
        padding: 8px 16px;
        min-width: 120px;
        font-size: 0.8rem;
    }
}

@media (max-width: 640px) and (orientation: landscape) {
    .m3-wrap {
        padding: 60px 12px 20px;
    }
    
    .m3-icon {
        width: 45px;
        height: 45px;
        font-size: 1.6rem;
        margin-bottom: 10px;
    }
    
    .m3-step-media {
        min-height: 70px;
    }
    
    .m3-modal-content {
        max-height: 90vh;
    }
}
</style>
@endpush

@section('content')
<!-- BURGER MENU (Mobile Only) -->
<div class="burger-menu" id="burgerMenu" onclick="toggleMobileNav()">
    <span></span>
    <span></span>
    <span></span>
</div>

<!-- MOBILE NAVIGATION DRAWER -->
<div class="mobile-nav" id="mobileNav">
    <ul>
        <li><a href="{{ url('/') }}">🏠 Home</a></li>
        <li><a href="{{ route('module.home') }}">📘 Module 2</a></li>
        <li><a href="{{ route('module3.home') }}">📗 Module 3</a></li>
        <li><a href="{{ route('module4.home') }}">📙 Module 4</a></li>
        <li><a href="{{ url('/map') }}">🗺️ World Map</a></li>
    </ul>
</div>

<!-- OVERLAY -->
<div class="nav-overlay" id="navOverlay" onclick="closeMobileNav()"></div>

<div class="m3-wrap">
    <div class="m3-shell">

        <!-- HERO with shield icon at the very top -->
        <div class="m3-hero" id="heroCard">
            <div class="m3-title-wrap">
                <div class="m3-icon">🛡️</div>
                <h1 class="m3-title">
                    Mission Prep: Paghahandang Nararapat Gawin sa Harap ng Panganib na Dulot ng Suliraning Pangkapaligiran
                </h1>
            </div>

            <p class="m3-sub">
                Tuklasin ang mga wastong paghahanda upang maging ligtas at handa sa panahon ng kalamidad.
                Basahin muna ang mga layunin sa ibaba bago pindutin ang Simulan.
            </p>

            <!-- BUTTONS: MGA LAYUNIN ABOVE, SIMULAN BELOW -->
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
                    <button type="button" class="m3-btn m3-primary" id="goalsUnderstandBtn">✅ Naiintindihan ko</button>
                </div>
            </div>
        </div>

        <div class="m3-panel hidden" id="stepPanel">
            <div class="m3-section-title">🧩 Paghahanda (Poll Question)</div>
            <div class="m3-section-sub">
               Tanong: Ano ang pinakamahalagang paghahanda na ginagawa sa inyong lugar kapag may paparating na kalamidad?
            </div>

            <div class="m3-steps" id="pollOptions">
                <div class="m3-step" data-option="0" data-value="emergency_kit">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/Emergency supplies kit illustration.png') }}" alt="Paghahanda ng emergency kit">
                    </div>
                    <div class="m3-step-body">
                        <div class="m3-radio-wrapper">
                            <input type="radio" name="poll_option" id="opt1" value="emergency_kit">
                            <div>
                                <h4>Paghahanda ng emergency kit <span class="select-indicator">✅</span></h4>
                                <p>Mga gamit na kailangang ihanda bago pa dumating ang kalamidad.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m3-step" data-option="1" data-value="listen_news">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/pakikinig_sa_balitapng.png') }}" alt="Pakikinig sa balita at babala">
                    </div>
                    <div class="m3-step-body">
                        <div class="m3-radio-wrapper">
                            <input type="radio" name="poll_option" id="opt2" value="listen_news">
                            <div>
                                <h4>Pakikinig sa balita at babala <span class="select-indicator">✅</span></h4>
                                <p>Pag-alam sa mga opisyal na anunsyo at alerto mula sa awtoridad.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m3-step" data-option="2" data-value="evacuate">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/paglipat_sa_ligtas_na_lugar.png') }}" alt="Paglikas sa ligtas na lugar">
                    </div>
                    <div class="m3-step-body">
                        <div class="m3-radio-wrapper">
                            <input type="radio" name="poll_option" id="opt3" value="evacuate">
                            <div>
                                <h4>Paglikas sa ligtas na lugar <span class="select-indicator">✅</span></h4>
                                <p>Pagpunta sa mas ligtas na lugar kapag may banta ng sakuna.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m3-step" data-option="3" data-value="clean_drainage">
                    <div class="m3-step-media">
                        <img src="{{ asset('pictures/paglilinis_kapaligiran.png') }}" alt="Paglilinis ng kanal at kapaligiran">
                    </div>
                    <div class="m3-step-body">
                        <div class="m3-radio-wrapper">
                            <input type="radio" name="poll_option" id="opt4" value="clean_drainage">
                            <div>
                                <h4>Paglilinis ng kanal at kapaligiran <span class="select-indicator">✅</span></h4>
                                <p>Pag-alis ng bara at basura upang mabawasan ang pagbaha at pinsala.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m3-footer-actions">
                <button class="m3-btn m3-primary" id="confirmPollBtn" disabled>🎯 Magpatuloy</button>
            </div>
        </div>

    </div>
</div>

<script>
// Mobile Navigation Functions
function toggleMobileNav() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('navOverlay');
    const burger = document.getElementById('burgerMenu');
    
    mobileNav.classList.toggle('open');
    overlay.classList.toggle('show');
    burger.classList.toggle('open');
}

function closeMobileNav() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('navOverlay');
    const burger = document.getElementById('burgerMenu');
    
    mobileNav.classList.remove('open');
    overlay.classList.remove('show');
    burger.classList.remove('open');
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'poll-toast';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 2000);
}

// Poll selection logic
const pollOptions = document.querySelectorAll('.m3-step');
const confirmBtn = document.getElementById('confirmPollBtn');
let selectedPollValue = null;

pollOptions.forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    
    // Click on the whole option selects it
    option.addEventListener('click', (e) => {
        // Don't trigger if clicking directly on radio (it will trigger anyway)
        if (e.target.type !== 'radio') {
            radio.checked = true;
        }
        // Trigger change event
        const changeEvent = new Event('change', { bubbles: true });
        radio.dispatchEvent(changeEvent);
    });
    
    radio.addEventListener('change', () => {
        if (radio.checked) {
            // Remove selected class from all
            pollOptions.forEach(opt => opt.classList.remove('selected'));
            // Add selected class to this one
            option.classList.add('selected');
            selectedPollValue = radio.value;
            confirmBtn.disabled = false;
        }
    });
});

// Confirm button - saves selection locally and proceeds
confirmBtn.addEventListener('click', () => {
    if (selectedPollValue) {
        // Save to localStorage (no DB for now)
        localStorage.setItem('module3_poll_answer', selectedPollValue);
        localStorage.setItem('module3_poll_timestamp', new Date().toISOString());
        showToast('✓ Napili: ' + getOptionText(selectedPollValue));
        
        // Proceed to pre-test
        window.location.href = "{{ route('module3.pretest') }}";
    }
});

function getOptionText(value) {
    const options = {
        'emergency_kit': 'Paghahanda ng emergency kit',
        'listen_news': 'Pakikinig sa balita at babala',
        'evacuate': 'Paglikas sa ligtas na lugar',
        'clean_drainage': 'Paglilinis ng kanal at kapaligiran'
    };
    return options[value] || value;
}

const startBtn = document.getElementById('startBtn');
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

    // Enable and style the Simulan button
    startBtn.disabled = false;
    startBtn.classList.remove('m3-disabled');
    startBtn.innerHTML = '🚀 Simulan';
}

function checkReadProgress() {
    const nearBottom = goalsScrollArea.scrollTop + goalsScrollArea.clientHeight >= goalsScrollArea.scrollHeight - 50;
    if (nearBottom && !hasReadGoals) {
        if (goalsUnderstandBtn.disabled) {
            goalsUnderstandBtn.disabled = false;
        }
    }
}

openGoalsBtn.addEventListener('click', () => {
    goalsModal.classList.add('show');
    
    if (hasReadGoals) {
        goalsUnderstandBtn.disabled = false;
    } else {
        goalsUnderstandBtn.disabled = true;
        goalsScrollArea.scrollTop = 0;
        setTimeout(checkReadProgress, 100);
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
        setTimeout(checkReadProgress, 100);
        return;
    }

    heroCard.classList.add('m3-hidden');
    stepPanel.classList.remove('hidden');
    stepPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
</script>
@endsection