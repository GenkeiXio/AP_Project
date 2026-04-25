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
            /* 🔥 makes it fill the whole screen */
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.2);
            /* dark overlay */
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .section h3 {
            margin-bottom: 10px;
        }

        .img-box {
            width: 100%;
            border-radius: 10px;
            margin: 10px 0;
        }

        .unlock-btn {
            margin-top: 15px;
            padding: 10px 18px;
            border: none;
            border-radius: 10px;
            background: #4caf50;
            color: white;
            font-weight: bold;
            cursor: pointer;
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

        .drop-zone.correct {
            background: #c8e6c9;
            border-color: green;
        }

        .drop-zone.wrong {
            background: #ffcdd2;
            border-color: red;
        }

        .source-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .source-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: #4caf50;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        #unlockBtn:disabled {
            background: gray;
            cursor: not-allowed;
        }

        .source-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            align-items: stretch;
            /* 🔥 important */
        }

        .source-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* spreads content nicely */
            min-height: 260px;
            /* 🔥 forces equal height */
        }

        .locked {
            position: relative;
            pointer-events: none;
            /* disables interaction */
            opacity: 0.6;
            filter: blur(2px);
        }

        .locked::after {
            content: "🔒 Kumpletuhin muna ang pagbasa at panonood";
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(2px);
            border-radius: 12px;
            text-align: center;
            padding: 20px;
        }

        .media-frame {
            width: 100%;
            height: 200px;
            /* same as video */
            border-radius: 10px;
            overflow: hidden;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .media-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* keeps it nice */
        }
    </style>
@endpush

