@extends('Students.studentslayout')
@section('title', 'Hamon at Tugon: Module 4 Paunang Pagsusulit')

@push('styles')

	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">

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

		.background-map {
			position: fixed;
			top: 0;
			left: 0;
			width: 100vw;
			height: 100vh;
			object-fit: cover;
			z-index: -1;
		}

		html, body{
			scroll-behavior:smooth;
			background:
				radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
				radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
				radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
				linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
		}

		body{
			overflow-x:hidden;
			color:var(--text);
			font-family:'Poppins', sans-serif;
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

		/* Hide quiz page when locked */
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
			justify-content: center;
			align-items: center;
			gap: 10px;
			margin-bottom: 15px;
			flex-wrap: wrap;
		}

		.progress-label {
			font-size: 0.84rem;
			font-weight: 900;
			color: var(--muted);
			letter-spacing: 0.4px;
		}

		.progress-mini-badge {
			font-size: 0.85rem;
			font-weight: 900;
			padding: 6px 14px;
			color: #5b472f;
			background: #fff7ea;
			border: 1px solid #efd9b3;
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
			margin-bottom: 14px;
			line-height: 1.5;
			font-size: 1.02rem;
			font-weight: 900;
			padding-right: 18px;
		}

		.choices {
			display: grid;
			gap: 10px;
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
			position: fixed;
			top: 80px;
			left: 20px;
			z-index: 100;
			background-color: rgba(255, 255, 255, 0.9);
			padding: 10px 15px;
			border-radius: 8px;
			text-decoration: none;
			color: #1a1a1a;
			font-weight: bold;
			font-family: 'Courier New', Courier, monospace;
			box-shadow: 0 4px 6px rgba(0,0,0,0.3);
			transition: transform 0.2s;
		}

		.back-button:hover {
			transform: scale(1.06);
		}

		.confirm-pending {
			animation: pulseBorder 1.5s ease-in-out infinite;
		}

		/* Unanswered question highlight */
		.unanswered-highlight {
			background-color: #fff3df !important;
			transition: background-color 0.5s ease;
			border-radius: 16px;
			padding: 12px;
			border: 2px solid #f4c97a;
		}

		/* Attempts disabled overlay */
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

		/* Last score display when no attempts left */
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

		/* No Attempts Continue Button */
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
				padding: 14px 10px 20px;
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

		.single-question {
			margin-bottom: 18px;
			padding-bottom: 12px;
			border-bottom: 1px dashed #e7d7bf;
		}

		.single-question:last-child {
			border-bottom: none;
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
	</style>
@endpush

@section('content')

<img src="{{ asset('pictures/mod4_innermap.png') }}" class="background-map">

<a href="{{ route('module4.home') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card" id="pretestCard">
			<div class="pretest-header">
				<div class="header-icons">🔥 🛡️ 🌊</div>
				<div class="subtitle">Module 4</div>
				<h1>PAUNANG PAGSUSULIT</h1>
				<p>Panuto: Basahin at suriin ang bawat sitwasyon. Piliin ang titik ng pinaka angkop na sagot.</p>
			</div>

			<!-- Last Score Display (shown when no attempts left) -->
			<div class="last-score-box" id="lastScoreBox">
				<div style="font-size: 1.2rem; margin-bottom: 8px;">📊 Ang iyong pinakamataas na iskor:</div>
				<div class="score-number" id="lastScoreNumber">0/15</div>
				<div class="score-label" id="lastScoreLabel">Nakumpleto mo na ang paunang pagsusulit.</div>
				
				<!-- No Attempts Actions -->
				<div class="no-attempts-actions" id="noAttemptsActions">
					<a href="{{ route('module4.balikaral') }}" class="btn-primary" style="min-width: 200px;">
						➡️ Magpatuloy sa Balik-Aral
					</a>
				</div>
			</div>

			<!-- Attempts Message -->
			<div class="attempts-message" id="attemptsMessage">
				<h3>⏰ Naabot mo na ang maximum na 3 attempts</h3>
				<p>Hindi ka na makakapag-ulit ng paunang pagsusulit.</p>
			</div>

			<form id="preTestForm">
				<div class="quiz-page" id="quizPage">
					<div class="quiz-progress">
						<div class="progress-topline">
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

						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPreTest()" style="display:none;">
							Tapusin ang Paunang Pagsusulit 🚀
						</button>
					</div>
				</div>

				<div class="result-page" id="resultPage" aria-live="polite">
					<div class="result-box show" id="resultBox">
						<div class="result-title">Resulta ng Paunang Pagsusulit</div>
						<div class="result-ring" id="resultRing" style="--progress:0;">
							<div class="result-percent" id="resultPercent">0/0</div>
						</div>
						<div class="result-score" id="resultScoreText"></div>
						<div class="badge-pill" id="resultBadge">🌟 Mahusay!</div>
						<div class="result-feedback" id="resultFeedback"></div>
						<div class="result-interpretation" id="resultInterpretation">Interpretasyon ng Iskor: 0–5 → Kailangan ng gabay, 6–10 → May kaalaman, 11–15 → Handa</div>

						<div class="retry-indicator" id="retryIndicator">
							🔁 Natitirang pagsubok: 3 / 3
						</div>

						<div class="result-actions" id="resultActions">
							<button type="button" class="btn-secondary" id="retryBtn" onclick="restartQuiz()">Ulitin ang Pre-Test</button>
							<a href="{{ route('module4.balikaral') }}" class="btn-primary">Magpatuloy →</a>
						</div>
					</div>
				</div>
			</form>
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
		return array;
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
			question: 'Ayon sa konsepto ng disaster management, alin ang pinakaangkop na paglalarawan nito?',
			options: {
				a: 'Proseso ng paghahanda, pagtugon, at pagbangon mula sa sakuna',
				b: 'Paraan ng pag-iwas lamang sa mga sakuna sa komunidad',
				c: 'Sistema ng pagtulong pagkatapos lamang ng kalamidad',
				d: 'Aktibidad ng pamahalaan sa panahon ng sakuna lamang'
			},
			answer: 'a'
		},
		{
			question: 'Sa isang komunidad, may paparating na bagyo at may babala ang PAGASA. Ano ang pinakaangkop na unang hakbang?',
			options: {
				a: 'Balewalain ang babala at maghintay ng karagdagang impormasyon',
				b: 'Makinig sa balita at magsimula ng paghahanda sa pamilya',
				c: 'Maghintay ng aksyon mula sa kapitbahay bago kumilos',
				d: 'Ipagpatuloy ang normal na gawain kahit may babala'
			},
			answer: 'b'
		},
		{
			question: 'Alin sa mga sumusunod ang pinakamalinaw na halimbawa ng hazard?',
			options: {
				a: 'Malakas na bagyo na maaaring magdulot ng pagbaha',
				b: 'Mahinang bahay na madaling masira ng hangin',
				c: 'Kakulangan ng kaalaman ng mga tao sa komunidad',
				d: 'Pinsalang natamo matapos ang isang sakuna'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang pinakamahusay na paglalarawan ng vulnerability?',
			options: {
				a: 'Kahinaan ng tao o lugar na madaling maapektuhan ng hazard',
				b: 'Banta na dulot ng kalikasan o gawain ng tao',
				c: 'Pinsalang dulot ng kalamidad sa komunidad',
				d: 'Kakayahan ng komunidad na makabangon sa sakuna'
			},
			answer: 'a'
		},
		{
			question: 'Kailan nagiging disaster ang isang hazard?',
			options: {
				a: 'Kapag nagdulot ito ng malaking pinsala sa tao at kapaligiran',
				b: 'Kapag may babala mula sa mga awtoridad',
				c: 'Kapag ito ay nangyari sa isang urban na lugar',
				d: 'Kapag ito ay inaasahan ng mga tao sa komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Bakit mas mataas ang risk sa mga pamilyang nakatira malapit sa ilog?',
			options: {
				a: 'Mas mataas ang kanilang exposure sa posibleng pagbaha',
				b: 'Mas marami silang mapagkukunan ng tubig sa araw-araw',
				c: 'Mas malamig ang klima sa mga lugar na malapit sa ilog',
				d: 'Mas mabilis ang transportasyon sa mga lugar na ito'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang nagpapakita ng resilience ng isang komunidad?',
			options: {
				a: 'Kakayahan nitong makabangon at makapag-adjust matapos ang sakuna',
				b: 'Pagkakaroon ng maraming hazard sa isang lugar',
				c: 'Pagtaas ng bilang ng populasyon sa komunidad',
				d: 'Pagkakaroon ng mahihinang istruktura sa lugar'
			},
			answer: 'a'
		},
		{
			question: 'Alin sa mga sumusunod ang halimbawa ng anthropogenic hazard?',
			options: {
				a: 'Polusyon mula sa pabrika at maling pagtatapon ng basura',
				b: 'Lindol na dulot ng paggalaw ng tectonic plates',
				c: 'Bagyong nabubuo sa karagatan',
				d: 'Landslide na dulot ng malakas na ulan'
			},
			answer: 'a'
		},
		{
			question: 'Ano ang pinakamahalagang dahilan kung bakit kailangang maghanda bago ang sakuna?',
			options: {
				a: 'Upang mabawasan ang pinsala sa buhay at ari-arian',
				b: 'Upang mapabilis ang pagdating ng tulong mula sa pamahalaan',
				c: 'Upang maiwasan ang pagdating ng sakuna sa komunidad',
				d: 'Upang makontrol ang lakas ng mga natural na hazard'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang nagpapakita ng tamang aksyon habang may bagyo?',
			options: {
				a: 'Lumikas sa evacuation center kung kinakailangan at may babala',
				b: 'Manatili sa bahay kahit mataas na ang tubig sa paligid',
				c: 'Lumabas upang obserbahan ang sitwasyon sa komunidad at paligid',
				d: 'Maghintay ng rescue bago gumawa ng aksyon'
			},
			answer: 'a'
		},
		{
			question: 'Ano ang pinakaangkop na gawain pagkatapos ng sakuna?',
			options: {
				a: 'Makilahok sa clean-up drive at tumulong sa komunidad',
				b: 'Umalis agad at iwanan ang mga apektadong lugar',
				c: 'Manood lamang at maghintay ng tulong mula sa iba',
				d: 'Iwasan ang pakikilahok sa anumang gawain'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang nagpapakita ng mataas na risk sa isang komunidad?',
			options: {
				a: 'Mataas ang vulnerability at mababa ang kapasidad ng komunidad',
				b: 'Mababa ang vulnerability at mataas ang kahandaan ng komunidad',
				c: 'Mataas ang resilience at sapat ang kaalaman ng mga tao',
				d: 'Mababa ang exposure at handa ang mga mamamayan'
			},
			answer: 'a'
		},
		{
			question: 'Sa dalawang approach sa disaster management, alin ang katangian ng bottom-up approach?',
			options: {
				a: 'Aktibong pakikilahok ng komunidad sa pagpaplano at desisyon',
				b: 'Pagdedesisyon lamang ng pambansang pamahalaan',
				c: 'Pag-asa sa utos ng mga opisyal sa lahat ng sitwasyon',
				d: 'Limitadong partisipasyon ng mga mamamayan'
			},
			answer: 'a'
		},
		{
			question: 'Ano ang pangunahing kahinaan ng top-down approach sa disaster management?',
			options: {
				a: 'Hindi nito agad natutugunan ang tunay na pangangailangan ng komunidad',
				b: 'Sobra ang partisipasyon ng mga mamamayan sa ganitong proseso',
				c: 'Masyadong mabilis ang implementasyon ng mga programa para sa mga mamamayan',
				d: 'Nakabatay ito sa karanasan ng mga lokal na residente'
			},
			answer: 'a'
		},
		{
			question: 'Paano nakatutulong ang Community-Based Disaster Risk Reduction and Management (CBDRRM)?',
			options: {
				a: 'Pinapalakas nito ang partisipasyon ng komunidad sa paghahanda sa sakuna',
				b: 'Pinapasa nito ang responsibilidad sa pambansang pamahalaan',
				c: 'Nililimitahan nito ang pakikilahok ng mga mamamayan',
				d: 'Binabawasan nito ang papel ng lokal na komunidad'
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
	const totalCards = Math.ceil(questions.length / questionsPerCard);
	let isQuizLocked = false;
	let remainingAttempts = 3;
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
	function randomFrom(array) { return array[Math.floor(Math.random() * array.length)]; }

	function getAnsweredCount() { return confirmedAnswers.filter(confirmed => confirmed === true).length; }

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
				<div class="card-chip">Card ${currentCard + 1} / ${totalCards}</div>
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
		nextCardBtn.style.display = (allConfirmed && currentCard < totalCards - 1) ? 'inline-flex' : 'none';

		submitBtn.style.display = (currentCard === totalCards - 1 && allConfirmed) ? 'inline-flex' : 'none';
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

		if (currentCard >= totalCards - 1) return;

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
			retryIndicator.textContent = `🔁 Natitirang pagsubok: ${remainingAttempts} / 3`;

			if (remainingAttempts <= 0) {
				retryIndicator.style.background = '#ffe5e5';
				retryIndicator.style.border = '1px solid #e5a5a5';
				retryIndicator.style.color = '#7a2e2e';
				retryIndicator.textContent = '⏰ Naubos na ang mga pagsubok.';
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
			
			if (highestScore >= 11) {
				document.getElementById('lastScoreLabel').textContent = '🏆 Magaling! Magpatuloy sa Balik-Aral.';
			} else {
				document.getElementById('lastScoreLabel').textContent = 'Maaari ka pa ring magpatuloy sa Balik-Aral kahit hindi pumasa.';
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

	// ================= SUBMIT PRE TEST =================
	function submitPreTest() {
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
			selected_option: selectedAnswers[index],
			correct_option: q.answer,
			is_correct: selectedAnswers[index] === q.answer
		}));

		fetch("{{ route('student.module4.pretest.save') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({
				score: score,
				total_items: questions.length,
				level: "",
				answers: questions.map((q, index) => ({
					question_number: index + 1,
					selected_option: selectedAnswers[index].charCodeAt(0) - 96,
					correct_option: q.answer.charCodeAt(0) - 96,
					is_correct: selectedAnswers[index] === q.answer
				}))
			})
		})
		.then(res => res.json())
		.then(data => {
			if (data.error) {
				if (data.max_attempts_reached) {
					isQuizLocked = true;
					lockQuiz();
				}
				alert(data.error);
				return;
			}
			
			// Update attempts
			remainingAttempts = data.attempts_remaining || 0;
			highestScore = data.highest_score || score;
			updateRetryIndicator();
			
			// If no attempts remaining, lock the quiz
			if (remainingAttempts <= 0) {
				lockQuiz();
				return;
			}
			
			// Show result with option to retry
			showResult(score, percentage);
		})
		.catch(err => {
			console.error('Error saving pretest:', err);
			alert('May error sa pag-save ng iyong sagot. Pakisubukan muli.');
		});
	}

	// ================= SHOW RESULT =================
	function showResult(score, percentage) {
		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');
		const resultActions = document.getElementById('resultActions');

		if (resultRing) {
			resultRing.style.setProperty('--progress', percentage);
		}
		if (resultPercent) {
			resultPercent.textContent = `${score}/${questions.length}`;
		}
		if (resultScoreText) {
			resultScoreText.textContent = `Nakakuha ka ng ${score} sa ${questions.length}`;
		}

		if (resultActions) {
			resultActions.innerHTML = "";
		}

		if (score >= 11) {
			if (resultBadge) resultBadge.textContent = "🏆 Mahusay!";
			if (resultFeedback) resultFeedback.textContent = "Magaling! Handa ka na para sa Balik-Aral!";
			document.getElementById('resultInterpretation').textContent = 'Interpretasyon ng Iskor: Handa (11–15)';

		} else if (score >= 6) {
			if (resultBadge) resultBadge.textContent = "👏 Magaling!";
			if (resultFeedback) resultFeedback.textContent = "May kaalaman ka na, patuloy pa ang pag-unlad.";
			document.getElementById('resultInterpretation').textContent = 'Interpretasyon ng Iskor: May kaalaman (6–10)';

		} else {
			if (resultBadge) resultBadge.textContent = "🌱 Warm-up pa lang!";
			if (resultFeedback) resultFeedback.textContent = "Kailangan ng gabay pa. Gamitin ito bilang panimulang lakas.";
			document.getElementById('resultInterpretation').textContent = 'Interpretasyon ng Iskor: Kailangan ng gabay (0–5)';
		}

		if (resultActions) {
			if (remainingAttempts > 0) {
				resultActions.innerHTML = `
					<button class="btn-secondary" id="retryBtn" onclick="restartQuiz()">
						Ulitin (${remainingAttempts} natitira)
					</button>
					<a href="{{ route('module4.balikaral') }}" class="btn-primary">Magpatuloy →</a>
				`;
			} else {
				resultActions.innerHTML = `
					<a href="{{ route('module4.balikaral') }}" class="btn-primary">Magpatuloy →</a>
				`;
			}
		}

		if (quizPage) quizPage.style.display = 'none';
		if (resultPage) {
			resultPage.classList.add('show');
			resultPage.style.display = 'block';
		}

		if (percentage >= 80) launchConfetti();
	}

	// ================= RETRY =================
	function restartQuiz() {
		if (isQuizLocked) {
			alert('Hindi ka na makakapag-retry. Naabot mo na ang maximum na attempts.');
			return;
		}

		if (remainingAttempts <= 0) {
			alert('Wala ka nang natitirang pagsubok.');
			return;
		}

		selectedAnswers.fill('');
		confirmedAnswers.fill(false);
		currentCard = 0;

		shuffleQuestionsAndChoices();

		resultPage.classList.remove('show');
		resultPage.style.display = 'none';
		quizPage.style.display = 'block';
		quizPage.classList.remove('hidden');
		actionRow.classList.remove('hidden');

		confirmBtn.style.display = 'inline-flex';
		confirmBtn.disabled = false;
		document.getElementById('nextCardBtn').style.display = 'none';
		document.getElementById('nextCardBtn').disabled = false;
		submitBtn.style.display = 'none';
		submitBtn.disabled = false;
		submitBtn.textContent = 'Tapusin ang Paunang Pagsusulit 🚀';

		updateRetryIndicator();
		renderAllQuestions();

		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	// ================= INIT =================
	window.addEventListener('load', () => {
		// Check attempts from server
		fetch("{{ route('student.module4.pretest.check') }}")
			.then(res => res.json())
			.then(data => {
				remainingAttempts = Math.max(0, data.max_attempts - data.attempts);
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
								text: "Simulan natin ang paglalakbay sa modyul na ito sa pamamagitan ng paunang pagsusulit. Alamin natin ang iyong kasalukuyang kaalaman tungkol sa disaster management at risk reduction.",
								name: "Mga Guro",
								image: "{{ asset('pictures/vn_box_teacher4.png') }}"
							},
							{
								text: "Mayroon ka lamang tatlong pagkakataon upang sagutan ito. Gamitin ito upang masukat ang iyong nalalaman at maging gabay sa iyong pag-aaral.",
								image: "{{ asset('pictures/vn_box_teacher1.png') }}"
							},
							{
								text: "Huwag mag-alala kung hindi mo ito makuha sa unang pagkakataon. Ang mahalaga ay matuto at lumago sa bawat pagsubok. Kaya mo ito!",
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