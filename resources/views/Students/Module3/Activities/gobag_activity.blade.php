<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission: Go Bag | Wooden Edition</title>

    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Baloo+2:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            /* PAGASA Wooden Palette */
            --wood-dark: #3d2b1f;
            --wood-medium: #5d4037;
            --wood-light: #e0c9a6;
            --gold: #f59e0b;
            --white-paper: #f4ece4;
            --success-green: #2e7d32;
            --error-red: #c62828;
        }

        body {
            font-family: 'Baloo 2', cursive;
            margin: 0;
            background: url("{{ asset('pictures/mod3_innermap.png') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: var(--wood-dark);
            overflow-x: hidden;
        }

        /* --- CONSOLIDATED HEADER CARD --- */
        .header-section {
            padding: 20px 10px;
            display: flex;
            justify-content: center;
        }

        .main-header-card {
            background: var(--wood-dark);
            border-bottom: 6px solid #b26a12;
            border-radius: 20px;
            padding: 15px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.4);
            min-width: 320px;
        }

        .title-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .title-container h2 {
            font-family: 'Bungee', cursive;
            color: white;
            font-size: clamp(1.2rem, 5vw, 2rem);
            margin: 0;
            letter-spacing: 2px;
        }

        .stats-row {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .stat-box {
            background: var(--white-paper);
            border: 2px solid var(--wood-medium);
            padding: 8px 15px;
            border-radius: 12px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
            font-size: 0.9rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .stat-box span { color: #d97706; margin-left: 5px; }

        /* --- FEEDBACK POPUP --- */
        .feedback-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10001;
            padding: 20px 40px;
            border-radius: 15px;
            font-family: 'Bungee', cursive;
            font-size: 2.5rem;
            color: white;
            pointer-events: none;
            display: none;
            border: 6px solid var(--wood-dark);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* --- MAIN GAME CARD --- */
        .game-wrapper {
            padding: 0 15px 40px 15px;
            display: flex;
            justify-content: center;
        }

        .game-card {
            width: 100%;
            max-width: 950px;
            background: var(--wood-light);
            background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
            border: 6px solid var(--wood-medium);
            border-radius: 20px;
            padding: 25px;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.1), 0 15px 35px rgba(0,0,0,0.4);
            position: relative;
        }

        .game-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            align-items: center;
        }

        /* --- COMPACT SUPPLY LOCKER --- */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(85px, 1fr)); 
            gap: 10px;
            background: rgba(255, 255, 255, 0.4);
            padding: 15px;
            border-radius: 12px;
            border: 3px solid var(--wood-medium);
            backdrop-filter: blur(5px);
        }

        .item {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: contain;
            cursor: grab;
            padding: 5px;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            user-select: none;
            touch-action: none;
        }

        .item:hover { transform: scale(1.1); }

        /* --- BAG AREA --- */
        .bag-area {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bag-visual {
            width: 100%;
            max-width: 420px;
            z-index: 1;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
        }

        #drop-zone {
            position: absolute;
            top: 22%; left: 50%;
            transform: translateX(-50%);
            width: 65%; height: 55%;
            display: flex; flex-wrap: wrap;
            justify-content: center; align-content: center;
            gap: 6px; z-index: 5;
        }

        #drop-zone.active {
            background: rgba(255, 255, 255, 0.3);
            border: 3px dashed var(--wood-dark);
            border-radius: 15px;
        }

        .dropped-item {
            width: clamp(40px, 6vw, 55px);
            animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        /* --- MODALS --- */
        .wood-modal {
            background: var(--white-paper) url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border: 8px solid var(--wood-dark);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 0 50px rgba(0,0,0,0.8);
        }

        .btn-action {
            background: var(--wood-dark);
            color: white;
            font-family: 'Bungee', cursive;
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 0 #1a0f06;
        }

        .btn-action:hover { background: var(--wood-medium); transform: translateY(-2px); color: white; }

        @media (max-width: 768px) {
            .game-container { grid-template-columns: 1fr; }
            .items-grid { order: 1; grid-template-columns: repeat(4, 1fr); }
            .bag-area { order: 2; }
        }

        @keyframes popIn { 0% { transform: scale(0); } 100% { transform: scale(1); } }
        
        .touch-ghost {
            position: fixed;
            width: 60px;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>

    <div id="feedback" class="feedback-popup animate__animated">TAMA!</div>

    <div class="header-section">
        <div class="main-header-card">
            <div class="title-container">
                <span style="font-size: 2.5rem;">🎒</span>
                <h2>GO BAG MISSION</h2>
            </div>
            <div class="stats-row">
                <div class="stat-box">⏱ ORAS: <span id="timer">01:00</span></div>
                <div class="stat-box">🎯 PROGRESO: <span id="progress">0 / 10</span></div>
            </div>
        </div>
    </div>

    <div id="startModal" style="display:flex; position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center;">
        <div class="wood-modal animate__animated animate__fadeInDown">
            <h3 style="font-family:'Bungee';">🚨 EMERGENCY ALERT</h3>
            <p>May paparating na sakuna! Ayon sa protocol, ihanda ang iyong <strong>Emergency Go Bag</strong>.</p>
            <p><small>Piliin lamang ang mga TAMANG gamit.<br><br>
                ⚠️ Iwasan ang maling items!</small></p>
            <button class="btn-action" onclick="startGame()">MAGSIMULA NA</button>
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
                    
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/tv.png') }}" class="item" draggable="true" data-id="tv">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/hairdryer.png') }}" class="item" draggable="true" data-id="hairdryer">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/toys.png') }}" class="item" draggable="true" data-id="toys">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/heels.png') }}" class="item" draggable="true" data-id="heels">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/makeup.png') }}" class="item" draggable="true" data-id="makeup">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/laptop.png') }}" class="item" draggable="true" data-id="laptop">
                </div>

                <div class="bag-area">
                    <img src="{{ asset('pictures/Module 3/Bag_Activity/bag1.png') }}" class="bag-visual">
                    <div id="drop-zone"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="completeScreen" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.9); z-index:9999; align-items:center; justify-content:center;">
        <div class="wood-modal animate__animated animate__zoomIn">
            <h3 style="font-family:'Bungee';">MISSION COMPLETE!</h3>
            <div style="font-size: 3rem; margin: 15px 0;">🏆</div>
            <p id="result-message">Handa ka na para sa anumang sakuna!</p>
            <div class="stat-box" style="display:inline-block; margin-bottom: 20px; width: auto;">
                ⏱ Oras: <span id="final-time"></span>
            </div>
            <div style="display:flex; flex-direction:column; gap:10px;">
                <a id="nextBtn" href="{{ route('safehome.activity') }}" class="btn-action" style="display:none;">MAGPATULOY ➡</a>
                <button class="btn-action" style="background:#64748b; box-shadow: 0 4px 0 #334155;" onclick="location.reload()">ULITIN</button>
            </div>
        </div>
    </div>

    <script>
        let score = 0;
        let timeLeft = 60;
        let timerInterval = null;
        let placedItems = new Set();
        let touchGhost = null;
        const correctItems = new Set(["food", "clothes", "blanket", "whistle", "aid", "power", "radio", "light", "hygiene", "knife"]);
        const dropZone = document.getElementById('drop-zone');
        const feedback = document.getElementById('feedback');

        function showFeedback(isCorrect) {
            feedback.innerText = isCorrect ? "TAMA!" : "MALI!";
            feedback.style.backgroundColor = isCorrect ? "var(--success-green)" : "var(--error-red)";
            feedback.style.display = "block";
            feedback.className = "feedback-popup animate__animated animate__bounceIn";
            setTimeout(() => {
                feedback.className = "feedback-popup animate__animated animate__fadeOutUp";
                setTimeout(() => { feedback.style.display = "none"; }, 500);
            }, 800);
        }

        function startGame() {
            document.getElementById('startModal').style.display = "none";
            updateTimerDisplay();
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                if (timeLeft <= 0) { clearInterval(timerInterval); gameOver(); }
            }, 1000);
        }

        function updateTimerDisplay() {
            let m = Math.floor(timeLeft / 60);
            let s = timeLeft % 60;
            document.getElementById('timer').innerText = String(m).padStart(2, '0') + ":" + String(s).padStart(2, '0');
        }

        function pointInsideDropZone(x, y) {
            const rect = dropZone.getBoundingClientRect();
            return x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom;
        }

        function placeItem(id, src) {
            if (!id || placedItems.has(id)) return;
            if (!correctItems.has(id)) {
                showFeedback(false);
                return;
            }
            showFeedback(true);
            placedItems.add(id);
            score++;
            const img = document.createElement('img');
            img.src = src; img.classList.add('dropped-item');
            dropZone.appendChild(img);
            document.getElementById('progress').innerText = score + " / 10";
            document.querySelector(`[data-id="${id}"]`).style.visibility = 'hidden';
            if (score === 10) { clearInterval(timerInterval); showModal(true); }
        }

        document.querySelectorAll('.item').forEach(item => {
            item.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('id', item.dataset.id);
                e.dataTransfer.setData('src', item.src);
            });
            item.addEventListener('touchstart', (e) => {
                if (placedItems.has(item.dataset.id)) return;
                const touch = e.touches[0];
                touchGhost = document.createElement('img');
                touchGhost.src = item.src;
                touchGhost.className = 'touch-ghost';
                document.body.appendChild(touchGhost);
            });
            item.addEventListener('touchmove', (e) => {
                if (!touchGhost) return;
                const touch = e.touches[0];
                touchGhost.style.left = touch.clientX + 'px';
                touchGhost.style.top = touch.clientY + 'px';
                dropZone.classList.toggle('active', pointInsideDropZone(touch.clientX, touch.clientY));
            });
            item.addEventListener('touchend', (e) => {
                if (!touchGhost) return;
                const touch = e.changedTouches[0];
                if (pointInsideDropZone(touch.clientX, touch.clientY)) {
                    placeItem(item.dataset.id, item.src);
                }
                touchGhost.remove(); touchGhost = null;
                dropZone.classList.remove('active');
            });
        });

        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('active'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('active'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault(); dropZone.classList.remove('active');
            placeItem(e.dataTransfer.getData('id'), e.dataTransfer.getData('src'));
        });

        function showModal(success) {
            document.getElementById('completeScreen').style.display = "flex";
            document.getElementById('final-time').innerText = (60 - timeLeft) + " segundo";
            if (success) document.getElementById('nextBtn').style.display = "inline-block";
        }

        function gameOver() {
            document.getElementById('completeScreen').style.display = "flex";
            document.getElementById('result-message').innerText = "Naubusan ka ng oras! Subukan muli.";
        }
    </script>
</body>

</html>