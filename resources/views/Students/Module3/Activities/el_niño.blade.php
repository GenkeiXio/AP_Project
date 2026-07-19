@extends('Students.studentslayout')
@section('title', 'Module 3 : El Niño at La Niña Activity')

@push('styles')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap");
    
    :root {
        --papel-pula: #f4f1ea; 
        --tinta: #2c3e50; 
        --border-ap: #5d6d7e; 
        --ginto-kupas: #b59551;
        --elnino: #d35400;
        --lanina: #2980b9;
    }

    html, body {
        scroll-behavior: smooth;
        background: linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                    url('/pictures/mod3_innermap.png') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

    body {
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
    }

    /* MODAL & OVERLAY STYLE */
    .ap-overlay {
        position: fixed; 
        inset: 0; 
        background: rgba(0, 0, 0, 0.95);
        display: flex; 
        justify-content: center; 
        align-items: center;
        z-index: 2000;
        padding: 20px;
    }

    .ap-kasulatan {
        background: var(--papel-pula);
        padding: 25px 20px;
        border: 2px solid var(--border-ap);
        outline: 8px double var(--border-ap);
        outline-offset: -8px;
        width: 100%; 
        max-width: 500px;
        text-align: center;
        color: var(--tinta);
        box-shadow: 0 0 40px rgba(0,0,0,0.5);
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 8px;
    }

    .ap-kasulatan h1 {
        font-family: 'Baloo 2', cursive;
        font-size: 1.8rem;
        margin-bottom: 15px;
        border-bottom: 2px solid var(--tinta);
        padding-bottom: 5px;
    }

    .instruction-list {
        text-align: left;
        margin: 15px 0;
        padding-left: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    /* VIDEO PLAYER MODAL */
    #videoPlayerModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.95);
        z-index: 3000;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .video-wrapper {
        width: 95%;
        max-width: 800px;
        aspect-ratio: 16/9;
        background: #000;
        border: 3px solid var(--ginto-kupas);
        border-radius: 8px;
        overflow: hidden;
    }

    .video-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* VIDEO BUTTONS IN INSTRUCTION */
    .video-selection {
        margin: 15px 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn-video {
        background: #e5e0d5;
        border: 1px solid var(--border-ap);
        padding: 12px;
        cursor: pointer;
        font-family: 'Baloo 2', cursive;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: 0.3s;
        text-align: left;
        border-radius: 8px;
        font-size: 14px;
    }

    .btn-video:hover { background: #dcd7ca; }

    .btn-ap {
        background: var(--tinta);
        color: white;
        padding: 12px 25px;
        border: none;
        font-family: 'Baloo 2', cursive;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        width: 100%;
        max-width: 250px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .btn-ap:hover { opacity: 0.9; transform: translateY(-2px); }

    /* GAME UI */
    .game-container {
        display: flex; 
        flex-direction: column; 
        align-items: center;
        justify-content: center;
        width: 100%; 
        max-width: 950px; 
        margin: 0 auto;
        padding: 10px;
    }

    .command-center {
        position: relative;
        width: 100%;
        background: url('/pictures/Module 3/elnino_bg.png') no-repeat center center;
        background-size: cover;
        background-color: #1a1a2e;
        border: 4px solid var(--border-ap);
        box-shadow: 0 10px 25px rgba(0,0,0,0.7);
        border-radius: 12px;
        overflow: hidden;
    }
    
    /* DESKTOP */
    @media (min-width: 769px) {
        .command-center {
            aspect-ratio: 16/9;
        }
    }
    
    /* MOBILE - Larger image, keep it visible */
    @media (max-width: 768px) {
        .command-center {
            aspect-ratio: 3/2;
            background-size: cover;
        }
    }

    .pulse-point {
        position: absolute;
        background: var(--papel-pula);
        border: 3px solid var(--tinta);
        border-radius: 50%;
        cursor: pointer; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 800; 
        color: var(--tinta); 
        font-family: 'Baloo 2', cursive;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
        animation: radarGlow 2s infinite ease-in-out;
        z-index: 10;
        transition: all 0.2s ease;
    }
    
    /* DESKTOP pulse point size */
    @media (min-width: 769px) {
        .pulse-point {
            width: 42px;
            height: 42px;
            font-size: 22px;
        }
    }
    
    /* MOBILE pulse points */
    @media (max-width: 768px) {
        .pulse-point {
            width: 44px;
            height: 44px;
            font-size: 22px;
        }
    }

    .pulse-point:active { transform: scale(0.95); }

    @keyframes radarGlow {
        0% { box-shadow: 0 0 5px rgba(255,255,255,0.4); transform: scale(1); }
        50% { box-shadow: 0 0 20px rgba(255,255,255,0.9); transform: scale(1.08); }
        100% { box-shadow: 0 0 5px rgba(255,255,255,0.4); transform: scale(1); }
    }

    .pulse-point.solved { 
        background: #27ae60 !important; 
        animation: none; 
        color: white; 
        border-color: white;
        box-shadow: 0 0 10px rgba(39, 174, 96, 0.8);
    }

    /* SELECTION MODAL */
    #selectionModal {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--papel-pula);
        border: 3px solid var(--tinta);
        padding: 15px;
        display: none;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        z-index: 1001;
        box-shadow: 0 0 50px rgba(0,0,0,0.9);
        width: 90%;
        max-width: 380px;
        border-radius: 16px;
    }

    .menu-item {
        aspect-ratio: 1/1;
        background: white;
        border: 2px solid #ccc;
        cursor: pointer;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .menu-item:hover {
        transform: scale(1.05);
        border-color: var(--ginto-kupas);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .menu-item:active { transform: scale(0.98); }

    .menu-item img { 
        width: 100%; 
        height: 100%; 
        object-fit: contain;
        max-width: 110px;
        max-height: 110px;
    }
    
    @media (max-width: 480px) {
        .menu-item img {
            max-width: 55px;
            max-height: 55px;
        }
    }

    /* POINT POSITIONS - Restored to working positions */
    #pt1 { top: 12%; left: 8%; }
    #pt2 { top: 12%; right: 28%; }
    #pt3 { bottom: 12%; left: 10%; }
    #pt4 { bottom: 12%; left: 45%; }
    #pt5 { bottom: 12%; right: 10%; }

    /* CONGRATULATIONS MODAL */
    #congratsModal .ap-kasulatan {
        max-width: 400px;
    }
</style>
@endpush

@section('content')

<div id="videoPlayerModal">
    <div class="video-wrapper">
        <iframe id="youtubeFrame" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
    <button class="btn-ap" onclick="isaraVideo()" style="margin-top: 20px; width: auto; min-width: 150px;">🔙 BUMALIK</button>
</div>

<div id="briefingOverlay" class="ap-overlay">
    <div class="ap-kasulatan">
        <h1>📋 GABAY SA PAGSASANAY</h1>
        <p style="font-style: italic; margin-bottom: 10px; font-size: 13px;">Basahin ang mga panuto:</p>
        
        <ul class="instruction-list">
            <li>🔍 Suriin ang mga <strong>radar point (?)</strong> sa mapa.</li>
            <li>👆 Pindutin ang punto upang makita ang mga pagpipilian.</li>
            <li>✅ Kailangang matugunan ang lahat ng <strong>lima (5)</strong> na punto.</li>
        </ul>

        <p style="font-weight: bold; font-size: 14px; text-align: left; margin: 10px 0 5px;">📺 Panoorin ang video:</p>
        <div class="video-selection">
            <button class="btn-video" onclick="playVideo('G4svwU0twEw')">
                <span>🎥</span> <span>Paghahanda sa El Niño at La Niña</span>
            </button>
            <button class="btn-video" onclick="playVideo('yurhT4mPjps')">
                <span>🎥</span> <span>Mga Hakbang para sa Kaligtasan</span>
            </button>
        </div>

        <button class="btn-ap" onclick="magsimula()">🚀 SIMULAN ANG GAWAIN</button>
    </div>
</div>

<div class="game-container">
    <div class="command-center">
        <div class="pulse-point" id="pt1" onclick="buksanMenu(event, 'tagtuyot1', 'pt1')">?</div>
        <div class="pulse-point" id="pt2" onclick="buksanMenu(event, 'baha1', 'pt2')">?</div>
        <div class="pulse-point" id="pt3" onclick="buksanMenu(event, 'tipid', 'pt3')">?</div>
        <div class="pulse-point" id="pt4" onclick="buksanMenu(event, 'daluyan', 'pt4')">?</div>
        <div class="pulse-point" id="pt5" onclick="buksanMenu(event, 'malinis', 'pt5')">?</div>

        <div id="selectionModal">
            <div class="menu-item" onclick="piliin('tagtuyot1')"><img src="/pictures/Module 3/tagtuyot1.png" alt="Tagtuyot"></div>
            <div class="menu-item" onclick="piliin('tipid')"><img src="/pictures/Module 3/tipid.png" alt="Tipid Tubig"></div>
            <div class="menu-item" onclick="piliin('baha1')"><img src="/pictures/Module 3/baha1.png" alt="Baha"></div>
            <div class="menu-item" onclick="piliin('daluyan')"><img src="/pictures/Module 3/daluyan.png" alt="Daluyan"></div>
            <div class="menu-item" onclick="piliin('malinis')"><img src="/pictures/Module 3/malinis.png" alt="Malinis"></div>
        </div>
    </div>
</div>

<div id="congratsModal" class="ap-overlay" style="display:none;">
    <div class="ap-kasulatan">
        <h1 style="color: #1b4f72;">🎉 PAGBATI!</h1>
        <p>Matagumpay mong naitakda ang mga wastong hakbang para sa kaligtasan.</p>
        <p style="font-size: 14px; margin-top: 10px;">🏆 Mahusay! handa ka na sa anumang kalamidad.</p>
        <button class="btn-ap" onclick="window.location.href='{{ route('lindol.activity') }}'">➡️ MAGPATULOY</button>
    </div>
</div>

<script>
    let activePointId = null;
    let score = {};
    const tamangSagot = { pt1: 'tagtuyot1', pt2: 'baha1', pt3: 'tipid', pt4: 'daluyan', pt5: 'malinis' };

    // VIDEO PLAYER FUNCTIONS
    function playVideo(id) {
        const frame = document.getElementById('youtubeFrame');
        frame.src = `https://www.youtube.com/embed/${id}?autoplay=1&rel=0`;
        document.getElementById('videoPlayerModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function isaraVideo() {
        const frame = document.getElementById('youtubeFrame');
        frame.src = "";
        document.getElementById('videoPlayerModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // Close video modal when clicking outside
    document.getElementById('videoPlayerModal').addEventListener('click', function(e) {
        if (e.target === this) {
            isaraVideo();
        }
    });

    // GAME FUNCTIONS
    function magsimula() {
        document.getElementById('briefingOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }

    function buksanMenu(e, target, id) {
        e.stopPropagation();
        const point = document.getElementById(id);
        if (point.classList.contains('solved')) return;
        
        activePointId = id;
        const modal = document.getElementById('selectionModal');
        modal.style.display = 'grid';
    }

    function piliin(choiceId) {
        const modal = document.getElementById('selectionModal');
        const point = document.getElementById(activePointId);

        if (choiceId === tamangSagot[activePointId]) {
            point.classList.add('solved');
            point.innerHTML = "✓";
            score[activePointId] = choiceId;
            modal.style.display = 'none';
            checkStatus();
        } else {
            point.style.background = "#e6b0aa";
            point.style.transform = "scale(0.95)";
            setTimeout(() => {
                point.style.background = "var(--papel-pula)";
                point.style.transform = "scale(1)";
                modal.style.display = 'none';
            }, 500);
        }
    }

    function saveElninoResult() {
        fetch("{{ route('student.module3.elnino.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                completed_points: Object.keys(score).length,
                is_success: Object.keys(score).length === 5,
                selections: score
            })
        })
        .then(res => res.json())
        .then(data => console.log("Saved:", data))
        .catch(err => console.error(err));
    }

    function checkStatus() {
        if(Object.keys(score).length === 5) {
            saveElninoResult();
            
            setTimeout(() => {
                document.getElementById('congratsModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }, 700);
        }
    }
    
    // Close modal functions
    function closeModal() {
        document.getElementById('congratsModal').style.display = 'none';
        document.body.style.overflow = '';
    }
    
    document.getElementById('congratsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>

@endsection