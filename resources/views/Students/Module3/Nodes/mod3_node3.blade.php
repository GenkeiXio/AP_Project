{{-- filepath: resources/views/Students/Module3/Nodes/mod3_node3.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Module 3 - CBDRRM Strategist')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap');

:root {
    --primary: #2d6a4f;
    --secondary: #40916c;
    --accent: #d4a373;
    --danger: #bc4749;
    --text-dark: #1b4332;
    --card-bg: rgba(255, 255, 255, 0.95);
}

/* Background Implementation */
body {
    font-family: 'Outfit', sans-serif;
    margin: 0;
    min-height: 100vh;
    color: var(--text-dark);
    background-image: 
        radial-gradient(var(--secondary) 0.5px, transparent 0.5px),
        linear-gradient(135deg, #dcfaf0 0%, #edf9f2 100%);
    background-size: 20px 20px, 100% 100%;
    background-attachment: fixed;
}

.game-container {
    max-width: 1100px;
    margin: 40px auto;
    background: var(--card-bg);
    border-radius: 30px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(8px);
}

.back-link {
    position: fixed;
    top: 88px;
    left: 20px;
    z-index: 100;
    text-decoration: none;
    color: #1b4332;
    background: #ffffff;
    padding: 10px 16px;
    border-radius: 999px;
    font-weight: 800;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Header Section */
.header-hero {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 50px 40px;
    text-align: center;
    position: relative;
}

.header-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.1;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23ffffff'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z'/%3E%3C/g%3E%3C/svg%3E");
}

/* Lesson Content */
.lesson-card {
    background: #fdfae6;
    margin: -30px 40px 20px;
    padding: 30px;
    border-radius: 25px;
    border-left: 10px solid var(--accent);
    box-shadow: 0 15px 30px rgba(0,0,0,0.06);
    position: relative;
    z-index: 10;
}

/* Integrated Instructions Box */
.instruction-box {
    margin: 0 40px 30px;
    padding: 20px 25px;
    background: #e8f5e9;
    border-radius: 20px;
    border: 2px dashed var(--secondary);
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.instruction-box i { font-size: 1.5rem; }

.instruction-text h4 { margin: 0 0 5px 0; color: var(--primary); font-size: 1.1rem; }
.instruction-text ol { margin: 0; padding-left: 20px; font-size: 0.9rem; line-height: 1.6; }

/* Stats HUD */
.hud {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-bottom: 30px;
}

.hud-pill {
    background: white;
    padding: 12px 28px;
    border-radius: 99px;
    font-weight: 800;
    border: 2px solid #e0e0e0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    font-size: 1.1rem;
}

/* Main Grid */
.main-grid {
    display: grid;
    grid-template-columns: 1.25fr 0.75fr;
    gap: 35px;
    padding: 0 40px 50px;
}

.blueprint-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.strategy-card {
    background: white;
    border: 2px solid #f0f0f0;
    border-radius: 22px;
    padding: 25px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.strategy-card:hover { transform: translateY(-7px); border-color: var(--secondary); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
.strategy-card.selected { border-color: var(--primary); background: #eefaf5; }

.cost-tag {
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary);
    color: white;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 800;
}

/* Simulation Panel */
.sim-panel {
    background: #1b4332;
    color: white;
    border-radius: 28px;
    padding: 35px;
    display: flex;
    flex-direction: column;
}

.readiness-meter {
    height: 16px;
    background: #081c15;
    border-radius: 10px;
    margin: 20px 0;
    overflow: hidden;
}

.meter-fill {
    height: 100%;
    width: 0%;
    background: #74c69d;
    transition: width 0.6s ease;
}

.action-btn {
    background: var(--accent);
    color: #1b4332;
    border: none;
    padding: 20px;
    border-radius: 18px;
    font-weight: 800;
    cursor: pointer;
    width: 100%;
    margin-top: auto;
    font-size: 1.1rem;
    box-shadow: 0 6px 0 #b08960;
}

.action-btn:hover { background: #e9c46a; transform: translateY(-2px); }
.action-btn:active { transform: translateY(4px); box-shadow: 0 2px 0 #b08960; }

#simLog {
    font-size: 0.95rem;
    min-height: 120px;
    padding: 20px;
    background: rgba(0,0,0,0.25);
    border-radius: 18px;
    line-height: 1.6;
}

@media (max-width: 950px) {
    .main-grid { grid-template-columns: 1fr; }
    .blueprint-grid { grid-template-columns: 1fr; }
}
</style>

<div class="game-container">
    <a href="{{ route('inner.map3') }}" class="back-link">⬅ Bumalik sa Mapa</a>

    <div class="header-hero">
        <h1 style="margin:0; font-size: 2.5rem;">NODE 3: CBDRRM</h1>
        <p style="margin-top:10px; font-size: 1.3rem; opacity: 0.9;">“BUILD YOUR COMMUNITY”</p>
    </div>

    <div class="lesson-card">
        <p><strong>Alamin natin:</strong> Ang Community-Based Disaster Risk Reduction and Management (CBDRRM) ay isang paraan kung saan ang komunidad mismo ang aktibong nakikilahok sa paghahanda at pagtugon sa sakuna.</p>
        <p style="margin-top:10px; color: var(--primary); font-weight: 600; font-style: italic;">
            Guiding Question: Paano nakatutulong ang pakikilahok ng komunidad sa pagbawas ng panganib?
        </p>
    </div>

    <div class="instruction-box">
        <span style="font-size: 2rem;">🕹️</span>
        <div class="instruction-text">
            <h4>Gabay sa Pagtuklas:</h4>
            <ol>
                <li>Gamitin ang iyong <strong>100 Bayanihan Points (BP)</strong> para pumili ng mga proyekto sa ibaba.</li>
                <li>I-click ang mga cards na sa tingin mo ay nakabase sa apat na haligi ng <strong>CBDRRM</strong>.</li>
                <li>Pindutin ang <strong>"ISAGAWA ANG SIMULASYON"</strong> para subukin kung ligtas ang iyong komunidad.</li>
            </ol>
        </div>
    </div>

    <div class="hud">
        <div class="hud-pill">💰 Budget: <span id="budgetDisplay">100</span> BP</div>
        <div class="hud-pill">🏠 Handa Score: <span id="safetyDisplay">0</span>%</div>
    </div>

    <div class="main-grid">
        <div class="blueprint-grid">
            <div class="strategy-card" data-cost="25" data-safety="25" onclick="toggleStrategy(this)">
                <span class="cost-tag">25 BP</span>
                <h3>🔍 Pagtukoy ng Hazard</h3>
                <p>Pagsusuri ng Panganib at Hazard Mapping upang malaman ang mga ligtas na lugar.</p>
            </div>

            <div class="strategy-card" data-cost="30" data-safety="25" onclick="toggleStrategy(this)">
                <span class="cost-tag">30 BP</span>
                <h3>📢 Pagpaplano</h3>
                <p>Pagbuo ng Evacuation Plans at pag-install ng Early Warning Systems.</p>
            </div>

            <div class="strategy-card" data-cost="25" data-safety="25" onclick="toggleStrategy(this)">
                <span class="cost-tag">25 BP</span>
                <h3>🏃 Pagsasanay at Drill</h3>
                <p>Pagsasagawa ng Evacuation Drills at First Aid Training para sa kahandaan.</p>
            </div>

            <div class="strategy-card" data-cost="20" data-safety="25" onclick="toggleStrategy(this)">
                <span class="cost-tag">20 BP</span>
                <h3>🤝 Partisipasyon</h3>
                <p>Pagpapatatag ng Bayanihan at Kooperasyon ng bawat miyembro ng komunidad.</p>
            </div>

            <div class="strategy-card" data-cost="55" data-safety="5" onclick="toggleStrategy(this)">
                <span class="cost-tag">55 BP</span>
                <h3>🏛️ Luxury Landmark</h3>
                <p>Pagtatayo ng magandang gate sa barangay. Maganda tingnan pero hindi nakakatulong sa baha.</p>
            </div>
        </div>

        <div class="sim-panel">
            <h2 style="margin-top:0;">Survival Simulator</h2>
            <div class="readiness-meter">
                <div class="meter-fill" id="meter"></div>
            </div>

            <div id="simLog">
                Naghihintay ng iyong blueprint... Ang layunin ay maabot ang 100% na kahandaan.
            </div>

            <button class="action-btn" id="simBtn" onclick="runSim()">ISAGAWA ANG SIMULASYON</button>
            <button class="action-btn" style="margin-top:15px; background:#f0f0f0; display:none; box-shadow: 0 6px 0 #ccc;" id="resetBtn" onclick="location.reload()">ULITIN ANG PLANO</button>
            <button class="action-btn" style="margin-top:15px; background:#2d6a4f; color:#fff; display:none; box-shadow: 0 6px 0 #1f4a37;" id="nextBtn" onclick="window.location.href='{{ route('apply.activity') }}'">MAGPATULOY SA ACTIVITY ➡</button>
        </div>
    </div>
</div>

<script>
let budget = 100;
let safety = 0;

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
            alert("Kulang ang iyong Bayanihan Points!");
            return;
        }
    }
    updateDisplay();
}

function updateDisplay() {
    document.getElementById('budgetDisplay').innerText = budget;
    document.getElementById('safetyDisplay').innerText = Math.min(safety, 100);
    document.getElementById('meter').style.width = Math.min(safety, 100) + "%";
}

function runSim() {
    const log = document.getElementById('simLog');
    const btn = document.getElementById('simBtn');
    btn.disabled = true;
    
    document.querySelectorAll('.strategy-card').forEach(c => c.style.pointerEvents = 'none');

    log.innerHTML = "⛈️ <b>ALERTO:</b> May paparating na malakas na bagyo...";

    setTimeout(() => {
        log.innerHTML += "<br>🌊 <i>Tumataas na ang tubig sa mababang bahagi...</i>";
        
        setTimeout(() => {
            if (safety >= 100) {
                log.innerHTML = "🏆 <b>TAGUMPAY!</b> Maiibaba ang epekto ng kalamidad dahil kumpleto ang iyong CBDRRM pillars. Ligtas ang buong komunidad!";
                document.getElementById('meter').style.background = "#2ecc71";
                sessionStorage.setItem('m3_node3', 'true');
                document.getElementById('nextBtn').style.display = 'block';
            } else if (safety >= 75) {
                log.innerHTML = "⚠️ <b>BAHAGYANG HANDA.</b> May ilang nasaktan dahil kulang ang kooperasyon o pagsasanay. Kailangan ng buong pakikilahok.";
                document.getElementById('meter').style.background = "#f39c12";
                sessionStorage.setItem('m3_node3', 'true');
                document.getElementById('nextBtn').style.display = 'block';
            } else {
                log.innerHTML = "❌ <b>HINDI HANDA.</b> Masyadong malaki ang nagastos sa dekorasyon kaysa sa kaligtasan. Kailangan ng masusing CBDRRM approach.";
                document.getElementById('meter').style.background = "#e74c3c";
                sessionStorage.removeItem('m3_node3');
            }
            document.getElementById('resetBtn').style.display = 'block';
        }, 1500);
    }, 1500);
}
</script>

@endsection