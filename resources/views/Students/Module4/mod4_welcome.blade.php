@extends('Students.studentslayout')
@section('title', 'Module 4 : Transition')

@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('pictures/mod4_innermap.png') }}") center center / cover no-repeat fixed !important;
        }

        .page-content {
            max-width: 100% !important;
            padding: 0 !important;
        }

        /* MAIN CONTAINER */
        .page {
            position: relative;
            width: 100vw;
            min-height: calc(100dvh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            background: none;
        }

        /* HEADER */
        .header {
            position: absolute;
            top: 20px;
            left: 25px;
            font-weight: 800;
            z-index: 3;
            color: white;
            background: rgba(0, 0, 0, 0.5);
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
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 35px;
            border-radius: 22px;
            color: #374151;
            font-size: 1.15rem;
            line-height: 1.8;
            backdrop-filter: blur(8px);
            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.15),
                0 2px 6px rgba(0, 0, 0, 0.08);
            text-align: left;
        }

        .highlight {
            color: #f59e0b;
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            border: none;
            cursor: pointer;
        }

        .btn-next:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #34ce57, #28a745);
            color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
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

        .bg-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            /* softer like screenshot */
            z-index: 1;
        }
    </style>
@endpush

@section('content')

    <div class="page">

        <!-- DARK BACKGROUND OVERLAY -->
        <div class="page">

            <!-- DARK BACKGROUND -->
            <div class="bg-overlay"></div>

            <!-- CONTENT -->
            <div class="content">

                <div class="overlay">
                    Ngayon na alam mo na ang mga dapat gawin bago, habang, at pagkatapos ng kalamidad,
                    handa ka nang matutunan kung bakit mahalaga ang
                    <span class="highlight">kahandaan</span>,
                    <span class="highlight">disiplina</span>,
                    at <span class="highlight">kooperasyon</span>
                    sa pagharap sa mga hamong pangkapaligiran.
                </div>

                <a href="{{ route('inner.map4') }}" class="btn-next">
                    Magpatuloy ➜
                </a>

            </div>
        </div>
    </div>

@endsection