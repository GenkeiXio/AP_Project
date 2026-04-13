{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 3\termino_konsepto.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Termino at Konsepto')

@push('styles')
<style>
    html, body {
        background: #0b1220 !important;
        scroll-behavior: smooth;
    }

    body {
        position: relative;
        overflow-x: hidden;
    }

    .bg-storm {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background: url('{{ asset('pictures/typhoon_chaos.png') }}') center/cover no-repeat;
    }

    .bg-overlay {
        position: fixed;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        background: rgba(0, 0, 0, .48);
    }

    .glass {
        background: rgba(255, 255, 255, .92);
        border: 1px solid rgba(255, 255, 255, .70);
        backdrop-filter: blur(8px);
        box-shadow: 0 12px 30px rgba(2, 6, 23, .28);
    }

    .term-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        align-items: stretch;
    }

    @media (min-width: 768px) {
        .term-row {
            grid-template-columns: 340px 1fr; /* image left, meaning right */
        }
    }

    .term-image {
        width: 100%;
        height: 100%;
        min-height: 220px;
        max-height: 300px;
        object-fit: cover;
        object-position: center;
        border-radius: 0.75rem;
        border: 1px solid rgba(15, 23, 42, .08);
        display: block;
    }

    /* Full-view only for Hazard image */
    .hazard-image {
        object-fit: contain;
        background: #e2e8f0;
        padding: .35rem;
    }

    .term-title {
        font-weight: 900;
        font-size: 1.3rem;
        line-height: 1.2;
    }

    .term-text {
        color: #334155;
        line-height: 1.75;
    }
</style>
@endpush

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-storm"></div>
<div class="bg-overlay"></div>

<div class="relative z-10 min-h-screen py-8 text-slate-900">
    <div class="max-w-6xl mx-auto px-4">
        <div class="glass rounded-2xl overflow-hidden">
            <div class="relative h-[220px] md:h-[280px]">
                <img src="{{ asset('pictures/termino_konsepto.png') }}" class="w-full h-full object-cover" alt="Termino at Konsepto">
                <div class="absolute inset-0 bg-black/35"></div>
                <div class="absolute inset-0 p-6 md:p-8 flex items-end">
                    <div>
                        <h1 class="text-2xl md:text-4xl font-black text-white">📘 Termino at Konsepto</h1>
                        <p class="text-cyan-100 font-semibold mt-1">Disaster Risk Reduction and Management</p>
                    </div>
                </div>
            </div>

            <div class="p-5 md:p-7 space-y-5">

                {{-- HAZARD --}}
                <section class="glass rounded-xl p-4">
                    <div class="term-row">
                        <div>
                            <img src="{{ asset('pictures/termino_konsepto.png') }}" class="term-image hazard-image" alt="Hazard">
                        </div>
                        <div>
                            <h2 class="term-title text-cyan-700">Hazard</h2>
                            <div class="term-text mt-2">
                                <p>
                                    Banta na maaaring dulot ng kalikasan o ng tao na maaaring sanhi ng pinsala, buhay, ari-arian, at kalikasan.
                                    May dalawang uri ng hazard, ito ay ang:
                                </p>
                                <ul class="list-disc pl-6 mt-2 space-y-2">
                                    <li>
                                        <b>Anthropogenic Hazard o Human-Induced Hazard</b> – ito ay mga hazard na bunga ng mga gawain ng tao.
                                        Halimbawa nito ay ang mga basura na itinatapon kung saan-saan at maitim na usok na ibinubuga ng mga pabrika.
                                    </li>
                                    <li>
                                        <b>Natural Hazard</b> – ito naman ay mga hazard na dulot ng kalikasan.
                                        Halimbawa nito ay ang lindol, tsunami, landslide at storm surge.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- DISASTER --}}
                <section class="glass rounded-xl p-4">
                    <div class="term-row">
                        <div>
                            <img src="{{ asset('pictures/disaster.png') }}" class="term-image" alt="Disaster">
                        </div>
                        <div>
                            <h2 class="term-title text-red-700">Disaster</h2>
                            <p class="term-text mt-2">
                                Mga pangyayari na nagdudulot ng pinsala sa tao, kapaligiran at mga gawaing pang-ekonomiya.
                                Ito ay maaaring resulta ng hazard, vulnerability o kahinaan at kawalan ng kakayahan ng isang
                                pamayanan na harapin ang mga hazard.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- VULNERABILITY --}}
                <section class="glass rounded-xl p-4">
                    <div class="term-row">
                        <div>
                            <img src="{{ asset('pictures/vulnerability.png') }}" class="term-image" alt="Vulnerability">
                        </div>
                        <div>
                            <h2 class="term-title text-amber-700">Vulnerability</h2>
                            <p class="term-text mt-2">
                                Kahinaan ng tao, lugar, at imprastruktura na may mataas na posibilidad na maapektuhan ng mga hazard.
                                Ang mga kalagayang heograpikal at antas ng kabuhayan ang kadalasang nakaiimpluwensiya sa kahinaang ito.
                                Halimbawa, mas vulnerable ang mga taong naninirahan sa paanan ng bundok at ang mga bahay na gawa sa
                                hindi matibay na materyales.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- RISK --}}
                <section class="glass rounded-xl p-4">
                    <div class="term-row">
                        <div>
                            <img src="{{ asset('pictures/risk.png') }}" class="term-image" alt="Risk">
                        </div>
                        <div>
                            <h2 class="term-title text-fuchsia-700">Risk</h2>
                            <div class="term-text mt-2">
                                <p>
                                    Mga pinsala sa tao, ari-arian, at buhay dulot ng isang kalamidad o sakuna.
                                    Ang mababang kapasidad ng isang pamayanan na harapin ang panganib na dulot ng kalamidad
                                    ay nagiging dahilan ng mas mataas na pinsala.
                                </p>
                                <p class="mt-2">
                                    May dalawang uri ito: <b>human risk</b> at <b>structural risk</b>.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- RESILIENCE --}}
                <section class="glass rounded-xl p-4">
                    <div class="term-row">
                        <div>
                            <img src="{{ asset('pictures/resilience.png') }}" class="term-image" alt="Resilience">
                        </div>
                        <div>
                            <h2 class="term-title text-emerald-700">Resilience</h2>
                            <p class="term-text mt-2">
                                Kakayahan ng pamayanan na harapin ang mga epekto ng kalamidad. Ang pagiging resilient ay maaaring
                                makita sa mga mamamayan, halimbawa ang pagkakaroon ng kasanayan at kaalaman tungkol sa hazard ay
                                isang paraan upang sila ay maging ligtas sa panahon ng kalamidad. Maari ring estruktural na kung saan
                                isinasaayos ang mga tahanan, gusali o tulay upang maging matibay bago pa dumating ang isang kalamidad.
                            </p>
                        </div>
                    </div>
                </section>

                <div class="glass rounded-xl p-4">
                    <h3 class="font-extrabold text-slate-800">🎥 Panoorin ang video</h3>
                    <div class="mt-3 aspect-video">
                        <iframe class="w-full h-full rounded-xl"
                                src="https://www.youtube.com/embed/y16aMLeh91Q"
                                title="DRRM Video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>

                <div class="pt-2 flex flex-wrap gap-3">
                    <a href="{{ route('module3.iv_explore') }}"
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-slate-700 text-white font-bold hover:bg-slate-800 transition">
                        ← Bumalik sa Explore
                    </a>

                    <a href="{{ route('module3.node1') }}"
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-cyan-600 text-white font-bold hover:bg-cyan-700 transition">
                        🗺️ Pumunta sa Node 1
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection