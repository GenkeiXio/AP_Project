{{-- filepath: resources/views/Students/Module3/Nodes/mod3_node1.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Module 3 - Node 1: Tactical Match')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=JetBrains+Mono:wght@500;700&display=swap');

:root {
    --primary: #1a535c;
    --secondary: #4ecdc4;
    --accent: #ff6b6b;
    --warning: #ffe66d;
    --bg-dark: #0f172a;
    --glass: rgba(255, 255, 255, 0.9);
}

body {
    margin: 0;
    font-family: 'Outfit', sans-serif;
    background: radial-gradient(circle at top right, #1e293b, #0f172a);
    min-height: 100vh;
    color: #f8fafc;
}

/* Navigation */
.back-button {
    position: fixed;
    top: 90px;
    left: 20px;
    z-index: 100;
    text-decoration: none;
    color: var(--primary);
    background: white;
    padding: 12px 20px;
    border-radius: 50px;
    font-weight: 800;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    transition: 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.back-button:hover { transform: scale(1.05); background: var(--secondary); color: white; }

.main-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.game-container {
    width: 100%;
    max-width: 950px;
    background: var(--glass);
    border-radius: 32px;
    overflow: hidden;
    color: #1e293b;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

/* Header */
.game-header {
    background: var(--primary);
    padding: 30px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 4px solid var(--secondary);
}

.header-info h1 { margin: 0; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 10px; }
.header-info p { margin: 5px 0 0; opacity: 0.8; font-size: 0.9rem; }

.hud-group { display: flex; gap: 15px; }
.hud-card {
    background: rgba(255,255,255,0.1);
    padding: 10px 20px;
    border-radius: 15px;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
    min-width: 80px;
}
.hud-val { display: block; font-size: 1.2rem; font-weight: 800; color: var(--secondary); }
.hud-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }

/* Content Area */
.game-content { padding: 40px; }

/* Timer Bar */
.timer-container { margin-bottom: 30px; }
.timer-bar-bg {
    height: 12px;
    background: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}
.timer-bar-fill {
    height: 100%;
    width: 100%;
    background: linear-gradient(90deg, var(--secondary), #2dd4bf);
    transition: width 1s linear;
}
.timer-bar-fill.warning-active { background: var(--accent); animation: pulse 0.5s infinite; }

@keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.6; } 100% { opacity: 1; } }

/* Target Zone */
.target-area {
    background: white;
    border: 3px dashed #cbd5e1;
    border-radius: 24px;
    padding: 40px;
    text-align: center;
    margin-bottom: 30px;
    transition: 0.3s;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.target-area.drag-over { border-color: var(--secondary); background: #f0fdfa; transform: scale(1.02); }
.target-area h2 { font-size: 2.5rem; margin: 0; color: var(--primary); letter-spacing: 2px; }
.target-area.correct { border-color: #22c55e; background: #f0fdf4; box-shadow: 0 0 20px rgba(34, 197, 94, 0.2); }
.target-area.wrong { border-color: var(--accent); background: #fef2f2; animation: shake 0.4s; }

.drop-hint {
    opacity: 0.6;
    font-size: 0.75rem;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: 2px;
}

.locked-preview {
    width: min(260px, 100%);
    margin-top: 16px;
    border-radius: 16px;
    overflow: hidden;
    border: 2px solid #22c55e;
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.18);
}

.locked-preview img {
    width: 100%;
    display: block;
}

/* Drag Items */
.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
}
.drag-item {
    background: white;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    cursor: grab;
    transition: 0.3s;
    border: 2px solid transparent;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}
.drag-item:hover { transform: translateY(-5px); border-color: var(--secondary); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.15); }
.drag-item img { width: 100%; border-radius: 15px; display: block; pointer-events: none; }
.drag-item.dragging { opacity: 0.75; transform: scale(0.98); }
.drag-item.selected { border-color: var(--secondary); box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.25); }
.drag-item.locked { border-color: #22c55e; opacity: 1; }
.drag-item.disabled { opacity: 0.5; cursor: not-allowed; }

.drag-ghost {
    position: fixed;
    width: 120px;
    height: auto;
    border-radius: 14px;
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.25);
    pointer-events: none;
    z-index: 9999;
    transform: translate(-50%, -50%);
    border: 2px solid rgba(78, 205, 196, 0.75);
    background: #ffffff;
    padding: 4px;
}

.drag-ghost img {
    width: 100%;
    display: block;
    border-radius: 10px;
}

@media (max-width: 900px) {
    .game-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        padding: 24px 20px;
    }

    .hud-group {
        width: 100%;
    }

    .hud-card {
        flex: 1;
    }

    .game-content {
        padding: 24px 20px;
    }

    .target-area {
        padding: 24px 16px;
    }

    .target-area h2 {
        font-size: 2rem;
        letter-spacing: 1px;
    }
}

@media (max-width: 640px) {
    .back-button {
        top: 76px;
        left: 12px;
        padding: 10px 14px;
        font-size: 0.85rem;
        gap: 6px;
    }

    .main-wrapper {
        padding: 14px;
    }

    .game-container {
        border-radius: 18px;
    }

    .header-info h1 {
        font-size: 1.2rem;
        line-height: 1.3;
    }

    .header-info p {
        font-size: 0.82rem;
    }

    .target-area {
        min-height: 100px;
        margin-bottom: 18px;
    }

    .target-area h2 {
        font-size: 1.4rem;
    }

    .options-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .drag-item {
        border-radius: 14px;
        padding: 8px;
    }

    .btn-group {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-final {
        justify-content: center;
    }
}

/* Result Screen */
.result-screen { text-align: center; padding: 40px 20px; }
.btn-group { display: flex; justify-content: center; gap: 15px; margin-top: 30px; }
.btn-final {
    padding: 15px 30px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: 800;
    transition: 0.3s;
    display: flex;
    align-items: center;
    gap: 10px;
}
.btn-next { background: var(--primary); color: white; }
.btn-retry { background: #e2e8f0; color: var(--primary); }
.btn-final:hover { transform: translateY(-3px); opacity: 0.9; }

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.hidden { display: none !important; }
</style>

<!-- <a href="{{ route('inner.map3') }}" class="back-button">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    Bumalik sa Mapa
</a> -->

<div class="main-wrapper">
    <div class="game-container">
        <div class="game-header">
            <div class="header-info">
                <h1>
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    NODE 01: DISASTER MANAGEMENT
                </h1>
                <p>Itugma ang tamang larawan sa konseptong teknikal.</p>
            </div>
            <div class="hud-group">
                <div class="hud-card">
                    <span class="hud-val" id="roundTxt">1/4</span>
                    <span class="hud-label">YUGTO</span>
                </div>
                <div class="hud-card">
                    <span class="hud-val" id="scoreTxt">0</span>
                    <span class="hud-label">ISKOR</span>
                </div>
            </div>
        </div>

        <div class="game-content">
            <div class="timer-container">
                <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-weight:800; font-size:0.85rem; letter-spacing:1px;">
                    <span id="statusLabel">ESTADO NG SIGNAL: STABLE</span>
                    <span id="timerTxt">10s</span>
                </div>
                <div class="timer-bar-bg">
                    <div class="timer-bar-fill" id="timerFill"></div>
                </div>
            </div>

            <div style="text-align:center; margin-bottom:20px;" id="startWrapper">
                <button id="startBtn" style="
                    padding: 15px 30px;
                    font-weight: 800;
                    border-radius: 15px;
                    border: none;
                    background: var(--primary);
                    color: white;
                    cursor: pointer;
                    font-size: 1rem;
                    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
                ">
                    ▶ Simulan ang Laro
                </button>
            </div>

            <div id="playArea" class="hidden">
                <div class="target-area" id="dropZone">
                    <div class="drop-hint">
                        IPATALASTAS ANG LARAWAN DITO
                    </div>
                    <h2 id="conceptLabel">HAZARD</h2>
                </div>

                <div class="options-grid" id="optionsGrid">
                    </div>
            </div>

            <div id="resultScreen" class="result-screen hidden">
                <div style="font-size: 5rem; margin-bottom: 20px;">🏆</div>
                <h1 style="font-size:3rem; margin:0; color:var(--primary)">TAPOS NA ANG MISYON</h1>
                <p id="finalComment" style="font-size:1.2rem; font-weight:600; color:#64748b">Sinusuri ang iyong husay...</p>
                
                <div class="btn-group">
                    <a href="{{ route('module3.node1') }}" class="btn-final btn-retry">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6M1 20v-6h6M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/></svg>
                        Ulitin
                    </a>
                    <a href="{{ route('module3.node2') }}" class="btn-final btn-next">
                        Kasunod na Node
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<audio id="warningSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3"></audio>
<audio id="errorSound" src="https://assets.mixkit.co/active_storage/sfx/2873/2873-preview.mp3"></audio>
<audio id="successSound" src="https://assets.mixkit.co/active_storage/sfx/2019/2019-preview.mp3"></audio>

<script>
const items = [
    { label: "Hazard", img: "hazard.png" },
    { label: "Risk", img: "risk.png" },
    { label: "Disaster", img: "disaster.png" },
    { label: "Resilience", img: "resilience.png" }
];

const imgBase = "{{ asset('pictures/Module 3/Node 1') }}/";
let current = 0;
let score = 0;
let timeLeft = 10;
let timerInterval;
let warningTriggered = false;
let selectedImg = null;
let roundResolved = false;
let activeTouchCard = null;
let touchMoved = false;
let dragGhost = null;
let desktopGhost = null;

const timerFill = document.getElementById('timerFill');
const dropZone = document.getElementById('dropZone');
const optionsGrid = document.getElementById('optionsGrid');
const conceptLabel = document.getElementById('conceptLabel');

// Audio Elements
const warningSound = document.getElementById('warningSound');
const errorSound = document.getElementById('errorSound');
const successSound = document.getElementById('successSound');

function renderDropPrompt() {
    dropZone.innerHTML = `
        <div class="drop-hint">IPATALASTAS ANG LARAWAN DITO</div>
        <h2 id="conceptLabel">${items[current].label.toUpperCase()}</h2>
    `;
}

function updateSelectedState() {
    const cards = optionsGrid.querySelectorAll('.drag-item');
    cards.forEach(card => {
        card.classList.toggle('selected', card.dataset.img === selectedImg);
    });
}

function attemptDrop(imgName, sourceCard) {
    if (roundResolved || !imgName) return;
    handleResult(imgName === items[current].img, imgName, sourceCard);
}

function isPointInsideDropZone(clientX, clientY) {
    const rect = dropZone.getBoundingClientRect();
    return clientX >= rect.left && clientX <= rect.right && clientY >= rect.top && clientY <= rect.bottom;
}

function getTouchCoords(event) {
    const touch = event.changedTouches && event.changedTouches[0];
    if (!touch) return null;
    return { x: touch.clientX, y: touch.clientY };
}

function showDragGhost(imgName, clientX, clientY) {
    removeDragGhost();
    dragGhost = document.createElement('div');
    dragGhost.className = 'drag-ghost';
    dragGhost.innerHTML = `<img src="${imgBase}${imgName}" alt="drag preview">`;
    document.body.appendChild(dragGhost);
    moveDragGhost(clientX, clientY);
}

function moveDragGhost(clientX, clientY) {
    if (!dragGhost) return;
    dragGhost.style.left = `${clientX}px`;
    dragGhost.style.top = `${clientY}px`;
}

function removeDragGhost() {
    if (dragGhost && dragGhost.parentNode) {
        dragGhost.parentNode.removeChild(dragGhost);
    }
    dragGhost = null;
}

function buildDesktopGhost(imgName) {
    if (desktopGhost && desktopGhost.parentNode) {
        desktopGhost.parentNode.removeChild(desktopGhost);
    }
    desktopGhost = document.createElement('div');
    desktopGhost.className = 'drag-ghost';
    desktopGhost.style.left = '-9999px';
    desktopGhost.style.top = '-9999px';
    desktopGhost.innerHTML = `<img src="${imgBase}${imgName}" alt="drag preview">`;
    document.body.appendChild(desktopGhost);
    return desktopGhost;
}

function clearDesktopGhost() {
    if (desktopGhost && desktopGhost.parentNode) {
        desktopGhost.parentNode.removeChild(desktopGhost);
    }
    desktopGhost = null;
}

function initRound() {
    if (current >= items.length) return endMission();
    
    // Reset Round State
    warningTriggered = false;
    roundResolved = false;
    selectedImg = null;
    timeLeft = 10;
    document.getElementById('statusLabel').innerText = "ESTADO NG SIGNAL: STABLE";
    document.getElementById('statusLabel').style.color = "inherit";
    document.getElementById('roundTxt').innerText = `${current + 1}/${items.length}`;
    document.getElementById('timerTxt').innerText = `${timeLeft}s`;
    renderDropPrompt();
    
    timerFill.className = 'timer-bar-fill';
    timerFill.style.width = '100%';
    dropZone.className = 'target-area';

    // Shuffle and populate images
    const shuffledPool = items.map(i => i.img).sort(() => Math.random() - 0.5);
    optionsGrid.innerHTML = '';
    
    shuffledPool.forEach(imgName => {
        const div = document.createElement('div');
        div.className = 'drag-item';
        div.draggable = true;
        div.dataset.img = imgName;
        div.innerHTML = `<img src="${imgBase}${imgName}" draggable="false" alt="${imgName}">`;
        div.addEventListener('dragstart', (e) => {
            if (roundResolved) {
                e.preventDefault();
                return;
            }
            div.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', imgName);
            const ghost = buildDesktopGhost(imgName);
            e.dataTransfer.setDragImage(ghost, 60, 60);
        });
        div.addEventListener('dragend', () => {
            div.classList.remove('dragging');
            clearDesktopGhost();
        });
        div.addEventListener('click', () => {
            if (roundResolved) return;
            selectedImg = imgName;
            updateSelectedState();
        });
        div.addEventListener('dblclick', () => {
            if (roundResolved) return;
            attemptDrop(imgName, div);
        });
        div.addEventListener('pointerdown', (e) => {
            if (roundResolved || e.pointerType !== 'touch') return;
            activeTouchCard = div;
            touchMoved = false;
            div.classList.add('dragging');
            showDragGhost(imgName, e.clientX, e.clientY);
        });
        div.addEventListener('pointermove', (e) => {
            if (!activeTouchCard || activeTouchCard !== div || roundResolved) return;
            touchMoved = true;
            moveDragGhost(e.clientX, e.clientY);
            dropZone.classList.toggle('drag-over', isPointInsideDropZone(e.clientX, e.clientY));
        });
        div.addEventListener('pointerup', (e) => {
            if (!activeTouchCard || activeTouchCard !== div || roundResolved) return;
            const shouldDrop = isPointInsideDropZone(e.clientX, e.clientY);
            div.classList.remove('dragging');
            activeTouchCard = null;
            removeDragGhost();
            dropZone.classList.remove('drag-over');
            if (shouldDrop) {
                attemptDrop(imgName, div);
            }
        });
        div.addEventListener('pointercancel', () => {
            if (activeTouchCard !== div) return;
            div.classList.remove('dragging');
            activeTouchCard = null;
            removeDragGhost();
            dropZone.classList.remove('drag-over');
        });

        // Safari/older mobile fallback: explicit touch events.
        div.addEventListener('touchstart', (e) => {
            if (roundResolved) return;
            activeTouchCard = div;
            touchMoved = false;
            div.classList.add('dragging');
            const coords = getTouchCoords(e);
            if (coords) showDragGhost(imgName, coords.x, coords.y);
        }, { passive: true });

        div.addEventListener('touchmove', (e) => {
            if (!activeTouchCard || activeTouchCard !== div || roundResolved) return;
            const coords = getTouchCoords(e);
            if (!coords) return;
            touchMoved = true;
            // Prevent page scroll while dragging card.
            e.preventDefault();
            moveDragGhost(coords.x, coords.y);
            dropZone.classList.toggle('drag-over', isPointInsideDropZone(coords.x, coords.y));
        }, { passive: false });

        div.addEventListener('touchend', (e) => {
            if (!activeTouchCard || activeTouchCard !== div || roundResolved) return;
            const coords = getTouchCoords(e);
            const shouldDrop = coords ? isPointInsideDropZone(coords.x, coords.y) : false;

            div.classList.remove('dragging');
            activeTouchCard = null;
            removeDragGhost();
            dropZone.classList.remove('drag-over');

            if (shouldDrop) {
                e.preventDefault();
                attemptDrop(imgName, div);
                return;
            }

            // If no drag motion happened, keep tap-to-select behavior.
            if (!touchMoved) {
                selectedImg = imgName;
                updateSelectedState();
            }
        }, { passive: false });

        div.addEventListener('touchcancel', () => {
            if (activeTouchCard !== div) return;
            div.classList.remove('dragging');
            activeTouchCard = null;
            removeDragGhost();
            dropZone.classList.remove('drag-over');
        }, { passive: true });
        optionsGrid.appendChild(div);
    });

    // Mobile-friendly: choose image by tap, then tap drop zone to submit.
    updateSelectedState();

    startTimer();
}

function startTimer() {
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById('timerTxt').innerText = `${timeLeft}s`;
        const pct = (timeLeft / 10) * 100;
        timerFill.style.width = pct + '%';

        // Critical Time (3 seconds remaining)
        if (timeLeft <= 3 && timeLeft > 0) {
            timerFill.classList.add('warning-active');
            document.getElementById('statusLabel').innerText = "BABALA: MAWAWALA ANG SIGNAL!";
            document.getElementById('statusLabel').style.color = "var(--accent)";
            if (!warningTriggered) {
                warningSound.play();
                warningTriggered = true;
            }
        }

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            handleResult(false);
        }
    }, 1000);
}

