<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Module 2</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <style>

    /* 🔥 FULLSCREEN BACKGROUND */
    html, body {
        height: 100%;
    }

    .map-wrapper {
        position: fixed;
        width: 100vw;
        height: 100vh;
        z-index: 1; /* 👈 prevent overlap issues */
    }   

    /* 🌍 BACKGROUND IMAGE */
    .background-map {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* 🎮 DARK OVERLAY (for readability) */
    .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.4), rgba(0,0,0,0.6));
    }

    /* 🎯 UI PANEL */
    .ui-panel {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        
        background: rgba(255,255,255,0.92);
        padding: 30px;
        border-radius: 20px;
        width: 90%;
        max-width: 650px;
        text-align: center;

        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        animation: popIn 0.4s ease;
    }

    /* @keyframes popIn {
        from { transform: translate(-50%, -60%) scale(0.9); opacity:0; }
        to { transform: translate(-50%, -50%) scale(1); opacity:1; }
    } */

    /* 🔙 BACK BUTTON */
    /* .home-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1000;

        font-size: 1.6rem;
        background: white;
        padding: 10px 14px;
        border-radius: 12px;
        text-decoration: none;
        color: black;

        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    } */

    /* 🎮 BUTTON LOCK */
    #startBtn.disabled {
        background: gray;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* MODAL (same as yours) */
    .modal {
        display: none;

        position: fixed;
        z-index: 9999;

        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;

        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);

        border-radius: 0 !important;

        justify-content: center;
        align-items: center;

        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: #ffffff;
        padding: 30px 28px;
        width: 90%;
        max-width: 650px;
        border-radius: 20px;
        text-align: left;
        margin: auto;

        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        animation: popIn 0.35s ease;

        max-height: 85vh;
        overflow-y: auto;
    }

    .close-btn {
        float: right;
        cursor: pointer;
        font-size: 1.5rem;
    }

    .modal-section {
        background: #f8fdf8;
        border-left: 5px solid #2e7d32;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    .modal-title {
        text-align: center;
        font-family: 'Baloo 2';
        margin-bottom: 20px;
        font-size: 1.4rem;
    }

    /* 🎮 QUEST CARDS */
    .goal-card {
        display: flex;
        gap: 15px;
        align-items: center;

        background: linear-gradient(135deg, #f8fff8, #eef7ee);
        border-radius: 15px;
        padding: 16px;
        margin-bottom: 15px;

        border-left: 6px solid #2e7d32;

        transition: 0.2s;
    }

    .goal-card:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* 🎮 ICON */
    .goal-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 1.5rem;

        width: 45px;
        height: 45px;

        background: #2e7d32;
        color: white;

        border-radius: 12px;

        flex-shrink: 0; /* 👈 prevents shrinking */
    }

    /* 🎯 TEXT */
    .goal-card h3 {
        margin: 0 0 5px;
        font-size: 1rem;
        font-weight: 800;
        color: #1b5e20;
    }

    .goal-card p {
        font-size: 0.95rem;
        color: #333;
    }

    /* ✅ CHECKLIST */
    .goal-list {
        padding-left: 0;
        list-style: none;
    }

    .goal-list li {
        margin-bottom: 6px;
        font-size: 0.95rem;
    }

    /* 🚀 FOOTER */
    .quest-footer {
        text-align: center;
        margin-top: 20px;
        font-weight: 700;
        color: #2e7d32;
        background: #e8f5e9;
        padding: 10px;
        border-radius: 10px;
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

<div class="map-wrapper">

    <!-- 🌍 BACKGROUND -->
    <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">

    <!-- 🌫️ OVERLAY -->
    <div class="overlay"></div>

    <!-- 🎮 CENTER UI -->
    <div class="ui-panel">

        <div class="header">
            <div class="header-icons">🧭 🗺️ ✨</div>
            <div class="subtitle">Module 2</div>

            <h1 style="font-family:'Baloo 2';">
                Kalagayan, Suliranin At Pagtugon Sa Isyung Pangkapaligiran Ng Pilipinas
            </h1>

            <p style="margin-top:10px;">
                Tuklasin ang mga suliraning pangkapaligiran sa Albay at matutunan kung paano tumugon bilang isang responsableng mamamayan.
            </p>
        </div>

        <button onclick="openModal()" class="btn-primary" style="margin-top:20px;">
            Mga Layunin 🎯
        </button>

        <button id="startBtn" onclick="startLesson()" class="btn-primary disabled" style="margin-top:15px;">
            Simulan 🚀
        </button>

    </div>
</div>

<!-- 🎯 MODAL -->
<div id="goalsModal" class="modal">
    <div class="modal-content">

        <h2 class="modal-title">🎯 Mga Layunin</h2>

        <div class="goal-card">
            <div class="goal-icon">📘</div>
            <div>
                <h3>Pamantayang Pangnilalaman</h3>
                <p>Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🎯</div>
            <div>
                <h3>Pamantayan sa Pagganap</h3>
                <p>Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🌱</div>
            <div>
                <h3>Kasanayan sa Pagkatuto</h3>
                <p>Natatalakay ang kalagayan, suliranin at pagtugon sa isyung pangkapaligiran ng Pilipinas</p>
                <ul class="goal-list">
                    <li>✔ Nailalarawan ang kasalukuyang kalagayan, suliranin at mga pagtugon sa isyung pangkapaligiran ng Pilipinas;</li>
                    <li>✔ Nailalahad at nasusuri ang mga epekto ng mga suliranin at isyung pangkapaligirang kinakaharap ng Pilipinas;</li>
                    <li>✔ Napahahalagahan ang kahalagahan ng pakikiisa at pakikibahagi ng lahat;</li>
                    <li>✔ Nakabubuo ng makabuluhang panukalang proyekto.</li>
                </ul>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">✅</div>
            <div>
                <h3>Paksang Aralin</h3>
                <ul class="goal-list">
                    <li>1. Kalagayan at Suliranin</li>
                    <li>2. Pagtugon sa mga Isyu</li>
                </ul>
            </div>
        </div>

        <!-- ✅ TAGALOG BUTTON -->
        <button onclick="closeModal()" class="btn-primary" style="
            width:100%;
            margin-top:20px;
            font-weight:700;
            font-size:1rem;
        ">
            Naiintindihan Ko ✔
        </button>

    </div>
</div>

<script>
let hasOpenedGoals = false;

function openModal(){
    document.getElementById("goalsModal").classList.add("show");
    hasOpenedGoals = true;
    document.getElementById("startBtn").classList.remove("disabled");
}

function closeModal(){
    document.getElementById("goalsModal").classList.remove("show");
}

function startLesson(){
    if(!hasOpenedGoals){
        alert("Basahin muna ang Mga Layunin 😊");
        return;
    }

    window.location.href = '{{ route("pretest.module2") }}';
}

window.onclick = function(e){
    const modal = document.getElementById("goalsModal");
    if(e.target === modal){
        // DO NOTHING ❌
    }
}
</script>

</body>
</html>