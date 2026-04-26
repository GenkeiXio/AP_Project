<!DOCTYPE html>
<html lang="tl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TACTICAL DRRM: PAGLIGTAS SA BULKAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;600;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --cmd-dark: #080808;
            --panel: #121212;
            --lava: #ff4500;
            --accent: #f1c40f;
            --safe: #2ecc71;
            --sky: #1a1a2e;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Lexend', sans-serif;
            color: #fff;
            overflow: hidden;

            /* 🔥 FULL BACKGROUND IMAGE */
            background: url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* --- 1. TRAINING MODAL --- */
        #instruction-modal {
            position: fixed;
            inset: 0;
            background: url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
            z-index: 3000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content-custom {
            background: #111;
            border-top: 4px solid var(--accent);
            width: 100%;
            max-width: 700px;
            padding: 30px;
            text-align: center;
        }

        .video-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .video-section iframe {
            width: 100%;
            height: 180px;
            border-radius: 8px;
            border: 1px solid #333;
        }

        .btn-ready {
            background: var(--accent);
            border: none;
            color: #000;
            font-weight: 900;
            letter-spacing: 2px;
            padding: 15px 30px;
            width: 100%;
            transition: 0.3s;
        }

        /* --- 2. LAYOUT --- */
        #game-layout {
            display: flex;
            width: 100vw;
            height: 100vh;
            padding: 25px;
            gap: 25px;
        }

        #ui-module {
            flex: 1;
            background: rgba(18, 18, 18, 0.85);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            border-left: 8px solid var(--accent);
            padding: 30px;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .status-header {
            font-size: 0.7rem;
            letter-spacing: 4px;
            color: var(--accent);
            font-weight: 900;
            margin-bottom: 15px;
        }

        #scenario-text {
            font-size: 1.1rem;
            line-height: 1.4;
            margin-bottom: 20px;
            min-height: 120px;
        }

        .choices-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stone-btn {
            background: #1a1a1a;
            border: 1px solid #333;
            border-bottom: 5px solid #000;
            border-radius: 12px;
            padding: 18px 20px;
            cursor: pointer;
            transition: 0.2s;
        }

        .stone-btn:hover {
            border-color: var(--accent);
            transform: translateX(5px);
        }

        /* --- 3. SIMULATION SIDE --- */
        #simulation-module {
            flex: 1.5;
            background: rgba(26, 26, 46, 0.85);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid #222;
        }

        #world {
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 0;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .green-ground {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 120px;
            background: #1b5e20;
            border-top: 10px solid var(--safe);
            z-index: 10;
        }

        #lava-layer {
            position: absolute;
            bottom: -2200px;
            width: 100%;
            height: 2000px;
            background: linear-gradient(0deg, #600, #d35400, #ff4500);
            z-index: 15;
            box-shadow: 0 -40px 100px var(--lava);
        }

        .stone-ledge {
            position: absolute;
            width: 200px;
            height: 50px;
            background: #333;
            border-top: 8px solid #555;
            border-radius: 10px;
            z-index: 12;
            transform: translateX(-50%);
        }

        #safe-place {
            position: absolute;
            width: 300px;
            height: 200px;
            background: #2c3e50;
            border: 4px solid var(--safe);
            border-bottom: none;
            border-radius: 50px 50px 0 0;
            z-index: 11;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding-bottom: 20px;
            box-shadow: 0 0 50px rgba(46, 204, 113, 0.3);
        }

        .safe-door {
            width: 80px;
            height: 110px;
            background: #1a252f;
            border: 2px solid var(--safe);
            border-radius: 10px 10px 0 0;
            transition: 1s ease;
            position: relative;
            overflow: hidden;
        }

        .safe-door.open {
            background: var(--safe);
            box-shadow: 0 0 30px var(--safe);
        }

        #hero {
            position: absolute;
            width: 150px;
            z-index: 100;
            transform: translateX(-50%);
            transition: bottom 0.6s ease-out, left 0.6s ease-out, opacity 0.5s;
            bottom: 120px;
            left: 50%;
        }

        #hero img {
            width: 100%;
            display: block;
            margin-bottom: -15px;
        }

        /* --- VICTORY GIFT STYLES --- */
        #victory-bag-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 5000;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 30px;
            border: 2px solid var(--accent);
            text-align: center;
            transition: 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
            opacity: 0;
        }

        #victory-bag-container.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        .gift-item-img {
            width: 150px;
            filter: drop-shadow(0 0 20px var(--accent));
            margin-bottom: 20px;
        }

        .game-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 50px;
            z-index: 2000;
        }

        .next-btn {
            background: var(--safe);
            color: #000;
            border: none;
            padding: 15px 30px;
            font-weight: 900;
            border-radius: 12px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .next-btn:hover {
            background: #27ae60;
            color: #fff;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div id="victory-bag-container">
        <div class="status-header">GANTIMPALA: LIGTAS-KIT</div>
        <img src="https://img.icons8.com/fluency/240/backpack.png" class="gift-item-img">
        <h2 class="text-white fw-bold">Emergency Go-Bag</h2>
        <p class="text-secondary small">Nakuha mo ang mahahalagang gamit <br> para sa paglikas sa pagsabog!</p>
        <button class="btn btn-warning mt-3 fw-bold w-100" onclick="closeGift()">IPAGPATULOY</button>
    </div>

    <div id="instruction-modal">
        <div class="modal-content-custom">
            <div class="status-header">PAGSASANAY NG MGA SIBILYAN</div>
            <div class="video-section">
                <iframe src="https://www.youtube.com/embed/Hg1ktHeXaPU" allowfullscreen></iframe>
                <iframe src="https://www.youtube.com/embed/UFz2fLrqZuk" allowfullscreen></iframe>
            </div>
            <button class="btn-ready" onclick="proceedToDashboard()">MAGSIMULA SA PAGSASANAY</button>
        </div>
    </div>

    <div id="game-layout">
        <div id="ui-module">
            <div class="status-header" id="cmd-status">STANDBY</div>
            <div id="scenario-text">
                <h5 class="text-white fw-bold mb-3">MGA PROTOKOL SA PAGLIGTAS:</h5>
                <ul class="list-unstyled text-secondary small">
                    <li>• Sagutin ang 10 kritikal na tanong.</li>
                    <li>• Bawat tamang sagot ay magpapaakyat sa iyo.</li>
                    <li>• Mag-ingat sa tumataas na lava.</li>
                </ul>
            </div>
            <div class="choices-container" id="selection-dock"></div>

            <div class="mt-auto">
                <div class="d-flex justify-content-between mb-2">
                    <small style="opacity:0.5; font-size:0.65rem;">PROGRESO</small>
                    <small id="prog-txt" style="color:var(--accent); font-weight:900;">0/10</small>
                </div>
                <div style="height:4px; background:#222; border-radius:10px; overflow:hidden;">
                    <div id="prog-bar" style="width:0%; height:100%; background:var(--accent); transition:0.4s;"></div>
                </div>
            </div>
        </div>

        <div id="simulation-module">
            <div id="mission-deployment-card"
                style="display: none; position: absolute; inset: 0; z-index: 1000; background: rgba(0,0,0,0.8); display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                <div class="text-center p-5 bg-dark border border-warning rounded-4">
                    <h2 class="text-warning fw-black mb-3">HANDA NA?</h2>
                    <button class="btn btn-warning px-5 py-3 fw-bold" onclick="startMission()">SIMULAN ANG
                        PAG-AKYAT</button>
                </div>
            </div>

            <div id="world">
                <div id="lava-layer"></div>
                <div class="green-ground"></div>
                <div id="ledge-layer"></div>

                <div id="safe-place" style="display:none;">
                    <div class="status-header text-success mb-2">LIGTAS NA LUGAR</div>
                    <div class="safe-door" id="door"></div>
                </div>

                <div id="hero">
                    <img src="/pictures/jumpingfrombulkan.png" alt="Hero">
                </div>
            </div>

            <div id="end-overlay" class="game-overlay">
                <h1 id="end-title" class="fw-bold mb-4"></h1>
                <p id="end-desc" class="mb-4 text-secondary"></p>
                <div class="d-flex flex-column gap-3 w-100 align-items-center">
                    <button id="retryBtn" class="btn btn-outline-warning btn-lg px-5"
                        onclick="location.reload()">ULITIN</button>
                    <a href="{{ route('flood.activity') }}" id="nextPageBtn" class="next-btn" style="display:none;">👉
                        SUSUNOD NA ARALIN (PAGBAHA)</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let drrmProtocols = [
            { q: "Anong Alert Level ang inilalabas ng PHIVOLCS kung malapit nang sumabog ang bulkan?", a1: "Alert Level 3 o 4", a2: "Alert Level 0", ok: 1 },
            { q: "Umuulan ng abo! Ano ang pinakamabuting gamitin para hindi makalanghap ng dumi?", a1: "N95 Mask o basang panyo", a2: "Face shield lang", ok: 1 },
            { q: "Bakit bawal gumamit ng contact lenses kapag may ashfall?", a1: "Dahil ang abo ay parang bubog na makakagasgas sa mata", a2: "Dahil baka matunaw ito sa init", ok: 1 },
            { q: "Kung naabutan ka ng ashfall sa kalsada habang nagmamaneho, ano ang gagawin?", a1: "Tumabi muna at patayin ang aircon", a2: "Bilisan ang takbo para makauwi agad", ok: 1 },
            { q: "Ilang galon ng tubig ang dapat ihanda para sa bawat miyembro ng pamilya kada araw?", a1: "1 galon kada tao", a2: "1 baso kada tao", ok: 1 },
            { q: "Ano ang tawag sa rumagasang putik at abo galing sa bulkan kapag umuulan?", a1: "Lahar", a2: "Baha", ok: 1 },
            { q: "Paano ang tamang paglilinis ng makapal na abo sa bubong ng bahay?", a1: "Buhusan muna ng konting tubig bago walisin", a2: "Hayaan lang hanggang sa gumuho", ok: 1 },
            { q: "Sino ang tanging dapat pakinggan para sa tamang balita tungkol sa bulkan?", a1: "PHIVOLCS at inyong LGU", a2: "Random post sa Facebook", ok: 1 },
            { q: "Bago lumikas ng bahay, ano ang dapat gawin sa main switch ng kuryente?", a1: "I-off ito para iwas sunog", a2: "Iwanang nakabukas para may ilaw", ok: 1 },
            { q: "Ano ang tawag sa lugar sa paligid ng bulkan na bawal tirhan dahil sobrang delikado?", a1: "Permanent Danger Zone (PDZ)", a2: "Tourist Spot", ok: 1 }
        ];

        let currentStep = 0, lavaY = -2200, jumping = false, active = false;
        const gap = 380;

        function proceedToDashboard() {
            // Shuffle the main array of questions
            for (let i = drrmProtocols.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [drrmProtocols[i], drrmProtocols[j]] = [drrmProtocols[j], drrmProtocols[i]];
            }

            document.getElementById('instruction-modal').style.display = 'none';
            document.getElementById('mission-deployment-card').style.display = 'flex';
            initLedges();
        }

        function startMission() {
            document.getElementById('mission-deployment-card').style.display = 'none';
            document.getElementById('cmd-status').innerText = "AKTIBO";
            active = true;
            render();
            lavaCycle();
        }

        function initLedges() {
            const layer = document.getElementById('ledge-layer');
            layer.innerHTML = '';
            for (let i = 0; i < 10; i++) {
                const ledge = document.createElement('div');
                ledge.className = 'stone-ledge';
                const x = (i % 2 === 0) ? "25%" : "75%";
                const y = 400 + (i * gap);
                ledge.style.left = x;
                ledge.style.bottom = y + "px";
                layer.appendChild(ledge);
            }

            const safe = document.getElementById('safe-place');
            safe.style.display = 'flex';
            safe.style.left = '50%';
            safe.style.bottom = (400 + (10 * gap)) + "px";
        }

        function render() {
            if (currentStep >= 10) return;
            const data = drrmProtocols[currentStep];

            // --- SHUFFLE CHOICES LOGIC ---
            // Create an array of choice objects
            let choices = [
                { text: data.a1, id: 1 }, // a1 is always correct in original data
                { text: data.a2, id: 2 }
            ];

            // Randomly swap if Math.random() > 0.5
            if (Math.random() > 0.5) {
                choices.reverse();
            }

            document.getElementById('scenario-text').innerHTML = `
            <strong style="color:var(--accent);">TANONG ${currentStep + 1}:</strong>
            <p>${data.q}</p>
        `;
            document.getElementById('prog-bar').style.width = (currentStep / 10 * 100) + "%";
            document.getElementById('prog-txt').innerText = `${currentStep}/10`;

            document.getElementById('selection-dock').innerHTML = `
            <div class="stone-btn mb-2" onclick="handle(${choices[0].id})">${choices[0].text}</div>
            <div class="stone-btn" onclick="handle(${choices[1].id})">${choices[1].text}</div>
        `;
        }

        function handle(choiceId) {
            if (!active || jumping) return;
            // Check against the 'ok' property (which is always 1 in your data)
            if (choiceId === drrmProtocols[currentStep].ok) {
                moveHero();
            } else {
                lavaY += 300; // Penalty for wrong answer
            }
        }

        function moveHero() {
            jumping = true;
            const hero = document.getElementById('hero');

            const ledges = document.querySelectorAll('.stone-ledge');
            const currentLedge = ledges[currentStep];

            hero.style.left = currentLedge.style.left;
            hero.style.bottom = (parseInt(currentLedge.style.bottom) + 40) + "px";

            setTimeout(() => {
                currentStep++;
                document.getElementById('world').style.transform = `translateY(${(currentStep * gap)}px)`;

                if (currentStep < 10) {
                    render();
                    jumping = false;
                } else {
                    document.getElementById('prog-bar').style.width = "100%";
                    document.getElementById('prog-txt').innerText = `10/10`;
                    document.getElementById('scenario-text').innerHTML = `<h5 class='text-success'>Ligtas ka na! Tumalon na sa Safe Zone!</h5>`;
                    document.getElementById('selection-dock').innerHTML = `<button class='btn btn-success w-100 py-3 fw-bold' onclick='finalLeap()'>TUMALON NA SA LIGTAS NA LUGAR</button>`;
                    jumping = false;
                }
            }, 600);
        }

        function finalLeap() {
            if (jumping) return;
            jumping = true;
            const hero = document.getElementById('hero');
            const safePlace = document.getElementById('safe-place');

            hero.style.left = "50%";
            hero.style.bottom = (parseInt(safePlace.style.bottom) + 20) + "px";

            setTimeout(() => {
                runSafeAnimation();
            }, 600);
        }

        function runSafeAnimation() {
            active = false;
            const door = document.getElementById('door');
            const hero = document.getElementById('hero');

            setTimeout(() => {
                door.classList.add('open');
                setTimeout(() => {
                    hero.style.opacity = "0";
                    setTimeout(() => {
                        showVictoryGift();
                    }, 1000);
                }, 800);
            }, 500);
        }

        function lavaCycle() {
            if (!active) return;
            lavaY += 0.8;
            const lavaElement = document.getElementById('lava-layer');
            lavaElement.style.bottom = lavaY + "px";

            const hero = document.getElementById('hero');
            const heroRect = hero.getBoundingClientRect();
            const lavaRect = lavaElement.getBoundingClientRect();

            if (lavaRect.top <= heroRect.bottom - 10) {
                finish(false);
            } else {
                requestAnimationFrame(lavaCycle);
            }
        }

        function showVictoryGift() {
            document.getElementById('victory-bag-container').classList.add('active');
        }

        function closeGift() {
            document.getElementById('victory-bag-container').classList.remove('active');
            setTimeout(() => finish(true), 500);
        }

        function finish(win) {
            const screen = document.getElementById('end-overlay');
            const nextBtn = document.getElementById('nextPageBtn');
            screen.style.display = 'flex';

            const title = document.getElementById('end-title');
            title.innerText = win ? "MISYON: TAGUMPAY" : "MISYON: BIGO";
            title.style.color = win ? "var(--safe)" : "var(--lava)";

            document.getElementById('end-desc').innerText = win ?
                "Ligtas ka na! Mahusay mong nailigtas ang iyong sarili." :
                "Nalamon ka ng lava. Mag-aral muli ng mga safety protocols.";

            if (win) {
                nextBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'none';
            }
        }
    </script>
</body>

</html>