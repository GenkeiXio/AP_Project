@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 3')

@push('styles')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: url("{{ asset('pictures/mod4_innermap.png') }}") no-repeat center center fixed;
            background-size: cover;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: -1;
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
        }

        .hero {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 18px;
            padding: 18px;
        }

        .title {
            text-align: center;
            font-weight: 900;
            font-size: 1.8rem;
            color: #1b5a42;
        }

        .section {
            margin-top: 20px;
            background: #fff;
            padding: 16px;
            border-radius: 12px;
        }

        /* PRE ACTIVITY */
        .source-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .source-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 260px;
        }

        .media-frame {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            background: #000;
        }

        .media-frame img,
        .media-frame iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* LOCK */
        .locked {
            pointer-events: none;
            opacity: 0.6;
            filter: blur(2px);
            position: relative;
        }

        .locked::after {
            content: "🔒 Kumpletuhin muna ang pagbasa at panonood";
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.6);
        }

        /* DROP GRID */
        .drop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .drop-col {
            border-radius: 12px;
            border: 1px solid #ddd;
            overflow: hidden;
        }

        .drop-header {
            padding: 10px;
            color: white;
            font-weight: bold;
        }

        .drop-header.sanhi {
            background: #1976d2;
        }

        .drop-header.epekto {
            background: #c62828;
        }

        .drop-header.tugon {
            background: #2e7d32;
        }

        .drop-zone {
            min-height: 150px;
            padding: 10px;
            background: #fafafa;
            border-top: 1px dashed #ccc;
        }

        /* CARD */
        .card-container {
            margin-top: 20px;
            background: #fff8e1;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            cursor: grab;
        }

        /* BUTTONS */
        .source-btn,
        .unlock-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: #4caf50;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        #unlockBtn:disabled {
            background: gray;
            cursor: not-allowed;
        }

        /* MODALS (GENERAL) */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 700px;
            border-radius: 12px;
            overflow: hidden;
        }

        /* ARTICLE MODAL */
        .modal-header {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            height: 80vh;
        }

        .modal-body iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* SUMMARY MODAL */
        .summary-content {
            padding: 20px;
            text-align: center;
        }
    </style>
@endpush

