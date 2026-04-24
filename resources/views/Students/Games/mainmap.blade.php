<!-- @extends('Students.studentslayout') -->

@section('title', 'World Map')

@php
    // Get module unlock status from session
    // Module 2 is always unlocked (starting point)
    $module2_unlocked = true;
    
    // Module 3 unlocks after completing Module 2
    $module3_unlocked = session('module3_unlocked', false);
    
    // Module 4 unlocks after completing Module 3
    $module4_unlocked = session('module4_unlocked', false);
    
    // For debugging - you can remove this later
    // Uncomment to test locked states:
    // session(['module3_unlocked' => false]);
    // session(['module4_unlocked' => false]);
@endphp

@push('styles')
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: hidden; /* Prevents scrollbars if you want a fixed game screen */
    }

    .page-content {
        max-width: 1350px !important; 
    }

    .map-wrapper {
        width: 100vw;
        height: 100vh;
        padding: 0; /* ❌ remove spacing */
        margin: 0;
    }

    .map-container {
        position: relative;
        width: 100vw;   /* FULL WIDTH */
        height: 100vh;  /* FULL HEIGHT */
        
        will-change: transform; /* OPTIMIZATION: hint for smoother animations */
        border-radius: 0; /* remove rounded edges */
        overflow: hidden;
        box-shadow: none; /* optional: remove floating effect */
    }

    .background-map {
        width: 100%;
        height: 100%;
        object-fit: cover; /* fills screen nicely */
    }

    .pin {
        position: absolute;
        width: 120px; 
        height: 160px; 
        
        background-image: url('{{ asset('pictures/map_pin.png') }}');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center bottom;
        background-color: transparent;
        border: none;
        cursor: pointer;
        z-index: 10;
        
        /* Anchor at Tip */
        transform: translate(-50%, -100%); 
        
        /* FIXED: Changed 'pulse' to 'pinPulse' to match your keyframes */
        animation: pinPulse 2s infinite ease-in-out;
        transition: transform 0.2s ease;
    }

    /* Hover Effects */
    .pin:hover {
        transform: translate(-50%, -100%) scale(1.1);
    }

    /* Positioning the 3 pins (Adjust these % values to fit your map) */
    .location-1 { top: 50%; left: 25%;}
    .location-2 { top: 53%; left: 50%; }
    .location-3 { top: 59%; left: 82%; }

    /* Simple Tooltip */
    .pin .tooltip {
        visibility: visible;
        position: absolute;
        bottom: 125px;
        left: 50%;
        transform: translateX(-50%);
        background: none;        /* remove dark background */
        padding: 0;              /* remove padding */
        border-radius: 0;
        box-shadow: none;
        white-space: nowrap;
    }

    .pin .tooltip img {
        width: 350px;
        height: auto;
        display: block;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.4));
    }

    .pin:hover .tooltip {
        background-color: #ffa502; /* Turns orange on hover */
        color: #000;
    }

    /* ===== LOCKED PIN STYLES ===== */
    .pin.locked-pin {
        opacity: 0.6;
        filter: grayscale(0.3);
        cursor: not-allowed !important;
    }

    .pin.locked-pin:hover {
        transform: translate(-50%, -100%) scale(1);
        opacity: 0.6;
    }

    .lock-icon {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 24px;
        background: rgba(0, 0, 0, 0.75);
        padding: 5px 10px;
        border-radius: 50%;
        color: #ffd700;
        z-index: 20;
        white-space: nowrap;
        font-weight: bold;
    }

    /* Locked message notification */
    .locked-notification {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.9);
        color: #ffa502;
        padding: 12px 24px;
        border-radius: 50px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        z-index: 10000;
        text-align: center;
        animation: fadeInUp 0.3s ease;
        pointer-events: none;
        font-size: 14px;
        white-space: nowrap;
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

    /* Back Button - Desktop */
    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 100;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #1a1a1a;
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        transition: transform 0.2s;
    }

    .back-button:hover {
        transform: scale(1.05);
        background-color: #ffffff;
    }

    /* ===== BURGER MENU (Mobile Only) ===== */
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

    /* Burger animation when open */
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
        font-family: 'Courier New', Courier, monospace;
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

    .page-content {
        max-width: 100% !important;
        padding: 0 !important;
    }

    @keyframes pinPulse {
        0% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
        50% { filter: drop-shadow(0 0 20px rgba(255, 71, 87, 0.9)); }
        100% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
    }

    /* MODAL (matches your theme) */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;

        background: linear-gradient(135deg, rgba(0,0,0,0.65), rgba(34,139,34,0.45));
        backdrop-filter: blur(6px);

        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal.show {
        display: flex;
    }

    /* ✨ MAIN CARD - Made scrollable for mobile */
    .modal-content {
        background: linear-gradient(135deg, #ffffff, #f3f8f3);
        padding: 28px;
        width: 90%;
        max-width: 620px;
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 22px;
        text-align: left;

        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        animation: popIn 0.35s ease;
        position: relative;
    }

    /* Custom scrollbar for modal content */
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: #e0e0e0;
        border-radius: 10px;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: #2e7d32;
        border-radius: 10px;
    }

    /* ✨ SECTION CARDS */
    .modal-section {
        background: #ffffff;
        border-left: 6px solid #2e7d32;
        padding: 18px;
        margin-bottom: 18px;
        border-radius: 14px;

        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
    }

    .modal-section:hover {
        transform: translateY(-2px);
    }

    /* ✨ HEADINGS */
    .modal-section h3 {
        margin-bottom: 8px;
        font-size: 1.1rem;
        font-weight: 900;
        color: #1b5e20;
    }

    /* ✨ TEXT */
    .modal-section p {
        font-size: 0.97rem;
        line-height: 1.7;
        color: #444;
    }

    /* ✨ BUTTON UPGRADE */
    .modal-content .btn-primary {
        width: 100%;
        margin-top: 10px;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;

        background: linear-gradient(135deg, #2e7d32, #66bb6a);
        color: #fff;
        border: none;
        cursor: pointer;

        box-shadow: 0 8px 20px rgba(46,125,50,0.4);
        transition: 0.25s ease;
    }

    .modal-content .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(46,125,50,0.6);
    }

    @keyframes popIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* 🎯 PIN FOCUS */
    .pin.active {
        transform: translate(-50%, -100%) scale(1.4) !important;
        z-index: 50;
        animation: pinSelect 0.6s ease;
    }

    @keyframes pinSelect {
        0% { transform: translate(-50%, -100%) scale(1); }
        50% { transform: translate(-50%, -100%) scale(1.6); }
        100% { transform: translate(-50%, -100%) scale(1.4); }
    }

    /* 🌫 FADE OUT SCREEN */
    .screen-fade {
        animation: fadeToBlack 0.6s forwards;
    }

    @keyframes fadeToBlack {
        to {
            opacity: 0;
            transform: scale(1.05);
        }
    }

    /* ===== NEW MOBILE RESPONSIVE STYLES ===== */
    /* For tablets and smaller devices */
    @media (max-width: 1024px) {
        .pin {
            width: 90px;
            height: 120px;
        }
        
        .pin .tooltip {
            bottom: 100px;
            font-size: 14px;
            padding: 4px 12px;
            white-space: nowrap;
        }
        
        .pin:hover {
            transform: translate(-50%, -100%) scale(1.05);
        }
        
        .modal-content {
            width: 85%;
            max-width: 500px;
            padding: 20px;
            max-height: 80vh;
        }
        
        .modal-section {
            padding: 14px;
            margin-bottom: 14px;
        }
        
        .modal-section h3 {
            font-size: 1rem;
        }
        
        .modal-section p {
            font-size: 0.9rem;
        }

        .lock-icon {
            bottom: 80px;
            font-size: 20px;
        }
    }

    @media (max-width: 768px) {

        /* Allow scroll only on mobile */
        body, html {
            overflow: auto !important;
        }

        /* Keep full screen but fix mobile viewport */
        .map-wrapper,
        .map-container {
            width: 100vw;
            height: 100vh;
            height: 100dvh;
        }

        /* KEEP cover so pins stay aligned */
        .background-map {
            object-fit: cover;
        }

        /* Show burger / hide back */
        .back-button {
            display: none;
        }

        .burger-menu {
            display: flex;
        }

        /* Smaller pins (safe size) */
        .pin {
            width: 70px;
            height: 95px;
        }

        /* Tooltip fix */
       .pin .tooltip {
            visibility: visible;
            position: absolute;
            bottom: 125px;
            left: 50%;
            transform: translateX(-50%);
            background: none;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            white-space: nowrap;
        }

        .pin .tooltip img {
            width: 250px;   /* ← change this for desktop */
            height: auto;
            display: block;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.4));
        }

        .pin:hover .tooltip img {
            transform: scale(1.05);  /* slight zoom on hover instead of color change */
        }

        /* KEEP ORIGINAL POSITIONS (important!) */
        .location-1 { top: 50%; left: 25%; }
        .location-2 { top: 53%; left: 50%; }
        .location-3 { top: 59%; left: 82%; }

        /* Disable zoom glitch on mobile */
        .map-container {
            transform: none !important;
        }

        /* Tap feedback */
        .pin:active {
            transform: translate(-50%, -100%) scale(1.15);
        }

        /* Lock icon */
        .lock-icon {
            bottom: 60px;
            font-size: 16px;
        }

        /* Notification */
        .locked-notification {
            font-size: 12px;
            padding: 8px 14px;
        }
    }

    /* For very small mobile devices (<=480px) */
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
        
        .pin {
            width: 50px;
            height: 65px;
        }
        
        .pin .tooltip {
            bottom: 55px;
            font-size: 9px;
            padding: 2px 6px;
            white-space: nowrap;
        }
        
        .pin:active {
            transform: translate(-50%, -100%) scale(1.15);
        }
        
        .location-1 { top: 47%; left: 20%; }
        .location-2 { top: 50%; left: 47%; }
        .location-3 { top: 56%; left: 82%; }
        
        .modal-content {
            padding: 14px;
            max-height: 85vh;
        }
        
        .modal-section {
            padding: 10px;
            margin-bottom: 10px;
        }
        
        .modal-section h3 {
            font-size: 0.85rem;
        }
        
        .modal-section p {
            font-size: 0.8rem;
            line-height: 1.45;
        }
        
        .modal-content .btn-primary {
            padding: 10px;
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

        .lock-icon {
            bottom: 45px;
            font-size: 14px;
            padding: 2px 6px;
        }
    }

    /* Landscape orientation on mobile */
    @media (max-width: 900px) and (orientation: landscape) {
        .pin {
            width: 55px;
            height: 75px;
        }
        
        .pin .tooltip {
            bottom: 60px;
            font-size: 10px;
            padding: 2px 7px;
        }
        
        .location-1 { top: 45%; left: 24%; }
        .location-2 { top: 48%; left: 49%; }
        .location-3 { top: 54%; left: 81%; }
        
        .modal-content {
            max-height: 85vh;
            overflow-y: auto;
            padding: 14px;
        }
        
        .modal-section {
            padding: 8px 12px;
            margin-bottom: 10px;
        }
        
        /* Ensure map still covers screen in landscape */
        .background-map {
            object-fit: cover;
        }

        .lock-icon {
            bottom: 50px;
            font-size: 14px;
        }
    }

    /* Touch-friendly improvements - no hover on mobile, use active state */
    @media (hover: none) and (pointer: coarse) {
        .pin:hover {
            transform: translate(-50%, -100%) scale(1);
        }
        
        .pin:active {
            transform: translate(-50%, -100%) scale(1.2);
        }
        
        .pin .tooltip {
            pointer-events: none;
        }
        
        .modal-content .btn-primary:active {
            transform: translateY(-1px);
        }
    }

    /* Prevent text scaling on orientation change */
    html {
        -webkit-text-size-adjust: 100%;
        text-size-adjust: 100%;
    }

    @media (max-width: 1024px) {
        .pin .tooltip img {
            width: 120px;
        }
    }

    @media (max-width: 768px) {
        .pin .tooltip img {
            width: 90px;
        }
    }

    @media (max-width: 480px) {
        .pin .tooltip img {
            width: 65px;
        }
    }

    @media (max-width: 900px) and (orientation: landscape) {
        .pin .tooltip img {
            width: 80px;
        }
    }

  /* ===== VISUAL NOVEL STYLE (MATCHED TO BG) ===== */

