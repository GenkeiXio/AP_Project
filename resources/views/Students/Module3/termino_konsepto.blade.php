@extends('Students.studentslayout')
@section('title', 'Termino at Konsepto')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            background: #0b1220 !important;
            scroll-behavior: smooth;
            min-height: 100vh;
        }

        body {
            position: relative;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* Wood Theme Background */
        .bg-storm {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background: url('{{ asset('pictures/mod3_innermap.png') }}') center/cover no-repeat;
        }

        .bg-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background: rgba(0, 0, 0, 0.55);
        }

        /* Main content wrapper */
        .main-content {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            padding: 1.5rem 0.75rem;
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 2rem 1rem;
            }
        }

        /* Wood Theme Cards */
        .wood-card {
            background: #d9c5a3;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border: 2px solid #c5a059;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), inset 0 0 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .wood-card:last-child {
            margin-bottom: 0;
        }

        .wood-card-header {
            background: #c9b58a;
            padding: 1rem;
            border-bottom: 2px solid #c5a059;
        }

        .term-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            align-items: start;
            padding: 1.25rem;
        }

        @media (min-width: 768px) {
            .term-row {
                grid-template-columns: 300px 1fr;
                gap: 1.5rem;
            }
        }

        .term-image {
            width: 100%;
            height: auto;
            min-height: 200px;
            max-height: 260px;
            object-fit: cover;
            object-position: center;
            border-radius: 6px;
            border: 1px solid #b89a6a;
            background: #f4e4c7;
        }

        .hazard-image {
            object-fit: contain;
            background: #e8d9be;
            padding: 0.5rem;
        }

        .term-title {
            font-weight: 900;
            font-size: 1.4rem;
            line-height: 1.3;
            font-family: 'Nunito', sans-serif;
            margin-bottom: 0.5rem;
        }

        .term-text {
            color: #1a1a1a;
            line-height: 1.75;
            font-size: 0.95rem;
        }

        .term-text p {
            margin-bottom: 0.75rem;
        }

        .term-text ul {
            margin-top: 0.5rem;
            margin-left: 1.25rem;
        }

        .term-text li {
            margin-bottom: 0.5rem;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .term-title {
                font-size: 1.2rem;
            }
            .term-text {
                font-size: 0.88rem;
            }
            .term-image {
                min-height: 180px;
                max-height: 220px;
            }
        }

        @media (max-width: 480px) {
            .term-image {
                min-height: 150px;
                max-height: 180px;
            }
            .term-row {
                padding: 1rem;
                gap: 0.75rem;
            }
        }

        /* ===== UPDATED GREEN BUTTON STYLES (matches explore page) ===== */
        :root {
            --green-dark: #1b5e20;
            --green-mid: #2e7d32;
            --wood-dark: #3d2b1f;
        }

        .btn-green {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 25px;
            min-width: 200px;
            background: var(--green-mid) !important;
            border: 3px solid var(--wood-dark) !important;
            box-shadow: 0 5px 0 var(--wood-dark) !important;
            color: #fff !important;
            border-radius: 12px;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 1rem;
            text-decoration: none;
            transition: 0.18s ease;
            cursor: pointer;
        }

        .btn-green:hover {
            background: var(--green-dark) !important;
            transform: translateY(-2px);
            text-decoration: none;
            color: #fff !important;
        }

        .btn-green:active {
            transform: translateY(3px);
            box-shadow: 0 2px 0 var(--wood-dark) !important;
        }

        /* Video container */
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
            border: 2px solid #c5a059;
            background: #c9b58a;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Header image container */
        .header-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .header-image-container {
                height: 260px;
            }
        }

        .header-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        }

        .header-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.25rem;
        }

        @media (min-width: 768px) {
            .header-text {
                padding: 1.75rem;
            }
        }

        /* Color classes for titles */
        .text-cyan { color: #0e6b7c; }
        .text-red { color: #b71c1c; }
        .text-amber { color: #b85c1a; }
        .text-fuchsia { color: #9b2e6e; }
        .text-emerald { color: #1e6b3b; }

        /* Utility classes */
        .flex-wrap { flex-wrap: wrap; }
        .gap-3 { gap: 0.75rem; }
        .pt-2 { padding-top: 0.5rem; }
        .pb-2 { padding-bottom: 0.5rem; }
        .space-y-4 > * + * { margin-top: 1rem; }
        .space-y-5 > * + * { margin-top: 1.25rem; }
        
        @media (min-width: 768px) {
            .space-y-4 > * + * { margin-top: 1.25rem; }
            .space-y-5 > * + * { margin-top: 1.5rem; }
        }

        /* Button container - UPDATED */
        .button-container {
            display: flex;
            justify-content: center;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        @media (max-width: 480px) {
            .button-container .btn-green {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="bg-storm"></div>
    <div class="bg-overlay"></div>

    <div class="main-content">
        <div class="max-w-6xl mx-auto">
            
            <!-- Main Wood Card -->
            <div class="wood-card">
                
                <!-- Header with Image -->
                <div class="header-image-container">
                    <img src="{{ asset('pictures/termino_konsepto.png') }}" alt="Termino at Konsepto">
                    <div class="header-overlay"></div>
                    <div class="header-text">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-white drop-shadow-lg" style="margin: 0;">Termino at Konsepto</h1>
                        <p class="text-white font-semibold mt-1 text-sm md:text-base" style="margin: 0;">Disaster Risk Reduction and Management</p>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="p-4 md:p-6 space-y-4">

                    <!-- HAZARD -->
                    <div class="wood-card">
                        <div class="term-row">
                            <div>
                                <img src="{{ asset('pictures/termino_konsepto.png') }}" class="term-image hazard-image" alt="Hazard">
                            </div>
                            <div>
                                <h2 class="term-title text-cyan" style="margin-top: 0;">Hazard</h2>
                                <div class="term-text">
                                    <p>Banta na maaaring dulot ng kalikasan o ng tao na maaaring sanhi ng pinsala, buhay, ari-arian, at kalikasan. May dalawang uri ng hazard, ito ay ang:</p>
                                    <ul>
                                        <li><strong>Anthropogenic Hazard o Human-Induced Hazard</strong> – ito ay mga hazard na bunga ng mga gawain ng tao. Halimbawa nito ay ang mga basura na itinatapon kung saan-saan at maitim na usok na ibinubuga ng mga pabrika.</li>
                                        <li><strong>Natural Hazard</strong> – ito naman ay mga hazard na dulot ng kalikasan. Halimbawa nito ay ang lindol, tsunami, landslide at storm surge.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DISASTER -->
                    <div class="wood-card">
                        <div class="term-row">
                            <div>
                                <img src="{{ asset('pictures/disaster.png') }}" class="term-image" alt="Disaster">
                            </div>
                            <div>
                                <h2 class="term-title text-red" style="margin-top: 0;">Disaster</h2>
                                <div class="term-text">
                                    <p>Mga pangyayari na nagdudulot ng pinsala sa tao, kapaligiran at mga gawaing pang-ekonomiya. Ito ay maaaring resulta ng hazard, vulnerability o kahinaan at kawalan ng kakayahan ng isang pamayanan na harapin ang mga hazard.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- VULNERABILITY -->
                    <div class="wood-card">
                        <div class="term-row">
                            <div>
                                <img src="{{ asset('pictures/vulnerability.png') }}" class="term-image" alt="Vulnerability">
                            </div>
                            <div>
                                <h2 class="term-title text-amber" style="margin-top: 0;">Vulnerability</h2>
                                <div class="term-text">
                                    <p>Kahinaan ng tao, lugar, at imprastruktura na may mataas na posibilidad na maapektuhan ng mga hazard. Ang mga kalagayang heograpikal at antas ng kabuhayan ang kadalasang nakaiimpluwensiya sa kahinaang ito. Halimbawa, mas vulnerable ang mga taong naninirahan sa paanan ng bundok at ang mga bahay na gawa sa hindi matibay na materyales.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RISK -->
                    <div class="wood-card">
                        <div class="term-row">
                            <div>
                                <img src="{{ asset('pictures/risk.png') }}" class="term-image" alt="Risk">
                            </div>
                            <div>
                                <h2 class="term-title text-fuchsia" style="margin-top: 0;">Risk</h2>
                                <div class="term-text">
                                    <p>Mga pinsala sa tao, ari-arian, at buhay dulot ng isang kalamidad o sakuna. Ang mababang kapasidad ng isang pamayanan na harapin ang panganib na dulot ng kalamidad ay nagiging dahilan ng mas mataas na pinsala.</p>
                                    <p class="mt-2">May dalawang uri ito: <strong>human risk</strong> at <strong>structural risk</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RESILIENCE -->
                    <div class="wood-card">
                        <div class="term-row">
                            <div>
                                <img src="{{ asset('pictures/resilience.png') }}" class="term-image" alt="Resilience">
                            </div>
                            <div>
                                <h2 class="term-title text-emerald" style="margin-top: 0;">Resilience</h2>
                                <div class="term-text">
                                    <p>Kakayahan ng pamayanan na harapin ang mga epekto ng kalamidad. Ang pagiging resilient ay maaaring makita sa mga mamamayan, halimbawa ang pagkakaroon ng kasanayan at kaalaman tungkol sa hazard ay isang paraan upang sila ay maging ligtas sa panahon ng kalamidad. Maari ring estruktural na kung saan isinasaayos ang mga tahanan, gusali o tulay upang maging matibay bago pa dumating ang isang kalamidad.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Section -->
                    <div class="wood-card">
                        <div class="wood-card-header">
                            <h3 class="font-extrabold text-slate-800 text-lg md:text-xl flex items-center gap-2" style="margin: 0;">
                                🎥 Panoorin ang Video
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="video-wrapper">
                                <iframe 
                                    src="https://www.youtube-nocookie.com/embed/y16aMLeh91Q?rel=0&modestbranding=1&playsinline=1"
                                    title="DRRM Video"
                                    frameborder="0"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons - UPDATED: Green button with shadow -->
                    <div class="button-container">
                        <a href="{{ route('inner.map3') }}" class="btn-green">
                            🗺️ Magpatuloy
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Small script to prevent any rendering issues -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure all images are loaded properly
            const images = document.querySelectorAll('.term-image');
            images.forEach(img => {
                if (img.complete) {
                    img.style.opacity = '1';
                } else {
                    img.addEventListener('load', function() {
                        this.style.opacity = '1';
                    });
                }
                img.style.opacity = '1';
            });
        });
    </script>
@endsection