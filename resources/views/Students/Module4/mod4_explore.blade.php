<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module 4 - Explore</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#e6f7ff,#f4fff8);
}

.container-box{
    max-width:1100px;
    margin:auto;
    padding:20px;
}

h2{text-align:center;font-weight:800;}

.progress{height:20px;border-radius:10px;}

.card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.news-card{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
    cursor:pointer;
}

.news-card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.7);
    justify-content:center;
    align-items:center;
}

.modal.show{display:flex;}

.modal-box{
    background:white;
    padding:20px;
    border-radius:15px;
    max-width:900px;
    width:95%;
    max-height:90vh;
    overflow:auto;
}

.story{display:none;}
.step{display:none;}
.step.active{display:block;}

.img-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:10px;
    margin:10px 0;
}

.img-grid img{
    width:100%;
    border-radius:10px;
}
</style>
</head>

<body>

<div class="container-box">

<h2>🧠 EXPLORE: Interactive News Hub</h2>

<div class="progress mt-3">
    <div id="progressBar" class="progress-bar bg-success" style="width:0%">0%</div>
</div>

<div class="card-grid mt-4">

<div class="news-card" onclick="openStory('rolly')">
<img src="{{ asset('pictures/Module4/rolly/card1_1.jpg') }}">
<h5 class="text-center p-2">🌀 Super Typhoon Rolly</h5>
</div>

<div class="news-card" onclick="openStory('baha')">
<img src="{{ asset('pictures/Module4/baha/card1_1.jpg') }}">
<h5 class="text-center p-2">🌊 Baha sa Guinobatan</h5>
</div>

<div class="news-card" onclick="openStory('lindol')">
<img src="{{ asset('pictures/Module4/lindol/card1_1.jpg') }}">
<h5 class="text-center p-2">🌍 Malakas na Lindol</h5>
</div>

<div class="news-card" onclick="openStory('mayon')">
<img src="{{ asset('pictures/Module4/mayon/card1_1.jpg') }}">
<h5 class="text-center p-2">🌋 Bulkang Mayon</h5>
</div>

<div class="news-card" onclick="openStory('landslide')">
<img src="{{ asset('pictures/Module4/landslide/card1_1.jpg') }}">
<h5 class="text-center p-2">⛰️ Landslide sa Albay</h5>
</div>

</div>

</div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-box">

<!-- ================= ROLLY ================= -->
<div class="story" id="rolly">

<h4>🌀 Super Typhoon Rolly (Tabaco, Albay)</h4>
<p>
    <small>
        Source: 
        <a href="https://www.gmanetwork.com/news/topstories/nation/762951/rolly-worst-to-hit-tabaco-in-albay-since-1952-says-mayor/story/" 
           target="_blank" 
           style="color:#0d6efd; text-decoration:underline;">
            GMA News Online (2020)
        </a>
    </small>
</p>
<!-- CARD 1 -->
<div class="step active" id="rolly-step1">
    <h5>🧩 ANO ANG NANGYARI?</h5>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/rolly/card1_1.jpg') }}">
        <img src="{{ asset('pictures/Module4/rolly/card1_2.jpg') }}">
        <img src="{{ asset('pictures/Module4/rolly/card1_3.jpg') }}">
    </div>

    <p>
        <strong>
            📌 Mahahalagang Punto:
        </strong>
    </p>
    <ul>
        <li>Pinakamalakas na bagyo sa Tabaco mula 1952</li>
        <li>Mas malakas kaysa Reming at Niña</li>
    </ul>

    <p>
        <strong>
            🧠 Mabilis na Ideya:
        </strong><br>
            👉 Isang makasaysayan at napakalakas na sakuna
    </p>

    <button class="btn btn-primary" onclick="nextStep(2)">
        Next
    </button>
</div>

<!-- CARD 2 -->
<div class="step" id="rolly-step2">
<h5>🧩 ULAT NG PINSALA</h5>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card2_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card2_2.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card2_3.jpg') }}">
</div>

<ul>
<li>₱2.5 bilyon ang pinsala</li>
<li>3,500 bahay ang nawasak</li>
<li>15,500 bahay ang napinsala</li>
<li>90% ng mga bangka ang nasira</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Malubhang naapektuhan ang tirahan at kabuhayan</p>

<button class="btn btn-primary" onclick="nextStep(3)">Next</button>
</div>

<!-- CARD 3 -->
<div class="step" id="rolly-step3">
<h5>🧩 KAKULANGAN SA PANGANGAILANGAN</h5>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card3_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card3_2.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card3_3.jpg') }}">
</div>

<ul>
<li>Walang kuryente sa buong lungsod</li>
<li>15 barangay ang kulang sa tubig</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Naging mahirap ang pamumuhay at kaligtasan</p>

<button class="btn btn-primary" onclick="nextStep(4)">Next</button>
</div>

<!-- CARD 4 -->
<div class="step" id="rolly-step4">
<h5>🧩 KARANASAN SA BAHA</h5>

