<!DOCTYPE html>
<html lang="tl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suri-Larawan: Gabay sa Kaligtasan</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap');

        :root {
            --papel: #fdf5e6;
            --kahoy: #4e342e;
            --ginto: #c5a059;
            --mali: #b71c1c;
            --tama: #2e7d32;
            --dark-overlay: rgba(20, 15, 10, 0.95);
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Baloo 2', cursive;
            background:
                linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* MINI GAME CARD */
        .game-card {
            width: 450px;
            background: var(--papel) url('https://www.transparenttextures.com/patterns/parchment.png');
            border: 10px solid var(--kahoy);
            border-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png') 30 stretch;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8);
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 550px;
        }

        /* REDESIGNED INSTRUCTION SCREEN */
        .instruction-overlay {
            position: absolute;
            inset: 0;
            background: var(--dark-overlay);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 200;
            backdrop-filter: blur(8px);
            padding: 30px;
            border: 2px solid var(--ginto);
        }

        .scroll-header {
            border-bottom: 2px double var(--ginto);
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .scroll-header h1 {
            font-family: 'Baloo 2', cursive;
            color: var(--ginto);
            font-size: 42px;
            margin: 0;
            letter-spacing: 2px;
        }

        .briefing-box {
            color: #e0e0e0;
            text-align: left;
            font-size: 15px;
            line-height: 1.6;
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid var(--ginto);
        }

        .briefing-box ul {
            margin: 10px 0;
            padding-left: 20px;
            list-style-type: '⚔ ';
        }

        .briefing-box li {
            margin-bottom: 10px;
            color: var(--papel);
        }

        .btn-start {
            margin-top: 30px;
            background: var(--kahoy);
            color: var(--ginto);
            border: 2px solid var(--ginto);
            padding: 15px 40px;
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
        }

        .btn-start:hover {
            background: var(--ginto);
            color: var(--kahoy);
            transform: scale(1.05);
        }

        /* GAME UI ELEMENTS */
        .card-header {
            background: var(--kahoy);
            color: var(--ginto);
            padding: 15px;
            text-align: center;
            border-bottom: 3px solid var(--ginto);
        }

        .card-header h2 {
            font-family: 'Baloo 2', cursive;
            margin: 0;
            font-size: 30px;
        }

        .image-viewer {
            width: 100%;
            height: 300px;
            background: #000;
            overflow: hidden;
            border-bottom: 2px solid var(--kahoy);
        }

        .image-viewer img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .button-grid {
            padding: 20px;
            display: grid;
            gap: 10px;
        }

        .choice-btn {
            background: white;
            border: 2px solid var(--kahoy);
            padding: 12px;
            cursor: pointer;
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            transition: 0.2s;
            color: var(--kahoy);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .choice-btn:hover {
            background: var(--kahoy);
            color: var(--ginto);
            transform: translateX(5px);
        }

        /* STAMP FEEDBACK */
        .feedback-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
            backdrop-filter: blur(5px);
        }

        .stamp {
            font-family: 'Baloo 2', cursive;
            font-size: 90px;
            transform: rotate(-15deg);
            padding: 10px 40px;
            border: 10px double;
            animation: stampImpact 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes stampImpact {
            0% {
                transform: scale(4) rotate(0deg);
                opacity: 0;
            }

            100% {
                transform: scale(1) rotate(-15deg);
                opacity: 1;
            }
        }

        .progress-container {
            height: 6px;
            background: #ddd;
            width: 100%;
        }

        #progressBar {
            height: 100%;
            background: var(--ginto);
            width: 0%;
            transition: 0.3s;
        }
    </style>
</head>

<body>

    <div class="game-card">
        <div id="instructionScreen" class="instruction-overlay">
            <div class="scroll-header">
                <h1>Paghahanda sa Misyon</h1>
            </div>

            <div class="briefing-box">
                <p style="margin-top:0; font-weight:bold; color:var(--ginto);">TAGAPANGALAGA NG BAYAN:</p>
                Ang iyong tungkulin ay ayusin ang mga talaan ng kaligtasan.
                <ul>
                    <li>Suriin ang bawat <strong>larawan</strong> na lilitaw.</li>
                    <li>Tukuyin kung ito ay isinasagawa <strong>Bago</strong>, <strong>Habang</strong>, o
                        <strong>Pagkatapos</strong> ng bagyo.
                    </li>
                    <li>Maging mabilis at tumpak sa iyong pagpapasya.</li>
                </ul>
                <p style="font-size: 13px; font-style: italic; opacity: 0.8;">"Ang kahandaan ay ang susi sa kaligtasan
                    ng ating komunidad."</p>
            </div>

            <button class="btn-start" onclick="startGame()">TANGGAPIN ANG MISYON</button>
        </div>

        <div id="gameContent" style="display:none;">
            <div class="card-header">
                <h2 id="stepTitle">Yugto 1 ng 12</h2>
            </div>
            <div class="progress-container">
                <div id="progressBar"></div>
            </div>

            <div class="image-viewer">
                <img id="displayImg" src="" alt="Suriin">
            </div>

            <div class="button-grid">
                <button class="choice-btn" onclick="checkAnswer('bago')">BAGO ANG BAGYO <span>➔</span></button>
                <button class="choice-btn" onclick="checkAnswer('habang')">HABANG MAY BAGYO <span>➔</span></button>
                <button class="choice-btn" onclick="checkAnswer('tapos')">PAGKATAPOS NG BAGYO <span>➔</span></button>
            </div>
        </div>

        <div id="feedbackModal" class="feedback-overlay">
            <div id="stampBox" class="stamp"></div>
            <p id="feedbackText" style="color: white; margin-top: 25px; font-family: 'Cinzel'; font-size: 18px;"></p>
        </div>

        <div id="resultArea" style="display:none; padding: 40px; text-align: center;">
            <h2 style="font-family: 'Baloo 2', cursive; font-size: 45px; margin: 0; color: var(--kahoy);">ULAT NG PAGSULIT
            </h2>
            <hr style="border: 1px solid var(--kahoy); opacity: 0.2;">
            <div style="font-size: 65px; font-weight: 900; color: var(--kahoy); margin: 15px 0;" id="finalScoreDisplay">
                0/12</div>
            <p id="rankLabel"
                style="font-weight: bold; text-transform: uppercase; letter-spacing: 2px; color: var(--kahoy);"></p>
            <button class="choice-btn"
                style="width:100%; margin-top: 30px; justify-content: center; background:var(--kahoy); color:var(--ginto);"
                onclick="window.location.href = '{{ route('el-nino.activity') }}'">
                IPAGPATULOY ANG PAGLALAKBAY
            </button>
        </div>
    </div>

    <script>
        const assets = [
            { src: "{{ asset('pictures/Module 3/Gabay/before1.jpg') }}", cat: 'bago' },
            { src: "{{ asset('pictures/Module 3/Gabay/before2.jpg') }}", cat: 'bago' },
            { src: "{{ asset('pictures/Module 3/Gabay/before3.jpg') }}", cat: 'bago' },
            { src: "{{ asset('pictures/Module 3/Gabay/before4.jpg') }}", cat: 'bago' },
            { src: "{{ asset('pictures/Module 3/Gabay/during1.jpg') }}", cat: 'habang' },
            { src: "{{ asset('pictures/Module 3/Gabay/during2.jpg') }}", cat: 'habang' },
            { src: "{{ asset('pictures/Module 3/Gabay/during3.jpg') }}", cat: 'habang' },
            { src: "{{ asset('pictures/Module 3/Gabay/during4.jpg') }}", cat: 'habang' },
            { src: "{{ asset('pictures/Module 3/Gabay/after1.jpg') }}", cat: 'tapos' },
            { src: "{{ asset('pictures/Module 3/Gabay/after2.png') }}", cat: 'tapos' },
            { src: "{{ asset('pictures/Module 3/Gabay/after3.jpg') }}", cat: 'tapos' },
            { src: "{{ asset('pictures/Module 3/Gabay/after4.jpg') }}", cat: 'tapos' }
        ].sort(() => Math.random() - 0.5);

        let currentIndex = 0;
        let score = 0;
        let gameHistory = [];

        function startGame() {
            document.getElementById('instructionScreen').style.display = 'none';
            document.getElementById('gameContent').style.display = 'block';
            loadStep();
        }

        function loadStep() {
            if (currentIndex >= assets.length) {
                showFinalResults();
                return;
            }
            const item = assets[currentIndex];
            document.getElementById('displayImg').src = item.src;
            document.getElementById('stepTitle').innerText = `Yugto ${currentIndex + 1} ng 12`;
            document.getElementById('progressBar').style.width = (currentIndex / 12 * 100) + "%";
        }

        function checkAnswer(userChoice) {
            const correctCat = assets[currentIndex].cat;
            const isCorrect = userChoice === correctCat;
            if (isCorrect) score++;

            gameHistory.push({
                image: assets[currentIndex].src,
                placed_in: userChoice,
                is_correct: isCorrect
            });

            showFeedback(isCorrect);
        }

        function showFeedback(isCorrect) {
            const modal = document.getElementById('feedbackModal');
            const stamp = document.getElementById('stampBox');
            const text = document.getElementById('feedbackText');

            modal.style.display = 'flex';
            if (isCorrect) {
                stamp.innerText = "TAMA";
                stamp.style.color = "var(--tama)";
                stamp.style.borderColor = "var(--tama)";
                text.innerText = "Mahusay na Obserbasyon!";
            } else {
                stamp.innerText = "MALI";
                stamp.style.color = "var(--mali)";
                stamp.style.borderColor = "var(--mali)";
                text.innerText = "Maling Panahon. Suriin muli.";
            }

            setTimeout(() => {
                modal.style.display = 'none';
                currentIndex++;
                loadStep();
            }, 2500); // 2.5 seconds to read
        }

        function showFinalResults() {
            document.getElementById('gameContent').style.display = 'none';
            document.getElementById('resultArea').style.display = 'block';
            document.getElementById('finalScoreDisplay').innerText = `${score} / 12`;

            let rank = "";
            if (score === 12) rank = "Dalubhasa sa Kaligtasan";
            else if (score >= 8) rank = "Handang Kawal";
            else rank = "Nagsasanay Pa";

            document.getElementById('rankLabel').innerText = rank;

            fetch("{{ route('student.module3.gabay.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ score: score, placements: gameHistory })
            });
        }
    </script>
</body>

</html>