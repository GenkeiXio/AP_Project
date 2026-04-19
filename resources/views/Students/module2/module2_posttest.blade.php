@extends('Students.studentslayout')
@section('title', 'Hamon at Tugon: Module 2 Post-Test')
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
			margin-top: 8px; /* ADD THIS */
			line-height: 1.6; /* slightly more breathing room */
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

		.single-question {
			margin-bottom: 28px; /* increased spacing */
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

<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

<a href="{{ route('inner.map2') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 2</div>
				<h1>PANGHULING PAGSUSULIT</h1>
                <p>Panuto: Basahin at suriin ang bawat sitwasyon. Piliin ang titik ng pinakaangkop na sagot.</p>
			</div>

			<!-- <div class="pretest-note">
				💡 Sagutin ang bawat tanong at i-click ang "✓ Kumpirmahin". <br> <br>Kailangang makakuha ng 13/15 upang makapasa.
			</div> -->

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

					<div class="action-row">
						<button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmAnswer()">✓ Kumpirmahin</button>
						<!-- <button type="button" class="btn-primary" id="nextBtn" onclick="goNextQuestion()" disabled>Susunod →</button> -->
						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPreTest()" style="display:none;">Tapusin ang Panghuling Pagsusulit 🚀</button>
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
						
						<div class="result-actions" id="resultActions">
							<button type="button" class="btn-secondary" onclick="restartQuiz()">Ulitin ang Panghuling Pagsusulit</button>
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
	function shuffleArray(array) {
		for (let i = array.length - 1; i > 0; i--) {
			const j = Math.floor(Math.random() * (i + 1));
			[array[i], array[j]] = [array[j], array[i]];
		}
	}

	function shuffleQuestionsAndChoices() {
		// Shuffle questions
		shuffleArray(questions);

		// Shuffle choices BUT keep a,b,c,d fixed
		questions.forEach(q => {
			const optionKeys = Object.keys(q.options); // ['a','b','c','d']
			const optionTexts = optionKeys.map(key => q.options[key]);

			// Shuffle only the TEXTS
			shuffleArray(optionTexts);

			// Reassign shuffled texts back to a,b,c,d
			const newOptions = {};
			optionKeys.forEach((key, index) => {
				newOptions[key] = optionTexts[index];
			});

			// Preserve correct answer
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
			question: 'Matapos ang clean-up drive sa isang barangay, nabawasan ang pagbaha ngunit bumalik ito makalipas ang ilang linggo. Ano ang pinakaangkop na paliwanag?',
			options: {
				a: 'Hindi tuloy-tuloy ang pagpapatupad ng wastong pamamahala ng basura',
				b: 'Biglang lumakas ang ulan kaya bumaha muli ang buong lugar',
				c: 'Dumami ang mga tao kaya nagkaroon ng mas maraming aktibidad',
				d: 'Nagbago ang direksyon ng hangin kaya naapektuhan ang tubig'
			},
			answer: 'a'
		},
		{
			question: 'Sa isang paaralan, may programa sa waste segregation ngunit hindi ito sinusunod ng karamihan. Ano ang pinakamabisang solusyon?',
			options: {
				a: 'Magpatupad ng mahigpit na monitoring at information campaign',
				b: 'Magdagdag ng mas maraming basurahan sa loob ng paaralan',
				c: 'Bawasan ang oras ng klase upang magkaroon ng paglilinis',
				d: 'Ipagbawal ang pagdadala ng pagkain sa loob ng silid-aralan'
			},
			answer: 'a'
		},
		{
			question: 'Napansin na dumadami ang kaso ng dengue sa isang lugar na maraming tambak na basura. Ano ang pinakaangkop na ugnayan?',
			options: {
				a: 'Ang basura ay nagiging breeding ground ng mga lamok na may sakit',
				b: 'Ang basura ay nagpapababa ng resistensya ng mga tao sa lugar',
				c: 'Ang basura ay nagdudulot ng pag-init ng temperatura sa paligid',
				d: 'Ang basura ay nagiging sanhi ng kakulangan sa pagkain ng tao'
			},
			answer: 'a'
		},
		{
			question: 'Sa isang komunidad, pinutol ang maraming puno upang gawing sakahan. Ano ang pangmatagalang epekto nito?',
			options: {
				a: 'Paglala ng soil erosion at pagbaha sa mga mabababang lugar',
				b: 'Pagdami ng produksyon ng pagkain sa buong komunidad',
				c: 'Pagbaba ng temperatura sa kagubatan at kapaligiran',
				d: 'Pagtaas ng bilang ng hayop sa mga kalapit na lugar'
			},
			answer: 'a'
		},
		{
			question: 'Bakit mahalaga ang reforestation sa mga lugar na nakaranas ng deforestation?',
			options: {
				a: 'Naibabalik nito ang kakayahan ng lupa na sumipsip ng tubig',
				b: 'Nadadagdagan nito ang bilang ng gusali sa komunidad dahil sa pagputol ng puno',
				c: 'Napapabilis nito ang pag-unlad ng mga negosyo sa lugar',
				d: 'Nababawasan nito ang dami ng ulan sa kapaligiran'
			},
			answer: 'a'
		},
		{
			question: 'Sa konteksto ng climate change, bakit mas nagiging matindi ang epekto ng bagyo sa Albay?',
			options: {
				a: 'Mas mainit ang karagatan kaya mas malakas ang enerhiya ng bagyo',
				b: 'Mas kaunti ang ulan kaya nagiging malakas ang hangin',
				c: 'Mas malamig ang klima kaya bumabagal ang paggalaw ng bagyo sa lugar na ito',
				d: 'Mas kaunti ang puno kaya nababawasan ang ulan sa lugar'
			},
			answer: 'a'
		},
		{
			question: 'Alin sa mga sumusunod ang nagpapakita ng climate change mitigation?',
			options: {
				a: 'Paggamit ng renewable energy at pagbawas ng carbon emissions',
				b: 'Paglikas ng mga tao sa oras ng bagyo sa komunidad',
				c: 'Pagtatayo ng evacuation centers sa mga barangay',
				d: 'Paghahanda ng go bag bago dumating ang sakuna'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang pinakamabisang paraan upang mabawasan ang epekto ng climate change sa araw-araw?',
			options: {
				a: 'Pagtitipid ng enerhiya at paggamit ng environment-friendly practices',
				b: 'Pag-iwas sa pakikilahok sa mga gawaing pangkomunidad',
				c: 'Pagsusunog ng basura upang mabawasan ang tambak nito',
				d: 'Pagputol ng puno upang mapalawak ang mga tirahan'
			},
			answer: 'a'
		},
		{
			question: 'Sa pagpapatupad ng disaster preparedness, bakit mahalaga ang early warning system?',
			options: {
				a: 'Nagbibigay ito ng sapat na oras upang makapaghanda ang komunidad',
				b: 'Pinapabagal nito ang pagdating ng bagyo sa isang lugar',
				c: 'Pinipigilan nito ang pagbuo ng sakuna sa kapaligiran',
				d: 'Binabawasan nito ang lakas ng ulan sa komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Ano ang pangunahing layunin ng Republic Act 9729?',
			options: {
				a: 'Maglatag ng mga hakbang upang matugunan ang epekto ng climate change',
				b: 'Magbigay ng ayuda sa mga nasalanta ng kalamidad sa bansa',
				c: 'Magpatupad ng buwis para sa mga industriyang polusyon at iba pang katulad nito',
				d: 'Magkontrol ng populasyon sa mga lungsod sa bansa'
			},
			answer: 'a'
		},
		{
			question: 'Alin ang nagpapakita ng aktibong pakikiisa ng mamamayan sa disaster risk reduction?',
			options: {
				a: 'Pakikilahok sa disaster drills at pagsunod sa mga babala',
				b: 'Pananatili sa bahay kahit may utos ng paglikas',
				c: 'Pagbabahagi ng maling impormasyon sa social media',
				d: 'Pag-iwas sa pakikilahok sa mga gawaing pangkomunidad'
			},
			answer: 'a'
		},
		{
			question: 'Sa isang barangay, mayroong Materials Recovery Facility (MRF). Ano ang pangunahing layunin nito?',
			options: {
				a: 'Iproseso at paghiwalayin ang mga recyclable at biodegradable waste',
				b: 'Magtapon ng lahat ng uri ng basura sa iisang lugar',
				c: 'Sunugin ang basura upang mabawasan ang dami nito',
				d: 'Mag-imbak ng basura nang matagal sa komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Bakit mahalaga ang preemptive evacuation sa mga lugar malapit sa Bulkang Mayon?',
			options: {
				a: 'Naiiwasan nito ang panganib bago pa lumala ang sitwasyon',
				b: 'Pinipigilan nito ang pagputok ng bulkan sa lugar',
				c: 'Binabawasan nito ang init na nagmumula sa bulkan',
				d: 'Pinapabagal nito ang pagdaloy ng lava sa komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Ano ang pinakaangkop na papel ng pamahalaan sa pagtugon sa suliraning pangkapaligiran?',
			options: {
				a: 'Magpatupad ng batas at programang pangkalikasan sa komunidad',
				b: 'Hayaan ang mga mamamayan na magdesisyon para sa sarili',
				c: 'Magbigay lamang ng impormasyon nang walang aksyon',
				d: 'Ituon ang pansin sa ekonomiya kaysa sa kalikasan'
			},
			answer: 'a'
		},
		{
			question: 'Kung ikaw ay lider ng kabataan sa inyong barangay, alin ang pinakaepektibong hakbang?',
			options: {
				a: 'Maglunsad ng clean-up drive at information campaign sa komunidad',
				b: 'Maghintay ng aksyon mula sa pamahalaan bago kumilos',
				c: 'Iwasan ang pakikilahok sa mga gawaing pangkapaligiran',
				d: 'Ituon lamang ang pansin sa personal na gawain'
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

	// ================= STATE =================
	const selectedAnswers = Array(questions.length).fill('');
	const confirmedAnswers = Array(questions.length).fill(false);

	let retryCount = 0;
	const maxRetries = 2;

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

	// ================= RENDER =================
	function renderAllQuestions() {
		let questionsHtml = '';

		questions.forEach((item, index) => {
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

			questionsHtml += `
				<div class="single-question">
					<h4>${index + 1}. ${item.question}</h4>
					<div class="choices">${choicesHtml}</div>
				</div>
			`;
		});

		questionList.innerHTML = `
			<div class="question-item">
				${questionsHtml}
			</div>
		`;

		updateProgressAll();
	}

	// ================= INTERACTION =================
	window.selectAnswer = function(index, key) {
		if (confirmedAnswers[index]) return;

		selectedAnswers[index] = key;
		renderAllQuestions();
	};

	function confirmAnswer() {
		if (selectedAnswers.includes('')) {
			alert('Sagutan muna lahat bago kumpirmahin.');
			return;
		}

		questions.forEach((_, index) => {
			confirmedAnswers[index] = true;
		});

		renderAllQuestions();

		submitBtn.style.display = 'inline-flex';
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

	// ================= RESULT =================
	function submitPreTest() {
		if (!confirmedAnswers.every(c => c)) {
			alert('Pakisagutan at kumpirmahin muna ang lahat ng tanong.');
			return;
		}

		const score = questions.reduce((total, item, index) =>
			total + (selectedAnswers[index] === item.answer ? 1 : 0), 0);

		const percentage = Math.round((score / questions.length) * 100);

		// ===== SEND TO BACKEND (UNCHANGED) =====
		const answers = questions.map((q, index) => ({
			question_number: index + 1,
			selected_answer: selectedAnswers[index],
			correct_answer: q.answer,
			is_correct: selectedAnswers[index] === q.answer
		}));

		fetch("{{ route('student.module2.posttest.save') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({ score, percentage, answers })
		});

		// ===== UI =====
		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');
		const resultActions = document.getElementById('resultActions');

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
			resultFeedback.textContent = "Subukan muli.";

			if (retryCount < maxRetries) {
				resultActions.innerHTML = `
					<button class="btn-secondary" onclick="restartQuiz()">
						Ulitin (${maxRetries - retryCount} natitira)
					</button>
				`;
			} else {
				resultActions.innerHTML = `
					<div style="font-weight:800;color:#7a2e2e;">
						Naabot na ang maximum retries.
					</div>
				`;
			}
		}

		quizPage.style.display = 'none';
		resultPage.classList.add('show');

		if (percentage >= 80) launchConfetti();
	}

	// ================= RETRY =================
	function restartQuiz() {
		if (retryCount >= maxRetries) {
			alert('Maximum retries reached.');
			return;
		}

		retryCount++;

		selectedAnswers.fill('');
		confirmedAnswers.fill(false);

		resultPage.classList.remove('show');
		quizPage.style.display = 'block';

		renderAllQuestions();
	}

	// ================= INIT =================
	window.addEventListener('load', () => {
		shuffleQuestionsAndChoices();
		renderAllQuestions();
	});
</script>

@endsection