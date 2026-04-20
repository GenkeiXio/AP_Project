@extends('Students.studentslayout')
@section('title', 'Module 2 : Node 1')

@push('styles')
	<style>
		* {
			box-sizing: border-box;
		}

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
			margin: 0 auto;
		}

		.hero {
			background: rgba(255, 255, 255, 0.68);
			border: 2px solid #d9e9dc;
			border-radius: 18px;
			padding: 18px;
			box-shadow: 0 10px 24px rgba(50, 90, 50, 0.12);
		}

		.title {
			font-family: "Baloo 2", cursive;
			color: #214f33;
			font-size: clamp(1.4rem, 3vw, 2rem);
			margin: 0 0 8px;
			text-align: center;
			line-height: 1.2;
		}

		.desc {
			font-size: 0.94rem;
			line-height: 1.5;
			margin: 0;
			text-align: center;
			color: #43624d;
		}

		.start-wrap {
			margin-top: 14px;
			display: flex;
			justify-content: center;
		}

		.start-btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			text-decoration: none;
			padding: 11px 18px;
			border-radius: 12px;
			font-weight: 900;
			color: #10311f;
			background: linear-gradient(180deg, #88d777 0%, #5eae4e 100%);
			border: 2px solid #4a8f3d;
			box-shadow: 0 4px 0 #3f7f36;
		}

		.start-btn:hover {
			filter: brightness(1.03);
		}

		.local-grid {
			margin-top: 14px;
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 10px;
		}

		.source-card {
			background: #fff;
			border: 1px solid #deeadf;
			border-radius: 12px;
			padding: 8px;
			min-height: 178px;
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.source-title {
			font-weight: 800;
			color: #2e5e3d;
			font-size: 0.86rem;
			line-height: 1.25;
		}

		.source-embed {
			border: none;
			width: 100%;
			border-radius: 10px;
			min-height: 120px;
			background: #f0f0f0;
		}

		.source-preview {
			background: linear-gradient(135deg, #f8fff6 0%, #eef5ea 100%);
			border-radius: 10px;
			padding: 16px 12px;
			text-align: center;
			margin-bottom: 8px;
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

		.btn-icon {
			margin-right: 6px;
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
		}

		.source-link:hover {
			transform: translateY(-1px);
			box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
			background: linear-gradient(180deg, #5cbf60, #3e9142);
		}

		.source-embed {
			display: none;
		}		

		.source-modal {
			position: fixed;
			inset: 0;
			display: none;
			align-items: center;
			justify-content: center;
			background: rgba(9, 21, 14, 0.75);
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

		@media (max-width: 960px) {
			.local-grid {
				grid-template-columns: 1fr;
			}
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
	</style>
@endpush

@section('content')
	
	<img src="{{ asset('pictures/mod2_innermap.png') }}" class="background-map">

	<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

	<div class="page">
		<section class="hero">
			<h1 class="title">NODE 1: SOLID WASTE </h1>
			<div class="info-cards">

		<div class="info-card">
			<div class="card-title">Gabay na Tanong</div>
			<p>
				Paano nakakaapekto ang hindi wastong pamamahala ng solid waste sa kapaligiran at kalusugan ng mga mamamayan sa Albay,
				at ano ang maaari mong gawin bilang mag-aaral upang makatulong sa paglutas nito?
			</p>
		</div>

		<div class="info-card">
			<div class="card-title">📘 Alamin natin</div>
			<p>
				Ang <strong>SOLID WASTE</strong> ay tumutukoy sa mga basurang nagmula sa tahanan, paaralan, at komersyal na lugar.
				Sa Albay, ang hindi wastong pagtatapon ng basura ay nagdudulot ng <strong>pagbaha</strong> at <strong>polusyon</strong> sa ilog at dagat.
			</p>
		</div>

	</div>

		<div class="local-grid">
			<article class="source-card">
				<div class="source-title">📹 Local Example Video (Facebook Reel)</div>
				<div class="source-preview">
					<div class="preview-icon">🎬</div>
					<div class="preview-text">Panoorin ang video tungkol sa solid waste management sa Albay</div>
				</div>
				<button class="source-link source-open" type="button" data-title="Local Example Video" data-embed="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Freel%2F847766111132161&show_text=true">
					<span class="btn-icon">▶️</span> Panoorin ang Video
				</button>
			</article>

			<article class="source-card">
				<div class="source-title">🌊 Pagbabaha sa Albay lalong tumitindi</div>
				<div class="source-preview">
					<div class="preview-icon">📰</div>
					<div class="preview-text">Balita at impormasyon tungkol sa tumitinding pagbaha sa Albay</div>
				</div>
				<button class="source-link source-open" type="button" data-title="Pagbabaha sa Albay" data-embed="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fphoto%2F%3Ffbid%3D1216101583895678%26set%3Dpcb.1216104043895432&show_text=true">
					<span class="btn-icon">📖</span> Basahin ang Post
				</button>
			</article>

			<article class="source-card">
				<div class="source-title">🗑️ Mga Basura sa may Dike ng Pawa, Legazpi</div>
				<div class="source-preview">
					<div class="preview-icon">⚠️</div>
					<div class="preview-text">Dokumentasyon ng problema sa  basura sa Pawa</div>
				</div>
				<button class="source-link source-open" type="button" data-title="Mga Basura sa may Dike ng Pawa, Legazpi" data-embed="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fphoto.php%3Ffbid%3D939689839020670%26set%3Da.105820365740959%26type%3D3&show_text=true&width=500" width="500" height="773" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
					<span class="btn-icon">📋</span> Tingnan ang Post
				</button>
			</article>
		</div>

		<div class="start-wrap">
			<a class="start-btn" href="{{ route('node1.solid-waste.activity') }}">Simulan ang Activity 🚀</a>
		</div>
		
	<!-- </section> -->
</div>

	<div class="source-modal" id="sourceModal" aria-hidden="true">
		<div class="source-modal-card">
			<div class="source-modal-head">
				<div class="source-modal-title" id="sourceModalTitle">Source Viewer</div>
				<button type="button" class="source-modal-close" id="sourceModalClose">Isara ✕</button>
			</div>
			<iframe id="sourceModalFrame" class="source-modal-frame" src="about:blank" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
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
		}

		function closeSourceModal() {
			sourceModal.classList.remove('show');
			sourceModal.setAttribute('aria-hidden', 'true');
			sourceModalFrame.src = 'about:blank';
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
