<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<title>Narration - Ang Iyong Misyon</title>

<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<style>
    /* === BASE STYLES (DESKTOP FIRST - COMPLETELY UNCHANGED) === */
    body {
        margin: 0;
        font-family: 'Nunito', sans-serif;
        background: #fef5e7;
        min-height: 100vh;
    }

    /* 🎯 HEADER (FIXED — NEVER MOVES) */
    .header {
        position: fixed;
        top: 120px;
        width: 100%;
        text-align: center;
        z-index: 10;
    }

    .header h1 {
        font-family: 'Baloo 2', cursive;
        font-size: 3.2rem;
        color: #3e2c1c;
        margin: 0;
    }

    .header-icons {
        margin-bottom: 5px;
    }

    /* 🎮 GAME AREA */
    .game-area {
        height: 100vh;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 40px;
    }

    .scene-placeholder {
        text-align: center;
        font-size: 1.2rem;
        opacity: 1;
    }

    /* 💬 DIALOGUE BOX (FIXED - ORIGINAL POSITION - CENTERED) */
    .vn-box {
        position: fixed;
        top: 46%;
        left: 50%;
        transform: translate(-50%, -40%);
        width: 85%;
        max-width: 900px;
        background: linear-gradient(145deg, #fff7e6, #f3e3c2);
        border: 3px solid #e0c097;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25), inset 0 0 15px rgba(255,255,255,0.5);
        z-index: 20;
        transition: all 0.2s ease;
    }

    /* ✨ TEXT */
    #text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #2d2d2d;
    }

    /* ✨ CURSOR */
    .cursor::after {
        content: "|";
        animation: blink 1s infinite;
    }
    @keyframes blink {
        0%,50%,100% { opacity: 1; }
        25%,75% { opacity: 0; }
    }

    /* 🎮 CONTROLS */
    .vn-controls {
        margin-top: 15px;
        display: flex;
        justify-content: flex-end;
    }

    /* 🎮 BUTTON */
    .vn-btn {
        background: linear-gradient(135deg,#2e7d32,#66bb6a);
        color: white;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 0 #2e7d32;
    }

    .vn-btn:hover {
        transform: translateY(-2px);
    }

    .vn-btn:active {
        transform: translateY(1px);
        box-shadow: 0 2px 0 #2e7d32;
    }

    /* 🌍 FADE */
    .fade-out {
        animation: fadeOut 0.6s forwards;
    }
    @keyframes fadeOut {
        to { opacity: 0; transform: scale(1.05); }
    }

    /* 🚶 CHARACTER IMAGE */
    .character {
        position: relative;
        left: 0;
        bottom: 0;
        width: 120px;
        height: auto;
        will-change: transform;
        animation: walkForward 10s linear infinite,
                walkBounce 0.6s ease-in-out infinite;
    }

    @keyframes walkBounce {
        0% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
        100% { transform: translateY(0); }
    }

    @keyframes walkForward {
        0% { left: -120px; }
        100% { left: 110%; }
    }

    .footsteps {
        position: absolute;
        bottom: 20px;
        left: -120px;
        width: 120px;
        animation: walkForward 10s linear infinite;
    }

    .footsteps span {
        display: inline-block;
        font-size: 18px;
        opacity: 0;
        animation: footstepsAnim 1.2s infinite;
    }

    /* 🛤️ TRAVEL TEXT */
    .path-text {
        margin-top: 12px;
        font-family: 'Baloo 2', cursive;
        font-size: 1.2rem;
        font-weight: 700;
        color: #3e2c1c;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 0 #fff, 0 4px 10px rgba(0,0,0,0.2);
        animation: floatText 2.5s ease-in-out infinite;
        will-change: transform;
        opacity: 0.9;
    }

    @keyframes floatText {
        0% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0); }
    }

    /* ✨ animated dots */
    .dots {
        display: inline-block;
        width: 1.5em;
        text-align: left;
    }

    .dots::after {
        content: "...";
        opacity: 0;
        animation: dotsFade 3s infinite;
    }

    @keyframes dotsFade {
        0%   { opacity: 0; }
        25%  { opacity: 0.3; }
        50%  { opacity: 0.6; }
        75%  { opacity: 1; }
        100% { opacity: 0; }
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
    
    .back-button:hover {
        transform: translateY(-2px);
    }

    /* ============================================================ */
    /* 📱 MOBILE LAYOUT - DIALOGUE BOX MADE MUCH SMALLER */
    /* REPOSITIONED SLIGHTLY HIGHER TO AVOID HIDING CHARACTER HEAD */
    /* ============================================================ */
    @media (max-width: 768px) {
        /* Make dialogue box significantly smaller and move it up */
        .vn-box {
            width: 60%;                    /* Much smaller width - was 85% desktop */
            max-width: 420px;             /* Smaller max width */
            padding: 12px 18px;           /* Much tighter padding */
            border-radius: 16px;
            /* Move box higher to avoid covering character head */
            top: 35%;                     /* Moved up from 46% */
            left: 50%;
            transform: translate(-50%, -35%);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        /* Smaller text size for compact box */
        #text {
            font-size: 0.85rem;
            line-height: 1.45;
        }
        
        /* Compact button styling */
        .vn-btn {
            padding: 6px 14px;
            font-size: 0.8rem;
            border-radius: 10px;
        }
        
        .vn-controls {
            margin-top: 10px;
        }
        
        /* Ensure header text doesn't overlap */
        .header h1 {
            font-size: 2.2rem;
        }
        
        .header {
            top: 90px;
        }
        
        /* Keep character visible - adjust spacing */
        .game-area {
            padding-bottom: 30px;
        }
        
        .character {
            width: 100px;
        }
        
        .path-text {
            font-size: 0.95rem;
            margin-top: 10px;
        }
        
        /* For very small devices - make box even smaller */
        @media (max-width: 480px) {
            .vn-box {
                width: 70%;
                max-width: 320px;
                padding: 10px 14px;
                top: 32%;
                transform: translate(-50%, -32%);
            }
            
            #text {
                font-size: 0.8rem;
                line-height: 1.4;
            }
            
            .vn-btn {
                padding: 5px 12px;
                font-size: 0.75rem;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
            
            .header {
                top: 70px;
            }
            
            .character {
                width: 85px;
            }
            
            .path-text {
                font-size: 0.85rem;
            }
        }
        
        /* Tablet adjustment */
        @media (min-width: 600px) and (max-width: 768px) {
            .vn-box {
                width: 55%;
                max-width: 460px;
                padding: 14px 20px;
                top: 38%;
            }
            #text {
                font-size: 0.9rem;
            }
            .character {
                width: 110px;
            }
        }
    }
    
    /* ============================================================ */
    /* DESKTOP MODE REMAINS 100% IDENTICAL TO ORIGINAL */
    /* No modifications to any desktop styles above */
    /* ============================================================ */
