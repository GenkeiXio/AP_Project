@extends('Students.studentslayout')
@section('title', 'Module 3 : Gabay sa Kaligtasan Activity')

@push('styles')

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

        html, body{
            scroll-behavior:smooth;
            background:
                linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
        }

        body{
            overflow-x:hidden;
            color:var(--text);
            font-family:'Poppins', sans-serif;
        }

        /* MAIN CONTAINER TO CENTER THE CARD */
        .game-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 100vh;
            padding: 30px;
        }

        /* MINI GAME CARD - MADE BIGGER */
        .game-card {
            width: 600px;  /* Increased from 450px */
            max-width: 95vw;
            background: var(--papel) url('https://www.transparenttextures.com/patterns/parchment.png');
            border: 10px solid var(--kahoy);
            border-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png') 30 stretch;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8);
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 650px;  /* Increased from 550px */
            margin: 0 auto;
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
            font-size: 48px;  /* Increased from 42px */
            margin: 0;
            letter-spacing: 2px;
        }

        .briefing-box {
            color: #e0e0e0;
            text-align: left;
            font-size: 17px;  /* Increased from 15px */
            line-height: 1.7;
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 5px;
            border-left: 4px solid var(--ginto);
        }

        .briefing-box ul {
            margin: 10px 0;
            padding-left: 20px;
            list-style-type: '⚔ ';
        }

        .briefing-box li {
            margin-bottom: 12px;
            color: var(--papel);
        }

        .btn-start {
            margin-top: 35px;
            background: var(--kahoy);
            color: var(--ginto);
            border: 2px solid var(--ginto);
            padding: 18px 50px;  /* Increased from 15px 40px */
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            font-size: 24px;  /* Increased from 20px */
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
            padding: 20px;  /* Increased from 15px */
            text-align: center;
            border-bottom: 3px solid var(--ginto);
        }

        .card-header h2 {
            font-family: 'Baloo 2', cursive;
            margin: 0;
            font-size: 36px;  /* Increased from 30px */
        }

        .image-viewer {
            width: 100%;
            height: 380px;  /* Increased from 300px */
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
            padding: 25px;  /* Increased from 20px */
            display: grid;
            gap: 15px;  /* Increased from 10px */
        }

        .choice-btn {
            background: white;
            border: 2px solid var(--kahoy);
            padding: 16px 20px;  /* Increased from 12px */
            cursor: pointer;
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            font-size: 18px;  /* Added font size */
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
            font-size: 110px;  /* Increased from 90px */
            transform: rotate(-15deg);
            padding: 15px 50px;  /* Increased from 10px 40px */
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
            height: 8px;  /* Increased from 6px */
            background: #ddd;
            width: 100%;
        }

        #progressBar {
            height: 100%;
            background: var(--ginto);
            width: 0%;
            transition: 0.3s;
        }

        .result-area {
            display: none;
            padding: 50px;  /* Increased from 40px */
            text-align: center;
        }

        .result-area h2 {
            font-family: 'Baloo 2', cursive;
            font-size: 48px;  /* Increased from 45px */
            margin: 0;
            color: var(--kahoy);
        }

        .result-area hr {
            border: 1px solid var(--kahoy);
            opacity: 0.2;
            margin: 20px 0;
        }

        #finalScoreDisplay {
            font-size: 80px;  /* Increased from 65px */
            font-weight: 900;
            color: var(--kahoy);
            margin: 20px 0;
        }

        #rankLabel {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--kahoy);
            font-size: 18px;  /* Added font size */
        }

        /* Responsive adjustments */
        @media (max-width: 650px) {
            .game-card {
                width: 100%;
                min-height: auto;
            }
            
            .scroll-header h1 {
                font-size: 32px;
            }
            
            .image-viewer {
                height: 250px;
            }
            
            .stamp {
                font-size: 70px;
            }
            
            #finalScoreDisplay {
                font-size: 55px;
            }
            
            .card-header h2 {
                font-size: 28px;
            }
            
            .choice-btn {
                font-size: 16px;
                padding: 14px 16px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="game-wrapper">
        <div class="game-card">
            <div id="instructionScreen" class="instruction-overlay">
                <div class="scroll-header">
                    <h1>Paghahanda sa Misyon</h1>
                </div>

                <div class="briefing-box">
                    <p style="margin-top:0; font-weight:bold; color:var(--ginto); font-size: 18px;">TAGAPANGALAGA NG BAYAN:</p>
                    Ang iyong tungkulin ay ayusin ang mga talaan ng kaligtasan.
                    <ul>
                        <li>Suriin ang bawat <strong>larawan</strong> na lilitaw.</li>
                        <li>Tukuyin kung ito ay isinasagawa <strong>Bago</strong>, <strong>Habang</strong>, o
                            <strong>Pagkatapos</strong> ng bagyo.
                        </li>
                        <li>Maging mabilis at tumpak sa iyong pagpapasya.</li>
                    </ul>
                    <p style="font-size: 14px; font-style: italic; opacity: 0.8;">"Ang kahandaan ay ang susi sa kaligtasan
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
                <p id="feedbackText" style="color: white; margin-top: 25px; font-family: 'Cinzel'; font-size: 20px;"></p>
            </div>

            <div id="resultArea" class="result-area">
                <h2>ULAT NG PAGSULIT</h2>
                <hr>
                <div id="finalScoreDisplay">0/12</div>
                <p id="rankLabel"></p>
                <button class="choice-btn"
                    style="width:100%; margin-top: 30px; justify-content: center; background:var(--kahoy); color:var(--ginto); font-size: 20px;"
                    onclick="window.location.href = '{{ route('el-nino.activity') }}'">
                    IPAGPATULOY ANG PAGLALAKBAY <span>➔</span>
                </button>
            </div>
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
            }, 2500);
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
@endsection