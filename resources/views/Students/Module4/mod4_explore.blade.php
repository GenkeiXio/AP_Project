<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Modyul 4 - Galugarin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:
        radial-gradient(circle at top left, rgba(255,255,255,0.14), transparent 28%),
        radial-gradient(circle at bottom right, rgba(255,215,0,0.10), transparent 26%),
        linear-gradient(135deg,#0b1b2b 0%, #11384f 45%, #173d2c 100%);
    color:#eaf4ff;
    overflow-x:hidden;
}

.container-box{
    max-width:1200px;
    margin:auto;
    padding:28px;
}

h2{
    text-align:center;
    font-weight:900;
    letter-spacing:1px;
    color:#f8fdff;
    text-shadow:0 4px 18px rgba(0,0,0,.35);
}

.page-banner{
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
    align-items:center;
    gap:14px;
    padding:16px 20px;
    margin-top:8px;
    margin-bottom:18px;
    border-radius:22px;
    background:rgba(3, 18, 30, 0.72);
    border:1px solid rgba(255,255,255,.10);
    box-shadow:0 16px 35px rgba(0,0,0,.25);
    backdrop-filter:blur(10px);
}

.page-banner .brief{
    max-width:760px;
}

.page-banner .brief .eyebrow{
    display:inline-block;
    font-size:.78rem;
    font-weight:800;
    letter-spacing:1.6px;
    text-transform:uppercase;
    color:#7ce7ff;
    margin-bottom:6px;
}

.page-banner .brief p{
    margin:0;
    color:#d8eefb;
    line-height:1.6;
}

.mission-pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 14px;
    border-radius:999px;
    background:linear-gradient(135deg, rgba(0,242,255,.18), rgba(57,255,20,.12));
    border:1px solid rgba(124,231,255,.28);
    color:#eafcff;
    font-weight:700;
    box-shadow:0 8px 20px rgba(0,0,0,.18);
}

.progress{height:20px;border-radius:10px;}

.progress-wrap{
    margin-top:10px;
    padding:14px;
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    border-radius:18px;
}

.progress-label{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:8px;
    font-weight:700;
    color:#e7f7ff;
}

.progress-label span:last-child{
    color:#9dfdba;
}

.card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:18px;
    margin-top:22px;
}

.news-card{
    position:relative;
    background:linear-gradient(180deg, rgba(15,32,52,.98), rgba(6,18,31,.98));
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 12px 28px rgba(0,0,0,.28);
    cursor:pointer;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    border:1px solid rgba(124,231,255,.16);
}

.news-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow:0 18px 36px rgba(0,0,0,.38);
    border-color: rgba(124,231,255,.42);
}

.news-card::after{
    content:'Pindutin upang buksan ang kuwento';
    position:absolute;
    top:12px;
    right:12px;
    font-size:.72rem;
    font-weight:800;
    letter-spacing:.4px;
    color:#062133;
    background:linear-gradient(135deg,#7ce7ff,#9dfdba);
    padding:6px 10px;
    border-radius:999px;
    box-shadow:0 6px 14px rgba(0,0,0,.2);
}

.news-card img{
    width:100%;
    height:190px;
    object-fit:cover;
}

.news-card h5{
    color:#f6fbff;
    font-weight:800;
    margin:0;
}

.news-card p{
    color:#bfd9ea;
}

.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.7);
    justify-content:center;
    align-items:center;
    z-index: 1000;
}

.modal.show{display:flex;}

