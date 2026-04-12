<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Balik-Aral: Handa Ka Ba?</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#dff6ff,#f0fff4);
}

.container-box {
    max-width: 1100px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,.1);
}

h2 { text-align:center; font-weight:800; }

.timer {
    font-size: 1.5rem;
    font-weight: bold;
    color: red;
}

.zones {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 15px;
    margin-top: 20px;
}

.zone {
    border: 3px dashed #ccc;
    border-radius: 12px;
    padding: 10px;
    min-height: 200px;
}

.before { border-color: #4f90ff; }
.during { border-color: #ffc107; }
.after { border-color: #28a745; }

.zone h5 {
    text-align: center;
    font-weight: 800;
}

.items {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-top: 20px;
}

.item {
    background: #fff;
    padding: 12px;
    border-radius: 10px;
    cursor: grab;
    width: 170px;
    text-align: center;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(0,0,0,.1);
}

.correct { border: 3px solid green; }
.wrong { border: 3px solid red; }

.controls { text-align:center; margin-top:20px; }

.feedback {
    margin-top:20px;
    padding:15px;
    border-radius:10px;
    display:none;
}
</style>
</head>

<body>

<div class="container-box">

    <h2>🎮 Ayusin Mo Ako!</h2>
    <p class="text-center"><strong>Gabay:</strong> Ilagay sa tamang yugto ang bawat gawain.</p>

    <div class="d-flex justify-content-between">
        <div>⏱️ Timer: <span class="timer" id="timer">30</span>s</div>
        <div>⭐ Score: <span id="score">0</span>/6</div>
    </div>

    <!-- ZONES -->
    <div class="zones">
        <div class="zone before" id="before"><h5>🟦 Bago</h5></div>
        <div class="zone during" id="during"><h5>🟨 Habang</h5></div>
        <div class="zone after" id="after"><h5>🟩 Pagkatapos</h5></div>
    </div>

    <!-- ITEMS -->
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
        <button class="btn btn-warning" onclick="resetGame()">Subukan Muli 🔄</button>
    </div>

    <!-- FEEDBACK -->
    <div id="feedback" class="feedback"></div>

</div>

<script>
let dragged = null;
let score = 0;
let total = 6;
let time = 30;
let timer;

// SOUND
const correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-4.mp3");
const wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

// DRAG
document.querySelectorAll('.item').forEach(item=>{
    item.addEventListener('dragstart', e=> dragged = e.target);
});

// DROP
document.querySelectorAll('.zone').forEach(zone=>{
    zone.addEventListener('dragover', e=> e.preventDefault());

    zone.addEventListener('drop', e=>{
        e.preventDefault();

        if(!dragged) return;

        if(dragged.dataset.type === zone.id){
            zone.appendChild(dragged);
            dragged.classList.add("correct");
            correctSound.play();
            score++;
        } else {
            dragged.classList.add("wrong");
            wrongSound.play();
            setTimeout(()=>dragged.classList.remove("wrong"),500);
        }

        document.getElementById('score').innerText = score;

        if(score === total) endGame();
    });
});

// TIMER
function startTimer(){
    timer = setInterval(()=>{
        time--;
        document.getElementById('timer').innerText = time;

        if(time === 5){
            alert("⚠️ 5 segundo na lang!");
        }

        if(time <= 0){
            clearInterval(timer);
            endGame();
        }
    },1000);
}

// END GAME
function endGame(){
    clearInterval(timer);

    let fb = document.getElementById('feedback');
    fb.style.display = "block";

    if(score === total){
        fb.className = "feedback alert alert-success";
        fb.innerHTML = `
        🎉 <strong>Magaling!</strong><br><br>
        Naipakita mo ang tamang pagkakasunod-sunod!<br><br>
        👉 Dadalhin ka na sa susunod na modyul...
        `;

        // 👉 AUTO REDIRECT AFTER 3 SECONDS
        setTimeout(() => {
            window.location.href = "{{ route('module4.welcome') }}";
        }, 3000);
    } else {
        fb.className = "feedback alert alert-danger";
        fb.innerHTML = `
        ⚠️ <strong>Subukan muli!</strong><br>
        May maling sagot. Ayusin muli!
        `;
    }
}

// RESET
function resetGame(){
    location.reload();
}

// START
startTimer();
</script>

</body>
</html>