@extends('Students.studentslayout')
@section('title', 'Module 2 : Final Activity')

@push('styles')
<style>
    body{
        margin:0;
        font-family:'Nunito',sans-serif;
        overflow:auto;
    }

    .page{
        position:relative;
        z-index:1;
        max-width:900px;
        margin:auto;
        padding:20px;
        margin-top:40px;
        margin-bottom:40px;

        background:white;
        border-radius:18px;
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
    }

    .background-map{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        object-fit:cover;
        z-index:-2;
    }

    .overlay{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.35);
        z-index:-1;
        pointer-events:none;
    }

    h1{
        margin-top:5px;
        text-align:center;
        font-family:'Baloo 2';
        color:#214f33;
    }

    /* ========== PANUTO MODAL STYLES ========== */
    .panuto-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
        animation: fadeInModal 0.3s ease;
    }

    .panuto-modal-overlay.hidden {
        display: none;
    }

    .panuto-modal-box {
        background: white;
        max-width: 600px;
        width: 100%;
        border-radius: 24px;
        padding: 30px 32px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        animation: slideUp 0.4s ease;
        max-height: 90vh;
        overflow-y: auto;
    }

    @keyframes fadeInModal {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(40px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .panuto-modal-title {
        font-family: 'Baloo 2', cursive;
        font-size: 2rem;
        color: #1a5c38;
        text-align: center;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .panuto-modal-body {
        font-size: 0.95rem;
        color: #2d4a3a;
        line-height: 1.7;
    }

    .panuto-modal-body ul {
        padding-left: 20px;
        margin: 10px 0;
    }

    .panuto-modal-body ul li {
        margin-bottom: 6px;
    }

    .panuto-modal-body .highlight-box {
        background: #fef9e4;
        border-left: 4px solid #f39c12;
        padding: 12px 16px;
        border-radius: 8px;
        margin-top: 14px;
        font-weight: 500;
    }

    .panuto-modal-btn {
        display: block;
        width: 100%;
        margin-top: 24px;
        padding: 14px;
        background: linear-gradient(135deg, #4caf50, #2e7d32);
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
    }

    .panuto-modal-btn:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
    }

    /* ========================================= */

    .card{
        background:rgba(255,255,255,0.92);
        border-radius:16px;
        padding:25px;
        margin-top:15px;
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
        backdrop-filter: blur(6px);
    }

    .btn-container{
        display:flex;
        justify-content:center;
        gap:15px;
        margin-top:30px;
    }

    button:disabled{
        opacity:0.6;
        cursor:not-allowed;
    }

    .primary-btn{
        font-size:18px;
        padding:16px 40px;
        border-radius:14px;
        background:linear-gradient(135deg,#5eae4e,#3d8f35);
        box-shadow:0 6px 15px rgba(0,0,0,0.25);
        transition:all 0.2s ease;
        cursor:pointer;
        border:none;
        color:white;
        font-weight:bold;
    }

    .primary-btn:hover{
        transform:scale(1.05);
        box-shadow:0 8px 18px rgba(0,0,0,0.3);
    }

    .primary-btn:active{
        transform:scale(0.97);
    }

    .next-btn{
        font-size:18px;
        padding:16px 40px;
        border-radius:14px;
        background:linear-gradient(135deg,#3498db,#21618c);
        box-shadow:0 6px 15px rgba(0,0,0,0.25);
        transition:all 0.2s ease;
        cursor:pointer;
        border:none;
        color:white;
        font-weight:bold;
    }

    .next-btn:hover{
        transform:scale(1.05);
        box-shadow:0 8px 18px rgba(0,0,0,0.3);
    }

    .next-btn:active{
        transform:scale(0.97);
    }

    /* ========== PROGRESS BAR STYLES ========== */
    .progress-section {
        margin: 15px 0 20px 0;
    }

    .progress-bar-container {
        width: 100%;
        background-color: #e0e0e0;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
        height: 42px;
        position: relative;
    }

    .progress-fill {
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, #3498db, #2980b9, #1f618d);
        border-radius: 30px;
        transition: width 0.5s ease-in-out;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .progress-text {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
        font-weight: bold;
        font-size: 1rem;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        z-index: 2;
        text-shadow: 0 0 2px rgba(255,255,255,0.5);
        pointer-events: none;
    }
    /* ========================================= */

    .scenario-img{
        width:100%;
        border-radius:12px;
        margin-bottom:10px;
    }

    .situation{
        background: linear-gradient(135deg, #2c3e50, #1a2632);
        color: #ecf0f1;
        padding: 14px 18px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
        letter-spacing: 0.5px;
    }

    .choices-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:16px;
    }

    .choice-box{
        border:2px solid #ccc;
        border-radius:14px;
        padding:12px;
        background:white;
        display:flex;
        flex-direction:column;
        align-items:center;
        min-height:210px;
        position:relative;
    }

    .choice-box:hover{
        transform:scale(1.03);
        box-shadow:0 6px 12px rgba(0,0,0,0.15);
    }

    .choice-box.correct{
        background:#e9fbe8;
        border-color:#2ecc71;
        transform:scale(1.05);
    }

    .choice-box.wrong{
        background:#fdeaea;
        border-color:#e74c3c;
    }

    .choice-img{
        width:100%;
        height:150px;
        object-fit:cover;
        border-radius:10px;
        background:#eee;
    }

    .choice-text{
        margin-top:3px;
        font-weight:bold;
        text-align:center;
        font-size:20px;
    }

    .choice-box input{
        position:absolute;
        top:10px;
        right:10px;
        transform:scale(1.8);
        cursor:pointer;
    }

    .pulse{
        animation: pop 0.4s ease;
    }

    @keyframes pop{
        0%{ transform:scale(0.95); opacity:0;}
        100%{ transform:scale(1); opacity:1;}
    }

    .topbar{
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-weight:bold;
        margin-bottom:20px;
        background: #f8f9fa;
        padding: 12px 20px;
        border-radius: 50px;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05), 0 2px 5px rgba(0,0,0,0.1);
    }

    .topbar .timer-wrap,
    .topbar .xp-wrap {
        display:flex;
        align-items:center;
        gap:6px;
        background:#2c3e50;
        color: #ecf0f1;
        padding:6px 14px;
        border-radius:40px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.2), 0 1px 2px rgba(255,255,255,0.5);
    }

    .topbar .timer-wrap span,
    .topbar .xp-wrap span {
        background:transparent;
        padding:0;
        color: #ecf0f1;
        box-shadow:none;
    }

    .topbar .timer-label,
    .topbar .xp-label {
        color: #aab;
        font-size:0.75rem;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:0.5px;
        font-family:'Poppins',sans-serif;
    }

    #feedback{
        margin-top:20px;
        text-align:center;
        font-weight:bold;
        font-size:18px;
    }

    /* 🎉 FINAL SCREEN */
    .final-card{
        text-align:center;
        padding:30px 20px;
        animation: fadeIn 0.5s ease;
    }

    .final-header{
        font-size:28px;
        font-weight:900;
        margin-bottom:20px;
        color:#2c3e50;
    }

    .final-stats{
        display:flex;
        justify-content:center;
        gap:20px;
        flex-wrap:wrap;
    }

    .stat-box{
        background:#f8f9fa;
        padding:15px 25px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
    }

    .stat-box span{
        display:block;
        font-size:22px;
        font-weight:bold;
    }

    .stat-box small{
        color:#777;
    }

    .rank-badge{
        font-size:22px;
        font-weight:bold;
        margin:20px 0;
        padding:10px 20px;
        display:inline-block;
        border-radius:20px;
        background:linear-gradient(135deg,#d4fc79,#96e6a1);
    }

    .final-btn{
        display:inline-block;
        margin-top:20px;
        padding:16px 40px;
        border-radius:14px;
        background:linear-gradient(135deg,#5eae4e,#3d8f35);
        color:white;
        font-size:18px;
        font-weight:bold;
        text-decoration:none;
        box-shadow:0 6px 15px rgba(0,0,0,0.25);
        transition:0.2s;
    }

    .final-btn:hover{
        transform:scale(1.05);
    }

    @keyframes fadeIn{
        from{opacity:0; transform:translateY(20px);}
        to{opacity:1; transform:translateY(0);}
    }

    .rank-section{
        display:flex;
        flex-direction:column;
        align-items:center;
        gap:20px;
        margin-top:20px;
    }

    /* ===== MOBILE RESPONSIVE ===== */
    @media (max-width: 768px){
        body{ overflow:auto; }
        .page{
            margin:10px;
            padding:15px;
            margin-top:20px;
            margin-bottom:20px;
            border-radius:14px;
        }
        h1{ font-size:1.3rem; line-height:1.4; }
        
        .topbar{
            flex-direction:row;
            justify-content:space-between;
            gap:8px;
            align-items:center;
            padding:10px 12px;
            border-radius:30px;
            flex-wrap:nowrap;
        }
        
        .topbar .timer-wrap,
        .topbar .xp-wrap {
            font-size:0.85rem;
            padding:4px 10px;
            border-radius:30px;
            flex-shrink:0;
        }
        
        .topbar .timer-label,
        .topbar .xp-label {
            font-size:0.55rem;
            margin-right:2px;
        }
        
        .topbar .timer-wrap span,
        .topbar .xp-wrap span {
            font-size:0.85rem;
        }

        .card{ padding:16px; margin-top:15px; }
        .situation{ font-size:14px; padding:8px; }
        .choices-grid{ grid-template-columns:1fr; gap:12px; }
        .choice-box{ min-height:auto; padding:10px; }
        .choice-img{ height:130px; }
        .choice-text{ font-size:16px; }
        .choice-box input{ transform:scale(1.6); top:8px; right:8px; }
        .btn-container{ flex-direction:column; gap:10px; margin-top:20px; }
        .primary-btn, .next-btn{ width:100%; font-size:16px; padding:14px; }
        #feedback{ font-size:15px; padding:10px; }
        .final-header{ font-size:22px; }
        .final-stats{ flex-direction:column; gap:12px; align-items:stretch; }
        .stat-box{ width:100%; padding:14px; text-align:center; }
        .final-btn{ width:100%; padding:14px; font-size:16px; }
        .progress-text { font-size: 0.8rem; }
        .panuto-modal-box { padding: 20px; margin: 10px; }
        .panuto-modal-title { font-size: 1.5rem; }
    }

    @media (max-width: 400px){
        .topbar{
            padding:8px 10px;
            border-radius:20px;
        }
        .topbar .timer-wrap,
        .topbar .xp-wrap {
            font-size:0.7rem;
            padding:3px 8px;
        }
        .topbar .timer-wrap span,
        .topbar .xp-wrap span {
            font-size:0.7rem;
        }
        .topbar .timer-label,
        .topbar .xp-label {
            font-size:0.5rem;
        }
    }
</style>
@endpush

@section('content')
        <body>

        <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">
        <div class="overlay"></div>

        <div class="page">
            <h1>Matalinong Pagpapasya sa Oras ng Sakuna</h1>

            <div class="topbar">
                <div class="timer-wrap">
                    <span class="timer-label">⏱</span>
                    <span id="timer">05:00</span>
                </div>
                <div class="xp-wrap">
                    <span class="xp-label">⭐ Puntos</span>
                    <span id="xp">0</span>
                </div>
            </div>

            <!-- PROGRESS BAR -->
            <div id="progress-container">
                <div class="progress-section">
                    <div class="progress-bar-container">
                        <div class="progress-fill" id="progress-fill"></div>
                        <div class="progress-text" id="progress-text">Sitwasyon 1 / 6</div>
                    </div>
                </div>
            </div>

            <div id="game"></div>

            <p id="feedback"></p>

            <div class="btn-container">
                <button class="primary-btn" id="submitBtn" onclick="submitAnswer()">
                    🚀 Isumite ang Sagot
                </button>

                <button class="next-btn" onclick="nextScenario()" id="nextBtn" style="display:none;">
                    ▶ Susunod na Sitwasyon
                </button>
            </div>

            
        </div>

        <!-- ========== PANUTO MODAL (appears only once) ========== -->
        <div id="panutoModal" class="panuto-modal-overlay">
            <div class="panuto-modal-box">
                <div class="panuto-modal-title">
                    <span>📋</span> Panuto
                </div>
                <div class="panuto-modal-body">
                    <p>Basahin ang bawat sitwasyon at <strong>piliin ang lahat ng tamang sagot</strong> sa pamamagitan ng pag-tsek sa kahon sa itaas ng bawat opsyon.</p>
                    <ul>
                        <li>✅ <strong>+10 puntos</strong> sa bawat <strong>TAMANG sagot</strong> na napili</li>
                        <li>❌ <strong>-10 puntos</strong> sa bawat <strong>MALING sagot</strong> na napili</li>
                        <li>🏆 <strong>BONUS +10 puntos</strong> kung nasagot mo ng <strong>LAHAT ng tama</strong> sa isang sitwasyon (walang maling napili)</li>
                        <li>🔥 <strong>Streak Bonus:</strong> Patuloy na pagkuha ng perpektong iskor ay nagbibigay ng dagdag na puntos!</li>
                    </ul>
                    <div class="highlight-box">
                        💡 <strong>Tip:</strong> Piliin lamang ang mga sagot na sigurado kang tama. Ang pagpili ng maling sagot ay nakakabawas ng puntos!
                    </div>
                    <button class="panuto-modal-btn" id="startBtn">🚀 Simulan na!</button>
                </div>
            </div>
        </div>

        <script>
            // 🔥 SCENARIOS
            const scenarios = [
                {
                    title:"Scenario 1",
                    image:"/pictures/Mod2_FinalAct/scenario1.png",
                    desc:" Matapos ang malakas na ulan sa Legazpi, nagkaroon ng pagbaha dahil sa baradong kanal na puno ng basura. Alin sa mga sumusunod ang tamang hakbang?",
                    choices:[
                        {t:"Sunugin ang basura",c:false, img:"/pictures/Mod2_FinalAct/sunog_basura.png"},
                        {t:"Makilahok sa clean-up drive",c:true, img:"/pictures/Mod2_FinalAct/clean_drive.png"},
                        {t:"Itapon ang basura sa ilog",c:false, img:"/pictures/Mod2_FinalAct/tapon_ilog.png"},
                        {t:"Isagawa ang waste segregation",c:true, img:"/pictures/Mod2_FinalAct/segregation.png"},
                        {t:"Magtapon ng basura sa tamang lalagyan",c:true, img:"/pictures/Mod2_FinalAct/tamang_tapon.png"}
                    ]
                },
                {
                    title:"Scenario 2: Deforestation",
                    image:"/pictures/Mod2_FinalAct/scenario2.png",
                    desc:"Sa isang barangay sa Daraga, patuloy ang pagputol ng mga puno upang gawing sakahan.",
                    choices:[
                        {t:"Sumali sa pagputol ng puno",c:false, img:"/pictures/Mod2_FinalAct/illegal_logging.png"},
                        {t:"Magsagawa ng tree planting",c:true, img:"/pictures/Mod2_FinalAct/tree_planting.png"},
                        {t:"Magputol pa ng puno para sa kita",c:false, img:"/pictures/Mod2_FinalAct/more_cutting.png"},
                        {t:"I-report ang illegal logging",c:true, img:"/pictures/Mod2_FinalAct/report_logging.png"},
                        {t:"Sumunod sa batas pangkalikasan",c:true, img:"/pictures/Mod2_FinalAct/environment_law.png"}
                    ]
                },
                {
                    title:"Scenario 3: Climate Change",
                    image:"/pictures/Mod2_FinalAct/scenario3.png",
                    desc:"Mas lumalakas ang bagyo at tumitindi ang init sa Albay.",
                    choices:[
                        {t:"Pagtatanim ng puno",c:true, img:"/pictures/Mod2_FinalAct/tree_planting.png"},
                        {t:"Pagsusunog ng basura",c:false, img:"/pictures/Mod2_FinalAct/sunog_basura.png"},
                        {t:"Pagputol ng mga puno",c:false, img:"/pictures/Mod2_FinalAct/more_cutting.png"},
                        {t:"Paggamit ng renewable energy",c:true, img:"/pictures/Mod2_FinalAct/renewable_energy.png"},
                        {t:"Pagtitipid ng enerhiya",c:true, img:"/pictures/Mod2_FinalAct/save_energy.png"}
                    ]
                },
                {
                    title:"Scenario 4: Government Response",
                    image:"/pictures/Mod2_FinalAct/scenario4.png",
                    desc:"May babala ang PAGASA tungkol sa bagyo at posibleng pagputok ng Mayon.",
                    choices:[
                        {t:"Huwag pansinin ang babala",c:false, img:"/pictures/Mod2_FinalAct/ignore_warning.png"},
                        {t:"Makilahok sa disaster drills",c:true, img:"/pictures/Mod2_FinalAct/disaster_drill.png"},
                        {t:"Sumunod sa early warning system",c:true, img:"/pictures/Mod2_FinalAct/warning_system.png"},
                        {t:"Maghihintay na lamang",c:false, img:"/pictures/Mod2_FinalAct/waiting.png"},
                        {t:"Lumikas papunta sa evacuation center",c:true, img:"/pictures/Mod2_FinalAct/evacuation.png"}
                    ]
                },
                {
                    title:"Scenario 5: Flooding",
                    image:"/pictures/Mod2_FinalAct/scenario5.png",
                    desc:"Baradong ilog sa barangay",
                    choices:[
                        {t:"Clean-up drive",c:true, img:"/pictures/Mod2_FinalAct/clean_drive.png"},
                        {t:"Waste segregation",c:true, img:"/pictures/Mod2_FinalAct/segregation.png"},
                        {t:"Report sa barangay",c:true, img:"/pictures/Mod2_FinalAct/report_barangay.png"},
                        {t:"Itapon sa ilog",c:false, img:"/pictures/Mod2_FinalAct/tapon_ilog.png"}
                    ]
                },
                {
                    title:"Scenario 6: Air Pollution",
                    image:"/pictures/Mod2_FinalAct/scenario6.png",
                    desc:"Mausok na lugar",
                    choices:[
                        {t:"Pag gamit ng public transport",c:true, img:"/pictures/Mod2_FinalAct/public_transport.png"},
                        {t:"Tree planting",c:true, img:"/pictures/Mod2_FinalAct/tree_planting.png"},
                        {t:"Reduce burning",c:true, img:"/pictures/Mod2_FinalAct/reduce_burning.png"},
                        {t:"Mag-sunog pa",c:false, img:"/pictures/Mod2_FinalAct/sunog_basura.png"}
                    ]
                }
            ];

            /* ===============================
            🎮 GAME STATE
            ================================ */
            let xp = 0;
            let current = 0;
            let streak = 0;
            let answered = false;
            let oras = 5 * 60; // 5 minutes
            let allAnswers = [];
            let totalCorrectSelected = 0;
            let totalPossibleCorrect = 0;
            let isSaving = false;
            let timerInterval = null;
            let gameStarted = false;

            /* ===============================
            ⏱ TIMER SYSTEM
            ================================ */
            function formatTime(seconds){
                let minutes = Math.floor(seconds / 60);
                let secs = seconds % 60;
                return String(minutes).padStart(2, '0') + ":" + String(secs).padStart(2, '0');
            }

            function startTimer() {
                if (timerInterval) return;
                timerInterval = setInterval(() => {
                    oras--;
                    document.getElementById("timer").innerText = formatTime(oras);
                    if(oras <= 0){
                        clearInterval(timerInterval);
                        timerInterval = null;
                        document.getElementById("feedback").innerHTML = "⏰ Naubos na ang oras! Awtomatikong tatapusin ang aktibidad.";
                        tapusinNa();
                    }
                }, 1000);
            }

            /* ===============================
            📊 UPDATE PROGRESS BAR
            ================================ */
            function updateProgressBar() {
                let progressPercent = ((current + 1) / scenarios.length) * 100;
                let fillElement = document.getElementById("progress-fill");
                let textElement = document.getElementById("progress-text");
                fillElement.style.width = progressPercent + "%";
                textElement.innerHTML = `Sitwasyon ${current + 1} / ${scenarios.length}`;
            }

            /* ===============================
            🔀 INITIAL SETUP
            ================================ */
            scenarios.forEach(s => {
                s.choices.sort(() => Math.random() - 0.5);
                totalPossibleCorrect += s.choices.filter(c => c.c).length;
            });

            // Panuto Modal - only once
            document.getElementById('startBtn').addEventListener('click', function() {
                document.getElementById('panutoModal').classList.add('hidden');
                gameStarted = true;
                startTimer();
                loadScenario();
            });

            // If user somehow clicks outside, still require the button
            document.getElementById('panutoModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    // Do nothing - must click the button
                }
            });

            /* ===============================
            🎮 LOAD SCENARIO
            ================================ */
            function loadScenario(){
                if (!gameStarted) return;
                answered = false;
                let s = scenarios[current];
                document.getElementById("feedback").innerHTML = "";
                updateProgressBar();
                
                document.getElementById("submitBtn").style.display = "inline-block";
                document.getElementById("nextBtn").style.display = "none";

                let html = `
                    <div class="card pulse">
                        <img src="${s.image}" class="scenario-img">
                        <div class="situation">
                            ${s.desc || ""}
                        </div>
                        <div class="choices-grid">
                `;

                s.choices.forEach((c, i) => {
                    html += `
                        <label class="choice-box">
                            <input type="checkbox" data-index="${i}">
                            ${c.img ? `<img src="${c.img}" class="choice-img">` : ""}
                            <div class="choice-text">${c.t}</div>
                        </label>
                    `;
                });

                html += `</div></div>`;
                document.getElementById("game").innerHTML = html;
                document.getElementById("submitBtn").disabled = false;
            }

            /* ===============================
            ✅ SUBMIT ANSWER
            ================================ */
            function submitAnswer(){
                if(!gameStarted || answered) return;

                let anyChecked = false;
                document.querySelectorAll(".choice-box input").forEach(cb => {
                    if(cb.checked) anyChecked = true;
                });

                if(!anyChecked){
                    document.getElementById("feedback").innerHTML = "⚠️ Pumili muna ng kahit isang sagot bago isumite!";
                    return;
                }

                answered = true;
                let s = scenarios[current];
                let correct = 0;
                let wrong = 0;
                let totalCorrect = s.choices.filter(c => c.c).length;
                let scenarioAnswers = [];

                document.querySelectorAll(".choice-box").forEach((el, i) => {
                    let checkbox = el.querySelector("input");
                    let selected = checkbox.checked;
                    let isCorrect = s.choices[i].c;

                    if(selected && isCorrect){
                        el.classList.add("correct");
                        correct++;
                        totalCorrectSelected++;
                    } 
                    else if(selected && !isCorrect){
                        el.classList.add("wrong");
                        wrong++;
                        totalCorrectSelected--;
                    }

                    scenarioAnswers.push({
                        scenario_number: current + 1,
                        choice_text: s.choices[i].t,
                        selected: selected,
                        is_correct: isCorrect
                    });
                });

                allAnswers.push(...scenarioAnswers);
                
                document.getElementById("submitBtn").style.display = "none";
                document.getElementById("nextBtn").style.display = "inline-block";

                let gainedXP = correct * 10;
                if(correct === totalCorrect){
                    streak++;
                    gainedXP += 10 * streak;
                } else {
                    streak = 0;
                }

                // Deduct points for wrong answers
                let wrongPenalty = wrong * 10;
                gainedXP = gainedXP - wrongPenalty;

                xp += gainedXP;
                if (xp < 0) xp = 0;
                document.getElementById("xp").innerText = xp;

                let feedback = "";
                let ratio = totalCorrect > 0 ? correct / totalCorrect : 0;

                if(ratio === 1 && wrong === 0){
                    feedback = `🔥 PERPEKTO!<br>Kumpleto ang lahat ng tamang sagot.<br>Malaking tulong ito sa kalikasan.<br>+${gainedXP} puntos (Sunod-sunod x${streak})`;
                }
                else if(ratio >= 0.75){
                    feedback = `👍 MAAYOS!<br>Karamihan sa iyong sagot ay tama.<br>May ilang kulang ngunit maayos pa rin ang epekto.<br>+${gainedXP} puntos`;
                }
                else if(ratio >= 0.5){
                    feedback = `⚠️ KATAMTAMAN!<br>May sapat na tamang sagot ngunit may mga mali rin.<br>Maaaring magdulot ito ng problema sa kapaligiran.<br>+${gainedXP} puntos`;
                }
                else if(ratio > 0){
                    feedback = `🚨 MARAMING MALI!<br>Kakaunti lamang ang tamang sagot.<br>Malaki ang negatibong epekto sa kapaligiran.<br>+${gainedXP} puntos`;
                }
                else{
                    feedback = `💀 WALANG TAMANG SAGOT!<br>Lahat ng napili ay mali.<br>Lubhang mapanganib ang epekto nito sa kapaligiran.<br>+${gainedXP} puntos`;
                }

                document.getElementById("feedback").innerHTML = feedback;
            }

            /* ===============================
            💾 SAVE FINAL ACTIVITY
            ================================ */
            function saveFinalActivity() {
                return fetch("{{ route('student.module2.final.save') }}", {
                    method: "POST",
                    credentials: "same-origin", 
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json" 
                    },
                    body: JSON.stringify({
                        total_xp: xp,
                        score: xp,
                        total_questions: scenarios.length,
                        correct_answers: totalCorrectSelected,
                        time_taken: (5 * 60) - oras,
                        answers: allAnswers
                    })
                });
            }

            function tapusinNa(){
                current = scenarios.length - 1;
                nextScenario();
            }

            /* ===============================
            ▶ NEXT SCENARIO
            ================================ */
            function nextScenario(){
                if(!answered){
                    document.getElementById("feedback").innerHTML = "⚠️ Isumite muna ang iyong sagot bago magpatuloy!";
                    return;
                }

                current++;

                if(current >= scenarios.length){
                    if (isSaving) return;
                    isSaving = true;
                    if (timerInterval) {
                        clearInterval(timerInterval);
                        timerInterval = null;
                    }
                    
                    document.getElementById("progress-container").style.display = "none";
                    document.querySelector(".btn-container").style.display = "none";
                    document.getElementById("feedback").innerHTML = "";

                    let rank = "";
                    if(xp >= 250) rank = "🏆 ECO MASTER";
                    else if(xp >= 150) rank = "🌿 ECO WARRIOR";
                    else rank = "🌱 ECO LEARNER";

                    let nagamitNaOras = (5 * 60) - oras;
                    let finalTime = formatTime(nagamitNaOras);
                    let percentage = Math.round((totalCorrectSelected / totalPossibleCorrect) * 100);
                    let passed = percentage >= 75;

                    saveFinalActivity()
                        .then(async response => {
                            let text = await response.text();
                            if (!response.ok) throw new Error("HTTP " + response.status);
                            return JSON.parse(text);
                        })
                        .then(data => {
                            document.getElementById("game").innerHTML = `
                                <div class="final-card">
                                    <div class="final-header">${passed ? "🎉 NAKAPASA KA!" : "❌ HINDI KA NAKAPASA"}</div>
                                    <div class="final-stats">
                                        <div class="stat-box">📊 <span>${percentage}%</span><small>Iskor</small></div>
                                        <div class="stat-box">⏱ <span>${finalTime}</span><small>Oras</small></div>
                                        <div class="stat-box">⭐ <span>${xp}</span><small>Kabuuang Puntos</small></div>
                                    </div>
                                    <div class="rank-section">
                                        <div class="rank-badge">${rank}</div>
                                        ${passed ? `<a href="{{ route('module2.posttest') }}" class="final-btn">📝 Sagutin ang Panghuling Pagsusulit</a>` : `<button class="final-btn" onclick="location.reload()">🔄 Ulitin ang Aktibidad</button>`}
                                    </div>
                                </div>
                            `;
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            document.getElementById("game").innerHTML = `
                                <div class="final-card">
                                    <div class="final-header">🎉 MISSION COMPLETE!</div>
                                    <div class="final-stats">
                                        <div class="stat-box">⏱ <span>${finalTime}</span><small>Time</small></div>
                                        <div class="stat-box">⭐ <span>${xp}</span><small>Total XP</small></div>
                                    </div>
                                    <div class="rank-section">
                                        <div class="rank-badge">${rank}</div>
                                        <p style="color:red;">Hindi na-save ang resulta.</p>
                                        <a href="{{ route('module2.posttest') }}" class="final-btn">📝 Take Post Test</a>
                                    </div>
                                </div>
                            `;
                        });
                    return;
                }

                loadScenario();
            }
        </script>
@endsection