@extends('Students.studentslayout')
@section('title', 'Module 2 : Node 2 - Activity')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Baloo+2:wght@600;700;800&display=swap');

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
        opacity: 0.3;
    }

    html, body {
        scroll-behavior: smooth;
        background:
            radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
            radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
            radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
            linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
        background-attachment: fixed;
        color: var(--text);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .page {
        max-width: 1280px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        padding: 20px;
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
    .panel {
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
        content: "🌳";
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
        text-align: center;
    }

    .board-title {
        margin: 0;
        font-family: "Baloo 2", cursive;
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        color: #23422c;
        text-align: center;
    }

    /* ===== DROP ZONE STYLES WITH ARROWS ===== */
    .flow-layout {
        display: grid;
        grid-template-columns: 1fr auto 1fr auto 1fr;
        gap: 12px;
        position: relative;
        align-items: stretch;
        margin-top: 30px;
    }

    .flow-arrow-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
    }

    .flow-arrow {
        font-size: 2rem;
        color: #8cc68a;
        opacity: 0.6;
        font-weight: 300;
        animation: pulseArrow 1.5s ease-in-out infinite;
    }

    @keyframes pulseArrow {
        0%, 100% { opacity: 0.4; transform: translateX(0); }
        50% { opacity: 0.8; transform: translateX(4px); }
    }

    .zone-wrap {
        position: relative;
        flex: 1;
    }

    .zone-card {
        position: relative;
        z-index: 1;
        background: rgba(255,255,255,0.7);
        border: 1px solid #d6e6cb;
        border-radius: 20px;
        padding: 16px;
        min-height: 100%;
        box-shadow: 0 8px 20px rgba(55, 93, 52, .06);
        display: flex;
        flex-direction: column;
        transition: all 0.2s ease;
    }

    .zone-card .zone-label {
        font-family: "Baloo 2", cursive;
        font-size: 1.3rem;
        color: #23422c;
        margin-bottom: 8px;
        text-align: center;
    }

    .drop-zone {
        min-height: 160px;
        border-radius: 16px;
        border: 2px dashed #c5d8c0;
        background: rgba(252,255,248,0.6);
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
        position: relative;
        flex: 1;
        cursor: pointer;
    }

    /* Socket / port dot at the top of each zone — this is what the
       connecting line visually plugs into, so the two ends read as one
       continuous connector instead of a line floating near a box. */
    .drop-zone::before {
        content: '';
        position: absolute;
        top: -9px;
        left: 50%;
        transform: translateX(-50%);
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #c5d8c0;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #c5d8c0, 0 2px 6px rgba(0,0,0,.12);
        transition: all 0.25s ease;
        z-index: 3;
    }

    .drop-zone.highlight::before {
        background: #7cae6a;
        box-shadow: 0 0 0 3px #7cae6a, 0 0 16px rgba(124, 174, 106, .55);
        transform: translateX(-50%) scale(1.1);
    }

    .drop-zone.hover-target::before {
        background: #4a9e3a;
        box-shadow: 0 0 0 4px #4a9e3a, 0 0 22px rgba(74, 158, 58, .6);
        transform: translateX(-50%) scale(1.25);
    }

    .drop-zone.correct-zone::before {
        background: #22c55e;
        box-shadow: 0 0 0 3px #22c55e, 0 0 20px rgba(34, 197, 94, .6);
        transform: translateX(-50%) scale(1.2);
    }

    .drop-zone.wrong-zone::before {
        background: #ef4444;
        box-shadow: 0 0 0 3px #ef4444, 0 0 20px rgba(239, 68, 68, .6);
    }

    .drop-zone.has-item::before {
        background: #22c55e;
        box-shadow: 0 0 0 3px #22c55e;
        transform: translateX(-50%) scale(1);
    }

    .drop-zone .drop-icon {
        font-size: 2rem;
        opacity: 0.3;
        transition: all 0.3s ease;
    }

    .drop-zone .drop-text {
        color: #a8bca3;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .drop-zone.has-item {
        border-style: solid;
        border-color: #b8d0b2 !important;
        background: transparent !important;
        padding: 0 !important;
    }

    .drop-zone.has-item .drop-icon,
    .drop-zone.has-item .drop-text {
        display: none;
    }

    .drop-zone.highlight {
        border-color: #62a74a;
        background: rgba(234, 248, 223, 0.8);
        transform: scale(1.02);
        box-shadow: 0 0 0 4px rgba(98, 167, 74, 0.12);
    }

    /* ===== ACTIVE CARD WITH CONNECTING LINE ===== */
    .card-with-line {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        overflow: visible;
    }

    .active-card-wrapper {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: center;
        padding-bottom: 20px;
        cursor: default;
        transition: transform 0.2s ease;
    }

    .active-card-wrapper.selected {
        transform: scale(1.02);
    }

    .active-card-wrapper.selected .drag-item {
        border-color: #62a74a;
        box-shadow: 0 0 0 4px rgba(98, 167, 74, 0.15);
    }

    .active-card-wrapper .drag-item {
        max-width: 380px;
        width: 100%;
        min-height: 100px;
        margin: 0 auto;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Connection Point (Circle) on the card */
    .connection-point {
        position: absolute;
        bottom: -14px;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #7cae6a;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #7cae6a, 0 2px 8px rgba(0,0,0,0.15);
        z-index: 10;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .connection-point::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        opacity: 0.6;
    }

    .active-card-wrapper.selected .connection-point {
        background: #4a9e3a;
        box-shadow: 0 0 0 4px #4a9e3a, 0 0 30px rgba(74, 158, 58, 0.5);
        transform: translateX(-50%) scale(1.15);
    }

    /* SVG Line Container */
    .line-svg-container {
        position: absolute;
        top: -20px;
        left: 0;
        width: 100%;
        height: calc(100% + 40px);
        pointer-events: none;
        z-index: 5;
        overflow: visible;
    }

    .connection-line {
        stroke: #7cae6a;
        stroke-width: 3.5;
        fill: none;
        opacity: 0;
        transition: opacity 0.4s ease;
        stroke-linecap: round;
    }

    .connection-line.visible {
        opacity: 1;
        stroke-dasharray: 10, 8;
        animation: dashFlow 0.9s linear infinite;
    }

    .connection-line.correct {
        stroke: #22c55e;
        stroke-width: 4.5;
        stroke-dasharray: none;
        opacity: 1;
        animation: none;
        filter: drop-shadow(0 0 8px rgba(34, 197, 94, 0.4));
    }

    .connection-line.wrong {
        stroke: #ef4444;
        stroke-width: 4.5;
        stroke-dasharray: none;
        opacity: 1;
        animation: none;
        filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.4));
    }

    /* Line end point (circle at zone) */
    .line-end-point {
        fill: #7cae6a;
        r: 8;
        opacity: 0;
        transition: opacity 0.3s ease;
        stroke: white;
        stroke-width: 2;
    }

    .line-end-point.visible {
        opacity: 1;
    }

    .line-end-point.correct {
        fill: #22c55e;
        r: 10;
        stroke: #22c55e;
        stroke-width: 3;
        filter: drop-shadow(0 0 10px rgba(34, 197, 94, 0.5));
    }

    .line-end-point.wrong {
        fill: #ef4444;
        r: 10;
        stroke: #ef4444;
        stroke-width: 3;
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.5));
    }

    @keyframes dashFlow {
        to {
            stroke-dashoffset: -18;
        }
    }

    /* ===== DRAG ITEMS ===== */
    .drag-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        border-radius: 16px;
        cursor: default;
        user-select: none;
        box-shadow: 0 8px 16px rgba(60, 72, 37, .08);
        overflow: hidden;
        background: white;
        border: 2px solid #d6e6cb;
        padding: 16px;
        gap: 8px;
        min-height: 100px;
        text-align: center;
        transition: transform 0.2s ease;
    }

    .drag-item .item-emoji {
        font-size: 2.5rem;
        line-height: 1.2;
    }

    .drag-item .item-text {
        font-weight: 700;
        font-size: 0.9rem;
        color: #2a4a35;
        line-height: 1.4;
    }

    .drag-item img {
        max-height: 150px;
        object-fit: contain;
        width: 100%;
    }

    /* ===== STATUS ANIMATIONS ===== */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-8px); }
        40% { transform: translateX(8px); }
        60% { transform: translateX(-5px); }
        80% { transform: translateX(5px); }
    }

    @keyframes pop {
        0% { transform: scale(0.95); }
        50% { transform: scale(1.06); }
        100% { transform: scale(1); }
    }

    .drop-zone.wrong-zone {
        border-color: #ef4444 !important;
        background: #fff5f5 !important;
        animation: shake 0.5s ease-in-out;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
    }

    .drop-zone.correct-zone {
        border-color: #22c55e !important;
        background: #f0fdf4 !important;
        animation: pop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.15);
    }

    .active-card-wrapper.shake-item {
        animation: shake 0.5s ease-in-out;
    }

    .active-card-wrapper.shake-item .drag-item {
        border-color: #ef4444 !important;
        background: #fff5f5 !important;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.25);
    }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-enter {
        animation: slideUpFade 0.4s ease-out forwards;
    }

    /* ===== DECK AREA ===== */
    .deck-area {
        background: rgba(255,255,255,0.6);
        border-radius: 20px;
        border: 2px solid #d6e6cb;
        padding: 20px;
        margin-bottom: 10px;
        min-height: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: visible;
    }

    .deck-area .deck-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 12px;
        padding: 0 4px;
    }

    .deck-area .deck-label {
        font-weight: 800;
        font-size: 0.85rem;
        color: #4a6a53;
        letter-spacing: 0.03em;
    }

    .deck-area .deck-counter {
        font-weight: 800;
        font-size: 0.85rem;
        color: #4a6a53;
        background: rgba(255,255,255,0.7);
        padding: 4px 14px;
        border-radius: 999px;
        border: 1px solid #d6e6cb;
    }

    /* ===== ACTIONS ===== */
    .actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 16px;
    }

    .btn {
        border: none;
        border-radius: 16px;
        padding: 12px 28px;
        font-weight: 800;
        font-size: .9rem;
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

    .btn-reset {
        background: white;
        color: #4a6a53;
        border: 2px solid #d6e6cb;
        padding: 12px 32px;
        font-weight: 800;
        font-size: 0.9rem;
        border-radius: 50px;
        transition: all 0.2s ease;
    }

    .btn-reset:hover {
        background: #f5f9f2;
        border-color: #a7c891;
        transform: translateY(-2px);
    }

    /* ===== MODAL ===== */
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

    .hidden-audio { display: none; }

    @keyframes confettiFall {
        0% { transform: translateY(0) rotate(0deg); opacity: 1; }
        100% { transform: translateY(110vh) rotate(540deg); opacity: 0; }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1080px) {
        .hero,
        .mission-grid { grid-template-columns: 1fr; }
        .drop-zone { min-height: 120px; }
    }

    @media (max-width: 768px) {
        .flow-layout {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-top: 20px;
        }
        .flow-arrow-wrapper {
            padding: 4px 0;
            transform: rotate(90deg);
        }
        .flow-arrow {
            font-size: 1.5rem;
        }
        .drop-zone { min-height: 100px; }
        .hero { padding: 8px 12px 16px; }
        .hero-main { padding: 16px; }
        .intro-layout { grid-template-columns: 100px 1fr; gap: 12px; }
        .intro-illustration { max-width: 100px; }
        .page { padding: 10px; }
        .deck-area .drag-item { max-width: 100%; }
        .deck-area { padding: 16px; }
        .zone-card .zone-label { font-size: 1.1rem; }
        .drag-item .item-emoji { font-size: 2rem; }
        .drag-item .item-text { font-size: 0.8rem; }
        .board-title { font-size: 1.4rem; }
        .actions .btn { flex: 1 1 140px; min-height: 44px; font-size: .85rem; }
        .btn-reset { padding: 10px 24px; font-size: 0.85rem; }
        .active-card-wrapper .drag-item { max-width: 100%; }
        .line-svg-container { display: none; }
        .connection-point { display: none; }
    }

    @media (max-width: 420px) {
        .intro-layout { grid-template-columns: 80px 1fr; gap: 10px; }
        .intro-illustration { max-width: 80px; }
        .drop-zone { min-height: 80px; }
        .deck-area .deck-label { font-size: 0.75rem; }
        .deck-area .deck-counter { font-size: 0.75rem; padding: 3px 10px; }
        .line-svg-container { display: none; }
        .connection-point { display: none; }
    }
</style>
@endpush

@section('content')
    <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">
    <div class="page">
        <div class="quest-shell">
            <div class="topbar">
                <a class="back-link" href="{{ route('node2') }}">⬅ Bumalik</a>
                <div class="xp-rack">
                    <div class="xp-chip">🏆 Gawaing Pangkalikasan</div>
                </div>
            </div>

            <!-- INTRO SECTION -->
            <section class="hero" id="introStage">
                <div class="hero-main intro-layout">
                    <img src="{{ asset('pictures/teacher.png') }}" alt="Teacher" class="intro-illustration">
                    <div class="intro-narration">
                        <div class="eyebrow" style="display:inline-flex;">🌍 Interaktibong Gawain</div>
                        <h1 class="hero-title" style="font-size:clamp(1.4rem, 5vw, 2.3rem);">Deforestation <span>Quest</span></h1>
                        <p class="hero-copy" id="introText" style="margin:0 auto; max-width:100%;"></p>
                        <div class="actions intro-actions" style="margin-left:0;">
                            <button class="btn btn-primary" type="button" id="introNextBtn">Susunod</button>
                        </div>
                    </div>
                </div>

                <aside class="hero-side" style="margin-top:10px;">
                    <div class="quest-card">
                        <h3>🎯 Layunin</h3>
                        <p>Tukuyin ang tamang <strong>Sanhi</strong>, <strong>Bunga</strong>, at <strong>Solusyon</strong> ng deforestation.</p>
                    </div>

                    <div class="quest-card">
                        <h3>📌 Paalala</h3>
                        <p>I-tap na lang ang tamang kahon — Sanhi, Bunga, o Solusyon — kung saan dapat ilagay ang larawan.</p>
                    </div>
                </aside>
            </section>

            <!-- GAME SECTION -->
            <section class="mission-grid" id="gameStage" style="display:none;">
                <div class="panel">
                    <div class="board-header">
                        <h2 class="board-title">Deforestation Quest</h2>
                    </div>

                    <!-- Deck Area with Active Card and Line -->
                    <div class="deck-area" id="deckArea">
                        <div class="deck-header">
                            <span class="deck-label">🎴 KASALUKUYANG KARD</span>
                            <span class="deck-counter" id="cardsLeftBadge">Natitira: 3</span>
                        </div>
                        <div class="card-with-line" id="cardWithLine" style="width:100%; position:relative; overflow:visible;">
                            <div class="active-card-wrapper" id="activeCardWrapper">
                                <div class="drag-item image-item card-enter" id="activeImageCard" style="display:flex;">
                                    <div style="width:100%; min-height:80px; display:flex; align-items:center; justify-content:center; border-radius:12px; overflow:hidden; background:rgba(255,255,255,0.8);">
                                        <img class="thumb" id="activeCardImg" alt="Larawang kard ng gawain" src="" style="max-height:150px; object-fit:contain; width:100%;">
                                    </div>
                                </div>
                                <div class="drag-item text-item card-enter" id="activeTextCard" style="display:none; min-height:80px;"></div>
                                <!-- Connection Point (Circle) at bottom of card -->
                                <div class="connection-point" id="connectionPoint"></div>
                            </div>
                            <!-- SVG Line Container for connection lines -->
                            <svg class="line-svg-container" id="lineSvg" style="position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:5; overflow:visible;">
                                <defs>
                                    <filter id="glowGreen">
                                        <feGaussianBlur stdDeviation="3" result="blur"/>
                                        <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                    </filter>
                                    <filter id="glowRed">
                                        <feGaussianBlur stdDeviation="3" result="blur"/>
                                        <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                    </filter>
                                    <marker id="arrowDefault" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
                                        <path d="M0,0 L10,5 L0,10 z" fill="#7cae6a"/>
                                    </marker>
                                    <marker id="arrowCorrect" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
                                        <path d="M0,0 L10,5 L0,10 z" fill="#22c55e"/>
                                    </marker>
                                    <marker id="arrowWrong" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
                                        <path d="M0,0 L10,5 L0,10 z" fill="#ef4444"/>
                                    </marker>
                                </defs>
                                <path class="connection-line" id="connectionLine" d="" marker-end="url(#arrowDefault)" />
                                <circle class="line-end-point" id="lineEndPoint" cx="0" cy="0" r="6" />
                            </svg>
                        </div>
                    </div>

                    <!-- Drop Zones with Arrows -->
                    <div class="flow-layout" id="flowLayout">
                        <!-- Zone 1: Sanhi -->
                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-label">Sanhi</div>
                                <div class="drop-zone" data-zone="cause" id="zoneCause">
                                    <div class="drop-icon">📥</div>
                                    <div class="drop-text">Ilagay ang Sanhi rito</div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow 1 -->
                        <div class="flow-arrow-wrapper">
                            <span class="flow-arrow">➔</span>
                        </div>

                        <!-- Zone 2: Bunga -->
                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-label">Bunga</div>
                                <div class="drop-zone" data-zone="effect" id="zoneEffect">
                                    <div class="drop-icon">📥</div>
                                    <div class="drop-text">Ilagay ang Bunga rito</div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow 2 -->
                        <div class="flow-arrow-wrapper">
                            <span class="flow-arrow">➔</span>
                        </div>

                        <!-- Zone 3: Solusyon -->
                        <div class="zone-wrap">
                            <div class="zone-card">
                                <div class="zone-label">Solusyon</div>
                                <div class="drop-zone" data-zone="solution" id="zoneSolution">
                                    <div class="drop-icon">📥</div>
                                    <div class="drop-text">Ilagay ang Solusyon rito</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="actions">
                        <button class="btn-reset" id="resetBtn">🔄 Ulitin</button>
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
        (function() {
            const introStage = document.getElementById('introStage');
            const gameStage = document.getElementById('gameStage');
            const introText = document.getElementById('introText');
            const introNextBtn = document.getElementById('introNextBtn');
            const activeImageCard = document.getElementById('activeImageCard');
            const activeTextCard = document.getElementById('activeTextCard');
            const activeCardImg = document.getElementById('activeCardImg');
            const cardsLeftBadge = document.getElementById('cardsLeftBadge');
            const dropZones = Array.from(document.querySelectorAll('.drop-zone'));
            const resetBtn = document.getElementById('resetBtn');
            const connectionLine = document.getElementById('connectionLine');
            const lineEndPoint = document.getElementById('lineEndPoint');
            const connectionPoint = document.getElementById('connectionPoint');
            const activeCardWrapper = document.getElementById('activeCardWrapper');
            const cardWithLine = document.getElementById('cardWithLine');
            const flowLayout = document.getElementById('flowLayout');
            const confettiLayer = document.getElementById('confettiLayer');
            const errorAudio = document.getElementById('errorAudio');

            // Modal elements
            const completionModal = document.getElementById('completionModal');
            const modalFeedbackText = document.getElementById('modalFeedbackText');
            const closeModalBtn = document.getElementById('closeModalBtn');

            // Audio
            const nodeCompleteSfx = new Audio('/audio/nodecomplete.mp3');

            let completedRecords = [];
            let lineIndex = 0;
            let itemIndex = 0;
            let typingTimer = null;
            let isProcessing = false;
            let placedItems = [];
            let selectedCard = null;

            const lines = [
                'Magandang araw! Ako ang inyong guro. Pag-aaralan natin ang suliranin sa deforestation o pagkakalbo ng kagubatan.',
                'Ang deforestation ay ang patuloy na pagputol ng mga puno nang walang sapat na kapalit.',
                'Ito ay nagdudulot ng pagbaha, pagguho ng lupa, at pagkawala ng tirahan ng mga hayop.',
                'Ngayon, i-tap na lang ang tamang kahon — Sanhi, Bunga, o Solusyon — kung saan dapat ilagay ang larawan.'
            ];

            const items = [
                { type: 'image', src: "{{ asset('pictures/node2sanhi.png') }}", zone: 'cause', emoji: '🪓', text: 'Illegal logging at labis na pagputol ng puno.' },
                { type: 'image', src: "{{ asset('pictures/node2bunga.png') }}", zone: 'effect', emoji: '🌊', text: 'Pagbaha, soil erosion, at pagkawala ng tirahan ng hayop.' },
                { type: 'image', src: "{{ asset('pictures/node2solusyon.png') }}", zone: 'solution', emoji: '🌱', text: 'Pagtatanim ng puno at responsableng paggamit ng kalikasan.' }
            ];

            const summaryMessage = `Magaling! Naunawaan mo ang sanhi, bunga, at solusyon ng pagkakalbo ng kagubatan.\n\nAng deforestation ay dulot ng illegal logging at labis na paggamit ng lupa.\n\nDahil dito, nagkakaroon ng pagbaha, soil erosion, at pagkawala ng tirahan ng mga hayop at halaman.\n\nNgunit may magagawa tayo. Sa pamamagitan ng pagtatanim ng puno, pagsunod sa batas, at responsableng paggamit ng kalikasan, mapoprotektahan natin ang ating kagubatan.\n\nTandaan—ang kalikasan ay buhay, kaya ito ay dapat pangalagaan!`;

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            function initializeAndShuffleItems() {
                shuffleArray(items);
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
                typingTimer = setInterval(() => {
                    if (i < text.length) {
                        introText.textContent += text[i];
                        i++;
                    } else {
                        clearInterval(typingTimer);
                        typingTimer = null;
                    }
                }, 18);
            }

            function getActiveElement() {
                const current = items[itemIndex];
                return current.type === 'image' ? activeImageCard : activeTextCard;
            }

            function updateCard() {
                const item = items[itemIndex];
                const remaining = items.length - itemIndex - placedItems.length;
                cardsLeftBadge.textContent = `Natitira: ${remaining}`;

                if (item.type === 'image') {
                    activeImageCard.style.display = 'flex';
                    activeTextCard.style.display = 'none';
                    activeCardImg.src = item.src;
                    activeImageCard.dataset.zone = item.zone;
                    activeImageCard.innerHTML = `
                        <div style="width:100%; min-height:80px; display:flex; align-items:center; justify-content:center; border-radius:12px; overflow:hidden; background:rgba(255,255,255,0.8);">
                            <img src="${item.src}" style="max-height:150px; object-fit:contain; width:100%;">
                        </div>
                    `;
                } else {
                    activeImageCard.style.display = 'none';
                    activeTextCard.style.display = 'flex';
                    activeTextCard.innerHTML = `
                        <div class="item-emoji">${item.emoji || '📄'}</div>
                        <div class="item-text">${item.text}</div>
                    `;
                    activeTextCard.dataset.zone = item.zone;
                }

                // The active card is always the one "selected" one — no tap
                // needed. Highlight the empty zones and start the connection
                // point pulsing right away so the player can just point at a
                // zone.
                selectedCard = item;
                activeCardWrapper.classList.add('selected');
                dropZones.forEach(z => {
                    if (!z.classList.contains('has-item')) z.classList.add('highlight');
                });
                connectionPoint.style.animation = 'none';
                setTimeout(() => {
                    connectionPoint.style.animation = 'pulsePoint 1s ease-in-out infinite';
                }, 10);
                hideLine();
            }

            // ===== LINE DRAWING FUNCTIONS - FIXED ALIGNMENT =====
            // Both the card's connection point and each zone's center must be
            // measured against the SAME reference element as the <svg> itself,
            // which is #cardWithLine (the svg is absolutely positioned inside it
            // with top:0; left:0; width:100%; height:100%). Measuring against
            // #flowLayout instead — as the previous version did — put every
            // coordinate off by the offset between flowLayout's and
            // cardWithLine's bounding boxes, which is why the line never lined
            // up with the card or the zone it was supposedly pointing at.
            function getCardConnectionPoint() {
                const containerRect = cardWithLine.getBoundingClientRect();
                // Use the circle's own rendered position rather than estimating
                // it from the card's box — the circle is offset from the card
                // by the wrapper's padding-bottom plus its own "bottom" offset,
                // so guessing that math led the line to start below/above the
                // actual dot. Reading its real rect guarantees a perfect match.
                const dotRect = connectionPoint.getBoundingClientRect();

                return {
                    x: (dotRect.left + dotRect.width / 2) - containerRect.left,
                    y: (dotRect.top + dotRect.height / 2) - containerRect.top
                };
            }

            function getZoneCenter(zoneElement) {
                const containerRect = cardWithLine.getBoundingClientRect();
                const zoneRect = zoneElement.getBoundingClientRect();

                // Land on the zone's socket dot (top-center, see .drop-zone::before),
                // not the middle of the box — that's what makes the line read as
                // "plugged into" the zone rather than just pointing near it.
                return {
                    x: (zoneRect.left + zoneRect.width / 2) - containerRect.left,
                    y: zoneRect.top - containerRect.top
                };
            }

            function drawLine(targetZone) {
                const start = getCardConnectionPoint();
                const end = getZoneCenter(targetZone);

                // Straight line, start to end — from the connection-point
                // circle on the card directly to the zone's socket.
                const d = `M ${start.x} ${start.y} L ${end.x} ${end.y}`;

                connectionLine.setAttribute('d', d);
                connectionLine.setAttribute('marker-end', 'url(#arrowDefault)');
                connectionLine.classList.add('visible');
                connectionLine.classList.remove('correct', 'wrong');

                // Show end point at the zone
                lineEndPoint.setAttribute('cx', end.x);
                lineEndPoint.setAttribute('cy', end.y);
                lineEndPoint.classList.add('visible');
                lineEndPoint.classList.remove('correct', 'wrong');
            }

            function hideLine() {
                connectionLine.classList.remove('visible', 'correct', 'wrong');
                connectionLine.setAttribute('marker-end', 'url(#arrowDefault)');
                lineEndPoint.classList.remove('visible', 'correct', 'wrong');
                dropZones.forEach(z => z.classList.remove('hover-target'));
            }

            function markLineCorrect() {
                connectionLine.classList.remove('wrong');
                connectionLine.classList.add('correct');
                connectionLine.setAttribute('marker-end', 'url(#arrowCorrect)');
                lineEndPoint.classList.remove('wrong');
                lineEndPoint.classList.add('correct');
                setTimeout(() => {
                    connectionLine.classList.remove('correct');
                    connectionLine.classList.remove('visible');
                    lineEndPoint.classList.remove('correct');
                    lineEndPoint.classList.remove('visible');
                }, 800);
            }

            function markLineWrong() {
                connectionLine.classList.remove('correct');
                connectionLine.classList.add('wrong');
                connectionLine.setAttribute('marker-end', 'url(#arrowWrong)');
                lineEndPoint.classList.remove('correct');
                lineEndPoint.classList.add('wrong');
                setTimeout(() => {
                    connectionLine.classList.remove('wrong');
                    connectionLine.classList.remove('visible');
                    lineEndPoint.classList.remove('wrong');
                    lineEndPoint.classList.remove('visible');
                }, 600);
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
                    confettiLayer.appendChild(piece);
                }
                setTimeout(() => { confettiLayer.innerHTML = ''; }, 2200);
            }

            function playErrorSound() {
                if (errorAudio) {
                    errorAudio.currentTime = 0;
                    errorAudio.play().catch(() => {});
                }
            }

            function saveData() {
                fetch("{{ route('student.module2.node2.save') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ records: completedRecords })
                })
                .then(res => res.json())
                .then(data => console.log("Saved Node2:", data))
                .catch(err => console.error("Error:", err));
            }

            function resetGame() {
                itemIndex = 0;
                completedRecords = [];
                placedItems = [];
                isProcessing = false;
                selectedCard = null;

                // Clear all drop zones
                dropZones.forEach(zone => {
                    zone.classList.remove('has-item', 'wrong-zone', 'correct-zone', 'highlight');
                    zone.innerHTML = `
                        <div class="drop-icon">📥</div>
                        <div class="drop-text">Ilagay ang ${zone.dataset.zone === 'cause' ? 'Sanhi' : zone.dataset.zone === 'effect' ? 'Bunga' : 'Solusyon'} rito</div>
                    `;
                });

                // Reset active card display
                activeImageCard.style.display = 'flex';
                activeTextCard.style.display = 'none';
                activeCardWrapper.classList.remove('selected', 'shake-item');

                // Shuffle items and update card
                shuffleArray(items);
                hideLine();
                updateCard();

                // Close modal if open
                closeModal();
            }

            // ===== INTRO =====
            introNextBtn.addEventListener('click', () => {
                if (lineIndex >= lines.length - 1) {
                    introStage.style.display = 'none';
                    gameStage.style.display = 'grid';
                    resetGame();
                    return;
                }
                lineIndex += 1;
                typeLine(lines[lineIndex]);
                if (lineIndex === lines.length - 1) {
                    introNextBtn.textContent = 'Simulan ang Gawain';
                }
            });

            // ===== RESET =====
            resetBtn.addEventListener('click', resetGame);

            // ===== POINT TO MATCH: CARD IS ALWAYS SELECTED, JUST TAP/HOVER A ZONE =====
            // (No click-to-select needed — updateCard() auto-selects the
            // current card the moment it's shown.)

            // Desktop: live-preview the connector as you move between zones,
            // so the line always terminates on a real socket rather than
            // floating in empty space.
            dropZones.forEach(zone => {
                zone.addEventListener('mouseenter', () => {
                    if (!selectedCard || isProcessing || zone.classList.contains('has-item')) return;
                    dropZones.forEach(z => z.classList.remove('hover-target'));
                    zone.classList.add('hover-target');
                    drawLine(zone);
                });

                zone.addEventListener('mouseleave', () => {
                    if (isProcessing) return;
                    zone.classList.remove('hover-target');
                    if (selectedCard) {
                        hideLine();
                    }
                });
            });

            // Add pulse animation for connection point
            const styleSheet = document.createElement('style');
            styleSheet.textContent = `
                @keyframes pulsePoint {
                    0%, 100% { transform: translateX(-50%) scale(1); box-shadow: 0 0 0 3px #7cae6a, 0 2px 8px rgba(0,0,0,0.15); }
                    50% { transform: translateX(-50%) scale(1.2); box-shadow: 0 0 0 6px #4a9e3a, 0 0 40px rgba(74, 158, 58, 0.4); }
                }
            `;
            document.head.appendChild(styleSheet);

            // Click on drop zones to place the selected card
            dropZones.forEach(zone => {
                zone.addEventListener('click', (e) => {
                    if (isProcessing) return;
                    if (itemIndex >= items.length) return;
                    if (zone.classList.contains('has-item')) return;
                    if (!selectedCard) {
                        // If no card selected, prompt to select first
                        zone.classList.add('wrong-zone');
                        setTimeout(() => zone.classList.remove('wrong-zone'), 400);
                        return;
                    }

                    const current = items[itemIndex];
                    const droppedZone = zone.dataset.zone;

                    // Draw line from card to this zone
                    drawLine(zone);

                    if (droppedZone === current.zone) {
                        // Correct!
                        isProcessing = true;
                        zone.classList.add('correct-zone');
                        markLineCorrect();

                        // Store data
                        let value = current.type === 'image'
                            ? current.src.replace(window.location.origin + '/', '')
                            : current.text;

                        if (!completedRecords[0]) {
                            completedRecords[0] = {
                                problem_number: 1,
                                sanhi: '',
                                bunga: '',
                                solusyon: ''
                            };
                        }

                        if (current.zone === 'cause') {
                            completedRecords[0].sanhi = value;
                        }
                        if (current.zone === 'effect') {
                            completedRecords[0].bunga = value;
                        }
                        if (current.zone === 'solution') {
                            completedRecords[0].solusyon = value;
                        }

                        // Clone card into zone
                        const activeEl = getActiveElement();
                        const snapCard = activeEl.cloneNode(true);
                        snapCard.style.cursor = 'default';
                        snapCard.style.border = '2px solid #22c55e';
                        zone.innerHTML = '';
                        zone.appendChild(snapCard);
                        zone.classList.add('has-item');
                        placedItems.push(current.zone);

                        // Deselect and clear highlights
                        selectedCard = null;
                        activeCardWrapper.classList.remove('selected');
                        dropZones.forEach(z => z.classList.remove('highlight'));
                        connectionPoint.style.animation = '';

                        // Move to next item
                        setTimeout(() => {
                            itemIndex += 1;
                            isProcessing = false;

                            if (itemIndex < items.length) {
                                updateCard();
                                // Check if all items are placed
                                if (placedItems.length === 3) {
                                    sessionStorage.setItem('node2_done', 'true');
                                    nodeCompleteSfx.currentTime = 0;
                                    nodeCompleteSfx.play().catch(() => {});
                                    saveData();
                                    burstConfetti();
                                    showCompletionModal(summaryMessage);
                                    activeImageCard.style.display = 'none';
                                    activeTextCard.style.display = 'none';
                                    cardsLeftBadge.textContent = '✅ Kumpleto na';
                                }
                            } else {
                                sessionStorage.setItem('node2_done', 'true');
                                nodeCompleteSfx.currentTime = 0;
                                nodeCompleteSfx.play().catch(() => {});
                                saveData();
                                burstConfetti();
                                showCompletionModal(summaryMessage);
                                activeImageCard.style.display = 'none';
                                activeTextCard.style.display = 'none';
                                cardsLeftBadge.textContent = '✅ Kumpleto na';
                            }
                        }, 800);

                    } else {
                        // Wrong!
                        isProcessing = true;
                        zone.classList.add('wrong-zone');
                        activeCardWrapper.classList.add('shake-item');
                        markLineWrong();
                        playErrorSound();

                        setTimeout(() => {
                            zone.classList.remove('wrong-zone');
                            activeCardWrapper.classList.remove('shake-item');
                            isProcessing = false;
                            // Don't deselect the card, let user try again
                            // But hide the line
                            hideLine();
                        }, 600);
                    }
                });
            });


            // Window resize handler: if a line is currently anchored to a
            // hovered zone, redraw it against the zone's new position.
            let resizeTimeout = null;
            window.addEventListener('resize', () => {
                const hoveredZone = dropZones.find(z => z.classList.contains('hover-target'));
                if (selectedCard && hoveredZone && connectionLine.classList.contains('visible')) {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(() => drawLine(hoveredZone), 200);
                }
            });

            initializeAndShuffleItems();
            typeLine(lines[0]);
        })();
    </script>
@endsection