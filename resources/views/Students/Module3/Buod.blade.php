@php
    session(['module3_completed' => true]);
    session(['module4_unlocked' => true]);
@endphp

@extends('Students.studentslayout')

@section('title', 'Buod ng Aralin')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                        url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .buod-container {
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px;
        }

        /* WOODEN CARD STYLE */
        .buod-card {
            background: #e0c9a6;
            background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
            border: 6px solid #5d4037;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .buod-title {
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            color: #3d2b1f;
            font-family: 'Nunito', sans-serif;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .buod-title span {
            color: #5d4037;
            font-size: 1.2rem;
        }

        .buod-image {
            width: 100%;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 3px solid #5d4037;
        }

        .buod-text {
            line-height: 1.8;
            font-size: 1rem;
            color: #3a2a1a;
            margin-bottom: 20px;
        }

        .buod-text strong {
            color: #5d4037;
            font-weight: 800;
        }

        .highlight-box {
            background: rgba(93, 64, 55, 0.15);
            border-left: 5px solid #c5a059;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .tandaan {
            margin-top: 30px;
            padding: 20px;
            border-radius: 16px;
            background: rgba(93, 64, 55, 0.2);
            border: 2px solid #5d4037;
        }

        .tandaan h3 {
            color: #3d2b1f;
            margin-bottom: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
        }

        .tandaan p {
            margin-bottom: 8px;
            color: #3a2a1a;
        }

        .btn-next {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 35px;
            font-size: 1.1rem;
            font-weight: 800;
            border-radius: 50px;
            background: linear-gradient(135deg, #3d2b1f, #5d4037);
            color: #f1f5f9;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid #8b5e3c;
            font-family: 'Nunito', sans-serif;
        }

        .btn-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #5d4037, #7a5a4a);
            color: #ffffff;
        }

        .center {
            text-align: center;
        }

        /* MODAL OVERLAY - Wood Theme */
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

        .reward-modal {
            background: #e0c9a6;
            background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
            padding: 40px;
            border-radius: 30px;
            max-width: 500px;
            width: 85%;
            text-align: center;
            transform: translateY(30px);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 6px solid #5d4037;
            box-shadow: 0 0 30px rgba(93, 64, 55, 0.3);
        }

        .modal-overlay.active .reward-modal {
            transform: translateY(0);
        }

        .reward-image {
            width: 220px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }

        .reward-title {
            font-family: 'Nunito', sans-serif;
            font-size: 26px;
            font-weight: 900;
            color: #3d2b1f;
            margin-bottom: 10px;
        }

        .reward-desc {
            font-size: 15px;
            color: #3a2a1a;
            line-height: 1.6;
        }

        .close-reward-btn {
            margin-top: 25px;
            background: linear-gradient(135deg, #3d2b1f, #5d4037);
            color: #f1f5f9;
            border: 1px solid #8b5e3c;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Nunito', sans-serif;
        }

        .close-reward-btn:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #5d4037, #7a5a4a);
        }

        /* ANIMATION OVERLAY - Wood Theme */
        .animation-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
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
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .anim-img {
            position: absolute;
            height: auto;
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            width: 50%;
            transform: translateY(-20px);
        }

        #animPart {
            width: 20% !important;
            height: auto;
        }

        .anim-img:not(#animPart) {
            width: 50%;
            height: auto;
        }

        .show-foundation {
            opacity: 1;
        }

        .house-part-init {
            opacity: 0;
            transform: translate(-80px, -20px);
        }

        .house-part-slide {
            opacity: 1;
            transform: translate(0, -20px);
        }

        .fade-out-both {
            opacity: 0 !important;
            transform: scale(0.95);
            filter: blur(5px);
        }

        .show-walls {
            opacity: 1 !important;
            transform: translate(0, -50px) scale(1);
        }

        .matched-congrats-container {
            position: absolute;
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
            bottom: -90px;
        }

        .yellow-matched-title {
            color: #fcc419;
            font-weight: 900;
            font-size: 32px;
            margin-bottom: 25px;
            font-family: 'Nunito', sans-serif;
        }

        .white-matched-desc {
            margin-bottom: 15px;
            font-size: 16px;
            max-width: 600px;
            color: #f1f5f9;
        }

        .btn-capsule-green {
            background: #5eae4e;
            color: #ffffff;
            border: none;
            padding: 14px 32px;
            border-radius: 60px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            transition: 0.3s ease;
            font-family: 'Nunito', sans-serif;
        }

        .btn-capsule-green:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .buod-card {
                padding: 20px;
            }
            .buod-title {
                font-size: 1.8rem;
            }
            .buod-text {
                font-size: 0.9rem;
            }
            .transform-wrapper {
                width: 350px;
                height: 400px;
            }
            .yellow-matched-title {
                font-size: 24px;
            }
            .white-matched-desc {
                font-size: 13px;
            }
            .btn-capsule-green {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>

    <div class="buod-container">
        <div class="buod-card">

            <div class="buod-title">
                📖 Buod ng Aralin
            </div>

            <!-- IMAGE -->
            <img src="{{ asset('pictures/buod.png') }}" class="buod-image" alt="Buod ng Aralin">

            <!-- TEXT -->
            <div class="buod-text">
                Sa araling ito, natutunan mo ang kahalagahan ng <strong>paghahanda sa harap ng mga panganib at
                    kalamidad</strong> na dulot ng suliraning pangkapaligiran.
                Naunawaan mo ang mahahalagang konsepto tulad ng <strong>hazard, vulnerability, risk, disaster, at
                    resilience</strong>,
                at kung paano nagkakaugnay ang mga ito sa pagbuo ng isang sakuna.
            </div>

            <div class="buod-text">
                Napag-aralan mo rin ang iba’t ibang <strong>paraan ng pagtugon sa sakuna</strong>, tulad ng
                <strong>top-down</strong> at <strong>bottom-up approach</strong>, at kung bakit mahalaga ang aktibong
                partisipasyon ng komunidad
                sa pamamagitan ng <strong>Community-Based Disaster Risk Reduction and Management (CBDRRM)</strong>.
            </div>

            <div class="buod-text">
                Sa pamamagitan ng iba’t ibang gawain, natutuhan mo ang mga <strong>dapat gawin bago, habang, at pagkatapos
                    ng sakuna</strong>
                tulad ng bagyo, baha, lindol, at pagputok ng bulkan.
                Nalinang ang iyong kakayahan sa <strong>tamang pagpapasya</strong> at pagiging <strong>handa</strong> upang
                maprotektahan ang sarili,
                pamilya, at komunidad.
            </div>

            <div class="buod-text">
                Higit sa lahat, natutunan mo na ang <strong>kahandaan, kaalaman, at pakikiisa</strong> ay mahalagang susi
                upang
                <strong>mabawasan ang pinsala ng kalamidad</strong>.
            </div>

            <!-- TANDAAN -->
            <div class="tandaan">
                <h3>💡 Tandaan:</h3>
                <p>👉 Ang sakuna ay hindi maiiwasan, ngunit ang pinsala nito ay maaaring <strong>mabawasan</strong> sa
                    pamamagitan ng tamang paghahanda.</p>
                <p>👉 Ang isang handa at maalam na mamamayan ay mahalagang bahagi ng isang <strong>ligtas na
                        komunidad</strong>.</p>
            </div>

            <!-- BUTTON -->
            <div class="center">
                <a href="{{ route('student.map') }}" class="btn-next">
                    🗺️ Bumalik sa Main Map
                </a>
            </div>

        </div>
    </div>

    <!-- REWARD MODAL -->
    <div class="modal-overlay" id="rewardModal">
        <div class="reward-modal">
            <h2 class="reward-title">🛠️ Bagong Materyales!</h2>

            <img src="{{ asset('pictures/Module 3/mod3housepart.png') }}" alt="Wall Materials" class="reward-image">

            <div class="reward-desc">
                Magaling! Dahil sa iyong pagsisikap na matapos ang araling ito, nakuha mo ang mga <strong>Materyales para sa
                    Dingding</strong>
                <br><br>
                Ang mga ito ang magsisilbing <strong>proteksyon</strong> ng iyong bahay. Tulad ng kaalamang natutunan mo,
                ang matibay na dingding ay simbolo ng ating kakayahang harapin at lagpasan ang anumang hagupit ng sakuna.
            </div>

            <button class="close-reward-btn" onclick="closeModal()">Ipagpatuloy ang Pagbuo</button>
        </div>
    </div>

    <!-- ANIMATION OVERLAY -->
    <div class="animation-overlay" id="animationOverlay">
        <div class="transform-wrapper">
            <img src="{{ asset('pictures/Mod2_FinalAct/finalhousefoundation.png') }}" id="animFoundation" class="anim-img">
            <img src="{{ asset('pictures/Module 3/mod3housepart.png') }}" id="animPart" class="anim-img house-part-init"
                style="z-index: 10;">
            <img src="{{ asset('pictures/Module 3/finalhousewalls.png') }}" id="animWalls" class="anim-img">

            <div id="congratsBox" class="matched-congrats-container">
                <div class="yellow-matched-title">🏠 Matatag na Dingding!</div>
                <div class="white-matched-desc">
                    Ang mga <strong>dingding</strong> na ito ay simbolo ng iyong <strong>resilience</strong>—ang kakayahang
                    manatiling matatag at protektado laban sa anumang hamon ng sakuna. Ang iyong kaalaman ay nagiging bahagi
                    na ng iyong tahanan.
                </div>
                <button class="btn-capsule-green" onclick="exitAnimation()">Bumalik sa Buod ↩️</button>
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
                const congratsBox = document.getElementById('congratsBox');

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
                        congratsBox.classList.add('visible');
                        launchConfetti();
                    }, 200);

                }, 2600);

            }, 300);
        }

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
                    colors: ['#c5a059', '#5d4037', '#ffffff']
                });
                confetti({
                    particleCount: 7,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                    colors: ['#c5a059', '#5d4037', '#ffffff']
                });

                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        }

        window.onload = function () {
            setTimeout(() => {
                launchConfetti();
                document.getElementById('rewardModal').classList.add('active');
            }, 800);
        };

        function exitAnimation() {
            const overlay = document.getElementById('animationOverlay');
            if (overlay) {
                overlay.classList.remove('active');
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 500);
            }

            const rewardModal = document.getElementById('rewardModal');
            if (rewardModal) {
                rewardModal.style.display = 'none';
                rewardModal.classList.remove('active');
            }
        }
    </script>

@endsection