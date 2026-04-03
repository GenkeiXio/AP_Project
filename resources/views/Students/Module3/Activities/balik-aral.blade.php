<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Balik-Aral - Module 3</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<style>

/* BACKGROUND */
.background-map {
    position: fixed;
    width: 100vw;
    height: 100vh;
    object-fit: cover;
    z-index: -2;
}

body {
    min-height: 100vh;
    padding: 30px 20px;
    background: rgba(0,0,0,0.25);
}

/* CARD */
.card {
    width: 95%;
    max-width: 1200px;
    margin: auto;
    background: rgba(255,255,255,0.95);
    border-radius: 28px;
    padding: 30px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.35);
}

/* TITLE */
.title {
    text-align: center;
    font-family: 'Baloo 2';
    font-size: 2rem;
}

/* LAYOUT */
.activity {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

/* DROP ZONES GRID */
.drop-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

/* DROP CARD */
.drop-zone {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    padding: 12px;
    border-radius: 18px;

    background: linear-gradient(135deg, #fff7ea, #fff3df);
    border: 2px dashed #f4c97a;

    min-height: 200px;
    transition: 0.2s;
}

/* DROP SLOT */
.drop-slot {
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* 🔥 prevents overflow */
}

/* LABEL */
.drop-label {
    text-align: center;
    font-weight: 800;
    font-size: 0.9rem;
    color: #5a4328;
}

/* WHEN FILLED */
.drop-zone.filled {
    border: 2px solid #6dbf7e;
    background: #f1fbf4;
}

/* DRAG ITEMS */
.drag-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.drag-item {
    padding: 15px;
    border-radius: 18px;
    background: linear-gradient(135deg, #eefaf1, #e6f6ea);
    border: 2px dashed #6dbf7e;
    cursor: grab;
    font-weight: bold;
    transition: 0.2s;
}

.drag-item:hover {
    transform: scale(1.03);
}

/* IMAGE */
.img-box {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 10px;
}

/* LOCKED ITEM */
.drop-zone .drag-item {
    width: 100%;
    height: 100%;
    padding: 8px;
    font-size: 0.85rem;
    border-radius: 12px;
}

.drop-zone .drag-item .img-box {
    height: 70px; /* smaller inside drop */
    margin-bottom: 5px;
}

/* FEEDBACK */
.feedback {
    text-align: center;
    font-weight: bold;
    margin-top: 15px;
}

/* BUTTON */
.btn-primary {
    margin-top: 15px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .drop-container,
    .drag-container {
        grid-template-columns: 1fr;
    }
}

/* MODAL BACKDROP */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
}

/* MODAL BOX */
.modal-content {
    background: white;
    padding: 35px 30px;
    border-radius: 24px;
    max-width: 450px;
    margin: 8% auto;
    text-align: center;
    animation: pop 0.3s ease;

    display: flex;
    flex-direction: column;
    gap: 15px; /* 🔥 consistent spacing */
}

/* TITLE */
.modal-content h2 {
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0;
}

/* SUBTEXT (TANDAAN) */
.modal-content .sub {
    font-weight: 700;
    font-size: 1rem;
    margin-top: 5px;
}

/* PARAGRAPH */
.modal-content p {
    font-size: 1rem;
    line-height: 1.6;
    margin: 5px 0 10px 0;
}

/* BUTTON */
.modal-content .btn-primary {
    margin-top: 10px;
    padding: 12px;
    font-size: 1rem;
    border-radius: 12px;
}

/* ANIMATION */
@keyframes pop {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

</style>
</head>

<body>

<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

<div class="card">

<h1 class="title">Iugnay Mo Ako!</h1>
<p style="text-align:center;">“Paano nagiging sanhi ng sakuna ang mga suliraning pangkapaligiran?”</p>

<div style="text-align:center; margin-top:10px;">
⏱️ Timer: <span id="timer">30</span>s |
⭐ Score: <span id="score">0</span>
</div>

<div class="activity">

<!-- 🔝 DROP ZONES -->
<div class="drop-container">

    <div class="drop-zone" data-accept="waste">
        <div class="drop-slot"></div>
        <div class="drop-label">🌊 Pagbaha at paglaganap ng sakit</div>
    </div>

    <div class="drop-zone" data-accept="deforestation">
        <div class="drop-slot"></div>
        <div class="drop-label">⛰️ Pagguho ng lupa at pagbaha</div>
    </div>

    <div class="drop-zone" data-accept="climate">
        <div class="drop-slot"></div>
        <div class="drop-label">🌪️ Mas malalakas na bagyo at matinding init</div>
    </div>

</div>

<!-- 🔽 DRAG ITEMS -->
<div>
    <h3 style="text-align:center;">🧩 Suliranin</h3>

    <div class="drag-container">

        <div class="drag-item" draggable="true" data-match="waste">
            <img src="{{ asset('pictures/Balik_Aral/solid_waste.png') }}" class="img-box">
            🗑️ Solid Waste
        </div>

        <div class="drag-item" draggable="true" data-match="deforestation">
            <img src="{{ asset('pictures/Balik_Aral/deforestation.png') }}" class="img-box">
            🌳 Deforestation
        </div>

        <div class="drag-item" draggable="true" data-match="climate">
            <img src="{{ asset('pictures/Balik_Aral/climate_change.png') }}" class="img-box">
            🌍 Climate Change
        </div>

    </div>
</div>

</div>

<div class="feedback" id="feedback"></div>

<button class="btn-primary" onclick="resetGame()">🔁 Reset</button>

</div>

<!-- SOUND -->
<audio id="correctSound" src="{{ asset('sounds/correct.mp3') }}"></audio>
<audio id="wrongSound" src="{{ asset('sounds/wrong.mp3') }}"></audio>

<script>

let score = 0;
let time = 30;
let draggedItem = null;
let countdown;

/* ELEMENTS */
const timerEl = document.getElementById("timer");
const scoreEl = document.getElementById("score");

/* =========================
   SHUFFLE FUNCTION
========================= */
function shuffleItems(container) {
    const items = Array.from(container.children);

    for (let i = items.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [items[i], items[j]] = [items[j], items[i]];
    }

    items.forEach(item => container.appendChild(item));
}

/* =========================
   CHECK COMPLETION
========================= */
function checkCompletion() {
    const total = document.querySelectorAll('.drop-zone').length;
    const filled = document.querySelectorAll('.drop-zone.filled').length;

    if (filled === total) {
        clearInterval(countdown); // 🛑 stop timer

        setTimeout(() => {
            document.getElementById("completionModal").style.display = "block";
        }, 300);
    }
}

/* =========================
   INIT (ON LOAD)
========================= */
window.addEventListener('DOMContentLoaded', () => {

    // 🔀 Shuffle drag items
    const dragContainer = document.querySelector('.drag-container');
    shuffleItems(dragContainer);

    /* DRAG */
    document.querySelectorAll('.drag-item').forEach(item => {
        item.addEventListener('dragstart', () => {
            draggedItem = item;
        });
    });

    /* DROP */
    document.querySelectorAll('.drop-zone').forEach(zone => {

        zone.addEventListener('dragover', e => e.preventDefault());

        zone.addEventListener('drop', () => {

            if (!draggedItem) return;

            const match = draggedItem.dataset.match;
            const accept = zone.dataset.accept;

            if (match === accept) {

                const slot = zone.querySelector('.drop-slot');

                if (slot.children.length > 0) return;

                slot.appendChild(draggedItem);

                draggedItem.setAttribute('draggable', 'false');

                zone.classList.add('filled');

                score++;
                scoreEl.textContent = score;

                document.getElementById("feedback").innerHTML = "🎉 Magaling!";
                document.getElementById("correctSound").play();

                checkCompletion(); // ✅ IMPORTANT

            } else {
                document.getElementById("feedback").innerHTML = "❌ Subukan muli!";
                document.getElementById("wrongSound").play();
            }

            draggedItem = null;
        });
    });

    /* START TIMER AFTER EVERYTHING IS READY */
    startTimer();
});

/* =========================
   TIMER FUNCTION
========================= */
function startTimer() {
    countdown = setInterval(() => {
        time--;
        timerEl.textContent = time;

        if (time <= 0) {
            clearInterval(countdown);
            alert("⏱️ Tapos na ang oras!");
        }
    }, 1000);
}

/* =========================
   RESET
========================= */
function resetGame() {
    location.reload();
}

</script>

<!-- ✅ COMPLETION MODAL -->
<div id="completionModal" class="modal">
    <div class="modal-content">
        <h2>🎉 Magaling!</h2>
        <p>
            👉 Tandaan:<br><br>
            Ang mga problemang ito ay magkakaugnay at kadalasang dulot ng gawain ng tao.<br>
            Ngunit may magagawa tayo upang maiwasan ang mas matinding pinsala.
        </p>

        <a href="{{ route('module3.scene') }}" class="btn-primary">
            👉 Magpatuloy
        </a>
    </div>
</div>

</body>
</html>