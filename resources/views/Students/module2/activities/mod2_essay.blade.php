@extends('Students.studentslayout')
@section('title', 'Module 2 : Repleksyon at Feedback')

@push('styles')

    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Nunito', sans-serif;
            overflow-y: auto; 
            position: relative;
        }

        body, {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Nunito', sans-serif;
            overflow-y: hidden; 
            position: relative;
        }

        /* BACKGROUND */
        .map-wrapper {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100vh;
        }

        .background-map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* CENTER CARD (DESKTOP) */
        .essay-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 800px;
            z-index: 10;
        }

        .essay-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 2px solid #e7d7bf;
        }

        .essay-card h1 {
            font-family: "Baloo 2", cursive;
            color: #3d2a1a;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .essay-card p {
            font-weight: 700;
            color: #5a4630;
            margin-bottom: 10px;
        }

        .question {
            font-weight: 900;
            color: #3d2a1a;
        }

        textarea {
            width: 100%;
            box-sizing: border-box;
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #d7c4a3;
            margin: 15px 0;
            resize: none;
            display: block;
        }

        textarea:focus {
            outline: none;
            border: 2px solid #6dbf7e;
            box-shadow: 0 0 0 3px rgba(109, 191, 126, 0.2);
        }

        .submission-note {
            font-size: 0.95rem;
            color: #2f6c44;
            font-weight: 800;
            margin: 12px 0;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6dbf7e, #4da862);
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f0a500, #d48900);
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .btn-secondary:hover {
            transform: scale(1.05);
        }

        .btn-outline {
            background: transparent;
            color: #4da862;
            border: 2px solid #4da862;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: #4da862;
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .btn-success:hover {
            transform: scale(1.05);
        }

        .button-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .back-button {
            position: fixed;
            top: 80px;
            left: 20px;
            z-index: 100;
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            color: black;
        }

        .success-message {
            margin-top: 12px;
            color: green;
            font-weight: bold;
            text-align: center;
        }

        /* ===== MOBILE FIX ===== */
        @media (max-width: 768px) {

            body,
            html {
                height: auto;
                overflow: auto;
            }

            /* REMOVE CENTER LOCK */
            .essay-container {
                width: 100%;
                max-width: 800px;
                margin: 60px auto 30px;
                padding: 15px;
                box-sizing: border-box;
                /* 🔥 IMPORTANT */
            }

            .essay-card {
                width: 100%;
                box-sizing: border-box;
                /* 🔥 prevents overflow */
            }

            .essay-card h2 {
                font-size: 1.3rem;
                text-align: center;
            }

            .essay-card p {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .question {
                font-size: 0.95rem;
            }

            textarea {
                width: 100%;
                max-width: 100%;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            .btn-primary {
                width: 100%;
                padding: 12px;
                font-size: 14px;
            }

            .back-button {
                top: 10px;
                left: 10px;
                padding: 8px 12px;
                font-size: 13px;
            }

            /* SAFE SPACE */
            body::after {
                content: "";
                display: block;
                height: 80px;
            }
        }

        /* ===== RUBRICS MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;

            background: rgba(0, 0, 0, 0.6);

            justify-content: center;
            /* ✅ center horizontally */
            align-items: center;
            /* ✅ center vertically */
        }

        /* REMOVE margin: 5% auto ❌ */
        .modal-content {
            background: #fffaf2;
            border-radius: 18px;
            border: 3px solid #d6b98c;

            width: 90%;
            max-width: 500px;

            padding: 0;
            overflow: hidden;
        }

        .modal-title {
            text-align: center;
            font-family: "Baloo 2", cursive;
            color: #5a3d1e;
            margin-bottom: 15px;
        }

        .close-btn {
            float: right;
            font-size: 26px;
            cursor: pointer;
        }

        /* 🔥 RUBRICS MODAL (MODULE 4 STYLE) */
        .rubrics-modal {
            max-width: 500px;
            /* narrower for vertical image */
            width: 90%;
            border-radius: 20px;
            overflow: hidden;
            padding: 0;
        }

        /* HEADER */
        .rubrics-modal .modal-header {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 12px;
        }

        .rubrics-modal .modal-header h2 {
            margin: 0;
            font-family: "Baloo 2", cursive;
            color: #3d2a1a;
        }

        /* CLOSE BUTTON */
        .rubrics-modal .close-btn {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 22px;
        }

        /* BODY */
        .rubrics-modal .modal-body {
            padding: 10px;
            text-align: center;

            /* ❌ REMOVE THESE */
            max-height: none;
            overflow: hidden;
        }


        /* IMAGE */
        .rubrics-modal .modal-body img {
            width: 100%;
            height: auto;

            max-height: 75vh;
            /* ✅ fits screen WITHOUT scroll */
            object-fit: contain;
        }

        /* FOOTER */
        .rubrics-modal .modal-footer {
            display: flex;
            justify-content: center;
            padding: 12px;
        }

        /* ===== CONFIRMATION MODAL ===== */
        .confirmation-modal {
            max-width: 450px;
            width: 90%;
            border-radius: 20px;
            overflow: hidden;
            padding: 0;
            text-align: center;
        }

        .confirmation-modal .modal-header {
            padding: 20px 20px 10px;
            text-align: center;
        }

        .confirmation-modal .modal-header h2 {
            margin: 0;
            font-family: "Baloo 2", cursive;
            color: #3d2a1a;
            font-size: 1.8rem;
        }

        .confirmation-modal .modal-body {
            padding: 10px 20px 20px;
        }

        .confirmation-modal .modal-body p {
            font-size: 1rem;
            color: #5a4630;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .confirmation-modal .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: center;
            padding: 10px 20px 20px;
            flex-wrap: wrap;
        }

        .confirmation-modal .modal-footer .btn-primary,
        .confirmation-modal .modal-footer .btn-secondary,
        .confirmation-modal .modal-footer .btn-outline,
        .confirmation-modal .modal-footer .btn-success {
            min-width: 120px;
        }

        .check-icon {
            font-size: 4rem;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
<body data-submitted="{{ session('success') ? 'true' : 'false' }}">

    <div class="map-wrapper">

        <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">

        <a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

        <div class="essay-container">
            <div class="essay-card">

                <h1 class="contn">📝 REPLEKSYON AT FEEDBACK</h1>

                <p><strong>Panuto:</strong> Magbigay ng iyong repleksyon at feedback tungkol sa buong modyul na ito.</p>

                <p class="question">
                    <strong>Mga Gabay na Tanong:</strong><br><br>
                    1. Ano ang iyong natutunan sa modyul na ito tungkol sa mga suliraning pangkapaligiran?<br><br>
                    2. Paano mo mailalapat ang mga natutunan mo sa iyong pang-araw-araw na buhay bilang mag-aaral at miyembro ng komunidad?<br><br>
                    3. Ano ang iyong mga suhestiyon upang mas mapabuti pa ang nilalaman at presentasyon ng modyul na ito?<br><br>
                    4. Mayroon ka bang iba pang komento o rekomendasyon para sa guro?
                </p>

                <form id="essayForm" action="{{ route('student.module2.essay.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <textarea id="essay_answer" name="essay_answer" rows="10"
                        placeholder="Isulat dito ang iyong repleksyon at feedback..." required></textarea>

                    <div style="display:flex; justify-content:center; margin-top:10px;">
                        <button type="submit" class="btn-primary" id="submitBtn">
                            📤 Isumite ang Repleskyon
                        </button>
                    </div>
                </form>

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>

        <!-- RUBRICS MODAL (IMAGE ONLY - VERTICAL) -->
        <div id="rubricsModal" class="modal">
            <div class="modal-content rubrics-modal">

                <!-- HEADER -->
                <div class="modal-header">
                    <h2>📊 Rubrics</h2>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <img src="{{ asset('pictures/mod2_rubrics.png') }}" alt="Module 2 Rubrics">
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button class="btn-primary" onclick="closeModal()">
                        ✔ Naiintindihan ko
                    </button>
                </div>

            </div>
        </div>

        <!-- CONFIRMATION MODAL -->
        <div id="confirmationModal" class="modal">
            <div class="modal-content confirmation-modal">

                <!-- HEADER -->
                <div class="modal-header">
                    <div class="check-icon">✅</div>
                    <h2>Naitala na ang Iyong Sagot!</h2>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <p>
                        Matagumpay mong naisumite ang iyong repleksyon at feedback.<br><br>
                        Ano ang nais mong gawin?
                    </p>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button class="btn-outline" onclick="editResponse()">
                        ✏️ I-edit ang Sagot
                    </button>
                    <a href="{{ route('module2.buod') }}" class="btn-success">
                        👉 Susunod na Modyul
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Store the submitted text for editing
        let submittedText = '';

        // Handle form submission
        document.getElementById('essayForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const textarea = document.getElementById('essay_answer');
            const text = textarea.value.trim();

            if (!text) {
                alert('⚠️ Pakisulat muna ang iyong repleksyon bago isumite.');
                return;
            }

            // Store the submitted text
            submittedText = text;

            // Show confirmation modal
            document.getElementById('confirmationModal').style.display = 'flex';
        });

        // Edit response - close modal and focus on textarea
        function editResponse() {
            document.getElementById('confirmationModal').style.display = 'none';
            const textarea = document.getElementById('essay_answer');
            textarea.value = submittedText;
            textarea.focus();
            // Scroll to textarea
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Close modal functions
        function closeModal() {
            document.getElementById('rubricsModal').style.display = 'none';
        }

        // Close confirmation modal if clicked outside
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                // Don't close on outside click to prevent accidental dismissal
                return;
            }
        });

        // Show rubrics modal on load if not submitted
        document.addEventListener("DOMContentLoaded", function () {
            const submitted = document.body.getAttribute("data-submitted");

            if (submitted !== "true") {
                document.getElementById("rubricsModal").style.display = "flex";
            }
        });

        // Keyboard shortcut: Escape to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('rubricsModal').style.display = 'none';
                // Don't close confirmation modal on escape to prevent accidental dismissal
            }
        });
    </script>

</body>

@endsection