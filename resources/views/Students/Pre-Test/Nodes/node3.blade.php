@extends('Students.studentslayout')
@section('title', 'Module 2 : Node 3')

@push('styles')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800;900&family=Baloo+2:wght@700;800&display=swap');

    * { box-sizing: border-box; }

    .background-map {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        z-index: -1;
        opacity: 0.3;
    }

    html, body{
        scroll-behavior:smooth;
        background:
            radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
            radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
            radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
            linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
    }

    body{
        overflow-x:hidden;
        color:var(--text);
        font-family:'Poppins', sans-serif;
    }

    .page {
        max-width: 1100px;
        margin: auto;
    }

    .hero {
        background: rgba(255,255,255,0.75);
        border: 2px solid #d9e9dc;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 10px 24px rgba(50,90,50,0.12);
    }

    .title {
        font-family: "Baloo 2", cursive;
        color: #214f33;
        font-size: 2rem;
        text-align: center;
        margin-top: -5px;
    }

    .desc {
        text-align: center;
        color: #43624d;
        margin-top: 10px;
        line-height: 1.6;
    }

    .info-cards {
        margin-top: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .info-card {
        background: #ffffff;
        border-left: 6px solid #4caf50;
        border-radius: 12px;
        padding: 14px 16px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        transition: 0.2s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
    }

    .card-title {
        font-weight: 900;
        color: #2e7d32;
        margin-bottom: 6px;
    }

    .local-grid {
        margin-top: 20px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .source-card {
        background:#fff;
        border:1px solid #deeadf;
        border-radius:12px;
        padding:10px;
        display: flex;
        flex-direction: column;
    }

    .source-title {
        font-weight:800;
        color:#2e5e3d;
        margin-bottom: 8px;
    }

    .source-preview {
        background: linear-gradient(135deg, #f8fff6 0%, #eef5ea 100%);
        border-radius: 10px;
        padding: 16px 12px;
        text-align: center;
        margin-bottom: 12px;
        border: 1px solid #c8e0c1;
        min-height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .preview-icon {
        font-size: 2.2rem;
    }

    .preview-text {
        font-size: 0.8rem;
        color: #4a6e54;
        font-weight: 600;
        line-height: 1.4;
    }

    .source-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: linear-gradient(180deg, #4caf50, #2e7d32);
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 0.8rem;
        color: white;
        font-weight: 800;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-top: auto;
    }

    .source-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        background: linear-gradient(180deg, #5cbf60, #3e9142);
    }

    .start-wrap {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .start-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 900;
        font-size: 1.1rem;
        background: linear-gradient(180deg,#88d777,#5eae4e);
        border: 2px solid #4a8f3d;
        box-shadow: 0 4px 0 #3f7f36;
        text-decoration: none;
        color: #10311f;
        transition: transform 0.1s ease;
    }

    .start-btn:hover {
        transform: translateY(-1px);
        filter: brightness(1.02);
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

    /* ===== MODAL STYLES ===== */
    .source-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(9, 21, 14, 0.85);
        z-index: 2500;
        padding: 16px;
    }

    .source-modal.show {
        display: flex;
    }

    .source-modal-card {
        width: min(940px, 100%);
        max-width: 100%;
        background: #fff;
        border-radius: 14px;
        border: none;
        padding: 10px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .source-modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        flex-shrink: 0;
    }

    .source-modal-title {
        font-weight: 900;
        font-size: 0.95rem;
        color: #285438;
    }

    .source-modal-close {
        border: none;
        background: #e9f3eb;
        border-radius: 7px;
        padding: 5px 10px;
        font-weight: 800;
        cursor: pointer;
        color: #285438;
        font-size: 1rem;
    }

    .source-modal-frame-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 400px;
        max-height: 65vh;
        background: #f0f2f5;
        border-radius: 0;
        padding: 0;
        overflow: auto;
        flex: 1;
        border: none;
    }

    .source-modal-frame-container iframe {
        max-width: 552px;
        width: 100%;
        border: none;
        border-radius: 0;
        box-shadow: none;
        min-height: 800px;
        height: 800px;
        display: block;
        margin: 0 auto;
        padding: 0;
        background: #f0f2f5;
        flex-shrink: 0;
    }

    .source-modal-tip {
        font-size: 0.76rem;
        color: #4a6b52;
        margin-top: 6px;
        text-align: center;
        flex-shrink: 0;
        padding: 4px 0;
    }

    /* Hide iframe border */
    iframe {
        border: none !important;
        outline: none !important;
    }

    /* Custom scrollbar */
    .source-modal-frame-container::-webkit-scrollbar {
        width: 8px;
    }

    .source-modal-frame-container::-webkit-scrollbar-track {
        background: #e0e0e0;
        border-radius: 4px;
    }

    .source-modal-frame-container::-webkit-scrollbar-thumb {
        background: #4caf50;
        border-radius: 4px;
    }

    .source-modal-frame-container::-webkit-scrollbar-thumb:hover {
        background: #2e7d32;
    }

    /* ===== ARTICLE MODAL (ABS-CBN) ===== */
    .article-modal .source-modal-frame-container iframe {
        max-width: 100%;
        height: 800px;
        min-height: 800px;
        background: white;
    }

    .article-modal .source-modal-frame-container {
        background: white;
    }

    /* ===== CONFIRMATION MODAL ===== */
    .confirm-modal .source-modal-card {
        max-width: 480px;
        text-align: center;
    }

    .confirm-modal .confirm-content {
        padding: 10px 0 20px;
    }

    .confirm-modal .confirm-content p {
        font-size: 1rem;
        color: #2a4a35;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .confirm-modal .confirm-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .confirm-modal .confirm-actions .btn {
        padding: 10px 28px;
        border-radius: 10px;
        border: none;
        font-weight: 800;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .confirm-modal .confirm-actions .btn-yes {
        background: linear-gradient(180deg, #4caf50, #2e7d32);
        color: white;
    }

    .confirm-modal .confirm-actions .btn-yes:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .confirm-modal .confirm-actions .btn-no {
        background: #e9f3eb;
        color: #285438;
        border: 1px solid #c8e0c1;
    }

    .confirm-modal .confirm-actions .btn-no:hover {
        background: #d5e8d0;
        transform: translateY(-2px);
    }

    .btn-icon {
        margin-right: 6px;
    }

    @media (max-width: 860px) {
        .local-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .source-modal-frame-container iframe {
            min-height: 600px;
            height: 600px;
        }
    }

    @media (max-width: 600px) {
        .source-modal-frame-container iframe {
            min-height: 500px;
            height: 500px;
            max-width: 100%;
        }
        
        .source-modal-frame-container {
            max-height: 55vh;
            min-height: 300px;
        }
        
        .source-modal-card {
            padding: 8px;
        }
        
        .confirm-modal .confirm-actions .btn {
            padding: 8px 20px;
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')

<img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="page">
    <section class="hero">

        <h1 class="title">🌡️ NODE 3: CLIMATE CHANGE</h1>

        <div class="info-cards">
            <div class="info-card">
                <div class="card-title">Gabay na Tanong</div>
                <p>
                    Paano nakakaapekto ang climate change sa nararanasang matinding init at mas malalakas na bagyo, 
                    at ano ang maaari mong gawin upang makatulong sa pagharap at pag-iwas sa mga epekto nito?
                </p>
            </div>

            <div class="info-card">
                <div class="card-title">📘 Alamin natin</div>
                <p>
                    Ang climate change o pagbabago ng klima ay ang pagbabago sa temperatura at klima ng mundo 
                    na nagdudulot ng mas malalakas na bagyo at matinding init.
                </p>
            </div>
        </div>

        <!-- Three source cards -->
        <div class="local-grid">
            <!-- Card 1: ABS-CBN News Article -->
            <div class="source-card">
                <div class="source-title">📰 Balita mula sa ABS-CBN News</div>
                <div class="source-preview">
                    <div class="preview-icon">📰</div>
                    <div class="preview-text">"Mas masahol po ito sa Reming" – Panawagan ng Tabaco City para sa pagkain at materyales matapos ang sunod-sunod na bagyo.</div>
                </div>
                <button class="source-link source-open-article" type="button"
                        data-title="ABS-CBN News: Tabaco City Typhoon Victims"
                        data-url="https://www.abs-cbn.com/news/11/05/20/mas-masahol-po-ito-sa-reming-typhoon-battered-tabaco-city-seeks-food-housing-materials">
                    <span class="btn-icon">📖</span> Basahin ang Balita
                </button>
            </div>

            <!-- Card 2: GMA 24 Oras YouTube Video -->
            <div class="source-card">
                <div class="source-title">🎥 Ulat mula sa GMA 24 Oras</div>
                <div class="source-preview">
                    <div class="preview-icon">📺</div>
                    <div class="preview-text">"Mga taga-Tabaco City na labis sinalanta ng bagyo, hindi pa rin alam kung paano babangon" – video ulat.</div>
                </div>
                <button class="source-link source-open" type="button" 
                        data-title="GMA 24 Oras: Tabaco City Typhoon Victims" 
                        data-embed="https://www.youtube.com/embed/mtf1JAQ2hq4">
                    <span class="btn-icon">▶️</span> Panoorin ang Ulat
                </button>
            </div>

            <!-- Card 3: Climate Change Overview -->
            <div class="source-card">
                <div class="source-title">🌍 Pag-unawa sa Climate Change</div>
                <div class="source-preview">
                    <div class="preview-icon">🌡️</div>
                    <div class="preview-text">Ang pagtaas ng temperatura at paglakas ng bagyo ay direktang epekto ng pagbabago ng klima.</div>
                </div>
                <button class="source-link source-open" type="button" 
                        data-title="Climate Change: Ang Kailangan Mong Malaman" 
                        data-embed="https://www.youtube.com/embed/G4H1N_yXBiA">
                    <span class="btn-icon">🌍</span> Matuto Pa
                </button>
            </div>
        </div>

        <!-- "Simulan ang Activity" Button -->
        <div class="start-wrap">
            <a class="start-btn" href="{{ route('node3.activity') }}">
                Simulan ang Gawain🚀
            </a>
        </div>

    </section>
</div>

<!-- Modal for viewing YouTube sources -->
<div class="source-modal" id="sourceModal" aria-hidden="true">
    <div class="source-modal-card">
        <div class="source-modal-head">
            <div class="source-modal-title" id="sourceModalTitle">Source Viewer</div>
            <button type="button" class="source-modal-close" id="sourceModalClose">✕</button>
        </div>
        <div class="source-modal-frame-container" id="sourceModalFrameContainer">
            <iframe id="sourceModalFrame" src="about:blank" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" title="Source Viewer"></iframe>
        </div>
        <div class="source-modal-tip">💡 Maaaring i-scroll ang video para makita ang buong nilalaman.</div>
    </div>
</div>

<!-- Modal for ABS-CBN Article -->
<div class="source-modal article-modal" id="articleModal" aria-hidden="true">
    <div class="source-modal-card">
        <div class="source-modal-head">
            <div class="source-modal-title" id="articleModalTitle">ABS-CBN News Article</div>
            <button type="button" class="source-modal-close" id="articleModalClose">✕</button>
        </div>
        <div class="source-modal-frame-container" id="articleModalFrameContainer">
            <iframe id="articleModalFrame" src="about:blank" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" title="Article Viewer"></iframe>
        </div>
        <div class="source-modal-tip">💡 Maaaring i-scroll ang artikulo para makita ang buong nilalaman.</div>
    </div>
</div>

<!-- Confirmation Modal for Desktop -->
<div class="source-modal confirm-modal" id="confirmModal" aria-hidden="true">
    <div class="source-modal-card">
        <div class="source-modal-head">
            <div class="source-modal-title">🔗 Lumabas ng System</div>
            <button type="button" class="source-modal-close" id="confirmModalClose">✕</button>
        </div>
        <div class="confirm-content">
            <p>Dadalhin ka sa labas ng system upang basahin ang buong artikulo sa ABS-CBN News.<br><br>
            <strong>Gusto mo bang magpatuloy?</strong></p>
            <div class="confirm-actions">
                <button type="button" class="btn btn-yes" id="confirmYesBtn">✅ Oo, magpatuloy</button>
                <button type="button" class="btn btn-no" id="confirmNoBtn">❌ Hindi, manatili</button>
            </div>
        </div>
    </div>
</div>

<script>
    // === YouTube Modal ===
    const sourceOpenBtns = Array.from(document.querySelectorAll('.source-open'));
    const sourceModal = document.getElementById('sourceModal');
    const sourceModalFrame = document.getElementById('sourceModalFrame');
    const sourceModalTitle = document.getElementById('sourceModalTitle');
    const sourceModalClose = document.getElementById('sourceModalClose');
    const sourceModalFrameContainer = document.getElementById('sourceModalFrameContainer');

    function openSourceModal(title, embedUrl) {
        sourceModalTitle.textContent = title;
        
        const frame = sourceModalFrame;
        
        // Set iframe to be tall enough to show full content
        frame.style.width = '100%';
        frame.style.maxWidth = '100%';
        frame.style.height = '800px';
        frame.style.minHeight = '800px';
        frame.style.border = 'none';
        frame.style.borderRadius = '0';
        frame.style.display = 'block';
        frame.style.margin = '0 auto';
        frame.style.padding = '0';
        frame.style.background = '#f0f2f5';
        frame.style.boxShadow = 'none';
        frame.style.outline = 'none';
        frame.style.flexShrink = '0';
        
        // Container
        sourceModalFrameContainer.style.width = '100%';
        sourceModalFrameContainer.style.height = '100%';
        sourceModalFrameContainer.style.minHeight = '400px';
        sourceModalFrameContainer.style.maxHeight = '65vh';
        sourceModalFrameContainer.style.display = 'flex';
        sourceModalFrameContainer.style.justifyContent = 'center';
        sourceModalFrameContainer.style.alignItems = 'flex-start';
        sourceModalFrameContainer.style.background = '#f0f2f5';
        sourceModalFrameContainer.style.borderRadius = '0';
        sourceModalFrameContainer.style.padding = '0';
        sourceModalFrameContainer.style.overflow = 'auto';
        sourceModalFrameContainer.style.flex = '1';
        sourceModalFrameContainer.style.border = 'none';
        
        frame.src = embedUrl;
        
        sourceModal.classList.add('show');
        sourceModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        
        // Reset scroll position to top
        sourceModalFrameContainer.scrollTop = 0;
    }

    function closeSourceModal() {
        sourceModal.classList.remove('show');
        sourceModal.setAttribute('aria-hidden', 'true');
        sourceModalFrame.src = 'about:blank';
        document.body.style.overflow = '';
    }

    sourceOpenBtns.forEach(button => {
        button.addEventListener('click', () => {
            openSourceModal(button.dataset.title || 'Source Viewer', button.dataset.embed || 'about:blank');
        });
    });

    sourceModalClose.addEventListener('click', closeSourceModal);
    sourceModal.addEventListener('click', (event) => {
        if (event.target === sourceModal) {
            closeSourceModal();
        }
    });

    // === Article Modal (ABS-CBN) ===
    const articleOpenBtns = Array.from(document.querySelectorAll('.source-open-article'));
    const articleModal = document.getElementById('articleModal');
    const articleModalFrame = document.getElementById('articleModalFrame');
    const articleModalTitle = document.getElementById('articleModalTitle');
    const articleModalClose = document.getElementById('articleModalClose');
    const articleModalFrameContainer = document.getElementById('articleModalFrameContainer');

    // Confirmation modal elements
    const confirmModal = document.getElementById('confirmModal');
    const confirmModalClose = document.getElementById('confirmModalClose');
    const confirmYesBtn = document.getElementById('confirmYesBtn');
    const confirmNoBtn = document.getElementById('confirmNoBtn');
    let pendingUrl = '';
    let pendingTitle = '';

    function isMobile() {
        return window.innerWidth <= 860;
    }

    function openArticleModal(title, url) {
        articleModalTitle.textContent = title;
        
        const frame = articleModalFrame;
        
        frame.style.width = '100%';
        frame.style.height = '800px';
        frame.style.minHeight = '800px';
        frame.style.border = 'none';
        frame.style.borderRadius = '0';
        frame.style.display = 'block';
        frame.style.margin = '0 auto';
        frame.style.padding = '0';
        frame.style.background = 'white';
        frame.style.boxShadow = 'none';
        frame.style.outline = 'none';
        frame.style.flexShrink = '0';
        frame.style.maxWidth = '100%';
        
        articleModalFrameContainer.style.width = '100%';
        articleModalFrameContainer.style.height = '100%';
        articleModalFrameContainer.style.minHeight = '400px';
        articleModalFrameContainer.style.maxHeight = '65vh';
        articleModalFrameContainer.style.display = 'flex';
        articleModalFrameContainer.style.justifyContent = 'center';
        articleModalFrameContainer.style.alignItems = 'flex-start';
        articleModalFrameContainer.style.background = 'white';
        articleModalFrameContainer.style.borderRadius = '0';
        articleModalFrameContainer.style.padding = '0';
        articleModalFrameContainer.style.overflow = 'auto';
        articleModalFrameContainer.style.flex = '1';
        articleModalFrameContainer.style.border = 'none';
        
        frame.src = url;
        
        articleModal.classList.add('show');
        articleModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        
        articleModalFrameContainer.scrollTop = 0;
    }

    function closeArticleModal() {
        articleModal.classList.remove('show');
        articleModal.setAttribute('aria-hidden', 'true');
        articleModalFrame.src = 'about:blank';
        document.body.style.overflow = '';
    }

    function openConfirmModal(title, url) {
        pendingTitle = title;
        pendingUrl = url;
        confirmModal.classList.add('show');
        confirmModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirmModal() {
        confirmModal.classList.remove('show');
        confirmModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        pendingUrl = '';
        pendingTitle = '';
    }

    function proceedToArticle() {
        if (pendingUrl) {
            window.open(pendingUrl, '_blank');
            closeConfirmModal();
        }
    }

    articleOpenBtns.forEach(button => {
        button.addEventListener('click', () => {
            const url = button.dataset.url || 'about:blank';
            const title = button.dataset.title || 'ABS-CBN News Article';
            
            // Check if desktop (width > 860px)
            if (!isMobile()) {
                // Desktop: Show confirmation modal first
                openConfirmModal(title, url);
            } else {
                // Mobile: Open in modal directly
                openArticleModal(title, url);
            }
        });
    });

    // Confirmation modal events
    confirmYesBtn.addEventListener('click', proceedToArticle);
    confirmNoBtn.addEventListener('click', closeConfirmModal);
    confirmModalClose.addEventListener('click', closeConfirmModal);
    confirmModal.addEventListener('click', (event) => {
        if (event.target === confirmModal) {
            closeConfirmModal();
        }
    });

    articleModalClose.addEventListener('click', closeArticleModal);
    articleModal.addEventListener('click', (event) => {
        if (event.target === articleModal) {
            closeArticleModal();
        }
    });

    // === Global Escape key ===
    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (sourceModal.classList.contains('show')) {
                closeSourceModal();
            }
            if (articleModal.classList.contains('show')) {
                closeArticleModal();
            }
            if (confirmModal.classList.contains('show')) {
                closeConfirmModal();
            }
        }
    });

    // === Handle window resize ===
    window.addEventListener('resize', () => {
        // If on desktop and article modal is open, close it
        if (!isMobile() && articleModal.classList.contains('show')) {
            closeArticleModal();
        }
        // If on mobile and confirm modal is open, close it
        if (isMobile() && confirmModal.classList.contains('show')) {
            closeConfirmModal();
        }
    });
</script>

@endsection