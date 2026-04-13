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

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
    function closeModal() {
        document.getElementById('rewardModal').classList.remove('active');
    }

    function launchConfetti() {
        let duration = 3000;
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