<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Node 1: Gawain sa Solid Waste</title>
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

    .drag-item.wrong-card {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 4px rgba(220, 38, 38, .22), 0 10px 18px rgba(127, 29, 29, .24) !important;
    animation: wrongFlash .35s ease;
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

    /* MODAL STYLES */
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
    .modal-overlay.active .modal-container {
        transform: scale(1);
    }
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
        transition: all 0.15s;
    }
    .modal-close:hover {
        background: #cfe2c6;
        transform: scale(1.02);
    }
    .modal-body {
        padding: 20px 24px 28px;
    }
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
        box-shadow: 0 5px 12px rgba(72, 128, 48, 0.25);
        border: none;
    }
    .modal-btn-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(100deg, #8edf6c, #62b848);
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

    @keyframes wrongFlash {
    0% { transform: scale(1); }
    35% { transform: scale(1.02); }
    100% { transform: scale(1); }
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
    .bank-items { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px; }
    .actions { position: sticky; bottom: 10px; background: rgba(255,255,255,.94); padding: 8px; border-radius: 14px; border: 1px solid #d9e8d0; z-index: 5; }
    .actions .btn { flex: 1 1 180px; min-height: 44px; font-size: .9rem; }
    .drag-item.text-item { min-height: 72px; font-size: .8rem; }
    .drag-item.image-item { min-height: 118px; }
    .thumb-wrap { min-height: 74px; }
    }

    @media (max-width: 520px) {
    .bank-items { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .hero {
            padding: 8px 12px 16px;
        }
        .hero-main {
            padding: 16px;
        }
        .quest-card {
            padding: 10px 12px;
        }
        .quest-card h3 {
            font-size: 0.85rem;
        }
        .quest-card p {
            font-size: 0.8rem;
        }
    }

    /* New Source Area for the 3 Starting Images */
    #cardSourceArea {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        background: rgba(255, 255, 255, 0.5);
        border: 2px dashed #b9d6b4;
        border-radius: 24px;
        padding: 20px;
        margin-bottom: 30px;
        min-height: 180px;
        align-items: center;
    }

    /* Red Flash for incorrect zones */
    .drop-zone.wrong-zone {
        border-color: #ff8d8d !important;
        background: linear-gradient(180deg, #fff5f5, #ffeaea) !important;
        animation: shake 0.4s ease-in-out;
    }

    /* Simple shake animation for errors */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Adjusting image sizing for the 3-column layout */
    .image-item {
        max-width: 100%;
        margin: 0 auto;
    }

    /* Ensure the Check Button stands out */
    #checkAnswersBtn {
        padding: 15px 40px;
        font-size: 1.1rem;
        box-shadow: 0 8px 20px rgba(78, 139, 64, 0.3);
    }

    /* Mobile optimization for the new source area */
    @media (max-width: 760px) {
        #cardSourceArea {
            grid-template-columns: 1fr;
            min-height: auto;
        }
    }
</style>
</head>
<body>
<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">
<div class="page">
    <div class="quest-shell">
        <div class="topbar">
            <a class="back-link" href="{{ route('node1.solid-waste') }}">⬅ Bumalik</a>
            <div class="xp-rack">
                <div class="xp-chip">🏆 Gawaing Pangkalikasan</div>
                <div class="xp-chip" id="missionCount">0 / 6 Tama</div>
            </div>
        </div>

        <section class="hero" id="introStage">
            <div class="hero-main" style="display:flex; flex-direction:column; align-items:center; gap:20px;">
                <img src="{{ asset('pictures/teacher.png') }}" alt="Teacher" style="width:min(180px, 60%); max-width:220px; object-fit:contain; filter: drop-shadow(0 12px 20px rgba(0,0,0,.18));">
                <div style="text-align:center; width:100%;">
                    <div class="eyebrow" style="display:inline-flex;">🌍 Interaktibong Gawain</div>
                    <h1 class="hero-title" style="font-size:clamp(1.4rem, 5vw, 2.3rem);">Gabay sa <span>Solid Waste</span></h1>
                    <p class="hero-copy" id="introText" style="margin:0 auto; max-width:100%;"></p>
                    <div class="actions" style="justify-content:center; margin-top:20px;">
                        <button class="btn btn-primary" type="button" id="introNextBtn">Susunod</button>
                    </div>
                </div>
            </div>
            <aside class="hero-side" style="margin-top:10px;">
                <div class="quest-card">
                    <h3>🎯 Layunin</h3>
                    <p>Tukuyin ang tamang <strong>Sanhi</strong>, <strong>Bunga</strong>, at <strong>Solusyon</strong> gamit ang dating daloy ng gawain.</p>
                </div>
                <div class="quest-card">
                    <h3>📌 Paalala</h3>
                    <p>I-drag ang kasalukuyang card papunta sa tamang zone. May image cards at hiwalay na text cards.</p>
                </div>
            </aside>
        </section>

        <section class="mission-grid" id="gameStage" style="display:none;">
            <div class="panel">
                <div class="board-header">
                    <h2 class="board-title">Sanhi → Bunga → Solusyon</h2>
                    <div class="board-sub">Ayusin ang mga larawan sa tamang hanay</div>
                </div>

                <div id="cardSourceArea" style="display:flex; justify-content:center; gap:20px; margin-bottom:30px; min-height: 150px; border: 2px dashed #ccc; padding: 15px; border-radius: 15px;">
                    </div>

                <div class="flow-layout">
                    <div class="zone-wrap">
                        <div class="zone-card">
                            <div class="zone-head">
                                <div class="zone-badge cause"><strong>🌟 Sanhi</strong></div>
                            </div>
                            <div class="drop-zone" data-zone="cause"></div>
                        </div>
                    </div>

                    <div class="zone-wrap">
                        <div class="zone-card">
                            <div class="zone-head">
                                <div class="zone-badge effect"><strong>🔥 Bunga</strong></div>
                            </div>
                            <div class="drop-zone" data-zone="effect"></div>
                        </div>
                    </div>

                    <div class="zone-wrap">
                        <div class="zone-card">
                            <div class="zone-head">
                                <div class="zone-badge solution"><strong>🌿 Solusyon</strong></div>
                            </div>
                            <div class="drop-zone" data-zone="solution"></div>
                        </div>
                    </div>
                </div>

                <div style="text-align:center; margin-top:30px;">
                    <button class="btn btn-primary" id="checkAnswersBtn">I-check ang Sagot</button>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- MODAL for completion -->
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
                <a href="{{ route('node2') }}" class="modal-btn" id="modalContinueBtn">Magpatuloy</a>
            </div>
        </div>
    </div>
</div>

<div class="confetti" id="confettiLayer"></div>
<audio id="summaryAudio" class="hidden-audio" preload="auto" src="{{ asset('audio/node1_summary.mp3') }}"></audio>
<audio id="errorAudio" class="hidden-audio" preload="auto" src="{{ asset('audio/error.mp3') }}"></audio>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // 1. KEEP THESE VARIABLES
    const introStage = document.getElementById('introStage');
    const gameStage = document.getElementById('gameStage');
    const introText = document.getElementById('introText');
    const introNextBtn = document.getElementById('introNextBtn');
    const missionCount = document.getElementById('missionCount');
    const confettiLayer = document.getElementById('confettiLayer');
    const summaryAudio = document.getElementById('summaryAudio');
    const errorAudio = document.getElementById('errorAudio');
    
    const completionModal = document.getElementById('completionModal');
    const modalFeedbackText = document.getElementById('modalFeedbackText');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // 2. KEEP THESE HELPER FUNCTIONS (Needed for the game to work)
    function showCompletionModal(message) {
        modalFeedbackText.innerText = message;
        completionModal.classList.add('active');
    }

    function closeModal() {
        completionModal.classList.remove('active');
    }

    function typeLine(text) {
        introText.textContent = '';
        let i = 0;
        let timer = setInterval(() => {
            if (i < text.length) {
                introText.textContent += text[i];
                i++;
            } else { clearInterval(timer); }
        }, 18);
    }

    function burstConfetti() {
        // ... (Keep your existing burstConfetti code here) ...
    }

    function playErrorSound() {
        if (errorAudio) { errorAudio.currentTime = 0; errorAudio.play().catch(() => {}); }
    }

    const lines = [
        'Magandang araw! Ako ang inyong guro. Pag-aaralan natin ang suliranin sa solid waste.',
        'Sa komunidad, maling pagtatapon ng basura ang madalas na sanhi ng problema.',
        'Kapag barado ang kanal, nagkakaroon ng pagbaha at pagdami ng sakit.',
        'Ngayon, i-drag ang bawat card sa tamang zone: Sanhi, Bunga, o Solusyon.'
    ];

    const summaryMessage = `Magaling! Natukoy mo ang tamang ugnayan ng sanhi, bunga, at solusyon...`;

    // 3. REPLACE EVERYTHING BELOW THIS WITH THE NEW CODE
    const items = [
        { id: 'img1', src: "{{ asset('pictures/node1sanhi.png') }}", zone: 'cause' },
        { id: 'img2', src: "{{ asset('pictures/node1bunga.png') }}", zone: 'effect' },
        { id: 'img3', src: "{{ asset('pictures/node1solution.png') }}", zone: 'solution' }
    ];

    const cardSourceArea = document.getElementById('cardSourceArea');
    const checkBtn = document.getElementById('checkAnswersBtn');
    const dropZones = document.querySelectorAll('.drop-zone');
    let draggedElement = null;
    let lineIndex = 0;

    function initGame() {
        cardSourceArea.innerHTML = '';
        dropZones.forEach(zone => {
            zone.innerHTML = '';
            zone.classList.remove('filled', 'wrong-zone');
        });

        const shuffled = [...items].sort(() => Math.random() - 0.5);

        shuffled.forEach(item => {
            const card = document.createElement('div');
            card.className = 'drag-item image-item';
            card.setAttribute('draggable', 'true');
            card.id = item.id;
            card.dataset.correctZone = item.zone;
            card.style.width = "150px";

            card.innerHTML = `
                <div class="thumb-wrap" style="min-height:100px;">
                    <img class="thumb" src="${item.src}" style="pointer-events: none;">
                </div>
            `;

            card.addEventListener('dragstart', () => { draggedElement = card; card.classList.add('dragging'); });
            card.addEventListener('dragend', () => { card.classList.remove('dragging'); });
            cardSourceArea.appendChild(card);
        });
    }

    // Drag/Drop Listeners
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', e => e.preventDefault());
        zone.addEventListener('drop', e => {
            e.preventDefault();
            if (draggedElement) {
                if (zone.children.length > 0) cardSourceArea.appendChild(zone.children[0]);
                zone.appendChild(draggedElement);
                zone.classList.add('filled');
            }
        });
    });

    cardSourceArea.addEventListener('dragover', e => e.preventDefault());
    cardSourceArea.addEventListener('drop', e => {
        e.preventDefault();
        if (draggedElement) cardSourceArea.appendChild(draggedElement);
    });

    checkBtn.addEventListener('click', () => {
        let allCorrect = true;
        let placedCount = 0;

        dropZones.forEach(zone => {
            zone.classList.remove('wrong-zone'); // Reset visual error
            if (zone.children.length > 0) {
                placedCount++;
                if (zone.children[0].dataset.correctZone !== zone.dataset.zone) {
                    allCorrect = false;
                    zone.classList.add('wrong-zone'); 
                }
            } else { allCorrect = false; }
        });

        if (placedCount < 3) {
            alert("Paki-lagay ang lahat ng larawan sa mga zone.");
            return;
        }

        if (allCorrect) {
            burstConfetti();
            showCompletionModal(summaryMessage);
            if (summaryAudio) summaryAudio.play();
        } else {
            playErrorSound();
            alert("May mali sa iyong pagkakaayos. Subukan muli!");
            setTimeout(initGame, 500); // Restart game
        }
    });

    introNextBtn.addEventListener('click', () => {
        if (lineIndex >= lines.length - 1) {
            introStage.style.display = 'none';
            gameStage.style.display = 'grid';
            initGame();
            return;
        }
        lineIndex += 1;
        typeLine(lines[lineIndex]);
    });

    closeModalBtn.addEventListener('click', closeModal);
    typeLine(lines[0]);
</script>
</body>
</html>