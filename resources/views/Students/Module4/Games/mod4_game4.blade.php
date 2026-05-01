@extends('Students.studentslayout')
@section('title', 'Drag & Drop Activity - Pagputok ng Bulkang Mayon')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background:
                linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
                url("{{ asset('pictures/mod4_innermap.png') }}") center center / cover no-repeat fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background Map Container */
        .background-map-container {
            display: none;
        }

        .background-map {
            display: none;
        }

        /* Main Content Wrapper */
        .content-wrapper {
            position: relative;
            z-index: 1;
            padding: 25px 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .game-container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.9),
                inset 0 0 50px rgba(0, 0, 0, 0.2);
            padding: 30px 30px 40px;
            border: 2px solid var(--gold-trim);
            position: relative;
        }

        h1 {
            font-weight: 800;
            font-size: 2rem;
            color: var(--ink);
            margin-bottom: 6px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 2px solid var(--ink);
            padding-bottom: 10px;
        }
        h1 i {
            color: var(--danger);
            margin-right: 12px;
        }
        
        .subhead {
            color: var(--ink);
            font-size: 1rem;
            border-left: 5px solid var(--gold-trim);
            padding-left: 18px;
            margin: 10px 0 25px;
        }

        /* Items Pool - Moving to top */
        .items-pool {
            margin: 0 0 25px 0;
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px 24px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: 
                inset 0 0 30px rgba(0, 0, 0, 0.15),
                0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        .pool-title {
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
        }
        
        .waiting-card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 280px;
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 30px;
            transition: all 0.2s;
            border: 1px solid #aaa;
            box-shadow: 
                inset 0 0 20px rgba(0, 0, 0, 0.1),
                2px 6px 12px rgba(0, 0, 0, 0.3);
        }
        
        .empty-waiting-message {
            text-align: center;
            color: var(--ink);
            font-size: 1.2rem;
            font-weight: 500;
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            padding: 40px 20px;
            border-radius: 5px;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }
        
        .remaining-count {
            font-size: 0.9rem;
            background: var(--vintage-leather);
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            margin-left: 12px;
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
        }

        /* Category Headers with Images */
        .category-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin: 10px 0 20px;
        }
        
        .cat-col {
            color: var(--gold-trim);
            padding: 20px 15px;
            border-radius: 3px;
            text-align: center;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 0 rgba(0,0,0,0.2);
            transition: transform 0.2s;
            font-family: 'Nunito', sans-serif;
            border: 1px solid var(--gold-trim);
        }
        
        .cat-col.sanhi-cat { 
            background: #3d2a25;
            box-shadow: 0 6px 0 #2b1b17;
        }
        .cat-col.epekto-cat { 
            background: #4a3530;
            box-shadow: 0 6px 0 #3d2a25;
        }
        .cat-col.tugon-cat { 
            background: #2b1b17;
            box-shadow: 0 6px 0 #1a0f0c;
        }
        
        .cat-icon {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 10px;
        }
        
        .cat-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            display: block;
            margin: 0 auto 10px auto;
            filter: brightness(0) invert(1);
        }
        
        .cat-label {
            font-size: 1.4rem;
            letter-spacing: 2px;
        }
        
        .cat-sub {
            font-size: 0.8rem;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: normal;
        }

        /* Drop Zones Row */
        .dropzones-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            min-height: 450px;
            margin-bottom: 20px;
        }
        
        .dropzone {
            background: rgba(244, 228, 199, 0.95);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px 15px;
            border: 3px dashed #8b6b3f;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-height: 400px;
        }
        
        .dropzone.drag-over {
            background: rgba(217, 197, 163, 0.95);
            border-color: var(--gold-trim);
            border-style: solid;
        }
        
        .dropzone-header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
        }
        
        /* Statement Cards - No side highlight */
        .statement-card {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px 20px 16px;
            box-shadow: 2px 6px 12px rgba(0, 0, 0, 0.3);
            font-weight: 500;
            cursor: grab;
            user-select: none;
            transition: all 0.2s ease;
            border: 1px solid #aaa;
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--ink);
        }
        
        .statement-card:active {
            cursor: grabbing;
        }
        
        .statement-card.dragging {
            opacity: 0.3;
            cursor: grabbing;
        }
        
        .statement-card.placed {
            cursor: default;
            opacity: 0.95;
        }
        
        /* Shake Animation for wrong drop */
        @keyframes shakeCard {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            50% { transform: translateX(8px); }
            75% { transform: translateX(-4px); }
            100% { transform: translateX(0); }
        }
        
        .statement-card.shake {
            animation: shakeCard 0.4s ease-in-out;
        }
        
        /* Header image style */
        .card-header-image {
            text-align: center;
            margin-bottom: 14px;
        }
        
        .card-header-image img {
            width: 55px;
            height: 55px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        
        .card-text-content {
            font-weight: 500;
            line-height: 1.5;
            margin-bottom: 12px;
        }
        
        .card-footer-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid rgba(0, 0, 0, 0.2);
            font-size: 0.8rem;
            color: #5D4037;
        }
        
        .card-footer-badge img {
            width: 22px;
            height: 22px;
            object-fit: contain;
        }

        /* Loading indicator */
        .loading-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #d9c5a3;
            border-top-color: var(--gold-trim);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-left: 10px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 8, 7, 0.9);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-container {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            max-width: 700px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            border: 2px solid var(--gold-trim);
        }
        
        .modal-overlay.show .modal-container {
            transform: scale(1);
        }
        
        .modal-header {
            background: var(--vintage-leather);
            padding: 24px 32px;
            border-radius: 3px 3px 0 0;
            color: var(--gold-trim);
            border-bottom: 1px solid var(--gold-trim);
        }
        
        .modal-header h2 {
            margin: 0;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Nunito', sans-serif;
        }
        
        .modal-body {
            padding: 32px;
        }
        
        .modal-body p {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--ink);
            margin-bottom: 20px;
        }
        
        .modal-footer {
            padding: 20px 32px 32px;
            display: flex;
            justify-content: flex-end;
        }
        
        .modal-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 14px 32px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .modal-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Reset Button */
        .reset-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 28px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .reset-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }

        /* Game Controls Bar */
        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background: var(--vintage-leather);
            padding: 10px 18px;
            border-radius: 3px;
            text-decoration: none;
            color: var(--gold-trim);
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
            border: 1px solid var(--gold-trim);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .dropzones-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .category-header {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .game-container {
                padding: 20px 15px;
            }
            .cat-col {
                padding: 12px;
            }
            .statement-card {
                padding: 16px;
            }
            .card-header-image img {
                width: 45px;
                height: 45px;
            }
            .modal-body {
                padding: 20px;
            }
        }
        
        /* Completion Message */
        .completion-badge {
            background: #d9c5a3;
            color: var(--ink);
            padding: 8px 20px;
            border-radius: 3px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #8b6b3f;
            font-family: 'Nunito', sans-serif;
        }
    </style>
