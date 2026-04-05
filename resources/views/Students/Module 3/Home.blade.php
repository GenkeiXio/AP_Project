<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Module 3 Home</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<style>
/* ===== BACKGROUND (KEEP DESIGN) ===== */
body {
    font-family: 'Nunito', sans-serif;
    background: linear-gradient(135deg, #d4edaa 0%, #f5e8c0 50%, #fde3a3 100%);
    margin:0;
    color:#3d2a1a;
}

/* PAGE WRAPPER (same feel as layout) */
.page-content{
    max-width:1060px;
    margin:auto;
    padding:40px 20px;
}

/* ===== MODULE DESIGN ===== */
:root{
    --green:#1f7a47;
    --soft:#f4fff6;
}

/* WRAP */
.m3-wrap{
    width:100%;
}

/* HERO */
.m3-hero{
    background:#fff;
    border-radius:20px;
    padding:30px 28px;
    border:1px solid #d7e9d8;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    max-width:900px;
    margin:0 auto;
}

.m3-title{
    font-size:clamp(1.5rem,2.5vw,2rem);
    font-weight:900;
    color:#1f3b2a;
}

.m3-sub{
    margin-top:8px;
    color:#4e7a61;
    font-size:0.95rem;
}

/* BUTTONS */
.m3-actions{
    margin-top:18px;
}

.m3-btn{
    padding:10px 16px;
    border-radius:12px;
    font-weight:800;
    border:none;
    cursor:pointer;
    transition:.2s;
}

.m3-btn:hover{ transform:translateY(-2px); }

.m3-primary{
    background:linear-gradient(#7fd46a,#59ab44);
}

.m3-ghost{
    background:#eef8ef;
}

/* POLL */
.m3-poll{
    display:none;
    margin-top:20px;
    background:#fff;
    padding:20px;
    border-radius:18px;
    border:1px solid #dcecdf;
    max-width:900px;
    margin-left:auto;
    margin-right:auto;
}

/* GOALS FIX */
.m3-goal{
    margin-top:16px;
    padding:14px;
    border-radius:12px;
    background:#f4fff6;
    border:1px solid #dcecdf;
}

.m3-goal h4{
    margin-bottom:6px;
    color:#1f7a47;
    font-size:0.95rem;
}

.m3-goal p{
    font-size:0.9rem;
    line-height:1.5;
}

/* COMPETENCY FIX */
.m3-competency{
    padding:10px 12px;
    border-radius:10px;
    margin-top:8px;
    background:#ffffff;
    border:1px solid #e3efe6;
    font-size:0.9rem;
    transition:.2s;
}

.m3-competency:hover{
    background:#eaffea;
    border-color:#1f7a47;
}

/* CHOICES */
.m3-choice{
    padding:14px;
    border-radius:14px;
    border:1px solid #d7e7da;
    margin-bottom:10px;
    cursor:pointer;
}

.m3-choice.active{
    border-color:var(--green);
    background:#eaffea;
    font-weight:800;
}

/* MODAL */
.m3-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    display:none;
    justify-content:center;
    align-items:center;
}

.m3-modal.show{ display:flex; }

.m3-modal-card{
    background:#fff;
    border-radius:16px;
    padding:20px;
    max-width:800px;
    width:95%;
    max-height:85vh;
    overflow-y:auto;
}

.m3-modal-card h3{
    margin-bottom:10px;
}

.back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 100;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #1a1a1a;
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        transition: transform 0.2s;
    }
</style>
</head>

<body>

<a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>

<div class="page-content">
<div class="m3-wrap">

<!-- HERO -->
<div class="m3-hero">
    <h1 class="m3-title">
        🌱 Paghahandang Nararapat Gawin sa Harap ng Panganib na Dulot ng Suliraning Pangkapaligiran
    </h1>

    <p class="m3-sub">
        Tuklasin ang mga wastong paghahanda upang maging ligtas at handa sa panahon ng kalamidad.
    </p>

    <div class="m3-actions">
        <button class="m3-btn m3-ghost" id="openGoals">📘 Mga Layunin</button>
    </div>
</div>

<!-- POLL -->
<div class="m3-poll" id="pollSection">

<p><b>👉 Ano ang pinakamahalagang paghahanda?</b></p>

<div class="m3-choice">🧰 Paghahanda ng emergency kit</div>
<div class="m3-choice">📢 Pakikinig sa balita at babala</div>
<div class="m3-choice">🏃 Paglikas sa ligtas na lugar</div>
<div class="m3-choice">🧹 Paglilinis ng kanal at kapaligiran</div>

<button class="m3-btn m3-primary" id="proceedBtn" disabled>
Magpatuloy →
</button>

</div>

</div>
</div>

<!-- MODAL -->
<div class="m3-modal" id="goalsModal">
    <div class="m3-modal-card">

        <h3>📘 Mga Layunin ng Aralin</h3>

        <div class="m3-goal">
            <h4>
                a. PAMANTAYANG PANGNILALAMAN
            </h4>
                <p>
                    Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.
                </p>
        </div>

    <div class="m3-goal">
    <h4>b. PAMANTAYAN SA PAGGANAP</h4>
    <p>
    Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.
    </p>
    </div>

    <div class="m3-goal">
    <h4>c. KASANAYAN SA PAGKATUTO</h4>
    <div class="m3-competency">Natutukoy ang mga paghahandang nararapat gawin sa harap ng panganib na dulot ng mga suliraning pangkapaligiran. (MELC3)</div>
    <div class="m3-competency">Naibibigay ang katuturan ng Disaster Management;</div>
    <div class="m3-competency">Nasusuri ang mga konsepto o termino na may kaugnayan sa disaster management;</div>
    <div class="m3-competency">Naipaliliwanag ang katangian ng top-down approach sa pagharap sa suliraning pangkapaligiran;</div>
    <div class="m3-competency">Napaghahambing ang top-down at bottom-up approach;</div>
    <div class="m3-competency">Nasusuri ang mga layunin ng Community Based-Disaster and Risk Management;</div>
    <div class="m3-competency">Natutukoy ang mga paghahanda na nararapat gawin sa harap ng mga panganib na dulot ng suliraning pangkapaligiran; at</div>
    <div class="m3-competency">Napahahalagahan ang bahaging ginagampanan bilang isang mamamayan para sa ligtas na pamayanang kaniyang kinabibilangan.</div>

    </div>

    <div class="m3-goal">
    <h4>d. PAKSANG ARALIN</h4>
    <ul>
    <li>Ang Disaster Management</li>
    <li>Mga Paghahandang Nararapat Gawin sa Harap ng Panganib/Kalamidad</li>
    </ul>
    </div>

    <button class="m3-btn m3-primary" id="closeGoals">Isara</button>

    <div class="m3-actions" style="justify-content:flex-end; margin-top:12px;">
        <button class="m3-btn m3-primary" id="startBtn" type="button">▶ Simulan</button>
    </div>
</div>

<script>
startBtn.onclick=()=>{
    goalsModal.classList.remove('show');
    pollSection.style.display='block';
};

const choices=document.querySelectorAll('.m3-choice');
const btn=document.getElementById('proceedBtn');

choices.forEach(c=>{
    c.onclick=()=>{
        choices.forEach(x=>x.classList.remove('active'));
        c.classList.add('active');
        btn.disabled=false;
    }
});

openGoals.onclick=()=>goalsModal.classList.add('show');
closeGoals.onclick=()=>goalsModal.classList.remove('show');

btn.onclick=()=>{
    window.location.href='{{ route("module3.pretest") }}';
};
</script>

</body>
</html>