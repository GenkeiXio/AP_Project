<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity: El Niño at La Niña</title>

    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;800&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --elnino: #f59e0b;
            --lanina: #3b82f6;
            --bg-dark: #0f172a;
        }

        body {
            background-color: var(--bg-dark);
            font-family: 'Inter', sans-serif;
            color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 350px 220px 1fr; /* Pinalapad ang column para sa items */
            min-height: 100vh;
            gap: 20px;
            padding: 20px;
        }

        /* COLUMN 1: INFO & VIDEOS */
        .sidebar-info {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 24px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h1 { font-family: 'Lexend'; font-size: 1.3rem; color: #fff; margin: 0; }
        
        .guiding-box { 
            background: rgba(59, 130, 246, 0.15); 
            padding: 15px; 
            border-radius: 15px; 
            border-left: 6px solid var(--lanina);
        }
        .guiding-box strong { color: var(--lanina); font-size: 0.9rem; text-transform: uppercase; }
        .guiding-box p { font-size: 1.1rem; font-weight: 600; margin: 5px 0 0; line-height: 1.3; }

        .video-card {
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .video-card iframe {
            width: 100%;
            aspect-ratio: 16 / 9;
            height: auto;
            display: block;
        }

        /* COLUMN 2: DRAGGABLE ITEMS (BIGGER) */
        .item-panel {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow-y: auto;
        }

        .panel-label { font-size: 0.85rem; font-weight: 800; color: #2dd4bf; text-align: center; margin-bottom: 5px; }

        .draggable {
            width: 120px; /* Mas malaki na para madaling basahin */
            height: 120px;
            background: white;
            border-radius: 18px;
            padding: 10px;
            cursor: grab;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            object-fit: contain;
            box-shadow: 0 10px 20px rgba(0,0,0,0.4);
        }
        .draggable:hover { transform: scale(1.1) rotate(2deg); box-shadow: 0 15px 30px rgba(59, 130, 246, 0.3); }

        /* COLUMN 3: MAP */
        .map-area {
            position: relative;
            background: rgba(255, 255, 255, 0.01);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .map-wrapper { position: relative; width: 100%; max-width: 950px; }
        .bg-img { width: 100%; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.6); }

        /* DROP ZONES */
        .dropzone {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border: 3px dashed rgba(255, 255, 255, 0.4);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
        }
        .dropzone.active { background: rgba(255, 255, 255, 0.3); border-color: #fff; transform: scale(1.05); }

        /* Zone Positions */
        #zone1 { top: 8%; left: 2%; width: 22%; height: 18%; }
        #zone2 { top: 8%; left: 55%; width: 22%; height: 18%; }
        #zone3 { bottom: 6%; left: 3%; width: 22%; height: 16%; }
        #zone4 { bottom: 6%; left: 38%; width: 22%; height: 16%; }
        #zone5 { bottom: 6%; right: 3%; width: 22%; height: 16%; }

        /* SUCCESS MESSAGE */
        #successBox {
            position: absolute;
            background: #10b981;
            padding: 40px;
            border-radius: 30px;
            text-align: center;
            display: none;
            z-index: 100;
            box-shadow: 0 25px 50px rgba(0,0,0,0.8);
            border: 4px solid white;
        }

        @media (max-width: 1200px) {
            .dashboard {
                grid-template-columns: 1fr;
                min-height: auto;
                gap: 14px;
                padding: 14px;
            }

            .sidebar-info,
            .item-panel,
            .map-area {
                border-radius: 16px;
            }

            .map-area {
                padding: 6px;
            }

            .item-panel {
                display: grid;
                grid-template-columns: repeat(5, minmax(90px, 1fr));
                gap: 10px;
                align-items: start;
                justify-items: center;
                overflow: visible;
            }

            .panel-label {
                grid-column: 1 / -1;
                margin-bottom: 4px;
            }

            .draggable {
                width: 90px;
                height: 90px;
                border-radius: 14px;
                padding: 8px;
            }

            #successBox {
                inset: 50% auto auto 50%;
                transform: translate(-50%, -50%);
                width: min(92vw, 760px);
                max-height: 85vh;
                overflow: auto;
                padding: 22px 18px;
                border-radius: 20px;
            }

            #successBox h2 {
                font-size: clamp(1.4rem, 5vw, 2rem) !important;
            }

            #successBox p {
                font-size: clamp(0.9rem, 3.4vw, 1.1rem) !important;
                line-height: 1.45;
            }

            #successBox .btn {
                width: 100%;
                font-size: 0.95rem;
                padding: 10px 14px;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 10px;
                gap: 10px;
            }

            h1 {
                font-size: 1.08rem;
            }

            .sidebar-info {
                padding: 14px;
                gap: 10px;
            }

            .guiding-box {
                padding: 12px;
                border-left-width: 4px;
            }

            .guiding-box p {
                font-size: 0.95rem;
            }

            .item-panel {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                padding: 12px;
            }

            .panel-label {
                font-size: 0.8rem;
                line-height: 1.35;
            }

            .map-area {
                padding: 4px;
            }

            .bg-img {
                border-radius: 12px;
            }

            .dropzone {
                border-width: 2px;
                border-radius: 10px;
            }
        }

        @media (max-width: 480px) {
            .item-panel {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .draggable {
                width: 78px;
                height: 78px;
                padding: 6px;
            }

            .dropzone {
                border-width: 1.5px;
            }

            #successBox {
                width: 94vw;
                padding: 14px 12px;
                border-width: 2px;
            }
        }

        @media (max-height: 520px) and (orientation: landscape) {
            .dashboard {
                grid-template-columns: 1fr 1fr;
            }

            .sidebar-info {
                grid-column: 1 / 3;
            }

            .item-panel {
                grid-template-columns: repeat(5, minmax(0, 1fr));
                align-content: start;
            }

            .map-area {
                min-height: 280px;
            }
        }
    </style>
