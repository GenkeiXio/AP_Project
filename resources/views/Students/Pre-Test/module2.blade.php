<!DOCTYPE html>
<html lang="fil">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hamon at Tugon: Module 2 Pre-Test</title>

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
			/* padding: 5px 10px; */
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
</head>
<body>

<img src="{{ asset('pictures/mod2_innermap.png') }}" class="background-map">

<a href="{{ route('module.home') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 2</div>
				<h1>Paunang Pagtataya</h1>
				<p>Pumili ng sagot, pagkatapos kumpirmahin bago magpatuloy.</p>
			</div>

			<div class="pretest-note">
				💡 Pumili ng sagot at I-click ang "✓ Kumpirmahin". Kapag nakumpirma na, pwede nang pumunta sa susunod na tanong.
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

					<div class="action-row">
						<button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmAnswer()">✓ Kumpirmahin</button>
						<!-- <button type="button" class="btn-primary" id="nextBtn" onclick="goNextQuestion()" disabled>Susunod →</button> -->
						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPreTest()" style="display:none;">Tapusin ang Pre-Test 🚀</button>
					</div>
				</div>

				<div class="result-page" id="resultPage" aria-live="polite">
					<div class="result-box show" id="resultBox">
						<div class="result-title">Resulta ng Pre-Test</div>
						<div class="result-ring" id="resultRing" style="--progress:0;">
							<div class="result-percent" id="resultPercent">0/0</div>
						</div>
						<div class="result-score" id="resultScoreText"></div>
						<div class="badge-pill" id="resultBadge">🌟 Mahusay!</div>
						<div class="result-feedback" id="resultFeedback"></div>
						<div class="result-interpretation" id="resultInterpretation">Interpretasyon ng Iskor: 0–5 → Kailangan ng gabay, 6–10 → May kaalaman, 11–15 → Handa</div>

						<div class="retry-indicator" id="retryIndicator">
							🔁 Natitirang retries: 2 / 2
						</div>

						<div class="result-actions">
							<button type="button" class="btn-secondary" onclick="restartQuiz()">Ulitin ang Pre-Test</button>
							<a href="{{ route('inner.map2') }}" class="btn-primary">Magpatuloy →</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	const questions = [
		{ 
			question: 'Ano ang tinutukoy ng solid waste?', 
			options: { 
				a: 'Mga materyal na maaaring gamitin muli sa produksyon', 
				b: 'Mga basurang nagmumula sa tahanan at komersyal na gawain', 
				c: 'Mga likas na yaman na matatagpuan sa kapaligiran', 
				d: 'Mga sangkap na ginagamit sa industriyal na proseso' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang pangunahing dahilan ng suliranin sa basura sa Pilipinas?', 
			options: { 
				a: 'Kakulangan sa disiplina sa wastong pagtatapon ng basura', 
				b: 'Pagbabago ng klima sa iba’t ibang rehiyon', 
				c: 'Pagtaas ng produksyon ng agrikultura', 
				d: 'Pagdami ng likas na yaman sa bansa' 
			}, 
			answer: 'a' 
		},
		{ 
			question: 'Ano ang maaaring maging epekto ng maling pagtatapon ng basura?', 
			options: { 
				a: 'Pagtaas ng antas ng kabuhayan sa komunidad', 
				b: 'Pagbaha at paglaganap ng mga sakit sa kapaligiran', 
				c: 'Pagdami ng likas na yaman sa kalikasan', 
				d: 'Pagbuti ng kalidad ng hangin sa lungsod' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang deforestation?', 
			options: { 
				a: 'Proseso ng pagtatanim ng mga puno sa kagubatan', 
				b: 'Paglilinis ng mga anyong tubig sa kapaligiran', 
				c: 'Malawakang pagputol at pagkawala ng mga puno sa kagubatan', 
				d: 'Pagpapanatili ng biodiversity sa isang lugar' 
			}, 
			answer: 'c' 
		},
		{ 
			question: 'Alin sa mga sumusunod ang sanhi ng deforestation?', 
			options: { 
				a: 'Malawakang recycling ng mga materyales', 
				b: 'Ilegal na pagtotroso at walang kontrol na pagputol ng puno', 
				c: 'Pagtatanim ng mga bagong puno sa komunidad', 
				d: 'Pagpapatupad ng environmental protection programs' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang maaaring epekto ng pagkakalbo ng kagubatan?', 
			options: { 
				a: 'Pagdami ng mga hayop sa natural na tirahan', 
				b: 'Pagbaha at pagguho ng lupa sa mga apektadong lugar', 
				c: 'Pagbuti ng kalidad ng lupa sa kabundukan', 
				d: 'Paglakas ng produksyon ng agrikultura' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang climate change?', 
			options: { 
				a: 'Pagbabago sa anyo ng lupa dulot ng kalikasan', 
				b: 'Pagtaas ng populasyon sa iba’t ibang bansa', 
				c: 'Pangmatagalang pagbabago sa temperatura at klima ng mundo', 
				d: 'Pagdami ng kagubatan sa iba’t ibang rehiyon' 
			}, 
			answer: 'c' 
		},
		{ 
			question: 'Ano ang pangunahing sanhi ng climate change?', 
			options: { 
				a: 'Pagpapalawak ng mga kagubatan sa bansa', 
				b: 'Paggamit ng fossil fuels at paglabas ng greenhouse gases', 
				c: 'Paglilinis ng kapaligiran sa mga lungsod', 
				d: 'Pagdami ng recycling programs sa komunidad' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Alin sa mga sumusunod ang epekto ng climate change?', 
			options: { 
				a: 'Paglamig ng temperatura sa buong mundo', 
				b: 'Mas malalakas at mas madalas na mga bagyo', 
				c: 'Pagdami ng kagubatan sa iba’t ibang bansa', 
				d: 'Pagbaba ng populasyon ng tao sa lungsod' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang layunin ng Republic Act 9003?', 
			options: { 
				a: 'Pagpapaunlad ng pagmimina sa bansa', 
				b: 'Wastong pamamahala at segregasyon ng solid waste', 
				c: 'Pagkontrol sa pagputol ng mga puno', 
				d: 'Pagpaparami ng sasakyan sa lungsod' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang pangunahing tungkulin ng early warning system?', 
			options: { 
				a: 'Pagpaparami ng mga puno sa kagubatan', 
				b: 'Pagbibigay ng babala bago mangyari ang sakuna', 
				c: 'Pagkolekta ng basura sa komunidad', 
				d: 'Pagpapatupad ng mga batas pangkalikasan' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Ano ang layunin ng evacuation program?', 
			options: { 
				a: 'Pagtatayo ng mga bagong tirahan', 
				b: 'Paglipat ng mga tao sa mas ligtas na lugar', 
				c: 'Paglilinis ng mga lansangan', 
				d: 'Pagtatanim ng mga halaman sa komunidad' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Bakit mahalaga ang pakikiisa ng mamamayan sa pangangalaga ng kalikasan?', 
			options: { 
				a: 'Upang makilala sa lipunan', 
				b: 'Para sa pansariling kapakinabangan', 
				c: 'Dahil ito ay kolektibong responsibilidad ng lahat', 
				d: 'Upang magkaroon ng karagdagang kita' 
			}, 
			answer: 'c' 
		},
		{ 
			question: 'Alin sa mga sumusunod ang tamang hakbang sa pangangalaga ng kapaligiran?', 
			options: { 
				a: 'Pagsusunog ng mga basura sa bakuran', 
				b: 'Maayos na paghihiwalay ng basura ayon sa uri', 
				c: 'Pagtatapon ng basura sa ilog o dagat', 
				d: 'Pagputol ng mga puno para sa gamit' 
			}, 
			answer: 'b' 
		},
		{ 
			question: 'Bilang isang mag-aaral, paano ka makakatulong sa kalikasan?', 
			options: { 
				a: 'Hindi pakikialam sa mga isyu sa kapaligiran', 
				b: 'Aktibong pakikilahok sa clean-up drive at environmental programs', 
				c: 'Pagtatapon ng basura kung saan-saan', 
				d: 'Pagsira sa mga halaman sa paligid' 
			}, 
			answer: 'b' 
		}
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

	const correctSfx = new Audio('/audio/mod2correct.mp3');
	const wrongSfx = new Audio('/audio/mod2wrong.mp3');

	const selectedAnswers = Array(questions.length).fill('');
	const confirmedAnswers = Array(questions.length).fill(false);
	let currentQuestionIndex = 0;
	let lastDirection = 'right';
	let pendingSelection = null;
	let retryCount = 0;
	const maxRetries = 2;

	function shuffleArray(array) {
		for (let i = array.length - 1; i > 0; i--) {
			const j = Math.floor(Math.random() * (i + 1));
			[array[i], array[j]] = [array[j], array[i]];
		}
		return array;
	}

	function shuffleQuestionsAndChoices() {
		// Shuffle the questions array
		shuffleArray(questions);
		
		// Shuffle choices for each question
		questions.forEach(q => {
			const optionKeys = Object.keys(q.options); // ['a', 'b', 'c', 'd']
			const optionTexts = optionKeys.map(key => q.options[key]);
			
			// Shuffle the option texts
			shuffleArray(optionTexts);
			
			// Create new options object with shuffled order
			const newOptions = {};
			optionKeys.forEach((key, index) => {
				newOptions[key] = optionTexts[index];
			});
			
			// Find which key now contains the correct answer
			const correctAnswerText = q.options[q.answer];
			const newAnswerKey = Object.keys(newOptions).find(key => newOptions[key] === correctAnswerText);
			
			q.options = newOptions;
			q.answer = newAnswerKey;
		});
	}

	const correctMessages = ['🎉 Tama! Galing mo!', '✨ Nice one! Tuloy lang!', '🌟 Sakto! Good job!', '🎊 Ayos! Nakuha mo!', '🧠 Correct! Malakas!'];
	const gentleMessages = ['🌱 Okay lang iyan — learning moment ito.', '💛 Good try! Bawi tayo sa next card.', '✨ Ayos lang — part ito ng pagkatuto.', '🌤️ Hindi man tama ngayon, mas lilinaw ito mamaya.', '📘 Nice try! Tuloy lang, nandito lang ang aralin.'];

	function randomFrom(array) { return array[Math.floor(Math.random() * array.length)]; }

	function getAnsweredCount() { return confirmedAnswers.filter(confirmed => confirmed === true).length; }

	function updateProgressAll() {
		const answeredCount = selectedAnswers.filter(a => a !== '').length;

		answeredCountLabel.textContent = `${answeredCount} / ${questions.length} answered`;

		progressDots.innerHTML = questions.map((_, idx) => `
			<div class="progress-dot ${confirmedAnswers[idx] ? 'completed' : ''}"></div>
		`).join('');
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

		// 🔥 ONE CARD ONLY
		questionList.innerHTML = `
			<div class="question-item">
				${questionsHtml}
			</div>
		`;

		updateProgressAll();
	}

	window.selectAnswer = function(index, selectedKey) {
		if (confirmedAnswers[index]) return;

		selectedAnswers[index] = selectedKey;
		renderAllQuestions();
	};

	function confirmAnswer() {
		// Check if all answered
		if (selectedAnswers.includes('')) {
			alert('Sagutan muna lahat bago kumpirmahin.');
			return;
		}

		questions.forEach((item, index) => {
			confirmedAnswers[index] = true;
		});

		renderAllQuestions();

		// enable submit
		submitBtn.style.display = 'inline-flex';
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
		renderAllQuestions();
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

		// Prepare answers for backend
		const answersPayload = questions.map((q, index) => ({
			question_number: index + 1,
			selected: selectedAnswers[index],
			correct: q.answer,
			is_correct: selectedAnswers[index] === q.answer
		}));

		// 🔥 SEND TO BACKEND
		fetch("{{ route('student.module2.pretest.save') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({
				score: score,
				percentage: percentage,
				answers: answersPayload
			})
		})
		.then(res => res.json())
		.then(data => {
			console.log(data);
		})
		.catch(err => {
			console.error("Error saving pretest:", err);
		});

		// ===== EXISTING RESULT LOGIC =====
		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');

		const level = getFeedbackByScore(score);

		animateResultRing(resultRing, percentage);
		resultPercent.textContent = `${score}/${questions.length}`;
		resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;
		resultBadge.textContent = level.badge;
		resultFeedback.textContent = level.feedback;
		document.getElementById('resultInterpretation').textContent = `Interpretasyon: ${level.interpretation} (${score} points)`;

		quizPage.style.display = 'none';
		resultPage.classList.add('show');

		if (percentage >= 80) launchConfetti();
		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	function updateRetryIndicator() {
		const remaining = maxRetries - retryCount;
		const retryIndicator = document.getElementById('retryIndicator');

		retryIndicator.textContent = `🔁 Natitirang retries: ${remaining} / ${maxRetries}`;

		// Optional: visual warning when 0
		if (remaining === 0) {
			retryIndicator.style.background = '#ffe5e5';
			retryIndicator.style.border = '1px solid #e5a5a5';
			retryIndicator.style.color = '#7a2e2e';
		}
	}

	function restartQuiz() {
		if (retryCount >= maxRetries) {
			alert('Naabot mo na ang maximum na 2 retries.');
			return;
		}

		retryCount++;

		selectedAnswers.fill('');
		confirmedAnswers.fill(false);

		resultPage.classList.remove('show');
		quizPage.style.display = 'block';

		updateRetryIndicator(); // 🔥 ADD THIS

		renderAllQuestions();
	}

	window.addEventListener('load', () => {
		if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
		shuffleQuestionsAndChoices();
		renderAllQuestions();
		updateRetryIndicator();
		window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
	});
</script>

</body>
</html>