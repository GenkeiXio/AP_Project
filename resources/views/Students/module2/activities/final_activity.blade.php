@extends('Students.studentslayout')

@section('title', 'Module 2 Final Activity')

@push('styles')
<style>
body {
    background: linear-gradient(180deg, #eefaf1, #fff4d9);
    font-family: 'Nunito', sans-serif;
}

.activity-container {
    max-width: 900px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    text-align: center;
}

.title {
    font-family: 'Baloo 2';
    font-size: 2rem;
    color: #1b5e20;
    margin-bottom: 10px;
}

.desc {
    color: #555;
    margin-bottom: 20px;
}

.btn-start {
    padding: 12px 20px;
    background: #2e7d32;
    color: white;
    border-radius: 12px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-start:hover {
    background: #1b5e20;
}
</style>
@endpush

@section('content')

<div class="activity-container">

    <div class="title">🔑 Final Activity</div>

    <p class="desc">
        Binabati kita! Nakumpleto mo ang lahat ng bahagi ng Module 2. 🎉 <br><br>
        Subukan ang panghuling hamon upang masubok ang iyong natutunan.
    </p>

    <button class="btn-start" onclick="startActivity()">
        Simulan ang Hamon 🚀
    </button>

    <div id="game-area" style="margin-top:30px;"></div>

</div>

<script>
function startActivity(){
    document.getElementById("game-area").innerHTML = `
        <h3>🌱 Tanong:</h3>
        <p>Ano ang pinakamahalagang paraan upang maiwasan ang sakuna?</p>

        <button onclick="checkAnswer(true)">Paghahanda at pakikiisa</button><br><br>
        <button onclick="checkAnswer(false)">Pagwawalang bahala</button>
    `;
}

function checkAnswer(correct){
    if(correct){
        alert("🎉 Tama! Mahusay!");
    } else {
        alert("❌ Mali. Subukan muli!");
    }
}
</script>

@endsection