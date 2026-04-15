<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mission: Go Bag</title>

<link href="https://fonts.googleapis.com/css2?family=Bungee&family=Lexend:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary: #1e88e5;
        --success: #2e7d32;
        --dark: #0d1b2a;
        --glass: rgba(255, 255, 255, 0.95);
    }

    body {
        font-family: 'Lexend', sans-serif;
        margin: 0;
        background: url("{{ asset('pictures/Module 3/Bag_Activity/background.png') }}") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

    .header-section { padding: 15px 10px; text-align: center; }
    h2 { font-family: 'Bungee', cursive; color: var(--dark); font-size: clamp(1.5rem, 5vw, 2.2rem); margin: 0; }

    .stats-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin: 15px 0;
    }

    .stat-pill {
        background: white;
        padding: 8px 20px;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-weight: bold;
        border: 2px solid var(--primary);
    }

    .game-wrapper { padding: 10px; display: flex; justify-content: center; padding-bottom: 50px; }

    .game-card {
        width: 100%;
        max-width: 1100px;
        background: var(--glass);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }

    .game-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: center;
    }

    @media (max-width: 992px) {
        .game-container { grid-template-columns: 1fr; }
        .items-grid { order: 1; }
        .bag-area { order: 2; }
    }

    /* ITEMS CABINET */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 15px;
        background: rgba(0,0,0,0.03);
        padding: 20px;
        border-radius: 20px;
        border: 2px dashed var(--primary);
    }

    .item {
        width: 100%;
        cursor: grab;
        transition: transform 0.2s;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        user-select: none;
        -webkit-user-drag: element;
        touch-action: none;
    }

    .item:active {
        cursor: grabbing;
    }

    .item:hover { transform: scale(1.1); }
    .item.dragging { opacity: 0.75; transform: scale(0.95); }

    /* BAG AREA & FITTING LOGIC */
    .bag-area {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bag-visual {
        width: 100%;
        max-width: 480px;
        height: auto;
        z-index: 1;
    }

    #drop-zone {
        position: absolute;
        top: 25%; /* Adjusted to look like they are inside the main pocket */
        left: 50%;
        transform: translateX(-50%);
        width: 55%; /* Narrowed to fit the bag's shape */
        height: 50%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: center; /* Centers items inside the bag */
        z-index: 5;
        gap: 5px;
        pointer-events: auto;
    }

    #drop-zone.active {
        background: rgba(30, 136, 229, 0.12);
        border: 2px dashed rgba(30, 136, 229, 0.6);
        border-radius: 20px;
    }

    .dropped-item {
        width: clamp(45px, 8vw, 65px); /* Size to ensure 10 items fit */
        height: auto;
        object-fit: contain;
        animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* MODAL STYLING */
    #completeScreen {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(13, 27, 42, 0.9);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 30px;
        text-align: center;
        max-width: 450px;
        width: 100%;
        box-shadow: 0 0 30px var(--primary);
        border: 4px solid var(--primary);
    }

    .modal-content h3 { font-family: 'Bungee'; color: var(--primary); margin-top: 0; }
    
    .rating-badge {
        background: #f1f5f9;
        padding: 15px;
        border-radius: 15px;
        margin: 20px 0;
        font-weight: bold;
        color: var(--dark);
    }

    .btn-group { display: flex; gap: 10px; flex-direction: column; }

    .btn {
        padding: 15px;
        border-radius: 50px;
        border: none;
        font-family: 'Bungee';
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-next { background: var(--success); color: white; }
    .btn-retry { background: #64748b; color: white; }
    .btn:hover { transform: translateY(-3px); opacity: 0.9; }

    .touch-ghost {
        position: fixed;
        width: 76px;
        height: auto;
        pointer-events: none;
        z-index: 9999;
        transform: translate(-50%, -50%);
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.25));
    }

    @media (max-width: 992px) {
        body {
            background-attachment: scroll;
        }

        .header-section {
            padding: 12px 10px 8px;
        }

        .game-wrapper {
            padding: 10px 10px 24px;
        }

        .game-card {
            border-radius: 20px;
            padding: 16px;
        }

        .game-container {
            gap: 14px;
        }

        .items-grid {
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
            padding: 14px;
            border-radius: 14px;
        }

        .stat-pill {
            padding: 8px 14px;
            font-size: 0.9rem;
        }

        .bag-visual {
            max-width: 360px;
        }

        #drop-zone {
            width: 58%;
            height: 52%;
            gap: 4px;
        }

        .dropped-item {
            width: clamp(34px, 9.6vw, 52px);
        }

        .modal-content {
            border-radius: 18px;
            padding: 22px 18px;
            max-width: 360px;
        }

        .btn {
            min-height: 48px;
            font-size: 0.9rem;
            padding: 12px;
        }
    }

    @media (max-width: 640px) {
        .items-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .bag-visual {
            max-width: 320px;
        }

        .game-card {
            padding: 12px;
        }

        .stats-container {
            gap: 8px;
        }

        .stat-pill {
            font-size: 0.82rem;
            padding: 7px 10px;
        }

        #drop-zone {
            width: 60%;
            height: 52%;
        }
    }

    @media (max-width: 480px) {
        h2 {
            font-size: 1.28rem;
        }

        .header-section {
            padding: 10px 8px 6px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            gap: 6px;
        }

        .stat-pill {
            text-align: center;
            border-width: 1px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .game-wrapper {
            padding: 8px 8px 16px;
        }

        .items-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            padding: 10px;
        }

        .bag-visual {
            max-width: 280px;
        }

        #drop-zone {
            top: 24%;
            width: 62%;
            height: 54%;
            gap: 3px;
        }

        .dropped-item {
            width: clamp(30px, 11vw, 42px);
        }

        .modal-content {
            max-width: 320px;
            padding: 18px 14px;
        }

        .modal-content h3 {
            font-size: 1rem;
        }

        .rating-badge {
            padding: 10px;
            margin: 12px 0;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 380px) {
        .items-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .bag-visual {
            max-width: 250px;
        }

        .btn {
            font-size: 0.82rem;
            padding: 10px;
            min-height: 44px;
        }
    }

    @media (max-height: 520px) and (orientation: landscape) {
        .header-section {
            padding: 6px;
        }

        .stats-container {
            margin: 8px 0;
        }

        .game-wrapper {
            padding-bottom: 10px;
        }

        .game-card {
            padding: 10px;
        }

        .game-container {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            align-items: start;
        }

        .items-grid {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        .bag-visual {
            max-width: 260px;
        }

        .modal-content {
            max-width: 420px;
            padding: 14px;
        }
    }

    @keyframes popIn { 0% { transform: scale(0); } 100% { transform: scale(1); } }
</style>
</head>
<body>

<div class="header-section">
    <h2>🎒 GO BAG MISSION</h2>
    <div class="stats-container">
        <div class="stat-pill">⏱ Oras: <span id="timer">0s</span></div>
        <div class="stat-pill">🎯 Progress: <span id="progress">0 / 10</span></div>
    </div>
</div>

<div class="game-wrapper">
    <div class="game-card">
        <div class="game-container">
            
            <div class="items-grid" id="cabinet">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/food.png') }}" class="item" draggable="true" data-id="food">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/clothes.png') }}" class="item" draggable="true" data-id="clothes">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/kumot.png') }}" class="item" draggable="true" data-id="blanket">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/whistle.png') }}" class="item" draggable="true" data-id="whistle">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/firstaid.png') }}" class="item" draggable="true" data-id="aid">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/powerbank.png') }}" class="item" draggable="true" data-id="power">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/radio.png') }}" class="item" draggable="true" data-id="radio">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/flashlight.png') }}" class="item" draggable="true" data-id="light">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/hygiene.png') }}" class="item" draggable="true" data-id="hygiene">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/knife.png') }}" class="item" draggable="true" data-id="knife">
            </div>

            <div class="bag-area">
                <img src="{{ asset('pictures/Module 3/Bag_Activity/bag.png') }}" class="bag-visual">
                <div id="drop-zone"></div>
            </div>

        </div>
    </div>
