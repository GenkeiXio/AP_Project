@extends('Students.studentslayout')
@section('title', 'Itama ang Numero - Pagputok ng Bulkang Mayon')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
            --success: #2e7d32;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

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
        @media (max-width: 768px) { h1 { font-size: 1.3rem; } }
        h1 i { color: var(--danger); margin-right: 12px; }

        .subhead {
            color: var(--ink);
            font-size: 1rem;
            border-left: 5px solid var(--gold-trim);
            padding-left: 18px;
            margin: 10px 0 25px;
        }
        @media (max-width: 768px) { .subhead { font-size: 0.8rem; } }

        /* ---------- Match Board Layout (same 2-column structure as Node 1 & 2) ---------- */
        .match-board {
            position: relative;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin: 10px 0 25px;
        }
        @media (max-width: 900px) {
            .match-board { grid-template-columns: 1fr; }
        }

        #lineLayer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }
        #lineLayer path {
            stroke: var(--success);
            stroke-width: 3;
            fill: none;
            stroke-linecap: round;
        }
        @media (max-width: 900px) {
            #lineLayer { display: none; }
        }

        /* ---------- Left: Category Anchor Zones ---------- */
        .categories-col {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        @media (max-width: 900px) {
            .categories-col {
                position: sticky;
                top: 8px;
                z-index: 6;
                flex-direction: row;
                gap: 10px;
                background: var(--old-paper);
                padding: 8px 0 4px;
            }
        }

        .category-zone {
            background: rgba(244, 228, 199, 0.95);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border: 3px solid #8b6b3f;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .category-header {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            padding: 14px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        @media (max-width: 900px) {
            .category-header { padding: 10px; flex-direction: column; gap: 4px; }
        }

        .cat-icon { font-size: 1.4rem; }
        .cat-number {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--gold-trim);
            color: var(--vintage-leather);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.85rem;
            font-family: 'Nunito', sans-serif;
            flex: 0 0 auto;
        }
        .cat-label {
            font-size: 1.1rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            text-align: center;
        }
        @media (max-width: 900px) { .cat-label { font-size: 0.78rem; } }

        .category-progress {
            padding: 10px 12px;
            font-size: 0.8rem;
            color: #7a6650;
            font-style: italic;
            text-align: center;
            font-family: 'Nunito', sans-serif;
        }
        @media (max-width: 900px) { .category-progress { display: none; } }

        /* ---------- Right: Statement Cards with Number Stepper ---------- */
        .items-col {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .item-card {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            padding: 16px 18px;
            box-shadow: 2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 2px solid #aaa;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.25s ease;
        }
        @media (max-width: 768px) {
            .item-card { flex-wrap: wrap; padding: 14px; }
        }

        .item-card.solved {
            border-color: var(--success);
            background: rgba(46, 125, 50, 0.08);
        }

        .stepper {
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .stepper-number {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 2px solid var(--gold-trim);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        @media (max-width: 768px) {
            .stepper-number { width: 44px; height: 44px; font-size: 1.2rem; }
        }

        .stepper-number:hover:not(.locked) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .stepper-number.locked {
            background: var(--success);
            border-color: var(--success);
            cursor: default;
        }

        .stepper-hint {
            font-size: 0.65rem;
            color: #7a6650;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .item-text {
            flex: 1 1 auto;
            font-size: 0.9rem;
            line-height: 1.55;
            color: var(--ink);
            font-weight: 500;
            min-width: 200px;
        }
        @media (max-width: 768px) { .item-text { font-size: 0.78rem; } }

        .confirm-btn {
            flex: 0 0 auto;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 10px 18px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .confirm-btn:hover:not(:disabled) { background: #3d2a25; transform: translateY(-2px); }
        .confirm-btn:disabled { opacity: 0.5; cursor: not-allowed; }
        @media (max-width: 768px) {
            .confirm-btn { width: 100%; }
        }

        .solved-tag {
            flex: 0 0 auto;
            color: var(--success);
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        @keyframes shakeCard {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            50% { transform: translateX(8px); }
            75% { transform: translateX(-4px); }
            100% { transform: translateX(0); }
        }
        .item-card.shake { animation: shakeCard 0.4s ease-in-out; border-color: var(--danger); }
        .category-zone.shake { animation: shakeCard 0.4s ease-in-out; }

        /* ---------- Controls ---------- */
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
        .reset-btn:hover { background: #3d2a25; transform: translateY(-2px); }
        @media (max-width: 768px) {
            .reset-btn { padding: 8px 16px; font-size: 0.75rem; width: 100%; justify-content: center; }
        }

        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 10px;
            gap: 15px;
        }
        @media (max-width: 768px) {
            .game-controls { flex-direction: column; align-items: stretch; }
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
            .completion-badge { font-size: 0.7rem; width: 100%; justify-content: center; }
        }

        .progress-track {
            font-size: 0.9rem;
            background: var(--vintage-leather);
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            font-family: 'Nunito', sans-serif;
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
            .back-button { top: 10px; left: 10px; padding: 5px 10px; font-size: 0.65rem; }
        }
        .back-button:hover { transform: translateX(-3px); }

        /* ---------- Modal ---------- */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(10, 8, 7, 0.9);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-container {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            max-width: 600px; width: 90%; max-height: 85vh; overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            border: 2px solid var(--gold-trim);
        }
        .modal-overlay.show .modal-container { transform: scale(1); }
        .modal-header {
            background: var(--vintage-leather);
            padding: 20px 24px;
            border-bottom: 1px solid var(--gold-trim);
        }
        .modal-header h2 { margin: 0; font-size: 1.5rem; color: var(--gold-trim); font-family: 'Nunito', sans-serif; }
        @media (max-width: 768px) {
            .modal-header { padding: 16px 18px; }
            .modal-header h2 { font-size: 1.2rem; }
        }
        .modal-body { padding: 24px; }
        @media (max-width: 768px) { .modal-body { padding: 18px; } }
        .modal-body p { font-size: 1rem; line-height: 1.7; color: var(--ink); margin-bottom: 20px; }
        @media (max-width: 768px) { .modal-body p { font-size: 0.85rem; } }
        .modal-footer { padding: 16px 24px 24px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }
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
            .modal-btn { padding: 10px 18px; font-size: 0.8rem; width: 100%; justify-content: center; }
        }
        .modal-btn:hover { background: #3d2a25; transform: translateY(-2px); }
    </style>
@endpush

@section('content')
    <a href="{{ route('module4.node4') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div>
                <h1><i class="fas fa-mountain"></i> Itama ang Numero</h1>
                <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b>Panuto:</b> I-tap ang numero sa bawat pahayag sa kanan upang baguhin ito (1, 2, o 3), pagkatapos i-tap ang "Kumpirmahin". Kapag tama, ikokonekta ito sa tamang kategorya sa kaliwa.</p>
            </div>

            <div class="match-board" id="matchBoard">
                <svg id="lineLayer"></svg>

                <!-- LEFT: Category Anchors -->
                <div class="categories-col">
                    <div class="category-zone" id="zoneSanhi">
                        <div class="category-header">
                            <span class="cat-number">1</span>
                            <i class="fas fa-fire cat-icon"></i>
                            <span class="cat-label">SANHI</span>
                        </div>
                        <div class="category-progress" id="progressSanhi">Wala pang itinutugma</div>
                    </div>

                    <div class="category-zone" id="zoneEpekto">
                        <div class="category-header">
                            <span class="cat-number">2</span>
                            <i class="fas fa-mountain cat-icon"></i>
                            <span class="cat-label">EPEKTO</span>
                        </div>
                        <div class="category-progress" id="progressEpekto">Wala pang itinutugma</div>
                    </div>

                    <div class="category-zone" id="zoneTugon">
                        <div class="category-header">
                            <span class="cat-number">3</span>
                            <i class="fas fa-hand-holding-heart cat-icon"></i>
                            <span class="cat-label">TUGON</span>
                        </div>
                        <div class="category-progress" id="progressTugon">Wala pang itinutugma</div>
                    </div>
                </div>

                <!-- RIGHT: Statement Cards with Number Stepper -->
                <div class="items-col" id="itemsCol"></div>
            </div>

            <!-- Game Controls -->
            <div class="game-controls">
                <div style="display:flex; align-items:center; gap:15px; flex-wrap:wrap;">
                    <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang Aktibidad</button>
                    <span class="progress-track" id="progressTrack">0 / 0 tama</span>
                </div>
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
                <p>Noong Hunyo 8, 2023, nakunan ang pag-agos at pagguho ng nagliliwanag na lava mula sa Bulkang Mayon, lalo na kapansin-pansin sa gabi dahil sa liwanag nito. Ipinakita ng aktibidad ang tuloy-tuloy na paglabas ng magma, kabilang ang mga "incandescent rockfalls," na senyales ng aktibong pagputok. Dahil dito, itinaas ang Alert Level 3 at nagbabala ang mga awtoridad sa posibleng panganib tulad ng lava flow, ashfall, at pyroclastic flows. Pinag-iingat ang mga residente at inihahanda ang mga hakbang sa paglikas upang mapanatili ang kaligtasan ng mga komunidad sa paligid ng bulkan.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            "use strict";

            // 1 = SANHI, 2 = EPEKTO, 3 = TUGON
            const CATEGORY_NUMBER = { sanhi: 1, epekto: 2, tugon: 3 };
            const NUMBER_LABEL = { 1: 'SANHI', 2: 'EPEKTO', 3: 'TUGON' };
            const NUMBER_ZONE_ID = { 1: 'zoneSanhi', 2: 'zoneEpekto', 3: 'zoneTugon' };
            const NUMBER_PROGRESS_ID = { 1: 'progressSanhi', 2: 'progressEpekto', 3: 'progressTugon' };

            // Add/remove entries here freely - each statement belongs to
            // exactly ONE category (sanhi, epekto, or tugon).
            const baseStatements = [
                {
                    text: "Ang pagsabog ng lava sa Mayon Volcano ay dulot ng patuloy na pag-akyat at paggalaw ng magma sa loob ng bulkan. Ayon sa PHIVOLCS, naitala ang sunod-sunod na lava eruption na sinabayan ng seismic at infrasound signals—mga palatandaan ng tumitinding aktibidad ng bulkan.",
                    category: "sanhi"
                },
                {
                    text: "Nagresulta ang aktibidad sa patuloy na pagdaloy ng lava sa iba't ibang bahagi ng bulkan, umabot ng ilang kilometro pababa sa mga dalisdis. Nagkaroon din ng mga rockfalls at pyroclastic density currents (PDCs) na nagdeposito ng debris sa loob ng ilang kilometro mula sa crater. Bukod dito, tumaas ang bilang ng volcanic earthquakes at tremors, na nagpapahiwatig ng patuloy na panganib sa mga kalapit na komunidad.",
                    category: "epekto"
                },
                {
                    text: "Naglabas ng mga babala ang mga awtoridad at pinanatili ang Alert Level 3 upang ipaalam ang posibilidad ng mapanganib na pagsabog sa mga susunod na araw o linggo. Pinag-iingat ang mga residente laban sa panganib tulad ng lava flow, rockfalls, at pyroclastic flows, at hinihikayat ang pagsunod sa mga safety protocols at posibleng paglikas upang matiyak ang kaligtasan ng komunidad.",
                    category: "tugon"
                }
            ];

            function shuffleArray(arr) {
                const a = [...arr];
                for (let i = a.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [a[i], a[j]] = [a[j], a[i]];
                }
                return a;
            }

            const itemsCol = document.getElementById('itemsCol');
            const lineLayer = document.getElementById('lineLayer');
            const matchBoard = document.getElementById('matchBoard');
            const progressTrack = document.getElementById('progressTrack');
            const completionStatus = document.getElementById('completionStatus');
            const resetBtn = document.getElementById('resetGameBtn');
            const summaryModal = document.getElementById('summaryModal');
            const modalContinueBtn = document.getElementById('modalContinueBtn');

            let statements = []; // { id, text, category, currentNumber, solved }
            let solvedCount = 0;

            function updateProgress() {
                progressTrack.textContent = `${solvedCount} / ${statements.length} tama`;
            }

            function shake(el) {
                if (!el) return;
                el.classList.add('shake');
                setTimeout(() => el.classList.remove('shake'), 400);
            }

            function cycleNumber(statement, numberEl, hintEl) {
                if (statement.solved) return;
                statement.currentNumber = statement.currentNumber >= 3 ? 1 : statement.currentNumber + 1;
                numberEl.textContent = statement.currentNumber;
                hintEl.textContent = NUMBER_LABEL[statement.currentNumber];
            }

            function drawLine(fromEl, toEl) {
                const boardRect = matchBoard.getBoundingClientRect();
                const fromRect = fromEl.getBoundingClientRect();
                const toRect = toEl.getBoundingClientRect();

                const x1 = fromRect.left - boardRect.left;
                const y1 = fromRect.top - boardRect.top + fromRect.height / 2;
                const x2 = toRect.right - boardRect.left;
                const y2 = toRect.top - boardRect.top + toRect.height / 2;

                const midX = (x1 + x2) / 2;
                const d = `M ${x2} ${y2} C ${midX} ${y2}, ${midX} ${y1}, ${x1} ${y1}`;

                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', d);
                lineLayer.appendChild(path);
            }

            function redrawAllLines() {
                lineLayer.innerHTML = '';
                statements.forEach(s => {
                    if (s.solved) {
                        const cardEl = document.getElementById(`stmt_${s.id}`);
                        const zoneEl = document.getElementById(NUMBER_ZONE_ID[s.currentNumber]);
                        if (cardEl && zoneEl) drawLine(cardEl, zoneEl.querySelector('.category-header'));
                    }
                });
            }

            function updateZoneProgressLabels() {
                [1, 2, 3].forEach(num => {
                    const solvedHere = statements.filter(s => s.solved && s.currentNumber === num);
                    const progEl = document.getElementById(NUMBER_PROGRESS_ID[num]);
                    if (!progEl) return;
                    progEl.textContent = solvedHere.length > 0
                        ? `${solvedHere.length} na-tugma`
                        : 'Wala pang itinutugma';
                });
            }

            function confirmAnswer(statement, cardEl, numberEl, confirmBtnEl) {
                if (statement.solved) return;

                if (CATEGORY_NUMBER[statement.category] === statement.currentNumber) {
                    statement.solved = true;
                    solvedCount++;
                    updateProgress();

                    cardEl.classList.add('solved');
                    numberEl.classList.add('locked');
                    confirmBtnEl.disabled = true;
                    confirmBtnEl.outerHTML = '<span class="solved-tag"><i class="fas fa-check-circle"></i> Tama!</span>';

                    updateZoneProgressLabels();
                    redrawAllLines();

                    if (solvedCount === statements.length) {
                        sessionStorage.setItem("node4_done", "true");
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                        setTimeout(() => summaryModal.classList.add('show'), 400);
                    }
                } else {
                    shake(cardEl);
                    shake(document.getElementById(NUMBER_ZONE_ID[statement.currentNumber]));
                }
            }

            function renderItems() {
                itemsCol.innerHTML = '';
                statements.forEach(s => {
                    const card = document.createElement('div');
                    card.className = 'item-card';
                    card.id = `stmt_${s.id}`;

                    card.innerHTML = `
                        <div class="stepper">
                            <div class="stepper-number" id="num_${s.id}">${s.currentNumber}</div>
                            <div class="stepper-hint" id="hint_${s.id}">${NUMBER_LABEL[s.currentNumber]}</div>
                        </div>
                        <div class="item-text">${s.text}</div>
                        <button type="button" class="confirm-btn" id="confirm_${s.id}">Kumpirmahin</button>
                    `;

                    itemsCol.appendChild(card);

                    const numberEl = card.querySelector(`#num_${s.id}`);
                    const hintEl = card.querySelector(`#hint_${s.id}`);
                    const confirmEl = card.querySelector(`#confirm_${s.id}`);

                    numberEl.addEventListener('click', () => cycleNumber(s, numberEl, hintEl));
                    confirmEl.addEventListener('click', () => confirmAnswer(s, card, numberEl, confirmEl));
                });
            }

            function resetGame() {
                const shuffled = shuffleArray(baseStatements);
                statements = shuffled.map((s, idx) => ({
                    ...s,
                    id: idx + 1,
                    currentNumber: Math.floor(Math.random() * 3) + 1,
                    solved: false
                }));

                solvedCount = 0;
                completionStatus.innerHTML = '';
                summaryModal.classList.remove('show');
                lineLayer.innerHTML = '';

                renderItems();
                updateProgress();
                updateZoneProgressLabels();
            }

            if (modalContinueBtn) {
                modalContinueBtn.addEventListener('click', () => {
                    window.location.href = "{{ route('inner.map4') }}";
                });
            }

            if (summaryModal) {
                summaryModal.addEventListener('click', (e) => {
                    if (e.target === summaryModal) summaryModal.classList.remove('show');
                });
            }

            if (resetBtn) resetBtn.addEventListener('click', resetGame);

            window.addEventListener('resize', redrawAllLines);

            resetGame();
        })();
    </script>
@endsection