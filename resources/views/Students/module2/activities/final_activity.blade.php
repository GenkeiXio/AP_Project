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

.choice.correct{ background:#c8f7c5; }
.choice.wrong{ background:#ffc9c9; }

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
    gap:12px;
}

.choice-box{
    border:2px solid #ccc;
    border-radius:12px;
    padding:8px;
    background:white;
}

.choice-img{
    width:100%;
    border-radius:8px;
}

.choice-text{
    margin-top:5px;
    font-weight:bold;
    text-align:center;
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
image:"/pictures/scenario1.png",
desc:"Matapos ang malakas na ulan sa Legazpi, nagkaroon ng pagbaha dahil sa baradong kanal na puno ng basura.",
question:"Alin sa mga sumusunod ang tamang hakbang?",
choices:[
{t:"Sunugin ang basura",c:false},
{t:"Makilahok sa clean-up drive",c:true},
{t:"Itapon ang basura sa ilog",c:false},
{t:"Isagawa ang waste segregation",c:true},
{t:"Magtapon ng basura sa tamang lalagyan",c:true}
]
},

{
title:"Scenario 2: Deforestation",
image:"/pictures/scenario2.png",
desc:"Sa isang barangay sa Daraga, patuloy ang pagputol ng mga puno upang gawing sakahan.",
question:"Ano ang tamang hakbang?",
choices:[
{t:"Sumali sa pagputol ng puno",c:false},
{t:"Magsagawa ng tree planting",c:true},
{t:"Magputol pa ng puno para sa kita",c:false},
{t:"I-report ang illegal logging",c:true},
{t:"Sumunod sa batas pangkalikasan",c:true}
]
},

{
title:"Scenario 3: Climate Change",
image:"/pictures/scenario3.png",
desc:"Mas lumalakas ang bagyo at tumitindi ang init sa Albay.",
question:"Alin ang makakatulong?",
choices:[
{t:"Pagtatanim ng puno",c:true},
{t:"Pagsusunog ng basura",c:false},
{t:"Pagputol ng mga puno",c:false},
{t:"Paggamit ng renewable energy",c:true},
{t:"Pagtitipid ng enerhiya",c:true}
]
},

{
title:"Scenario 4: Government Response",
image:"/pictures/scenario4.png",
desc:"May babala ang PAGASA tungkol sa bagyo at posibleng pagputok ng Mayon.",
question:"Ano ang dapat gawin?",
choices:[
{t:"Huwag pansinin ang babala",c:false},
{t:"Makilahok sa disaster drills",c:true},
{t:"Sumunod sa early warning system",c:true},
{t:"Maghihintay na lamang",c:false},
{t:"Lumikas sa evacuation center",c:true}
]
},

{
title:"Scenario 5: Flooding",
image:"/pictures/scenario5.png",
desc:"Baradong ilog sa barangay",
question:"Ano ang tamang gawin?",
choices:[
{t:"Clean-up drive",c:true},
{t:"Waste segregation",c:true},
{t:"Report sa barangay",c:true},
{t:"Itapon sa ilog",c:false}
]
},

{
title:"Scenario 6: Air Pollution",
image:"/pictures/scenario6.png",
desc:" Mausok na lugar",
question:"Ano ang solusyon?",
choices:[
{t:"Public transport",c:true},
{t:"Tree planting",c:true},
{t:"Reduce burning",c:true},
{t:"Mag-sunog pa",c:false}
]
},

{
title:"Scenario 7: Volcanic Eruption",
image:"/pictures/scenario7.png",
question:"Ano ang dapat gawin?",
choices:[
{t:"Follow evacuation",c:true},
{t:"Prepare go bag",c:true},
{t:"Ignore warnings",c:false},
{t:"Listen to alerts",c:true}
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

    s.choices.forEach((c,i)=>{
        html += `
        <div class="choice">
            <label>
                <input type="checkbox" data-index="${i}">
                ${c.t}
            </label>
        </div>`;
    });

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

document.querySelectorAll(".choice").forEach((el,i)=>{
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