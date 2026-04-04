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

// 🎯 LOAD
window.onload = function(){
    launchConfetti();
}
</script>

</body>
</html>