@extends('Students.studentslayout')
@section('title', 'Module 3 - Node 1')

@section('content')

<style>
body {
	background: linear-gradient(135deg, #eef5ff, #f8fbff);
	font-family: 'Poppins', sans-serif;
}

/* BACK BUTTON */
.back-button {
	position: fixed;
	top: 90px;
	left: 20px;
	background: white;
	padding: 10px 16px;
	border-radius: 10px;
	text-decoration: none;
	font-weight: 600;
	box-shadow: 0 4px 10px rgba(0,0,0,0.15);
	z-index: 100;
}

/* MAIN CARD */
.main-wrapper {
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	padding: 20px;
}

.game-card {
	background: white;
	padding: 30px;
	border-radius: 24px;
	width: 100%;
	max-width: 900px;
	box-shadow: 0 15px 40px rgba(0,0,0,0.15);
	text-align: center;
}

/* HEADER */
.game-header h1 {
	margin: 0;
	font-size: 2rem;
	color: #2c3e50;
}

.game-header p {
	color: #666;
	margin-top: 8px;
}

/* TIMER */
.timer {
	font-size: 20px;
	font-weight: bold;
	color: #e74c3c;
	margin-top: 15px;
}

.warning {
	color: #e74c3c;
	font-weight: bold;
	display: none;
	margin-top: 5px;
}

/* QUESTION */
.question-label {
	font-size: 1.5rem;
	font-weight: 700;
	margin: 20px 0;
	color: #34495e;
}

/* DROP ZONE */
.drop-zone {
	border: 3px dashed #cbd5e1;
	padding: 30px;
	margin: 20px auto;
	width: 300px;
	min-height: 130px;
	border-radius: 16px;
	background: #f9fbff;
	transition: all 0.3s ease;
}

.drop-zone.correct {
	border-color: #2ecc71;
	background: #ecfff3;
}

.drop-zone.wrong {
	border-color: #e74c3c;
	background: #fff2f2;
}

/* DRAG ITEMS */
.drag-container {
	display: flex;
	justify-content: center;
	gap: 15px;
	margin-top: 20px;
	flex-wrap: wrap;
}

.draggable {
	width: 120px;
	cursor: grab;
	border-radius: 14px;
	border: 2px solid #e2e8f0;
	background: white;
	padding: 6px;
	box-shadow: 0 5px 10px rgba(0,0,0,0.08);
	transition: transform 0.2s ease;
}

.draggable:hover {
	transform: scale(1.08);
}

/* RESULT */
.result {
	font-size: 1.2rem;
	margin-top: 20px;
}

/* BUTTONS */
.result a {
	display: inline-block;
	margin: 10px;
	padding: 10px 16px;
	border-radius: 10px;
	text-decoration: none;
	font-weight: 600;
}

.result a:nth-child(1) {
	background: #e0f2fe;
}

.result a:nth-child(2) {
	background: #f1f5f9;
}

.result a:nth-child(3) {
	background: #6dbf7e;
	color: white;
}

/* HIDDEN */
.hidden { display: none; }

</style>

<a href="{{ route('inner.map3') }}" class="back-button">⬅️ Bumalik</a>

<div class="main-wrapper">

<div class="game-card">

	<div class="game-header">
		<h1>🟩 NODE 1</h1>
		<p>Match the image to the correct concept</p>
	</div>

	<div class="timer">⏱ Time: <span id="time">10</span>s</div>
	<div class="warning" id="warning">⚠️ Time is running out!</div>

	<div class="question-label" id="questionLabel"></div>

	<div class="drop-zone" id="dropZone">
		I-drop dito ang tamang sagot
	</div>

	<div class="drag-container" id="dragContainer"></div>

	<div class="result" id="result"></div>

</div>

</div>

<script>
const items = [
	{ label: "Hazard", correct: "hazard.png" },
	{ label: "Risk", correct: "risk.png" },
	{ label: "Disaster", correct: "disaster.png" },
	{ label: "Resilience", correct: "resilience.png" }
];

const imagePath = "{{ asset('pictures/Module 3/Node 1') }}/";

let currentIndex = 0;
let timeLeft = 10;
let timer;
let score = 0;

const timeDisplay = document.getElementById('time');
const warning = document.getElementById('warning');
const questionLabel = document.getElementById('questionLabel');
const dropZone = document.getElementById('dropZone');
const dragContainer = document.getElementById('dragContainer');
const result = document.getElementById('result');

function startTimer() {
	timeLeft = 10;
	timeDisplay.textContent = timeLeft;
	warning.style.display = 'none';

	timer = setInterval(() => {
		timeLeft--;
		timeDisplay.textContent = timeLeft;

		if (timeLeft <= 3) warning.style.display = 'block';

		if (timeLeft <= 0) {
			clearInterval(timer);
			nextItem();
		}
	}, 1000);
}

function loadQuestion() {
	if (currentIndex >= items.length) {
		showResult();
		return;
	}

	const item = items[currentIndex];
	questionLabel.textContent = item.label;

	loadImages();
	startTimer();
}

function loadImages() {
	dragContainer.innerHTML = "";

	let allImages = ["hazard.png", "risk.png", "disaster.png", "resilience.png"];
	allImages.sort(() => Math.random() - 0.5);

	allImages.forEach(img => {
		const el = document.createElement("img");
		el.src = imagePath + img;
		el.className = "draggable";
		el.draggable = true;
		el.dataset.value = img;

		el.addEventListener("dragstart", dragStart);
		dragContainer.appendChild(el);
	});
}

function dragStart(e) {
	e.dataTransfer.setData("text", e.target.dataset.value);
}

dropZone.addEventListener("dragover", e => e.preventDefault());

dropZone.addEventListener("drop", function(e) {
	e.preventDefault();

	const dragged = e.dataTransfer.getData("text");
	const correct = items[currentIndex].correct;

	clearInterval(timer);

	if (dragged === correct) {
		score++;
		dropZone.classList.add("correct");
	} else {
		dropZone.classList.add("wrong");
	}

	setTimeout(() => {
		dropZone.classList.remove("correct", "wrong");
		nextItem();
	}, 800);
});

function nextItem() {
	currentIndex++;
	loadQuestion();
}

function showResult() {

	sessionStorage.setItem("m3_node1", "true");

	questionLabel.classList.add("hidden");
	dropZone.classList.add("hidden");
	dragContainer.classList.add("hidden");
	document.querySelector(".timer").classList.add("hidden");
	warning.style.display = "none";

	result.innerHTML = `
		🎉 Score: ${score} / ${items.length} <br><br>

		<a href="{{ route('module3.node1') }}">🔁 Ulitin</a>
		<a href="{{ route('inner.map3') }}">⬅️ Map</a>
		<a href="{{ route('module3.node2') }}">Magpatuloy →</a>
	`;
}

loadQuestion();
</script>

@endsection