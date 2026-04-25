<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌋 Bulkan Survival: The Path to Safety</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --lava: #ff4d00;
            --magma: #cf1010;
            --safe: #10b981;
            --bg: #0f0f0f;
            --card-size: 130px;
        }

        body {
            background-color: var(--bg);
            color: #eee;
            font-family: 'Lexend', sans-serif;
            overflow: hidden; /* Lock scroll for the experience */
            height: 100vh;
        }

        .container { max-width: 1000px; height: 100%; display: flex; flex-direction: column; }

        /* Story Area */
        .story-tracker {
            text-align: center;
            padding: 20px;
            background: rgba(0,0,0,0.5);
            border-bottom: 2px solid #333;
            border-radius: 0 0 20px 20px;
        }

        /* The Game Path */
        .game-path-container {
            flex-grow: 1;
            position: relative;
            background: #1a1a1a;
            border-radius: 30px;
            margin: 20px 0;
            padding: 20px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #333;
        }

        /* Visual Lava Flow */
        .lava-flow {
            position: absolute;
            left: -100%; /* Starts off-screen */
            top: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(to right, transparent, var(--magma), rgba(255, 77, 0, 0.4), transparent);
            transition: left 1s cubic-bezier(0.165, 0.84, 0.44, 1);
            opacity: 0.7;
            pointer-events: none;
            z-index: 10;
        }

        /* The Image Choices */
        .choices-area {
            display: flex;
            gap: 15px;
            justify-content: center;
            position: relative;
            z-index: 20; /* Above the lava */
        }

        .game-item {
            background: #fff;
            border-radius: 18px;
            border: 4px solid #444;
            width: var(--card-size);
            height: var(--card-size);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.4);
            position: relative;
        }

        .game-item:hover {
            transform: scale(1.1) rotate(-3deg);
            border-color: var(--lava);
            box-shadow: 0 15px 30px rgba(255, 77, 0, 0.3);
        }

        .game-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            pointer-events: none;
        }

        /* State Styles */
        .disabled { opacity: 0.3; pointer-events: none; }
        .collected { border-color: var(--safe) !important; filter: grayscale(1); transform: scale(0.9) !important; }
        .game-over { background-color: #700; border-color: red !important; animation: shake 0.5s; }

        .game-map {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            opacity: 0.6;
            font-size: 0.8rem;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
    </style>
</head>
<body>

<div class="container py-3">
    <div class="story-tracker">
        <h2 class="fw-black text-white m-0">🌋 BULKAN SURVIVAL</h2>
        <p id="story-text" class="text-secondary small mt-1">Nagsimula na ang pagputok ng bulkan! Ano ang unang hakbang para sa kaligtasan?</p>
        <div class="game-map">
            <span>🏠 Bahay</span>
            <span>⬇️</span>
            <span>⬇️</span>
            <span>⬇️</span>
            <span>⬇️</span>
            <span>⬇️</span>
            <span>⬇️</span>
            <span>✅ Ligtas na Evacuation Center</span>
        </div>
    </div>

    <div id="game-area" class="game-path-container">
        <div id="lava-overlay" class="lava-flow"></div>
        <div class="choices-area" id="choices">
            <div class="game-item" id="bulkan1" data-id="safe1" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan1.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan2" data-id="safe2" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan2.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan5" data-id="safe3" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan5.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan6" data-id="safe4" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan6.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan3" data-id="hazard1" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan3.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan4" data-id="hazard2" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan4.png" alt="Step">
            </div>
            <div class="game-item" id="bulkan7" data-id="hazard3" onclick="selectStep(this)">
                <img src="/pictures/Module 3/Bulkan_Activity/bulkan7.jpg" alt="Step">
            </div>
        </div>
    </div>

    <div class="text-center p-3">
        <p class="small text-secondary">I-click ang tamang hakbang o gamit para makalayo sa lava flow.</p>
    </div>

    <div id="feedback-area" class="feedback-container d-none animate__animated animate__zoomIn p-5 bg-success rounded-4 text-center">
        <h2 class="fw-bold text-white">Nakaligtas Ka! 🏆</h2>
        <p class="text-white">Mahusay ang iyong naging desisyon at mabilis kang nakalikas. Isang daang puntos (100) para sa kaligtasan!</p>
        <a href="{{ route('flood.activity') }}" class="btn btn-light btn-lg mt-3 fw-bold rounded-pill px-5">SUSUNOD NA LEVEL →</a>
    </div>
</div>

<script>
    const choices = document.getElementById('choices');
    const lava = document.getElementById('lava-overlay');
    const storyText = document.getElementById('story-text');
    let lavaPosition = -100; // Start off-screen
    let currentSafeStep = 1; // Track which 'safe' item must be clicked next
    const totalSafeSteps = 4; // Bulkan 1, 2, 5, 6

    const stories = {
        1: "Tumatakas ang oras! Kunin muna ang Emergency Kit (Bulkan 1).",
        2: "Nakuha mo ang kit! Isuot na ang N95 mask (Bulkan 5) bago lumabas.",
        3: "Magaling! Makinig muna sa radyo (Bulkan 6) para sa balita.",
        4: "Ngayong may alam ka na sa balita, lumikas na agad (Bulkan 2)! Bilisan mo!",
        win: "Ligtas ka na sa evacuation center!"
    };

    function selectStep(element) {
        const stepId = element.dataset.id;
        const choicesChildren = Array.from(choices.children);

        if (stepId.startsWith('safe')) {
            // Player clicked a correct survival action
            handleCorrectChoice(element, choicesChildren);
        } else {
            // Player clicked a 'hazard' action
            handleWrongChoice(element);
        }
    }

    function handleCorrectChoice(element, choicesChildren) {
        element.classList.add('collected');
        element.style.pointerEvents = 'none'; // Lock this item
        currentSafeStep++;

        // Visual feedback
        storyText.innerText = stories[currentSafeStep] || stories.win;
        storyText.classList.add('animate__animated', 'animate__fadeIn');
        setTimeout(() => storyText.classList.remove('animate__animated', 'animate__fadeIn'), 500);

        // Win Condition
        if (currentSafeStep > totalSafeSteps) {
            finishGame(true);
        }
    }

    function handleWrongChoice(element) {
        element.classList.add('animate__animated', 'animate__headShake', 'game-over');
        
        // Lava moves closer when a bad choice is made
        lavaPosition += 25; 
        lava.style.left = lavaPosition + "%";

        storyText.innerText = "Mali ang desisyon mo! Hinahabol ka na ng lava!";
        storyText.classList.add('text-danger');
        setTimeout(() => storyText.classList.remove('text-danger'), 1000);

        // Game Over Condition
        if (lavaPosition >= 0) {
            choices.classList.add('disabled');
            storyText.innerText = "GAME OVER: Nalamon ka ng lava flow. Subukan muli.";
            fetchScore(0); // Optional Laravel save
            // Restart after short delay
            setTimeout(() => location.reload(), 2500);
        } else {
            // Temporary flash to show it's wrong, then allow clicking again
            setTimeout(() => element.classList.remove('game-over', 'animate__animated', 'animate__headShake'), 1000);
        }
    }

    function finishGame(win) {
        if (win) {
            choices.style.display = 'none';
            document.getElementById('feedback-area').classList.remove('d-none');
            fetchScore(100); // Save winning score to Laravel
        }
    }

    // Function to handle the Laravel save logic
    function fetchScore(finalScore) {
        fetch("{{ route('student.module3.bulkan.save') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: JSON.stringify({ score: finalScore, status: finalScore >= 100 ? 'passed' : 'failed' })
        });
    }

</script>

</body>
</html>