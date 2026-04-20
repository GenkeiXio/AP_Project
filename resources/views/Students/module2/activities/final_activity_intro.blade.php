@extends('Students.studentslayout')
@section('title', 'Module 2 : Final Activity Intro')

@push('styles')
<style>
    html, body {
        background: #060b16;
        background-image: 
            radial-gradient(circle at 8% 8%, rgba(0, 242, 255, 0.1), transparent 24%),
            radial-gradient(circle at 90% 14%, rgba(57, 255, 20, 0.08), transparent 20%),
            linear-gradient(rgba(160, 190, 230, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(160, 190, 230, 0.04) 1px, transparent 1px);
        background-size: auto, auto, 34px 34px, 34px 34px;
        color: var(--ink-1);
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        touch-action: pan-y;
    }

    /* 🌍 BACKGROUND MAP */
    .background-map{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        object-fit:cover;
        z-index:-1;
    }

    /* 🌫 DARK OVERLAY (improves readability) */
    .overlay{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.35);
        z-index:0;
    }

    /* MAIN CONTENT */
    .page{
        position:relative;
        z-index:1;
        max-width:900px;
        margin:auto;
        padding:20px;
    }

    /* CARD */
    .card{
        background:rgba(255,255,255,0.92);
        border-radius:18px;
        padding:25px;
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
        backdrop-filter: blur(6px); /* 🔥 glass effect */
    }

    /* TITLE */
    h1{
        text-align:center;
        font-family:'Baloo 2';
        color:#214f33;
    }

    h2{
        text-align:center;
        font-family:'Baloo 2';
        color:#214f33;
    }

    /* TEXT */
    .section-title{
        font-weight:bold;
        margin-top:15px;
    }

    /* BUTTON */
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
        transform:scale(1.02);
    }

    /* BACK BUTTON */
    .back-button{
        position:fixed;
        top: 80px; 
        left:20px;
        z-index: 999; 
        background:white;
        padding:10px 15px;
        border-radius:8px;
        text-decoration:none;
        font-weight:bold;
        box-shadow:0 4px 8px rgba(0,0,0,0.2);
    }

    /* ===== MOBILE RESPONSIVE FIX ===== */
    @media (max-width: 768px){

        body{
            overflow:auto; /* allow scroll on mobile */
        }

        .page{
            padding:15px;
            max-width:100%;
        }

        /* Card adjustments */
        .card{
            padding:18px;
            border-radius:14px;
        }

        /* Titles scale properly */
        h1{
            font-size:1.3rem;
            line-height:1.4;
        }

        h2{
            font-size:1.1rem;
        }

        /* Paragraph readability */
        p{
            font-size:0.9rem;
            line-height:1.6;
        }

        .section-title{
            font-size:0.95rem;
        }

        /* Button fix */
        .btn{
            padding:12px;
            font-size:14px;
        }

        /* Prevent overlap with content */
        .page{
            margin-top:50px;
        }
    }
</style>
@endpush

@section('content')
<!-- 🌍 BACKGROUND -->
<img src="{{ asset('pictures/mod2_innermap.png') }}" class="background-map">

<!-- 🌫 OVERLAY -->
<div class="overlay"></div>

<div class="page">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="card">

<h1><b>IKAW ANG TAGAPAMAHALA NG SAKUNA</b> <br>🎮Laro sa Tamang Desisyon sa Kapaligiran🎮</h1>

<!-- <h2>🎮 Environmental Decision Game</h2> -->

<p class="section-title">📘 Paglalarawan:</p>
<p>
Ang gawaing ito ay tumutulong sa iyo na malinang ang iyong pag-iisip at kakayahan sa pagpapasya
tungkol sa mga suliraning pangkapaligiran. Sa pamamagitan ng mga sitwasyong hango sa karanasan sa Albay,
matututuhan mong tukuyin ang sanhi ng problema at pumili ng tamang hakbang upang makatulong sa kalikasan at komunidad.
</p>

<p class="section-title">📌 Mga Tagubilin:</p>
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

@endsection