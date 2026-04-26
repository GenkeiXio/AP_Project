@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 4')

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
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-weight: 900;
            text-align: center;
            font-size: 1.8rem;
            color: #1b5a42;
        }

        .section {
            margin-top: 20px;
            background: #fff;
            padding: 16px;
            border-radius: 12px;
        }

        .unlock-btn {
            margin-top: 15px;
            padding: 10px 18px;
            border-radius: 10px;
            background: #4caf50;
            color: white;
            font-weight: bold;
        }

        .drag-item {
            background: #e3f2fd;
            padding: 12px;
            border-radius: 10px;
            cursor: grab;
            border: 2px solid #90caf9;
            font-weight: 600;
        }

        .drop-zone {
            min-height: 120px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            padding: 10px;
        }

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

        .source-btn {
            padding: 10px;
            border-radius: 10px;
            background: #4caf50;
            color: white;
            font-weight: bold;
        }

        #unlockBtn:disabled {
            background: gray;
        }

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
            font-weight: bold;
            background: rgba(255, 255, 255, 0.6);
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

        .drop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .drop-col {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #ddd;
            overflow: hidden;
        }

        .drop-header {
            padding: 10px;
            font-weight: bold;
            color: white;
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

        .drop-col h4 {
            margin-bottom: 10px;
        }

        /* .drop-col.sanhi {
                                    background: #1976d2;
                                    color: white;
                                }

                                .drop-col.epekto {
                                    background: #c62828;
                                    color: white;
                                }

                                .drop-col.tugon {
                                    background: #2e7d32;
                                    color: white;
                                } */

        .drop-zone {
            min-height: 150px;
            padding: 10px;
            background: #fafafa;
            border-top: 1px dashed #ccc;
        }

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
            font-weight: 500;
        }
    </style>
@endpush

