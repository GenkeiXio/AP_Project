<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligtas Kautusan: Misyon sa Lindol</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-glow: #00f2ff;
            --danger-glow: #ff0000;
            --success-glow: #3cff00;
            --panel-bg: rgba(10, 20, 30, 0.95);
        }

        body {
            background-color: #050a0f;
            background-image: radial-gradient(circle at 50% 50%, rgba(0, 242, 255, 0.05) 0%, transparent 80%);
            color: #ffffff;
            font-family: 'Rajdhani', sans-serif;
            min-height: 100vh;
            padding: 20px;
            overflow-x: hidden;
            transition: background-color 0.5s ease;
        }

        .game-container {
            max-width: 1200px;
            margin: auto;
            border: 3px solid var(--primary-glow);
            border-radius: 20px;
            padding: 30px;
            background: var(--panel-bg);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.2);
            position: relative;
        }

        /* EMERGENCY BUZZING EFFECT PARA SA MITHIIN 2 */
        .active-emergency {
            background-color: #2b0000 !important;
            /* animation: buzz 0.1s infinite; */
        }
        /* @keyframes buzz {
            0% { transform: translate(1px, 1px); }
            50% { transform: translate(-1px, -1px); }
            100% { transform: translate(1px, -1px); }
        } */

        .hud-bar {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 15px;
            border-left: 8px solid var(--primary-glow);
            margin-bottom: 20px;
        }

        .progress-container {
            height: 15px;
            background: #000;
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #0084ff, #00f2ff);
            width: 0%;
            transition: width 0.4s ease;
        }

        .dropzone {
            min-height: 280px;
            border: 3px dashed rgba(255, 255, 255, 0.2);
            background: rgba(0,0,0,0.4);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px;
            margin-bottom: 30px;
            transition: 0.3s;
        }
        .dropzone.drag-over { border-color: var(--primary-glow); background: rgba(0, 242, 255, 0.1); }

        .item-card {
            background: #ffffff;
            color: #000;
            width: 230px;
            padding: 10px;
            border-radius: 15px;
            cursor: grab;
            box-shadow: 0 8px 15px rgba(0,0,0,0.5);
            border: 4px solid transparent;
        }
        .item-card img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            border-radius: 10px;
            pointer-events: none;
        }
        .item-card p {
            font-weight: 700;
            font-size: 0.95rem;
            text-align: center;
            margin: 10px 0 0;
            line-height: 1.2;
        }

        .correct-glow { border-color: var(--success-glow) !important; box-shadow: 0 0 20px var(--success-glow); }
        
        /* WRONG ANIMATION */
        .wrong-shake { 
            animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both; 
            border-color: var(--danger-glow) !important; 
            background-color: #ffcccc !important;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .hidden { display: none !important; }
        .btn-action {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            padding: 12px 45px;
            background: var(--primary-glow);
            color: #000;
            border-radius: 50px;
            border: none;
            transition: 0.3s;
        }
        .btn-action:hover { box-shadow: 0 0 20px var(--primary-glow); transform: scale(1.05); }
    </style>
</head>
<body id="game-body">

<audio id="sfx-correct" src="https://www.soundjay.com/buttons/sounds/button-4.mp3" preload="auto"></audio>
<audio id="sfx-wrong" src="https://www.soundjay.com/buttons/sounds/button-10.mp3" preload="auto"></audio>
<audio id="sfx-alarm" src="https://assets.mixkit.co/active_storage/sfx/995/995-preview.mp3" loop preload="auto"></audio>
<audio id="sfx-victory" src="https://www.soundjay.com/human/sounds/applause-01.mp3" preload="auto"></audio>

<div class="container game-container mt-5">
    <div class="text-center">
        <h1 style="font-family: 'Bebas Neue'; color: var(--primary-glow); font-size: clamp(3rem, 8vw, 5rem);">LIGTAS NA KAUTUSAN</h1>
        <p class="fs-5 opacity-75">Gabay na Tanong: Bakit mahalaga ang tamang kilos habang lumilindol?</p>
    </div>

    <div id="intro-layer">
        <div class="row g-3 mb-4 mt-2">
            <div class="col-md-6">
                <iframe width="100%" height="280"
                        src="https://www.youtube.com/embed/dJpIU1rSOFY"
                        frameborder="0"
                        style="border-radius:15px; border:2px solid #333;"
                        allowfullscreen>
                </iframe>
            </div>
            <div class="col-md-6"><iframe width="100%" height="280" src="https://www.youtube.com/embed/AxpSZSsxvf8" frameborder="0" style="border-radius:15px; border:2px solid #333;" allowfullscreen></iframe></div>
        </div>
        <div class="text-center">
            <button class="btn btn-action" onclick="startGame()">SIMULAN ANG MISYON</button>
        </div>
    </div>

    <div id="game-layer" class="hidden">
        <div class="hud-bar" id="hud-bar">
            <div class="d-flex justify-content-between align-items-center">
                <h3 id="phase-title" style="margin:0;">MITHIIN: PAGHAHANDA</h3>
                <div class="fs-4">ISKOR: <span id="score-val" class="text-warning">0</span>%</div>
            </div>
            <div class="progress-container">
                <div id="progress-bar" class="progress-bar"></div>
            </div>
        </div>

        <div class="dropzone" id="drop-zone">
            <div id="placeholder" class="text-white-50 fs-5">I-DRAG ANG 3 TAMANG HAKBANG DITO</div>
        </div>

        <div id="cards-pool" class="d-flex flex-wrap justify-content-center gap-3"></div>
    </div>

    <div id="end-layer" class="hidden">
        <div style="background: rgba(0, 255, 0, 0.05); border: 2px solid var(--success-glow); border-radius: 20px; padding: 40px;">
            <h2 class="text-center mb-4" style="color: var(--success-glow); font-family: 'Bebas Neue'; font-size: 3.5rem;">MISYON TAGUMPAY! 🎖️</h2>
            <div class="fs-5 lh-lg">
                <p>Napagtagumpayan mong matukoy ang mga tamang gawain bago, habang, at pagkatapos ng lindol. Ipinapakita nito na handa ka at may sapat na kaalaman upang mapanatiling ligtas ang iyong sarili at ang iba sa oras ng sakuna.</p>
                <p>Sa pamamagitan ng iyong mga sagot, natutunan mo na ang kahalagahan ng paghahanda tulad ng pagkakaroon ng <strong>kagamitang pang-emergency</strong> at pakikilahok sa <strong>pagsasanay sa lindol</strong>. Naipakita mo rin ang tamang kilos habang lumilindol, tulad ng pananatiling kalmado, pag-iwas sa panganib, at pagtatago sa ligtas na lugar. Higit sa lahat, alam mo na ang mga dapat gawin pagkatapos ng lindol tulad ng pagtiyak sa kaligtasan ng lahat at pagsunod sa mga tagubilin sa paglikas.</p>
                <p class="text-center mt-4 fw-bold text-info" style="font-size: 1.3rem;">👏 Ipagpatuloy ang pagiging handa! Ang kaalamang ito ay makakatulong hindi lamang sa iyo kundi pati sa iyong pamilya at komunidad. Tandaan: Ang handa ay ligtas!</p>
            </div>
            <div class="text-center mt-4"><a href="{{ route('bulkan.activity') }}" class="btn btn-action">SUSUNOD NA ARALIN ➡️</a></div>
        </div>
    </div>
</div>

<script>
    const imgFolder = "{{ asset('pictures/Module 3/lindol_activity') }}/";

    let startTime = Date.now(); // ✅ FIX
    let correctItems = 0; // ✅ FIX

    const data = [
        { phase: 'before', img: 'earthquake_drill.png', text: 'Makilahok sa pagsasanay sa lindol.' },
        { phase: 'before', img: 'emergency_kit.png', text: 'Maghanda ng kagamitang pang-emergency.' },
        { phase: 'before', img: 'exit_route.png', text: 'Alamin ang mga daan ng paglabas.' },
        { phase: 'during', img: 'avoid_structures.png', text: 'Umiwas sa puno at poste.' },
        { phase: 'during', img: 'duck_cover.png', text: 'Yumuko, magkubli, at kumapit.' },
        { phase: 'during', img: 'go_safe_place.png', text: 'Pumunta sa ligtas na lugar.' },
        { phase: 'after', img: 'exit_building.png', text: 'Lumabas agad paghinto ng yanig.' },
        { phase: 'after', img: 'bring_kit.png', text: 'Dalhin ang kit sa paglikas.' },
        { phase: 'after', img: 'evacuate.png', text: 'Lumikas kung pinalilikas na.' }
    ];

    let currentPhase = 'before';
    let score = 0;
    let itemsInZone = 0;
    let draggedData = null;
    let totalItems = 9; // 3 per phase x 3 phases

    function startGame() {
        startTime = Date.now(); // ✅ RESET TIMER
        correctItems = 0;  

        document.getElementById('intro-layer').classList.add('hidden');
        document.getElementById('game-layer').classList.remove('hidden');
        loadPhase();
    }

    function loadPhase() {
        const pool = document.getElementById('cards-pool');
        const dz = document.getElementById('drop-zone');
        const title = document.getElementById('phase-title');
        const body = document.getElementById('game-body');
        const hud = document.getElementById('hud-bar');

        pool.innerHTML = '';
        dz.innerHTML = '<div id="placeholder" class="text-white-50 fs-5">I-DRAG ANG 3 TAMANG HAKBANG DITO</div>';
        itemsInZone = 0;

        body.classList.remove('active-emergency');
        document.getElementById('sfx-alarm').pause();

        if (currentPhase === 'before') {
            title.innerText = "MITHIIN 1: PAGHAHANDA (BAGO)";
            hud.style.borderLeftColor = "var(--primary-glow)";
            title.style.color = "var(--primary-glow)";
        } else if (currentPhase === 'during') {
            title.innerText = "⚠️ BABALA: HABANG LUMILINDOL!";
            title.style.color = "var(--danger-glow)";
            body.classList.add('active-emergency');
            hud.style.borderLeftColor = "var(--danger-glow)";
            // document.getElementById('sfx-alarm').play();
        } else {
            title.innerText = "MITHIIN 3: PAGLIKAS (PAGKATAPOS)";
            title.style.color = "var(--success-glow)";
            hud.style.borderLeftColor = "var(--success-glow)";
        }

        const corrects = data.filter(d => d.phase === currentPhase);
        const wrongs = data.filter(d => d.phase !== currentPhase).sort(() => 0.5 - Math.random()).slice(0, 2);
        const combined = [...corrects, ...wrongs].sort(() => 0.5 - Math.random());

        combined.forEach(item => {
            const card = document.createElement('div');
            card.className = 'item-card';
            card.draggable = true;
            card.innerHTML = `<img src="${imgFolder}${item.img}"><p>${item.text}</p>`;
            
            card.addEventListener('dragstart', () => { draggedData = item; card.id = "dragging-now"; });
            pool.appendChild(card);
        });
    }

    const dz = document.getElementById('drop-zone');
    dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
    dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));

    dz.addEventListener('drop', e => {
        e.preventDefault();
        dz.classList.remove('drag-over');
        const card = document.getElementById('dragging-now');

        if (draggedData.phase === currentPhase) {

            correctItems++; // ✅ TRACK

            const audio = document.getElementById('sfx-correct');
            audio.currentTime = 0;
            audio.play().catch(() => {});
            
            itemsInZone++;
            score += 11.1;
            document.getElementById('score-val').innerText = Math.round(score);
            document.getElementById('progress-bar').style.width = score + "%";
            
            if (document.getElementById('placeholder')) document.getElementById('placeholder').remove();
            card.classList.add('correct-glow');
            card.draggable = false;
            dz.appendChild(card);

            if (itemsInZone === 3) setTimeout(nextPhase, 1200);
        } else {
            const audio = document.getElementById('sfx-wrong');
            audio.currentTime = 0;
            audio.play().catch(() => {});
            
            card.classList.add('wrong-shake');
            setTimeout(() => card.classList.remove('wrong-shake'), 400);
        }
        card.id = "";
    });

    function nextPhase() {
        if (currentPhase === 'before') { 
            currentPhase = 'during'; 
            loadPhase(); 
        }
        else if (currentPhase === 'during') { 
            currentPhase = 'after'; 
            loadPhase(); 
        }
        else {

            saveLindol(); // ✅ IMPORTANT

            document.getElementById('sfx-alarm').pause();
            document.getElementById('sfx-victory').play().catch(() => {});
            document.getElementById('game-layer').classList.add('hidden');
            document.getElementById('end-layer').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = "100%";

            // ✅ SAVE GAME HERE
            saveLindol();
        }
    }

    function saveLindol() {
        let timeSpent = Math.floor((Date.now() - startTime) / 1000);

        fetch("{{ route('student.module3.lindol.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                score: Math.round(score),
                total_items: totalItems,
                correct_items: correctItems,
                time_spent: timeSpent
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log("SAVED:", data);
            alert("Saved successfully!");
        })
        .catch(err => console.error("ERROR:", err));
    }
</script>

</body>
</html>