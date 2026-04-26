@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 1')

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
            color: #0d6efd;
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
            color: #0d6efd;
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
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
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
            background: #0b2b4a;
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
            background: #0d6efd;
        }
        .confirm-btn.enabled:hover {
            background: #0b5ed7;
            transform: scale(1.02);
        }
        
        /* drag drop zone */
        .game-area {
            margin-top: 15px;
        }
        .category-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 18px;
            margin: 25px 0 15px;
        }
        .cat-col {
            background: #1e293b;
            color: white;
            padding: 16px 10px;
            border-radius: 40px 40px 16px 16px;
            text-align: center;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 0 #0f172a;
        }
        .cat-col.sanchi { 
            background: #0d6efd; 
            box-shadow: 0 8px 0 #0a4bb5; 
        }
        .cat-col.bunga { 
            background: #b02e2e; 
            box-shadow: 0 8px 0 #7a1f1f; 
        }
        .cat-col.tugon { 
            background: #2e7d32; 
            box-shadow: 0 8px 0 #1b5e20; 
        }

        .dropzones-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 18px;
            min-height: 420px;
        }
        .dropzone {
            background: rgba(249, 249, 255, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 24px;
            padding: 18px 12px;
            border: 3px dashed #b9c7da;
            transition: background 0.2s;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .dropzone.drag-over {
            background: rgba(230, 240, 255, 0.95);
            border-color: #0d6efd;
        }
        .statement-card {
            background: white;
            border-radius: 20px;
            padding: 16px 18px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.08);
            border-left: 8px solid;
            font-weight: 500;
            cursor: grab;
            user-select: none;
            transition: 0.1s;
            border: 1px solid #e2e8f0;
            font-size: 0.98rem;
        }
        .statement-card:active {
            cursor: grabbing;
            opacity: 0.8;
        }
        .statement-card.dragging {
            opacity: 0.3;
        }
        .statement-card.sanhi-border { border-left-color: #0d6efd; }
        .statement-card.bunga-border { border-left-color: #b02e2e; }
        .statement-card.tugon-border { border-left-color: #2e7d32; }

        .items-pool {
            margin: 30px 0 15px;
            background: rgba(238, 242, 246, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 20px 20px;
        }
        .pool-title {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .draggable-container {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .summary-box {
            background: rgba(233, 242, 250, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 25px 30px;
            margin-top: 40px;
            border-left: 12px solid #0d6efd;
        }

        .reset-btn {
            background: #f1f5f9;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .reset-btn:hover {
            background: #e2e8f0;
        }

        .image-badge {
            font-size: 0.9rem;
            margin-top: 4px;
            color: #4b5563;
        }

        .footer-note {
            margin-top: 20px;
            font-style: italic;
            color: #475569;
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
            .dropzones-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .category-header {
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
                <span><i class="fas fa-newspaper"></i> 📖 GMA News Online - Super Typhoon Rolly</span>
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
                    <h1><i class="fas fa-cyclone"></i> NODE 1: Super Typhoon Rolly 
                        <span style="font-size: 1rem; background: #e6e9f0; padding: 5px 18px; border-radius: 30px; margin-left: 16px;">Tabaco, Albay</span>
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
                            <h4>GMA News Online · Nobyembre 2020</h4>
                        </div>
                        <div class="article-excerpt">
                            <strong>Rolly worst to hit Tabaco in Albay since 1952, says mayor</strong><br><br>
                            Super Typhoon Rolly (international name: Goni) is the strongest typhoon to hit Tabaco City in Albay province since 1952, its mayor said Sunday.<br><br>
                            "Ito na ang pinakamalakas na bagyo mula pa 1952," Tabaco Mayor Krisel Lagman-Luistro said in an interview on Dobol B sa News TV. "Malakas siya. Kung ikukumpara kay Reming noong 2006 at saka kay Niña noong 2016, itong si Rolly ay mas malakas."<br><br>
                            The mayor said damage to infrastructure and agriculture in Tabaco is estimated at ₱2.5 billion. Around 3,500 houses were destroyed while 15,500 were damaged. About 90% of fishermen's boats were also destroyed.<br><br>
                            The entire city has no electricity, and 15 villages are experiencing water shortage. Floodwaters reached neck-deep in some areas, forcing residents to swim. Despite the severity, <strong>zero casualties</strong> were reported in Tabaco due to preemptive evacuation.
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
                            <h4>Video: Super Typhoon Rolly</h4>
                        </div>
                        <div class="video-wrapper">
                            <iframe 
                                id="youtubeVideo"
                                src="https://www.youtube.com/embed/mtf1JAQ2hq4?autoplay=1&mute=1&enablejsapi=1" 
                                title="Super Typhoon Rolly"
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
                    <a href="{{ route('module4.node1.game') }}" class="confirm-btn" id="unlockActivityBtn" style="display: inline-block; text-decoration: none; text-align: center;">🔒 Simulan ang Activity</a>
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
            
            // Article URL
            const articleUrl = "https://www.gmanetwork.com/news/topstories/nation/762951/rolly-worst-to-hit-tabaco-in-albay-since-1952-says-mayor/story/";

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
                    // Keep the button text as only "I-unlock ang Activity" without extra text
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
                window.open('https://youtu.be/mtf1JAQ2hq4', '_blank');
                markVideoWatched();
            });

            // Mark video as watched after playing (autoplay detection)
            let videoMarkTimeout = setTimeout(() => {
                if (!videoWatched) {
                    markVideoWatched();
                }
            }, 5000); // Mark as watched after 5 seconds of autoplay

            // Close modal when clicking outside (optional)
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