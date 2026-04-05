<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply Activity - Bagyo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        /* HEADER */
        .title {
            font-weight: bold;
            letter-spacing: 1px;
            color: #0d47a1;
        }

        /* GAME HEADER CARDS */
        .game-header .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .game-header .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* INSTRUCTION BOX */
        .game-header div[style*="background:#d1e7dd"] {
            font-size: 15px;
        }

        /* BLUE CONTAINER (LIKE PAGASA) */
        .wind-banner {
            background: linear-gradient(to right, #1e73be, #0d47a1);
            padding: 20px;
            border-radius: 15px;
        }

        /* ROW STYLE */
        .wind-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        /* EACH SIGNAL */
        .wind-box {
            flex: 1;
            text-align: center;
            padding: 10px;
        }

        .wind-img {
            width: 100%;
            max-width: 150px;
            cursor: pointer;
            transition: transform 0.25s, box-shadow 0.25s;
            border-radius: 10px;
        }

        .wind-img:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .modal-backdrop.show {
            opacity: 0.9;
        }

        .source {
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }

        .source a {
            color: #0d6efd;
            text-decoration: none;
        }

        .source a:hover {
            text-decoration: underline;
        }

        .game-header .card {
            background: #ffffff;
            transition: transform 0.2s;
        }

        .game-header .card:hover {
            transform: scale(1.02);
        }

        .title {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .container {
            padding-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container text-center mt-4">

    <!-- GAME HEADER -->
    <div class="game-header text-center mb-4">

        <h1 class="title">🌪️ MISYON: BAGYO</h1>

        <!-- OBJECTIVE -->
        <div class="card shadow p-3 mt-3 border-0" style="border-radius:15px; background:#e3f2fd;">
            <h4>🎯 Layunin ng Misyon</h4>
            <p>
                Tuklasin kung paano nakaaapekto ang 
                <strong>hazard</strong>, 
                <strong>vulnerability</strong>, at 
                <strong>risk</strong> 
                sa pagkakaroon ng sakuna.
            </p>
        </div>

        <!-- CHALLENGE -->
        <div class="card shadow p-3 mt-3 border-0" style="border-radius:15px; background:#fff3cd;">
            <h4>🧠 Iyong Hamon</h4>
            <p>
                Alamin kung paano magiging handa 
                <strong>bago</strong>, 
                <strong>habang</strong>, at 
                <strong>pagkatapos</strong> ng bagyo.
            </p>
        </div>

        <!-- INSTRUCTION -->
        <div class="mt-3 p-3" style="background:#d1e7dd; border-radius:12px;">
            🎮 <strong>Paano Laruin:</strong><br>
            I-click ang bawat <strong>wind signal</strong> upang makita ang epekto at impormasyon nito.
        </div>

    </div>

    <!-- PAGASA STYLE BANNER -->
    <div class="wind-banner mt-4">
        <div class="wind-row">

            <div class="wind-box">
                <img src="{{ asset('pictures/Module 3/Apply/wind1.png') }}"
                     class="wind-img wind-signal"
                     data-img="{{ asset('pictures/Module 3/Apply/wind1_modal.png') }}">
            </div>

            <div class="wind-box">
                <img src="{{ asset('pictures/Module 3/Apply/wind2.png') }}"
                     class="wind-img wind-signal"
                     data-img="{{ asset('pictures/Module 3/Apply/wind2_modal.png') }}">
            </div>

            <div class="wind-box">
                <img src="{{ asset('pictures/Module 3/Apply/wind3.png') }}"
                     class="wind-img wind-signal"
                     data-img="{{ asset('pictures/Module 3/Apply/wind3_modal.png') }}">
            </div>

            <div class="wind-box">
                <img src="{{ asset('pictures/Module 3/Apply/wind4.png') }}"
                     class="wind-img wind-signal"
                     data-img="{{ asset('pictures/Module 3/Apply/wind4_modal.png') }}">
            </div>

            <div class="wind-box">
                <img src="{{ asset('pictures/Module 3/Apply/wind5.png') }}"
                     class="wind-img wind-signal"
                     data-img="{{ asset('pictures/Module 3/Apply/wind5_modal.png') }}">
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="popupModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-transparent border-0">

                <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-4"
                        style="z-index: 10;"
                        data-bs-dismiss="modal">
                </button>

                <div class="d-flex justify-content-center align-items-center vh-100">
                    <img id="popupImage"
                         style="max-width:95%; max-height:95vh; object-fit:contain;">
                </div>

            </div>
        </div>
    </div>
    
    <!-- SOURCE -->
    <div class="source mt-3">
        Source:
        <a href="https://www.pagasa.dost.gov.ph/learning-tools/tropical-cyclone-wind-signal" target="_blank">
            PAGASA Tropical Cyclone Wind Signal
        </a>
    </div>

    <!-- VIDEO -->
    <div class="mt-5">
        <h4 class="mb-3">📺 Mga Dapat Gawin</h4>

        <div class="d-flex justify-content-center">
            <iframe width="800" height="400"
                src="https://www.youtube.com/embed/5MP0TxfEWyA"
                frameborder="0"
                allowfullscreen
                style="border-radius:12px;">
            </iframe>
        </div>
    </div>

    <!-- NEXT BUTTON -->
    <div class="mt-4 mb-5">
        <a href="{{ route('gobag.activity') }}" class="btn btn-primary btn-lg px-4 py-2" style="border-radius:12px;">
            Magpatuloy sa susunod na aktibidad 🎒
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.wind-signal').forEach(img => {
    img.addEventListener('click', function() {
        document.getElementById('popupImage').src = this.dataset.img;

        let modal = new bootstrap.Modal(document.getElementById('popupModal'));
        modal.show();
    });
});
</script>

</body>
</html>