// Drag & Drop
dropZone.addEventListener('dragover', (e) => {
    if (roundResolved) return;
    e.preventDefault();
    dropZone.classList.add('drag-over');
});

dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));

dropZone.addEventListener('drop', (e) => {
    if (roundResolved) return;
    e.preventDefault();
    const droppedImg = e.dataTransfer.getData('text/plain');
    const sourceCard = optionsGrid.querySelector(`[data-img="${droppedImg}"]`);
    attemptDrop(droppedImg, sourceCard);
});

dropZone.addEventListener('click', () => {
    if (roundResolved || !selectedImg) return;
    const sourceCard = optionsGrid.querySelector(`[data-img="${selectedImg}"]`);
    attemptDrop(selectedImg, sourceCard);
});

function handleResult(isCorrect, imgName = null, sourceCard = null) {
    if (roundResolved) return;
    roundResolved = true;
    clearInterval(timerInterval);
    dropZone.classList.remove('drag-over');
    selectedImg = null;
    updateSelectedState();
    optionsGrid.querySelectorAll('.drag-item').forEach(card => {
        card.draggable = false;
        card.classList.add('disabled');
    });
    
    if (isCorrect) {
        score++;
        successSound.play();
        document.getElementById('scoreTxt').innerText = score;
        dropZone.classList.add('correct');

        dropZone.innerHTML = `
            <div class="drop-hint">TAMANG TUGMA</div>
            <h2>${items[current].label.toUpperCase()}</h2>
            <div class="locked-preview">
                <img src="${imgBase}${imgName || items[current].img}" alt="${items[current].label}">
            </div>
        `;

        if (sourceCard) {
            sourceCard.classList.remove('disabled');
            sourceCard.classList.add('locked');
        }
    } else {
        errorSound.play();
        dropZone.classList.add('wrong');
    }

    setTimeout(() => {
        current++;
        initRound();
    }, 1200);
}

function endMission() {
    document.getElementById('playArea').classList.add('hidden');
    document.getElementById('resultScreen').classList.remove('hidden');

    const accuracy = (score / items.length) * 100;

    document.getElementById('finalComment').innerText = `Katumpakan: ${(score/items.length)*100}% | Kabuuang Iskor: ${score}/${items.length}`;

    //SAVE TO DATABASE
    saveGameResult();

    sessionStorage.setItem("m3_node1", "true");
}

document.getElementById('startBtn').addEventListener('click', () => {
    document.getElementById('startWrapper').classList.add('hidden');
    document.getElementById('playArea').classList.remove('hidden');
    initRound();
});

// initRound();

function saveGameResult(){
    fetch("{{ route('module3.node1.save') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            score: score,
            total_items: items.length
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("Saved Node1:", data);
    })
    .catch(err => console.error(err));
}
</script>

@endsection