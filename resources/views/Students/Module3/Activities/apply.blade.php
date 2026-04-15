<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabay sa Protokol ng Panahon | PAGASA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #0f172a;
            --brand-accent: #2563eb;
            --section-bg: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #475569;
            
            /* Professional Card Tints */
            --obj-card-bg: #eff6ff; /* Very light blue */
            --obj-card-border: #bfdbfe;
            --skill-card-bg: #fffbeb; /* Very light amber */
            --skill-card-border: #fef3c7;
        }

        body {
            background-color: var(--section-bg);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        /* HEADER */
        .page-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-label {
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            display: block;
            margin-bottom: 0.5rem;
        }

        .main-title {
            font-weight: 700;
            font-size: 2.2rem;
            margin: 0;
        }

        /* ENHANCED PROFESSIONAL CARDS */
        .protocol-card {
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid transparent;
        }

        .protocol-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.1);
        }

        /* Objective Card Styling */
        .protocol-card.objective {
            background-color: var(--obj-card-bg);
            border-color: var(--obj-card-border);
            border-top: 5px solid var(--brand-accent);
        }

        /* Skills Card Styling */
        .protocol-card.skills {
            background-color: var(--skill-card-bg);
            border-color: var(--skill-card-border);
            border-top: 5px solid #f59e0b;
        }

        .protocol-card h5 {
            color: var(--brand-primary);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .icon-box {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        /* MAIN PANEL */
        .signals-panel {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .panel-title {
            color: var(--brand-primary);
            font-weight: 700;
            border-left: 6px solid var(--brand-accent);
            padding-left: 15px;
            margin-bottom: 1.5rem;
        }

        /* INTERACTIVE SIGNALS */
        .wind-signal-item {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 12px;
            transition: all 0.25s ease;
            background: #f1f5f9;
            padding: 12px;
        }

        .wind-signal-item:hover {
            border-color: var(--brand-accent);
            background: #e0f2fe;
            transform: scale(1.05);
        }

        .wind-img {
            width: 100%;
            border-radius: 8px;
        }

        /* VIDEO SECTION */
        .video-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid #e2e8f0;
        }

        /* BUTTON */
        .btn-continue {
            background: var(--brand-accent);
            color: white;
            font-weight: 700;
            padding: 1.2rem 3.5rem;
            border-radius: 12px;
            border: none;
            transition: 0.3s;
            letter-spacing: 0.5px;
        }

        .btn-continue:hover {
            background: #1d4ed8;
            color: white;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .btn-continue.disabled {
            pointer-events: none;
            opacity: 0.6;
        }

        .btn-continue:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* PROGRESS INDICATOR */
        .progress-indicator {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 600;
            color: var(--text-muted);
        }

        .progress-indicator.complete {
            background: #dcfce7;
            color: #166534;
        }    </style>
</head>
<body>

<header class="page-header text-center">
    <div class="container">
        <span class="breadcrumb-label">MODYUL SA PAGHAHANDA SA SAKUNA 3.1</span>
        <h1 class="main-title">Gabay sa Pag-unawa sa Bagyo</h1>
    </div>
</header>

<div class="container pb-5">
    
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="protocol-card objective shadow-sm">
                <div class="icon-box text-primary"><i class="fa-solid fa-bullseye"></i></div>
                <h5>Layunin ng Aralin</h5>
                <p>Matutunan kung paano <strong>makikilala ang panganib</strong> at kung paano <strong>mababawasan ang pinsala</strong> gamit ang mga babala mula sa PAGASA.</p>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="protocol-card skills shadow-sm">
                <div class="icon-box" style="color: #f59e0b;"><i class="fa-solid fa-shield-halved"></i></div>
                <h5>Ang Inyong Matututunan</h5>
                <p>Kakayahang <strong>magsagawa ng pag-iingat</strong> base sa lakas ng hangin at sa mga posibleng epekto ng bawat signal ng bagyo.</p>
            </div>
        </div>
    </div>

    <section class="signals-panel mb-5 shadow-sm">
        <h4 class="panel-title">Gabay sa mga Signal ng Bagyo</h4>
        <p class="text-muted mb-4">Pindutin ang bawat icon sa ibaba upang makita ang mga dapat gawin at mahalagang impormasyon para sa bawat signal.</p>

        <div class="progress-indicator" id="progressIndicator">
            Binuksan ang Modal: 0/5
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-2 text-center">
                <div class="wind-signal-item" data-signal="1" data-img="{{ asset('pictures/Module 3/Apply/wind1_modal.png') }}">
                    <img src="{{ asset('pictures/Module 3/Apply/wind1.png') }}" class="wind-img">
                    <div class="mt-2 fw-bold small text-secondary">Signal No. 1</div>
                </div>
            </div>
            <div class="col-6 col-md-2 text-center">
                <div class="wind-signal-item" data-signal="2" data-img="{{ asset('pictures/Module 3/Apply/wind2_modal.png') }}">
                    <img src="{{ asset('pictures/Module 3/Apply/wind2.png') }}" class="wind-img">
                    <div class="mt-2 fw-bold small text-secondary">Signal No. 2</div>
                </div>
            </div>
            <div class="col-6 col-md-2 text-center">
                <div class="wind-signal-item" data-signal="3" data-img="{{ asset('pictures/Module 3/Apply/wind3_modal.png') }}">
                    <img src="{{ asset('pictures/Module 3/Apply/wind3.png') }}" class="wind-img">
                    <div class="mt-2 fw-bold small text-secondary">Signal No. 3</div>
                </div>
            </div>
            <div class="col-6 col-md-2 text-center">
                <div class="wind-signal-item" data-signal="4" data-img="{{ asset('pictures/Module 3/Apply/wind4_modal.png') }}">
                    <img src="{{ asset('pictures/Module 3/Apply/wind4.png') }}" class="wind-img">
                    <div class="mt-2 fw-bold small text-secondary">Signal No. 4</div>
                </div>
            </div>
            <div class="col-6 col-md-2 text-center">
                <div class="wind-signal-item" data-signal="5" data-img="{{ asset('pictures/Module 3/Apply/wind5_modal.png') }}">
                    <img src="{{ asset('pictures/Module 3/Apply/wind5.png') }}" class="wind-img">
                    <div class="mt-2 fw-bold small text-secondary">Signal No. 5</div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section shadow-sm mb-5">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0 text-center text-lg-start">
                <h4 class="video-label">Video sa Kaligtasan</h4>
                <p class="text-muted small">Panoorin ang video na ito para malaman ang mga tamang hakbang na dapat gawin ng inyong pamilya tuwing may banta ng bagyo.</p>
            </div>
            <div class="col-lg-8">
                <div class="ratio ratio-16x9 rounded shadow-lg overflow-hidden border">
                    <iframe src="https://www.youtube.com/embed/5MP0TxfEWyA" title="PAGASA Protocol" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <div class="text-center py-4">
        <a href="{{ route('gobag.activity') }}" id="continueBtn" class="btn btn-continue shadow disabled">
            SUSUNOD NA BAHAGI <i class="fa-solid fa-arrow-right ms-2"></i>
        </a>
    </div>

</div>

<div class="modal fade" id="popupModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content border-0" style="background: rgba(255,255,255,0.98); backdrop-filter: blur(12px);">
            <div class="modal-header border-0 container py-4">
                <h5 class="fw-bold" style="color: var(--brand-primary);"><i class="fa-solid fa-circle-info me-2"></i>Gabay at Detalye</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center p-4">
                <img id="popupImage" src="" class="img-fluid rounded-4 shadow-2xl" style="max-height: 80vh; border: 1px solid #ddd;">
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modal = new bootstrap.Modal(document.getElementById('popupModal'));
    const popupImg = document.getElementById('popupImage');
    const progressIndicator = document.getElementById('progressIndicator');
    const continueBtn = document.getElementById('continueBtn');

    const viewedSignals = new Set();
    const totalSignals = 5;

    function updateProgress() {
        const viewedCount = viewedSignals.size;
        progressIndicator.textContent = `Binuksan ang Modal: ${viewedCount}/${totalSignals}`;
        
        if (viewedCount === totalSignals) {
            progressIndicator.classList.add('complete');
            continueBtn.classList.remove('disabled');
        } else {
            progressIndicator.classList.remove('complete');
            continueBtn.classList.add('disabled');
        }
    }

    // Track when modal is hidden (exited)
    document.getElementById('popupModal').addEventListener('hidden.bs.modal', function() {
        // Find which signal was last clicked
        const lastClicked = document.querySelector('.wind-signal-item[data-signal]');
        // Since modal is shown on click, we can assume the last clicked is the one viewed
        // But to be precise, we can store the current signal
        // Actually, since each click shows the modal, and we want to mark when exited, we need to know which one was shown
        // So, add a variable for currentSignal
    });

    // Better way: set currentSignal on click, then mark on hide
    let currentSignal = null;

    document.querySelectorAll('.wind-signal-item').forEach(el => {
        el.addEventListener('click', function() {
            currentSignal = this.getAttribute('data-signal');
            popupImg.src = this.getAttribute('data-img');
            modal.show();
        });
    });

    document.getElementById('popupModal').addEventListener('hidden.bs.modal', function() {
        if (currentSignal) {
            viewedSignals.add(currentSignal);
            updateProgress();
            currentSignal = null;
        }
    });

    // Prevent clicking disabled button
    continueBtn.addEventListener('click', function(e) {
        if (this.disabled) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>