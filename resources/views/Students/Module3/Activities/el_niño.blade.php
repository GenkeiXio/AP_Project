<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>El Niño at La Niña Activity</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
        }

        /* Draggable area */
        .draggable-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 25px 0;
            padding: 15px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .draggable {
            cursor: grab;
            width: 130px;
            transition: transform 0.2s ease;
        }

        .draggable:hover {
            transform: scale(1.1);
        }

        /* Activity image */
        .activity-container {
            position: relative;
            width: 100%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .bg-image {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        /* Drop zones */
        .dropzone {
            position: absolute;
            border: 2px dashed rgba(255,255,255,0.7);
            border-radius: 12px;

            display: flex;
            justify-content: center;
            align-items: center;

            transition: 0.3s;
        }

        .dropzone:hover {
            background: rgba(255,255,255,0.15);
        }

        /* Positions (same as yours) */
        #zone1 { top: 8%; left: 2%; width: 22%; height: 18%; }
        #zone2 { top: 8%; left: 55%; width: 22%; height: 18%; }
        #zone3 { bottom: 6%; left: 3%; width: 22%; height: 16%; }
        #zone4 { bottom: 6%; left: 38%; width: 22%; height: 16%; }
        #zone5 { bottom: 6%; right: 3%; width: 22%; height: 16%; }

        /* Feedback */
        #feedback {
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
            font-size: 16px;
        }

        /* Header */
        .header-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .guide-question {
            font-size: 16px;
            color: #444;
            margin-top: 10px;
        }

        /* Video layout */
        .video-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .video-card {
            background: white;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .video-card iframe {
            width: 100%;
            height: 220px;
            border-radius: 10px;
        }

        .video-label {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <div class="header-section">

        <h2 class="fw-bold">B. Mga Dapat Gawin sa Panahon ng El Niño at La Niña</h2>

        <p class="guide-question">
            <strong>Guiding Question:</strong><br>
            Paano nagkakaiba ang paghahanda sa tagtuyot at pagbaha?
        </p>

    </div>

    <!-- Videos -->
    <div class="video-section">

        <div class="video-card">
            <iframe src="https://www.youtube.com/embed/yurhT4mPips"
                allowfullscreen></iframe>
            <p class="video-label">El Niño (Tagtuyot)</p>
        </div>

        <div class="video-card">
            <iframe src="https://www.youtube.com/embed/G4svwU0twEw"
                allowfullscreen></iframe>
            <p class="video-label">La Niña (Baha)</p>
        </div>

    </div>

    <h4>
        Ano ang mga nararapat na gawin sa panahon ng <strong>El Niño at La Niña</strong>?
    </h4>
    <p>I-drag ang mga salita papunta sa tamang kahon.</p>

    <div class="draggable-container">

    <img src="/pictures/Module 3/tagtuyot1.png" class="draggable" draggable="true" data-name="tagtuyot1">
    <img src="/pictures/Module 3/tipid.png" class="draggable" draggable="true" data-name="tipid">
    <img src="/pictures/Module 3/baha1.png" class="draggable" draggable="true" data-name="baha1">
    <img src="/pictures/Module 3/daluyan.png" class="draggable" draggable="true" data-name="daluyan">
    <img src="/pictures/Module 3/malinis.png" class="draggable" draggable="true" data-name="malinis">

</div>

    <div class="activity-container mt-4">

        <!-- Background Image -->
        <img src="/pictures/Module 3/elnino_bg.png" class="bg-image">

        <!-- Invisible Drop Zones -->
        <div class="dropzone" id="zone1"></div>
        <div class="dropzone" id="zone2"></div>
        <div class="dropzone" id="zone3"></div>
        <div class="dropzone" id="zone4"></div>
        <div class="dropzone" id="zone5"></div>

    </div>

    <!-- Feedback -->
    <div id="feedback" class="alert alert-success mt-4 d-none">
        <strong>Mahusay!</strong> Ipinapakita ng larawan ang epekto ng El Niño (tagtuyot)
        at La Niña (pagbaha) at ang mga paraan ng paghahanda tulad ng pagtitipid ng tubig,
        paglilinis ng daluyan, at pangangalaga sa kapaligiran upang mabawasan ang pinsala.
    </div>

</div>

<script>
    let draggedItem = null;

    const draggables = document.querySelectorAll('.draggable');
    const dropzones = document.querySelectorAll('.dropzone');

    let answers = {
        zone1: ["tagtuyot1"],
        zone2: ["baha1"],

        zone3: ["tipid"],
        zone4: ["daluyan"],
        zone5: ["malinis"]
    };

    let placed = {};

    // Drag start
    draggables.forEach(item => {
        item.addEventListener('dragstart', () => {
            draggedItem = item;
        });
    });

    // AUTO SCROLL WHEN DRAGGING
    document.addEventListener('dragover', function(e) {
        const scrollSpeed = 15;
        const threshold = 100;

        const y = e.clientY;
        const height = window.innerHeight;

        // Scroll down
        if (y > height - threshold) {
            window.scrollBy(0, scrollSpeed);
        }

        // Scroll up
        if (y < threshold) {
            window.scrollBy(0, -scrollSpeed);
        }
    });

    // Drop logic
    dropzones.forEach(zone => {
        placed[zone.id] = [];

        zone.addEventListener('dragover', e => e.preventDefault());

        zone.addEventListener('drop', e => {
            e.preventDefault();

            if (!draggedItem) return;

            let clone = draggedItem.cloneNode(true);
            clone.style.width = "85%";   // fills most of the zone
            clone.style.height = "auto";
            clone.style.pointerEvents = "none"; // prevents re-drag issues // 👈 bigger drop size

            zone.innerHTML = "";
            zone.appendChild(clone);

            let name = draggedItem.dataset.name;
            placed[zone.id].push(name);

            checkAnswers();
        });
    });

    function checkAnswers() {
        let correct = true;

        for (let key in answers) {
            answers[key].forEach(ans => {
                if (!placed[key].includes(ans)) {
                    correct = false;
                }
            });
        }

        if (correct) {
            document.getElementById('feedback').classList.remove('d-none');
        }
    }
</script>

</body>
</html>