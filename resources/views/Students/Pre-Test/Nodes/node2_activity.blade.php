<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Node 2 Activity</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<style>
body {
    margin:0;
    font-family:'Nunito',sans-serif;
    background:linear-gradient(180deg,#eefaf1,#fff4d9);
    padding:20px;
}

.page { max-width:1200px; margin:auto; }

.zone {
    border:2px dashed #8fbf7a;
    padding:20px;
    border-radius:16px;
    min-height:120px;
    margin-bottom:15px;
    background:#f9fff6;
}

.bank {
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.card {
    padding:10px;
    border-radius:10px;
    background:#fff;
    border:1px solid #ccc;
    cursor:grab;
}

.btn {
    padding:10px 16px;
    border:none;
    border-radius:10px;
    background:#5eae4e;
    color:white;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="page">

<h2>🌳 Node 2: Sanhi • Bunga • Solusyon</h2>

<div class="zone" data-zone="cause">Sanhi</div>
<div class="zone" data-zone="effect">Bunga</div>
<div class="zone" data-zone="solution">Solusyon</div>

<h3>Cards</h3>

<div class="bank" id="bank">

<div class="card" draggable="true" data-zone="cause">
Illegal logging at paglaki ng populasyon
</div>

<div class="card" draggable="true" data-zone="effect">
Pagbaha at pagguho ng lupa
</div>

<div class="card" draggable="true" data-zone="solution">
Pagtatanim ng puno at pangangalaga sa kagubatan
</div>

</div>

<br>

<button class="btn" onclick="check()">Suriin</button>

<p id="result"></p>

</div>

<script>
let dragged;

document.querySelectorAll('.card').forEach(card=>{
    card.addEventListener('dragstart',()=>dragged=card);
});

document.querySelectorAll('.zone').forEach(zone=>{
    zone.addEventListener('dragover',e=>e.preventDefault());
    zone.addEventListener('drop',()=>zone.appendChild(dragged));
});

function check(){
    let correct = true;

    document.querySelectorAll('.zone').forEach(zone=>{
        let card = zone.querySelector('.card');
        if(!card || card.dataset.zone !== zone.dataset.zone){
            correct = false;
        }
    });

    if(correct){
        document.getElementById('result').innerText = "✅ Tama!";
        
        // 🔥 unlock next node
        sessionStorage.setItem("node2_done", "true");

        // 🔁 back to map
        setTimeout(()=>{
            window.location.href = "{{ route('inner.map2') }}";
        },1000);

    } else {
        document.getElementById('result').innerText = "❌ Subukan muli.";
    }
}
</script>

</body>
</html>