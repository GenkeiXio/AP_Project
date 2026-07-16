@extends('Students.studentslayout')
@section('title', 'Panghuling Pagsusulit: Module 4')
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
			background: linear-gradient(135deg, rgba(255,255,255,0.35), rgba(255,255,255,0));
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
			background: linear-gradient(180deg, #ffffff 0%, #fffdf9 100%);
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
			z-index: 999;
			background: white;
			padding: 10px 15px;
			border-radius: 8px;
			text-decoration: none;
			font-weight: bold;
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
		}

		.back-button:hover {
			transform: scale(1.06);
		}

		/* Unanswered question highlight */
		.unanswered-highlight {
			background-color: #fff3df !important;
			transition: background-color 0.5s ease;
			border-radius: 16px;
			padding: 12px;
			border: 2px solid #f4c97a;
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

		@media (max-width: 768px) {
			body { overflow: auto; }

			.pretest-card {
				padding: 14px;
				border-radius: 22px;
			}

			.question-item {
				padding: 15px;
				min-height: 340px;
			}

			.flashcard-stage,
			.question-list { min-height: 340px; }

			.action-row { flex-direction: column; }

			.btn-primary,
			.btn-secondary,
			.btn-confirm { width: 100%; }

			.result-ring {
				width: 140px;
				height: 140px;
			}

			.result-ring::before {
				width: 106px;
				height: 106px;
			}

			.result-percent { font-size: 1.42rem; }

			.back-button {
				top: 12px;
				left: 12px;
				padding: 8px 12px;
				font-size: 0.85rem;
			}
		}

		@keyframes fadePop {
			from { opacity: 0; transform: translateY(18px) scale(0.98); }
			to   { opacity: 1; transform: translateY(0) scale(1); }
		}

		@keyframes slideInRight {
			from { opacity: 0; transform: translateX(60px) rotate(0.7deg) scale(0.98); }
			to   { opacity: 1; transform: translateX(0) rotate(0) scale(1); }
		}

		@keyframes slideInLeft {
			from { opacity: 0; transform: translateX(-60px) rotate(-0.7deg) scale(0.98); }
			to   { opacity: 1; transform: translateX(0) rotate(0) scale(1); }
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
			0%   { transform: translateY(0) rotate(0deg); opacity: 1; }
			100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
		}
	</style>
@endpush

@section('content')

<img src="{{ asset('pictures/mod4_innermap.png') }}" class="background-map">

<a href="{{ route('inner.map4') }}" class="back-button" title="Bumalik sa Module">⬅️ Bumalik</a>

<div class="main-wrapper">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 4</div>
				<h1>PANGHULING PAGSUSULIT</h1>
				<p>Panuto: Basahin at suriin ang bawat sitwasyon. Piliin ang titik ng pinakaangkop na sagot.</p>
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

					<div class="action-row">
						<button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmAnswer()">✓ Kumpirmahin</button>
						<button type="button" class="btn-primary" id="nextCardBtn" onclick="goNextCard()" style="display:none;">
							Susunod →
						</button>
						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPostTest()" style="display:none;">
							Tapusin ang Panghuling Pagsusulit 🚀
						</button>
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
						<div class="result-actions" id="resultActions"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	// ================= QUESTIONS =================
	const questions = [
		{
			question: 'Matapos ang karanasan sa Super Typhoon Rolly, alin ang pinakaangkop na indikasyon na bumaba ang disaster risk ng isang komunidad?',
			options: {
				a: 'Tumaas ang bilang ng evacuation centers ngunit mababa ang paggamit nito',
				b: 'Tumaas ang kahandaan at partisipasyon ng komunidad sa preparedness drills',
				c: 'Dumami ang relief goods na nakaimbak sa barangay hall',
				d: 'Lumakas ang istruktura ng ilang piling bahay sa komunidad'
			},
			answer: 'b'
		},
		{
			question: 'Sa flashflood na may lahar mula sa Mayon Volcano, alin ang nagpapakita ng maling risk assessment?',
			options: {
				a: 'Pagkilala na mas mapanganib ang lahar kaysa karaniwang baha',
				b: 'Pag-iwas sa daluyan ng baha at pagharang sa access ng tao',
				c: 'Pag-aakalang ligtas tumawid dahil mababaw ang bahagi ng tubig',
				d: 'Pagbibigay ng babala at agarang paglikas sa komunidad'
			},
			answer: 'c'
		},
		{
			question: 'Sa lindol, alin ang nagpapakita ng pinakamataas na antas ng situational awareness habang may aftershocks?',
			options: {
				a: 'Bumalik agad sa bahay upang kunin ang mahahalagang gamit',
				b: 'Manatili sa open area at iwasan ang mga gusaling may pinsala',
				c: 'Maghintay ng opisyal na anunsyo bago kumilos',
				d: 'Pumasok sa gusali upang suriin ang kalagayan nito'
			},
			answer: 'b'
		},
		{
			question: 'Kapag itinaas sa Alert Level 3 ang Bulkang Mayon, alin ang pinakamalinaw na implikasyon sa risk level?',
			options: {
				a: 'Katamtamang panganib na may limitadong epekto sa komunidad',
				b: 'Mataas na panganib na nangangailangan ng agarang paghahanda',
				c: 'Mababang panganib na hindi nangangailangan ng aksyon',
				d: 'Walang panganib hangga\'t walang nakikitang lava'
			},
			answer: 'b'
		},
		{
			question: 'Sa isang landslide-prone area, alin ang nagpapakita ng maling ugnayan ng hazard at vulnerability?',
			options: {
				a: 'Matinding ulan at marupok na lupa ay nagpapataas ng panganib',
				b: 'Mataas na lugar ngunit walang vegetation ay mas delikado',
				c: 'Matibay na bahay ay nag-aalis ng panganib mula sa landslide',
				d: 'Pagputol ng puno ay nagpapataas ng posibilidad ng pagguho'
			},
			answer: 'c'
		},
		{
			question: 'Sa pagkawala ng kuryente at tubig, alin ang nagpapakita ng ineffective community response?',
			options: {
				a: 'Pag-oorganisa ng relief distribution batay sa pangangailangan',
				b: 'Pagbabahagi ng limitadong resources sa mga apektadong pamilya',
				c: 'Pag-asa lamang sa external aid nang walang lokal na aksyon',
				d: 'Pag-coordinate sa barangay para sa maayos na sistema'
			},
			answer: 'c'
		},
		{
			question: 'Alin sa mga sumusunod ang nagpapakita ng high resilience ngunit moderate vulnerability?',
			options: {
				a: 'Komunidad na may kahandaan ngunit matatagpuan sa hazard-prone area',
				b: 'Komunidad na walang kaalaman ngunit nasa ligtas na lugar',
				c: 'Komunidad na walang hazard ngunit mataas ang kahinaan',
				d: 'Komunidad na walang partisipasyon ngunit may sapat na resources'
			},
			answer: 'a'
		},
		{
			question: 'Sa isang barangay na paulit-ulit na binabaha, alin ang pinakamabisang long-term risk reduction strategy?',
			options: {
				a: 'Pagdaragdag ng relief goods bago ang sakuna',
				b: 'Pagpapatibay ng evacuation response tuwing may bagyo',
				c: 'Pagpaplano ng land use at environmental management',
				d: 'Pagbibigay ng ayuda pagkatapos ng bawat kalamidad'
			},
			answer: 'c'
		},
		{
			question: 'Bakit kritikal ang damage assessment sa decision-making phase ng Disaster Risk Reduction Management (DRRM)?',
			options: {
				a: 'Nakakatulong ito upang matukoy ang lawak ng pinsala at prayoridad',
				b: 'Nakakapigil ito sa pagdating ng susunod na sakuna',
				c: 'Nakakapagpahina ito sa epekto ng hazard',
				d: 'Nakakabawas ito sa vulnerability ng komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Sa evacuation center management, alin ang nagpapakita ng system failure?',
			options: {
				a: 'Maayos na koordinasyon at malinaw na impormasyon sa evacuees',
				b: 'Sapat na suplay ngunit walang organisadong distribusyon',
				c: 'Aktibong partisipasyon ng mga lider at volunteers',
				d: 'Malinaw na sistema ng pagrehistro ng evacuees'
			},
			answer: 'b'
		},
		{
			question: 'Sa panahon ng baha, alin ang nagpapakita ng false sense of safety?',
			options: {
				a: 'Pag-iwas sa tubig na hindi alam ang lalim nito',
				b: 'Pananatili sa loob ng bahay kung ligtas ang lokasyon',
				c: 'Pagtawid sa mababaw na bahagi ng baha na may agos',
				d: 'Pakikinig sa mga babala mula sa awtoridad'
			},
			answer: 'c'
		},
		{
			question: 'Alin ang nagpapakita ng proactive role ng kabataan sa DRRM?',
			options: {
				a: 'Pag-antay ng direktiba bago kumilos sa komunidad',
				b: 'Pakikilahok sa drills at pagbabahagi ng tamang impormasyon',
				c: 'Pag-iwas sa responsibilidad sa panahon ng sakuna',
				d: 'Pagtutok lamang sa personal na kaligtasan'
			},
			answer: 'b'
		},
		{
			question: 'Bakit hindi sapat ang pagkakaroon lamang ng early warning system?',
			options: {
				a: 'Kailangan din ang aksyon at pagsunod ng komunidad sa babala',
				b: 'Dahil hindi nito kayang hulaan ang lahat ng sakuna',
				c: 'Dahil nakadepende ito sa teknolohiya lamang',
				d: 'Dahil mahal ang pagpapatupad nito sa komunidad'
			},
			answer: 'a'
		},
		{
			question: 'Sa DRRM cycle, alin ang nagpapakita ng overlap ng preparedness at response?',
			options: {
				a: 'Pagsasagawa ng drills habang may aktwal na sakuna',
				b: 'Pagbibigay ng relief goods matapos ang kalamidad',
				c: 'Pagpaplano ng evacuation routes bago ang sakuna',
				d: 'Rehabilitasyon ng mga nasirang imprastraktura'
			},
			answer: 'a'
		},
		{
			question: 'Bilang Disaster Response Leader, alin ang nagpapakita ng optimal decision-making under pressure?',
			options: {
				a: 'Pagdedesisyon batay sa limitadong impormasyon ngunit may koordinasyon',
				b: 'Paghihintay ng kumpletong datos bago kumilos sa sitwasyon',
				c: 'Pagtuon lamang sa sariling pamilya bago ang komunidad',
				d: 'Pag-iwas sa responsibilidad upang maiwasan ang pagkakamali'
			},
			answer: 'a'
		}
	];

	// ================= STATE =================
	const selectedAnswers  = Array(questions.length).fill('');
	const confirmedAnswers = Array(questions.length).fill(false);

	let retryCount = 0;
	const maxRetries      = 2;
	const questionsPerCard = 5;
	let currentCard        = 0;

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

	function shuffleArray(array) {
		for (let i = array.length - 1; i > 0; i--) {
			const j = Math.floor(Math.random() * (i + 1));
			[array[i], array[j]] = [array[j], array[i]];
		}
	}

	function shuffleQuestionsAndChoices() {
		shuffleArray(questions);

		questions.forEach(q => {
			const optionKeys  = Object.keys(q.options);
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
			q.answer  = newAnswerKey;
		});
	}

	// ================= DOM ELEMENTS =================
	const questionList       = document.getElementById('questionList');
	const progressDots       = document.getElementById('progressDots');
	const answeredCountLabel = document.getElementById('answeredCountLabel');
	const quizPage           = document.getElementById('quizPage');
	const resultPage         = document.getElementById('resultPage');
	const submitBtn          = document.getElementById('submitBtn');
	const confirmBtn         = document.getElementById('confirmBtn');

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
		// First check questions on current card
		let start = currentCard * questionsPerCard;
		let end = start + questionsPerCard;
		
		// Check current card first
		for (let i = start; i < end; i++) {
			if (selectedAnswers[i] === '') {
				// Scroll to this question
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
		
		// If all current card questions are answered, check all questions
		for (let i = 0; i < questions.length; i++) {
			if (selectedAnswers[i] === '') {
				// Navigate to the card containing this question
				const targetCard = Math.floor(i / questionsPerCard);
				if (targetCard !== currentCard) {
					currentCard = targetCard;
					renderAllQuestions();
					// Wait for render then scroll
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
		
		return -1; // All answered
	}

	// ================= RENDER =================
	function renderAllQuestions() {
		const start            = currentCard * questionsPerCard;
		const end              = start + questionsPerCard;
		const currentQuestions = questions.slice(start, end);

		let questionsHtml = '';

		currentQuestions.forEach((item, i) => {
			const index         = start + i;
			const selectedValue = selectedAnswers[index];
			const isConfirmed   = confirmedAnswers[index];

			const choicesHtml = Object.entries(item.options).map(([key, text]) => {
				let classNames = ['choice'];
				if (selectedValue === key)                                     classNames.push('selected');
				if (isConfirmed && key === item.answer)                        classNames.push('correct-reveal');
				if (isConfirmed && selectedValue === key && selectedValue !== item.answer) classNames.push('soft-wrong');
				if (isConfirmed && selectedValue === key)                      classNames.push('confirmed');

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
			if (!confirmedAnswers[i]) { allConfirmed = false; break; }
		}

		const nextCardBtn = document.getElementById('nextCardBtn');
		confirmBtn.style.display  = allConfirmed ? 'none' : 'inline-flex';
		nextCardBtn.style.display = (allConfirmed && currentCard < 2) ? 'inline-flex' : 'none';
		submitBtn.style.display   = (currentCard === 2 && allConfirmed) ? 'inline-flex' : 'none';
	}

	// ================= INTERACTION =================
	window.selectAnswer = function(index, key) {
		if (confirmedAnswers[index]) return;
		selectedAnswers[index] = key;
		renderAllQuestions();
	};

	function confirmAnswer() {
		const start = currentCard * questionsPerCard;
		const end   = start + questionsPerCard;

		// Check unanswered - SCROLL instead of alert
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
		const start = currentCard * questionsPerCard;
		const end   = start + questionsPerCard;

		// Ensure current card is confirmed - SCROLL instead of alert
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
			piece.style.left              = `${Math.random() * 100}vw`;
			piece.style.background        = colors[Math.floor(Math.random() * colors.length)];
			piece.style.animationDuration = `${2.4 + Math.random() * 1.6}s`;
			piece.style.animationDelay    = `${Math.random() * 0.15}s`;
			document.body.appendChild(piece);
			setTimeout(() => piece.remove(), 4200);
		}
	}

	// ================= SUBMIT =================
	function submitPostTest() {
		// Check if all questions are confirmed - SCROLL instead of alert
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

		// Send to backend
		const answers = questions.map((q, index) => ({
			question_number: index + 1,
			selected_answer: selectedAnswers[index],
			correct_answer:  q.answer,
			is_correct:      selectedAnswers[index] === q.answer
		}));

		fetch("{{ route('module4.posttest.submit') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN":  "{{ csrf_token() }}"
			},
			body: JSON.stringify({ score, percentage, answers })
		});

		// UI
		const resultRing      = document.getElementById('resultRing');
		const resultPercent   = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge     = document.getElementById('resultBadge');
		const resultFeedback  = document.getElementById('resultFeedback');
		const resultActions   = document.getElementById('resultActions');

		resultRing.style.setProperty('--progress', percentage);
		resultPercent.textContent   = `${score}/${questions.length}`;
		resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;

		resultActions.innerHTML = '';

		if (score >= 13) {
			resultBadge.textContent    = '🏆 Mahusay!';
			resultFeedback.textContent = 'Nakamit mo ang passing score!';
			resultActions.innerHTML    = `
				<a href="{{ route('module4.performance') }}" class="btn-primary">
					Magpatuloy →
				</a>
			`;
			launchConfetti();
		} else {
			resultBadge.textContent    = '❌ Hindi pa sapat';
			resultFeedback.textContent = 'Subukan muli.';
			retryCount++;

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
	}

	// ================= RETRY =================
	function restartQuiz() {
		if (retryCount >= maxRetries) {
			// Show message in UI instead of alert
			const resultFeedback = document.getElementById('resultFeedback');
			resultFeedback.textContent = 'Naabot mo na ang maximum na 2 pagsubok.';
			resultFeedback.style.color = '#7a2e2e';
			return;
		}

		selectedAnswers.fill('');
		confirmedAnswers.fill(false);
		currentCard = 0;

		shuffleQuestionsAndChoices();

		resultPage.classList.remove('show');
		quizPage.style.display = 'block';

		confirmBtn.style.display = 'inline-flex';
		document.getElementById('nextCardBtn').style.display = 'none';
		submitBtn.style.display = 'none';

		renderAllQuestions();
		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	// ================= INIT =================
	window.addEventListener('load', () => {
		shuffleQuestionsAndChoices();
		renderAllQuestions();
	});
</script>

@endsection