@section('content')

    <div class="page">
        <section class="hero">
            <h1 class="title">NODE 2: BAHA SA GUINOBATAN, ALBAY</h1>

            <p>
                <b>Panuto:</b> Basahin at unawaing mabuti ang inilahad na balita.
                Pagkatapos, suriin ang bawat pangungusap o pahayag.
                I-drag at i-drop ang mga ito sa tamang kategorya: <b>Sanhi, Bunga, o Tugon.</b>
            </p>

            <!-- <div class="section">
                                                    <p><b>Pinagmulan:</b> Abordo, V. J. (2025)</p>
                                                    <p>
                                                        <a href="https://www.gmanetwork.com/regionaltv/news/109662/flashflood-hits-guinobatan-albay/story/"
                                                            target="_blank">
                                                            Basahin ang balita
                                                        </a>
                                                    </p>
                                                    <p>
                                                        <a href="https://www.youtube.com/watch?v=RzG1kbeyS-g" target="_blank">
                                                            Panoorin ang video
                                                        </a>
                                                    </p>
                                                </div> -->

            <div class="section" id="preActivity">

                <h3>📘 BAGO MAG-ACTIVITY: Basahin at panoorin</h3>

                <div class="source-grid">

                    <!-- ARTICLE -->
                    <div class="source-box">
                        <h4>📰 Balita</h4>

                        <!-- COVER IMAGE -->
                        <div class="media-frame">
                            <img src="{{ asset('pictures/Module4/baha/card1_1.png') }}" alt="Flashflood Cover">
                        </div>

                        <button class="source-btn" onclick="openArticle(); markRead();">
                            Basahin ang Artikulo
                        </button>

                        <div id="readStatus">❌ Hindi pa nababasa</div>
                    </div>

                    <div id="articleModal" style="
                                                            display:none;
                                                            position:fixed;
                                                            inset:0;
                                                            background:rgba(0,0,0,0.7);
                                                            z-index:9999;
                                                            justify-content:center;
                                                            align-items:center;
                                                        ">
                        <div style="background:white; width:90%; height:80%; border-radius:10px; overflow:hidden;">

                            <div style="padding:10px; display:flex; justify-content:space-between;">
                                <b>📖 Artikulo</b>
                                <button onclick="closeArticle()">✕</button>
                            </div>

                            <iframe
                                src="https://www.gmanetwork.com/regionaltv/news/109662/flashflood-hits-guinobatan-albay/story/"
                                width="100%" height="90%"></iframe>
                        </div>
                    </div>

                    <!-- VIDEO -->
                    <div class="source-box">
                        <h4>🎥 Video</h4>

                        <div class="media-frame">
                            <iframe id="ytVideo" src="https://www.youtube.com/embed/RzG1kbeyS-g" frameborder="0"
                                allowfullscreen style="width:100%; height:100%;">
                            </iframe>
                        </div>

                        <button class="source-btn" onclick="markWatched()">
                            ✔ Natapos ko panoorin
                        </button>

                        <div id="watchStatus">❌ Hindi pa napapanood</div>
                    </div>

                </div>

                <div style="text-align:center; margin-top:15px;">
                    <button id="unlockBtn" class="unlock-btn" disabled onclick="unlockActivity()">
                        🔒 I-unlock ang Activity
                    </button>
                </div>

            </div>

            <!-- DRAG DROP TABLE (placeholder UI) -->
            <div class="section locked" id="activitySection">
                <h3>📊 I-drag at i-drop ang tamang sagot</h3>

                <!-- DRAG ITEMS -->
                <div id="dragItems" style="display:flex; flex-direction:column; gap:10px; margin-bottom:20px;">

                    <div class="drag-item" draggable="true" data-type="sanhi">
                        Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa’t kalahating
                        oras at nagdala ng lahar mula sa Mayon Volcano.
                    </div>

                    <div class="drag-item" draggable="true" data-type="epekto">
                        Nagmistulang ilog ang mga kalsada at nasira ang mga bahay, kaya nagdulot ito ng panganib at
                        takot sa mga residente.
                    </div>

                    <div class="drag-item" draggable="true" data-type="tugon">
                        Agad na kumilos ang mga awtoridad sa clearing operations at nagbigay ng babala at tulong sa mga
                        apektadong residente.
                    </div>

                </div>

                <!-- DROP ZONES -->
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">

                    <div class="drop-zone" data-accept="sanhi">
                        <b>🔵 SANHI</b>
                    </div>

                    <div class="drop-zone" data-accept="epekto">
                        <b>🔴 BUNGA</b>
                    </div>

                    <div class="drop-zone" data-accept="tugon">
                        <b>🟢 MGA TUGON</b>
                    </div>

                </div>

                <button onclick="checkAnswers()" class="unlock-btn">
                    I-check ang Sagot
                </button>
            </div>
    </div>

    <!-- SUMMARY -->
    <div class="section" id="summarySection" style="display:none;">
        <h3>BUOD</h3>
        <img src="{{ asset('images/mod4_node2_summary.jpg') }}" class="img-box">
        <p>
            Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa’t kalahating oras,
            na nagpasimula ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano.
            Dahil dito, ang mga kalsada ay naging parang ilog na may dalang putik, bato, at buhangin na nagdulot ng
            panganib.
            Agad namang kumilos ang mga awtoridad sa pamamagitan ng clearing operations, pagbibigay ng babala,
            at paghahanda ng tulong. Ipinapakita nito ang kahalagahan ng paghahanda at pagtutulungan.
        </p>
    </div>

    </section>
    </div>

    <script>
        let hasRead = false;
        let hasWatched = false;

        function markRead() {
            hasRead = true;
            document.getElementById('readStatus').innerText = "✅ Nabasa na";
            checkUnlock();
        }

        function markWatched() {
            hasWatched = true;
            document.getElementById('watchStatus').innerText = "✅ Napanood na";
            checkUnlock();
        }

        function checkUnlock() {
            if (hasRead && hasWatched) {
                document.getElementById('unlockBtn').disabled = false;
            }
        }

        function unlockActivity() {
            const activity = document.getElementById('activitySection');
            activity.classList.remove('locked');
        }

        function openArticle() {
            document.getElementById('articleModal').style.display = 'flex';
        }

        function closeArticle() {
            document.getElementById('articleModal').style.display = 'none';
        }
    </script>

@endsection