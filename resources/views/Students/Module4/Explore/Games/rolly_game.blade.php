<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolly Rescue Mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .game-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }

        /* HEADER */
        .game-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .game-title {
            font-size: 32px;
            font-weight: 800;
            color: #222;
            margin-bottom: 10px;
        }

        .game-subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        /* PROGRESS */
        .progress-section {
            margin-bottom: 30px;
        }

        .level-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
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
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        /* SCENARIO */
        .scenario-box {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 5px solid #667eea;
        }

        .scenario-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .scenario-title {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 15px;
        }

        .scenario-text {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        /* QUESTION */
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

        /* OPTIONS */
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
            border-color: #667eea;
            background: #f0f4ff;
            transform: translateX(5px);
        }

        .option-btn.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .option-btn.correct {
            border-color: #28a745;
            background: #28a745;
            color: white;
        }

        .option-btn.incorrect {
            border-color: #dc3545;
            background: #dc3545;
            color: white;
        }

        /* FEEDBACK */
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
            background: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
        }

        .feedback-incorrect {
            background: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
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

        /* BUTTONS */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-primary-game {
            flex: 1;
            padding: 12px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
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
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-primary-game:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* RESULTS SCREEN */
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
            color: #222;
            margin-bottom: 15px;
        }

        .results-description {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .score-display {
            background: linear-gradient(135deg, #667eea, #764ba2);
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
            background: #d4edda;
            color: #155724;
            border: 2px solid #28a745;
        }

        .rank-good {
            background: #fff3cd;
            color: #856404;
            border: 2px solid #ffc107;
        }

        .rank-needswork {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #dc3545;
        }

        .btn-restart {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
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
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        /* RESPONSIVE */
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

    <!-- GAME SCREEN -->
    <div class="game-screen">

        <div class="game-header">
            <div class="game-title">🌀 Rolly Rescue Mission</div>
            <div class="game-subtitle">Barangay Disaster Response Leader</div>
        </div>

        <div class="progress-section">
            <div class="level-badge" id="levelBadge">Level 1 of 6</div>
            <div class="progress">
                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <div class="scenario-box">
            <div class="scenario-icon" id="scenarioIcon">📢</div>
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

    <!-- RESULTS SCREEN -->
    <div class="results-screen" id="resultsScreen">

        <div class="results-icon" id="resultsIcon">🎖️</div>
        <div class="results-title" id="resultsTitle">Disaster Ready Leader</div>
        <div class="rank-badge" id="rankBadge">Excellent Performance</div>

        <div class="score-display" id="scoreDisplay">6/6</div>

        <div class="results-description" id="resultsDescription">
            Ang iyong matalinong desisyon ay nakaligtas ng libu-libong buhay!
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 30px;">
            <button class="btn-restart" onclick="restartGame()">🔄 Maglaro Muli</button>
            <a href="{{ route('module4.explore', ['completed' => 'rolly']) }}" class="btn-restart" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">📚 Balik sa Explore</a>
        </div>

    </div>

</div>

<script>
    const gameData = [
        {
            level: 1,
            icon: '🔰',
            phase: 'BAGO ANG BAGYO (Preparedness Phase)',
            scenario: 'May paparating na super typhoon.',
            question: 'Ano ang uunahin mong gawin?',
            options: [
                { text: 'A. Maghintay muna ng update', correct: false },
                { text: 'B. Mag-evacuate agad ng mga residente sa danger zone', correct: true },
                { text: 'C. Mag-post lang sa social media', correct: false }
            ],
            feedback: '✅ Correct! Ang maagap na paglikas ay nakapagliligtas ng buhay.'
        },
        {
            level: 2,
            icon: '🌧️',
            phase: 'HABANG MAY BAGYO (Response Phase)',
            scenario: 'Tumataas na ang baha (abot leeg)',
            question: 'Ano ang gagawin mo?',
            options: [
                { text: 'A. Hayaan ang mga tao sa bahay', correct: false },
                { text: 'B. Mag-rescue operation gamit ang bangka', correct: true },
                { text: 'C. Isara ang barangay hall', correct: false }
            ],
            feedback: '✅ Correct! Ang agarang pagtugon ay mahalaga sa oras ng panganib.'
        },
        {
            level: 3,
            icon: '⚡',
            phase: 'PAGKAWALA NG KURYENTE AT TUBIG',
            scenario: 'Walang kuryente, kulang ang tubig',
            question: 'Ano ang solusyon?',
            options: [
                { text: 'A. Maghintay ng tulong', correct: false },
                { text: 'B. Mag-organize ng relief distribution', correct: true },
                { text: 'C. Magpahinga muna', correct: false }
            ],
            feedback: '✅ Correct! Ang organisadong tulong ay susi sa kaligtasan.'
        },
        {
            level: 4,
            icon: '🌊',
            phase: 'MATINDING PINSALA',
            scenario: 'Libo-libong bahay ang nasira',
            question: 'Ano ang susunod mong hakbang?',
            options: [
                { text: 'A. I-ignore muna', correct: false },
                { text: 'B. Mag-assess ng damage at pangangailangan', correct: true },
                { text: 'C. Umuwi na lang', correct: false }
            ],
            feedback: '✅ Correct! Mahalaga ang tamang assessment para sa epektibong tulong.'
        },
        {
            level: 5,
            icon: '🏛️',
            phase: 'NASIRANG PAMANA',
            scenario: 'Nasira ang simbahan at makasaysayang bahay',
            question: 'Ano ang dapat gawin?',
            options: [
                { text: 'A. Kalimutan na', correct: false },
                { text: 'B. I-dokumento at planuhin ang restoration', correct: true },
                { text: 'C. Gibain lahat', correct: false }
            ],
            feedback: '✅ Correct! Ang kultura at kasaysayan ay dapat pinapahalagahan.'
        },
        {
            level: 6,
            icon: '🤝',
            phase: 'PAGTUTULUNGAN',
            scenario: 'Kailangan ng bayan ang pagkakaisa',
            question: 'Ano ang gagawin mo?',
            options: [
                { text: 'A. Sariling pamilya lang ang tulungan', correct: false },
                { text: 'B. Hikayatin ang bayanihan', correct: true },
                { text: 'C. Umalis sa lugar', correct: false }
            ],
            feedback: '✅ Correct! Ang lakas ng komunidad ang susi sa pagbangon.'
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
        
        const buttons = document.querySelectorAll('.option-btn');
        buttons.forEach((btn, i) => {
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
        
        const percentage = (score / 6) * 100;
        document.getElementById('scoreDisplay').textContent = `${score}/6`;
        
        let title, description, icon, rank, badgeClass;
        
        if (score >= 5) {
            title = 'Disaster Ready Leader 🎖️';
            description = 'Ang iyong matalinong desisyon ay nakaligtas ng libu-libong buhay! Ikaw ay handa nang harapin ang kahirap-hirap at maglingkod sa komunidad.';
            icon = '🟢';
            rank = '⭐ Excellent Performance';
            badgeClass = 'rank-excellent';
        } else if (score >= 3) {
            title = 'Developing Responder 📈';
            description = 'Maganda ang iyong simula! Patuloy na mag-aral at palakasin ang iyong kaalaman tungkol sa disaster response.';
            icon = '🟡';
            rank = '⚡ Good Effort';
            badgeClass = 'rank-good';
        } else {
            title = 'Needs More Training 📚';
            description = 'Huwag mawalan ng pag-asa! Basahin muli ang mga kwento at subukan ang laro ulit.';
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

    // Initialize game
    renderLevel();
</script>

</body>
</html>
