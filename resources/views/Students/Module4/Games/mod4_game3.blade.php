@extends('Students.studentslayout')
@section('title', 'Drag & Drop Activity - Lindol sa Bogo City')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
            --success: #2e7d32;
            --error: #c62828;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background:
                linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
                url("{{ asset('pictures/mod4_innermap.png') }}") center center / cover no-repeat fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            padding: 25px 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .game-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2);
            padding: 30px 30px 40px;
            border: 2px solid var(--gold-trim);
            position: relative;
        }

        h1 {
            font-weight: 800;
            font-size: 2rem;
            color: var(--ink);
            margin-bottom: 6px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 2px solid var(--ink);
            padding-bottom: 10px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.3rem;
            }
        }

        h1 i {
            color: var(--danger);
            margin-right: 12px;
        }

        .subhead {
            color: var(--ink);
            font-size: 1rem;
            border-left: 5px solid var(--gold-trim);
            padding-left: 18px;
            margin: 10px 0 25px;
        }

        @media (max-width: 768px) {
            .subhead {
                font-size: 0.8rem;
            }
        }

        /* Main Layout: Left (Categories) + Right (Description) */
        .game-layout {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-top: 20px;
        }

        @media (max-width: 992px) {
            .game-layout {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        /* LEFT SIDE - Categories (Clickable) */
        .categories-side {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-item {
            background: rgba(244, 228, 199, 0.6);
            border-radius: 8px;
            border: 3px solid var(--gold-trim);
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .category-item:hover:not(.filled):not(.disabled) {
            transform: scale(1.03);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            border-color: #c5a059;
        }

        .category-item:active:not(.filled):not(.disabled) {
            transform: scale(0.97);
        }

        .category-item.filled {
            border-color: var(--success);
            background: rgba(46, 125, 50, 0.15);
            cursor: default;
        }

        .category-item.filled:hover {
            transform: none;
            box-shadow: none;
        }

        .category-item.correct-highlight {
            border-color: var(--success);
            box-shadow: 0 0 25px rgba(46, 125, 50, 0.4);
            background: rgba(46, 125, 50, 0.2);
        }

        .category-item.wrong-highlight {
            border-color: var(--error);
            box-shadow: 0 0 25px rgba(198, 40, 40, 0.4);
            background: rgba(198, 40, 40, 0.2);
            animation: shakeCard 0.5s ease-in-out;
        }

        .category-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @keyframes shakeCard {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-12px); }
            40% { transform: translateX(12px); }
            60% { transform: translateX(-8px); }
            80% { transform: translateX(8px); }
        }

        .category-header {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--gold-trim);
            pointer-events: none;
        }

        .cat-icon {
            font-size: 1.4rem;
        }

        @media (max-width: 768px) {
            .cat-icon {
                font-size: 1.2rem;
            }
        }

        .cat-image {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        @media (max-width: 768px) {
            .cat-image {
                width: 26px;
                height: 26px;
            }
        }

        .cat-label {
            font-size: 1.1rem;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            flex: 1;
        }

        @media (max-width: 768px) {
            .cat-label {
                font-size: 0.95rem;
            }
        }

        .cat-status {
            font-size: 1.3rem;
            margin-left: auto;
            pointer-events: none;
        }

        .cat-click-hint {
            font-size: 0.7rem;
            opacity: 0.7;
            font-weight: 400;
            margin-left: 8px;
            pointer-events: none;
        }

        .category-dropzone {
            min-height: 80px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.3);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            transition: all 0.3s ease;
            border-radius: 0 0 6px 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .category-dropzone .placeholder-text {
            color: #8b6b3f;
            font-style: italic;
            font-size: 0.85rem;
            opacity: 0.6;
        }

        .category-dropzone .statement-card {
            width: 100%;
            cursor: default;
            pointer-events: none;
            font-size: 0.82rem;
            padding: 10px 12px;
            margin: 0;
        }

        .category-dropzone .statement-card .card-header-image {
            margin-bottom: 6px;
        }

        .category-dropzone .statement-card .card-header-image img {
            width: 30px;
            height: 30px;
        }

        .category-dropzone .statement-card .card-text-content {
            font-size: 0.8rem;
            line-height: 1.4;
        }

        /* RIGHT SIDE - Description Card */
        .description-side {
            display: flex;
            flex-direction: column;
        }

        .description-card-container {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            padding: 30px;
            border: 2px solid var(--gold-trim);
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.3);
            flex: 1;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .description-card-container {
                padding: 20px;
                min-height: 200px;
            }
        }

        .description-progress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--old-paper);
        }

        .progress-text {
            font-weight: 600;
            color: var(--ink);
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .progress-text {
                font-size: 0.8rem;
            }
        }

        .progress-dots {
            display: flex;
            gap: 8px;
        }

        .progress-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #d9c5a3;
            border: 2px solid #8b6b3f;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .progress-dot {
                width: 10px;
                height: 10px;
            }
        }

        .progress-dot.active {
            background: var(--gold-trim);
            border-color: var(--vintage-leather);
            transform: scale(1.2);
        }

        .progress-dot.completed {
            background: var(--success);
            border-color: var(--success);
        }

        .description-content {
            text-align: center;
            padding: 10px 0;
        }

        .description-content .card-header-image {
            margin-bottom: 15px;
        }

        .description-content .card-header-image img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .description-content .card-header-image img {
                width: 45px;
                height: 45px;
            }
        }

        .description-content .description-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--ink);
            font-weight: 500;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .description-content .description-text {
                font-size: 0.85rem;
                line-height: 1.6;
            }
        }

        .description-hint {
            margin-top: 20px;
            padding: 12px;
            background: rgba(43, 27, 23, 0.05);
            border-radius: 5px;
            border: 1px dashed var(--gold-trim);
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .description-hint i {
            color: var(--gold-trim);
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .description-hint {
                font-size: 0.75rem;
                padding: 10px;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .description-content.slide-in {
            animation: slideIn 0.4s ease-out;
        }

        /* Completion Message */
        .completion-message {
            text-align: center;
            padding: 20px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--success);
        }

        .completion-message i {
            font-size: 3rem;
            display: block;
            margin-bottom: 15px;
        }

        /* Buttons */
        .reset-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 10px 20px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .reset-btn {
                padding: 8px 16px;
                font-size: 0.75rem;
                width: 100%;
                justify-content: center;
            }
        }

        .reset-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }

        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 25px;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .game-controls {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .completion-badge {
            background: #d9c5a3;
            color: var(--ink);
            padding: 6px 15px;
            border-radius: 3px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #8b6b3f;
            font-family: 'Nunito', sans-serif;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .completion-badge {
                font-size: 0.7rem;
                width: 100%;
                justify-content: center;
            }
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background: var(--vintage-leather);
            padding: 8px 15px;
            border-radius: 3px;
            text-decoration: none;
            color: var(--gold-trim);
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
            border: 1px solid var(--gold-trim);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .back-button {
                top: 10px;
                left: 10px;
                padding: 5px 10px;
                font-size: 0.65rem;
            }
        }

        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 8, 7, 0.9);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            max-width: 600px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            border: 2px solid var(--gold-trim);
        }

        .modal-overlay.show .modal-container {
            transform: scale(1);
        }

        .modal-header {
            background: var(--vintage-leather);
            padding: 20px 24px;
            border-bottom: 1px solid var(--gold-trim);
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--gold-trim);
            font-family: 'Nunito', sans-serif;
        }

        @media (max-width: 768px) {
            .modal-header {
                padding: 16px 18px;
            }
            .modal-header h2 {
                font-size: 1.2rem;
            }
        }

        .modal-body {
            padding: 24px;
        }

        @media (max-width: 768px) {
            .modal-body {
                padding: 18px;
            }
        }

        .modal-body p {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--ink);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .modal-body p {
                font-size: 0.85rem;
            }
        }

        .modal-footer {
            padding: 16px 24px 24px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .modal-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 24px;
            border-radius: 3px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Nunito', sans-serif;
        }

        @media (max-width: 768px) {
            .modal-btn {
                padding: 10px 18px;
                font-size: 0.8rem;
                width: 100%;
                justify-content: center;
            }
        }

        .modal-btn:hover {
            background: #3d2a25;
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <a href="{{ route('module4.node3') }}" class="back-button">⬅️ Bumalik</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div>
                <h1><i class="fas fa-house-damage"></i> Sanhi, Epekto, at Mga Tugon</h1>
                <p class="subhead"><i class="fas fa-hand-peace me-2"></i> <b>Panuto:</b> Basahin ang paglalarawan at i-tap ang tamang kategorya sa kaliwa.</p>
            </div>

            <!-- Main Layout: Left (Categories) + Right (Description) -->
            <div class="game-layout">
                <!-- LEFT SIDE - Categories (Clickable) -->
                <div class="categories-side">
                    <!-- SANHI -->
                    <div class="category-item" id="catSanhi" data-category="sanhi">
                        <div class="category-header">
                            <img src="{{ asset('pictures/sanhi-icon.png') }}" alt="Sanhi" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-cloud-rain cat-icon"></i>
                            <span class="cat-label">SANHI</span>
                            <span class="cat-status" id="statusSanhi"></span>
                        </div>
                        <div class="category-dropzone" id="dropzoneSanhi">
                            <span class="placeholder-text">⬇️ Ilalagay dito ang sanhi</span>
                        </div>
                    </div>

                    <!-- EPEKTO -->
                    <div class="category-item" id="catEpekto" data-category="epekto">
                        <div class="category-header">
                            <img src="{{ asset('pictures/epekto-icon.png') }}" alt="Epekto" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-house-damage cat-icon"></i>
                            <span class="cat-label">EPEKTO</span>
                            <span class="cat-status" id="statusEpekto"></span>
                        </div>
                        <div class="category-dropzone" id="dropzoneEpekto">
                            <span class="placeholder-text">⬇️ Ilalagay dito ang epekto</span>
                        </div>
                    </div>

                    <!-- MGA TUGON -->
                    <div class="category-item" id="catTugon" data-category="tugon">
                        <div class="category-header">
                            <img src="{{ asset('pictures/tugon-icon.png') }}" alt="Tugon" class="cat-image" onerror="this.style.display='none'">
                            <i class="fas fa-hand-holding-heart cat-icon"></i>
                            <span class="cat-label">MGA TUGON</span>
                            <span class="cat-status" id="statusTugon"></span>
                        </div>
                        <div class="category-dropzone" id="dropzoneTugon">
                            <span class="placeholder-text">⬇️ Ilalagay dito ang tugon</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - Description Card -->
                <div class="description-side">
                    <div class="description-card-container">
                        <div class="description-progress">
                            <span class="progress-text" id="progressText">Tanong 1 ng 3</span>
                            <div class="progress-dots" id="progressDots">
                                <span class="progress-dot active" data-index="0"></span>
                                <span class="progress-dot" data-index="1"></span>
                                <span class="progress-dot" data-index="2"></span>
                            </div>
                        </div>
                        <div class="description-content slide-in" id="descriptionContent">
                            <!-- Dynamically populated -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Game Controls -->
            <div class="game-controls">
                <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang Aktibidad</button>
                <div id="completionStatus"></div>
            </div>
        </div>
    </div>

    <!-- Summary Modal -->
    <div id="summaryModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h2><i class="fas fa-clipboard-list"></i> 📖 BUOD</h2>
            </div>
            <div class="modal-body">
                <p>Ang magnitude 6.9 na lindol na tumama sa Bogo City ay nagdulot ng matinding pinsala sa buhay at ari-arian, kung saan umabot sa 69 ang nasawi at 175 ang nasugatan dahil sa mga gumuhong gusali at bahay. Maraming residente ang napilitang lumikas habang ang mga ospital ay napuno ng mga biktima. Naramdaman ang pagyanig sa iba't ibang bahagi ng Visayas at Bicol, at sinundan ito ng daan-daang aftershocks na nagpalala ng sitwasyon. Sa kabila nito, mabilis na kumilos ang pamahalaan at mga rescue teams upang magbigay ng tulong, magsagawa ng search and rescue operations, at tiyakin ang kaligtasan ng mga apektadong komunidad, na nagpapakita ng kahalagahan ng kahandaan at pagtutulungan sa panahon ng sakuna.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn" id="modalContinueBtn"><i class="fas fa-arrow-right"></i> Magpatuloy</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            "use strict";

            // STATEMENTS DATA - Keep original text exactly as provided
            const fullStatements = [
                {
                    text: "Ang malakas na lindol na may lakas na magnitude 6.9 ay dulot ng paggalaw ng mga tectonic plates sa ilalim ng lupa. Ang epicenter nito ay naitala sa Bogo City, na nagdulot ng matinding pagyanig na naramdaman sa iba't ibang bahagi ng Visayas at Bicol.",
                    category: "sanhi",
                    imageIcon: "pictures/sanhi-card.png"
                },
                {
                    text: "Nagresulta ang lindol sa matinding pinsala sa buhay at ari-arian. Umabot sa 69 ang nasawi at 175 ang nasugatan dahil sa mga gumuhong gusali at bahay. Maraming ospital ang napuno ng mga biktima kaya ang iba ay ginamot na lamang sa labas. Marami ring residente ang napilitang lumikas at pansamantalang nanirahan sa evacuation centers. Naranasan din ang daan-daang aftershocks, pagkakaroon ng mga bitak sa kalsada, at pagkawala ng kuryente sa ilang lugar.",
                    category: "epekto",
                    imageIcon: "pictures/epekto-card.png"
                },
                {
                    text: "Agad na kumilos ang pamahalaan at mga rescue teams upang magsagawa ng search and rescue operations at magbigay ng agarang tulong sa mga apektadong komunidad. Nagkaroon ng mga babala at paghahanda para sa kaligtasan ng mga residente, kabilang ang paglikas sa mga mapanganib na lugar. Ipinakita rin ng komunidad ang pagtutulungan at bayanihan sa pagtulong sa mga biktima ng sakuna.",
                    category: "tugon",
                    imageIcon: "pictures/tugon-card.png"
                }
            ];

            // Shuffle function
            function shuffleArray(arr) {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                }
                return arr;
            }

            // State
            let currentIndex = 0;
            let placedCount = 0;
            let gameActive = true;
            let isProcessing = false;
            let shuffledStatements = [];

            // DOM Elements
            const descriptionContent = document.getElementById('descriptionContent');
            const progressText = document.getElementById('progressText');
            const progressDots = document.querySelectorAll('.progress-dot');
            const completionStatus = document.getElementById('completionStatus');
            const resetBtn = document.getElementById('resetGameBtn');
            const summaryModal = document.getElementById('summaryModal');
            const modalContinueBtn = document.getElementById('modalContinueBtn');

            // Category elements
            const categories = {
                sanhi: {
                    item: document.getElementById('catSanhi'),
                    dropzone: document.getElementById('dropzoneSanhi'),
                    status: document.getElementById('statusSanhi'),
                    filled: false
                },
                epekto: {
                    item: document.getElementById('catEpekto'),
                    dropzone: document.getElementById('dropzoneEpekto'),
                    status: document.getElementById('statusEpekto'),
                    filled: false
                },
                tugon: {
                    item: document.getElementById('catTugon'),
                    dropzone: document.getElementById('dropzoneTugon'),
                    status: document.getElementById('statusTugon'),
                    filled: false
                }
            };

            // Shake animation helper
            function shakeElement(element) {
                if (!element) return;
                element.classList.add('wrong-highlight');
                setTimeout(() => {
                    element.classList.remove('wrong-highlight');
                }, 600);
            }

            // Update progress dots
            function updateProgress() {
                progressDots.forEach((dot, index) => {
                    dot.classList.remove('active', 'completed');
                    if (index < currentIndex) {
                        dot.classList.add('completed');
                    } else if (index === currentIndex) {
                        dot.classList.add('active');
                    }
                });
                progressText.textContent = `Tanong ${currentIndex + 1} ng ${shuffledStatements.length}`;
            }

            // Check if all categories are filled
            function checkAllFilled() {
                const allFilled = Object.values(categories).every(cat => cat.filled);
                if (allFilled && gameActive) {
                    gameActive = false;
                    sessionStorage.setItem("node3_done", "true");
                    if (completionStatus) {
                        completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                    }
                    // Show completion in description area
                    descriptionContent.innerHTML = `
                        <div class="completion-message slide-in">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                            <p>🎉 Napakahusay! Nakumpleto mo ang lahat ng kategorya!</p>
                            <p style="font-size: 0.9rem; margin-top: 10px; font-weight: 400;">I-click ang "Magpatuloy" upang tingnan ang buod.</p>
                        </div>
                    `;
                    showSummaryModal();
                }
            }

            // Handle category click
            function handleCategoryClick(categoryKey) {
                if (!gameActive || isProcessing) return;
                
                const catData = categories[categoryKey];
                
                // Check if this category is already filled
                if (catData.filled) {
                    shakeElement(catData.item);
                    return;
                }

                const currentStatement = shuffledStatements[currentIndex];
                if (!currentStatement) return;

                isProcessing = true;

                // Disable all categories temporarily
                Object.values(categories).forEach(c => {
                    if (!c.filled) {
                        c.item.classList.add('disabled');
                    }
                });

                if (categoryKey === currentStatement.category) {
                    // CORRECT ANSWER
                    catData.item.classList.add('correct-highlight');
                    
                    // Fill the category
                    catData.filled = true;
                    catData.item.classList.add('filled');
                    
                    // Add the statement to the dropzone
                    const dropzone = catData.dropzone;
                    const placeholder = dropzone.querySelector('.placeholder-text');
                    if (placeholder) placeholder.style.display = 'none';
                    
                    // Create a mini card for the dropzone
                    const miniCard = document.createElement('div');
                    miniCard.className = 'statement-card placed';
                    let miniImageHtml = '';
                    if (currentStatement.imageIcon) {
                        miniImageHtml = `
                            <div class="card-header-image">
                                <img src="{{ asset('${currentStatement.imageIcon}') }}" alt="${currentStatement.category} icon" onerror="this.style.display='none'">
                            </div>
                        `;
                    }
                    miniCard.innerHTML = `
                        ${miniImageHtml}
                        <div class="card-text-content" style="font-size: 0.8rem;">${currentStatement.text.substring(0, 100)}${currentStatement.text.length > 100 ? '...' : ''}</div>
                    `;
                    dropzone.appendChild(miniCard);
                    
                    // Update status icon
                    catData.status.innerHTML = '✅';
                    
                    // Increment counters
                    placedCount++;
                    currentIndex++;

                    // Re-enable categories
                    Object.values(categories).forEach(c => {
                        c.item.classList.remove('disabled');
                    });

                    // Check if all done
                    if (currentIndex < shuffledStatements.length) {
                        // Move to next description after delay
                        setTimeout(() => {
                            isProcessing = false;
                            // Remove highlight
                            catData.item.classList.remove('correct-highlight');
                            renderDescription(currentIndex);
                        }, 600);
                    } else {
                        // All descriptions have been shown
                        setTimeout(() => {
                            isProcessing = false;
                            catData.item.classList.remove('correct-highlight');
                            checkAllFilled();
                        }, 600);
                    }

                } else {
                    // WRONG ANSWER
                    const wrongCat = catData.item;
                    shakeElement(wrongCat);
                    
                    // Show wrong feedback and reset
                    setTimeout(() => {
                        wrongCat.classList.remove('wrong-highlight');
                        Object.values(categories).forEach(c => {
                            c.item.classList.remove('disabled');
                        });
                        isProcessing = false;
                    }, 700);
                }
            }

            // Add click listeners to categories
            function setupCategoryListeners() {
                Object.keys(categories).forEach(key => {
                    const item = categories[key].item;
                    // Remove any existing listeners by cloning
                    const newItem = item.cloneNode(true);
                    item.parentNode.replaceChild(newItem, item);
                    // Update the reference
                    categories[key].item = newItem;
                    // Update sub-elements
                    categories[key].dropzone = newItem.querySelector('.category-dropzone');
                    categories[key].status = newItem.querySelector('.cat-status');
                    
                    newItem.addEventListener('click', function(e) {
                        // Don't trigger if clicking on the status or inside dropzone content
                        if (e.target.closest('.cat-status')) return;
                        const categoryKey = this.dataset.category;
                        handleCategoryClick(categoryKey);
                    });
                });
            }

            // Get responsive hint text
            function getHintText() {
                const isMobile = window.innerWidth <= 992;
                return isMobile 
                    ? '<i class="fas fa-hand-pointer"></i> I-tap ang tamang kategorya sa itaas' 
                    : '<i class="fas fa-hand-pointer"></i> I-tap ang tamang kategorya sa kaliwa';
            }

            // Render description card
            function renderDescription(index) {
                if (!gameActive) return;
                if (index >= shuffledStatements.length) {
                    checkAllFilled();
                    return;
                }

                const statement = shuffledStatements[index];
                
                let headerImageHtml = '';
                if (statement.imageIcon) {
                    headerImageHtml = `
                        <div class="card-header-image">
                            <img src="{{ asset('${statement.imageIcon}') }}" alt="${statement.category} icon" onerror="this.style.display='none'">
                        </div>
                    `;
                }

                descriptionContent.innerHTML = `
                    <div class="slide-in">
                        ${headerImageHtml}
                        <div class="description-text">${statement.text}</div>
                        <div class="description-hint">
                            ${getHintText()}
                        </div>
                    </div>
                `;

                updateProgress();
            }

            // Show summary modal
            function showSummaryModal() {
                if (summaryModal) {
                    summaryModal.classList.add('show');
                }
            }

            // Reset game
            function resetGame() {
                gameActive = true;
                isProcessing = false;
                currentIndex = 0;
                placedCount = 0;

                // Reset categories
                Object.values(categories).forEach(cat => {
                    cat.filled = false;
                    cat.item.classList.remove('filled', 'correct-highlight', 'wrong-highlight', 'disabled');
                    cat.item.style.borderColor = '';
                    cat.dropzone.innerHTML = `<span class="placeholder-text">⬇️ Ilalagay dito ang ${cat.item.dataset.category}</span>`;
                    cat.status.innerHTML = '';
                });

                // Reset completion status
                if (completionStatus) completionStatus.innerHTML = '';

                // Reset progress dots
                progressDots.forEach(dot => {
                    dot.classList.remove('active', 'completed');
                });

                // Shuffle statements
                shuffledStatements = shuffleArray([...fullStatements]);

                // Setup category listeners
                setupCategoryListeners();

                // Render first description
                renderDescription(0);
            }

            // Event Listeners
            if (modalContinueBtn) {
                modalContinueBtn.addEventListener('click', () => {
                    window.location.href = "{{ route('inner.map4') }}";
                });
            }

            if (summaryModal) {
                summaryModal.addEventListener('click', (e) => {
                    if (e.target === summaryModal) {
                        summaryModal.classList.remove('show');
                    }
                });
            }

            if (resetBtn) {
                resetBtn.addEventListener('click', resetGame);
            }

            // Add resize listener for responsive hint
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    if (gameActive && currentIndex < shuffledStatements.length) {
                        const hintElement = document.querySelector('.description-hint');
                        if (hintElement) {
                            hintElement.innerHTML = getHintText();
                        }
                    }
                }, 250);
            });

            // Initialize game
            resetGame();
        })();
    </script>
@endsection