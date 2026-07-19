@extends('Students.studentslayout')
@section('title', 'Hamon at Tugon: Module 3 Panghuling Pagsusulit')

@push('styles')
<style>
    :root {
        --bg-1: #fffaf3;
        --bg-2: #fff3df;
        --card: rgba(255, 255, 255, 0.94);
        --text: #3d2a1a;
        --muted: #7a6143;
        --accent: #6dbf7e;
        --accent-dark: #4da862;
        --accent-soft: #eefaf1;
        --warm: #f4c97a;
        --wrong-soft: #fff3e6;
        --wrong-border: #efc48f;
        --shadow: 0 14px 38px rgba(100, 73, 33, 0.12);
        --radius-xl: 24px;
        --radius-lg: 18px;
        --radius-md: 14px;
    }

    * {
        box-sizing: border-box;
    }

    html, body {
        background: #060b16;
        background-image: 
            radial-gradient(circle at 8% 8%, rgba(0, 242, 255, 0.1), transparent 24%),
            radial-gradient(circle at 90% 14%, rgba(57, 255, 20, 0.08), transparent 20%),
            linear-gradient(rgba(160, 190, 230, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(160, 190, 230, 0.04) 1px, transparent 1px);
        background-size: auto, auto, 34px 34px, 34px 34px;
        color: var(--ink-1);
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        touch-action: pan-y;
    }

    .background-map {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        z-index: -1;
    }

    .main-wrapper {
        display: block;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .pretest-wrap {
        width: 100%;
        max-width: 880px;
        margin: 0 auto;
    }

    .pretest-card {
        position: relative;
        background: var(--card);
        backdrop-filter: blur(10px);
        border-radius: 28px;
        box-shadow: var(--shadow);
        padding: 22px;
        border: 1px solid rgba(230, 208, 175, 0.7);
        overflow: hidden;
    }

    .pretest-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(255,255,255,0.35), rgba(255,255,255,0));
        pointer-events: none;
    }

    .pretest-header {
        text-align: center;
        margin-bottom: 16px;
        position: relative;
        z-index: 2;
    }

    .pretest-header .header-icons {
        font-size: 1.2rem;
        letter-spacing: 3px;
        margin-bottom: 4px;
    }

    .pretest-header .subtitle {
        font-size: 0.85rem;
        font-weight: 800;
        color: var(--muted);
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .pretest-header h1 {
        font-family: "Baloo 2", cursive;
        font-size: clamp(1.9rem, 3.5vw, 2.5rem);
        margin: 6px 0 4px;
        color: var(--text);
        line-height: 1.1;
    }

    .pretest-header p {
        color: var(--muted);
        font-weight: 700;
        margin-top: 6px;
        font-size: 0.94rem;
    }

    .pretest-note {
        background: linear-gradient(180deg, #fffaf0 0%, #fff4df 100%);
        border: 1px solid #efd9b3;
        color: #6e5233;
        border-radius: 16px;
        padding: 12px 14px;
        font-size: 0.92rem;
        margin-bottom: 16px;
        font-weight: 700;
        text-align: center;
    }

    .quiz-page {
        display: block;
        position: relative;
        z-index: 2;
    }

    .quiz-page.hidden {
        display: none !important;
    }

    .quiz-progress {
        max-width: 520px;
        margin: 0 auto 18px;
    }

    .progress-topline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }
    
    .progress-center {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .progress-label {
        font-size: 0.84rem;
        font-weight: 900;
        color: var(--muted);
        letter-spacing: 0.4px;
    }

    .progress-mini-badge {
        font-size: 0.78rem;
        font-weight: 800;
        color: #5b472f;
        background: #fff7ea;
        border: 1px solid #efd9b3;
        padding: 5px 10px;
        border-radius: 999px;
    }

    .progress-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .progress-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #dfd2c3;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .progress-dot.completed {
        background: var(--accent);
        transform: scale(1.15);
    }

    .progress-dot.active {
        background: #57ba77;
        transform: scale(1.45);
        box-shadow: 0 0 10px rgba(109, 191, 126, 0.45);
    }

    .progress-track {
        width: 100%;
        height: 10px;
        border-radius: 999px;
        background: #eadfcd;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(135deg, var(--accent), var(--accent-dark));
        border-radius: inherit;
        transition: width 0.35s ease;
    }

    .flashcard-stage {
        position: relative;
        min-height: 360px;
        perspective: 1200px;
    }

    .question-list {
        display: block;
        position: relative;
        min-height: 360px;
    }

    .question-item {
        position: relative;
        background:
            linear-gradient(180deg, #ffffff 0%, #fffdf9 100%);
        border: 1px solid #eadcc5;
        border-radius: 24px;
        padding: 18px;
        min-height: 360px;
        box-shadow: 0 12px 30px rgba(91, 66, 33, 0.08);
        overflow: hidden;
    }

    .question-item::after {
        content: "";
        position: absolute;
        top: -60px;
        right: -60px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(109,191,126,0.13) 0%, rgba(109,191,126,0) 68%);
        pointer-events: none;
    }

    .card-chip-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .card-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 900;
        background: #fff7ea;
        color: #694d30;
        border: 1px solid #efd9b3;
    }

    .card-tip {
        font-size: 0.78rem;
        font-weight: 800;
        color: var(--muted);
    }

    .question-item h4 {
        color: var(--text);
        margin-bottom: 16px;
        margin-top: 8px;
        line-height: 1.6;
        font-size: 1.05rem;
        font-weight: 900;
        padding-right: 18px;
    }

    .choices {
        display: grid;
        gap: 12px;
    }

    .choice {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: 1px solid #e7d7bf;
        border-radius: 16px;
        padding: 11px 12px;
        cursor: pointer;
        transition: border-color 0.22s, background-color 0.22s, transform 0.18s, box-shadow 0.18s;
        background: #fff;
        position: relative;
    }

    .choice:hover {
        border-color: #d4a574;
        background: #fffaf1;
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(170, 124, 67, 0.08);
    }

    .choice.selected {
        border-color: var(--accent);
        background: #f3fbf5;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(109, 191, 126, 0.12);
    }

    .choice.confirmed {
        border-color: var(--accent);
        background: #e8f5eb;
        position: relative;
    }

    .choice.confirmed::after {
        content: "✓";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--accent);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .choice.correct-reveal {
        border-color: var(--accent);
        background: #f1fbf4;
        box-shadow: 0 0 0 3px rgba(109, 191, 126, 0.12);
    }

    .choice.soft-wrong {
        border-color: var(--wrong-border);
        background: var(--wrong-soft);
    }

    .choice input {
        margin-top: 4px;
        accent-color: var(--accent);
        cursor: pointer;
        transform: scale(1.05);
    }

    .choice span {
        color: #4e3823;
        font-size: 0.93rem;
        line-height: 1.45;
        font-weight: 700;
    }

    .reaction-box {
        margin-top: 14px;
        min-height: 64px;
        border-radius: 16px;
        padding: 12px 14px;
        font-weight: 800;
        font-size: 0.92rem;
        display: flex;
        align-items: center;
        gap: 10px;
        opacity: 0;
        transform: translateY(8px);
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .reaction-box.show {
        opacity: 1;
        transform: translateY(0);
    }

    .reaction-box.correct {
        background: linear-gradient(180deg, #eefaf1 0%, #e4f7ea 100%);
        border: 1px solid #bfe3c8;
        color: #2f6c44;
    }

    .reaction-box.gentle {
        background: linear-gradient(180deg, #fff8ef 0%, #fff2df 100%);
        border: 1px solid #efd2a7;
        color: #7a5a2e;
    }

    .reaction-emoji {
        font-size: 1.25rem;
        line-height: 1;
        flex-shrink: 0;
    }

    .action-row {
        margin-top: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .action-row.hidden {
        display: none !important;
    }

    .btn-primary,
    .btn-secondary,
    .btn-confirm {
        border: none;
        outline: none;
        text-decoration: none;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-width: 160px;
        padding: 11px 16px;
        border-radius: 14px;
        font-size: 0.92rem;
        font-family: "Baloo 2", cursive;
        font-weight: 800;
        cursor: pointer;
        transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-dark));
        color: #fff;
        box-shadow: 0 10px 22px rgba(77, 168, 98, 0.22);
    }

    .btn-primary:hover:not([disabled]),
    .btn-secondary:hover:not([disabled]),
    .btn-confirm:hover:not([disabled]) {
        transform: translateY(-2px);
    }

    .btn-primary[disabled],
    .btn-secondary[disabled],
    .btn-confirm[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-secondary {
        background: #fff;
        color: #4c3a26;
        border: 2px solid #d7c4a3;
        box-shadow: 0 8px 18px rgba(120, 90, 50, 0.08);
    }

    .btn-confirm {
        background: linear-gradient(135deg, #f4c97a, #e5b55c);
        color: #4a2f14;
        box-shadow: 0 10px 22px rgba(244, 201, 122, 0.3);
    }

    .result-page {
        display: none;
        max-width: 560px;
        margin: 12px auto 0;
    }

    .result-page.show {
        display: block;
        animation: fadePop 0.45s ease;
    }

    .result-box {
        display: none;
        margin-top: 14px;
        border-radius: 24px;
        border: 2px solid rgba(109, 191, 126, 0.28);
        background: linear-gradient(180deg, #fffdf7 0%, #f6efe2 100%);
        color: var(--text);
        padding: 18px 16px;
        text-align: center;
        font-weight: 800;
        box-shadow: 0 14px 32px rgba(91, 66, 33, 0.1);
    }

    .result-box.show {
        display: block;
    }

    .result-title {
        font-family: "Baloo 2", cursive;
        font-size: clamp(1.55rem, 3.4vw, 2rem);
        color: var(--text);
        margin-bottom: 10px;
    }

    .result-ring {
        --progress: 0;
        width: 160px;
        height: 160px;
        margin: 0 auto 10px;
        border-radius: 50%;
        background: conic-gradient(#57ba77 calc(var(--progress) * 1%), #d9e8dc 0);
        display: grid;
        place-items: center;
        position: relative;
        box-shadow: inset 0 0 12px rgba(0,0,0,0.04);
    }

    .result-ring::before {
        content: "";
        width: 122px;
        height: 122px;
        border-radius: 50%;
        background: linear-gradient(180deg, #fffdf8 0%, #f2eadf 100%);
        position: absolute;
        inset: 0;
        margin: auto;
    }

    .result-percent {
        position: relative;
        z-index: 1;
        font-size: 1.7rem;
        font-weight: 900;
        color: #2f6c44;
    }

    .result-score {
        font-size: 1rem;
        font-weight: 800;
        color: #4c3a26;
        margin-top: 4px;
    }

    .result-subtext {
        margin-top: 6px;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--muted);
    }

    .result-feedback {
        margin-top: 6px;
        font-size: 0.9rem;
        font-weight: 800;
        color: #6f5538;
    }

    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 900;
        margin-top: 8px;
        background: #eefaf1;
        color: #2f6c44;
        border: 1px solid #bfe3c8;
    }

    .result-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    .back-button {
        position:fixed;
        top: 80px; 
        left:20px;
        z-index: 999; 
        background:white;
        padding:10px 15px;
        border-radius:8px;
        text-decoration:none;
        font-weight:bold;
        box-shadow:0 4px 8px rgba(0,0,0,0.2);
    }

    .back-button:hover {
        transform: scale(1.06);
    }

    .confirm-pending {
        animation: pulseBorder 1.5s ease-in-out infinite;
    }

    .unanswered-highlight {
        background-color: #fff3df !important;
        transition: background-color 0.5s ease;
        border-radius: 16px;
        padding: 12px;
        border: 2px solid #f4c97a;
    }

    .attempts-disabled {
        position: relative;
    }

    .attempts-disabled .quiz-page {
        pointer-events: none;
        opacity: 0.5;
    }

    .attempts-disabled .quiz-page.hidden {
        display: none !important;
    }

    .attempts-message {
        display: none;
        text-align: center;
        padding: 30px;
        background: #fff5f5;
        border: 2px solid #e5a5a5;
        border-radius: 20px;
        margin: 20px 0;
    }

    .attempts-message.show {
        display: block;
    }

    .attempts-message h3 {
        color: #7a2e2e;
        margin-bottom: 10px;
    }

    .last-score-box {
        display: none;
        background: #f0f7ff;
        border: 2px solid #b8d4f0;
        border-radius: 16px;
        padding: 30px 20px;
        margin: 20px 0;
        text-align: center;
    }

    .last-score-box.show {
        display: block;
    }

    .last-score-box .score-number {
        font-size: 3rem;
        font-weight: 900;
        color: #2c6b9e;
    }

    .last-score-box .score-label {
        font-size: 1.1rem;
        color: #4a6a8a;
        margin-top: 5px;
    }

    .last-score-box .score-badge {
        margin: 10px 0;
    }

    .no-attempts-actions {
        display: none;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .no-attempts-actions.show {
        display: flex;
    }

    .retry-indicator {
        text-align: center;
        font-size: 0.85rem;
        font-weight: 900;
        color: #5b472f;
        background: #fff7ea;
        border: 1px solid #efd9b3;
        padding: 6px 12px;
        border-radius: 999px;
        margin-top: 10px;
        display: inline-block;
    }

    @keyframes pulseBorder {
        0%, 100% { border-color: #e7d7bf; }
        50% { border-color: #f4c97a; }
    }

    @media (max-width: 768px) {
        body {
            overflow: auto;
        }

        .pretest-card {
            padding: 14px;
            border-radius: 22px;
        }

        .question-item {
            padding: 15px;
            min-height: 340px;
        }

        .flashcard-stage,
        .question-list {
            min-height: 340px;
        }

        .action-row {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary,
        .btn-confirm {
            width: 100%;
        }

        .result-ring {
            width: 140px;
            height: 140px;
        }

        .result-ring::before {
            width: 106px;
            height: 106px;
        }

        .result-percent {
            font-size: 1.42rem;
        }

        .back-button {
            top: 12px;
            left: 12px;
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        .last-score-box .score-number {
            font-size: 2.2rem;
        }
    }

    .card-slide-in-right {
        animation: slideInRight 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .card-slide-in-left {
        animation: slideInLeft 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .card-slide-in-up {
        animation: slideInUp 0.42s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .pulse-pop {
        animation: pulsePop 0.45s ease;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(60px) rotate(0.7deg) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateX(0) rotate(0) scale(1);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-60px) rotate(-0.7deg) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateX(0) rotate(0) scale(1);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(42px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes fadePop {
        from {
            opacity: 0;
            transform: translateY(18px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes pulsePop {
        0% { transform: scale(0.98); }
        50% { transform: scale(1.015); }
        100% { transform: scale(1); }
    }

    .confetti-piece {
        position: fixed;
        top: -20px;
        width: 10px;
        height: 16px;
        border-radius: 3px;
        opacity: 0.95;
        z-index: 9999;
        pointer-events: none;
        animation: confettiFall linear forwards;
    }

    @keyframes confettiFall {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(110vh) rotate(720deg);
            opacity: 0;
        }
    }

    @keyframes rewardPop {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(61, 42, 26, 0.4);
        backdrop-filter: blur(8px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .modal-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-box {
        background: #ffffff;
        padding: 30px;
        border-radius: 28px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(230, 208, 175, 0.5);
    }

    .reward-container {
        background: #f0fdf4;
        border: 2px dashed #6dbf7e;
        border-radius: 20px;
        padding: 20px;
        margin: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .reward-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--accent-dark);
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }

    .reward-image {
        width: 100%;
        max-width: 200px;
        height: auto;
        border-radius: var(--radius-md);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        animation: rewardPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s backwards;
    }

    .reward-image:hover {
        transform: scale(1.05) rotate(2deg);
    }

    .modal-box {
        max-width: 450px;
        width: 90%;
    }

    .modal-box h2 {
        font-family: "Baloo 2", cursive;
        margin-bottom: 10px;
    }

    .modal-box p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #5b472f;
        margin-bottom: 25px;
        text-align: justify;
    }

    .single-question {
        margin-bottom: 28px;
        padding-bottom: 18px;
        border-bottom: 1px dashed #e7d7bf;
    }

    .single-question:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')

<img src="{{ asset('pictures/mod3_innermap.png') }}" class="background-map">

<a href="{{ route('inner.map3') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
    <div class="pretest-wrap">
        <div class="pretest-card" id="pretestCard">
            <div class="pretest-header">
                <div class="header-icons">🧭 🗺️ ✨</div>
                <div class="subtitle">Module 3</div>
                <h1>PANGHULING PAGSUSULIT</h1>
                <p>Panuto: Basahin at suriin ang bawat sitwasyon. Piliin ang titik ng pinakaangkop na sagot.</p>
            </div>

            <div class="pretest-note">
                💡 Kailangang makakuha ng 13/15 upang makapasa.
            </div>

            <!-- Last Score Display (shown when no attempts left) -->
            <div class="last-score-box" id="lastScoreBox">
                <div style="font-size: 1.2rem; margin-bottom: 8px;">📊 Ang iyong pinakamataas na iskor:</div>
                <div class="score-number" id="lastScoreNumber">0/15</div>
                <div class="score-label" id="lastScoreLabel">Nakumpleto mo na ang panghuling pagsusulit.</div>
                
                <!-- No Attempts Actions -->
                <div class="no-attempts-actions" id="noAttemptsActions">
                    <a href="{{ route('student.module3.performance-task') }}" class="btn-primary" style="min-width: 200px;">
                        ➡️ Magpatuloy sa Performance Task
                    </a>
                </div>
            </div>

            <!-- Attempts Message -->
            <div class="attempts-message" id="attemptsMessage">
                <h3>⏰ Naabot mo na ang maximum na 2 attempts</h3>
                <p>Hindi ka na makakapag-ulit ng panghuling pagsusulit.</p>
            </div>

            <form id="preTestForm">
                <div class="quiz-page" id="quizPage">
                    <div class="quiz-progress">
                        <div class="progress-topline">
                            <div class="progress-label" id="quizProgressLabel"></div>
                        </div>

                        <div class="progress-center">
                            <div class="progress-mini-badge" id="answeredCountLabel">0 / 15 answered</div>
                        </div>

                        <div class="progress-dots" id="progressDots"></div>
                    </div>

                    <div class="flashcard-stage">
                        <div class="question-list" id="questionList"></div>
                    </div>

                    <div class="action-row" id="actionRow">
                        <button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmAnswer()">✓ Kumpirmahin</button>
                        <button type="button" class="btn-primary" id="nextCardBtn" onclick="goNextCard()" style="display:none;">
                            Susunod →
                        </button>
                        <button type="button" class="btn-primary" id="submitBtn" onclick="submitPostTest()" style="display:none;">Tapusin ang Panghuling Pagsusulit 🚀</button>
                    </div>
                </div>

                <div class="result-page" id="resultPage" aria-live="polite">
                    <div class="result-box show" id="resultBox">
                        <div class="result-title">Resulta ng Panghuling Pagsusulit</div>
                        <div class="result-ring" id="resultRing" style="--progress:0;">
                            <div class="result-percent" id="resultPercent">0/0</div>
                        </div>
                        <div class="result-score" id="resultScoreText"></div>
                        <div class="badge-pill" id="resultBadge"></div>
                        <div class="result-feedback" id="resultFeedback"></div>
                        
                        <div class="retry-indicator" id="retryIndicator">
                            🔁 Natitirang attempts: 2 / 2
                        </div>

                        <div class="result-actions" id="resultActions">
                            <button type="button" class="btn-secondary" id="retryBtn" onclick="restartQuiz()">Ulitin ang Panghuling Pagsusulit</button>
                            <a href="{{ route('inner.map3') }}" class="btn-primary">Magpatuloy →</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- PASS MODAL -->
    <div id="passModal" class="modal-overlay">
        <div class="modal-box">
            <h2>🎉 Mahusay!</h2>
            
            <p>
                Mahusay! Ipinapakita ng iyong resulta na nauunawaan mo na ang mga konsepto ng hazard, vulnerability, at risk, 
                pati na rin ang iba't ibang estratehiya sa pagtugon sa mga panganib at sakuna. 
                Nawa'y magamit mo ang iyong natutunan upang maging aktibong kalahok sa pagbuo ng mas ligtas at handang komunidad.
            </p>

            <a href="{{ route('student.module3.performance-task') }}" class="btn-primary">
                Magpatuloy sa Performance Task ✍️
            </a>
        </div>
    </div>
</div>

<x-vn />

<script>
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function shuffleQuestionsAndChoices() {
        shuffleArray(questions);

        questions.forEach(q => {
            const optionKeys = Object.keys(q.options);
            const optionTexts = optionKeys.map(key => q.options[key]);

            shuffleArray(optionTexts);

            const newOptions = {};
            optionKeys.forEach((key, index) => {
                newOptions[key] = optionTexts[index];
            });

            const correctAnswerText = q.options[q.answer];
            const newAnswerKey = Object.keys(newOptions).find(
                key => newOptions[key] === correctAnswerText
            );

            q.options = newOptions;
            q.answer = newAnswerKey;
        });
    }

    const questions = [
        {
            question: 'Isang barangay ang madalas bahain dahil sa lokasyon nito malapit sa ilog. Ano ang pinakaangkop na paliwanag batay sa risk concept?',
            options: {
                a: 'Mataas ang exposure at vulnerability kaya tumataas ang risk',
                b: 'Mababa ang hazard kaya hindi dapat mag-alala ang komunidad',
                c: 'Mataas ang resilience kaya walang magiging pinsala',
                d: 'Mababa ang population kaya hindi ito magiging problema'
            },
            answer: 'a'
        },
        {
            question: 'Sa isang komunidad, may early warning system ngunit hindi ito pinapansin ng mga residente. Ano ang posibleng epekto?',
            options: {
                a: 'Tataas ang pinsala dahil hindi agad nakapaghahanda ang mga tao',
                b: 'Bababa ang hazard dahil may sistema ng babala sa lugar',
                c: 'Mawawala ang risk dahil may teknolohiya ang komunidad',
                d: 'Mapipigilan ang sakuna dahil may warning system'
            },
            answer: 'a'
        },
        {
            question: 'Alin sa mga sumusunod ang nagpapakita ng ugnayan ng hazard at vulnerability?',
            options: {
                a: 'Malakas na bagyo at mahihinang bahay sa komunidad',
                b: 'Maraming puno at malinis na kapaligiran sa lugar',
                c: 'Mataas na gusali at maayos na drainage system',
                d: 'Sapat na kaalaman at kahandaan ng mamamayan'
            },
            answer: 'a'
        },
        {
            question: 'Bakit mahalaga ang pagkakaroon ng emergency kit bago ang sakuna?',
            options: {
                a: 'Nakakatulong ito upang matugunan ang agarang pangangailangan sa oras ng sakuna',
                b: 'Nakakapigil ito sa pagdating ng sakuna sa komunidad',
                c: 'Nakakabawas ito sa lakas ng hazard sa kapaligiran',
                d: 'Nakakapigil ito sa pagtaas ng tubig sa baha'
            },
            answer: 'a'
        },
        {
            question: 'Sa panahon ng bagyo, bakit mahalaga ang maagang paglikas kung kinakailangan?',
            options: {
                a: 'Naiiwasan ang panganib bago pa lumala ang sitwasyon',
                b: 'Napipigilan ang pagdating ng bagyo sa komunidad',
                c: 'Nababawasan ang lakas ng hangin sa kapaligiran',
                d: 'Napapahinto ang pagtaas ng tubig sa ilog'
            },
            answer: 'a'
        },
        {
            question: 'Alin ang nagpapakita ng resilience ng isang pamilya matapos ang sakuna?',
            options: {
                a: 'Muling pagbangon at pag-aayos ng tahanan matapos ang pinsala',
                b: 'Pag-alis sa komunidad at hindi na pagbabalik muli',
                c: 'Pag-iwas sa pakikilahok sa mga gawaing pangkomunidad',
                d: 'Pagdepende lamang sa tulong mula sa pamahalaan'
            },
            answer: 'a'
        },
        {
            question: 'Isang komunidad ang aktibong nakikilahok sa disaster drills at planning. Ano ang ipinapakita nito?',
            options: {
                a: 'Mataas na kapasidad at kahandaan ng komunidad sa sakuna',
                b: 'Mataas na vulnerability ng mga mamamayan sa lugar',
                c: 'Mababang risk dahil walang hazard sa kanilang lugar',
                d: 'Kawalan ng suporta mula sa pamahalaan'
            },
            answer: 'a'
        },
        {
            question: 'Ano ang pinakaangkop na halimbawa ng structural risk?',
            options: {
                a: 'Mahinang gusali na madaling masira sa lindol',
                b: 'Kakulangan ng kaalaman ng mga tao sa komunidad',
                c: 'Pagkakaroon ng bagyo sa isang rehiyon',
                d: 'Pagtaas ng tubig sa ilog matapos ang ulan'
            },
            answer: 'a'
        },
        {
            question: 'Sa CBDRRM, bakit mahalaga ang partisipasyon ng komunidad?',
            options: {
                a: 'Nakakatulong ito sa pagbuo ng angkop at epektibong plano',
                b: 'Napapalitan nito ang papel ng pamahalaan sa lahat ng gawain',
                c: 'Nababawasan nito ang responsibilidad ng mga mamamayan',
                d: 'Napipigilan nito ang pagdating ng hazard'
            },
            answer: 'a'
        },
        {
            question: 'Alin sa mga sumusunod ang nagpapakita ng bottom-up approach?',
            options: {
                a: 'Aktibong pakikilahok ng komunidad sa pagpaplano at desisyon',
                b: 'Pagdedesisyon ng pambansang pamahalaan lamang',
                c: 'Pag-asa sa utos ng mas mataas na opisyal sa lahat ng oras',
                d: 'Limitadong partisipasyon ng lokal na mamamayan'
            },
            answer: 'a'
        },
        {
            question: 'Ano ang pangunahing layunin ng disaster preparedness activities tulad ng drills?',
            options: {
                a: 'Sanayin ang mga tao upang maging handa sa aktwal na sakuna',
                b: 'Pigilan ang pagdating ng hazard sa isang lugar',
                c: 'Bawasan ang lakas ng sakuna sa kapaligiran',
                d: 'Palitan ang mga tungkulin ng pamahalaan'
            },
            answer: 'a'
        },
        {
            question: 'Alin ang pinakaangkop na aksyon habang lumilindol?',
            options: {
                a: 'Magtago sa ilalim ng matibay na mesa at manatiling kalmado',
                b: 'Tumakbo palabas agad kahit may mga bumabagsak na bagay',
                c: 'Manatili sa tabi ng bintana upang makita ang sitwasyon',
                d: 'Gumamit ng elevator upang makalabas agad'
            },
            answer: 'a'
        },
        {
            question: 'Bakit mahalagang sundin ang early warning system at evacuation protocols?',
            options: {
                a: 'Nakakatulong ito upang maiwasan ang pinsala sa buhay at ari-arian',
                b: 'Nakakapigil ito sa pagdating ng sakuna sa komunidad',
                c: 'Nakakapagpahina ito sa lakas ng hazard',
                d: 'Nakakapagpabagal ito sa pagdating ng bagyo'
            },
            answer: 'a'
        },
        {
            question: 'Sa panahon ng baha, alin ang pinakaangkop na gawain?',
            options: {
                a: 'Iwasan ang paglusong sa baha lalo na kung hindi alam ang lalim',
                b: 'Tumawid sa baha upang makita ang sitwasyon sa paligid',
                c: 'Lumabas ng bahay upang obserbahan ang daloy ng tubig',
                d: 'Ipagpatuloy ang normal na gawain kahit may baha'
            },
            answer: 'a'
        },
        {
            question: 'Bilang Youth Disaster Leader, alin ang pinakaepektibong hakbang upang mabawasan ang risk sa komunidad?',
            options: {
                a: 'Mag-organisa ng preparedness training at information campaign',
                b: 'Maghintay ng tulong mula sa pamahalaan bago kumilos',
                c: 'Iwasan ang pakikilahok sa mga gawaing pangkomunidad',
                d: 'Ituon lamang ang pansin sa sariling kaligtasan'
            },
            answer: 'a'
        }
    ];

    // ================= DOM ELEMENTS =================
    const questionList = document.getElementById('questionList');
    const progressDots = document.getElementById('progressDots');
    const quizProgressLabel = document.getElementById('quizProgressLabel');
    const answeredCountLabel = document.getElementById('answeredCountLabel');
    const quizPage = document.getElementById('quizPage');
    const resultPage = document.getElementById('resultPage');
    const submitBtn = document.getElementById('submitBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const actionRow = document.getElementById('actionRow');

    // ================= STATE =================
    const selectedAnswers = Array(questions.length).fill('');
    const confirmedAnswers = Array(questions.length).fill(false);

    const questionsPerCard = 5;
    let currentCard = 0;
    let isQuizLocked = false;
    let remainingAttempts = 2;
    let highestScore = null;

    // ================= MESSAGES =================
    const correctMessages = [
        '🎉 Tama! Galing mo!',
        '✨ Nice one! Tuloy lang!',
        '🌟 Sakto! Good job!',
        '🎊 Ayos! Nakuha mo!',
        '🧠 Correct! Malakas!'
    ];

    const gentleMessages = [
        '🌱 Okay lang iyan — learning moment ito.',
        '💛 Good try! Bawi tayo sa next card.',
        '✨ Ayos lang — part ito ng pagkatuto.',
        '🌤️ Hindi man tama ngayon, mas lilinaw ito mamaya.',
        '📘 Nice try! Tuloy lang, nandito lang ang aralin.'
    ];

    // ================= HELPERS =================
    function randomFrom(array) {
        return array[Math.floor(Math.random() * array.length)];
    }

    // ================= PROGRESS =================
    function updateProgressAll() {
        const answeredCount = selectedAnswers.filter(a => a !== '').length;
        answeredCountLabel.textContent = `${answeredCount} / ${questions.length} answered`;

        progressDots.innerHTML = questions.map((_, idx) => `
            <div class="progress-dot ${confirmedAnswers[idx] ? 'completed' : ''}"></div>
        `).join('');
    }

    // ================= SCROLL TO UNANSWERED =================
    function scrollToFirstUnanswered() {
        let start = currentCard * questionsPerCard;
        let end = start + questionsPerCard;
        
        for (let i = start; i < end; i++) {
            if (selectedAnswers[i] === '') {
                const questionElements = document.querySelectorAll('.single-question');
                for (let el of questionElements) {
                    const h4 = el.querySelector('h4');
                    if (h4 && h4.textContent.trim().startsWith(`${i + 1}.`)) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        el.classList.add('unanswered-highlight');
                        setTimeout(() => {
                            el.classList.remove('unanswered-highlight');
                        }, 2000);
                        return i;
                    }
                }
            }
        }
        
        for (let i = 0; i < questions.length; i++) {
            if (selectedAnswers[i] === '') {
                const targetCard = Math.floor(i / questionsPerCard);
                if (targetCard !== currentCard) {
                    currentCard = targetCard;
                    renderAllQuestions();
                    setTimeout(() => {
                        const questionElements = document.querySelectorAll('.single-question');
                        for (let el of questionElements) {
                            const h4 = el.querySelector('h4');
                            if (h4 && h4.textContent.trim().startsWith(`${i + 1}.`)) {
                                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                el.classList.add('unanswered-highlight');
                                setTimeout(() => {
                                    el.classList.remove('unanswered-highlight');
                                }, 2000);
                                return;
                            }
                        }
                    }, 150);
                } else {
                    const questionElements = document.querySelectorAll('.single-question');
                    for (let el of questionElements) {
                        const h4 = el.querySelector('h4');
                        if (h4 && h4.textContent.trim().startsWith(`${i + 1}.`)) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            el.classList.add('unanswered-highlight');
                            setTimeout(() => {
                                el.classList.remove('unanswered-highlight');
                            }, 2000);
                            return;
                        }
                    }
                }
                return i;
            }
        }
        
        return -1;
    }

    // ================= RENDER =================
    function renderAllQuestions() {
        if (isQuizLocked) return;

        let start = currentCard * questionsPerCard;
        let end = start + questionsPerCard;
        let currentQuestions = questions.slice(start, end);

        let questionsHtml = '';

        currentQuestions.forEach((item, i) => {
            let index = start + i;
            const selectedValue = selectedAnswers[index];
            const isConfirmed = confirmedAnswers[index];

            const choicesHtml = Object.entries(item.options).map(([key, text]) => {
                let classNames = ['choice'];

                if (selectedValue === key) classNames.push('selected');
                if (isConfirmed && key === item.answer) classNames.push('correct-reveal');
                if (isConfirmed && selectedValue === key && selectedValue !== item.answer) classNames.push('soft-wrong');
                if (isConfirmed && selectedValue === key) classNames.push('confirmed');

                return `
                    <label class="${classNames.join(' ')}" onclick="selectAnswer(${index}, '${key}')">
                        <input type="radio" name="q${index}" value="${key}"
                            ${selectedValue === key ? 'checked' : ''}
                            ${isConfirmed ? 'disabled' : ''}>
                        <span>${key}. ${text}</span>
                    </label>
                `;
            }).join('');

            let feedbackHtml = '';
            if (isConfirmed) {
                if (selectedValue === item.answer) {
                    feedbackHtml = `<div class="reaction-box correct show">✅ ${randomFrom(correctMessages)}</div>`;
                } else {
                    feedbackHtml = `<div class="reaction-box gentle show">❌ ${randomFrom(gentleMessages)}<br>Tamang sagot: ${item.answer.toUpperCase()}</div>`;
                }
            }

            questionsHtml += `
                <div class="single-question">
                    <h4>${index + 1}. ${item.question}</h4>
                    <div class="choices">${choicesHtml}</div>
                    ${feedbackHtml}
                </div>
            `;
        });

        questionList.innerHTML = `
            <div class="question-item">
                <div class="card-chip">Card ${currentCard + 1} / 3</div>
                ${questionsHtml}
            </div>
        `;

        updateProgressAll();

        let allConfirmed = true;
        for (let i = start; i < end; i++) {
            if (!confirmedAnswers[i]) {
                allConfirmed = false;
                break;
            }
        }

        confirmBtn.style.display = allConfirmed ? 'none' : 'inline-flex';

        const nextCardBtn = document.getElementById('nextCardBtn');
        nextCardBtn.style.display = (allConfirmed && currentCard < 2) ? 'inline-flex' : 'none';

        submitBtn.style.display = (currentCard === 2 && allConfirmed) ? 'inline-flex' : 'none';
    }

    // ================= INTERACTION =================
    window.selectAnswer = function(index, key) {
        if (confirmedAnswers[index] || isQuizLocked) return;

        selectedAnswers[index] = key;
        renderAllQuestions();
    };

    function confirmAnswer() {
        if (isQuizLocked) return;

        let start = currentCard * questionsPerCard;
        let end = start + questionsPerCard;

        for (let i = start; i < end; i++) {
            if (selectedAnswers[i] === '') {
                scrollToFirstUnanswered();
                return;
            }
        }

        for (let i = start; i < end; i++) {
            confirmedAnswers[i] = true;
        }

        renderAllQuestions();
    }

    function goNextCard() {
        if (isQuizLocked) return;

        let start = currentCard * questionsPerCard;
        let end = start + questionsPerCard;

        for (let i = start; i < end; i++) {
            if (!confirmedAnswers[i]) {
                scrollToFirstUnanswered();
                return;
            }
        }

        if (currentCard >= 2) return;

        currentCard++;
        renderAllQuestions();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ================= CONFETTI =================
    function launchConfetti() {
        const colors = ['#6dbf7e', '#ffd166', '#ff8fab', '#7bdff2', '#cdb4db', '#f4a261'];

        for (let i = 0; i < 42; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.left = `${Math.random() * 100}vw`;
            piece.style.background = colors[Math.floor(Math.random() * colors.length)];
            piece.style.animationDuration = `${2.4 + Math.random() * 1.6}s`;
            piece.style.animationDelay = `${Math.random() * 0.15}s`;
            document.body.appendChild(piece);

            setTimeout(() => piece.remove(), 4200);
        }
    }

    // ================= UPDATE RETRY INDICATOR =================
    function updateRetryIndicator() {
        const retryIndicator = document.getElementById('retryIndicator');
        const retryBtn = document.getElementById('retryBtn');

        if (retryIndicator) {
            retryIndicator.textContent = `🔁 Natitirang attempts: ${remainingAttempts} / 2`;

            if (remainingAttempts <= 0) {
                retryIndicator.style.background = '#ffe5e5';
                retryIndicator.style.border = '1px solid #e5a5a5';
                retryIndicator.style.color = '#7a2e2e';
                retryIndicator.textContent = '⏰ Naubos na ang attempts.';
            } else {
                retryIndicator.style.background = '#fff7ea';
                retryIndicator.style.border = '1px solid #efd9b3';
                retryIndicator.style.color = '#5b472f';
            }
        }

        if (retryBtn) {
            if (remainingAttempts <= 0) {
                retryBtn.disabled = true;
                retryBtn.style.opacity = 0.5;
                retryBtn.style.cursor = 'not-allowed';
            } else {
                retryBtn.disabled = false;
                retryBtn.style.opacity = 1;
                retryBtn.style.cursor = 'pointer';
            }
        }
    }

    // ================= LOCK QUIZ =================
    function lockQuiz() {
        isQuizLocked = true;
        
        const pretestCard = document.getElementById('pretestCard');
        pretestCard.classList.add('attempts-disabled');
        
        const attemptsMessage = document.getElementById('attemptsMessage');
        attemptsMessage.classList.add('show');
        
        // Show highest score
        if (highestScore !== null) {
            const lastScoreBox = document.getElementById('lastScoreBox');
            lastScoreBox.classList.add('show');
            document.getElementById('lastScoreNumber').textContent = `${highestScore}/${questions.length}`;
            
            if (highestScore >= 13) {
                document.getElementById('lastScoreLabel').textContent = '🏆 Nakapasa ka! Magpatuloy sa Performance Task.';
            } else {
                document.getElementById('lastScoreLabel').textContent = 'Maaari ka pa ring magpatuloy sa Performance Task kahit hindi pumasa.';
            }
            
            document.getElementById('noAttemptsActions').classList.add('show');
        }
        
        // Hide quiz elements
        quizPage.classList.add('hidden');
        actionRow.classList.add('hidden');
        
        const confirmButton = document.getElementById('confirmBtn');
        const nextCardButton = document.getElementById('nextCardBtn');
        const submitButton = document.getElementById('submitBtn');
        
        confirmButton.disabled = true;
        nextCardButton.disabled = true;
        submitButton.disabled = true;
        
        document.querySelectorAll('.choice input[type="radio"]').forEach(input => {
            input.disabled = true;
        });
        
        // Hide VN dialog
        const vnContainer = document.getElementById('vnContainer');
        if (vnContainer) {
            vnContainer.style.display = 'none';
        }
    }

    // ================= SUBMIT POST TEST =================
    function submitPostTest() {
        if (isQuizLocked) return;

        let unansweredIndex = -1;
        for (let i = 0; i < questions.length; i++) {
            if (!confirmedAnswers[i]) {
                unansweredIndex = i;
                break;
            }
        }
        
        if (unansweredIndex !== -1) {
            scrollToFirstUnanswered();
            return;
        }

        const score = questions.reduce((total, item, index) =>
            total + (selectedAnswers[index] === item.answer ? 1 : 0), 0);

        const percentage = Math.round((score / questions.length) * 100);

        // Track highest score
        if (highestScore === null || score > highestScore) {
            highestScore = score;
        }

        // SEND TO BACKEND
        const answers = questions.map((q, index) => ({
            question_number: index + 1,
            selected_answer: selectedAnswers[index],
            correct_answer: q.answer,
            is_correct: selectedAnswers[index] === q.answer
        }));

        fetch("{{ route('student.module3.posttest.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ score, percentage, answers })
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            
            remainingAttempts = data.attempts_remaining || 0;
            updateRetryIndicator();
            
            if (remainingAttempts <= 0) {
                lockQuiz();
            }
        })
        .catch(err => {
            console.error('Error saving posttest:', err);
        });

        // ===== UI =====
        const resultPercent = document.getElementById('resultPercent');
        const resultScoreText = document.getElementById('resultScoreText');
        const resultBadge = document.getElementById('resultBadge');
        const resultFeedback = document.getElementById('resultFeedback');
        const resultActions = document.getElementById('resultActions');
        const resultRing = document.getElementById('resultRing');

        if (resultRing) {
            resultRing.style.setProperty('--progress', percentage);
        }
        resultPercent.textContent = `${score}/${questions.length}`;
        resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;

        resultActions.innerHTML = "";

        if (score >= 13) {
            resultBadge.textContent = "🏆 Mahusay!";
            resultFeedback.textContent = "Nakamit mo ang passing score!";

            setTimeout(() => {
                document.getElementById('passModal').classList.add('show');
            }, 800);

        } else {
            resultBadge.textContent = "❌ Hindi pa sapat";
            resultFeedback.textContent = `Kailangan ng 13/15 para makapasa.`;

            if (remainingAttempts > 0) {
                resultActions.innerHTML = `
                    <button class="btn-secondary" onclick="restartQuiz()">
                        Ulitin (${remainingAttempts} natitira)
                    </button>
                    <a href="{{ route('inner.map3') }}" class="btn-primary">Magpatuloy →</a>
                `;
            } else {
                resultActions.innerHTML = `
                    <a href="{{ route('inner.map3') }}" class="btn-primary">Magpatuloy →</a>
                `;
            }
        }

        quizPage.style.display = 'none';
        resultPage.classList.add('show');

        if (percentage >= 80) launchConfetti();
    }

    // ================= RETRY =================
    function restartQuiz() {
        if (isQuizLocked) {
            alert('Hindi ka na makakapag-retry. Naabot mo na ang maximum na attempts.');
            return;
        }

        if (remainingAttempts <= 0) {
            alert('Wala ka nang natitirang attempts.');
            return;
        }

        selectedAnswers.fill('');
        confirmedAnswers.fill(false);
        currentCard = 0;

        shuffleQuestionsAndChoices();

        resultPage.classList.remove('show');
        quizPage.style.display = 'block';
        quizPage.classList.remove('hidden');
        actionRow.classList.remove('hidden');

        confirmBtn.style.display = 'inline-flex';
        confirmBtn.disabled = false;
        document.getElementById('nextCardBtn').style.display = 'none';
        document.getElementById('nextCardBtn').disabled = false;
        submitBtn.style.display = 'none';
        submitBtn.disabled = false;
        submitBtn.textContent = 'Tapusin ang Panghuling Pagsusulit 🚀';

        updateRetryIndicator();
        renderAllQuestions();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ================= INIT =================
    window.addEventListener('load', () => {
        // Check attempts from server
        fetch("{{ route('student.module3.posttest.check') }}")
            .then(res => res.json())
            .then(data => {
                remainingAttempts = Math.max(0, 2 - data.attempts);
                highestScore = data.highest_score > 0 ? data.highest_score : null;
                
                updateRetryIndicator();
                
                if (data.is_locked || !data.has_attempts_remaining) {
                    lockQuiz();
                } else {
                    shuffleQuestionsAndChoices();
                    renderAllQuestions();
                    
                    confirmBtn.style.display = 'inline-flex';
                    document.getElementById('nextCardBtn').style.display = 'none';
                    submitBtn.style.display = 'none';
                    
                    // Start dialogue
                    if (typeof startDialogue === 'function') {
                        startDialogue([
                            {
                                text: "Narito na ang huling hamon para sa modyul na ito. Dito mo maipapakita ang lahat ng iyong natutunan.",
                                name: "Mga Guro",
                                image: "{{ asset('pictures/vn_box_teacher4.png') }}"
                            },
                            {
                                text: "Mayroon ka lamang dalawang pagkakataon upang sagutan ito. Kailangan mong makakuha ng passing score upang makuha ang gantimpala at makapagpatuloy sa susunod na modyul.",
                                image: "{{ asset('pictures/vn_box_teacher1.png') }}"
                            },
                            {
                                text: "Gawin mo ang iyong makakaya at magtiwala sa iyong natutunan. Good luck!",
                                image: "{{ asset('pictures/vn_box_teacher4.png') }}"
                            }
                        ]);
                    }
                }
            })
            .catch(err => {
                console.error('Error checking attempts:', err);
                // Fallback: initialize quiz anyway
                shuffleQuestionsAndChoices();
                renderAllQuestions();
            });
    });
</script>

@endsection