@extends('Students.studentslayout')
@section('title', 'Module 2 : Node 2 - Deforestation')

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
        background: #fff;
        border-radius: 14px;
        border: 2px solid #b8cfb6;
        padding: 10px;
    }

    .source-modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
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
    }

    .source-modal-frame {
        width: 100%;
        height: min(72vh, 600px);
        border: none;
        border-radius: 10px;
    }

    .source-modal-tip {
        font-size: 0.76rem;
        color: #4a6b52;
        margin-top: 6px;
    }

    @media (max-width: 860px) {
        .local-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }
</style>
@endpush

@section('content')

<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="page">
    <section class="hero">

        <h1 class="title">🌳 NODE 2: DEFORESTATION</h1>

        <div class="info-cards">
            <div class="info-card">
                <div class="card-title">Gabay na Tanong</div>
                <p>
                    Paano nakaaapekto ang deforestation (pagkakalbo ng kagubatan) sa kapaligiran at kaligtasan ng mga mamamayan sa Albay,
                    at ano ang maaari mong gawin bilang mag-aaral upang makatulong sa paglutas nito?
                </p>
            </div>

            <div class="info-card">
                <div class="card-title">📘 Alamin natin</div>
                <p>Ang deforestation ay ang patuloy na pagputol ng mga puno nang walang sapat na kapalit.
                Nagdudulot ito ng pagbaha, landslide, pagkasira ng tirahan ng wildlife, at paglala ng climate change.</p>
            </div>
        </div>

        <!-- Three source cards based on the links provided -->
        <div class="local-grid">
            <!-- Card 1: Facebook Reel Video -->
            <div class="source-card">
                <div class="source-title">🎥 Kamakailang Video tungkol sa Deforestation</div>
                <div class="source-preview">
                    <div class="preview-icon">📹</div>
                    <div class="preview-text">Maikling video (reel) na nagpapakita ng epekto ng deforestation sa komunidad.</div>
                </div>
                <button class="source-link source-open" type="button" 
                        data-title="Facebook Reel: Kamakailang Video tungkol sa Deforestation" 
                        data-embed="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/reel/25161448763539025&show_text=false">
                    <span class="btn-icon">🎥</span> Tingnan ang Video
                </button>
            </div>

            <!-- Card 2: Rappler Article -->
            <div class="source-card">
                <div class="source-title">📰 Pahayag mula sa Rappler</div>
                <div class="source-preview">
                    <div class="preview-icon">📄</div>
                    <div class="preview-text">"Declare landslide-hit Albay roads as no-build zones" – ekspertong panawagan matapos ang bagyong Usman.</div>
                </div>
                <button class="source-link" type="button"
                        onclick="window.open('https://www.rappler.com/philippines/220275-expert-says-declare-no-build-zones-landslide-hit-roads-albay/', '_blank')">
                    <span class="btn-icon">📖</span> Basahin ang Artikulo
                </button>
            </div>

            <!-- Card 3: Facebook Photo Post -->
            <div class="source-card">
                <div class="source-title">🖼️ Larawan mula sa Facebook</div>
                <div class="source-preview">
                    <div class="preview-icon">🏞️</div>
                    <div class="preview-text">Dokumentasyon ng sitwasyon kaugnay ng deforestation at pagguho ng lupa sa rehiyon.</div>
                </div>
                <button class="source-link source-open" type="button" 
                        data-title="Facebook Post: Sitwasyon sa Kabundukan" 
                        data-embed="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fphoto.php%3Ffbid%3D4219952541362365%26set%3Da.589691729852777%26type%3D3&show_text=true">
                    <span class="btn-icon">🖼️</span> Tingnan ang Post
                </button>
            </div>
        </div>

        <!-- "Simulan ang Activity" Button at the very bottom -->
        <div class="start-wrap">
            <a class="start-btn" href="{{ route('node2.activity') }}">
                Simulan ang Activity 🚀
            </a>
        </div>

    </section>
</div>

<!-- Modal for viewing sources -->
<div class="source-modal" id="sourceModal" aria-hidden="true">
    <div class="source-modal-card">
        <div class="source-modal-head">
            <div class="source-modal-title" id="sourceModalTitle">Source Viewer</div>
            <button type="button" class="source-modal-close" id="sourceModalClose">Isara ✕</button>
        </div>
        <iframe id="sourceModalFrame" class="source-modal-frame" src="about:blank" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" title="Source Viewer"></iframe>
        <div class="source-modal-tip">Nasa loob lang ng system ang source viewer; walang external redirect.</div>
    </div>
</div>

<script>
    const sourceOpenBtns = Array.from(document.querySelectorAll('.source-open'));
    const sourceModal = document.getElementById('sourceModal');
    const sourceModalFrame = document.getElementById('sourceModalFrame');
    const sourceModalTitle = document.getElementById('sourceModalTitle');
    const sourceModalClose = document.getElementById('sourceModalClose');

    function openSourceModal(title, embedUrl) {
        sourceModalTitle.textContent = title;
        sourceModalFrame.src = embedUrl;
        sourceModal.classList.add('show');
        sourceModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
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

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && sourceModal.classList.contains('show')) {
            closeSourceModal();
        }
    });
</script>

@endsection