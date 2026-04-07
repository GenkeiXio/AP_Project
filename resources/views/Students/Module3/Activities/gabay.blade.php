<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Gabay</title>

<style>
    /* FULLSCREEN BACKGROUND */
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;

        background: url("{{ asset('pictures/Module 3/Gabay/gabay_bg.png') }}") no-repeat center center;
        background-size: cover;

        font-family: Arial, sans-serif;
    }

    /* GRAY OVERLAY */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        background: rgba(0, 0, 0, 0.25); /* 🔥 adjust darkness here */

        z-index: 0;
    }

    /* CENTER CONTENT */
    .main-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    /* GLASS CARD */
    .card {
        width: 90%;
        max-width: 800px;

        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 30px;

        text-align: center;

        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    /* TITLE */
    h1 {
        margin-bottom: 10px;
    }

    /* TEXT */
    p {
        font-size: 18px;
        line-height: 1.6;
    }

    /* BUTTON */
    .btn {
        margin-top: 20px;
        padding: 12px 25px;
        border: none;
        background: #0d6efd;
        color: white;
        border-radius: 12px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.2s;
    }

    .btn:hover {
        background: #0b5ed7;
        transform: scale(1.05);
    }

    /* TABLE POSITION (ALIGNED TO IMAGE BOXES) */
    .table-overlay {
        position: absolute;
        top: 30%;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    /* TABLE */
    .gabay-table {
        width: 70%;
        border-collapse: separate;
        border-spacing: 20px;
    }

    /* HEADERS */
    .gabay-table th {
        color: white;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
    }

    /* COLOR CODING */
    .before {
        background: #f57c00; /* orange */
    }

    .during {
        background: #1565c0; /* blue */
    }

    .after {
        background: #2e7d32; /* green */
    }

    /* CELLS */
    .gabay-table td {
        background: rgba(255,255,255,0.9);
        border-radius: 10px;
        padding: 10px;
        font-size: 14px;
        text-align: left;
        vertical-align: top;

        height: 120px; /* matches box height */
    }

    /* ITEMS */
    .items {
        position: absolute;
        bottom: 15px;
        width: 100%;

        display: flex;
        justify-content: flex-start;
        gap: 30px;

        overflow-x: auto;
        padding: 20px 60px;

        z-index: 2;
    }

    .item {
        width: 220px;   /* 🔥 BIG */
        height: 180px;

        object-fit: contain; /* no crop */
        background: white;

        border-radius: 18px;
        padding: 12px;

        cursor: grab;
        transition: 0.25s;

        box-shadow: 0 10px 20px rgba(0,0,0,0.35);
    }

    /* HOVER EFFECT */
    .item:hover {
        transform: scale(1.2);
        z-index: 5;
    }

    /* DRAG STATE */
    .item.dragging {
        opacity: 0.5;
        transform: scale(1.1);
    }

    .items::-webkit-scrollbar {
        height: 8px;
    }

    .items::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.3);
        border-radius: 10px;
    }

    /* COLUMNS */
    .column-header {
        color: white;
        padding: 12px;
        font-weight: bold;
        text-align: center;
    }

    .columns {
        position: absolute;
        top: 16%;
        width: 80%;
        display: flex;
        gap: 25px;
        justify-content: center;
    }

    .column {
        flex: 1;
        height: 350px;
        border-radius: 20px;
        background: rgba(255,255,255,0.9);
        display: flex;
        flex-direction: column;
        overflow: hidden;

        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        transition: 0.3s;
    }

    .column h3 {
        color: white;
        padding: 8px;
        border-radius: 10px;
    }

    /* COLORS */
    .column.before .column-header { background: #f57c00; }
    .column.during .column-header { background: #1565c0; }
    .column.after .column-header { background: #2e7d32; }

    .column.before h3 { background: #f57c00; }
    .column.during h3 { background: #1565c0; }
    .column.after h3 { background: #2e7d32; }

    /* DROP EFFECT */
    .column.hovered {
        transform: scale(1.05);
        background: rgba(255,255,255,1);
    }

    /* DROP AREA */
    .drop-area {
        flex: 1;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
        gap: 8px;
    }

    /* DROPPED ITEMS */
    .dropped {
        width: 100px;
        height: 100px;
        object-fit: contain; /* ✅ FIXED */
        border-radius: 10px;
        background: white;
    }

    .correct {
        border: 3px solid green;
    }

    .wrong {
        border: 3px solid red;
    }

    /* HEADER TITLE */
    .header-title {
        position: absolute;
        top: 3%;
        width: 100%;
        text-align: center;

        font-size: 52px;
        font-weight: 900;

        background: linear-gradient(to bottom, #ff9800, #e65100);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        text-shadow:
            2px 2px 0 #fff,
            4px 4px 10px rgba(0,0,0,0.4);

        z-index: 2;
    }

    .finish-panel {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 30;
        background: rgba(255,255,255,0.95);
        border-radius: 14px;
        padding: 12px;
        box-shadow: 0 10px 24px rgba(0,0,0,0.25);
        display: none;
        min-width: 260px;
    }

    .finish-panel p {
        margin: 0 0 10px;
        font-size: 14px;
        text-align: left;
    }

    .finish-btn {
        width: 100%;
        border: none;
        border-radius: 10px;
        background: #1565c0;
        color: #fff;
        padding: 10px 12px;
        font-weight: 700;
        cursor: pointer;
    }
</style>

</head>
<body>
    <div class="main-container">

        <!-- INSTRUCTION MODAL -->
        <div id="instructionModal" style="
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;

            display: flex;
            justify-content: center;
            align-items: center;
        ">

            <div style="
                background: white;
                width: 90%;
                max-width: 600px;
                padding: 30px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 10px 40px rgba(0,0,0,0.4);
            ">
                <h2>📘 Panuto</h2>

                <p style="font-size:16px; line-height:1.6;">
                    Ayusin ang mga larawan sa tamang kategorya:
                    <br><br>
                    <b>Bago ang Bagyo</b>, <b>Habang may Bagyo</b>, at <b>Pagkatapos ng Bagyo</b>.
                    <br><br>
                    I-drag ang bawat larawan papunta sa tamang kahon.
                    <br><br>
                    ✔️ Kapag tama, magiging <span style="color:green;">berde</span><br>
                    ❌ Kapag mali, magiging <span style="color:red;">pula</span>
                </p>

                <button id="startBtn" class="btn">Simulan</button>
            </div>
        </div>

        <!-- HEADER TITLE -->
        <div class="header-title">
            Mga Gabay sa Panahon ng Bagyo
        </div>

        <!-- DROP ZONES -->
        <div class="columns">

            <div class="column before" data-zone="before">
                <div class="column-header">Bago ang Bagyo</div>
                <div class="drop-area"></div>
            </div>

            <div class="column during" data-zone="during">
                <div class="column-header">Habang may Bagyo</div>
                <div class="drop-area"></div>
            </div>

            <div class="column after" data-zone="after">
                <div class="column-header">Pagkatapos ng Bagyo</div>
                <div class="drop-area"></div>
            </div>

        </div>

        <!-- IMAGE ITEMS (BOTTOM INVENTORY STYLE) -->
        <div class="items">
            <img src="{{ asset('pictures\Module 3\Gabay\before1.jpg') }}" class="item" draggable="true" data-target="before">
            <img src="{{ asset('pictures\Module 3\Gabay\before2.jpg') }}" class="item" draggable="true" data-target="before">
            <img src="{{ asset('pictures\Module 3\Gabay\before3.jpg') }}" class="item" draggable="true" data-target="before">
            <img src="{{ asset('pictures\Module 3\Gabay\before4.jpg') }}" class="item" draggable="true" data-target="before">

            <img src="{{ asset('pictures\Module 3\Gabay\during1.jpg') }}" class="item" draggable="true" data-target="during">
            <img src="{{ asset('pictures\Module 3\Gabay\during2.jpg') }}" class="item" draggable="true" data-target="during">
            <img src="{{ asset('pictures\Module 3\Gabay\during3.jpg') }}" class="item" draggable="true" data-target="during">
            <img src="{{ asset('pictures\Module 3\Gabay\during4.jpg') }}" class="item" draggable="true" data-target="during">

            <img src="{{ asset('pictures\Module 3\Gabay\after1.jpg') }}" class="item" draggable="true" data-target="after">
            <img src="{{ asset('pictures\Module 3\Gabay\after2.png') }}" class="item" draggable="true" data-target="after">
            <img src="{{ asset('pictures\Module 3\Gabay\after3.jpg') }}" class="item" draggable="true" data-target="after">
            <img src="{{ asset('pictures\Module 3\Gabay\after4.jpg') }}" class="item" draggable="true" data-target="after">
        </div>

        <!-- IMAGE PREVIEW -->
        <div id="previewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:999; justify-content:center; align-items:center;">
            <img id="previewImg" style="max-width:90%; max-height:90%;">
        </div>

        <div id="finishPanel" class="finish-panel">
            <p id="finishText">Tapusin ang pag-aayos para magpatuloy.</p>
            <button id="finishBtn" class="finish-btn" type="button">➡ Magpatuloy sa Posttest</button>
        </div>
    </div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let draggedItem = null;
    let droppedCount = 0;
    let correctCount = 0;
    const totalItems = document.querySelectorAll('.item').length;

    /* =========================
       🔀 SHUFFLE ITEMS
    ========================= */
    function shuffleItems() {
        const container = document.querySelector('.items');
        const items = Array.from(container.children);

        for (let i = items.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [items[i], items[j]] = [items[j], items[i]];
        }

        items.forEach(item => container.appendChild(item));
    }

    shuffleItems();


    /* =========================
       🚫 DISABLE SCROLL BEFORE START
    ========================= */
    document.body.style.overflow = "hidden";


    /* =========================
       ▶️ START BUTTON (MODAL)
    ========================= */
    const startBtn = document.getElementById('startBtn');
    if (startBtn) {
        startBtn.addEventListener('click', function () {
            document.getElementById('instructionModal').style.display = 'none';
            document.body.style.overflow = "auto";
        });
    }


    /* =========================
       🖱 DRAG & DROP ITEMS
    ========================= */
    document.querySelectorAll('.item').forEach(item => {

        item.addEventListener('dragstart', () => {
            draggedItem = item;
            item.classList.add('dragging');
        });

        item.addEventListener('dragend', () => {
            item.classList.remove('dragging');
        });

        // CLICK TO ZOOM
        item.addEventListener('click', function () {
            document.getElementById('previewImg').src = this.src;
            document.getElementById('previewModal').style.display = 'flex';
        });

    });


    /* =========================
       📦 DROP ZONES
    ========================= */
    document.querySelectorAll('.column').forEach(column => {

        column.addEventListener('dragover', e => {
            e.preventDefault();
            column.classList.add('hovered');
        });

        column.addEventListener('dragleave', () => {
            column.classList.remove('hovered');
        });

        column.addEventListener('drop', () => {
            column.classList.remove('hovered');

            if (!draggedItem) return;

            let correctZone = draggedItem.dataset.target;
            let dropZone = column.dataset.zone;

            let newItem = draggedItem.cloneNode(true);
            newItem.classList.remove('item');
            newItem.classList.add('dropped');

            if (correctZone === dropZone) {
                newItem.classList.add('correct');
                correctCount++;
            } else {
                newItem.classList.add('wrong');
            }

            column.querySelector('.drop-area').appendChild(newItem);
            draggedItem.remove();
            droppedCount++;

            if (droppedCount >= totalItems) {
                const finishPanel = document.getElementById('finishPanel');
                const finishText = document.getElementById('finishText');
                const pass = correctCount >= Math.ceil(totalItems * 0.7);

                if (pass) {
                    finishText.textContent = `Magaling! Tama ang ${correctCount}/${totalItems}. Maaari ka nang mag-posttest.`;
                    sessionStorage.setItem('m3_activity_gabay_done', 'true');
                } else {
                    finishText.textContent = `Nakuha mo ang ${correctCount}/${totalItems}. Subukan muli para sa mas mataas na score, o magpatuloy kung handa ka na.`;
                }

                finishPanel.style.display = 'block';
            }
        });

    });

    const finishBtn = document.getElementById('finishBtn');
    if (finishBtn) {
        finishBtn.addEventListener('click', () => {
            window.location.href = "{{ route('module3.posttest') }}";
        });
    }


    /* =========================
       🔍 IMAGE PREVIEW MODAL
    ========================= */
    const previewModal = document.getElementById('previewModal');

    if (previewModal) {
        previewModal.addEventListener('click', function () {
            this.style.display = 'none';
        });
    }

});
</script>
</html>