.vn-container {
    position: fixed;
    inset: 0;
    /* Updated to a deeper, thematic dark green overlay */
    background: radial-gradient(circle, rgba(13, 35, 13, 0.75) 0%, rgba(0, 0, 0, 0.9) 100%);
    z-index: 20000;
    display: flex;
    align-items: flex-end;
}

/* Teacher LEFT */
.vn-character {
    position: absolute;
    bottom: 0;
    left: 60px;
    height: 70vh;
    max-height: 520px;
    object-fit: contain;
    animation: fadeInVN 0.5s ease, teacherIdle 3s ease-in-out infinite;
}

/* Dialogue box - Matches the Forest/Map Theme */
.vn-dialogue-box {
    position: absolute;
    left: 44%;
    bottom: 340px;
    transform: translateX(-50%);

    width: min(760px, 78vw);
    max-width: 78vw;

    /* Matching your mobile-nav and forest theme colors */
    background: linear-gradient(180deg, rgba(27, 94, 32, 0.95), rgba(13, 59, 18, 0.98));
    padding: 26px 32px;
    border-radius: 18px;

    /* Subtle border instead of bright white */
    border: 2px solid rgba(143, 209, 143, 0.4);
    box-shadow: 0 20px 52px rgba(0,0,0,0.6), inset 0 0 20px rgba(255,255,255,0.05);

    cursor: pointer;
}

