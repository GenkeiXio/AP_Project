    <!DOCTYPE html>
    <html lang="fil">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Node 1: Solid Waste Quest</title>
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
        .deck-panel,
        .feedback-wrap {
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

        .progress-fill::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent 20%, rgba(255,255,255,.45) 48%, transparent 75%);
        animation: none;
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
        .flow-line.two { left: calc(66.66% - 34px); animation-delay: .2s; }

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
        .zone-badge span { font-size: .8rem; opacity: .9; }

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
        min-height: 230px;
        border-radius: 20px;
        border: 2px dashed #95b889;
        background: linear-gradient(180deg, rgba(252,255,248,.95), rgba(244,239,225,.95));
        padding: 12px;
        display: grid;
        grid-template-columns: 1fr;
        align-content: start;
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

        .tray::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent 24%, rgba(255,255,255,.22) 45%, transparent 66%);
        transform: none;
        animation: none;
        pointer-events: none;
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
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        }

        .drag-item {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        width: 100%;
        border-radius: 18px;
        cursor: grab;
        user-select: none;
        transition: transform .12s ease, box-shadow .12s ease, opacity .12s ease;
        box-shadow: 0 10px 18px rgba(74, 76, 31, .08);
        overflow: hidden;
        isolation: isolate;
        will-change: transform;
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
        padding: 30px 10px 10px;
        background: linear-gradient(180deg, #fff1d7, #f6e3b9);
        border: 1px solid #dfcda8;
        color: #533f22;
        font-size: .84rem;
        font-weight: 800;
        line-height: 1.32;
        min-height: 76px;
        min-width: 0;
        max-width: none;
        text-align: left;
        }

        .drag-item.text-item::before,
        .drag-item.image-item::before {
        content: attr(data-label);
        position: absolute;
        top: 7px;
        left: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 7px;
        border-radius: 999px;
        font-size: .6rem;
        font-weight: 900;
        letter-spacing: .05em;
        text-transform: uppercase;
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(127,163,119,.45);
        color: #355241;
        z-index: 2;
        }

        .drag-item.image-item {
        padding: 30px 8px 8px;
        background: linear-gradient(180deg, #f4fbf2, #edf6e7);
        border: 1.5px solid #a7cb9d;
        min-height: 132px;
        min-width: 0;
        max-width: none;
        }

        .thumb-wrap {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: rgba(255,255,255,.82);
        min-height: 86px;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(163, 198, 153, .7);
        }

        .thumb {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        transition: transform .35s ease;
        }

        .drag-item.image-item:hover .thumb {
        transform: scale(1.02);
        }

        .image-glow {
        position: absolute;
        inset: auto 0 0 0;
        height: 54%;
        background: linear-gradient(180deg, transparent, rgba(20, 48, 26, .45));
        pointer-events: none;
        }

        .image-caption {
        position: absolute;
        left: 12px;
        right: 12px;
        bottom: 10px;
        color: white;
        font-weight: 900;
        font-size: .68rem;
        text-shadow: 0 2px 8px rgba(0,0,0,.4);
        z-index: 1;
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
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
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

        .feedback-wrap {
        margin: 0 18px 18px;
        padding: 14px 16px;
        display: none;
        }

        .feedback-wrap.show { display: block; }
        .feedback-wrap.error {
        background: linear-gradient(180deg, #fff4f4, #ffe6e6);
        border-color: #f0c2c2;
        color: #8b2d2d;
        }

        .feedback-wrap.success {
        background: linear-gradient(180deg, #effff2, #e0f5e3);
        border-color: #b8dfbe;
        color: #205f30;
        animation: glowSuccess .5s ease;
        }

        .feedback-title {
        margin: 0 0 6px;
        font-size: .95rem;
        font-weight: 900;
        }

        .feedback-text {
        margin: 0;
        line-height: 1.6;
        font-size: .92rem;
        white-space: pre-line;
        font-weight: 700;
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

        .hidden-audio { display: none; }

        @keyframes shimmer {
        0% { transform: translateX(-120%); }
        100% { transform: translateX(150%); }
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

        @keyframes glowSuccess {
        0% { transform: scale(1); }
        45% { transform: scale(1.01); }
        100% { transform: scale(1); }
        }

        @keyframes confettiFall {
        0% { transform: translateY(0) rotate(0deg); opacity: 1; }
        100% { transform: translateY(110vh) rotate(540deg); opacity: 0; }
        }

        @media (max-width: 1080px) {
        .hero,
        .mission-grid { grid-template-columns: 1fr; }
        .flow-line { display: none; }
        .drop-zone { min-height: 180px; }
        }

        @media (max-width: 760px) {
        .flow-layout { grid-template-columns: 1fr; }
        .drop-zone { min-height: 130px; }

        .bank-items {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .actions {
            position: sticky;
            bottom: 10px;
            background: rgba(255,255,255,.94);
            padding: 8px;
            border-radius: 14px;
            border: 1px solid #d9e8d0;
            z-index: 5;
        }

        .actions .btn {
            flex: 1 1 180px;
            min-height: 44px;
            font-size: .9rem;
        }

        .drag-item.text-item {
            min-height: 72px;
            font-size: .8rem;
        }

        .drag-item.image-item {
            min-height: 118px;
        }

        .thumb-wrap {
            min-height: 74px;
        }
        }

        @media (max-width: 520px) {
        .bank-items {
            grid-template-columns: 1fr;
        }
        }

        @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation: none !important;
            transition: none !important;
            scroll-behavior: auto !important;
        }
        }
    </style>
    </head>
    <body>
    <div class="page">
        <div class="quest-shell">
        <div class="topbar">
            <a class="back-link" href="{{ route('node1.solid-waste') }}">⬅ Balik sa Node 1 Overview</a>
            <div class="xp-rack">
            <div class="xp-chip">🏆 Eco Mission</div>
            <div class="xp-chip" id="missionCount">0 / 3 Zones Cleared</div>
            </div>
        </div>

        <section class="hero">
            <div class="hero-main">
            <div class="eyebrow">🌍 Interactive Learning Quest</div>
            <h1 class="hero-title">Solid Waste <span>Quest</span></h1>
            <p class="hero-copy">
                Ayusin ang tamang pagkakasunod-sunod ng <strong>Sanhi</strong>, <strong>Bunga</strong>, at <strong>Solusyon</strong>.
                Drag the text and image cards into the correct zones para makumpleto ang eco mission.
            </p>
            </div>

            <aside class="hero-side">
            <div class="quest-card">
                <h3>🎯 Mission Brief</h3>
                <p id="missionHint">Hanapin muna ang pinagmumulan ng problema, sunod ang epekto, at panghuli ang pinakaangkop na solusyon.</p>
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
                <div class="board-sub">✨ Drag cards into the glowing zones</div>
            </div>

            <div class="flow-layout">
                <div class="flow-line one"></div>
                <div class="flow-line two"></div>

                <div class="zone-wrap">
                <div class="zone-card">
                    <div class="zone-head">
                    <div class="zone-badge cause"><strong>🌟 Sanhi</strong><span></span></div>
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
                    <div class="zone-badge effect"><strong>🔥 Bunga</strong><span></span></div>
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
                    <div class="zone-badge solution"><strong>🌿 Solusyon</strong><span></span></div>
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
                <div class="deck-counter" id="deckCounter">6 Cards Left</div>
            </div>

            <div class="tray deck-unified">
                <p class="tray-title">All Cards</p>
                <div class="bank-items" id="bankItems">
                <div class="drag-item text-item" draggable="true" data-id="causeText" data-kind="text" data-correct-zone="cause" data-label="Text Card">
                    Kawalan ng disiplina at hindi pagsunod sa waste segregation
                </div>
                <div class="drag-item text-item" draggable="true" data-id="effectText" data-kind="text" data-correct-zone="effect" data-label="Text Card">
                    Pagbaha at paglaganap ng sakit
                </div>
                <div class="drag-item text-item" draggable="true" data-id="solutionText" data-kind="text" data-correct-zone="solution" data-label="Text Card">
                    Waste segregation, recycling, at clean-up drives
                </div>
                <div class="drag-item image-item" draggable="true" data-id="causeImage" data-kind="image" data-correct-zone="cause" data-label="Image Card">
                    <div class="thumb-wrap">
                    <img class="thumb" alt="Sanhi image" src="{{ asset('pictures/cause.png') }}">
                    <div class="image-glow"></div>
                    <div class="image-caption">Maling Pagtatapon</div>
                    </div>
                </div>
                <div class="drag-item image-item" draggable="true" data-id="effectImage" data-kind="image" data-correct-zone="effect" data-label="Image Card">
                    <div class="thumb-wrap">
                    <img class="thumb" alt="Bunga image" src="{{ asset('pictures/Effect.png') }}">
                    <div class="image-glow"></div>
                    <div class="image-caption">Pagbaha at Sakit</div>
                    </div>
                </div>
                <div class="drag-item image-item" draggable="true" data-id="solutionImage" data-kind="image" data-correct-zone="solution" data-label="Image Card">
                    <div class="thumb-wrap">
                    <img class="thumb" alt="Solusyon image" src="{{ asset('pictures/Solusion.png') }}">
                    <div class="image-glow"></div>
                    <div class="image-caption">Clean-up Action</div>
                    </div>
                </div>
                </div>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="button" id="checkBtn">✅ Suriin ang Sagot</button>
                <button class="btn btn-secondary" type="button" id="resetBtn">🔄 I-reset</button>
            </div>
            </aside>
        </section>

        <section id="feedback" class="feedback-wrap" aria-live="polite">
            <div style="text-align:center; margin-top: 20px;">
                <button id="nextNodeBtn" class="btn btn-primary" style="display:none;">
                    🗺️ Go back to Map
                </button>
            </div>

            <div class="feedback-title" id="feedbackTitle"></div>
            <p class="feedback-text" id="feedbackText"></p>
        </section>

        <!-- <audio id="summaryAudio" class="hidden-audio" preload="auto" src="{{ asset('audio/home-bg-music.mp3') }}"></audio> -->
        </div>
    </div>

    <div class="confetti" id="confettiLayer"></div>

    <script>
        const dragItems = Array.from(document.querySelectorAll('.drag-item'));
        const dropZones = Array.from(document.querySelectorAll('.drop-zone'));
        const bankZone = document.getElementById('bankZone');
        const bankItems = document.getElementById('bankItems');
                function shuffleCards() {
            const cards = Array.from(bankItems.children);

            for (let i = cards.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [cards[i], cards[j]] = [cards[j], cards[i]];
            }

            cards.forEach(card => bankItems.appendChild(card));
        }
        const feedback = document.getElementById('feedback');
        const feedbackTitle = document.getElementById('feedbackTitle');
        const feedbackText = document.getElementById('feedbackText');
        const checkBtn = document.getElementById('checkBtn');
        const resetBtn = document.getElementById('resetBtn');
        const summaryAudio = document.getElementById('summaryAudio');
        const missionCount = document.getElementById('missionCount');
        const missionProgressFill = document.getElementById('missionProgressFill');
        const missionHint = document.getElementById('missionHint');
        const deckCounter = document.getElementById('deckCounter');
        const confettiLayer = document.getElementById('confettiLayer');
        const nextNodeBtn = document.getElementById('nextNodeBtn');

        const statusCause = document.getElementById('status-cause');
        const statusEffect = document.getElementById('status-effect');
        const statusSolution = document.getElementById('status-solution');

        const zoneStatusMap = {
        cause: statusCause,
        effect: statusEffect,
        solution: statusSolution,
        };

        let draggedId = '';
        const isCoarsePointer = window.matchMedia('(pointer: coarse)').matches || window.matchMedia('(hover: none)').matches;
        const defaultDeckOrder = ['causeText', 'effectText', 'solutionText', 'causeImage', 'effectImage', 'solutionImage'];
        const deckOrderIndex = Object.fromEntries(defaultDeckOrder.map((id, index) => [id, index]));

        dragItems.forEach(item => {
        if (isCoarsePointer) {
            item.setAttribute('draggable', 'false');
        }

        item.addEventListener('dragstart', () => {
            draggedId = item.dataset.id;
            item.classList.add('dragging');
        });

        item.addEventListener('dragend', () => {
            item.classList.remove('dragging');
        });

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
            clearFeedback();
        });
        });

        function sendItemBackToBank(item) {
        bankItems.appendChild(item);
        normalizeDeckOrder();
        }

        function normalizeDeckOrder() {
        const items = Array.from(bankItems.querySelectorAll('.drag-item'));
        items
            .sort((firstItem, secondItem) => (deckOrderIndex[firstItem.dataset.id] ?? 999) - (deckOrderIndex[secondItem.dataset.id] ?? 999))
            .forEach((item) => bankItems.appendChild(item));
        }

        function updateDeckCounter() {
        const left = bankItems.querySelectorAll('.drag-item').length;
        if (deckCounter) {
            deckCounter.textContent = `${left} Cards Left`;
        }
        }

        function placeInZoneFixed(zone, item) {
        const itemKind = item.dataset.kind;
        const existingSameKind = zone.querySelector(`.drag-item[data-kind="${itemKind}"]`);
        if (existingSameKind && existingSameKind !== item) {
            sendItemBackToBank(existingSameKind);
        }

        if (itemKind === 'text') {
            const imageCard = zone.querySelector('.drag-item[data-kind="image"]');
            if (imageCard) {
            zone.insertBefore(item, imageCard);
            } else {
            zone.appendChild(item);
            }
        } else {
            zone.appendChild(item);
        }
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

        missionCount.textContent = `${filledZones} / 3 Zones Cleared`;
        missionProgressFill.style.width = `${(filledZones / 3) * 100}%`;

        missionHint.textContent =
            filledZones === 3
            ? 'Kumpleto na ang board. Time to check your answer!'
            : filledZones === 0
                ? 'Simulan sa sanhi para mas madali mong ma-build ang tamang flow.'
                : 'Nice one. Ituloy mo lang hanggang mapuno ang tatlong zones.';

        updateDeckCounter();
        }

        function zoneContains(zoneName, id) {
        const zone = document.querySelector(`.drop-zone[data-zone="${zoneName}"]`);
        return Boolean(zone.querySelector(`.drag-item[data-id="${id}"]`));
        }

        function clearFeedback() {
        feedback.className = 'feedback-wrap';
        feedbackTitle.textContent = '';
        feedbackText.textContent = '';
        }

        function showError(message) {
        feedback.className = 'feedback-wrap show error';
        feedbackTitle.textContent = '⚠️ Hindi pa tama';
        feedbackText.textContent = message;
        }

        function showSuccess(message) {
        feedback.className = 'feedback-wrap show success';
        feedbackTitle.textContent = '🎉 Mission Complete';
        feedbackText.textContent = message;
        }

        function speakSummary(text) {
        if (!('speechSynthesis' in window)) return;
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(text.replace(/\n/g, ' '));
        utterance.lang = 'fil-PH';
        utterance.rate = 0.92;
        window.speechSynthesis.speak(utterance);
        }

        function burstConfetti() {
        confettiLayer.innerHTML = '';
        const colors = ['#8fd96d', '#ffd86b', '#8ed8ff', '#ff9b8e', '#ffffff'];
        for (let i = 0; i < 26; i++) {
            const piece = document.createElement('span');
            piece.className = 'confetti-piece';
            piece.style.left = `${Math.random() * 100}%`;
            piece.style.background = colors[Math.floor(Math.random() * colors.length)];
            piece.style.animationDelay = `${Math.random() * 0.35}s`;
            piece.style.transform = `translateY(0) rotate(${Math.random() * 120}deg)`;
            confettiLayer.appendChild(piece);
        }
        setTimeout(() => confettiLayer.innerHTML = '', 2200);
        }

        function wireDropTarget(target) {
        target.addEventListener('dragover', (event) => {
            event.preventDefault();
            if (target.classList.contains('drop-zone')) target.classList.add('over');
        });

        target.addEventListener('dragleave', () => {
            target.classList.remove('over');
        });

        target.addEventListener('drop', (event) => {
            event.preventDefault();
            target.classList.remove('over');

            const dragged = document.querySelector(`.drag-item[data-id="${draggedId}"]`);
            if (!dragged) return;

            if (target.classList.contains('drop-zone')) {
            placeInZoneFixed(target, dragged);
            } else if (target === bankZone || target.closest('#bankZone')) {
            sendItemBackToBank(dragged);
            }

            triggerDropPop(target.classList.contains('drop-zone') ? target : bankZone);
            refreshZoneVisuals();
            clearFeedback();
        });
        }

        dropZones.forEach(zone => wireDropTarget(zone));
        wireDropTarget(bankZone);
        refreshZoneVisuals();

        function checkAnswers() {
            const hasCause = zoneContains('cause', 'causeText');
            const hasEffect = zoneContains('effect', 'effectText');
            const hasSolution = zoneContains('solution', 'solutionText');
            const hasCauseImage = zoneContains('cause', 'causeImage');
            const hasEffectImage = zoneContains('effect', 'effectImage');
            const hasSolutionImage = zoneContains('solution', 'solutionImage');

            if (!hasCause || !hasEffect || !hasSolution) {
                showError('Ayusin pa ang text cards. Dapat nasa tamang zone ang Sanhi, Bunga, at Solusyon.');
                return;
            }

            if (!hasCauseImage || !hasEffectImage || !hasSolutionImage) {
                showError('May image cards pang wala sa tamang zone. Itugma ang bawat larawan sa tamang kahulugan nito.');
                return;
            }

            const summary = `Magaling! Natukoy mo ang tamang ugnayan ng sanhi, bunga, at solusyon.
        Ang suliranin ay nagsisimula sa kawalan ng disiplina at maling pamamahala ng basura.
        Bunga nito ang pagbaha at paglaganap ng sakit sa komunidad.
        Ngunit may malinaw na tugon: waste segregation, recycling, at clean-up drives.
        Tandaan—ang pangangalaga sa kapaligiran ay nagsisimula sa araw-araw na tamang gawain.`;

            showSuccess(summary);
            burstConfetti();

            // 🔥 IMPORTANT: UNLOCK NODE 2
            sessionStorage.setItem("node1_done", "true");

            nextNodeBtn.style.display = 'inline-block';

            nextNodeBtn.addEventListener('click', () => {
                window.location.href = '{{ route("inner.map2") }}';
            });

            summaryAudio.currentTime = 0;
            summaryAudio.play().catch(() => {});
            speakSummary(summary);
        }

        function resetBoard() {
        dragItems.forEach(item => sendItemBackToBank(item));
        refreshZoneVisuals();
        clearFeedback();
        window.speechSynthesis?.cancel();
        summaryAudio.pause();
        summaryAudio.currentTime = 0;
        confettiLayer.innerHTML = '';
        }

        checkBtn.addEventListener('click', checkAnswers);
        resetBtn.addEventListener('click', resetBoard);
    </script>
    </body>
    </html>
