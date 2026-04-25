@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 2')

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

        /* GRID */
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
        }

        /* MEDIA */
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

        /* BUTTONS */
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
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.6);
            pointer-events: none;
            /* 🔥 IMPORTANT FIX */
        }

        /* DROP */
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

        /* MODAL */
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

            <h1 class="title">NODE 2: BAHA SA GUINOBATAN, ALBAY</h1>

            <p>
                <b>Panuto:</b> Basahin at unawaing mabuti ang balita.
                I-drag at i-drop sa tamang kategorya.
            </p>

            <!-- PRE -->
            <div class="section">

                <div class="source-grid">

                    <div class="source-box">
                        <h4>📰 Balita</h4>

                        <div class="media-frame">
                            <img src="{{ asset('pictures/Module4/baha/card1_1.png') }}">
                        </div>

                        <button class="source-btn" onclick="openArticle(); markRead();">
                            Basahin ang Artikulo
                        </button>

                        <div id="readStatus">❌ Hindi pa nababasa</div>
                    </div>

                    <div class="source-box">
                        <h4>🎥 Video</h4>

                        <div class="media-frame">
                            <iframe src="https://www.youtube.com/embed/RzG1kbeyS-g"></iframe>
                        </div>

                        <button class="source-btn" onclick="markWatched()">
                            ✔ Natapos ko panoorin
                        </button>

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

                <div
                    style="background:white; width:90%; max-width:600px; border-radius:12px; padding:20px; text-align:center;">

                    <h3>📘 BUOD</h3>

                    <p>
                        Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa’t kalahating
                        oras, na nagpasimula ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano. Dahil dito,
                        ang mga kalsada ay naging parang ilog na may dalang putik, bato, at buhangin na nagdulot ng panganib
                        sa mga residente, bahay, at kabuhayan. Agad namang kumilos ang mga awtoridad sa pamamagitan ng
                        clearing operations, pagbibigay ng babala, at paghahanda ng tulong para sa mga apektado. Ipinapakita
                        ng pangyayaring ito ang kahalagahan ng maagap na paghahanda, pagsunod sa babala, at pagtutulungan ng
                        komunidad upang maiwasan ang mas matinding pinsala at mapanatili ang kaligtasan ng lahat.

                    </p>

                    <div style="margin-top:15px; display:flex; gap:10px; justify-content:center;">

                        <a href="{{ route('inner.map4') }}" class="unlock-btn">
                            🗺️ Bumalik sa Mapa
                        </a>

                    </div>

                </div>

            </div>

            <!-- MODAL -->
            <div id="articleModal" class="modal">
                <div style="background:white;width:90%;height:80%;border-radius:10px;overflow:hidden;">
                    <div style="padding:10px;display:flex;justify-content:space-between;">
                        <b>📖 Artikulo</b>
                        <button onclick="closeArticle()">✕</button>
                    </div>

                    <iframe src="https://www.gmanetwork.com/regionaltv/news/109662/flashflood-hits-guinobatan-albay/story/"
                        width="100%" height="90%"></iframe>
                </div>
            </div>

        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }

            const cards = [
                { text: 
                    "Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa’t kalahating oras. Dahil sa lakas ng buhos ng ulan, nagkaroon ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano, na mabilis na bumaba mula sa kabundukan patungo sa mga mababang lugar.", 
                    
                    type: "sanhi" 
                },
                { text: 
                    "Nagmistulang ilog ang mga kalsada dahil sa rumaragasang baha na may dalang putik, bato, at buhangin. Nagdulot ito ng panganib sa mga residente, nasira ang ilang bahay, at naapektuhan ang kabuhayan ng mga tao sa lugar. Ang mabilis na pagtaas ng tubig ay nagdulot ng takot at pinsala sa komunidad.", 
                    type: "epekto" 
                },
                { text: 
                    "Agad na kumilos ang mga awtoridad sa pamamagitan ng clearing operations upang alisin ang putik at debris sa mga kalsada. Nagbigay rin sila ng mga babala at naghanda ng tulong para sa mga apektadong residente. Ipinakita ng pangyayaring ito ang kahalagahan ng maagap na paghahanda, pagsunod sa mga babala, at pagtutulungan ng komunidad upang maiwasan ang mas matinding pinsala at mapanatili ang kaligtasan ng lahat.", 
                    
                    type: "tugon" 
                }
            ];

            shuffleArray(cards);

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
                e.dataTransfer.setData("type", cards[currentIndex].type);
                e.dataTransfer.setData("text", cards[currentIndex].text);
            });

            document.querySelectorAll(".drop-zone").forEach(zone => {
                zone.addEventListener("dragover", e => e.preventDefault());

                zone.addEventListener("drop", e => {
                    e.preventDefault();

                    let type = e.dataTransfer.getData("type");
                    let text = e.dataTransfer.getData("text");

                    let accept = zone.parentElement.getAttribute("data-accept");

                    if (type === accept) {
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

            window.markRead = function () {
                hasRead = true;
                document.getElementById("readStatus").innerText = "✅ Nabasa na";
                checkUnlock();
            }

            window.markWatched = function () {
                hasWatched = true;
                document.getElementById("watchStatus").innerText = "✅ Napanood na";
                checkUnlock();
            }

            function checkUnlock() {
                if (hasRead && hasWatched) {
                    document.getElementById("unlockBtn").disabled = false;
                }
            }

            window.unlockActivity = function () {
                document.getElementById("activitySection").classList.remove("locked");
            }

            /* MODAL */
            window.openArticle = function () {
                document.getElementById("articleModal").style.display = "flex";
            }

            window.closeArticle = function () {
                document.getElementById("articleModal").style.display = "none";
            }

            window.closeSummary = function () {
                document.getElementById("summaryModal").style.display = "none";
            }

        });
    </script>

@endsection