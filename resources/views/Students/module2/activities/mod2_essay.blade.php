<!DOCTYPE html>
<html lang="fil">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanaysay – Modyul 2</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
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
            /* 🔥 move fixed here instead */
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

        .button-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .back-button {
            position: fixed;
            top: 20px;
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
    </style>
</head>

<body data-submitted="{{ session('success') ? 'true' : 'false' }}">

    <div class="map-wrapper">

        <img src="{{ asset('pictures/mod2_innermap.png') }}" class="background-map">

        <a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

        <div class="essay-container">
            <div class="essay-card">

                <h1 class="contn">MAIKLING SANAYSAY</h1>

                <p><strong>Panuto:</strong> Ibigay ang iyong opinyon at isulat ang sagot sa ibaba.</p>

                <p class="question">
                    Bilang isang mag-aaral at miyembro ng komunidad, paano ka makatutulong sa pagtugon sa mga suliraning
                    pangkapaligiran tulad ng
                    <strong>basurang solido, pagkakalbo ng kagubatan, at pagbabago ng klima</strong>?
                </p>

                <p>
                    Magbigay ng ebidensya ng iyong mga gawain (hal. paglilinis ng kapaligiran, pagtatanim ng puno) sa
                    pamamagitan ng larawan o video.
                </p>

                <form action="{{ route('student.module2.essay.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- FIXED TEXTAREA ID -->
                    <textarea id="essay_answer" name="essay_answer" rows="8"
                        placeholder="Ilagay dito ang iyong sagot..." required></textarea>

                    <div style="display:flex; justify-content:center; margin-top:10px;">
                        <button type="submit" class="btn-primary">
                            📤 Isumite ang Sanaysay
                        </button>
                    </div>
                </form>

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="submission-note">
                    📩 <strong>Paraan ng Pagsusumite:</strong><br><br>
                    Kopyahin ang iyong sagot at ipadala ito sa email ng iyong guro.<br><br>
                    <strong>Email:</strong> teacher@gmail.com
                </p>

                <div class="button-group">
                    <button class="btn-primary" onclick="copyAnswer()">📋 Kopyahin ang Sagot</button>

                    <a href="https://mail.google.com/" target="_blank" class="btn-primary">
                        📧 Buksan ang Email
                    </a>
                </div>

                <div id="copyMessage" class="success-message" style="display:none;">
                    ✅ Nakopya na ang sagot!
                </div>

                <div style="text-align:center; margin-top:15px;">
                    <a href="{{ route('module2.buod') }}" class="btn-primary">
                        👉 Magpatuloy sa Susunod
                    </a>
                </div>

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
    </div>

    <script>
        function copyAnswer() {
            const text = document.getElementById("essay_answer").value;

            if (!text.trim()) {
                alert("⚠️ Wala pang nakalagay na sagot.");
                return;
            }

            navigator.clipboard.writeText(text).then(() => {
                const msg = document.getElementById("copyMessage");
                msg.style.display = "block";

                setTimeout(() => {
                    msg.style.display = "none";
                }, 2000);
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const submitted = document.body.getAttribute("data-submitted");

            if (submitted !== "true") {
                document.getElementById("rubricsModal").style.display = "flex";
            }
        });

        function closeModal() {
            document.getElementById("rubricsModal").style.display = "none";
        }
    </script>

</body>

</html>