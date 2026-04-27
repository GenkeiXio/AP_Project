@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 4')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
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
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Background Map Container */
        .background-map-container {
            display: none;
        }

        .background-map {
            display: none;
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
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .node-container {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            background: var(--old-paper);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 8px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.9),
                inset 0 0 50px rgba(0, 0, 0, 0.2);
            padding: 30px 30px 40px;
            border: 2px solid var(--gold-trim);
            position: relative;
        }

        h1 {
            font-weight: 800;
            font-size: 2.2rem;
            color: var(--ink);
            margin-bottom: 6px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 2px solid var(--ink);
            padding-bottom: 10px;
        }
        h1 i {
            color: var(--danger);
            margin-right: 12px;
        }
        .subhead {
            color: var(--ink);
            font-size: 1.1rem;
            border-left: 5px solid var(--gold-trim);
            padding-left: 18px;
            margin: 10px 0 20px;
        }

        /* READ FIRST SECTION - VINTAGE BOOK THEME */
        .read-first-card {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 25px 30px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            margin-bottom: 35px;
            box-shadow: 
                inset 0 0 30px rgba(0, 0, 0, 0.15),
                0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .read-first-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--ink);
            margin-bottom: 12px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            padding-bottom: 8px;
        }
        
        /* Media Container - Article & Video Side by Side */
        .media-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin: 20px 0;
        }
        
        .article-preview-box {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px;
            box-shadow: 
                inset 0 0 20px rgba(0, 0, 0, 0.1),
                2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #aaa;
        }
        
        .article-preview-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }
        
        .article-preview-header i {
            font-size: 24px;
            color: var(--danger);
        }
        
        .article-preview-header h4 {
            margin: 0;
            font-weight: 700;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
        }
        
        .article-excerpt {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--ink);
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;
            margin-bottom: 15px;
        }
        
        .article-excerpt::-webkit-scrollbar {
            width: 6px;
        }
        
        .article-excerpt::-webkit-scrollbar-track {
            background: #d9c5a3;
            border-radius: 10px;
        }
        
        .article-excerpt::-webkit-scrollbar-thumb {
            background: #8b6b3f;
            border-radius: 10px;
        }
        
        .video-container {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px;
            box-shadow: 
                inset 0 0 20px rgba(0, 0, 0, 0.1),
                2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #aaa;
        }
        
        .video-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }
        
        .video-header i {
            font-size: 24px;
            color: var(--danger);
        }
        
        .video-header h4 {
            margin: 0;
            font-weight: 700;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
        }
        
        .video-wrapper {
            position: relative;
            padding-bottom: 56%;
            height: 0;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid #8b6b3f;
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
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 24px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            border-radius: 3px;
        }
        .article-btn:hover {
            background: #3d2a25;
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
            background: rgba(10, 8, 7, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            width: 90%;
            height: 85%;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 2px solid var(--gold-trim);
        }
        
        .modal-header {
            padding: 15px 20px;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
        }
        
        .modal-header button {
            background: none;
            border: none;
            color: var(--gold-trim);
            font-size: 24px;
            cursor: pointer;
            font-weight: bold;
            padding: 5px 10px;
        }
        
        .modal-header button:hover {
            opacity: 0.8;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
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
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 14px 32px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.3);
            transition: 0.2s;
            cursor: pointer;
            min-width: 280px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px;
        }
        .confirm-btn:disabled {
            opacity: 0.5;
            box-shadow: none;
            pointer-events: none;
            cursor: not-allowed;
            transform: none;
        }
        .confirm-btn.enabled {
            background: #3d2a25;
        }
        .confirm-btn.enabled:hover {
            background: #4a3530;
            transform: translateY(-2px);
        }

        .summary-box {
            background: rgba(244, 228, 199, 0.95);
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 25px 30px;
            margin-top: 40px;
            border-left: 12px solid #8b6b3f;
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background: var(--vintage-leather);
            padding: 10px 15px;
            border-radius: 3px;
            text-decoration: none;
            color: var(--gold-trim);
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
            border: 1px solid var(--gold-trim);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 10px;
            font-family: 'Nunito', sans-serif;
        }
        
        .status-badge.read {
            background: #d9c5a3;
            color: var(--ink);
            border: 1px solid #8b6b3f;
        }
        
        .status-badge.not-read {
            background: #f4e4c7;
            color: var(--danger);
            border: 1px solid var(--danger);
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
                <button id="closeModalBtn">&times;</button>
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
                        <span style="font-size: 1rem; background: var(--vintage-leather); padding: 5px 18px; border-radius: 3px; margin-left: 16px; color: var(--gold-trim); border: 1px solid var(--gold-trim);">Albay</span>
                    </h1>
                </div>
            </div>

            <!-- READ FIRST SECTION with Article Preview and Video -->
            <div class="read-first-card">
                <div class="read-first-title">
                    <i class="fas fa-book-open me-2"></i> 
                     BAGO MAG-ACTIVITY: Basahin at panoorin
                </div>
                <p style="font-size: 1.05rem; margin-bottom: 5px; color: var(--ink);">
                    <strong>Panuto:</strong> Basahin ang artikulo at panoorin ang video.
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
                    
                    <!-- Video Box WITHOUT Autoplay -->
                    <div class="video-container">
                        <div class="video-header">
                            <i class="fab fa-youtube"></i>
                            <h4>Video: Bulkang Mayon</h4>
                        </div>
                        <div class="video-wrapper">
                            <iframe 
                                id="youtubeVideo"
                                src="https://www.youtube.com/embed/UR7cTKlugFM?enablejsapi=1" 
                                title="Bulkang Mayon"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
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
        // Make closeArticleModal globally accessible
        window.closeArticleModal = function() {
            const articleModal = document.getElementById('articleModal');
            const articleIframe = document.getElementById('articleIframe');
            
            // Clear the iframe src to stop loading
            articleIframe.src = 'about:blank';
            // Hide the modal
            articleModal.style.display = 'none';
        };

        (function(){
            "use strict";

            const readBtn = document.getElementById('readArticleBtn');
            const watchBtn = document.getElementById('watchVideoBtn');
            const unlockLink = document.getElementById('unlockActivityBtn');
            const articleModal = document.getElementById('articleModal');
            const articleIframe = document.getElementById('articleIframe');
            const closeModalBtn = document.getElementById('closeModalBtn');
            
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
                articleIframe.src = 'about:blank';
                articleModal.style.display = 'none';
                // Mark as read when modal is closed
                if (!articleRead) {
                    articleRead = true;
                    // Change button style to completed
                    if (readButtonElement) {
                        readButtonElement.classList.add('completed');
                        readButtonElement.innerHTML = '<i class="fas fa-check-circle"></i> ✓ Tapos na';
                    }
                    updateUnlockLink();
                }
            }

            // Override the global function with the full version
            window.closeArticleModal = closeArticleModal;

            function markVideoWatched() {
                if (!videoWatched) {
                    videoWatched = true;
                    // Change button style to completed
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
            
            // Close modal when clicking close button
            closeModalBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeArticleModal();
            });
            
            // Handle video watching - open YouTube in new tab and mark as watched
            watchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.open('https://youtu.be/UR7cTKlugFM', '_blank');
                markVideoWatched();
            });

            // Close modal when clicking outside
            articleModal.addEventListener('click', (e) => {
                if (e.target === articleModal) {
                    closeArticleModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && articleModal.style.display === 'flex') {
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
        })();
    </script>
@endsection