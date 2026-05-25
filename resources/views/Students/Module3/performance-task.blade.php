@extends('Students.studentslayout')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* WOOD THEME BACKGROUND - SAME AS APPLY ACTIVITY */
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(20, 15, 10, 0.7), rgba(20, 15, 10, 0.85)),
                    url("{{ asset('pictures/mod3_innermap.png') }}") center center / cover no-repeat fixed;
        min-height: 100vh;
    }

    /* ===== WOODEN CARD STYLE - SAME AS APPLY ACTIVITY ===== */
    .wooden-card {
        background: #e0c9a6;
        background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
        border: 6px solid #5d4037;
        border-radius: 18px;
        box-shadow: inset 0 0 40px rgba(0,0,0,0.1), 0 10px 25px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .performance-task-container {
        min-height: 100vh;
        padding: 30px 40px;
        position: relative;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .performance-task-container {
            padding: 15px;
        }
    }

    /* Header */
    .task-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .task-header h1 {
        font-family: 'Nunito', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        color: #ffefc0;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        margin-bottom: 10px;
    }

    .subtitle {
        color: #f6e5c9;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Mission Banner */
    .mission-banner {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 30px;
        padding: 25px 30px;
        margin-bottom: 25px;
        align-items: center;
    }

    @media (max-width: 768px) {
        .mission-banner {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px;
        }
    }

    .mission-callout {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mission-pill {
        display: inline-block;
        background: #5d4037;
        color: #f1f5f9;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 20px;
        letter-spacing: 1px;
        width: fit-content;
        font-family: 'Nunito', sans-serif;
    }

    .mission-callout h2 {
        color: #3d2b1f;
        font-size: 1.5rem;
        font-family: 'Nunito', sans-serif;
        margin: 0;
    }

    .mission-callout p {
        color: #3a2a1a;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .mission-objectives {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .objective-chip {
        background: rgba(93, 64, 55, 0.15);
        padding: 10px 15px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #3d2b1f;
        border-left: 4px solid #5d4037;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .objective-chip.active {
        background: rgba(93, 64, 55, 0.25);
        border-left-color: #3d2b1f;
    }

    /* Stats Bar */
    .game-stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        padding: 15px 20px;
        margin-bottom: 15px;
    }

    @media (max-width: 600px) {
        .game-stats-bar {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .stat {
        background: rgba(93, 64, 55, 0.2);
        padding: 12px 15px;
        border-radius: 12px;
        text-align: center;
        backdrop-filter: blur(4px);
    }

    .stat .label {
        font-size: 0.75rem;
        color: #f6e5c9;
        display: block;
        margin-bottom: 5px;
    }

    .stat .value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #ffefc0;
        font-family: 'Nunito', sans-serif;
    }

    /* Progress Bar */
    .progress-bar-container {
        height: 12px;
        border-radius: 20px;
        background: #3b2a1a;
        overflow: hidden;
        margin-bottom: 25px;
        border: 1px solid #5d4037;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #5d4037, #8b5e3c);
        width: 0%;
        transition: width 0.3s ease;
        border-radius: 20px;
    }

    /* Main Game Layout */
    .game-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 20px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .game-content {
            grid-template-columns: 1fr;
        }
    }

    /* Sidebar */
    .scenario-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .scenario-card, .badges-earned {
        padding: 20px;
    }

    .scenario-card h3, .badges-earned h3 {
        color: #3d2b1f;
        font-family: 'Nunito', sans-serif;
        font-size: 1.2rem;
        margin-bottom: 12px;
        border-left: 4px solid #5d4037;
        padding-left: 12px;
    }

    .scenario-card p {
        color: #3a2a1a;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .badges-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .badge-item {
        background: rgba(93, 64, 55, 0.15);
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .badge-item.earned {
        background: linear-gradient(135deg, #5d4037, #8b5e3c);
        box-shadow: 0 4px 12px rgba(93, 64, 55, 0.3);
        color: white;
    }

    .badge-item .emoji {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 5px;
    }

    .badge-item .name {
        font-size: 0.7rem;
        font-weight: 600;
        color: inherit;
    }

    /* Planning Interface */
    .planning-interface {
        height: 70vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* Tabs */
    .task-tabs {
        display: flex;
        gap: 8px;
        padding: 12px;
        background: rgba(93, 64, 55, 0.15);
        border-bottom: 3px solid #5d4037;
        flex-shrink: 0;
    }

    @media (max-width: 600px) {
        .task-tabs {
            flex-wrap: wrap;
        }
    }

    .tab-btn {
        flex: 1;
        padding: 10px 12px;
        border-radius: 12px;
        background: transparent;
        border: none;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .tab-btn:hover {
        background: rgba(93, 64, 55, 0.25);
    }

    .tab-btn.active {
        background: #5d4037;
    }

    .tab-btn.active .tab-title,
    .tab-btn.active .tab-score {
        color: white;
    }

    .tab-icon {
        font-size: 1.3rem;
    }

    .tab-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: #3d2b1f;
    }

    .tab-score {
        font-size: 0.7rem;
        font-weight: 700;
        color: #5d4037;
    }

    /* Tab Content */
    .tab-contents {
        padding: 25px;
        flex: 1;
        overflow-y: auto;
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-header {
        margin-bottom: 20px;
    }

    .section-header h3 {
        color: #3d2b1f;
        font-family: 'Nunito', sans-serif;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .instructions {
        background: rgba(93, 64, 55, 0.1);
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 0.85rem;
        color: #3a2a1a;
        border-left: 4px solid #5d4037;
    }

    /* Items Grid */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .item-card {
        background: rgba(255, 255, 255, 0.5);
        padding: 12px;
        border-radius: 12px;
        border: 2px solid #5d4037;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .item-card:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.8);
    }

    .item-card.selected {
        background: #5d4037;
        border-color: #3d2b1f;
    }

    .item-card.selected .item-name,
    .item-card.selected .item-info,
    .item-card.selected .item-points {
        color: white;
    }

    .item-icon {
        font-size: 1.8rem;
        margin-bottom: 5px;
    }

    .item-name {
        font-weight: 700;
        font-size: 0.85rem;
        color: #3d2b1f;
    }

    .item-info {
        font-size: 0.7rem;
        color: #6b5a4a;
        margin: 5px 0;
    }

    .item-points {
        font-size: 0.7rem;
        font-weight: 700;
        color: #5d4037;
    }

    .selected-items {
        margin-top: 20px;
        padding: 15px;
        background: rgba(93, 64, 55, 0.1);
        border-radius: 12px;
    }

    .selected-items p {
        font-weight: 600;
        color: #3d2b1f;
        margin-bottom: 10px;
    }

    .items-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .item-tag {
        background: #5d4037;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        cursor: pointer;
        transition: all 0.2s;
    }

    .item-tag:hover {
        background: #3d2b1f;
        transform: scale(1.05);
    }

    /* Questions */
    .questions-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .question-card {
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid #5d4037;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        gap: 15px;
    }

    .question-num {
        font-size: 1.2rem;
        font-weight: 800;
        color: #5d4037;
        min-width: 30px;
    }

    .question-content {
        flex: 1;
    }

    .question-text {
        font-weight: 600;
        color: #3d2b1f;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .answer-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .option-label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .option-label:hover {
        background: rgba(93, 64, 55, 0.15);
    }

    .option-label input[type="radio"] {
        width: 16px;
        height: 16px;
        accent-color: #5d4037;
        cursor: pointer;
    }

    .option-text {
        font-size: 0.85rem;
        color: #3a2a1a;
    }

    /* Submit Section */
    .submit-section {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 3px solid #5d4037;
        text-align: center;
    }

    .submit-btn {
        background: linear-gradient(135deg, #3d2b1f, #5d4037);
        color: #f1f5f9;
        border: none;
        padding: 14px 35px;
        border-radius: 50px;
        font-weight: 800;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid #8b5e3c;
    }

    .submit-btn:hover:not(:disabled) {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #5d4037, #7a5a4a);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .submit-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .submit-info {
        margin-top: 10px;
        font-size: 0.75rem;
        color: #f6e5c9;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: #e0c9a6;
        background-image: url('https://www.transparenttextures.com/patterns/retina-wood.png');
        border: 6px solid #5d4037;
        border-radius: 18px;
        max-width: 600px;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        box-shadow: 0 30px 50px rgba(0, 0, 0, 0.5);
    }

    .modal-header {
        padding: 20px;
        border-bottom: 3px solid #5d4037;
        text-align: center;
        background: rgba(93, 64, 55, 0.2);
    }

    .modal-header h2 {
        color: #3d2b1f;
        font-family: 'Nunito', sans-serif;
        font-size: 1.5rem;
    }

    .modal-body {
        padding: 25px;
    }

    .modal-footer {
        padding: 20px;
        border-top: 3px solid #5d4037;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .save-btn {
        background: #3d2b1f;
        color: #f1f5f9;
        border: 1px solid #5d4037;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .save-btn:hover {
        background: #5d4037;
        transform: translateY(-2px);
    }

    /* Result Styles */
    .final-score {
        text-align: center;
        margin-bottom: 20px;
    }

    .score-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #5d4037, #8b5e3c);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        border: 3px solid #3d2b1f;
    }

    .score-value {
        font-size: 2rem;
        font-weight: 800;
        color: white;
    }

    .score-max {
        font-size: 0.8rem;
        color: #f1f5f9;
    }

    .result-stats {
        background: rgba(93, 64, 55, 0.15);
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .result-stats p {
        color: #3d2b1f;
        margin: 8px 0;
    }

    .result-feedback {
        background: rgba(93, 64, 55, 0.1);
        padding: 15px;
        border-radius: 12px;
        border-left: 4px solid #5d4037;
        margin-bottom: 20px;
        color: #3a2a1a;
        line-height: 1.6;
    }

    .result-badges {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .result-badge {
        background: linear-gradient(135deg, #5d4037, #8b5e3c);
        padding: 10px;
        border-radius: 12px;
        text-align: center;
        color: white;
    }

    .badge-emoji {
        font-size: 1.5rem;
        display: block;
    }

    .badge-name {
        font-size: 0.7rem;
        font-weight: 600;
    }

    /* Scrollbar */
    .tab-contents::-webkit-scrollbar {
        width: 6px;
    }

    .tab-contents::-webkit-scrollbar-track {
        background: #3b2a1a;
        border-radius: 10px;
    }

    .tab-contents::-webkit-scrollbar-thumb {
        background: #5d4037;
        border-radius: 10px;
    }
</style>

<div class="performance-task-container">

    <!-- HEADER -->
    <header class="task-header">
        <h1>🎮 Gawain sa Pagganap: Hamon sa Paghahanda sa Sakuna</h1>
        <p class="subtitle">Tapusin ang misyon, kumita ng XP, magbukas ng mga badge, at bumuo ng plano ng kaligtasan ng pamilya.</p>
    </header>

    <!-- MISSION BANNER -->
    <div class="wooden-card mission-banner">
        <div class="mission-callout">
            <span class="mission-pill">BUOD NG MISYON</span>
            <h2>⚡ Misyon sa Pagtugon sa Sakuna</h2>
            <p>Ihanda ang iyong pamilya bago dumating ang bagyo. Bawat desisyon ay may katumbas na XP. Bawat seksyon na natapos ay may gantimpala.</p>
        </div>
        <div class="mission-objectives">
            <div class="objective-chip active">🎒 Bumuo ng Emergency Kit (kailangan: 5 gamit)</div>
            <div class="objective-chip active">🚪 Gumawa ng Plano sa Paglikas (kailangan: 5 tanong)</div>
            <div class="objective-chip active">📱 Siguraduhin ang Komunikasyon (kailangan: 5 tanong)</div>
            <div class="objective-chip active">🏠 Tukuyin ang Ligtas na Lugar (kailangan: 5 tanong)</div>
        </div>
    </div>

    <!-- STATS + PROGRESS -->
    <div class="wooden-card game-stats-bar">
        <div class="stat">
            <span class="label">🏆 ISKOR</span>
            <span class="value" id="totalScore">0</span>
        </div>
        <div class="stat">
            <span class="label">📊 PROGRESO</span>
            <span class="value" id="progressPercent">0%</span>
        </div>
        <div class="stat">
            <span class="label">⏱️ NATITIRANG ORAS</span>
            <span class="value" id="timeLeft">30:00</span>
        </div>
        <div class="stat">
            <span class="label">🎖️ MGA BADGE</span>
            <span class="value" id="badgeCount">0/5</span>
        </div>
    </div>

    <div class="progress-bar-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="game-content">
        <!-- SIDEBAR -->
        <aside class="scenario-sidebar">
            <div class="wooden-card scenario-card">
                <h3>📍 Iyong Sitwasyon</h3>
                <p>Ikaw ang pinuno ng isang pamilya sa lugar na madalas tamaan ng sakuna. May babala ng bagyo. Kailangan mong maghanda upang mailigtas ang iyong pamilya.</p>
            </div>

            <div class="wooden-card badges-earned">
                <h3>🏆 Mga Nakuhang Badge</h3>
                <div class="badges-list" id="badgesList"></div>
            </div>
        </aside>

        <!-- MAIN INTERFACE -->
        <main class="wooden-card planning-interface">
            <!-- TABS -->
            <div class="task-tabs">
                <button class="tab-btn active" data-tab="emergency-kit">
                    <span class="tab-icon">🎒</span>
                    <span class="tab-title">Emergency Kit</span>
                    <span class="tab-score" id="kit-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="evacuation-plan">
                    <span class="tab-icon">🚪</span>
                    <span class="tab-title">Plano sa Paglikas</span>
                    <span class="tab-score" id="evacuation-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="communication">
                    <span class="tab-icon">📱</span>
                    <span class="tab-title">Komunikasyon</span>
                    <span class="tab-score" id="communication-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="safe-areas">
                    <span class="tab-icon">🏠</span>
                    <span class="tab-title">Ligtas na Lugar</span>
                    <span class="tab-score" id="safe-score">0/25</span>
                </button>
            </div>

            <!-- TAB CONTENTS -->
            <div class="tab-contents">
                <!-- EMERGENCY KIT -->
                <section class="tab-content active" id="emergency-kit">
                    <div class="section-header">
                        <h3>🎒 Bumuo ng Iyong Emergency Kit</h3>
                        <p class="instructions">Pumili ng hindi bababa sa 5 mahahalagang gamit para sa iyong emergency kit. Bawat gamit ay 5 puntos.</p>
                    </div>
                    <div class="items-grid">
                        <div class="item-card" data-item="Tubig" data-points="5">
                            <div class="item-icon">💧</div>
                            <div class="item-name">Tubig</div>
                            <div class="item-info">1-2 litro bawat tao</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Pagkain" data-points="5">
                            <div class="item-icon">🥫</div>
                            <div class="item-name">Pagkaing Hindi Napapanis</div>
                            <div class="item-info">De-lata, biskwit</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="First Aid Kit" data-points="5">
                            <div class="item-icon">⚕️</div>
                            <div class="item-name">First Aid Kit</div>
                            <div class="item-info">Mga benda, gamot</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Flashlight" data-points="5">
                            <div class="item-icon">🔦</div>
                            <div class="item-name">Flashlight</div>
                            <div class="item-info">May ekstrang baterya</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Dokumento" data-points="5">
                            <div class="item-icon">📄</div>
                            <div class="item-name">Mahahalagang Dokumento</div>
                            <div class="item-info">Mga ID, papeles</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Pera" data-points="5">
                            <div class="item-icon">💵</div>
                            <div class="item-name">Pera at Card</div>
                            <div class="item-info">Para sa emerhensiya</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Radyo" data-points="5">
                            <div class="item-icon">📻</div>
                            <div class="item-name">Radyo/Charger</div>
                            <div class="item-info">Manatiling may impormasyon</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Baby Items" data-points="5">
                            <div class="item-icon">👶</div>
                            <div class="item-name">Gamit ng Sanggol</div>
                            <div class="item-info">Diaper, gatas</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="Pet Supplies" data-points="5">
                            <div class="item-icon">🐾</div>
                            <div class="item-name">Gamit ng Alagang Hayop</div>
                            <div class="item-info">Pagkain, tali</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                    </div>
                    <div class="selected-items">
                        <p>📦 Mga Napiling Gamit: <span id="kit-count">0</span>/5 (minimum)</p>
                        <div class="items-list" id="kitList"></div>
                    </div>
                </section>

                <!-- EVACUATION PLAN -->
                <section class="tab-content" id="evacuation-plan">
                    <div class="section-header">
                        <h3>🚪 Gumawa ng Plano sa Paglikas</h3>
                        <p class="instructions">Sagutin ang mga sumusunod na tanong tungkol sa iyong plano sa paglikas.</p>
                    </div>
                    <div class="questions-list" id="evacuation-questions"></div>
                </section>

                <!-- COMMUNICATION -->
                <section class="tab-content" id="communication">
                    <div class="section-header">
                        <h3>📱 Plano sa Komunikasyon</h3>
                        <p class="instructions">Ihanda ang paraan ng komunikasyon ng inyong pamilya.</p>
                    </div>
                    <div class="questions-list" id="communication-questions"></div>
                </section>

                <!-- SAFE AREAS -->
                <section class="tab-content" id="safe-areas">
                    <div class="section-header">
                        <h3>🏠 Tukuyin ang Ligtas na Lugar</h3>
                        <p class="instructions">Tukuyin ang mga ligtas na lugar sa inyong tahanan at komunidad.</p>
                    </div>
                    <div class="questions-list" id="safe-questions"></div>
                </section>

                <!-- SUBMIT -->
                <div class="submit-section">
                    <button class="submit-btn" id="submitBtn" disabled>📤 Ipasa ang Gawain</button>
                    <p class="submit-info" id="submitInfo">💡 Kumpletuhin ang lahat ng bahagi upang maipasa ang gawain!</p>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- RESULTS MODAL -->
<div class="modal" id="resultsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>🎉 Natapos ang Gawain!</h2>
        </div>
        <div class="modal-body">
            <div class="final-score">
                <div class="score-circle">
                    <div class="score-value" id="finalScore">0</div>
                    <div class="score-max">/100</div>
                </div>
            </div>
            <div class="result-stats">
                <p><strong>📊 Antas ng Pagkakumpleto:</strong> <span id="resultCompletion">0%</span></p>
                <p><strong>🎖️ Nakuhang Badge:</strong> <span id="resultBadges">0/5</span></p>
                <p><strong>⏱️ Oras na Ginamit:</strong> <span id="resultTime">0m 0s</span></p>
            </div>
            <div class="result-feedback" id="resultFeedback"></div>
            <div class="result-badges-section">
                <h4 style="color:#3d2b1f; margin-bottom:10px;">🏆 Mga Nakuhang Badge:</h4>
                <div class="result-badges" id="resultBadgesDisplay"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="save-btn" id="saveResultBtn">💾 I-save at Magpatuloy</button>
            <a href="{{ route('module3.buod') }}" class="save-btn">➡️ Pumunta sa Buod</a>
        </div>
    </div>
</div>

<!-- RUBRICS MODAL (First Time Only) -->
<div class="modal" id="rubricsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>📊 Rubrics sa Pagganap</h2>
        </div>
        <div class="modal-body">
            <img src="{{ asset('pictures/Module 3/mod3_rubrics.jpg') }}" alt="Module 3 Rubrics" style="width:100%; border-radius:12px;">
        </div>
        <div class="modal-footer">
            <button class="save-btn" onclick="closeRubrics()">✔ Naiintindihan ko, Simulan na!</button>
        </div>
    </div>
</div>

<script>
    // GAME STATE
    const gameState = {
        score: 0,
        selectedItems: [],
        answers: {},
        timeLeft: 1800,
        startTime: Date.now(),
        badges: [],
        completed: false
    };

    // BADGE DEFINITIONS
    const badgeDefinitions = {
        kitmaster: { name: 'Dalubhasa sa Kit', emoji: '🎒', condition: () => gameState.selectedItems.length >= 5 },
        evacuationexpert: { name: 'Eksperto sa Paglikas', emoji: '🚪', condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('evacuation')).length >= 5 },
        communicationpro: { name: 'Dalubhasa sa Komunikasyon', emoji: '📱', condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('communication')).length >= 5 },
        safehaven: { name: 'Ligtas na Kanlungan', emoji: '🏠', condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('safe')).length >= 5 },
        preparednessmaster: { name: 'Ganap na Handa', emoji: '🌟', condition: () => gameState.score >= 90 }
    };

    // QUESTION DATA
    const evacuationQuestions = [
        { text: "Saan ang iyong itinalagang lugar ng paglikas?", options: [
            { value: "school", text: "🏫 Pinakamalapit na paaralan/center ng komunidad", points: 5 },
            { value: "relative", text: "👥 Bahay ng kamag-anak sa mas mataas na lugar", points: 5 },
            { value: "unknown", text: "❓ Hindi ko pa alam", points: 0 }
        ] },
        { text: "Paano kayo makakarating doon?", options: [
            { value: "walk", text: "🚶 Nakaplano ang paglalakad na ruta", points: 5 },
            { value: "vehicle", text: "🚗 Handa ang sasakyan na may sapat na gasolina", points: 5 },
            { value: "unsure", text: "❓ Hindi pa napagdesisyunan", points: 0 }
        ] },
        { text: "Mayroon ka bang mapa ng ruta ng paglikas?", options: [
            { value: "yes", text: "✅ Oo, nakamarka sa mapa", points: 5 },
            { value: "planning", text: "📋 Nagpaplanong gumawa", points: 3 },
            { value: "no", text: "❌ Wala pa", points: 0 }
        ] },
        { text: "Sino ang mamumuno sa paglikas?", options: [
            { value: "designated", text: "👤 Itinalagang miyembro ng pamilya", points: 5 },
            { value: "unclear", text: "❓ Hindi pa napagdesisyunan", points: 0 }
        ] },
        { text: "Gaano katagal dapat ang paglikas?", options: [
            { value: "estimated", text: "⏱️ May tinatayang oras na nakalkula", points: 5 },
            { value: "unknown", text: "❓ Hindi pa nakalkula", points: 0 }
        ] }
    ];

    const communicationQuestions = [
        { text: "Mayroon ba kayong pangunahing taong kokontakin sa labas ng inyong lugar?", options: [
            { value: "yes", text: "✅ Oo, may itinalagang kontak", points: 5 },
            { value: "no", text: "❌ Wala", points: 0 }
        ] },
        { text: "Alam ba ng lahat ng miyembro ng pamilya ang numerong ito?", options: [
            { value: "yes", text: "✅ Oo, alam ng lahat", points: 5 },
            { value: "partial", text: "🟡 Ilan lamang", points: 3 },
            { value: "no", text: "❌ Hindi", points: 0 }
        ] },
        { text: "Paano kayo makikipag-ugnayan kung hindi gumagana ang mga telepono?", options: [
            { value: "planned", text: "📍 May nakaplanong tagpuan o radyo", points: 5 },
            { value: "unsure", text: "❓ Hindi pa napag-isipan", points: 0 }
        ] },
        { text: "Mayroon ba kayong nakasulat na listahan ng emergency contacts?", options: [
            { value: "yes", text: "✅ Nakasulat at naipamahagi", points: 5 },
            { value: "phone", text: "📱 Nasa telepono lamang", points: 3 },
            { value: "no", text: "❌ Wala", points: 0 }
        ] },
        { text: "Gaano kadalas ninyo nire-review ang inyong plano sa komunikasyon?", options: [
            { value: "monthly", text: "🔄 Buwan-buwan o regular", points: 5 },
            { value: "rarely", text: "❓ Bihira o hindi kailanman", points: 0 }
        ] }
    ];

    const safeQuestions = [
        { text: "Saan ang pinakaligtas na silid sa inyong tahanan?", options: [
            { value: "interior", text: "🛡️ Loob na silid na malayo sa bintana", points: 5 },
            { value: "basement", text: "🏚️ Basement/pinakamababang bahagi", points: 5 },
            { value: "unknown", text: "❓ Hindi pa natutukoy", points: 0 }
        ] },
        { text: "Ang inyong bahay ba ay malayo sa mga lugar na madaling bahain?", options: [
            { value: "yes", text: "✅ Nasa mataas na lugar, ligtas sa baha", points: 5 },
            { value: "partial", text: "🟡 Bahagyang nanganganib", points: 3 },
            { value: "risk", text: "⚠️ Lugar na madaling bahain", points: 0 }
        ] },
        { text: "Alam mo ba kung saan matatagpuan ang mga pampublikong evacuation center?", options: [
            { value: "yes", text: "✅ Oo, napuntahan at natukoy na", points: 5 },
            { value: "vague", text: "🟡 May kaunting ideya sa lokasyon", points: 3 },
            { value: "no", text: "❌ Hindi alam", points: 0 }
        ] },
        { text: "Mayroon bang ligtas na lugar para sa mga alagang hayop tuwing sakuna?", options: [
            { value: "yes", text: "✅ Oo, may itinalagang lugar", points: 5 },
            { value: "flexible", text: "🟡 Maaaring makahanap ng pansamantalang matutuluyan", points: 3 },
            { value: "no", text: "❌ Wala pang plano", points: 0 }
        ] },
        { text: "Nasubukan na ba ninyong pumunta sa inyong ligtas na lugar?", options: [
            { value: "yes", text: "✅ Oo, regular na isinasagawa", points: 5 },
            { value: "once", text: "🟡 Isa o dalawang beses pa lamang", points: 3 },
            { value: "no", text: "❌ Hindi pa nasusubukan", points: 0 }
        ] }
    ];

    // GENERATE QUESTION HTML
    function generateQuestions(containerId, questions, prefix) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        questions.forEach((q, idx) => {
            const qNum = idx + 1;
            const qCard = document.createElement('div');
            qCard.className = 'question-card';
            qCard.innerHTML = `
                <div class="question-num">${qNum}.</div>
                <div class="question-content">
                    <p class="question-text">${q.text}</p>
                    <div class="answer-options" data-prefix="${prefix}" data-qidx="${qNum}">
                        ${q.options.map(opt => `
                            <label class="option-label">
                                <input type="radio" name="${prefix}-${qNum}" value="${opt.value}" data-points="${opt.points}">
                                <span class="option-text">${opt.text}</span>
                            </label>
                        `).join('')}
                    </div>
                </div>
            `;
            container.appendChild(qCard);
        });
    }

    // INITIALIZE GAME
    document.addEventListener('DOMContentLoaded', function() {
        generateQuestions('evacuation-questions', evacuationQuestions, 'evacuation');
        generateQuestions('communication-questions', communicationQuestions, 'communication');
        generateQuestions('safe-questions', safeQuestions, 'safe');

        setupTabNavigation();
        setupItemSelection();
        setupRadioButtons();
        setupTimer();
        updateScore();
        updateSubmitButton();
    });

    // TAB NAVIGATION
    function setupTabNavigation() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.dataset.tab;
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    }

    // ITEM SELECTION
    function setupItemSelection() {
        const itemCards = document.querySelectorAll('.item-card');
        itemCards.forEach(card => {
            card.addEventListener('click', function() {
                const item = this.dataset.item;
                const points = parseInt(this.dataset.points);
                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    gameState.selectedItems = gameState.selectedItems.filter(i => i.item !== item);
                    gameState.score -= points;
                } else {
                    this.classList.add('selected');
                    gameState.selectedItems.push({ item, points });
                    gameState.score += points;
                }
                updateItemsList();
                updateScore();
            });
        });
    }

    // UPDATE ITEMS LIST
    function updateItemsList() {
        const listContainer = document.getElementById('kitList');
        const countSpan = document.getElementById('kit-count');
        const scoreSpan = document.getElementById('kit-score');
        listContainer.innerHTML = '';
        gameState.selectedItems.forEach(item => {
            const tag = document.createElement('div');
            tag.className = 'item-tag';
            tag.innerHTML = `${item.item} ✕`;
            tag.addEventListener('click', () => {
                const card = document.querySelector(`.item-card[data-item="${item.item}"]`);
                card.click();
            });
            listContainer.appendChild(tag);
        });
        countSpan.textContent = gameState.selectedItems.length;
        const kitPoints = gameState.selectedItems.reduce((sum, item) => sum + item.points, 0);
        scoreSpan.textContent = `${kitPoints}/25`;
    }

    // RADIO BUTTONS
    function setupRadioButtons() {
        document.addEventListener('change', function(e) {
            if (e.target && e.target.type === 'radio') {
                const name = e.target.name;
                const points = parseInt(e.target.dataset.points);
                if (gameState.answers[name]) {
                    gameState.score -= gameState.answers[name];
                }
                gameState.answers[name] = points;
                gameState.score += points;
                updateScore();
                updateTabScores();
            }
        });
    }

    // UPDATE TAB SCORES
    function updateTabScores() {
        const prefixes = ['evacuation', 'communication', 'safe'];
        prefixes.forEach(prefix => {
            let total = 0;
            for (let i = 1; i <= 5; i++) {
                const checked = document.querySelector(`input[name="${prefix}-${i}"]:checked`);
                if (checked) total += parseInt(checked.dataset.points);
            }
            const scoreSpan = document.getElementById(`${prefix}-score`);
            if (scoreSpan) scoreSpan.textContent = `${total}/25`;
        });
    }

    // UPDATE SCORE
    function updateScore() {
        document.getElementById('totalScore').textContent = gameState.score;
        const maxScore = 100;
        const progressPercent = Math.min(100, Math.round((gameState.score / maxScore) * 100));
        document.getElementById('progressPercent').textContent = progressPercent + '%';
        document.getElementById('progressBar').style.width = progressPercent + '%';
        updateBadges();
        updateSubmitButton();
    }

    // UPDATE BADGES
    function updateBadges() {
        const badgesList = document.getElementById('badgesList');
        const badgeCount = document.getElementById('badgeCount');
        const earnedBadges = [];
        for (const [key, badge] of Object.entries(badgeDefinitions)) {
            if (badge.condition()) {
                if (!gameState.badges.includes(key)) gameState.badges.push(key);
                earnedBadges.push(key);
            }
        }
        badgesList.innerHTML = '';
        for (const [key, badge] of Object.entries(badgeDefinitions)) {
            const badgeDiv = document.createElement('div');
            badgeDiv.className = 'badge-item';
            if (earnedBadges.includes(key)) badgeDiv.classList.add('earned');
            badgeDiv.innerHTML = `<div class="emoji">${badge.emoji}</div><div class="name">${badge.name}</div>`;
            badgesList.appendChild(badgeDiv);
        }
        badgeCount.textContent = earnedBadges.length + '/5';
    }

    // UPDATE SUBMIT BUTTON
    function updateSubmitButton() {
        const submitBtn = document.getElementById('submitBtn');
        const kitComplete = gameState.selectedItems.length >= 5;
        const evacuationComplete = Object.keys(gameState.answers).filter(k => k.startsWith('evacuation')).length >= 5;
        const communicationComplete = Object.keys(gameState.answers).filter(k => k.startsWith('communication')).length >= 5;
        const safeComplete = Object.keys(gameState.answers).filter(k => k.startsWith('safe')).length >= 5;
        const infoText = document.getElementById('submitInfo');
        if (kitComplete && evacuationComplete && communicationComplete && safeComplete) {
            submitBtn.disabled = false;
            infoText.innerHTML = '✅ Handa na ang iyong plano! I-click ang "Ipasa ang Gawain" upang matapos.';
        } else {
            submitBtn.disabled = true;
            let missing = [];
            if (!kitComplete) missing.push('🎒 Emergency Kit (kailangan ng 5 gamit)');
            if (!evacuationComplete) missing.push('🚪 Plano sa Paglikas');
            if (!communicationComplete) missing.push('📱 Plano sa Komunikasyon');
            if (!safeComplete) missing.push('🏠 Ligtas na Lugar');
            infoText.innerHTML = `💡 Kailangan mong kumpletuhin ang: ${missing.join(', ')}`;
        }
    }

    // TIMER
    function setupTimer() {
        setInterval(() => {
            if (gameState.timeLeft <= 0) {
                submitTask(true);
                return;
            }
            gameState.timeLeft--;
            const minutes = Math.floor(gameState.timeLeft / 60);
            const seconds = gameState.timeLeft % 60;
            document.getElementById('timeLeft').textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            if (gameState.timeLeft === 300) alert('⚠️ 5 minuto na lang ang natitira!');
            if (gameState.timeLeft === 60) alert('⚠️ 1 minuto na lang ang natitira!');
        }, 1000);
    }

    // SUBMIT TASK
    document.getElementById('submitBtn').addEventListener('click', () => submitTask(false));

    function submitTask(isTimeout) {
        if (!isTimeout && document.getElementById('submitBtn').disabled) return;
        gameState.completed = true;
        const modal = document.getElementById('resultsModal');
        const timeTaken = Math.floor((Date.now() - gameState.startTime) / 1000);
        const minutes = Math.floor(timeTaken / 60);
        const seconds = timeTaken % 60;
        document.getElementById('finalScore').textContent = gameState.score;
        document.getElementById('resultCompletion').textContent = Math.min(100, Math.round((gameState.score / 100) * 100)) + '%';
        document.getElementById('resultBadges').textContent = gameState.badges.length + '/5';
        document.getElementById('resultTime').textContent = minutes + 'm ' + seconds + 's';
        let feedback = '';
        if (gameState.score >= 90) feedback = '🌟 Napakahusay! Ang iyong plano ay kumpleto at pinag-isipang mabuti!';
        else if (gameState.score >= 75) feedback = '👍 Magaling! Saklaw ng iyong plano ang mahahalagang bahagi.';
        else if (gameState.score >= 60) feedback = '📋 Magandang simula! Suriin ang mga bahaging nakaligtaan.';
        else feedback = '💡 Nagsisimula ka pa lamang. Kumpletuhin ang lahat ng bahagi para sa ganap na kaligtasan.';
        document.getElementById('resultFeedback').textContent = feedback;
        const badgesDisplay = document.getElementById('resultBadgesDisplay');
        badgesDisplay.innerHTML = '';
        gameState.badges.forEach(badgeKey => {
            const badge = badgeDefinitions[badgeKey];
            const badgeDiv = document.createElement('div');
            badgeDiv.className = 'result-badge';
            badgeDiv.innerHTML = `<div class="badge-emoji">${badge.emoji}</div><div class="badge-name">${badge.name}</div>`;
            badgesDisplay.appendChild(badgeDiv);
        });
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // SAVE RESULT
    document.getElementById('saveResultBtn').addEventListener('click', function() {
        const getSectionScore = (prefix) => {
            let total = 0;
            Object.keys(gameState.answers).forEach(key => {
                if (key.startsWith(prefix)) total += gameState.answers[key];
            });
            return total;
        };
        const kitScore = gameState.selectedItems.reduce((sum, item) => sum + item.points, 0);
        const timeTaken = Math.floor((Date.now() - gameState.startTime) / 1000);
        fetch("{{ route('student.module3.performance-task.store') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: JSON.stringify({
                score: gameState.score,
                badges: gameState.badges,
                completionTime: timeTaken,
                selectedItems: gameState.selectedItems,
                answers: gameState.answers,
                kitScore: kitScore,
                evacuationScore: getSectionScore('evacuation'),
                communicationScore: getSectionScore('communication'),
                safeScore: getSectionScore('safe')
            })
        })
        .then(res => res.json())
        .then(data => {
            alert('✅ Na-save ang iyong Performance Task! Score: ' + gameState.score + '/100');
            document.getElementById('resultsModal').classList.remove('show');
            document.body.style.overflow = '';
            window.location.href = "{{ route('module3.buod') }}";
        })
        .catch(err => console.error(err));
    });

    // RUBRICS MODAL
    document.addEventListener("DOMContentLoaded", function() {
        if (!sessionStorage.getItem("module3RubricsShown")) {
            const modal = document.getElementById("rubricsModal");
            modal.classList.add("show");
            document.body.style.overflow = 'hidden';
            sessionStorage.setItem("module3RubricsShown", "true");
        }
    });

    function closeRubrics() {
        document.getElementById("rubricsModal").classList.remove("show");
        document.body.style.overflow = '';
    }
</script>

@endsection