/* Tail pointing to teacher - Color matched to bottom of box */
.vn-dialogue-box::after {
    content: "";
    position: absolute;
    left: 40px; /* Adjusted to look better on desktop */
    bottom: -22px;
    width: 0;
    height: 0;
    border-left: 18px solid transparent;
    border-right: 18px solid transparent;
    border-top: 24px solid rgba(13, 59, 18, 0.98); 
}

/* Text styles */
.vn-name {
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    font-size: 14px;
    display: inline-block;
    padding: 6px 14px;
    border-radius: 8px;
    background: #2e7d32; /* Solid green for the name tag */
    box-shadow: 2px 2px 0px rgba(0,0,0,0.2);
}

.vn-text {
    font-size: 18px;
    line-height: 1.8;
    color: #f4f7fb;
    min-height: 2.4em;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

.vn-continue {
    margin-top: 14px;
    font-size: 12px;
    font-style: italic;
    opacity: 0.8;
    text-align: right;
    color: #8fd18f; /* Light green text for the prompt */
}

/* MOBILE FIXES */
@media (max-width: 768px) {
    .vn-dialogue-box {
        bottom: 132px;
        background: linear-gradient(180deg, rgba(124, 209, 129, 0.98), rgba(13, 59, 18, 1));
    }

    .vn-dialogue-box::after {
        left: 25px;
        border-top-color: rgb(124, 212, 139);
    }
    
    .vn-name {
        background: #96cf9a;
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
        <li><a href="{{ route('module.home') }}">📘 Kalagayan, Suliranin At Pagtugon Sa Isyung Pangkapaligiran Ng Pilipinas</a></li>
        <li><a href="#" onclick="return false;" style="opacity: 0.6; cursor: not-allowed;">📗 Module 3 <?php if(!$module3_unlocked): ?>🔒<?php endif; ?></a></li>
        <li><a href="#" onclick="return false;" style="opacity: 0.6; cursor: not-allowed;">📙 Module 4 <?php if(!$module4_unlocked): ?>🔒<?php endif; ?></a></li>
    </ul>
</div>

<!-- OVERLAY -->
<div class="nav-overlay" id="navOverlay" onclick="closeMobileNav()"></div>

<!-- VISUAL NOVEL INTRO -->
<div id="vnIntro" class="vn-container">
    <img src="{{ asset('pictures/teacher.png') }}" class="vn-character">

    <div class="vn-dialogue-box">
        <div class="vn-name">Guro JC</div>
        <div class="vn-text" id="vnText"></div>
        <div class="vn-continue">▶ I-click upang magpatuloy</div>
    </div>
</div>

<div class="map-wrapper">
    <div class="map-container" style="position: relative; display: inline-block;">
        <img src="{{ asset('pictures/main_map2.png') }}" class="background-map" alt="Main Map">

        <!-- MODULE 2 PIN (PAKSA 1) - Always Unlocked -->
        <button class="pin location-1" onclick="enterModule(this, '{{ route('module.home') }}')">
            <span class="tooltip">
                <img src="{{ asset('pictures/mod2titleimage.png') }}" alt="Paksa 1">
            </span>
        </button>

        <!-- MODULE 3 PIN (PAKSA 2) - Locked until Module 2 is completed -->
        <button class="pin location-2 <?php echo !$module3_unlocked ? 'locked-pin' : ''; ?>"
            onclick="<?php echo $module3_unlocked ? "enterModule(this, '" . route('module3.home') . "')" : "showLockedMessage('PAKSA 2')"; ?>"
            <?php echo !$module3_unlocked ? 'disabled style="cursor:not-allowed;"' : ''; ?>>
            <span class="tooltip">
                <img src="{{ asset('pictures/mod3titleimage.png') }}" alt="Paksa 2">
            </span>
            <?php if(!$module3_unlocked): ?>
                <span class="lock-icon">🔒</span>
            <?php endif; ?>
        </button>

        <!-- MODULE 4 PIN (PAKSA 3) - Locked until Module 3 is completed -->
        <button class="pin location-3 <?php echo !$module4_unlocked ? 'locked-pin' : ''; ?>"
            onclick="<?php echo $module4_unlocked ? "enterModule(this, '" . route('module4.home') . "')" : "showLockedMessage('PAKSA 3')"; ?>"
            <?php echo !$module4_unlocked ? 'disabled style="cursor:not-allowed;"' : ''; ?>>
            <span class="tooltip">
                <img src="{{ asset('pictures/mod4titleimage.png') }}" alt="Paksa 3">
            </span>
            <?php if(!$module4_unlocked): ?>
                <span class="lock-icon">🔒</span>
            <?php endif; ?>
        </button>

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

    function enterModule(pin, url) {
        if (window.innerWidth <= 768) {
            window.location.href = url;
            return;
        }

        const map = document.querySelector('.map-container');

        const rect = map.getBoundingClientRect();
        const pinRect = pin.getBoundingClientRect();

        const pinCenterX = pinRect.left + pinRect.width / 2;
        const pinCenterY = pinRect.top + pinRect.height / 2;

        const mapCenterX = rect.left + rect.width / 2;
        const mapCenterY = rect.top + rect.height / 2;

        const offsetX = mapCenterX - pinCenterX;
        const offsetY = mapCenterY - pinCenterY;

        map.style.transform = `
            translate(${offsetX}px, ${offsetY}px)
            scale(2)
        `;
        map.style.transition = 'transform 0.7s ease';

        pin.classList.add('active');

        setTimeout(() => {
            document.body.classList.add('screen-fade');
        }, 400);

        setTimeout(() => {
            window.location.href = url;
        }, 900);
    }

    // ===== VISUAL NOVEL FLOW =====
    const vnLines = [
        '🌋 Maligayang pagdating sa Albay!',
        'Ikaw ay papasok sa isang misyon kung saan tutuklasin mo ang mga suliraning pangkapaligiran.',
        'Matututuhan mo rin kung paano makakatulong bilang isang responsableng mamamayan.',
        '🧭 Ang iyong gawain ay galugarin ang mapa ng Albay.',
        'Tuklasin ang bawat lokasyon at alamin ang mga isyung kinakaharap ng kapaligiran.',
        'Sa bawat hakbang, ikaw ay matututo at makakagawa ng tamang desisyon.',
        '🎯 Ang iyong layunin ay unawain ang kalagayan ng kapaligiran.',
        'Mag-isip ng mga paraan upang makatulong sa pangangalaga ng kalikasan.',
        'Handa ka na ba? Simulan na natin ang iyong paglalakbay.'
    ];

    const vnText = document.getElementById('vnText');
    const vnContainer = document.getElementById('vnIntro');

    let vnIndex = 0;
    let isTyping = false;
    let typingTimeout = null;

    function typeWriter(text, element, speed = 25) {
        let i = 0;
        element.innerHTML = '';
        isTyping = true;

        if (typingTimeout) clearTimeout(typingTimeout);

        function typing() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                typingTimeout = setTimeout(typing, speed);
            } else {
                isTyping = false;
                typingTimeout = null;
            }
        }

        typing();
    }

    typeWriter(vnLines[vnIndex], vnText);

    vnContainer.addEventListener('click', () => {
        if (isTyping) {
            if (typingTimeout) clearTimeout(typingTimeout);
            vnText.innerHTML = vnLines[vnIndex];
            isTyping = false;
            return;
        }

        vnIndex++;

        if (vnIndex < vnLines.length) {
            typeWriter(vnLines[vnIndex], vnText);

            const box = document.querySelector('.vn-dialogue-box');
            box.classList.remove('pop');
            void box.offsetWidth;
            box.classList.add('pop');
        } else {
            vnContainer.style.opacity = '0';
            vnContainer.style.transition = 'opacity 0.5s';

            setTimeout(() => {
                vnContainer.style.display = 'none';
            }, 500);
        }
    });

    // Show message when clicking on locked module
    function showLockedMessage(moduleName) {
        const notification = document.createElement('div');
        notification.className = 'locked-notification';
        notification.innerHTML = `🔒 Naka-lock pa ang ${moduleName}. Kumpletuhin muna ang nakaraang paksa.`;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    document.querySelector('.map-wrapper').addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        console.log(`top: ${y.toFixed(2)}%; left: ${x.toFixed(2)}%;`);
    });
</script>
@endsection