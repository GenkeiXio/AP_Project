{{-- filepath: resources/views/Students/Module3/Nodes/mod3_node1.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Modyul 3 - Node 1: Ang Lihim ng Arkibo')

@section('content')

    <style>
        /* ================= MOBILE ONLY ================= */

        /* Tablet and below */
        @media (max-width: 900px) {

            .ap-wrapper {
                height: auto !important;
                min-height: 100vh;
            }

            .book-spine::after {
                display: none !important;
            }

            .book-container {
                height: auto !important;
            }

            .book-spine {
                flex-direction: column;
                height: auto !important;
            }

            .page {
                width: 100%;
                padding: 16px 10px;
            }

            .left-page,
            .right-page {
                border: none;
                border-radius: 0;
            }

            /* 🔥 HARD RESET flip system on mobile */
            .flip-layer {
                display: none;
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                top: 0 !important;
                right: 0 !important;
                transform: none !important;
                box-shadow: none !important;
                padding: 20px 12px !important;
            }

            /* hide flipped pages completely */
            .flipped {
                display: none !important;
            }

            #gameHUD {
                width: 100% !important;
                flex-wrap: wrap;
                gap: 6px;
            }

            .timer-container {
                width: 100%;
            }

            .book-container {
                height: auto !important;
                min-height: unset !important;
            }
        }


        /* Phones */
        @media (max-width: 600px) {

            .book-spine {
                padding: 6px;
                box-shadow: none;
            }

            .page {
                padding: 12px 8px;
                font-size: 0.95rem;
            }

            h1 {
                font-size: 1.3rem !important;
            }

            h2 {
                font-size: 1.1rem !important;
            }

            .btn-vintage {
                width: 100%;
                padding: 10px;
                font-size: 0.9rem;
            }

            .drop-placeholder {
                width: 100%;
                height: 180px;
            }

            .inner-inventory,
            .completed-grid {
                grid-template-columns: 1fr;
            }

            .completed-grid img {
                height: 90px;
            }

            .card-item img {
                height: 80px;
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
        }

        body {
            margin: 0;
            background:
                linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
                url("{{ asset('pictures/mod3_innermap.png') }}") center center / cover no-repeat fixed;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            overflow-y: auto;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        .page-content,
        .container,
        .main-wrapper {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .ap-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100dvh;
            height: auto !important;
            box-sizing: border-box;
            padding: 10px;
        }

        /* -----------------------------------------------------------
                                                                   VINTAGE BOOK DESIGN
                                                                ----------------------------------------------------------- */
        .book-container {
            width: min(850px, calc(100vw - 24px));
            height: min(520px, calc(100dvh - 98px));
            perspective: 1500px;
            position: relative;
        }

        .book-spine {
            width: 100%;
            height: 100%;
            background: var(--vintage-leather);
            border-radius: 5px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9);
            display: flex;
            padding: 15px;
            border: 2px solid var(--gold-trim);
            position: relative;
        }

        .book-spine::after {
            content: '';
            position: absolute;
            left: 50%;
            width: 8px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.5), transparent);
            z-index: 60;
            /* Layered on top of flipping pages */
            transform: translateX(-50%);
        }

        .page {
            flex: 1;
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            position: relative;
            padding: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.2);
            color: var(--ink);
        }

        .left-page {
            border-radius: 3px 0 0 3px;
            border-right: 1px solid rgba(0, 0, 0, 0.2);
        }

        .right-page {
            border-radius: 0 3px 3px 0;
            border-left: 1px solid rgba(0, 0, 0, 0.2);
        }

        /* Realistic Flip Animation */
        .flip-layer {
            position: absolute;
            right: 15px;
            top: 15px;
            width: calc(50% - 15px);
            height: calc(100% - 30px);
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            transform-origin: left;
            transition: transform 1s cubic-bezier(0.645, 0.045, 0.355, 1), box-shadow 1s;
            z-index: 55;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            border-radius: 0 3px 3px 0;
            box-shadow: inset -10px 0 20px rgba(0, 0, 0, 0.1);
            backface-visibility: hidden;
        }

        .flipped {
            transform: rotateY(-180deg);
            box-shadow: inset 10px 0 20px rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        /* -----------------------------------------------------------
                                                                   GAMEPLAY ELEMENTS
                                                                ----------------------------------------------------------- */
        .drop-placeholder {
            width: 280px;
            /* Mas malaki */
            height: 280px;
            border: 3px dashed rgba(0, 0, 0, 0.2);
            background: rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-top: 10px;
            transition: 0.3s;
        }

        .drop-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .inner-inventory {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            width: 100%;
        }

        .completed-board {
            width: 100%;
            text-align: center;
        }

        .completed-board h3 {
            margin: 0 0 10px 0;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            padding-bottom: 8px;
        }

        .completed-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            width: 100%;
        }

        .completed-grid img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border: 1px solid #8b6b3f;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.3);
            background: #f4e4c7;
        }

        .completed-empty {
            margin-top: 14px;
            font-size: 0.9rem;
            opacity: 0.75;
        }

        .card-item {
            background: #fff;
            padding: 6px;
            box-shadow: 2px 6px 12px rgba(0, 0, 0, 0.4);
            cursor: grab;
            transition: 0.2s;
            border: 1px solid #aaa;
        }

        .card-item:hover {
            transform: scale(1.1) rotate(-2deg);
        }

        .card-item img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            filter: sepia(0.4) contrast(1.1);
        }

        /* TIMER & ALERTS */
        .timer-container {
            width: min(850px, calc(100vw - 24px));
            height: 12px;
            background: #222;
            margin-bottom: 20px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--gold-trim);
        }

        .timer-bar {
            width: 100%;
            height: 100%;
            background: var(--gold-trim);
            transition: width 1s linear, background-color 0.3s;
        }

        .timer-warning {
            background-color: var(--danger) !important;
            animation: pulse-red 0.5s infinite;
        }

        @keyframes pulse-red {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .btn-vintage {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 24px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-vintage:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }

        .btn-vintage:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .attempt-indicator {
            margin-top: 14px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--danger);
        }

        .hidden {
            display: none !important;
        }
    </style>

    <div class="ap-wrapper">

        <div id="gameHUD" class="hidden"
            style="width: min(850px, calc(100vw - 24px)); color: var(--gold-trim); display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.9rem;">
            <span>ANTAS: <span id="txtStep">1/4</span></span>
            <span id="timeText" style="font-weight: bold;">ORAS: 10s</span>
            <span>DUNONG: <span id="txtScore">0</span></span>
        </div>

        <div id="timerContainer" class="timer-container hidden">
            <div id="timerBar" class="timer-bar"></div>
        </div>

        <div class="book-container">
            <div class="book-spine">

                <div class="page left-page">
                    <div id="introLeft">
                        <h1
                            style="font-family: 'Nunito', sans-serif; font-weight: 800; border-bottom: 2px solid var(--ink);">
                            TALAAN NG BAYAN</h1>
                        <p style="font-size: 0.7rem; letter-spacing: 2px;">REKORD NG MGA SAKUNA</p>
                    </div>
                    <div id="cardStorage" class="inner-inventory hidden"></div>
                    <div id="completedBoard" class="completed-board hidden">
                        <h3>MGA LARAWANG NAAYOS</h3>
                        <div id="completedGrid" class="completed-grid"></div>
                        <p id="completedEmpty" class="completed-empty hidden">Walang tamang larawan na naitala.</p>
                    </div>
                </div>

                <div class="page right-page">
                    <div id="gameRight" class="hidden">
                        <p style="font-size: 0.8rem; margin: 0;">IBALIK ANG LARAWAN NG:</p>
                        <h2 id="targetLabel" style="margin: 10px 0; color: var(--danger);">HAZARD</h2>
                        <div id="dropZone" class="drop-placeholder">
                            <span style="opacity: 0.3; font-size: 0.8rem;">IDIKIT DITO</span>
                        </div>
                    </div>

                    <div id="finalResult" class="hidden" style="text-align: center; padding: 20px;">
                        <h2 id="resultTitle" style="font-family: 'Nunito', sans-serif; font-weight: 800;">MISYON: TAGUMPAY
                        </h2>
                        <p id="resultMsg" style="font-size: 1.1rem; line-height: 1.6; margin: 25px 0;"></p>
                        <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                            <button id="btnRepeat" onclick="repeatQuest()" class="btn-vintage">ULITIN</button>
                            <button id="btnToMap" onclick="window.location.href='{{ route('inner.map3') }}'"
                                class="btn-vintage" style="display:none;">BUMALIK SA MAPA</button>
                        </div>
                        <p id="attemptIndicator" class="attempt-indicator hidden"></p>
                    </div>
                </div>

                <div id="flip2" class="flip-layer" style="z-index: 99;">
                    <div>
                        <h2 style="color: var(--danger); font-family: 'Nunito', sans-serif; font-weight: 800;">BANTAY-ORAS!
                        </h2>
                        <p style="line-height: 1.6;">"Habang tumatagal, kumukupas ang tinta sa talaan. Sa bawat pahina,
                            mayroon ka lamang <strong>10 segundo</strong> upang maitugma ang tamang larawan sa tamang
                            konsepto."</p>
                        <p style="font-size: 0.9rem; margin-top: 15px; line-height: 1.6;">Kapag umabot sa 5 segundo ang
                            natitirang oras, magiging pula ang orasan bilang huling babala.</p>
                        <button class="btn-vintage" onclick="startQuest()">SIMULAN ANG PAG-AAYOS</button>
                    </div>
                </div>

                <div id="flip3" class="flip-layer" style="z-index: 100;">
                    <div>
                        <p style="font-size: 1.05rem; line-height: 1.6;">
                            "Sa bawat pahina ng talaan, nakaukit ang alaala ng mga unos na minsang yumanig sa ating
                            barangay: bagyo, baha,
                            at pagguho. Ngunit kasabay ng bawat sakuna ay mga aral kung paano tayo makaiiwas sa mas malalang
                            pinsala."
                        </p>
                        <p style="font-size: 0.95rem; line-height: 1.6; margin-top: 14px;">
                            "Ikaw ngayon ang tagapag-ingat ng talaan. Ayusin mo ang mga larawan upang maibalik ang wastong
                            kahulugan ng
                            Hazard, Risk, Disaster, at Resilience para sa susunod na henerasyon."
                        </p>
                        <button class="btn-vintage" onclick="flipPage(3)">IPAGPATULOY ANG PAGBASA</button>
                    </div>
                </div>

                <div id="flip1" class="flip-layer" style="z-index: 101;">
                    <div>
                        <p style="font-size: 1.15rem; line-height: 1.7;">"Sa isang maulang gabi, may natagpuan akong lumang
                            talaan sa silid-imbakan ng barangay. Halos punit na ang mga pahina,
                            ngunit naroon pa rin ang mahahalagang aral sa kaligtasan ng komunidad."</p>
                        <button class="btn-vintage" onclick="flipPage(1)">BASAHIN ANG SUSUNOD NA PAHINA</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <audio id="sndTama" src="https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3"></audio>
    <audio id="sndMali" src="https://assets.mixkit.co/active_storage/sfx/2571/2571-preview.mp3"></audio>
    <audio id="sndAlert" src="https://assets.mixkit.co/active_storage/sfx/951/951-preview.mp3"></audio>
    <audio id="sndFlip" src="https://assets.mixkit.co/active_storage/sfx/1474/1474-preview.mp3"></audio>

    <script>
        const data = [
            { label: "Hazard", img: "hazard.png" },
            { label: "Risk", img: "risk.png" },
            { label: "Disaster", img: "disaster.png" },
            { label: "Resilience", img: "resilience.png" }
        ];

        const imgPath = "{{ asset('pictures/Module 3/Node 1') }}/";
        let step = 0; let points = 0; let locked = false;
        let timer = 10; let countdown;
        let audioCtx;
        let completedCorrect = [];
        let retryCount = 0;
        const maxRetries = 3;

        function playSound(id) {
            const s = document.getElementById(id);
            if (s) {
                s.currentTime = 0;
                s.play().catch(() => { });
            }
        }

        function getAudioCtx() {
            if (!audioCtx) {
                const Ctx = window.AudioContext || window.webkitAudioContext;
                if (!Ctx) return null;
                audioCtx = new Ctx();
            }

            if (audioCtx.state === 'suspended') {
                audioCtx.resume().catch(() => { });
            }

            return audioCtx;
        }

        function playPaperRustle() {
            const ctx = getAudioCtx();
            if (!ctx) return;

            const duration = 0.2 + Math.random() * 0.09;
            const bufferSize = Math.floor(ctx.sampleRate * duration);
            const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
            const channel = buffer.getChannelData(0);
            let brown = 0;

            for (let i = 0; i < bufferSize; i++) {
                // Blend white + brown noise so the texture sounds more like rubbing paper fibers.
                const white = (Math.random() * 2 - 1) * 0.75;
                brown = (brown + 0.045 * white) / 1.045;
                const envelope = Math.pow(1 - (i / bufferSize), 0.85);
                channel[i] = (white * 0.6 + brown * 0.9) * envelope;
            }

            const source = ctx.createBufferSource();
            source.buffer = buffer;
            source.playbackRate.value = 0.86 + Math.random() * 0.22;

            const highPass = ctx.createBiquadFilter();
            highPass.type = 'highpass';
            highPass.frequency.value = 420 + Math.random() * 180;

            const lowPass = ctx.createBiquadFilter();
            lowPass.type = 'lowpass';
            lowPass.frequency.value = 3000 + Math.random() * 900;

            const gain = ctx.createGain();
            const now = ctx.currentTime;
            gain.gain.setValueAtTime(0.0001, now);
            gain.gain.exponentialRampToValueAtTime(0.11, now + 0.02);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + duration);

            source.connect(highPass);
            highPass.connect(lowPass);
            lowPass.connect(gain);
            gain.connect(ctx.destination);

            source.start(now);
            source.stop(now + duration);
        }

        function playPageThump() {
            const ctx = getAudioCtx();
            if (!ctx) return;

            const osc = ctx.createOscillator();
            osc.type = 'triangle';
            osc.frequency.value = 120 + Math.random() * 24;

            const gain = ctx.createGain();
            const now = ctx.currentTime;
            gain.gain.setValueAtTime(0.0001, now);
            gain.gain.exponentialRampToValueAtTime(0.03, now + 0.01);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.08);

            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.start(now);
            osc.stop(now + 0.09);
        }

        function playPageFlip() {
            const flip = document.getElementById('sndFlip');
            if (flip) {
                flip.currentTime = 0;
                flip.volume = 0.36;
                flip.playbackRate = 0.84 + Math.random() * 0.18;
                if ('preservesPitch' in flip) flip.preservesPitch = false;
                if ('webkitPreservesPitch' in flip) flip.webkitPreservesPitch = false;
                flip.play().catch(() => { });
            }

            // Multi-layer texture: soft thump + overlapping rustles feels closer to a real page turn.
            playPageThump();
            playPaperRustle();
            setTimeout(() => playPaperRustle(), 45 + Math.random() * 35);
            setTimeout(() => playPaperRustle(), 95 + Math.random() * 45);
        }

        function flipPage(num) {
            playPageFlip();
            document.getElementById('flip' + num).classList.add('flipped');
        }

        function resetRoundUI() {
            const dropZone = document.getElementById('dropZone');
            const rPage = document.querySelector('.right-page');
            const timerBar = document.getElementById('timerBar');
            const timeText = document.getElementById('timeText');

            clearInterval(countdown);
            step = 0;
            points = 0;
            locked = false;
            timer = 10;
            completedCorrect = [];

            dropZone.innerHTML = `<span style="opacity: 0.3; font-size: 0.8rem;">IDIKIT DITO</span>`;
            rPage.style.boxShadow = "inset 0 0 50px rgba(0,0,0,0.2)";
            timerBar.classList.remove('timer-warning');
            timerBar.style.width = '100%';
            timeText.style.color = 'var(--gold-trim)';
            timeText.innerText = 'ORAS: 10s';
            document.getElementById('txtScore').innerText = '0';
            document.getElementById('txtStep').innerText = `1/${data.length}`;
        }

        function repeatQuest() {
            const isLockedOut = retryCount >= maxRetries;
            if (isLockedOut) return;

            resetRoundUI();

            document.getElementById('finalResult').classList.add('hidden');
            document.getElementById('completedBoard').classList.add('hidden');
            document.getElementById('attemptIndicator').classList.add('hidden');

            document.getElementById('gameHUD').classList.remove('hidden');
            document.getElementById('timerContainer').classList.remove('hidden');
            document.getElementById('cardStorage').classList.remove('hidden');
            document.getElementById('gameRight').classList.remove('hidden');

            initRound();
        }

        function startQuest() {

            // 🔥 MOBILE FIX: hide all slides manually
            if (window.matchMedia("(max-width: 900px)").matches) {
                ['flip1', 'flip2', 'flip3'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.style.display = 'none';
                });
            }

            flipPage(2);

            setTimeout(() => {
                document.getElementById('gameHUD').classList.remove('hidden');
                document.getElementById('timerContainer').classList.remove('hidden');
                document.getElementById('introLeft').classList.add('hidden');
                document.getElementById('cardStorage').classList.remove('hidden');
                document.getElementById('gameRight').classList.remove('hidden');
                initRound();
            }, 600);
        }

        function initRound() {
            if (step >= data.length) return finish();

            locked = false;
            timer = 10;
            updateTimerUI();

            document.getElementById('txtStep').innerText = `${step + 1}/${data.length}`;
            document.getElementById('targetLabel').innerText = data[step].label.toUpperCase();

            const pool = data.map(d => d.img).sort(() => Math.random() - 0.5);
            const storage = document.getElementById('cardStorage');
            storage.innerHTML = '';

            pool.forEach(file => {
                const card = document.createElement('div');
                card.className = 'card-item';
                card.draggable = true;
                card.innerHTML = `<img src="${imgPath}${file}">`;
                card.addEventListener('dragstart', (e) => {
                    if (locked) return e.preventDefault();
                    e.dataTransfer.setData('text/plain', file);
                });
                storage.appendChild(card);
            });

            runCountdown();
        }

        function runCountdown() {
            clearInterval(countdown);
            countdown = setInterval(() => {
                timer--;
                updateTimerUI();

                if (timer === 5) {
                    playSound('sndAlert');
                }

                if (timer <= 0) {
                    clearInterval(countdown);
                    checkAnswer('');
                }
            }, 1000);
        }

        function updateTimerUI() {
            const bar = document.getElementById('timerBar');
            const text = document.getElementById('timeText');

            bar.style.width = (timer * 10) + '%';
            text.innerText = `ORAS: ${timer}s`;

            if (timer <= 5) {
                bar.classList.add('timer-warning');
                text.style.color = 'var(--danger)';
            } else {
                bar.classList.remove('timer-warning');
                text.style.color = 'var(--gold-trim)';
            }
        }

        const dropZone = document.getElementById('dropZone');
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('drag-over'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            if (locked) return;
            checkAnswer(e.dataTransfer.getData('text/plain'));
        });

        function checkAnswer(choice) {
            locked = true;
            clearInterval(countdown);

            const isCorrect = choice === data[step].img;
            const isLastStep = step === data.length - 1;
            const rPage = document.querySelector('.right-page');

            if (isCorrect) {
                points++;
                completedCorrect.push(choice);
                document.getElementById('txtScore').innerText = points;
                playSound('sndTama');
                dropZone.innerHTML = `<img src="${imgPath}${choice}" style="width:100%; height:100%; object-fit:contain;">`;
            } else {
                playSound('sndMali');
                rPage.style.boxShadow = "inset 0 0 60px rgba(183, 28, 28, 0.6)";
            }

            setTimeout(() => {
                rPage.style.boxShadow = "inset 0 0 50px rgba(0,0,0,0.2)";

                if (isLastStep) {
                    step++;
                    finish();
                    return;
                }

                dropZone.innerHTML = `<span style="opacity: 0.3; font-size: 0.8rem;">IDIKIT DITO</span>`;
                step++;
                initRound();
            }, 1500);
        }

        function renderCompletedBoard() {
            const grid = document.getElementById('completedGrid');
            const empty = document.getElementById('completedEmpty');

            grid.innerHTML = '';

            if (!completedCorrect.length) {
                empty.classList.remove('hidden');
                return;
            }

            empty.classList.add('hidden');

            completedCorrect.forEach(file => {
                const img = document.createElement('img');
                img.src = `${imgPath}${file}`;
                img.alt = file.replace('.png', '');
                grid.appendChild(img);
            });
        }

        function finish() {
            document.getElementById('gameRight').classList.add('hidden');
            document.getElementById('cardStorage').classList.add('hidden');
            document.getElementById('timerContainer').classList.add('hidden');
            document.getElementById('gameHUD').classList.add('hidden');
            document.getElementById('finalResult').classList.remove('hidden');
            document.getElementById('completedBoard').classList.remove('hidden');
            renderCompletedBoard();

            const attemptIndicator = document.getElementById('attemptIndicator');
            const repeatBtn = document.getElementById('btnRepeat');
            const mapBtn = document.getElementById('btnToMap');
            const isComplete = points === data.length;

            // Mark node as completed once the node flow reaches finish screen.
            sessionStorage.setItem('m3v2_node1', 'true');
            localStorage.setItem('m3v2_node1', 'true');
            mapBtn.style.display = 'inline-flex';

            if (!isComplete) {
                retryCount++;
                const retriesLeft = Math.max(0, maxRetries - retryCount);

                attemptIndicator.classList.remove('hidden');
                attemptIndicator.innerText = `May ilang sagot pang kailangang ayusin. Natitirang pag-ulit: ${retriesLeft} / ${maxRetries}`;

                if (retriesLeft <= 0) {
                    repeatBtn.disabled = true;
                    attemptIndicator.innerText = 'Naabot mo na ang 3 pag-ulit. Balikan ang mga konsepto bago subukang muli.';
                } else {
                    repeatBtn.disabled = false;
                }
            } else {
                repeatBtn.disabled = false;
                attemptIndicator.classList.add('hidden');
            }

            document.getElementById('resultTitle').innerText = isComplete ? 'MISYON: TAGUMPAY' : 'MISYON: HINDI PA TAPOS';

            const msg = isComplete
                ? "Mahusay! Kumpleto mong naibalik ang mga larawan kaya ligtas ang mahahalagang ulat ng barangay."
                : "May mga larawang hindi pa naitugma nang tama. Maaari mo pa itong subukang ayusin hanggang sa matapos nang wasto.";

            document.getElementById('resultMsg').innerText = `${msg}\n\nNakakuha ka ng ${points} / ${data.length} na puntos.`;
        }

        /* ================= MOBILE SLIDE MODE ================= */

        function isMobileView() {
            return window.matchMedia("(max-width: 900px)").matches;
        }

        if (isMobileView()) {

            let currentSlide = 0;
            const slides = ['flip1', 'flip3', 'flip2'];

            function showSlide(index) {
                slides.forEach((id, i) => {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.style.display = (i === index) ? 'block' : 'none';
                });
            }

            // override ONLY on mobile
            const originalFlip = window.flipPage;

            window.flipPage = function () {

                // if NOT last slide → go next
                if (currentSlide < slides.length - 1) {
                    currentSlide++;
                    showSlide(currentSlide);
                    return;
                }

                // LAST SLIDE → trigger original start button behavior
                const startBtn = document.querySelector('#flip2 button');
                if (startBtn) {
                    startBtn.click(); // simulate real button click
                }
            };

            window.addEventListener('load', () => {
                currentSlide = 0;
                showSlide(0);
            });
        }
    </script>

@endsection