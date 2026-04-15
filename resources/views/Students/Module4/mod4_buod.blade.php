<!DOCTYPE html>
<html lang="en">
<head >
<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<title>Module 4 - Buod ng Aralin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0b1b2b 0%, #11384f 45%, #173d2c 100%);
    min-height: 100vh;
    overflow-x: hidden;
    color: #eaf4ff;
}

.container-box {
    max-width: 1200px;
    margin: auto;
    padding: 30px 20px;
}

/* ============ SUMMARY SECTION ============ */
.summary-title {
    text-align: center;
    color: #f8fdff;
    font-weight: 900;
    font-size: 36px;
    letter-spacing: 1px;
    text-shadow: 0 4px 18px rgba(0,0,0,.35);
    margin-bottom: 30px;
}

.summary-container {
    display: flex;
    gap: 30px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
    background: rgba(3, 18, 30, 0.5);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
}

.summary-image {
    flex: 1;
    min-width: 300px;
}

.summary-image img {
    width: 100%;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(124, 231, 255, 0.2);
    border: 2px solid rgba(124, 231, 255, 0.3);
}

.summary-text {
    flex: 1;
    min-width: 300px;
}

.summary-text p {
    color: #d8eefb;
    line-height: 1.8;
    margin-bottom: 16px;
    font-size: 16px;
}

.highlight {
    color: #7ce7ff;
    font-weight: 800;
}

.summary-text hr {
    border: 1px solid rgba(124, 231, 255, 0.2);
    margin: 20px 0;
}

.summary-text strong {
    color: #9dfdba;
}

/* ============ CELEBRATION SECTION ============ */
.celebration-container {
    text-align: center;
    padding: 40px 20px;
    margin-bottom: 30px;
}

.celebration-icon {
    font-size: 80px;
    animation: bounce 1s infinite;
    display: inline-block;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

@keyframes pulse {
    0% { transform: scale(0.8); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: scale(1.1); opacity: 0; }
}

.pulse-badge {
    display: inline-block;
    animation: pulse 1.5s ease-out;
}

.completion-title {
    color: #7ce7ff;
    font-weight: 900;
    font-size: 48px;
    margin-bottom: 10px;
    text-shadow: 0 4px 20px rgba(124, 231, 255, 0.4);
}

.completion-subtitle {
    color: #9dfdba;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 30px;
}

/* ============ STATS SECTION ============ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.stat-card {
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.15), rgba(57, 255, 20, 0.1));
    border: 2px solid rgba(124, 231, 255, 0.3);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    color: #eaf4ff;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: rgba(124, 231, 255, 0.6);
    box-shadow: 0 10px 30px rgba(124, 231, 255, 0.2);
}

.stat-number {
    font-size: 32px;
    font-weight: 900;
    color: #7ce7ff;
}

.stat-label {
    font-size: 14px;
    color: #b8d4e8;
    font-weight: 600;
}

/* ============ ACHIEVEMENTS ============ */
.achievements-section {
    background: rgba(3, 18, 30, 0.6);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 30px;
}

.achievements-title {
    color: #7ce7ff;
    font-weight: 800;
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.achievement-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
}

.achievement-badge {
    background: linear-gradient(135deg, rgba(157, 253, 186, 0.2), rgba(124, 231, 255, 0.15));
    border: 2px solid rgba(157, 253, 186, 0.4);
    border-radius: 12px;
    padding: 15px;
    text-align: center;
    color: #eaf4ff;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
}

.achievement-badge:hover {
    transform: scale(1.05);
    border-color: rgba(157, 253, 186, 0.8);
    box-shadow: 0 8px 20px rgba(157, 253, 186, 0.2);
}

.achievement-icon {
    font-size: 32px;
    margin-bottom: 8px;
}

/* ============ KEY LEARNINGS ============ */
.learnings-section {
    background: rgba(3, 18, 30, 0.6);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 30px;
}

.learnings-title {
    color: #7ce7ff;
    font-weight: 800;
    font-size: 24px;
    margin-bottom: 20px;
}

.learning-item {
    display: flex;
    gap: 15px;
    margin-bottom: 16px;
    padding: 12px;
    background: rgba(157, 253, 186, 0.08);
    border-left: 4px solid #9dfdba;
    border-radius: 8px;
}

.learning-check {
    font-size: 20px;
    color: #9dfdba;
    font-weight: 900;
    min-width: 25px;
}

.learning-text {
    color: #d8eefb;
    line-height: 1.5;
}

/* ============ BUTTONS ============ */
.button-container {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
}

.btn-primary, .btn-secondary {
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, #7ce7ff, #9dfdba);
    color: #0b1b2b;
    box-shadow: 0 12px 30px rgba(124, 231, 255, 0.25);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(124, 231, 255, 0.35);
}

.btn-secondary {
    background: linear-gradient(135deg, #28a745, #45b358);
    color: white;
    box-shadow: 0 12px 30px rgba(40, 167, 69, 0.25);
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(40, 167, 69, 0.35);
}

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
    .summary-title {
        font-size: 28px;
    }
    
    .completion-title {
        font-size: 32px;
    }
    
    .completion-subtitle {
        font-size: 16px;
    }
    
    .summary-container {
        padding: 20px;
        gap: 15px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .achievement-list {
        grid-template-columns: repeat(3, 1fr);
    }
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(11, 27, 43, 0.95); /* Dark blue match */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s ease;
}

.modal-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* REWARD MODAL BOX */
.reward-modal {
    background: #03121e;
    padding: 40px;
    border-radius: 25px;
    max-width: 550px;
    width: 90%;
    text-align: center;
    border: 3px solid #7ce7ff;
    box-shadow: 0 0 50px rgba(124, 231, 255, 0.3);
    transform: scale(0.8);
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.modal-overlay.active .reward-modal {
    transform: scale(1);
}

.reward-image {
    width: 250px;
    height: auto;
    margin-bottom: 25px;
    filter: drop-shadow(0 0 20px rgba(157, 253, 186, 0.5));
}

.reward-title {
    color: #9dfdba;
    font-size: 32px;
    font-weight: 900;
    margin-bottom: 15px;
    text-shadow: 0 0 10px rgba(157, 253, 186, 0.3);
}

.reward-desc {
    color: #d8eefb;
    font-size: 17px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.complete-house-btn {
    background: linear-gradient(135deg, #7ce7ff, #9dfdba);
    color: #0b1b2b;
    padding: 15px 40px;
    border: none;
    border-radius: 50px;
    font-weight: 800;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(124, 231, 255, 0.3);
}

.complete-house-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 35px rgba(124, 231, 255, 0.5);
}

.animation-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.9);
    z-index: 10001;
    display: none; /* Controlled by JS */
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.anim-wrapper {
    position: relative;
    width: 100%;
    max-width: 600px;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.house-part {
    position: absolute;
    height: auto;
    transition: opacity 0.6s ease, transform 0.8s ease-out;
    opacity: 0;
    pointer-events: none; /* Prevents images from blocking button clicks */
}

/* Specific Sizes for Module 4 Pieces */
#finalWalls { 
    width: 50%; 
    transform: scale(0.9); 
    opacity: 0;
}

#mod4Roof { 
    width: 42%; 
    /* Start offset to the right and slightly up */
    transform: translate(150px, -40px); 
    opacity: 0;
}

#completeHouse {
    width: 50% !important;
    transform: scale(0.8);
    opacity: 0;
    z-index: 10;
}

#completeHouse.fade-in-center {
    opacity: 1 !important;
    transform: scale(1) !important;
}

/* Animation States */
.fade-in-center { 
    opacity: 1 !important; 
    transform: scale(1) !important; 
}

.slide-in-roof { 
    opacity: 1 !important; 
    /* This moves it to the horizontal center while keeping the vertical alignment */
    transform: translate(0, -40px) !important; 
}

