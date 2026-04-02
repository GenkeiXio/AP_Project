<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Final Activity - Module 2</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&family=Baloo+2:wght@700&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Nunito',sans-serif;
    background:linear-gradient(180deg,#eefaf1,#fff4d9);
}

.page{
    max-width:900px;
    margin:auto;
    padding:20px;
}

h1{
    text-align:center;
    font-family:'Baloo 2';
    color:#214f33;
}

.card{
    background:white;
    border-radius:16px;
    padding:20px;
    margin-top:20px;
    box-shadow:0 6px 12px rgba(0,0,0,0.1);
}

.choice{
    border:1px solid #ccc;
    padding:12px;
    border-radius:10px;
    margin:10px 0;
    cursor:pointer;
}

/* .choice.correct{ background:#c8f7c5; }
.choice.wrong{ background:#ffc9c9; } */

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

.topbar{
    display:flex;
    justify-content:space-between;
    font-weight:bold;
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
    padding:10px;
    background:white;

    display:flex;
    flex-direction:column;
    align-items:center;

    min-height:200px;
    position:relative;
}

.choice-box:hover{
    transform:scale(1.03);
    box-shadow:0 6px 12px rgba(0,0,0,0.15);
}

.choice-box.correct{
    background:#c8f7c5;
    border-color:#2ecc71;
}

.choice-box.wrong{
    background:#ffc9c9;
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
</style>
</head>

<body>

<div class="page">

<h1>🎮 Environmental Decision Game</h1>

<div class="topbar">
    ⏱ Timer: <span id="timer">0</span>s
    ⭐ XP: <span id="xp">0</span>
</div>

<div class="progress">
    Scenario <span id="current">1</span> / 7
</div>

<div id="game"></div>

<button class="btn" onclick="submitAnswer()">Submit</button>
<button class="btn" onclick="nextScenario()" id="nextBtn" style="display:none;">Next ▶</button>

<p id="feedback"></p>

</div>

<script>

// ⏱ TIMER
let time = 0;
setInterval(()=>{
    time++;
    document.getElementById("timer").innerText = time;
},1000);

let xp = 0;
let current = 0;

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
    {t:"Lumikas sa evacuation center",c:true, img:"/pictures/Mod2_FinalAct/evacuation.png"}
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
    {t:"Public transport",c:true, img:"/pictures/Mod2_FinalAct/public_transport.png"},
    {t:"Tree planting",c:true, img:"/pictures/Mod2_FinalAct/tree_planting.png"},
    {t:"Reduce burning",c:true, img:"/pictures/Mod2_FinalAct/reduce_burning.png"},
    {t:"Mag-sunog pa",c:false, img:"/pictures/Mod2_FinalAct/sunog_basura.png"}
    ]
    },

    {
    title:"Scenario 7: Volcanic Eruption",
    image:"/pictures/Mod2_FinalAct/scenario7.png",
    question:"Ano ang dapat gawin?",
    choices:[
    {t:"Follow evacuation",c:true, img:"/pictures/Mod2_FinalAct/evacuation.png"},
    {t:"Prepare go bag",c:true, img:"/pictures/Mod2_FinalAct/go_bag.png"},
    {t:"Ignore warnings",c:false, img:"/pictures/Mod2_FinalAct/ignore_warning.png"},
    {t:"Listen to alerts",c:true, img:"/pictures/Mod2_FinalAct/alerts.png"}
    ]
    }

];

// 🔀 RANDOMIZE
scenarios.forEach(s=>{
    s.choices.sort(()=>Math.random()-0.5);
});

// 🎮 LOAD SCENARIO
function loadScenario(){
    let s = scenarios[current];
    document.getElementById("current").innerText = current+1;

    let html = `
    <div class="card">

        <!-- 🖼 SCENARIO IMAGE -->
        <img src="${s.image}" class="scenario-img">

        <!-- 📝 SITUATION -->
        <div class="situation">
            <strong>Sitwasyon:</strong> ${s.desc || ""}
        </div>

        <!-- ❓ QUESTION -->
        <div class="question">
            ❓ ${s.question}
        </div>

        <!-- 🧩 CHOICES -->
        <div>
    `;

    html += `<div class="choices-grid">`;

    s.choices.forEach((c,i)=>{
        html += `
        <label class="choice-box">
            <input type="checkbox" data-index="${i}" style="margin-bottom:5px;">

            ${c.img ? `<img src="${c.img}" class="choice-img">` : ""}

            <div class="choice-text">${c.t}</div>
        </label>
        `;
    });

    html += `</div>`;

    html += `
        </div>
    </div>`;

    document.getElementById("game").innerHTML = html;
}

loadScenario();

// ✅ SUBMIT ONE SCENARIO
function submitAnswer(){

let s = scenarios[current];
let correct = 0;

document.querySelectorAll(".choice-box").forEach((el,i)=>{
    let checkbox = el.querySelector("input");

    if(checkbox.checked && s.choices[i].c){
        el.classList.add("correct");
        correct++;
        xp += 10;
    }
    else if(checkbox.checked && !s.choices[i].c){
        el.classList.add("wrong");
    }
});

document.getElementById("xp").innerText = xp;
document.getElementById("feedback").innerText = `Score: ${correct}`;

document.getElementById("nextBtn").style.display="inline-block";
}

// ▶ NEXT
function nextScenario(){

current++;

if(current >= scenarios.length){
    document.getElementById("game").innerHTML =
    `<h2>🎉 Tapos na!</h2>
    <p>XP: ${xp}</p>`;
    document.getElementById("nextBtn").style.display="none";
    return;
}

document.getElementById("feedback").innerText="";
document.getElementById("nextBtn").style.display="none";

loadScenario();
}

</script>

</body>
</html>