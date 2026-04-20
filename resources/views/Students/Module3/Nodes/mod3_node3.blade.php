{{-- filepath: resources/views/Students/Module3/Nodes/mod3_node3.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Modyul 3 - Estratehistang CBDRRM')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

:root {
    --lgu-blue: #1a3a5f;
    --lgu-gold: #ffcc00;
    --bayanihan-green: #2d6a4f;
    --danger-red: #ae2012;
    --paper-bg: #f4f1de;
}

body {
    font-family: 'Poppins', sans-serif;
    background: 
        linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
        url("{{ asset('pictures/mod3_innermap.png') }}") center/cover fixed;
    color: #333;
}

/* Tactical Top Nav */
.tactical-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--lgu-blue);
    padding: 15px 30px;
    border-bottom: 4px solid var(--lgu-gold);
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.mission-title h1 {
    font-family: 'Nunito', sans-serif;
    letter-spacing: 0.5px;
    margin: 0;
    color: var(--lgu-gold);
}

/* Main Layout */
.ops-center {
    max-width: 1100px;
    margin: 20px auto;
    padding: 0 18px 22px;
}

.mission-card {
    background: var(--paper-bg);
    background-image: radial-gradient(#d1ccb9 1px, transparent 1px);
    background-size: 20px 20px;
    border-radius: 16px;
    padding: 24px;
    border: 3px solid #7a7561;
    box-shadow: 0 14px 30px rgba(0,0,0,0.2);
    position: relative;
}

.mission-intro {
    margin: 0 0 18px;
    border-bottom: 2px solid #7a7561;
    padding-bottom: 12px;
}

.mission-intro h2 {
    margin: 0;
    color: var(--lgu-blue);
    font-family: 'Nunito', sans-serif;
}

.hud-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 18px;
}

.status-box {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 14px;
    padding: 16px 18px;
    border-left: 8px solid var(--lgu-blue);
    box-shadow: 0 8px 0 rgba(0,0,0,0.1);
    flex: 1 1 260px;
}

.bp-counter {
    font-size: 2rem;
    font-weight: 800;
    color: var(--bayanihan-green);
    font-family: 'Nunito', sans-serif;
}

.readiness-bar {
    background:#eee;
    height:20px;
    border-radius:10px;
    margin-top:10px;
    overflow:hidden;
}

.strategy-list {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
    margin: 0;
    padding: 0;
}

.strategy-item {
    width: 100%;
    background: #fff;
    border: 2px solid #ccc;
    padding: 12px;
    position: relative;
    cursor: pointer;
    transition: 0.2s;
    border-bottom: 5px solid #bbb;
    text-align: left;
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    min-height: 92px;
    display: flex;
    align-items: center;
}

.strategy-item.selected {
    background: #e9f5ff;
    border-color: var(--lgu-blue);
    border-bottom: 5px solid var(--lgu-blue);
}

.strategy-item h3 {
    margin: 0;
    font-size: 0.96rem;
    color: var(--lgu-blue);
    padding-right: 76px;
    width: 100%;
}

.cost-stamp {
    position: absolute;
    top: 8px;
    right: 10px;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
    color: var(--danger-red);
    border: 2px solid var(--danger-red);
    padding: 2px 7px;
    transform: rotate(-4deg);
    opacity: 0.8;
    font-size: 0.9rem;
}

#simOverlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 1000;
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    padding: 20px;
}

.sim-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    width: 100%;
    max-width: 760px;
}

