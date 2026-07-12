@extends('Students.studentslayout')
@section('title', 'Climate Change Quest')

@push('styles')
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

        html, body {
            scroll-behavior: smooth;
            background:
                radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
                radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
                radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
                linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
        }

        body {
            overflow-x: hidden;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
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

        .intro-layout {
            display: grid;
            grid-template-columns: minmax(150px, 220px) minmax(0, 1fr);
            align-items: start;
            gap: 20px;
        }

        .intro-illustration {
            width: min(180px, 100%);
            max-width: 220px;
            object-fit: contain;
            filter: drop-shadow(0 12px 20px rgba(0,0,0,.18));
            justify-self: center;
        }

        .intro-narration {
            text-align: left;
            width: 100%;
        }

        .intro-actions {
            justify-content: flex-start;
            margin-top: 12px;
            width: fit-content;
        }

        .intro-narration .actions {
            justify-content: flex-start;
        }

        .hero-main::after {
            content: "🌡️";
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
            justify-content: center;
            gap: 10px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .board-title {
            margin: 0;
            font-family: "Baloo 2", cursive;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            color: #23422c;
            text-align: center;
        }

        /* ===== SEQUENCE TRACK ===== */
        .sequence-track {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            position: relative;
            align-items: stretch;
            margin-bottom: 26px;
        }

        .seq-wrap {
            position: relative;
        }

        .seq-arrow {
            position: absolute;
            top: 50%;
            width: 56px;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, #86cf68, #f6ca58);
            box-shadow: 0 6px 12px rgba(77, 113, 51, .15);
            z-index: 0;
            transform: translateY(-50%);
        }

        .seq-arrow.one { left: calc(33.33% - 21px); }
        .seq-arrow.two { left: calc(66.66% - 34px); }

        .seq-arrow::after {
            content: "➜";
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 900;
            color: #4f7c2f;
        }

        .seq-card {
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

        .seq-head {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .seq-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 16px;
            font-weight: 900;
            box-shadow: inset 0 -3px 0 rgba(0,0,0,.08);
        }

        .seq-badge strong { font-size: 1rem; }
        .seq-badge .step-no {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255,255,255,.55);
            font-size: .72rem;
        }

        .cause { background: linear-gradient(180deg, #ffe386, #f3c53d); color: #52380b; }
        .effect { background: linear-gradient(180deg, #ffb772, #ef8f37); color: #58270b; }
        .solution { background: linear-gradient(180deg, #b8ea82, #81c948); color: #22431a; }

        .seq-slot {
            min-height: 190px;
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

        .seq-slot.filled {
            border-style: solid;
            box-shadow: inset 0 0 0 1px rgba(121, 171, 95, .16);
        }

        .seq-slot.slot-pop { animation: popIn .35s ease; }

        .seq-slot.spark::after {
            content: "✨";
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 1.1rem;
            animation: sparkle .7s ease;
        }

        .seq-slot.next-up {
            border-color: #62a74a;
            box-shadow: 0 0 0 4px rgba(116, 180, 86, .18);
            background: linear-gradient(180deg, #f7fff0, #eef8df);
        }

        .slot-note {
            margin: auto;
            text-align: center;
            color: #8a7b61;
            font-weight: 800;
            font-size: .84rem;
            max-width: 18ch;
        }

        .slot-placed-img {
            width: 100%;
            border-radius: 14px;
            display: block;
        }

        /* ===== CARD BANK ===== */
        .card-bank-panel {
            margin-top: 4px;
        }

        .bank-title {
            margin: 0 0 12px;
            font-size: .82rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 900;
            color: #42634b;
            text-align: center;
        }

        .bank-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .bank-card {
            position: relative;
            border-radius: 20px;
            border: 2px solid #a7cb9d;
            background: linear-gradient(180deg, #f4fbf2, #edf6e7);
            padding: 10px;
            cursor: pointer;
            transition: transform .14s ease, box-shadow .14s ease, opacity .18s ease;
            box-shadow: 0 10px 18px rgba(74, 76, 31, .08);
        }

        .bank-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 22px rgba(60, 72, 37, .14);
        }

        .bank-card:active { transform: translateY(0) scale(.98); }

        .bank-card img {
            width: 100%;
            border-radius: 14px;
            display: block;
        }

        .bank-card.wrong-card {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, .22), 0 10px 18px rgba(127, 29, 29, .24) !important;
            animation: wrongFlash .35s ease;
        }

        .bank-card.placed {
            opacity: 0;
            transform: scale(.85);
            pointer-events: none;
        }

        .bank-empty-note {
            grid-column: 1 / -1;
            text-align: center;
            color: #4e6f52;
            font-weight: 800;
            font-size: .9rem;
            padding: 18px 0;
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

        /* ----- Updated Reset Button: white fill, green border, green glow on hover ----- */
        .btn-reset {
            background: #ffffff;
            color: #2b5c2b;
            border: 2px solid #7cb86c;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 800;
            transition: all 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.04);
        }

        .btn-reset:hover {
            background: #ffffff;
            border-color: #4caf50;
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.25), 0 8px 16px rgba(46, 125, 50, 0.15);
            transform: translateY(-2px);
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 2000;
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
            max-width: 560px;
            width: 90%;
            border-radius: 36px;
            box-shadow: 0 30px 45px rgba(32, 58, 34, 0.4);
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
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-close {
            background: rgba(200, 220, 190, 0.6);
            border: none;
            font-size: 1.6rem;
            cursor: pointer;
            border-radius: 60px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: #3d694b;
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
            margin-top: 8px;
        }
        .modal-btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: 0.12s linear;
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
        @keyframes wrongFlash {
            0% { transform: scale(1); }
            35% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        @keyframes confettiFall {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(110vh) rotate(540deg); opacity: 0; }
        }
        @media (max-width: 760px) {
            .hero { grid-template-columns: 1fr; }
            .sequence-track { grid-template-columns: 1fr; }
            .seq-arrow { display: none; }
            .bank-grid { grid-template-columns: 1fr; }
            .seq-slot { min-height: 140px; }
        }
        @media (max-width: 640px) {
            .hero { padding: 8px 12px 16px; }
            .hero-main { padding: 16px; }
            .hero-side { margin-top: 0 !important; }
            .intro-layout {
                grid-template-columns: 110px 1fr;
                gap: 12px;
                align-items: start;
            }
            .intro-illustration {
                width: 100%;
                max-width: 110px;
                justify-self: center;
                align-self: center;
            }
            .intro-narration {
                text-align: left;
            }
            .intro-actions {
                justify-content: flex-end;
                position: static;
                bottom: auto;
                background: transparent;
                border: 0;
                padding: 0;
                z-index: auto;
            }
            .quest-card { padding: 10px 12px; }
            .quest-card h3 { font-size: 0.85rem; }
            .quest-card p { font-size: 0.8rem; }
            .actions { gap: 8px; }
            .btn { width: 100%; }
        }

        @media (max-width: 420px) {
            .intro-layout {
                grid-template-columns: 90px 1fr;
                gap: 10px;
                align-items: start;
            }
            .intro-illustration {
                max-width: 90px;
                justify-self: center;
            }
        }
    </style>
@endpush

@section('content')
    <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">
    <div class="page">
        <div class="quest-shell">
            <div class="topbar">
                <a class="back-link" href="{{ route('node3') }}">⬅ Bumalik</a>
                <div class="xp-rack">
                    <div class="xp-chip">🏆 Gawaing Pangkalikasan</div>
                </div>
            </div>

            <!-- INTRO STAGE -->
            <section class="hero" id="introStage">
                <div class="hero-main intro-layout">
                    <img src="{{ asset('pictures/teacher.png') }}" alt="Teacher" class="intro-illustration">
                    <div class="intro-narration">
                        <div class="eyebrow" style="display:inline-flex;">🌍 Interaktibong Gawain</div>
                        <h1 class="hero-title" style="font-size:clamp(1.4rem, 5vw, 2.3rem);">Climate Change <span>Quest</span></h1>
                        <p class="hero-copy" id="introText" style="margin:0 auto; max-width:100%;"></p>
                        <div class="actions intro-actions" style="margin-left:0;">
                            <button class="btn btn-primary" type="button" id="introNextBtn">Susunod</button>
                        </div>
                    </div>
                </div>
                <aside class="hero-side" style="margin-top:10px;">
                    <div class="quest-card">
                        <h3>🎯 Layunin</h3>
                        <p>Ayusin sa tamang pagkakasunod-sunod ang <strong>Sanhi</strong>, <strong>Bunga</strong>, at <strong>Solusyon</strong> ng climate change.</p>
                    </div>
                    <div class="quest-card">
                        <h3>📌 Paalala</h3>
                        <p>Tatlong larawan ang nasa ibaba. I-tap ang mga ito ayon sa tamang pagkakasunod-sunod ng kuwento: Sanhi, pagkatapos Bunga, saka Solusyon.</p>
                    </div>
                </aside>
            </section>

            <!-- GAME STAGE -->
            <section class="mission-grid" id="gameStage" style="display:none;">
                <div class="panel">
                    <div class="board-header">
                        <h2 class="board-title">Climate Change Quest</h2>
                    </div>

                    <!-- Sequence Track -->
                    <div class="sequence-track" id="sequenceTrack">
                        <div class="seq-arrow one"></div>
                        <div class="seq-arrow two"></div>

                        <div class="seq-wrap">
                            <div class="seq-card">
                                <div class="seq-head">
                                    <div class="seq-badge cause"><span class="step-no">1</span><strong>Sanhi</strong></div>
                                </div>
                                <div class="seq-slot next-up" data-zone="cause" data-order="0">
                                    <span class="slot-note">Tapin ang Sanhi</span>
                                </div>
                            </div>
                        </div>

                        <div class="seq-wrap">
                            <div class="seq-card">
                                <div class="seq-head">
                                    <div class="seq-badge effect"><span class="step-no">2</span><strong>Bunga</strong></div>
                                </div>
                                <div class="seq-slot" data-zone="effect" data-order="1">
                                    <span class="slot-note">Susunod na hakbang</span>
                                </div>
                            </div>
                        </div>

                        <div class="seq-wrap">
                            <div class="seq-card">
                                <div class="seq-head">
                                    <div class="seq-badge solution"><span class="step-no">3</span><strong>Solusyon</strong></div>
                                </div>
                                <div class="seq-slot" data-zone="solution" data-order="2">
                                    <span class="slot-note">Huling hakbang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Bank -->
                    <div class="card-bank-panel">
                        <p class="bank-title">👆 I-tap ang larawan na susunod sa kuwento</p>
                        <div class="bank-grid" id="cardBank"></div>
                    </div>

                    <!-- Ulitin Button (white fill, green border, green glow on hover) -->
                    <div class="actions" style="margin-top: 24px;">
                        <button class="btn btn-reset" id="resetGameBtn">🔄 Ulitin</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- MODAL -->
    <div id="completionModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-title">🎉 Tagumpay!</div>
                <button class="modal-close" id="closeModalBtn">✕</button>
            </div>
            <div class="modal-body">
                <div class="modal-feedback-text" id="modalFeedbackText"></div>
                <div class="modal-actions">
                    <a href="{{ route('inner.map2') }}" class="modal-btn modal-btn-primary" id="modalBackToMapBtn">🗺️ Bumalik sa Mapa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="confetti" id="confettiLayer"></div>
    <audio id="errorAudio" class="hidden-audio" preload="auto" src="{{ asset('audio/error.mp3') }}"></audio>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        const introStage = document.getElementById('introStage');
        const gameStage = document.getElementById('gameStage');
        const introText = document.getElementById('introText');
        const introNextBtn = document.getElementById('introNextBtn');
        const cardBank = document.getElementById('cardBank');
        const confettiLayer = document.getElementById('confettiLayer');
        const errorAudio = document.getElementById('errorAudio');
        const seqSlots = Array.from(document.querySelectorAll('.seq-slot'));
        const resetBtn = document.getElementById('resetGameBtn');

        const completionModal = document.getElementById('completionModal');
        const modalFeedbackText = document.getElementById('modalFeedbackText');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const nodeCompleteSfx = new Audio('/audio/nodecomplete.mp3');

        const lines = [
            'Magandang araw! Ako ang inyong guro. Pag-aaralan natin ang suliranin sa climate change o pagbabago ng klima.',
            'Ang climate change ay ang patuloy na pagtaas ng temperatura ng mundo dulot ng mga gawain ng tao.',
            'Ito ay nagdudulot ng matinding bagyo, pagbaha, tagtuyot, at pagkasira ng ating kalikasan.',
            'Ngayon, tingnan mo ang tatlong larawan sa ibaba at i-tap ang mga ito ayon sa tamang pagkakasunod-sunod: Sanhi, Bunga, saka Solusyon.'
        ];

        const SEQUENCE_ORDER = ['cause', 'effect', 'solution'];

        // Base items (will be cloned for reset)
        const BASE_ITEMS = [
            { type: 'image', src: "pictures/node3sanhi.png", zone: 'cause' },
            { type: 'image', src: "pictures/node3bunga.png", zone: 'effect' },
            { type: 'image', src: "pictures/node3solusyon.png", zone: 'solution' },
        ];

        let items = [];
        let completedRecords = [];
        let nextStepIndex = 0;
        let locked = false;

        const summaryMessage = `Magaling! Naunawaan mo ang sanhi, bunga, at solusyon ng climate change.\n\nAng climate change ay dulot ng pagsusunog ng fossil fuels, deforestation, at polusyon.\n\nDahil dito, nagkakaroon ng matinding pagbaha, pagguho ng lupa, at pagkawala ng biodiversity.\n\nNgunit may magagawa tayo. Sa pamamagitan ng pagtatanim ng puno, disaster preparedness, at paggamit ng renewable energy, mapoprotektahan natin ang ating planeta.\n\nTandaan—ang laban sa climate change ay nagsisimula sa bawat isa sa atin!`;

        let lineIndex = 0;
        let typingTimer = null;
        let isTyping = false;

        // ----- helpers -----
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function resetGameState() {
            // Reset items (shuffled)
            items = BASE_ITEMS.map(item => ({ ...item }));
            shuffleArray(items);
            completedRecords = [];
            nextStepIndex = 0;
            locked = false;

            // Clear slots
            seqSlots.forEach(slot => {
                slot.innerHTML = '';
                slot.classList.remove('filled', 'slot-pop', 'spark', 'next-up');
                const zone = slot.dataset.zone;
                if (zone === 'cause') {
                    slot.innerHTML = '<span class="slot-note">Tapin ang Sanhi</span>';
                } else if (zone === 'effect') {
                    slot.innerHTML = '<span class="slot-note">Susunod na hakbang</span>';
                } else if (zone === 'solution') {
                    slot.innerHTML = '<span class="slot-note">Huling hakbang</span>';
                }
            });

            // Re-render bank and update highlights
            renderBank();
            updateNextUpHighlight();
        }

        function showCompletionModal(message) {
            modalFeedbackText.innerText = message;
            completionModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            completionModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        closeModalBtn.addEventListener('click', closeModal);
        completionModal.addEventListener('click', (e) => {
            if (e.target === completionModal) closeModal();
        });

        function typeLine(text) {
            if (typingTimer) {
                clearInterval(typingTimer);
                typingTimer = null;
            }
            introText.textContent = '';
            let i = 0;
            isTyping = true;
            typingTimer = setInterval(() => {
                if (i < text.length) {
                    introText.textContent += text[i];
                    i++;
                } else {
                    clearInterval(typingTimer);
                    typingTimer = null;
                    isTyping = false;
                }
            }, 18);
        }

        function renderBank() {
            cardBank.innerHTML = '';

            if (items.length === 0) {
                const note = document.createElement('div');
                note.className = 'bank-empty-note';
                note.textContent = '✅ Nakumpleto ang lahat ng larawan!';
                cardBank.appendChild(note);
                return;
            }

            items.forEach((item, idx) => {
                const card = document.createElement('div');
                card.className = 'bank-card';
                card.dataset.index = String(idx);
                card.innerHTML = `<img src="/${item.src}" alt="Larawang kard">`;
                card.addEventListener('click', () => handleCardTap(idx, card));
                cardBank.appendChild(card);
            });
        }

        function updateNextUpHighlight() {
            seqSlots.forEach(slot => {
                const order = Number(slot.dataset.order);
                slot.classList.toggle('next-up', order === nextStepIndex && !slot.classList.contains('filled'));
            });
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
            setTimeout(() => {
                confettiLayer.innerHTML = '';
            }, 2200);
        }

        function playErrorSound() {
            if (errorAudio) {
                errorAudio.currentTime = 0;
                errorAudio.play().catch(() => {});
            }
        }

        // ----- intro navigation -----
        introNextBtn.addEventListener('click', () => {
            if (isTyping) return;

            if (lineIndex >= lines.length - 1) {
                introStage.style.display = 'none';
                gameStage.style.display = 'grid';
                resetGameState();
                return;
            }
            lineIndex += 1;
            typeLine(lines[lineIndex]);
            if (lineIndex === lines.length - 1) {
                introNextBtn.textContent = 'Simulan ang Gawain';
            }
        });

        // ----- card tap handler -----
        function handleCardTap(idx, cardEl) {
            if (locked) return;

            const tapped = items[idx];
            const expectedZone = SEQUENCE_ORDER[nextStepIndex];

            if (tapped.zone === expectedZone) {
                locked = true;

                // Store data
                let currentRecordIndex = 0;
                if (!completedRecords[currentRecordIndex]) {
                    completedRecords[currentRecordIndex] = {
                        problem_number: 1,
                        sanhi: '',
                        bunga: '',
                        solusyon: ''
                    };
                }
                if (tapped.zone === 'cause') completedRecords[currentRecordIndex].sanhi = tapped.src;
                if (tapped.zone === 'effect') completedRecords[currentRecordIndex].bunga = tapped.src;
                if (tapped.zone === 'solution') completedRecords[currentRecordIndex].solusyon = tapped.src;

                // Snap image into slot
                const targetSlot = seqSlots.find(s => s.dataset.zone === expectedZone);
                targetSlot.innerHTML = `<img class="slot-placed-img" src="/${tapped.src}" alt="Nailagay na larawan">`;
                targetSlot.classList.add('filled', 'slot-pop', 'spark');
                targetSlot.classList.remove('next-up');

                cardEl.classList.add('placed');

                setTimeout(() => {
                    targetSlot.classList.remove('slot-pop', 'spark');
                    items.splice(idx, 1);
                    nextStepIndex += 1;
                    locked = false;

                    if (nextStepIndex < SEQUENCE_ORDER.length) {
                        renderBank();
                        updateNextUpHighlight();
                    } else {
                        renderBank();
                        sessionStorage.setItem('node3_done', 'true');

                        nodeCompleteSfx.currentTime = 0;
                        nodeCompleteSfx.play().catch(e => console.log("Audio playback delayed or blocked"));

                        fetch("{{ route('student.module2.node3.save') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ records: completedRecords })
                        })
                        .then(async res => {
                            const data = await res.json();
                            if (!res.ok) {
                                console.error("Server Error:", data);
                                alert("Error saving data!");
                                return;
                            }
                            console.log("Saved Node3:", data);
                        })
                        .catch(err => {
                            console.error("Fetch Error:", err);
                        });

                        burstConfetti();
                        showCompletionModal(summaryMessage);
                    }
                }, 650);

            } else {
                locked = true;
                cardEl.classList.add('wrong-card');
                playErrorSound();
                setTimeout(() => {
                    cardEl.classList.remove('wrong-card');
                    locked = false;
                }, 420);
            }
        }

        // ----- reset button -----
        resetBtn.addEventListener('click', () => {
            if (locked) return;
            resetGameState();
            // Also reset any completion state
            completionModal.classList.remove('active');
            document.body.style.overflow = '';
        });

        // ----- init intro -----
        typeLine(lines[0]);
    </script>
@endsection