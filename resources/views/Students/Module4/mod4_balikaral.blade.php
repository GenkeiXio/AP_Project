@extends('Students.studentslayout')
@section('title', 'Module 4 : Disaster Defense')

@push('styles')
<style>
    :root {
        --neon-cyan: #00f2ff;
        --neon-green: #39ff14;
        --neon-red: #ff3131;
        --neon-yellow: #f4ea14;
        --panel-bg: rgba(13, 25, 48, 0.9);
    }

    html, body {
        background: #050a14;
        background-image: 
            linear-gradient(rgba(0, 242, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 242, 255, 0.03) 1px, transparent 1px);
        background-size: 30px 30px;
        color: #e2e8f0;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    .container-box {
        max-width: 1100px;
        margin: 20px auto;
        padding: 30px;
        border-radius: 30px;
        background: var(--panel-bg);
        border: 1px solid rgba(0, 242, 255, 0.2);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
    }

    /* HUD HEADER */
    .hud-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding: 15px 20px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        border-left: 4px solid var(--neon-cyan);
    }

    .game-title h2 {
        font-weight: 800;
        color: var(--neon-cyan);
        margin: 0;
        font-size: 1.5rem;
    }

    .stat-display {
        background: #1a2233;
        padding: 8px 15px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.1);
        text-align: center;
        min-width: 100px;
    }

    .stat-label { font-size: 0.65rem; color: #94a3b8; text-transform: uppercase; }
    .stat-value { font-size: 1.2rem; font-weight: 700; color: #fff; }

    /* MISSION SECTORS */
    .mission-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .sector {
        background: rgba(0, 0, 0, 0.2);
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        min-height: 250px;
        padding: 12px;
        transition: 0.2s;
    }

    .sector.drag-over {
        border-color: var(--neon-cyan);
        background: rgba(0, 242, 255, 0.1);
    }

    .sector-title {
        text-align: center;
        padding: 8px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .bago { background: rgba(0, 242, 255, 0.1); color: var(--neon-cyan); border: 1px solid var(--neon-cyan); }
    .habang { background: rgba(244, 234, 20, 0.1); color: var(--neon-yellow); border: 1px solid var(--neon-yellow); }
    .pagkatapos { background: rgba(57, 255, 20, 0.1); color: var(--neon-green); border: 1px solid var(--neon-green); }

    .drop-target {
        min-height: 180px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    /* CARD STYLING */
    .deck-container {
        background: rgba(0, 0, 0, 0.4);
        padding: 20px;
        border-radius: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        border-top: 2px solid var(--neon-cyan);
    }

    .action-card {
        background: #1e293b;
        width: 160px;
        border-radius: 12px;
        padding: 10px;
        cursor: grab;
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        touch-action: none;
    }

    .action-card:hover { box-shadow: 0 0 15px rgba(0, 242, 255, 0.3); }
    .action-card:active { cursor: grabbing; transform: scale(0.95); }

    .action-card img {
        width: 100%;
        height: 110px;
        object-fit: contain;
        background: white;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .action-card p {
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        line-height: 1.2;
        margin: 0;
        color: #f8fafc;
    }

    /* CUSTOM MODAL */
    .game-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0, 5, 20, 0.85);
        backdrop-filter: blur(8px);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #0d1930;
        border: 2px solid var(--neon-cyan);
        padding: 40px;
        border-radius: 30px;
        width: 90%;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 0 50px rgba(0, 242, 255, 0.2);
        animation: modalSlide 0.4s cubic-bezier(0.18, 0.89, 0.32, 1.28);
    }

    @keyframes modalSlide {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* UTILITIES */
    .correct-drop { width: 100% !important; margin-bottom: 8px; border-color: var(--neon-green) !important; box-shadow: 0 0 10px rgba(57, 255, 20, 0.2); }
    .shake { animation: shake-ani 0.3s; border-color: var(--neon-red) !important; }
    @keyframes shake-ani { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    .timer-pulse { animation: timerPulse 0.8s ease-in-out infinite; color: var(--neon-red); }
    @keyframes timerPulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

    .timer-safe { color: var(--neon-green); text-shadow: 0 0 10px rgba(57, 255, 20, 0.35); }
    .timer-warning { color: var(--neon-yellow); text-shadow: 0 0 10px rgba(244, 234, 20, 0.35); }
    .timer-danger { color: var(--neon-red); text-shadow: 0 0 12px rgba(255, 49, 49, 0.45); }

    .btn-deploy {
        margin-top: 20px;
        background: linear-gradient(135deg, #00f2ff 0%, #39ff14 100%);
        color: #001724;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        box-shadow: 0 7px 0 #0aa2b0, 0 14px 22px rgba(0, 0, 0, 0.25);
        transition: transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
    }

    .btn-deploy:hover {
        color: #001724;
        filter: brightness(1.06);
        transform: translateY(-2px);
        box-shadow: 0 9px 0 #0aa2b0, 0 18px 28px rgba(0, 0, 0, 0.3);
    }

    .btn-deploy:active {
        transform: translateY(4px);
        box-shadow: 0 3px 0 #0aa2b0, 0 8px 12px rgba(0, 0, 0, 0.28);
    }

    @media (max-width: 992px) {
        .container-box {
            padding: 22px;
            margin: 14px;
        }

        .hud-header {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }

        .hud-header .d-flex.gap-2 {
            display: grid !important;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px !important;
        }

        .stat-display {
            min-width: 0;
            padding: 8px 10px;
        }

        .mission-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .sector {
            min-height: auto;
        }

        .drop-target {
            min-height: 140px;
        }
    }

    @media (max-width: 576px) {
        .container-box {
            padding: 16px;
            border-radius: 18px;
            margin: 10px;
        }

        .game-title h2 {
            font-size: 1.1rem;
        }

        .game-title p {
            font-size: 0.72rem;
        }

        .hud-header {
            padding: 12px;
            border-radius: 12px;
        }

        .hud-header .d-flex.gap-2 {
            grid-template-columns: 1fr;
        }

        .stat-label {
            font-size: 0.62rem;
        }

        .stat-value {
            font-size: 1rem;
        }

        .deck-container {
            padding: 12px;
            gap: 10px;
        }

        .action-card {
            width: calc(50% - 10px);
            min-width: 130px;
            padding: 8px;
        }

        .action-card img {
            height: 95px;
        }

        .action-card p {
            font-size: 0.7rem;
        }

        .btn-deploy {
            width: 100%;
            padding: 11px 14px;
            font-size: 0.9rem;
            letter-spacing: 0.4px;
        }

        .modal-content {
            width: 94%;
            padding: 22px 16px;
            border-radius: 18px;
        }

        #modalTitle {
            font-size: 1.25rem;
        }

        #modalMessage {
            font-size: 0.92rem;
            margin-bottom: 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-box">
    <div class="hud-header">
        <div class="game-title">
            <h2>OPERASYON: KALAMIDAD</h2>
            <p class="m-0 text-muted small">AYUSIN ANG MGA HAKBANG SA KALIGTASAN</p>
        </div>
        <div class="d-flex gap-2">
            <div class="stat-display">
                <div class="stat-label">Oras</div>
                <div class="stat-value timer-safe" id="timerBigDisplay">30s</div>
            </div>
            <div class="stat-display">
                <div class="stat-label">Iskor</div>
                <div class="stat-value"><span id="score">0</span>/6</div>
            </div>
            <div class="stat-display">
                <div class="stat-label">Antas</div>
                <div class="stat-value text-info" id="missionRank">BAGUHAN</div>
            </div>
        </div>
    </div>

    <div style="height: 10px; background: #0f172a; border-radius: 10px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.05);">
        <div id="missionXpBar" style="height: 100%; width: 0%; background: linear-gradient(90deg, var(--neon-cyan), var(--neon-green)); transition: 0.5s; border-radius: 10px;"></div>
    </div>

    <div id="warningMessage" style="display:none; text-align:center; color:var(--neon-yellow); font-weight:bold; margin-bottom:10px;">⚠️ 5 segundo na lang!</div>
    <div id="sfxMessage" style="min-height: 25px; text-align:center; font-weight:bold; margin-bottom:10px;"></div>

    <div class="mission-grid">
        <div class="sector" id="before">
            <div class="sector-title bago">BAGO (Paghahanda)</div>
            <div class="drop-target"></div>
        </div>
        <div class="sector" id="during">
            <div class="sector-title habang">HABANG (Aksyon)</div>
            <div class="drop-target"></div>
        </div>
        <div class="sector" id="after">
            <div class="sector-title pagkatapos">PAGKATAPOS (Pagbangon)</div>
            <div class="drop-target"></div>
        </div>
    </div>

    <div class="deck-container" id="choices">
        @php
            $cards = [
                ['type' => 'before', 'img' => 'mod4_emergencykit.png', 'text' => 'Maghanda ng emergency kit.'],
                ['type' => 'before', 'img' => 'mod4_newsbabala.png', 'text' => 'Makinig sa balita at babala.'],
                ['type' => 'during', 'img' => 'mod4_evacuating.png', 'text' => 'Lumikas sa ligtas na lugar.'],
                ['type' => 'during', 'img' => 'mod4_duckcoverhold.png', 'text' => 'Yumuko, magkubli, at kumapit.'],
                ['type' => 'after', 'img' => 'mod4_cleanupdrive.png', 'text' => 'Tumulong sa paglilinis.'],
                ['type' => 'after', 'img' => 'mod4_suriinkuryente.png', 'text' => 'Suriin ang linya ng kuryente.']
            ];
            shuffle($cards);
        @endphp

        @foreach($cards as $card)
        <div class="action-card" draggable="true" data-type="{{ $card['type'] }}">
            <img src="{{ asset('pictures/'.$card['img']) }}" alt="Gawain">
            <p>{{ $card['text'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="text-center">
        <button class="btn btn-deploy" onclick="resetGame()">🔄 I-RESET ANG LARO</button>
    </div>
</div>

<div id="feedbackModal" class="game-modal">
    <div class="modal-content">
        <div id="modalIcon" style="font-size: 50px; margin-bottom: 20px;"></div>
        <h2 id="modalTitle" style="font-weight: 800; margin-bottom: 15px;"></h2>
        <p id="modalMessage" style="color: #cbd5e1; line-height: 1.6; margin-bottom: 30px;"></p>
        <div id="modalAction"></div>
    </div>
</div>

<script>
    let dragged = null;
    let score = 0;
    const total = 6;
    let time = 30;
    let timer;
    let isActive = true;
    let warningShown = false;

    const correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-4.mp3");
    const wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

    function initGame() {
        const cards = document.querySelectorAll('.action-card');
        const sectors = document.querySelectorAll('.sector');

        cards.forEach(card => {
            card.addEventListener('dragstart', function(e) {
                if(!isActive) return;
                dragged = this;
                e.dataTransfer.setData('text/plain', null);
                this.style.opacity = '0.4';
            });
            card.addEventListener('dragend', function() {
                this.style.opacity = '1';
                dragged = null;
            });
        });

        sectors.forEach(sector => {
            sector.addEventListener('dragover', (e) => {
                e.preventDefault();
                sector.classList.add('drag-over');
            });
            sector.addEventListener('dragleave', () => sector.classList.remove('drag-over'));
            sector.addEventListener('drop', function(e) {
                e.preventDefault();
                sector.classList.remove('drag-over');
                if(!dragged) return;

                if(dragged.dataset.type === this.id) {
                    this.querySelector('.drop-target').appendChild(dragged);
                    dragged.setAttribute('draggable', 'false');
                    dragged.classList.add('correct-drop');
                    correctSound.play().catch(()=>{});
                    score++;
                    updateUI();
                    if(score === total) endGame(true);
                } else {
                    wrongSound.play().catch(()=>{});
                    dragged.classList.add('shake');
                    setTimeout(() => dragged.classList.remove('shake'), 400);
                }
            });
        });
        startTimer();
    }

    function updateUI() {
        document.getElementById('score').innerText = score;
        const xp = (score / total) * 100;
        document.getElementById('missionXpBar').style.width = xp + '%';
        
        const rank = document.getElementById('missionRank');
        if(score >= 6) { rank.innerText = "HEPE"; rank.style.color = "var(--neon-green)"; }
        else if(score >= 4) { rank.innerText = "OPISYAL"; rank.style.color = "var(--neon-cyan)"; }
        else if(score >= 2) { rank.innerText = "REKRUT"; rank.style.color = "var(--neon-yellow)"; }
    }

    function startTimer() {
        const timerEl = document.getElementById('timerBigDisplay');
        timer = setInterval(() => {
            if(time <= 0) { endGame(false); return; }
            time--;
            timerEl.innerText = time + 's';

            timerEl.classList.remove('timer-safe', 'timer-warning', 'timer-danger');
            if (time > 15) {
                timerEl.classList.add('timer-safe');
            } else if (time > 5) {
                timerEl.classList.add('timer-warning');
            } else {
                timerEl.classList.add('timer-danger');
            }

            if (time <= 5) {
                timerEl.classList.add('timer-pulse');
                document.getElementById('warningMessage').style.display = 'block';
            }
        }, 1000);
    }

    function endGame(win) {
        clearInterval(timer);
        isActive = false;
        
        const modal = document.getElementById('feedbackModal');
        const icon = document.getElementById('modalIcon');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMessage');
        const action = document.getElementById('modalAction');

        modal.style.display = 'flex';

        if(win) {
            icon.innerHTML = "🎉";
            title.innerText = "Magaling!";
            title.style.color = "var(--neon-green)";
            msg.innerHTML = "Naipakita mo ang tamang pagkakasunod-sunod ng mga gawain sa panahon ng kalamidad.<br><br><strong>👉 Tandaan:</strong> Ang pagiging handa bago ang sakuna, maingat habang ito ay nangyayari, at responsable pagkatapos nito ay susi sa kaligtasan ng lahat.";
            action.innerHTML = `<button class="btn btn-deploy" onclick="window.location.href='{{ route('module4.welcome') }}'">Magpatuloy</button>`;
        } else {
            icon.innerHTML = "❌";
            title.innerText = "Subukan Muli!";
            title.style.color = "var(--neon-red)";
            msg.innerText = "May ilang gawain na hindi nailagay sa tamang yugto o naubusan ka ng oras. Balikan ang iyong kaalaman at ayusin muli ang mga sagot.";
            action.innerHTML = `<button class="btn btn-deploy" onclick="resetGame()">SUBUKAN MULI</button>`;
        }
    }

    function resetGame() {
        location.reload(); // Pinakamalinis na paraan para i-reset ang lahat ng states at positions
    }

    initGame();
</script>
@endsection