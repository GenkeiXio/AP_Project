{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 4\home.blade.php --}}
<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modyul 4</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        :root{
            --bg1:#f2fbf5;
            --bg2:#daf3e4;
            --text:#1d3c2b;
            --muted:#567161;
            --line:#d4eadb;
            --shadow:0 14px 35px rgba(18,67,41,.15);

            --green:#2f9f5a;
            --green-dark:#1f7a45;
            --blue:#3f8cff;
            --orange:#ff9f43;
            --violet:#8c63ff;
            --teal:#00a88f;
        }

        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family:'Poppins', sans-serif;
            color:var(--text);
            background: radial-gradient(circle at 20% 0%, #ffffff 0%, var(--bg1) 45%, var(--bg2) 100%);
        }

        .wrap{
            max-width:1100px;
            margin:28px auto;
            padding:0 16px 30px;
        }

        .view{ display:none; }
        .view.active{ display:block; animation:fadeIn .28s ease; }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(8px); }
            to{ opacity:1; transform:translateY(0); }
        }

        .hero{
            background:linear-gradient(135deg,#ffffff,#f5fff8);
            border:1px solid var(--line);
            border-radius:24px;
            box-shadow:var(--shadow);
            padding:26px;
            overflow:hidden;
        }

        .badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            border:1px solid #c9e6d3;
            background:#e9f8ee;
            color:#166339;
            border-radius:999px;
            padding:8px 12px;
            font-weight:700;
            font-size:.85rem;
        }

        h1{
            margin:12px 0 10px;
            font-size:clamp(1.25rem,2.4vw,2rem);
            line-height:1.35;
            font-weight:800;
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
            font-weight:700;
            cursor:pointer;
            transition:.2s ease;
            font-family:inherit;
        }
        .btn:hover{ transform:translateY(-2px); }
        .btn-main{
            color:#fff;
            background:linear-gradient(135deg,var(--green),var(--green-dark));
            box-shadow:0 10px 22px rgba(47,159,90,.30);
        }
        .btn-soft{
            color:#1e5c3a;
            background:#f0faf3;
            border:1px solid var(--line);
        }
        .btn:disabled{
            opacity:.6;
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
            color:#1f382c;
            border:1px solid #d8e9de;
            box-shadow:0 8px 18px rgba(0,0,0,.06);
        }
        .card .icon{ font-size:1.4rem; }
        .card h4{ margin:8px 0 4px; font-size:.98rem; }
        .card p{ margin:0; font-size:.88rem; }

        .card-1{
            background:linear-gradient(135deg,#e8fff2,#d6f8e4);
            border-left:6px solid var(--green-dark);
        }
        .card-2{
            background:linear-gradient(135deg,#eaf3ff,#dceaff);
            border-left:6px solid var(--blue);
        }
        .card-3{
            background:linear-gradient(135deg,#fff4e8,#ffe7cc);
            border-left:6px solid var(--orange);
        }

        /* Poll page */
        .poll-page{
            min-height:78vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .poll-card{
            width:min(860px,100%);
            background:#fff;
            border:1px solid var(--line);
            border-radius:22px;
            box-shadow:var(--shadow);
            padding:22px;
        }

        .poll-title{
            margin:0 0 8px;
            font-size:1.2rem;
            color:#1f4d35;
        }

        .poll-q{
            margin:0 0 14px;
            color:#305542;
            line-height:1.5;
        }

        .opt{
            display:flex;
            align-items:center;
            gap:12px;
            border:1px solid var(--line);
            border-radius:14px;
            background:#fff;
            padding:10px;
            margin-bottom:10px;
            transition:.2s ease;
        }
        .opt:hover{
            background:#f8fffb;
            border-color:#bfe3cc;
        }

        .opt input{
            width:18px; height:18px;
            accent-color:var(--green);
            cursor:pointer;
        }

        .thumb{
            width:52px; height:52px;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:1.5rem;
            border:1px solid #d9ecdf;
            flex-shrink:0;
        }
        .t1{ background:#eefbf2; }
        .t2{ background:#eef4ff; }
        .t3{ background:#fff4ee; }
        .t4{ background:#f4efff; }

        .opt label{
            cursor:pointer;
            font-weight:600;
            font-size:.94rem;
            color:#234b38;
        }

        /* Modal */
        .modal{
            position:fixed;
            inset:0;
            background:rgba(8,28,19,.60);
            display:none;
            align-items:center;
            justify-content:center;
            z-index:999;
            padding:16px;
            backdrop-filter: blur(4px);
        }
        .modal.show{ display:flex; }

        .modal-card{
            width:min(960px,96%);
            max-height:90vh;
            overflow:auto;
            border-radius:20px;
            border:1px solid var(--line);
            background:linear-gradient(180deg,#ffffff,#f7fffb);
            box-shadow:0 25px 50px rgba(0,0,0,.24);
            padding:18px;
        }

        .goal-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:10px;
            margin-bottom:12px;
        }

        .goal-title-wrap{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .goal-title-icon{
            width:42px;height:42px;border-radius:12px;
            display:flex;align-items:center;justify-content:center;
            background:linear-gradient(135deg,#ddf8e8,#c7f1d8);
            border:1px solid #bfe6ce;
            color:#1c6e43;
        }

        .goal-title{
            margin:0;
            font-size:1.06rem;
            font-weight:800;
            color:#1a4c32;
        }

        .goal-sub{
            margin:2px 0 0;
            color:#5c7a69;
            font-size:.82rem;
            font-weight:600;
        }

        .progress-chip{
            display:flex;align-items:center;gap:8px;
            background:#f2fbf6;
            border:1px solid #d6eadf;
            border-radius:999px;
            padding:8px 12px;
            font-size:.82rem;
            font-weight:700;
            color:#24593c;
        }

        .progress-bar{
            width:100px;height:7px;border-radius:999px;background:#e3f2ea;overflow:hidden;
        }
        .progress-fill{
            width:0%;height:100%;
            background:linear-gradient(90deg,var(--teal),var(--green));
            transition:width .25s ease;
        }

        .accordion-tools{
            display:flex;
            gap:8px;
            justify-content:flex-end;
            margin:0 0 10px;
            flex-wrap:wrap;
        }

        .tool-btn{
            border:1px solid var(--line);
            background:#f0faf3;
            color:#1e5c3a;
            border-radius:10px;
            padding:8px 12px;
            font-weight:700;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }

        .acc-item{
            border:1px solid #d6eadf;
            border-radius:14px;
            margin-bottom:10px;
            background:#fcfffd;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(18,67,41,.05);
            position:relative;
        }

        .acc-item::before{
            content:'';
            position:absolute;
            left:0; top:0; bottom:0;
            width:4px;
            background:linear-gradient(180deg,var(--teal),var(--green));
            opacity:.25;
        }

        .acc-btn{
            width:100%;
            border:0;
            background:linear-gradient(135deg,#ffffff,#f4fff8);
            padding:12px 14px;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            font-family:inherit;
            text-align:left;
        }

        .acc-main{
            display:flex;
            align-items:center;
            gap:10px;
            min-width:0;
        }

        .acc-badge{
            width:34px;height:34px;border-radius:10px;
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-weight:800;font-size:.82rem;flex-shrink:0;
            box-shadow:0 6px 12px rgba(0,0,0,.15);
        }
        .bg-a{ background:linear-gradient(135deg,#2f9f5a,#1f7a45); }
        .bg-b{ background:linear-gradient(135deg,#3f8cff,#356fe0); }
        .bg-c{ background:linear-gradient(135deg,#8c63ff,#714ce5); }
        .bg-d{ background:linear-gradient(135deg,#ff9f43,#ef7e2b); }
        .bg-e{ background:linear-gradient(135deg,#00a88f,#148b72); }

        .acc-title{
            font-weight:700;
            font-size:.92rem;
            color:#1c4d34;
            line-height:1.35;
            display:flex;
            align-items:center;
            gap:8px;
        }

        .title-icon{
            color:#2c6c49;
            display:inline-flex;
        }

        .acc-right{
            display:flex;
            align-items:center;
            gap:8px;
            flex-shrink:0;
        }

        .chev-wrap{
            width:28px;height:28px;border-radius:8px;
            border:1px solid #d8eadf;
            background:#fff;
            display:flex;align-items:center;justify-content:center;
            transition:.2s ease;
        }

        .acc-btn:hover .chev-wrap{
            background:#f0faf3;
            border-color:#c4e2d1;
        }

        .chev{
            width:16px;height:16px;
            transition:transform .24s ease;
            color:#2b6a47;
        }

        .acc-btn[aria-expanded="true"] .chev{
            transform:rotate(180deg);
        }

        .acc-panel{
            max-height:0;
            overflow:hidden;
            transition:max-height .28s ease;
            background:#fff;
        }

        .acc-body{
            padding:6px 14px 14px 58px;
            color:#2f5743;
            line-height:1.58;
            font-size:.93rem;
        }

        .acc-body ul, .acc-body ol{ margin:8px 0 0 18px; }

        .modal-actions, .poll-actions{
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-top:12px;
            flex-wrap:wrap;
        }

        @media (max-width:860px){
            .cards{ grid-template-columns:1fr; }
            .acc-body{ padding-left:14px; }
            .progress-bar{ width:86px; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <!-- PAGE 1 -->
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

    <!-- PAGE 2 -->
    <div class="view" id="pollView">
        <section class="poll-page">
            <div class="poll-card">
                <h2 class="poll-title">✅ Simpleng Poll (Checklist)</h2>
                <p class="poll-q">
                    👉 <strong>Tanong:</strong> Sa iyong komunidad, alin sa mga sumusunod ang pinakamahalagang ginagawa upang makatulong sa pagtugon sa mga suliraning pangkapaligiran?
                </p>

                <div class="opt">
                    <input type="checkbox" id="o1" class="poll-check">
                    <div class="thumb t1">🧹</div>
                    <label for="o1">Pakikilahok sa clean-up drive at tamang pagtatapon ng basura</label>
                </div>

                <div class="opt">
                    <input type="checkbox" id="o2" class="poll-check">
                    <div class="thumb t2">🌱</div>
                    <label for="o2">Pagtatanim ng puno at pangangalaga sa kalikasan</label>
                </div>

                <div class="opt">
                    <input type="checkbox" id="o3" class="poll-check">
                    <div class="thumb t3">🚨</div>
                    <label for="o3">Pagsunod sa mga babala at paghahanda sa sakuna</label>
                </div>

                <div class="opt">
                    <input type="checkbox" id="o4" class="poll-check">
                    <div class="thumb t4">🤝</div>
                    <label for="o4">Pakikiisa sa mga programa ng barangay at pamahalaan</label>
                </div>

                <div class="poll-actions">
                    <button type="button" class="btn btn-soft" id="backToHomeBtn">← Bumalik</button>
                    <button type="button" class="btn btn-main" id="proceedBtn" disabled>Magpatuloy ➜</button>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Goals Collapsible Popup -->
<div class="modal" id="goalsModal">
    <div class="modal-card">
        <div class="goal-header">
            <div class="goal-title-wrap">
                <div class="goal-title-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2l2.3 4.66L19.5 7.5l-3.75 3.65.88 5.15L12 13.9l-4.63 2.4.88-5.15L4.5 7.5l5.2-.84L12 2z" fill="currentColor"/>
                    </svg>
                </div>
                <div>
                    <h3 class="goal-title">Mga Layunin ng Aralin</h3>
                </div>
            </div>

            <div class="progress-chip">
                <span id="progressText">Nabasa: 1/5</span>
                <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
            </div>
        </div>

        <div class="accordion-tools">
            <button type="button" class="tool-btn" id="openAllBtn">📂 Buksan Lahat</button>
            <button type="button" class="tool-btn" id="closeAllBtn">🗂️ Isara Lahat</button>
        </div>

        <div class="acc-item">
            <button type="button" class="acc-btn" aria-expanded="true" data-target="acc1">
                <span class="acc-main">
                    <span class="acc-badge bg-a">A</span>
                    <span class="acc-title">
                        <span class="title-icon"></span>
                        PAMANTAYANG PANGNILALAMAN (Content Standard)
                    </span>
                </span>
                <span class="acc-right">
                    <span class="chev-wrap">
                        <svg class="chev" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </span>
            </button>
            <div class="acc-panel" id="acc1">
                <div class="acc-body">
                    Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.
                </div>
            </div>
        </div>

        <div class="acc-item">
            <button type="button" class="acc-btn" aria-expanded="false" data-target="acc2">
                <span class="acc-main">
                    <span class="acc-badge bg-b">B</span>
                    <span class="acc-title">
                        <span class="title-icon"></span>
                        PAMANTAYAN SA PAGGANAP (Performance Standard)
                    </span>
                </span>
                <span class="acc-right">
                    <span class="chev-wrap">
                        <svg class="chev" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </span>
            </button>
            <div class="acc-panel" id="acc2">
                <div class="acc-body">
                    Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.
                </div>
            </div>
        </div>

        <div class="acc-item">
            <button type="button" class="acc-btn" aria-expanded="false" data-target="acc3">
                <span class="acc-main">
                    <span class="acc-badge bg-c">C</span>
                    <span class="acc-title">
                        <span class="title-icon"></span>
                        KASANAYAN SA PAGKATUTO
                    </span>
                </span>
                <span class="acc-right">
                    <span class="chev-wrap">
                        <svg class="chev" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </span>
            </button>
            <div class="acc-panel" id="acc3">
                <div class="acc-body">
                    Nasusuri ang kahalagahan ng kahandaan, disiplina at kooperasyon sa pagtugon sa mga hamong pangkapaligiran (MELC4).
                </div>
            </div>
        </div>

        <div class="acc-item">
            <button type="button" class="acc-btn" aria-expanded="false" data-target="acc4">
                <span class="acc-main">
                    <span class="acc-badge bg-d">D</span>
                    <span class="acc-title">
                        <span class="title-icon"></span>
                        MGA TIYAK NA LAYUNIN
                    </span>
                </span>
                <span class="acc-right">
                    <span class="chev-wrap">
                        <svg class="chev" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </span>
            </button>
            <div class="acc-panel" id="acc4">
                <div class="acc-body">
                    <ul>
                        <li>Nailalarawan ang kasalukuyang kalagayan, suliranin at mga pagtugon sa isyung pangkapaligiran ng Pilipinas;</li>
                        <li>Nailalahad at nasusuri ang mga epekto ng mga suliranin at isyung pangkapaligirang kinakaharap ng Pilipinas at sa ibang panig ng daigdig sa kasalukuyang panahon;</li>
                        <li>Napahahalagahan ang kahalagahan ng pakikiisa at pakikibahagi ng lahat sa pagsugpo sa mga hamong pangkapaligiran sa mga lokal na pamahalaan sa Pilipinas maging sa ibang panig ng daigdig;</li>
                        <li>Nakabubuo ng isang malikhain at makabuluhang panukalang proyekto na makakatulong sa pangangalaga ng kalikasan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="acc-item">
            <button type="button" class="acc-btn" aria-expanded="false" data-target="acc5">
                <span class="acc-main">
                    <span class="acc-badge bg-e">E</span>
                    <span class="acc-title">
                        <span class="title-icon"></span>
                        PAKSANG ARALIN
                    </span>
                </span>
                <span class="acc-right">
                    <span class="chev-wrap">
                        <svg class="chev" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </span>
            </button>
            <div class="acc-panel" id="acc5">
                <div class="acc-body">
                    <ol>
                        <li>Kalagayan at Suliranin sa mga Isyung Pangkapaligiran sa Pilipinas</li>
                        <li>Pagtugon sa mga Isyung Pangkapaligiran sa Pilipinas</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn btn-soft" id="closeGoalsBtn">Isara</button>
            <button type="button" class="btn btn-main" id="unlockStartBtn">Nabasa ko na ✅</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const homeView = document.getElementById('homeView');
    const pollView = document.getElementById('pollView');

    const goalsModal = document.getElementById('goalsModal');
    const openGoalsBtn = document.getElementById('openGoalsBtn');
    const closeGoalsBtn = document.getElementById('closeGoalsBtn');
    const unlockStartBtn = document.getElementById('unlockStartBtn');
    const openAllBtn = document.getElementById('openAllBtn');
    const closeAllBtn = document.getElementById('closeAllBtn');
    const progressText = document.getElementById('progressText');
    const progressFill = document.getElementById('progressFill');

    const startBtn = document.getElementById('startBtn');
    const backToHomeBtn = document.getElementById('backToHomeBtn');
    const proceedBtn = document.getElementById('proceedBtn');
    const checks = document.querySelectorAll('.poll-check');

    const accButtons = document.querySelectorAll('.acc-btn');

    function showView(view) {
        homeView.classList.remove('active');
        pollView.classList.remove('active');
        view.classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function openPanel(btn) {
        const panel = document.getElementById(btn.dataset.target);
        btn.setAttribute('aria-expanded', 'true');
        panel.style.maxHeight = panel.scrollHeight + 'px';
    }

    function closePanel(btn) {
        const panel = document.getElementById(btn.dataset.target);
        btn.setAttribute('aria-expanded', 'false');
        panel.style.maxHeight = '0px';
    }

    function updateProgress() {
        const total = accButtons.length;
        const opened = Array.from(accButtons).filter(b => b.getAttribute('aria-expanded') === 'true').length;
        const pct = Math.round((opened / total) * 100);
        progressText.textContent = `Nabasa: ${opened}/${total}`;
        progressFill.style.width = `${pct}%`;
    }

    function togglePanel(btn) {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        expanded ? closePanel(btn) : openPanel(btn);
        updateProgress();
    }

    accButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => togglePanel(btn));
        if (index === 0) openPanel(btn);
        else closePanel(btn);
    });
    updateProgress();

    openAllBtn.addEventListener('click', () => {
        accButtons.forEach(openPanel);
        updateProgress();
    });

    closeAllBtn.addEventListener('click', () => {
        accButtons.forEach(closePanel);
        updateProgress();
    });

    openGoalsBtn.addEventListener('click', () => goalsModal.classList.add('show'));
    closeGoalsBtn.addEventListener('click', () => goalsModal.classList.remove('show'));

    unlockStartBtn.addEventListener('click', function () {
        goalsModal.classList.remove('show');
        startBtn.disabled = false;
        startBtn.textContent = 'Simulan ▶';
    });

    startBtn.addEventListener('click', function () {
        showView(pollView);
    });

    backToHomeBtn.addEventListener('click', function () {
        showView(homeView);
    });

    checks.forEach(chk => {
        chk.addEventListener('change', function () {
            const anyChecked = Array.from(checks).some(c => c.checked);
            proceedBtn.disabled = !anyChecked;
        });
    });

    proceedBtn.addEventListener('click', function () {
        window.location.href = "{{ url('/module4/pretest') }}";
    });

    goalsModal.addEventListener('click', function (e) {
        if (e.target === goalsModal) goalsModal.classList.remove('show');
    });

    window.addEventListener('resize', function () {
        accButtons.forEach((btn) => {
            if (btn.getAttribute('aria-expanded') === 'true') {
                const panel = document.getElementById(btn.dataset.target);
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    });
});
</script>
</body>
</html>