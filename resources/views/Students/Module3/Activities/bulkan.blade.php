@extends('Students.studentslayout')
@section('title', 'Module 3 : Bulkan Activity')

@push('styles')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=yes">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
    
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lexend:wght@300;600;900&display=swap");
        :root {
            /* Lighter Wooden Palette - Matching Safe Home & Lindol */
            --wood-dark: #5c3d2e;
            --wood-medium: #8b6b4f;
            --wood-light: #d2b48c;
            --wood-bg: #d4b896;
            --wood-panel: #c4a484;
            --lava: #ff4500;
            --accent: #f1c40f;
            --safe: #2ecc71;
            --parchment: #fcfaf7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Desktop styles - keep original */
        html, body {
            scroll-behavior: smooth;
            background:
                linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        body {
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Center the game wrapper - only affects game content */
        .game-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100% - 80px);
        }

        /* Main content area - centered */
        #game-layout {
            display: flex;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            gap: 20px;
            flex: 1;
            min-height: 0;
        }

        /* --- 1. TRAINING MODAL --- */
        #instruction-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 3000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content-custom {
            background: var(--wood-panel);
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border: 6px solid var(--wood-dark);
            box-shadow: 0 0 30px rgba(0, 0, 0, 1);
            width: 100%;
            max-width: 700px;
            padding: 30px;
            text-align: center;
            border-radius: 15px;
        }

        .modal-content-custom .status-header {
            color: var(--wood-dark);
            text-shadow: 0 1px 2px rgba(255,255,255,0.2);
        }

        .video-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .video-section iframe {
            width: 100%;
            max-width: 300px;
            height: 180px;
            border-radius: 8px;
            border: 3px solid var(--wood-dark);
            flex: 1;
            min-width: 250px;
        }

        .btn-ready {
            background: var(--accent);
            border: none;
            color: #000;
            font-weight: 900;
            letter-spacing: 2px;
            padding: 15px 30px;
            width: 100%;
            transition: 0.3s;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-ready:hover {
            background: #f39c12;
            transform: scale(1.02);
        }

        /* --- LEFT PANEL: UI MODULE --- */
        #ui-module {
            flex: 1;
            background: var(--wood-panel);
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border-radius: 20px;
            border-left: 8px solid var(--accent);
            padding: 25px;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);
            min-width: 280px;
            overflow-y: auto;
            max-height: 85vh;
        }

        .status-header {
            font-size: 0.8rem;
            letter-spacing: 4px;
            color: var(--wood-dark);
            font-weight: 900;
            margin-bottom: 15px;
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(255,255,255,0.2);
        }

        #scenario-text {
            background: var(--parchment);
            background-image: url('https://www.transparenttextures.com/patterns/handmade-paper.png');
            color: var(--wood-dark);
            padding: 20px;
            border-radius: 10px;
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 20px;
            min-height: 140px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
            border: 2px solid var(--wood-medium);
        }

        .choices-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex-grow: 1;
        }

        .stone-btn {
            background: var(--wood-dark);
            border: 1px solid var(--wood-medium);
            border-bottom: 5px solid #3d281a;
            border-radius: 12px;
            padding: 18px 20px;
            cursor: pointer;
            transition: 0.2s;
            color: #fff;
            font-weight: 600;
            text-align: left;
        }

        .stone-btn:hover {
            background: var(--wood-medium);
            border-color: var(--accent);
            transform: translateX(5px);
        }

        /* --- RIGHT PANEL: SIMULATION --- */
        #simulation-module {
            flex: 1.5;
            background: rgba(43, 29, 18, 0.85);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 8px solid var(--wood-dark);
            min-width: 350px;
            height: 75vh;
            min-height: 500px;
        }

        #world {
            width: 100%;
            height: 100%;
            position: relative;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: visible;
        }

        .green-ground {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 15%;
            background: #1b5e20;
            border-top: 8px solid var(--safe);
            z-index: 10;
        }

        #lava-layer {
            position: absolute;
            bottom: -2200px;
            width: 100%;
            height: 2000px;
            background: linear-gradient(0deg, #600, #d35400, #ff4500);
            z-index: 15;
            box-shadow: 0 -40px 100px var(--lava);
        }

        .stone-ledge {
            position: absolute;
            width: 180px;
            height: 50px;
            background: var(--wood-medium);
            border-top: 8px solid var(--wood-light);
            border-radius: 10px;
            z-index: 12;
            transform: translateX(-50%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
        }

        #safe-place {
            position: absolute;
            width: 280px;
            height: 180px;
            background: var(--wood-panel);
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border: 4px solid var(--accent);
            border-bottom: none;
            border-radius: 50px 50px 0 0;
            z-index: 11;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding-bottom: 30px;
            box-shadow: 0 0 50px rgba(241, 196, 15, 0.3);
        }

        #safe-place .status-header {
            color: var(--safe);
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        .safe-door {
            width: 80px;
            height: 110px;
            background: var(--wood-dark);
            border: 2px solid var(--accent);
            border-radius: 10px 10px 0 0;
            transition: 1s ease;
            position: relative;
            overflow: hidden;
        }

        .safe-door.open {
            background: var(--accent);
            box-shadow: 0 0 30px var(--accent);
        }

        #hero {
            position: absolute;
            width: 100px;
            z-index: 100;
            transform: translateX(-50%);
            transition: bottom 0.6s ease-out, left 0.6s ease-out, opacity 0.5s;
            bottom: 15%;
            left: 50%;
        }

        #hero img {
            width: 100%;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        /* --- MISSION DEPLOYMENT CARD --- */
        #mission-deployment-card {
            position: absolute;
            inset: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            border-radius: 20px;
        }

        #mission-deployment-card .text-center {
            background: var(--wood-panel);
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border: 4px solid var(--accent);
        }

        #mission-deployment-card h2 {
            color: var(--wood-dark);
        }

        /* --- VICTORY GIFT --- */
        #victory-bag-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 5000;
            background: var(--wood-panel);
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            padding: 40px;
            border-radius: 30px;
            border: 5px solid var(--accent);
            text-align: center;
            transition: 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
            opacity: 0;
            max-width: 90%;
            width: 400px;
        }

        #victory-bag-container.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        .gift-item-img {
            width: 150px;
            filter: drop-shadow(0 0 20px var(--accent));
            margin-bottom: 20px;
        }

        /* --- GAME OVER OVERLAY --- */
        .game-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 30px;
            z-index: 2000;
            border-radius: 20px;
        }

        .game-overlay.show {
            display: flex;
        }

        .next-btn {
            background: var(--safe);
            color: #000;
            border: none;
            padding: 15px 30px;
            font-weight: 900;
            border-radius: 12px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .next-btn:hover {
            background: #27ae60;
            color: #fff;
        }

        /* --- PROGRESS BAR --- */
        .progress-custom {
            height: 8px;
            background: var(--wood-dark);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--wood-medium);
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            background: var(--accent);
            transition: 0.4s;
        }

        #prog-txt {
            color: var(--wood-dark) !important;
            font-weight: 900;
        }

        /* ========== MOBILE RESPONSIVE - 40% LEFT, 60% RIGHT ========== */
        
        /* Tablets */
        @media (max-width: 1024px) {
            .game-wrapper {
                padding: 0 15px;
                height: calc(100% - 70px);
            }
            #game-layout {
                gap: 15px;
            }
            .stone-ledge {
                width: 140px;
                height: 45px;
            }
            #safe-place {
                width: 220px;
                height: 150px;
            }
            .safe-door {
                width: 65px;
                height: 90px;
            }
            #hero {
                width: 80px;
            }
            #ui-module {
                max-height: 80vh;
                padding: 20px;
            }
            #simulation-module {
                min-height: 450px;
                height: 70vh;
            }
        }
        
        /* Mobile phones - 40% LEFT, 60% RIGHT */
        @media (max-width: 768px) {
            /* Fix body/html for mobile scrolling */
            html, body {
                height: auto;
                overflow-y: auto;
                overflow-x: hidden;
            }
            
            .game-wrapper {
                padding: 0 8px;
                height: auto;
                min-height: 100vh;
                display: block;
                margin-top: 10px;
                margin-bottom: 20px;
            }
            
            /* Keep horizontal layout with 40/60 ratio */
            #game-layout {
                display: flex;
                flex-direction: row;
                gap: 8px;
                margin: 0;
                min-height: 85vh;
                align-items: stretch;
            }
            
            /* Left panel - 40% width */
            #ui-module {
                flex: 0.66;
                min-width: 130px;
                padding: 8px;
                max-height: none;
                height: auto;
                display: flex;
                flex-direction: column;
            }
            
            /* Right panel - 60% width */
            #simulation-module {
                flex: 1;
                min-width: 200px;
                height: auto;
                min-height: auto;
                max-height: none;
                position: relative;
                border-width: 5px;
            }
            
            /* Make world container take full height */
            #world {
                height: 100%;
                min-height: 550px;
            }
            
            /* Make ledges VISIBLE and properly sized */
            .stone-ledge {
                width: 110px;
                height: 42px;
                border-top-width: 5px;
                border-radius: 8px;
            }
            
            /* Make safe place visible */
            #safe-place {
                width: 150px;
                height: 115px;
                padding-bottom: 10px;
            }
            
            .safe-door {
                width: 48px;
                height: 65px;
            }
            
            /* Make hero character visible */
            #hero {
                width: 65px;
            }
            
            /* LEFT PANEL TEXT - SMALLER FONTS */
            .status-header {
                font-size: 0.45rem !important;
                letter-spacing: 1.5px;
                margin-bottom: 6px;
            }
            
            #scenario-text {
                padding: 6px;
                font-size: 0.55rem !important;
                min-height: auto;
                margin-bottom: 8px;
                line-height: 1.3;
            }
            
            #scenario-text h5 {
                font-size: 0.6rem !important;
                margin-bottom: 4px !important;
            }
            
            #scenario-text ul {
                font-size: 0.5rem !important;
                margin-bottom: 0;
                padding-left: 10px;
            }
            
            #scenario-text li {
                font-size: 0.5rem !important;
            }
            
            .stone-btn {
                padding: 5px 7px;
                font-size: 0.5rem !important;
                border-bottom-width: 2px;
                border-radius: 6px;
            }
            
            .choices-container {
                gap: 5px;
            }
            
            /* Progress bar text smaller */
            .mt-auto.pt-3 {
                margin-top: 8px;
            }
            
            .mt-auto.pt-3 small {
                font-size: 0.45rem !important;
            }
            
            .progress-custom {
                height: 4px;
            }
            
            /* Adjust lava layer for mobile */
            #lava-layer {
                bottom: -2200px;
                height: 1800px;
            }
            
            /* Modal videos - smaller */
            .video-section iframe {
                height: 100px;
                min-width: 130px;
            }
            
            .modal-content-custom {
                padding: 12px;
                margin: 10px;
            }
            
            .modal-content-custom .status-header {
                font-size: 0.55rem !important;
            }
            
            .btn-ready {
                padding: 8px 12px;
                font-size: 0.65rem;
            }
            
            /* Mission start card - smaller */
            #mission-deployment-card .text-center {
                margin: 8px;
                padding: 12px !important;
            }
            
            #mission-deployment-card h2 {
                font-size: 0.85rem;
                margin-bottom: 6px !important;
            }
            
            #mission-deployment-card button {
                padding: 6px 12px !important;
                font-size: 0.65rem;
            }
            
            /* Victory gift - smaller */
            .gift-item-img {
                width: 60px;
            }
            
            #victory-bag-container {
                padding: 12px;
                width: 85%;
            }
            
            #victory-bag-container h2 {
                font-size: 0.9rem;
            }
            
            #victory-bag-container p {
                font-size: 0.6rem;
            }
            
            #victory-bag-container button {
                font-size: 0.7rem;
                padding: 6px;
            }
            
            /* Game over overlay - smaller */
            .game-overlay {
                padding: 12px;
            }
            
            .game-overlay h1 {
                font-size: 0.85rem;
                margin-bottom: 8px !important;
            }
            
            .game-overlay p {
                font-size: 0.6rem;
                margin-bottom: 10px !important;
            }
            
            .next-btn, #retryBtn {
                padding: 6px 12px;
                font-size: 0.65rem;
            }
        }
        
        /* Small phones - maintain 40/60 ratio */
        @media (max-width: 600px) {
            .game-wrapper {
                padding: 0 6px;
            }
            
            #game-layout {
                gap: 6px;
                min-height: 80vh;
            }
            
            /* Left panel - 40% */
            #ui-module {
                flex: 0.66;
                min-width: 110px;
                padding: 6px;
            }
            
            /* Right panel - 60% */
            #simulation-module {
                flex: 1;
                min-width: 170px;
            }
            
            #world {
                min-height: 500px;
            }
            
            .stone-ledge {
                width: 95px;
                height: 38px;
            }
            
            #safe-place {
                width: 130px;
                height: 100px;
            }
            
            .safe-door {
                width: 40px;
                height: 55px;
            }
            
            #hero {
                width: 55px;
            }
            
            /* Even smaller text */
            .status-header {
                font-size: 0.4rem !important;
                letter-spacing: 1px;
            }
            
            #scenario-text {
                padding: 5px;
                font-size: 0.5rem !important;
            }
            
            #scenario-text h5 {
                font-size: 0.55rem !important;
            }
            
            .stone-btn {
                padding: 4px 6px;
                font-size: 0.45rem !important;
            }
        }
        
        /* Very small phones - maintain 40/60 ratio */
        @media (max-width: 480px) {
            #ui-module {
                flex: 0.66;
                min-width: 100px;
            }
            
            #simulation-module {
                flex: 1;
                min-width: 155px;
            }
            
            .stone-ledge {
                width: 85px;
                height: 35px;
            }
            
            #safe-place {
                width: 115px;
                height: 90px;
            }
            
            .safe-door {
                width: 35px;
                height: 48px;
            }
            
            #hero {
                width: 48px;
            }
        }
        
        /* Landscape mode on mobile */
        @media (max-width: 900px) and (orientation: landscape) {
            html, body {
                height: 100%;
                overflow: hidden;
            }
            
            .game-wrapper {
                height: 100%;
                display: flex;
                align-items: center;
                margin-top: 0;
            }
            
            #game-layout {
                height: 85vh;
                min-height: 400px;
            }
            
            #ui-module {
                flex: 0.66;
                min-width: 180px;
                max-height: 85vh;
            }
            
            #simulation-module {
                flex: 1;
                min-width: 240px;
            }
            
            #world {
                min-height: 400px;
            }
            
            .stone-ledge {
                width: 100px;
                height: 40px;
            }
            
            #hero {
                width: 60px;
            }
            
            #safe-place {
                width: 140px;
                height: 105px;
            }
            
            .safe-door {
                width: 42px;
                height: 58px;
            }
            
            .status-header {
                font-size: 0.5rem !important;
            }
            
            #scenario-text {
                font-size: 0.6rem !important;
            }
            
            .stone-btn {
                font-size: 0.55rem !important;
            }
            
            .video-section iframe {
                height: 90px;
            }
        }
        
        /* Touch-friendly tap targets */
        @media (max-width: 768px) {
            .stone-btn,
            .btn-ready,
            .btn-warning,
            .next-btn {
                cursor: pointer;
                -webkit-tap-highlight-color: transparent;
            }
            
            .stone-btn:active {
                transform: scale(0.97);
                background: var(--wood-medium);
            }
        }
        
        /* Scrollbar styling */
        #ui-module::-webkit-scrollbar {
            width: 3px;
        }
        
        #ui-module::-webkit-scrollbar-track {
            background: var(--wood-dark);
            border-radius: 10px;
        }
        
        #ui-module::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="game-wrapper">
        <div id="victory-bag-container">
            <div class="status-header">GANTIMPALA: LIGTAS-KIT</div>
            <img src="https://img.icons8.com/fluency/240/backpack.png" class="gift-item-img" alt="Backpack">
            <h2 style="color: var(--wood-dark); font-weight: 900;">Emergency Go-Bag</h2>
            <p class="text-secondary small">Nakuha mo ang mahahalagang gamit <br> para sa paglikas sa pagsabog!</p>
            <button class="btn btn-warning mt-3 fw-bold w-100" onclick="closeGift()">IPAGPATULOY</button>
        </div>

        <div id="instruction-modal">
            <div class="modal-content-custom">
                <div class="status-header">PAGSASANAY NG MGA SIBILYAN</div>
                <div class="video-section">
                    <iframe src="https://www.youtube.com/embed/Hg1ktHeXaPU" allowfullscreen title="Volcano Safety Video 1"></iframe>
                    <iframe src="https://www.youtube.com/embed/UFz2fLrqZuk" allowfullscreen title="Volcano Safety Video 2"></iframe>
                </div>
                <button class="btn-ready" onclick="proceedToDashboard()">MAGSIMULA SA PAGSASANAY</button>
            </div>
        </div>

        <div id="game-layout">
            <div id="ui-module">
                <div class="status-header" id="cmd-status">STANDBY</div>
                <div id="scenario-text">
                    <h5 class="fw-bold mb-3" style="color: var(--wood-dark);">MGA PROTOKOL SA PAGLIGTAS:</h5>
                    <ul class="list-unstyled small" style="color: var(--wood-dark);">
                        <li>• Sagutin ang 10 kritikal na tanong.</li>
                        <li>• Bawat tamang sagot ay magpapaakyat sa iyo.</li>
                        <li>• Mag-ingat sa tumataas na lava.</li>
                    </ul>
                </div>
                <div class="choices-container" id="selection-dock"></div>

                <div class="mt-auto pt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <small style="color: var(--wood-dark); opacity:0.7; font-size:0.65rem;">PROGRESO</small>
                        <small id="prog-txt" style="color: var(--accent); font-weight:900;">0/10</small>
                    </div>
                    <div class="progress-custom">
                        <div id="prog-bar" class="progress-fill"></div>
                    </div>
                </div>
            </div>

            <div id="simulation-module">
                <div id="mission-deployment-card">
                    <div class="text-center p-4 p-md-5 border rounded-4 m-3">
                        <h2 class="fw-black mb-3">HANDA NA?</h2>
                        <button class="btn btn-warning px-4 px-md-5 py-3 fw-bold" onclick="startMission()">SIMULAN ANG PAG-AKYAT</button>
                    </div>
                </div>

                <div id="world">
                    <div id="lava-layer"></div>
                    <div class="green-ground"></div>
                    <div id="ledge-layer"></div>

                    <div id="safe-place" style="display:none;">
                        <div class="status-header text-success mb-2">LIGTAS NA LUGAR</div>
                        <div class="safe-door" id="door"></div>
                    </div>

                    <div id="hero">
                        <img src="/pictures/jumpingfrombulkan.png" alt="Hero Character">
                    </div>
                </div>

                <div id="end-overlay" class="game-overlay">
                    <h1 id="end-title" class="fw-bold mb-4"></h1>
                    <p id="end-desc" class="mb-4 text-secondary"></p>
                    <div class="d-flex flex-column gap-3 w-100 align-items-center">
                        <button id="retryBtn" class="btn btn-outline-warning btn-lg px-5" onclick="location.reload()">ULITIN</button>
                        <a href="{{ route('flood.activity') }}" id="nextPageBtn" class="next-btn" style="display:none;">
                            SUSUNOD NA ARALIN (PAGBAHA)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let drrmProtocols = [
            { q: "Ano ang dapat gawin bago ang pagsabog ng bulkan?", a1: "Maghanda ng emergency kit at plano ng paglikas", a2: "Hintayin na lang ang abiso ng kapitbahay", ok: 1 },
            { q: "Bakit mahalagang makinig sa balita at abiso ng PHIVOLCS bago ang pagsabog?", a1: "Para malaman ang tamang oras ng paglikas", a2: "Para makapag-post agad sa social media", ok: 1 },
            { q: "Ano ang dapat gawin sa mga alagang hayop bago lumikas?", a1: "Isama o ilipat sa ligtas na lugar", a2: "Iwanan na lang sa bahay", ok: 1 },
            { q: "Ano ang dapat isuot kapag may ashfall?", a1: "Mask at takip sa mata", a2: "T-shirt lang at shorts", ok: 1 },
            { q: "Ano ang dapat gawin kung nasa loob ng bahay habang sumasabog ang bulkan?", a1: "Isara ang mga bintana at pinto", a2: "Buksan lahat ng bintana para pumasok ang hangin", ok: 1 },
            { q: "Kung kailangang lumikas, ano ang unang dapat gawin?", a1: "Sundin ang evacuation order ng LGU", a2: "Hintayin munang makita ang lava", ok: 1 },
            { q: "Ano ang dapat iwasan habang naglalakad sa labas sa gitna ng pagsabog?", a1: "Iwasan ang ilog at mababang lugar", a2: "Dumaan sa gilid ng bulkan", ok: 1 },
            { q: "Ano ang dapat gawin pagkatapos ng pagsabog bago bumalik sa bahay?", a1: "Hintayin ang abiso ng awtoridad na ligtas na bumalik", a2: "Bumalik agad para tingnan ang bahay", ok: 1 },
            { q: "Paano dapat linisin ang abo sa paligid pagkatapos ng pagsabog?", a1: "Basaing mabuti bago walisin", a2: "Walisin agad kahit tuyo", ok: 1 },
            { q: "Ano ang dapat gawin kung may nasaktan o may sugat pagkatapos ng pagsabog?", a1: "Humingi ng tulong sa health center o awtoridad", a2: "Hayaan na lang, gagaling din", ok: 1 }
        ];

        let currentStep = 0, lavaY = -2200, jumping = false, active = false;
        const gap = 380;

        function proceedToDashboard() {
            // Shuffle questions
            for (let i = drrmProtocols.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [drrmProtocols[i], drrmProtocols[j]] = [drrmProtocols[j], drrmProtocols[i]];
            }
            document.getElementById('instruction-modal').style.display = 'none';
            document.getElementById('mission-deployment-card').style.display = 'flex';
            initLedges();
        }

        function startMission() {
            document.getElementById('mission-deployment-card').style.display = 'none';
            document.getElementById('cmd-status').innerText = "AKTIBO";
            active = true;
            render();
            lavaCycle();
        }

        function initLedges() {
            const layer = document.getElementById('ledge-layer');
            layer.innerHTML = '';
            for (let i = 0; i < 10; i++) {
                const ledge = document.createElement('div');
                ledge.className = 'stone-ledge';
                const x = (i % 2 === 0) ? "25%" : "75%";
                const y = 400 + (i * gap);
                ledge.style.left = x;
                ledge.style.bottom = y + "px";
                layer.appendChild(ledge);
            }
            const safe = document.getElementById('safe-place');
            safe.style.display = 'flex';
            safe.style.left = '50%';
            safe.style.bottom = (400 + (10 * gap)) + "px";
        }

        function render() {
            if (currentStep >= 10) return;
            const data = drrmProtocols[currentStep];
            let choices = [{ text: data.a1, id: 1 }, { text: data.a2, id: 2 }];
            if (Math.random() > 0.5) { choices.reverse(); }

            document.getElementById('scenario-text').innerHTML = `
                <strong style="color: var(--wood-dark);">TANONG ${currentStep + 1}:</strong>
                <p class="mt-2 mb-0" style="color: var(--wood-dark);">${escapeHtml(data.q)}</p>
            `;
            document.getElementById('prog-bar').style.width = (currentStep / 10 * 100) + "%";
            document.getElementById('prog-txt').innerText = `${currentStep}/10`;

            document.getElementById('selection-dock').innerHTML = `
                <div class="stone-btn mb-2" onclick="handle(${choices[0].id})">${escapeHtml(choices[0].text)}</div>
                <div class="stone-btn" onclick="handle(${choices[1].id})">${escapeHtml(choices[1].text)}</div>
            `;
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        function handle(choiceId) {
            if (!active || jumping) return;
            if (choiceId === drrmProtocols[currentStep].ok) {
                moveHero();
            } else {
                lavaY += 300;
            }
        }

        function moveHero() {
            jumping = true;
            const hero = document.getElementById('hero');
            const ledges = document.querySelectorAll('.stone-ledge');
            const currentLedge = ledges[currentStep];
            hero.style.left = currentLedge.style.left;
            hero.style.bottom = (parseInt(currentLedge.style.bottom) + 40) + "px";

            setTimeout(() => {
                currentStep++;
                document.getElementById('world').style.transform = `translateY(${(currentStep * gap)}px)`;
                if (currentStep < 10) {
                    render();
                    jumping = false;
                } else {
                    document.getElementById('prog-bar').style.width = "100%";
                    document.getElementById('prog-txt').innerText = `10/10`;
                    document.getElementById('scenario-text').innerHTML = `<h5 class='text-success' style="color: var(--safe) !important;">Ligtas ka na! Tumalon na sa Safe Zone!</h5>`;
                    document.getElementById('selection-dock').innerHTML = `<button class='btn btn-success w-100 py-3 fw-bold' onclick='finalLeap()'>TUMALON NA SA LIGTAS NA LUGAR</button>`;
                    jumping = false;
                }
            }, 600);
        }

        function finalLeap() {
            if (jumping) return;
            jumping = true;
            const hero = document.getElementById('hero');
            const safePlace = document.getElementById('safe-place');
            hero.style.left = "50%";
            hero.style.bottom = (parseInt(safePlace.style.bottom) + 20) + "px";
            setTimeout(() => { runSafeAnimation(); }, 600);
        }

        function runSafeAnimation() {
            active = false;
            const door = document.getElementById('door');
            const hero = document.getElementById('hero');
            setTimeout(() => {
                door.classList.add('open');
                setTimeout(() => {
                    hero.style.opacity = "0";
                    setTimeout(() => { showVictoryGift(); }, 1000);
                }, 800);
            }, 500);
        }

        function lavaCycle() {
            if (!active) return;
            lavaY += 0.8;
            const lavaElement = document.getElementById('lava-layer');
            lavaElement.style.bottom = lavaY + "px";
            const hero = document.getElementById('hero');
            const heroRect = hero.getBoundingClientRect();
            const lavaRect = lavaElement.getBoundingClientRect();
            if (lavaRect.top <= heroRect.bottom - 10) {
                finish(false);
            } else {
                requestAnimationFrame(lavaCycle);
            }
        }

        function showVictoryGift() {
            document.getElementById('victory-bag-container').classList.add('active');
        }

        function closeGift() {
            document.getElementById('victory-bag-container').classList.remove('active');
            setTimeout(() => finish(true), 500);
        }

        function saveBulkanResult(isWin) {
            fetch("{{ route('student.module3.bulkan.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    progress: currentStep,
                    is_success: isWin,
                    mistakes: (10 - currentStep)
                })
            })
            .then(res => res.json())
            .then(data => console.log("Saved:", data))
            .catch(err => console.error(err));
        }

        function finish(win) {
            saveBulkanResult(win);

            const screen = document.getElementById('end-overlay');
            const nextBtn = document.getElementById('nextPageBtn');
            screen.classList.add('show');
            
            const title = document.getElementById('end-title');
            title.innerText = win ? "MISYON: TAGUMPAY" : "MISYON: BIGO";
            title.style.color = win ? "var(--safe)" : "var(--lava)";

            document.getElementById('end-desc').innerText = win ?
                "Ligtas ka na! Mahusay mong nailigtas ang iyong sarili." :
                "Nalamon ka ng lava. Mag-aral muli ng mga safety protocols.";

            nextBtn.style.display = win ? 'inline-block' : 'none';
        }
    </script>
@endsection