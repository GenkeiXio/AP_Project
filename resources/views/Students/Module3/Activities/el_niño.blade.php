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
            height: 100vh;
            margin: 0;
            overflow: hidden; 
        }

        .dashboard {
            display: grid;
            grid-template-columns: 350px 220px 1fr; /* Pinalapad ang column para sa items */
            height: 100vh;
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
        .video-card iframe { width: 100%; height: 150px; display: block; }

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
            body { overflow-y: auto; height: auto; }
            .dashboard { grid-template-columns: 1fr; }
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
            <p class="fs-4">Mahusay! Ipinapakita ng larawan ang epekto ng El Niño (tagtuyot) at La Niña (pagbaha) at ang mga paraan ng paghahanda tulad ng pagtitipid ng tubig, paglilinis ng daluyan, at pangangalaga sa kapaligiran upang mabawasan ang pinsala.

</p>
            <a href="{{ route('bulkan.activity') }}" class="btn btn-light btn-lg fw-bold px-5 mt-3">Susunod na Aralin</a>
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
    }
</script>

</body>
</html>