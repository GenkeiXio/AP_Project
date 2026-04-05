@extends('Students.studentslayout')
@section('title', 'Module 3 Home')

@push('styles')
<style>
:root{
    --green:#1f7a47;
    --light:#66bb6a;
    --soft:#f4fff6;
}

/* Layout */
.m3-wrap{
    max-width:1000px;
    margin:30px auto;
    padding:15px;
}

.m3-title-wrap{
    display:flex;
    align-items:flex-start;
    gap:10px;
}

.m3-hero{
    background:#fff;
    border-radius:20px;
    padding:25px;
    border:1px solid #d7e9d8;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.m3-title{
    font-size:clamp(1.3rem,2.5vw,1.9rem);
    font-weight:900;
    color:#1f3b2a;
}

.m3-sub{
    margin-top:8px;
    color:#4e7a61;
}

/* ACTIONS */
.m3-actions{
    margin-top:18px;
}

.m3-btn{
    padding:12px 18px;
    border-radius:14px;
    font-weight:800;
    border:none;
    cursor:pointer;
    border:none;
    transition:.2s;
}

.m3-btn:hover{ transform:translateY(-2px); }

.m3-primary{
    background:linear-gradient(135deg,#8ce274,#2f9b57);
    color:#0f311f;
    box-shadow:0 10px 24px rgba(47,155,87,.25);
}

.m3-primary:hover{ transform:translateY(-2px); }

.m3-ghost{
    background:#eef8ef;
    border:1px solid #dcecdf;
}

.m3-question{
    font-weight:900;
    margin-bottom:12px;
}

/* CHOICES */
.m3-choice{
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px;
    border-radius:14px;
    border:1px solid #d7e7da;
    margin-bottom:10px;
    cursor:pointer;
    transition:.2s;
}

.m3-choice:hover{
    background:#f6fff8;
}

.m3-choice.active{
    border-color:var(--green);
    background:#eaffea;
    font-weight:800;
}

.m3-icon{
    font-size:22px;
}

/* PROGRESS FEEL */
.m3-progress{
    font-size:.8rem;
    color:#5c7d67;
    margin-bottom:10px;
}

/* MODAL */
.m3-modal{
    position:fixed;
    inset:0;
    background:linear-gradient(135deg, rgba(4,14,10,.70), rgba(7,40,22,.52));
    display:none;
    align-items:center;
    justify-content:center;
    z-index:999;
    padding:18px;
}

.m3-modal.show{ display:flex; }

.m3-modal-content{
    width:min(860px,94%);
    max-height:88vh;
    overflow:auto;
    border-radius:24px;
    background:linear-gradient(180deg,#ffffff 0%,#f6fff8 100%);
    padding:18px;
    box-shadow:0 30px 60px rgba(0,0,0,.28);
    border:1px solid #d6ebda;
    margin:auto; /* center the card */
}

.m3-modal-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    margin-bottom:12px;
    padding:14px;
    border-radius:16px;
    padding:20px;
    max-width:800px;
    width:95%;
    max-height:85vh;
    overflow:auto;
}

/* GOALS */
.m3-goal{
    margin-top:14px;
    padding:12px;
    border-radius:10px;
    background:var(--soft);
}

.m3-goal h4{
    margin-bottom:6px;
    color:var(--green);
}

/* COMPETENCY */
.m3-competency{
    padding:10px;
    border-radius:10px;
    margin-top:8px;
    cursor:pointer;
    display:flex;
    gap:10px;
    transition:.2s;
}

.m3-competency:hover{
    background:#eaffea;
}

.m3-competency.active{
    background:#d7f7db;
    border-left:4px solid var(--green);
}
</style>
</head>

<body>

<a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>

<div class="page-content">
<div class="m3-wrap">
    <div class="m3-shell">

        <!-- HERO -->
        <div class="m3-hero" id="heroCard">
            <div class="m3-title-wrap">
                <span class="m3-icon">🛡️</span>
                <h1 class="m3-title">
                 Paghahandang Nararapat Gawin sa Harap ng Panganib na Dulot ng Suliraning Pangkapaligiran
                </h1>
            </div>

            <p class="m3-sub">
                Tuklasin ang mga wastong paghahanda upang maging ligtas at handa sa panahon ng kalamidad.
                Basahin muna ang mga layunin sa ibaba bago pindutin ang Simulan.
            </p>

            <div class="m3-actions">
                <button type="button" class="m3-btn m3-ghost" id="openGoalsBtn">📜 Mga Layunin</button>
                <button class="m3-btn m3-primary m3-disabled" id="startBtn" type="button" disabled>🔒 Simulan</button>
            </div>

            <div id="startNote" class="m3-start-note">
                Kailangan munang basahin ang buong “Mga Layunin” para ma-unlock ang Simulan.
            </div>
        </div>

<!-- POLL -->
<div class="m3-poll" id="pollSection">

<div class="m3-progress">Step 1 of 2</div>

<p class="m3-question">
👉 Ano ang pinakamahalagang paghahanda na ginagawa sa inyong lugar kapag may paparating na kalamidad?
</p>

<div class="m3-choice"><span class="m3-icon">🧰</span>Paghahanda ng emergency kit</div>
<div class="m3-choice"><span class="m3-icon">📢</span>Pakikinig sa balita at babala</div>
<div class="m3-choice"><span class="m3-icon">🏃</span>Paglikas sa ligtas na lugar</div>
<div class="m3-choice"><span class="m3-icon">🧹</span>Paglilinis ng kanal at kapaligiran</div>

<button class="m3-btn m3-primary" id="proceedBtn" disabled>
Magpatuloy →
</button>

</div>

</div>

<!-- MODAL -->
<div class="m3-modal" id="goalsModal">
<div class="m3-modal-card">

<h3>📘 Mga Layunin ng Aralin</h3>

<div class="m3-goal">
<h4>a. PAMANTAYANG PANGNILALAMAN</h4>
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
</div>

<script>
/* START */
startBtn.onclick=()=>{
    goalsModal.classList.remove('show');
    pollSection.style.display='block';
    pollSection.scrollIntoView({behavior:'smooth'});
};

/* SELECT */
const choices=document.querySelectorAll('.m3-choice');
const btn=document.getElementById('proceedBtn');

choices.forEach(c=>{
    c.onclick=()=>{
        choices.forEach(x=>x.classList.remove('active'));
        c.classList.add('active');
        btn.disabled=false;
    }
});

btn.onclick=()=>{
    window.location.href='{{ route("module3.pretest") }}';
};

/* COMPETENCY INTERACTION */
document.querySelectorAll('.m3-competency').forEach(c=>{
    c.onclick=()=>c.classList.toggle('active');
});

/* MODAL */
openGoals.onclick=()=>goalsModal.classList.add('show');
closeGoals.onclick=()=>goalsModal.classList.remove('show');
</script>

@endsection