</style>
</head>

<body>

<a href="{{ route('home') }}" class="back-button">⬅️ Bumalik</a>
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<!-- 🧭 FIXED HEADER -->
<div class="header">
    <div class="header-icons">🧭 🗺️ ✨</div>
    <h1>Ang Iyong Misyon</h1>
</div>

<!-- 🎮 GAME AREA -->
<div class="game-area">
    <div class="scene-placeholder">
        <img src="{{ asset('pictures/studentAvatarWalking.png') }}" class="character" alt="Walking Character">
        <div class="path-text">
            Naglalakbay ka sa Albay<span class="dots"></span>
        </div>
    </div>
</div>

<!-- 💬 DIALOGUE BOX -->
<div class="vn-box">
    <div id="text" class="cursor"></div>
    <div class="vn-controls">
        <button id="nextBtn" class="vn-btn" onclick="nextPage()">Susunod ▶</button>
        <button id="startBtn" class="vn-btn" style="display:none;" onclick="proceedToModule()">
            Magpatuloy sa Mapa ng Albay 🚀
        </button>
    </div>
</div>

<!-- 🔊 AUDIO -->
<audio autoplay loop>
    <source src="/audio/narration-bg.mp3">
</audio>

<script>

const pages = [
`Sa harap ng patuloy na pagdanas ng Pilipinas ng iba’t ibang kalamidad tulad ng bagyo, lindol, baha, at pagputok ng bulkan, mahalagang maunawaan ng bawat mag-aaral ang kahalagahan ng kahandaan, disiplina, at kooperasyon sa pagtugon sa mga hamong pangkapaligiran.`,

`Ang interactive instructional material na ito ay idinisenyo upang gawing mas makabuluhan, masigla, at mas malalim ang pagkatuto sa pamamagitan ng mga sitwasyong batay sa tunay na pangyayari, pagsusuri ng sanhi at epekto, at pagbuo ng angkop na plano ng pagtugon.`,

`Layunin nitong hindi lamang mapalawak ang kaalaman ng mga mag-aaral tungkol sa kalagayan at suliraning pangkapaligiran ng bansa, kundi malinang din ang kanilang kritikal na pag-iisip at pananagutan bilang aktibong kabahagi sa pagpapabuti ng pamumuhay ng tao at komunidad.`
];

let current = 0;
let typing = false;
let typingTimeout = null;

function typeWriter(text, element, speed = 25){
    clearTimeout(typingTimeout);
    element.innerHTML = "";
    let i = 0;
    typing = true;

    function typingEffect(){
        if(i < text.length){
            element.innerHTML += text.charAt(i);
            i++;
            typingTimeout = setTimeout(typingEffect, speed);
        } else {
            typing = false;
        }
    }

    typingEffect();
}

function nextPage(){
    const textEl = document.getElementById("text");

    if(typing){
        clearTimeout(typingTimeout);
        textEl.innerHTML = pages[current];
        typing = false;
        return;
    }

    current++;

    if(current < pages.length){
        typeWriter(pages[current], textEl);
    } else {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("startBtn").style.display = "inline-block";
    }
}

function proceedToModule(){
    document.body.classList.add('fade-out');
    setTimeout(()=>{
        window.location.href = '{{ route("student.map") }}';
    },600);
}

typeWriter(pages[0], document.getElementById("text"));

</script>

</body>
</html>