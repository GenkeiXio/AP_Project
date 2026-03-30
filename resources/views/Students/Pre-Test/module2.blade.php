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
		.btn-secondary {
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
		.btn-secondary:hover:not([disabled]) {
			transform: translateY(-2px);
		}

		.btn-primary[disabled],
		.btn-secondary[disabled] {
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

		.home-btn {
			position: fixed;
			top: 20px;
			left: 20px;
			font-size: 1.6rem;
			text-decoration: none;
			color: #000;
			padding: 10px 14px;
			border-radius: 14px;
			box-shadow: 0 6px 14px rgba(0,0,0,0.14);
			z-index: 1000;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
			background: rgba(255, 255, 255, 0.88);
			backdrop-filter: blur(8px);
		}

		.home-btn:hover {
			transform: scale(1.06);
			box-shadow: 0 8px 18px rgba(0,0,0,0.18);
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

			.action-row,
			.result-actions {
				flex-direction: column;
			}

			.btn-primary,
			.btn-secondary {
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

			.home-btn {
				top: 12px;
				left: 12px;
				font-size: 1.4rem;
				padding: 8px 11px;
			}
		}
	</style>
</head>
<body>

<span class="deco deco-1">🌿</span>
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<a href="{{ route('module.home') }}" class="home-btn" title="Bumalik sa Module">⬅️</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 2</div>
				<h1>Paunang Pagtataya</h1>
				<p>Parang flashcards lang ito — isang tanong kada slide.</p>
			</div>

			<div class="pretest-note">
				💡 Piliin ang sagot at mag-slide sa susunod. Kapag tama, may munting celebration. Kapag mali, may magaan na feedback para tuloy lang ang momentum.
			</div>

			<form id="preTestForm">
				<div class="quiz-page" id="quizPage">
					<div class="quiz-progress">
						<div class="progress-topline">
							<div class="progress-label" id="quizProgressLabel"></div>
							<div class="progress-mini-badge" id="answeredCountLabel">0 / 15 answered</div>
						</div>
						<div class="progress-dots" id="progressDots"></div>
						<!-- <div class="progress-track">
							<div class="progress-fill" id="quizProgressFill"></div>
						</div> -->
					</div>

					<div class="flashcard-stage">
						<div class="question-list" id="questionList"></div>
					</div>

					<div class="action-row">
						<button type="button" class="btn-secondary" id="prevBtn" onclick="goPreviousQuestion()">← Nakaraan</button>
						<button type="button" class="btn-primary" id="nextBtn" onclick="goNextQuestion()">Susunod →</button>
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
			question: '1. Ano ang tinutukoy ng solid waste?',
			options: {
				a: 'Mga likas na yaman',
				b: 'Mga basurang mula sa tahanan at negosyo',
				c: 'Mga hayop sa kagubatan',
				d: 'Mga anyong tubig'
			},
			answer: 'b'
		},
		{
			question: '2. Ano ang pangunahing dahilan ng suliranin sa basura sa Pilipinas?',
			options: {
				a: 'Kawalan ng disiplina sa pagtatapon',
				b: 'Malakas na ulan',
				c: 'Kakulangan sa tubig',
				d: 'Pagdami ng bundok'
			},
			answer: 'a'
		},
		{
			question: '3. Ano ang maaaring maging epekto ng maling pagtatapon ng basura?',
			options: {
				a: 'Pag-unlad ng ekonomiya',
				b: 'Pagbaha at paglaganap ng sakit',
				c: 'Pagdami ng puno',
				d: 'Paglinis ng hangin'
			},
			answer: 'b'
		},
		{
			question: '4. Ano ang deforestation?',
			options: {
				a: 'Pagtatanim ng puno',
				b: 'Paglilinis ng ilog',
				c: 'Pagputol ng mga puno sa kagubatan',
				d: 'Pag-aalaga ng hayop'
			},
			answer: 'c'
		},
		{
			question: '5. Alin sa mga sumusunod ang sanhi ng deforestation?',
			options: {
				a: 'Recycling',
				b: 'Illegal logging',
				c: 'Pagtatanim ng puno',
				d: 'Clean-up drive'
			},
			answer: 'b'
		},
		{
			question: '6. Ano ang maaaring epekto ng pagkakalbo ng kagubatan?',
			options: {
				a: 'Pagdami ng hayop',
				b: 'Pagbaha at pagguho ng lupa',
				c: 'Paglamig ng klima',
				d: 'Pagdami ng isda'
			},
			answer: 'b'
		},
		{
			question: '7. Ano ang climate change?',
			options: {
				a: 'Pagbabago ng anyo ng lupa',
				b: 'Pagtaas ng populasyon',
				c: 'Pagbabago ng temperatura at klima ng mundo',
				d: 'Pagdami ng kagubatan'
			},
			answer: 'c'
		},
		{
			question: '8. Ano ang pangunahing sanhi ng climate change?',
			options: {
				a: 'Pagtatanim ng puno',
				b: 'Paggamit ng fossil fuels',
				c: 'Paglilinis ng kapaligiran',
				d: 'Pag-recycle'
			},
			answer: 'b'
		},
		{
			question: '9. Alin sa mga sumusunod ang epekto ng climate change?',
			options: {
				a: 'Mas malamig na panahon',
				b: 'Mas malalakas na bagyo',
				c: 'Pagdami ng kagubatan',
				d: 'Pagliit ng populasyon'
			},
			answer: 'b'
		},
		{
			question: '10. Ano ang layunin ng Republic Act 9003?',
			options: {
				a: 'Pagpapatupad ng pagmimina',
				b: 'Wastong pamamahala ng basura',
				c: 'Pagputol ng puno',
				d: 'Pagpaparami ng sasakyan'
			},
			answer: 'b'
		},
		{
			question: '11. Ano ang pangunahing tungkulin ng early warning system?',
			options: {
				a: 'Magtanim ng puno',
				b: 'Magbigay ng babala bago ang sakuna',
				c: 'Mangolekta ng basura',
				d: 'Magpatupad ng batas'
			},
			answer: 'b'
		},
		{
			question: '12. Ano ang layunin ng evacuation program?',
			options: {
				a: 'Magtayo ng bahay',
				b: 'Ilipat ang tao sa ligtas na lugar',
				c: 'Maglinis ng kalsada',
				d: 'Magtanim ng halaman'
			},
			answer: 'b'
		},
		{
			question: '13. Bakit mahalaga ang pakikiisa ng mamamayan sa pangangalaga ng kalikasan?',
			options: {
				a: 'Para maging sikat',
				b: 'Para sa pansariling interes',
				c: 'Dahil ito ay pananagutang panlahat',
				d: 'Para kumita ng pera'
			},
			answer: 'c'
		},
		{
			question: '14. Alin sa mga sumusunod ang tamang hakbang sa pangangalaga ng kapaligiran?',
			options: {
				a: 'Pagsusunog ng basura',
				b: 'Waste segregation',
				c: 'Pagtapon sa ilog',
				d: 'Pagputol ng puno'
			},
			answer: 'b'
		},
		{
			question: '15. Bilang isang mag-aaral, paano ka makakatulong sa kalikasan?',
			options: {
				a: 'Huwag makialam',
				b: 'Makilahok sa clean-up drive',
				c: 'Magtapon ng basura kahit saan',
				d: 'Sumira ng halaman'
			},
			answer: 'b'
		}
	];

	const questionList = document.getElementById('questionList');
	const progressDots = document.getElementById('progressDots');
	const quizProgressLabel = document.getElementById('quizProgressLabel');
	const quizProgressFill = document.getElementById('quizProgressFill');
	const answeredCountLabel = document.getElementById('answeredCountLabel');
	const quizPage = document.getElementById('quizPage');
	const resultPage = document.getElementById('resultPage');
	const prevBtn = document.getElementById('prevBtn');
	const nextBtn = document.getElementById('nextBtn');
	const submitBtn = document.getElementById('submitBtn');

	const selectedAnswers = Array(questions.length).fill('');
	const answerLocked = Array(questions.length).fill(false);
	let currentQuestionIndex = 0;
	let lastDirection = 'right';

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

	function getAnsweredCount() {
		return selectedAnswers.filter(answer => answer !== '').length;
	}

	function randomFrom(array) {
		return array[Math.floor(Math.random() * array.length)];
	}

	function updateProgress() {
		const progressPercent = ((currentQuestionIndex + 1) / questions.length) * 100;
		const answeredCount = getAnsweredCount();

		quizProgressLabel.textContent = `Card ${currentQuestionIndex + 1} of ${questions.length}`;
		answeredCountLabel.textContent = `${answeredCount} / ${questions.length} answered`;
		// quizProgressFill.style.width = `${progressPercent}%`;

		progressDots.innerHTML = questions.map((_, idx) => `
			<div class="progress-dot ${idx < currentQuestionIndex ? 'completed' : ''} ${idx === currentQuestionIndex ? 'active' : ''}"></div>
		`).join('');
	}

	function updateActionButtons() {
		prevBtn.disabled = currentQuestionIndex === 0;

		const isLast = currentQuestionIndex === questions.length - 1;
		const hasAnswer = Boolean(selectedAnswers[currentQuestionIndex]);

		nextBtn.style.display = isLast ? 'none' : 'inline-flex';
		submitBtn.style.display = isLast ? 'inline-flex' : 'none';

		nextBtn.disabled = !isLast && !hasAnswer;
		submitBtn.disabled = isLast && !hasAnswer;
	}

	function getCardAnimationClass() {
		if (currentQuestionIndex === 0) return 'card-slide-in-up';
		return lastDirection === 'left' ? 'card-slide-in-left' : 'card-slide-in-right';
	}

	function renderCurrentQuestion() {
		const item = questions[currentQuestionIndex];
		const selectedValue = selectedAnswers[currentQuestionIndex];
		const isLocked = answerLocked[currentQuestionIndex];
		const isCorrect = selectedValue && selectedValue === item.answer;
		const animationClass = getCardAnimationClass();

		const choicesHtml = Object.entries(item.options).map(([key, text]) => {
			let classNames = ['choice'];
			if (selectedValue === key) classNames.push('selected');
			if (isLocked && key === item.answer) classNames.push('correct-reveal');
			if (isLocked && selectedValue === key && selectedValue !== item.answer) classNames.push('soft-wrong');

			return `
				<label class="${classNames.join(' ')}">
					<input type="radio" name="q${currentQuestionIndex}" value="${key}" ${selectedValue === key ? 'checked' : ''} ${isLocked ? 'disabled' : ''}>
					<span>${key}. ${text}</span>
				</label>
			`;
		}).join('');

		let reactionBoxHtml = '';
		if (isLocked && selectedValue) {
			if (isCorrect) {
				reactionBoxHtml = `
					<div class="reaction-box correct show pulse-pop">
						<div class="reaction-emoji">🎉</div>
						<div>${randomFrom(correctMessages)}</div>
					</div>
				`;
			} else {
				reactionBoxHtml = `
					<div class="reaction-box gentle show pulse-pop">
						<div class="reaction-emoji">🌱</div>
						<div>${randomFrom(gentleMessages)}</div>
					</div>
				`;
			}
		} else {
			reactionBoxHtml = `
				<div class="reaction-box">
					<div class="reaction-emoji">✨</div>
					<div>Piliin ang sagot na sa tingin mo ay tama.</div>
				</div>
			`;
		}

		questionList.innerHTML = `
			<div class="question-item ${animationClass}">
				<div class="card-chip-row">
					<div class="card-chip">🎴 Flashcard ${currentQuestionIndex + 1}</div>
					<div class="card-tip">Swipe vibe • one question at a time</div>
				</div>

				<h4>${item.question}</h4>
				<div class="choices">${choicesHtml}</div>
				${reactionBoxHtml}
			</div>
		`;

		updateProgress();
		updateActionButtons();
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
			piece.style.transform = `translateY(0) rotate(${Math.random() * 360}deg)`;
			piece.style.width = `${8 + Math.random() * 6}px`;
			piece.style.height = `${10 + Math.random() * 10}px`;

			document.body.appendChild(piece);
			setTimeout(() => piece.remove(), 4200);
		}
	}

	questionList.addEventListener('change', (event) => {
		const target = event.target;
		if (!target || !target.matches('input[type="radio"]')) return;
		if (answerLocked[currentQuestionIndex]) return;

		selectedAnswers[currentQuestionIndex] = target.value;
		answerLocked[currentQuestionIndex] = true;

		const isCorrect = target.value === questions[currentQuestionIndex].answer;
		if (isCorrect) {
			launchConfetti();
		}

		renderCurrentQuestion();
	});

	function goPreviousQuestion() {
		if (currentQuestionIndex === 0) return;

		lastDirection = 'left';
		currentQuestionIndex -= 1;
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	function goNextQuestion() {
		if (currentQuestionIndex >= questions.length - 1) return;

		if (!selectedAnswers[currentQuestionIndex]) {
			alert('Pumili muna ng sagot bago magpatuloy sa susunod na card.');
			return;
		}

		lastDirection = 'right';
		currentQuestionIndex += 1;
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	function animateResultRing(resultRing, targetPercent, duration = 1100) {
		const startTime = performance.now();
		const fromPercent = 0;

		function frame(currentTime) {
			const elapsed = currentTime - startTime;
			const progress = Math.min(elapsed / duration, 1);
			const eased = 1 - Math.pow(1 - progress, 3);
			const value = Math.round(fromPercent + (targetPercent - fromPercent) * eased);

			resultRing.style.setProperty('--progress', value);

			if (progress < 1) {
				requestAnimationFrame(frame);
			}
		}

		resultRing.style.setProperty('--progress', fromPercent);
		requestAnimationFrame(frame);
	}

	function getFeedbackByScore(score) {
		if (score >= 11) {
			return {
				badge: '🏆 Napakahusay!',
				feedback: 'Ang ganda ng iyong pundasyon. Ready ka na sa susunod na bahagi!',
				interpretation: 'Handa'
			};
		}
		if (score >= 6) {
			return {
				badge: '👏 Magaling!',
				feedback: 'May kaalaman ka na, patuloy pa ang pag-unlad.',
				interpretation: 'May kaalaman'
			};
		}
		return {
			badge: '🌱 Warm-up pa lang!',
			feedback: 'Kailangan ng gabay pa. Gamitin ito bilang panimulang lakas.',
			interpretation: 'Kailangan ng gabay'
		};
	}

	function submitPreTest() {
		if (selectedAnswers.some(answer => !answer)) {
			alert('Pakisagutan muna ang lahat ng card bago tapusin.');
			return;
		}

		const score = questions.reduce((total, item, index) => {
			return total + (selectedAnswers[index] === item.answer ? 1 : 0);
		}, 0);

		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');
		const percentage = Math.round((score / questions.length) * 100);
		const level = getFeedbackByScore(score);

		animateResultRing(resultRing, percentage);
		resultPercent.textContent = `${score}/${questions.length}`;
		resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;
		resultBadge.textContent = level.badge;
		resultFeedback.textContent = level.feedback;
		document.getElementById('resultInterpretation').textContent = `Interpretasyon: ${level.interpretation} (${score} points)`;

		quizPage.style.display = 'none';
		resultPage.classList.add('show');

		if (percentage >= 80) {
			launchConfetti();
		}

		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	function restartQuiz() {
		selectedAnswers.fill('');
		answerLocked.fill(false);
		currentQuestionIndex = 0;
		lastDirection = 'right';

		resultPage.classList.remove('show');
		quizPage.style.display = 'block';

		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	window.addEventListener('load', () => {
		if ('scrollRestoration' in history) {
			history.scrollRestoration = 'manual';
		}
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
	});
</script>

</body>
</html>