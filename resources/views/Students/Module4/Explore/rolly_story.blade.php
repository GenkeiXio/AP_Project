@extends('Students.studentslayout')
@section('title', 'InnerMap4')

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
            padding-bottom: 56.25%;
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
        }
        .article-btn:hover {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
            transform: translateY(-2px);
        }
        
        .confirmation-area {
            display: flex;
            align-items: center;
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
        }
        .confirm-btn:disabled {
            opacity: 0.45;
            box-shadow: none;
            pointer-events: none;
        }
        .confirm-btn.enabled {
            background: #0d6efd;
        }
        .confirm-btn.enabled:hover {
            background: #0b5ed7;
            transform: scale(1.02);
        }
        
        .read-status {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .status-badge {
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            background: #f1f5f9;
            color: #64748b;
        }
        
        .status-badge.completed {
            background: #d4edda;
            color: #155724;
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
                            <a href="https://www.gmanetwork.com/news/topstories/nation/762951/rolly-worst-to-hit-tabaco-in-albay-since-1952-says-mayor/story/" 
                               target="_blank" 
                               class="article-btn" 
                               id="readArticleBtn">
                                <i class="fas fa-external-link-alt"></i> Basahin ang buong artikulo
                            </a>
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
                            <a href="https://youtu.be/mtf1JAQ2hq4" 
                               target="_blank" 
                               class="article-btn" 
                               id="watchVideoBtn">
                                <i class="fab fa-youtube"></i> Panoorin sa YouTube
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Status and Unlock -->
                <div class="confirmation-area">
                    <button class="confirm-btn" id="unlockActivityBtn" disabled>🔒 I-unlock ang Activity</button>
                    <div class="read-status">
                        <span class="status-badge" id="articleStatus">⏳ Artikulo: Hindi pa nababasa</span>
                        <span class="status-badge" id="videoStatus">⏳ Video: Hindi pa napapanood</span>
                    </div>
                </div>
                <p class="mt-2 text-secondary">
                    <small><i class="far fa-check-circle"></i> I-click ang "Basahin ang buong artikulo" at panoorin ang video para ma-unlock ang activity.</small>
                </p>
            </div>

            <!-- DRAG DROP GAME -->
            <div id="gameSection" style="opacity: 0.5; pointer-events: none; transition: opacity 0.3s;">
                <div class="game-area">
                    <div class="category-header">
                        <div class="cat-col sanchi"><i class="fas fa-dot-circle"></i> SANHI</div>
                        <div class="cat-col bunga"><i class="fas fa-exclamation-triangle"></i> BUNGA (EPEKTO)</div>
                        <div class="cat-col tugon"><i class="fas fa-hands-helping"></i> MGA TUGON</div>
                    </div>

                    <div class="dropzones-row">
                        <div class="dropzone" id="dropzoneSanhi" data-category="sanhi"></div>
                        <div class="dropzone" id="dropzoneBunga" data-category="bunga"></div>
                        <div class="dropzone" id="dropzoneTugon" data-category="tugon"></div>
                    </div>

                    <div class="items-pool">
                        <div class="pool-title"><i class="fas fa-arrows-alt"></i> I-DRAG ANG MGA PAHAYAG SA TAMANG KAHON</div>
                        <div class="draggable-container" id="draggablePool"></div>
                        <div class="mt-3 text-end">
                            <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang mga kard</button>
                        </div>
                    </div>
                </div>

                <div class="summary-box" id="summaryBox" style="display: none;">
                    <h3 style="font-weight: 800;"><i class="fas fa-clipboard-list me-2"></i> BUOD (SUMMARY)</h3>
                    <p style="font-size: 1.05rem; margin-top: 15px; line-height: 1.6;">
                        Ang Super Typhoon Rolly ay itinuturing na pinakamalakas na bagyong tumama sa Tabaco, Albay mula pa noong 1952, na nagdulot ng humigit-kumulang ₱2.5 bilyong pinsala sa mga bahay, kabuhayan, at imprastruktura. Libu-libong tahanan ang nawasak o napinsala, at halos lahat ng bangka ng mga mangingisda ay nasira, habang nawalan ng kuryente at sapat na suplay ng tubig ang maraming barangay. Naranasan din ng mga residente ang matinding pagbaha kung saan ang ilan ay napilitang lumangoy upang makaligtas. Nasira rin ang mga makasaysayang gusali. Sa kabila ng matinding pinsala, <strong>walang naitalang nasawi</strong>, na nagpapatunay sa kahalagahan ng kahandaan, disiplina, at pagtutulungan.
                    </p>
                    <div class="mt-3">
                        <span class="badge bg-primary p-2 px-4" style="font-size: 1rem;">✅ Zero casualty · Bayanihan</span>
                    </div>
                </div>
            </div>
            <p class="footer-note"><i class="far fa-lightbulb"></i> Matapos mai-drag ang lahat ng pahayag sa tamang kategorya, lilitaw ang buod.</p>
        </div>
    </div>

    <script>
        (function(){
            "use strict";

            const statements = [
                { 
                    text: "Ang matinding pinsala at panganib na naranasan sa Tabaco, Albay—kabilang ang pagkasira ng mga bahay, kabuhayan, at mahahalagang serbisyo—ay kasabay ng pagdating ng Super Typhoon Rolly, na nagdala ng napakalakas na hangin at matinding pag-ulan na nagdulot ng malawakang pagbaha.", 
                    category: "sanhi",
                    imageNote: "🌀 SANHI"
                },
                { 
                    text: "Nagresulta ito sa humigit-kumulang ₱2.5 bilyong pinsala, pagkawasak at pagkasira ng libu-libong bahay, pagkasira ng 90% ng mga bangka ng mangingisda, pagkawala ng kuryente sa buong lungsod, kakulangan sa suplay ng tubig, at matinding pagbaha. Nasira rin ang mga makasaysayang gusali. Gayunpaman, walang naitalang nasawi.", 
                    category: "bunga",
                    imageNote: "📉 EPEKTO"
                },
                { 
                    text: "Ipinakita ng mga residente ang matibay na pagkakaisa at pagtutulungan sa gitna ng sakuna. Naging mahalaga ang kahandaan at disiplina, tulad ng maagang paglikas at pagsunod sa mga babala, kaya walang naitalang nasawi. Kumilos din ang lokal na pamahalaan upang magbigay ng agarang tulong.", 
                    category: "tugon",
                    imageNote: "🤝 TUGON"
                }
            ];

            const readBtn = document.getElementById('readArticleBtn');
            const watchBtn = document.getElementById('watchVideoBtn');
            const unlockBtn = document.getElementById('unlockActivityBtn');
            const gameSection = document.getElementById('gameSection');
            const draggablePool = document.getElementById('draggablePool');
            const dropSanhi = document.getElementById('dropzoneSanhi');
            const dropBunga = document.getElementById('dropzoneBunga');
            const dropTugon = document.getElementById('dropzoneTugon');
            const summaryBox = document.getElementById('summaryBox');
            const resetBtn = document.getElementById('resetGameBtn');
            const articleStatus = document.getElementById('articleStatus');
            const videoStatus = document.getElementById('videoStatus');

            let articleRead = false;
            let videoWatched = false;
            let gameUnlocked = false;
            let draggedElement = null;
            let cardElements = [];

            function updateStatus() {
                if (articleRead) {
                    articleStatus.innerHTML = '✅ Artikulo: Nabasa na';
                    articleStatus.classList.add('completed');
                } else {
                    articleStatus.innerHTML = '⏳ Artikulo: Hindi pa nababasa';
                    articleStatus.classList.remove('completed');
                }
                
                if (videoWatched) {
                    videoStatus.innerHTML = '✅ Video: Napanood na';
                    videoStatus.classList.add('completed');
                } else {
                    videoStatus.innerHTML = '⏳ Video: Hindi pa napapanood';
                    videoStatus.classList.remove('completed');
                }
            }

            function updateUnlockButton() {
                if (articleRead && videoWatched) {
                    unlockBtn.disabled = false;
                    unlockBtn.classList.add('enabled');
                    unlockBtn.innerHTML = '🔓 I-unlock ang Activity (Drag & Drop)';
                } else {
                    unlockBtn.disabled = true;
                    unlockBtn.classList.remove('enabled');
                    unlockBtn.innerHTML = '🔒 I-unlock ang Activity';
                }
            }

            readBtn.addEventListener('click', (e) => {
                window.open(readBtn.href, '_blank');
                articleRead = true;
                updateStatus();
                updateUnlockButton();
            });
            
            watchBtn.addEventListener('click', (e) => {
                window.open(watchBtn.href, '_blank');
                videoWatched = true;
                updateStatus();
                updateUnlockButton();
            });

            // Mark video as watched when played (since it autoplays)
            const youtubeIframe = document.getElementById('youtubeVideo');
            // Optional: You can also mark as watched after a few seconds using YouTube API
            // For simplicity, we'll also consider it watched if they click the watch button
            // But since it autoplays, we can auto-mark after 3 seconds
            setTimeout(() => {
                if (!videoWatched) {
                    videoWatched = true;
                    updateStatus();
                    updateUnlockButton();
                }
            }, 3000);

            unlockBtn.addEventListener('click', () => {
                if (!articleRead || !videoWatched) return;
                gameUnlocked = true;
                gameSection.style.opacity = '1';
                gameSection.style.pointerEvents = 'auto';
                unlockBtn.disabled = true;
                unlockBtn.innerHTML = '✅ Aktibidad naka-unlock';
            });

            function renderCards() {
                draggablePool.innerHTML = '';
                cardElements = [];
                statements.forEach((stmt, index) => {
                    const card = document.createElement('div');
                    card.className = `statement-card ${stmt.category}-border`;
                    card.setAttribute('draggable', 'true');
                    card.setAttribute('data-category', stmt.category);
                    card.setAttribute('data-index', index);
                    card.innerHTML = `${stmt.text} <div class="image-badge"><i class="far fa-image"></i> ${stmt.imageNote}</div>`;
                    
                    card.addEventListener('dragstart', handleDragStart);
                    card.addEventListener('dragend', handleDragEnd);
                    draggablePool.appendChild(card);
                    cardElements.push(card);
                });
            }

            function handleDragStart(e) {
                if (!gameUnlocked) {
                    e.preventDefault();
                    return false;
                }
                draggedElement = this;
                this.classList.add('dragging');
                e.dataTransfer.setData('text/plain', this.dataset.index);
                e.dataTransfer.effectAllowed = 'move';
            }

            function handleDragEnd(e) {
                this.classList.remove('dragging');
                document.querySelectorAll('.dropzone').forEach(z => z.classList.remove('drag-over'));
            }

            const dropzones = [dropSanhi, dropBunga, dropTugon];
            dropzones.forEach(zone => {
                zone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    if (!gameUnlocked) return;
                    e.dataTransfer.dropEffect = 'move';
                    zone.classList.add('drag-over');
                });
                zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
                zone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    zone.classList.remove('drag-over');
                    if (!gameUnlocked) {
                        alert('I-unlock muna ang activity sa pamamagitan ng pagbasa at panonood.');
                        return;
                    }
                    const index = e.dataTransfer.getData('text/plain');
                    if (!index || !draggedElement) return;
                    
                    const card = document.querySelector(`.statement-card[data-index="${index}"]`);
                    if (!card) return;
                    
                    const targetCategory = zone.dataset.category;
                    const cardCategory = card.dataset.category;
                    
                    if (cardCategory !== targetCategory) {
                        alert(`❌ Hindi tama! Ang pahayag na ito ay para sa kategoryang ${cardCategory.toUpperCase()}. Subukan muli.`);
                        return;
                    }
                    
                    if (card.parentNode === zone) return;
                    zone.appendChild(card);
                    card.style.cursor = 'default';
                    card.setAttribute('draggable', 'false');
                    card.classList.add('placed');
                    
                    checkAllPlaced();
                });
            });

            function checkAllPlaced() {
                const totalCards = statements.length;
                const placedSanhi = dropSanhi.children.length;
                const placedBunga = dropBunga.children.length;
                const placedTugon = dropTugon.children.length;
                
                if (placedSanhi + placedBunga + placedTugon === totalCards) {
                    let correct = true;
                    if (dropSanhi.children.length !== 1 || dropSanhi.children[0]?.dataset.category !== 'sanhi') correct = false;
                    if (dropBunga.children.length !== 1 || dropBunga.children[0]?.dataset.category !== 'bunga') correct = false;
                    if (dropTugon.children.length !== 1 || dropTugon.children[0]?.dataset.category !== 'tugon') correct = false;
                    
                    if (correct) {
                        summaryBox.style.display = 'block';
                    }
                } else {
                    summaryBox.style.display = 'none';
                }
            }

            function resetGame() {
                if (!gameUnlocked) return;
                draggablePool.innerHTML = '';
                dropSanhi.innerHTML = '';
                dropBunga.innerHTML = '';
                dropTugon.innerHTML = '';
                renderCards();
                summaryBox.style.display = 'none';
            }

            resetBtn.addEventListener('click', resetGame);

            document.addEventListener('dragover', (e) => e.preventDefault());
            document.addEventListener('drop', (e) => e.preventDefault());

            renderCards();
            updateStatus();
            updateUnlockButton();
            
            document.addEventListener('dragstart', (e) => {
                if (!gameUnlocked && e.target.classList.contains('statement-card')) {
                    e.preventDefault();
                    alert('🔒 Basahin at panoorin muna ang materyal, pagkatapos i-unlock ang aktibidad.');
                }
            }, true);
        })();
    </script>
@endsection