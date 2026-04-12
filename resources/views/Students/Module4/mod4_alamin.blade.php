<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modyul 4 - Alamin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0b1b2b 0%, #11384f 45%, #173d2c 100%);
    color: #eaf4ff;
    min-height: 100vh;
}

.container-box {
    max-width: 1100px;
    margin: auto;
    padding: 28px;
}

h2 {
    text-align: center;
    font-weight: 900;
    letter-spacing: 1px;
    color: #f8fdff;
    text-shadow: 0 4px 18px rgba(0,0,0,.35);
    margin-bottom: 24px;
}

.page-banner {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    margin-bottom: 24px;
    border-radius: 22px;
    background: rgba(3, 18, 30, 0.72);
    border: 1px solid rgba(255,255,255,.10);
    box-shadow: 0 16px 35px rgba(0,0,0,.25);
    backdrop-filter: blur(10px);
}

.page-banner .brief {
    max-width: 760px;
}

.page-banner .brief .eyebrow {
    display: inline-block;
    font-size: .78rem;
    font-weight: 800;
    letter-spacing: 1.6px;
    text-transform: uppercase;
    color: #7ce7ff;
    margin-bottom: 6px;
}

.page-banner .brief p {
    margin: 0;
    color: #d8eefb;
    line-height: 1.6;
}

.progress-wrap {
    margin-bottom: 24px;
    padding: 14px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 18px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-weight: 700;
    color: #e7f7ff;
}

.progress {
    height: 12px;
    border-radius: 10px;
    background: rgba(255,255,255,.08);
}

.progress-bar {
    background: linear-gradient(90deg, #7ce7ff, #9dfdba);
    border-radius: 10px;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 24px;
}

.card-btn {
    position: relative;
    padding: 16px;
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.12), rgba(57, 255, 20, 0.08));
    border: 2px solid rgba(124, 231, 255, 0.28);
    border-radius: 18px;
    color: #e7f7ff;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.card-btn:hover {
    border-color: rgba(124, 231, 255, 0.6);
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.18), rgba(57, 255, 20, 0.12));
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(124, 231, 255, 0.18);
}

