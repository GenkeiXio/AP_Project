<!DOCTYPE html>
<html lang="tl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batas ng Kaligtasan: Disaster Protocol</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Special+Elite&family=Oswald:wght@500;700&family=Quicksand:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --hazard-yellow: #fcd116;
            --hazard-orange: #ff8c00;
            --rainy-blue: #1e2a38;
            --storm-gray: #34495e;
            --alert-red: #d32f2f;
            --success-green: #2e7d32;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            padding: 20px;
            color: #ffffff;

            /* 🔥 FULL BACKGROUND IMAGE */
            background: url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            /* adjust 0.4–0.6 */
            z-index: -1;
        }

        .game-container {
            max-width: 900px;
            margin: auto;
            border: 4px solid var(--hazard-yellow);
            padding: 30px;
            background: rgba(52, 73, 94, 0.85);
            backdrop-filter: blur(6px);
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.7);
            position: relative;
            border-radius: 10px;
        }

        .game-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: repeating-linear-gradient(45deg, var(--hazard-yellow), var(--hazard-yellow) 10px, #000 10px, #000 20px);
            border-radius: 5px 5px 0 0;
        }

        h1 {
            font-family: 'Oswald', sans-serif;
            color: var(--hazard-yellow);
            font-size: 2.5rem;
            text-transform: uppercase;
            text-shadow: 2px 2px 0px #000;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border: 3px solid var(--hazard-yellow);
            border-radius: 8px;
            background: #000;
            margin-bottom: 10px;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .report-file {
            background: #e0e0e0;
            width: 100%;
            max-width: 650px;
            padding: 35px;
            box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.4);
            border-left: 15px solid var(--hazard-orange);
            font-family: 'Special Elite', cursive;
            margin: 20px auto;
            color: #2c3e50;
        }

        .scenario-img-container {
            width: 100%;
            height: 280px;
            background: #000;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 2px solid #ccc;
        }

        .stamp-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 25px;
        }

        .stamp-btn {
            font-family: 'Oswald', sans-serif;
            padding: 12px 40px;
            font-size: 1.4rem;
            border: 3px solid transparent;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            border-radius: 5px;
        }

        .btn-approve {
            background: transparent;
            color: var(--success-green);
            border-color: var(--success-green);
        }

        .btn-approve:hover {
            background: var(--success-green);
            color: white;
            transform: rotate(-3deg) scale(1.1);
        }

        .btn-deny {
            background: transparent;
            color: var(--alert-red);
            border-color: var(--alert-red);
        }

        .btn-deny:hover {
            background: var(--alert-red);
            color: white;
            transform: rotate(3deg) scale(1.1);
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>

    <div id="decision-modal"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0); z-index: 3000; padding: 25px 50px; background: #000; border: 5px solid var(--hazard-yellow); font-family: 'Oswald'; font-size: 4rem; transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); pointer-events: none;">
        TAMA</div>

    <div class="container game-container">
        <div class="text-center mb-3">
            <h1>BATAS NG KALIGTASAN</h1>
            <p style="color: var(--hazard-orange); font-weight: bold; font-size: 1rem; margin: 0;">[ PROTOCOL: LINDOL AT
                SAKUNA ]</p>
        </div>

        <div id="briefing-layer">
            <div class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <p class="text-center mb-1 fw-bold" style="color: var(--hazard-yellow);">📺 PAGHAHANDA SA LINDOL
                        </p>
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/hlePrsXTGxQ?rel=0&modestbranding=1"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center mb-1 fw-bold" style="color: var(--hazard-yellow);">📺 EMERGENCY KIT GUIDE
                        </p>
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/AxpSZSsxvf8?rel=0&modestbranding=1"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-warning btn-lg fw-bold px-5 shadow" onclick="startDesk()">BUKSAN ANG ARCHIVE
                    📁</button>
            </div>
        </div>

        <div id="game-layer" class="hidden">
            <div class="header-box"
                style="background: #000; color: var(--hazard-yellow); padding: 8px; text-align: center; font-family: 'Oswald'; margin-bottom: 20px; border: 1px solid var(--hazard-yellow); font-size: 1.1rem;">
                DOKUMENTO: <span id="current-report">1</span> / 9
            </div>

            <div class="report-file">
                <div class="scenario-img-container">
                    <img id="scenario-image" src="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
                <div style="font-weight: bold; color: var(--alert-red); font-size: 1rem; margin-bottom: 5px;"
                    id="phase-tag">ESTADO: PAGHAHANDA</div>
                <p id="scenario-text" style="font-size: 1.25rem; line-height: 1.4; margin: 0;">Naghihintay ng datos...
                </p>

                <div class="stamp-container">
                    <button class="stamp-btn btn-approve" onclick="makeDecision(true)">APRUBADO</button>
                    <button class="stamp-btn btn-deny" onclick="makeDecision(false)">ITANGGI</button>
                </div>
            </div>
        </div>

        <div id="end-layer" class="hidden">
            <div class="text-center p-4"
                style="background: rgba(0,0,0,0.8); border: 2px solid var(--success-green); border-radius: 15px;">
                <h2 style="color: var(--success-green); font-family: 'Oswald';">MISYON TAGUMPAY! 🎖️</h2>
                <p class="mt-3">Napagtagumpayan mong matukoy ang mga tamang gawain sa oras ng sakuna. Handa ka na para
                    sa susunod na hamon.</p>
                <div class="mt-4">
                    <a href="{{ route('bulkan.activity') }}" class="btn btn-warning btn-lg fw-bold px-4">SUSUNOD NA
                        ARALIN ➡️</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const imgFolder = "{{ asset('pictures/Module 3/lindol_activity') }}/";
        const scenarios = [
            { text: "BAGO: Makilahok sa mga earthquake drill sa paaralan o barangay.", img: "earthquake_drill.png", phase: "BAGO ANG LINDOL", correct: true },
            { text: "BAGO: Maghanda ng emergency kit na may tubig at pagkain.", img: "emergency_kit.png", phase: "BAGO ANG LINDOL", correct: true },
            { text: "BAGO: Alamin ang mga exit route sa loob ng inyong gusali.", img: "exit_route.png", phase: "BAGO ANG LINDOL", correct: true },
            { text: "HABANG: Umiwas sa mga puno, poste, at matatayog na estruktura.", img: "avoid_structures.png", phase: "HABANG LUMILINDOL", correct: true },
            { text: "HABANG: Gawin ang 'Duck, Cover, and Hold' sa ilalim ng mesa.", img: "duck_cover.png", phase: "HABANG LUMILINDOL", correct: true },
            { text: "HABANG: Pumunta agad sa isang ligtas na bukas na lugar.", img: "go_safe_place.png", phase: "HABANG LUMILINDOL", correct: true },
            { text: "PAGKATAPOS: Lumabas agad sa gusali kapag huminto na ang pagyanig.", img: "exit_building.png", phase: "PAGKATAPOS NG LINDOL", correct: true },
            { text: "PAGKATAPOS: Dalhin ang emergency kit sa paglikas.", img: "bring_kit.png", phase: "PAGKATAPOS NG LINDOL", correct: true },
            { text: "PAGKATAPOS: Lumikas lamang kapag may hudyat na mula sa awtoridad.", img: "evacuate.png", phase: "PAGKATAPOS NG LINDOL", correct: true }
        ];

        let currentIdx = 0;
        let score = 0;
        let startTime;

        function startDesk() {
            startTime = Date.now();
            document.getElementById('briefing-layer').classList.add('hidden');
            document.getElementById('game-layer').classList.remove('hidden');
            updateReport();
        }

        function updateReport() {
            if (currentIdx >= scenarios.length) {
                saveProgress();
                document.getElementById('game-layer').classList.add('hidden');
                document.getElementById('end-layer').classList.remove('hidden');
                return;
            }
            const data = scenarios[currentIdx];
            document.getElementById('current-report').innerText = currentIdx + 1;
            document.getElementById('phase-tag').innerText = "ESTADO: " + data.phase;
            document.getElementById('scenario-text').innerText = data.text;
            document.getElementById('scenario-image').src = imgFolder + data.img;
        }

        function makeDecision(playerChoice) {
            const correct = scenarios[currentIdx].correct;
            const modal = document.getElementById('decision-modal');

            if (playerChoice === correct) {
                modal.innerText = "TAMA";
                modal.style.color = "var(--success-green)";
                modal.style.borderColor = "var(--success-green)";
                score += 11.1;
            } else {
                modal.innerText = "MALI";
                modal.style.color = "var(--alert-red)";
                modal.style.borderColor = "var(--alert-red)";
            }

            modal.style.transform = "translate(-50%, -50%) scale(1)";
            setTimeout(() => {
                modal.style.transform = "translate(-50%, -50%) scale(0)";
                currentIdx++;
                updateReport();
            }, 800);
        }

        function saveProgress() {
            let timeSpent = Math.floor((Date.now() - startTime) / 1000);
            fetch("{{ route('student.module3.lindol.save') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({
                    score: Math.round(score),
                    total_items: scenarios.length,
                    correct_items: Math.round(score / 11.1),
                    time_spent: timeSpent
                })
            }).catch(err => console.error("Save Error:", err));
        }
    </script>
</body>

</html>