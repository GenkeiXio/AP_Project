@extends('Students.studentslayout')
@section('title', 'Module 4 - Alamin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    /* WOOD BACKGROUND - same as Node 1 */
    background: linear-gradient(rgba(10, 8, 7, 0.62), rgba(10, 8, 7, 0.62)),
                url("{{ asset('pictures/mod4_innermap.png') }}") center center / cover no-repeat fixed;
    color: #1a1a1a;
    min-height: 100vh;
    position: relative;
}

/* Main Content Wrapper - same as Node 1 */
.content-wrapper {
    position: relative;
    z-index: 1;
    padding: 25px 15px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.container-box {
    max-width: 1100px;
    width: 100%;
    margin: 0 auto;
    background: #d9c5a3;
    background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
    border-radius: 8px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2);
    padding: 30px 30px 40px;
    border: 2px solid #c5a059;
    position: relative;
}

/* Hide the stray img tag */
.background-map {
    display: none;
}

h2 {
    font-weight: 800;
    font-size: 2rem;
    color: #1a1a1a;
    margin-bottom: 24px;
    font-family: 'Nunito', sans-serif;
    border-bottom: 2px solid #1a1a1a;
    padding-bottom: 10px;
    display: block;
    width: 100%;
    text-align: left;
    background: none;
    backdrop-filter: none;
    border-radius: 0;
    padding: 12px 0;
}

h2 i {
    color: #b71c1c;
    margin-right: 12px;
}

.page-banner {
    background: #f4e4c7;
    background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
    border-radius: 5px;
    padding: 20px 25px;
    margin-bottom: 30px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.3);
}

.page-banner .brief .eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #b71c1c;
    background: rgba(0,0,0,0.05);
    padding: 4px 10px;
    border-radius: 3px;
    margin-bottom: 10px;
    font-family: 'Nunito', sans-serif;
}

.page-banner .brief p {
    margin: 0;
    color: #1a1a1a;
    line-height: 1.6;
    font-weight: 500;
}

.progress-wrap {
    margin-bottom: 28px;
    padding: 16px 20px;
    background: rgba(244, 228, 199, 0.95);
    background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
    border-radius: 5px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.3);
}

.progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-weight: 700;
    color: #1a1a1a;
    font-family: 'Nunito', sans-serif;
}

.progress {
    height: 14px;
    border-radius: 10px;
    background: #d9c5a3;
    box-shadow: inset 0 1px 4px rgba(0,0,0,0.2);
}