</div>

<div id="completeScreen" class="animate__animated animate__fadeIn">
    <div class="modal-content animate__animated animate__zoomIn">
        <h3>MISSION REPORT</h3>
        <div style="font-size: 3rem;">🏆</div>
        <p>Matagumpay mong nabuo ang iyong Emergency Go Bag!</p>
        
        <div class="rating-badge">
            ⏱ Oras: <span id="final-time"></span><br>
            <span id="rating-text" style="color: var(--primary);"></span>
        </div>

        <div class="btn-group">
            <a href="{{ route('safehome.activity') }}" class="btn btn-next">MAGPATULOY ➡</a>
            <button class="btn btn-retry" onclick="location.reload()">ULITIN ANG MISYON</button>
        </div>
    </div>
</div>

<script>
let score = 0;
let time = 0;
let placedItems = new Set();
let activeTouchItem = null;
let touchGhost = null;
let suppressClickUntil = 0;
let timerInterval = setInterval(() => { 
    time++; 
    document.getElementById('timer').innerText = time + "s"; 
}, 1000);

const items = document.querySelectorAll('.item');
const dropZone = document.getElementById('drop-zone');
const totalItems = items.length;

function vibrate(pattern) {
    if (typeof navigator !== 'undefined' && typeof navigator.vibrate === 'function') {
        navigator.vibrate(pattern);
    }
}

