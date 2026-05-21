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
    transition: all 0.3s ease;
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

/* Shake animation for insufficient budget */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    50% { transform: translateX(6px); }
    75% { transform: translateX(-3px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
}

/* Budget warning flash */
.budget-warning {
    animation: flashRed 0.3s ease-in-out 3;
}

@keyframes flashRed {
    0% { background-color: transparent; }
    50% { background-color: rgba(174, 32, 18, 0.4); }
    100% { background-color: transparent; }
}

/* Budget number pulse */
@keyframes pulseRed {
    0% { transform: scale(1); color: var(--bayanihan-green); }
    50% { transform: scale(1.1); color: var(--danger-red); }
    100% { transform: scale(1); color: var(--bayanihan-green); }
}

.budget-pulse {
    animation: pulseRed 0.5s ease-in-out 2;
}

/* Floating warning message */
.floating-warning {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #ae2012, #d6321c);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.9rem;
    z-index: 100;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: slideUpWarning 0.3s ease-out, fadeOutWarning 3s ease-out 2s forwards;
    font-family: 'Nunito', sans-serif;
    letter-spacing: 0.5px;
    text-align: center;
    max-width: 90%;
}

@keyframes slideUpWarning {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

@keyframes fadeOutWarning {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        visibility: hidden;
    }
}

/* FIXED MODAL OVERLAY - SCROLLABLE ON MOBILE */
#simOverlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    z-index: 1000;
    display: none;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    padding: 20px;
    overflow-y: auto;
    overflow-x: hidden;
}

.sim-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    width: 100%;
    max-width: 760px;
    margin: auto;
    min-height: min-content;
}

.sim-card {
    width: min(700px, 92vw);
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 2px solid #e0e7ff;
    border-radius: 20px;
    padding: 30px 25px 25px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
    position: relative;
    overflow: visible;
    animation: slideUp 0.4s ease-out;
    max-height: 80vh;
    overflow-y: auto;
}

/* Custom scrollbar for sim-card */
.sim-card::-webkit-scrollbar {
    width: 5px;
}

.sim-card::-webkit-scrollbar-track {
    background: #e0e7ff;
    border-radius: 10px;
}

.sim-card::-webkit-scrollbar-thumb {
    background: var(--lgu-blue);
    border-radius: 10px;
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
    margin-top: 15px;
}

.sim-actions.show {
    display: block;
}

