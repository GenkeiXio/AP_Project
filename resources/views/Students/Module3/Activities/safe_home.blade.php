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
        --primary: #3b82f6; --success: #22c55e; --danger: #ef4444;  
        --warning: #f59e0b; --bg-dark: #0f172a; --panel: #1e293b; --text: #f1f5f9;
    }

    body {
        font-family: 'Lexend', sans-serif;
        margin: 0; padding: 15px;
        background-color: var(--bg-dark);
        color: var(--text);
        min-height: 100vh;
    }

    .game-master-container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        background: var(--panel); border-radius: 20px;
        overflow: hidden; border: 4px solid #334155;
        box-shadow: 0 0 40px rgba(0,0,0,0.5); position: relative;
    }

    /* GUIDELINES SECTION */
    .guidelines-banner {
        background: rgba(59, 130, 246, 0.1);
        padding: 20px;
        border-bottom: 2px solid #334155;
    }

    .guidelines-title {
        font-family: 'Bungee';
        color: var(--warning);
        font-size: 18px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .guidelines-list {
        margin: 0;
        padding-left: 20px;
        font-size: 14px;
        color: #cbd5e1;
        line-height: 1.6;
    }

    .game-header {
        background: #0f172a; padding: 15px; text-align: center;
        border-bottom: 4px solid #334155;
    }

    .game-header h2 { font-family: 'Bungee'; margin: 0; color: #fff; font-size: 24px; letter-spacing: 1px; }

    .mission-tracker {
        padding: 10px 20px; background: rgba(0,0,0,0.3);
        display: flex; align-items: center; gap: 10px; border-bottom: 2px solid #334155;
    }

    .progress-bar-container {
        flex-grow: 1; height: 18px; background: #0f172a;
        border-radius: 50px; border: 2px solid #475569; overflow: hidden;
    }

    .progress-fill {
        height: 100%; width: 0%;
        background: linear-gradient(90deg, #22c55e, #4ade80);
        transition: width 0.4s ease-out;
    }

    .content-grid { 
        display: grid; 
        grid-template-columns: 1fr 1.2fr; 
        gap: 20px; 
        padding: 20px; 
    }

    .display-panel {
        background: rgba(0,0,0,0.2); border-radius: 15px;
        padding: 10px; border: 2px solid #334155;
        display: flex; justify-content: center; align-items: center;
        position: relative; min-height: 350px;
    }

    .display-panel img { max-width: 100%; height: auto; border-radius: 10px; }

    .options-grid { display: flex; flex-direction: column; gap: 10px; }

    .option {
        background: #1e293b; padding: 16px 20px; border-radius: 12px;
        cursor: pointer; transition: all 0.2s ease; border: 2px solid #334155;
        font-size: 17px; 
        font-weight: 600;
        display: flex; justify-content: space-between; align-items: center;
        color: #cbd5e1;
    }

    .option:hover:not(.selected) { border-color: var(--primary); background: #2d3748; color: #fff; }
    .option.selected { pointer-events: none; opacity: 0.8; }

    .option.correct { border-color: var(--success) !important; background: rgba(34, 197, 94, 0.2) !important; color: #fff; }
    .option.wrong { border-color: var(--danger) !important; background: rgba(239, 68, 68, 0.2) !important; animation: shake 0.4s; color: #fff; }

    .status-icon { display: none; font-size: 22px; }
    .correct .check { display: block; color: var(--success); }
    .wrong .xmark { display: block; color: var(--danger); }

    #result {
        text-align: center; padding: 25px; background: rgba(15, 23, 42, 0.98);
        border-radius: 15px; border: 3px solid var(--warning);
        position: absolute; width: 85%; display: none; z-index: 20;
        box-shadow: 0 0 30px rgba(0,0,0,0.8);
    }

    .btn-game {
        font-family: 'Bungee'; padding: 12px 25px; border-radius: 50px;
        cursor: pointer; border: none; font-size: 16px; text-decoration: none;
        display: inline-block; margin-top: 15px; transition: 0.2s;
    }
    .btn-success { background: var(--success); color: white; }
    .btn-danger { background: var(--danger); color: white; }
    .btn-game:hover { transform: scale(1.05); }

    @media (max-width: 850px) {
        .content-grid { grid-template-columns: 1fr; }
        .display-panel { min-height: 250px; order: -1; }
        .option { font-size: 15px; padding: 12px 15px; }
        .game-header h2 { font-size: 20px; }
    }

    @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
</style>
</head>
<body>

<div class="game-master-container">
    <div class="guidelines-banner">
        <div class="guidelines-title">
            <i class="fa-solid fa-circle-info"></i> GABAY SA MISYON
        </div>
        <ul class="guidelines-list">
            <li><strong>Layunin:</strong> Patatagin ang bahay sa pamamagitan ng pagpili ng <strong>5 tamang paraan</strong> ng paghahanda.</li>
            <li><strong>Limitasyon:</strong> Mayroon kang <strong>5 pagkakataon (clicks)</strong> lamang.</li>
            <li><strong>Kondisyon:</strong> Kailangang <strong>perpekto (5/5)</strong> ang iyong mapili upang manalo. Kapag may kahit isang mali, mabibigo ang misyon.</li>
        </ul>
    </div>

    <div class="game-header">
        <h2>MISYON: LIGTAS NA BAHAY</h2>
    </div>

    <div class="mission-tracker">
        <div style="font-family: 'Bungee'; font-size: 11px; color: var(--success);">KLIK:</div>
        <div id="clickCounter" style="font-family: 'Bungee'; color: var(--warning);">0 / 5</div>
        <div class="progress-bar-container">
            <div id="progressFill" class="progress-fill"></div>
        </div>
        <div id="progressText" style="font-family: 'Bungee'; min-width: 40px; text-align: right;">0%</div>
    </div>

    <div class="content-grid">
        <div class="display-panel">
            <img id="mainImage" src="{{ asset('pictures/Module 3/Safe_Home/normal.png') }}">
            <div id="result">
                <h3 id="resultTitle" style="font-family: 'Bungee'; margin: 0; font-size: 22px;"></h3>
                <img id="resultImage" style="width:100%; max-width:200px; margin: 15px 0; border-radius: 10px; border: 2px solid #444;">
                <p id="resultText" style="font-size: 15px; color: #cbd5e1; line-height: 1.5;"></p>
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

            // 🔥 SAVE DATA TO DATABASE
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