@endpush

@section('content')
    <!-- Background Map -->
    <div class="background-map-container">
        <img src="{{ asset('pictures/mod4_innermap.png') }}" class="background-map" alt="Module 4 Inner Map">
    </div>

    <a href="{{ route('module4.node4') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; margin-bottom: 5px;">
                <div>
                    <h1><i class="fas fa-mountain"></i>Sanhi, Epekto, at Mga Tugon</h1>
                    <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b> Panuto:</b> I-drag ang bawat card papunta sa tamang kahon. Matapos ilagay ang kasalukuyang card, awtomatikong lalabas ang susunod na card.</p>
                </div>
            </div>

            <!-- Dynamic Waiting Pool: shows one random card at a time (MOVED TO TOP) -->
            <div class="items-pool">
                <div class="pool-title">
                    <i class="fas fa-hourglass-half"></i> 
                    Ilagay ang card sa tamang kategorya
                    <span class="remaining-count" id="remainingCount">3</span>
                </div>
                <div id="waitingCardArea" class="waiting-card-container">
                    <!-- The active card will appear here dynamically -->
                </div>
            </div>

            <!-- Category Headers with IMAGE placeholders -->
            <div class="category-header">
                <div class="cat-col sanhi-cat">
                    <img src="{{ asset('pictures/sanhi-icon.png') }}" alt="Sanhi Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-fire cat-icon"></i>
                    <div class="cat-label">SANHI</div>
                </div>
                <div class="cat-col epekto-cat">
                    <img src="{{ asset('pictures/epekto-icon.png') }}" alt="Epekto Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-mountain cat-icon"></i>
                    <div class="cat-label">EPEKTO</div>
                </div>
                <div class="cat-col tugon-cat">
                    <img src="{{ asset('pictures/tugon-icon.png') }}" alt="Tugon Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-hand-holding-heart cat-icon"></i>
                    <div class="cat-label">MGA TUGON</div>
                </div>
            </div>

            <!-- Drop Zones Row (Headers removed) -->
            <div class="dropzones-row">
                <div class="dropzone" id="dropzoneSanhi" data-category="sanhi">
                    <!-- Drop zone content will be added here -->
                </div>
                <div class="dropzone" id="dropzoneEpekto" data-category="epekto">
                    <!-- Drop zone content will be added here -->
                </div>
                <div class="dropzone" id="dropzoneTugon" data-category="tugon">
                    <!-- Drop zone content will be added here -->
                </div>
            </div>

            <!-- Game Controls and Reset -->
            <div class="game-controls">
                <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang Aktibidad</button>
                <div id="completionStatus"></div>
            </div>
        </div>
    </div>

    <!-- Summary Modal -->
    <div id="summaryModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h2><i class="fas fa-clipboard-list"></i> 📖 BUOD (Summary)</h2>
            </div>
            <div class="modal-body">
                <p>Noong Hunyo 8, 2023, nakunan ang pag-agos at pagguho ng nagliliwanag na lava mula sa Bulkang Mayon, lalo na kapansin-pansin sa gabi dahil sa liwanag nito. Ipinakita ng aktibidad ang tuloy-tuloy na paglabas ng magma, kabilang ang mga "incandescent rockfalls," na senyales ng aktibong pagputok. Dahil dito, itinaas ang Alert Level 3 at nagbabala ang mga awtoridad sa posibleng panganib tulad ng lava flow, ashfall, at pyroclastic flows. Pinag-iingat ang mga residente at inihahanda ang mga hakbang sa paglikas upang mapanatili ang kaligtasan ng mga komunidad sa paligid ng bulkan.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function(){
            "use strict";

            // ==================== STATEMENTS DATA ====================
            const fullStatements = [
                { 
                    text: "Ang pagsabog ng lava sa Mayon Volcano ay dulot ng patuloy na pag-akyat at paggalaw ng magma sa loob ng bulkan. Ayon sa PHIVOLCS, naitala ang sunod-sunod na lava eruption na sinabayan ng seismic at infrasound signals—mga palatandaan ng tumitinding aktibidad ng bulkan.", 
                    category: "sanhi",
                    imageIcon: "pictures/sanhi-card.png"
                },
                { 
                    text: "Nagresulta ang aktibidad sa patuloy na pagdaloy ng lava sa iba't ibang bahagi ng bulkan, umabot ng ilang kilometro pababa sa mga dalisdis. Nagkaroon din ng mga rockfalls at pyroclastic density currents (PDCs) na nagdeposito ng debris sa loob ng ilang kilometro mula sa crater. Bukod dito, tumaas ang bilang ng volcanic earthquakes at tremors, na nagpapahiwatig ng patuloy na panganib sa mga kalapit na komunidad.", 
                    category: "epekto",
                    imageIcon: "pictures/epekto-card.png"
                },
                { 
                    text: "Naglabas ng mga babala ang mga awtoridad at pinanatili ang Alert Level 3 upang ipaalam ang posibilidad ng mapanganib na pagsabog sa mga susunod na araw o linggo. Pinag-iingat ang mga residente laban sa panganib tulad ng lava flow, rockfalls, at pyroclastic flows, at hinihikayat ang pagsunod sa mga safety protocols at posibleng paglikas upang matiyak ang kaligtasan ng komunidad.", 
                    category: "tugon",
                    imageIcon: "pictures/tugon-card.png"
                }
            ];

            // Randomize order of statements once at start
            let remainingStatements = [...fullStatements];
            function shuffleArray(arr) {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                }
                return arr;
            }
            remainingStatements = shuffleArray(remainingStatements);

            // DOM Elements
            const waitingArea = document.getElementById('waitingCardArea');
            const remainingCountSpan = document.getElementById('remainingCount');
            const dropSanhi = document.getElementById('dropzoneSanhi');
            const dropEpekto = document.getElementById('dropzoneEpekto');
            const dropTugon = document.getElementById('dropzoneTugon');
            const resetBtn = document.getElementById('resetGameBtn');
            const completionStatus = document.getElementById('completionStatus');
            const summaryModal = document.getElementById('summaryModal');
            const modalContinueBtn = document.getElementById('modalContinueBtn');

            let gameActive = true;
            let isLoadingNext = false;

            // Shake a card element
            function shakeCard(card) {
                if (!card) return;
                card.classList.add('shake');
                setTimeout(() => {
                    card.classList.remove('shake');
                }, 400);
            }

            // Helper: update remaining count display
            function updateRemainingDisplay() {
                if (remainingCountSpan) {
                    remainingCountSpan.textContent = remainingStatements.length;
                }
                if (remainingStatements.length === 0 && gameActive) {
                    checkAllPlacedFinal();
                }
            }

            // Function to show modal and handle navigation
            function showSummaryModal() {
                if (summaryModal) {
                    summaryModal.classList.add('show');
                }
            }

            // Function to check final completion after all cards dragged
            function checkAllPlacedFinal() {
                const totalCards = fullStatements.length;
                const sanhiCount = dropSanhi ? dropSanhi.querySelectorAll('.statement-card').length : 0;
                const epektoCount = dropEpekto ? dropEpekto.querySelectorAll('.statement-card').length : 0;
                const tugonCount = dropTugon ? dropTugon.querySelectorAll('.statement-card').length : 0;
                const totalPlaced = sanhiCount + epektoCount + tugonCount;

                let allCorrect = false;
                if (totalPlaced === totalCards) {
                    let correct = true;
                    if (dropSanhi) {
                        const cards = Array.from(dropSanhi.querySelectorAll('.statement-card'));
                        if (cards.some(card => card.dataset.category !== 'sanhi')) correct = false;
                    }
                    if (dropEpekto) {
                        const cards = Array.from(dropEpekto.querySelectorAll('.statement-card'));
                        if (cards.some(card => card.dataset.category !== 'epekto')) correct = false;
                    }
                    if (dropTugon) {
                        const cards = Array.from(dropTugon.querySelectorAll('.statement-card'));
                        if (cards.some(card => card.dataset.category !== 'tugon')) correct = false;
                    }
                    if (correct && totalPlaced === totalCards) {
                        allCorrect = true;
                    }
                }

                if (allCorrect) {
                    sessionStorage.setItem("node4_done", "true");
                    if (completionStatus) {
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                    }
                    gameActive = false;
                    if (waitingArea) waitingArea.innerHTML = '<div class="empty-waiting-message"><i class="fas fa-check-circle"></i> Lahat ng card ay nailagay na! Napakahusay!</div>';
                    // Show the summary modal
                    showSummaryModal();
                } else if (totalPlaced === totalCards && !allCorrect) {
                    if (completionStatus) {
                        completionStatus.innerHTML = '<span style="color: #b02e2e;"><i class="fas fa-exclamation-triangle"></i> May mali pang pagkakalagay. I-reset at subukang muli.</span>';
                    }
                } else {
                    if (!gameActive) return;
                }
            }

            // Create draggable card element with HEADER IMAGE (no side border)
            function createDraggableCard(statement, indexId) {
                const card = document.createElement('div');
                card.className = `statement-card`;
                card.setAttribute('draggable', 'true');
                card.setAttribute('data-category', statement.category);
                card.setAttribute('data-id', indexId);

                // Header Image HTML (top of card)
                let headerImageHtml = '';
                if (statement.imageIcon) {
                    headerImageHtml = `
                        <div class="card-header-image">
                            <img src="{{ asset('${statement.imageIcon}') }}" alt="${statement.category} icon" onerror="this.style.display='none'">
                        </div>
                    `;
                }

                card.innerHTML = `
                    ${headerImageHtml}
                    <div class="card-text-content">${statement.text}</div>
                `;

                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);
                return card;
            }

            // Show next card in waiting area (automatically called after placement)
            function loadNextCard() {
                if (!gameActive) return;
                if (isLoadingNext) return;

                if (remainingStatements.length === 0) {
                    if (waitingArea) {
                        waitingArea.innerHTML = '<div class="empty-waiting-message"><i class="fas fa-check-circle"></i> Walang natitirang card. Natapos na!</div>';
                    }
                    checkAllPlacedFinal();
                    return;
                }

                isLoadingNext = true;

                // Add a small delay for smooth transition
                setTimeout(() => {
                    if (!gameActive) {
                        isLoadingNext = false;
                        return;
                    }

                    const nextStatement = remainingStatements[0];
                    const newCard = createDraggableCard(nextStatement, `card_${Date.now()}_${Math.random()}`);
                    if (waitingArea) {
                        waitingArea.innerHTML = '';
                        waitingArea.appendChild(newCard);
                    }
                    isLoadingNext = false;
                    updateRemainingDisplay();
                }, 150);
            }

            // Function to finalize placement of current card, then automatically load next
            function onCardPlacedSuccessfully(placedCard, targetZone) {
                if (!gameActive) return;

                // Remove from waiting area
                if (waitingArea && waitingArea.contains(placedCard)) {
                    waitingArea.innerHTML = '';
                }

                // Remove from remainingStatements array (the first one)
                if (remainingStatements.length > 0) {
                    remainingStatements.shift();
                }
                updateRemainingDisplay();

                // Check if all cards are placed
                const totalCards = fullStatements.length;
                const sanhiCount = dropSanhi ? dropSanhi.querySelectorAll('.statement-card').length : 0;
                const epektoCount = dropEpekto ? dropEpekto.querySelectorAll('.statement-card').length : 0;
                const tugonCount = dropTugon ? dropTugon.querySelectorAll('.statement-card').length : 0;
                const totalPlaced = sanhiCount + epektoCount + tugonCount;

                if (totalPlaced === totalCards) {
                    // All cards placed, check final correctness
                    checkAllPlacedFinal();
                } else {
                    // Automatically load the next card
                    loadNextCard();
                }

                checkAllPlacedFinal();
            }

            // Drag & Drop Handlers
            let draggedElement = null;

            function handleDragStart(e) {
                if (!gameActive) {
                    e.preventDefault();
                    return false;
                }
                const parent = this.parentNode;
                if (parent !== waitingArea) {
                    e.preventDefault();
                    shakeCard(this);
                    return false;
                }
                draggedElement = this;
                this.classList.add('dragging');
                e.dataTransfer.setData('text/plain', this.getAttribute('data-id'));
                e.dataTransfer.effectAllowed = 'move';
            }

            function handleDragEnd(e) {
                if (this) this.classList.remove('dragging');
                document.querySelectorAll('.dropzone').forEach(zone => {
                    zone.classList.remove('drag-over');
                });
                draggedElement = null;
            }

            function setupDropZones() {
                const dropzones = [dropSanhi, dropEpekto, dropTugon];
                dropzones.forEach(zone => {
                    if (!zone) return;

                    zone.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        if (!gameActive) return;
                        e.dataTransfer.dropEffect = 'move';
                        zone.classList.add('drag-over');
                    });

                    zone.addEventListener('dragleave', () => {
                        zone.classList.remove('drag-over');
                    });

                    zone.addEventListener('drop', (e) => {
                        e.preventDefault();
                        zone.classList.remove('drag-over');
                        if (!gameActive) return;
                        if (!draggedElement) return;

                        const targetCategory = zone.dataset.category;
                        const cardCategory = draggedElement.dataset.category;

                        if (cardCategory !== targetCategory) {
                            shakeCard(draggedElement);
                            return;
                        }

                        if (draggedElement.parentNode !== waitingArea) {
                            shakeCard(draggedElement);
                            return;
                        }

                        // Move card to dropzone
                        zone.appendChild(draggedElement);
                        draggedElement.style.cursor = 'default';
                        draggedElement.setAttribute('draggable', 'false');
                        draggedElement.classList.add('placed');

                        // Remove drag listeners to prevent further drag
                        draggedElement.removeEventListener('dragstart', handleDragStart);
                        draggedElement.removeEventListener('dragend', handleDragEnd);

                        // Trigger automatic next card
                        onCardPlacedSuccessfully(draggedElement, zone);
                        draggedElement = null;
                    });
                });
            }

            // Reset game fully
            function resetGame() {
                gameActive = true;
                isLoadingNext = false;
                remainingStatements = shuffleArray([...fullStatements]);

                // Clear all dropzones
                if (dropSanhi) dropSanhi.innerHTML = '';
                if (dropEpekto) dropEpekto.innerHTML = '';
                if (dropTugon) dropTugon.innerHTML = '';

                // Reset waiting area
                if (waitingArea) waitingArea.innerHTML = '';

                if (completionStatus) completionStatus.innerHTML = '';

                updateRemainingDisplay();

                // Load first card
                setTimeout(() => {
                    if (remainingStatements.length > 0) {
                        const firstStatement = remainingStatements[0];
                        const firstCard = createDraggableCard(firstStatement, `card_init_${Date.now()}`);
                        if (waitingArea) {
                            waitingArea.innerHTML = '';
                            waitingArea.appendChild(firstCard);
                        }
                    }
                    updateRemainingDisplay();
                }, 50);
            }

            // Modal continue button - navigate to inner.map4
            if (modalContinueBtn) {
                modalContinueBtn.addEventListener('click', () => {

                    window.location.href = "{{ route('inner.map4') }}";
                });
            }

            // Close modal when clicking outside
            if (summaryModal) {
                summaryModal.addEventListener('click', (e) => {
                    if (e.target === summaryModal) {
                        summaryModal.classList.remove('show');
                    }
                });
            }

            if (resetBtn) {
                resetBtn.addEventListener('click', resetGame);
            }

            // Prevent default dragover on document
            document.addEventListener('dragover', (e) => e.preventDefault());
            document.addEventListener('drop', (e) => e.preventDefault());

            // Initial setup
            setupDropZones();
            resetGame();
        })();
    </script>
@endsection