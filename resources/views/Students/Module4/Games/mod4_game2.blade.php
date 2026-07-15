@extends('Students.studentslayout')
@section('title', 'Tama ang Numero - Flashflood sa Guinobatan')

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

        /* ---------- Match Board Layout (same 2-column structure as Node 1) ---------- */
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

        /* ---------- Left: Category Zones with Sequential Number Grids ---------- */
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
        }

        .category-header {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            user-select: none;
        }
        @media (max-width: 900px) {
            .category-header { padding: 10px; flex-direction: column; gap: 4px; }
        }

        .cat-icon { font-size: 1.4rem; }
        .cat-image {
            width: 30px;
            height: 30px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }
        @media (max-width: 900px) { .cat-image { width: 24px; height: 24px; } }

        .cat-label {
            font-size: 1.1rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            text-align: center;
        }
        @media (max-width: 900px) { .cat-label { font-size: 0.75rem; } }

        .number-grid {
            padding: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        @media (max-width: 900px) { .number-grid { display: none; } }

        .number-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #8b6b3f;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .number-btn:hover:not(.solved):not(.solved-elsewhere):not(.locked) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.25);
            border-color: var(--gold-trim);
        }

        .number-btn.solved {
            background: var(--success);
            border-color: var(--success);
            color: #fff;
            cursor: default;
        }

        .number-btn.solved-elsewhere {
            background: #d9d0c2;
            border-color: #b7ac97;
            color: #a89f8e;
            cursor: default;
        }

        .number-btn.locked { opacity: 0.6; cursor: not-allowed; }

        @keyframes shakeCard {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            50% { transform: translateX(8px); }
            75% { transform: translateX(-4px); }
            100% { transform: translateX(0); }
        }
        .number-btn.shake { animation: shakeCard 0.4s ease-in-out; border-color: var(--danger); }
        .category-zone.shake { animation: shakeCard 0.4s ease-in-out; }

        /* ---------- Right: Numbered Description Cards ---------- */
        .items-col {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .item-card {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            padding: 14px 16px;
            box-shadow: 2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 2px solid #aaa;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.25s ease;
        }

        .item-card.solved {
            border-color: var(--success);
            background: rgba(46, 125, 50, 0.08);
        }
        .item-card.solved .item-number {
            background: var(--success);
            border-color: var(--success);
            color: #fff;
        }

        .item-number {
            flex: 0 0 auto;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 2px solid var(--gold-trim);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .item-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--ink);
            font-weight: 500;
        }
        @media (max-width: 768px) { .item-text { font-size: 0.78rem; } }

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
        @media (max-width: 768px) { .reset-btn { padding: 8px 16px; font-size: 0.75rem; width: 100%; justify-content: center; } }

        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 10px;
            gap: 15px;
        }
        @media (max-width: 768px) { .game-controls { flex-direction: column; align-items: stretch; } }

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
        @media (max-width: 768px) { .completion-badge { font-size: 0.7rem; width: 100%; justify-content: center; } }

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
        @media (max-width: 768px) { .back-button { top: 10px; left: 10px; padding: 5px 10px; font-size: 0.65rem; } }
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
        @media (max-width: 768px) { .modal-header { padding: 16px 18px; } .modal-header h2 { font-size: 1.2rem; } }
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
        @media (max-width: 768px) { .modal-btn { padding: 10px 18px; font-size: 0.8rem; width: 100%; justify-content: center; } }
        .modal-btn:hover { background: #3d2a25; transform: translateY(-2px); }
    </style>
@endpush

@section('content')
    <a href="{{ route('module4.node2') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div>
                <h1><i class="fas fa-link"></i> Tama ang Numero: Flashflood sa Guinobatan</h1>
                <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b>Panuto:</b> Basahin ang bawat numerong pahayag sa kanan, pagkatapos i-tap ang katumbas na numero sa loob ng tamang kategorya sa kaliwa.</p>
            </div>

            <div class="match-board" id="matchBoard">
                <svg id="lineLayer"></svg>

                <!-- LEFT: Category Zones with Sequential Numbers -->
                <div class="categories-col">
                    <div class="category-zone" id="zoneSanhi" data-category="sanhi">
                        <div class="category-header">
                            <img src="{{ asset('pictures/sanhi-icon.png') }}" alt="Sanhi" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-cloud-rain cat-icon"></i>
                            <span class="cat-label">SANHI</span>
                        </div>
                        <div class="number-grid" id="gridSanhi"></div>
                    </div>

                    <div class="category-zone" id="zoneEpekto" data-category="epekto">
                        <div class="category-header">
                            <img src="{{ asset('pictures/epekto-icon.png') }}" alt="Epekto" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-house-damage cat-icon"></i>
                            <span class="cat-label">EPEKTO</span>
                        </div>
                        <div class="number-grid" id="gridEpekto"></div>
                    </div>

                    <div class="category-zone" id="zoneTugon" data-category="tugon">
                        <div class="category-header">
                            <img src="{{ asset('pictures/tugon-icon.png') }}" alt="Tugon" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-hand-holding-heart cat-icon"></i>
                            <span class="cat-label">MGA TUGON</span>
                        </div>
                        <div class="number-grid" id="gridTugon"></div>
                    </div>
                </div>

                <!-- RIGHT: Numbered Description Cards -->
                <div class="items-col" id="itemsCol"></div>
            </div>

            <!-- Game Controls -->
            <div class="game-controls">
                <div style="display:flex; align-items:center; gap:15px; flex-wrap:wrap;">
                    <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang Aktibidad</button>
                    <span class="progress-track" id="progressTrack">0 / 0 natutugma</span>
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
                <p>Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa't kalahating oras, na nagpasimula ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano. Dahil dito, ang mga kalsada ay naging parang ilog na may dalang putik, bato, at buhangin na nagdulot ng panganib sa mga residente, bahay, at kabuhayan. Agad namang kumilos ang mga awtoridad sa pamamagitan ng clearing operations, pagbibigay ng babala, at paghahanda ng tulong para sa mga apektado. Ipinapakita ng pangyayaring ito ang kahalagahan ng maagap na paghahanda, pagsunod sa babala, at pagtutulungan ng komunidad upang maiwasan ang mas matinding pinsala at mapanatili ang kaligtasan ng lahat.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            "use strict";

            // Each statement belongs to exactly ONE category.
            // Add/remove entries here freely - the sequential number grids
            // in every category zone are generated automatically to match.
            const baseStatements = [
                { text: "Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa't kalahating oras.", category: "sanhi", imageIcon: "pictures/sanhi-card.png" },
                { text: "Dahil sa lakas ng buhos ng ulan, nagkaroon ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano na mabilis na bumaba mula sa kabundukan patungo sa mababang lugar.", category: "sanhi", imageIcon: "pictures/sanhi-card.png" },
                { text: "Nagmistulang ilog ang mga kalsada dahil sa rumaragasang baha na may dalang putik, bato, at buhangin.", category: "epekto", imageIcon: "pictures/epekto-card.png" },
                { text: "Nagdulot ito ng panganib sa mga residente, nasira ang ilang bahay, at naapektuhan ang kabuhayan ng mga tao sa lugar.", category: "epekto", imageIcon: "pictures/epekto-card.png" },
                { text: "Agad na kumilos ang mga awtoridad sa pamamagitan ng clearing operations upang alisin ang putik at debris sa mga kalsada.", category: "tugon", imageIcon: "pictures/tugon-card.png" },
                { text: "Nagbigay rin sila ng mga babala at naghanda ng tulong para sa mga apektadong residente.", category: "tugon", imageIcon: "pictures/tugon-card.png" }
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

            const zones = {
                sanhi: document.getElementById('zoneSanhi'),
                epekto: document.getElementById('zoneEpekto'),
                tugon: document.getElementById('zoneTugon')
            };
            const grids = {
                sanhi: document.getElementById('gridSanhi'),
                epekto: document.getElementById('gridEpekto'),
                tugon: document.getElementById('gridTugon')
            };

            const LOCKOUT_MS = 500;

            let statements = []; // { number, text, category, imageIcon, solved }
            let solvedCount = 0;

            function shake(el) {
                if (!el) return;
                el.classList.add('shake');
                setTimeout(() => el.classList.remove('shake'), 400);
            }

            function updateProgress() {
                progressTrack.textContent = `${solvedCount} / ${statements.length} natutugma`;
            }

            function drawLine(fromEl, toEl) {
                const boardRect = matchBoard.getBoundingClientRect();
                const fromRect = fromEl.getBoundingClientRect();
                const toRect = toEl.getBoundingClientRect();

                const x1 = fromRect.right - boardRect.left;
                const y1 = fromRect.top - boardRect.top + fromRect.height / 2;
                const x2 = toRect.left - boardRect.left;
                const y2 = toRect.top - boardRect.top + toRect.height / 2;

                const midX = (x1 + x2) / 2;
                const d = `M ${x1} ${y1} C ${midX} ${y1}, ${midX} ${y2}, ${x2} ${y2}`;

                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', d);
                lineLayer.appendChild(path);
            }

            function redrawAllLines() {
                lineLayer.innerHTML = '';
                statements.forEach(s => {
                    if (s.solved) {
                        const btnEl = document.querySelector(`.number-btn.solved[data-number="${s.number}"]`);
                        const cardEl = document.getElementById(`item_${s.number}`);
                        if (btnEl && cardEl) drawLine(btnEl, cardEl);
                    }
                });
            }

            function renderItems() {
                itemsCol.innerHTML = '';
                const sortedByNumber = [...statements].sort((a, b) => a.number - b.number);
                sortedByNumber.forEach(s => {
                    const card = document.createElement('div');
                    card.className = 'item-card';
                    card.id = `item_${s.number}`;

                    let imgHtml = '';
                    if (s.imageIcon) {
                        imgHtml = `<img class="item-image" src="{{ asset('') }}${s.imageIcon}" alt="" onerror="this.style.display='none'" style="width:40px;height:40px;object-fit:contain;">`;
                    }

                    card.innerHTML = `
                        <div class="item-number">${s.number}</div>
                        ${imgHtml}
                        <div class="item-text">${s.text}</div>
                    `;
                    itemsCol.appendChild(card);
                });
            }

            function renderNumberGrids() {
                // Sequential order (1, 2, 3, ...) - identical in every zone.
                Object.keys(grids).forEach(category => {
                    grids[category].innerHTML = '';
                    statements
                        .slice()
                        .sort((a, b) => a.number - b.number)
                        .forEach(s => {
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'number-btn';
                            btn.textContent = s.number;
                            btn.setAttribute('data-number', s.number);
                            btn.setAttribute('data-category', category);
                            btn.addEventListener('click', () => handleNumberTap(s.number, category, btn));
                            grids[category].appendChild(btn);
                        });
                });
            }

            function allButtonsForNumber(number) {
                return document.querySelectorAll(`.number-btn[data-number="${number}"]`);
            }

            function handleNumberTap(number, tappedCategory, btnEl) {
                const statement = statements.find(s => s.number === number);
                if (!statement || statement.solved) return;
                if (btnEl.classList.contains('locked')) return;

                if (statement.category === tappedCategory) {
                    statement.solved = true;
                    solvedCount++;
                    updateProgress();

                    const cardEl = document.getElementById(`item_${number}`);
                    if (cardEl) cardEl.classList.add('solved');

                    allButtonsForNumber(number).forEach(b => {
                        if (b.dataset.category === tappedCategory) {
                            b.classList.add('solved');
                        } else {
                            b.classList.add('solved-elsewhere');
                        }
                    });

                    redrawAllLines();

                    if (solvedCount === statements.length) {
                        sessionStorage.setItem("node2_done", "true");
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                        setTimeout(() => summaryModal.classList.add('show'), 400);
                    }
                } else {
                    shake(zones[tappedCategory]);
                    btnEl.classList.add('shake', 'locked');
                    setTimeout(() => btnEl.classList.remove('shake'), 400);
                    setTimeout(() => btnEl.classList.remove('locked'), LOCKOUT_MS);
                }
            }

            function resetGame() {
                const shuffled = shuffleArray(baseStatements);
                statements = shuffled.map((s, idx) => ({
                    ...s,
                    number: idx + 1,
                    solved: false
                }));

                solvedCount = 0;
                completionStatus.innerHTML = '';
                summaryModal.classList.remove('show');
                lineLayer.innerHTML = '';

                renderItems();
                renderNumberGrids();
                updateProgress();
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