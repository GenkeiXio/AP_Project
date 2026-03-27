<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hamon at Tugon: Module 2</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <style>
        .module-container {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .module-title {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .home-btn {
            position: fixed; /* stays visible even on scroll */
            top: 20px;
            left: 20px; /* move to top-left for visibility */
            font-size: 1.8rem; /* bigger icon */
            text-decoration: none;
            
            color: #000; /* black icon for contrast */
            padding: 10px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            z-index: 1000; /* ensure it’s on top of other elements */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .home-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 10px rgba(0,0,0,0.3);
        }

        .modal {
            display: none; /* default hidden */

            position: fixed;
            z-index: 9999;

            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;

            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            border-radius: 0 !important; /* 👈 remove any rounding */

            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        /* ✅ ACTIVE STATE */
        .modal.show {
            display: flex; /* 👈 KEEP FLEX ALWAYS */
        }

        /* ✨ POPUP CARD */
        .modal-content {
            background: #ffffff;
            padding: 30px 28px;
            width: 90%;
            max-width: 650px;
            border-radius: 20px;
            text-align: left;

            /* ✨ Soft shadow */
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);

            /* ✨ Animation */
            animation: popIn 0.35s ease;

            max-height: 85vh;
            overflow-y: auto;
        }

        /* ✨ Animation */
        @keyframes popIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* ✨ CLOSE BUTTON */
        .close-btn {
            float: right;
            font-size: 1.6rem;
            cursor: pointer;
            font-weight: bold;
            color: #555;
            transition: 0.2s;
        }

        .close-btn:hover {
            color: red;
            transform: scale(1.2);
        }

        /* ✨ SECTION CARDS */
        .modal-section {
            background: #f8fdf8;
            border-left: 6px solid #2e7d32;
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 12px;
        }

        /* ✨ HEADINGS */
        .modal-section h3 {
            margin-bottom: 10px;
            font-size: 1rem;
            font-weight: 800;
            color: #1b5e20;
        }

        /* ✨ TEXT */
        .modal-section p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #333;
            margin-bottom: 10px;
        }

        /* ✨ LIST */
        .modal-section ul {
            padding-left: 18px;
        }

        .modal-section li {
            margin-bottom: 6px;
        }

        #startBtn.disabled {
            background: gray;
            cursor: not-allowed;
            opacity: 0.6;
        }
    </style>
</head>

<body>

<!-- Decorations -->
<!-- <span class="deco deco-1">🌿</span> -->
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<a href="{{ route('home') }}" class="home-btn">🏠</a>

<div class="main-wrapper">

    <div class="module-container">

        <!-- Header -->
        <div class="header">
            <div class="header-icons">🧭 🗺️ ✨</div>
            <div class="subtitle">Module 2</div>
            <h1>Kalagayan, Suliranin at Pagtugon sa Isyung Pangkapaligiran ng Pilipinas</h1>
        </div>

        

        <!-- Goals Button -->
        <button onclick="openModal()" class="btn-primary" style="margin-top: 25px;">
            Mga Layunin 🎯
        </button>

        <!-- Modal -->
        <div id="goalsModal" class="modal">
            <div class="modal-content">

                <span class="close-btn" onclick="closeModal()">✖</span>

                <div class="modal-section">
                    <h3>📘 PAMANTAYANG PANGNILALAMAN</h3>
                    <p>
                        Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.
                    </p>
                </div>

                <div class="modal-section">
                    <h3>🎯 PAMANTAYAN SA PAGGANAP</h3>
                    <p>
                        Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.
                    </p>
                </div>

                <div class="modal-section">
                    <h3>🌱 KASANAYAN SA PAGKATUTO</h3>
                    <p>Natatalakay ang kalagayan, suliranin at pagtugon sa isyung pangkapaligiran ng Pilipinas:</p>
                    <ul>
                        <li>Nailalarawan ang kasalukuyang kalagayan...</li>
                        <li>Nailalahad at nasusuri ang mga epekto...</li>
                        <li>Napahahalagahan ang pakikiisa...</li>
                        <li>Nakabubuo ng proyekto para sa kalikasan</li>
                    </ul>
                </div>

                <div class="modal-section">
                    <h3>📚 PAKSANG ARALIN</h3>
                    <p>
                        • Kalagayan at Suliranin sa mga Isyung Pangkapaligiran sa Pilipinas <br>
                        • Pagtugon sa mga Isyung Pangkapaligiran sa Pilipinas
                    </p>
                </div>

            </div>
        </div>

        <!-- Start Button -->
        <button id="startBtn" onclick="startLesson()" class="btn-primary disabled" style="margin-top: 25px;">
            Simulan 🚀
        </button>

    </div>

</div>

<script>
    let hasOpenedGoals = false;

    function openModal() {
        document.getElementById("goalsModal").classList.add("show");

        hasOpenedGoals = true;

        // enable button
        document.getElementById("startBtn").classList.remove("disabled");
    }

    function closeModal() {
        document.getElementById("goalsModal").classList.remove("show");
    }

    function startLesson() {
        if (!hasOpenedGoals) {
            alert("Basahin muna ang Goals bago magpatuloy 😊");
            return;
        }

        window.location.href = '{{ route("pretest.module2") }}';
    }

    // close when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById("goalsModal");
        if (event.target === modal) {
            modal.classList.remove("show");
        }
    }
</script>

</body>
</html>