{{-- filepath: resources/views/Students/Module 3/Eco_Tycoon.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Eco-Tycoon: Modyul 3')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        /* BACKGROUND OVERLAY - Consistent with next page */
        .page-bg {
            position: fixed;
            inset: 0;
            background: url('{{ asset('pictures/mod3_innermap.png') }}') center center / cover no-repeat;
            pointer-events: none;
            z-index: 0;
        }

        .page-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            pointer-events: none;
            z-index: 1;
        }

        /* Body styles - match first page */
        html, body { 
            background: #0b1220 !important;
            margin: 0; 
            padding: 0;
            font-family: 'Quicksand', sans-serif;
            color: #1a1a1a;
            position: relative;
            overflow-x: hidden;
        }

        /* Content wrapper needs higher z-index to appear above overlay */
        .game-wrapper { 
            max-width: 1100px; 
            margin: 40px auto; 
            padding: 0 20px; 
            position: relative; 
            z-index: 2;
        }

        :root {
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --wood-dark: #3d2b1f;
            --berde-mid: #2e7d32;
            --berde: #4caf50;
            --pula: #e53935;
        }

        /* WOODEN CARD STYLING - Matching first page */
        .wood-frame {
            background: #d9c5a3 !important;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png') !important;
            border: 2px solid #c5a059 !important;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
            padding: 40px 30px;
            position: relative;
            color: #1a1a1a;
        }

        .context-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        /* Green cards inside - keep them but adjust to fit the wood theme */
        .wood-card {
            background: var(--berde-mid);
            background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 100% 10px;
            border: 3px solid var(--wood-dark);
            border-radius: 12px;
            padding: 25px 15px;
            position: relative;
            box-shadow: 0 6px 0 var(--wood-dark);
            transition: transform 0.2s;
            text-align: center;
            display: flex;
            flex-direction: column;
            color: var(--old-paper);
        }

        .wood-card:hover { transform: translateY(-5px); }
        
        .card-icon {
            font-size: 2.5rem;
            background: var(--old-paper);
            width: 60px; height: 60px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: -50px auto 15px;
            border: 3px solid var(--wood-dark);
            color: var(--wood-dark);
        }

        .wood-card h4 { 
            font-family: 'Fondamento', cursive; 
            font-size: 1.4rem; 
            margin: 5px 0;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .law-tag {
            background: var(--wood-dark);
            font-size: 0.75rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: inline-block;
            color: var(--old-paper);
        }

        .wood-card p { font-size: 0.9rem; line-height: 1.4; color: var(--old-paper); font-weight: 500; margin: 0; }

        .instruction-box {
            background: rgba(255, 255, 255, 0.85);
            border: 3px dashed var(--wood-dark);
            padding: 20px;
            border-radius: 12px;
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
            color: #1a1a1a;
        }

        .instruction-box h5 {
            margin-top: 0;
            color: var(--wood-dark);
            font-weight: 800;
            text-align: center;
            font-size: 1.2rem;
            text-transform: uppercase;
        }

        .instruction-box ul { padding-left: 20px; margin-bottom: 0; }
        .instruction-box li { margin-bottom: 8px; font-size: 0.95rem; font-weight: 600; }

        .wood-hud {
            display: flex; justify-content: space-around;
            background: rgba(0,0,0,0.25);
            border-radius: 50px;
            padding: 15px;
            margin-bottom: 25px;
            border: 2px solid var(--gold-trim);
        }

        .hud-item { 
            color: #1a1a1a; 
            font-weight: 800; 
            font-size: 1.1rem;
        }

        .btn-wood {
            background: #8d6e63;
            color: white;
            border: 3px solid var(--wood-dark);
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 800;
            font-family: 'Fondamento', cursive;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 5px 0 var(--wood-dark);
            text-decoration: none;
            display: inline-block;
            transition: 0.1s;
        }

        .btn-wood:active { transform: translateY(3px); box-shadow: 0 2px 0 var(--wood-dark); }
        .btn-green { background: var(--berde); }
        .btn-pula { background: var(--pula); }

        .choice-btn {
            background: var(--old-paper);
            border: 3px solid var(--wood-dark);
            padding: 20px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 1.1rem;
            box-shadow: 0 5px 0 var(--wood-dark);
            transition: 0.2s;
            color: var(--wood-dark);
        }

        .choice-btn:hover { background: #efe0b1; transform: translateY(-2px); }
        .choice-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .nakatago { display: none !important; }

        #eventArea {
            background: rgba(255, 255, 255, 0.85) !important;
            padding: 40px !important;
            border-radius: 12px !important;
            border: 2px solid var(--gold-trim) !important;
            min-height: 320px;
            text-align: center;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
            color: #1a1a1a;
        }

        #eventTitle {
            font-family: 'Fondamento', cursive;
            font-size: 2.2rem;
            margin-top: 0;
            color: #1a1a1a;
        }

        #eventDesc {
            font-size: 1.25rem;
            margin: 20px 0;
            line-height: 1.5;
            color: #1a1a1a;
        }

        .victory-text, .gameover-text {
            color: #fff !important;
            text-shadow: 3px 3px 0 #000;
        }

        @media (max-width: 768px) {
            .context-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .wood-frame {
                padding: 20px 15px;
            }
            #choicesGrid {
                grid-template-columns: 1fr !important;
            }
            .wood-hud {
                flex-wrap: wrap;
                gap: 10px;
                border-radius: 20px;
            }
        }
    </style>
