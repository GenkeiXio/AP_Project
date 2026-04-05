@extends('Students.studentslayout')
@section('title', 'Module 3 - Node 2')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #dff3e3, #ffe9b5);
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.title {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
}

.subtitle {
    text-align: center;
    margin-bottom: 25px;
    color: #555;
}

/* CARDS */
.choice-container {
    display: flex;
    gap: 25px;
    margin-top: 25px;
}

.choice-card {
    flex: 1;
    background: #f4fbf6;
    border-radius: 20px;
    padding: 25px;
    cursor: pointer;
    border: 2px solid #cce3d1;
    transition: all 0.25s ease;
}

.choice-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    border-color: #27ae60;
}

.choice-card.active {
    border-color: #2ecc71;
    background: #eafff1;
}

.hidden-text {
    display: none;
    margin-top: 15px;
    line-height: 1.6;
}

/* CHOOSE */
.choose-section {
    display: none;
    text-align: center;
    margin-top: 35px;
}

/* BUTTONS */
.game-btn {
    padding: 12px 22px;
    border-radius: 12px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    margin: 10px;
    font-size: 16px;
    transition: 0.2s;
    background: #34495e;
    color: white;
}

.game-btn:hover {
    transform: scale(1.05);
}

/* RESULT */
.result {
    margin-top: 25px;
    padding: 20px;
    border-radius: 14px;
    display: none;
    animation: fadeIn 0.4s ease;
}

