@php
    session(['module3_completed' => true]);
    session(['module4_unlocked' => true]);
@endphp

@extends('Students.studentslayout')

@section('title', 'Buod ng Aralin')

@section('content')

<style>
    body {
        background: linear-gradient(160deg, #020617 0%, #0b1020 50%, #10172c 100%);
        font-family: 'Poppins', sans-serif;
        color: #e2e8f0;
    }

    .buod-container {
        max-width: 1100px;
        margin: auto;
        padding: 30px 20px;
    }

    .buod-card {
        background: rgba(15, 23, 42, 0.9);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        border: 1px solid rgba(0,242,255,0.2);
    }

    .buod-title {
        font-size: 2.5rem;
        font-weight: 900;
        text-align: center;
        color: #00f2ff;
        margin-bottom: 20px;
    }

    .buod-title span {
        color: #94a3b8;
        font-size: 1.2rem;
    }

    .buod-image {
        width: 100%;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    }

    .buod-text {
        line-height: 1.8;
        font-size: 1rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .buod-text strong {
        color: #00f2ff;
    }

    .highlight-box {
        background: rgba(255, 255, 0, 0.1);
        border-left: 5px solid #facc15;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .tandaan {
        margin-top: 30px;
        padding: 20px;
        border-radius: 15px;
        background: rgba(0, 242, 255, 0.08);
        border: 1px solid rgba(0,242,255,0.2);
    }

    .tandaan h3 {
        color: #00f2ff;
        margin-bottom: 10px;
    }

    .tandaan p {
        margin-bottom: 8px;
    }

    .btn-next {
        display: inline-block;
        margin-top: 30px;
        padding: 15px 30px;
        font-size: 1.2rem;
        font-weight: 900;
        border-radius: 50px;
        background: linear-gradient(135deg, #00f2ff, #39ff14);
        color: #000;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0,242,255,0.3);
    }

    .btn-next:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,242,255,0.5);
    }

    .center {
        text-align: center;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* MODAL CONTENT */
    .reward-modal {
        background: #1e293b; /* Darker theme to match your page */
        padding: 40px;
        border-radius: 30px;
        max-width: 500px;
        width: 85%;
        text-align: center;
        transform: translateY(30px);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 3px solid #00f2ff;
        box-shadow: 0 0 30px rgba(0, 242, 255, 0.3);
    }

    .modal-overlay.active .reward-modal {
        transform: translateY(0);
    }

    .reward-image {
        width: 220px;
        height: auto;
        margin-bottom: 20px;
        filter: drop-shadow(0 5px 15px rgba(0,242,255,0.4));
    }

    .reward-title {
        font-family: 'Poppins', sans-serif;
        font-size: 26px;
        font-weight: 900;
        color: #39ff14;
        margin-bottom: 10px;
    }

    .reward-desc {
        font-size: 15px;
        color: #cbd5e1;
        line-height: 1.6;
    }

    .close-reward-btn {
        margin-top: 25px;
        background: linear-gradient(135deg, #00f2ff, #39ff14);
        color: #000;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .close-reward-btn:hover {
        transform: scale(1.1);
    }

    .animation-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85); /* Dim background to focus on images */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease;
    }

    .animation-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .transform-wrapper {
        position: relative;
        width: 600px; 
        height: 500px; /* Increased height */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .anim-img {
        position: absolute;
        height: auto; /* Keep this 'auto' to maintain aspect ratio */
        opacity: 0;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        
        /* ADJUST THIS VALUE to shrink all three house images */
        width: 50%; /* Changed from 60% or 70% to 50% for a smaller size */
        
        transform: translateY(-20px); /* Keeps the house centered higher up */
    }

    #animPart {
        /* Adjust this percentage until it fits perfectly on your foundation */
        width: 20% !important; 
        height: auto;
    }

    .anim-img:not(#animPart) {
        width: 50%; /* foundation and final walls size */
        height: auto;
    }

    /* Foundation: Fades in at center */
    .show-foundation {
        opacity: 1;
    }

    /* House Part: Fades in slightly to the left then slides to center */
    .house-part-init {
        opacity: 0;
        /* REDUCED horizontal starting position to match the smaller image size */
        transform: translate(-80px, -20px); /* Changed from -100px or -150px */
    }

    .house-part-slide {
        opacity: 1;
        transform: translate(0, -20px);
    }

    /* Combined Fade Out */
    .fade-out-both {
        opacity: 0 !important;
        transform: scale(0.95);
        filter: blur(5px);
    }

    /* Final Walls: Fades in as the others fade out */
    .show-walls {
        opacity: 1 !important;
        transform: translate(0, -50px) scale(1);
    }

    .status-msg {
        position: absolute;
        bottom: -50px;
        color: #39ff14;
        font-weight: 900;
        font-size: 1.8rem;
        text-shadow: 0 0 15px rgba(57, 255, 20, 0.5);
        opacity: 0;
        transition: 0.5s;
    }
    .status-msg.visible { opacity: 1; bottom: -20px; }

    .matched-congrats-container {
        position: absolute;
        /* Pull the text up more since the house is now smaller */
        bottom: -110px; 
        width: 100%;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.8s ease;
        z-index: 20;
    }


    .matched-congrats-container.visible {
        opacity: 1;
        visibility: visible;
        bottom: -90px; /* Final resting position of the text */
    }

    .yellow-matched-title {
        color: #fcc419; /* Yellow matched from image */
        font-weight: 900;
        font-size: 32px; /* Large matched size */
        margin-bottom: 25px; /* Spacing below title */
    }

    .white-matched-desc {
        margin-bottom: 15px;
        font-size: 18px;
        max-width: 600px;
    }

    /* Green Capsule Button Matched from image */
    .btn-capsule-green {
        background: #5eae4e; /* Green color from image */
        color: #ffffff;
        border: none;
        padding: 16px 36px; /* Size/shape matched */
        border-radius: 60px; /* Perfectly round edges */
        font-weight: bold;
        font-size: 18px; /* Button text size matched */
        cursor: pointer;
        display: inline-block;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Subtle shadow matched */
        transition: 0.3s ease;
    }

    .btn-capsule-green:hover { transform: scale(1.08); }
</style>

<div class="buod-container">
    <div class="buod-card">

        <div class="buod-title">
            Buod ng Aralin <br>
        </div>

        <!-- IMAGE -->
        <img src="{{ asset('pictures/buod.png') }}" class="buod-image" alt="Buod ng Aralin">

        <!-- TEXT -->
        <div class="buod-text">
            Sa araling ito, natutunan mo ang kahalagahan ng <strong>paghahanda sa harap ng mga panganib at kalamidad</strong> na dulot ng suliraning pangkapaligiran.
            Naunawaan mo ang mahahalagang konsepto tulad ng <strong>hazard, vulnerability, risk, disaster, at resilience</strong>,
            at kung paano nagkakaugnay ang mga ito sa pagbuo ng isang sakuna.
        </div>

        <div class="buod-text">
            Napag-aralan mo rin ang iba’t ibang <strong>paraan ng pagtugon sa sakuna</strong>, tulad ng
            <strong>top-down</strong> at <strong>bottom-up approach</strong>, at kung bakit mahalaga ang aktibong partisipasyon ng komunidad
            sa pamamagitan ng <strong>Community-Based Disaster Risk Reduction and Management (CBDRRM)</strong>.
        </div>

        <div class="buod-text">
            Sa pamamagitan ng iba’t ibang gawain, natutuhan mo ang mga <strong>dapat gawin bago, habang, at pagkatapos ng sakuna</strong>
            tulad ng bagyo, baha, lindol, at pagputok ng bulkan.
            Nalinang ang iyong kakayahan sa <strong>tamang pagpapasya</strong> at pagiging <strong>handa</strong> upang maprotektahan ang sarili,
            pamilya, at komunidad.
        </div>

        <div class="buod-text">
            Higit sa lahat, natutunan mo na ang <strong>kahandaan, kaalaman, at pakikiisa</strong> ay mahalagang susi upang
            <strong>mabawasan ang pinsala ng kalamidad</strong>.
        </div>

        <!-- TANDAAN -->
        <div class="tandaan">
            <h3>💡 Tandaan:</h3>
            <p>👉 Ang sakuna ay hindi maiiwasan, ngunit ang pinsala nito ay maaaring <strong>mabawasan</strong> sa pamamagitan ng tamang paghahanda.</p>
            <p>👉 Ang isang handa at maalam na mamamayan ay mahalagang bahagi ng isang <strong>ligtas na komunidad</strong>.</p>
        </div>

        <!-- BUTTON -->
        <div class="center">
            <a href="{{ route('student.map') }}" class="btn-next">
                🗺️ Bumalik sa Main Map
            </a>
        </div>

    </div>
</div>

<div class="modal-overlay" id="rewardModal">
    <div class="reward-modal">
        <h2 class="reward-title">🛠️ Bagong Materyales!</h2>
        
        <img src="{{ asset('pictures/Module 3/mod3housepart.png') }}" alt="Wall Materials" class="reward-image">
        
        <div class="reward-desc">
            Magaling! Dahil sa iyong pagsisikap na matapos ang araling ito, nakuha mo ang mga <strong>Materyales para sa Dingding</strong> 
            <br><br>
            Ang mga ito ang magsisilbing <strong>proteksyon</strong> ng iyong bahay. Tulad ng kaalamang natutunan mo, ang matibay na dingding ay simbolo ng ating kakayahang harapin at lagpasan ang anumang hagupit ng sakuna.
        </div>

        <button class="close-reward-btn" onclick="closeModal()">Ipagpatuloy ang Pagbuo</button>
    </div>
</div>

<div class="animation-overlay" id="animationOverlay">
    <div class="transform-wrapper">
        <img src="{{ asset('pictures/Mod2_FinalAct/finalhousefoundation.png') }}" id="animFoundation" class="anim-img">
        <img src="{{ asset('pictures/Module 3/mod3housepart.png') }}" id="animPart" class="anim-img house-part-init" style="z-index: 10;">
        <img src="{{ asset('pictures/Module 3/finalhousewalls.png') }}" id="animWalls" class="anim-img">

        <div id="congratsBox" class="matched-congrats-container">
            <div class="yellow-matched-title">Matatag na Dingding!</div>
            <div class="white-matched-desc">
                Ang mga <strong>dingding</strong> na ito ay simbolo ng iyong <strong>resilience</strong>—ang kakayahang manatiling matatag at protektado laban sa anumang hamon ng sakuna. Ang iyong kaalaman ay nagiging bahagi na ng iyong tahanan.
            </div>
            <button class="btn-capsule-green" onclick="goMap()">Ipagpatuloy ang Paglalakbay 🗺️</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
    function closeModal() {
        // 1. Hide the reward announcement
        document.getElementById('rewardModal').classList.remove('active');

        // 2. Start the animation sequence
        setTimeout(() => {
            const overlay = document.getElementById('animationOverlay');
            const foundation = document.getElementById('animFoundation');
            const part = document.getElementById('animPart');
            const walls = document.getElementById('animWalls');
            const congratsBox = document.getElementById('congratsBox'); // Target the text container

            overlay.classList.add('active');

            // Step A: Foundation fades in
            setTimeout(() => { 
                foundation.classList.add('show-foundation'); 
            }, 500);

            // Step B: House part fades in and slides to center
            setTimeout(() => { 
                part.classList.add('house-part-slide'); 
            }, 1800);

            // Step C: Swap images and show the Text/Button
            setTimeout(() => {
                foundation.classList.add('fade-out-both');
                part.classList.add('fade-out-both');
                
                setTimeout(() => {
                    walls.classList.add('show-walls');
                    
                    // FIXED: Added the 'visible' class to the correct ID
                    congratsBox.classList.add('visible'); 
                    
                    // Launch a small second burst of confetti for the completion
                    launchConfetti();
                }, 200); 

            }, 2600); 

        }, 300);
    }

    // New function to handle the button click manually
    function goMap() {
        window.location.href = "{{ route('student.map') }}";
    }

    function launchConfetti() {
        let duration = 1500;
        let end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 7,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#00f2ff', '#39ff14', '#ffffff']
            });
            confetti({
                particleCount: 7,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#00f2ff', '#39ff14', '#ffffff']
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    }

    window.onload = function() {
        // Bahagyang delay para mas maganda ang dating ng popup
        setTimeout(() => {
            launchConfetti();
            document.getElementById('rewardModal').classList.add('active');
        }, 800);
    };
</script>

@endsection