@endpush

@section('content')
{{-- Background Elements - Consistent with next page --}}
<div class="page-bg"></div>
<div class="page-overlay"></div>

<div class="game-wrapper">
    <div class="wood-frame">
        <div id="briefingScreen">
            <h1 style="text-align:center; font-family: 'Fondamento', cursive; font-size: 3rem; margin-bottom: 60px; color: #1a1a1a; text-shadow: 2px 2px 0 rgba(197,160,89,0.3);">
                📜 Balik Aral: Batas at Kalikasan
            </h1>

            <div class="context-grid">
                <div class="wood-card">
                    <div class="card-icon">♻️</div>
                    <span class="law-tag">R.A. 9003</span>
                    <h4>Solid Waste</h4>
                    <p>Ang <i>Ecological Solid Waste Management Act</i> ay nag-uutos ng wastong pagbubukod (segregation) ng basura sa tahanan.</p>
                </div>
                <div class="wood-card">
                    <div class="card-icon">🌳</div>
                    <span class="law-tag">P.D. 705</span>
                    <h4>Deforestation</h4>
                    <p>Ang <i>Revised Forestry Code</i> ay nagbabawal sa illegal logging at naghihikayat sa reforestation upang iwas-baha.</p>
                </div>
                <div class="wood-card">
                    <div class="card-icon">🌡️</div>
                    <span class="law-tag">R.A. 9729</span>
                    <h4>Climate Change</h4>
                    <p>Sa ilalim ng <i>Climate Change Act</i>, layunin ng bansa na bawasan ang carbon emissions at lumipat sa Clean Energy.</p>
                </div>
            </div>

            <div class="instruction-box">
                <h5>Paano Maglaro:</h5>
                <ul>
                    <li>Magpasya batay sa mga sitwasyong pang-kalikasan.</li>
                    <li>Panatilihing mataas ang <b>🌿 Kalusugan</b> ng bayan at <b>🤝 Tiwala</b> ng tao.</li>
                    <li>Huwag hayaang maubos ang iyong <b>💰 Pondo</b> (₱70,000).</li>
                    <li>Piliin ang opsyong sumusunod sa tamang batas para manalo!</li>
                </ul>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <button class="btn-wood btn-green" style="padding: 15px 50px; font-size: 1.5rem;" onclick="startGame()">Simulan ang Simulation</button>
            </div>
        </div>

        <div id="gameUI" class="nakatago">
            <div class="wood-hud">
                <div class="hud-item">🌿 Kalusugan: <span id="healthTxt">100%</span></div>
                <div class="hud-item">💰 Pondo: <span id="budgetTxt" style="color: #2e7d32;">₱70,000</span></div>
                <div class="hud-item">🤝 Tiwala: <span id="trustTxt">80%</span></div>
            </div>

            <div id="eventArea">
                <div id="statusMsg" style="margin-bottom: 20px; font-weight: 800; display: none; padding: 12px; border-radius: 8px; border: 2px solid currentColor;"></div>
                <h2 id="eventTitle"></h2>
                <p id="eventDesc"></p>
                <div id="choicesGrid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;"></div>
            </div>
        </div>

        <div id="victoryScreen" class="nakatago" style="text-align:center; padding: 40px 0;">
            <h1 class="victory-text" style="font-family: 'Fondamento', cursive; font-size: 4rem; margin: 0;">Tagumpay! 🏆</h1>
            <p class="victory-text" style="font-size: 1.6rem; margin: 20px 0 40px;">Mahusay! Sinunod mo ang batas para sa ikabubuti ng bayan.</p>
            <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
                <button class="btn-wood" onclick="location.reload()">Ulitin</button>
                <button class="btn-wood btn-green" onclick="window.location.href='{{ route('module3.iv_explore') }}'">Magpatuloy</button>
            </div>
        </div>

        <div id="gameOverScreen" class="nakatago" style="text-align:center; padding: 40px 0;">
            <h1 class="gameover-text" style="font-family: 'Fondamento', cursive; font-size: 4rem; margin: 0;">Talunan 💀</h1>
            <p id="failReason" class="gameover-text" style="font-size: 1.6rem; margin: 20px 0 40px;"></p>
            <button class="btn-wood btn-pula" style="font-size: 1.5rem;" onclick="location.reload()">Ulitin (Retry)</button>
        </div>
    </div>
