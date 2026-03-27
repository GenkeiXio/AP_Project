<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Change sa Albay | Interactive Learning with Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Smooth dragging style */
        .dragging {
            opacity: 0.5;
            transform: scale(0.95);
        }
        /* Custom styling to mimic the nature background */
        .game-board {
            background-color: #f4fbd0;
            background-image: radial-gradient(#d4e9a0 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Modal backdrop animation */
        .modal-backdrop {
            transition: opacity 0.3s ease;
        }
        .modal-content {
            transition: transform 0.3s ease, opacity 0.2s ease;
        }
        
        /* Drag and drop styling */
        [draggable=true] {
            user-select: none;
            cursor: grab;
            transition: all 0.1s ease;
        }
        [draggable=true]:active {
            cursor: grabbing;
        }
        
        .drop-zone-hover {
            background-color: rgba(200, 230, 120, 0.4) !important;
            border: 2px dashed #4a7c2c !important;
            transition: all 0.1s;
        }
        
        /* Category zone containers */
        .category-zone {
            transition: all 0.2s ease;
        }
        
        /* Item styling with image support */
        .drag-item {
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border-radius: 12px;
            padding: 8px 16px 8px 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .drag-item:active {
            cursor: grabbing;
        }
        
        .drag-item-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 10px;
            background: #f0f7e8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        
        .drag-item-text {
            font-weight: 600;
            color: #2d3e1f;
            font-size: 0.95rem;
        }
        
        /* Category zone item styling */
        .category-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fef9e6;
            border-radius: 10px;
            padding: 6px 12px;
            margin-bottom: 8px;
            border-left: 4px solid;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .category-item-img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 8px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .category-item-text {
            font-size: 0.9rem;
            font-weight: 500;
            color: #3a2c1a;
        }
        
        /* CENTER TOP VALIDATION MESSAGE - Prominent and immediately visible */
        .validation-toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            z-index: 9999;
            min-width: 320px;
            max-width: 90vw;
            text-align: center;
            padding: 14px 24px;
            border-radius: 60px;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2), 0 8px 10px -6px rgba(0,0,0,0.1);
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            backdrop-filter: blur(8px);
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .validation-toast.show {
            transform: translateX(-50%) translateY(0);
        }
        .validation-toast.error {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            border-left: 6px solid #ffd966;
        }
        .validation-toast.success {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            border-left: 6px solid #fde047;
        }
        .validation-toast.info {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            border-left: 6px solid #93c5fd;
        }
        .toast-icon {
            font-size: 1.5rem;
            animation: gentlePulse 0.5s ease-in-out;
            display: inline-block;
        }
        
        @keyframes gentlePulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.08); }
            100% { transform: scale(1); }
        }
        
        /* Pool container item styling */
        .pool-item {
            transition: transform 0.1s ease;
        }
        .pool-item:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Decorative elements -->
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    <!-- HERO SECTION -->
    <section class="relative py-20 md:py-28 bg-transparent bg-cover bg-center rounded-lg mx-6">
        <div class="absolute inset-0 bg-transparent bg-cover bg-center rounded-lg"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-orange-500 text-4xl md:text-5xl font-extrabold mb-5 leading-tight">Climate Change sa Albay</h2>
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-black">Paano nakaaapekto ang matinding init at malalakas na bagyo sa ating lalawigan? Alamin ang mga sanhi, epekto, at sama-samang solusyon.</p>
            
            <div class="mt-8 flex justify-center gap-4 flex-wrap">
                <button id="openEffectsModalBtn" class="bg-white text-green-800 px-6 py-2 rounded-full font-semibold shadow-md hover:bg-green-100 transition duration-200 cursor-pointer">Ating Alamin →</button>
            </div>

            <div class="mt-12 max-w-4xl mx-auto overflow-hidden rounded-2xl shadow-2xl border-4 border-white/10">
                <div class="relative pb-[56.25%] h-0">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/mtf1JAQ2hq4" 
                        title="Super Typhoon Rolly Albay"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL with Drag & Drop Game (with Images) -->
    <div id="effectsModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop opacity-0 invisible transition-all duration-300">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" id="modalBackdropClose"></div>
        
        <div class="relative w-full max-w-6xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl modal-content scale-95 opacity-0 transition-all duration-300">
            <div class="game-board p-6 md:p-8 rounded-3xl border-8 border-[#c2d88a] relative">
                <button id="closeModalBtn" class="absolute top-3 right-4 bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold shadow-lg hover:bg-red-600 transition z-20 text-xl">✕</button>
                
                <div class="text-center mb-6 relative">
                    <h2 class="inline-block bg-[#f8efc9] text-[#5a4614] border-4 border-[#d5b565] rounded-full px-8 py-2 text-2xl md:text-3xl font-extrabold shadow-md">
                        🌿 Sanhi • Bunga • Solusyon 🌏
                    </h2>
                    <p class="text-sm text-gray-700 mt-2">📌 I-drag ang mga aytem (may larawan) papunta sa tamang kategorya</p>
                </div>

                <!-- 3 Column Grid: Sanhi | Bunga | Solusyon -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="category-zone bg-white/90 border-4 border-[#eed072] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-sanhi" data-category="sanhi" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#fced9a] border-b-4 border-[#d9b846] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-yellow-900">
                            🌋 Sanhi (Cause)
                        </div>
                        <div id="sanhi-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>

                    <div class="category-zone bg-white/90 border-4 border-[#e99742] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-bunga" data-category="bunga" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#fbb963] border-b-4 border-[#d27e26] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-orange-900">
                            🌊 Bunga (Effect)
                        </div>
                        <div id="bunga-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>

                    <div class="category-zone bg-white/90 border-4 border-[#82b866] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-solusyon" data-category="solusyon" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#a8d387] border-b-4 border-[#619543] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-green-900">
                            🌱 Solusyon (Solution)
                        </div>
                        <div id="solusyon-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>
                </div>

                <!-- DRAGGABLE ITEMS POOL with Images -->
                <div class="bg-[#e4ebd3] border-4 border-solid border-[#82b866] rounded-2xl p-5 relative shadow-md" 
                     id="item-pool" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-[#e4ebd3] px-4 font-bold text-green-800 whitespace-nowrap text-sm md:text-base border-2 border-green-600 rounded-full">
                        📦 DRAG & DROP ZONE - May mga larawan ang bawat aytem 📦
                    </div>
                    <div id="items-pool-container" class="flex flex-wrap justify-center gap-3 mt-5">
                        <!-- Draggable items with images will appear here -->
                    </div>
                    <p class="text-center text-xs text-gray-600 mt-3">⬅️ I-drag ang kahit anong aytem (kasama ang imahe) papunta sa tamang kategorya sa itaas ➡️</p>
                </div>

                <div class="flex justify-center mt-6 gap-4">
                    <button id="resetModalItemsBtn" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-6 rounded-full shadow transition text-sm">⟳ I-reset ang Lahat</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ==================== DATA WITH IMAGES ====================
        // Each item now has an image icon (emoji-based visual + some custom image URLs using emoji as fallback, 
        // but we'll use actual image URLs from free icon resources to represent concepts)
        // For a richer experience, we use a mix of FontAwesome-style emojis and embedded data URLs? 
        // Using reliable emoji + background colors to simulate "images". But to truly attach an image, 
        // we will use <img> with inline SVG or emoji as visual representation.
        // To make it realistic and fun, each item gets a custom image-like representation (emoji as image + optional background)
        
        const itemsData = [
            { 
                id: "item1", 
                text: "Pagsusunog ng fossil fuels", 
                correctCategory: "sanhi",
                image: "🏭",      // Emoji as visual image
                imageBg: "#ffedd5",
                altText: "factory pollution icon"
            },
            { 
                id: "item2", 
                text: "Pagbaha", 
                correctCategory: "bunga",
                image: "🌊",
                imageBg: "#d9f0f7",
                altText: "flood water icon"
            },
            { 
                id: "item3", 
                text: "Pagtatanim ng Puno", 
                correctCategory: "solusyon",
                image: "🌱",
                imageBg: "#e0f2e0",
                altText: "tree planting icon"
            },
            { 
                id: "item4", 
                text: "Renewable Energy", 
                correctCategory: "solusyon",
                image: "☀️",
                imageBg: "#fff3cf",
                altText: "solar energy icon"
            },
            { 
                id: "item5", 
                text: "Deforestation", 
                correctCategory: "sanhi",
                image: "🪓",
                imageBg: "#e9e0c7",
                altText: "deforestation icon"
            },
            { 
                id: "item6", 
                text: "Pagguho ng Lupa", 
                correctCategory: "bunga",
                image: "⛰️",
                imageBg: "#e2d9c6",
                altText: "landslide icon"
            }
        ];

        // Track current location
        let itemLocations = {};
        let poolContainer, sanhiContainer, bungaContainer, solusyonContainer;
        
        // ==================== CENTER-TOP VALIDATION ====================
        let activeToast = null;
        let toastTimeout = null;
        
        function showCenterTopValidation(message, type = 'info') {
            if (activeToast) {
                activeToast.classList.remove('show');
                setTimeout(() => {
                    if (activeToast && activeToast.parentNode) activeToast.parentNode.removeChild(activeToast);
                    activeToast = null;
                }, 200);
                if (toastTimeout) clearTimeout(toastTimeout);
            }
            
            const toast = document.createElement('div');
            toast.className = `validation-toast ${type}`;
            let icon = '';
            if (type === 'error') icon = '❌';
            else if (type === 'success') icon = '✅';
            else if (type === 'warning') icon = '⚠️';
            else icon = 'ℹ️';
            
            toast.innerHTML = `<span class="toast-icon">${icon}</span><span>${message}</span>`;
            document.body.appendChild(toast);
            activeToast = toast;
            
            setTimeout(() => toast.classList.add('show'), 10);
            
            toastTimeout = setTimeout(() => {
                if (activeToast) {
                    activeToast.classList.remove('show');
                    setTimeout(() => {
                        if (activeToast && activeToast.parentNode) activeToast.parentNode.removeChild(activeToast);
                        if (activeToast === toast) activeToast = null;
                    }, 300);
                }
                toastTimeout = null;
            }, 3500);
        }
        
        // ==================== CREATE DRAGGABLE ITEM WITH IMAGE ====================
        function createDraggableItem(item) {
            const div = document.createElement('div');
            div.className = "drag-item pool-item cursor-grab shadow-md hover:shadow-lg transition-all";
            div.setAttribute('draggable', 'true');
            div.setAttribute('data-id', item.id);
            div.setAttribute('data-correct', item.correctCategory);
            div.style.background = "white";
            div.style.border = "1px solid #cbd5a0";
            
            // Image/Icon container
            const imgSpan = document.createElement('div');
            imgSpan.className = "drag-item-img";
            imgSpan.style.backgroundColor = item.imageBg || "#f0f7e8";
            imgSpan.style.fontSize = "28px";
            imgSpan.style.display = "flex";
            imgSpan.style.alignItems = "center";
            imgSpan.style.justifyContent = "center";
            imgSpan.textContent = item.image; // Using emoji as image representation
            
            const textSpan = document.createElement('span');
            textSpan.className = "drag-item-text";
            textSpan.textContent = item.text;
            
            div.appendChild(imgSpan);
            div.appendChild(textSpan);
            
            // Drag handlers
            div.addEventListener('dragstart', handleDragStart);
            div.addEventListener('dragend', handleDragEnd);
            
            return div;
        }
        
        // Create item display for category zones (non-draggable visual)
        function createCategoryItemDisplay(item) {
            const wrapper = document.createElement('div');
            wrapper.className = "category-item";
            wrapper.style.borderLeftColor = item.correctCategory === 'sanhi' ? '#e9b741' : (item.correctCategory === 'bunga' ? '#e97a2e' : '#6b9e3f');
            
            const imgDiv = document.createElement('div');
            imgDiv.className = "category-item-img";
            imgDiv.style.backgroundColor = item.imageBg || "#faf3e0";
            imgDiv.style.fontSize = "24px";
            imgDiv.textContent = item.image;
            
            const textSpan = document.createElement('span');
            textSpan.className = "category-item-text";
            textSpan.textContent = item.text;
            
            wrapper.appendChild(imgDiv);
            wrapper.appendChild(textSpan);
            return wrapper;
        }
        
        function initializeLocations() {
            itemsData.forEach(item => {
                itemLocations[item.id] = 'pool';
            });
        }
        
        function renderAllItems() {
            if (poolContainer) poolContainer.innerHTML = '';
            if (sanhiContainer) sanhiContainer.innerHTML = '';
            if (bungaContainer) bungaContainer.innerHTML = '';
            if (solusyonContainer) solusyonContainer.innerHTML = '';
            
            itemsData.forEach(item => {
                const location = itemLocations[item.id];
                
                if (location === 'pool') {
                    const draggableElem = createDraggableItem(item);
                    poolContainer.appendChild(draggableElem);
                } else if (location === 'sanhi') {
                    const displayElem = createCategoryItemDisplay(item);
                    sanhiContainer.appendChild(displayElem);
                } else if (location === 'bunga') {
                    const displayElem = createCategoryItemDisplay(item);
                    bungaContainer.appendChild(displayElem);
                } else if (location === 'solusyon') {
                    const displayElem = createCategoryItemDisplay(item);
                    solusyonContainer.appendChild(displayElem);
                }
            });
        }
        
        // ==================== DRAG & DROP ====================
        let draggedItemId = null;
        
        function handleDragStart(event) {
            const target = event.target.closest('[draggable="true"]');
            if (!target) {
                event.preventDefault();
                return false;
            }
            draggedItemId = target.getAttribute('data-id');
            event.dataTransfer.setData("text/plain", draggedItemId);
            event.dataTransfer.effectAllowed = "move";
            target.classList.add('opacity-50', 'scale-95');
            return true;
        }
        
        function handleDragEnd(event) {
            const target = event.target.closest('[draggable="true"]');
            if (target) {
                target.classList.remove('opacity-50', 'scale-95');
            }
            document.querySelectorAll('.category-zone, #item-pool').forEach(zone => {
                zone.classList.remove('drop-zone-hover');
            });
            draggedItemId = null;
        }
        
        function handleDragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = "move";
            const zone = event.target.closest('.category-zone, #item-pool');
            if (zone && !zone.classList.contains('drop-zone-hover')) {
                document.querySelectorAll('.category-zone, #item-pool').forEach(z => {
                    z.classList.remove('drop-zone-hover');
                });
                zone.classList.add('drop-zone-hover');
            }
        }
        
        function handleDrop(event) {
            event.preventDefault();
            document.querySelectorAll('.category-zone, #item-pool').forEach(zone => {
                zone.classList.remove('drop-zone-hover');
            });
            
            const draggedId = event.dataTransfer.getData("text/plain");
            if (!draggedId || !itemLocations.hasOwnProperty(draggedId)) return;
            
            const dropTarget = event.target.closest('.category-zone, #item-pool');
            if (!dropTarget) return;
            
            let targetZone = null;
            if (dropTarget.id === 'zone-sanhi') targetZone = 'sanhi';
            else if (dropTarget.id === 'zone-bunga') targetZone = 'bunga';
            else if (dropTarget.id === 'zone-solusyon') targetZone = 'solusyon';
            else if (dropTarget.id === 'item-pool') targetZone = 'pool';
            else return;
            
            const currentZone = itemLocations[draggedId];
            if (currentZone === targetZone) return;
            
            const draggedItem = itemsData.find(item => item.id === draggedId);
            if (!draggedItem) return;
            
            // VALIDATION: check category correctness
            if (targetZone === 'sanhi' || targetZone === 'bunga' || targetZone === 'solusyon') {
                if (draggedItem.correctCategory !== targetZone) {
                    const categoryDisplay = getCategoryName(targetZone);
                    const errorMsg = `❌ MALI! Ang "${draggedItem.text}" (${draggedItem.image}) ay HINDI kabilang sa ${categoryDisplay}. Hanapin ang tamang kategorya. ❌`;
                    showCenterTopValidation(errorMsg, 'error');
                    return;
                }
            }
            
            // Valid move
            itemLocations[draggedId] = targetZone;
            renderAllItems();
            
            if (targetZone !== 'pool') {
                const categoryDisplay = getCategoryName(targetZone);
                const successMsg = `✓ TAMA! Ang "${draggedItem.text}" ${draggedItem.image} ay nasa ${categoryDisplay} na. Magaling! ✓`;
                showCenterTopValidation(successMsg, 'success');
            } else {
                const infoMsg = `↺ Ibinalik sa pool ang "${draggedItem.text}" ${draggedItem.image}. Maaari mo itong subukan muli. ↺`;
                showCenterTopValidation(infoMsg, 'info');
            }
        }
        
        function getCategoryName(category) {
            const names = {
                'sanhi': 'SANHI (Cause)',
                'bunga': 'BUNGA (Effect)',
                'solusyon': 'SOLUSYON (Solution)',
                'pool': 'Item Pool'
            };
            return names[category] || category;
        }
        
        function resetAllItems() {
            itemsData.forEach(item => {
                itemLocations[item.id] = 'pool';
            });
            renderAllItems();
            showCenterTopValidation('✓ NA-RESET! Lahat ng aytem (may mga larawan) ay nasa pool na. Magsimula muli! ✓', 'success');
        }
        
        // ==================== MODAL CONTROLS ====================
        const modal = document.getElementById('effectsModal');
        const openBtn = document.getElementById('openEffectsModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const backdropClose = document.getElementById('modalBackdropClose');
        const resetBtn = document.getElementById('resetModalItemsBtn');
        
        function openModal() {
            draggedItemId = null;
            renderAllItems();
            modal.classList.remove('invisible', 'opacity-0');
            const modalContentDiv = modal.querySelector('.modal-content');
            modalContentDiv.classList.remove('scale-95', 'opacity-0');
            modalContentDiv.classList.add('scale-100', 'opacity-100');
            modal.classList.add('opacity-100');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modalContentDiv = modal.querySelector('.modal-content');
            modalContentDiv.classList.remove('scale-100', 'opacity-100');
            modalContentDiv.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('opacity-100');
            modal.classList.add('invisible', 'opacity-0');
            document.body.style.overflow = '';
            if (activeToast) {
                activeToast.classList.remove('show');
                if (toastTimeout) clearTimeout(toastTimeout);
                setTimeout(() => {
                    if (activeToast && activeToast.parentNode) activeToast.parentNode.removeChild(activeToast);
                    activeToast = null;
                }, 200);
            }
        }
        
        function setupContainers() {
            poolContainer = document.getElementById('items-pool-container');
            sanhiContainer = document.getElementById('sanhi-items');
            bungaContainer = document.getElementById('bunga-items');
            solusyonContainer = document.getElementById('solusyon-items');
        }
        
        function init() {
            setupContainers();
            initializeLocations();
            renderAllItems();
            
            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (backdropClose) backdropClose.addEventListener('click', closeModal);
            if (resetBtn) resetBtn.addEventListener('click', resetAllItems);
            
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal && !modal.classList.contains('invisible')) {
                    closeModal();
                }
            });
            
            const modalContentDiv = modal ? modal.querySelector('.modal-content') : null;
            if (modalContentDiv) {
                modalContentDiv.addEventListener('click', (e) => e.stopPropagation());
            }
        }
        
        window.handleDragOver = handleDragOver;
        window.handleDrop = handleDrop;
        
        init();
    </script>
</body>
</html>