@section('content')

    <div class="page">
        <section class="hero">

            <h1 class="title">NODE 3: MALAKAS NA LINDOL SA PILIPINAS</h1>

            <p>
                <b>Panuto:</b> Basahin at unawaing mabuti ang inilahad na balita.
                I-drag at i-drop ang mga ito sa tamang kategorya:
                <b>Sanhi, Bunga, o Tugon.</b>
            </p>

            <!-- PRE -->
            <div class="section">
                <h3>📘 BAGO MAG-ACTIVITY</h3>

                <div class="source-grid">

                    <div class="source-box">
                        <h4>📰 Balita</h4>
                        <div class="media-frame">
                            <img src="{{ asset('pictures/Module4/lindol/card3_1.png') }}">
                        </div>
                        <button class="source-btn" onclick="openArticle(); markRead();">Basahin</button>
                        <div id="readStatus">❌ Hindi pa nababasa</div>
                    </div>

                    <div class="source-box">
                        <h4>🎥 Video</h4>
                        <div class="media-frame">
                            <iframe src="https://www.youtube.com/embed/48qGLqpyutQ"></iframe>
                        </div>
                        <button class="source-btn" onclick="markWatched()">✔ Natapos</button>
                        <div id="watchStatus">❌ Hindi pa napapanood</div>
                    </div>

                </div>

                <button id="unlockBtn" class="unlock-btn" disabled onclick="unlockActivity()">
                    🔒 I-unlock ang Activity
                </button>
            </div>

            <!-- ACTIVITY -->
            <div class="section locked" id="activitySection">

                <div class="drop-grid">

                    <div class="drop-col" data-accept="sanhi">
                        <div class="drop-header sanhi">🔵 SANHI</div>
                        <div class="drop-zone"></div>
                    </div>

                    <div class="drop-col" data-accept="epekto">
                        <div class="drop-header epekto">🔴 BUNGA</div>
                        <div class="drop-zone"></div>
                    </div>

                    <div class="drop-col" data-accept="tugon">
                        <div class="drop-header tugon">🟢 MGA TUGON</div>
                        <div class="drop-zone"></div>
                    </div>

                </div>

                <div class="card-container">
                    <h4>Kasalukuyang Card (<span id="cardCount">3</span>)</h4>
                    <div id="currentCard" class="card" draggable="true"></div>
                </div>

            </div>

            <!-- SUMMARY MODAL -->
            <div id="summaryModal" class="modal">

                <div class="modal-content summary-content">

                    <h3>📘 BUOD</h3>

                    <p>
                        Ang magnitude 6.9 na lindol na tumama sa Bogo City ay nagdulot ng matinding pinsala sa buhay at
                        ari-arian, kung saan
                        umabot sa 69 ang nasawi at 175 ang nasugatan dahil sa mga gumuhong gusali at bahay. Maraming
                        residente ang napilitang
                        lumikas habang ang mga ospital ay napuno ng mga biktima. Naramdaman ang pagyanig sa iba’t ibang
                        bahagi ng Visayas at
                        Bicol, at sinundan ito ng daan-daang aftershocks na nagpalala ng sitwasyon. Sa kabila nito, mabilis
                        na kumilos ang
                        pamahalaan at mga rescue teams upang magbigay ng tulong, magsagawa ng search and rescue operations,
                        at tiyakin ang
                        kaligtasan ng mga apektadong komunidad, na nagpapakita ng kahalagahan ng kahandaan at pagtutulungan
                        sa panahon ng
                        sakuna.
                    </p>

                    <div style="margin-top:15px; display:flex; gap:10px; justify-content:center;">
                        <a href="{{ route('inner.map4') }}" class="unlock-btn">
                            🗺️ Bumalik sa Mapa
                        </a>
                    </div>

                </div>

            </div>

            <!-- ARTICLE MODAL -->
            <div id="articleModal" class="modal">

                <div class="modal-content">

                    <div class="modal-header">
                        <b>📖 Artikulo</b>
                        <button onclick="closeArticle()">✕</button>
                    </div>

                    <div class="modal-body">
                        <iframe
                            src="https://www.abs-cbn.com/news/regions/2026/1/7/lindol-sa-manay-davao-oriental-1404"></iframe>
                    </div>

                </div>

            </div>
        </section>
    </div>

    <script>

        /* SHUFFLE */
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        const cards = [
            { text: "Ang malakas na lindol na may lakas na magnitude 6.9 ay dulot ng paggalaw ng mga tectonic plates sa ilalim ng lupa. Ang epicenter nito ay naitala sa Bogo City, na nagdulot ng matinding pagyanig na naramdaman sa iba’t ibang bahagi ng Visayas at Bicol.", type: "sanhi" },

            { text: "Nagresulta ang lindol sa matinding pinsala sa buhay at ari-arian. Umabot sa 69 ang nasawi at 175 ang nasugatan dahil sa mga gumuhong gusali at bahay. Maraming ospital ang napuno ng mga biktima kaya ang iba ay ginamot na lamang sa labas. Marami ring residente ang napilitang lumikas at pansamantalang nanirahan sa evacuation centers. Naranasan din ang daan-daang aftershocks, pagkakaroon ng mga bitak sa kalsada, at pagkawala ng kuryente sa ilang lugar.", type: "epekto" },

            { text: "Agad na kumilos ang pamahalaan at mga rescue teams upang magsagawa ng search and rescue operations at magbigay ng agarang tulong sa mga apektadong komunidad. Nagkaroon ng mga babala at paghahanda para sa kaligtasan ng mga residente, kabilang ang paglikas sa mga mapanganib na lugar. Ipinakita rin ng komunidad ang pagtutulungan at bayanihan sa pagtulong sa mga biktima ng sakuna.", type: "tugon" }
        ];

        shuffleArray(cards);

        let currentIndex = 0;
        const card = document.getElementById("currentCard");

        function loadCard() {
            if (currentIndex >= cards.length) {
                card.innerText = "🎉 Tapos na!";
                setTimeout(() => summaryModal.style.display = "flex", 500);
                return;
            }
            card.innerText = cards[currentIndex].text;
            cardCount.innerText = cards.length - currentIndex;
        }

        card.addEventListener("dragstart", e => {
            e.dataTransfer.setData("type", cards[currentIndex].type);
            e.dataTransfer.setData("text", cards[currentIndex].text);
        });

        document.querySelectorAll(".drop-zone").forEach(zone => {
            zone.addEventListener("dragover", e => e.preventDefault());
            zone.addEventListener("drop", e => {
                e.preventDefault();

                const type = e.dataTransfer.getData("type");
                const text = e.dataTransfer.getData("text");

                if (type === zone.parentElement.dataset.accept) {
                    let item = document.createElement("div");
                    item.className = "card";
                    item.innerText = text;
                    zone.appendChild(item);
                    currentIndex++;
                    loadCard();
                } else {
                    alert("❌ Mali!");
                }
            });
        });

        loadCard();

        /* LOCK */
        let hasRead = false, hasWatched = false;

        function markRead() { hasRead = true; readStatus.innerText = "✅"; checkUnlock(); }
        function markWatched() { hasWatched = true; watchStatus.innerText = "✅"; checkUnlock(); }

        function checkUnlock() {
            if (hasRead && hasWatched) unlockBtn.disabled = false;
        }

        function unlockActivity() {
            activitySection.classList.remove("locked");
        }

        function openArticle() {
            document.getElementById('articleModal').style.display = 'flex';
        }

        function closeArticle() {
            document.getElementById('articleModal').style.display = 'none';
        }

        function closeSummary() {
            document.getElementById('summaryModal').style.display = 'none';
        }

    </script>

@endsection