@extends('Students.studentslayout')
@section('title', 'Module 4 : Balik-Aral')

@push('styles')
<style>
    html, body{
        scroll-behavior:smooth;
        background:
            radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
            radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
            radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
            linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
    }

    body{
        overflow-x:hidden;
        color:var(--text);
        font-family:'Poppins', sans-serif;
    }

    .container-box {
        max-width: 1100px;
        margin: auto;
        background: white;
        padding: 25px 30px;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,.15);
    }

    h2 { text-align:center; font-weight:800; margin-bottom: 0.5rem; font-size: 2rem; }

    /* COMPACT TIMER + SCORE HEADER */
    .game-stats {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
        background: #1a2a1f;
        border-radius: 60px;
        padding: 8px 20px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.1);
    }
    .timer-section {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 2;
    }
    .timer-label {
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }
    .timer-slider-wrapper {
        flex: 1;
        background: #e9ecef;
        border-radius: 40px;
        height: 12px;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
    }
    .timer-slider-bar {
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #28a745, #ffc107, #dc3545);
        border-radius: 40px;
        transition: width 0.2s linear;
    }
    .timer-big-number {
        font-weight: 800;
        background: #f8f9fa;
        padding: 4px 16px;
        border-radius: 40px;
        color: #1e5a3a;
        font-size: 1.3rem;
        min-width: 70px;
        text-align: center;
        font-family: monospace;
        font-weight: 800;
    }
    .score-section {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.15);
        padding: 5px 18px;
        border-radius: 50px;
    }
    .score-label {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .score-value {
        background: #f8f9fa;
        padding: 4px 14px;
        border-radius: 40px;
        font-weight: 800;
        font-size: 1.3rem;
        color: #2c7a4d;
    }
    .score-value span {
        font-size: 1rem;
        color: #6c757d;
    }

    .zones {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 18px;
        margin-top: 25px;
    }

    .zone {
        border: 3px dashed #ccc;
        border-radius: 20px;
        padding: 15px 10px;
        min-height: 250px;
        background: rgba(255,255,240,0.6);
        transition: none;
    }

    .before { border-color: #4f90ff; background: rgba(79,144,255,0.08); }
    .during { border-color: #ffc107; background: rgba(255,193,7,0.08); }
    .after { border-color: #28a745; background: rgba(40,167,69,0.08); }

    .zone h5 {
        text-align: center;
        font-weight: 800;
        margin-bottom: 15px;
        font-size: 1.3rem;
    }

    .items {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        justify-content: center;
        margin-top: 30px;
        padding: 18px;
        background: #fef9e6;
        border-radius: 60px;
    }

    .item {
        background: white;
        padding: 14px 22px;
        border-radius: 60px;
        cursor: grab;
        min-width: 170px;
        text-align: center;
        font-weight: 600;
        font-size: 1rem;
        border: 2px solid #ddd;
        user-select: none;
        /* REMOVED: box-shadow, transition, border-left */
    }
    .item:active { cursor: grabbing; }
    
    /* Remove any drag visual effects */
    .item:active, .item:focus, .item:focus-visible {
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }
    
    /* Remove default drag image glow */
    .item::-moz-selection,
    .item::selection {
        background: transparent;
    }

    .correct {
        background: #d4edda;
        border: 2px solid #28a745;
        opacity: 0.9;
        cursor: default;
    }
    .wrong {
        background: #f8d7da;
        border: 2px solid #dc3545;
        animation: shake 0.3s ease-in-out 0s 2;
    }

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-6px); }
        75% { transform: translateX(6px); }
        100% { transform: translateX(0); }
    }

    /* BIGGER BUTTON */
    .btn-reset {
        background: #ffc107;
        border: none;
        padding: 14px 40px;
        font-size: 1.3rem;
        font-weight: 800;
        border-radius: 60px;
        color: #2c3e2f;
        transition: 0.2s;
        box-shadow: 0 6px 0 #b8860b;
        letter-spacing: 1px;
    }
    .btn-reset:hover {
        background: #ffca2c;
        transform: translateY(-2px);
        box-shadow: 0 8px 0 #b8860b;
    }
    .btn-reset:active {
        transform: translateY(4px);
        box-shadow: 0 2px 0 #b8860b;
    }

    .controls { text-align:center; margin-top: 30px; }
    .feedback {
        margin-top:25px;
        padding:20px;
        border-radius:25px;
        display:none;
        font-weight: 500;
        text-align: center;
        font-size: 1.1rem;
    }
    .zone .item {
        margin: 10px auto;
        width: 90%;
        cursor: default;
    }

    @media (max-width: 700px) {
        .zones { gap: 10px; }
        .item { min-width: 130px; font-size: 0.85rem; padding: 10px 12px; }
        .timer-big-number { font-size: 1rem; min-width: 55px; padding: 3px 10px; }
        .score-value { font-size: 1rem; padding: 3px 10px; }
        .btn-reset { padding: 10px 28px; font-size: 1.1rem; }
        .game-stats { padding: 6px 15px; }
        .timer-slider-wrapper { height: 8px; }
    }
</style>
@endpush


@section('content')
<div class="container-box">

    <h2>🎮 Ayusin Mo Ako!</h2>
    <p class="text-center text-muted"><strong>📌 Gabay:</strong> I-drag ang bawat gawain sa tamang yugto (Bago, Habang, Pagkatapos).</p>

    <!-- COMPACT GAME STATS: Timer Slider + Timer Number + Score (all in one row) -->
    <div class="game-stats">
        <div class="timer-section">
            <span class="timer-label">⏱️</span>
            <div class="timer-slider-wrapper">
                <div class="timer-slider-bar" id="timerSliderBar" style="width: 100%;"></div>
            </div>
            <div class="timer-big-number" id="timerBigDisplay">30s</div>
        </div>
        <div class="score-section">
            <span class="score-label">⭐ SCORE</span>
            <div class="score-value">
                <span id="score">0</span>/6
            </div>
        </div>
    </div>

    <!-- ZONES -->
    <div class="zones">
        <div class="zone before" id="before">
            <h5>🟦 BAGO</h5>
            <div class="zone-items-container"></div>
        </div>
        <div class="zone during" id="during">
            <h5>🟨 HABANG</h5>
            <div class="zone-items-container"></div>
        </div>
        <div class="zone after" id="after">
            <h5>🟩 PAGKATAPOS</h5>
            <div class="zone-items-container"></div>
        </div>
    </div>

    <!-- DRAGGABLE ITEMS (choices) - NO SHADOWS/HIGHLIGHTS -->
    <div class="items" id="choices">
        <div class="item" draggable="true" data-type="before">🧰 Emergency Kit</div>
        <div class="item" draggable="true" data-type="before">📢 Makinig sa Babala</div>
        <div class="item" draggable="true" data-type="during">🏃 Lumikas</div>
        <div class="item" draggable="true" data-type="during">🙇 Drop Cover Hold</div>
        <div class="item" draggable="true" data-type="after">🧹 Clean-up Drive</div>
        <div class="item" draggable="true" data-type="after">🔌 Suriin ang Kuryente</div>
    </div>

    <!-- CONTROLS -->
    <div class="controls">
        <button class="btn btn-reset" onclick="resetGame()">🔄 SUBUKAN MULI</button>
    </div>

    <!-- FEEDBACK -->
    <div id="feedback" class="feedback"></div>

</div>

<script>
    let dragged = null;
    let score = 0;
    const total = 6;
    let time = 30;
    let timer;
    let intervalRunning = true;

    // Sound effects
    const correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-4.mp3");
    const wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

    // DOM elements
    const timerSliderBar = document.getElementById('timerSliderBar');
    const timerBigDisplay = document.getElementById('timerBigDisplay');
    const scoreSpan = document.getElementById('score');
    const feedbackDiv = document.getElementById('feedback');
    const zones = {
        before: document.getElementById('before'),
        during: document.getElementById('during'),
        after: document.getElementById('after')
    };

    // Helper: update timer slider & big number
    function updateTimerUI() {
        const percent = (time / 30) * 100;
        timerSliderBar.style.width = `${percent}%`;
        timerBigDisplay.innerText = `${time}s`;
        // change bar color based on remaining time
        if (percent <= 20) {
            timerSliderBar.style.background = "#dc3545";
        } else if (percent <= 50) {
            timerSliderBar.style.background = "#ffc107";
        } else {
            timerSliderBar.style.background = "linear-gradient(90deg, #28a745, #ffc107, #dc3545)";
        }
    }

    // Drag & Drop logic
    function attachDragEvents() {
        document.querySelectorAll('.item').forEach(item => {
            item.setAttribute('draggable', 'true');
            item.removeEventListener('dragstart', dragStartHandler);
            item.addEventListener('dragstart', dragStartHandler);
        });
    }

    function dragStartHandler(e) {
        dragged = e.target;
        // Only allow dragging if the item is still inside #choices (not yet placed in a zone)
        if (dragged.parentElement.id !== 'choices') {
            e.preventDefault();
            dragged = null;
            return false;
        }
        e.dataTransfer.setData('text/plain', '');
        e.dataTransfer.effectAllowed = 'move';
    }

    function setupDropZones() {
        for (let zoneId in zones) {
            const zone = zones[zoneId];
            zone.addEventListener('dragover', (e) => e.preventDefault());
            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                if (!dragged) return;

                const expectedType = dragged.getAttribute('data-type');
                if (expectedType === zone.id) {
                    // CORRECT DROP
                    zone.appendChild(dragged);
                    dragged.classList.add("correct");
                    dragged.setAttribute('draggable', 'false');
                    correctSound.play();
                    score++;
                    scoreSpan.innerText = score;

                    // check win
                    if (score === total) {
                        endGame(true);
                    }
                } else {
                    // WRONG DROP
                    wrongSound.play();
                    dragged.classList.add("wrong");
                    setTimeout(() => dragged.classList.remove("wrong"), 400);
                }
                dragged = null;
            });
        }
    }

    // Timer with visual slider
    function startTimer() {
        updateTimerUI();
        timer = setInterval(() => {
            if (!intervalRunning) return;
            if (time <= 1) {
                clearInterval(timer);
                time = 0;
                updateTimerUI();
                endGame(false);
            } else {
                time--;
                updateTimerUI();
                if (time === 5) {
                    alert("⚠️ 5 segundo na lang! Bilisan mo.");
                }
            }
        }, 1000);
    }

    // End game function (win/loss)
    function endGame(isWin) {
        if (!intervalRunning) return;
        intervalRunning = false;
        clearInterval(timer);

        // Disable further drag on all items
        document.querySelectorAll('.item').forEach(item => {
            item.setAttribute('draggable', 'false');
        });

        feedbackDiv.style.display = "block";
        if (isWin && score === total) {
            feedbackDiv.className = "feedback alert alert-success";
            feedbackDiv.innerHTML = `
                🎉 <strong>NAPAKAHUSAY!</strong><br><br>
                ✅ Naayos mo nang tama ang lahat ng hakbang!<br>
                Ipinapakita mong handa ka sa bawat yugto ng kalamidad.<br><br>
                👉 <strong>Dadalhin ka na sa susunod na modyul...</strong>
            `;
            setTimeout(() => {
                window.location.href = "{{ route('module4.welcome') }}";
            }, 3000);
        } else {
            feedbackDiv.className = "feedback alert alert-danger";
            feedbackDiv.innerHTML = `
                ⚠️ <strong>Oras na! o Hindi pa tapos ang lahat.</strong><br><br>
                Siguraduhing mailagay lahat ng anim na gawain sa tamang zone.<br>
                Pindutin ang "SUBUKAN MULI" para magsimulang muli.<br><br>
                🧠 <i>Balikan ang mga hakbang: Bago, Habang, at Pagkatapos ng kalamidad.</i>
            `;
        }
    }

    // Reset everything
    function resetGame() {
        // kill old timer to avoid double intervals
        clearInterval(timer);
        intervalRunning = false;

        // reset variables
        score = 0;
        time = 30;
        intervalRunning = true;
        scoreSpan.innerText = "0";
        updateTimerUI();

        // remove all items from zones and put back to #choices
        const choicesContainer = document.getElementById('choices');
        const allItems = document.querySelectorAll('.item');
        allItems.forEach(item => {
            // remove correct/wrong classes
            item.classList.remove('correct', 'wrong');
            item.setAttribute('draggable', 'true');
            choicesContainer.appendChild(item);
        });

        // clear feedback
        feedbackDiv.style.display = "none";
        feedbackDiv.innerHTML = "";

        // restart timer
        startTimer();
        dragged = null;
    }

    // Initialize game
    function initGame() {
        setupDropZones();
        attachDragEvents();
        startTimer();
    }

    // Make reset globally accessible
    window.resetGame = resetGame;

    initGame();
</script>
@endsection