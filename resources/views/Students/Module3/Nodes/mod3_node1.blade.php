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
}
.drag-item:hover { transform: translateY(-5px); border-color: var(--secondary); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.15); }
.drag-item img { width: 100%; border-radius: 15px; display: block; pointer-events: none; }

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

<a href="{{ route('inner.map3') }}" class="back-button">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    Bumalik sa Mapa
</a>

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

            <div id="playArea">
                <div class="target-area" id="dropZone">
                    <div style="opacity:0.6; font-size:0.75rem; font-weight:800; margin-bottom:10px; letter-spacing:2px;">
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

// Audio Elements
const warningSound = document.getElementById('warningSound');
const errorSound = document.getElementById('errorSound');
const successSound = document.getElementById('successSound');

function initRound() {
    if (current >= items.length) return endMission();
    
    // Reset Round State
    warningTriggered = false;
    timeLeft = 10;
    document.getElementById('statusLabel').innerText = "ESTADO NG SIGNAL: STABLE";
    document.getElementById('statusLabel').style.color = "inherit";
    document.getElementById('roundTxt').innerText = `${current + 1}/${items.length}`;
    document.getElementById('conceptLabel').innerText = items[current].label.toUpperCase();
    
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
        div.innerHTML = `<img src="${imgBase}${imgName}">`;
        div.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', imgName);
        });
        optionsGrid.appendChild(div);
    });

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
    e.preventDefault();
    dropZone.classList.add('drag-over');
});

dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const droppedImg = e.dataTransfer.getData('text/plain');
    handleResult(droppedImg === items[current].img);
});

function handleResult(isCorrect) {
    clearInterval(timerInterval);
    dropZone.classList.remove('drag-over');
    
    if (isCorrect) {
        score++;
        successSound.play();
        document.getElementById('scoreTxt').innerText = score;
        dropZone.classList.add('correct');
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
    document.getElementById('finalComment').innerText = `Katumpakan: ${(score/items.length)*100}% | Kabuuang Iskor: ${score}/${items.length}`;
    sessionStorage.setItem("m3_node1", "true");
}

initRound();
</script>

@endsection