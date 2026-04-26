@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 5')

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

        .source-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .source-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 260px;
            text-align: center;
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

        .source-btn,
        .unlock-btn {
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
            background: rgba(255, 255, 255, 0.6);
        }

        .drop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
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

        .sanhi {
            background: #1976d2;
        }

        .epekto {
            background: #c62828;
        }

        .tugon {
            background: #2e7d32;
        }

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
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush

@section('content')

    <div class="page">
        <section class="hero">

            <h1 class="title">NODE 5: LANDSLIDE SA ALBAY</h1>

            <p>
                <b>Panuto:</b> Basahin at unawaing mabuti ang inilahad na balita.
                I-drag at i-drop ang mga ito sa tamang kategorya:
                <b>Sanhi, Epekto, o Tugon.</b>
            </p>

            <!-- PRE -->
            <div class="section">

                <div class="source-grid">

                    <div class="source-box">
                        <h4>📰 Balita</h4>

                        <div class="media-frame">
                            <img src="{{ asset('pictures/Module4/landslide/node5.png') }}">
                        </div>

                        <button class="source-btn" onclick="openArticle(); markRead();">
                            Basahin ang Artikulo
                        </button>

                        <div id="readStatus">❌ Hindi pa nababasa</div>
                    </div>

                    <div class="source-box">
                        <h4>🎥 Video</h4>

                        <div class="media-frame">
                            <iframe src="https://www.youtube.com/embed/ibI0oImzDSs"></iframe>
                        </div>

                        <button class="source-btn" onclick="markWatched()">✔ Natapos</button>
                        <div id="watchStatus">❌ Hindi pa napapanood</div>
                    </div>

                </div>

                <div style="text-align:center;margin-top:15px;">
                    <button id="unlockBtn" class="unlock-btn" disabled onclick="unlockActivity()">
                        🔒 I-unlock ang Activity
                    </button>
                </div>

            </div>

            <!-- ACTIVITY -->
            <div class="section locked" id="activitySection">

                <div class="drop-grid">

                    <div class="drop-col" data-accept="sanhi">
                        <div class="drop-header sanhi">🔵 SANHI</div>
                        <div class="drop-zone"></div>
                    </div>

                    <div class="drop-col" data-accept="epekto">
                        <div class="drop-header epekto">🔴 EPEKTO</div>
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

                <div
                    style="background:white; width:90%; max-width:600px; border-radius:12px; padding:20px; text-align:center;">

                    <h3>📘 BUOD</h3>

                    <p>
                        Nagkaroon ng dalawang landslide sa Barangay Burabod, Libon, Albay dulot ng matinding ulan mula sa
                        bagyong Kristine. Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa habang patuloy ang pagguho
                        sa lugar dahil sa basa at marupok na lupa.
                        Sa kabila ng pinsala, ligtas ang mga residente dahil agad silang nakalikas at pansamantalang
                        nanunuluyan sa evacuation center. Gayunpaman, isang 60-anyos na lalaki ang naiulat na nawawala kaya
                        nagpapatuloy ang search and rescue operations.
                        Ipinapakita ng insidenteng ito ang kahalagahan ng maagap na paglikas at pagsunod sa mga babala ng
                        awtoridad upang maiwasan ang mas malala na sakuna.
                    </p>

                    <div style="margin-top:15px;">
                        <a href="{{ route('inner.map4') }}" class="unlock-btn">
                            🗺️ Bumalik sa Mapa
                        </a>
                    </div>

                </div>

            </div>

            <!-- ARTICLE MODAL -->
            <div id="articleModal" class="modal">
                <div style="background:white;width:90%;height:80%;border-radius:10px;overflow:hidden;">
                    <div style="padding:10px;display:flex;justify-content:space-between;">
                        <b>📖 Artikulo</b>
                        <button onclick="closeArticle()">✕</button>
                    </div>

                    <iframe
                        src="https://www.abs-cbn.com/regions/2024/10/24/20-bahay-nabaon-sa-landslides-sa-libon-albay-1331"
                        width="100%" height="90%"></iframe>
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
                text: "Ang landslide sa Barangay Burabod ay dulot ng matinding pag-ulan na dala ng bagyong Kristine. Dahil sa tuloy-tuloy na buhos ng ulan, naging basa at marupok ang lupa sa mataas na bahagi ng lugar hanggang sa ito ay gumuho at umagos pababa.",
                type: "sanhi"
            },
            {
                text: "Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa dahil sa dalawang magkasunod na landslide. Napilitang lumikas ang mga residente at pansamantalang nanirahan sa evacuation center. Bagamat walang naiulat na nasaktan, isang 60-anyos na lalaki ang naiulat na nawawala. Patuloy ring naging mapanganib ang lugar dahil sa posibilidad ng panibagong pagguho habang isinasagawa ang clearing operations.",
                type: "epekto"
            },
            {
                text: "Agad na lumikas ang mga residente upang maiwasan ang panganib at inilipat sila sa evacuation center sa San Vicente Elementary School. Patuloy na nagsasagawa ang mga awtoridad ng search and rescue operations para sa nawawalang indibidwal at clearing operations upang alisin ang mga debris. Nagbibigay rin ng paalala ang mga awtoridad sa kahalagahan ng maagap na paglikas at pagsunod sa mga babala upang mapanatili ang kaligtasan ng komunidad.",
                type: "tugon"
            }
        ];

        shuffleArray(cards);

        let currentIndex = 0;
        const card = document.getElementById("currentCard");

        function loadCard() {
            if (currentIndex >= cards.length) {
                card.innerText = "🎉 Tapos na!";
                setTimeout(() => document.getElementById("summaryModal").style.display = "flex", 500);
                return;
            }
            card.innerText = cards[currentIndex].text;
            document.getElementById("cardCount").innerText = cards.length - currentIndex;
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

        /* LOCK SYSTEM */
        let hasRead = false, hasWatched = false;

        function markRead() { hasRead = true; readStatus.innerText = "✅"; checkUnlock(); }
        function markWatched() { hasWatched = true; watchStatus.innerText = "✅"; checkUnlock(); }

        function checkUnlock() {
            if (hasRead && hasWatched) unlockBtn.disabled = false;
        }

        function unlockActivity() {
            activitySection.classList.remove("locked");
        }

        /* MODALS */
        function openArticle() {
            document.getElementById("articleModal").style.display = "flex";
        }

        function closeArticle() {
            document.getElementById("articleModal").style.display = "none";
        }

    </script>

@endsection