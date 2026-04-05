@extends('Students.studentslayout')
@section('title', 'Module 3 - Node 3')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #dff3e3, #ffe9b5);
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.title {
    font-size: 28px;
    font-weight: 800;
    text-align: center;
}

.subtitle {
    text-align: center;
    margin-bottom: 20px;
    color: #555;
}

/* GAME AREA */
.zones {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin: 25px 0;
}

.drop-zone {
    border: 2px dashed #bbb;
    padding: 20px;
    border-radius: 15px;
    min-height: 120px;
    background: #f9f9f9;
    transition: 0.3s;
}

.drop-zone:hover {
    background: #eef5ff;
}

/* ITEMS */
.items {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.drag-item {
    padding: 10px 15px;
    background: #3498db;
    color: white;
    border-radius: 10px;
    cursor: grab;
    margin: 5px;
    font-weight: 600;
}

/* RESULT */
.result {
    margin-top: 20px;
    padding: 15px;
    border-radius: 12px;
    display: none;
}

.correct {
    background: #ecfff3;
    border: 2px solid #2ecc71;
}

.wrong {
    background: #fff2f2;
    border: 2px solid #e74c3c;
}
</style>

<div class="wrapper">
<div class="card">

<div class="title">🟧 CBDRRM → BUILD YOUR COMMUNITY</div>

<div class="subtitle">
Guiding Question:<br>
Paano nakatutulong ang pakikilahok ng komunidad sa pagbawas ng panganib?
</div>

<div style="text-align:center; margin-bottom:15px;">
👉 I-drag ang tamang elemento sa tamang bahagi ng komunidad
</div>

<!-- DROP ZONES -->
<div class="zones">
    <div class="drop-zone" data-correct="early">📢 Early Warning</div>
    <div class="drop-zone" data-correct="trained">🧑‍🚒 Training</div>
    <div class="drop-zone" data-correct="evacuation">🏫 Evacuation</div>
    <div class="drop-zone" data-correct="cooperation">🤝 Cooperation</div>
</div>

<!-- ITEMS -->
<div class="items">
    <div class="drag-item" draggable="true" data-type="early">Early Warning System</div>
    <div class="drag-item" draggable="true" data-type="trained">Trained Citizens</div>
    <div class="drag-item" draggable="true" data-type="evacuation">Evacuation Plan</div>
    <div class="drag-item" draggable="true" data-type="cooperation">Cooperation</div>
</div>

<!-- RESULT -->
<div id="resultBox" class="result"></div>

</div>
</div>

<script>
let draggedItem = null;
let correctCount = 0;

document.querySelectorAll('.drag-item').forEach(item => {
    item.addEventListener('dragstart', function () {
        draggedItem = this;
    });
});

document.querySelectorAll('.drop-zone').forEach(zone => {

    zone.addEventListener('dragover', function (e) {
        e.preventDefault();
    });

    zone.addEventListener('drop', function () {
        if (!draggedItem) return;

        let correct = this.getAttribute('data-correct');
        let type = draggedItem.getAttribute('data-type');

        const resultBox = document.getElementById('resultBox');
        resultBox.style.display = 'block';

        if (correct === type) {
            this.appendChild(draggedItem);
            draggedItem.style.background = "#2ecc71";
            draggedItem.setAttribute("draggable", "false");
            correctCount++;

            resultBox.className = "result correct";
            resultBox.innerHTML = "👍 ✅ Matatag ang iyong komunidad! Mababa ang risk!";

            if (correctCount === 4) {
                resultBox.innerHTML = "🎉 COMPLETE! Ligtas ang buong komunidad!";
            }

        } else {
            resultBox.className = "result wrong";
            resultBox.innerHTML = "👎 ⚠️ Mahina ang preparedness! Mataas ang panganib!";
        }
    });
});
</script>

@endsection