.progress-bar {
    background: linear-gradient(90deg, #c5a059, #d4b87a);
    border-radius: 10px;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 24px;
}

.card-btn {
    position: relative;
    padding: 20px 12px;
    background: #fff;
    background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
    border: 2px solid #c5a059;
    border-radius: 5px;
    color: #1a1a1a;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: center;
    box-shadow: 0 6px 0 #a0864a;
    transform: translateY(-2px);
    font-family: 'Nunito', sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.card-btn.locked {
    opacity: 0.7;
    cursor: not-allowed;
    border-color: #a0864a;
    background: #e8dcc5;
    box-shadow: 0 3px 0 #a0864a;
    transform: translateY(2px);
}

.card-btn.locked:hover {
    transform: translateY(2px);
    box-shadow: 0 3px 0 #a0864a;
}

.card-btn:not(.locked):hover {
    border-color: #8b6914;
    background: #f5ead4;
    transform: translateY(-4px);
    box-shadow: 0 8px 0 #a0864a;
}

.card-btn .number {
    display: inline-flex;
    background: linear-gradient(145deg, #c5a059, #b38a40);
    color: white;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 1.3rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    flex-shrink: 0;
}

.card-btn.locked .number {
    background: linear-gradient(145deg, #a0864a, #8a6e3a);
    color: #e8dcc5;
}

/* Card title text styling */
.card-btn span:not(.number):not(.lock-icon):not(.check-icon) {
    display: block;
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.3;
    margin-top: 4px;
}

.card-btn .lock-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    color: #b71c1c;
    font-size: 16px;
}

.card-btn.locked .lock-icon {
    color: #8e6a3e;
}

.card-btn .check-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    color: #2e7d32;
    font-size: 16px;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(10, 8, 7, 0.9);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal.show {
    display: flex;
}

.modal-box {
    background: #f4e4c7;
    background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
    padding: 28px;
    border-radius: 5px;
    max-width: 920px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    border: 2px solid #c5a059;
    position: relative;
}

.modal-close-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #b71c1c;
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 3px;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-close-btn:hover {
    background: #8b1a1a;
    transform: scale(1.05);
}

.modal-header {
    text-align: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #c5a059;
}

.card-title {
    color: #1a1a1a;
    font-weight: 900;
    font-size: 26px;
    margin-bottom: 8px;
    font-family: 'Nunito', sans-serif;
}

.card-subtitle {
    color: #6b4c2c;
    font-size: 14px;
    font-weight: 600;
}

.card-content {
    color: #1a1a1a;
    line-height: 1.75;
}

.card-content h5 {
    color: #8b6914;
    font-weight: 800;
    margin-top: 18px;
    margin-bottom: 10px;
    border-left: 5px solid #c5a059;
    padding-left: 12px;
    font-family: 'Nunito', sans-serif;
}

.card-content ul, .card-content ol {
    margin: 10px 0 10px 24px;
    color: #1a1a1a;
}

.card-content li {
    margin-bottom: 6px;
}

.card-content strong {
    color: #b71c1c;
}

.message-box {
    background: #fff8e8;
    border-left: 6px solid #c5a059;
    padding: 14px 18px;
    border-radius: 3px;
    margin: 18px 0;
    color: #1a1a1a;
    font-weight: 500;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.checklist-section {
    background: #fff8e8;
    padding: 16px;
    border-radius: 5px;
    margin: 16px 0;
    border: 1px solid #c5a059;
}

.checklist-section table {
    width: 100%;
    border-collapse: collapse;
    color: #1a1a1a;
}

.checklist-section th {
    background: #e8d9be;
    color: #1a1a1a;
    padding: 10px;
    text-align: left;
    font-weight: 800;
    font-family: 'Nunito', sans-serif;
}

.checklist-section td {
    padding: 10px;
    border-bottom: 1px solid #d9c5a3;
}

.checklist-section input[type="checkbox"] {
    margin-right: 6px;
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #c5a059;
}

.btn-nav {
    display: flex;
    gap: 15px;
    justify-content: space-between;
    margin-top: 28px;
    padding-top: 18px;
    border-top: 2px solid #c5a059;
}

.btn-prev, .btn-next, .btn-proceed {
    padding: 12px 28px;
    border: none;
    border-radius: 3px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
    font-family: 'Nunito', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-prev {
    background: #2b1b17;
    color: #c5a059;
    border: 1px solid #c5a059;
}

.btn-prev:hover:not(:disabled) {
    background: #3d2a25;
    transform: translateY(-2px);
}

.btn-next {
    background: #2b1b17;
    color: #c5a059;
    border: 1px solid #c5a059;
}

.btn-next:hover:not(:disabled) {
    background: #3d2a25;
    transform: translateY(-2px);
}

.btn-proceed {
    background: #2b1b17;
    color: #c5a059;
    border: 1px solid #c5a059;
}

.btn-proceed:hover {
    background: #3d2a25;
    transform: translateY(-2px);
}

.btn-prev:disabled, .btn-next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.counter {
    text-align: center;
    padding: 8px 20px;
    color: #1a1a1a;
    font-size: 14px;
    font-weight: 800;
    background: #e8d9be;
    border-radius: 3px;
    font-family: 'Nunito', sans-serif;
}

.answer-option {
    display: block;
    margin-bottom: 12px;
    cursor: pointer;
    background: #fff8e8;
    padding: 10px 15px;
    border-radius: 3px;
    transition: 0.1s;
    border: 1px solid #d9c5a3;
}

.answer-option:hover {
    background: #f0e4cc;
}

.answer-feedback {
    margin-top: 16px;
    display: none;
}

@media (max-width: 768px) {
    .container-box { padding: 20px 15px; }
    .modal-box { padding: 20px; }
    .card-grid { gap: 12px; }
    .card-btn { padding: 14px 6px; gap: 8px; }
    .card-btn .number { width: 36px; height: 36px; font-size: 1rem; }
    h2 { font-size: 1.5rem; }
}
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container-box">
        <h2><i class="fas fa-cyclone"></i> ALAMIN: Kahalagahan ng Kahandaan, Disiplina at Kooperasyon</h2>

        <div class="page-banner">
            <div class="brief">
                <div class="eyebrow">Araling Panlipunan · Modyul 4</div>
                <p>Matuto tungkol sa kahalagahan ng kahandaan, disiplina, at kooperasyon sa panahon ng kalamidad.</p>
            </div>
        </div>

        <div class="progress-wrap">
            <div class="progress-label">
                <span>🌿 Pag-usad sa Alamin</span>
                <span id="progressText">0/11</span>
            </div>
            <div class="progress">
                <div id="progressBar" class="progress-bar" style="width:0%"></div>
            </div>
        </div>

        <div class="card-grid" id="cardGrid"></div>
    </div>
</div>

<!-- MAIN MODAL -->
<div class="modal" id="modal">
    <div class="modal-box" id="modalContent">
        <button class="modal-close-btn" onclick="closeCard()">✕</button>
        <div id="cardContent"></div>
        <div class="btn-nav" id="btnNav">
            <button class="btn-prev" id="prevBtn" onclick="previousCard()">← Nakaraan</button>
            <div class="counter"><span id="cardCounter">1</span>/11</div>
            <button class="btn-next" id="nextBtn" onclick="nextCard()">Susunod →</button>
        </div>
    </div>
</div>

<script>
// Card data
const cardTitles = [
    "Panimula",
    "Kahandaan",
    "Disiplina",
    "Kooperasyon",
    "Sistema ng DRRM",
    "Pagtugon sa Sakuna",
    "Tunay na Buhay",
    "Buod",
    "Mabilis na Pagsusuri",
    "Checklist",
    "Maikling Sagot"
];

let currentCard = 0;
const totalCards = 11;
let visitedCards = new Set();
let highestUnlockedCard = 1;
let card9AnswerSubmitted = false;
let card11AnswerSubmitted = false;

function initializeCards() {
    const grid = document.getElementById('cardGrid');
    grid.innerHTML = '';
    
    for (let i = 1; i <= totalCards; i++) {
        const isLocked = i > highestUnlockedCard;
        const isCompleted = visitedCards.has(i);
        
        const card = document.createElement('button');
        card.className = `card-btn ${isLocked ? 'locked' : ''}`;
        card.onclick = () => openCard(i);
        
        const numberDiv = document.createElement('div');
        numberDiv.className = 'number';
        numberDiv.textContent = i;
        card.appendChild(numberDiv);
        
        const titleSpan = document.createElement('span');
        titleSpan.textContent = cardTitles[i-1];
        card.appendChild(titleSpan);
        
        if (isCompleted) {
            const checkIcon = document.createElement('i');
            checkIcon.className = 'fas fa-check-circle check-icon';
            card.appendChild(checkIcon);
        } else if (isLocked) {
            const lockIcon = document.createElement('i');
            lockIcon.className = 'fas fa-lock lock-icon';
            card.appendChild(lockIcon);
        }
        
        grid.appendChild(card);
    }
}

function updateProgress() {
    const percentage = Math.round((visitedCards.size / totalCards) * 100);
    document.getElementById('progressBar').style.width = percentage + '%';
    document.getElementById('progressText').innerText = visitedCards.size + '/' + totalCards;
}

function updateNavButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const counterSpan = document.getElementById('cardCounter');
    
    prevBtn.disabled = currentCard === 1;
    
    if (currentCard === 11) {
        nextBtn.textContent = 'Magpatuloy sa Huling Gawain →';
        nextBtn.className = 'btn-proceed';
        nextBtn.onclick = () => proceedToPosttest();
        nextBtn.disabled = false;
    } else {
        nextBtn.textContent = 'Susunod →';
        nextBtn.className = 'btn-next';
        nextBtn.onclick = () => nextCard();
        
        if (currentCard === 9) {
            nextBtn.disabled = !card9AnswerSubmitted;
        } else {
            nextBtn.disabled = currentCard === totalCards || (currentCard + 1) > highestUnlockedCard;
        }
    }
    
    counterSpan.innerText = currentCard;
}

function openCard(num) {
    if (num > highestUnlockedCard) {
        alert(`Hindi mo pa maa-access ang Card ${num}. Tapusin muna ang mga naunang card.`);
        return;
    }
    
    currentCard = num;
    visitedCards.add(num);
    
    if (num === highestUnlockedCard && highestUnlockedCard < totalCards) {
        highestUnlockedCard = num + 1;
    }
    
    updateProgress();
    initializeCards();
    
    const content = getCardContent(num);
    document.getElementById('cardContent').innerHTML = content;
    document.getElementById('modal').classList.add('show');
    
    updateNavButtons();
    
    setTimeout(() => {
        if (num === 9) attachCard9Listeners();
        if (num === 11) attachCard11Listeners();
    }, 50);
}

function closeCard() {
    document.getElementById('modal').classList.remove('show');
}

function nextCard() {
    if (currentCard < totalCards && currentCard + 1 <= highestUnlockedCard) {
        openCard(currentCard + 1);
    }
}

function previousCard() {
    if (currentCard > 1) {
        openCard(currentCard - 1);
    }
}

function attachCard9Listeners() {
    const submitBtn = document.getElementById('card9SubmitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', checkCard9Answer);
    }
}

function attachCard11Listeners() {
    const submitBtn = document.getElementById('card11SubmitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', checkCard11Answer);
    }
}

function checkCard9Answer() {
    const selected = document.querySelector('input[name="card9Answer"]:checked');
    const resultDiv = document.getElementById('card9Result');
    
    if (selected) {
        if (selected.value === 'B') {
            resultDiv.innerHTML = `
                <h5 style="color: #2e7d32;">✅ Tama ang iyong sagot!</h5>
                <div class="message-box">
                    💡 <strong>Paliwanag:</strong> Bilang lider, dapat mong ihanda ang buong komunidad at magbigay ng maagang babala para maiwasan ang malaking pinsala.
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <h5 style="color: #b71c1c;">❌ Hindi tama. Subukang muli.</h5>
                <div class="message-box">
                    💡 <strong>Paliwanag:</strong> Ang tamang sagot ay B. Bilang lider, dapat mong ihanda ang buong komunidad at magbigay ng maagang babala.
                </div>
            `;
        }
        resultDiv.style.display = 'block';
        card9AnswerSubmitted = true;
        
        document.querySelectorAll('input[name="card9Answer"]').forEach(radio => radio.disabled = true);
        document.getElementById('card9SubmitBtn').disabled = true;
        document.getElementById('nextBtn').disabled = false;
    } else {
        alert('Pumili muna ng sagot.');
    }
}

function checkCard11Answer() {
    const selected = document.querySelector('input[name="card11Answer"]:checked');
    const resultDiv = document.getElementById('card11Result');
    
    if (selected) {
        if (selected.value === 'B') {
            resultDiv.innerHTML = `
                <h5 style="color: #2e7d32;">✅ Tama ang iyong sagot!</h5>
                <div class="message-box">
                    💡 <strong>Paliwanag:</strong> Ang kahandaan, disiplina, at kooperasyon ay mahalaga upang mabawasan ang pinsala na maaaring idulot ng kalamidad at mapabilis ang pagbangon ng komunidad.
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <h5 style="color: #b71c1c;">❌ Hindi tama.</h5>
                <div class="message-box">
                    💡 <strong>Tamang Sagot: B</strong> - Upang mabawasan ang pinsala at mapabilis ang pagbangon
                </div>
            `;
        }
        resultDiv.style.display = 'block';
        card11AnswerSubmitted = true;
        
        document.querySelectorAll('input[name="card11Answer"]').forEach(radio => radio.disabled = true);
        document.getElementById('card11SubmitBtn').disabled = true;
    } else {
        alert('Pumili muna ng sagot.');
    }
}

function proceedToPosttest() {
    window.location.href = "{{ route('module4.posttest') }}";
}

function getCardContent(num) {
    const cards = {
        1: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 1: PANIMULA</h3>
            </div>
            <div class="card-content">
                <h5>🎯 Pamagat:</h5>
                <p><strong>Bakit Mahalaga ang Kahandaan, Disiplina, at Kooperasyon?</strong></p>
                
                <h5>💡 Pangunahing Kaisipan:</h5>
                <div class="message-box">
                    👉 Sa panahon ng sakuna, ang kaligtasan ay nakasalalay hindi lamang sa pamahalaan kundi sa bawat mamamayan.
                </div>
                
                <ul>
                    <li><strong>✔ Kahandaan</strong> → Nakapagliligtas ng buhay</li>
                    <li><strong>✔ Disiplina</strong> → Nakaiiwas sa aksidente</li>
                    <li><strong>✔ Kooperasyon</strong> → Nagpapabilis ng pagbangon</li>
                </ul>
            </div>
        `,
        2: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 2: KAHANDAAN</h3>
            </div>
            <div class="card-content">
                <h5>🧰 Konsepto:</h5>
                <div class="message-box">
                    👉 Ayon sa Philippine National Red Cross, mahalaga ang pagkakaroon ng "Emergency Kit" bago pa man dumating ang sakuna
                </div>
                
                <h5>📌 Halimbawa:</h5>
                <ul>
                    <li>Go bag (tubig, pagkain, flashlight)</li>
                    <li>First aid kit</li>
                    <li>Mahahalagang dokumento</li>
                </ul>
                
                <h5>🎯 Mensahe:</h5>
                <div class="message-box">
                    👉 "Ang handa ay ligtas."
                </div>
            </div>
        `,
        3: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 3: DISIPLINA</h3>
            </div>
            <div class="card-content">
                <h5>⚡ Konsepto:</h5>
                <div class="message-box">
                    👉 Ayon sa Department of Energy, kailangang maging maingat sa paggamit ng kuryente sa panahon ng kalamidad
                </div>
                
                <h5>📌 Halimbawa:</h5>
                <ul>
                    <li>Patayin ang kuryente kung may baha</li>
                    <li>Sumunod sa mga babala</li>
                    <li>Iwasan ang delikadong lugar</li>
                </ul>
                
                <h5>🎯 Mensahe:</h5>
                <div class="message-box">
                    👉 "Ang disiplina ay proteksyon."
                </div>
            </div>
        `,
        4: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 4: KOOPERASYON</h3>
            </div>
            <div class="card-content">
                <h5>🤝 Konsepto:</h5>
                <div class="message-box">
                    👉 Ang pagtutulungan ng komunidad ay mahalaga sa pagharap sa sakuna
                </div>
                
                <h5>📌 Halimbawa:</h5>
                <ul>
                    <li>Bayanihan sa paglikas</li>
                    <li>Pamamahagi ng relief goods</li>
                    <li>Pagsunod sa utos ng barangay</li>
                </ul>
                
                <h5>🎯 Mensahe:</h5>
                <div class="message-box">
                    👉 "Walang iwanan sa sakuna."
                </div>
            </div>
        `,
        5: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 5: SISTEMA NG DRRM</h3>
            </div>
            <div class="card-content">
                <h5>🏛️ Batayan:</h5>
                <p><strong>Batas Republika Blg. 10121</strong> – Disaster Risk Reduction and Management Act</p>
                
                <h5>🔄 Apat na Yugto:</h5>
                <ol>
                    <li><strong>🛡️ Pag-iwas at Pagbawas ng Panganib</strong></li>
                    <li><strong>📦 Paghahanda</strong></li>
                    <li><strong>🚨 Pagtugon</strong></li>
                    <li><strong>🏗️ Rehabilitasyon at Pagbangon</strong></li>
                </ol>
                
                <h5>🎯 Mensahe:</h5>
                <div class="message-box">
                    👉 "May sistema ang pagtugon sa sakuna."
                </div>
            </div>
        `,
        6: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 6: PAGTUGON SA SAKUNA</h3>
            </div>
            <div class="card-content">
                <h5>🚑 Layunin:</h5>
                <div class="message-box">
                    👉 Agarang pagtulong sa mga apektado
                </div>
                
                <h5>📌 Halimbawa:</h5>
                <ul>
                    <li>Pagsagip (rescue)</li>
                    <li>Pamamahagi ng tulong</li>
                    <li>Serbisyong medikal</li>
                </ul>
                
                <h5>🎯 Mensahe:</h5>
                <div class="message-box">
                    👉 "Bawat segundo ay mahalaga."
                </div>
            </div>
        `,
        7: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 7: PAGLALAPAT SA TUNAY NA BUHAY</h3>
            </div>
            <div class="card-content">
                <h5>🌧️ Halimbawa:</h5>
                <div class="message-box">
                    👉 Pagbaha sa Butuan at rehiyon ng Caraga
                </div>
                
                <h5>📊 Natutunan:</h5>
                <ul>
                    <li>Mahalaga ang paghahanda bago ang tag-ulan</li>
                    <li>Kailangan ang maayos na pangangalaga sa kapaligiran</li>
                </ul>
                
                <h5>🌱 Apat na Aspeto:</h5>
                <ul>
                    <li>Kagubatan</li>
                    <li>Tubig-tabang</li>
                    <li>Karagatan</li>
                    <li>Urban na lugar</li>
                </ul>
            </div>
        `,
        8: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 8: BUOD</h3>
            </div>
            <div class="card-content">
                <h5>🧠 Mahahalagang Punto:</h5>
                <div class="message-box">
                    👉 Hindi natin mapipigilan ang sakuna, ngunit maaari nating mabawasan ang pinsala kung:
                </div>
                <ul>
                    <li><strong>✔ Tayo ay handa</strong></li>
                    <li><strong>✔ Tayo ay disiplinado</strong></li>
                    <li><strong>✔ Tayo ay nagtutulungan</strong></li>
                </ul>
            </div>
        `,
        9: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 9: MABILISANG PAGSUSURI</h3>
            </div>
            <div class="card-content">
                <h5>🎮 Tanong:</h5>
                <div class="message-box">
                    👉 "Kung ikaw ay lider ng barangay, ano ang iyong uunahin?"
                </div>
                
                <div style="margin: 14px 0;">
                    <label class="answer-option">
                        <input type="radio" name="card9Answer" value="A" style="margin-right: 8px;">
                        <strong>A.</strong> Maghintay ng tulong
                    </label>
                    <label class="answer-option">
                        <input type="radio" name="card9Answer" value="B" style="margin-right: 8px;">
                        <strong>B.</strong> Maghanda at magbigay babala
                    </label>
                    <label class="answer-option">
                        <input type="radio" name="card9Answer" value="C" style="margin-right: 8px;">
                        <strong>C.</strong> Sariling pamilya lamang ang tulungan
                    </label>
                </div>
                
                <button type="button" id="card9SubmitBtn" style="padding: 12px 24px; background: #2b1b17; color: #c5a059; border: 1px solid #c5a059; border-radius: 3px; font-weight: 800; cursor: pointer; font-family: 'Nunito', sans-serif;">Suriin ang Sagot</button>
                
                <div id="card9Result" class="answer-feedback"></div>
                
                <p style="margin-top: 14px; font-size: 14px; color: #6b4c2c;">
                    <strong>💬 Paalala:</strong> Piliin ang opsyon na sa tingin mo ay pinaka-tama.
                </p>
            </div>
        `,
        10: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 10: CHECKLIST NG KAHANDAAN</h3>
            </div>
            <div class="card-content">
                <p><strong>Panuto:</strong> Sagutan ang mga sumusunod na tanong tungkol sa kahandaan kapag may kalamidad. Lagyan ng tsek (√) sa loob ng kahon ang iyong kasagutan.</p>
                
                <div class="checklist-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Mga Katanungan</th>
                                <th style="width: 70px; text-align: center;">Oo</th>
                                <th style="width: 70px; text-align: center;">Hindi</th>
                                <th style="width: 100px; text-align: center;">Hindi Sigurado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Alam ba natin ang mga emergency numbers ng lokal na tanggapan ng pagamutan, pamatay-sunog, pulis, at mga kawani ng barangay?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>2. Alam ba natin ang pinakamalapit na ligtas na lugar mula sa ating bahay na maaaring paglikasan pag may kalamidad?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>3. Alam ba ng buong pamilya ang evacuation plan sa kani-kanilang mga paaralan at trabaho?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>4. Alam ba natin kung paano ililikas ang mga bata, may kapansanan at matatanda na kasama natin sa bahay?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>5. Nag-iimbak ba tayo ng pagkain o inuming tubig para sa posibleng kalamidad?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>6. Naghahanda ba tayo ng emergency kit at first aid kit para sa posibleng sakuna o trahedya?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>7. Alam ba ng buong pamilya kung ang ating tahanan ay malapit sa bulkan, dagat o ilog?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>8. Kapag may bagyo o lindol, alam ba ng buong pamilya kung tayo ay nasa panganib?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>9. Pagkatapos ng bagyo, alam ba natin kung paano matatawagan ang mga kasama natin sa bahay kung sakaling nagkahiwalay kayo?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>10. Alam ba natin kung kailan dapat bumalik sa ating mga tahanan pagkatapos ng isang kalamidad?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>11. Tayo ba ay handa sa posibleng epekto ng bagyo, pagbaha, lindol at pagputok ng bulkan?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>12. Alam ba natin kung kanino makakukuha ng tama at totoong balita o impormasyon?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>13. Alam ba natin kung kailan dapat lumikas kapag may kalamidad?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>14. Alam ba natin ang tamang paraan ng paglikas kung tayo ay nasa panganib dulot ng kalamidad?</td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                                <td style="text-align: center;"><input type="checkbox"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        `,
        11: `
            <div class="modal-header">
                <h3 class="card-title">🧩 CARD 11: PILIAN</h3>
            </div>
            <div class="card-content">
                <h5>🎯 Tanong:</h5>
                <p><strong>👉 Bakit mahalaga ang kahandaan, disiplina, at kooperasyon sa panahon ng kalamidad?</strong></p>
                
                <div class="message-box">
                    👉 Piliin ang pinaka-tamang sagot sa mga sumusunod na opsyon.
                </div>
                
                <div style="margin: 14px 0;">
                    <label class="answer-option">
                        <input type="radio" name="card11Answer" value="A" style="margin-right: 8px;">
                        <strong>A.</strong> Upang mapigilan ang kalamidad
                    </label>
                    <label class="answer-option">
                        <input type="radio" name="card11Answer" value="B" style="margin-right: 8px;">
                        <strong>B.</strong> Upang mabawasan ang pinsala at mapabilis ang pagbangon
                    </label>
                    <label class="answer-option">
                        <input type="radio" name="card11Answer" value="C" style="margin-right: 8px;">
                        <strong>C.</strong> Upang maging masaya ang lahat
                    </label>
                    <label class="answer-option">
                        <input type="radio" name="card11Answer" value="D" style="margin-right: 8px;">
                        <strong>D.</strong> Upang magkaroon ng trabaho
                    </label>
                </div>
                
                <button type="button" id="card11SubmitBtn" style="padding: 12px 24px; background: #2b1b17; color: #c5a059; border: 1px solid #c5a059; border-radius: 3px; font-weight: 800; cursor: pointer; font-family: 'Nunito', sans-serif;">Suriin ang Sagot</button>
                
                <div id="card11Result" class="answer-feedback"></div>
                
                <p style="margin-top: 14px; font-size: 14px; color: #6b4c2c;">
                    <strong>💬 Paalala:</strong> Piliin ang opsyon na sa tingin mo ay pinaka-tama.
                </p>
            </div>
        `
    };
    
    return cards[num] || '<p>Card not found</p>';
}

document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCard();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    initializeCards();
    updateProgress();
});
</script>
@endsection