.sim-card {
    width: min(760px, 92vw);
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 2px solid #e0e7ff;
    border-radius: 20px;
    padding: 60px 50px 40px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
    position: relative;
    overflow: visible;
    animation: slideUp 0.4s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.sim-actions {
    width: 100%;
    display: none;
}

.sim-actions.show {
    display: block;
}

.action-buttons {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
    width: 100%;
    margin-bottom: 12px;
}

.retry-btn {
    width: 100%;
    animation: slideUp 0.5s ease-out 0.3s both;
}

/* --- DOCUMENT STAMP (UPPER RIGHT CORNER) --- */
.document-stamp {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 140px;
    height: 70px;
    border: 3px double var(--bayanihan-green);
    color: var(--bayanihan-green);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-family: 'Poppins', sans-serif;
    font-weight: 800;
    text-transform: uppercase;
    line-height: 1;
    z-index: 10;
    background: rgba(255, 255, 255, 0.1);
    
    /* Simulang invisible */
    opacity: 0;
    transform: scale(0) rotate(30deg);
    pointer-events: none;
}

.document-stamp.active {
    animation: stampIncoming 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes stampIncoming {
    0% {
        opacity: 0;
        transform: scale(0) rotate(30deg);
    }
    100% {
        opacity: 0.85;
        transform: scale(1) rotate(-12deg);
        filter: drop-shadow(2px 5px 5px rgba(0,0,0,0.2));
    }
}

.document-stamp span { font-size: 1.4rem; }
.document-stamp small { font-size: 0.6rem; letter-spacing: 1px; }

.terminal-text {
    font-family: 'Poppins', sans-serif;
    color: #1a3a5f;
    font-size: 1.05rem;
    margin-bottom: 24px;
    min-height: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 20px 0;
}

.terminal-text .sim-line {
    margin: 10px 0;
    line-height: 1.7;
    font-weight: 600;
    padding: 12px 14px;
    border: 1px solid #d9e4ff;
    border-left: 6px solid var(--lgu-gold);
    border-radius: 10px;
    background: linear-gradient(135deg, #ffffff 0%, #eef4ff 100%);
    box-shadow: 0 6px 14px rgba(26,58,95,0.08);
    color: #1a3a5f;
    letter-spacing: 0.2px;
    text-align: left;
}

.terminal-text h1 {
    margin: 20px 0 12px 0;
    font-size: 2rem;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
}

.terminal-text p:first-child {
    margin-top: 0;
}

.action-btn {
    background: var(--lgu-gold);
    color: var(--lgu-blue);
    border: none;
    padding: 15px 30px;
    font-size: 1.2rem;
    font-weight: 800;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 5px 0 #b38f00;
    width: 100%;
    position: relative;
    z-index: 5;
}

.action-btn:active { transform: translateY(3px); box-shadow: 0 2px 0 #b38f00; }

@media (max-width: 600px) {
    .action-btn {
        padding: 16px 30px;
        font-size: 1.1rem;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    .action-btn:active { 
        transform: translateY(2px); 
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }
}
</style>

<div class="tactical-header">
    <div class="mission-title">
        <h1>Oplan: Ligtas Barangay</h1>
        <small>Yunit ng Estratehikong CBDRRM</small>
    </div>
</div>

<div class="ops-center">
    <main class="mission-card">
        <div class="mission-intro">
            <h2>Yugto 3: Estratehistang CBDRRM</h2>
            <p>
                <strong>Layunin:</strong> Maglaan ng pondo sa mga proyektong nakababawas sa panganib ng komunidad.
            </p>
        </div>

        <div class="hud-row">
            <div class="status-box">
                <h4 style="margin:0; color: #666;">Pondo ng Komunidad</h4>
                <div class="bp-counter"><span id="budgetDisplay">₱100,000</span></div>
            </div>

            <div class="status-box">
                <h4 style="margin:0; color: #666;">Antas ng Kahandaan</h4>
                <div class="readiness-bar">
                    <div id="meter" style="width:0%; height:100%; background:var(--bayanihan-green); transition:0.5s;"></div>
                </div>
                <div style="text-align:right; font-weight:bold;"><span id="safetyDisplay">0</span>%</div>
            </div>
        </div>

        <div class="strategy-list">
            <button type="button" class="strategy-item" data-type="tama" data-cost="25000" data-safety="25" onclick="toggleStrategy(this)">
                <h3>🔍 Pagmamapa ng Panganib sa Barangay</h3>
                <div class="cost-stamp">₱25,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="tama" data-cost="25000" data-safety="25" onclick="toggleStrategy(this)">
                <h3>📢 Maagang Babala at Agarang Abiso</h3>
                <div class="cost-stamp">₱25,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="tama" data-cost="25000" data-safety="25" onclick="toggleStrategy(this)">
                <h3>🏃 Regular na Drill sa Paglikas</h3>
                <div class="cost-stamp">₱25,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="tama" data-cost="25000" data-safety="25" onclick="toggleStrategy(this)">
                <h3>🤝 Pagsasanay ng Mga Boluntaryo sa Komunidad</h3>
                <div class="cost-stamp">₱25,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="mapanlinlang" data-cost="55000" data-safety="0" onclick="toggleStrategy(this)">
                <h3>🏛️ Magarang Harapan ng Gusali ng Barangay</h3>
                <div class="cost-stamp">₱55,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="mapanlinlang" data-cost="35000" data-safety="0" onclick="toggleStrategy(this)">
                <h3>🎉 Isang Beses na Programang Pang-aliw</h3>
                <div class="cost-stamp">₱35,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="mapanlinlang" data-cost="15000" data-safety="0" onclick="toggleStrategy(this)">
                <h3>📄 Pag-imprenta ng Tarpaulin Lamang</h3>
                <div class="cost-stamp">₱15,000</div>
            </button>
            <button type="button" class="strategy-item" data-type="mapanlinlang" data-cost="40000" data-safety="0" onclick="toggleStrategy(this)">
                <h3>🏢 Renovasyon ng Opisina na Di Pang-emergency</h3>
                <div class="cost-stamp">₱40,000</div>
            </button>
        </div>

        <div style="margin-top: 20px;">
            <button class="action-btn" onclick="runSim()">ISAGAWA ANG MGA PROTOKOL</button>
        </div>
    </main>
</div>

<div id="simOverlay">
    <div class="sim-wrapper">
        <div class="sim-card">
            <div class="document-stamp" id="docStamp">
                <small>LGU-OFFICIAL</small>
                <span>PINAGTIBAY</span>
            </div>

            <div class="terminal-text" id="simText"></div>
        </div>
        
        <div class="sim-actions" id="simActions">
            <div class="action-buttons">
                <button class="action-btn" id="backBtn" style="background:var(--lgu-blue); color:white;" onclick="window.location.href='{{ route('inner.map3') }}'">🗺 BUMALIK SA MAPA</button>
            </div>
            <button class="action-btn retry-btn" id="closeSim" style="background:var(--lgu-blue); color:white;">SUBUKAN MULI</button>
        </div>
    </div>
</div>

<script>
let budget = 100000;
let safety = 0;

function formatPeso(amount) {
    return `₱${amount.toLocaleString('en-PH')}`;
}

function shuffleStrategies() {
    const list = document.querySelector('.strategy-list');
    const items = Array.from(list.querySelectorAll('.strategy-item'));
    
    // Fisher-Yates shuffle
    for (let i = items.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [items[i], items[j]] = [items[j], items[i]];
    }
    
    // Re-append shuffled items
    items.forEach(item => list.appendChild(item));
}

function kuninBilangNgNapili() {
    const napili = Array.from(document.querySelectorAll('.strategy-item.selected'));
    const tama = napili.filter(item => item.dataset.type === 'tama').length;
    const mapanlinlang = napili.filter(item => item.dataset.type === 'mapanlinlang').length;
    return { tama, mapanlinlang };
}

function toggleStrategy(el) {
    const cost = parseInt(el.dataset.cost);
    const safetyVal = parseInt(el.dataset.safety);

    if (el.classList.contains('selected')) {
        el.classList.remove('selected');
        budget += cost;
        safety -= safetyVal;
    } else {
        if (budget >= cost) {
            el.classList.add('selected');
            budget -= cost;
            safety += safetyVal;
        } else {
            alert("Hindi sapat ang pondo!");
            return;
        }
    }
    updateDisplay();
}

function updateDisplay() {
    document.getElementById('budgetDisplay').innerText = formatPeso(budget);
    document.getElementById('safetyDisplay').innerText = Math.min(safety, 100);
    document.getElementById('meter').style.width = Math.min(safety, 100) + "%";
}

function saveNode3Progress(isPassed) {
    fetch("{{ route('student.module3.node3.save') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            choices_selected: document.querySelectorAll('.strategy-item.selected').length,
            remaining_budget: budget,
            readiness_score: Math.min(safety, 100),
            is_passed: isPassed ? 1 : 0
        })
    }).catch(() => {
        // Do not block UI flow when save fails.
    });
}

function runSim() {
    const overlay = document.getElementById('simOverlay');
    const text = document.getElementById('simText');
    const stamp = document.getElementById('docStamp');
    const actions = document.getElementById('simActions');

    text.innerHTML = '';
    actions.classList.remove('show');
    stamp.classList.remove('active');
    overlay.style.display = 'flex';

    const sequence = [
        "Sinisimulan ang pagmamasid sa panahon...",
        "May namumuong malakas na bagyo sa silangan...",
        "Isinasagawa ang pagsubok sa katatagan ng lugar..."
    ];

    let i = 0;
    const interval = setInterval(() => {
        text.innerHTML += `<p class="sim-line">${sequence[i]}</p>`;
        i++;
        if(i >= sequence.length) {
            clearInterval(interval);
            setTimeout(() => {
                const bilang = kuninBilangNgNapili();
                const panalo = bilang.tama === 4 && bilang.mapanlinlang === 0 && budget === 0;

                // Mark node as completed once simulation result is reached.
                sessionStorage.setItem('m3v2_node3', 'true');
                localStorage.setItem('m3v2_node3', 'true');
                saveNode3Progress(panalo);

                if (panalo) {
                    text.innerHTML += `<h1 style="color:var(--bayanihan-green); margin-top:20px;">TAGUMPAY ANG MISYON!</h1>
                                       <p>Lahat ng tamang proyekto ay napondohan. Ligtas ang barangay!</p>`;
                    
                    // Stamp animation pagkatapos ng text
                    setTimeout(() => {
                        stamp.classList.add('active');
                        actions.classList.add('show');
                        document.getElementById('backBtn').style.display = 'block';
                        document.getElementById('closeSim').style.display = 'none';
                    }, 300);
                } else {
                    text.innerHTML += `<h1 style="color:var(--danger-red); margin-top:20px;">HINDI NAGTAGUMPAY</h1>
                                       <p>Suriing muli ang mga prayoridad ng barangay.</p>`;
                    actions.classList.add('show');
                    document.getElementById('backBtn').style.display = 'block';
                    document.getElementById('closeSim').style.display = 'block';
                }
            }, 1000);
        }
    }, 800);
}

document.getElementById('closeSim').addEventListener('click', () => {
    document.getElementById('simOverlay').style.display = 'none';
});

// Shuffle strategies on page load
document.addEventListener('DOMContentLoaded', () => {
    shuffleStrategies();
});
</script>

@endsection