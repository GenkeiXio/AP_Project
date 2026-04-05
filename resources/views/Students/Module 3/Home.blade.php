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

/* HERO */
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
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.m3-btn{
    padding:10px 16px;
    border-radius:12px;
    font-weight:800;
    cursor:pointer;
    border:none;
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
@endpush

@section('content')
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