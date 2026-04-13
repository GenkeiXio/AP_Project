<!DOCTYPE html>
<html lang="fil">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Hamon at Tugon: Module 2 Post-Test</title>

	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">

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

		body {
			display: block;
			min-height: 100vh;
			padding: 28px 20px 40px;
			overflow-x: hidden;
			background:
				radial-gradient(circle at top left, #fff6df 0%, transparent 32%),
				radial-gradient(circle at top right, #fdf0ff 0%, transparent 25%),
				linear-gradient(180deg, var(--bg-1) 0%, var(--bg-2) 100%);
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
			top: 20px;
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
			background: rgba(61, 42, 26, 0.4); /* Matches your --text color for a warmer dim */
			backdrop-filter: blur(8px); /* Blurs the background map for focus */
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
			background: #f0fdf4; /* Very light green */
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
			max-width: 200px; /* Adjust based on your image aspect ratio */
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
			max-width: 450px; /* Keeps it tight and focused */
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
			text-align: justify; /* Cleaner look for long paragraphs */
		}
	</style>
</head>
<body>

<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

<a href="{{ route('inner.map2') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 2</div>
				<h1>Post-Test</h1>
                <p>Basahin at unawain ang bawat tanong. Piliin ang tamang sagot at kumpirmahin bago magpatuloy.</p>
			</div>

			<div class="pretest-note">
				💡 Sagutin ang bawat tanong at i-click ang "✓ Kumpirmahin". <br> <br>Kailangang makakuha ng 13/15 upang makapasa.
			</div>

			<form id="preTestForm">
				<div class="quiz-page" id="quizPage">
					<div class="quiz-progress">
						<div class="progress-topline">
							<div class="progress-label" id="quizProgressLabel"></div>
							<div class="progress-mini-badge" id="answeredCountLabel">0 / 15 answered</div>
						</div>
						<div class="progress-dots" id="progressDots"></div>
					</div>

					<div class="flashcard-stage">
						<div class="question-list" id="questionList"></div>
					</div>

					<div class="action-row">
						<button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmAnswer()">✓ Kumpirmahin</button>
						<button type="button" class="btn-primary" id="nextBtn" onclick="goNextQuestion()" disabled>Susunod →</button>
						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPreTest()" style="display:none;">Tapusin ang Post-Test 🚀</button>
					</div>
				</div>

				<div class="result-page" id="resultPage" aria-live="polite">
					<div class="result-box show" id="resultBox">
						<div class="result-title">Resulta ng Post-Test</div>
						<div class="result-ring" id="resultRing" style="--progress:0;">
							<div class="result-percent" id="resultPercent">0/0</div>
						</div>
						<div class="result-score" id="resultScoreText"></div>
						<div class="badge-pill" id="resultBadge"></div>
						<div class="result-feedback" id="resultFeedback"></div>
						
						<div class="result-actions" id="resultActions">
							<button type="button" class="btn-secondary" onclick="restartQuiz()">Ulitin ang Post-Test</button>
							<a href="{{ route('inner.map2') }}" class="btn-primary">Magpatuloy →</a>
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
        
        <div class="reward-container">
            <span class="reward-label">Nakuha mo ang isang bahagi!</span>
            <img src="{{ asset('pictures/Mod2_FinalAct/mod2housepart.png') }}" alt="Reward Piece" class="reward-image" style="box-shadow: none;">
        </div>

        <p>
            Mahusay! Ipinapakita ng iyong resulta na nauunawaan mo na ang kalagayan, mga suliranin, at mga paraan ng pagtugon sa isyung pangkapaligiran sa Pilipinas.
			Nawa’y magamit mo ang iyong natutunan sa paggawa ng tamang desisyon at sa pakikiisa sa mga gawaing pangkalikasan, sapagkat ang pangangalaga sa kapaligiran ay tungkulin ng bawat isa at mahalaga para sa kinabukasan ng ating komunidad at bansa.
        </p>

        <a href="{{ route('module2.essay') }}" class="btn-primary">
            Magpatuloy sa Essay ✍️
        </a>
    </div>
</div>
</div>


<script>
	const questions = [
        { question:'1. Alin sa sumusunod ang pinakamahusay na paglalarawan ng solid waste?', options:{ a:'Mga yamang likas sa kagubatan', b:'Mga basurang nagmumula sa tahanan, paaralan, at negosyo', c:'Mga anyong tubig sa kapaligiran', d:'Mga produktong agrikultural' }, answer:'b' },
        { question:'2. Ano ang pangunahing suliraning nagdudulot ng pagdami ng basura sa bansa?', options:{ a:'Kakulangan ng ulan', b:'Kawalan ng disiplina sa pagtatapon ng basura', c:'Pagdami ng puno', d:'Malinis na kapaligiran' }, answer:'b' },
        { question:'3. Ano ang posibleng mangyari kung patuloy ang maling pamamahala ng basura?', options:{ a:'Pag-unlad ng kalikasan', b:'Pagbaha at pagkalat ng sakit', c:'Pagdami ng likas na yaman', d:'Paglilinis ng hangin' }, answer:'b' },
        { question:'4. Ano ang tinutukoy kapag sinabing pagkakalbo ng kagubatan?', options:{ a:'Reforestation', b:'Deforestation', c:'Urbanisasyon', d:'Industrialisasyon' }, answer:'b' },
        { question:'5. Alin sa mga sumusunod ang halimbawa ng gawaing nakasisira sa kagubatan?', options:{ a:'Tree planting', b:'Illegal logging', c:'Recycling', d:'Waste segregation' }, answer:'b' },
        { question:'6. Ano ang epekto ng patuloy na pagputol ng mga puno?', options:{ a:'Pagdami ng biodiversity', b:'Pagbaha at soil erosion', c:'Paglamig ng panahon', d:'Pagdami ng hayop' }, answer:'b' },
        { question:'7. Paano mailalarawan ang climate change?', options:{ a:'Pagbabago sa anyong lupa', b:'Pagbabago sa pangmatagalang kondisyon ng klima', c:'Pagtaas ng populasyon', d:'Pagdami ng kagubatan' }, answer:'b' },
        { question:'8. Alin sa mga sumusunod ang nagpapalala sa climate change?', options:{ a:'Paggamit ng renewable energy', b:'Pagsusunog ng fossil fuels', c:'Pagtatanim ng puno', d:'Paglilinis ng kapaligiran' }, answer:'b' },
        { question:'9. Ano ang isa sa mga epekto ng patuloy na pag-init ng mundo?', options:{ a:'Mas mahinang bagyo', b:'Mas malalakas na kalamidad', c:'Mas malamig na klima', d:'Mas maraming kagubatan' }, answer:'b' },
        { question:'10. Ano ang pangunahing layunin ng Ecological Solid Waste Management Act (RA 9003)?', options:{ a:'Palakihin ang produksyon ng basura', b:'Isulong ang wastong pamamahala ng basura', c:'Magtayo ng pabrika', d:'Putulin ang mga puno' }, answer:'b' },
        { question:'11. Ano ang kahalagahan ng early warning system sa komunidad?', options:{ a:'Para magtanim ng puno', b:'Para makapagbigay ng paunang babala sa sakuna', c:'Para mangolekta ng basura', d:'Para magpatupad ng batas' }, answer:'b' },
        { question:'12. Bakit mahalaga ang agarang paglikas sa panahon ng sakuna?', options:{ a:'Para makapasyal', b:'Para maiwasan ang panganib at makaligtas', c:'Para kumita', d:'Para magtapon ng basura' }, answer:'b' },
        { question:'13. Ano ang ipinapakita ng pakikiisa ng mamamayan sa mga programang pangkalikasan?', options:{ a:'Kawalan ng interes', b:'Pansariling layunin', c:'Pananagutang panlipunan', d:'Pagiging tamad' }, answer:'c' },
        { question:'14. Alin sa sumusunod ang pinakaepektibong paraan ng pangangalaga sa kapaligiran?', options:{ a:'Pagtapon ng basura kung saan-saan', b:'Pagsusunog ng basura', c:'Paghihiwalay ng basura (waste segregation)', d:'Pagputol ng puno' }, answer:'c' },
        { question:'15. Bilang kabataan, alin ang pinakamainam na hakbang upang makatulong sa kalikasan?', options:{ a:'Manahimik lamang', b:'Makilahok sa mga programang pangkalikasan', c:'Magtapon ng basura sa ilog', d:'Sirain ang mga halaman' }, answer:'b' }
    ];

	const questionList = document.getElementById('questionList');
	const progressDots = document.getElementById('progressDots');
	const quizProgressLabel = document.getElementById('quizProgressLabel');
	const answeredCountLabel = document.getElementById('answeredCountLabel');
	const quizPage = document.getElementById('quizPage');
	const resultPage = document.getElementById('resultPage');
	const nextBtn = document.getElementById('nextBtn');
	const submitBtn = document.getElementById('submitBtn');
	const confirmBtn = document.getElementById('confirmBtn');

	const selectedAnswers = Array(questions.length).fill('');
	const confirmedAnswers = Array(questions.length).fill(false);
	let currentQuestionIndex = 0;
	let lastDirection = 'right';
	let pendingSelection = null;

	const correctMessages = ['🎉 Tama! Galing mo!', '✨ Nice one! Tuloy lang!', '🌟 Sakto! Good job!', '🎊 Ayos! Nakuha mo!', '🧠 Correct! Malakas!'];
	const gentleMessages = ['🌱 Okay lang iyan — learning moment ito.', '💛 Good try! Bawi tayo sa next card.', '✨ Ayos lang — part ito ng pagkatuto.', '🌤️ Hindi man tama ngayon, mas lilinaw ito mamaya.', '📘 Nice try! Tuloy lang, nandito lang ang aralin.'];

	function randomFrom(array) { return array[Math.floor(Math.random() * array.length)]; }

	function getAnsweredCount() { return confirmedAnswers.filter(confirmed => confirmed === true).length; }

	function updateProgress() {
		const answeredCount = getAnsweredCount();
		quizProgressLabel.textContent = `Card ${currentQuestionIndex + 1} of ${questions.length}`;
		answeredCountLabel.textContent = `${answeredCount} / ${questions.length} answered`;
		
		progressDots.innerHTML = questions.map((_, idx) => `
			<div class="progress-dot ${confirmedAnswers[idx] ? 'completed' : ''} ${idx === currentQuestionIndex ? 'active' : ''}"></div>
		`).join('');
		
		const isLast = currentQuestionIndex === questions.length - 1;
		const isConfirmed = confirmedAnswers[currentQuestionIndex];
		
		if (isLast) {
			nextBtn.style.display = 'none';
			submitBtn.style.display = 'inline-flex';
			submitBtn.disabled = !isConfirmed;
		} else {
			nextBtn.style.display = 'inline-flex';
			submitBtn.style.display = 'none';
			nextBtn.disabled = !isConfirmed;
		}
		
		confirmBtn.disabled = pendingSelection === null || confirmedAnswers[currentQuestionIndex];
	}

	function getCardAnimationClass() {
		if (currentQuestionIndex === 0) return 'card-slide-in-up';
		return lastDirection === 'left' ? 'card-slide-in-left' : 'card-slide-in-right';
	}

	function launchConfetti() {
		const colors = ['#6dbf7e', '#ffd166', '#ff8fab', '#7bdff2', '#cdb4db', '#f4a261'];
		for (let i = 0; i < 42; i++) {
			const piece = document.createElement('div');
			piece.className = 'confetti-piece';
			piece.style.left = `${Math.random() * 100}vw`;
			piece.style.background = colors[Math.floor(Math.random() * colors.length)];
			piece.style.animationDuration = `${2.4 + Math.random() * 1.6}s`;
			piece.style.animationDelay = `${Math.random() * 0.15}s`;
			piece.style.width = `${8 + Math.random() * 6}px`;
			piece.style.height = `${10 + Math.random() * 10}px`;
			document.body.appendChild(piece);
			setTimeout(() => piece.remove(), 4200);
		}
	}

	function renderCurrentQuestion() {
		const item = questions[currentQuestionIndex];
		const selectedValue = selectedAnswers[currentQuestionIndex];
		const isConfirmed = confirmedAnswers[currentQuestionIndex];
		const isCorrect = selectedValue && selectedValue === item.answer;
		const animationClass = getCardAnimationClass();

		const choicesHtml = Object.entries(item.options).map(([key, text]) => {
			let classNames = ['choice'];
			if (selectedValue === key) classNames.push('selected');
			if (isConfirmed && key === item.answer) classNames.push('correct-reveal');
			if (isConfirmed && selectedValue === key && selectedValue !== item.answer) classNames.push('soft-wrong');
			if (isConfirmed && selectedValue === key) classNames.push('confirmed');

			return `
				<label class="${classNames.join(' ')}" onclick="selectAnswer('${key}')">
					<input type="radio" name="q${currentQuestionIndex}" value="${key}" ${selectedValue === key ? 'checked' : ''} ${isConfirmed ? 'disabled' : ''}>
					<span>${key}. ${text}</span>
				</label>
			`;
		}).join('');

		let reactionBoxHtml = '';
		if (isConfirmed && selectedValue) {
			if (isCorrect) {
				reactionBoxHtml = `<div class="reaction-box correct show pulse-pop"><div class="reaction-emoji">🎉</div><div>${randomFrom(correctMessages)}</div></div>`;
			} else {
				reactionBoxHtml = `<div class="reaction-box gentle show pulse-pop"><div class="reaction-emoji">🌱</div><div>${randomFrom(gentleMessages)}</div></div>`;
			}
		} else if (pendingSelection === null && !isConfirmed) {
			reactionBoxHtml = `<div class="reaction-box show"><div class="reaction-emoji">✨</div><div>Pumili ng sagot, pagkatapos pindutin ang "✓ Kumpirmahin".</div></div>`;
		} else if (pendingSelection !== null && !isConfirmed) {
			reactionBoxHtml = `<div class="reaction-box show pulse-pop"><div class="reaction-emoji">📝</div><div>Napili mo na ang sagot. Pindutin ang "✓ Kumpirmahin" kung tama ang sagot.</div></div>`;
		} else {
			reactionBoxHtml = `<div class="reaction-box"><div class="reaction-emoji">✨</div><div>Pumili ng sagot.</div></div>`;
		}

		questionList.innerHTML = `
			<div class="question-item ${animationClass}">
				<div class="card-chip-row">
					<div class="card-chip">🎴 Flashcard ${currentQuestionIndex + 1}</div>
					
				</div>
				<h4>${item.question}</h4>
				<div class="choices">${choicesHtml}</div>
				${reactionBoxHtml}
			</div>
		`;

		updateProgress();
	}

	window.selectAnswer = function(selectedKey) {
		if (confirmedAnswers[currentQuestionIndex]) {
			alert('Ang sagot ay nakumpirma na. Hindi na ito mababago.');
			return;
		}
		pendingSelection = selectedKey;
		selectedAnswers[currentQuestionIndex] = selectedKey;
		renderCurrentQuestion();
	};

	function confirmAnswer() {
		if (confirmedAnswers[currentQuestionIndex]) {
			alert('Ang sagot ay nakumpirma na.');
			return;
		}
		
		if (pendingSelection === null && !selectedAnswers[currentQuestionIndex]) {
			alert('Pumili muna ng sagot bago kumpirmahin.');
			return;
		}
		
		const selectedValue = selectedAnswers[currentQuestionIndex];
		const item = questions[currentQuestionIndex];
		const isCorrect = selectedValue === item.answer;
		
		confirmedAnswers[currentQuestionIndex] = true;
		
		if (isCorrect) {
			launchConfetti();
		}
		
		renderCurrentQuestion();
	}

	function goNextQuestion() {
		if (!confirmedAnswers[currentQuestionIndex]) {
			alert('Kailangan munang kumpirmahin ang sagot bago magpatuloy sa susunod.');
			return;
		}
		
		if (currentQuestionIndex >= questions.length - 1) return;
		
		lastDirection = 'right';
		currentQuestionIndex += 1;
		pendingSelection = null;
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	function animateResultRing(resultRing, targetPercent, duration = 1100) {
		const startTime = performance.now();
		function frame(currentTime) {
			const elapsed = currentTime - startTime;
			const progress = Math.min(elapsed / duration, 1);
			const eased = 1 - Math.pow(1 - progress, 3);
			const value = Math.round(targetPercent * eased);
			resultRing.style.setProperty('--progress', value);
			if (progress < 1) requestAnimationFrame(frame);
		}
		resultRing.style.setProperty('--progress', 0);
		requestAnimationFrame(frame);
	}

	function getFeedbackByScore(score) {
		if (score >= 11) return { badge: '🏆 Napakahusay!', feedback: 'Ang ganda ng iyong pundasyon. Ready ka na sa susunod na bahagi!', interpretation: 'Handa' };
		if (score >= 6) return { badge: '👏 Magaling!', feedback: 'May kaalaman ka na, patuloy pa ang pag-unlad.', interpretation: 'May kaalaman' };
		return { badge: '🌱 Warm-up pa lang!', feedback: 'Kailangan ng gabay pa. Gamitin ito bilang panimulang lakas.', interpretation: 'Kailangan ng gabay' };
	}

	function submitPreTest() {
		if (!confirmedAnswers.every(confirmed => confirmed === true)) {
			alert('Pakisagutan at kumpirmahin muna ang lahat ng tanong bago tapusin.');
			return;
		}

		const score = questions.reduce((total, item, index) => {
			return total + (selectedAnswers[index] === item.answer ? 1 : 0);
		}, 0);

		const percentage = Math.round((score / questions.length) * 100);

		// PREPARE ANSWERS DATA
		const answers = questions.map((q, index) => ({
			question_number: index + 1,
			selected_answer: selectedAnswers[index],
			correct_answer: q.answer,
			is_correct: selectedAnswers[index] === q.answer
		}));

		// 🔥 SEND TO BACKEND
		fetch("{{ route('student.module2.posttest.save') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({
				score: score,
				percentage: percentage,
				answers: answers
			})
		})
		.then(res => res.json())
		.then(data => {
			console.log("Saved:", data);
		})
		.catch(err => console.error(err));

		// ================= EXISTING UI =================

		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');
		const resultActions = document.getElementById('resultActions');

		animateResultRing(resultRing, percentage);
		resultPercent.textContent = `${score}/${questions.length}`;
		resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;

		resultActions.innerHTML = "";

		if (score >= 13) {
			resultBadge.textContent = "🏆 Mahusay!";

			setTimeout(() => {
				document.getElementById('passModal').classList.add('show');
			}, 800);

		} else {
			resultBadge.textContent = "❌ Hindi pa sapat";
			resultFeedback.textContent = "Too bad, try again.";

			resultActions.innerHTML = `
				<button type="button" class="btn-secondary" onclick="restartQuiz()">
					Ulitin ang Post-Test
				</button>
			`;
		}

		quizPage.style.display = 'none';
		resultPage.classList.add('show');

		if (percentage >= 80) launchConfetti();

		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	function restartQuiz() {
		selectedAnswers.fill('');
		confirmedAnswers.fill(false);
		pendingSelection = null;
		currentQuestionIndex = 0;
		lastDirection = 'right';
		resultPage.classList.remove('show');
		quizPage.style.display = 'block';
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	window.addEventListener('load', () => {
		if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
	});
</script>

</body>
</html>