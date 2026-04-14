<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Final Activity - Module 2</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&family=Baloo+2:wght@700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

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

    background:white;            /* 🔥 ADD THIS */
    border-radius:18px;          /* 🔥 OPTIONAL */
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
    pointer-events:none; /* 🔥 IMPORTANT */
}

h1{
    margin-top:5px;
    text-align:center;
    font-family:'Baloo 2';
    color:#214f33;
}

.card{
    background:rgba(255,255,255,0.92);
    border-radius:16px;
    padding:25px;
    margin-top:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
    backdrop-filter: blur(6px);
}

.choice{
    border:1px solid #ccc;
    padding:12px;
    border-radius:10px;
    margin:10px 0;
    cursor:pointer;
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

/* BIGGER PRIMARY BUTTON */
.primary-btn{
    font-size:18px;
    padding:16px 40px;
    border-radius:14px;

    background:linear-gradient(135deg,#5eae4e,#3d8f35);
    box-shadow:0 6px 15px rgba(0,0,0,0.25);

    transition:all 0.2s ease;
}

/* HOVER EFFECT */
.primary-btn:hover{
    transform:scale(1.05);
    box-shadow:0 8px 18px rgba(0,0,0,0.3);
}

/* CLICK EFFECT */
.primary-btn:active{
    transform:scale(0.97);
}

.next-btn{
    font-size:18px;
    padding:16px 40px;
    border-radius:14px;

    background:linear-gradient(135deg,#3498db,#21618c);
    box-shadow:0 6px 15px rgba(0,0,0,0.25);

    margin-left:10px;

    transition:all 0.2s ease;
}

.next-btn:hover{
    transform:scale(1.05);
    box-shadow:0 8px 18px rgba(0,0,0,0.3);
}

.next-btn:active{
    transform:scale(0.97);
}

.btn{
    padding:12px 20px;
    border:none;
    border-radius:10px;
    background:#5eae4e;
    color:white;
    font-weight:bold;
    cursor:pointer;
    margin-top:15px;
}

.progress{
    text-align:center;
    margin-top:10px;
}

.scenario-img{
    width:100%;
    border-radius:12px;
    margin-bottom:10px;
}

.situation{
    background:#ffe08a;
    padding:10px;
    border-radius:10px;
    margin-bottom:10px;
    font-weight:bold;
}

.question{
    background:#1e3a5f;
    color:white;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
    font-weight:bold;
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
    height:150px;            /* 🔥 smaller + controlled */
    object-fit:cover;        /* 🔥 fills nicely */
    border-radius:10px;
    background:#eee;
}

.choice-text{
    margin-top:3px;
    font-weight:bold;
    text-align:center;
    font-size:20px;
}

/* CHECKBOX FIX (top-right clean) */
.choice-box input{
    position:absolute;
    top:10px;
    right:10px;
    transform:scale(1.8); /* 🔥 bigger */
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
    margin-bottom:10px;
}

.topbar span{
    background:#f1f3f5;
    padding:6px 12px;
    border-radius:10px;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
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
    margin-bottom:25px;
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

.rank-img{
    width:140px;
    border-radius:20px;
    background:linear-gradient(135deg,#b8f1a1,#7ed957);
    padding:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

</style>
</head>
        <body>

        <img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">
        <div class="overlay"></div>

        <div class="page">
            <h1>🎮 Environmental Decision Game</h1>

            <div class="topbar">
                <div>⏱ Timer: <span id="timer">00:00</span></div>
                <div>⭐ XP: <span id="xp">0</span></div>
            </div>

            <div class="progress">
                Scenario <span id="current">1</span> / 6
            </div>

            <div id="game"></div>

            <div class="btn-container">
                <button class="btn primary-btn" onclick="submitAnswer()">
                    🚀 Submit Answer
                </button>

                <button class="btn next-btn" onclick="nextScenario()" id="nextBtn" style="display:none;">
                    ▶ Next Scenario
                </button>
            </div>

            <p id="feedback"></p>
        </div>

        <script>
            // 🔥 SCENARIOS
            const scenarios = [
                {
                    title:"Scenario 1",
                    image:"/pictures/Mod2_FinalAct/scenario1.png",
                    desc:"Matapos ang malakas na ulan sa Legazpi, nagkaroon ng pagbaha dahil sa baradong kanal na puno ng basura.",
                    question:"Alin sa mga sumusunod ang tamang hakbang?",
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
                    question:"Ano ang tamang hakbang?",
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
                    question:"Alin ang makakatulong?",
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
                    question:"Ano ang dapat gawin?",
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
                    question:"Ano ang tamang gawin?",
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
                    question:"Ano ang solusyon?",
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
            let time = 0;
            let allAnswers = [];
            let totalCorrectSelected = 0;
            let isSaving = false;

            /* ===============================
            ⏱ TIMER SYSTEM
            ================================ */
            function formatTime(seconds){
                let minutes = Math.floor(seconds / 60);
                let secs = seconds % 60;

                return String(minutes).padStart(2, '0') + ":" + String(secs).padStart(2, '0');
            }

            let timerInterval = setInterval(() => {
                time++;
                document.getElementById("timer").innerText = formatTime(time);
            }, 1000);

            /* ===============================
            🔀 INITIAL SETUP
            ================================ */
            scenarios.forEach(s => {
                s.choices.sort(() => Math.random() - 0.5);
            });

            loadScenario();

            /* ===============================
            🎮 LOAD SCENARIO
            ================================ */
            function loadScenario(){
                answered = false;

                let s = scenarios[current];

                document.getElementById("current").innerText = current + 1;
                document.getElementById("feedback").innerHTML = "";

                let html = `
                    <div class="card pulse">
                        <img src="${s.image}" class="scenario-img">

                        <div class="situation">
                            🌍 ${s.desc || ""}
                        </div>

                        <div class="question">
                            ❓ ${s.question}
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
                document.querySelector(".primary-btn").disabled = false;
            }

            /* ===============================
            ✅ SUBMIT ANSWER
            ================================ */
            function submitAnswer(){
                if(answered) return;
                answered = true;

                let s = scenarios[current];
                let correct = 0;
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
                    } else if(selected && !isCorrect){
                        el.classList.add("wrong");
                    }

                    scenarioAnswers.push({
                        scenario_number: current + 1,
                        choice_text: s.choices[i].t,
                        selected: selected,
                        is_correct: isCorrect
                    });
                });

                allAnswers.push(...scenarioAnswers);

                document.querySelector(".primary-btn").disabled = true;

                let gainedXP = correct * 10;

                if(correct === totalCorrect){
                    streak++;
                    gainedXP += 10 * streak;
                } else {
                    streak = 0;
                }

                xp += gainedXP;
                document.getElementById("xp").innerText = xp;

                let feedback = "";
                let ratio = totalCorrect > 0 ? (correct / totalCorrect) : 0;

                if(ratio === 1){
                    feedback = `🔥 PERFECT! Kumpleto ang tamang sagot — nakatulong ka talaga sa kalikasan! +${gainedXP} XP (Streak x${streak})`;
                }
                else if(ratio >= 0.75){
                    feedback = `👍 HALOS TAMANG-TAMA! May ilang pagkukulang — maaaring may maliit na epekto sa kapaligiran.<br>+${gainedXP} XP`;
                }
                else if(ratio >= 0.5){
                    feedback = `⚠️ KATAMTAMAN! May ilang maling desisyon na maaaring magdulot ng problema sa kapaligiran.<br>+${gainedXP} XP`;
                }
                else if(ratio > 0){
                    feedback = `🚨 MARAMING MALI! Malaki ang posibleng epekto ng iyong mga desisyon sa kalikasan.<br>+${gainedXP} XP`;
                }
                else{
                    feedback = `💀 WALANG TAMANG SAGOT! Maaaring lumala nang husto ang sitwasyon sa kapaligiran.<br>+${gainedXP} XP`;
                }

                document.getElementById("feedback").innerHTML = feedback;
                document.getElementById("nextBtn").style.display = "inline-block";
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
                        time_taken: time,
                        answers: allAnswers
                    })
                });
            }

            /* ===============================
            ▶ NEXT SCENARIO
            ================================ */
            function nextScenario(){
                current++;

                if(current >= scenarios.length){

                    if (isSaving) return;
                    isSaving = true;

                    clearInterval(timerInterval);

                    document.querySelector(".btn-container").style.display = "none";
                    document.getElementById("nextBtn").style.display = "none";
                    document.getElementById("feedback").innerHTML = "";

                    let rank = "";
                    if(xp >= 250) rank = "🏆 ECO MASTER";
                    else if(xp >= 150) rank = "🌿 ECO WARRIOR";
                    else rank = "🌱 ECO LEARNER";

                    let finalTime = formatTime(time);

                    saveFinalActivity()
                        .then(async response => {
                            let text = await response.text();

                            console.log("RAW RESPONSE:", text);

                            if (!response.ok) {
                                throw new Error("HTTP " + response.status + " → " + text);
                            }

                            return JSON.parse(text);
                        })
                        .then(data => {
                            document.getElementById("game").innerHTML = `
                                <div class="final-card">
                                    <div class="final-header">
                                        🎉 MISSION COMPLETE!
                                    </div>

                                    <div class="final-stats">
                                        <div class="stat-box">
                                            ⏱ <span>${finalTime}</span>
                                            <small>Time</small>
                                        </div>

                                        <div class="stat-box">
                                            ⭐ <span>${xp}</span>
                                            <small>Total XP</small>
                                        </div>
                                    </div>

                                    <div class="rank-section">
                                        <div class="rank-badge">
                                            ${rank}
                                        </div>

                                        <a href="{{ route('module2.posttest') }}" class="final-btn">
                                            📝 Take Post Test
                                        </a>
                                    </div>
                                </div>
                            `;
                        })
                        .catch(error => {
                            console.error("Error saving final activity:", error);

                            document.getElementById("game").innerHTML = `
                                <div class="final-card">
                                    <div class="final-header">
                                        🎉 MISSION COMPLETE!
                                    </div>

                                    <div class="final-stats">
                                        <div class="stat-box">
                                            ⏱ <span>${finalTime}</span>
                                            <small>Time</small>
                                        </div>

                                        <div class="stat-box">
                                            ⭐ <span>${xp}</span>
                                            <small>Total XP</small>
                                        </div>
                                    </div>

                                    <div class="rank-section">
                                        <div class="rank-badge">
                                            ${rank}
                                        </div>

                                        <p style="color:red; margin: 15px 0;">
                                            Failed to save activity result.
                                        </p>

                                        <a href="{{ route('module2.posttest') }}" class="final-btn">
                                            📝 Take Post Test
                                        </a>
                                    </div>
                                </div>
                            `;
                        });

                    return;
                }

                document.getElementById("nextBtn").style.display = "none";
                loadScenario();
            }
        </script>
    </body>
</html>