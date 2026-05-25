@extends('Students.studentslayout')
@section('title', 'Module 3 Completed!')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Bungee&family=Lexend:wght@400;700;800&display=swap");
    
    :root {
        --wood-dark: #2c1e14;
        --wood-medium: #4a3728;
        --wood-light: #d2b48c;
        --wood-paper: #d9c5a3;
        --accent-gold: #c5a059;
        --text-dark: #2c2418;
        --text-light: #f9eed7;
    }

    html, body {
        scroll-behavior: smooth;
        background: linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                    url('/pictures/mod3_innermap.png') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

    body {
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        color: var(--text-light);
    }

    .container {
        max-width: 1100px;
        z-index: 1;
    }

    /* Floating Card Design - Wood Theme */
    .closing-card {
        background: var(--wood-paper);
        background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        border-radius: 16px;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        border: 2px solid var(--accent-gold);
        transition: transform 0.3s ease;
    }

    @media (max-width: 992px) {
        .closing-card {
            grid-template-columns: 1fr;
            margin: 20px;
        }
    }

    /* Image Section */
    .closing-image {
        position: relative;
        background: var(--wood-dark);
        overflow: hidden;
    }

    .closing-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .closing-card:hover .closing-image img {
        transform: scale(1.05);
    }

    .image-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: var(--accent-gold);
        color: var(--wood-dark);
        padding: 8px 20px;
        border-radius: 40px;
        font-family: 'Bungee';
        font-size: 0.85rem;
        box-shadow: 0 4px 15px rgba(197, 160, 89, 0.4);
        font-weight: bold;
    }

    /* Content Section */
    .closing-content {
        padding: 45px 50px;
        color: var(--text-dark);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .closing-content {
            padding: 30px;
        }
    }

    h2 {
        font-family: 'Bungee', cursive;
        color: var(--wood-dark);
        margin-bottom: 20px;
        line-height: 1.2;
        font-size: 1.8rem;
    }

    @media (min-width: 768px) {
        h2 {
            font-size: 2rem;
        }
    }

    .closing-text p {
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        color: var(--text-dark);
    }

    @media (min-width: 768px) {
        .closing-text p {
            font-size: 1.05rem;
        }
    }

    .highlight-box {
        background: rgba(210, 180, 140, 0.5);
        border-left: 5px solid var(--accent-gold);
        padding: 18px;
        border-radius: 0 12px 12px 0;
        font-weight: 500;
        color: var(--text-dark) !important;
        font-style: italic;
        backdrop-filter: blur(4px);
    }

    /* Button - Wood Theme */
    .btn-next {
        background: linear-gradient(135deg, var(--wood-dark), var(--wood-medium));
        color: var(--accent-gold);
        padding: 16px 38px;
        border-radius: 50px;
        text-decoration: none;
        font-family: 'Bungee';
        font-size: 0.95rem;
        display: inline-block;
        margin-top: 15px;
        text-align: center;
        border: 1px solid var(--accent-gold);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
        .btn-next {
            font-size: 1rem;
            padding: 18px 40px;
        }
    }

    .btn-next:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #3d2a25, #5c3f2e);
        color: #e8c88a;
        border-color: #e8c88a;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        text-decoration: none;
    }

    .btn-next:active {
        transform: translateY(2px);
    }

    /* Decorative blobs - wood-themed */
    .blob {
        position: absolute;
        width: 400px;
        height: 400px;
        background: var(--wood-dark);
        filter: blur(100px);
        opacity: 0.15;
        border-radius: 50%;
        z-index: -1;
    }

    .blob-light {
        background: var(--accent-gold);
        opacity: 0.12;
    }
    </style>
@endpush

@section('content')

    <div class="blob animate__animated animate__pulse animate__infinite" style="top: -10%; right: -5%;"></div>
    <div class="blob blob-light animate__animated animate__pulse animate__infinite"
        style="bottom: -10%; left: -5%; background: var(--accent-gold);"></div>

    <div class="container py-4 py-md-5">
        <div class="closing-card animate__animated animate__zoomIn">

            <div class="closing-image">
                <img src="/pictures/Module 3/closing.png" alt="Mission Completed">
            </div>

            <div class="closing-content">
                <h2 class="animate__animated animate__fadeInRight animate__delay-1s">
                    🎉 Natapos mo ang Module 3!
                </h2>

                <div class="closing-text">
                    <p>
                        Laging tandaan na <strong>ligtas ang may alam</strong>, kaya't dapat kang maging mapanuri at
                        alerto lalo na sa pagdating ng mga kalamidad at anumang panganib.
                    </p>

                    <p class="highlight-box">
                        📢 Narito ang ilan sa mga ahensiya ng pamahalaan na dapat mong tandaan lalo na ang mga bahaging
                        ginagampanan ng mga ito tungo sa ligtas na bansa.
                    </p>

                    <div class="text-center text-md-start mt-3 mt-md-4">
                        <a href="{{ route('module3.posttest') }}" class="btn-next">
                            📝 Magpatuloy sa Posttest ➜
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection