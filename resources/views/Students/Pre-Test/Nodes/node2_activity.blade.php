<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Node 2 Activity</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; }

body {
    margin:0;
    font-family:'Nunito',sans-serif;
    background:linear-gradient(180deg,#eefaf1,#fff4d9);
    padding:20px;
}

.page {
    max-width:1100px;
    margin:auto;
}

h2 {
    font-family:'Baloo 2', cursive;
    color:#214f33;
    text-align:center;
}

.desc {
    text-align:center;
    color:#43624d;
    margin-bottom:20px;
}

/* ZONES */
.zone {
    border:2px dashed #8fbf7a;
    padding:20px;
    border-radius:16px;
    min-height:120px;
    margin-bottom:15px;
    background:#f9fff6;
    font-weight:bold;
}

/* CARDS */
.bank {
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    justify-content:center;
}

.card {
    padding:12px;
    border-radius:12px;
    background:#fff;
    border:1px solid #ccc;
    cursor:grab;
    font-weight:bold;
}

/* BUTTON */
.btn {
    padding:12px 18px;
    border:none;
    border-radius:12px;
    background:#5eae4e;
    color:white;
    font-weight:bold;
    display:block;
    margin:20px auto;
}
</style>
</head>

<body>

<div class="page">

<h2>🌳 Node 2: Kagubatan Quest</h2>
<p class="desc">Ayusin ang Sanhi → Bunga → Solusyon</p>

<div class="zone" data-zone="cause">🌟 Sanhi</div>
<div class="zone" data-zone="effect">🔥 Bunga</div>
<div class="zone" data-zone="solution">🌿 Solusyon</div>

<h3 style="text-align:center;">🃏 Cards</h3>

<div class="bank" id="bank">

<div class="card" draggable="true" data-zone="cause">
Illegal logging at pagkakalbo ng kagubatan
</div>

<div class="card" draggable="true" data-zone="effect">
Pagbaha at pagguho ng lupa
</div>

<div class="card" draggable="true" data-zone="solution">
Pagtatanim ng puno at pangangalaga sa kagubatan
</div>

</div>

<button class="btn" onclick="check()">✅ Suriin</button>

<p id="result" style="text-align:center;font-weight:bold;"></p>

</div>

<script>
let dragged;

// drag
document.querySelectorAll('.card').forEach(card=>{
    card.addEventListener('dragstart',()=>dragged=card);
});

// drop
document.querySelectorAll('.zone').forEach(zone=>{
    zone.addEventListener('dragover',e=>e.preventDefault());
    zone.addEventListener('drop',()=>zone.appendChild(dragged));
});

// check
function check(){
    let correct = true;

    document.querySelectorAll('.zone').forEach(zone=>{
        let card = zone.querySelector('.card');
        if(!card || card.dataset.zone !== zone.dataset.zone){
            correct = false;
        }
    });

    if(correct){
        document.getElementById('result').innerText = "🎉 Tama!";

        sessionStorage.setItem("node2_done", "true");

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