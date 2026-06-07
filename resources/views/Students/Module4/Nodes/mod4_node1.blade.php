@extends('Students.studentslayout')
@section('title', 'Module 4 : Node 1')

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
            font-size: 1.5rem;
            color: var(--ink);
            margin-bottom: 6px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 2px solid var(--ink);
            padding-bottom: 10px;
            word-break: break-word;
        }

        @media (min-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
        }

        h1 i {
            color: var(--danger);
            margin-right: 12px;
        }

        h1 span {
            font-size: 0.7rem !important;
            display: inline-block;
            margin-top: 8px;
            margin-left: 0 !important;
        }

        @media (min-width: 768px) {
            h1 span {
                font-size: 1rem !important;
                margin-left: 16px !important;
                margin-top: 0;
            }
        }

        .subhead {
            color: var(--ink);
            font-size: 1rem;
            border-left: 5px solid var(--gold-trim);
            padding-left: 18px;
            margin: 10px 0 20px;
        }

        @media (min-width: 768px) {
            .subhead {
                font-size: 1.1rem;
            }
        }

        /* READ FIRST SECTION - VINTAGE BOOK THEME */
        .read-first-card {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            margin-bottom: 35px;
            box-shadow: 
                inset 0 0 30px rgba(0, 0, 0, 0.15),
                0 4px 8px rgba(0, 0, 0, 0.3);
        }

        @media (min-width: 768px) {
            .read-first-card {
                padding: 25px 30px;
            }
        }

        .read-first-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--ink);
            margin-bottom: 12px;
            font-family: 'Nunito', sans-serif;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            padding-bottom: 8px;
        }

        @media (min-width: 768px) {
            .read-first-title {
                font-size: 1.5rem;
            }
        }

        /* Media Container - Article & Video Side by Side */
        .media-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        @media (min-width: 768px) {
            .media-container {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }
        }

        .article-preview-box {
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            border-radius: 5px;
            padding: 15px;
            box-shadow: 
                inset 0 0 20px rgba(0, 0, 0, 0.1),
                2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #aaa;
        }

        @media (min-width: 768px) {
            .article-preview-box {
                padding: 20px;
            }
        }

        .article-preview-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }

        .article-preview-header i {
            font-size: 20px;
            color: var(--danger);
        }

        @media (min-width: 768px) {
            .article-preview-header i {
                font-size: 24px;
            }
        }

        .article-preview-header h4 {
            margin: 0;
            font-weight: 700;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .article-preview-header h4 {
                font-size: 1rem;
            }
        }

        .article-excerpt {
            font-size: 0.85rem;
            line-height: 1.5;
            color: var(--ink);
            max-height: 250px;
            overflow-y: auto;
            padding-right: 8px;
            margin-bottom: 12px;
        }

        @media (min-width: 768px) {
            .article-excerpt {
                font-size: 0.95rem;
                max-height: 200px;
                margin-bottom: 15px;
            }
        }

        .article-excerpt::-webkit-scrollbar {
            width: 4px;
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
            padding: 15px;
            box-shadow: 
                inset 0 0 20px rgba(0, 0, 0, 0.1),
                2px 6px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #aaa;
        }

        @media (min-width: 768px) {
            .video-container {
                padding: 20px;
            }
        }

        .video-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }

        .video-header i {
            font-size: 20px;
            color: var(--danger);
        }

        @media (min-width: 768px) {
            .video-header i {
                font-size: 24px;
            }
        }

        .video-header h4 {
            margin: 0;
            font-weight: 700;
            color: var(--ink);
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .video-header h4 {
                font-size: 1rem;
            }
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
            gap: 10px;
            margin-top: 12px;
        }

        @media (min-width: 768px) {
            .article-links {
                gap: 15px;
                margin-top: 15px;
            }
        }

        .article-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 8px 16px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            border-radius: 3px;
        }

        @media (min-width: 768px) {
            .article-btn {
                padding: 12px 24px;
                font-size: 0.95rem;
                gap: 10px;
            }
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

        /* Modal Styles for Article */
        .article-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 8, 7, 0.95);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .modal-content {
            background: #f4e4c7;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            width: 95%;
            height: 90%;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 2px solid var(--gold-trim);
        }

        @media (min-width: 768px) {
            .modal-content {
                width: 90%;
                height: 85%;
            }
        }

        .modal-header {
            padding: 12px 15px;
            background: var(--vintage-leather);
            color: var(--gold-trim);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        @media (min-width: 768px) {
            .modal-header {
                padding: 15px 20px;
                font-size: 1rem;
                flex-wrap: nowrap;
            }
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
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        @media (min-width: 768px) {
            .confirmation-area {
                gap: 25px;
                margin-top: 25px;
            }
        }

        .confirm-btn {
            background: var(--vintage-leather);
            color: var(--gold-trim);
            border: 1px solid var(--gold-trim);
            padding: 12px 20px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.3);
            transition: 0.2s;
            cursor: pointer;
            min-width: 240px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px;
        }

        @media (min-width: 768px) {
            .confirm-btn {
                padding: 14px 32px;
                font-size: 1.2rem;
                min-width: 280px;
            }
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

        .back-button {
            position: fixed;
            top: 80px;
            left: 15px;
            z-index: 100;
            background: var(--vintage-leather);
            padding: 8px 12px;
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
            font-size: 0.8rem;
        }

        @media (min-width: 768px) {
            .back-button {
                position: absolute;
                top: 20px;
                left: 20px;
                padding: 10px 15px;
                font-size: 1rem;
            }
        }

        .back-button:hover {
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .node-container {
                padding: 20px 15px;
            }
            
            .read-first-card p {
                font-size: 0.9rem !important;
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
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; flex-wrap: wrap;">
                <div>
                    <h1><i class="fas fa-cyclone"></i> NODE 1: Super Typhoon Rolly 
                        <span style="font-size: 0.7rem; background: var(--vintage-leather); padding: 4px 12px; border-radius: 3px; display: inline-block; color: var(--gold-trim); border: 1px solid var(--gold-trim);">Tabaco, Albay</span>
                    </h1>
                </div>
            </div>

            <!-- READ FIRST SECTION with Article Preview and Video -->
            <div class="read-first-card">
                <div class="read-first-title">
                    <i class="fas fa-book-open me-2"></i> 
                     BAGO MAG-ACTIVITY: Basahin at panoorin
                </div>
                <p style="font-size: 0.95rem; margin-bottom: 5px; color: var(--ink);">
                    <strong>Panuto:</strong> Basahin ang artikulo at panoorin ang video.
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
                    
                    <!-- Video Box WITHOUT Autoplay -->
                    <div class="video-container">
                        <div class="video-header">
                            <i class="fab fa-youtube"></i>
                            <h4>Video: Super Typhoon Rolly</h4>
                        </div>
                        <div class="video-wrapper">
                            <iframe 
                                id="youtubeVideo"
                                src="https://www.youtube.com/embed/mtf1JAQ2hq4?enablejsapi=1" 
                                title="Super Typhoon Rolly"
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
                    <a href="{{ route('module4.node1.game') }}" class="confirm-btn" id="unlockActivityBtn" style="display: inline-block; text-decoration: none; text-align: center;">🔒 Simulan ang Activity</a>
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
            
            // Article URL
            const articleUrl = "https://www.gmanetwork.com/news/topstories/nation/762951/rolly-worst-to-hit-tabaco-in-albay-since-1952-says-mayor/story/";

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
                window.open('https://youtu.be/mtf1JAQ2hq4', '_blank');
                markVideoWatched();
            });

            // Close modal when clicking outside (optional)
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