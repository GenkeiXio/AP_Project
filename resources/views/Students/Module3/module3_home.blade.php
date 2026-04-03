<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Module 3</title>

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
    <img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

    <!-- 🌫️ OVERLAY -->
    <div class="overlay"></div>

    <!-- 🎮 CENTER UI -->
    <div class="ui-panel">

        <div class="header">
            <div class="header-icons">🧭 🗺️ ✨</div>
            <div class="subtitle">Module 3</div>

            <h1 style="font-family:'Baloo 2';">
                Paghahandang Nararapat Gawin sa Harap ng Panganib na Dulot ng Suliraning Pangkapaligiran
            </h1>

            <!-- <p style="margin-top:10px;">
                Tuklasin ang mga suliraning pangkapaligiran sa Albay at matutunan kung paano tumugon bilang isang responsableng mamamayan.
            </p> -->
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
                <h3>PAMANTAYANG PANGNILALAMAN</h3>
                <p>Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🎯</div>
            <div>
                <h3>PAMANTAYAN SA PAGGANAP</h3>
                <p>Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🌱</div>
            <div>
                <h3>KASANAYAN SA PAGKATUTO</h3>
                <p>Natutukoy ang mga paghahandang nararapat gawin sa harap ng panganib na dulot ng mga suliraning pangkapaligiran. (MELC3)</p>
                <ul class="goal-list">
                    <li>✔ naibibigay ang katuturan ng Disaster Management;</li>
                    <li>✔ nasusuri ang mga konsepto o termino na may kaugnayan sa disaster management;</li>
                    <li>✔ naipaliliwanag ang katangian ng top-down approach sa pagharap sa suliraning pangkapaligiran;</li>
                    <li>✔ napaghahambing ang top-down at bottom-up approach;</li>
                    <li>✔ nasusuri ang mga layunin ng Community Based-Disaster and Risk Management;</li>
                    <li>✔ matutukoy ang mga paghahanda na nararapat gawin sa harap ng mga panganib na dulot ng suliraning pangkapaligiran; at</li>
                    <li>✔ napahahalagahan ang bahaging ginagampanan bilang isang mamamayan para sa ligtas na pamayanang kaniyang kinabibilangan.</li>
                </ul>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">✅</div>
            <div>
                <h3>Paksang Aralin</h3>
                <ul class="goal-list">
                    <li>1. Ang Disaster Management</li>
                    <li>2. Mga Paghahandang Nararapat Gawin sa Harap ng Panganib/Kalamidad</li>
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

    window.location.href = '{{ route("module3.pretest") }}';
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