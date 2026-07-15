@extends('Students.studentslayout')
@section('title', 'Tugma-Tala Activity - Sanhi, Bunga, Solusyon')

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

        /* ---------- Match Board Layout ---------- */
        .match-board {
            position: relative;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin: 10px 0 25px;
        }
        @media (max-width: 900px) {
            .match-board {
                grid-template-columns: 1fr;
            }
        }

        /* SVG overlay for connecting lines */
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
        #lineLayer path.wrong-flash {
            stroke: var(--danger);
        }
        /* Lines only make visual sense in the two-column desktop layout */
        @media (max-width: 900px) {
            #lineLayer { display: none; }
        }

        /* ---------- Left: Category Zones ---------- */
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
        .category-zone.eligible {
            border-color: var(--gold-trim);
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.4);
        }
        .category-zone.shake { animation: shakeCard 0.4s ease-in-out; }

        .category-header {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
        }
        @media (max-width: 900px) {
            .category-header { padding: 10px; flex-direction: column; gap: 4px; }
        }

        .cat-icon { font-size: 1.4rem; }
        .cat-label {
            font-size: 1.1rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            text-align: center;
        }
        @media (max-width: 900px) { .cat-label { font-size: 0.75rem; } }

        .category-matches {
            padding: 12px;
            min-height: 50px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: flex-start;
        }
        @media (max-width: 900px) { .category-matches { display: none; } }

        .match-chip {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--success);
            color: #fff;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .category-empty-hint {
            color: #7a6650;
            font-size: 0.8rem;
            font-style: italic;
            padding: 4px 2px;
        }

        /* ---------- Right: Numbered Item Cards ---------- */
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
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .item-card:hover { transform: translateY(-2px); box-shadow: 3px 8px 16px rgba(0,0,0,0.35); }

        .item-card.selected {
            border-color: var(--gold-trim);
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.5);
        }

        .item-card.matched {
            cursor: default;
            opacity: 0.55;
            border-color: var(--success);
        }
        .item-card.matched:hover { transform: none; }

        .item-card.shake { animation: shakeCard 0.4s ease-in-out; }

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
        .item-card.matched .item-number { background: var(--success); border-color: var(--success); color: #fff; }

        .item-image {
            flex: 0 0 auto;
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        .item-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--ink);
            font-weight: 500;
        }
        @media (max-width: 768px) { .item-text { font-size: 0.78rem; } }

        @keyframes shakeCard {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            50% { transform: translateX(8px); }
            75% { transform: translateX(-4px); }
            100% { transform: translateX(0); }
        }

        /* ---------- Controls / Buttons ---------- */
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
    <a href="{{ route('module4.node1') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div>
                <h1><i class="fas fa-link"></i> Tugma-Tala: Sanhi, Bunga, Solusyon</h1>
                <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b>Panuto:</b> Piliin ang numerong pahayag sa kanan, pagkatapos i-tap ang tamang kategorya sa kaliwa upang itugma ito.</p>
            </div>

            <div class="match-board" id="matchBoard">
                <svg id="lineLayer"></svg>

                <!-- LEFT: Category Zones -->
                <div class="categories-col">
                    <div class="category-zone" id="zoneSanhi" data-category="sanhi">
                        <div class="category-header">
                            <i class="fas fa-frown cat-icon"></i>
                            <span class="cat-label">SANHI</span>
                        </div>
                        <div class="category-matches" id="matchesSanhi">
                            <span class="category-empty-hint">Wala pang itinutugma</span>
                        </div>
                    </div>

                    <div class="category-zone" id="zoneBunga" data-category="bunga">
                        <div class="category-header">
                            <i class="fas fa-tornado cat-icon"></i>
                            <span class="cat-label">BUNGA</span>
                        </div>
                        <div class="category-matches" id="matchesBunga">
                            <span class="category-empty-hint">Wala pang itinutugma</span>
                        </div>
                    </div>

                    <div class="category-zone" id="zoneSolusyon" data-category="solusyon">
                        <div class="category-header">
                            <i class="fas fa-hand-holding-heart cat-icon"></i>
                            <span class="cat-label">SOLUSYON</span>
                        </div>
                        <div class="category-matches" id="matchesSolusyon">
                            <span class="category-empty-hint">Wala pang itinutugma</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Numbered Item Cards -->
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
                <p>Ang Super Typhoon Rolly ay itinuturing na pinakamalakas na bagyong tumama sa Tabaco, Albay mula pa noong 1952, na nagdulot ng humigit-kumulang ₱2.5 bilyong pinsala sa mga bahay, kabuhayan, at imprastruktura. Sa kabila ng matinding pinsala at paghihirap, walang naitalang nasawi, na nagpapatunay sa kahalagahan ng kahandaan, disiplina, at pagtutulungan ng komunidad sa pagharap sa kalamidad.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            "use strict";

            // Each statement is independently correct for ONE category.
            // Add/remove entries here freely - numbering and shuffling is automatic.
            const baseStatements = [
                { text: "Dumating ang Super Typhoon Rolly sa Bicol Region noong Nobyembre 2020, dala ang napakalakas na hangin at malakas na pag-ulan.", category: "sanhi", imageIcon: "pictures/sanhi-card.png" },
                { text: "Ang kawalan ng sapat na proteksyon sa baybayin at mga ilog ay nagpalala sa epekto ng bagyo sa mga komunidad.", category: "sanhi", imageIcon: "pictures/sanhi-card.png" },
                { text: "Humigit-kumulang ₱2.5 bilyong halaga ng pinsala ang naitala sa mga bahay, kabuhayan, at imprastruktura.", category: "bunga", imageIcon: "pictures/bunga-card.png" },
                { text: "Halos 90% ng mga bangkang pangisda ang nasira, at nawalan ng kuryente at tubig ang maraming barangay.", category: "bunga", imageIcon: "pictures/bunga-card.png" },
                { text: "Nagtulungan ang mga residente at lokal na pamahalaan sa pamamahagi ng relief goods at pag-aayos ng mga apektadong lugar.", category: "solusyon", imageIcon: "pictures/tugon-card.png" },
                { text: "Ang maagang paglikas at disiplina ng mga tao ang naging dahilan kung bakit walang naitalang nasawi.", category: "solusyon", imageIcon: "pictures/tugon-card.png" }
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
                bunga: document.getElementById('zoneBunga'),
                solusyon: document.getElementById('zoneSolusyon')
            };
            const matchesLists = {
                sanhi: document.getElementById('matchesSanhi'),
                bunga: document.getElementById('matchesBunga'),
                solusyon: document.getElementById('matchesSolusyon')
            };

            let statements = [];
            let selectedId = null;
            let matchedCount = 0;

            function shake(el) {
                if (!el) return;
                el.classList.add('shake');
                setTimeout(() => el.classList.remove('shake'), 400);
            }

            function updateProgress() {
                progressTrack.textContent = `${matchedCount} / ${statements.length} natutugma`;
            }

            function drawLine(fromEl, toEl) {
                const boardRect = matchBoard.getBoundingClientRect();
                const fromRect = fromEl.getBoundingClientRect();
                const toRect = toEl.getBoundingClientRect();

                const x1 = fromRect.left - boardRect.left; // right side item's left edge... but item is on right, zone on left
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
                    if (s.matched) {
                        const cardEl = document.querySelector(`.item-number[data-id="${s.id}"]`);
                        const zoneHeaderEl = zones[s.category].querySelector('.category-header');
                        if (cardEl && zoneHeaderEl) drawLine(cardEl, zoneHeaderEl);
                    }
                });
            }

            function addMatchChip(category, number) {
                const list = matchesLists[category];
                const hint = list.querySelector('.category-empty-hint');
                if (hint) hint.remove();
                const chip = document.createElement('div');
                chip.className = 'match-chip';
                chip.textContent = number;
                list.appendChild(chip);
            }

            function selectCard(id) {
                document.querySelectorAll('.item-card').forEach(c => c.classList.remove('selected'));
                selectedId = id;
                const card = document.querySelector(`.item-card[data-id="${id}"]`);
                if (card) card.classList.add('selected');
            }

            function deselect() {
                selectedId = null;
                document.querySelectorAll('.item-card').forEach(c => c.classList.remove('selected'));
            }

            function attemptMatch(category) {
                if (selectedId === null) return;
                const statement = statements.find(s => s.id === selectedId);
                if (!statement || statement.matched) { deselect(); return; }

                const cardEl = document.querySelector(`.item-card[data-id="${statement.id}"]`);
                const zoneEl = zones[category];

                if (statement.category === category) {
                    statement.matched = true;
                    cardEl.classList.add('matched');
                    cardEl.classList.remove('selected');
                    addMatchChip(category, statement.number);
                    matchedCount++;
                    updateProgress();
                    deselect();
                    redrawAllLines();

                    if (matchedCount === statements.length) {
                        sessionStorage.setItem("node_match_done", "true");
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                        setTimeout(() => summaryModal.classList.add('show'), 400);
                    }
                } else {
                    shake(zoneEl);
                    shake(cardEl);
                    deselect();
                }
            }

            function renderItems() {
                itemsCol.innerHTML = '';
                statements.forEach(s => {
                    const card = document.createElement('div');
                    card.className = 'item-card';
                    card.setAttribute('data-id', s.id);

                    let imgHtml = '';
                    if (s.imageIcon) {
                        imgHtml = `<img class="item-image" src="{{ asset('') }}${s.imageIcon}" alt="" onerror="this.style.display='none'">`;
                    }

                    card.innerHTML = `
                        <div class="item-number" data-id="${s.id}">${s.number}</div>
                        ${imgHtml}
                        <div class="item-text">${s.text}</div>
                    `;

                    card.addEventListener('click', () => {
                        if (s.matched) return;
                        selectCard(s.id);
                    });

                    itemsCol.appendChild(card);
                });
            }

            Object.keys(zones).forEach(category => {
                zones[category].addEventListener('click', () => attemptMatch(category));
            });

            function resetGame() {
                const shuffled = shuffleArray(baseStatements);
                statements = shuffled.map((s, idx) => ({
                    ...s,
                    id: `stmt_${idx}_${Date.now()}`,
                    number: idx + 1,
                    matched: false
                }));

                matchedCount = 0;
                selectedId = null;
                lineLayer.innerHTML = '';
                completionStatus.innerHTML = '';
                summaryModal.classList.remove('show');

                Object.values(matchesLists).forEach(list => {
                    list.innerHTML = '<span class="category-empty-hint">Wala pang itinutugma</span>';
                });

                renderItems();
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