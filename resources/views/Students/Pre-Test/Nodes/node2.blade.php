<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Node 2: Deforestation</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<style>
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

body {
    margin: 0;
    font-family: "Nunito", sans-serif;
    background: linear-gradient(180deg, #eff8ff 0%, #f6fff6 45%, #fff8ea 100%);
    padding: 20px;
    background: none !important;
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

.start-wrap {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.start-btn {
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 900;
    background: linear-gradient(180deg,#88d777,#5eae4e);
    border: 2px solid #4a8f3d;
    box-shadow: 0 4px 0 #3f7f36;
    text-decoration: none;
    color: #10311f;
}

.local-grid {
    margin-top: 20px;
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 15px;
}

.source-card {
    background:#fff;
    border:1px solid #deeadf;
    border-radius:12px;
    padding:10px;
}

.source-title {
    font-weight:800;
    color:#2e5e3d;
}

.source-img {
    width:100%;
    border-radius:10px;
    margin-top:8px;
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
</head>

<body>

<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<div class="page">
<section class="hero">

<h1 class="title">🌳 NODE 2: DEFORESTATION</h1>

<p class="desc">
Ang deforestation ay ang patuloy na pagputol ng mga puno nang walang sapat na kapalit.
Nagdudulot ito ng pagbaha, landslide, at pagkasira ng kalikasan.
</p>

<div class="start-wrap">
<a class="start-btn" href="{{ route('node2.activity') }}">
Simulan ang Activity 🚀
</a>
</div>

<div class="local-grid">

<div class="source-card">
<div class="source-title">Landslide sa Albay</div>
<img src="{{ asset('pictures/deforestation1.png') }}" class="source-img">
</div>

<div class="source-card">
<div class="source-title">Illegal Logging</div>
<img src="{{ asset('pictures/deforestation2.png') }}" class="source-img">
</div>

</div>

</section>
</div>

</body>
</html>