@extends('Students.studentslayout')
@section('title', 'Module 3 : Lindol Activity')

@push('styles')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"/>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Special+Elite&family=Oswald:wght@500;700&family=Quicksand:wght@400;600&display=swap');

        :root {
            --hazard-yellow: #fcd116;
            --hazard-orange: #ff8c00;
            --rainy-blue: #1e2a38;
            --storm-gray: #34495e;
            --alert-red: #d32f2f;
            --success-green: #2e7d32;
            /* Lighter Wooden Palette - Matching Safe Home */
            --wood-dark: #5c3d2e;
            --wood-medium: #8b6b4f;
            --wood-light: #d2b48c;
            --wood-bg: #c4a484;
            --parchment: #fcfaf7;
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
            color: #fff;
            font-family:'Poppins', sans-serif;
        }

        .game-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .game-container {
            max-width: 900px;
            width: 100%;
            margin: auto;
            /* Lighter Wooden Background - Matching Safe Home */
            background-color: #d4b896;
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border-radius: 20px;
            overflow: hidden;
            border: 6px solid var(--wood-dark);
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            position: relative;
            padding: 0;
        }

        .game-container-inner {
            padding: 30px;
            background: rgba(255, 248, 240, 0.15);
            backdrop-filter: blur(2px);
        }

        .game-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: repeating-linear-gradient(45deg, var(--hazard-yellow), var(--hazard-yellow) 10px, #000 10px, #000 20px);
            border-radius: 14px 14px 0 0;
            z-index: 2;
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
            background: var(--parchment);
            background-image: url('https://www.transparenttextures.com/patterns/handmade-paper.png');
            width: 100%;
            max-width: 650px;
            padding: 35px;
            box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.4);
            border-left: 15px solid var(--hazard-orange);
            border-radius: 8px;
            font-family: 'Special Elite', cursive;
            margin: 20px auto;
            color: var(--wood-dark);
        }

        .scenario-img-container {
            width: 100%;
            height: 280px;
            background: #8b6b4f;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 3px solid var(--wood-dark);
        }

        .scenario-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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
            background: rgba(255,255,255,0.95);
        }

        .btn-approve {
            color: var(--success-green);
            border-color: var(--success-green);
        }

        .btn-approve:hover {
            background: var(--success-green);
            color: white;
            transform: rotate(-3deg) scale(1.1);
        }

        .btn-deny {
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

        #decision-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 3000;
            padding: 25px 50px;
            background: var(--wood-dark);
            border: 5px solid var(--hazard-yellow);
            font-family: 'Oswald', sans-serif;
            font-size: 4rem;
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
            border-radius: 12px;
        }

        .btn-warning-custom {
            background: var(--hazard-yellow);
            color: var(--wood-dark);
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            padding: 12px 40px;
            font-size: 1.2rem;
            border: 3px solid var(--wood-dark);
            border-radius: 8px;
            transition: all 0.2s ease;
            text-transform: uppercase;
        }

        .btn-warning-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(252, 209, 22, 0.4);
            background: #ffe44d;
        }

        .header-box {
            background: var(--wood-dark);
            color: var(--hazard-yellow);
            padding: 10px;
            text-align: center;
            font-family: 'Oswald', sans-serif;
            margin-bottom: 20px;
            border: 2px solid var(--hazard-yellow);
            font-size: 1.1rem;
            border-radius: 8px;
        }

        .phase-tag {
            font-weight: bold;
            color: var(--alert-red);
            font-size: 1rem;
            margin-bottom: 5px;
        }

        /* Subtitle text styling */
        .subtitle-text {
            color: var(--hazard-orange);
            font-weight: bold;
            font-size: 1rem;
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .video-label {
            color: var(--hazard-yellow);
            font-weight: bold;
            text-shadow: 1px 1px 3px #000;
        }

        @media (max-width: 768px) {
            .game-container-inner {
                padding: 20px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .stamp-btn {
                padding: 10px 25px;
                font-size: 1.1rem;
            }
            
            #decision-modal {
                font-size: 2.5rem;
                padding: 15px 30px;
            }
        }
    </style>
@endpush

@section('content')

    <div id="decision-modal">TAMA</div>

    <div class="game-wrapper">
        <div class="game-container">
            <div class="game-container-inner">
                <div class="text-center mb-3">
                    <h1>BATAS NG KALIGTASAN</h1>
                    <p class="subtitle-text">[ PROTOCOL: LINDOL AT SAKUNA ]</p>
                </div>

                <div id="briefing-layer">
                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-center mb-1 fw-bold video-label">📺 PAGHAHANDA SA LINDOL</p>
                                <div class="video-wrapper">
                                    <iframe src="https://www.youtube.com/embed/hlePrsXTGxQ?rel=0&modestbranding=1"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center mb-1 fw-bold video-label">📺 EMERGENCY KIT GUIDE</p>
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
                        <button class="btn-warning-custom" onclick="startDesk()">BUKSAN ANG ARCHIVE 📁</button>
                    </div>
                </div>

                <div id="game-layer" class="hidden">
                    <div class="header-box">
                        DOKUMENTO: <span id="current-report">1</span> / 9
                    </div>

                    <div class="report-file">
                        <div class="scenario-img-container">
                            <img id="scenario-image" src="" alt="Scenario">
                        </div>
                        <div class="phase-tag" id="phase-tag">ESTADO: PAGHAHANDA</div>
                        <p id="scenario-text" style="font-size: 1.25rem; line-height: 1.4; margin: 0;">Naghihintay ng datos...</p>

                        <div class="stamp-container">
                            <button class="stamp-btn btn-approve" onclick="makeDecision(true)">APRUBADO</button>
                            <button class="stamp-btn btn-deny" onclick="makeDecision(false)">ITANGGI</button>
                        </div>
                    </div>
                </div>

                <div id="end-layer" class="hidden">
                    <div class="text-center p-4" style="background: var(--wood-dark); border: 3px solid var(--success-green); border-radius: 15px;">
                        <h2 style="color: var(--success-green); font-family: 'Oswald', sans-serif;">MISYON TAGUMPAY! 🎖️</h2>
                        <p class="mt-3" style="color: var(--parchment);">Napagtagumpayan mong matukoy ang mga tamang gawain sa oras ng sakuna. Handa ka na para sa susunod na hamon.</p>
                        <div class="mt-4">
                            <a href="{{ route('bulkan.activity') }}" class="btn-warning-custom" style="text-decoration: none; display: inline-block;">SUSUNOD NA ARALIN ➡️</a>
                        </div>
                    </div>
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
@endsection