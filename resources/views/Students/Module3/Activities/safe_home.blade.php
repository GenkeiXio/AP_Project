<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Misyon: Ligtas na Bahay</title>

<link href="https://fonts.googleapis.com/css2?family=Bungee&family=Lexend:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        /* Neutral Brown Wooden Palette (No Pink/Red Tones) */
        --wood-dark: #2c1e14;      /* Espresso Brown */
        --wood-medium: #4a3728;    /* Deep Oak */
        --wood-light: #d2b48c;     /* Tan/Sand Wood */
        --accent-gold: #eab308;    /* Harvest Gold */
        --parchment: #fcfaf7;      /* Clean off-white */
        --success: #15803d; 
        --danger: #b91c1c;  
    }

    body {
        font-family: 'Lexend', sans-serif;
        margin: 0; padding: 15px;
        background: url("{{ asset('pictures/mod3_innermap.png') }}") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

    .game-master-container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        /* Authentic Brown Wood Aesthetic */
        background-color: #c4a484;
        background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
        border-radius: 20px;
        overflow: hidden; 
        border: 6px solid var(--wood-dark);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6); 
        position: relative;
    }

    /* GUIDELINES SECTION */
    .guidelines-banner {
        background: rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-bottom: 3px solid var(--wood-medium);
    }

    .guidelines-title {
        font-family: 'Bungee';
        color: var(--wood-dark);
        font-size: 18px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .guidelines-list {
        margin: 0; padding-left: 20px;
        font-size: 14px;
        color: #2c1e14;
        font-weight: 500;
        line-height: 1.6;
    }

    .game-header {
        background: var(--wood-dark); 
        padding: 18px; 
        text-align: center;
        border-bottom: 4px solid #1a110a;
    }

    .game-header h2 { 
        font-family: 'Bungee'; 
        margin: 0; 
        color: #fff; 
        font-size: 26px; 
        letter-spacing: 1px; 
        text-shadow: 2px 2px 0px rgba(0,0,0,0.4);
    }

    .mission-tracker {
        padding: 12px 20px; 
        background: rgba(0,0,0,0.2);
        display: flex; 
        align-items: center; 
        gap: 12px; 
        border-bottom: 2px solid var(--wood-medium);
    }

    .progress-bar-container {
        flex-grow: 1; height: 18px; 
        background: #1a110a;
        border-radius: 50px; 
        border: 2px solid var(--wood-medium); 
        overflow: hidden;
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.5);
    }

    .progress-fill {
        height: 100%; width: 0%;
        background: linear-gradient(90deg, #facc15, #ca8a04);
        transition: width 0.4s ease-out;
    }

    .content-grid { 
        display: grid; 
        grid-template-columns: 1fr 1.2fr; 
        gap: 20px; 
        padding: 20px; 
    }

    .display-panel {
        background: rgba(255,255,255,0.15); 
        border-radius: 15px;
        padding: 15px; 
        border: 2px solid var(--wood-medium);
        display: flex; justify-content: center; align-items: center;
        position: relative; min-height: 350px;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
    }

    .display-panel img { max-width: 100%; height: auto; border-radius: 10px; border: 2px solid var(--wood-dark); }

    .options-grid { display: flex; flex-direction: column; gap: 10px; }

    .option {
        background: var(--parchment); 
        padding: 16px 20px; 
        border-radius: 12px;
        cursor: pointer; 
        transition: all 0.2s ease; 
        border: 2px solid var(--wood-medium);
        font-size: 16px; 
        font-weight: 600;
        display: flex; justify-content: space-between; align-items: center;
        color: var(--wood-dark);
        box-shadow: 0 4px 0 var(--wood-dark);
    }

    .option:hover:not(.selected) { 
        transform: translateY(-2px);
        background: #ffffff; 
        box-shadow: 0 6px 0 var(--wood-dark);
    }
    
    .option.selected { pointer-events: none; opacity: 0.8; transform: translateY(2px); box-shadow: none; }

    .option.correct { 
        border-color: var(--success) !important; 
        background: #f0fdf4 !important; 
        color: var(--success); 
        box-shadow: 0 2px 0 var(--success);
    }
    
    .option.wrong { 
        border-color: var(--danger) !important; 
        background: #fef2f2 !important; 
        animation: shake 0.4s; 
        color: var(--danger);
        box-shadow: 0 2px 0 var(--danger);
    }

    .status-icon { display: none; font-size: 20px; }
    .correct .check { display: block; }
    .wrong .xmark { display: block; }

    #result {
        text-align: center; 
        padding: 30px; 
        background: var(--parchment);
        background-image: url('https://www.transparenttextures.com/patterns/handmade-paper.png');
        border-radius: 20px; 
        border: 8px solid var(--wood-dark);
        position: absolute; 
        width: 85%; 
        display: none; 
        z-index: 20;
        box-shadow: 0 15px 60px rgba(0,0,0,0.8);
        color: var(--wood-dark);
    }

    .btn-game {
        font-family: 'Bungee'; 
        padding: 14px 30px; 
        border-radius: 12px;
        cursor: pointer; 
        border: none; 
        font-size: 16px; 
        text-decoration: none;
        display: inline-block; 
        margin-top: 15px; 
        transition: 0.2s;
        box-shadow: 0 5px 0 rgba(0,0,0,0.3);
    }
    .btn-success { background: var(--success); color: white; }
    .btn-danger { background: var(--danger); color: white; }
    .btn-game:hover { transform: translateY(-3px); box-shadow: 0 8px 0 rgba(0,0,0,0.3); }

    @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }

    @media (max-width: 850px) {
        .content-grid { grid-template-columns: 1fr; }
        .display-panel { min-height: 250px; order: -1; }
    }
