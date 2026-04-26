@extends('Students.studentslayout')
@section('title', 'Module 4 : Disaster Defense')

@push('styles')
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-green: #39ff14;
            --neon-red: #ff3131;
            --neon-yellow: #f4ea14;
            --panel-bg: rgba(10, 18, 34, 0.9);
            --ink-1: #e6edf7;
            --ink-2: #9fb1c9;
            --stroke-1: rgba(155, 190, 230, 0.24);
            --card-bg: linear-gradient(160deg, #17243b 0%, #101a2d 100%);
            --card-hover: linear-gradient(160deg, #1d2e4b 0%, #14223a 100%);
            --surface-1: rgba(255, 255, 255, 0.04);
            --surface-2: rgba(255, 255, 255, 0.07);
        }

        html,
        body {
            background: url("{{ asset('pictures/mod4_innermap.png') }}") no-repeat center center fixed;
            background-size: cover;
            color: var(--ink-1);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            touch-action: pan-y;
        }

        .container-box {
            max-width: 1180px;
            margin: 24px auto;
            padding: 28px;
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.04);

            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(6px);
            border: 1px solid #e5e7eb;
        }

        .hud-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            padding: 16px 18px;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .game-title h2 {
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            font-size: 1.28rem;
            letter-spacing: 0.2px;
        }

        .game-title p {
            color: #6b7280 !important;
            margin-top: 4px !important;
            letter-spacing: 0.3px;
        }

        .stat-display {
            background: #f9fafb;
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            text-align: center;
            box-shadow: none;
        }

        .stat-label {
            font-size: 0.64rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #6b7280;
        }

        .stat-value {
            font-size: 0.64rem;
            font-weight: 700;
            color: #111827;
            letter-spacing: 0.5px;
        }

        /* Make the Rank/Antas wider - targeting the specific element */
        #missionRank {
            display: inline-block;
            min-width: 110px;
            font-size: 0.64rem;
            font-weight: 800;
            color: #2563eb;
            font-weight: 800;
        }

        /* Make the container wider */
        .stat-display:has(#missionRank) {
            min-width: 140px;
            padding: 8px 12px;
        }

        /* Timer Progress Bar */
        .timer-container {
            margin-bottom: 20px;
            position: relative;
        }

        .timer-bar-bg {
            height: 8px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            border: none;
        }

        .timer-bar-fill {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-green));
            border-radius: 10px;
            transition: width 0.3s linear;
        }

        .timer-bar-fill.warning {
            background: linear-gradient(90deg, var(--neon-yellow), #ff8800);
        }

        .timer-bar-fill.danger {
            background: linear-gradient(90deg, var(--neon-red), #ff6600);
        }

        .timer-text {
            color: #111827;
            position: absolute;
            right: 0;
            top: -20px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* Current Card Display - One by One */
        .current-card-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 24px;
            text-align: center;
            border: 1px solid #e5e7eb;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .current-card-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #374151;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .current-card {
            display: inline-block;
            cursor: grab;
            transition: transform 0.2s;
            touch-action: none;
        }

        .current-card:active {
            cursor: grabbing;
        }

        .current-card img {
            width: 220px;
            height: 180px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 16px;
            padding: 10px;
            border: 2px solid #e5e7eb;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .current-card p {
            margin-top: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1f2937;
        }

        .cards-remaining {
            margin-top: 10px;
            font-size: 0.75rem;
            color: var(--ink-2);
        }

        /* Drag Clone (visual feedback while dragging) */
        .drag-clone {
            position: fixed;
            z-index: 9999;
            opacity: 0.85;
            pointer-events: none;
            transform: scale(0.95) rotate(5deg);
            transition: none;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
            width: 200px;
        }

        .drag-clone img {
            width: 100%;
            height: 160px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 16px;
            border: 2px solid #e5e7eb;
        }

        .drag-clone p {
            text-align: center;
            font-size: 0.75rem;
            margin-top: 5px;
            color: #1f2937;
        }

        /* MISSION SECTORS */
        .mission-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .sector {
            background: #ffffff;
            border: 2px dashed #d1d5db;
            border-radius: 16px;
            min-height: 200px;
            padding: 10px;
            transition: 0.2s ease;
        }

        .sector.drag-over {
            border-color: #2563eb;
            background: #eff6ff;
        }

        .sector-title {
            text-align: center;
            padding: 8px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.75rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .bago {
            background: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #93c5fd;
        }

        .habang {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .pagkatapos {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .drop-target {
            min-height: 140px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .placed-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .placed-card img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            background: white;
            border-radius: 8px;
            padding: 4px;
        }

        .placed-card p {
            font-size: 0.7rem;
            margin: 0;
            color: #1f2937;
            /* darker text */
            flex: 1;
        }

        /* Feedback Message */
        .feedback-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.9);
            color: var(--neon-yellow);
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: bold;
            z-index: 1000;
            animation: fadeInOut 3s ease;
            border: 1px solid var(--neon-yellow);
            white-space: nowrap;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }

            15% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            85% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }

        /* CUSTOM MODAL */
        .game-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 5, 20, 0.85);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 40px;
            border-radius: 22px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2);
        }

        @keyframes modalSlide {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-deploy {
            margin-top: 20px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 6px 0 #15803d, 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .btn-deploy:hover {
            filter: brightness(1.05);
        }

        .btn-deploy:active {
            transform: translateY(3px);
            box-shadow: 0 3px 0 #15803d;
        }

        /* Mobile Optimizations */
        @media (max-width: 992px) {
            .container-box {
                padding: 16px;
                margin: 10px;
            }

            .hud-header {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
                padding: 12px;
            }

            .hud-header .d-flex.gap-2 {
                display: grid !important;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 8px !important;
            }

            .stat-display {
                min-width: 0;
                padding: 6px 8px;
            }

            .stat-value {
                font-size: 1rem;
            }

            .mission-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .sector {
                min-height: auto;
            }

            .drop-target {
                min-height: 100px;
            }

            .current-card img {
                width: 180px;
                height: 150px;
            }

            .drag-clone {
                width: 160px;
            }

            .drag-clone img {
                height: 130px;
            }

            .btn-deploy {
                width: 100%;
                padding: 12px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .game-title h2 {
                font-size: 1rem;
            }

            .game-title p {
                font-size: 0.7rem;
            }

            .current-card img {
                width: 150px;
                height: 130px;
            }

            .drag-clone {
                width: 130px;
            }

            .drag-clone img {
                height: 110px;
            }

            .sector-title {
                font-size: 0.7rem;
            }

            .modal-content {
                padding: 20px;
            }

            .feedback-toast {
                font-size: 0.75rem;
                padding: 8px 16px;
                white-space: normal;
                text-align: center;
                max-width: 90%;
            }
        }

        .balik-aral-label {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            color: #16a34a;
            background: #dcfce7;
            padding: 4px 10px;
            border-radius: 999px;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
    </style>
@endpush

@section('content')
    <div class="container-box">
        <div class="hud-header">
            <div class="game-title">
                <span class="balik-aral-label">📘 Balik-Aral</span>
                <h2>OPERASYON: KALAMIDAD</h2>
                <p class="m-0 text-muted small">I-DRAG ANG LARAWAN SA TAMANG KAHON</p>
            </div>
            <div class="d-flex gap-2">
                <div class="stat-display">
                    <div class="stat-label">Iskor</div>
                    <div class="stat-value"><span id="score">0</span>/6</div>
                </div>
                <div class="stat-display">
                    <div class="stat-label">Antas</div>
                    <div class="stat-value text-info" id="missionRank">BAGUHAN</div>
                </div>
            </div>
        </div>

        <!-- Timer Progress Bar -->
        <div class="timer-container">
            <div class="timer-bar-bg">
                <div class="timer-bar-fill" id="timerBarFill"></div>
            </div>
            <div class="timer-text" id="timerText">30s</div>
        </div>

        <div style="height: 10px; background: #e5e7eb; border-radius: 10px; margin-bottom: 20px;">
            <div id="missionXpBar"
                style="height: 100%; width: 0%; background: linear-gradient(90deg, var(--neon-cyan), var(--neon-green)); transition: 0.5s; border-radius: 10px;">
            </div>
        </div>

        <div class="mission-grid">
            <div class="sector" id="before">
                <div class="sector-title bago">BAGO (Paghahanda)</div>
                <div class="drop-target" id="beforeTarget"></div>
            </div>
            <div class="sector" id="during">
                <div class="sector-title habang">HABANG (Aksyon)</div>
                <div class="drop-target" id="duringTarget"></div>
            </div>
            <div class="sector" id="after">
                <div class="sector-title pagkatapos">PAGKATAPOS (Pagbangon)</div>
                <div class="drop-target" id="afterTarget"></div>
            </div>
        </div>

        <!-- Current Card to Drag (One by One) -->
        <div class="current-card-container">
            <div class="current-card-label">📦 KASALUKUYANG GAWAIN</div>
            <div id="currentCard" class="current-card" draggable="false">
                <img id="currentImg" src="" alt="Gawain">
                <p id="currentText"></p>
            </div>
            <div class="cards-remaining" id="cardsRemaining"></div>
        </div>



        <div class="text-center">
            <button class="btn btn-deploy" onclick="resetGame()">🔄 I-RESET ANG LARO</button>
        </div>
    </div>

    <div id="feedbackModal" class="game-modal">
        <div class="modal-content">
            <div id="modalIcon" style="font-size: 50px; margin-bottom: 20px;"></div>
            <h2 id="modalTitle" style="font-weight: 800; margin-bottom: 15px;"></h2>
            <p id="modalMessage" style="color: #374151; line-height: 1.6; margin-bottom: 30px;"></p>
            <div id="modalAction"></div>
        </div>
    </div>

    <script>
        // Game Data
        const allCards = [
            { type: 'before', img: 'mod4_emergencykit.png', text: 'Maghanda ng emergency kit.' },
            { type: 'before', img: 'mod4_newsbabala.png', text: 'Makinig sa balita at babala.' },
            { type: 'during', img: 'mod4_evacuating.png', text: 'Lumikas sa ligtas na lugar.' },
            { type: 'during', img: 'mod4_duckcoverhold.png', text: 'Yumuko, magkubli, at kumapit.' },
            { type: 'after', img: 'mod4_cleanupdrive.png', text: 'Tumulong sa paglilinis.' },
            { type: 'after', img: 'mod4_suriinkuryente.png', text: 'Suriin ang linya ng kuryente.' }
        ];

        // Shuffle cards
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        let remainingCards = [];
        let currentCardData = null;
        let score = 0;
        const total = 6;
        let time = 30;
        const initialTime = 30;
        let timer;
        let isActive = true;
        let hasEnded = false;
        let dragClone = null;
        let isDragging = false;
        let startX, startY;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        const balikAralSaveUrl = "{{ route('student.module4.balikaral.save') }}";

        const correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-4.mp3");
        const wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

        // DOM Elements
        const currentCardEl = document.getElementById('currentCard');
        const currentImg = document.getElementById('currentImg');
        const currentText = document.getElementById('currentText');
        const cardsRemainingEl = document.getElementById('cardsRemaining');

        // Show feedback message
        function showFeedback(message, isError = false) {
            const existingToast = document.querySelector('.feedback-toast');
            if (existingToast) existingToast.remove();

            const toast = document.createElement('div');
            toast.className = 'feedback-toast';
            toast.style.color = isError ? 'var(--neon-red)' : 'var(--neon-green)';
            toast.style.borderColor = isError ? 'var(--neon-red)' : 'var(--neon-green)';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                if (toast) toast.remove();
            }, 3000);
        }

        // Update timer progress bar
        function updateTimerBar() {
            const percentage = (time / initialTime) * 100;
            const fill = document.getElementById('timerBarFill');
            const timerText = document.getElementById('timerText');

            fill.style.width = percentage + '%';
            timerText.textContent = time + 's';

            fill.classList.remove('warning', 'danger');
            if (time <= 5) {
                fill.classList.add('danger');
                timerText.style.color = 'var(--neon-red)';
                timerText.style.fontWeight = 'bold';
            } else if (time <= 15) {
                fill.classList.add('warning');
                timerText.style.color = 'var(--neon-yellow)';
            } else {
                timerText.style.color = 'var(--neon-green)';
            }

            if (time === 5) {
                showFeedback('⚠️ 5 segundo na lang! ⚠️', true);
            }
        }

        function updateUI() {
            document.getElementById('score').innerText = score;
            const xp = (score / total) * 100;
            document.getElementById('missionXpBar').style.width = xp + '%';

            const rank = document.getElementById('missionRank');
            if (score >= 6) { rank.innerText = "HEPE"; rank.style.color = "var(--neon-green)"; }
            else if (score >= 4) { rank.innerText = "OPISYAL"; rank.style.color = "var(--neon-cyan)"; }
            else if (score >= 2) { rank.innerText = "REKRUT"; rank.style.color = "var(--neon-yellow)"; }

            // Update remaining count
            // cardsRemainingEl.textContent = `📋 Natitira: ${remainingCards.length} gawain`;
        }

        function startTimer() {
            timer = setInterval(() => {
                if (time <= 0 || !isActive) {
                    if (time <= 0) endGame(false);
                    return;
                }
                time--;
                updateTimerBar();

                if (time === 0) {
                    endGame(false);
                }
            }, 1000);
        }

        // Load next card
        function loadNextCard() {
            if (remainingCards.length === 0 && score === total) {
                endGame(true);
                return;
            }

            if (remainingCards.length > 0) {
                currentCardData = remainingCards.shift();
                currentImg.src = "{{ asset('pictures') }}/" + currentCardData.img;
                currentText.textContent = currentCardData.text;
                updateUI();
            }
        }

        // Add placed card to drop zone as visual
        function addPlacedCardToZone(cardData, zoneId) {
            const zone = document.getElementById(zoneId + 'Target');
            const placedCardDiv = document.createElement('div');
            placedCardDiv.className = 'placed-card';
            placedCardDiv.setAttribute('data-type', cardData.type);
            placedCardDiv.innerHTML = `
                                                                    <img src="{{ asset('pictures') }}/${cardData.img}" alt="Placed">
                                                                    <p>${cardData.text}</p>
                                                                `;
            zone.appendChild(placedCardDiv);
        }

        // Handle drop on sector
        function handleDrop(cardData, sectorId) {
            if (!isActive) return false;

            if (cardData.type === sectorId) {
                // Correct placement
                addPlacedCardToZone(cardData, sectorId);
                score++;
                updateUI();
                correctSound.play().catch(() => { });
                showFeedback('✓ Tamang sagot!', false);

                // Load next card
                loadNextCard();
                return true;
            } else {
                // Wrong placement
                wrongSound.play().catch(() => { });
                showFeedback(`✗ Mali! Ang "${cardData.text}" ay kabilang sa ${getCategoryName(cardData.type)}`, true);

                // Shake the current card
                currentCardEl.classList.add('shake');
                setTimeout(() => currentCardEl.classList.remove('shake'), 400);
                return false;
            }
        }

        function getCategoryName(type) {
            const categories = {
                'before': 'BAGO (Paghahanda)',
                'during': 'HABANG (Aksyon)',
                'after': 'PAGKATAPOS (Pagbangon)'
            };
            return categories[type] || type;
        }

        // Get drop zone from point
        function getDropZoneFromPoint(x, y) {
            const sectors = document.querySelectorAll('.sector');
            for (let sector of sectors) {
                const rect = sector.getBoundingClientRect();
                if (x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom) {
                    return sector.id;
                }
            }
            return null;
        }

        // Create drag clone (the floating image while dragging)
        function createDragClone(cardData, clientX, clientY) {
            const clone = document.createElement('div');
            clone.className = 'drag-clone';
            clone.innerHTML = `
                                                                    <img src="{{ asset('pictures') }}/${cardData.img}" alt="Dragging">
                                                                    <p>${cardData.text}</p>
                                                                `;
            clone.style.left = (clientX - 100) + 'px';
            clone.style.top = (clientY - 80) + 'px';
            document.body.appendChild(clone);
            return clone;
        }

        // Touch/Mouse Drag Implementation for current card
        function onDragStart(e) {
            if (!isActive || !currentCardData) return;
            e.preventDefault();

            let clientX, clientY;
            if (e.type === 'touchstart') {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            startX = clientX;
            startY = clientY;
            isDragging = false;

            // Create visual clone
            dragClone = createDragClone(currentCardData, clientX, clientY);

            // NO pre-drag color highlighting on sectors!
            // The correct target zone is NOT indicated with green beforehand

            // Add event listeners for move/end
            if (e.type === 'touchstart') {
                document.addEventListener('touchmove', onDragMove);
                document.addEventListener('touchend', onDragEnd);
            } else {
                document.addEventListener('mousemove', onDragMove);
                document.addEventListener('mouseup', onDragEnd);
            }
        }

        function onDragMove(e) {
            if (!dragClone) return;
            e.preventDefault();

            let clientX, clientY;
            if (e.type === 'touchmove') {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            const deltaX = Math.abs(clientX - startX);
            const deltaY = Math.abs(clientY - startY);

            if (deltaX > 10 || deltaY > 10) {
                isDragging = true;
            }

            // Update clone position
            dragClone.style.left = (clientX - (dragClone.offsetWidth / 2)) + 'px';
            dragClone.style.top = (clientY - (dragClone.offsetHeight / 2)) + 'px';

            // Highlight drop zone under cursor (only during drag, not beforehand)
            const dropZoneId = getDropZoneFromPoint(clientX, clientY);
            document.querySelectorAll('.sector').forEach(sector => {
                if (dropZoneId === sector.id) {
                    sector.classList.add('drag-over');
                } else {
                    sector.classList.remove('drag-over');
                }
            });
        }

        function onDragEnd(e) {
            if (!dragClone) {
                cleanupDrag();
                return;
            }

            e.preventDefault();

            let clientX, clientY;
            if (e.type === 'touchend') {
                clientX = e.changedTouches[0].clientX;
                clientY = e.changedTouches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            if (isDragging) {
                const dropZoneId = getDropZoneFromPoint(clientX, clientY);
                if (dropZoneId && currentCardData) {
                    handleDrop(currentCardData, dropZoneId);
                } else if (currentCardData) {
                    showFeedback('I-drop sa tamang kahon', true);
                    // Shake the current card
                    currentCardEl.classList.add('shake');
                    setTimeout(() => currentCardEl.classList.remove('shake'), 400);
                }
            } else {
                // Just a tap - show hint without revealing correct zone
                if (currentCardData) {
                    showFeedback(`I-drag ang larawan sa tamang kahon`, false);
                }
            }

            cleanupDrag();
        }

        function cleanupDrag() {
            if (dragClone) {
                dragClone.remove();
                dragClone = null;
            }

            isDragging = false;

            // Reset sector highlights
            document.querySelectorAll('.sector').forEach(sector => {
                sector.style.border = '';
                sector.style.background = '';
                sector.classList.remove('drag-over');
            });

            // Remove event listeners
            document.removeEventListener('touchmove', onDragMove);
            document.removeEventListener('touchend', onDragEnd);
            document.removeEventListener('mousemove', onDragMove);
            document.removeEventListener('mouseup', onDragEnd);
        }

        function endGame(win) {
            if (hasEnded) return;
            hasEnded = true;
            clearInterval(timer);
            isActive = false;

            // Remove drag listeners
            currentCardEl.removeEventListener('touchstart', onDragStart);
            currentCardEl.removeEventListener('mousedown', onDragStart);

            const timeSpent = Math.max(0, initialTime - Math.max(time, 0));
            saveBalikAralResult(score, total, timeSpent, win);

            const modal = document.getElementById('feedbackModal');
            const icon = document.getElementById('modalIcon');
            const title = document.getElementById('modalTitle');
            const msg = document.getElementById('modalMessage');
            const action = document.getElementById('modalAction');

            modal.style.display = 'flex';

            if (win) {
                icon.innerHTML = "🎉";
                title.innerText = "Magaling!";
                title.style.color = "#16a34a";
                msg.innerHTML = "Naipakita mo ang tamang pagkakasunod-sunod ng mga gawain sa panahon ng kalamidad.<br><br><strong>👉 Tandaan:</strong> Ang pagiging handa bago ang sakuna, maingat habang ito ay nangyayari, at responsable pagkatapos nito ay susi sa kaligtasan ng lahat.";
                action.innerHTML = `<button class="btn btn-deploy" onclick="window.location.href='{{ route('module4.welcome') }}'">Magpatuloy</button>`;
            } else {
                icon.innerHTML = "❌";
                title.innerText = "Subukan Muli!";
                title.style.color = "#dc2626";
                msg.innerText = "May ilang gawain na hindi nailagay sa tamang yugto o naubusan ka ng oras. Balikan ang iyong kaalaman at ayusin muli ang mga sagot.";
                action.innerHTML = `<button class="btn btn-deploy" onclick="resetGame()">SUBUKAN MULI</button>`;
            }
        }

        async function saveBalikAralResult(currentScore, totalItems, timeSpent, completed) {
            try {
                await fetch(balikAralSaveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        score: currentScore,
                        correct_answers: currentScore,
                        total_items: totalItems,
                        time_spent: timeSpent,
                        completed: completed
                    })
                });
            } catch (error) {
                console.error('Failed to save Module 4 Balik-Aral result:', error);
            }
        }

        function resetGame() {
            location.reload();
        }

        // Initialize game
        function initGame() {
            // Shuffle and set up remaining cards
            remainingCards = shuffleArray([...allCards]);

            // Load first card
            loadNextCard();

            // Add drag listeners to current card
            currentCardEl.addEventListener('touchstart', onDragStart, { passive: false });
            currentCardEl.addEventListener('mousedown', onDragStart);

            startTimer();
            updateTimerBar();
        }

        initGame();
    </script>
@endsection