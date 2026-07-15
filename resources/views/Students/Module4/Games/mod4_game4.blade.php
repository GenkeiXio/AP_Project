@extends('Students.studentslayout')
@section('title', 'Drag & Drop Activity - Landslide sa Barangay Burabod')

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
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2);
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

        @media (max-width: 768px) {
            h1 {
                font-size: 1.3rem;
            }
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

        @media (max-width: 768px) {
            .subhead {
                font-size: 0.8rem;
            }
        }

        /* Main Layout: Left (Categories) + Right (Cards) */
        .game-layout {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-top: 20px;
        }

        @media (max-width: 992px) {
            .game-layout {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        /* LEFT SIDE - Categories */
        .categories-side {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-item {
            background: rgba(244, 228, 199, 0.6);
            border-radius: 8px;
            border: 2px solid var(--gold-trim);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .category-item.drag-over-cat {
            border-color: #ff6b35;
            box-shadow: 0 0 20px rgba(255, 107, 53, 0.3);
        }

        .category-item.matched {
            border-color: #2e7d32;
            background: rgba(46, 125, 50, 0.1);
        }

        .category-header {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--gold-trim);
        }

        .cat-icon {
            font-size: 1.4rem;
        }

        @media (max-width: 768px) {
            .cat-icon {
                font-size: 1.2rem;
            }
        }

        .cat-image {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        @media (max-width: 768px) {
            .cat-image {
                width: 26px;
                height: 26px;
            }
        }

        .cat-label {
            font-size: 1.1rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
        }

        @media (max-width: 768px) {
            .cat-label {
                font-size: 0.95rem;
            }
        }

        .category-dropzone {
            min-height: 80px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.3);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            transition: all 0.3s ease;
            border-radius: 0 0 6px 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-dropzone.drag-over {
            background: rgba(217, 197, 163, 0.8);
            border: 2px dashed var(--gold-trim);
        }

        .category-dropzone .placeholder-text {
            color: #8b6b3f;
            font-style: italic;
            font-size: 0.85rem;
            opacity: 0.6;
        }

        .category-dropzone .statement-card {
            width: 100%;
            cursor: default;
            pointer-events: none;
            font-size: 0.85rem;
            padding: 12px;
        }

        .category-dropzone .statement-card .card-header-image img {
            width: 35px;
            height: 35px;
        }

        /* RIGHT SIDE - Cards Pool */
        .cards-side {
            display: flex;
            flex-direction: column;
        }

        .cards-pool {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            padding: 20px 24px;
            border: 2px solid var(--gold-trim);
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.3);
            flex: 1;
        }

        .pool-title {
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .pool-title {
                font-size: 1rem;
            }
        }

        .remaining-count {
            font-size: 0.85rem;
            background: var(--vintage-leather);
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            margin-left: 12px;
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
        }

        @media (max-width: 768px) {
            .remaining-count {
                font-size: 0.7rem;
                padding: 3px 8px;
            }
        }

        .cards-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
            min-height: 300px;
        }

        @media (max-width: 768px) {
            .cards-grid {
                min-height: 200px;
                gap: 12px;
            }
        }

        .empty-cards-message {
            text-align: center;
            color: var(--ink);
            font-size: 1.1rem;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.5);
            padding: 40px 20px;
            border-radius: 5px;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .empty-cards-message {
                font-size: 0.85rem;
                padding: 25px 15px;
            }
        }

        /* Statement Cards */
        .statement-card {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 15px 18px;
            box-shadow: 2px 6px 12px rgba(0, 0, 0, 0.25);
            font-weight: 500;
            cursor: grab;
            user-select: none;
            transition: all 0.2s ease;
            border: 1px solid #aaa;
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .statement-card {
                padding: 12px 14px;
                font-size: 0.75rem;
                gap: 10px;
                flex-wrap: wrap;
            }
        }

        .statement-card:active {
            cursor: grabbing;
        }

        .statement-card.dragging {
            opacity: 0.3;
            cursor: grabbing;
            transform: scale(0.95);
        }

        .statement-card.placed {
            cursor: default;
            opacity: 0.95;
        }

        .statement-card .card-header-image {
            flex-shrink: 0;
        }

        .statement-card .card-header-image img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .statement-card .card-header-image img {
                width: 30px;
                height: 30px;
            }
        }

        .statement-card .card-text-content {
            flex: 1;
        }

        /* Shake Animation */
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

        /* Success animation for matched card */
        @keyframes matchSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); background: #c8e6c9; }
            100% { transform: scale(1); }
        }

        .statement-card.match-success {
            animation: matchSuccess 0.5s ease-in-out;
        }

        /* Buttons */
        .reset-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 10px 20px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .reset-btn {
                padding: 8px 16px;
                font-size: 0.75rem;
                width: 100%;
                justify-content: center;
            }
        }

        .reset-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }

        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 25px;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .game-controls {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .completion-badge {
            background: #d9c5a3;
            color: var(--ink);
            padding: 6px 15px;
            border-radius: 3px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #8b6b3f;
            font-family: 'Nunito', sans-serif;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .completion-badge {
                font-size: 0.7rem;
                width: 100%;
                justify-content: center;
            }
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background: var(--vintage-leather);
            padding: 8px 15px;
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
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .back-button {
                top: 10px;
                left: 10px;
                padding: 5px 10px;
                font-size: 0.65rem;
            }
        }

        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Modal */
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
            max-width: 600px;
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
            padding: 20px 24px;
            border-bottom: 1px solid var(--gold-trim);
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--gold-trim);
            font-family: 'Nunito', sans-serif;
        }

        @media (max-width: 768px) {
            .modal-header {
                padding: 16px 18px;
            }
            .modal-header h2 {
                font-size: 1.2rem;
            }
        }

        .modal-body {
            padding: 24px;
        }

        @media (max-width: 768px) {
            .modal-body {
                padding: 18px;
            }
        }

        .modal-body p {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--ink);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .modal-body p {
                font-size: 0.85rem;
            }
        }

        .modal-footer {
            padding: 16px 24px 24px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .modal-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 24px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Nunito', sans-serif;
        }

        @media (max-width: 768px) {
            .modal-btn {
                padding: 10px 18px;
                font-size: 0.8rem;
                width: 100%;
                justify-content: center;
            }
        }

        .modal-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <a href="{{ route('module4.node5') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div>
                <h1><i class="fas fa-mountain"></i> Sanhi, Epekto, at Mga Tugon</h1>
                <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b>Panuto:</b> I-drag ang bawat card mula sa kanan papunta sa tamang kategorya sa kaliwa.</p>
            </div>

            <!-- Main Layout: Left (Categories) + Right (Cards) -->
            <div class="game-layout">
                <!-- LEFT SIDE - Categories -->
                <div class="categories-side">
                    <!-- SANHI -->
                    <div class="category-item" id="catSanhi">
                        <div class="category-header">
                            <img src="{{ asset('pictures/sanhi-icon.png') }}" alt="Sanhi" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-cloud-rain cat-icon"></i>
                            <span class="cat-label">SANHI</span>
                        </div>
                        <div class="category-dropzone" id="dropzoneSanhi" data-category="sanhi">
                            <span class="placeholder-text">⬇️ I-drop dito ang sanhi</span>
                        </div>
                    </div>

                    <!-- EPEKTO -->
                    <div class="category-item" id="catEpekto">
                        <div class="category-header">
                            <img src="{{ asset('pictures/epekto-icon.png') }}" alt="Epekto" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-hill-rockslide cat-icon"></i>
                            <span class="cat-label">EPEKTO</span>
                        </div>
                        <div class="category-dropzone" id="dropzoneEpekto" data-category="epekto">
                            <span class="placeholder-text">⬇️ I-drop dito ang epekto</span>
                        </div>
                    </div>

                    <!-- MGA TUGON -->
                    <div class="category-item" id="catTugon">
                        <div class="category-header">
                            <img src="{{ asset('pictures/tugon-icon.png') }}" alt="Tugon" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-hand-holding-heart cat-icon"></i>
                            <span class="cat-label">MGA TUGON</span>
                        </div>
                        <div class="category-dropzone" id="dropzoneTugon" data-category="tugon">
                            <span class="placeholder-text">⬇️ I-drop dito ang tugon</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - Cards Pool -->
                <div class="cards-side">
                    <div class="cards-pool">
                        <div class="pool-title">
                            <i class="fas fa-cards"></i>
                            Mga Pahayag
                            <span class="remaining-count" id="remainingCount">3</span>
                        </div>
                        <div class="cards-grid" id="cardsGrid"></div>
                    </div>
                </div>
            </div>

            <!-- Game Controls -->
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
                <h2><i class="fas fa-clipboard-list"></i> 📖 BUOD</h2>
            </div>
            <div class="modal-body">
                <p>Nagkaroon ng dalawang landslide sa Barangay Burabod, Libon, Albay dulot ng matinding ulan mula sa bagyong Kristine. Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa habang patuloy ang pagguho sa lugar dahil sa basa at marupok na lupa.</p>
                <p>Sa kabila ng pinsala, ligtas ang mga residente dahil agad silang nakalikas at pansamantalang nanunuluyan sa evacuation center. Gayunpaman, isang 60-anyos na lalaki ang naiulat na nawawala kaya nagpapatuloy ang search and rescue operations.</p>
                <p>Ipinapakita ng insidenteng ito ang kahalagahan ng maagap na paglikas at pagsunod sa mga babala ng awtoridad upang maiwasan ang mas malalang sakuna.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            "use strict";

            // STATEMENTS DATA
            const fullStatements = [
                { 
                    text: "Ang landslide sa Barangay Burabod ay dulot ng matinding pag-ulan na dala ng bagyong Kristine. Dahil sa tuloy-tuloy na buhos ng ulan, naging basa at marupok ang lupa sa mataas na bahagi ng lugar hanggang sa ito ay gumuho at umagos pababa.", 
                    category: "sanhi",
                    imageIcon: "pictures/sanhi-card.png"
                },
                { 
                    text: "Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa dahil sa dalawang magkasunod na landslide. Napilitang lumikas ang mga residente at pansamantalang nanirahan sa evacuation center. Bagamat walang naiulat na nasaktan, isang 60-anyos na lalaki ang naiulat na nawawala. Patuloy ring naging mapanganib ang lugar dahil sa posibilidad ng panibagong pagguho habang isinasagawa ang clearing operations.", 
                    category: "epekto",
                    imageIcon: "pictures/epekto-card.png"
                },
                { 
                    text: "Agad na lumikas ang mga residente upang maiwasan ang panganib at inilipat sila sa evacuation center sa San Vicente Elementary School. Patuloy na nagsasagawa ang mga awtoridad ng search and rescue operations para sa nawawalang indibidwal at clearing operations upang alisin ang mga debris. Nagbibigay rin ng paalala ang mga awtoridad sa kahalagahan ng maagap na paglikas at pagsunod sa mga babala upang mapanatili ang kaligtasan ng komunidad.", 
                    category: "tugon",
                    imageIcon: "pictures/tugon-card.png"
                }
            ];

            let remainingStatements = [...fullStatements];
            function shuffleArray(arr) {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                }
                return arr;
            }
            remainingStatements = shuffleArray(remainingStatements);

            const cardsGrid = document.getElementById('cardsGrid');
            const remainingCountSpan = document.getElementById('remainingCount');
            const dropSanhi = document.getElementById('dropzoneSanhi');
            const dropEpekto = document.getElementById('dropzoneEpekto');
            const dropTugon = document.getElementById('dropzoneTugon');
            const catSanhi = document.getElementById('catSanhi');
            const catEpekto = document.getElementById('catEpekto');
            const catTugon = document.getElementById('catTugon');
            const resetBtn = document.getElementById('resetGameBtn');
            const completionStatus = document.getElementById('completionStatus');
            const summaryModal = document.getElementById('summaryModal');
            const modalContinueBtn = document.getElementById('modalContinueBtn');

            let gameActive = true;
            let isLoadingNext = false;
            let placedCount = 0;

            function shakeCard(card) {
                if (!card) return;
                card.classList.add('shake');
                setTimeout(() => {
                    card.classList.remove('shake');
                }, 400);
            }

            function updateRemainingDisplay() {
                if (remainingCountSpan) {
                    remainingCountSpan.textContent = remainingStatements.length;
                }
            }

            function showSummaryModal() {
                if (summaryModal) {
                    summaryModal.classList.add('show');
                }
            }

            function checkAllPlacedFinal() {
                if (placedCount === fullStatements.length) {
                    sessionStorage.setItem("node5_done", "true");
                    if (completionStatus) {
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                    }
                    gameActive = false;
                    if (cardsGrid) {
                        cardsGrid.innerHTML = '<div class="empty-cards-message"><i class="fas fa-check-circle"></i> Lahat ng card ay nailagay na!</div>';
                    }
                    showSummaryModal();
                }
            }

            function createDraggableCard(statement, indexId) {
                const card = document.createElement('div');
                card.className = 'statement-card';
                card.setAttribute('draggable', 'true');
                card.setAttribute('data-category', statement.category);
                card.setAttribute('data-id', indexId);

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

            function loadNextCard() {
                if (!gameActive) return;
                if (isLoadingNext) return;

                if (remainingStatements.length === 0) {
                    if (cardsGrid) {
                        cardsGrid.innerHTML = '<div class="empty-cards-message"><i class="fas fa-check-circle"></i> Walang natitirang card.</div>';
                    }
                    return;
                }

                isLoadingNext = true;

                setTimeout(() => {
                    if (!gameActive) {
                        isLoadingNext = false;
                        return;
                    }

                    const nextStatement = remainingStatements[0];
                    const newCard = createDraggableCard(nextStatement, `card_${Date.now()}_${Math.random()}`);
                    if (cardsGrid) {
                        cardsGrid.innerHTML = '';
                        cardsGrid.appendChild(newCard);
                    }
                    isLoadingNext = false;
                    updateRemainingDisplay();
                }, 150);
            }

            function onCardPlacedSuccessfully(cardElement) {
                if (!gameActive) return;

                // Remove placeholder text
                const placeholder = cardElement.parentNode.querySelector('.placeholder-text');
                if (placeholder) placeholder.style.display = 'none';

                // Add match success animation
                cardElement.classList.add('match-success');
                setTimeout(() => {
                    cardElement.classList.remove('match-success');
                }, 500);

                // Mark category as matched
                const categoryItem = cardElement.closest('.category-item');
                if (categoryItem) {
                    categoryItem.classList.add('matched');
                }

                if (cardsGrid) cardsGrid.innerHTML = '';

                if (remainingStatements.length > 0) {
                    remainingStatements.shift();
                }
                placedCount++;
                updateRemainingDisplay();

                if (placedCount === fullStatements.length) {
                    checkAllPlacedFinal();
                } else {
                    loadNextCard();
                }
            }

            let draggedElement = null;

            function handleDragStart(e) {
                if (!gameActive) {
                    e.preventDefault();
                    return false;
                }
                const parent = this.parentNode;
                if (parent !== cardsGrid) {
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
                document.querySelectorAll('.category-dropzone').forEach(zone => {
                    zone.classList.remove('drag-over');
                });
                document.querySelectorAll('.category-item').forEach(cat => {
                    cat.classList.remove('drag-over-cat');
                });
                draggedElement = null;
            }

            function setupDropZones() {
                const dropzones = [dropSanhi, dropEpekto, dropTugon];
                const categoryItems = [catSanhi, catEpekto, catTugon];

                dropzones.forEach((zone, index) => {
                    if (!zone) return;

                    const parentCat = categoryItems[index];

                    zone.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        if (!gameActive) return;
                        e.dataTransfer.dropEffect = 'move';
                        zone.classList.add('drag-over');
                        if (parentCat) parentCat.classList.add('drag-over-cat');
                    });

                    zone.addEventListener('dragleave', () => {
                        zone.classList.remove('drag-over');
                        if (parentCat) parentCat.classList.remove('drag-over-cat');
                    });

                    zone.addEventListener('drop', (e) => {
                        e.preventDefault();
                        zone.classList.remove('drag-over');
                        if (parentCat) parentCat.classList.remove('drag-over-cat');
                        if (!gameActive) return;
                        if (!draggedElement) return;

                        const targetCategory = zone.dataset.category;
                        const cardCategory = draggedElement.dataset.category;

                        if (cardCategory !== targetCategory) {
                            shakeCard(draggedElement);
                            return;
                        }

                        if (draggedElement.parentNode !== cardsGrid) {
                            shakeCard(draggedElement);
                            return;
                        }

                        // Check if this category already has a card
                        if (zone.querySelector('.statement-card')) {
                            shakeCard(draggedElement);
                            return;
                        }

                        // Move the card to the dropzone
                        zone.appendChild(draggedElement);
                        draggedElement.style.cursor = 'default';
                        draggedElement.setAttribute('draggable', 'false');
                        draggedElement.classList.add('placed');

                        draggedElement.removeEventListener('dragstart', handleDragStart);
                        draggedElement.removeEventListener('dragend', handleDragEnd);

                        onCardPlacedSuccessfully(draggedElement);
                        draggedElement = null;
                    });
                });
            }

            function resetGame() {
                gameActive = true;
                isLoadingNext = false;
                placedCount = 0;
                remainingStatements = shuffleArray([...fullStatements]);

                // Reset dropzones
                [dropSanhi, dropEpekto, dropTugon].forEach(zone => {
                    if (zone) {
                        zone.innerHTML = '<span class="placeholder-text">⬇️ I-drop dito ang ' + 
                            (zone.dataset.category === 'sanhi' ? 'sanhi' : 
                             zone.dataset.category === 'epekto' ? 'epekto' : 'tugon') + 
                            '</span>';
                        zone.classList.remove('drag-over');
                    }
                });

                // Reset category items
                [catSanhi, catEpekto, catTugon].forEach(cat => {
                    if (cat) cat.classList.remove('matched', 'drag-over-cat');
                });

                if (cardsGrid) cardsGrid.innerHTML = '';
                if (completionStatus) completionStatus.innerHTML = '';

                updateRemainingDisplay();

                setTimeout(() => {
                    if (remainingStatements.length > 0) {
                        const firstStatement = remainingStatements[0];
                        const firstCard = createDraggableCard(firstStatement, `card_init_${Date.now()}`);
                        if (cardsGrid) {
                            cardsGrid.innerHTML = '';
                            cardsGrid.appendChild(firstCard);
                        }
                    }
                    updateRemainingDisplay();
                }, 50);
            }

            if (modalContinueBtn) {
                modalContinueBtn.addEventListener('click', () => {
                    window.location.href = "{{ route('inner.map4') }}";
                });
            }

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

            document.addEventListener('dragover', (e) => e.preventDefault());
            document.addEventListener('drop', (e) => e.preventDefault());

            setupDropZones();
            resetGame();
        })();
    </script>
@endsection