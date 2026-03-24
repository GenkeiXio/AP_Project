<!DOCTYPE html>
<html lang="fil">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hamon at Tugon: Module 2 Pre-Test</title>

	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">

	<style>
		body {
			display: block;
			min-height: 100vh;
			padding: 28px 20px 40px;
			overflow-x: hidden;
		}

		.main-wrapper {
			display: block;
			width: 100%;
			max-width: 1200px;
			margin: 0 auto;
		}

		.pretest-wrap {
			width: 100%;
			max-width: 860px;
			margin: 0 auto;
		}

		.pretest-card {
			background: rgba(255, 255, 255, 0.9);
			border-radius: 16px;
			box-shadow: 0 6px 28px rgba(80, 50, 10, 0.1);
			padding: 16px;
		}

		.pretest-header {
			text-align: center;
			margin-bottom: 14px;
		}

		.pretest-header .header-icons {
			font-size: 1rem;
		}

		.pretest-header .subtitle {
			font-size: 0.82rem;
		}

		.pretest-header h1 {
			font-size: clamp(1.6rem, 3.3vw, 2.1rem);
			margin: 6px 0;
		}

		.pretest-header p {
			color: #7a6143;
			font-weight: 700;
			margin-top: 6px;
			font-size: 0.88rem;
		}

		.pretest-note {
			background: #fff9ef;
			border: 1px solid #efd9b3;
			color: #6e5233;
			border-radius: 12px;
			padding: 10px 12px;
			font-size: 0.9rem;
			margin-bottom: 14px;
		}

		.question-list {
			display: block;
		}

		.question-item {
			background: #fff;
			border: 1px solid #eadcc5;
			border-radius: 12px;
			padding: 12px;
			min-height: 245px;
		}

		.question-item h4 {
			color: #3d2a1a;
			margin-bottom: 8px;
			line-height: 1.42;
			font-size: 0.91rem;
		}

		.choices {
			display: grid;
			gap: 7px;
		}

		.choice {
			display: flex;
			align-items: flex-start;
			gap: 8px;
			border: 1px solid #e7d7bf;
			border-radius: 10px;
			padding: 7px 9px;
			cursor: pointer;
			transition: border-color 0.2s, background-color 0.2s, transform 0.15s;
		}

		.choice:hover {
			border-color: #d4a574;
			background: #fffaf1;
			transform: translateX(4px);
		}

		.choice.selected {
			border-color: #6dbf7e;
			background: #f3fbf5;
			transform: translateX(4px);
		}

		.choice input {
			margin-top: 3px;
			accent-color: #6dbf7e;
			cursor: pointer;
		}

		.choice span {
			color: #4e3823;
			font-size: 0.87rem;
			line-height: 1.35;
		}

		.quiz-progress {
			max-width: 430px;
			margin: 0 auto 10px;
		}

		.progress-dots {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 5px;
			flex-wrap: wrap;
			margin-bottom: 8px;
		}

		.progress-dot {
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: #dfd2c3;
			transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
			cursor: default;
		}

		.progress-dot.completed {
			background: #6dbf7e;
			transform: scale(1.2);
		}

		.progress-dot.active {
			background: #57ba77;
			transform: scale(1.35);
			box-shadow: 0 0 6px rgba(109, 191, 126, 0.45);
		}

		.progress-label {
			text-align: center;
			font-size: 0.78rem;
			font-weight: 700;
			color: #7a6143;
			margin-bottom: 4px;
			letter-spacing: 0.5px;
		}

		.progress-track {
			width: 100%;
			height: 6px;
			border-radius: 999px;
			background: #eadfcd;
			overflow: hidden;
		}

		.progress-fill {
			height: 100%;
			width: 0%;
			background: linear-gradient(135deg, #6dbf7e, #4da862);
			transition: width 0.3s ease;
		}

		.quiz-page {
			display: block;
		}

		.result-page {
			display: none;
			max-width: 500px;
			margin: 12px auto 0;
		}

		.result-page.show {
			display: block;
		}

		.action-row {
			margin-top: 12px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			gap: 7px;
		}

		.action-row .btn-primary {
			width: min(180px, 100%);
			padding: 10px;
			font-size: 0.88rem;
		}

		.action-row .btn-primary[disabled] {
			opacity: 0.5;
			cursor: not-allowed;
			transform: none;
			box-shadow: none;
		}

		.result-box {
			display: none;
			margin-top: 14px;
			border-radius: 15px;
			border: 2px solid rgba(109, 191, 126, 0.3);
			background: linear-gradient(180deg, #fffdf7 0%, #f6efe2 100%);
			color: #3d2a1a;
			padding: 14px 12px;
			text-align: center;
			font-weight: 800;
		}

		.result-box.show {
			display: block;
		}

		.result-title {
			font-family: "Baloo 2", cursive;
			font-size: clamp(1.45rem, 3.4vw, 1.9rem);
			color: #3d2a1a;
			margin-bottom: 10px;
		}

		.result-ring {
			--progress: 0;
			width: 150px;
			height: 150px;
			margin: 0 auto 10px;
			border-radius: 50%;
			background: conic-gradient(#57ba77 calc(var(--progress) * 1%), #d9e8dc 0);
			display: grid;
			place-items: center;
			position: relative;
		}

		.result-ring::before {
			content: "";
			width: 116px;
			height: 116px;
			border-radius: 50%;
			background: linear-gradient(180deg, #fffdf8 0%, #f2eadf 100%);
			position: absolute;
			inset: 0;
			margin: auto;
		}

		.result-percent {
			position: relative;
			z-index: 1;
			font-size: 1.6rem;
			font-weight: 900;
			color: #2f6c44;
		}

		.result-score {
			font-size: 0.96rem;
			font-weight: 800;
			color: #4c3a26;
			margin-top: 3px;
		}

		.result-subtext {
			margin-top: 5px;
			font-size: 0.82rem;
			font-weight: 700;
			color: #7a6143;
		}

		.result-feedback {
			margin-top: 5px;
			font-size: 0.84rem;
			font-weight: 700;
			color: #6f5538;
		}

		.badge-pill {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			padding: 4px 9px;
			border-radius: 999px;
			font-size: 0.75rem;
			font-weight: 800;
			margin-top: 6px;
			background: #eefaf1;
			color: #2f6c44;
			border: 1px solid #bfe3c8;
		}

		.result-actions {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			gap: 7px;
			margin-top: 10px;
		}

		.result-actions .btn-primary,
		.result-actions .btn-secondary {
			text-decoration: none;
			width: min(180px, 100%);
			text-align: center;
			padding: 9px;
			font-size: 0.86rem;
		}

		.btn-secondary {
			padding: 9px;
			background: #fff;
			color: #4c3a26;
			border: 2px solid #d7c4a3;
			border-radius: 12px;
			font-size: 0.86rem;
			font-family: "Baloo 2", cursive;
			font-weight: 700;
			cursor: pointer;
			transition: transform 0.15s, box-shadow 0.15s;
		}

		.btn-secondary:hover {
			transform: translateY(-2px);
			box-shadow: 0 7px 18px rgba(120, 90, 50, 0.18);
		}

		.home-btn {
			position: fixed;
			top: 20px;
			left: 20px;
			font-size: 1.8rem;
			text-decoration: none;
			color: #000;
			padding: 10px 14px;
			border-radius: 12px;
			box-shadow: 0 4px 6px rgba(0,0,0,0.2);
			z-index: 1000;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
			background: rgba(255, 255, 255, 0.85);
		}

		.home-btn:hover {
			transform: scale(1.08);
			box-shadow: 0 6px 10px rgba(0,0,0,0.25);
		}

		@media (max-width: 768px) {
			body {
				padding: 14px 10px 20px;
			}

			.pretest-card {
				padding: 12px;
			}

			.action-row {
				flex-direction: column;
			}

			.result-actions {
				flex-direction: column;
			}

			.result-ring {
				width: 132px;
				height: 132px;
			}

			.result-ring::before {
				width: 102px;
				height: 102px;
			}

			.result-percent {
				font-size: 1.35rem;
			}
		}
	</style>
</head>
<body>

<span class="deco deco-1">🌿</span>
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<a href="{{ route('poll') }}" class="home-btn" title="Bumalik sa Poll">⬅️</a>

<div class="main-wrapper" style="width:100%; max-width:1200px;">
	<div class="pretest-wrap">
		<div class="pretest-card">
			<div class="pretest-header">
				<div class="header-icons">🧭 🗺️ ✨</div>
				<div class="subtitle">Module 2</div>
				<h1>Paunang Pagtataya</h1>
				<p>Piliin ang letra ng tamang sagot.</p>
			</div>

			<form id="preTestForm">
				<div class="quiz-page" id="quizPage">
					<div class="quiz-progress">
						<div class="progress-dots" id="progressDots"></div>
						<div class="progress-label" id="quizProgressLabel"></div>
						<div class="progress-track">
							<div class="progress-fill" id="quizProgressFill"></div>
						</div>
					</div>
					<div class="question-list" id="questionList"></div>

					<div class="action-row">
						<button type="button" class="btn-primary" id="prevBtn" onclick="goPreviousQuestion()">← Nakaraan</button>
						<button type="button" class="btn-primary" id="nextBtn" onclick="goNextQuestion()">Susunod →</button>
						<button type="button" class="btn-primary" id="submitBtn" onclick="submitPreTest()" style="display:none;">Ipasa ang Pre-Test 🚀</button>
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
						<div class="result-subtext">Makikita mo lang ang iskor, ngunit hindi pa ipapakita ang tamang sagot.</div>
						<div class="result-actions">
							<button type="button" class="btn-secondary" onclick="restartQuiz()">Ulitin ang Pre-Test</button>
							<a href="{{ route('module.home') }}" class="btn-primary">Magpatuloy →</a>
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
			question: '1. Alin sa mga sumusunod ang batas kung saan nakapaloob ang kautusan sa pagsasagawa ng reforestation sa buong bansa kasama ang pribadong sektor?',
			options: {
				a: 'Presidential Decree 705',
				b: 'Executive Order No. 23',
				c: 'Republic Act 570',
				d: 'Republic Act 9072'
			},
			answer: 'a'
		},
		{
			question: '2. Alin sa mga sumusunod ang naglalarawan sa konsepto ng reforestation?',
			options: {
				a: 'Ang walang habas na pamumutol ng mga puno sa kagubatan',
				b: 'Muling pagtatanim ng mga puno sa mga kagubatan at kabundukan',
				c: 'Ang pagsunog sa mga kagubatan upang makuhanan ng mga uling at panggatong',
				d: 'Wala sa nabanggit'
			},
			answer: 'b'
		},
		{
			question: '3. Tumutukoy sa nararanasang pagtaas ng katamtamang temperatura ng himpapawid at mga karagatan sa mundo nitong mga nakaraang dekada.',
			options: {
				a: 'Climate Change',
				b: 'Slash and Burn',
				c: 'Deforestation',
				d: 'Illegal Logging'
			},
			answer: 'a'
		},
		{
			question: '4. Batay sa Executive Order No. 23, anong gawain ang ipinagbawal ng pamahalaan upang mapangalagaan ang kalikasan?',
			options: {
				a: 'Fuel Wood Harvesting',
				b: 'Illegal Mining',
				c: 'Illegal Logging',
				d: 'Reforestation'
			},
			answer: 'c'
		},
		{
			question: '5. Alin sa mga sumusunod ang HIGIT na nagpapakita ng pangangalaga sa likas na yaman ng daigdig?',
			options: {
				a: 'Paggamit ng mga renewable energy tulad ng solar at wind energy na hindi nauubos.',
				b: 'Huwag mangisda sa mga maliliit na ilog at dagat.',
				c: 'Pagtatapon sa tamang basurahan.',
				d: 'Pagtatanim ng mga pagkain sa sariling bakuran upang hindi maubos ang likas na yaman.'
			},
			answer: 'a'
		},
		{
			question: '6. Paano higit na maiiwasan ang pagkaubos ng likas na yaman ng daigdig?',
			options: {
				a: 'Huwag bumili ng mga mamahaling bato tulad ng diyamante at metal.',
				b: 'Ibalik sa dagat ang mga maliliit pang isda.',
				c: 'Huwag abusuhin ang kalikasan at gumamit ng mga renewable energy.',
				d: 'Huwag putulin ang mga puno'
			},
			answer: 'c'
		},
		{
			question: '7. Bakit mahalagang panatilihin ang ekolohikal na balanse ng ating kapaligiran?',
			options: {
				a: 'Para magkaroon ng kaunlaran ang bansa',
				b: 'Para mapaunlad ang mga industriya at mga pagawaan sa bansa',
				c: 'Para matiyak ang kaligtasan ng pamumuhay ng mga mamamayan.',
				d: 'Para makilala at mabigyan ng karangalan sa ibang bansa'
			},
			answer: 'c'
		},
		{
			question: '8. Bakit mahalagang bigyang-pansin ang pagtutulungan ng iba’t ibang sektor ng lipunan sa pagsugpo sa mga suliraning pangkapaligiran?',
			options: {
				a: 'Upang maraming dayuhan ang magtungo sa ating bansa',
				b: 'Pananagutang panlahat ang pagsugpo sa iba’t ibang suliraning pangkapaligiran',
				c: 'Makakabawas ito sa mga gastusin ng pamahalaan',
				d: 'Masyadong malawak ang pagsugpo sa suliraning pangkapaligiran'
			},
			answer: 'b'
		},
		{
			question: '9. Ano ang batas na nilagdaan noong 1987 na tumugon sa pagpigil sa pagnipis ng ozone layer na nagbibigay proteksyon sa mundo laban sa matinding init ng araw na humahantong sa climate change?',
			options: {
				a: 'Montreal Protocol',
				b: 'Kyoto Protocol',
				c: 'Clean and Green',
				d: 'Bantay Kalikasan'
			},
			answer: 'a'
		},
		{
			question: '10. Batay sa mga ulat at pananaliksik, saang lugar sa Pilipinas nagmumula ang malaking bahagdan ng solid waste?',
			options: {
				a: 'Mindoro',
				b: 'Masbate',
				c: 'Marinduque',
				d: 'Metro Manila'
			},
			answer: 'd'
		},
		{
			question: '11. Alin sa mga sumusunod ang HINDI kabilang sa mga organisasyong nakikiisa sa pagsugpo sa mga suliraning pangkapaligiran?',
			options: {
				a: 'Mother Earth Foundation',
				b: 'Clean and Green Foundation',
				c: 'Greenpeace',
				d: 'CEDAW'
			},
			answer: 'd'
		},
		{
			question: '12. Ano-ano ang mga aspeto ng pamumuhay ang labis na naaapektuhan ng mga kalamidad na nararanasan sa Pilipinas?',
			options: {
				a: 'Kabuhayan at katarungan',
				b: 'Kalusugan, kabuhayan at kalikasan',
				c: 'Kalakalan, kabuhayan at kapatiran',
				d: 'Kultura, kalikasan at kapayapaan'
			},
			answer: 'b'
		},
		{
			question: '13. Ang mga sumusunod ay pawang mga epekto ng pagsasagawa ng illegal logging maliban sa ______________.',
			options: {
				a: 'malawakang pagbaha',
				b: 'pagkasira ng tahanan ng mga hayop',
				c: 'soil erosion',
				d: 'pagkawala ng sustansya ng lupa'
			},
			answer: 'd'
		},
		{
			question: '14. Batay sa pag-aaral ng National Solid Waste Management Report ng 2015, anong uri ng basura ang may pinakamalaking porsyento ang itinatapon sa bansa?',
			options: {
				a: 'Biodegradables',
				b: 'Recyclables',
				c: 'Residual',
				d: 'Non-Biodegradables'
			},
			answer: 'a'
		},
		{
			question: '15. Bilang isang mag-aaral, paano ka makakatulong sa pagsugpo sa mga suliraning pangkapaligiran sa ating daigdig?',
			options: {
				a: 'Patuloy na pananaliksik sa mga epektibong pamamaraan',
				b: 'Pakikisa sa mga gawaing nagtataguyod sa pangangalaga sa kalikasan',
				c: 'Pananaliksik at pag-aaral sa mga kasalukuyang kaganapan sa kapaligiran',
				d: 'Palagiang pagbatikos sa mga kakulangan ng gobyerno sa pagharap sa mga suliranin'
			},
			answer: 'b'
		}
	];

	const questionList = document.getElementById('questionList');
	const progressDots = document.getElementById('progressDots');
	const quizProgressLabel = document.getElementById('quizProgressLabel');
	const quizProgressFill = document.getElementById('quizProgressFill');
	const quizPage = document.getElementById('quizPage');
	const resultPage = document.getElementById('resultPage');
	const prevBtn = document.getElementById('prevBtn');
	const nextBtn = document.getElementById('nextBtn');
	const submitBtn = document.getElementById('submitBtn');

	const selectedAnswers = Array(questions.length).fill('');
	let currentQuestionIndex = 0;

	function getAnsweredCount() {
		return selectedAnswers.filter(answer => answer !== '').length;
	}

	function updateProgress() {
		const progressPercent = ((currentQuestionIndex + 1) / questions.length) * 100;
		quizProgressLabel.textContent = `Tanong ${currentQuestionIndex + 1} / ${questions.length}`;
		quizProgressFill.style.width = `${progressPercent}%`;

		// Update progress dots
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

	function renderCurrentQuestion() {
		const item = questions[currentQuestionIndex];
		const selectedValue = selectedAnswers[currentQuestionIndex];

		const choicesHtml = Object.entries(item.options).map(([key, text]) => `
			<label class="choice ${selectedValue === key ? 'selected' : ''}">
				<input type="radio" name="q${currentQuestionIndex}" value="${key}" ${selectedValue === key ? 'checked' : ''}>
				<span>${key}. ${text}</span>
			</label>
		`).join('');

		questionList.innerHTML = `
			<div class="question-item">
				<h4>${item.question}</h4>
				<div class="choices">${choicesHtml}</div>
			</div>
		`;

		updateProgress();
		updateActionButtons();
	}

	questionList.addEventListener('change', (event) => {
		const target = event.target;
		if (target && target.matches('input[type="radio"]')) {
			selectedAnswers[currentQuestionIndex] = target.value;
			updateProgress();
			updateActionButtons();
		}
	});

	function goPreviousQuestion() {
		if (currentQuestionIndex === 0) {
			return;
		}

		currentQuestionIndex -= 1;
		renderCurrentQuestion();
		window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
	}

	function goNextQuestion() {
		if (currentQuestionIndex >= questions.length - 1) {
			return;
		}

		if (!selectedAnswers[currentQuestionIndex]) {
			alert('Pumili muna ng sagot bago magpatuloy sa susunod na tanong.');
			return;
		}

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

	function getFeedbackByPercent(percent) {
		if (percent >= 80) return { badge: '🏆 Napakahusay!', feedback: 'Malakas na ang pundasyon mo sa paksa. Ipagpatuloy mo lang!' };
		if (percent >= 50) return { badge: '👏 Magaling!', feedback: 'May alam ka na sa paksa. Mas gagaling ka pa sa susunod na aralin.' };
		return { badge: '🌱 Simula pa lang!', feedback: 'Okay lang ito. Ang pre-test ay gabay para mas mapalalim pa ang iyong pag-unawa.' };
	}

	function submitPreTest() {
		if (selectedAnswers.some(answer => !answer)) {
			alert('Pakisagutan muna ang lahat ng tanong bago ipasa.');
			return;
		}

		const score = questions.reduce((total, item, index) => {
			return total + (selectedAnswers[index] === item.answer ? 1 : 0);
		}, 0);

		const resultBox = document.getElementById('resultBox');
		const resultRing = document.getElementById('resultRing');
		const resultPercent = document.getElementById('resultPercent');
		const resultScoreText = document.getElementById('resultScoreText');
		const resultBadge = document.getElementById('resultBadge');
		const resultFeedback = document.getElementById('resultFeedback');
		const percentage = Math.round((score / questions.length) * 100);
		const level = getFeedbackByPercent(percentage);

		animateResultRing(resultRing, percentage);
		resultPercent.textContent = `${score}/${questions.length}`;
		resultScoreText.textContent = `Nakuha mo ang ${score} sa ${questions.length}`;
		resultBadge.textContent = level.badge;
		resultFeedback.textContent = level.feedback;

		quizPage.style.display = 'none';
		resultPage.classList.add('show');

		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	function restartQuiz() {
		selectedAnswers.fill('');
		currentQuestionIndex = 0;
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
