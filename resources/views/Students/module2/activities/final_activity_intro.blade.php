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
    .background-map {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    /* 🌫 DARK OVERLAY (improves readability) */
    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        z-index: 0;
    }

    /* MAIN CONTENT */
    .page {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: auto;
        padding: 40px 20px;
    }

    /* CARD */
    .card {
        background: rgba(255,255,255,0.95);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* GAME HEADER HEADINGS */
    .game-header {
        text-align: center;
        margin-bottom: 35px;
    }

    h1 {
        font-family: 'Baloo 2', 'Poppins', sans-serif;
        color: #1b432a;
        font-size: 2.2rem;
        font-weight: 800;
        text-transform: uppercase;
        margin: 0 0 10px 0;
        letter-spacing: 0.5px;
    }

    h2 {
        font-family: 'Baloo 2', 'Poppins', sans-serif;
        color: #2c5e3b;
        font-size: 1.6rem;
        font-weight: 600;
        margin: 0;
    }

    /* TEXT CONTENT ELEMENTS */
    .section-block {
        margin-bottom: 25px;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1b432a;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .section-content {
        color: #333333;
        line-height: 1.7;
        font-size: 1.05rem;
        margin: 0;
        text-align: justify;
    }

    /* BUTTON */
    .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 14px;
        background: #5eae4e;
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin-top: 35px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(94, 174, 78, 0.3);
    }

    .btn:hover {
        background: #4a983c;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(74, 152, 60, 0.4);
    }

    .btn:active {
        transform: translateY(0);
    }

    /* BACK BUTTON */
    .back-button {
        position: fixed;
        top: 80px; 
        left: 20px;
        z-index: 999; 
        background: white;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        color: #333;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.2s;
    }
    
    .back-button:hover {
        background: #f5f5f5;
        transform: translateX(-3px);
    }

    /* ===== MOBILE RESPONSIVE FIX ===== */
    @media (max-width: 768px) {
        body {
            overflow: auto;
        }

        .page {
            padding: 15px;
            margin-top: 60px;
            max-width: 100%;
        }

        .card {
            padding: 25px 20px;
            border-radius: 18px;
        }

        h1 {
            font-size: 1.5rem;
            line-height: 1.3;
        }

        h2 {
            font-size: 1.2rem;
            line-height: 1.3;
        }

        .section-content {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .btn {
            padding: 14px;
            font-size: 16px;
        }
    }
</style>
@endpush

@section('content')
<img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">

<div class="overlay"></div>

<div class="page">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="card">

    <div class="game-header">
        <h1>Ikaw ang Tagapangasiwa ng Kahandaan</h1>
        <h2>Matalinong Pagpapasya sa Oras ng Sakuna</h2>
    </div>

    <div class="section-block">
        <div class="section-title">📘 Paglalarawan:</div>
        <p class="section-content">
            Ang gawaing ito ay tumutulong sa iyo na malinang ang iyong pag-iisip at kakayahan sa pagpapasya
            tungkol sa mga suliraning pangkapaligiran. Sa pamamagitan ng mga sitwasyong hango sa karanasan sa Albay,
            matututuhan mong tukuyin ang sanhi ng problema at pumili ng tamang hakbang upang makatulong sa kalikasan at komunidad.
        </p>
    </div>

    <div class="section-block">
        <div class="section-title">📌 Mga Tagubilin:</div>
        <p class="section-content">
            Basahin at suriin ang bawat sitwasyon at larawan. Piliin ang <b>LAHAT</b> ng tamang sagot na
            makatutulong sa paglutas ng suliranin.
        </p>
    </div>

    <button class="btn" onclick="startGame()">
        🚀 Simulan ang Huling Gawain
    </button>

</div>

</div>

<script>
function startGame(){
    window.location.href = "{{ route('module2.activity') }}";
}
</script>
@endsection