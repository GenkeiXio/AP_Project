<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Flood Survival: Guinobatan Mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --accent-blue: #38bdf8;
            --emergency-red: #ef4444;
            --success-green: #22c55e;
            --warning-orange: #f59e0b;
            --card-bg: #1e293b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .game-container {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            max-width: 850px;
            width: 100%;
            overflow: hidden;
        }

        /* HUD Header */
        .hud-header {
            background: rgba(15, 23, 42, 0.6);
            padding: 20px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mission-title {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.9rem;
            color: var(--accent-blue);
            margin: 0;
            letter-spacing: 1px;
        }

        .safety-meter-container {
            width: 200px;
        }

        .meter-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            text-transform: uppercase;
            color: #94a3b8;
            display: block;
            margin-bottom: 4px;
        }

        .progress-sync {
            height: 8px;
            background: #334155;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Game Content */
        .game-content { padding: 40px; }

        .scenario-card {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid var(--accent-blue);
        }

        .phase-tag {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: var(--warning-orange);
            background: rgba(245, 158, 11, 0.1);
            padding: 4px 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: inline-block;
            font-weight: 700;
        }

        .scenario-text { font-size: 1.1rem; color: #cbd5e1; line-height: 1.6; }

        .question-text { font-size: 1.4rem; font-weight: 700; margin-bottom: 25px; color: #fff; }

        /* Options Grid */
        .options-grid { display: grid; gap: 12px; }

        .option-btn {
            background: #334155;
            border: 2px solid transparent;
            padding: 18px 25px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
            color: white;
            font-weight: 500;
            width: 100%;
        }

        .option-btn:hover:not(:disabled) {
            background: #475569;
            border-color: var(--accent-blue);
            transform: translateX(5px);
        }

        .option-btn.correct { background: rgba(34, 197, 94, 0.2) !important; border-color: var(--success-green) !important; color: #bef264; }
        .option-btn.incorrect { background: rgba(239, 68, 68, 0.2) !important; border-color: var(--emergency-red) !important; color: #fca5a5; }

        .feedback-box {
            margin-top: 20px;
            padding: 15px 20px;
            border-radius: 12px;
            display: none;
            font-size: 0.95rem;
            animation: fadeIn 0.4s;
            font-weight: 500;
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .btn-next {
            background: var(--accent-blue);
            color: var(--bg-dark);
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 800;
            width: 100%;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-next:disabled { opacity: 0.3; cursor: not-allowed; }

        /* Results */
        .results-screen { text-align: center; padding: 50px 20px; display: none; }
        .score-display { font-size: 4rem; font-weight: 800; color: var(--accent-blue); margin: 20px 0; }
        
        .rank-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="game-container">
    <div class="hud-header">
        <div>
            <p class="mission-title">🌧️ Flash Flood Survival: Guinobatan</p>
            <span id="lvlDisplay" style="font-family: 'JetBrains Mono'; font-size: 11px; color: #64748b;">LEVEL 1/6</span>
        </div>
        <div class="safety-meter-container">
            <span class="meter-label">Community Safety Status</span>
            <div class="progress-sync">
                <div id="safetyBar" class="progress-bar bg-info" style="width: 100%; transition: width 0.5s ease;"></div>
            </div>
        </div>
    </div>

    <div id="gameScreen" class="game-content">
        <div class="scenario-card">
            <span id="phaseTag" class="phase-tag">PHASE</span>
            <div id="scenarioText" class="scenario-text">...</div>
        </div>

        <div class="question-box">
            <div id="questionText" class="question-text">...</div>
        </div>

        <div id="optionsContainer" class="options-grid"></div>

        <div id="feedbackBox" class="feedback-box"></div>

        <button id="nextBtn" class="btn-next" onclick="nextLevel()" disabled>SUSUNOD NA LEVEL ➜</button>
    </div>

    <div id="resultsScreen" class="results-screen">
        <div id="resIcon" style="font-size: 60px;">🎖️</div>
        <h1 id="resTitle" style="font-weight: 800; margin-top: 10px;">Flood-Ready Leader</h1>
        <div id="rankBadge" class="rank-badge">RANK</div>
        <div class="score-display" id="scoreDisplay">0/6</div>
        <p id="resDesc" class="mb-5" style="color: #94a3b8; max-width: 500px; margin: 0 auto;">...</p>
        
        <div class="d-flex gap-2 justify-content-center">
            <button id="restartBtn" class="btn btn-outline-light px-4 py-3" onclick="restartGame()">🔄 Maglaro Muli</button>
            <a id="backBtn" href="{{ route('module4.explore', ['completed' => 'baha']) }}" class="btn btn-info px-4 py-3" style="font-weight: 700; display: none;">📚 Balik sa Explore</a>
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
    let safety = 100;
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
                    game_type: 'baha',
                    score: score,
                    total_items: gameData.length,
                    rank: rank,
                    is_completed: true
                })
            });
        } catch (error) {
            console.error('Failed to save Baha game result:', error);
        }
    }

    function renderLevel() {
        const level = gameData[currentLevel];
        document.getElementById('lvlDisplay').textContent = `LEVEL ${level.level}/6`;
        document.getElementById('phaseTag').textContent = level.phase;
        document.getElementById('scenarioText').textContent = level.scenario;
        document.getElementById('questionText').textContent = level.question;

        const optionsContainer = document.getElementById('optionsContainer');
        optionsContainer.innerHTML = '';

        level.options.forEach((option, index) => {
            const btn = document.createElement('button');
            btn.className = 'option-btn';
            btn.textContent = option.text;
            btn.onclick = () => selectOption(index, btn);
            optionsContainer.appendChild(btn);
        });

        document.getElementById('feedbackBox').style.display = 'none';
        document.getElementById('nextBtn').disabled = true;
        answered = false;
    }

    function selectOption(index, btn) {
        if (answered) return;
        answered = true;
        const level = gameData[currentLevel];
        const correct = level.options[index].correct;

        if (correct) {
            btn.classList.add('correct');
            score++;
        } else {
            btn.classList.add('incorrect');
            safety -= 16.6;
            document.getElementById('safetyBar').style.width = Math.max(0, safety) + '%';
            // Show correct answer
            document.querySelectorAll('.option-btn').forEach((b, i) => {
                if(level.options[i].correct) b.classList.add('correct');
            });
        }

        const feedback = document.getElementById('feedbackBox');
        feedback.style.display = 'block';
        feedback.style.background = correct ? 'rgba(34, 197, 94, 0.1)' : 'rgba(239, 68, 68, 0.1)';
        feedback.style.color = correct ? '#bef264' : '#fca5a5';
        feedback.textContent = level.feedback;

        document.getElementById('nextBtn').disabled = false;
    }

    function nextLevel() {
        currentLevel++;
        if (currentLevel < gameData.length) {
            renderLevel();
        } else {
            showResults();
        }
    }

    function showResults() {
        document.getElementById('gameScreen').style.display = 'none';
        document.getElementById('resultsScreen').style.display = 'block';
        document.getElementById('scoreDisplay').textContent = `${score}/6`;

        const title = document.getElementById('resTitle');
        const desc = document.getElementById('resDesc');
        const icon = document.getElementById('resIcon');
        const badge = document.getElementById('rankBadge');

        if (score >= 5) {
            title.textContent = "Flood-Ready Leader";
            desc.textContent = "Magaling! Ang iyong mabilis at tamang desisyon ay nakatulong sa komunidad.";
            icon.textContent = "🟢";
            badge.textContent = "Excellent Performance";
            badge.style.background = "rgba(34, 197, 94, 0.2)";
            badge.style.color = "#22c55e";
        } else if (score >= 3) {
            title.textContent = "Developing Responder";
            desc.textContent = "Maganda ang simula. Mas lalo pang paigtingin ang iyong kaalaman.";
            icon.textContent = "🟡";
            badge.textContent = "Good Effort";
            badge.style.background = "rgba(245, 158, 11, 0.2)";
            badge.style.color = "#f59e0b";
        } else {
            title.textContent = "At Risk – Needs Training";
            desc.textContent = "Kailangan pa ng karagdagang pagsasanay para mas maging handa.";
            icon.textContent = "🔴";
            badge.textContent = "Needs Improvement";
            badge.style.background = "rgba(239, 68, 68, 0.2)";
            badge.style.color = "#ef4444";
        }

        saveGameResult(badge.textContent);

        if (score === 6) {
            document.getElementById('restartBtn').style.display = 'none';
            document.getElementById('backBtn').style.display = 'inline-block';
        } else {
            document.getElementById('restartBtn').style.display = 'inline-block';
            document.getElementById('backBtn').style.display = 'none';
        }
    }

    function restartGame() {
        currentLevel = 0;
        score = 0;
        safety = 100;
        document.getElementById('safetyBar').style.width = '100%';
        document.getElementById('gameScreen').style.display = 'block';
        document.getElementById('resultsScreen').style.display = 'none';
        renderLevel();
    }

    renderLevel();
</script>

</body>
</html>