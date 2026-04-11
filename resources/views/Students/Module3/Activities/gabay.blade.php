<!DOCTYPE html>
<html lang="tl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gabay sa Kaligtasan: Araling Panlipunan Activity</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Lora:ital,wght@0,400;0,700;1,400&display=swap');

    :root {
        --papel: #f4e4bc;
        --kahoy: #5d4037;
        --asul: #0038a8;
        --pula: #ce1126;
        --ginto: #fcd116;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0; padding: 0;
        height: 100vh; overflow: hidden;
        font-family: 'Lora', serif;
        background-color: #2c1e1a;
        background-image: url('https://www.transparenttextures.com/patterns/dark-leather.png');
        display: flex; flex-direction: column; align-items: center;
    }

    /* HEADER */
    .ap-header {
        width: 100%; background: var(--kahoy);
        padding: 15px 0; text-align: center;
        border-bottom: 5px solid var(--ginto);
        box-shadow: 0 5px 15px rgba(0,0,0,0.5); z-index: 10;
    }

    .ap-header h1 {
        font-family: 'Cinzel', serif; color: var(--ginto);
        margin: 0; font-size: 28px; letter-spacing: 2px;
        text-shadow: 2px 2px 0px black;
    }

    /* GAME GRID */
    .map-container {
        flex: 1; width: 98%; max-width: 1400px;
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 15px; padding: 15px; margin-bottom: 240px;
    }

    .scroll-box {
        background: var(--papel);
        background-image: url('https://www.transparenttextures.com/patterns/old-map.png');
        border: 12px solid transparent;
        border-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png') 30 stretch;
        display: flex; flex-direction: column;
        box-shadow: 10px 10px 20px rgba(0,0,0,0.6);
    }

    .scroll-title {
        background: var(--kahoy); color: var(--papel);
        padding: 10px; text-align: center; font-weight: bold;
        font-size: 16px; border-bottom: 2px solid var(--ginto);
        font-family: 'Cinzel', serif;
    }

    .drop-zone {
        flex: 1; padding: 10px;
        display: grid; grid-template-columns: repeat(auto-fill, minmax(115px, 1fr));
        gap: 12px; justify-content: center; align-content: flex-start;
    }

    /* INVENTORY - BIG CARDS */
    .inventory-shelf {
        position: fixed; bottom: 15px;
        width: 95%; height: 210px;
        background: rgba(0,0,0,0.85);
        border: 3px solid var(--ginto); border-radius: 15px;
        display: flex; align-items: center; gap: 20px;
        padding: 0 30px; overflow-x: auto; z-index: 100;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.7);
    }

    .larawan-card {
        min-width: 180px; height: 180px;
        background: white; border: 5px solid white;
        cursor: grab; transition: 0.3s;
        object-fit: contain;
        box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    }

    .larawan-card:hover {
        transform: scale(1.1) translateY(-10px);
        z-index: 105; border-color: var(--ginto);
    }

    /* PLACED IMAGES */
    .placed-img {
        width: 110px; height: 110px;
        object-fit: contain; background: white;
        border: 4px solid white; border-radius: 5px;
        animation: sealPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes sealPop {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .tama { border-color: var(--asul); }
    .mali { border-color: var(--pula); }

    /* MODAL STYLES */
    .overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.9); backdrop-filter: blur(8px);
        display: flex; justify-content: center; align-items: center; z-index: 2000;
    }

    .document-card {
        background: var(--papel); background-image: url('https://www.transparenttextures.com/patterns/old-map.png');
        padding: 40px; border: 15px double var(--kahoy);
        width: 90%; max-width: 550px; text-align: center; color: var(--kahoy);
        box-shadow: 0 0 50px rgba(0,0,0,0.8);
    }

    .score-circle {
        width: 130px; height: 130px; border: 6px solid var(--kahoy);
        border-radius: 50%; margin: 20px auto;
        display: flex; flex-direction: column; justify-content: center; align-items: center;
        background: rgba(255,255,255,0.4);
    }

    .btn-custom {
        background: var(--kahoy); color: var(--ginto);
        border: none; padding: 15px 35px;
        font-family: 'Cinzel', serif; font-size: 18px;
        cursor: pointer; transition: 0.3s; margin-top: 15px;
    }

    .btn-custom:hover { background: #3e2723; transform: scale(1.05); }

    .inventory-shelf::-webkit-scrollbar { height: 8px; }
    .inventory-shelf::-webkit-scrollbar-thumb { background: var(--ginto); border-radius: 10px; }
</style>
</head>
<body>

    <div id="startOverlay" class="overlay">
        <div class="document-card">
            <h2 style="font-family:'Cinzel';">Sertipikasyon ng Kahandaan</h2>
            <hr style="border: 1px solid var(--kahoy); margin: 20px 0;">
            <p style="font-size: 20px;">
                I-drag ang mga malalaking larawan sa tamang hanay. Tapusin ang pagsusulit upang makapunta sa susunod na aralin.
            </p>
            <button class="btn-custom" onclick="magsimula()">TANGGAPIN ANG HAMON</button>
        </div>
    </div>

    <div id="resultOverlay" class="overlay" style="display:none;">
        <div class="document-card">
            <h2 style="font-family:'Cinzel'; text-decoration: underline;">RESULTA NG PAGSUSULIT</h2>
            <div class="score-circle">
                <p style="font-size:45px; font-weight:900; margin:0;" id="finalScore">0</p>
                <p style="font-size:12px; margin:0;">PUNTOS</p>
            </div>
            <div id="rankText" style="font-size: 24px; font-weight: bold; color: var(--kahoy); margin: 10px 0;">TAPOS NA!</div>
            <p id="feedbackMessage">Naitala na ang iyong puntos sa gawaing ito.</p>
            
            <button class="btn-custom" onclick="window.location.href = '{{ route('el-nino.activity') }}'">
                MAGPATULOY SA EL NIÑO
            </button>
        </div>
    </div>

    <div class="ap-header">
        <h1>GABAY SA PANAHON NG BAGYO</h1>
    </div>

    <div class="map-container">
        <div class="scroll-box" data-yugto="bago">
            <div class="scroll-title">I. BAGO ANG BAGYO</div>
            <div class="drop-zone"></div>
        </div>
        <div class="scroll-box" data-yugto="habang">
            <div class="scroll-title">II. HABANG MAY BAGYO</div>
            <div class="drop-zone"></div>
        </div>
        <div class="scroll-box" data-yugto="tapos">
            <div class="scroll-title">III. PAGKATAPOS NG BAGYO</div>
            <div class="drop-zone"></div>
        </div>
    </div>

    <div class="inventory-shelf" id="shelf">
        <img src="{{ asset('pictures/Module 3/Gabay/before1.jpg') }}" class="larawan-card" draggable="true" data-target="bago">
        <img src="{{ asset('pictures/Module 3/Gabay/before2.jpg') }}" class="larawan-card" draggable="true" data-target="bago">
        <img src="{{ asset('pictures/Module 3/Gabay/before3.jpg') }}" class="larawan-card" draggable="true" data-target="bago">
        <img src="{{ asset('pictures/Module 3/Gabay/before4.jpg') }}" class="larawan-card" draggable="true" data-target="bago">

        <img src="{{ asset('pictures/Module 3/Gabay/during1.jpg') }}" class="larawan-card" draggable="true" data-target="habang">
        <img src="{{ asset('pictures/Module 3/Gabay/during2.jpg') }}" class="larawan-card" draggable="true" data-target="habang">
        <img src="{{ asset('pictures/Module 3/Gabay/during3.jpg') }}" class="larawan-card" draggable="true" data-target="habang">
        <img src="{{ asset('pictures/Module 3/Gabay/during4.jpg') }}" class="larawan-card" draggable="true" data-target="habang">

        <img src="{{ asset('pictures/Module 3/Gabay/after1.jpg') }}" class="larawan-card" draggable="true" data-target="tapos">
        <img src="{{ asset('pictures/Module 3/Gabay/after2.png') }}" class="larawan-card" draggable="true" data-target="tapos">
        <img src="{{ asset('pictures/Module 3/Gabay/after3.jpg') }}" class="larawan-card" draggable="true" data-target="tapos">
        <img src="{{ asset('pictures/Module 3/Gabay/after4.jpg') }}" class="larawan-card" draggable="true" data-target="tapos">
    </div>

    <script>
        let draggedImg = null;
        let score = 0;
        let droppedCount = 0;

        function magsimula() {
            document.getElementById('startOverlay').style.display = 'none';
            shuffleShelf();
        }

        function shuffleShelf() {
            const shelf = document.getElementById('shelf');
            for (let i = shelf.children.length; i >= 0; i--) {
                shelf.appendChild(shelf.children[Math.random() * i | 0]);
            }
        }

        document.querySelectorAll('.larawan-card').forEach(card => {
            card.addEventListener('dragstart', (e) => {
                draggedImg = e.target;
                e.target.style.opacity = "0.4";
            });
            card.addEventListener('dragend', (e) => {
                e.target.style.opacity = "1";
            });
        });

        document.querySelectorAll('.scroll-box').forEach(box => {
            box.addEventListener('dragover', e => e.preventDefault());
            box.addEventListener('drop', () => {
                if (!draggedImg) return;

                const zone = box.dataset.yugto;
                const correct = draggedImg.dataset.target;
                
                const mini = document.createElement('img');
                mini.src = draggedImg.src;
                mini.className = 'placed-img ' + (zone === correct ? 'tama' : 'mali');

                if (zone === correct) score++;

                box.querySelector('.drop-zone').appendChild(mini);
                draggedImg.remove();
                draggedImg = null;
                droppedCount++;

                // Kapag nalagay na lahat ng 12 images
                if (droppedCount === 12) ipakitaResulta();
            });
        });

        function ipakitaResulta() {
            const resOverlay = document.getElementById('resultOverlay');
            document.getElementById('finalScore').innerText = score;
            resOverlay.style.display = 'flex';
            
            // Optional: Iba-ibang message base sa score pero isa lang ang button
            const msg = document.getElementById('feedbackMessage');
            if (score >= 9) {
                msg.innerText = "Napakahusay! Matagumpay mong natapos ang hamon.";
            } else {
                msg.innerText = "Naitala na ang iyong puntos. Maaari nang tumuloy sa susunod na aralin.";
            }

            // 🔥 COLLECT DATA
            let placements = [];

            document.querySelectorAll('.scroll-box').forEach(box => {
                const yugto = box.dataset.yugto;

                box.querySelectorAll('.placed-img').forEach(img => {
                    placements.push({
                        image: img.src,
                        placed_in: yugto,
                        is_correct: img.classList.contains('tama')
                    });
                });
            });

            // 🔥 SAVE TO DATABASE
            fetch("{{ route('student.module3.gabay.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    score: score,
                    placements: placements
                })
            });
        }
    </script>
</body>
</html>