@section('content')

    <div class="page">
        <section class="hero">

            <h1 class="title">NODE 4: PAGPUTOK NG BULKANG MAYON</h1>

            <p>
                <b>Panuto:</b> Basahin at unawaing mabuti ang inilahad na balita.
                Pagkatapos, suriin ang bawat pangungusap o pahayag.
                I-drag at i-drop ang mga ito sa tamang kategorya:
                <b>Sanhi, Bunga, o Tugon.</b>
            </p>

            <!-- PRE ACTIVITY -->
            <div class="section">

                <h3>📘 BAGO MAG-ACTIVITY: Basahin at panoorin</h3>

                <div class="source-grid">

                    <!-- ARTICLE -->
                    <div class="source-box">
                        <h4>📰 Balita</h4>

                        <div class="media-frame">
                            <img src="{{ asset('pictures/Module4/mayon/card4_1.png') }}">
                        </div>

                        <button class="source-btn" onclick="openArticle(); markRead();">
                            Basahin ang Artikulo
                        </button>

                        <div id="readStatus">❌ Hindi pa nababasa</div>
                    </div>

                    <!-- MODAL -->
                    <div id="articleModal"
                        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:9999; justify-content:center; align-items:center;">
                        <div style="background:white; width:90%; height:80%; border-radius:10px; overflow:hidden;">

                            <div style="padding:10px; display:flex; justify-content:space-between;">
                                <b>📖 Artikulo</b>
                                <button onclick="closeArticle()">✕</button>
                            </div>

                            <iframe
                                src="https://www.philstar.com/pang-masa/police-metro/2023/10/22/2305565/pagsabog-ng-lava-sa-bulkang-mayon-naitala"
                                width="100%" height="90%"></iframe>

                        </div>
                    </div>

                    <!-- VIDEO -->
                    <div class="source-box">
                        <h4>🎥 Video</h4>

                        <div class="media-frame">
                            <iframe src="https://www.youtube.com/embed/UR7cTKlugFM" allowfullscreen></iframe>
                        </div>

                        <button class="source-btn" onclick="markWatched()">✔ Natapos ko panoorin</button>

                        <div id="watchStatus">❌ Hindi pa napapanood</div>
                    </div>

                </div>

                <div style="text-align:center; margin-top:15px;">
                    <button id="unlockBtn" class="unlock-btn" disabled onclick="unlockActivity()">
                        🔒 I-unlock ang Activity
                    </button>
                </div>

            </div>

            <!-- ACTIVITY -->
            <div class="section locked" id="activitySection">

                <h3>📊 I-drag at i-drop ang tamang sagot</h3>

                <!-- DROP COLUMNS -->
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

                <!-- CURRENT CARD -->
                <div class="card-container">
                    <h4>Kasalukuyang Card (<span id="cardCount">3</span>)</h4>

                    <div id="currentCard" class="card" draggable="true"></div>
                </div>

            </div>

            <!-- SUMMARY MODAL -->
            <div id="summaryModal" style="display:none;
                                                                                    position:fixed;
                                                                                    inset:0;
                                                                                    background:rgba(0,0,0,0.7);
                                                                                    z-index:9999;
                                                                                    justify-content:center;
                                                                                    align-items:center;
                                                                                ">

                <div style="
                                                                                        background:white;
                                                                                        width:90%;
                                                                                        max-width:600px;
                                                                                        border-radius:12px;
                                                                                        padding:20px;
                                                                                        text-align:center;
                                                                                    ">

                    <h3>📘 BUOD</h3>

                    <p>
                        Noong Hunyo 8, 2023, nakunan ang pag-agos at pagguho ng nagliliwanag na lava mula sa Bulkang Mayon,
                        lalo na
                        kapansin-pansin sa gabi dahil sa liwanag nito. Ipinakita ng aktibidad ang tuloy-tuloy na paglabas ng
                        magma, kabilang ang
                        mga “incandescent rockfalls,” na senyales ng aktibong pagputok. Dahil dito, itinaas ang Alert Level
                        3 at nagbabala ang
                        mga awtoridad sa posibleng panganib tulad ng lava flow, ashfall, at pyroclastic flows. Pinag-iingat
                        ang mga residente at
                        inihahanda ang mga hakbang sa paglikas upang mapanatili ang kaligtasan ng mga komunidad sa paligid
                        ng bulkan.
                    </p>

                    <div style="margin-top:15px; display:flex; gap:10px; justify-content:center;">
                        <a href="{{ route('inner.map4') }}" class="unlock-btn">
                            🗺️ Bumalik sa Mapa
                        </a>
                    </div>

                </div>
            </div>

        </section>
    </div>

    <script>

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        const cards = [
            {
                text: "Ang pagsabog ng lava sa Mayon Volcano ay dulot ng patuloy na pag-akyat at paggalaw ng magma sa loob ng bulkan. Ayon sa PHIVOLCS, naitala ang sunod-sunod na lava eruption na sinabayan ng seismic at infrasound signals—mga palatandaan ng tumitinding aktibidad ng bulkan.",
                type: "sanhi"
            },
            {
                text: "Nagresulta ang aktibidad sa patuloy na pagdaloy ng lava sa iba’t ibang bahagi ng bulkan, umabot ng ilang kilometro pababa sa mga dalisdis. Nagkaroon din ng mga rockfalls at pyroclastic density currents (PDCs) na nagdeposito ng debris sa loob ng ilang kilometro mula sa crater. Bukod dito, tumaas ang bilang ng volcanic earthquakes at tremors, na nagpapahiwatig ng patuloy na panganib sa mga kalapit na komunidad.",
                type: "epekto"
            },
            {
                text: "Naglabas ng mga babala ang mga awtoridad at pinanatili ang Alert Level 3 upang ipaalam ang posibilidad ng mapanganib na pagsabog sa mga susunod na araw o linggo. Pinag-iingat ang mga residente laban sa panganib tulad ng lava flow, rockfalls, at pyroclastic flows, at hinihikayat ang pagsunod sa mga safety protocols at posibleng paglikas upang matiyak ang kaligtasan ng komunidad.",
                type: "tugon"
            }
        ];

        shuffleArray(cards); // ✅ shuffle

        let currentIndex = 0;
        const card = document.getElementById("currentCard");

        function loadCard() {

            if (currentIndex >= cards.length) {
                card.innerText = "🎉 Tapos na!";

                setTimeout(() => {
                    document.getElementById("summaryModal").style.display = "flex";
                }, 500);

                return;
            }

            card.innerText = cards[currentIndex].text;
            document.getElementById("cardCount").innerText = cards.length - currentIndex;
        }

        card.addEventListener("dragstart", e => {
            if (currentIndex >= cards.length) return;

            e.dataTransfer.setData("type", cards[currentIndex].type);
            e.dataTransfer.setData("text", cards[currentIndex].text);
        });

        document.querySelectorAll(".drop-zone").forEach(zone => {

            zone.addEventListener("dragover", e => e.preventDefault());

            zone.addEventListener("drop", e => {
                e.preventDefault();

                if (currentIndex >= cards.length) return;

                const type = e.dataTransfer.getData("type");
                const text = e.dataTransfer.getData("text");

                const accept = zone.parentElement.getAttribute("data-accept");

                if (type === accept) {

                    const item = document.createElement("div");
                    item.className = "card";
                    item.innerText = text;

                    zone.appendChild(item);

                    currentIndex++;
                    loadCard();

                } else {
                    alert("❌ Mali! Subukan ulit.");
                }
            });

        });

        loadCard();

        /* ===== LOCK SYSTEM ===== */

        let hasRead = false, hasWatched = false;

        function markRead() {
            hasRead = true;
            readStatus.innerText = "✅ Nabasa na";
            checkUnlock();
        }

        function markWatched() {
            hasWatched = true;
            watchStatus.innerText = "✅ Napanood na";
            checkUnlock();
        }

        function checkUnlock() {
            if (hasRead && hasWatched) {
                unlockBtn.disabled = false;
            }
        }

        function unlockActivity() {
            document.getElementById('activitySection').classList.remove('locked');
        }

        /* ===== MODALS ===== */

        function openArticle() {
            document.getElementById('articleModal').style.display = 'flex';
        }

        function closeArticle() {
            document.getElementById('articleModal').style.display = 'none';
        }

        function closeSummary() {
            document.getElementById("summaryModal").style.display = "none";
        }
    </script>

@endsection