<div class="img-grid">
    <img src="{{ asset('pictures/Module4/rolly/card4_1.png') }}">
    <img src="{{ asset('pictures/Module4/rolly/card4_2.png') }}">
    <img src="{{ asset('pictures/Module4/rolly/card4_3.png') }}">
</div>

<ul>
    <li>Abot leeg ang baha</li>
    <li>Napilitang lumangoy ang mga tao</li>
    <li>Maraming bahay ang tinangay</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Mapanganib na sitwasyon sa buhay</p>

<button class="btn btn-primary" onclick="nextStep(5)">Next</button>
</div>

<!-- CARD 5 -->
<div class="step" id="rolly-step5">
<h5>🧩 EPEKTO SA MGA TAO</h5>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card5_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card5_2.jpg') }}">
</div>

<ul>
<li>Hirap ang mga residente</li>
<li>Kulang ang suplay</li>
<li>✅ Walang naitalang namatay</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Ang kahandaan ay nakapagliligtas ng buhay</p>

<button class="btn btn-primary" onclick="nextStep(6)">Next</button>
</div>

<!-- CARD 6 -->
<div class="step" id="rolly-step6">
<h5>🧩 PINSALA SA PAMANA</h5>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card6_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card6_2.png') }}">
<img src="{{ asset('pictures/Module4/rolly/card6_3.png') }}">
</div>

<ul>
<li>Nasira ang 160 taong gulang na simbahan</li>
<li>Nasira ang makasaysayang bahay</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Apektado ang kultura at kasaysayan</p>

<button class="btn btn-primary" onclick="nextStep(7)">Next</button>
</div>

<!-- CARD 7 -->
<div class="step" id="rolly-step7">
<h5>🧩 PAGTUGON NG KOMUNIDAD</h5>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card7_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card7_2.jpg') }}">
</div>

<ul>
<li>Pagkakaisa at pagtutulungan</li>
<li>Itinuring na pagsubok ng pananampalataya</li>
</ul>

<p><strong>🧠 Mabilis na Ideya:</strong><br>
👉 Lakas ng komunidad ang susi</p>

<button class="btn btn-primary" onclick="nextStep(8)">Next</button>
</div>

<!-- CARD 8 -->
<div class="step" id="rolly-step8">
<h5>🧩 BUOD</h5>

<p>
Ang Super Typhoon Rolly ay itinuturing na pinakamalakas na bagyong tumama sa Tabaco, Albay mula pa noong 1952, na nagdulot ng humigit-kumulang ₱2.5 bilyong pinsala sa mga bahay, kabuhayan, at imprastruktura. Libu-libong tahanan ang nawasak o napinsala, at halos lahat ng bangka ng mga mangingisda ay nasira, habang nawalan ng kuryente at sapat na suplay ng tubig ang maraming barangay. Naranasan din ng mga residente ang matinding pagbaha kung saan ang ilan ay napilitang lumangoy upang makaligtas. Nasira rin ang mga makasaysayang gusali, kabilang ang isang lumang simbahan at bahay, na nagpapakita ng epekto ng sakuna sa kultura at kasaysayan. Sa kabila ng matinding pinsala at paghihirap, walang naitalang nasawi, na nagpapatunay sa kahalagahan ng kahandaan, disiplina, at pagtutulungan ng komunidad sa pagharap sa kalamidad.
</p>

<!-- OPTIONAL VIDEO -->
<p><strong>🎥 Optional Video:</strong></p>
<iframe width="100%" height="315"
src="https://www.youtube.com/embed/mtf1JAQ2hq4"
title="YouTube video"
allowfullscreen></iframe>

<button class="btn btn-success" onclick="finishStory()">Tapusin</button>
</div>

</div>

<!-- OTHER STORIES PLACEHOLDER -->
<div class="story" id="baha"><div class="step active"><h4>🌊 Baha</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>
<div class="story" id="lindol"><div class="step active"><h4>🌍 Lindol</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>
<div class="story" id="mayon"><div class="step active"><h4>🌋 Mayon</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>
<div class="story" id="landslide"><div class="step active"><h4>⛰️ Landslide</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>

</div>
</div>

<script>
let progress=0;
let completed={};
let currentStory="";

function openStory(id){
currentStory=id;
document.getElementById('modal').classList.add('show');
document.querySelectorAll('.story').forEach(s=>s.style.display='none');
document.getElementById(id).style.display='block';
document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
document.querySelector('#'+id+' .step').classList.add('active');
}

function nextStep(step){
document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
document.getElementById(currentStory+'-step'+step).classList.add('active');
}

function finishStory(){
document.getElementById('modal').classList.remove('show');
if(!completed[currentStory]){
completed[currentStory]=true;
progress+=20;
let bar=document.getElementById('progressBar');
bar.style.width=progress+"%";
bar.innerText=progress+"%";
}
}
</script>

</body>
</html>