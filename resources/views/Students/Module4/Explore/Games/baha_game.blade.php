<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Flood Survival: Guinobatan Rescue Mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #6bc1ff 100%);
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
            color: #0d3f8b;
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
            background: linear-gradient(135deg, #0d6efd, #6bc1ff);
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
            background: linear-gradient(90deg, #0d6efd, #6bc1ff);
            border-radius: 10px;
        }

        .scenario-box {
            background: linear-gradient(135deg, #f1f8ff, #dbefff);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 5px solid #0d6efd;
        }

        .scenario-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .scenario-title {
            font-size: 18px;
            font-weight: 700;
            color: #0d3f8b;
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
            border-color: #0d6efd;
            background: #eff6ff;
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

        .btn-primary-game,
        .btn-secondary-game {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-primary-game {
            background: linear-gradient(135deg, #0d6efd, #6bc1ff);
            color: white;
        }

        .btn-primary-game:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.25);
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
            color: #0d3f8b;
            margin-bottom: 15px;
        }

        .results-description {
            font-size: 18px;
            color: #4a4a4a;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .score-display {
            background: linear-gradient(135deg, #0d6efd, #6bc1ff);
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
            background: linear-gradient(135deg, #0d6efd, #6bc1ff);
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
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.25);
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
            <div class="game-title">🌧️ Flash Flood Survival: Guinobatan Rescue Mission</div>
            <div class="game-subtitle">Barangay Disaster Response Leader</div>
        </div>

        <div class="progress-section">
            <div class="level-badge" id="levelBadge">Level 1 of 6</div>
            <div class="progress">
                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <div class="scenario-box">
            <div class="scenario-icon" id="scenarioIcon">🌧️</div>
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
        <div class="results-title" id="resultsTitle">Flood-Ready Leader</div>
        <div class="rank-badge" id="rankBadge">Excellent Performance</div>

        <div class="score-display" id="scoreDisplay">6/6</div>

        <div class="results-description" id="resultsDescription">
            Ang iyong mabilis at tamang desisyon ay nakatulong sa komunidad.
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; justify-items: center;">
            <button class="btn-restart" onclick="restartGame()">🔄 Maglaro Muli</button>
            <a href="{{ route('module4.explore', ['completed' => 'baha']) }}" class="btn-restart" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">📚 Balik sa Explore</a>
        </div>

    </div>

</div>

<script>
    const gameData = [
        {
            level: 1,
            icon: '🌧️',
            phase: 'BIGLAANG BAHA (Understanding the Situation)',
            scenario: 'Biglang rumagasa ang baha at naging parang ilog ang kalsada.',
            question: 'Ano ang una mong gagawin?',
            options: [
                { text: 'A. Manood muna ng balita', correct: false },
                { text: 'B. Magbigay agad ng babala at pa-evacuate', correct: true },
                { text: 'C. Maghintay ng utos', correct: false }
            ],
            feedback: '✅ Correct! Ang maagap na babala ay nakapagliligtas ng buhay.'
        },
        {
            level: 2,
            icon: '🌊',
            phase: 'DELIKADONG DALUYAN (Hazard Recognition)',
            scenario: 'Ang baha ay may kasamang lahar (putik, bato, buhangin).',
            question: 'Ano ang tamang aksyon?',
            options: [
                { text: 'A. Patawirin ang mga tao', correct: false },
                { text: 'B. Iwasan ang daluyan at i-block ang access', correct: true },
                { text: 'C. Maglaro sa baha', correct: false }
            ],
            feedback: '✅ Correct! Ang lahar ay mas mapanganib kaysa ordinaryong baha.'
        },
        {
            level: 3,
            icon: '⛈️',
            phase: 'SANHI NG SAKUNA (Analyzing Causes)',
            scenario: 'Malakas ang ulan nang higit isang oras.',
            question: 'Ano ang dapat mong ipaliwanag sa komunidad?',
            options: [
                { text: 'A. Normal lang ito', correct: false },
                { text: 'B. Posibleng magdulot ng flashflood lalo na malapit sa bulkan', correct: true },
                { text: 'C. Walang epekto', correct: false }
            ],
            feedback: '✅ Correct! Ang kaalaman sa sanhi ay susi sa pag-iwas sa panganib.'
        },
        {
            level: 4,
            icon: '🏠',
            phase: 'EPEKTO SA MGA RESIDENTE (Impact Awareness)',
            scenario: 'Nahihirapan ang mga tao sa paglikas.',
            question: 'Ano ang gagawin mo?',
            options: [
                { text: 'A. Hayaan sila', correct: false },
                { text: 'B. Mag-organize ng rescue at evacuation', correct: true },
                { text: 'C. Isara ang barangay', correct: false }
            ],
            feedback: '✅ Correct! Ang mabilis na pagtugon ay nakababawas ng pinsala.'
        },
        {
            level: 5,
            icon: '🚜',
            phase: 'PAGTUGON NG PAMAHALAAN (Response Action)',
            scenario: 'Maraming debris sa kalsada.',
            question: 'Ano ang susunod na hakbang?',
            options: [
                { text: 'A. Iwanan', correct: false },
                { text: 'B. Magsagawa ng clearing operations at magbigay ng relief', correct: true },
                { text: 'C. Maghintay ng tulong', correct: false }
            ],
            feedback: '✅ Correct! Ang organisadong pagtugon ay nagpapabilis ng pagbangon.'
        },
        {
            level: 6,
            icon: '🤝',
            phase: 'PAG-IINGAT AT KOOPERASYON (Community Action)',
            scenario: 'May babala ang awtoridad.',
            question: 'Ano ang dapat gawin ng komunidad?',
            options: [
                { text: 'A. Balewalain', correct: false },
                { text: 'B. Sumunod at makiisa', correct: true },
                { text: 'C. Maghintay muna', correct: false }
            ],
            feedback: '✅ Correct! Ang disiplina at pagtutulungan ay nagliligtas ng buhay.'
        }
    ];

    let currentLevel = 0;
    let score = 0;
    let answered = false;

    function renderLevel() {
        const level = gameData[currentLevel];
        document.getElementById('levelBadge').textContent = `Level ${level.level} of 6`;
        document.getElementById('progressBar').style.width = ((currentLevel + 1) / 6 * 100) + '%';
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

        document.getElementById('scoreDisplay').textContent = `${score}/6`;

        let title, description, icon, rank, badgeClass;
        if (score >= 5) {
            title = 'Flood-Ready Leader 🎖️';
            description = 'Magaling! Handang-handa ka sa flash flood response.';
            icon = '🟢';
            rank = '⭐ Excellent Performance';
            badgeClass = 'rank-excellent';
        } else if (score >= 3) {
            title = 'Developing Responder 📈';
            description = 'Maganda ang simula. Mas lalo pang paigtingin ang iyong kaalaman.';
            icon = '🟡';
            rank = '⚡ Good Effort';
            badgeClass = 'rank-good';
        } else {
            title = 'At Risk – Needs Training 📚';
            description = 'Kailangan pa ng karagdagang pagsasanay para mas maging handa.';
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