function pointInsideDropZone(x, y) {
    const rect = dropZone.getBoundingClientRect();
    return x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom;
}

function setDropZoneActive(active) {
    dropZone.classList.toggle('active', active);
}

function showTouchGhost(src, x, y) {
    removeTouchGhost();
    touchGhost = document.createElement('img');
    touchGhost.src = src;
    touchGhost.className = 'touch-ghost';
    document.body.appendChild(touchGhost);
    moveTouchGhost(x, y);
}

function moveTouchGhost(x, y) {
    if (!touchGhost) return;
    touchGhost.style.left = x + 'px';
    touchGhost.style.top = y + 'px';
}

function removeTouchGhost() {
    if (touchGhost && touchGhost.parentNode) {
        touchGhost.parentNode.removeChild(touchGhost);
    }
    touchGhost = null;
}

function placeItem(id, src) {
    if (!id || placedItems.has(id)) return;

    placedItems.add(id);
    score++;

    const img = document.createElement('img');
    img.src = src;
    img.classList.add('dropped-item');
    dropZone.appendChild(img);
    vibrate(30);

    document.getElementById('progress').innerText = score + " / " + totalItems;
    const sourceItem = document.querySelector(`[data-id="${id}"]`);
    if (sourceItem) {
        sourceItem.style.visibility = 'hidden';
        sourceItem.style.pointerEvents = 'none';
    }

    if (score === totalItems) {
        clearInterval(timerInterval);
        vibrate([60, 40, 80]);
        showModal();
    }
}

items.forEach(item => {
    item.addEventListener('dragstart', (e) => {
        if (placedItems.has(item.dataset.id)) {
            e.preventDefault();
            return;
        }
        item.classList.add('dragging');
        e.dataTransfer.setData('text/plain', item.dataset.id);
        e.dataTransfer.setData('id', item.dataset.id);
        e.dataTransfer.setData('src', item.src);
        e.dataTransfer.effectAllowed = 'move';
    });

    item.addEventListener('dragend', () => {
        item.classList.remove('dragging');
        setDropZoneActive(false);
    });

    item.addEventListener('touchstart', (e) => {
        if (placedItems.has(item.dataset.id)) return;
        const touch = e.changedTouches[0];
        if (!touch) return;

        activeTouchItem = item;
        item.classList.add('dragging');
        showTouchGhost(item.src, touch.clientX, touch.clientY);
    }, { passive: true });

    item.addEventListener('touchmove', (e) => {
        if (!activeTouchItem || activeTouchItem !== item) return;
        const touch = e.changedTouches[0];
        if (!touch) return;

        e.preventDefault();
        moveTouchGhost(touch.clientX, touch.clientY);
        setDropZoneActive(pointInsideDropZone(touch.clientX, touch.clientY));
    }, { passive: false });

    item.addEventListener('touchend', (e) => {
        if (!activeTouchItem || activeTouchItem !== item) return;
        const touch = e.changedTouches[0];
        const inside = touch ? pointInsideDropZone(touch.clientX, touch.clientY) : false;

        suppressClickUntil = Date.now() + 350;
        item.classList.remove('dragging');
        activeTouchItem = null;
        removeTouchGhost();
        setDropZoneActive(false);

        if (inside) {
            e.preventDefault();
            placeItem(item.dataset.id, item.src);
        }
    }, { passive: false });

    item.addEventListener('touchcancel', () => {
        if (activeTouchItem !== item) return;
        item.classList.remove('dragging');
        activeTouchItem = null;
        removeTouchGhost();
        setDropZoneActive(false);
    }, { passive: true });
});

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    setDropZoneActive(true);
});

dropZone.addEventListener('dragleave', () => {
    setDropZoneActive(false);
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    setDropZoneActive(false);
    
    const id = e.dataTransfer.getData('id');
    const src = e.dataTransfer.getData('src');
    placeItem(id, src);
});

function showModal() {
    document.getElementById('completeScreen').style.display = "flex";
    document.getElementById('final-time').innerText = time + " segundo";
    
    let rating = "";
    if (time <= 25) rating = "⭐⭐⭐ Napakahusay! Handa ka na.";
    else if (time <= 45) rating = "⭐⭐ Magaling! Maging mas mabilis pa.";
    else rating = "⭐ Mabuti! Praktis pa para sa kaligtasan.";
    
    document.getElementById('rating-text').innerText = rating;

    //SAVE TO DATABASE
    fetch("{{ route('student.module3.gobag.save') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            score: score,
            time_taken: time
        })
    });
}
</script>
</body>
</html>