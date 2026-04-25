@extends('Students.studentslayout')
@section('title', 'Drag & Drop Activity - Sanhi, Bunga, Tugon')

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

        .game-container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-radius: 36px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 30px 30px 40px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        h1 {
            font-weight: 800;
            font-size: 2rem;
            color: #0b2b4a;
            margin-bottom: 6px;
        }
        h1 i {
            color: #0d6efd;
            margin-right: 12px;
        }
        
        .subhead {
            color: #2c3e50;
            font-size: 1rem;
            border-left: 5px solid #ff9800;
            padding-left: 18px;
            margin: 10px 0 25px;
        }

        /* Category Headers with Images */
        .category-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin: 10px 0 20px;
        }
        
        .cat-col {
            background: #1e293b;
            color: white;
            padding: 20px 15px;
            border-radius: 24px 24px 20px 20px;
            text-align: center;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 0 #0f172a;
            transition: transform 0.2s;
        }
        
        .cat-col.sanhi-cat { 
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            box-shadow: 0 6px 0 #0a4bb5; 
        }
        .cat-col.bunga-cat { 
            background: linear-gradient(135deg, #b02e2e, #8b2323);
            box-shadow: 0 6px 0 #7a1f1f; 
        }
        .cat-col.tugon-cat { 
            background: linear-gradient(135deg, #2e7d32, #1e5a20);
            box-shadow: 0 6px 0 #1b5e20; 
        }
        
        .cat-icon {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 10px;
        }
        
        .cat-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            display: block;
            margin: 0 auto 10px auto;
            filter: brightness(0) invert(1);
        }
        
        .cat-label {
            font-size: 1.4rem;
            letter-spacing: 2px;
        }
        
        .cat-sub {
            font-size: 0.8rem;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: normal;
        }

        /* Drop Zones Row */
        .dropzones-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            min-height: 450px;
            margin-bottom: 20px;
        }
        
        .dropzone {
            background: rgba(248, 250, 252, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 20px 15px;
            border: 3px dashed #cbd5e1;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-height: 400px;
        }
        
        .dropzone.drag-over {
            background: rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
            border-style: solid;
        }
        
        .dropzone-header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            color: #334155;
        }
        
        /* Statement Cards */
        .statement-card {
            background: white;
            border-radius: 20px;
            padding: 16px 18px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.08);
            border-left: 8px solid;
            font-weight: 500;
            cursor: grab;
            user-select: none;
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .statement-card:active {
            cursor: grabbing;
        }
        
        .statement-card.dragging {
            opacity: 0.3;
            cursor: grabbing;
        }
        
        .statement-card.placed {
            cursor: default;
            opacity: 0.9;
        }
        
        .statement-card.sanhi-border { border-left-color: #0d6efd; }
        .statement-card.bunga-border { border-left-color: #b02e2e; }
        .statement-card.tugon-border { border-left-color: #2e7d32; }
        
        .card-image-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px solid #eef2f6;
            font-size: 0.8rem;
            color: #64748b;
        }
        
        .card-image-badge img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        /* Items Pool (Draggable Area) */
        .items-pool {
            margin: 25px 0 20px;
            background: rgba(238, 242, 246, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 20px 24px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .pool-title {
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
        }
        
        .draggable-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        /* Summary Box */
        .summary-box {
            background: linear-gradient(135deg, #f0f9ff, #e6f7ec);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 28px 32px;
            margin-top: 35px;
            border-left: 12px solid #0d6efd;
            display: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        
        .summary-box h3 {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #0b2b4a;
        }
        
        .summary-box p {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #1e293b;
        }

        /* Reset Button */
        .reset-btn {
            background: #f1f5f9;
            border: none;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        
        .reset-btn:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        /* Game Controls Bar */
        .game-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 18px;
            border-radius: 40px;
            text-decoration: none;
            color: #1a1a1a;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: transform 0.2s;
            backdrop-filter: blur(4px);
        }
        
        .back-button:hover {
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .dropzones-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .category-header {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .game-container {
                padding: 20px 15px;
            }
            .cat-col {
                padding: 12px;
            }
        }
        
        /* Completion Message */
        .completion-badge {
            background: #d4edda;
            color: #155724;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
    </style>
@endpush

@section('content')
    <!-- Background Map -->
    <div class="background-map-container">
        <img src="{{ asset('pictures/mod4_innermap.png') }}" class="background-map" alt="Module 4 Inner Map">
    </div>

    <a href="{{ route('inner.map4') }}" class="back-button">⬅️ Bumalik sa Module</a>

    <div class="content-wrapper">
        <div class="game-container">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; margin-bottom: 5px;">
                <div>
                    <h1><i class="fas fa-arrows-alt"></i> 🎮 Sanhi, Bunga, at Tugon</h1>
                    <p class="subhead"><i class="fas fa-hand-peace me-2"></i> I-drag ang mga pahayag sa tamang kategorya: SANHI (Dahilan) | BUNGA (Epekto) | MGA TUGON (Solusyon/Responde)</p>
                </div>
            </div>

            <!-- Category Headers with IMAGE placeholders -->
            <div class="category-header">
                <div class="cat-col sanhi-cat">
                    <!-- IMAGE TAG: Change src path later -->
                    <img src="{{ asset('pictures/sanhi-icon.png') }}" alt="Sanhi Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-frown cat-icon"></i>
                    <div class="cat-label">🔵 SANHI</div>
                    <div class="cat-sub">(Dahilan / Cause)</div>
                </div>
                <div class="cat-col bunga-cat">
                    <!-- IMAGE TAG: Change src path later -->
                    <img src="{{ asset('pictures/bunga-icon.png') }}" alt="Bunga Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-tornado cat-icon"></i>
                    <div class="cat-label">🔴 BUNGA</div>
                    <div class="cat-sub">(Epekto / Effect)</div>
                </div>
                <div class="cat-col tugon-cat">
                    <!-- IMAGE TAG: Change src path later -->
                    <img src="{{ asset('pictures/tugon-icon.png') }}" alt="Tugon Icon" class="cat-image" onerror="this.style.display='none'">
                    <i class="fas fa-hand-holding-heart cat-icon"></i>
                    <div class="cat-label">🟢 MGA TUGON</div>
                    <div class="cat-sub">(Responde / Response)</div>
                </div>
            </div>

            <!-- Drop Zones Row -->
            <div class="dropzones-row">
                <div class="dropzone" id="dropzoneSanhi" data-category="sanhi">
                    <div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang SANHI dito</div>
                </div>
                <div class="dropzone" id="dropzoneBunga" data-category="bunga">
                    <div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang BUNGA dito</div>
                </div>
                <div class="dropzone" id="dropzoneTugon" data-category="tugon">
                    <div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang MGA TUGON dito</div>
                </div>
            </div>

            <!-- Draggable Items Pool -->
            <div class="items-pool">
                <div class="pool-title">
                    <i class="fas fa-grip-vertical"></i> 
                    I-drag ang mga sumusunod na pahayag:
                </div>
                <div class="draggable-container" id="draggablePool">
                    <!-- Statements will be injected here via JavaScript -->
                </div>
            </div>

            <!-- Game Controls and Reset -->
            <div class="game-controls">
                <button class="reset-btn" id="resetGameBtn"><i class="fas fa-undo-alt"></i> I-reset ang Aktibidad</button>
                <div id="completionStatus"></div>
            </div>

            <!-- Summary Box (shows after completing) -->
            <div class="summary-box" id="summaryBox">
                <h3><i class="fas fa-clipboard-list"></i> 📖 BUOD (Summary)</h3>
                <p>Ang Super Typhoon Rolly ay itinuturing na pinakamalakas na bagyong tumama sa Tabaco, Albay mula pa noong 1952, na nagdulot ng humigit-kumulang ₱2.5 bilyong pinsala sa mga bahay, kabuhayan, at imprastruktura. Libu-libong tahanan ang nawasak o napinsala, at halos lahat ng bangka ng mga mangingisda ay nasira, habang nawalan ng kuryente at sapat na suplay ng tubig ang maraming barangay. Naranasan din ng mga residente ang matinding pagbaha kung saan ang ilan ay napilitang lumangoy upang makaligtas. Nasira rin ang mga makasaysayang gusali, kabilang ang isang lumang simbahan at bahay, na nagpapakita ng epekto ng sakuna sa kultura at kasaysayan. Sa kabila ng matinding pinsala at paghihirap, walang naitalang nasawi, na nagpapatunay sa kahalagahan ng kahandaan, disiplina, at pagtutulungan ng komunidad sa pagharap sa kalamidad.</p>
                <div style="margin-top: 20px;">
                    <span class="completion-badge"><i class="fas fa-check-circle"></i> Napakahusay! Nakumpleto mo ang aktibidad.</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function(){
            "use strict";

            // ==================== STATEMENTS DATA ====================
            const statements = [
                { 
                    text: "Ang matinding pinsala at panganib na naranasan sa Tabaco, Albay—kabilang ang pagkasira ng mga bahay, kabuhayan, at mahahalagang serbisyo—ay kasabay ng pagdating ng Super Typhoon Rolly, na nagdala ng napakalakas na hangin at matinding pag-ulan na nagdulot ng malawakang pagbaha.", 
                    category: "sanhi",
                    imageNote: "🌀 SANHI",
                    imageIcon: "pictures/sanhi-card.png"  // change image path later
                },
                { 
                    text: "Nagresulta ito sa humigit-kumulang ₱2.5 bilyong pinsala, pagkawasak at pagkasira ng libu-libong bahay, pagkasira ng 90% ng mga bangka ng mangingisda, pagkawala ng kuryente sa buong lungsod, kakulangan sa suplay ng tubig sa ilang barangay, at matinding pagbaha kung saan napilitang lumangoy ang ilang residente. Nasira rin ang mga makasaysayang gusali. Gayunpaman, walang naitalang nasawi.", 
                    category: "bunga",
                    imageNote: "📉 EPEKTO",
                    imageIcon: "pictures/bunga-card.png"
                },
                { 
                    text: "Ipinakita ng mga residente ang matibay na pagkakaisa at pagtutulungan sa gitna ng sakuna. Naging mahalaga ang kahandaan at disiplina, tulad ng maagang paglikas at pagsunod sa mga babala, kaya walang naitalang nasawi. Kumilos din ang lokal na pamahalaan upang magbigay ng agarang tulong, kabilang ang pamamahagi ng suplay at pagsasaayos ng mga apektadong lugar. Sa kabuuan, ang mabilis na pagtugon ng komunidad at pamahalaan ang naging susi upang mapanatili ang kaligtasan ng mga tao.", 
                    category: "tugon",
                    imageNote: "🤝 TUGON NG KOMUNIDAD",
                    imageIcon: "pictures/tugon-card.png"
                }
            ];

            // DOM Elements
            const draggablePool = document.getElementById('draggablePool');
            const dropSanhi = document.getElementById('dropzoneSanhi');
            const dropBunga = document.getElementById('dropzoneBunga');
            const dropTugon = document.getElementById('dropzoneTugon');
            const summaryBox = document.getElementById('summaryBox');
            const resetBtn = document.getElementById('resetGameBtn');
            const completionStatus = document.getElementById('completionStatus');

            let draggedElement = null;
            let gameActive = true;

            // Helper: Render all draggable cards
            function renderCards() {
                if (!draggablePool) return;
                draggablePool.innerHTML = '';
                
                statements.forEach((stmt, index) => {
                    const card = document.createElement('div');
                    card.className = `statement-card ${stmt.category}-border`;
                    card.setAttribute('draggable', 'true');
                    card.setAttribute('data-category', stmt.category);
                    card.setAttribute('data-index', index);
                    
                    // Card content with optional image inside the card
                    let imageHtml = '';
                    if (stmt.imageIcon) {
                        imageHtml = `<img src="{{ asset('${stmt.imageIcon}') }}" alt="icon" style="width: 22px; height: 22px; object-fit: contain;" onerror="this.style.display='none'">`;
                    }
                    
                    card.innerHTML = `
                        ${stmt.text}
                        <div class="card-image-badge">
                            ${imageHtml}
                            <span><i class="far fa-image"></i> ${stmt.imageNote}</span>
                        </div>
                    `;
                    
                    card.addEventListener('dragstart', handleDragStart);
                    card.addEventListener('dragend', handleDragEnd);
                    draggablePool.appendChild(card);
                });
            }

            function handleDragStart(e) {
                if (!gameActive) {
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
                document.querySelectorAll('.dropzone').forEach(zone => {
                    zone.classList.remove('drag-over');
                });
                draggedElement = null;
            }

            // Setup drop zones
            function setupDropZones() {
                const dropzones = [dropSanhi, dropBunga, dropTugon];
                dropzones.forEach(zone => {
                    if (!zone) return;
                    
                    zone.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        if (!gameActive) return;
                        e.dataTransfer.dropEffect = 'move';
                        zone.classList.add('drag-over');
                    });
                    
                    zone.addEventListener('dragleave', () => {
                        zone.classList.remove('drag-over');
                    });
                    
                    zone.addEventListener('drop', (e) => {
                        e.preventDefault();
                        zone.classList.remove('drag-over');
                        if (!gameActive) return;
                        
                        const index = e.dataTransfer.getData('text/plain');
                        if (!index || !draggedElement) return;
                        
                        const card = document.querySelector(`.statement-card[data-index="${index}"]`);
                        if (!card) return;
                        
                        const targetCategory = zone.dataset.category;
                        const cardCategory = card.dataset.category;
                        
                        // Validate if card matches dropzone category
                        if (cardCategory !== targetCategory) {
                            alert(`❌ Mali! Ang pahayag na ito ay kabilang sa kategoryang "${cardCategory.toUpperCase()}". Subukang ilagay sa tamang kahon.`);
                            return;
                        }
                        
                        // If card already placed in correct zone, prevent duplicate
                        if (card.parentNode === zone) return;
                        
                        // Move card to dropzone
                        zone.appendChild(card);
                        card.style.cursor = 'default';
                        card.setAttribute('draggable', 'false');
                        card.classList.add('placed');
                        
                        // Check if all cards are placed correctly
                        checkAllPlaced();
                    });
                });
            }

            function checkAllPlaced() {
                const totalCards = statements.length;
                const sanhiCount = dropSanhi ? dropSanhi.children.length : 0;
                const bungaCount = dropBunga ? dropBunga.children.length : 0;
                const tugonCount = dropTugon ? dropTugon.children.length : 0;
                
                const totalPlaced = sanhiCount + bungaCount + tugonCount;
                
                if (totalPlaced === totalCards) {
                    // Verify each card is in correct zone
                    let allCorrect = true;
                    
                    // Check SANHI zone - should contain ONLY sanhi cards
                    if (dropSanhi) {
                        const sanhiCards = Array.from(dropSanhi.children).filter(child => child.classList && child.classList.contains('statement-card'));
                        const hasWrongCard = sanhiCards.some(card => card.dataset.category !== 'sanhi');
                        if (hasWrongCard || sanhiCards.length !== 1) allCorrect = false;
                    }
                    
                    // Check BUNGA zone
                    if (dropBunga) {
                        const bungaCards = Array.from(dropBunga.children).filter(child => child.classList && child.classList.contains('statement-card'));
                        const hasWrongCard = bungaCards.some(card => card.dataset.category !== 'bunga');
                        if (hasWrongCard || bungaCards.length !== 1) allCorrect = false;
                    }
                    
                    // Check TUGON zone
                    if (dropTugon) {
                        const tugonCards = Array.from(dropTugon.children).filter(child => child.classList && child.classList.contains('statement-card'));
                        const hasWrongCard = tugonCards.some(card => card.dataset.category !== 'tugon');
                        if (hasWrongCard || tugonCards.length !== 1) allCorrect = false;
                    }
                    
                    if (allCorrect) {
                        if (summaryBox) summaryBox.style.display = 'block';
                        if (completionStatus) {
                            completionStatus.innerHTML = '<span class="completion-badge"><i class="fas fa-trophy"></i> Perpekto! Nakumpleto mo ang aktibidad.</span>';
                        }
                        gameActive = false; // optional: lock further moves
                    } else {
                        if (summaryBox) summaryBox.style.display = 'none';
                        if (completionStatus) {
                            completionStatus.innerHTML = '<span style="color: #b02e2e;"><i class="fas fa-exclamation-triangle"></i> May mali pang pagkakalagay. Subukang ayusin ang mga pahayag.</span>';
                        }
                    }
                } else {
                    if (summaryBox) summaryBox.style.display = 'none';
                    if (completionStatus) {
                        completionStatus.innerHTML = `<span style="color: #0d6efd;"><i class="fas fa-hourglass-half"></i> ${totalPlaced} ng ${totalCards} ang nailagay. I-drag ang lahat ng pahayag sa tamang kategorya.</span>`;
                    }
                }
            }

            // Reset game function
            function resetGame() {
                // Clear all dropzones
                if (dropSanhi) dropSanhi.innerHTML = '<div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang SANHI dito</div>';
                if (dropBunga) dropBunga.innerHTML = '<div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang BUNGA dito</div>';
                if (dropTugon) dropTugon.innerHTML = '<div class="dropzone-header"><i class="fas fa-arrow-down"></i> Ilagay ang MGA TUGON dito</div>';
                
                // Re-render cards in draggable pool
                renderCards();
                
                // Hide summary box and reset status
                if (summaryBox) summaryBox.style.display = 'none';
                if (completionStatus) completionStatus.innerHTML = '';
                
                gameActive = true;
                
                // Re-attach drag events to new cards (renderCards already adds them)
                // Reset any other states
                draggedElement = null;
            }
            
            // Reset button event
            if (resetBtn) {
                resetBtn.addEventListener('click', resetGame);
            }

            // Prevent default dragover on document
            document.addEventListener('dragover', (e) => e.preventDefault());
            document.addEventListener('drop', (e) => e.preventDefault());

            // Initialize game
            renderCards();
            setupDropZones();
            
            // Additional drag prevention for cards not yet unlocked style
            document.addEventListener('dragstart', (e) => {
                if (!e.target.closest('.statement-card')) {
                    e.preventDefault();
                }
            });
        })();
    </script>
@endsection