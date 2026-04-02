<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <title>Node 2: Deforestation Quest</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
        --bg-1: #eefaf1;
        --bg-2: #dff5ff;
        --bg-3: #fff4d9;
        --panel: rgba(255,255,255,0.82);
        --panel-strong: rgba(255,255,255,0.94);
        --line: #b9d6b4;
        --text: #24402c;
        --muted: #53725c;
        --gold-1: #ffe28a;
        --gold-2: #f4bb2b;
        --green-1: #1f7a47;
        --green-2: #83d16c;
        --green-3: #eaf8df;
        --orange-1: #ffbc6f;
        --red-1: #ff8d8d;
        --blue-1: #8ed8ff;
        --shadow: 0 18px 40px rgba(45, 89, 53, 0.14);
        }

        * { box-sizing: border-box; }

        .background-map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
        }

        html { scroll-behavior: smooth; }

        body {
        margin: 0;
        font-family: "Nunito", sans-serif;
        color: var(--text);
        background: linear-gradient(180deg, var(--bg-2) 0%, var(--bg-1) 48%, var(--bg-3) 100%);
        min-height: 100vh;
        overflow-x: hidden;
        scroll-behavior: smooth;
        padding: 20px 14px 34px;
        background: none !important;
        }

        .page {
        max-width: 1280px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        }

        .quest-shell {
        position: relative;
        border: 2px solid rgba(125, 173, 123, 0.45);
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255,255,255,0.68), rgba(255,255,255,0.86));
        box-shadow: var(--shadow);
        overflow: hidden;
        }

        .quest-shell::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255,255,255,0.18), transparent 30%);
        pointer-events: none;
        }

        .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 16px 18px 10px;
        flex-wrap: wrap;
        }

        .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        color: #245037;
        text-decoration: none;
        font-weight: 800;
        background: rgba(239, 249, 232, 0.92);
        border: 1px solid #a7c891;
        box-shadow: 0 8px 18px rgba(50, 97, 61, 0.1);
        transition: transform .18s ease, box-shadow .18s ease;
        }

        .back-link:hover { transform: translateY(-2px); }

        .xp-rack {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        }

        .xp-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 999px;
        background: var(--panel-strong);
        border: 1px solid #d7e8cf;
        font-weight: 900;
        color: #30553c;
        box-shadow: 0 6px 16px rgba(54, 87, 47, 0.08);
        }

        .hero {
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        gap: 16px;
        padding: 8px 18px 16px;
        align-items: stretch;
        }

        .hero-main,
        .hero-side,
        .panel,
        .deck-panel {
        background: var(--panel);
        border: 1px solid rgba(168, 203, 167, 0.58);
        border-radius: 24px;
        box-shadow: 0 12px 24px rgba(65, 103, 59, 0.08);
        position: relative;
        overflow: hidden;
        }

        .hero-main {
        padding: 22px;
        min-height: 260px;
        }

        .hero-main::after {
        content: "♻️";
        position: absolute;
        right: 18px;
        top: 14px;
        font-size: 4rem;
        opacity: .11;
        }

        .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(180deg, #245e3b, #1f4f32);
        color: #f5fff7;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: .78rem;
        font-weight: 900;
        letter-spacing: .06em;
        text-transform: uppercase;
        box-shadow: 0 10px 18px rgba(31, 79, 50, 0.18);
        }

        .hero-title {
        margin: 14px 0 10px;
        font-family: "Baloo 2", cursive;
        font-size: clamp(2rem, 4vw, 3.4rem);
        line-height: .95;
        color: #23482d;
        }

        .hero-title span {
        display: inline-block;
        color: #c77e13;
        text-shadow: 0 3px 0 rgba(255, 214, 138, .35);
        }

        .hero-copy {
        margin: 0;
        color: var(--muted);
        font-size: 1rem;
        line-height: 1.6;
        max-width: 60ch;
        }

        .hero-side {
        padding: 18px;
        display: grid;
        gap: 12px;
        align-content: start;
        }

        .quest-card {
        padding: 14px 14px 16px;
        border-radius: 20px;
        background: rgba(255,255,255,0.84);
        border: 1px solid #d8ead4;
        position: relative;
        }

        .quest-card h3 {
        margin: 0 0 10px;
        font-size: .95rem;
        color: #31523d;
        }

        .quest-card p {
        margin: 0;
        font-size: .88rem;
        line-height: 1.5;
        color: #577060;
        font-weight: 700;
        }

        .progress-track {
        margin-top: 10px;
        height: 14px;
        background: #e3f0db;
        border: 1px solid #add092;
        border-radius: 999px;
        overflow: hidden;
        }

        .progress-fill {
        height: 100%;
        width: 0%;
        border-radius: inherit;
        background: linear-gradient(90deg, #7cd15c, #f5c947);
        transition: width .35s ease;
        position: relative;
        overflow: hidden;
        }

        .mission-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        padding: 0 18px 18px;
        }

        .panel {
        padding: 18px;
        }

        .board-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 14px;
        flex-wrap: wrap;
        }

        .board-title {
        margin: 0;
        font-family: "Baloo 2", cursive;
        font-size: clamp(1.4rem, 2.6vw, 2rem);
        color: #23422c;
        }

        .board-sub {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f7fbe9;
        border: 1px solid #cddfa9;
        color: #4e6f52;
        font-weight: 800;
        font-size: .82rem;
        }

        .flow-layout {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        position: relative;
        align-items: stretch;
        }

        .zone-wrap {
        position: relative;
        }

        .flow-line {
        position: absolute;
        top: 50%;
        width: 56px;
        height: 12px;
        border-radius: 999px;
        background: linear-gradient(90deg, #86cf68, #f6ca58);
        box-shadow: 0 6px 12px rgba(77, 113, 51, .15);
        z-index: 0;
        transform: translateY(-50%);
        animation: none;
        }

        .flow-line.one { left: calc(33.33% - 21px); }
        .flow-line.two { left: calc(66.66% - 34px); }

        .flow-line::after {
        content: "➜";
        position: absolute;
        right: -8px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 900;
        color: #4f7c2f;
        }

        .zone-card {
        position: relative;
        z-index: 1;
        background: linear-gradient(180deg, rgba(255,255,255,.8), rgba(255,250,240,.88));
        border: 1px solid #d6e6cb;
        border-radius: 22px;
        padding: 12px;
        min-height: 100%;
        box-shadow: 0 10px 22px rgba(55, 93, 52, .08);
        display: flex;
        flex-direction: column;
        }

        .zone-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 10px;
        }

        .zone-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 16px;
        font-weight: 900;
        box-shadow: inset 0 -3px 0 rgba(0,0,0,.08);
        }

        .zone-badge strong { font-size: 1rem; }

        .cause { background: linear-gradient(180deg, #ffe386, #f3c53d); color: #52380b; }
        .effect { background: linear-gradient(180deg, #ffb772, #ef8f37); color: #58270b; }
        .solution { background: linear-gradient(180deg, #b8ea82, #81c948); color: #22431a; }

        .zone-status {
        padding: 7px 10px;
        border-radius: 999px;
        border: 1px solid #d5dfbb;
        background: #fffdf2;
        font-size: .72rem;
        font-weight: 900;
        color: #766649;
        white-space: nowrap;
        }

        .zone-status.complete {
        background: #eaf9e4;
        border-color: #92c982;
        color: #2a6b32;
        }

        .drop-zone {
        min-height: 200px;
        border-radius: 20px;
        border: 2px dashed #95b889;
        background: linear-gradient(180deg, rgba(252,255,248,.95), rgba(244,239,225,.95));
        padding: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: transform .16s ease, border-color .16s ease, box-shadow .16s ease;
        position: relative;
        overflow: hidden;
        flex: 1;
        }

        .drop-zone .drag-item {
        width: 100%;
        }

        .drop-zone.over {
        transform: translateY(-2px);
        border-color: #62a74a;
        box-shadow: 0 0 0 4px rgba(116, 180, 86, .15);
        background: linear-gradient(180deg, #f7fff0, #eef8df);
        }

        .drop-zone.filled {
        border-style: solid;
        box-shadow: inset 0 0 0 1px rgba(121, 171, 95, .16);
        }

        .drop-zone.drop-pop { animation: popIn .35s ease; }

        .drop-zone.spark::after {
        content: "✨";
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 1.1rem;
        animation: sparkle .7s ease;
        }

        .drop-note {
        margin: auto;
        text-align: center;
        color: #8a7b61;
        font-weight: 800;
        font-size: .84rem;
        max-width: 18ch;
        }

        .deck-panel {
        padding: 16px;
        display: grid;
        gap: 14px;
        align-content: start;
        width: 100%;
        }

        .deck-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        }

        .deck-counter {
        padding: 7px 10px;
        border-radius: 999px;
        border: 1px solid #d5dfbb;
        background: #fffdf2;
        font-size: .72rem;
        font-weight: 900;
        color: #766649;
        white-space: nowrap;
        }

        .deck-title {
        margin: 0;
        font-family: "Baloo 2", cursive;
        font-size: 1.5rem;
        color: #24472f;
        }

        .tray {
        border-radius: 20px;
        border: 1px solid #d8e6d2;
        background: linear-gradient(180deg, rgba(246,255,242,.94), rgba(241,248,233,.88));
        padding: 12px;
        position: relative;
        overflow: hidden;
        }

        .tray.deck-unified {
        min-height: 210px;
        }

        .tray-title {
        margin: 0 0 10px;
        font-size: .8rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 900;
        color: #42634b;
        }

        .bank-items {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        align-items: stretch;
        gap: 10px;
        overflow: hidden;
        padding-bottom: 6px;
        }

        .drag-item {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        border-radius: 18px;
        cursor: grab;
        user-select: none;
        transition: transform .12s ease, box-shadow .12s ease;
        box-shadow: 0 10px 18px rgba(74, 76, 31, .08);
        overflow: hidden;
        }

        .drag-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 16px rgba(60, 72, 37, .12);
        }

        .drag-item.dragging {
        opacity: .72;
        transform: scale(.98);
        }

        .drag-item:active { cursor: grabbing; }

        .drag-item.text-item {
        padding: 24px 12px;
        background: linear-gradient(180deg, #fff1d7, #f6e3b9);
        border: 1px solid #dfcda8;
        color: #533f22;
        font-size: .9rem;
        font-weight: 800;
        line-height: 1.35;
        text-align: center;
        min-height: 100px;
        }

        .actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        }

        .btn {
        border: none;
        border-radius: 16px;
        padding: 13px 18px;
        font-weight: 900;
        font-size: .95rem;
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease;
        }

        .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(34, 59, 33, .14);
        }

        .btn-primary {
        background: linear-gradient(180deg, #89d95f, #59ab44);
        color: #103620;
        }

        .btn-secondary {
        background: linear-gradient(180deg, #f7e5c4, #ebd1a6);
        color: #5a4121;
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease;
        }
        .modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }
        .modal-container {
            background: linear-gradient(145deg, #ffffff, #f9fef7);
            max-width: 520px;
            width: 90%;
            border-radius: 36px;
            box-shadow: 0 30px 45px rgba(32, 58, 34, 0.35);
            border: 1px solid rgba(121, 171, 112, 0.5);
            overflow: hidden;
            transform: scale(0.96);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .modal-overlay.active .modal-container { transform: scale(1); }
        .modal-header {
            padding: 20px 24px 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #e2f0dc;
        }
        .modal-title {
            font-family: "Baloo 2", cursive;
            font-size: 1.7rem;
            margin: 0;
            color: #2b5938;
        }
        .modal-close {
            background: rgba(200, 220, 190, 0.6);
            border: none;
            font-size: 1.6rem;
            cursor: pointer;
            border-radius: 60px;
            width: 38px;
            height: 38px;
        }
        .modal-body { padding: 20px 24px 28px; }
        .modal-feedback-text {
            font-size: 1rem;
            line-height: 1.55;
            font-weight: 600;
            color: #2a4a35;
            background: #f4fcf0;
            padding: 18px;
            border-radius: 24px;
            margin-bottom: 28px;
            white-space: pre-line;
            border-left: 6px solid #8bc97c;
        }
        .modal-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: center;
        }
        .modal-btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            cursor: pointer;
            background: #f2f7ef;
            color: #2a573a;
            border: 1px solid #c1ddb5;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .modal-btn-primary {
            background: linear-gradient(100deg, #7ed15e, #51a23b);
            color: #102e1a;
            border: none;
        }
        .confetti {
            pointer-events: none;
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 50;
        }
        .confetti-piece {
            position: absolute;
            top: -20px;
            width: 12px;
            height: 18px;
            border-radius: 4px;
            animation: confettiFall 1.8s linear forwards;
            opacity: .95;
        }
        @keyframes popIn {
            0% { transform: scale(.97); }
            70% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        @keyframes sparkle {
            0% { transform: scale(.6) rotate(0deg); opacity: 0; }
            40% { opacity: 1; }
            100% { transform: scale(1.25) rotate(20deg); opacity: 0; }
        }
        @keyframes confettiFall {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(110vh) rotate(540deg); opacity: 0; }
        }
        @media (max-width: 760px) {
            .flow-layout { grid-template-columns: 1fr; }
            .bank-items { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">
    <div class="page">
        <div class="quest-shell">
            <div class="topbar">
                <a class="back-link" href="{{ route('node2') }}">⬅ Bumalik</a>
                <div class="xp-rack">
                    <div class="xp-chip" id="missionCount">0 / 3 Zones Cleared</div>
                </div>
            </div>

            <section class="hero">
                <div class="hero-main">
                    <div class="eyebrow">🌍 Learning Quest</div>
                    <h1 class="hero-title">Deforestation <span>Quest</span></h1>
                    <p class="hero-copy">
                        Ayusin ang tamang pagkakasunod-sunod base kung ito ay <strong>Sanhi</strong>, <strong>Bunga</strong>, o <strong>Solusyon</strong>.
                        I-drag ang card sa tamang zones para makumpleto ang misyon.
                    </p>
                </div>
                <aside class="hero-side">
                    <div class="quest-card">
                        <h3>🎯 Hint</h3>
                        <p id="missionHint">Alamin ang ugat ng problema, ang epekto nito sa kalikasan, at ang solusyon upang maprotektahan ang kagubatan.</p>
                    </div>
                    <div class="quest-card">
                        <h3>📈 Progress Bar</h3>
                        <div class="progress-track">
                            <div class="progress-fill" id="missionProgressFill"></div>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="mission-grid">
                <div class="panel">
                    <div class="board-header">
                        <h2 class="board-title">Cause → Effect → Solution Board</h2>
                        <div class="board-sub">✨ I-drag ang card sa tamang zone</div>
                    </div>
                    <div class="flow-layout">
                        <div class="flow-line one"></div>
                        <div class="flow-line two"></div>

                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-head">
                                    <div class="zone-badge cause"><strong>🌟 Sanhi</strong></div>
                                    <div class="zone-status" id="status-cause">Waiting...</div>
                                </div>
                                <div class="drop-zone" data-zone="cause">
                                    <div class="drop-note">I-drop dito ang cause cards</div>
                                </div>
                            </div>
                        </div>

                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-head">
                                    <div class="zone-badge effect"><strong>🔥 Bunga</strong></div>
                                    <div class="zone-status" id="status-effect">Waiting...</div>
                                </div>
                                <div class="drop-zone" data-zone="effect">
                                    <div class="drop-note">I-drop dito ang effect cards</div>
                                </div>
                            </div>
                        </div>

                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-head">
                                    <div class="zone-badge solution"><strong>🌿 Solusyon</strong></div>
                                    <div class="zone-status" id="status-solution">Waiting...</div>
                                </div>
                                <div class="drop-zone" data-zone="solution">
                                    <div class="drop-note">I-drop dito ang solution cards</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="deck-panel" id="bankZone">
                    <div class="deck-head">
                        <h3 class="deck-title">🃏 Card Deck</h3>
                        <div class="deck-counter" id="deckCounter">3 Cards Left</div>
                    </div>
                    <div class="tray deck-unified">
                        <p class="tray-title">All Cards</p>
                        <div class="bank-items" id="bankItems">
                            <div class="drag-item text-item" draggable="true" data-id="causeText" data-kind="text" data-correct-zone="cause" data-label="Text Card">
                                Illegal logging at pagkakalbo ng kagubatan
                            </div>
                            <div class="drag-item text-item" draggable="true" data-id="effectText" data-kind="text" data-correct-zone="effect" data-label="Text Card">
                                Pagbaha, pagguho ng lupa, at pagkawala ng tirahan ng wildlife
                            </div>
                            <div class="drag-item text-item" draggable="true" data-id="solutionText" data-kind="text" data-correct-zone="solution" data-label="Text Card">
                                Pagtatanim ng puno, reforestation, at pangangalaga sa kagubatan
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary" type="button" id="checkBtn">✅ Suriin ang Sagot</button>
                        <button class="btn btn-secondary" type="button" id="resetBtn">🔄 I-reset</button>
                    </div>
                </aside>
            </section>
        </div>
    </div>

    <div id="feedbackModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-title" id="modalTitleIcon">📋 Resulta</div>
                <button class="modal-close" id="closeModalBtn">✕</button>
            </div>
            <div class="modal-body">
                <div class="modal-feedback-text" id="modalFeedbackText"></div>
                <div class="modal-actions">
                    <button class="modal-btn modal-btn-primary" id="modalNextMapBtn" style="display: none;">🗺️ Bumalik sa Mapa</button>
                    <a href="{{ route('node3') }}" class="modal-btn" id="modalContinueBtn" style="display: none;">Magpatuloy</a>
                </div>
            </div>
        </div>
    </div>

    <div class="confetti" id="confettiLayer"></div>

    <script>
        const dragItems = Array.from(document.querySelectorAll('.drag-item'));
        const dropZones = Array.from(document.querySelectorAll('.drop-zone'));
        const bankZone = document.getElementById('bankZone');
        const bankItems = document.getElementById('bankItems');
        
        const modalOverlay = document.getElementById('feedbackModal');
        const modalFeedbackText = document.getElementById('modalFeedbackText');
        const modalTitleIcon = document.getElementById('modalTitleIcon');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalNextMapBtn = document.getElementById('modalNextMapBtn');
        const modalContinueBtn = document.getElementById('modalContinueBtn');

        function openModal(type, message) {
            modalOverlay.classList.add('active');
            modalTitleIcon.innerHTML = type === 'error' ? '⚠️ Hindi pa tama' : '🎉 Tagumpay!';
            modalFeedbackText.innerText = message;
        }

        function closeModal() { 
            modalOverlay.classList.remove('active'); 
        }
        
        closeModalBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', (e) => { 
            if (e.target === modalOverlay) closeModal(); 
        });

        function shuffleCards() {
            const cards = Array.from(bankItems.children);
            for (let i = cards.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [cards[i], cards[j]] = [cards[j], cards[i]];
            }
            cards.forEach(card => bankItems.appendChild(card));
        }

        const checkBtn = document.getElementById('checkBtn');
        const resetBtn = document.getElementById('resetBtn');
        const missionCountSpan = document.getElementById('missionCount');
        const missionProgressFill = document.getElementById('missionProgressFill');
        const missionHint = document.getElementById('missionHint');
        const deckCounter = document.getElementById('deckCounter');
        const confettiLayer = document.getElementById('confettiLayer');

        const statusCause = document.getElementById('status-cause');
        const statusEffect = document.getElementById('status-effect');
        const statusSolution = document.getElementById('status-solution');
        const zoneStatusMap = { cause: statusCause, effect: statusEffect, solution: statusSolution };

        let draggedId = '';
        const isCoarsePointer = window.matchMedia('(pointer: coarse)').matches || window.matchMedia('(hover: none)').matches;
        const defaultDeckOrder = ['causeText', 'effectText', 'solutionText'];
        const deckOrderIndex = Object.fromEntries(defaultDeckOrder.map((id, index) => [id, index]));

        dragItems.forEach(item => {
            if (isCoarsePointer) item.setAttribute('draggable', 'false');
            item.addEventListener('dragstart', () => { draggedId = item.dataset.id; item.classList.add('dragging'); });
            item.addEventListener('dragend', () => { item.classList.remove('dragging'); });
            item.addEventListener('click', () => {
                if (!isCoarsePointer) return;
                const inBank = item.closest('#bankItems');
                if (inBank) {
                    const correctZone = document.querySelector(`.drop-zone[data-zone="${item.dataset.correctZone}"]`);
                    if (!correctZone) return;
                    placeInZoneFixed(correctZone, item);
                    triggerDropPop(correctZone);
                } else {
                    sendItemBackToBank(item);
                    triggerDropPop(bankZone);
                }
                refreshZoneVisuals();
                shuffleCards();
                closeModal();
            });
        });

        function sendItemBackToBank(item) { bankItems.appendChild(item); normalizeDeckOrder(); }
        function normalizeDeckOrder() {
            const items = Array.from(bankItems.querySelectorAll('.drag-item'));
            items.sort((a, b) => (deckOrderIndex[a.dataset.id] ?? 999) - (deckOrderIndex[b.dataset.id] ?? 999))
                  .forEach(item => bankItems.appendChild(item));
        }
        function updateDeckCounter() { deckCounter.textContent = `${bankItems.querySelectorAll('.drag-item').length} Cards Left`; }
        function placeInZoneFixed(zone, item) {
            const existingSameKind = zone.querySelector(`.drag-item[data-kind="${item.dataset.kind}"]`);
            if (existingSameKind && existingSameKind !== item) sendItemBackToBank(existingSameKind);
            zone.appendChild(item);
        }
        function triggerDropPop(target) {
            target.classList.remove('drop-pop', 'spark');
            requestAnimationFrame(() => {
                target.classList.add('drop-pop', 'spark');
                setTimeout(() => target.classList.remove('drop-pop', 'spark'), 750);
            });
        }
        function refreshZoneVisuals() {
            let filledZones = 0;
            dropZones.forEach(zone => {
                const zoneName = zone.dataset.zone;
                const hasAnyItem = Boolean(zone.querySelector('.drag-item'));
                zone.classList.toggle('filled', hasAnyItem);
                if (hasAnyItem) filledZones += 1;
                const statusEl = zoneStatusMap[zoneName];
                if (statusEl) {
                    statusEl.textContent = hasAnyItem ? 'Filled ✓' : 'Waiting...';
                    statusEl.classList.toggle('complete', hasAnyItem);
                }
                const existingNote = zone.querySelector('.drop-note');
                if (hasAnyItem && existingNote) existingNote.remove();
                if (!hasAnyItem && !existingNote) {
                    const note = document.createElement('div');
                    note.className = 'drop-note';
                    note.textContent = `I-drop dito ang ${zoneName} cards`;
                    zone.appendChild(note);
                }
            });
            missionCountSpan.textContent = `${filledZones} / 3 Zones Cleared`;
            missionProgressFill.style.width = `${(filledZones / 3) * 100}%`;
            missionHint.textContent = filledZones === 3 ? 'Kumpleto na ang board. Suriin na ang sagot!' : (filledZones === 0 ? 'Simulan sa sanhi.' : 'Ituloy mo lang.');
            updateDeckCounter();
        }
        function zoneContains(zoneName, id) {
            const zone = document.querySelector(`.drop-zone[data-zone="${zoneName}"]`);
            return Boolean(zone.querySelector(`.drag-item[data-id="${id}"]`));
        }
        function burstConfetti() {
            confettiLayer.innerHTML = '';
            const colors = ['#8fd96d', '#ffd86b', '#8ed8ff', '#ff9b8e'];
            for (let i = 0; i < 26; i++) {
                const piece = document.createElement('span');
                piece.className = 'confetti-piece';
                piece.style.left = `${Math.random() * 100}%`;
                piece.style.background = colors[Math.floor(Math.random() * colors.length)];
                piece.style.animationDelay = `${Math.random() * 0.35}s`;
                confettiLayer.appendChild(piece);
            }
            setTimeout(() => confettiLayer.innerHTML = '', 2200);
        }
        function wireDropTarget(target) {
            target.addEventListener('dragover', (e) => { e.preventDefault(); if (target.classList.contains('drop-zone')) target.classList.add('over'); });
            target.addEventListener('dragleave', () => { target.classList.remove('over'); });
            target.addEventListener('drop', (e) => {
                e.preventDefault();
                target.classList.remove('over');
                const dragged = document.querySelector(`.drag-item[data-id="${draggedId}"]`);
                if (!dragged) return;
                if (target.classList.contains('drop-zone')) placeInZoneFixed(target, dragged);
                else if (target === bankZone || target.closest('#bankZone')) sendItemBackToBank(dragged);
                triggerDropPop(target.classList.contains('drop-zone') ? target : bankZone);
                refreshZoneVisuals();
                closeModal();
            });
        }
        dropZones.forEach(zone => wireDropTarget(zone));
        wireDropTarget(bankZone);
        refreshZoneVisuals();
        shuffleCards();

        function checkAnswers() {
            const hasCause = zoneContains('cause', 'causeText');
            const hasEffect = zoneContains('effect', 'effectText');
            const hasSolution = zoneContains('solution', 'solutionText');

            const allCorrect = hasCause && hasEffect && hasSolution;

            if (!allCorrect) {
                openModal('error', 'Kailangang nasa tamang zone ang bawat card. Ilagay ang Sanhi, Bunga, at Solusyon sa kani-kanilang kahon.');
                // HIDE both buttons when incorrect
                modalNextMapBtn.style.display = 'none';
                modalContinueBtn.style.display = 'none';
                return;
            }

            // SHOW both buttons when correct
            modalNextMapBtn.style.display = 'inline-flex';
            modalContinueBtn.style.display = 'inline-flex';
            
            modalNextMapBtn.onclick = () => {
                window.location.href = '{{ route("inner.map2") }}';
            };

            const summary = `Magaling! Naunawaan mo ang sanhi, bunga, at solusyon ng pagkakalbo ng kagubatan.
                             Ang deforestation ay dulot ng illegal logging at paglaki ng populasyon na nagdudulot ng labis na paggamit ng lupa at likas na yaman.
                             Dahil dito, nagkakaroon ng pagbaha, soil erosion, at pagkawala ng tirahan ng mga hayop at halaman.
                             Ngunit may magagawa tayo. Sa pamamagitan ng pagtatanim ng puno, pagsunod sa batas, at responsableng paggamit ng kalikasan, mapoprotektahan natin ang ating kagubatan.
                             Tandaan—ang kalikasan ay buhay, kaya ito ay dapat pangalagaan
                            `;
            openModal('success', summary);
            burstConfetti();
            sessionStorage.setItem("node2_done", "true");
        }

        function resetBoard() {
            dragItems.forEach(item => sendItemBackToBank(item));
            refreshZoneVisuals();
            closeModal();
            confettiLayer.innerHTML = '';
            modalNextMapBtn.style.display = 'none';
            modalContinueBtn.style.display = 'none';
        }

        checkBtn.addEventListener('click', checkAnswers);
        resetBtn.addEventListener('click', resetBoard);
    </script>
</body>
</html>