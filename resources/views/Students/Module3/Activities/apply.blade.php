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

        .protocol-card {
            padding: 2rem;
            height: 100%;
        }

        .protocol-card.objective {
            border-top: 8px solid #2e7d32;
        }

        .protocol-card.skills {
            border-top: 8px solid #f59e0b;
        }

        .icon-box {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .signals-panel {
            padding: 2.5rem;
            margin-top: 1rem;
        }

        .panel-title {
            color: var(--wood-dark);
            font-weight: 700;
            border-left: 6px solid var(--wood-dark);
            padding-left: 15px;
            margin-bottom: 1.5rem;
        }

        .wind-signal-item {
            cursor: pointer;
            border: 3px solid var(--wood-medium);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.4);
            padding: 12px;
            transition: all 0.25s ease;
        }

        .wind-signal-item:hover {
            transform: translateY(-8px) scale(1.05);
            background: #fff;
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .wind-img {
            width: 100%;
            border-radius: 8px;
        }

        .progress-indicator {
            background: var(--wood-dark);
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
            color: #f1f5f9;
            display: inline-block;
        }

        .progress-indicator.complete {
            background: #166534;
            color: #dcfce7;
        }

        .video-section {
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .video-frame-wrapper {
            border: 8px solid var(--wood-medium);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .btn-continue {
            background: var(--wood-dark);
            color: white;
            font-weight: 700;
            padding: 1.2rem 3.5rem;
            border-radius: 12px;
            border: none;
            transition: 0.3s;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
        }

        .btn-continue:hover:not(.disabled) {
            background: #1e293b;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }

        .btn-continue.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #64748b;
            pointer-events: none;
        }

        /* MODAL - Move to body level styling */
        #popupModal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 999999 !important;
            width: 100% !important;
            height: 100% !important;
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

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="wooden-card protocol-card objective shadow-sm">
                    <div class="icon-box text-success"><i class="fa-solid fa-bullseye"></i></div>
                    <h5>Layunin ng Aralin</h5>
                    <p>Matutunan kung paano <strong>makikilala ang panganib</strong> at kung paano <strong>mababawasan ang pinsala</strong> gamit ang mga babala mula sa PAGASA.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="wooden-card protocol-card skills shadow-sm">
                    <div class="icon-box" style="color: #f59e0b;"><i class="fa-solid fa-shield-halved"></i></div>
                    <h5>Ang Inyong Matututunan</h5>
                    <p>Kakayahang <strong>magsagawa ng pag-iingat</strong> base sa lakas ng hangin at sa mga posibleng epekto ng bawat signal ng bagyo.</p>
                </div>
            </div>
        </div>

        <section class="wooden-card signals-panel mb-5 text-center">
            <h4 class="panel-title d-inline-block">Gabay sa mga Signal ng Bagyo</h4>
            <p class="text-muted mb-4">Pindutin ang bawat icon sa ibaba upang makita ang mga dapat gawin.</p>

            <div class="progress-indicator" id="progressIndicator">
                Binuksan ang Modal: 0/5
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-2">
                    <div class="wind-signal-item" data-signal="1" data-img="{{ asset('pictures/Module 3/Apply/wind1_modal.png') }}" data-title="Signal No. 1 - Gabay">
                        <img src="{{ asset('pictures/Module 3/Apply/wind1.png') }}" class="wind-img">
                        <div class="mt-2 fw-bold small">Signal No. 1</div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="wind-signal-item" data-signal="2" data-img="{{ asset('pictures/Module 3/Apply/wind2_modal.png') }}" data-title="Signal No. 2 - Gabay">
                        <img src="{{ asset('pictures/Module 3/Apply/wind2.png') }}" class="wind-img">
                        <div class="mt-2 fw-bold small">Signal No. 2</div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="wind-signal-item" data-signal="3" data-img="{{ asset('pictures/Module 3/Apply/wind3_modal.png') }}" data-title="Signal No. 3 - Gabay">
                        <img src="{{ asset('pictures/Module 3/Apply/wind3.png') }}" class="wind-img">
                        <div class="mt-2 fw-bold small">Signal No. 3</div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="wind-signal-item" data-signal="4" data-img="{{ asset('pictures/Module 3/Apply/wind4_modal.png') }}" data-title="Signal No. 4 - Gabay">
                        <img src="{{ asset('pictures/Module 3/Apply/wind4.png') }}" class="wind-img">
                        <div class="mt-2 fw-bold small">Signal No. 4</div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="wind-signal-item" data-signal="5" data-img="{{ asset('pictures/Module 3/Apply/wind5_modal.png') }}" data-title="Signal No. 5 - Gabay">
                        <img src="{{ asset('pictures/Module 3/Apply/wind5.png') }}" class="wind-img">
                        <div class="mt-2 fw-bold small">Signal No. 5</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="wooden-card video-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                    <h4 class="fw-bold">Video sa Kaligtasan</h4>
                    <p class="text-muted small">Panoorin ang video na ito para malaman ang mga tamang hakbang na dapat gawin ng inyong pamilya.</p>
                </div>
                <div class="col-lg-8">
                    <div class="video-frame-wrapper">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/5MP0TxfEWyA" title="PAGASA Protocol" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center py-4">
            <button id="continueBtn" class="btn btn-continue shadow disabled" onclick="if(!this.classList.contains('disabled')){window.location.href='{{ route('gobag.activity') }}'}">
                SUSUNOD NA BAHAGI <i class="fa-solid fa-arrow-right ms-2"></i>
            </button>
        </div>

    </div>

    <x-vn />

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create modal dynamically and append to body
            const modalHTML = `
                <div class="modal fade" id="popupModal" tabindex="-1" aria-hidden="true" style="position: fixed; top: 0; left: 0; z-index: 999999;">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 90vw; margin: 2rem auto;">
                        <div class="modal-content" style="
                            position: relative;
                            z-index: 999999;
                            background: #f4ece4 url('https://www.transparenttextures.com/patterns/wood-pattern.png');
                            border: 8px solid #3d2b1f;
                            border-radius: 20px;
                            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
                        ">
                            <div class="modal-header" style="
                                background: #1e293b;
                                color: white;
                                border-bottom: 3px solid #5d4037;
                                padding: 1rem 1.5rem;
                                border-radius: 10px 10px 0 0;
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                            ">
                                <h5 class="modal-title" id="modalTitle" style="font-weight: 700; font-size: 1.3rem; color: white;">
                                    <i class="fa-solid fa-circle-info me-2"></i>Gabay at Detalye
                                </h5>
                                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close" style="
                                    background-color: #ef4444;
                                    border-radius: 50%;
                                    padding: 12px;
                                    opacity: 1;
                                    cursor: pointer;
                                    border: 3px solid white;
                                "></button>
                            </div>
                            <div class="modal-body" style="padding: 1.5rem;">
                                <div style="
                                    max-height: 75vh;
                                    overflow: auto;
                                    text-align: center;
                                    background: white;
                                    border-radius: 10px;
                                    padding: 15px;
                                ">
                                    <img id="popupImage" src="" class="img-fluid" alt="Signal Guide" style="
                                        max-width: 100%;
                                        height: auto;
                                        border: 3px solid #5d4037;
                                        border-radius: 10px;
                                    ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Append modal to body
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            // Now initialize modal
            const modalElement = document.getElementById('popupModal');
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            const popupImg = document.getElementById('popupImage');
            const modalTitle = document.getElementById('modalTitle');
            const progressIndicator = document.getElementById('progressIndicator');
            const continueBtn = document.getElementById('continueBtn');

            const viewedSignals = new Set();
            const totalSignals = 5;
            let currentSignal = null;

            function updateProgress() {
                const viewedCount = viewedSignals.size;
                progressIndicator.textContent = `Binuksan ang Modal: ${viewedCount}/${totalSignals}`;

                if (viewedCount === totalSignals) {
                    progressIndicator.classList.add('complete');
                    continueBtn.classList.remove('disabled');
                }
            }

            document.querySelectorAll('.wind-signal-item').forEach(el => {
                el.addEventListener('click', function () {
                    currentSignal = this.getAttribute('data-signal');
                    const imgSrc = this.getAttribute('data-img');
                    const title = this.getAttribute('data-title');
                    
                    popupImg.src = imgSrc;
                    if (title && modalTitle) {
                        modalTitle.innerHTML = `<i class="fa-solid fa-circle-info me-2"></i>${title}`;
                    }
                    
                    modal.show();
                });
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                if (currentSignal) {
                    viewedSignals.add(currentSignal);
                    updateProgress();
                    currentSignal = null;
                }
            });

            updateProgress();
        });

        window.addEventListener("load", () => {
            startDialogue([
                {
                text: "Hindi tulad ng naunang modyul, ang bahaging ito ay may ilang gawain na susubok sa iyong kaalaman at pag-unawa. Pero huwag kang mag-alala, gawin mo lang ang iyong makakaya at tandaan ang mga natutunan mo. Konting tiyaga na lang at matatapos mo rin ang mga gawain",
                name: "Mga Guro",
                image: "{{ asset('pictures/vn_box_teacher1.png') }}"
                },
                {
                text: "Ngunit bago ka magsimula, kailangan mo munang basahin at unawain ang bawat Gabay sa mga Signal ng Bagyo.",
                name: "Mga Guro",
                image: "{{ asset('pictures/vn_box_teacher1.png') }}"
                },
                {
                text:  "Kapag handa ka na, maaari ka nang magpatuloy.",
                name: "Mga Guro",
                image: "{{ asset('pictures/vn_box_teacher3.png') }}"
                }
            ]);
        });
    </script>
@endpush