.modal-box{
    background:
        radial-gradient(circle at top right, rgba(124,231,255,.18), transparent 30%),
        linear-gradient(180deg, #fdfefe 0%, #eef7fb 100%);
    padding:20px;
    border-radius:22px;
    max-width:900px;
    width:95%;
    max-height:90vh;
    overflow:auto;
    box-shadow:0 24px 60px rgba(0,0,0,.45);
    border:1px solid rgba(255,255,255,.35);
}

/* Close button in modal header */
.modal-close {
    position: sticky;
    top: 0;
    background: linear-gradient(90deg, rgba(255,255,255,.98), rgba(238,247,251,.95));
    padding: 10px 0;
    text-align: right;
    border-bottom: 1px solid #e0e0e0;
    margin-bottom: 15px;
}

.modal-close .btn-close-modal {
    background: linear-gradient(135deg, #dc3545, #ff6b6b);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s;
    box-shadow:0 8px 16px rgba(220,53,69,.25);
}

.modal-close .btn-close-modal:hover {
    background: #c82333;
    transform: translateY(-1px);
}

.modal-heading{
    text-align:center;
    padding:8px 0 14px;
    margin-bottom:10px;
    border-bottom:1px dashed rgba(13,110,253,.22);
}

.modal-heading h3{
    color:#103e63;
    font-weight:900;
    margin-bottom:6px;
}

.modal-heading p{
    color:#60758a;
    margin:0;
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
    box-shadow:0 8px 18px rgba(0,0,0,.14);
}

.story h4{
    font-weight:900;
    color:#153b55;
}

.story p,
.story li{
    color:#334155;
    line-height:1.7;
}

.story .btn{
    border-radius:999px;
    padding:10px 20px;
    font-weight:700;
    box-shadow:0 10px 20px rgba(0,0,0,.14);
}

@media (max-width: 768px){
    .container-box{padding:16px;}
    .page-banner{padding:14px;}
    .news-card img{height:160px;}
    .news-card::after{font-size:.66rem; padding:5px 8px;}
    .modal-box{width:96%; padding:14px; border-radius:18px;}
}
</style>
</head>

<body>

<div class="container-box">

<h2>🧠 GALUGARIN: Disaster Mission Hub</h2>

<div class="page-banner">
    <div class="brief">
        <div class="eyebrow">Araling Panlipunan · Modyul 4</div>
        <p>Galugarin ang mga totoong pangyayaring pangkalamidad sa Albay at tuklasin ang mga aral tungkol sa kahandaan, pagtugon, at pagbangon.</p>
    </div>
    <div class="mission-pill">🎯 Misyon: Basahin • Matuto • Tapusin</div>
</div>

<div class="progress-wrap">
    <div class="progress-label">
        <span>Pag-usad ng Misyon</span>
        <span id="progressText">0%</span>
    </div>
    <div class="progress">
        <div id="progressBar" class="progress-bar bg-success" style="width:0%">0%</div>
    </div>
</div>

<div class="card-grid mt-4">

<div class="news-card" onclick="openStory('rolly')">
<img src="{{ asset('pictures/Module4/rolly/card1_1.jpg') }}">
<h5 class="text-center p-2">🌀 Super Taifun Rolly</h5>
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
<img src="{{ asset('pictures/Module4/mayon/Mayon.jpg') }}">
<h5 class="text-center p-2">🌋 Bulkang Mayon</h5>
</div>

<div class="news-card" onclick="openStory('landslide')">
<img src="{{ asset('pictures/Module4/landslide/landslide.png') }}">
<h5 class="text-center p-2">⛰️ Landslide sa Albay</h5>
</div>

</div>

</div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-box">
    
    <!-- Modal close button -->
    <div class="modal-close">
        <button class="btn-close-modal" onclick="closeModal()">✕ Isara</button>
    </div>

    <div class="modal-heading">
        <h3>Hamong Kuwento at Misyon</h3>
        <p>Basahin ang kuwento at tapusin ang mga hakbang upang ma-unlock ang pag-usad.</p>
    </div>

    <!-- ================= STORIES ================= -->
    @include('Students.Module4.Explore.rolly_story')
    @include('Students.Module4.Explore.baha_story')
    @include('Students.Module4.Explore.lindol_story')
    @include('Students.Module4.Explore.mayon_story')
    @include('Students.Module4.Explore.landslide_story')

</div>
</div>

<script>
let progress = 0;
let completed = {};
let currentStory = "";
const progressPerStory = 20;
const totalStories = 5;
const progressText = document.getElementById('progressText');
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const exploreSaveUrl = "{{ route('student.module4.explore.save') }}";

function updateProgress() {
    const bar = document.getElementById('progressBar');
    const value = Math.min(progress, 100);
    bar.style.width = value + "%";
    bar.innerText = value + "%";
    progressText.innerText = value + "%";
}

function loadCompletedStories() {
    try {
        completed = JSON.parse(localStorage.getItem('module4_completedStories') || '{}') || {};
    } catch (e) {
        completed = {};
    }
    progress = Math.min(Object.keys(completed).length * progressPerStory, 100);
    updateProgress();
}

function saveCompletedStories() {
    localStorage.setItem('module4_completedStories', JSON.stringify(completed));
}

async function saveExploreProgress() {
    try {
        await fetch(exploreSaveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                completed_stories: Object.keys(completed),
                progress_percent: Math.min(progress, 100),
                is_completed: Object.keys(completed).length >= totalStories
            })
        });
    } catch (error) {
        console.error('Failed to save Module 4 explore progress:', error);
    }
}

function awardStepXP(stepId, xp) {
    const stepEl = document.getElementById(stepId);
    if (!stepEl || stepEl.dataset.xpAwarded === '1') return;
    stepEl.dataset.xpAwarded = '1';
    const badge = document.createElement('div');
    badge.className = 'achievement-badge';
    badge.textContent = `+${xp} XP`;
    stepEl.insertBefore(badge, stepEl.firstChild.nextSibling);
}

function updateStoryProgress(storyId, stepNumber) {
    const totalSteps = { rolly: 8, baha: 6, lindol: 8, mayon: 8, landslide: 7 }[storyId] || 1;
    const label = document.getElementById(storyId + 'ProgressLabel');
    const bar = document.getElementById(storyId + 'ProgressBar');
    const percent = Math.min(Math.round((stepNumber / totalSteps) * 100), 100);
    if (label) label.innerText = `Hakbang ${stepNumber} / ${totalSteps}`;
    if (bar) bar.style.width = percent + '%';
}

// Check URL parameter for completed stories
function checkCompletedFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const completedStory = urlParams.get('completed');

    if (completedStory && !completed[completedStory]) {
        completed[completedStory] = true;
        progress = Math.min(Object.keys(completed).length * progressPerStory, 100);
        updateProgress();
        saveCompletedStories();
        saveExploreProgress();

        // Clean up the URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}

function openStory(id) {
    currentStory = id;
    document.getElementById('modal').classList.add('show');
    document.querySelectorAll('.story').forEach(s => s.style.display = 'none');
    document.getElementById(id).style.display = 'block';
    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
    document.querySelector('#' + id + ' .step').classList.add('active');
}

function closeModal() {
    document.getElementById('modal').classList.remove('show');
}

function nextStep(step) {
    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
    document.getElementById(currentStory + '-step' + step).classList.add('active');
}

function finishStory() {
    document.getElementById('modal').classList.remove('show');
    if (!completed[currentStory]) {
        completed[currentStory] = true;
        progress = Math.min(Object.keys(completed).length * progressPerStory, 100);
        updateProgress();
        saveCompletedStories();
        saveExploreProgress();

        if (Object.keys(completed).length >= totalStories) {
            setTimeout(() => {
                window.location.href = "{{ route('module4.welcome') }}";
            }, 300);
        }
    }
}

// Close modal when clicking outside
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Initialize on page load
window.addEventListener('DOMContentLoaded', function() {
    loadCompletedStories();
    checkCompletedFromURL();
    updateProgress();
});
</script>

</body>
</html>