@extends('Students.studentslayout')
@section('title', 'Balik-Aral: Operasyon Kalamidad')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ap-gold: #c5a059;
            --ap-brown: #4e342e;
            --ap-green: #2e7d32;
            --ap-paper: rgba(255, 255, 255, 0.95);
        }

        body {
            /* Low opacity background for focus */
            background: linear-gradient(rgba(103, 103, 103, 0.88), rgba(117, 114, 114, 0.88)), 
                        url("{{ asset('pictures/mod4_innermap.png') }}") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Baloo 2', cursive;
            color: var(--ap-brown);
        }

        /* --- INSTRUKSYON MODAL --- */
        #instruksyonOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .kard-instruksyon {
            background: #fffefb;
            padding: 40px;
            border: 6px solid var(--ap-gold);
            border-radius: 30px;
            max-width: 550px;
            text-align: center;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
        }

        .gabay-listahan {
            text-align: left;
            background: rgba(197, 160, 89, 0.1);
            padding: 25px;
            border-radius: 20px;
            margin: 25px 0;
            font-size: 1.1rem;
            line-height: 1.6;
            border-left: 8px solid var(--ap-gold);
        }

        .btn-simula {
            background: var(--ap-green);
            color: white;
            padding: 12px 50px;
            border: none;
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 50px;
            box-shadow: 0 4px 0 #1b5e20;
        }

        /* --- GAME INTERFACE --- */
        .hud-container {
            max-width: 1000px;
            margin: 40px auto;
            background: var(--ap-paper);
            border-radius: 30px;
            overflow: hidden;
            display: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .hud-header {
            background: var(--ap-brown);
            color: #fff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .game-body { display: grid; grid-template-columns: 280px 1fr; min-height: 480px; }

        .sidebar-yugto { background: #f9f6f2; padding: 25px; border-right: 2px solid #eee; }

        .yugto-kard {
            background: white;
            border: 3px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 20px;
            cursor: pointer;
            text-align: center;
            transition: 0.3s;
            font-weight: 600;
        }

        .yugto-kard.pili {
            background: var(--ap-gold);
            color: white;
            transform: scale(1.05);
        }

        .aksyon-area { padding: 30px; display: flex; flex-direction: column; gap: 20px; }

        .ulat-senaryo {
            background: #fff;
            padding: 20px;
            border-radius: 20px;
            font-size: 1.3rem;
            text-align: center;
            border: 2px solid var(--ap-gold);
            font-weight: 600;
        }

        .larawan-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }

        .larawan-item {
            background: white;
            border: 3px solid #f0f0f0;
            padding: 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .larawan-item:hover { border-color: var(--ap-green); }
        .larawan-item.tama { border-color: var(--ap-green); background: #e8f5e9; opacity: 0.5; pointer-events: none; }
        .larawan-item img { width: 100%; height: 90px; object-fit: contain; }

        /* --- FINAL RESULT MODAL --- */
        #modalPagtatapos {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .map-container {
            position: relative;
            background: white;
            padding: 20px;
            border-radius: 30px;
            text-align: center;
        }

        .inner-map-preview {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            margin-bottom: 20px;
            border: 3px solid var(--ap-gold);
        }

        .btn-magpatuloy {
            background: var(--ap-green);
            color: white;
            padding: 15px 45px;
            border: none;
            border-radius: 50px;
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            font-size: 1.4rem;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
<div id="instruksyonOverlay">
    <div class="kard-instruksyon">
        <h1 style="color: var(--ap-brown); font-weight: 800; font-size: 2.5rem; margin-bottom: 0;">BALIK-ARAL</h1>
        <p style="margin-top: 0; color: var(--ap-gold); font-weight: 600;">OPERASYON: KALAMIDAD</p>
        
        <div class="gabay-listahan">
            <strong>Gabay sa Paglalaro:</strong><br>
            1. **Basahin** ang ulat sa gitna ng screen.<br>
            2. **Piliin ang Yugto** (Bago, Habang, o Pagkatapos) sa kaliwa.<br>
            3. **I-click ang Larawan** na tugma sa yugto at ulat.<br>
            4. Kumpletuhin ang lahat ng misyon sa sarili mong bilis.
        </div>

        <button class="btn-simula" onclick="simulanAngLaro()">MAGSIMULA</button>
    </div>
</div>

<div class="hud-container" id="gameUI">
    <div class="hud-header">
        <div>
            <h2 style="margin:0; font-weight: 800;">Ligtas-Kalamidad Command</h2>
            <span id="gabayTeksto" style="color: var(--ap-gold); font-weight: 600;">Step 1: Piliin ang Yugto...</span>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 0.9rem; font-weight: 600; opacity: 0.8;">MISYON</div>
            <div style="font-size: 2.2rem; font-weight: 800;" id="puntosValue">0 / 6</div>
        </div>
    </div>

    <div class="game-body">
        <div class="sidebar-yugto">
            <div class="yugto-kard" onclick="piliinAngYugto('before', this)" id="y-before">
                <div style="font-size: 1.4rem;">BAGO</div>
                <small>Paghahanda</small>
            </div>
            <div class="yugto-kard" onclick="piliinAngYugto('during', this)" id="y-during">
                <div style="font-size: 1.4rem;">HABANG</div>
                <small>Pagtugon</small>
            </div>
            <div class="yugto-kard" onclick="piliinAngYugto('after', this)" id="y-after">
                <div style="font-size: 1.4rem;">PAGKATAPOS</div>
                <small>Pagbangon</small>
            </div>
        </div>

        <div class="aksyon-area">
            <div class="ulat-senaryo" id="senaryoDisplay">Naghahanda...</div>
            
            <div class="larawan-grid">
                @foreach([
                    ['p' => 'before', 'img' => 'mod4_emergencykit.png'],
                    ['p' => 'before', 'img' => 'mod4_newsbabala.png'],
                    ['p' => 'during', 'img' => 'mod4_evacuating.png'],
                    ['p' => 'during', 'img' => 'mod4_duckcoverhold.png'],
                    ['p' => 'after', 'img' => 'mod4_cleanupdrive.png'],
                    ['p' => 'after', 'img' => 'mod4_suriinkuryente.png']
                ] as $item)
                    <div class="larawan-item" onclick="suriinAngSagot('{{ $item['p'] }}', this)">
                        <img src="{{ asset('pictures/'.$item['img']) }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="modalPagtatapos">
    <div class="map-container">
        <h1 style="font-weight: 800; color: var(--ap-brown);">MISYON TAPOS!</h1>
        <p style="font-weight: 600; margin-bottom: 20px;">Nagtagumpay ka sa pag-aaral ng kahandaan.</p>
        
        <img src="{{ asset('pictures/mod4_innermap.png') }}" class="inner-map-preview">
        
        <a href="{{ route('module4.welcome') }}" class="btn-magpatuloy">
            Magpatuloy sa Susunod ➔
        </a>
    </div>
</div>

<script>
    const mgaSenaryo = [
        { phase: 'before', text: "Pag-eempake ng Go Bag na may pagkain, tubig, at gamot." },
        { phase: 'before', text: "Pagsubaybay sa ulat ng panahon at storm signals sa TV o radyo." },
        { phase: 'during', text: "Mabilis na paglikas sa mataas na lugar bago pa tumaas ang baha." },
        { phase: 'during', text: "Pagsasagawa ng Duck, Cover, and Hold habang yumayanig ang lupa." },
        { phase: 'after', text: "Paglilinis ng basura at putik upang maiwasan ang sakit paghupa ng baha." },
        { phase: 'after', text: "Pagsuri sa main switch at mga wire ng kuryente bago ito buksan muli." }
    ];

    let index = 0;
    let pilingYugto = null;
    let puntos = 0;
    let laroAktibo = false;
    let simulaOras = null;

    const saveUrl = "{{ route('student.module4.balikaral.save') }}";
    const token = "{{ csrf_token() }}";

    function simulanAngLaro() {
        document.getElementById('instruksyonOverlay').style.display = 'none';
        document.getElementById('gameUI').style.display = 'block';
        laroAktibo = true;
        simulaOras = new Date();
        mgaSenaryo.sort(() => Math.random() - 0.5);
        loadLevel();
    }

    function loadLevel() {
        if(index < mgaSenaryo.length) {
            document.getElementById('senaryoDisplay').innerText = mgaSenaryo[index].text;
            pilingYugto = null;
            resetSidebar();
            document.getElementById('gabayTeksto').innerText = "Step 1: Piliin ang Yugto...";
        } else {
            tapusin();
        }
    }

    function piliinAngYugto(y, el) {
        pilingYugto = y;
        resetSidebar();
        el.classList.add('pili');
        document.getElementById('gabayTeksto').innerText = "Step 2: I-click ang tamang larawan...";
    }

    function resetSidebar() {
        document.querySelectorAll('.yugto-kard').forEach(k => k.classList.remove('pili'));
    }

    function suriinAngSagot(imgPhase, el) {
        if(!pilingYugto || !laroAktibo) return;

        if(pilingYugto === mgaSenaryo[index].phase && imgPhase === pilingYugto) {
            puntos++;
            index++;
            el.classList.add('tama');
            document.getElementById('puntosValue').innerText = puntos + " / 6";
            loadLevel();
        } else {
            alert("Mali! Itugma ang Yugto sa tamang Larawan.");
        }
    }

    async function tapusin() {
        laroAktibo = false;
        const orasNatapos = new Date();
        const timeSpent = Math.floor((orasNatapos - simulaOras) / 1000);

        // AJAX Save (No countdown, but we still track time spent)
        try {
            await fetch(saveUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({
                    score: puntos,
                    correct_answers: puntos,
                    total_items: 6,
                    time_spent: timeSpent,
                    completed: true
                })
            });
        } catch(e) { console.error(e); }

        document.getElementById('modalPagtatapos').style.display = 'flex';
    }
</script>
@endsection