.fade-out-all { opacity: 0 !important; transform: scale(1.1) !important; }

/* Final Text/Button Container */
.final-text-container {
    text-align: center;
    margin-top: 20px;
    opacity: 0;
    transition: opacity 1s ease;
    padding: 0 20px;
}

.visible-text { opacity: 1 !important; }

.final-title { color: #fcc419; font-weight: 900; font-size: 32px; margin-bottom: 10px; }
.final-desc { color: #ffffff; font-size: 18px; max-width: 500px; margin-bottom: 25px; }

.btn-cert {
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    font-weight: 800;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    /* Gold/Yellow Gradient for the Certificate feel */
    background: linear-gradient(135deg, #fcc419, #ffdd59);
    color: #0b1b2b;
    box-shadow: 0 12px 30px rgba(252, 196, 25, 0.25);
}

.btn-cert:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(252, 196, 25, 0.45);
    color: #000;
}
</style>
</head>

<body>

<div class="container-box">

    <!-- ============ SUMMARY SECTION ============ -->
    <h1 class="summary-title">VI. BUOD NG ARALIN</h1>
    
    <div class="summary-container">
        <!-- LEFT IMAGE -->
        <div class="summary-image">
            <img src="{{ asset('pictures/Module4/buod.png') }}" alt="Buod ng Aralin">
        </div>

        <!-- RIGHT TEXT -->
        <div class="summary-text">

            <p>
            Mahusay! Sa araling ito natutunan mo ang kahalagahan ng 
            <span class="highlight">kahandaan</span>, 
            <span class="highlight">disiplina</span>, at 
            <span class="highlight">kooperasyon</span> 
            sa pagtugon sa mga hamong pangkapaligiran.
            </p>

            <p>
            Nalalaman mo na ang pagiging handa bago ang sakuna, pagsunod sa mga babala habang ito ay nangyayari,
            at pakikiisa sa komunidad pagkatapos nito ay mahalaga upang mapanatili ang kaligtasan ng lahat.
            </p>

            <hr>

            <p>
            Nauunawaan mo rin na kahit hindi mapipigilan ang sakuna, maaari nating mabawasan ang pinsala kung tayo ay
            <strong>handa, disiplinado, at nagtutulungan.</strong>
            </p>

        </div>
    </div>

    <!-- ============ GAMIFIED COMPLETION ============ -->
    
    <!-- CELEBRATION -->
    <div class="celebration-container">
        <div class="celebration-icon pulse-badge">🎉</div>
        <div class="completion-title">TAPOS NA!</div>
        <div class="completion-subtitle">Matagumpay mong natapos ang Module 4</div>
    </div>

    <!-- CALL TO ACTION -->
    <div class="button-container">
        <a href="{{ route('module4.home') }}" class="btn-secondary">
            ↶ Bumalik sa Module
        </a>
        <a href="/dashboard" class="btn-primary">
            🏠 Balik sa Dashboard →
        </a>
    </div>

</div>

<div class="modal-overlay" id="rewardModal">
    <div class="reward-modal">
        <h2 class="reward-title">🏠 Kumpleto na ang Bahay!</h2>
        
        <img src="{{ asset('pictures/Module4/mod4housepart.png') }}" alt="Roof Reward" class="reward-image">
        
        <div class="reward-desc">
            Kamangha-mangha! Nakuha mo na ang huling bahagi: <strong>Ang Bubong</strong>. 
            <br><br>
            Ang bubong na ito ang kumakatawan sa iyong <strong>ganap na kahandaan</strong>. Ngayon, ang iyong <strong>Bahay</strong> ay tapos na—simbolo na ikaw ay may sapat na kaalaman at kasanayan upang maprotektahan ang iyong sarili at komunidad mula sa anumang sakuna.
        </div>



        <button class="complete-house-btn" onclick="closeModal()">Tapusin ang Konstruksyon</button>
    </div>
</div>

<div id="finalAnimOverlay" class="animation-overlay">
    <div class="anim-wrapper">
        <img src="{{ asset('pictures/Module 3/finalhousewalls.png') }}" id="finalWalls" class="house-part">
        
        <img src="{{ asset('pictures/Module4/mod4housepart.png') }}" id="mod4Roof" class="house-part">
        
        <img src="{{ asset('pictures/Module4/finalrewardhouse.png') }}" id="completeHouse" class="house-part">
    </div>

    <div id="finalText" class="final-text-container">
        <h2 class="final-title">Ang Bahay ay Ganap na!</h2>
        <p class="final-desc">
            Ang <strong>bubong</strong> ang simbolo ng iyong proteksyon at ganap na kaalaman. 
            Ngayon, ang iyong tahanan ay matatag na laban sa anumang sakuna.
        </p>
        <a href="{{ route('certificate.view') }}" class="btn-cert">
            📜 Kunin ang iyong Sertipiko →
        </a>
       <a href="{{ route('module4.references') }}" class="btn-cert" style="background: linear-gradient(135deg, #6c757d, #495057); color: white; margin-left: 10px;">
            📚 View references
        </a>

        <br><br>

       <button onclick="closeFinalOverlay()" 
            style="background: none; border: 2px solid rgba(124,231,255,0.4); color: #7ce7ff; padding: 10px 25px; border-radius: 50px; font-weight: 700; font-size: 15px; cursor: pointer; transition: 0.3s;"
            onmouseover="this.style.borderColor='rgba(124,231,255,0.9)'"
            onmouseout="this.style.borderColor='rgba(124,231,255,0.4)'">
            ↶ Bumalik sa Buod
        </button>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('rewardModal').classList.remove('active');
        
        const overlay = document.getElementById('finalAnimOverlay');
        const walls = document.getElementById('finalWalls');
        const roof = document.getElementById('mod4Roof');
        const completeHouse = document.getElementById('completeHouse');
        const finalText = document.getElementById('finalText');

        overlay.style.display = 'flex';

        setTimeout(() => {
            // Step A: Walls appear
            walls.classList.add('fade-in-center');
            
            setTimeout(() => {
                // Step B: Roof slides in
                roof.classList.add('slide-in-roof');
                
                setTimeout(() => {
                    // ==========================================
                    // STEP C: THIS IS WHERE THE CODE GOES
                    // ==========================================
                    walls.classList.remove('fade-in-center');
                    roof.classList.remove('slide-in-roof');

                    walls.style.opacity = '0';
                    walls.style.transform = 'scale(1.1)';
                    roof.style.opacity = '0';
                    roof.style.transform = 'translate(0, -40px) scale(1.1)'; 
                    
                    setTimeout(() => {
                        // Step D: Physical removal and show final reward

                    
                        walls.style.display = 'none';
                        roof.style.display = 'none';

                        completeHouse.classList.add('fade-in-center');
                        finalText.classList.add('visible-text');
                        
                        confetti({
                            particleCount: 150,
                            spread: 70,
                            origin: { y: 0.6 }
                        });
                    }, 600); 
                }, 2000); // Step C timing
            }, 1000); // Step B timing
        }, 300); // Step A timing
    }

    // Initial confetti when page loads (your existing code)
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.getElementById('rewardModal').classList.add('active');
        }, 1000);
    });

    function launchFinalConfetti() {
        var duration = 5 * 1000;
        var animationEnd = Date.now() + duration;
        var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 10000 };

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        var interval = setInterval(function() {
            var timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            var particleCount = 50 * (timeLeft / duration);
            // Confetti cannons from left and right
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
        }, 250);
    }

    // Trigger on load
    window.addEventListener('load', function() {
        setTimeout(() => {
            launchFinalConfetti();
            document.getElementById('rewardModal').classList.add('active');
        }, 1000);
    });

    function closeFinalOverlay() {
        const overlay = document.getElementById('finalAnimOverlay');
        overlay.style.display = 'none';
    }
</script>

</body>
</html>