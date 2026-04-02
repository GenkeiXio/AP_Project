<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Final Activity Intro</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&family=Baloo+2:wght@700&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Nunito',sans-serif;
    background:linear-gradient(180deg,#eefaf1,#fff4d9);
}

.page{
    max-width:900px;
    margin:auto;
    padding:20px;
}

.card{
    background:rgba(255,255,255,0.9);
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

h1{
    text-align:center;
    font-family:'Baloo 2';
    color:#214f33;
}

.section-title{
    font-weight:bold;
    margin-top:15px;
}

.btn{
    display:block;
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#5eae4e;
    color:white;
    font-weight:bold;
    font-size:16px;
    margin-top:20px;
    cursor:pointer;
    transition:0.2s;
}

.btn:hover{
    background:#4a983c;
}

.back-button {
    position: fixed;
    top: 80px;
    left: 20px;
    z-index: 100;
    background: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="page">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="card">

<h1>🎮 Environmental Decision Game</h1>

<p><strong>Title:</strong> <b>Ikaw ang Tagapamahala ng Sakuna</b></p>

<p class="section-title">📘 Paglalarawan (Description):</p>
<p>
Ang gawaing ito ay tumutulong sa iyo na malinang ang iyong pag-iisip at kakayahan sa pagpapasya
tungkol sa mga suliraning pangkapaligiran. Sa pamamagitan ng mga sitwasyong hango sa karanasan sa Albay,
matututuhan mong tukuyin ang sanhi ng problema at pumili ng tamang hakbang upang makatulong sa kalikasan at komunidad.
</p>

<p class="section-title">📌 Mga Tagubilin (Instructions):</p>
<p>
Basahin at suriin ang bawat sitwasyon at larawan. Piliin ang <b>LAHAT</b> ng tamang sagot na
makatutulong sa paglutas ng suliranin.
</p>

<button class="btn" onclick="startGame()">
🚀 Simulan ang Final Activity
</button>

</div>

</div>

<script>
function startGame(){
    window.location.href = "{{ route('module2.activity') }}";
}
</script>

</body>
</html>