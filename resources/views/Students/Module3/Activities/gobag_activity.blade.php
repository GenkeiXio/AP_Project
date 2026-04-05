<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Go Bag Activity</title>

<style>
    body {
        font-family: Arial;
        margin: 0;
        padding: 0;

        background: url("{{ asset('pictures/Module 3/Bag_Activity/background.png') }}") no-repeat center center fixed;
        background-size: cover;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        background: rgba(255,255,255,0.6); /* adjust if needed */
        z-index: -1;
    }

    h2, p {
        text-align: center;
    }

    /* MAIN LAYOUT */
    .game-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding: 0 40px;
    }

    /* WRAPPER */
    .game-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 30px;
    }

    /* GLASS CARD */
    .game-card {
        width: 100%;
        max-width: 1200px;

        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);

        border-radius: 20px;
        padding: 30px;

        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .game-container {
            flex-direction: column;
        }

        .items, .bag-container {
            width: 100%;
        }

        .bag-image {
            width: 400px;
        }
    }

    /* ITEMS (LEFT SIDE) */
    .items {
        width: 45%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* BIGGER ITEMS */
    .item {
        width: 130px;   /* 🔥 bigger */
        margin: 15px;
        cursor: grab;
        transition: transform 0.2s;
    }

    .item:hover {
        transform: scale(1.15);
    }

    /* BAG AREA (RIGHT SIDE) */
    .bag-container {
        width: 50%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* 🔥 MUCH BIGGER BAG */
    .bag-image {
        width: 550px;
    }

    /* 🔥 BIGGER DROP ZONE */
    #bag {
        position: absolute;
        top: 18%;
        left: 50%;
        transform: translateX(-50%);

        width: 360px;
        height: 420px;

        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: flex-start;
        padding: 15px;

        border-radius: 20px;
        transition: 0.3s;
        z-index: 2;
    }

    /* HOVER EFFECT */
    #bag.hovered {
        background: rgba(0, 123, 255, 0.25);
        box-shadow: 0 0 25px rgba(0,123,255,0.6);
    }

    /* DROPPED ITEMS */
    .dropped {
        width: 70px; /* 🔥 bigger inside bag */
        margin: 6px;
        border-radius: 10px;
    }

    /* FEEDBACK */
    .correct {
        border: 3px solid green;
    }

    .wrong {
        border: 3px solid red;
    }

    /* SCORE */
    #score {
        text-align: center;
        font-size: 26px;
        margin-top: 25px;
        font-weight: bold;
    }

    /* MESSAGE */
    #message {
        text-align: center;
        margin-top: 10px;
        font-size: 24px;
        color: green;
        display: none;
    }

    /* TIMER */
    #timer {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        color: #0d47a1;
    }

    /* PROGRESS */
    #progress {
        text-align: center;
        font-size: 20px;
        margin-top: 10px;
    }

    /* DRAG EFFECT */
    .item:active {
        transform: scale(1.2) rotate(5deg);
    }

    /* DROP ANIMATION */
    @keyframes dropBounce {
        0% { transform: scale(0.5); }
        60% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .dropped {
        width: 70px;
        margin: 6px;
        border-radius: 10px;
        animation: dropBounce 0.3s ease;
    }

    /* CORRECT EFFECT */
    @keyframes glow {
        0% { box-shadow: 0 0 0px green; }
        50% { box-shadow: 0 0 20px green; }
        100% { box-shadow: 0 0 0px green; }
    }

    .correct {
        border: 3px solid green;
        animation: glow 0.5s;
    }

    /* WRONG SHAKE */
    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-6px); }
        50% { transform: translateX(6px); }
        75% { transform: translateX(-6px); }
        100% { transform: translateX(0); }
    }

    .wrong {
        border: 3px solid red;
        animation: shake 0.3s;
    }

    /* COMPLETE SCREEN */
    #completeScreen {
        display: none;
        text-align: center;
        margin-top: 20px;
    }

    #completeScreen h2 {
        color: green;
    }
</style>
</head>
<body>

<div class="game-wrapper">

    <div class="game-card">

        <h2>🎒 MISYON: BUUIN ANG GO BAG</h2>
        <p>I-drag ang mga tamang gamit papunta sa bag!</p>

        <div id="timer">⏱ Oras: 0s</div>
        <div id="progress">🎯 Nakalagay: 0 / 10</div>

        <div class="game-container">

            <!-- ITEMS -->
            <div class="items">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/food.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/clothes.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/kumot.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/whistle.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/firstaid.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/powerbank.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/radio.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/flashlight.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/hygiene.png') }}" class="item" draggable="true" data-correct="true">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/knife.png') }}" class="item" draggable="true" data-correct="true">
            </div>

            <!-- BAG -->
            <div class="bag-container">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/bag.png') }}" class="bag-image">
                <div id="bag"></div>
            </div>

        </div>

        <!-- SCORE -->
        <div id="score">Score: 0</div>
        <div id="message">🎉 Kumpleto na ang iyong Go Bag!</div>

        <div id="completeScreen">
            <h2>🎉 MISYON COMPLETE!</h2>
            <p id="rating"></p>
            <button onclick="location.reload()">🔁 Ulitin</button>
        </div>

    </div>

</div>

<script>
let score = 0;
let correctNeeded = 10;
let placedItems = new Set();
let time = 0;

/* TIMER */
setInterval(() => {
    time++;
    document.getElementById('timer').innerText = "⏱ Oras: " + time + "s";
}, 1000);

const items = document.querySelectorAll('.item');
const bag = document.getElementById('bag');

items.forEach(item => {
    item.addEventListener('dragstart', (e) => {
        e.dataTransfer.setData('correct', item.dataset.correct);
        e.dataTransfer.setData('src', item.src);
    });
});

bag.addEventListener('dragover', (e) => {
    e.preventDefault();
    bag.classList.add('hovered');
});

bag.addEventListener('dragleave', () => {
    bag.classList.remove('hovered');
});

bag.addEventListener('drop', (e) => {
    e.preventDefault();
    bag.classList.remove('hovered');

    const correct = e.dataTransfer.getData('correct');
    const src = e.dataTransfer.getData('src');

    /* PREVENT DUPLICATES */
    if (placedItems.has(src)) return;

    placedItems.add(src);

    const img = document.createElement('img');
    img.src = src;
    img.classList.add('dropped');

    if (correct === "true") {
        score++;
        img.classList.add('correct');
    } else {
        img.classList.add('wrong');
    }

    bag.appendChild(img);

    document.getElementById('score').innerText = "Score: " + score;
    document.getElementById('progress').innerText =
        "🎯 Nakalagay: " + score + " / " + correctNeeded;

    /* WIN CONDITION */
    if (score === correctNeeded) {
        document.getElementById('message').style.display = "block";

        let rating = "⭐";
        if (time < 20) rating = "⭐⭐⭐ Ang bilis mo!";
        else if (time < 40) rating = "⭐⭐ Magaling!";
        else rating = "⭐ Subukan ulit para mas mabilis!";

        document.getElementById('rating').innerText =
            "Natapos mo sa " + time + " segundo! " + rating;

        document.getElementById('completeScreen').style.display = "block";
    }
});
</script>

</body>
</html>