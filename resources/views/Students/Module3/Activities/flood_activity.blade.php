<!DOCTYPE html>
<html lang="tl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Survival Challenge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Lexend:wght@400;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --deep-water: #003973;
            --safety-yellow: #ffcc00;
            --hp-green: #2ecc71;
            --danger-red: #e74c3c;
        }

        body {
            background:
                /* linear-gradient(rgba(0, 20, 40, 0.7), rgba(0, 10, 25, 0.85)), */
                url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;

            font-family: 'Lexend', sans-serif;
            color: white;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* GAME HUD */
        .game-hud {
            background: rgba(0, 0, 0, 0.85);
            padding: 15px 0;
            border-bottom: 4px solid var(--safety-yellow);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .hp-bar-container {
            width: 100%;
            height: 25px;
            background: #333;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #fff;
        }

        #hp-fill {
            width: 100%;
            height: 100%;
            background: var(--hp-green);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .game-stage {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .mission-header h1 {
            font-family: 'Bungee';
            font-size: 2.2rem;
            color: var(--safety-yellow);
            text-align: center;
            text-shadow: 3px 3px 0px #000;
        }

        .briefing-box {
            background: rgba(255, 255, 255, 0.05);
            border-left: 6px solid var(--safety-yellow);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        /* VIDEO SECTION */
        .video-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .video-wrapper {
            background: #000;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        iframe {
            width: 100%;
            height: 250px;
            border-radius: 12px;
        }

        /* QUEST CARD */
        .quest-card {
            background: #ffffff;
            color: #1a1a1b;
            border-radius: 30px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 15px 0px var(--deep-water);
            position: relative;
        }

        .action-btn {
            border: none;
            border-radius: 20px;
            padding: 25px;
            font-family: 'Bungee', cursive;
            font-size: 1.5rem;
            width: 100%;
            transition: 0.2s;
            color: white;
        }

        .btn-safe {
            background: #27ae60;
            box-shadow: 0 8px 0 #1e8449;
        }

        .btn-danger {
            background: #c0392b;
            box-shadow: 0 8px 0 #922b21;
        }

        .action-btn:active {
            transform: translateY(6px);
            box-shadow: 0 2px 0 #000;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-10px);
            }

            80% {
                transform: translateX(10px);
            }
        }

        .damage-shake {
            animation: shake 0.4s ease-in-out;
        }

        #result-screen {
            display: none;
            background: white;
            color: #1a1a1b;
            border-radius: 40px;
            padding: 60px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="game-hud">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span style="font-family: 'Bungee'; color: var(--safety-yellow);">HP</span>
                <div class="hp-bar-container" style="width: 200px;">
                    <div id="hp-fill"></div>
                </div>
            </div>
            <div style="font-family: 'Bungee';">SCORE: <span id="game-score" class="text-warning">0</span></div>
        </div>
    </div>

    <div class="game-stage">
        <div id="game-play">
            <div class="mission-header">
                <h1>Mga Dapat Gawin sa Banta ng Pagbaha</h1>
            </div>

            <div class="briefing-box">
                <h6 class="text-warning fw-bold mb-1">GUIDING QUESTION:</h6>
                <p class="m-0 fs-5">Ano ang maaaring mangyari kung hindi susundin ang safety measures?</p>
            </div>

            <div class="video-grid">
                <div class="video-wrapper">
                    <p class="text-center small mb-2 text-white-50">Ano ang Pagbaha at Flashflood?</p>
                    <iframe src="https://www.youtube.com/embed/9hQZCiZ21fk" allowfullscreen></iframe>
                </div>
                <div class="video-wrapper">
                    <p class="text-center small mb-2 text-white-50">Safety Guide tuwing Pagbaha</p>
                    <iframe src="https://www.youtube.com/embed/AoraXNrMp48" allowfullscreen></iframe>
                </div>
            </div>

            <div class="quest-card" id="card">
                <div class="mb-3 text-muted small">MISSION PROGRESS: <span id="q-num">1</span> / 19</div>
                <h4 id="question-text" class="fw-bold mb-4">Loading mission...</h4>

                <div class="row g-4 mt-2">
                    <div class="col-md-6"><button class="action-btn btn-safe" onclick="processAnswer('safe')">✅
                            LIGTAS</button></div>
                    <div class="col-md-6"><button class="action-btn btn-danger" onclick="processAnswer('danger')">❌
                            DELIKADO</button></div>
                </div>
            </div>
        </div>

        <div id="result-screen">
            <h1 style="font-family: 'Bungee'; color: var(--deep-water);">MISSION COMPLETE!</h1>
            <div class="display-1 fw-bold my-4" id="final-score" style="color: #27ae60;">0</div>
            <p class="fs-4">Magaling! Natapos mo ang gawain!</p>
            <p class="fs-5">Sa activity na ito, natutunan mo kung alin ang mga ligtas at delikadong gawain sa panahon ng
                baha at bagyo. Mahalaga ang pagiging handa, maingat, at pagsunod sa tamang hakbang upang mapanatiling
                ligtas ang sarili at pamilya.
                Tandaan: Ang tamang kaalaman ay susi sa kaligtasan! 🌧️</p>
            <a href="{{ route('module3.closing') }}"
                class="btn btn-dark btn-lg px-5 py-3 rounded-pill fw-bold mt-3">TAPUSIN ANG MODULE</a>
        </div>
    </div>

    <script>
        // --- SOUND ENGINE ---
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

        function playSound(type) {
            if (audioCtx.state === 'suspended') audioCtx.resume();

            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            if (type === 'correct') {
                oscillator.type = 'sine';
                oscillator.frequency.setValueAtTime(523.25, audioCtx.currentTime);
                oscillator.frequency.exponentialRampToValueAtTime(1046.50, audioCtx.currentTime + 0.1);
                gainNode.gain.setValueAtTime(0.1, audioCtx.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3);
                oscillator.start();
                oscillator.stop(audioCtx.currentTime + 0.3);
            } else {
                oscillator.type = 'sawtooth';
                oscillator.frequency.setValueAtTime(150, audioCtx.currentTime);
                oscillator.frequency.linearRampToValueAtTime(100, audioCtx.currentTime + 0.1);

                const osc2 = audioCtx.createOscillator();
                const gain2 = audioCtx.createGain();
                osc2.type = 'sawtooth';
                osc2.frequency.setValueAtTime(150, audioCtx.currentTime + 0.15);
                osc2.frequency.linearRampToValueAtTime(100, audioCtx.currentTime + 0.25);

                osc2.connect(gain2);
                gain2.connect(audioCtx.destination);

                gainNode.gain.setValueAtTime(0.1, audioCtx.currentTime);
                gainNode.gain.linearRampToValueAtTime(0, audioCtx.currentTime + 0.1);
                gain2.gain.setValueAtTime(0.1, audioCtx.currentTime + 0.15);
                gain2.gain.linearRampToValueAtTime(0, audioCtx.currentTime + 0.25);

                oscillator.start();
                oscillator.stop(audioCtx.currentTime + 0.1);
                osc2.start(audioCtx.currentTime + 0.15);
                osc2.stop(audioCtx.currentTime + 0.25);
            }
        }

        // --- GAME LOGIC ---
        const quizData = [
            { t: "May tuloy-tuloy na ulan at may posibilidad ng pagbaha, kaya naghahanda ka ng emergency kit.", a: "safe" },

            { t: "Habang may bagyo, patuloy kang nakikinig sa radyo o TV para sa updates at babala.", a: "safe" },

            { t: "Hindi ka muna nag-iimbak ng tubig dahil hindi pa naman nagsisimula ang baha.", a: "danger" },

            { t: "Nag-iimbak ka ng malinis na tubig kahit wala pang baha bilang paghahanda.", a: "safe" },

            { t: "Inilalagay mo ang mahahalagang gamit sa sahig para madaling makuha kung sakaling kailanganin.", a: "danger" },

            { t: "Inilalagay mo ang mahahalagang gamit sa mataas na lugar upang maiwasan ang pagkabasa.", a: "safe" },

            { t: "Inililipat mo ang iyong alagang hayop sa ligtas at mataas na lugar habang tumataas ang tubig.", a: "safe" },

            { t: "Pinapabayaan mo muna ang alagang hayop sa labas habang inaasikaso ang ibang gamit.", a: "danger" },

            { t: "Nanatili ka sa loob ng bahay habang malakas ang ulan at walang kailangang gawin sa labas.", a: "safe" },

            { t: "Lumalabas ka upang tingnan ang baha kahit malakas pa ang ulan.", a: "danger" },

            { t: "Pinapatay mo ang kuryente bago lumikas upang maiwasan ang aksidente.", a: "safe" },

            { t: "Nagpapasya kang huwag muna lumikas kahit may babala na, hangga't hindi pa pumapasok ang tubig sa bahay.", a: "danger" },

            { t: "Iniiwasan mong tumawid sa baha kung hindi mo alam ang lalim nito.", a: "safe" },

            { t: "Sinusubukan mong tawirin ang baha kahit hindi mo alam kung gaano ito kalalim.", a: "danger" },

            { t: "Hindi mo pinipilit ang sasakyan na dumaan sa baha kung mataas na ang tubig.", a: "safe" },

            { t: "Pagkatapos ng baha, pinapakuluan mo ang tubig bago ito inumin.", a: "safe" },

            { t: "Umiinom ka ng tubig mula sa gripo pagkatapos ng baha kahit hindi ito napakuluan.", a: "danger" },

            { t: "Sinisigurado mong walang nakalaylay na live wire sa paligid bago lumabas ng bahay.", a: "safe" },

            { t: "Binubuksan agad ang kuryente matapos ang baha nang hindi muna nagpapasuri sa eksperto.", a: "danger" }
        ];

        let current = 0;
        let score = 0;
        let hp = 100;
        let answers = [];

        function refreshUI() {
            if (current >= quizData.length) {

                // SAVE COMPLETED GAME
                saveGame(false);

                document.getElementById('game-play').style.display = 'none';
                document.getElementById('result-screen').style.display = 'block';
                document.getElementById('final-score').innerText = score;
                return;
            }
            document.getElementById('q-num').innerText = current + 1;
            document.getElementById('question-text').innerText = quizData[current].t;
            document.getElementById('card').classList.remove('damage-shake');
        }

        function processAnswer(choice) {
            // save answer
            answers.push({
                question: current,
                selected: choice,
                correct: quizData[current].a
            });

            if (choice === quizData[current].a) {
                score += 1;
                document.getElementById('game-score').innerText = score;
                playSound('correct');
            } else {
                hp -= 20;
                document.getElementById('hp-fill').style.width = hp + "%";
                document.getElementById('card').classList.add('damage-shake');
                playSound('wrong');
                if (hp <= 0) {

                    //SAVE GAME OVER
                    saveGame(true);

                    alert("GAME OVER! Naubos ang iyong HP. Subukan muli.");
                    location.reload();
                    return;
                }
            }
            current++;
            setTimeout(refreshUI, 400);
        }

        function saveGame(isGameOver = false) {
            fetch("{{ route('student.module3.flood.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    score: score,
                    hp_remaining: hp,
                    answers: answers,
                    is_game_over: isGameOver
                })
            });
        }
        refreshUI();
    </script>

</body>

</html>