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

<!-- ================= STORIES ================= -->
@include('Students.Module4.Explore.rolly_story')
@include('Students.Module4.Explore.baha_story')
@include('Students.Module4.Explore.lindol_story')

<!-- OTHER STORIES PLACEHOLDER -->
<div class="story" id="mayon"><div class="step active"><h4>🌋 Mayon</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>
<div class="story" id="landslide"><div class="step active"><h4>⛰️ Landslide</h4><button onclick="finishStory()" class="btn btn-success">Tapusin</button></div></div>

</div>
</div>

<script>
let progress=0;
let completed={};
let currentStory="";

// Check URL parameter for completed stories
function checkCompletedFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const completedStory = urlParams.get('completed');
    
    if (completedStory && !completed[completedStory]) {
        completed[completedStory] = true;
        progress += 20;
        let bar = document.getElementById('progressBar');
        bar.style.width = progress + "%";
        bar.innerText = progress + "%";
        
        // Clean up the URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}

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

// Initialize on page load
window.addEventListener('DOMContentLoaded', checkCompletedFromURL);
</script>

</body>
</html>