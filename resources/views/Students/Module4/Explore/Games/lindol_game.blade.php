<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bogo City: Earthquake Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --emergency-orange: #f39c12;
            --safety-red: #d35400;
            --caution-yellow: #f1c40f;
            --rescue-charcoal: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto Mono', monospace;
            background-color: #1a1a1a;
            background-image: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://www.transparenttextures.com/patterns/cracked-mud.png');
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #ecf0f1;
        }

        .game-container {
            background: #ffffff;
            color: #333;
            border-radius: 8px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            max-width: 800px;
            width: 100%;
            padding: 40px;
            border: 4px solid var(--rescue-charcoal);
            position: relative;
            overflow: hidden;
        }

        .game-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 15px;
            background: repeating-linear-gradient(-45deg, #000, #000 10px, var(--caution-yellow) 10px, var(--caution-yellow) 20px);
        }

        .game-header {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 10px;
        }

        .game-title {
            font-family: 'Black Ops One', cursive;
            font-size: 28px;
            text-transform: uppercase;
            color: var(--safety-red);
            letter-spacing: 1px;
        }

        .game-subtitle {
            font-size: 14px;
            font-weight: 700;
            color: #7f8c8d;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            text-transform: uppercase;
        }

        /* FIXED LEVEL BADGE */
        .level-badge-container {
            display: inline-block;
            margin-bottom: 15px;
        }

        .level-badge {
            background: var(--rescue-charcoal);
            color: var(--caution-yellow);
            padding: 8px 25px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            /* Using skew instead of clip-path to prevent text cropping */
            transform: skew(-15deg); 
            border: 1px solid var(--caution-yellow);
        }

        .level-badge span {
            display: inline-block;
            transform: skew(15deg); /* Un-skew the text so it stays upright */
        }

        .progress {
            height: 12px;
            background: #dfe6e9;
            border-radius: 0;
            margin-top: 5px;
            border: 1px solid #ccc;
        }

        .progress-bar {
            background-color: var(--emergency-orange);
            transition: width 0.4s ease;
        }

        .scenario-box {
            background: #fdf2e9;
            padding: 25px;
            border: 1px solid var(--emergency-orange);
            border-left: 10px solid var(--safety-red);
            margin-bottom: 30px;
        }

        .scenario-icon {
            font-size: 40px;
            float: left;
            margin-right: 15px;
        }

        .scenario-title {
            font-weight: 900;
            color: var(--safety-red);
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .scenario-text {
            font-weight: 500;
            line-height: 1.4;
        }

        .question-box {
            background: var(--rescue-charcoal);
            color: white;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-left: 5px solid var(--caution-yellow);
        }

        .question-text {
            font-size: 18px;
            margin: 0;
        }

        .option-btn {
            padding: 15px;
            border: 2px solid #eee;
            background: #fff;
            margin-bottom: 10px;
            width: 100%;
            text-align: left;
            font-weight: bold;
            font-family: 'Roboto Mono', monospace;
            transition: 0.2s;
            cursor: pointer;
        }

        .option-btn:hover:not(:disabled) {
            background: #fcfcfc;
            border-color: var(--emergency-orange);
            padding-left: 25px;
        }

        .option-btn.correct { background: #27ae60 !important; color: white; border-color: #2ecc71; }
        .option-btn.incorrect { background: #c0392b !important; color: white; border-color: #e74c3c; }

        .feedback-box {
            border-left: 5px solid;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
        }

        .feedback-correct { background: #e8f5e9; border-color: #2ecc71; color: #1b5e20; }
        .feedback-incorrect { background: #ffebee; border-color: #e74c3c; color: #b71c1c; }

        .btn-primary-game {
            background: var(--safety-red);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 900;
            text-transform: uppercase;
            width: 100%;
            cursor: pointer;
            font-family: 'Black Ops One', cursive;
        }

        .btn-primary-game:hover:not(:disabled) {
            background: var(--rescue-charcoal);
        }

        .btn-primary-game:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Results Display */
        .score-display {
            font-family: 'Black Ops One', cursive;
            font-size: 60px;
            background: var(--rescue-charcoal);
            color: var(--caution-yellow);
            display: inline-block;
            padding: 20px 40px;
            margin-bottom: 20px;
            border: 3px solid var(--caution-yellow);
        }

        .rank-badge {
            font-size: 18px;
            text-transform: uppercase;
            padding: 10px 20px;
            font-weight: bold;
            display: inline-block;
        }

        .rank-excellent { background: #27ae60; color: white; }
        .rank-good { background: #f39c12; color: white; }
        .rank-needswork { background: #c0392b; color: white; }

        .btn-restart {
            padding: 12px 20px;
            background: var(--rescue-charcoal);
            color: white;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .game-container { padding: 20px; }
            .game-title { font-size: 20px; }
        }
    </style>
</head>
<body>

<div class="game-container">

    <div class="game-screen">
        <div class="game-header">
            <div class="game-title">⚠️ BOGO CITY RESCUE MISSION</div>
            <div class="game-subtitle">Incident Command Center: Earthquake Division</div>
        </div>

        <div class="progress-section">
            <div class="level-badge-container">
                <div class="level-badge">
                    <span id="levelBadge">Phase 1 of 7</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <div class="scenario-box" style="margin-top: 20px;">
            <div class="scenario-icon" id="scenarioIcon">🌍</div>
            <div style="overflow: hidden;">
                <div class="scenario-title" id="scenarioTitle">SITREP: Initial Impact</div>
                <div class="scenario-text" id="scenarioText">...</div>
            </div>
        </div>

        <div class="question-box">
            <p class="question-text" id="questionText">Awaiting input...</p>
        </div>

        <div class="options-container" id="optionsContainer"></div>

        <div class="feedback-box" id="feedbackBox">
            <div class="feedback-text" id="feedbackTitle" style="font-weight:bold;">Analysis</div>
            <div class="feedback-message" id="feedbackMessage">...</div>
        </div>

        <div class="button-group">
            <button class="btn-primary-game" id="nextBtn" onclick="nextLevel()" disabled>Proceed to Next Phase ➜</button>
        </div>
    </div>

    <div class="results-screen" id="resultsScreen" style="text-align: center; display: none;">
        <div class="results-icon" id="resultsIcon" style="font-size: 80px; margin-bottom: 10px;">🎖️</div>
        <div class="results-title" id="resultsTitle" style="font-family: 'Black Ops One'; font-size: 32px; color: var(--safety-red);">MISSION DEBRIEF</div>
        
        <div class="score-display" id="scoreDisplay">0/7</div>
        <br>
        <div class="rank-badge" id="rankBadge">RANK: EVALUATING...</div>

        <div class="results-description mt-4 mb-4" id="resultsDescription" style="max-width: 500px; margin: 20px auto; line-height: 1.6;">
            Assessment complete.
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 30px;">
            <button class="btn-restart" onclick="restartGame()">🔄 RE-START MISSION</button>
            <a href="{{ route('module4.explore', ['completed' => 'lindol']) }}" class="btn-restart" style="background: var(--safety-red); display: flex; align-items: center; justify-content: center;">📚 EXIT TO HQ</a>
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
            feedback: '✅ Correct! Ang tamang kilos habang lumilindol ay nakapagliligtas ng buhay.',
            wrongFeedback: '❌ Hindi ito ligtas habang lumilindol.'
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
            feedback: '✅ Correct! Ang agarang tulong ay kritikal sa oras ng sakuna.',
            wrongFeedback: '❌ Hindi ito ang pinakamabilis na paraan para makaligtas ng buhay.'
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
            feedback: '✅ Correct! Ang safety assessment ay mahalaga bago kumilos.',
            wrongFeedback: '❌ Delikado ang kumilos nang walang safety assessment.'
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
            feedback: '✅ Correct! Ang flexibility sa response ay nakakatulong sa mas maraming buhay.',
            wrongFeedback: '❌ Kailangan ng alternatibong setup para magpatuloy ang gamutan.'
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
            feedback: '✅ Correct! Ang maayos na evacuation ay nagbabawas ng panganib.',
            wrongFeedback: '❌ Kailangan ng organisadong evacuation para maiwasan ang panic at aksidente.'
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
            feedback: '✅ Correct! Ang aftershocks ay maaaring mas mapanganib.',
            wrongFeedback: '❌ Delikado pa rin ang paligid habang may aftershocks.'
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
            feedback: '✅ Correct! Ang bayanihan ang susi sa pagbangon.',
            wrongFeedback: '❌ Sa sakuna, mahalaga ang koordinasyon at pagtutulungan.'
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
                    game_type: 'lindol',
                    score: score,
                    total_items: gameData.length,
                    rank: rank,
                    is_completed: true
                })
            });
        } catch (error) {
            console.error('Failed to save Lindol game result:', error);
        }
    }

    function renderLevel() {
        const level = gameData[currentLevel];
        document.getElementById('levelBadge').textContent = `Phase ${level.level} of 7`;
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

        const fb = document.getElementById('feedbackBox');
        fb.style.display = 'none';
        fb.className = 'feedback-box';
        document.getElementById('nextBtn').disabled = true;
        answered = false;
    }

    function selectOption(index) {
        if (answered) return;
        const level = gameData[currentLevel];
        const correct = level.options[index].correct;
        const correctOption = level.options.find(option => option.correct);

        document.querySelectorAll('.option-btn').forEach((btn, i) => {
            if (level.options[i].correct) btn.classList.add('correct');
            else if (i === index && !correct) btn.classList.add('incorrect');
            btn.disabled = true;
        });

        if (correct) score++;

        const fb = document.getElementById('feedbackBox');
        fb.style.display = 'block';
        fb.classList.add(correct ? 'feedback-correct' : 'feedback-incorrect');
        document.getElementById('feedbackTitle').textContent = correct ? '✅ STRATEGIC SUCCESS' : '❌ CALCULATION ERROR';
        document.getElementById('feedbackMessage').textContent = correct
            ? level.feedback
            : `${level.wrongFeedback} Tamang sagot: ${correctOption.text}`;
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
        const rs = document.getElementById('resultsScreen');
        rs.style.display = 'block';

        document.getElementById('scoreDisplay').textContent = `${score}/7`;

        let title, description, icon, rank, badgeClass;
        if (score >= 6) {
            title = 'ELITE RESPONDER 🎖️';
            description = 'Magaling! Handa ka na sa lindol at alam mo ang tamang aksyon sa gitna ng krisis.';
            icon = '🟢';
            rank = 'RANK: DISASTER READY LEADER';
            badgeClass = 'rank-excellent';
        } else if (score >= 4) {
            title = 'FIELD AGENT 📈';
            description = 'Maganda ang simula. Mas lalo pang paigtingin ang kaalaman tungkol sa earthquake safety.';
            icon = '🟡';
            rank = 'RANK: DEVELOPING RESPONDER';
            badgeClass = 'rank-good';
        } else {
            title = 'CADET – NEEDS RETRAINING 📚';
            description = 'Kailangan pa ng karagdagang pagsasanay para mas maging handa sa lindol.';
            icon = '🔴';
            rank = 'RANK: NEEDS IMPROVEMENT';
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