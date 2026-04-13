<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Module 2 Complete</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&family=Baloo+2:wght@700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
body{
    margin:0;
    font-family:'Nunito',sans-serif;
    overflow:hidden;
}

/* 🌍 BACKGROUND (FROM INNER MAP) */
.map-wrapper{
    position:fixed;
    inset:0;
}

.background-map{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* DARK OVERLAY FOR READABILITY */
.overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.35);
}

/* 🎯 PERFECT CENTER (NO SHIFT EVER) */
.container{
    position:fixed;
    inset:0;

    display:flex;
    justify-content:center;
    align-items:center;

    width:100%;
}

/* ✨ CARD */
.card{
    background:rgba(255,255,255,0.92);
    backdrop-filter:blur(12px);
    border-radius:24px;
    padding:30px;
    max-width:850px;
    width:90%;

    box-shadow:0 20px 50px rgba(0,0,0,0.4);
    text-align:center;

    animation: pop 0.5s ease;
}

/* HEADER */
h1{
    font-family:'Baloo 2';
    font-size:34px;
    margin-bottom:10px;
    color:#2c3e50;
}

.subtitle{
    font-weight:700;
    margin-bottom:15px;
    color:#555;
}

/* SUMMARY TEXT */
.summary{
    text-align:left;
    font-size:15px;
    line-height:1.7;
    color:#333;
    margin-top:20px;
}

/* BUTTON */
.btn{
    margin-top:25px;
    padding:16px 32px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#5eae4e,#3d8f35);
    color:white;
    font-weight:bold;
    font-size:16px;
    cursor:pointer;

    box-shadow:0 8px 20px rgba(0,0,0,0.3);
    transition:0.2s;
}

.btn:hover{
    transform:scale(1.08);
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
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
    background: white;
    padding: 40px;
    border-radius: 30px;
    max-width: 500px;
    width: 85%;
    text-align: center;
    transform: translateY(30px);
    transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 5px solid #f1c40f; /* Gold border for reward */
}

.modal-overlay.active .reward-modal {
    transform: translateY(0);
}

.reward-image {
    width: 180px;
    height: auto;
    margin-bottom: 20px;
    filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));
}

.reward-title {
    font-family: 'Baloo 2';
    font-size: 28px;
    color: #d35400;
    margin-bottom: 10px;
}

.reward-desc {
    font-size: 16px;
    color: #2c3e50;
    line-height: 1.6;
}

.close-reward-btn {
    margin-top: 25px;
    background: #27ae60;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* 🔥 FIXED ANIMATION (NO translate conflict) */
@keyframes pop{
    from{
        transform: scale(0.85);
        opacity:0;
    }
    to{
        transform: scale(1);
        opacity:1;
    }
}
</style>
</head>

<body>

<div class="map-wrapper">

    <!-- 🌍 SAME BACKGROUND -->
    <img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">
    <div class="overlay"></div>

    <div class="container">
        <div class="card">

            <h1>🎉 Congratulations!</h1>
            <div class="subtitle">Natapos mo na ang Module 2!</div>

            <div class="summary">
                <strong>Buod ng Aralin:</strong><br><br>

                Sa araling ito, natutunan mo ang kalagayan, mga suliranin, at pagtugon sa isyung pangkapaligiran sa Pilipinas tulad ng solid waste, deforestation, at climate change. 
                Napag-alaman na ang mga suliraning ito ay kadalasang dulot ng gawain ng tao tulad ng maling pagtatapon ng basura, illegal logging, at labis na paggamit ng likas na yaman. 
                Dahil dito, nagkakaroon ng mga epekto tulad ng pagbaha, pagguho ng lupa, polusyon, at mas malalakas na kalamidad. 

                <br><br>

                Gayunpaman, may mga solusyon tulad ng waste segregation, pagtatanim ng puno, paggamit ng malinis na enerhiya, at pakikiisa sa mga programang pangkalikasan. 
                Mahalaga rin ang papel ng pamahalaan sa pamamagitan ng mga batas at programa upang mapangalagaan ang kalikasan. 

                <br><br>

                Higit sa lahat, natutunan mo na ang pangangalaga sa kapaligiran ay pananagutang panlahat.
            </div>

            <button class="btn" onclick="goMap()">Bumalik sa Mapa 🗺️</button>

        </div>
    </div>

    <div class="modal-overlay" id="rewardModal">
        <div class="reward-modal">
            <h2 class="reward-title">🎁 Gantimpala ng Katatagan!</h2>
            
            <img src="{{ asset('pictures/Mod2_FinalAct/mod2housepart.png') }}" alt="Bricks" class="reward-image">
            
            <div class="reward-desc">
                Mahusay! Dahil natapos mo ang Module 2, nakuha mo ang <strong>Unang Bahagi (Pundasyon)</strong> ng iyong matibay na bahay. 
                <br><br>
                Ang mga ito ang magsisilbing matatag na pundasyon, simbolo ng iyong kahandaan at kaalaman laban sa mga sakuna. Ituloy ang pag-aaral para mabuo ang iyong <strong>Bahay</strong>
            </div>

            <button class="close-reward-btn" onclick="closeModal()">Tanggapin ang Gantimpala</button>
        </div>
    </div>

</div>

<script>
// 🎉 CONFETTI BURST
function launchConfetti(){
    let duration = 3000;
    let end = Date.now() + duration;

    (function frame(){
        confetti({
            particleCount:10,
            spread:90,
            origin:{y:0.6}
        });

        if(Date.now() < end){
            requestAnimationFrame(frame);
        }
    })();
}

// 🚀 BUTTON
function goMap(){
    window.location.href = "{{ route('student.map') }}";
}

function closeModal() {
    const modal = document.getElementById('rewardModal');
    modal.classList.remove('active');
}

window.onload = function(){
    // 1. Launch Confetti
    launchConfetti();
    
    // 2. Show Modal with a slight delay for better effect
    setTimeout(() => {
        document.getElementById('rewardModal').classList.add('active');
    }, 500);
}

function launchConfetti(){
    let duration = 3000;
    let end = Date.now() + duration;

    (function frame(){
        confetti({
            particleCount: 10,
            spread: 90,
            origin: { y: 0.6 },
            zIndex: 10000 // Higher than modal
        });

        if(Date.now() < end){
            requestAnimationFrame(frame);
        }
    })();
}
</script>

</body>
</html>