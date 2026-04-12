<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolly Rescue Mission | Storm Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Inter:wght@400;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <style>
        :root {
            --emergency-navy: #0f172a;
            --alert-red: #dc2626;
            --warning-yellow: #facc15;
            --success-green: #22c55e;
            --glass: rgba(255, 255, 255, 0.05);
            --border-glass: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            /* Wind effect overlay */
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3%3Cfilter id='noiseFilter'%3%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3%3C/filter%3%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3%3C/svg%3");
            background-blend-mode: overlay;
        }

        .game-container {
            background: var(--emergency-navy);
            border: 2px solid var(--border-glass);
            border-radius: 12px;
            box-shadow: 0 0 50px rgba(0,0,0,0.8);
            max-width: 850px;
            width: 100%;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Tactical Header */
        .game-header {
            text-align: left;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--alert-red);
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .game-title {
            font-family: 'Black Ops One', system-ui;
            font-size: 28px;
            text-transform: uppercase;
            color: var(--warning-yellow);
            letter-spacing: 2px;
        }

        .game-subtitle {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
        }

        /* Radar Progress */
        .progress-section {
            margin-bottom: 30px;
        }

        .level-badge {
            font-family: 'JetBrains Mono', monospace;
            background: var(--alert-red);
            color: white;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
            clip-path: polygon(10% 0, 100% 0, 90% 100%, 0% 100%);
        }

        .progress {
            height: 6px;
            background: #334155;
            border-radius: 0;
        }

        .progress-bar {
            background: var(--warning-yellow);
            box-shadow: 0 0 15px var(--warning-yellow);
        }

        /* Mission Scenario Card */
        .scenario-box {
            background: var(--glass);
            border: 1px solid var(--border-glass);
            padding: 25px;
            position: relative;
            margin-bottom: 30px;
        }

        .scenario-box::before {
            content: "SITUATION REPORT";
            position: absolute;
            top: -10px;
            left: 20px;
            background: var(--emergency-navy);
            padding: 0 10px;
            font-size: 10px;
            font-family: 'JetBrains Mono';
            color: var(--warning-yellow);
        }

        .scenario-icon { font-size: 40px; margin-right: 20px; float: left; }
        .scenario-title { font-weight: 800; color: var(--warning-yellow); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;}
        .scenario-text { color: #e2e8f0; font-size: 1.1rem; line-height: 1.6; }

        /* Tactical Options */
        .question-box { margin-bottom: 20px; }
        .question-text { font-weight: 700; font-size: 1.2rem; border-left: 4px solid var(--alert-red); padding-left: 15px; }

        .options-container { display: grid; gap: 10px; }

        .option-btn {
            background: transparent;
            border: 1px solid #475569;
            color: #cbd5e1;
            padding: 18px;
            text-align: left;
            transition: 0.2s;
            font-weight: 500;
            border-radius: 4px;
        }

        .option-btn:hover:not(:disabled) {
            background: rgba(250, 204, 21, 0.1);
            border-color: var(--warning-yellow);
            color: white;
        }

        .option-btn.correct { background: var(--success-green) !important; color: white !important; border-color: var(--success-green); }
        .option-btn.incorrect { background: var(--alert-red) !important; color: white !important; border-color: var(--alert-red); }

        /* Feedback Comms */
        .feedback-box {
            background: #1e293b;
            border-left: 4px solid white;
            padding: 15px;
            margin-top: 20px;
            font-family: 'JetBrains Mono', monospace;
            display: none;
        }

        .feedback-correct { border-color: var(--success-green); color: var(--success-green); }
        .feedback-incorrect { border-color: var(--alert-red); color: var(--alert-red); }

        /* Tactical Buttons */
        .btn-primary-game {
            background: var(--warning-yellow);
            color: black;
            border: none;
            padding: 15px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            width: 100%;
        }

        .btn-primary-game:hover:not(:disabled) { background: #eab308; transform: scale(1.01); }

        /* Result Screen HUD */
        .results-screen { text-align: center; display: none; }
        .score-display { 
            font-family: 'Black Ops One';
            font-size: 70px; 
            color: var(--warning-yellow);
            text-shadow: 0 0 20px rgba(250, 204, 21, 0.4);
        }

        .rank-badge {
            font-family: 'JetBrains Mono';
            padding: 8px 20px;
            border: 2px solid;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: inline-block;
        }

        .rank-excellent { border-color: var(--success-green); color: var(--success-green); }
        .rank-good { border-color: var(--warning-yellow); color: var(--warning-yellow); }
        .rank-needswork { border-color: var(--alert-red); color: var(--alert-red); }

        .btn-restart {
            background: #334155;
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: 700;
            border-radius: 4px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-restart:hover { background: #475569; }

        @media (max-width: 768px) {
            .game-header { flex-direction: column; align-items: flex-start; }
            .game-container { padding: 20px; }
        }
    </style>
</head>
<body>

<div class="game-container">
    <div class="game-screen">
        <div class="game-header">
            <div>
                <div class="game-subtitle">STORM COMMAND UNIT</div>
                <div class="game-title">🌀 ROLLY RESCUE MISSION</div>
            </div>
            <div id="levelBadge" class="level-badge">LEVEL 1 / 6</div>
        </div>

        <div class="progress-section">
            <div class="progress">
                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <div class="scenario-box">
            <div class="scenario-icon" id="scenarioIcon">📢</div>
            <div class="scenario-title" id="scenarioTitle">PHASE</div>
            <div class="scenario-text" id="scenarioText">...</div>
            <div style="clear:both;"></div>
        </div>

        <div class="question-box">
            <div class="question-text" id="questionText">...</div>
        </div>

        <div class="options-container" id="optionsContainer"></div>

        <div class="feedback-box" id="feedbackBox">
            <div id="feedbackTitle" style="font-weight: bold; margin-bottom: 5px;">COMM_LOG:</div>
            <div id="feedbackMessage">...</div>
        </div>

        <div class="button-group mt-4">
            <button class="btn-primary-game" id="nextBtn" onclick="nextLevel()" disabled>PROCEED TO NEXT PHASE ➜</button>
        </div>
    </div>

    <div class="results-screen" id="resultsScreen">
        <div class="results-icon" id="resultsIcon" style="font-size: 80px;">🎖️</div>
        <div class="results-title" id="resultsTitle" style="font-family: 'Black Ops One'; font-size: 32px; margin: 15px 0;">MISSION DEBRIEF</div>
        
        <div class="score-display" id="scoreDisplay">6/6</div>
        <br>
        <div class="rank-badge" id="rankBadge">RANK</div>

        <div class="results-description mt-3 mb-4" id="resultsDescription" style="max-width: 600px; margin: 0 auto; color: #94a3b8; line-height: 1.6;">
            ...
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 30px;">
            <button class="btn-restart" onclick="restartGame()">🔄 RE-RUN MISSION</button>
            <a href="{{ route('module4.explore', ['completed' => 'rolly']) }}" class="btn-restart" style="background: var(--warning-yellow); color: black;">📚 BACK TO HQ</a>
        </div>
    </div>
</div>

<script>
    // Logic remains strictly identical to original
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
            feedback: '✅ Correct! Ang maagap na paglikas ay nakapagliligtas ng buhay.',
            wrongFeedback: '❌ Hindi ito ang pinakamahusay na unang hakbang sa ganitong sitwasyon.'
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
            feedback: '✅ Correct! Ang agarang pagtugon ay mahalaga sa oras ng panganib.',
            wrongFeedback: '❌ Sa tumataas na baha, kailangan ang aktibong rescue at mabilis na pag-aksyon.'
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
            feedback: '✅ Correct! Ang organisadong tulong ay susi sa kaligtasan.',
            wrongFeedback: '❌ Sa kakulangan ng suplay, mahalaga ang maayos at agarang pamamahagi ng relief.'
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
            feedback: '✅ Correct! Mahalaga ang tamang assessment para sa epektibong tulong.',
            wrongFeedback: '❌ Bago tumulong nang malawakan, dapat munang malinaw ang lawak ng pinsala at pangangailangan.'
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
            feedback: '✅ Correct! Ang kultura at kasaysayan ay dapat pinapahalagahan.',
            wrongFeedback: '❌ Ang makasaysayang pook ay kailangang idokumento at maibalik, hindi basta isinasantabi.'
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
            feedback: '✅ Correct! Ang lakas ng komunidad ang susi sa pagbangon.',
            wrongFeedback: '❌ Sa pagbangon mula sa sakuna, kailangan ang pagtutulungan ng buong komunidad.'
        }
    ];

    let currentLevel = 0;
    let score = 0;
    let answered = false;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const gameSaveUrl = "{{ route('student.module4.games.save') }}";

    async function saveGameResult(rank) {
        try {
            await fetch(gameSaveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    game_type: 'rolly',
                    score: score,
                    total_items: gameData.length,
                    rank: rank,
                    is_completed: true
                })
            });
        } catch (error) {
            console.error('Failed to save Rolly game result:', error);
        }
    }

    function renderLevel() {
        const level = gameData[currentLevel];
        document.getElementById('levelBadge').textContent = `PHASE 0${level.level} / 06`;
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
        document.getElementById('feedbackBox').style.display = 'none';
        document.getElementById('feedbackBox').classList.remove('feedback-correct', 'feedback-incorrect');
        document.getElementById('nextBtn').disabled = true;
        answered = false;
    }

    function selectOption(index) {
        if (answered) return;
        const level = gameData[currentLevel];
        const correct = level.options[index].correct;
        const correctOption = level.options.find(option => option.correct);
        const buttons = document.querySelectorAll('.option-btn');
        buttons.forEach((btn, i) => {
            if (level.options[i].correct) btn.classList.add('correct');
            else if (i === index && !correct) btn.classList.add('incorrect');
            btn.disabled = true;
        });
        if (correct) score++;
        const feedbackBox = document.getElementById('feedbackBox');
        feedbackBox.style.display = 'block';
        if (correct) {
            feedbackBox.classList.add('feedback-correct');
            document.getElementById('feedbackTitle').textContent = '✅ TARGET IDENTIFIED';
            document.getElementById('feedbackMessage').textContent = level.feedback;
        } else {
            feedbackBox.classList.add('feedback-incorrect');
            document.getElementById('feedbackTitle').textContent = '❌ STRATEGIC ERROR';
            document.getElementById('feedbackMessage').textContent = `${level.wrongFeedback} Tamang sagot: ${correctOption.text}`;
        }
        document.getElementById('nextBtn').disabled = false;
        answered = true;
    }

    function nextLevel() {
        currentLevel++;
        if (currentLevel >= gameData.length) showResults();
        else renderLevel();
    }

    function showResults() {
        document.querySelector('.game-screen').style.display = 'none';
        document.getElementById('resultsScreen').style.display = 'block';
        document.getElementById('scoreDisplay').textContent = `${score}/6`;
        let title, description, icon, rank, badgeClass;
        if (score >= 5) {
            title = 'ELITE COMMANDER';
            description = 'Ang iyong matalinong desisyon ay nakaligtas ng libu-libong buhay! Ikaw ay handa nang harapin ang kahirap-hirap at maglingkod sa komunidad.';
            icon = '🟢';
            rank = 'OFFICIAL RANK: DISASTER READY LEADER';
            badgeClass = 'rank-excellent';
        } else if (score >= 3) {
            title = 'FIELD RESPONDER';
            description = 'Maganda ang iyong simula! Patuloy na mag-aral at palakasin ang iyong kaalaman tungkol sa disaster response.';
            icon = '🟡';
            rank = 'OFFICIAL RANK: DEVELOPING RESPONDER';
            badgeClass = 'rank-good';
        } else {
            title = 'TRAINEE STATUS';
            description = 'Huwag mawalan ng pag-asa! Basahin muli ang mga kwento at subukan ang laro ulit.';
            icon = '🔴';
            rank = 'OFFICIAL RANK: NEEDS MORE TRAINING';
            badgeClass = 'rank-needswork';
        }
        document.getElementById('resultsIcon').textContent = icon;
        document.getElementById('resultsTitle').textContent = title;
        document.getElementById('resultsDescription').textContent = description;
        document.getElementById('rankBadge').textContent = rank;
        document.getElementById('rankBadge').className = 'rank-badge ' + badgeClass;

        saveGameResult(rank);
    }

    function restartGame() {
        currentLevel = 0; score = 0; answered = false;
        document.querySelector('.game-screen').style.display = 'block';
        document.getElementById('resultsScreen').style.display = 'none';
        renderLevel();
    }

    renderLevel();
</script>
</body>
</html>