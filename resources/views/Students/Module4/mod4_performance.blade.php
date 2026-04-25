<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module 4 - Performance Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                /* 🔥 dark overlay */
                url('{{ asset('pictures/mod4_innermap.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #e2e8f0;
        }

        .container-box {
            max-width: 1100px;
            margin: auto;
            padding: 25px;
        }

        /* HEADER */
        h1 {
            text-align: center;
            font-weight: 900;
            margin-bottom: 25px;
            color: white;
        }

        /* CARD SECTIONS */
        .section {
            background: rgba(15, 23, 42, .9);
            padding: 22px;
            border-radius: 18px;
            margin-bottom: 18px;
            border: 1px solid rgba(0, 229, 255, .2);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .4);
            transition: .3s;
        }

        .section:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 229, 255, .15);
        }

        /* TITLES */
        .title {
            font-size: 18px;
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 10px;
        }

        /* HIGHLIGHT TASK ITEMS */
        .highlight {
            font-weight: 700;
            color: #22c55e;
            margin-top: 10px;
        }

        /* LIST */
        ul li {
            margin-bottom: 5px;
        }

        /* FORMAT BOX */
        .format-box {
            background: rgba(15, 23, 42, .9);
            border: 1px solid #22c55e;
        }

        /* INPUTS */
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .2);
            background: #020617;
            color: #fff;
            margin-top: 10px;
        }

        /* BUTTON */
        .btn-submit {
            margin-top: 20px;
            padding: 14px 30px;
            background: linear-gradient(135deg, #00e5ff, #22c55e);
            border: none;
            color: #020617;
            font-weight: 700;
            border-radius: 999px;
            transition: .3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 229, 255, .3);
        }

        /* SUCCESS */
        .final-message {
            margin-top: 25px;
            padding: 20px;
            border-radius: 18px;

            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(34, 197, 94, 0.4);

            color: #86efac;
            font-size: 16px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        /* MODAL */
        .modal-content {
            background: #020617;
            color: white;
            border: 1px solid rgba(0, 229, 255, .3);
        }

        .btn-understand {
            padding: 12px 28px;
            border-radius: 999px;
            border: none;
            font-weight: 600;
            font-size: 15px;

            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;

            /* box-shadow: 0 6px 15px rgba(34, 197, 94, 0.35); */
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-understand:hover {
            transform: translateY(-2px);
            /* box-shadow: 0 10px 25px rgba(34, 197, 94, 0.5); */
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .btn-understand:active {
            transform: scale(0.97);
        }

        /* NEW BUTTON STYLE (matches your theme better) */
        .btn-next {
            display: inline-block;
            margin-top: 15px;
            padding: 14px 32px;

            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;

            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;

            /* box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4); */
            transition: all 0.3s ease;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            /* box-shadow: 0 12px 30px rgba(34, 197, 94, 0.6); */
            background: linear-gradient(135deg, #16a34a, #15803d);
        }
    </style>
</head>

<body>

    <div class="container-box">

        <h1>🎯 PANGHULING GAWAIN SA PAGGANAP</h1>

        <div class="section">
            <div class="title">🧩 Pamagat:</div>
            <p><strong>“Ligtas na Komunidad: Plano ng Isang Lider”</strong></p>
        </div>

        <div class="section">
            <div class="title">🎯 Sitwasyon:</div>
            <p>👉 Ikaw ay isang Punong Barangay na haharap sa iba’t ibang hamong pangkapaligiran tulad ng bagyo, baha,
                lindol, at pagputok ng bulkan.</p>
            <p>👉 Kailangan mong bumuo ng konkretong plano upang matiyak ang:</p>
            <ul>
                <li>Kahandaan</li>
                <li>Disiplina</li>
                <li>Kooperasyon ng iyong komunidad</li>
            </ul>
        </div>

        <div class="section">
            <div class="title">📝 Gawain</div>

            <div class="p-3 mb-3 rounded" style="background:rgba(255,255,255,.05);">
                <div class="highlight">📌 1. KAHANDAAN</div>
                <small>Ano ang iyong gagawin bago ang sakuna?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(255,255,255,.05);">
                <div class="highlight">📌 2. DISIPLINA</div>
                <small>Anong mga patakaran ang ipatutupad mo?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(255,255,255,.05);">
                <div class="highlight">📌 3. KOOPERASYON</div>
                <small>Paano mo hihikayatin ang bayanihan?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(255,255,255,.05);">
                <div class="highlight">📌 4. PAGTUGON</div>
                <small>Ano ang gagawin habang may sakuna?</small>
            </div>

            <div class="p-3 rounded" style="background:rgba(255,255,255,.05);">
                <div class="highlight">📌 5. PAGBANGON</div>
                <small>Ano ang gagawin pagkatapos ng sakuna?</small>
            </div>

        </div>

        <!-- ✅ FORM START -->
        <form method="POST" action="{{ route('module4.performance.submit') }}">
            @csrf

            <div class="section format-box">
                <div class="title">🎨 FORMAT (PUMILI NG ISA):</div>

                <select name="format" required>
                    <option value="">-- Pili ng Format --</option>
                    <option value="written">📄 Written Plan</option>
                    <option value="poster">📊 Poster / Infographic</option>
                    <option value="video">🎥 Video</option>
                    <option value="slides">📱 Slides</option>
                </select>

            </div>

            <div class="section reflection-box">
                <div class="title">💬 REFLECTION (REQUIRED)</div>

                <p>👉 Sagutin sa 2–3 pangungusap:</p>
                <p><strong>“Ano ang pinakamahalagang natutunan mo sa gawaing ito bilang isang lider?”</strong></p>

                <textarea name="reflection" rows="4" required
                    placeholder="Isulat ang iyong sagot dito...">{{ old('reflection') }}</textarea>

                <button type="submit" class="btn-understand">Ipasa ang Gawain</button>

            </div>

        </form>
        <!-- ✅ FORM END -->

        <!-- ✅ SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="final-message">
                ✅ {{ session('success') }}

                <div class="final-message text-center">
                    <div class="mb-2">✅ <strong>Matagumpay na naisumite ang gawain!</strong></div>

                    <a href="{{ route('module4.buod') }}" class="btn-next">
                        📖 Magpatuloy sa Buod ng Aralin →
                    </a>
                </div>
            </div>
        @endif

        <!-- ✅ VALIDATION ERRORS -->
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <!-- RUBRICS MODAL (IMAGE ONLY) -->
    <div class="modal fade" id="rubricsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:15px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header justify-content-center position-relative">
                    <h1 class="modal-title text-center w-100">📊 <i>Rubrics</i></h1>

                    <!-- <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"> -->
                    </button>
                </div>

                <!-- BODY (IMAGE ONLY) -->
                <div class="modal-body text-center">
                    <img src="{{ asset('pictures/Module4/mod4_rubrics.png') }}" alt="Rubrics"
                        style="width:100%; border-radius:10px;">
                </div>

                <!-- FOOTER -->
                <div class="modal-footer justify-content-center">
                    <button class="btn-understand" data-bs-dismiss="modal">
                        ✔ Naiintindihan ko
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Rubrics Auto Show -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            if (!sessionStorage.getItem("module4RubricsShown")) {

                var rubricsModal = new bootstrap.Modal(document.getElementById('rubricsModal'));
                rubricsModal.show();

                sessionStorage.setItem("module4RubricsShown", "true");
            }

        });
    </script>
</body>

</html>