</div>

<x-vn />

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    let stats = { health: 100, budget: 70000, trust: 80 };
    let currentIdx = 0;

    const gameEvents = [
        {
            title: "Krisis sa Basura",
            desc: "Nagreklamo ang mga tao dahil sa tambak na basura sa kalsada. Ano ang plano mo?",
            choices: [
                { text: "Ipatupad ang Waste Segregation (RA 9003)", cost: 10000, h: 20, t: 10, msg: "Tama! Ang RA 9003 ay nag-uutos ng pagbubukod ng basura sa tahanan." },
                { text: "Hayaan na lang sunugin ang basura", cost: 0, h: -40, t: -20, msg: "Mali! Ang pagsusunog ay labag sa Clean Air Act at sanhi ng Climate Change." }
            ]
        },
        {
            title: "Banta ng Landslide",
            desc: "Dahil sa Deforestation, nanganganib ang komunidad sa landslide tuwing uulan.",
            choices: [
                { text: "Magsagawa ng Reforestation (PD 705)", cost: 20000, h: 30, t: 15, msg: "Mahusay! Ang mga puno ay humahawak sa lupa ayon sa Forestry Code." },
                { text: "Magpatayo ng pader (Sea Wall)", cost: 15000, h: -10, t: 5, msg: "Medyo tama, pero hindi nito tinutugunan ang pagkalbo ng gubat." }
            ]
        },
        {
            title: "Enerhiya ng Bayan",
            desc: "Kailangan ng kuryente. May murang Coal Plant na iaalok para sa bayan.",
            choices: [
                { text: "Mag-Solar Power (Clean Energy)", cost: 35000, h: 25, t: 10, msg: "Tumpak! Ang Renewable Energy ay mas ligtas laban sa Climate Change." },
                { text: "Payagan ang Coal Plant", cost: 10000, h: -50, t: 15, msg: "Mali! Ang uling ay naglalabas ng carbon na nagpapainit sa mundo." }
            ]
        }
    ];

    function updateHUD() {
        const displayBudget = stats.budget < 0 ? 0 : stats.budget;
        const displayHealth = stats.health < 0 ? 0 : stats.health;
        document.getElementById('healthTxt').textContent = displayHealth + "%";
        document.getElementById('budgetTxt').textContent = "₱" + displayBudget.toLocaleString();
        document.getElementById('trustTxt').textContent = stats.trust + "%";
    }

    function startGame() {
        document.getElementById('briefingScreen').classList.add('nakatago');
        document.getElementById('gameUI').classList.remove('nakatago');
        updateHUD();
        loadEvent();
    }

    function loadEvent() {
        if(currentIdx >= gameEvents.length) { 
            if(stats.health >= 50 && stats.budget >= 0) endGame(true); 
            else endGame(false, "Hindi sapat ang iyong ginawa para maisalba ang bayan.");
            return; 
        }
        const ev = gameEvents[currentIdx];
        document.getElementById('eventTitle').textContent = ev.title;
        document.getElementById('eventDesc').textContent = ev.desc;
        const grid = document.getElementById('choicesGrid');
        grid.innerHTML = '';
        ev.choices.forEach(c => {
            const btn = document.createElement('button');
            btn.className = 'choice-btn';
            btn.innerHTML = `${c.text}<br><small style="color:#795548; font-size:0.85rem">Gastos: ₱${c.cost.toLocaleString()}</small>`;
            btn.onclick = () => handleChoice(c);
            grid.appendChild(btn);
        });
        document.querySelectorAll('.choice-btn').forEach(b => b.disabled = false);
    }

    function handleChoice(c) {
        const msg = document.getElementById('statusMsg');
        msg.style.display = 'block';
        msg.textContent = c.msg;
        msg.style.background = c.h > 0 ? '#c8e6c9' : '#ffcdd2';
        msg.style.color = c.h > 0 ? '#2e7d32' : '#c62828';
        msg.style.borderColor = c.h > 0 ? '#2e7d32' : '#c62828';
        stats.health = Math.min(100, stats.health + c.h);
        stats.budget -= c.cost;
        stats.trust = Math.min(100, stats.trust + c.t);
        updateHUD();
        document.querySelectorAll('.choice-btn').forEach(b => b.disabled = true);
        setTimeout(() => {
            msg.style.display = 'none';
            if (stats.health <= 0) endGame(false, "Tuluyang nasira ang ekosistema ng bayan.");
            else if (stats.budget < 0) endGame(false, "Naubos ang pondo dahil sa maling pamamahala.");
            else { currentIdx++; loadEvent(); }
        }, 3000);
    }

    function endGame(win, reason) {
        document.getElementById('gameUI').classList.add('nakatago');

        saveGameResult(win);

        if(win) document.getElementById('victoryScreen').classList.remove('nakatago');
        else {
            document.getElementById('gameOverScreen').classList.remove('nakatago');
            document.getElementById('failReason').textContent = reason;
        }
    }

    function saveGameResult(isWin) {
        fetch("{{ route('student.module3.balikaral.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                health: stats.health,
                budget: stats.budget,
                trust: stats.trust,
                is_success: isWin,
                time_spent: 0
            })
        })
        .then(res => res.json())
        .then(data => console.log("Saved:", data))
        .catch(err => console.error(err));
    }

    document.addEventListener("DOMContentLoaded", function () {
        const dialogueKey = "module3_balikaral";
        if (!hasSeen(dialogueKey)) {
            startDialogue([
                {
                    text: "Magaling! Narating mo na ang Ikatlong Modyul! Bago tayo magpatuloy, balikan muna natin ang mga natutuhan mo sa nakaraang modyul. May inihanda kaming maikling gawain upang makita kung naaalala mo pa ang mahahalagang konsepto.",
                    name: "Mga Guro",
                    image: "{{ asset('pictures/vn_box_teacher2.png') }}"
                },
                {
                    text: "Basahin nang mabuti ang bawat panuto at pag-isipan ang iyong mga sagot. Huwag mag-alala kung may makalimutan—bahagi ito ng pagkatuto. Maaari mo ring ulitin ang gawaing ito pagkatapos, kung nais mong mas mapabuti pa ang iyong resulta.",
                    image: "{{ asset('pictures/vn_box_teacher2.png') }}"
                },
                {
                    text: "Kaya mo yan! Simulan na natin.",
                    image: "{{ asset('pictures/vn_box_teacher3.png') }}"
                }
            ], dialogueKey);
        }
    });
</script>
@endsection