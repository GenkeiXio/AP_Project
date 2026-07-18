@extends('Students.studentslayout')
@section('title', 'Module 3 : Apply Activity')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap');
        :root {
            --wood-dark: #3d2b1f;
            --wood-medium: #5d4037;
            --brand-accent: #2563eb;
            --text-main: #1e293b;
            --green-dark: #1b5e20;
            --green-mid: #2e7d32;
        }

        html, body{
            scroll-behavior:smooth;
            background:
                linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                url('/pictures/mod3_innermap.png') no-repeat center center fixed;
        }

        body{
            overflow-x:hidden;
            color:var(--text);
            font-family:'Poppins', sans-serif;
        }

        .wooden-card {
            background: #e0c9a6;
            background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
            border: 6px solid var(--wood-medium);
            border-radius: 18px;
            box-shadow: 
                inset 0 0 40px rgba(0,0,0,0.1),
                0 10px 25px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .page-header {
            background: rgba(15, 23, 42, 0.9);
            padding: 2rem 0;
            margin-bottom: 2rem;
            color: white;
            border-bottom: 5px solid var(--wood-medium);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .main-title {
            font-weight: 700;
            font-size: 2.3rem;
            margin: 0;
        }

        /* ===== STEP CONTAINER ===== */
        .step-container {
            margin-top: 10px;
        }

        .step-indicators {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .step-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #cdbda6;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .step-dot.active {
            background: var(--green-mid);
            transform: scale(1.3);
            box-shadow: 0 0 12px rgba(46, 125, 50, 0.4);
        }

        .step-dot.completed {
            background: #b88b33;
        }

        .step-content {
            display: none;
            animation: fadeInUp 0.4s ease;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-card {
            border-radius: 16px;
            border: 1px solid #d0bca1;
            background: linear-gradient(135deg, #fffdf8, #f4e8d5);
            padding: 18px;
            position: relative;
        }

        .step-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #3d2f26;
            margin: 0 0 10px 0;
        }

        .step-description {
            color: #5f5349;
            line-height: 1.6;
            font-size: 0.95rem;
            margin-bottom: 12px;
        }

        /* ===== GREEN BUTTON ===== */
        .btn-green {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 30px;
            background: var(--green-mid) !important;
            border: 3px solid var(--wood-dark) !important;
            box-shadow: 0 5px 0 var(--wood-dark) !important;
            color: #fff !important;
            border-radius: 12px;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
            text-decoration: none;
            transition: 0.18s ease;
            cursor: pointer;
        }

        .btn-green:hover {
            background: var(--green-dark) !important;
            transform: translateY(-2px);
            color: #fff !important;
        }

        .btn-green:active {
            transform: translateY(3px);
            box-shadow: 0 2px 0 var(--wood-dark) !important;
        }

        .btn-green:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* ===== STEP NAVIGATION ===== */
        .step-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .step-nav .btn-green {
            min-width: 120px;
        }

        .step-nav .btn-green:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ===== SIGNAL ITEMS ===== */
        .signals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        .wind-signal-item {
            cursor: pointer;
            border: 3px solid var(--wood-medium);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.4);
            padding: 12px;
            transition: all 0.25s ease;
            text-align: center;
        }

        .wind-signal-item:hover {
            transform: translateY(-5px) scale(1.03);
            background: #fff;
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .wind-signal-item.viewed {
            border-color: var(--green-mid);
            background: #e8f5e9;
        }

        .wind-img {
            width: 100%;
            border-radius: 8px;
            max-height: 80px;
            object-fit: contain;
        }

        .signal-label {
            margin-top: 6px;
            font-weight: 700;
            font-size: 0.8rem;
            color: #3d2f26;
        }

        .signal-check {
            display: none;
            color: var(--green-mid);
            font-size: 1.2rem;
            margin-top: 4px;
        }

        .wind-signal-item.viewed .signal-check {
            display: block;
        }

        .progress-indicator {
            background: var(--wood-dark);
            border-radius: 8px;
            padding: 10px 15px;
            margin: 10px 0 0 0;
            text-align: center;
            font-weight: 600;
            color: #f1f5f9;
            display: inline-block;
            width: 100%;
        }

        .progress-indicator.complete {
            background: #166534;
            color: #dcfce7;
        }

        /* ===== VIDEO ===== */
        .video-frame-wrapper {
            border: 8px solid var(--wood-medium);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        /* ===== CUSTOM MODAL - FIXED ===== */
        #customModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 999999;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            padding: 20px;
        }

        #customModal.show {
            display: flex;
        }

        .custom-modal-content {
            background: #f4ece4;
            background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            border: 8px solid #3d2b1f;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            position: relative;
            animation: modalPop 0.3s ease;
        }

        @keyframes modalPop {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .custom-modal-header {
            background: #1e293b;
            color: white;
            border-bottom: 3px solid #5d4037;
            padding: 1rem 1.5rem;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .custom-modal-header h5 {
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
            color: white;
        }

        .custom-modal-close {
            background: #ef4444;
            border: 3px solid white;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
            flex-shrink: 0;
            padding: 0;
        }

        .custom-modal-close:hover {
            background: #dc2626;
        }

        .custom-modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            text-align: center;
            background: white;
            margin: 1rem;
            border-radius: 10px;
            flex: 1;
            max-height: 60vh;
        }

        .custom-modal-body img {
            max-width: 100%;
            height: auto;
            border: 3px solid #5d4037;
            border-radius: 10px;
        }

        /* ===== COMPLETION BADGE ===== */
        .completion-badge {
            display: inline-block;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 0.85rem;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.4);
        }

        /* ===== VIDEO SECTION IN STEP ===== */
        .video-section {
            margin-top: 12px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .custom-modal-content {
                max-width: 95%;
                max-height: 95vh;
            }
            
            .custom-modal-body {
                max-height: 50vh;
                padding: 1rem;
                margin: 0.5rem;
            }
            
            .custom-modal-header {
                padding: 0.75rem 1rem;
            }
            
            .custom-modal-header h5 {
                font-size: 1rem !important;
            }
            
            .custom-modal-close {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <header class="page-header text-center">
        <div class="container">
            <h1 class="main-title">Gabay sa Pag-unawa sa Bagyo</h1>
        </div>
    </header>

    <div class="container pb-5">

        <!-- ===== STEP CONTAINER ===== -->
        <div class="step-container">
            <!-- Step Indicators -->
            <div class="step-indicators" id="stepIndicators">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot" data-step="2"></div>
                <div class="step-dot" data-step="3"></div>
            </div>

            <!-- ===== STEP 1: INTRO ===== -->
            <div class="step-content active" id="step1">
                <div class="step-card">
                    <h3 class="step-title">📚 Layunin at Matututunan</h3>
                    <p class="step-description">Alamin ang layunin ng aralin at kung ano ang inyong matututunan.</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="wooden-card protocol-card objective shadow-sm" style="padding:1.5rem; height:100%;">
                                <div class="icon-box text-success" style="font-size:2rem;"><i class="fa-solid fa-bullseye"></i></div>
                                <h5>Layunin ng Aralin</h5>
                                <p class="small">Matutunan kung paano <strong>makikilala ang panganib</strong> at kung paano <strong>mababawasan ang pinsala</strong> gamit ang mga babala mula sa PAGASA.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="wooden-card protocol-card skills shadow-sm" style="padding:1.5rem; height:100%;">
                                <div class="icon-box" style="font-size:2rem; color:#f59e0b;"><i class="fa-solid fa-shield-halved"></i></div>
                                <h5>Ang Inyong Matututunan</h5>
                                <p class="small">Kakayahang <strong>magsagawa ng pag-iingat</strong> base sa lakas ng hangin at sa mga posibleng epekto ng bawat signal ng bagyo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="step-nav">
                        <span></span>
                        <button class="btn-green" onclick="goToStep(2)">Magpatuloy →</button>
                    </div>
                </div>
            </div>

            <!-- ===== STEP 2: SIGNALS ===== -->
            <div class="step-content" id="step2">
                <div class="step-card">
                    <h3 class="step-title">🌪️ Gabay sa mga Signal ng Bagyo</h3>
                    <p class="step-description">Pindutin ang bawat icon upang makita ang mga dapat gawin. Kailangan mong tingnan ang <strong>lahat ng 5 signal</strong> bago magpatuloy.</p>

                    <div class="progress-indicator" id="progressIndicator">
                        📖 Binuksan: 0/5
                    </div>

                    <div class="signals-grid">
                        <div class="wind-signal-item" data-signal="1" data-img="{{ asset('pictures/Module 3/Apply/wind1_modal.png') }}" data-title="Signal No. 1 - Gabay">
                            <img src="{{ asset('pictures/Module 3/Apply/wind1.png') }}" class="wind-img">
                            <div class="signal-label">Signal No. 1</div>
                            <div class="signal-check">✅</div>
                        </div>
                        <div class="wind-signal-item" data-signal="2" data-img="{{ asset('pictures/Module 3/Apply/wind2_modal.png') }}" data-title="Signal No. 2 - Gabay">
                            <img src="{{ asset('pictures/Module 3/Apply/wind2.png') }}" class="wind-img">
                            <div class="signal-label">Signal No. 2</div>
                            <div class="signal-check">✅</div>
                        </div>
                        <div class="wind-signal-item" data-signal="3" data-img="{{ asset('pictures/Module 3/Apply/wind3_modal.png') }}" data-title="Signal No. 3 - Gabay">
                            <img src="{{ asset('pictures/Module 3/Apply/wind3.png') }}" class="wind-img">
                            <div class="signal-label">Signal No. 3</div>
                            <div class="signal-check">✅</div>
                        </div>
                        <div class="wind-signal-item" data-signal="4" data-img="{{ asset('pictures/Module 3/Apply/wind4_modal.png') }}" data-title="Signal No. 4 - Gabay">
                            <img src="{{ asset('pictures/Module 3/Apply/wind4.png') }}" class="wind-img">
                            <div class="signal-label">Signal No. 4</div>
                            <div class="signal-check">✅</div>
                        </div>
                        <div class="wind-signal-item" data-signal="5" data-img="{{ asset('pictures/Module 3/Apply/wind5_modal.png') }}" data-title="Signal No. 5 - Gabay">
                            <img src="{{ asset('pictures/Module 3/Apply/wind5.png') }}" class="wind-img">
                            <div class="signal-label">Signal No. 5</div>
                            <div class="signal-check">✅</div>
                        </div>
                    </div>

                    <div class="step-nav">
                        <button class="btn-green" onclick="goToStep(1)">← Bumalik</button>
                        <button class="btn-green" id="step2NextBtn" onclick="goToStep(3)" disabled>Magpatuloy →</button>
                    </div>
                </div>
            </div>

            <!-- ===== STEP 3: VIDEO & CONTINUE ===== -->
            <div class="step-content" id="step3">
                <div class="step-card">
                    <h3 class="step-title">🎥 Video sa Kaligtasan</h3>
                    <p class="step-description">Panoorin ang video na ito para malaman ang mga tamang hakbang na dapat gawin ng inyong pamilya.</p>

                    <div class="video-section">
                        <div class="video-frame-wrapper">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/5MP0TxfEWyA" title="PAGASA Protocol" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div style="text-align:center; margin-top:16px;">
                        <div class="completion-badge" id="completionBadge" style="display:none;">
                            ✅ Handa ka na!
                        </div>
                    </div>

                    <div class="step-nav">
                        <button class="btn-green" onclick="goToStep(2)">← Bumalik</button>
                        <button class="btn-green" id="continueBtn" onclick="continueToNext()" disabled>
                            SUSUNOD NA BAHAGI →
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== CUSTOM MODAL - FIXED ===== -->
    <div id="customModal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 id="modalTitle"><i class="fa-solid fa-circle-info me-2"></i>Gabay at Detalye</h5>
                <button class="custom-modal-close" onclick="closeModal()">✕</button>
            </div>
            <div class="custom-modal-body">
                <img id="modalImage" src="" alt="Signal Guide">
            </div>
        </div>
    </div>

    <x-vn />

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== CUSTOM MODAL FUNCTIONS =====
        function openModal(imageSrc, title) {
            const modal = document.getElementById('customModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            
            modalImage.src = imageSrc;
            modalTitle.innerHTML = `<i class="fa-solid fa-circle-info me-2"></i>${title}`;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent body scroll
        }

        function closeModal() {
            const modal = document.getElementById('customModal');
            modal.classList.remove('show');
            document.body.style.overflow = ''; // Restore body scroll
        }

        // Close modal on backdrop click
        document.getElementById('customModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // ===== STEP NAVIGATION =====
        function goToStep(step) {
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.step-dot').forEach(el => el.classList.remove('active'));
            
            document.getElementById(`step${step}`).classList.add('active');
            document.querySelector(`.step-dot[data-step="${step}"]`).classList.add('active');
            
            window.scrollTo({ top: document.querySelector('.step-container').offsetTop - 100, behavior: 'smooth' });
        }

        // ===== SIGNAL VIEWING =====
        document.addEventListener('DOMContentLoaded', function() {
            const progressIndicator = document.getElementById('progressIndicator');
            const step2NextBtn = document.getElementById('step2NextBtn');
            const continueBtn = document.getElementById('continueBtn');
            const completionBadge = document.getElementById('completionBadge');

            const viewedSignals = new Set();
            const totalSignals = 5;

            function updateProgress() {
                const viewedCount = viewedSignals.size;
                progressIndicator.textContent = `📖 Binuksan: ${viewedCount}/${totalSignals}`;

                if (viewedCount === totalSignals) {
                    progressIndicator.classList.add('complete');
                    progressIndicator.textContent = `✅ Kumpleto: ${viewedCount}/${totalSignals}`;
                    step2NextBtn.disabled = false;
                    
                    // Also enable continue button if we're on step 3
                    if (document.getElementById('step3').classList.contains('active')) {
                        continueBtn.disabled = false;
                        completionBadge.style.display = 'inline-block';
                    }
                }
            }

            document.querySelectorAll('.wind-signal-item').forEach(el => {
                el.addEventListener('click', function () {
                    const signal = this.getAttribute('data-signal');
                    const imgSrc = this.getAttribute('data-img');
                    const title = this.getAttribute('data-title');
                    
                    // Store current signal to mark as viewed when modal closes
                    this.dataset.currentSignal = signal;
                    
                    openModal(imgSrc, title);
                });
            });

            // Handle modal close to mark signal as viewed
            const modal = document.getElementById('customModal');
            const originalClose = closeModal;
            window.closeModal = function() {
                // Check if there's a signal to mark as viewed
                const activeItem = document.querySelector('.wind-signal-item[data-current-signal]');
                if (activeItem) {
                    const signal = activeItem.getAttribute('data-current-signal');
                    if (!viewedSignals.has(signal)) {
                        viewedSignals.add(signal);
                        activeItem.classList.add('viewed');
                        activeItem.removeAttribute('data-current-signal');
                        updateProgress();
                    }
                }
                originalClose();
            };

            // Override openModal to handle signal tracking
            const originalOpenModal = openModal;
            window.openModal = function(imgSrc, title) {
                // Store current signal in the clicked element
                originalOpenModal(imgSrc, title);
            };

            // Check if all signals are viewed when going to step 3
            const originalGoToStep = window.goToStep;
            window.goToStep = function(step) {
                originalGoToStep(step);
                
                if (step === 3) {
                    const viewedCount = viewedSignals.size;
                    if (viewedCount === totalSignals) {
                        continueBtn.disabled = false;
                        completionBadge.style.display = 'inline-block';
                    }
                }
            };

            updateProgress();
        });

        // ===== CONTINUE TO NEXT =====
        function continueToNext() {
            const continueBtn = document.getElementById('continueBtn');
            if (!continueBtn.disabled) {
                window.location.href = "{{ route('gobag.activity') }}";
            }
        }

        // ===== VN DIALOGUE =====
        window.addEventListener("load", () => {
            startDialogue([
                {
                    text: "Hindi tulad ng naunang modyul, ang bahaging ito ay may ilang gawain na susubok sa iyong kaalaman at pag-unawa. Pero huwag kang mag-alala, gawin mo lang ang iyong makakaya at tandaan ang mga natutunan mo. Konting tiyaga na lang at matatapos mo rin ang mga gawain.",
                    name: "Mga Guro",
                    image: "{{ asset('pictures/vn_box_teacher1.png') }}"
                },
                {
                    text: "Ngunit bago ka magsimula, kailangan mo munang basahin at unawain ang bawat Gabay sa mga Signal ng Bagyo.",
                    name: "Mga Guro",
                    image: "{{ asset('pictures/vn_box_teacher1.png') }}"
                },
                {
                    text: "Kapag handa ka na, maaari ka nang magpatuloy.",
                    name: "Mga Guro",
                    image: "{{ asset('pictures/vn_box_teacher3.png') }}"
                }
            ]);
        });
    </script>
@endpush