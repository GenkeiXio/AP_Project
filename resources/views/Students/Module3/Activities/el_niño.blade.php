<!DOCTYPE html>
<html lang="tl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Gawain: El Niño at La Niña</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;800&family=Lora:ital,wght@0,400;0,700;1,400&family=Pirata+One&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --papel-pula: #f4f1ea;
            --tinta: #2c3e50;
            --border-ap: #5d6d7e;
            --ginto-kupas: #b59551;
            --elnino: #d35400;
            --lanina: #2980b9;
        }

        body {
            background: url('/pictures/mod3_innermap.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Lora', serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
            /* Iwas sa side-scroll */
        }

        /* ANTIQUE MODAL STYLE - RESPONSIVE */
        .ap-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            padding: 15px;
        }

        .ap-kasulatan {
            background: var(--papel-pula);
            padding: 30px 20px;
            border: 2px solid var(--border-ap);
            outline: 8px double var(--border-ap);
            outline-offset: -12px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            color: var(--tinta);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            max-height: 90vh;
            overflow-y: auto;
            /* Para sa maliit na phone */
        }

        .ap-kasulatan h1 {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--tinta);
            padding-bottom: 5px;
        }

        .instruction-list {
            text-align: left;
            margin: 15px 0;
            padding-left: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .btn-ap {
            background: var(--tinta);
            color: white;
            padding: 12px 25px;
            border: none;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            /* Full width sa mobile */
            max-width: 250px;
        }

        /* MAIN GAME UI */
        .game-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 950px;
            padding: 10px;
        }

        .command-center {
            position: relative;
            width: 100%;
            /* Responsive aspect ratio */
            aspect-ratio: 16/9;
            background: url('/pictures/Module 3/elnino_bg.png') no-repeat center center;
            background-size: cover;
            border: 4px solid var(--border-ap);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
        }

        /* PULSE POINTS - ADJUSTED SIZE FOR TOUCH */
        .pulse-point {
            position: absolute;
            width: clamp(30px, 8vw, 45px);
            height: clamp(30px, 8vw, 45px);
            background: var(--papel-pula);
            border: 2px double var(--tinta);
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--tinta);
            font-family: 'Cinzel';
            font-size: clamp(12px, 4vw, 18px);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            animation: radarGlow 2s infinite ease-in-out;
            z-index: 10;
        }

        @keyframes radarGlow {
            0% {
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.4);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
                transform: scale(1.1);
            }

            100% {
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.4);
                transform: scale(1);
            }
        }

        .pulse-point.solved {
            background: #27ae60 !important;
            animation: none;
            color: white;
            border-color: white;
        }

        /* SELECTION MODAL - RESPONSIVE GRID */
        #selectionModal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--papel-pula);
            border: 3px double var(--tinta);
            padding: 10px;
            display: none;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            z-index: 1000;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.9);
            width: 85%;
            /* Mas malapad sa mobile */
            max-width: 320px;
        }

        .menu-item {
            aspect-ratio: 1/1;
            background: white;
            border: 1px solid #ccc;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* COORDINATES - USING PERCENTAGE FOR SCALING */
        #pt1 {
            top: 12%;
            left: 8%;
            border-color: var(--elnino);
        }

        #pt2 {
            top: 12%;
            right: 28%;
            border-color: var(--lanina);
        }

        #pt3 {
            bottom: 12%;
            left: 10%;
        }

        #pt4 {
            bottom: 12%;
            left: 45%;
        }

        #pt5 {
            bottom: 12%;
            right: 10%;
        }

        /* MOBILE OVERRIDES */
        @media (max-width: 600px) {
            .command-center {
                border-width: 2px;
            }

            .ap-kasulatan {
                outline-width: 5px;
                outline-offset: -10px;
            }

            #selectionModal {
                grid-template-columns: repeat(2, 1fr);
            }

            /* 2 columns lang sa sobrang liit na screen */
            .instruction-list {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div id="briefingOverlay" class="ap-overlay">
        <div class="ap-kasulatan">
            <h1>GABAY SA PAGSASANAY</h1>
            <p style="font-style: italic; margin-bottom: 10px; font-size: 14px;">Basahin ang mga panuto:</p>

            <ul class="instruction-list">
                <li>Suriin ang mga <strong>radar point (?)</strong> sa mapa.</li>
                <li>Pindutin ang punto upang makita ang mga pagpipilian.</li>
                <li>Piliin ang <strong>angkop na hakbang</strong> para sa El Niño o La Niña.</li>
                <li>Kailangang matugunan ang lahat ng <strong>lima (5)</strong> na punto.</li>
            </ul>

            <button class="btn-ap" onclick="magsimula()">SIMULAN</button>
        </div>
    </div>

    <div class="game-container">
        <div class="command-center">
            <div class="pulse-point" id="pt1" onclick="buksanMenu(event, 'tagtuyot1', 'pt1')">?</div>
            <div class="pulse-point" id="pt2" onclick="buksanMenu(event, 'baha1', 'pt2')">?</div>
            <div class="pulse-point" id="pt3" onclick="buksanMenu(event, 'tipid', 'pt3')">?</div>
            <div class="pulse-point" id="pt4" onclick="buksanMenu(event, 'daluyan', 'pt4')">?</div>
            <div class="pulse-point" id="pt5" onclick="buksanMenu(event, 'malinis', 'pt5')">?</div>

            <div id="selectionModal">
                <div class="menu-item" onclick="piliin('tagtuyot1')"><img src="/pictures/Module 3/tagtuyot1.png"></div>
                <div class="menu-item" onclick="piliin('tipid')"><img src="/pictures/Module 3/tipid.png"></div>
                <div class="menu-item" onclick="piliin('baha1')"><img src="/pictures/Module 3/baha1.png"></div>
                <div class="menu-item" onclick="piliin('daluyan')"><img src="/pictures/Module 3/daluyan.png"></div>
                <div class="menu-item" onclick="piliin('malinis')"><img src="/pictures/Module 3/malinis.png"></div>
            </div>
        </div>
    </div>

    <div id="congratsModal" class="ap-overlay" style="display:none;">
        <div class="ap-kasulatan">
            <h1 style="color: #1b4f72;">PAGBATI!</h1>
            <p>Matagumpay mong naitakda ang mga wastong hakbang para sa kaligtasan. Ipinamalas mo ang kahandaan ng isang
                responsableng mamamayan.</p>
            <button class="btn-ap" onclick="window.location.href='{{ route('lindol.activity') }}'">
                MAGPATULOY
            </button>
        </div>
    </div>

    <script>
        let activePointId = null;
        let score = {};
        const tamangSagot = { pt1: 'tagtuyot1', pt2: 'baha1', pt3: 'tipid', pt4: 'daluyan', pt5: 'malinis' };

        function magsimula() {
            document.getElementById('briefingOverlay').style.display = 'none';
        }

        function buksanMenu(e, target, id) {
            activePointId = id;
            document.getElementById('selectionModal').style.display = 'grid';
        }

        function piliin(choiceId) {
            const modal = document.getElementById('selectionModal');
            const point = document.getElementById(activePointId);

            if (choiceId === tamangSagot[activePointId]) {
                point.classList.add('solved');
                point.innerHTML = "✓";
                score[activePointId] = choiceId;
                modal.style.display = 'none';
                checkStatus();
            } else {
                point.style.background = "#e6b0aa";
                setTimeout(() => {
                    point.style.background = "var(--papel-pula)";
                    modal.style.display = 'none';
                }, 500);
            }
        }

        function checkStatus() {
            if (Object.keys(score).length === 5) {
                setTimeout(() => {
                    document.getElementById('congratsModal').style.display = 'flex';
                }, 700);
            }
        }
    </script>

</body>

</html>