</style>
</head>
<body>

<div class="game-master-container">
    <div class="guidelines-banner">
        <div class="guidelines-title">
            <i class="fa-solid fa-circle-info"></i> GABAY SA MISYON
        </div>
        <ul class="guidelines-list">
            <li><strong>Layunin:</strong> Patatagin ang bahay sa pamamagitan ng pagpili ng <strong>5 tamang paraan</strong>.</li>
            <li><strong>Limitasyon:</strong> Mayroon kang <strong>5 pagkakataon</strong> lamang.</li>
            <li><strong>Kondisyon:</strong> Kailangang <strong>perpekto (5/5)</strong> upang manalo.</li>
        </ul>
    </div>

    <div class="game-header">
        <h2>MISYON: LIGTAS NA BAHAY</h2>
    </div>

    <div class="mission-tracker">
        <div style="font-family: 'Bungee'; font-size: 11px; color: #fff;">KLIK:</div>
        <div id="clickCounter" style="font-family: 'Bungee'; color: var(--accent-gold);">0 / 5</div>
        <div class="progress-bar-container">
            <div id="progressFill" class="progress-fill"></div>
        </div>
        <div id="progressText" style="font-family: 'Bungee'; min-width: 40px; text-align: right; color: #fff;">0%</div>
    </div>

    <div class="content-grid">
        <div class="display-panel">
            <img id="mainImage" src="{{ asset('pictures/Module 3/Safe_Home/normal.png') }}">
            <div id="result">
                <h3 id="resultTitle" style="font-family: 'Bungee'; margin: 0; font-size: 22px;"></h3>
                <img id="resultImage" style="width:100%; max-width:200px; margin: 15px 0; border-radius: 10px; border: 3px solid var(--wood-medium);">
                <p id="resultText" style="font-size: 15px; font-weight: 600; line-height: 1.5;"></p>
                <a id="resultBtn" class="btn-game"></a>
            </div>
        </div>

        <div class="options-grid">
            <div class="option" data-correct="true"><span>Linisin ang paligid at alisin ang mga debris.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="true"><span>Takpan ang mga bintana upang maprotektahan ang loob ng bahay.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="true"><span>Ayusin ang mga bitak sa pader.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="true"><span>Siguraduhing maayos ang drainage.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="true"><span>Ayusin ang sirang bubong upang maiwasan ang pagpasok ng tubig.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            
            <div class="option" data-correct="false"><span>Manatili sa sirang bahay.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="false"><span>Huwag ayusin ang bubong kahit sira.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="false"><span>Magbukas ng bintana habang may bagyo.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="false"><span>Balewalain ang babala ng bagyo.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
            <div class="option" data-correct="false"><span>Mag-iwan ng gamit sa labas ng bahay.</span><i class="fa-solid fa-check check status-icon"></i><i class="fa-solid fa-xmark xmark status-icon"></i></div>
        </div>
    </div>
