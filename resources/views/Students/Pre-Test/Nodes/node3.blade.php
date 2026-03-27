<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Change sa Albay | Interactive Learning</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
        
        /* Item styling */
        .drag-item {
            transition: all 0.2s ease;
        }
        
        .drag-item:active {
            cursor: grabbing;
        }
    </style>
</head>
<body">
    <!-- Decorative elements (preserved) -->
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    <!-- HERO SECTION (Preserved) -->
    <section class="relative py-20 md:py-28 bg-transparent bg-cover bg-center rounded-lg mx-6">
        <div class="absolute inset-0 bg-transparent bg-cover bg-center rounded-lg"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-orange-500 text-4xl md:text-5xl font-extrabold mb-5 leading-tight">Climate Change sa Albay</h2>
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-black">Paano nakaaapekto ang matinding init at malalakas na bagyo sa ating lalawigan? Alamin ang mga sanhi, epekto, at sama-samang solusyon.</p>
            
            <div class="mt-8 flex justify-center gap-4 flex-wrap">
                <!-- Button to open modal -->
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

    <!-- MODAL with Drag & Drop Game -->
    <div id="effectsModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop opacity-0 invisible transition-all duration-300">
        <!-- Modal Backdrop -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" id="modalBackdropClose"></div>
        
        <!-- Modal Container -->
        <div class="relative w-full max-w-6xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl modal-content scale-95 opacity-0 transition-all duration-300">
            <div class="game-board p-6 md:p-8 rounded-3xl border-8 border-[#c2d88a] relative">
                <!-- Close Button -->
                <button id="closeModalBtn" class="absolute top-3 right-4 bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold shadow-lg hover:bg-red-600 transition z-20 text-xl">✕</button>
                
                <!-- Title -->
                <div class="text-center mb-6 relative">
                    <h2 class="inline-block bg-[#f8efc9] text-[#5a4614] border-4 border-[#d5b565] rounded-full px-8 py-2 text-2xl md:text-3xl font-extrabold shadow-md">
                        🌿 Sanhi • Bunga • Solusyon 🌏
                    </h2>
                    <p class="text-sm text-gray-700 mt-2">📌 I-drag ang mga aytem mula sa ibaba papunta sa tamang kategorya</p>
                </div>

                <!-- 3 Column Grid: Sanhi | Bunga | Solusyon -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Sanhi Zone -->
                    <div class="category-zone bg-white/90 border-4 border-[#eed072] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-sanhi" data-category="sanhi" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#fced9a] border-b-4 border-[#d9b846] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-yellow-900">
                            🌋 Sanhi (Cause)
                        </div>
                        <div id="sanhi-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>

                    <!-- Bunga Zone -->
                    <div class="category-zone bg-white/90 border-4 border-[#e99742] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-bunga" data-category="bunga" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#fbb963] border-b-4 border-[#d27e26] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-orange-900">
                            🌊 Bunga (Effect)
                        </div>
                        <div id="bunga-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>

                    <!-- Solusyon Zone -->
                    <div class="category-zone bg-white/90 border-4 border-[#82b866] rounded-2xl p-4 min-h-[320px] flex flex-col shadow-inner transition-all" 
                         id="zone-solusyon" data-category="solusyon" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        <div class="bg-[#a8d387] border-b-4 border-[#619543] w-[110%] -mt-8 py-2 text-center rounded-lg shadow-md mb-4 font-bold text-lg text-green-900">
                            🌱 Solusyon (Solution)
                        </div>
                        <div id="solusyon-items" class="flex flex-col gap-2 min-h-[200px]"></div>
                    </div>
                </div>

                <!-- DRAGGABLE ITEMS POOL (All items start here) -->
                <div class="bg-[#e4ebd3] border-4 border-solid border-[#82b866] rounded-2xl p-5 relative shadow-md" 
                     id="item-pool" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-[#e4ebd3] px-4 font-bold text-green-800 whitespace-nowrap text-sm md:text-base border-2 border-green-600 rounded-full">
                        📦 DRAG & DROP ZONE - Simula dito ang mga aytem 📦
                    </div>
                    <div id="items-pool-container" class="flex flex-wrap justify-center gap-3 mt-5">
                        <!-- All draggable items will be placed here initially -->
                    </div>
                    <p class="text-center text-xs text-gray-600 mt-3">⬅️ I-drag ang kahit anong aytem papunta sa Sanhi, Bunga, o Solusyon sa itaas ➡️</p>
                </div>

                <!-- Reset Button -->
                <div class="flex justify-center mt-6 gap-4">
                    <button id="resetModalItemsBtn" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-6 rounded-full shadow transition text-sm">⟳ I-reset ang Lahat</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ==================== DATA ====================
        // Define all draggable items with their correct category (for validation)
        const itemsData = [
            { id: "item1", text: "🏭 Pagsusunog ng fossil fuels", correctCategory: "sanhi" },
            { id: "item2", text: "🌊 Pagbaha", correctCategory: "bunga" },
            { id: "item3", text: "🌱 Pagtatanim ng Puno", correctCategory: "solusyon" },
            { id: "item4", text: "☀️ Renewable Energy", correctCategory: "solusyon" },
            { id: "item5", text: "🪓 Deforestation", correctCategory: "sanhi" },
            { id: "item6", text: "⛰️ Pagguho ng Lupa", correctCategory: "bunga" }
        ];

        // Track current location of each item: 'pool', 'sanhi', 'bunga', 'solusyon'
        let itemLocations = {};
        
        // Store references to DOM elements
        let poolContainer, sanhiContainer, bungaContainer, solusyonContainer;
        
        // ==================== INITIALIZATION ====================
        function initializeLocations() {
            // All items start in the pool (button area)
            itemsData.forEach(item => {
                itemLocations[item.id] = 'pool';
            });
        }
        
        // Create draggable element
        function createDraggableItem(item) {
            const div = document.createElement('div');
            div.className = "drag-item bg-white border-2 border-gray-400 rounded-lg p-3 cursor-grab shadow-md hover:shadow-lg hover:bg-gray-50 transition-all font-semibold text-center min-w-[140px]";
            div.setAttribute('draggable', 'true');
            div.setAttribute('data-id', item.id);
            div.setAttribute('data-correct', item.correctCategory);
            div.textContent = item.text;
            
            // Drag event handlers
            div.addEventListener('dragstart', handleDragStart);
            div.addEventListener('dragend', handleDragEnd);
            
            return div;
        }
        
        // Render all items based on current locations
        function renderAllItems() {
            // Clear all containers
            if (poolContainer) poolContainer.innerHTML = '';
            if (sanhiContainer) sanhiContainer.innerHTML = '';
            if (bungaContainer) bungaContainer.innerHTML = '';
            if (solusyonContainer) solusyonContainer.innerHTML = '';
            
            // For each item, render it in its current location
            itemsData.forEach(item => {
                const itemElement = createDraggableItem(item);
                const location = itemLocations[item.id];
                
                if (location === 'pool') {
                    poolContainer.appendChild(itemElement);
                } else if (location === 'sanhi') {
                    sanhiContainer.appendChild(itemElement);
                } else if (location === 'bunga') {
                    bungaContainer.appendChild(itemElement);
                } else if (location === 'solusyon') {
                    solusyonContainer.appendChild(itemElement);
                }
            });
        }
        
        // ==================== DRAG & DROP HANDLERS ====================
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
            
            // Add dragging visual effect
            target.classList.add('opacity-50', 'scale-95');
            
            return true;
        }
        
        function handleDragEnd(event) {
            const target = event.target.closest('[draggable="true"]');
            if (target) {
                target.classList.remove('opacity-50', 'scale-95');
            }
            
            // Remove highlight from all drop zones
            document.querySelectorAll('.category-zone, #item-pool').forEach(zone => {
                zone.classList.remove('drop-zone-hover');
            });
            
            draggedItemId = null;
        }
        
        function handleDragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = "move";
            
            // Highlight the drop zone
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
            
            // Remove highlights
            document.querySelectorAll('.category-zone, #item-pool').forEach(zone => {
                zone.classList.remove('drop-zone-hover');
            });
            
            // Get the dragged item ID
            const draggedId = event.dataTransfer.getData("text/plain");
            if (!draggedId || !itemLocations.hasOwnProperty(draggedId)) {
                return;
            }
            
            // Determine drop target zone
            const dropTarget = event.target.closest('.category-zone, #item-pool');
            if (!dropTarget) return;
            
            let targetZone = null;
            if (dropTarget.id === 'zone-sanhi') targetZone = 'sanhi';
            else if (dropTarget.id === 'zone-bunga') targetZone = 'bunga';
            else if (dropTarget.id === 'zone-solusyon') targetZone = 'solusyon';
            else if (dropTarget.id === 'item-pool') targetZone = 'pool';
            else return;
            
            const currentZone = itemLocations[draggedId];
            
            // If dropping to the same zone, do nothing
            if (currentZone === targetZone) return;
            
            // Find the item data
            const draggedItem = itemsData.find(item => item.id === draggedId);
            if (!draggedItem) return;
            
            // If dropping to a category zone (sanhi/bunga/solusyon), validate if it's correct
            if (targetZone === 'sanhi' || targetZone === 'bunga' || targetZone === 'solusyon') {
                // Check if the item belongs to this category
                if (draggedItem.correctCategory !== targetZone) {
                    // Wrong category - show feedback but still allow? Better to show warning and not move
                    showTemporaryMessage(`⚠️ Mali! Ang "${draggedItem.text}" ay hindi kabilang sa ${getCategoryName(targetZone)}. Subukan sa tamang kategorya. ⚠️`, 'error');
                    return;
                }
            }
            
            // Valid move - update location
            itemLocations[draggedId] = targetZone;
            
            // Re-render the UI
            renderAllItems();
            
            // Show success feedback (optional)
            if (targetZone !== 'pool') {
                showTemporaryMessage(`✓ Tamang paglalagay! Ang "${draggedItem.text}" ay nasa ${getCategoryName(targetZone)} na.`, 'success');
            } else {
                showTemporaryMessage(`↺ Ibinalik sa pool ang "${draggedItem.text}"`, 'info');
            }
        }
        
        // Helper function to get category name in Tagalog/English
        function getCategoryName(category) {
            const names = {
                'sanhi': 'SANHI (Cause)',
                'bunga': 'BUNGA (Effect)',
                'solusyon': 'SOLUSYON (Solution)',
                'pool': 'Item Pool'
            };
            return names[category] || category;
        }
        
        // Show temporary floating message
        let messageTimeout = null;
        function showTemporaryMessage(message, type = 'info') {
            // Remove existing message if any
            const existingMsg = document.getElementById('drag-feedback-msg');
            if (existingMsg) existingMsg.remove();
            if (messageTimeout) clearTimeout(messageTimeout);
            
            const msgDiv = document.createElement('div');
            msgDiv.id = 'drag-feedback-msg';
            msgDiv.className = 'fixed bottom-5 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-full shadow-lg text-white font-bold text-sm md:text-base animate-bounce';
            
            if (type === 'error') {
                msgDiv.className += ' bg-red-600';
            } else if (type === 'success') {
                msgDiv.className += ' bg-green-600';
            } else {
                msgDiv.className += ' bg-blue-600';
            }
            
            msgDiv.textContent = message;
            document.body.appendChild(msgDiv);
            
            messageTimeout = setTimeout(() => {
                if (msgDiv) msgDiv.remove();
            }, 2500);
        }
        
        // ==================== RESET FUNCTION ====================
        function resetAllItems() {
            // Reset all locations to pool
            itemsData.forEach(item => {
                itemLocations[item.id] = 'pool';
            });
            
            // Re-render everything
            renderAllItems();
            
            // Show feedback
            showTemporaryMessage('✓ Na-reset ang lahat ng aytem. Lahat ay nasa pool na ulit!', 'success');
        }
        
        // ==================== MODAL CONTROLS ====================
        const modal = document.getElementById('effectsModal');
        const openBtn = document.getElementById('openEffectsModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const backdropClose = document.getElementById('modalBackdropClose');
        const resetBtn = document.getElementById('resetModalItemsBtn');
        
        function openModal() {
            // Reset any ongoing drag state
            draggedItemId = null;
            
            // Make sure all items are in their correct locations (as per current state)
            renderAllItems();
            
            // Show modal with animations
            modal.classList.remove('invisible', 'opacity-0');
            const modalContentDiv = modal.querySelector('.modal-content');
            modalContentDiv.classList.remove('scale-95', 'opacity-0');
            modalContentDiv.classList.add('scale-100', 'opacity-100');
            modal.classList.add('opacity-100');
            
            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modalContentDiv = modal.querySelector('.modal-content');
            modalContentDiv.classList.remove('scale-100', 'opacity-100');
            modalContentDiv.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('opacity-100');
            modal.classList.add('invisible', 'opacity-0');
            document.body.style.overflow = '';
        }
        
        // ==================== SETUP DOM REFERENCES ====================
        function setupContainers() {
            poolContainer = document.getElementById('items-pool-container');
            sanhiContainer = document.getElementById('sanhi-items');
            bungaContainer = document.getElementById('bunga-items');
            solusyonContainer = document.getElementById('solusyon-items');
        }
        
        // ==================== INITIALIZE ====================
        function init() {
            setupContainers();
            initializeLocations();
            renderAllItems();
            
            // Set up event listeners for modal
            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (backdropClose) backdropClose.addEventListener('click', closeModal);
            if (resetBtn) resetBtn.addEventListener('click', resetAllItems);
            
            // Close modal on escape key
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal && !modal.classList.contains('invisible')) {
                    closeModal();
                }
            });
            
            // Prevent modal content click from closing
            const modalContentDiv = modal ? modal.querySelector('.modal-content') : null;
            if (modalContentDiv) {
                modalContentDiv.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }
        }
        
        // Make drop handlers globally accessible
        window.handleDragOver = handleDragOver;
        window.handleDrop = handleDrop;
        
        // Start the application
        init();
    </script>
</body>
</html>