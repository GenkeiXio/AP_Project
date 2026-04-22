@extends('Students.studentslayout')
@section('title', 'Module 4 : Transition')

@push('styles')
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background: url("{{ asset('pictures/Module4/welcome_bg.png') }}") center center / cover no-repeat fixed !important;
}

.page-content{
    max-width:100% !important;
    padding:0 !important;
}

/* MAIN CONTAINER */
.page{
    position:relative;
    width:100vw;
    min-height:calc(100dvh - 60px);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    overflow-x:hidden;
    background:none;
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


        <!-- CONTENT -->
        <div class="content">

            <div class="overlay">
                Ngayon na alam mo na ang mga dapat gawin bago, habang, at pagkatapos ng kalamidad,
                handa ka nang matutunan kung bakit mahalaga ang <strong>kahandaan</strong>, <strong>disiplina</strong>, at <strong>kooperasyon</strong>
                sa pagharap sa mga hamong pangkapaligiran.
            </div>

            <a href="{{ route('inner.map4') }}" class="btn-next">
                Magpatuloy ➜
            </a>

        </div>

    </div>

@endsection