.action-buttons {
    display: flex;
    flex-direction: column;
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
    width: 120px;
    height: 60px;
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

.document-stamp span { font-size: 1.2rem; }
.document-stamp small { font-size: 0.55rem; letter-spacing: 1px; }

.terminal-text {
    font-family: 'Poppins', sans-serif;
    color: #1a3a5f;
    font-size: 1rem;
    margin-bottom: 20px;
    min-height: auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 15px 0;
}

.terminal-text .sim-line {
    margin: 8px 0;
    line-height: 1.6;
    font-weight: 600;
    padding: 10px 12px;
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
    margin: 15px 0 10px 0;
    font-size: 1.6rem;
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
    padding: 14px 25px;
    font-size: 1rem;
    font-weight: 800;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 4px 0 #b38f00;
    width: 100%;
    position: relative;
    z-index: 5;
    transition: all 0.2s ease;
}

.action-btn:active { transform: translateY(2px); box-shadow: 0 2px 0 #b38f00; }

/* Disabled button style */
.action-btn.disabled {
    opacity: 0.6;
    cursor: not-allowed;
    pointer-events: none;
}

@media (max-width: 600px) {
    .action-btn {
        padding: 14px 20px;
        font-size: 0.95rem;
        border-radius: 10px;
    }
    
    /* Mobile text size adjustments */
    .bp-counter {
        font-size: 1.5rem;
    }
    
    .floating-warning {
        font-size: 0.75rem;
        padding: 8px 16px;
        bottom: 20px;
    }
    
    .sim-card {
        padding: 20px 18px 18px;
        max-height: 85vh;
    }
    
    .terminal-text h1 {
        font-size: 1.3rem;
    }
    
    .terminal-text {
        font-size: 0.9rem;
    }
    
    .document-stamp {
        width: 100px;
        height: 50px;
    }
    
    .document-stamp span { font-size: 1rem; }
    .document-stamp small { font-size: 0.5rem; }
    
    .strategy-item h3 {
        font-size: 0.85rem;
        padding-right: 65px;
    }
    
    .cost-stamp {
        font-size: 0.75rem;
        padding: 2px 5px;
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
            <div class="status-box" id="budgetBox">
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
            
            <div class="sim-actions" id="simActions">
                <div class="action-buttons">
                    <button class="action-btn" id="backBtn" style="background:var(--lgu-blue); color:white;" onclick="window.location.href='{{ route('inner.map3') }}'">🗺 BUMALIK SA MAPA</button>
                </div>
                <button class="action-btn retry-btn" id="closeSim" style="background:var(--lgu-blue); color:white;">🔄 SUBUKAN MULI</button>
            </div>
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
    
    for (let i = items.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [items[i], items[j]] = [items[j], items[i]];
    }
    
    items.forEach(item => list.appendChild(item));
}

function kuninBilangNgNapili() {
    const napili = Array.from(document.querySelectorAll('.strategy-item.selected'));
    const tama = napili.filter(item => item.dataset.type === 'tama').length;
    const mapanlinlang = napili.filter(item => item.dataset.type === 'mapanlinlang').length;
    return { tama, mapanlinlang };
}

// Remove existing floating warning if any
function removeFloatingWarning() {
    const existing = document.querySelector('.floating-warning');
    if (existing) existing.remove();
}

// Show multiple visual feedback for insufficient budget
function showInsufficientBudget() {
    const budgetBox = document.getElementById('budgetBox');
    const budgetNumber = document.getElementById('budgetDisplay');
    
    // Remove existing warnings
    removeFloatingWarning();
    
    // 1. Shake the budget card
    budgetBox.classList.add('shake');
    
    // 2. Flash red background
    budgetBox.classList.add('budget-warning');
    
    // 3. Pulse the budget number
    budgetNumber.classList.add('budget-pulse');
    
    // 4. Show floating warning message (visible on mobile)
    const warning = document.createElement('div');
    warning.className = 'floating-warning';
    warning.innerHTML = '⚠️ INSUFFICIENT FUNDS! ⚠️<br><small>Kulang ang pondo para sa proyektong ito</small>';
    document.body.appendChild(warning);
    
    // 5. Vibrate on mobile devices (if supported)
    if (window.navigator && window.navigator.vibrate) {
        window.navigator.vibrate(200);
    }
    
    // Remove all animations after they finish
    setTimeout(() => {
        budgetBox.classList.remove('shake');
        budgetBox.classList.remove('budget-warning');
        budgetNumber.classList.remove('budget-pulse');
    }, 800);
}

function toggleStrategy(el) {
    const cost = parseInt(el.dataset.cost);
    const safetyVal = parseInt(el.dataset.safety);

    if (el.classList.contains('selected')) {
        el.classList.remove('selected');
        budget += cost;
        safety -= safetyVal;
        updateDisplay();
    } else {
        if (budget >= cost) {
            el.classList.add('selected');
            budget -= cost;
            safety += safetyVal;
            updateDisplay();
        } else {
            // NO ALERT - multiple visual feedback
            showInsufficientBudget();
            return;
        }
    }
}

function updateDisplay() {
    document.getElementById('budgetDisplay').innerText = formatPeso(budget);
    const safetyPercent = Math.min(safety, 100);
    document.getElementById('safetyDisplay').innerText = safetyPercent;
    document.getElementById('meter').style.width = safetyPercent + "%";
    
    // Change budget color and add warning effect if low
    const budgetSpan = document.getElementById('budgetDisplay');
    if (budget < 10000) {
        budgetSpan.style.color = 'var(--danger-red)';
        budgetSpan.style.fontWeight = '900';
    } else {
        budgetSpan.style.color = 'var(--bayanihan-green)';
        budgetSpan.style.fontWeight = '800';
    }
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
    }).catch(() => {});
}

function runSim() {
    const overlay = document.getElementById('simOverlay');
    const text = document.getElementById('simText');
    const stamp = document.getElementById('docStamp');
    const actions = document.getElementById('simActions');

    // Reset and show overlay
    text.innerHTML = '';
    actions.classList.remove('show');
    stamp.classList.remove('active');
    overlay.style.display = 'flex';
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';

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

                sessionStorage.setItem('m3v2_node3', 'true');
                localStorage.setItem('m3v2_node3', 'true');
                saveNode3Progress(panalo);

                if (panalo) {
                    text.innerHTML += `<h1 style="color:var(--bayanihan-green); margin-top:20px;">🎉 TAGUMPAY ANG MISYON!</h1>
                                       <p>🏆 Lahat ng tamang proyekto ay napondohan. Ligtas ang barangay!</p>
                                       <p>💪 Ang komunidad ay handa na sa anumang sakuna.</p>`;
                    
                    setTimeout(() => {
                        stamp.classList.add('active');
                        actions.classList.add('show');
                        document.getElementById('backBtn').style.display = 'block';
                        document.getElementById('closeSim').style.display = 'none';
                    }, 300);
                } else {
                    text.innerHTML += `<h1 style="color:var(--danger-red); margin-top:20px;">⚠️ HINDI NAGTAGUMPAY</h1>
                                       <p>📋 Suriing muli ang mga prayoridad ng barangay.</p>
                                       <p>💡 Piliin ang mga proyektong tunay na makatutulong sa komunidad.</p>`;
                    actions.classList.add('show');
                    document.getElementById('backBtn').style.display = 'block';
                    document.getElementById('closeSim').style.display = 'block';
                }
                
                // Scroll to top of modal content
                const simCard = document.querySelector('.sim-card');
                if (simCard) {
                    simCard.scrollTop = 0;
                }
            }, 1000);
        }
    }, 800);
}

document.getElementById('closeSim').addEventListener('click', () => {
    document.getElementById('simOverlay').style.display = 'none';
    document.body.style.overflow = ''; // Restore body scroll
    location.reload(); // Reload to reset game
});

// Close modal when clicking outside on overlay (but not on the card itself)
document.getElementById('simOverlay').addEventListener('click', function(e) {
    if (e.target === this) {
        this.style.display = 'none';
        document.body.style.overflow = '';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    shuffleStrategies();
    updateDisplay();
});
</script>

@endsection