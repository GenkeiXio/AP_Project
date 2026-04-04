@extends('Students.studentslayout')
@section('title', 'InnerMap3')

@push('styles')
<style>
body, html {
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	overflow: hidden;
}

.page-content, .container, .main-wrapper {
	max-width: 100% !important;
	padding: 0 !important;
	margin: 0 !important;
}

.map-wrapper {
	position: fixed;
	top: 0;
	left: 0;
	width: 100vw;
	height: 100vh;
}

.map-container {
	position: relative;
	width: 100%;
	height: 100%;
	transition: transform 0.7s ease;
	transform-origin: center center;
}

.background-map {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

.module-entry {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	z-index: 5;
	border: 0;
	border-radius: 16px;
	padding: 14px 20px;
	font-weight: 900;
	font-size: 1rem;
	cursor: pointer;
	background: rgba(255, 255, 255, 0.92);
	box-shadow: 0 8px 18px rgba(0,0,0,0.25);
}

.module-entry.active {
	animation: pinSelect 0.6s ease;
}

@keyframes pinSelect {
	0% { transform: translate(-50%, -50%) scale(1); }
	50% { transform: translate(-50%, -50%) scale(1.12); }
	100% { transform: translate(-50%, -50%) scale(1.06); }
}

.screen-fade {
	animation: fadeToBlack 0.6s forwards;
}

@keyframes fadeToBlack {
	to {
		opacity: 0;
		transform: scale(1.05);
	}
}

.back-button {
	position: fixed;
	top: 80px;
	left: 20px;
	z-index: 100;
	background: white;
	padding: 10px 15px;
	border-radius: 8px;
	text-decoration: none;
	font-weight: bold;
}
</style>
@endpush

@section('content')
<div class="map-wrapper">
	<div class="map-container">
		<img src="{{ asset('pictures/mod3_innermap.png') }}" class="background-map" alt="Module 3 Inner Map">

		<button class="module-entry" onclick="moduleTransition(this, '{{ route('module3.home') }}')">
			Simulan ang Module 3
		</button>

		<a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>
	</div>
</div>

<script>
function moduleTransition(target, url) {
	const map = document.querySelector('.map-container');
	const rect = map.getBoundingClientRect();
	const targetRect = target.getBoundingClientRect();

	const targetCenterX = targetRect.left + targetRect.width / 2;
	const targetCenterY = targetRect.top + targetRect.height / 2;
	const mapCenterX = rect.left + rect.width / 2;
	const mapCenterY = rect.top + rect.height / 2;

	const offsetX = mapCenterX - targetCenterX;
	const offsetY = mapCenterY - targetCenterY;

	map.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(1.8)`; // ✅ FIXED

	target.classList.add('active');

	setTimeout(() => {
		document.body.classList.add('screen-fade');
	}, 400);

	setTimeout(() => {
		window.location.href = url;
	}, 900);
}
</script>
@endsection