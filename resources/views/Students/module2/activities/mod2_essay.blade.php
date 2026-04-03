<!DOCTYPE html>
<html lang="fil">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Module 2 Essay</title>

	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">

	<style>
		body, html {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
			font-family: 'Nunito', sans-serif;
		}

		.map-wrapper {
			position: fixed;
			top: 0;
			left: 0;
			width: 100vw;
			height: 100vh;
		}

		.background-map {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		/* CENTER CARD */
		.essay-container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 90%;
			max-width: 800px;
			z-index: 10;
		}

		.essay-card {
			background: rgba(255,255,255,0.95);
			backdrop-filter: blur(10px);
			border-radius: 24px;
			padding: 24px;
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
			border: 2px solid #e7d7bf;
		}

		.essay-card h2 {
			font-family: "Baloo 2", cursive;
			color: #3d2a1a;
			margin-bottom: 10px;
		}

		.essay-card p {
			font-weight: 700;
			color: #5a4630;
			margin-bottom: 10px;
		}

		.question {
			font-weight: 900;
			color: #3d2a1a;
		}

		textarea {
			width: 100%;
			border-radius: 14px;
			padding: 12px;
			border: 1px solid #d7c4a3;
			margin: 12px 0;
			resize: none;
		}

		.file-upload {
			margin-bottom: 12px;
			font-weight: 700;
		}

		.submission-note {
			font-size: 0.9rem;
			color: #2f6c44;
			font-weight: 800;
			margin-bottom: 12px;
		}

		.btn-primary {
			background: linear-gradient(135deg, #6dbf7e, #4da862);
			color: white;
			border: none;
			padding: 12px 18px;
			border-radius: 12px;
			font-weight: 800;
			cursor: pointer;
			transition: 0.2s;
		}

		.btn-primary:hover {
			transform: scale(1.05);
		}

		.back-button {
			position: fixed;
			top: 20px;
			left: 20px;
			z-index: 100;
			background: white;
			padding: 10px 15px;
			border-radius: 8px;
			text-decoration: none;
			font-weight: bold;
			color: black;
		}

		.success-message {
			margin-top: 12px;
			color: green;
			font-weight: bold;
			text-align: center;
		}
	</style>
</head>

<body>

<div class="map-wrapper">

	<!-- 🌍 BACKGROUND -->
	<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

	<!-- ⬅️ BACK -->
	<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

	<!-- ✨ ESSAY CARD -->
	<div class="essay-container">
		<div class="essay-card">

			<h2>Short Answer Essay</h2>

			<p><strong>Panuto:</strong> Ano ang iyong opinyon? Ilagay ang sagot sa ibaba.</p>

			<p class="question">
				Bilang isang mag-aaral at miyembro ng komunidad, paano ka makatutulong sa pagtugon sa mga suliraning pangkapaligiran tulad ng 
				<strong>solid waste, deforestation, at climate change</strong>? Ipaliwanag ang iyong sagot gamit ang mga konkretong halimbawa.
			</p>

			<p>
				Magbigay ng ebidensya ng iyong gawa (hal. clean-up, pagtatanim) sa pamamagitan ng larawan o video.
			</p>

			<form action="{{ route('essay.submit') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<textarea name="essay_answer" rows="8" placeholder="Isulat ang iyong sagot dito..." required></textarea>

				<div class="file-upload">
					<label>Mag-upload ng larawan o video bilang ebidensya:</label>
					<input type="file" name="evidence" accept="image/*,video/*" required>
				</div>

				<p class="submission-note">
					📩 Ang iyong sagot at kalakip na ebidensya ay <strong>ipapadala diretso sa Gmail ng iyong guro</strong>.
				</p>

				<button type="submit" class="btn-primary">
					Isumite ang Sagot 📤
				</button>
			</form>

			@if(session('success'))
				<div class="success-message">
					{{ session('success') }}
				</div>
			@endif

		</div>
	</div>

</div>

</body>
</html>