@extends('Students.studentslayout')

@section('title', 'Buod ng Aralin')

@section('content')

<style>
    body {
        background: linear-gradient(160deg, #020617 0%, #0b1020 50%, #10172c 100%);
        font-family: 'Poppins', sans-serif;
        color: #e2e8f0;
    }

    .buod-container {
        max-width: 1100px;
        margin: auto;
        padding: 30px 20px;
    }

    .buod-card {
        background: rgba(15, 23, 42, 0.9);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        border: 1px solid rgba(0,242,255,0.2);
    }

    .buod-title {
        font-size: 2.5rem;
        font-weight: 900;
        text-align: center;
        color: #00f2ff;
        margin-bottom: 20px;
    }

    .buod-title span {
        color: #94a3b8;
        font-size: 1.2rem;
    }

    .buod-image {
        width: 100%;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    }

    .buod-text {
        line-height: 1.8;
        font-size: 1rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .buod-text strong {
        color: #00f2ff;
    }

    .highlight-box {
        background: rgba(255, 255, 0, 0.1);
        border-left: 5px solid #facc15;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .tandaan {
        margin-top: 30px;
        padding: 20px;
        border-radius: 15px;
        background: rgba(0, 242, 255, 0.08);
        border: 1px solid rgba(0,242,255,0.2);
    }

    .tandaan h3 {
        color: #00f2ff;
        margin-bottom: 10px;
    }

    .tandaan p {
        margin-bottom: 8px;
    }

    .btn-next {
        display: inline-block;
        margin-top: 30px;
        padding: 15px 30px;
        font-size: 1.2rem;
        font-weight: 900;
        border-radius: 50px;
        background: linear-gradient(135deg, #00f2ff, #39ff14);
        color: #000;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0,242,255,0.3);
    }

    .btn-next:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,242,255,0.5);
    }

    .center {
        text-align: center;
    }
</style>

<div class="buod-container">
    <div class="buod-card">

        <div class="buod-title">
            Buod ng Aralin <br>
        </div>

        <!-- IMAGE -->
        <img src="{{ asset('pictures/buod.png') }}" class="buod-image" alt="Buod ng Aralin">

        <!-- TEXT -->
        <div class="buod-text">
            Sa araling ito, natutunan mo ang kahalagahan ng <strong>paghahanda sa harap ng mga panganib at kalamidad</strong> na dulot ng suliraning pangkapaligiran.
            Naunawaan mo ang mahahalagang konsepto tulad ng <strong>hazard, vulnerability, risk, disaster, at resilience</strong>,
            at kung paano nagkakaugnay ang mga ito sa pagbuo ng isang sakuna.
        </div>

        <div class="buod-text">
            Napag-aralan mo rin ang iba’t ibang <strong>paraan ng pagtugon sa sakuna</strong>, tulad ng
            <strong>top-down</strong> at <strong>bottom-up approach</strong>, at kung bakit mahalaga ang aktibong partisipasyon ng komunidad
            sa pamamagitan ng <strong>Community-Based Disaster Risk Reduction and Management (CBDRRM)</strong>.
        </div>

        <div class="buod-text">
            Sa pamamagitan ng iba’t ibang gawain, natutuhan mo ang mga <strong>dapat gawin bago, habang, at pagkatapos ng sakuna</strong>
            tulad ng bagyo, baha, lindol, at pagputok ng bulkan.
            Nalinang ang iyong kakayahan sa <strong>tamang pagpapasya</strong> at pagiging <strong>handa</strong> upang maprotektahan ang sarili,
            pamilya, at komunidad.
        </div>

        <div class="buod-text">
            Higit sa lahat, natutunan mo na ang <strong>kahandaan, kaalaman, at pakikiisa</strong> ay mahalagang susi upang
            <strong>mabawasan ang pinsala ng kalamidad</strong>.
        </div>

        <!-- TANDAAN -->
        <div class="tandaan">
            <h3>💡 Tandaan:</h3>
            <p>👉 Ang sakuna ay hindi maiiwasan, ngunit ang pinsala nito ay maaaring <strong>mabawasan</strong> sa pamamagitan ng tamang paghahanda.</p>
            <p>👉 Ang isang handa at maalam na mamamayan ay mahalagang bahagi ng isang <strong>ligtas na komunidad</strong>.</p>
        </div>

        <!-- BUTTON -->
        <div class="center">
            <a href="{{ route('student.map') }}" class="btn-next">
                🗺️ Bumalik sa Main Map
            </a>
        </div>

    </div>
</div>

@endsection