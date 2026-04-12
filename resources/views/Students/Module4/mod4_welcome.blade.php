@extends('Students.studentslayout')
@section('title', 'Module 4 : Transition')

@push('styles')
<style>
    /* OVERRIDE any parent layout backgrounds */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        overflow: hidden !important;
    }

    body {
        background: transparent !important;
    }

    /* MAIN CONTAINER */
    .page {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    /* BACKGROUND IMAGE - FULL COVER */
    .bg-img {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 0;
    }

    /* HEADER */
    .header {
        position: absolute;
        top: 20px;
        left: 25px;
        font-weight: 800;
        z-index: 3;
        color: white;
        background: rgba(0,0,0,0.5);
        padding: 8px 20px;
        border-radius: 50px;
        backdrop-filter: blur(5px);
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    /* CONTENT CENTER */
    .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 3;
        width: 90%;
        max-width: 800px;
    }

    /* OVERLAY TEXT */
    .overlay {
        background: rgba(0,0,0,0.65);
        padding: 35px 40px;
        border-radius: 25px;
        color: white;
        font-size: 1.2rem;
        line-height: 1.7;
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }

    .overlay strong {
        color: #ffc107;
        font-weight: 700;
    }

    /* BUTTON */
    .btn-next {
        margin-top: 35px;
        display: inline-block;
        padding: 14px 40px;
        border-radius: 50px;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
        font-weight: 800;
        text-decoration: none;
        transition: 0.3s;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        letter-spacing: 1px;
        border: none;
        cursor: pointer;
    }

    .btn-next:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #34ce57, #28a745);
        color: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    }

    /* Hide any extra containers from layout */
    .container,
    .container-fluid,
    [class*="container"] {
        background: transparent !important;
        box-shadow: none !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .overlay {
            padding: 20px 25px;
            font-size: 1rem;
        }
        .btn-next {
            padding: 12px 30px;
            font-size: 1rem;
        }
        .header {
            font-size: 0.75rem;
            top: 12px;
            left: 15px;
        }
    }
</style>
@endpush

@section('content')

<div class="page">

    <!-- BACKGROUND IMAGE - FULL COVER -->
    <img src="{{ asset('pictures/Module4/welcome_bg.png') }}" class="bg-img" alt="Background">

    <!-- HEADER -->
    <div class="header">
        🧠 TRANSITION TO MODULE 4
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="overlay">
            Ngayon na alam mo na ang mga dapat gawin bago, habang, at pagkatapos ng kalamidad,
            handa ka nang matutunan kung bakit mahalaga ang <strong>kahandaan</strong>, <strong>disiplina</strong>, at <strong>kooperasyon</strong>
            sa pagharap sa mga hamong pangkapaligiran.
        </div>

        <a href="{{ route('module4.explore') }}" class="btn-next">
            Magpatuloy ➜
        </a>

    </div>

</div>

@endsection