.card-btn .number {
    display: inline-block;
    background: linear-gradient(135deg, #7ce7ff, #9dfdba);
    color: #0b1b2b;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    margin-bottom: 8px;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal.show {
    display: flex;
}

.modal-box {
    background: linear-gradient(180deg, #fdfefe 0%, #eef7fb 100%);
    padding: 28px;
    border-radius: 22px;
    max-width: 900px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,.45);
    border: 1px solid rgba(255,255,255,.35);
    position: relative;
}

.modal-close-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: linear-gradient(135deg, #dc3545, #ff6b6b);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-close-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

.modal-header {
    text-align: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #e0e0e0;
}

.card-title {
    color: #0b1b2b;
    font-weight: 900;
    font-size: 24px;
    margin-bottom: 8px;
}

.card-subtitle {
    color: #60758a;
    font-size: 14px;
}

.card-content {
    color: #334455;
    line-height: 1.8;
}

.card-content h5 {
    color: #153b55;
    font-weight: 800;
    margin-top: 16px;
    margin-bottom: 10px;
}

.card-content ul, .card-content ol {
    margin: 10px 0 10px 24px;
    color: #334455;
}

.card-content li {
    margin-bottom: 6px;
}

.card-content strong {
    color: #0b1b2b;
}

.message-box {
    background: linear-gradient(135deg, #e7f5ff, #f0f9ff);
    border-left: 4px solid #0d6efd;
    padding: 14px;
    border-radius: 10px;
    margin: 14px 0;
    color: #0c3a66;
    font-weight: 600;
}

.checklist-section {
    background: #f8f9fa;
    padding: 16px;
    border-radius: 12px;
    margin: 14px 0;
}

.checklist-section table {
    width: 100%;
    border-collapse: collapse;
    color: #334455;
}

.checklist-section th {
    background: #e7f5ff;
    color: #0c3a66;
    padding: 10px;
    text-align: left;
    font-weight: 700;
}

.checklist-section td {
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
}

.checklist-section input[type="checkbox"] {
    margin-right: 8px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.short-answer {
    background: #fff9e6;
    border-left: 4px solid #ff9800;
    padding: 16px;
    border-radius: 12px;
    margin: 14px 0;
}

.short-answer textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    margin-top: 10px;
    resize: vertical;
    min-height: 80px;
}

.rubric {
    background: #f8f9fa;
    padding: 14px;
    border-radius: 10px;
    margin-top: 14px;
}

.rubric-item {
    display: flex;
    gap: 10px;
    margin-bottom: 8px;
    padding: 8px;
    border-radius: 6px;
    font-size: 14px;
}

.rubric-item.low {
    background: #ffe0e0;
    color: #8b0000;
}

.rubric-item.mid {
    background: #fff9e6;
    color: #8b7500;
}

.rubric-item.high {
    background: #e0ffe0;
    color: #006600;
}

.btn-nav {
    display: flex;
    gap: 10px;
    justify-content: space-between;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 2px solid #e0e0e0;
}

.btn-prev, .btn-next {
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-prev {
    background: #e0e0e0;
    color: #333;
}

.btn-prev:hover:not(:disabled) {
    background: #d0d0d0;
}

.btn-next {
    background: linear-gradient(135deg, #28a745, #45b358);
    color: white;
}

.btn-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(40, 167, 69, 0.25);
}

.btn-prev:disabled, .btn-next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.counter {
    text-align: center;
    padding: 10px;
    color: #60758a;
    font-size: 14px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .container-box { padding: 16px; }
    .modal-box { padding: 16px; }
    .card-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
    .card-btn { padding: 12px; }
}
</style>
</head>

<body>

<div class="container-box">

<h2>🧠 ALAMIN: Kahalagahan ng Kahandaan, Disiplina at Kooperasyon</h2>

<div class="page-banner">
    <div class="brief">
        <div class="eyebrow">Araling Panlipunan · Modyul 4</div>
        <p>Matuto tungkol sa kahalagahan ng kahandaan, disiplina, at kooperasyon sa panahon ng kalamidad.</p>
    </div>
</div>

<div class="progress-wrap">
    <div class="progress-label">
        <span>Pag-usad sa Alamin</span>
        <span id="progressText">0/11</span>
    </div>
    <div class="progress">
        <div id="progressBar" class="progress-bar" style="width:0%"></div>
    </div>
</div>

<div class="card-grid">
    <button class="card-btn" onclick="openCard(1)">
        <div class="number">1</div>
        Panimula
    </button>
    <button class="card-btn" onclick="openCard(2)">
        <div class="number">2</div>
        Kahandaan
    </button>
    <button class="card-btn" onclick="openCard(3)">
        <div class="number">3</div>
        Disiplina
    </button>
    <button class="card-btn" onclick="openCard(4)">
        <div class="number">4</div>
        Kooperasyon
    </button>
    <button class="card-btn" onclick="openCard(5)">
        <div class="number">5</div>
        Sistema ng DRRM
    </button>
    <button class="card-btn" onclick="openCard(6)">
        <div class="number">6</div>
        Pagtugon sa Sakuna
    </button>
    <button class="card-btn" onclick="openCard(7)">
        <div class="number">7</div>
        Tunay na Buhay
    </button>
    <button class="card-btn" onclick="openCard(8)">
        <div class="number">8</div>
        Buod
    </button>
    <button class="card-btn" onclick="openCard(9)">
        <div class="number">9</div>
        Mabilis na Pagsusuri
    </button>
    <button class="card-btn" onclick="openCard(10)">
        <div class="number">10</div>
        Checklist
    </button>
    <button class="card-btn" onclick="openCard(11)">
        <div class="number">11</div>
        Maikling Sagot
    </button>
</div>

</div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-box" id="modalContent">
    <button class="modal-close-btn" onclick="closeCard()">✕</button>
    <div id="cardContent"></div>
    <div class="btn-nav">
        <button class="btn-prev" id="prevBtn" onclick="previousCard()">← Nakaraan</button>
        <div class="counter"><span id="cardCounter">1</span>/11</div>
        <button class="btn-next" id="nextBtn" onclick="nextCard()">Susunod →</button>
    </div>
</div>
</div>

<script>
let currentCard = 0;
const totalCards = 11;
let visitedCards = new Set();

function updateProgress() {
    const percentage = Math.round((visitedCards.size / totalCards) * 100);
    document.getElementById('progressBar').style.width = percentage + '%';
    document.getElementById('progressText').innerText = visitedCards.size + '/' + totalCards;
}

function openCard(num) {
    currentCard = num;
    visitedCards.add(num);
    updateProgress();
    
    const content = getCardContent(num);
    document.getElementById('cardContent').innerHTML = content;
    document.getElementById('modal').classList.add('show');
    document.getElementById('cardCounter').innerText = num;
    
    document.getElementById('prevBtn').disabled = num === 1;
    document.getElementById('nextBtn').disabled = num === totalCards;
}

function closeCard() {
    document.getElementById('modal').classList.remove('show');
}

function nextCard() {
    if (currentCard < totalCards) {
        openCard(currentCard + 1);
    }
}

function previousCard() {
    if (currentCard > 1) {
        openCard(currentCard - 1);
    }
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
                
                <ul>
                    <li>A. Maghintay ng tulong</li>
                    <li>B. Maghanda at magbigay babala</li>
                    <li>C. Sariling pamilya lamang ang tulungan</li>
                </ul>
                
                <h5>✅ Tamang Sagot: B</h5>
                <div class="message-box">
                    💡 <strong>Paliwanag:</strong> Bilang lider, dapat mong ihanda ang buong komunidad at magbigay ng maagang babala para maiwasan ang malaking pinsala.
                </div>
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
                
                <form id="mcqForm">
                    <div style="margin: 14px 0;">
                        <label style="display: block; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="answer" value="A" style="margin-right: 8px;">
                            <strong>A.</strong> Upang mapigilan ang kalamidad
                        </label>
                        <label style="display: block; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="answer" value="B" style="margin-right: 8px;">
                            <strong>B.</strong> Upang mabawasan ang pinsala at mapabilis ang pagbangon
                        </label>
                        <label style="display: block; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="answer" value="C" style="margin-right: 8px;">
                            <strong>C.</strong> Upang maging masaya ang lahat
                        </label>
                        <label style="display: block; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="answer" value="D" style="margin-right: 8px;">
                            <strong>D.</strong> Upang magkaroon ng trabaho
                        </label>
                    </div>
                    
                    <button type="button" onclick="checkAnswer()" style="padding: 10px 20px; background: linear-gradient(135deg, #28a745, #45b358); color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer;">Suriin ang Sagot</button>
                </form>
                
                <div id="result" style="margin-top: 14px; display: none;">
                    <h5>✅ Tamang Sagot: B</h5>
                    <div class="message-box">
                        💡 <strong>Paliwanag:</strong> Ang kahandaan, disiplina, at kooperasyon ay mahalaga upang mabawasan ang pinsala na maaaring idulot ng kalamidad at mapabilis ang pagbangon ng komunidad.
                    </div>
                </div>
                
                <p style="margin-top: 14px; font-size: 14px; color: #60758a;">
                    <strong>💬 Paalala:</strong> Piliin ang opsyon na sa tingin mo ay pinaka-tama.
                </p>
            </div>
        `
    };
    
    return cards[num] || '<p>Card not found</p>';
}

function checkAnswer() {
    const selected = document.querySelector('input[name="answer"]:checked');
    const resultDiv = document.getElementById('result');
    if (selected) {
        if (selected.value === 'B') {
            resultDiv.innerHTML = `
                <h5>✅ Tama ang iyong sagot!</h5>
                <div class="message-box">
                    💡 <strong>Paliwanag:</strong> Ang kahandaan, disiplina, at kooperasyon ay mahalaga upang mabawasan ang pinsala na maaaring idulot ng kalamidad at mapabilis ang pagbangon ng komunidad.
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <h5>❌ Hindi tama. Subukang muli.</h5>
                <div class="message-box">
                    💡 <strong>Tamang Sagot: B</strong> - Upang mabawasan ang pinsala at mapabilis ang pagbangon
                </div>
            `;
        }
        resultDiv.style.display = 'block';
    } else {
        alert('Pumili muna ng sagot.');
    }
}

document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCard();
    }
});
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modyul 4 - Alamin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0b1b2b 0%, #11384f 45%, #173d2c 100%);
    color: #eaf4ff;
    min-height: 100vh;
}

.container-box {
    max-width: 1100px;
    margin: auto;
    padding: 28px;
}

h2 {
    text-align: center;
    font-weight: 900;
    letter-spacing: 1px;
    color: #f8fdff;
    text-shadow: 0 4px 18px rgba(0,0,0,.35);
    margin-bottom: 24px;
}

.page-banner {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    margin-bottom: 24px;
    border-radius: 22px;
    background: rgba(3, 18, 30, 0.72);
    border: 1px solid rgba(255,255,255,.10);
    box-shadow: 0 16px 35px rgba(0,0,0,.25);
    backdrop-filter: blur(10px);
}

.page-banner .brief {
    max-width: 760px;
}

.page-banner .brief .eyebrow {
    display: inline-block;
    font-size: .78rem;
    font-weight: 800;
    letter-spacing: 1.6px;
    text-transform: uppercase;
    color: #7ce7ff;
    margin-bottom: 6px;
}

.page-banner .brief p {
    margin: 0;
    color: #d8eefb;
    line-height: 1.6;
}

.progress-wrap {
    margin-bottom: 24px;
    padding: 14px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 18px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-weight: 700;
    color: #e7f7ff;
}

.progress {
    height: 12px;
    border-radius: 10px;
    background: rgba(255,255,255,.08);
}

.progress-bar {
    background: linear-gradient(90deg, #7ce7ff, #9dfdba);
    border-radius: 10px;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 24px;
}

.card-btn {
    position: relative;
    padding: 16px;
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.12), rgba(57, 255, 20, 0.08));
    border: 2px solid rgba(124, 231, 255, 0.28);
    border-radius: 18px;
    color: #e7f7ff;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.card-btn:hover {
    border-color: rgba(124, 231, 255, 0.6);
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.18), rgba(57, 255, 20, 0.12));
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(124, 231, 255, 0.18);
}

.card-btn .number {
    display: inline-block;
    background: linear-gradient(135deg, #7ce7ff, #9dfdba);
    color: #0b1b2b;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    margin-bottom: 8px;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal.show {
    display: flex;
}

.modal-box {
    background: linear-gradient(180deg, #fdfefe 0%, #eef7fb 100%);
    padding: 28px;
    border-radius: 22px;
    max-width: 900px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,.45);
    border: 1px solid rgba(255,255,255,.35);
    position: relative;
}

.modal-close-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: linear-gradient(135deg, #dc3545, #ff6b6b);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-close-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

.modal-header {
    text-align: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #e0e0e0;
}

.card-title {
    color: #0b1b2b;
    font-weight: 900;
    font-size: 24px;
    margin-bottom: 8px;
}

.card-subtitle {
    color: #60758a;
    font-size: 14px;
}

.card-content {
    color: #334455;
    line-height: 1.8;
}

.card-content h5 {
    color: #153b55;
    font-weight: 800;
    margin-top: 16px;
    margin-bottom: 10px;
}

.card-content ul, .card-content ol {
    margin: 10px 0 10px 24px;
    color: #334455;
}

.card-content li {
    margin-bottom: 6px;
}

.card-content strong {
    color: #0b1b2b;
}

.message-box {
    background: linear-gradient(135deg, #e7f5ff, #f0f9ff);
    border-left: 4px solid #0d6efd;
    padding: 14px;
    border-radius: 10px;
    margin: 14px 0;
    color: #0c3a66;
    font-weight: 600;
}

.checklist-section {
    background: #f8f9fa;
    padding: 16px;
    border-radius: 12px;
    margin: 14px 0;
}

.checklist-section table {
    width: 100%;
    border-collapse: collapse;
    color: #334455;
}

.checklist-section th {
    background: #e7f5ff;
    color: #0c3a66;
    padding: 10px;
    text-align: left;
    font-weight: 700;
}

.checklist-section td {
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
}

.checklist-section input[type="checkbox"] {
    margin-right: 8px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.short-answer {
    background: #fff9e6;
    border-left: 4px solid #ff9800;
    padding: 16px;
    border-radius: 12px;
    margin: 14px 0;
}

.short-answer textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    margin-top: 10px;
    resize: vertical;
    min-height: 80px;
}

.rubric {
    background: #f8f9fa;
    padding: 14px;
    border-radius: 10px;
    margin-top: 14px;
}

.rubric-item {
    display: flex;
    gap: 10px;
    margin-bottom: 8px;
    padding: 8px;
    border-radius: 6px;
    font-size: 14px;
}

.rubric-item.low {
    background: #ffe0e0;
    color: #8b0000;
}

.rubric-item.mid {
    background: #fff9e6;
    color: #8b7500;
}

.rubric-item.high {
    background: #e0ffe0;
    color: #006600;
}

.btn-nav {
    display: flex;
    gap: 10px;
    justify-content: space-between;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 2px solid #e0e0e0;
}

.btn-prev, .btn-next {
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-prev {
    background: #e0e0e0;
    color: #333;
}

.btn-prev:hover:not(:disabled) {
    background: #d0d0d0;
}

.btn-next {
    background: linear-gradient(135deg, #28a745, #45b358);
    color: white;
}

.btn-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(40, 167, 69, 0.25);
}

.btn-prev:disabled, .btn-next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.counter {
    text-align: center;
    padding: 10px;
    color: #60758a;
    font-size: 14px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .container-box { padding: 16px; }
    .modal-box { padding: 16px; }
    .card-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
    .card-btn { padding: 12px; }
}
</style>
</html>