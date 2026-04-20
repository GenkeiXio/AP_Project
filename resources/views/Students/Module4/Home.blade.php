@extends('Students.studentslayout')
@section('title', 'Modyul 4 - Home')

@push('styles')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Nunito:wght@600;700;800&family=Fredoka:wght@500;600;700&display=swap');

        :root{
            --bg1:#ecfff3;
            --bg2:#d8f4e4;
            --bg3:#eef2ff;

            --text:#173c2a;
            --muted:#4f6d5e;
            --line:#d1e9da;
            --shadow:0 18px 40px rgba(16,77,46,.14);

            --green:#2f9f5a;
            --green-dark:#1f7a45;
            --blue:#3f8cff;
            --orange:#ff9f43;
            --purple:#8f67ff;
            --pink:#ff6ea6;
            --gold:#ffca45;
        }

        *{ box-sizing:border-box; }

        body{
            margin:0;
            color:var(--text);
            font-family:'Poppins',sans-serif;
            background:
                radial-gradient(circle at 10% 0%, #ffffff 0%, var(--bg1) 28%, var(--bg2) 100%),
                radial-gradient(circle at 90% 15%, #edf2ff 0%, transparent 40%),
                radial-gradient(circle at 12% 90%, #fff0f7 0%, transparent 33%);
            min-height:100vh;
        }

        .wrap{
            max-width:1150px;
            margin:26px auto;
            padding:0 16px 28px;
        }

        .view{ display:none; }
        .view.active{ display:block; animation:fadeIn .3s ease; }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(8px); }
            to{ opacity:1; transform:translateY(0); }
        }

        .hero{
            position:relative;
            overflow:hidden;
            border:1px solid var(--line);
            border-radius:24px;
            background:linear-gradient(145deg,#ffffff,#f5fff9,#fbfffe);
            box-shadow:var(--shadow);
            padding:26px;
        }

        .hero::before,
        .hero::after{
            content:'';
            position:absolute;
            border-radius:50%;
            pointer-events:none;
        }
        .hero::before{
            width:230px;height:230px;
            top:-100px;right:-80px;
            background:radial-gradient(circle, rgba(143,103,255,.18), transparent 70%);
        }
        .hero::after{
            width:190px;height:190px;
            left:-80px;bottom:-80px;
            background:radial-gradient(circle, rgba(255,110,166,.16), transparent 70%);
        }

        .badge{
            display:inline-flex; align-items:center; gap:8px;
            border:1px solid #bfe3cc;
            background:linear-gradient(135deg,#e9fdf0,#f4fffa);
            color:#14653b;
            border-radius:999px;
            padding:8px 13px;
            font-weight:800;
            font-size:.84rem;
            letter-spacing:.2px;
            box-shadow:0 6px 14px rgba(47,159,90,.14);
            font-family:'Nunito',sans-serif;
        }

        h1{
            margin:12px 0 10px;
            font-size:clamp(1.25rem,2.4vw,2rem);
            line-height:1.34;
            color:#184a32;
            font-weight:800;
            font-family:'Fredoka','Nunito',sans-serif;
            letter-spacing:.2px;
        }

        .subtitle{
            margin:0;
            color:var(--muted);
            font-size:.98rem;
        }

        .actions{
            margin-top:18px;
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }

        .btn{
            border:none;
            border-radius:12px;
            padding:11px 16px;
            font-weight:800;
            font-family:'Nunito',sans-serif;
            cursor:pointer;
            transition:.2s ease;
            letter-spacing:.2px;
        }
        .btn:hover{ transform:translateY(-2px); }

        .btn-main{
            color:#fff;
            background:linear-gradient(135deg,var(--green),var(--green-dark));
            box-shadow:0 10px 20px rgba(47,159,90,.3);
        }

        .btn-soft{
            color:#1c5b3a;
            border:1px solid #d3e8dc;
            background:linear-gradient(135deg,#f5fffa,#edf4ff);
        }

        .btn:disabled{
            opacity:.62;
            cursor:not-allowed;
            transform:none !important;
        }

        .cards{
            margin-top:18px;
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:12px;
        }

        .card{
            border-radius:16px;
            padding:15px;
            border:1px solid #d7e8de;
            box-shadow:0 8px 18px rgba(0,0,0,.06);
            transition:.2s ease;
        }
        .card:hover{
            transform:translateY(-3px);
            box-shadow:0 14px 24px rgba(0,0,0,.11);
        }
        .card .icon{ font-size:1.5rem; }
        .card h4{
            margin:8px 0 4px;
            font-size:.98rem;
            font-family:'Nunito',sans-serif;
            color:#1f4f36;
        }
        .card p{ margin:0; font-size:.88rem; color:#2f5945; }

        .card-1{ background:linear-gradient(135deg,#e9fff3,#cff6de); border-left:6px solid var(--green-dark); }
        .card-2{ background:linear-gradient(135deg,#eaf2ff,#d9e7ff); border-left:6px solid var(--blue); }
        .card-3{ background:linear-gradient(135deg,#fff2e8,#ffdcbf); border-left:6px solid var(--orange); }

        /* Poll */
        .poll-page{
            min-height:78vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .poll-card{
            width:min(1040px,100%);
            border:1px solid var(--line);
            border-radius:22px;
            background:linear-gradient(180deg,#ffffff,#fbfffd);
            box-shadow:var(--shadow);
            padding:18px;
            position:relative;
            overflow:hidden;
        }

        .poll-card::before,
        .poll-card::after{
            content:'';
            position:absolute;
            border-radius:50%;
            pointer-events:none;
        }
        .poll-card::before{
            width:260px;height:260px;
            right:-120px;top:-120px;
            background:radial-gradient(circle, rgba(255,202,69,.27), transparent 70%);
        }
        .poll-card::after{
            width:240px;height:240px;
            left:-120px;bottom:-120px;
            background:radial-gradient(circle, rgba(63,140,255,.2), transparent 70%);
        }

        .poll-top{
            position:relative;
            z-index:1;
            display:grid;
            grid-template-columns:1.2fr .8fr;
            gap:12px;
            margin-bottom:12px;
        }

        .poll-title-box{
            border:1px solid #d8ebdf;
            border-radius:14px;
            background:linear-gradient(135deg,#ffffff,#f2fff8);
            padding:12px;
        }

        .poll-title{
            margin:0 0 6px;
            font-size:1.2rem;
            font-family:'Fredoka','Nunito',sans-serif;
            color:#1f4f36;
        }

        .poll-q{
            margin:0;
            color:#315744;
            line-height:1.5;
            font-size:.94rem;
        }

        .poll-score{
            border:1px solid #ebddb0;
            border-radius:14px;
            background:linear-gradient(135deg,#fffdf5,#fff7d9);
            padding:12px;
        }

        .score-line{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:8px;
            color:#735900;
            font-size:.88rem;
            font-weight:800;
            font-family:'Nunito',sans-serif;
        }

        .star-row{
            display:flex;
            gap:4px;
            margin-bottom:8px;
            font-size:1.18rem;
            line-height:1;
        }

        .star{ color:#d4d4d4; transition:.2s ease; }
        .star.on{
            color:var(--gold);
            text-shadow:0 0 10px rgba(255,196,0,.35);
        }

        .progress-track{
            width:100%;
            height:10px;
            border-radius:999px;
            background:#eee3be;
            overflow:hidden;
        }

        .progress-fill{
            width:0%;
            height:100%;
            background:linear-gradient(90deg,#ffdb72,#ffb92f);
            transition:width .25s ease;
        }

        .poll-toolbar{
            display:flex;
            justify-content:flex-end;
            gap:8px;
            flex-wrap:wrap;
            margin:10px 0 12px;
        }

        .tool-btn{
            border:1px solid #d3e8dc;
            background:linear-gradient(135deg,#f1fff7,#edf3ff);
            color:#1c5b3a;
            border-radius:10px;
            padding:8px 12px;
            font-weight:800;
            font-family:'Nunito',sans-serif;
            cursor:pointer;
            transition:.2s ease;
        }
        .tool-btn:hover{
            transform:translateY(-1px);
            border-color:#b9ddca;
        }

        .poll-grid{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:14px;
        }

        .poll-item{
            position:relative;
            border:1px solid #d8eadf;
            border-radius:16px;
            background:#fff;
            overflow:hidden;
            cursor:pointer;
            transition:.2s ease;
            box-shadow:0 7px 16px rgba(0,0,0,.05);
            display:block;
        }
        .poll-item:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 22px rgba(20,90,55,.11);
        }

        .poll-item:nth-child(1){ border-top:4px solid #48b06f; }
        .poll-item:nth-child(2){ border-top:4px solid #4f90ff; }
        .poll-item:nth-child(3){ border-top:4px solid #986cf8; }
        .poll-item:nth-child(4){ border-top:4px solid #ff9d4b; }

        .poll-item input{
            position:absolute;
            opacity:0;
            pointer-events:none;
        }

        .poll-media{
            width:100%;
            height:235px;
            background:#eaf7ef;
            border-bottom:1px solid #d9ecdf;
            overflow:hidden;
        }

        .poll-media img{
            width:100%;
            height:100%;
            object-fit:cover;
            object-position:center;
            display:block;
        }

        .poll-content{
            padding:12px 12px 14px;
            display:flex;
            align-items:flex-start;
            gap:10px;
        }

        .poll-text{ flex:1; min-width:0; }

        .poll-text strong{
            display:block;
            margin:0 0 4px;
            color:#1f4d35;
            font-size:.95rem;
            font-family:'Nunito',sans-serif;
        }

        .poll-text span{
            color:#496856;
            font-size:.84rem;
            line-height:1.45;
        }

        .chip{
            display:inline-flex;
            margin-top:8px;
            border-radius:999px;
            padding:4px 8px;
            font-size:.72rem;
            font-weight:800;
            font-family:'Nunito',sans-serif;
            border:1px solid #d8eadf;
            color:#2b5f43;
            background:#f2fcf6;
        }
        .poll-item:nth-child(2) .chip{ background:#edf4ff; border-color:#d6e5ff; color:#2d5eb9; }
        .poll-item:nth-child(3) .chip{ background:#f6efff; border-color:#e5d9ff; color:#6a45c5; }
        .poll-item:nth-child(4) .chip{ background:#fff2ea; border-color:#ffd9c7; color:#b05d2f; }

        .poll-checkmark{
            margin-left:auto;
            width:26px;height:26px;
            border-radius:8px;
            border:2px solid #c7dfd2;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-size:.82rem;
            transition:.2s ease;
            flex-shrink:0;
        }

        .poll-item.checked{
            border-color:#8dd2ad;
            background:linear-gradient(135deg,#f0fff6,#e9fbf1);
            box-shadow:0 14px 24px rgba(47,159,90,.18);
        }

        .poll-item.checked .poll-checkmark{
            border-color:var(--green);
            background:var(--green);
        }

        .check-chip{
            position:absolute;
            top:10px;
            right:10px;
            display:none;
            border-radius:999px;
            padding:4px 8px;
            font-size:.72rem;
            font-weight:800;
            font-family:'Nunito',sans-serif;
            color:#176e3f;
            border:1px solid #ccebd8;
            background:#ecfff3;
        }
        .poll-item.checked .check-chip{ display:inline-flex; }

        .poll-actions{
            margin-top:14px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .poll-hint{
            margin:0;
            color:#355d49;
            font-size:.85rem;
            font-weight:700;
        }

        /* Modal */
        .modal{
            position:fixed;
            inset:0;
            display:none;
            align-items:center;
            justify-content:center;
            padding:16px;
            z-index:999;
            background:rgba(8,28,19,.58);
            backdrop-filter:blur(4px);
        }
        .modal.show{ display:flex; }

        .modal-card{
            width:min(650px,96%);
            max-height:85vh;
            overflow-y:auto;
            border-radius:20px;
            border:1px solid var(--line);
            background:linear-gradient(180deg,#ffffff,#f7fffb);
            box-shadow:0 25px 50px rgba(0,0,0,.24);
            padding:24px 20px;
        }

        /* Goal Cards */
        .goal-card {
            display: flex;
            gap: 15px;
            align-items: flex-start;

            background: linear-gradient(135deg, #f8fff8, #eef7ee);
            border-radius: 15px;
            padding: 16px;
            margin-bottom: 15px;

            border-left: 6px solid #2e7d32;

            transition: 0.2s;
            text-align: left;
        }

        .goal-card:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .goal-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 1.5rem;

            width: 45px;
            height: 45px;

            background: #2e7d32;
            color: white;

            border-radius: 12px;

            flex-shrink: 0;
        }

        .goal-card h3 {
            margin: 0 0 5px;
            font-size: 1rem;
            font-weight: 800;
            color: #1b5e20;
            font-family: 'Nunito', sans-serif;
        }

        .goal-card p {
            font-size: 0.95rem;
            color: #333;
            margin: 0;
        }

        .goal-list {
            padding-left: 0;
            list-style: none;
            margin: 5px 0 0;
        }

        .goal-list li {
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: #333;
        }

        .modal-title {
            text-align: center;
            font-family: 'Fredoka', 'Nunito', sans-serif;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #1a4c32;
        }

        .modal-actions{
            margin-top:20px;
            display:flex;
            justify-content:center;
        }

        .btn-full {
            width: 100%;
            text-align: center;
            justify-content: center;
            padding: 14px 20px;
            font-size: 1.1rem;
        }

        @media (max-width:860px){
            .cards{ grid-template-columns:1fr; }
            .poll-grid{ grid-template-columns:1fr; }
            .poll-top{ grid-template-columns:1fr; }
            .poll-media{ height:230px; }
        }
    </style>
@endpush

@section('content')
<div class="wrap">
    <div class="view active" id="homeView">
        <section class="hero">
            <span class="badge">🌍 Modyul 4</span>
            <h1>Kahalagahan ng Kahandaan, Disiplina at Kooperasyon sa Pagtugon sa mga Hamong Pangkapaligiran</h1>
            <p class="subtitle">Basahin muna ang mga layunin sa popup. Pagkatapos, pindutin ang <strong>Simulan</strong> upang pumunta sa susunod na bahagi.</p>

            <div class="actions">
                <button type="button" class="btn btn-soft" id="openGoalsBtn">📘 Mga Layunin</button>
                <button type="button" class="btn btn-main" id="startBtn" disabled>🔒 Simulan</button>
            </div>

            <div class="cards">
                <article class="card card-1">
                    <div class="icon">🛡️</div>
                    <h4>Kahandaan</h4>
                    <p>Palaging handa sa sakuna at may malinaw na plano para sa kaligtasan ng komunidad.</p>
                </article>
                <article class="card card-2">
                    <div class="icon">📏</div>
                    <h4>Disiplina</h4>
                    <p>Wastong pagsunod sa batas pangkalikasan at maayos na pamamahala ng basura.</p>
                </article>
                <article class="card card-3">
                    <div class="icon">🤝</div>
                    <h4>Kooperasyon</h4>
                    <p>Pakikiisa ng mamamayan, barangay, at pamahalaan para sa iisang layunin.</p>
                </article>
            </div>
        </section>
    </div>

    <div class="view" id="pollView">
        <section class="poll-page">
            <div class="poll-card">
                <div class="poll-top">
                    <div class="poll-title-box">
                        <h1 class="poll-title">🎯 Tanong</h1>
                        <p class="poll-q">Sa iyong komunidad, alin sa mga sumusunod ang pinakamahalagang ginagawa upang makatulong sa pagtugon sa mga suliraning pangkapaligiran?</p>
                    </div>

                    <div class="poll-score">
                        <div class="score-line">
                            <span id="selectedCount">Napili: 0/4</span>
                            <span id="selectedPercent">0%</span>
                        </div>
                        <div class="star-row" id="starRow" aria-label="stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" id="pollMeterFill"></div>
                        </div>
                    </div>
                </div>

                <div class="poll-toolbar">
                    <button type="button" class="tool-btn" id="selectAllPollBtn">✅ Piliin Lahat</button>
                    <button type="button" class="tool-btn" id="clearPollBtn">↺ I-reset</button>
                </div>

                <div class="poll-grid">
                    <label class="poll-item" for="o1">
                        <input type="checkbox" id="o1" class="poll-check">
                        <span class="check-chip">✔ Napili</span>
                        <div class="poll-media">
                            <img src="{{ asset('pictures/Community cleanup along a residential street.png') }}" alt="Clean-up drive">
                        </div>
                        <div class="poll-content">
                            <div class="poll-text">
                                <strong>Clean-up Drive</strong>
                                <span>Pakikilahok sa clean-up drive at tamang pagtatapon ng basura.</span>
                                <span class="chip">Gawaing Komunidad</span>
                            </div>
                            <span class="poll-checkmark">✓</span>
                        </div>
                    </label>

                    <label class="poll-item" for="o2">
                        <input type="checkbox" id="o2" class="poll-check">
                        <span class="check-chip">✔ Napili</span>
                        <div class="poll-media">
                            <img src="{{ asset('pictures/Community tree planting in progress.png') }}" alt="Pagtatanim ng puno">
                        </div>
                        <div class="poll-content">
                            <div class="poll-text">
                                <strong>Pagtatanim ng Puno</strong>
                                <span>Pagtatanim ng puno at pangangalaga sa kalikasan.</span>
                                <span class="chip">Pangmatagalang Solusyon</span>
                            </div>
                            <span class="poll-checkmark">✓</span>
                        </div>
                    </label>

                    <label class="poll-item" for="o3">
                        <input type="checkbox" id="o3" class="poll-check">
                        <span class="check-chip">✔ Napili</span>
                        <div class="poll-media">
                            <img src="{{ asset('pictures/paghahanda.png') }}" alt="Kahandaan sa sakuna">
                        </div>
                        <div class="poll-content">
                            <div class="poll-text">
                                <strong>Kahandaan sa Sakuna</strong>
                                <span>Pagsunod sa mga babala at paghahanda sa sakuna.</span>
                                <span class="chip">Kaligtasan</span>
                            </div>
                            <span class="poll-checkmark">✓</span>
                        </div>
                    </label>

                    <label class="poll-item" for="o4">
                        <input type="checkbox" id="o4" class="poll-check">
                        <span class="check-chip">✔ Napili</span>
                        <div class="poll-media">
                            <img src="{{ asset('pictures/Pakikiisa_Mamayanan.png') }}" alt="Pakikiisa sa programa">
                        </div>
                        <div class="poll-content">
                            <div class="poll-text">
                                <strong>Pakikiisa sa Programa</strong>
                                <span>Pakikiisa sa mga programa ng barangay at pamahalaan.</span>
                                <span class="chip">Kooperasyon</span>
                            </div>
                            <span class="poll-checkmark">✓</span>
                        </div>
                    </label>
                </div>

                <div class="poll-actions">
                    <p class="poll-hint" id="pollHint">Pumili ng kahit isa para magpatuloy.</p>
                    <div style="display:flex; gap:10px; flex-wrap:wrap;">
                        <button type="button" class="btn btn-soft" id="backToHomeBtn">← Bumalik</button>
                        <button type="button" class="btn btn-main" id="proceedBtn" disabled>Magpatuloy ➜</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- MODAL -->
<div class="modal" id="goalsModal">
    <div class="modal-card">
        <h2 class="modal-title">🎯 Mga Layunin</h2>

        <div class="goal-card">
            <div class="goal-icon">📘</div>
            <div>
                <h3>Pamantayang Pangnilalaman</h3>
                <p>Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">📒</div>
            <div>
                <h3>Pamantayan sa Pagganap</h3>
                <p>Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🌱</div>
            <div>
                <h3>Kasanayan sa Pagkatuto</h3>
                <p>Nasusuri ang kahalagahan ng kahandaan, disiplina at kooperasyon sa pagtugon sa mga hamong pangkapaligiran. (MELC4)</p>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">🎯</div>
            <div>
                <h3>Mga Tiyak na Layunin</h3>
                <ul class="goal-list">
                    <li>✔ Nailalarawan ang kasalukuyang kalagayan, suliranin at mga pagtugon sa isyung pangkapaligiran ng Pilipinas;</li>
                    <li>✔ Nailalahad at nasusuri ang mga epekto ng mga suliranin at isyung pangkapaligirang kinakaharap ng Pilipinas at sa ibang panig ng daigdig sa kasalukuyang panahon;</li>
                    <li>✔ Napahahalagahan ang kahalagahan ng pakikiisa at pakikibahagi ng lahat sa pagsugpo sa mga hamong pangkapaligiran sa mga lokal na pamahalaan sa Pilipinas maging sa ibang panig ng daigdig;</li>
                    <li>✔ Nakabubuo ng isang malikhain at makabuluhang panukalang proyekto na makakatulong sa pangangalaga ng kalikasan.</li>
                </ul>
            </div>
        </div>

        <div class="goal-card">
            <div class="goal-icon">✅</div>
            <div>
                <h3>Paksang Aralin</h3>
                <ul class="goal-list">
                    <li>1. Kalagayan at Suliranin sa mga Isyung Pangkapaligiran sa Pilipinas</li>
                    <li>2. Pagtugon sa mga Isyung Pangkapaligiran sa Pilipinas</li>
                </ul>
            </div>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn btn-main btn-full" id="unlockStartBtn">Naintindihan Ko ✅</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const pollSaveUrl = "{{ route('student.module4.poll.save') }}";

    const homeView = document.getElementById('homeView');
    const pollView = document.getElementById('pollView');

    const goalsModal = document.getElementById('goalsModal');
    const openGoalsBtn = document.getElementById('openGoalsBtn');
    const unlockStartBtn = document.getElementById('unlockStartBtn');

    const startBtn = document.getElementById('startBtn');
    const backToHomeBtn = document.getElementById('backToHomeBtn');
    const proceedBtn = document.getElementById('proceedBtn');

    const checks = document.querySelectorAll('.poll-check');
    const pollItems = document.querySelectorAll('.poll-item');
    const selectedCount = document.getElementById('selectedCount');
    const selectedPercent = document.getElementById('selectedPercent');
    const pollMeterFill = document.getElementById('pollMeterFill');
    const pollHint = document.getElementById('pollHint');
    const selectAllPollBtn = document.getElementById('selectAllPollBtn');
    const clearPollBtn = document.getElementById('clearPollBtn');
    const stars = document.querySelectorAll('#starRow .star');

    function showView(view) {
        homeView.classList.remove('active');
        pollView.classList.remove('active');
        view.classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updatePollState() {
        const total = checks.length;
        const checked = Array.from(checks).filter(c => c.checked).length;
        const pct = Math.round((checked / total) * 100);

        selectedCount.textContent = `Napili: ${checked}/${total}`;
        selectedPercent.textContent = `${pct}%`;
        pollMeterFill.style.width = `${pct}%`;

        stars.forEach((star, index) => {
            star.classList.toggle('on', index < checked);
        });

        proceedBtn.disabled = checked === 0;
        if (checked === 0) pollHint.textContent = 'Pumili ng kahit isa para magpatuloy.';
        else if (checked < total) pollHint.textContent = `Maganda! ${checked} na ang napili mo.`;
        else pollHint.textContent = 'Kumpleto! Lahat ng mahahalagang gawain ay napili.';

        pollItems.forEach(item => {
            const input = item.querySelector('.poll-check');
            item.classList.toggle('checked', input.checked);
        });
    }

    function getSelectedOptions() {
        return Array.from(checks)
            .filter(c => c.checked)
            .map(c => c.id);
    }

    async function savePollSelection() {
        const selectedOptions = getSelectedOptions();
        if (selectedOptions.length === 0) {
            return false;
        }

        try {
            const response = await fetch(pollSaveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    selected_options: selectedOptions,
                    selected_count: selectedOptions.length
                })
            });

            return response.ok;
        } catch (error) {
            console.error('Failed to save Module 4 poll:', error);
            return false;
        }
    }

    // Modal controls
    openGoalsBtn.addEventListener('click', () => {
        goalsModal.classList.add('show');
    });

    unlockStartBtn.addEventListener('click', function () {
        goalsModal.classList.remove('show');
        startBtn.disabled = false;
        startBtn.textContent = 'Simulan ▶';
    });

    startBtn.addEventListener('click', function () {
        if (startBtn.disabled) {
            alert('Basahin muna ang Mga Layunin 😊');
            return;
        }
        showView(pollView);
    });

    backToHomeBtn.addEventListener('click', function () {
        showView(homeView);
    });

    checks.forEach(chk => chk.addEventListener('change', updatePollState));

    selectAllPollBtn.addEventListener('click', function () {
        checks.forEach(c => c.checked = true);
        updatePollState();
    });

    clearPollBtn.addEventListener('click', function () {
        checks.forEach(c => c.checked = false);
        updatePollState();
    });

    proceedBtn.addEventListener('click', async function () {
        proceedBtn.disabled = true;
        const originalText = proceedBtn.textContent;
        proceedBtn.textContent = 'Nagse-save...';

        await savePollSelection();
        window.location.href = "{{ route('module4.pretest') }}";

        proceedBtn.textContent = originalText;
    });

    // Close modal when clicking outside
    goalsModal.addEventListener('click', function (e) {
        if (e.target === goalsModal) {
            goalsModal.classList.remove('show');
        }
    });

    updatePollState();
});
</script>
@endsection