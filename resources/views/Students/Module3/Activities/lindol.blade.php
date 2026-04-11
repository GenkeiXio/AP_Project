<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lindol Game</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
        }

        .container {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .dropzone {
            min-height: 220px;
            border: 2px dashed #fff;
            padding: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }

        .draggable {
            cursor: grab;
            border: 2px solid #fff;
            padding: 5px;
            background: white;
            border-radius: 10px;
            transition: 0.3s;
            width: 200px;      /* ✅ bigger */
            height: auto;
        }

        .dropzone img {
            width: 200px;      /* ✅ readable */
            height: auto;
            margin: 8px;
        }

        .draggable:hover {
            transform: scale(1.1);
        }

        .correct {
            border: 3px solid #00ff88 !important;
            box-shadow: 0 0 10px #00ff88;
        }

        .wrong {
            border: 3px solid red !important;
            box-shadow: 0 0 10px red;
        }

        .locked {
            pointer-events: none;
            opacity: 0.7;
        }

        .category-title {
            font-weight: bold;
            padding: 10px;
            border-radius: 8px;
        }

        #score, #lives {
            font-weight: bold;
            font-size: 1.3rem;
        }

        .game-title {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2 class="game-title">🎮 Mga Dapat Gawin sa Banta ng Lindol 🌍</h2>

    <p><strong>Guiding Question:</strong> Bakit mahalaga ang tamang kilos habang lumilindol?</p>

    <!-- VIDEOS -->
    <h5>Panoorin muna:</h5>
    <iframe width="100%" height="250" src="https://www.youtube.com/embed/dJpIU1rSOFY"></iframe>
    <iframe class="mt-3" width="100%" height="250" src="https://www.youtube.com/embed/AxpSZSsxvf8"></iframe>

    <h4 class="mt-4">🎯 I-drag ang tamang gawain sa tamang kategorya</h4>

    <!-- GAME HUD -->
    <div class="d-flex justify-content-between mb-3">
        <div>⭐ Score: <span id="score">0</span></div>
        <div>❤️ Lives: <span id="lives">3</span></div>
    </div>

    <!-- DROP ZONES -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="bg-warning text-dark category-title">Bago ang Lindol</div>
            <div class="dropzone" id="before"></div>
        </div>

        <div class="col-md-4">
            <div class="bg-primary category-title">Habang may Lindol</div>
            <div class="dropzone" id="during"></div>
        </div>

        <div class="col-md-4">
            <div class="bg-success category-title">Pagkatapos ng Lindol</div>
            <div class="dropzone" id="after"></div>
        </div>
    </div>

    <!-- DRAG ITEMS -->
    @php
        $items = [
            ['img'=>'pictures/Module%203/lindol_activity/earthquake_drill.png','type'=>'before'],
            ['img'=>'pictures/Module%203/lindol_activity/emergency_kit.png','type'=>'before'],
            ['img'=>'pictures/Module%203/lindol_activity/exit_route.png','type'=>'before'],

            ['img'=>'pictures/Module%203/lindol_activity/avoid_structures.png','type'=>'during'],
            ['img'=>'pictures/Module%203/lindol_activity/duck_cover.png','type'=>'during'],
            ['img'=>'pictures/Module%203/lindol_activity/go_safe_place.png','type'=>'during'],

            ['img'=>'pictures/Module%203/lindol_activity/exit_building.png','type'=>'after'],
            ['img'=>'pictures/Module%203/lindol_activity/bring_kit.png','type'=>'after'],
            ['img'=>'pictures/Module%203/lindol_activity/evacuate.png','type'=>'after'],
        ];
        shuffle($items);
    @endphp

    <div class="row" id="choices">
        @foreach($items as $item)
            <div class="col-md-2 mb-3 text-center">
                <img src="{{ asset($item['img']) }}"
                     class="draggable"
                     draggable="true"
                     data-type="{{ $item['type'] }}">
            </div>
        @endforeach
    </div>

    <!-- FEEDBACK -->
    <div id="feedback" class="mt-4 alert" style="display:none;"></div>

    <!-- NEXT BUTTON -->
    <div class="text-center mt-4" id="nextBtn" style="display:none;">
        <a href="{{ route('bulkan.activity') }}" class="btn btn-warning btn-lg fw-bold px-5">
            Susunod na Aralin 🚀
        </a>
    </div>

</div>

<script>
let dragged = null;
let score = 0;
let lives = 3;
let totalCorrect = 0;
let totalItems = document.querySelectorAll('.draggable').length;

const correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-4.mp3");
const wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

// DRAG
document.querySelectorAll('.draggable').forEach(item => {
    item.addEventListener('dragstart', e => dragged = e.target);
});

// DROP
document.querySelectorAll('.dropzone').forEach(zone => {
    zone.addEventListener('dragover', e => e.preventDefault());

    zone.addEventListener('drop', e => {
        e.preventDefault();

        if (!dragged) return;

        let correctType = dragged.dataset.type;
        let zoneId = zone.id;

        if (correctType === zoneId) {
            zone.appendChild(dragged);
            dragged.classList.add("correct", "locked");
            correctSound.play();

            score += 10;
            totalCorrect++;

            document.getElementById('score').innerText = score;

        } else {
            dragged.classList.add("wrong");
            wrongSound.play();

            lives--;
            document.getElementById('lives').innerText = lives;

            setTimeout(() => {
                dragged.classList.remove("wrong");
            }, 500);
        }

        // PERFECT WIN
        if (totalCorrect === totalItems && lives === 3) {
            endGame(true);
        }

        // FAIL
        if (lives <= 0) {
            endGame(false);
        }
    });
});

// END GAME
function endGame(win) {
    let feedback = document.getElementById('feedback');
    let nextBtn = document.getElementById('nextBtn');

    feedback.style.display = "block";

    if (win) {
        feedback.className = "mt-4 alert alert-success";
        feedback.innerHTML = `
        🎉 <strong>PERFECT SCORE!</strong><br><br>
        Napagtagumpayan mong matukoy ang lahat ng tamang gawain nang walang pagkakamali!<br><br>
        ⭐ Score: ${score}<br><br>
        👏 Ang handa ay ligtas!
        `;
        nextBtn.style.display = "block";
        confetti();

    } else {
        feedback.className = "mt-4 alert alert-danger";
        feedback.innerHTML = `
        💥 GAME OVER<br>
        Kailangan mong makuha ang PERFECT score upang makapagpatuloy.<br>
        ⭐ Score: ${score}
        `;
    }
}

// CONFETTI
function confetti() {
    for (let i = 0; i < 80; i++) {
        let c = document.createElement("div");
        c.style.position = "fixed";
        c.style.width = "8px";
        c.style.height = "8px";
        c.style.background = "hsl(" + Math.random()*360 + ",100%,50%)";
        c.style.top = "0";
        c.style.left = Math.random() * window.innerWidth + "px";

        document.body.appendChild(c);

        let fall = setInterval(() => {
            c.style.top = (parseFloat(c.style.top) + 5) + "px";

            if (parseFloat(c.style.top) > window.innerHeight) {
                clearInterval(fall);
                c.remove();
            }
        }, 30);
    }
}
</script>

</body>
</html>