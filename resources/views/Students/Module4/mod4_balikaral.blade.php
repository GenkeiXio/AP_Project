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
            --ap-red: #c62828;
        }

        body {
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

        .sidebar-yugto { 
            background: #f9f6f2; 
            padding: 25px; 
            border-right: 2px solid #eee;
            transition: all 0.3s ease;
        }

        .sidebar-yugto.highlight {
            background: #fff8e1;
            border-right: 4px solid var(--ap-gold);
            box-shadow: inset 0 0 30px rgba(197, 160, 89, 0.1);
        }

        .step-indicator {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            background: var(--ap-brown);
            color: white;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .step-indicator .step-number {
            display: inline-block;
            background: var(--ap-gold);
            color: var(--ap-brown);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 24px;
            font-size: 0.8rem;
            margin-right: 8px;
            font-weight: 800;
        }

        .yugto-kard {
            background: white;
            border: 3px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 20px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
        }

        .yugto-kard:hover:not(.disabled):not(.selected) {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Pulsating glow for active step */
        @keyframes pulseGlow {
            0% {
                box-shadow: 0 0 10px rgba(197, 160, 89, 0.3), 0 0 20px rgba(197, 160, 89, 0.2);
                border-color: var(--ap-gold);
            }
            50% {
                box-shadow: 0 0 30px rgba(197, 160, 89, 0.8), 0 0 60px rgba(197, 160, 89, 0.4);
                border-color: #d4b06a;
            }
            100% {
                box-shadow: 0 0 10px rgba(197, 160, 89, 0.3), 0 0 20px rgba(197, 160, 89, 0.2);
                border-color: var(--ap-gold);
            }
        }

        .yugto-kard.highlight-select {
            animation: pulseGlow 1.5s ease-in-out infinite;
            border-color: var(--ap-gold);
            background: #fffcf0;
        }

        .yugto-kard.selected {
            background: var(--ap-gold);
            color: white;
            transform: scale(1.05);
            border-color: var(--ap-gold);
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.3);
            animation: pulseGlow 1.5s ease-in-out infinite;
        }

        .yugto-kard.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Shake animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
            20%, 40%, 60%, 80% { transform: translateX(10px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        .yugto-kard.shake {
            animation: shake 0.5s ease-in-out;
            border-color: var(--ap-red) !important;
            background: #ffebee !important;
        }

        .larawan-item.shake {
            animation: shake 0.5s ease-in-out;
            border-color: var(--ap-red) !important;
            background: #ffebee !important;
        }

        /* Image area styling */
        .aksyon-area { 
            padding: 30px; 
            display: flex; 
            flex-direction: column; 
            gap: 20px;
            transition: all 0.3s ease;
        }

        .aksyon-area.highlight {
            background: #f1f8e9;
            border-radius: 0 0 30px 0;
        }

        .ulat-senaryo {
            background: #fff;
            padding: 20px;
            border-radius: 20px;
            font-size: 1.3rem;
            text-align: center;
            border: 2px solid var(--ap-gold);
            font-weight: 600;
        }

        .larawan-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 15px;
            transition: all 0.3s ease;
        }

        .larawan-grid.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        .larawan-grid.highlight-select {
            opacity: 1;
            pointer-events: all;
        }

        .larawan-grid.highlight-select .larawan-item {
            border-color: #a5d6a7;
            background: #f1f8e9;
        }

        .larawan-grid.highlight-select .larawan-item:hover:not(.tama):not(.shake) {
            transform: scale(1.05);
            border-color: var(--ap-green);
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.3);
            background: white;
        }

        .larawan-item {
            background: white;
            border: 3px solid #f0f0f0;
            padding: 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .larawan-item.tama {
            border-color: var(--ap-green);
            background: #e8f5e9;
            opacity: 0.7;
            cursor: default;
            pointer-events: none;
        }

        .larawan-item img { width: 100%; height: 90px; object-fit: contain; }

        /* Step 3: After choosing - highlight the selected stage and image area */
        .step-completed .sidebar-yugto {
            background: #e8f5e9;
            border-right-color: var(--ap-green);
        }

        .step-completed .yugto-kard.selected {
            animation: none;
            background: var(--ap-green);
            border-color: var(--ap-green);
        }

        .step-completed .aksyon-area {
            background: #e8f5e9;
        }

        .step-completed .larawan-grid {
            opacity: 0.6;
            pointer-events: none;
        }

        .step-completed .larawan-item.tama {
            opacity: 1;
            border-color: var(--ap-green);
            background: #c8e6c9;
        }

        /* Step instruction badge */
        .step-badge {
            display: inline-block;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 800;
            background: var(--ap-gold);
            color: white;
            margin-bottom: 10px;
        }

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

    <div class="game-body" id="gameBody">
        <div class="sidebar-yugto" id="sidebarYugto">
            <div class="step-indicator" id="stepIndicator">
                <span class="step-number">1</span> PILIIN ANG YUGTO
            </div>
            
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

        <div class="aksyon-area" id="aksyonArea">
            <div class="ulat-senaryo" id="senaryoDisplay">Naghahanda...</div>
            
            <div class="larawan-grid disabled" id="imageGrid">
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
    let currentStep = 1; // 1=select stage, 2=select image, 3=completed
    let isProcessing = false;

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
            currentStep = 1;
            isProcessing = false;
            resetAll();
            showStep1();
            document.getElementById('puntosValue').innerText = puntos + " / 6";
        } else {
            tapusin();
        }
    }

    function showStep1() {
        // Step 1: Highlight the sidebar (yugto selection)
        document.getElementById('sidebarYugto').classList.add('highlight');
        document.getElementById('aksyonArea').classList.remove('highlight');
        document.getElementById('imageGrid').classList.remove('highlight-select');
        document.getElementById('imageGrid').classList.add('disabled');
        document.getElementById('stepIndicator').innerHTML = '<span class="step-number">1</span> PILIIN ANG YUGTO';
        document.getElementById('gabayTeksto').innerText = "📖 Step 1: Basahin ang sitwasyon at piliin ang tamang Yugto";
        document.getElementById('gameBody').classList.remove('step-completed');
        
        // Highlight stage cards for selection
        document.querySelectorAll('.yugto-kard').forEach(k => {
            k.classList.remove('selected', 'disabled', 'shake');
            if(!k.classList.contains('highlight-select')) {
                k.classList.add('highlight-select');
            }
        });
    }

    function showStep2() {
        // Step 2: Highlight the images for selection
        document.getElementById('sidebarYugto').classList.remove('highlight');
        document.getElementById('aksyonArea').classList.add('highlight');
        document.getElementById('imageGrid').classList.remove('disabled');
        document.getElementById('imageGrid').classList.add('highlight-select');
        document.getElementById('stepIndicator').innerHTML = '<span class="step-number">2</span> PILIIN ANG LARAWAN';
        document.getElementById('gabayTeksto').innerText = "🖼️ Step 2: I-click ang tamang larawan para sa Yugto";
        
        // Remove highlight from stage cards, keep selected highlighted
        document.querySelectorAll('.yugto-kard').forEach(k => {
            k.classList.remove('highlight-select', 'shake');
            if(!k.classList.contains('selected')) {
                k.classList.add('disabled');
            }
        });
    }

    function showStep3() {
        // Step 3: Show completion state
        document.getElementById('gameBody').classList.add('step-completed');
        document.getElementById('stepIndicator').innerHTML = '<span class="step-number">✓</span> TAPOS NA!';
        document.getElementById('gabayTeksto').innerText = "✅ Step 3: Tapos na! Maghintay para sa susunod...";
    }

    function resetAll() {
        document.getElementById('sidebarYugto').classList.remove('highlight');
        document.getElementById('aksyonArea').classList.remove('highlight');
        document.getElementById('imageGrid').classList.remove('highlight-select');
        document.getElementById('imageGrid').classList.add('disabled');
        document.getElementById('gameBody').classList.remove('step-completed');
        
        document.querySelectorAll('.yugto-kard').forEach(k => {
            k.classList.remove('selected', 'disabled', 'highlight-select', 'shake');
        });
        
        document.querySelectorAll('.larawan-item').forEach(k => {
            k.classList.remove('tama', 'shake');
        });
    }

    function piliinAngYugto(y, el) {
        if(isProcessing) return;
        if(currentStep === 3) return;
        if(!laroAktibo) return;
        
        // Check if this is already selected (toggle off)
        if(el.classList.contains('selected')) {
            // Unselect - go back to step 1
            el.classList.remove('selected');
            pilingYugto = null;
            currentStep = 1;
            
            // Reset image grid
            document.getElementById('imageGrid').classList.remove('highlight-select');
            document.getElementById('imageGrid').classList.add('disabled');
            document.getElementById('aksyonArea').classList.remove('highlight');
            
            // Reset all stage cards to highlight-select
            document.querySelectorAll('.yugto-kard').forEach(k => {
                k.classList.remove('disabled', 'shake');
                if(!k.classList.contains('highlight-select')) {
                    k.classList.add('highlight-select');
                }
            });
            
            // Reset image items
            document.querySelectorAll('.larawan-item').forEach(k => {
                k.classList.remove('tama', 'shake');
            });
            
            // Update UI
            document.getElementById('stepIndicator').innerHTML = '<span class="step-number">1</span> PILIIN ANG YUGTO';
            document.getElementById('gabayTeksto').innerText = "📖 Step 1: Basahin ang sitwasyon at piliin ang tamang Yugto";
            document.getElementById('sidebarYugto').classList.add('highlight');
            document.getElementById('gameBody').classList.remove('step-completed');
            
            return;
        }
        
        // Select new yugto
        pilingYugto = y;
        
        // Remove selected class from all
        document.querySelectorAll('.yugto-kard').forEach(k => {
            k.classList.remove('selected', 'shake');
        });
        
        // Add selected class to clicked
        el.classList.add('selected');
        
        // If we were in step 1, move to step 2
        if(currentStep === 1) {
            currentStep = 2;
            showStep2();
        } else if(currentStep === 2) {
            // We're already in step 2, just update the selected stage
            // Re-enable all images for new selection
            document.querySelectorAll('.larawan-item').forEach(k => {
                k.classList.remove('tama', 'shake');
            });
            document.getElementById('imageGrid').classList.add('highlight-select');
            document.getElementById('imageGrid').classList.remove('disabled');
        }
    }

    function suriinAngSagot(imgPhase, el) {
        if(isProcessing) return;
        if(currentStep !== 2 || !laroAktibo || !pilingYugto) {
            // If no stage selected, shake the sidebar to indicate
            document.getElementById('sidebarYugto').classList.add('shake');
            setTimeout(() => {
                document.getElementById('sidebarYugto').classList.remove('shake');
            }, 500);
            return;
        }
        
        // Check if correct
        if(pilingYugto === mgaSenaryo[index].phase && imgPhase === pilingYugto) {
            // Correct!
            isProcessing = true;
            puntos++;
            index++;
            el.classList.add('tama');
            document.getElementById('puntosValue').innerText = puntos + " / 6";
            
            // Show step 3 completion
            currentStep = 3;
            showStep3();
            
            // Move to next level after delay
            setTimeout(() => {
                isProcessing = false;
                loadLevel();
            }, 1500);
        } else {
            // Wrong answer - shake both the selected yugto and the clicked image
            // Find the selected yugto card
            const selectedYugto = document.querySelector('.yugto-kard.selected');
            if(selectedYugto) {
                selectedYugto.classList.add('shake');
                setTimeout(() => {
                    selectedYugto.classList.remove('shake');
                }, 500);
            }
            
            // Shake the clicked image
            el.classList.add('shake');
            setTimeout(() => {
                el.classList.remove('shake');
            }, 500);
            
            // Reset the image grid highlight briefly to show feedback
            document.getElementById('imageGrid').classList.remove('highlight-select');
            setTimeout(() => {
                document.getElementById('imageGrid').classList.add('highlight-select');
            }, 500);
        }
    }

    async function tapusin() {
        laroAktibo = false;
        const orasNatapos = new Date();
        const timeSpent = Math.floor((orasNatapos - simulaOras) / 1000);

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