</div>

<script>
    // Logic remains exactly the same as provided in your original script
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    function playBeep(freq, type, duration) {
        const osc = audioCtx.createOscillator();
        const gain = audioCtx.createGain();
        osc.type = type; osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
        gain.gain.setValueAtTime(0.1, audioCtx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + duration);
        osc.connect(gain); gain.connect(audioCtx.destination);
        osc.start(); osc.stop(audioCtx.currentTime + duration);
    }

    const sounds = {
        correct: () => { playBeep(600, 'sine', 0.1); setTimeout(() => playBeep(800, 'sine', 0.2), 100); },
        wrong: () => { playBeep(300, 'sawtooth', 0.2); },
        victory: () => { [440, 554, 659, 880].forEach((f, i) => setTimeout(() => playBeep(f, 'sine', 0.4), i * 150)); },
        fail: () => { [300, 250, 200].forEach((f, i) => setTimeout(() => playBeep(f, 'triangle', 0.5), i * 200)); }
    };

    function shuffleOptions() {
        const container = document.querySelector('.options-grid');
        const items = Array.from(container.children);
        for (let i = items.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [items[i], items[j]] = [items[j], items[i]];
        }
        items.forEach(item => container.appendChild(item));
    }
    shuffleOptions();

    let correctCount = 0;
    let wrongCount = 0;
    let totalClicks = 0;
    let isGameOver = false;

    document.querySelectorAll('.option').forEach(opt => {
        opt.addEventListener('click', function() {
            if (this.classList.contains('selected') || isGameOver || totalClicks >= 5) return;
            if (audioCtx.state === 'suspended') audioCtx.resume();

            this.classList.add('selected');
            totalClicks++;

            document.getElementById('clickCounter').innerText = `${totalClicks} / 5`;

            if (this.dataset.correct === "true") {
                this.classList.add('correct');
                correctCount++;
                sounds.correct();
            } else {
                this.classList.add('wrong');
                wrongCount++;
                sounds.wrong();
            }

            const progressPercent = (correctCount / 5) * 100;
            document.getElementById('progressFill').style.width = progressPercent + "%";
            document.getElementById('progressText').innerText = progressPercent + "%";

            if (totalClicks === 5) {
                if (correctCount === 5) endGame(true);
                else endGame(false);
            }
        });
    });

    function endGame(isWin) {
        isGameOver = true;
        document.querySelectorAll('.option').forEach(o => o.style.pointerEvents = "none");
        
        setTimeout(() => {
            let title, text, img, btnText, btnClass, btnAction;

            if (isWin) {
                sounds.victory();
                title = "PERPEKTONG PAGHAHANDA!";
                text = "Napakahusay! Nahanap mo ang lahat ng 5 tamang paraan. Ang iyong bahay ay ligtas na mula sa bagyo!";
                img = "{{ asset('pictures/Module 3/Safe_Home/safe.png') }}";
                btnText = "MAGPATULOY"; btnClass = "btn-success";
                btnAction = () => window.location.href = "{{ route('gabay.activity') }}";
            } else {
                sounds.fail();
                title = "MISYON AY NABIGO!";
                text = `Mayroon kang ${wrongCount} na maling sagot. Upang maging ligtas, kailangang perpekto (5/5) ang iyong paghahanda. Subukan muli!`;
                img = "{{ asset('pictures/Module 3/Safe_Home/destroyed.png') }}";
                btnText = "ULITIN ANG PAG-AAYOS"; btnClass = "btn-danger";
                btnAction = () => location.reload();
            }

            document.getElementById('resultTitle').innerText = title;
            document.getElementById('resultText').innerText = text;
            document.getElementById('resultImage').src = img;

            const btn = document.getElementById('resultBtn');
            btn.innerText = btnText; btn.className = `btn-game ${btnClass}`;
            btn.onclick = btnAction;

            document.getElementById('mainImage').style.display = "none";
            document.getElementById('result').style.display = "block";

            fetch("{{ route('student.module3.safehome.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    correct_count: correctCount,
                    wrong_count: wrongCount,
                    total_clicks: totalClicks,
                    selected_options: Array.from(document.querySelectorAll('.option.selected'))
                        .map(el => el.innerText.trim())
                })
            });
            
        }, 800);
    }
</script>

</body>
</html>