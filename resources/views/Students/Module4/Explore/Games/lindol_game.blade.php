<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earthquake Emergency: Bogo City Rescue Mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #28a745 0%, #45b358 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .game-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }

        .game-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .game-title {
            font-size: 32px;
            font-weight: 800;
            color: #1e7e34;
            margin-bottom: 10px;
        }

        .game-subtitle {
            font-size: 16px;
            color: #4a4a4a;
            margin-bottom: 20px;
        }

        .progress-section {
            margin-bottom: 30px;
        }

        .level-badge {
            display: inline-block;
            background: linear-gradient(135deg, #28a745, #45b358);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .progress {
            height: 12px;
            border-radius: 10px;
            background: #e9ecef;
        }

        .progress-bar {
            background: linear-gradient(90deg, #28a745, #45b358);
            border-radius: 10px;
        }

        .scenario-box {
            background: linear-gradient(135deg, #f1f8f4, #e0f2f1);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 5px solid #28a745;
        }

        .scenario-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .scenario-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e7e34;
            margin-bottom: 15px;
        }

        .scenario-text {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .question-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 2px solid #e9ecef;
        }

        .question-text {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 20px;
        }

        .options-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 30px;
        }

        .option-btn {
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .option-btn:hover {
            border-color: #28a745;
            background: #f1f8f4;
            transform: translateX(5px);
        }

        .option-btn.correct {
            border-color: #198754;
            background: #198754;
            color: white;
        }

        .option-btn.incorrect {
            border-color: #dc3545;
            background: #dc3545;
            color: white;
        }

        .feedback-box {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: none;
        }

        .feedback-box.show {
            display: block;
        }

        .feedback-correct {
            background: #d1e7dd;
            border: 2px solid #198754;
            color: #0f5132;
        }

        .feedback-incorrect {
            background: #f8d7da;
            border: 2px solid #dc3545;
            color: #842029;
        }

        .feedback-text {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .feedback-message {
            font-size: 14px;
            line-height: 1.5;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-primary-game {
            flex: 1;
            padding: 12px 20px;
            background: linear-gradient(135deg, #28a745, #45b358);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-primary-game:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.25);
        }

        .btn-primary-game:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .results-screen {
            text-align: center;
            display: none;
        }

        .results-screen.show {
            display: block;
        }

        .results-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .results-title {
            font-size: 36px;
            font-weight: 800;
            color: #1e7e34;
            margin-bottom: 15px;
        }

        .results-description {
            font-size: 18px;
            color: #4a4a4a;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .score-display {
            background: linear-gradient(135deg, #28a745, #45b358);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            font-size: 48px;
            font-weight: 800;
        }

        .rank-badge {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .rank-excellent {
            background: #d1e7dd;
            color: #0f5132;
            border: 2px solid #198754;
        }

        .rank-good {
            background: #fff3cd;
            color: #664d03;
            border: 2px solid #ffc107;
        }

        .rank-needswork {
            background: #f8d7da;
            color: #842029;
            border: 2px solid #dc3545;
        }

        .btn-restart {
            padding: 12px 30px;
            background: linear-gradient(135deg, #28a745, #45b358);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-restart:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.25);
        }

        @media (max-width: 768px) {
            .game-container {
                padding: 25px;
            }

            .game-title {
                font-size: 24px;
            }

            .option-btn {
                font-size: 14px;
                padding: 12px 15px;
            }

            .results-title {
                font-size: 28px;
            }

            .score-display {
                font-size: 36px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="game-container">

    <div class="game-screen">

        <div class="game-header">
            <div class="game-title">🌍 Earthquake Emergency: Bogo City Rescue Mission</div>
            <div class="game-subtitle">Disaster Response Leader</div>
        </div>

        <div class="progress-section">
            <div class="level-badge" id="levelBadge">Level 1 of 7</div>
            <div class="progress">
                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <div class="scenario-box">
            <div class="scenario-icon" id="scenarioIcon">🌍</div>
            <div class="scenario-title" id="scenarioTitle">Scenario Title</div>
            <div class="scenario-text" id="scenarioText">Scenario description goes here</div>
        </div>

        <div class="question-box">
            <div class="question-text" id="questionText">Question?</div>
        </div>

        <div class="options-container" id="optionsContainer"></div>

        <div class="feedback-box" id="feedbackBox">
            <div class="feedback-text" id="feedbackTitle">Feedback</div>
            <div class="feedback-message" id="feedbackMessage">Message</div>
        </div>

        <div class="button-group">
            <button class="btn-primary-game" id="nextBtn" onclick="nextLevel()" disabled>Next Level ➜</button>
        </div>

    </div>

    <div class="results-screen" id="resultsScreen">

        <div class="results-icon" id="resultsIcon">🎖️</div>
        <div class="results-title" id="resultsTitle">Disaster Ready Leader</div>
        <div class="rank-badge" id="rankBadge">Excellent Performance</div>

        <div class="score-display" id="scoreDisplay">7/7</div>

        <div class="results-description" id="resultsDescription">
            Magaling! Handa ka na sa lindol.
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; justify-items: center;">
            <button class="btn-restart" onclick="restartGame()">🔄 Maglaro Muli</button>
            <a href="{{ route('module4.explore', ['completed' => 'lindol']) }}" class="btn-restart" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">📚 Balik sa Explore</a>
        </div>

    </div>

</div>

<script>
    const gameData = [
        {
            level: 1,
            icon: '🌍',
            phase: 'ANO ANG NANGYARI? (Immediate Action)',
            scenario: 'Malakas na lindol ang tumama sa lungsod.',
            question: 'Ano ang unang gagawin mo?',
            options: [
                { text: 'A. Tumakbo palabas agad', correct: false },
                { text: 'B. Mag "Duck, Cover, and Hold"', correct: true },
                { text: 'C. Mag-panic', correct: false }
            ],
            feedback: '✅ Correct! Ang tamang kilos habang lumilindol ay nakapagliligtas ng buhay.'
        },
        {
            level: 2,
            icon: '🚑',
            phase: 'ULAT NG KASUALTI (Life-Saving Priority)',
            scenario: 'Maraming nasawi at nasugatan',
            question: 'Ano ang uunahin mo?',
            options: [
                { text: 'A. Maghintay', correct: false },
                { text: 'B. Magbigay ng first aid at unahin ang kritikal', correct: true },
                { text: 'C. Mag-record ng video', correct: false }
            ],
            feedback: '✅ Correct! Ang agarang tulong ay kritikal sa oras ng sakuna.'
        },
        {
            level: 3,
            icon: '🏚️',
            phase: 'LAWAK NG PINSALA (Critical Thinking)',
            scenario: 'Maraming gusali ang gumuho',
            question: 'Ano ang tamang aksyon?',
            options: [
                { text: 'A. Pumasok agad', correct: false },
                { text: 'B. Mag-inspect muna kung ligtas', correct: true },
                { text: 'C. Balewalain', correct: false }
            ],
            feedback: '✅ Correct! Ang safety assessment ay mahalaga bago kumilos.'
        },
        {
            level: 4,
            icon: '🏥',
            phase: 'SITWASYON SA OSPITAL (Problem Solving)',
            scenario: 'Punuan ang ospital',
            question: 'Ano ang gagawin mo?',
            options: [
                { text: 'A. Pauwiin ang pasyente', correct: false },
                { text: 'B. Mag-set up ng temporary treatment area', correct: true },
                { text: 'C. Isara ang ospital', correct: false }
            ],
            feedback: '✅ Correct! Ang flexibility sa response ay nakakatulong sa mas maraming buhay.'
        },
        {
            level: 5,
            icon: '🏕️',
            phase: 'PAGLIKAS AT KALIGTASAN (Evacuation Planning)',
            scenario: 'Maraming evacuees',
            question: 'Ano ang dapat tiyakin?',
            options: [
                { text: 'A. Walang sistema', correct: false },
                { text: 'B. Organisado at ligtas na evacuation center', correct: true },
                { text: 'C. Bahala na', correct: false }
            ],
            feedback: '✅ Correct! Ang maayos na evacuation ay nagbabawas ng panganib.'
        },
        {
            level: 6,
            icon: '⚠️',
            phase: 'AFTERSHOCKS (Risk Awareness)',
            scenario: 'May patuloy na aftershocks',
            question: 'Ano ang tamang gawin?',
            options: [
                { text: 'A. Bumalik agad sa bahay', correct: false },
                { text: 'B. Manatili sa open at ligtas na lugar', correct: true },
                { text: 'C. Maglakad-lakad', correct: false }
            ],
            feedback: '✅ Correct! Ang aftershocks ay maaaring mas mapanganib.'
        },
        {
            level: 7,
            icon: '🤝',
            phase: 'PAGTUGON NG KOMUNIDAD (Collaboration)',
            scenario: 'Kailangan ng rescue at relief',
            question: 'Ano ang gagawin mo?',
            options: [
                { text: 'A. Sarili lang', correct: false },
                { text: 'B. Makipagtulungan sa rescue teams', correct: true },
                { text: 'C. Umalis', correct: false }
            ],
            feedback: '✅ Correct! Ang bayanihan ang susi sa pagbangon.'
        }
    ];

    let currentLevel = 0;
    let score = 0;
    let answered = false;

    function renderLevel() {
        const level = gameData[currentLevel];
        document.getElementById('levelBadge').textContent = `Level ${level.level} of 7`;
        document.getElementById('progressBar').style.width = ((currentLevel + 1) / 7 * 100) + '%';
        document.getElementById('scenarioIcon').textContent = level.icon;
        document.getElementById('scenarioTitle').textContent = level.phase;
        document.getElementById('scenarioText').textContent = level.scenario;
        document.getElementById('questionText').textContent = level.question;

        const optionsContainer = document.getElementById('optionsContainer');
        optionsContainer.innerHTML = '';

        level.options.forEach((option, index) => {
            const btn = document.createElement('button');
            btn.className = 'option-btn';
            btn.textContent = option.text;
            btn.onclick = () => selectOption(index);
            optionsContainer.appendChild(btn);
        });

        document.getElementById('feedbackBox').classList.remove('show', 'feedback-correct', 'feedback-incorrect');
        document.getElementById('nextBtn').disabled = true;
        answered = false;
    }

    function selectOption(index) {
        if (answered) return;
        const level = gameData[currentLevel];
        const correct = level.options[index].correct;

        document.querySelectorAll('.option-btn').forEach((btn, i) => {
            if (level.options[i].correct) {
                btn.classList.add('correct');
            } else if (i === index && !correct) {
                btn.classList.add('incorrect');
            }
            btn.disabled = true;
        });

        if (correct) {
            score++;
        }

        const feedbackBox = document.getElementById('feedbackBox');
        feedbackBox.classList.add('show');

        if (correct) {
            feedbackBox.classList.add('feedback-correct');
            feedbackBox.classList.remove('feedback-incorrect');
            document.getElementById('feedbackTitle').textContent = '✅ Correct!';
        } else {
            feedbackBox.classList.add('feedback-incorrect');
            feedbackBox.classList.remove('feedback-correct');
            document.getElementById('feedbackTitle').textContent = '❌ Incorrect';
        }

        document.getElementById('feedbackMessage').textContent = level.feedback;
        document.getElementById('nextBtn').disabled = false;
        answered = true;
    }

    function nextLevel() {
        currentLevel++;
        if (currentLevel >= gameData.length) {
            showResults();
        } else {
            renderLevel();
        }
    }

    function showResults() {
        document.querySelector('.game-screen').style.display = 'none';
        document.getElementById('resultsScreen').classList.add('show');

        document.getElementById('scoreDisplay').textContent = `${score}/7`;

        let title, description, icon, rank, badgeClass;
        if (score >= 6) {
            title = 'Earthquake Ready Leader 🎖️';
            description = 'Magaling! Handa ka na sa lindol at alam mo ang tamang aksyon.';
            icon = '🟢';
            rank = '⭐ Excellent Performance';
            badgeClass = 'rank-excellent';
        } else if (score >= 4) {
            title = 'Developing Responder 📈';
            description = 'Maganda ang simula. Mas lalo pang paigtingin ang kaalaman tungkol sa earthquake safety.';
            icon = '🟡';
            rank = '⚡ Good Effort';
            badgeClass = 'rank-good';
        } else {
            title = 'At Risk – Needs Training 📚';
            description = 'Kailangan pa ng karagdagang pagsasanay para mas maging handa sa lindol.';
            icon = '🔴';
            rank = '⏱️ Needs Improvement';
            badgeClass = 'rank-needswork';
        }

        document.getElementById('resultsIcon').textContent = icon;
        document.getElementById('resultsTitle').textContent = title;
        document.getElementById('resultsDescription').textContent = description;
        document.getElementById('rankBadge').textContent = rank;
        document.getElementById('rankBadge').className = 'rank-badge ' + badgeClass;
    }

    function restartGame() {
        currentLevel = 0;
        score = 0;
        answered = false;
        document.querySelector('.game-screen').style.display = 'block';
        document.getElementById('resultsScreen').classList.remove('show');
        renderLevel();
    }

    renderLevel();
</script>

</body>
</html>
