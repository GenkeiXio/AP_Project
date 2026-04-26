@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 4')

@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #eef2f7;
            font-family: 'Segoe UI', Roboto, system-ui, sans-serif;
            padding: 0;
            margin: 0;
            position: relative;
            min-height: 100vh;
        }

        /* Background Map Container */
        .background-map-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .background-map {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Main Content Wrapper */
        .content-wrapper {
            position: relative;
            z-index: 1;
            padding: 25px 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .node-container {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 36px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 30px 30px 40px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        h1 {
            font-weight: 800;
            font-size: 2.2rem;
            color: #0b2b4a;
            margin-bottom: 6px;
        }
        h1 i {
            color: #ff6f00;
            margin-right: 12px;
        }
        .subhead {
            color: #2c3e50;
            font-size: 1.1rem;
            border-left: 5px solid #ff9800;
            padding-left: 18px;
            margin: 10px 0 20px;
        }

        /* READ FIRST SECTION */
        .read-first-card {
            background: rgba(248, 250, 252, 0.95);
            border-radius: 28px;
            padding: 25px 30px;
            border: 2px dashed #94a3b8;
            margin-bottom: 35px;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.02);
            backdrop-filter: blur(5px);
        }
        .read-first-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 12px;
        }
        
        /* Media Container - Article & Video Side by Side */
        .media-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin: 20px 0;
        }
        
        .article-preview-box {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
        }
        
        .article-preview-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .article-preview-header i {
            font-size: 24px;
            color: #ff6f00;
        }
        
        .article-preview-header h4 {
            margin: 0;
            font-weight: 700;
            color: #1e293b;
        }
        
        .article-excerpt {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #334155;
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;
            margin-bottom: 15px;
        }
        
        .article-excerpt::-webkit-scrollbar {
            width: 6px;
        }
        
        .article-excerpt::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .article-excerpt::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        .video-container {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
        }
        
        .video-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .video-header i {
            font-size: 24px;
            color: #ff0000;
        }
        
        .video-header h4 {
            margin: 0;
            font-weight: 700;
            color: #1e293b;
        }
        
        .video-wrapper {
            position: relative;
            padding-bottom: 56%;
            height: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .article-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        
        .article-btn {
            background: white;
            border-radius: 60px;
            padding: 12px 24px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            border: 1px solid #dee2e6;
            transition: all 0.15s;
            color: #0b2b4a;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            cursor: pointer;
        }
        .article-btn:hover {
            background: #ff6f00;
            color: white;
            border-color: #ff6f00;
            transform: translateY(-2px);
        }
        
        /* Completed Button Style */
        .article-btn.completed {
            background: #2e7d32;
            border-color: #1b5e20;
            color: white;
            cursor: default;
            pointer-events: none;
            opacity: 0.8;
        }
        .article-btn.completed:hover {
            transform: none;
            background: #2e7d32;
        }
        
        /* Modal Styles for Article */
        .article-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: white;
            width: 90%;
            height: 85%;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .modal-header {
            padding: 15px 20px;
            background: #e65100;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }
        
        .modal-header button {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .modal-header button:hover {
            opacity: 0.8;
        }
        
        .modal-body {
            flex: 1;
            overflow: auto;
        }
        
        .modal-body iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .confirmation-area {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 25px;
        }
        .confirm-btn {
            background: #2b3a55;
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 10px 18px rgba(0,0,0,0.1);
            transition: 0.2s;
            cursor: pointer;
            min-width: 280px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .confirm-btn:disabled {
            opacity: 0.55;
            box-shadow: none;
            pointer-events: none;
            cursor: not-allowed;
        }
        .confirm-btn.enabled {
            background: #ff6f00;
        }
        .confirm-btn.enabled:hover {
            background: #e65100;
            transform: scale(1.02);
        }

        .summary-box {
            background: rgba(233, 242, 250, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 25px 30px;
            margin-top: 40px;
            border-left: 12px solid #ff6f00;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #1a1a1a;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            transition: transform 0.2s;
        }
        
        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 10px;
        }
        
        .status-badge.read {
            background: #d4edda;
            color: #155724;
        }
        
        .status-badge.not-read {
            background: #f8d7da;
            color: #721c24;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .media-container {
                grid-template-columns: 1fr;
            }
            .node-container {
                padding: 20px 15px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Background Map -->
    <div class="background-map-container">
        <img src="{{ asset('pictures/mod4_innermap.png') }}" class="background-map" alt="Module 4 Inner Map">
    </div>

    <a href="{{ route('inner.map4') }}" class="back-button">⬅️ Bumalik</a>

    <!-- Article Modal (Temporary Web View) -->
    <div id="articleModal" class="article-modal">
        <div class="modal-content">
            <div class="modal-header">
                <span><i class="fas fa-newspaper"></i> 📖 Philstar - Pagsabog ng Lava sa Bulkang Mayon</span>
                <button onclick="closeArticleModal()">&times;</button>
            </div>
            <div class="modal-body">
                <iframe id="articleIframe" src="about:blank"></iframe>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="node-container">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <div>
                    <h1><i class="fas fa-mountain"></i> NODE 4: Pagputok ng Bulkang Mayon 
                        <span style="font-size: 1rem; background: #e6e9f0; padding: 5px 18px; border-radius: 30px; margin-left: 16px;">Albay</span>
                    </h1>
                </div>
            </div>

            <!-- READ FIRST SECTION with Article Preview and Video -->
            <div class="read-first-card">
                <div class="read-first-title">
                    <i class="fas fa-book-open me-2"></i> 
                     BAGO MAG-ACTIVITY: Basahin at panoorin
                </div>
                <p style="font-size: 1.05rem; margin-bottom: 5px;">
                    <strong>Panuto:</strong> Basahin ang artikulo at panoorin ang video. Awtomatikong magpe-play ang video.
                </p>
                
                <!-- Article & Video Side by Side -->
                <div class="media-container">
                    <!-- Article Preview Box -->
                    <div class="article-preview-box">
                        <div class="article-preview-header">
                            <i class="fas fa-newspaper"></i>
                            <h4>Philstar · Oktubre 2023</h4>
                        </div>
                        <div class="article-excerpt">
                            <strong>Pagsabog ng lava sa Bulkang Mayon, naitala</strong><br><br>
                            Noong Hunyo 8, 2023, nakunan ang pag-agos at pagguho ng nagliliwanag na lava mula sa Bulkang Mayon, lalo na kapansin-pansin sa gabi dahil sa liwanag nito. Ipinakita ng aktibidad ang tuloy-tuloy na paglabas ng magma, kabilang ang mga "incandescent rockfalls," na senyales ng aktibong pagputok.<br><br>
                            Ayon sa PHIVOLCS, naitala ang sunod-sunod na lava eruption na sinabayan ng seismic at infrasound signals—mga palatandaan ng tumitinding aktibidad ng bulkan. Umabot ng ilang kilometro pababa sa mga dalisdis ang pagdaloy ng lava.<br><br>
                            Dahil dito, itinaas ang Alert Level 3 at nagbabala ang mga awtoridad sa posibleng panganib tulad ng lava flow, ashfall, at pyroclastic flows. Pinag-iingat ang mga residente at inihahanda ang mga hakbang sa paglikas upang mapanatili ang kaligtasan ng mga komunidad sa paligid ng bulkan.
                        </div>
                        <div class="article-links">
                            <button class="article-btn" id="readArticleBtn">
                                <i class="fas fa-external-link-alt"></i> Basahin ang buong artikulo
                            </button>
                        </div>
                    </div>
                    
                    <!-- Video Box with Autoplay -->
                    <div class="video-container">
                        <div class="video-header">
                            <i class="fab fa-youtube"></i>
                            <h4>Video: Bulkang Mayon</h4>
                        </div>
                        <div class="video-wrapper">
                            <iframe 
                                id="youtubeVideo"
                                src="https://www.youtube.com/embed/UR7cTKlugFM?autoplay=1&mute=1&enablejsapi=1" 
                                title="Bulkang Mayon"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="article-links" style="margin-top: 15px;">
                            <button class="article-btn" id="watchVideoBtn">
                                <i class="fab fa-youtube"></i> Panoorin sa YouTube
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Single Centered Unlock Button - Redirects to game page -->
                <div class="confirmation-area">
                    <a href="{{ route('module4.node4.game') }}" class="confirm-btn" id="unlockActivityBtn" style="display: inline-block; text-decoration: none; text-align: center;">🔒 Simulan ang Activity</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function(){
            "use strict";

            const readBtn = document.getElementById('readArticleBtn');
            const watchBtn = document.getElementById('watchVideoBtn');
            const unlockLink = document.getElementById('unlockActivityBtn');
            const articleModal = document.getElementById('articleModal');
            const articleIframe = document.getElementById('articleIframe');
            
            let articleRead = false;
            let videoWatched = false;
            
            // Save references to buttons to change their text/style later
            const readButtonElement = readBtn;
            const watchButtonElement = watchBtn;
            
            // Article URL - Philstar article about Mayon Volcano
            const articleUrl = "https://www.philstar.com/pang-masa/police-metro/2023/10/22/2305565/pagsabog-ng-lava-sa-bulkang-mayon-naitala";

            function openArticleModal() {
                articleIframe.src = articleUrl;
                articleModal.style.display = 'flex';
            }

            function closeArticleModal() {
                articleModal.style.display = 'none';
                // Mark as read when modal is closed
                if (!articleRead) {
                    articleRead = true;
                    // Change button style to completed (green)
                    if (readButtonElement) {
                        readButtonElement.classList.add('completed');
                        readButtonElement.innerHTML = '<i class="fas fa-check-circle"></i> ✓ Tapos na';
                    }
                    updateUnlockLink();
                }
            }

            function markVideoWatched() {
                if (!videoWatched) {
                    videoWatched = true;
                    // Change button style to completed (green)
                    if (watchButtonElement) {
                        watchButtonElement.classList.add('completed');
                        watchButtonElement.innerHTML = '<i class="fas fa-check-circle"></i> ✓ Tapos na';
                    }
                    updateUnlockLink();
                }
            }

            function updateUnlockLink() {
                if (articleRead && videoWatched) {
                    unlockLink.style.pointerEvents = 'auto';
                    unlockLink.style.opacity = '1';
                    unlockLink.classList.add('enabled');
                    unlockLink.innerHTML = '🎮 Simulan ang Activity';
                } else {
                    unlockLink.style.pointerEvents = 'none';
                    unlockLink.style.opacity = '0.6';
                    unlockLink.classList.remove('enabled');
                    unlockLink.innerHTML = '🔒 Simulan ang Activity';
                }
            }

            // Open article modal when clicking read button
            readBtn.addEventListener('click', (e) => {
                e.preventDefault();
                openArticleModal();
            });
            
            // Handle video watching - open YouTube in new tab and mark as watched
            watchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.open('https://youtu.be/UR7cTKlugFM', '_blank');
                markVideoWatched();
            });

            // Mark video as watched after playing (autoplay detection)
            let videoMarkTimeout = setTimeout(() => {
                if (!videoWatched) {
                    markVideoWatched();
                }
            }, 5000); // Mark as watched after 5 seconds of autoplay

            // Close modal when clicking outside
            articleModal.addEventListener('click', (e) => {
                if (e.target === articleModal) {
                    closeArticleModal();
                }
            });

            // Prevent navigation if not unlocked
            unlockLink.addEventListener('click', (e) => {
                if (!articleRead || !videoWatched) {
                    e.preventDefault();
                    alert('🔒 Basahin muna ang artikulo at panoorin ang video bago i-unlock ang aktibidad.');
                    return false;
                }
                return true;
            });

            // Initialize
            updateUnlockLink();
            
            // Cleanup timeout on page unload
            window.addEventListener('beforeunload', () => {
                if (videoMarkTimeout) clearTimeout(videoMarkTimeout);
            });
        })();
    </script>
@endsection