</head>
<body>

<div class="dashboard">
    <div class="sidebar-info">
        <h1>B. El Niño at La Niña</h1>
        
        <div class="guiding-box">
            <strong>Gabay na Tanong:</strong>
            <p>Paano nagkakaiba ang paghahanda sa tagtuyot at pagbaha?</p>
        </div>

        <div class="video-card">
            <iframe src="https://www.youtube.com/embed/yurhT4mPips" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="video-card">
            <iframe src="https://www.youtube.com/embed/G4svwU0twEw" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <div class="item-panel">
        <span class="panel-label">
Ano ang mga nararapat na gawin sa panahon ng El Niño at La Niña?
Ilagay ang mga salita na magbibigay ng  tamang gabay sa ganitong pangyayari. 
</span>
        <img src="/pictures/Module 3/tagtuyot1.png" class="draggable" draggable="true" data-id="tagtuyot1">
        <img src="/pictures/Module 3/tipid.png" class="draggable" draggable="true" data-id="tipid">
        <img src="/pictures/Module 3/baha1.png" class="draggable" draggable="true" data-id="baha1">
        <img src="/pictures/Module 3/daluyan.png" class="draggable" draggable="true" data-id="daluyan">
        <img src="/pictures/Module 3/malinis.png" class="draggable" draggable="true" data-id="malinis">
    </div>

    <div class="map-area">
        <div class="map-wrapper">
            <img src="/pictures/Module 3/elnino_bg.png" class="bg-img">
            <div class="dropzone" id="zone1"></div>
            <div class="dropzone" id="zone2"></div>
            <div class="dropzone" id="zone3"></div>
            <div class="dropzone" id="zone4"></div>
            <div class="dropzone" id="zone5"></div>
        </div>

        <div id="successBox">
            <h2 class="fw-bold" style="font-size: 2.5rem;">🌟 Mahusay!</h2>
            <p class="fs-4">
                Mahusay! Ipinapakita ng larawan ang epekto ng El Niño (tagtuyot) at La Niña (pagbaha) at ang mga paraan ng paghahanda tulad ng pagtitipid ng tubig, paglilinis ng daluyan, at pangangalaga sa kapaligiran upang mabawasan ang pinsala.
            </p>
            <a href="{{ route('lindol.activity') }}" class="btn btn-light btn-lg fw-bold px-5 mt-3">
                Susunod na Aralin
            </a>
        </div>
    </div>
</div>

<script>
    let dragged = null;
    const correct = { zone1:"tagtuyot1", zone2:"baha1", zone3:"tipid", zone4:"daluyan", zone5:"malinis" };
    let score = {};

    document.querySelectorAll('.draggable').forEach(img => {
        img.addEventListener('dragstart', (e) => { 
            dragged = e.target; 
            e.target.style.opacity = "0.5";
        });
        img.addEventListener('dragend', (e) => { 
            e.target.style.opacity = "1";
        });
    });

    document.querySelectorAll('.dropzone').forEach(zone => {
        zone.addEventListener('dragover', (e) => { 
            e.preventDefault(); 
            zone.classList.add('active'); 
        });
        zone.addEventListener('dragleave', () => zone.classList.remove('active'));
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('active');
            if(dragged) {
                zone.innerHTML = "";
                const clone = dragged.cloneNode(true);
                clone.style.width = "90%"; clone.style.height = "90%";
                zone.appendChild(clone);
                score[zone.id] = dragged.dataset.id;
                checkWin();
            }
        });
    });

    function checkWin() {
        let count = 0;
        for(let z in correct) { if(score[z] === correct[z]) count++; }
        if(count === 5) document.getElementById('successBox').style.display = 'block';

        // 🔥 SAVE TO DATABASE
        fetch("{{ route('student.module3.elnino.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                score: count,
                zone1: score.zone1 || null,
                zone2: score.zone2 || null,
                zone3: score.zone3 || null,
                zone4: score.zone4 || null,
                zone5: score.zone5 || null
            })
        });
    }
</script>

</body>
</html>