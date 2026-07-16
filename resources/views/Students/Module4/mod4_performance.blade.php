<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module 4 - Performance Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #1a0f0c;
            --gold-trim: #b8943e;
            --old-paper: #c9b594;
            --old-paper-dark: #b8a080;
            --ink: #0d0a08;
            --danger: #8b1a1a;
            --success: #1e6b2a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                linear-gradient(rgba(8, 5, 4, 0.75), rgba(8, 5, 4, 0.75)),
                url("{{ asset('pictures/mod4_innermap.png') }}") center center / cover no-repeat fixed;
            color: #e2e8f0;
        }

        /* Add the stardust texture overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        .container-box {
            max-width: 1100px;
            margin: auto;
            padding: 25px;
            position: relative;
            z-index: 1;
        }

        /* HEADER */
        h1 {
            text-align: center;
            font-weight: 800;
            margin-bottom: 25px;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.9);
        }

        h1 i {
            color: var(--gold-trim);
        }

        /* CARD SECTIONS - Darker vintage theme */
        .section {
            background: rgba(201, 181, 148, 0.92);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            padding: 22px;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 2px solid var(--gold-trim);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7), inset 0 0 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            color: var(--ink);
        }

        .section:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.8), inset 0 0 30px rgba(0, 0, 0, 0.15);
        }

        /* TITLES */
        .title {
            font-size: 18px;
            font-weight: 700;
            color: var(--vintage-leather);
            margin-bottom: 10px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 2px solid var(--gold-trim);
            padding-bottom: 8px;
        }

        .title i {
            color: var(--gold-trim);
            margin-right: 8px;
        }

        /* HIGHLIGHT TASK ITEMS */
        .highlight {
            font-weight: 700;
            color: var(--vintage-leather);
            margin-top: 10px;
            font-size: 1.05rem;
        }

        .highlight i {
            color: var(--gold-trim);
            margin-right: 6px;
        }

        /* LIST */
        ul li {
            margin-bottom: 5px;
            color: var(--ink);
        }

        ul li::marker {
            color: var(--gold-trim);
        }

        /* FORMAT BOX */
        .format-box {
            background: rgba(201, 181, 148, 0.92);
            border: 2px solid var(--gold-trim);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .reflection-box {
            background: rgba(201, 181, 148, 0.92);
            border: 2px solid var(--gold-trim);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .reflection-box p {
            color: var(--ink);
        }

        /* INPUTS */
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 5px;
            border: 2px solid var(--gold-trim);
            background: rgba(255, 255, 255, 0.92);
            color: var(--ink);
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--vintage-leather);
            box-shadow: 0 0 15px rgba(184, 148, 62, 0.3);
            background: #fff;
        }

        select option {
            background: #c9b594;
            color: var(--ink);
        }

        /* BUTTON - Darker vintage theme */
        .btn-understand {
            margin-top: 15px;
            padding: 12px 28px;
            border-radius: 5px;
            border: 2px solid var(--gold-trim);
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Nunito', sans-serif;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-understand:hover {
            transform: translateY(-2px);
            background: #2d1a14;
            box-shadow: 0 6px 20px rgba(26, 15, 12, 0.6);
        }

        .btn-understand:active {
            transform: scale(0.97);
        }

        /* NEXT BUTTON */
        .btn-next {
            display: inline-block;
            margin-top: 15px;
            padding: 14px 32px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 700;
            font-family: 'Nunito', sans-serif;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 2px solid var(--gold-trim);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            background: #2d1a14;
            box-shadow: 0 6px 20px rgba(26, 15, 12, 0.6);
            color: var(--gold-trim);
        }

        /* SUCCESS MESSAGE */
        .final-message {
            margin-top: 25px;
            padding: 20px 25px;
            border-radius: 8px;
            background: rgba(201, 181, 148, 0.92);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border: 2px solid var(--gold-trim);
            color: var(--ink);
            font-size: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
        }

        .final-message .text-center {
            background: transparent;
            border: none;
            box-shadow: none;
            padding: 0;
            margin-top: 15px;
        }

        /* ALERT */
        .alert-danger {
            background: rgba(201, 181, 148, 0.92);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border: 2px solid var(--danger);
            color: var(--danger);
            border-radius: 8px;
            padding: 15px 20px;
            margin-top: 15px;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-danger ul li {
            color: var(--danger);
        }

        /* MODAL - Darker vintage theme */
        .modal-content {
            background: #c9b594;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            color: var(--ink);
            border: 2px solid var(--gold-trim);
            border-radius: 8px;
        }

        .modal-header {
            background: var(--vintage-leather);
            border-bottom: 2px solid var(--gold-trim);
            border-radius: 6px 6px 0 0;
            padding: 20px 24px;
        }

        .modal-header h1 {
            color: var(--gold-trim);
            margin: 0;
            font-family: 'Nunito', sans-serif;
            text-shadow: none;
        }

        .modal-header h1 i {
            color: var(--gold-trim);
        }

        .modal-body {
            padding: 24px;
            background: #c9b594;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .modal-body img {
            border-radius: 5px;
            border: 2px solid var(--gold-trim);
        }

        .modal-footer {
            background: #c9b594;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-top: 2px solid var(--gold-trim);
            border-radius: 0 0 6px 6px;
            padding: 16px 24px 24px;
        }

        .modal-footer .btn-understand {
            margin-top: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-box {
                padding: 15px;
            }

            .section {
                padding: 16px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .title {
                font-size: 16px;
            }

            .btn-understand,
            .btn-next {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .modal-header h1 {
                font-size: 1.3rem;
            }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--vintage-leather);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gold-trim);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d4b06a;
        }
    </style>
</head>

<body>

    <div class="container-box">

        <h1><i class="fas fa-tasks"></i> PANGHULING GAWAIN SA PAGGANAP</h1>

        <div class="section">
            <div class="title"><i class="fas fa-puzzle-piece"></i> Pamagat:</div>
            <p><strong>“Ligtas na Komunidad: Plano ng Isang Lider”</strong></p>
        </div>

        <div class="section">
            <div class="title"><i class="fas fa-bullseye"></i> Sitwasyon:</div>
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
            <div class="title"><i class="fas fa-clipboard-list"></i> Gawain</div>

            <div class="p-3 mb-3 rounded" style="background:rgba(26, 15, 12, 0.10); border-radius:5px;">
                <div class="highlight"><i class="fas fa-shield-alt"></i> 1. KAHANDAAN</div>
                <small style="color: var(--ink); opacity:0.75;">Ano ang iyong gagawin bago ang sakuna?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(26, 15, 12, 0.10); border-radius:5px;">
                <div class="highlight"><i class="fas fa-gavel"></i> 2. DISIPLINA</div>
                <small style="color: var(--ink); opacity:0.75;">Anong mga patakaran ang ipatutupad mo?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(26, 15, 12, 0.10); border-radius:5px;">
                <div class="highlight"><i class="fas fa-handshake"></i> 3. KOOPERASYON</div>
                <small style="color: var(--ink); opacity:0.75;">Paano mo hihikayatin ang bayanihan?</small>
            </div>

            <div class="p-3 mb-3 rounded" style="background:rgba(26, 15, 12, 0.10); border-radius:5px;">
                <div class="highlight"><i class="fas fa-ambulance"></i> 4. PAGTUGON</div>
                <small style="color: var(--ink); opacity:0.75;">Ano ang gagawin habang may sakuna?</small>
            </div>

            <div class="p-3 rounded" style="background:rgba(26, 15, 12, 0.10); border-radius:5px;">
                <div class="highlight"><i class="fas fa-hand-holding-heart"></i> 5. PAGBANGON</div>
                <small style="color: var(--ink); opacity:0.75;">Ano ang gagawin pagkatapos ng sakuna?</small>
            </div>

        </div>

        <!-- FORM START -->
        <form method="POST" action="{{ route('module4.performance.submit') }}">
            @csrf

            <div class="section format-box">
                <div class="title"><i class="fas fa-palette"></i> FORMAT (PUMILI NG ISA):</div>

                <select name="format" required>
                    <option value="">-- Pili ng Format --</option>
                    <option value="written">📄 Written Plan</option>
                    <option value="poster">📊 Poster / Infographic</option>
                    <option value="video">🎥 Video</option>
                    <option value="slides">📱 Slides</option>
                </select>

            </div>

            <div class="section reflection-box">
                <div class="title"><i class="fas fa-comment-dots"></i> REFLECTION (REQUIRED)</div>

                <p>👉 Sagutin sa 2–3 pangungusap:</p>
                <p><strong>“Ano ang pinakamahalagang natutunan mo sa gawaing ito bilang isang lider?”</strong></p>

                <textarea name="reflection" rows="4" required
                    placeholder="Isulat ang iyong sagot dito...">{{ old('reflection') }}</textarea>

                <button type="submit" class="btn-understand"><i class="fas fa-paper-plane"></i> Ipasa ang Gawain</button>

            </div>

        </form>
        <!-- FORM END -->

        <!-- SUCCESS MESSAGE -->
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

        <!-- VALIDATION ERRORS -->
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
            <div class="modal-content" style="border-radius:8px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header justify-content-center position-relative">
                    <h1><i class="fas fa-star"></i> Rubrics</h1>
                </div>

                <!-- BODY (IMAGE ONLY) -->
                <div class="modal-body text-center">
                    <img src="{{ asset('pictures/Module4/mod4_rubrics.png') }}" alt="Rubrics"
                        style="width:100%; border-radius:5px;">
                </div>

                <!-- FOOTER -->
                <div class="modal-footer justify-content-center">
                    <button class="btn-understand" data-bs-dismiss="modal">
                        <i class="fas fa-check"></i> Naiintindihan ko
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Rubrics Auto Show -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            if (!sessionStorage.getItem("module4RubricsShown")) {

                var rubricsModal = new bootstrap.Modal(document.getElementById('rubricsModal'));
                rubricsModal.show();

                sessionStorage.setItem("module4RubricsShown", "true");
            }

        });
    </script>
</body>

</html>