.correct { background: #ecfff3; border: 2px solid #2ecc71; }
.wrong { background: #fff2f2; border: 2px solid #e74c3c; }

@keyframes fadeIn {
    from {opacity:0; transform:translateY(10px);}
    to {opacity:1; transform:translateY(0);}
}

/* MODAL */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: none;
    align-items: center;
    justify-content: center;
}

.modal-box {
    background: white;
    padding: 25px;
    border-radius: 18px;
    text-align: center;
    animation: pop 0.4s ease;
}

@keyframes pop {
    from { transform: scale(0.7); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.modal-btn {
    margin-top: 15px;
    padding: 10px 18px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-weight: 600;
}

.btn-next { background: #2ecc71; color: white; }
.btn-close { background: #e74c3c; color: white; }

/* CONFETTI */
.confetti-piece {
    position: absolute;
    width: 8px;
    height: 14px;
    animation: fall 1.5s linear forwards;
}

@keyframes fall {
    to {
        transform: translateY(300px) rotate(360deg);
        opacity: 0;
    }
}
</style>

<div class="wrapper">
<div class="card">

<div class="title">🟦 APPROACHES → DEBATE GAME</div>

<div class="subtitle">
Guiding Question:<br>
Paano nakaaapekto ang hazard, vulnerability, at risk sa pagkakaroon ng disaster?
</div>

<div style="text-align:center; margin-bottom:15px;">
👉 Ikaw ay Mayor. Pili ka ng approach.
</div>

<!-- CARDS -->
<div class="choice-container">

<div class="choice-card" onclick="reveal(event, 'top')">
    <h3>🔥 Top-down</h3>
    <div id="topText" class="hidden-text">
        <p>
            Ang sistemang ito ay nakatuon sa pag-asa ng mga komunidad sa mas mataas na antas ng pamahalaan (pambayan, panlungsod, o pambansa) sa lahat ng aspeto ng disaster management, mula pagpaplano hanggang pagtugon.
        </p> 
        <br>
        <p>
            Gayunpaman, madalas itong nababatikos dahil nagiging mabagal ang aksyon at hindi agad natutugunan ang pangangailangan ng mga mamamayan, lalo na ang mga pinakaapektado. Karaniwan ding limitado ang mga plano dahil nakabatay lamang sa pananaw ng mga namumuno, habang napapabayaan ang karanasan at boses ng komunidad.
        </p>
        <br>
        <p>
            Bukod dito, ang hindi pagkakasundo ng pambansa at lokal na pamahalaan ay nagiging sanhi ng pagkaantala sa epektibong pagtugon sa kalamidad.
        </p>
    </div>
</div>

<div class="choice-card" onclick="reveal(event, 'bottom')">
    <h3>🌱 Bottom-up</h3>
    <div id="bottomText" class="hidden-text">
        <p>
            Ang bottom-up approach sa pagtugon sa mga suliraning pangkapaligiran ay nakatuon sa aktibong partisipasyon ng mga mamamayan at iba’t ibang sektor ng pamayanan sa pagtukoy, pag-aanalisa, at paglutas ng mga problema. 
        </p>
        <br>
        <p>
            Mahalaga ang pamumuno ng lokal na komunidad, kasama ang lokal na pamahalaan, pribadong sektor, at mga NGO, upang maisulong ang epektibong grassroots development. Sa paraang ito, nabibigyang-halaga ang iba’t ibang pananaw at karanasan ng mga taong nakatira sa disaster-prone areas, na nagsisilbing batayan ng mas angkop at makabuluhang plano. 
        </p>
        <br>
        <p>
            Nakatutulong din ang maayos na pamamahala ng pondo at pagkilala sa matagumpay na implementasyon upang mapanatili ang bisa ng programa, kung saan ang tagumpay ay nakasalalay sa malawakang pakikilahok ng komunidad sa pagpaplano at pagdedesisyon.
        </p>
    </div>
</div>

</div>

<!-- CHOOSE -->
<div class="choose-section" id="chooseSection">
    <h3>👉 Piliin ang Approach</h3>

    <button onclick="choose('top')" class="game-btn btn-top">🔥 Top-down</button>
    <button onclick="choose('bottom')" class="game-btn btn-bottom">🌱 Bottom-up</button>
</div>

<!-- RESULT -->
<div id="resultBox" class="result"></div>

</div>
</div>

<!-- MODALS -->

<div id="wrongModal" class="modal-overlay">
    <div class="modal-box">
        <h3>❌ Oops!</h3>
        <p>Insert generated message</p>
        <button class="modal-btn btn-close" onclick="closeModal('wrongModal')">Subukan muli</button>
    </div>
</div>

<div id="successModal" class="modal-overlay">
    <div class="modal-box">
        <h3>🎉 Congrats Mayor!</h3>
        <p>Natutunan mo ang tamang approach!</p>
        <button class="modal-btn btn-next">Magpatuloy ➡</button>
    </div>
</div>

<div id="confettiLayer"></div>

<script>
let viewed = { top: false, bottom: false };

function reveal(e, type) {
    document.getElementById(type + 'Text').style.display = 'block';
    viewed[type] = true;

    document.querySelectorAll('.choice-card').forEach(card => {
        card.classList.remove('active');
    });

    e.currentTarget.classList.add('active');

    if (viewed.top && viewed.bottom) {
        document.getElementById('chooseSection').style.display = 'block';
    }
}

function choose(type) {

    // STEP 1: Show what user picked (modal first)
    alert("Pinili mo: " + (type === 'top' ? "Top-down" : "Bottom-up"));

    const resultBox = document.getElementById('resultBox');
    resultBox.style.display = 'block';

    // STEP 2: Show BOTH approaches (comparison mode)
    resultBox.className = "result";

    resultBox.innerHTML = `
    <h3 style="text-align:center;">📊 Paghahambing ng Approaches</h3>

    <div style="margin-top:15px;">

        <div style="background:#fff2f2; border:2px solid #e74c3c; padding:15px; border-radius:10px; margin-bottom:10px;">
            <b>❌ Top-down:</b>
            <ul>
                <li>Hindi narinig ang komunidad kaya hindi tugma ang plano sa kanilang tunay na pangangailangan.</li>
                <li>Mabagal ang pagtugon dahil nakaasa sa desisyon ng mas mataas na pamahalaan.</li>
                <li>Kulang sa partisipasyon ng mamamayan kaya mahina ang implementasyon.</li>
                <li>Mas mataas ang pinsala dahil hindi handa ang komunidad.</li>
            </ul>
        </div>

        <div style="background:#ecfff3; border:2px solid #2ecc71; padding:15px; border-radius:10px;">
            <b>✅ Bottom-up:</b>
            <ul>
                <li>Mas naging epektibo ang plano dahil nakabatay sa karanasan ng komunidad.</li>
                <li>Mabilis ang pagtugon dahil aktibo ang mga mamamayan.</li>
                <li>Mas mataas ang partisipasyon kaya mas maayos ang implementasyon.</li>
                <liMas nababawasan ang pinsala dahil handa at may kaalaman ang komunidad. </li>
            </ul>
        </div>

    </div>

    <div style="text-align:center; margin-top:20px;">
        <button onclick="finalStep('${type}')" class="modal-btn btn-next">
            Magpatuloy ➡
        </button>
    </div>
    `;
}


function showWrong() {
    document.getElementById('wrongModal').style.display = 'flex';
}

function showSuccess() {
    burstConfetti();
    document.getElementById('successModal').style.display = 'flex';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

function finalStep(type) {

    if (type === 'bottom') {
        // ✅ correct
        burstConfetti();
        document.getElementById('successModal').style.display = 'flex';
    } else {
        // ❌ wrong
        document.getElementById('wrongModal').style.display = 'flex';
    }
}

function burstConfetti() {
    const layer = document.getElementById('confettiLayer');
    layer.innerHTML = '';

    const colors = ['#2ecc71','#3498db','#f1c40f','#e74c3c'];

    for (let i = 0; i < 25; i++) {
        const piece = document.createElement('span');
        piece.className = 'confetti-piece';
        piece.style.left = Math.random() * 100 + '%';
        piece.style.background = colors[Math.floor(Math.random() * colors.length)];
        piece.style.top = '-10px';
        layer.appendChild(piece);
    }
}
</script>

@endsection