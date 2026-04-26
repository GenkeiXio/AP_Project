@extends('Students.studentslayout')

@section('content')
    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== BACKGROUND ===== */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Lexend', sans-serif;
            background-image: url("{{ asset('pictures/mod3_innermap.png') }}");
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        /* DARK OVERLAY */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: -1;
        }

        body.modal-open::before {
            opacity: 0;
            /* disable background dark layer when modal is open */
        }

        /* ===== MAIN CONTAINER ===== */
        .performance-task-container {
            min-height: 100vh;
            padding: 40px 50px;
            background: transparent;
        }

        /* ===== GLASS CARD ===== */
        /* ===== CLEAN WHITE CARDS ===== */
        .card,
        .mission-banner,
        .game-stats-bar,
        .scenario-card,
        .badges-earned,
        .planning-interface {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            color: #333;

            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .planning-interface {
            height: 75vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ===== HEADER ===== */
        .task-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .task-header h1 {
            font-family: 'Bungee', cursive;
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: #ffffff;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        .subtitle {
            opacity: 0.9;
            color: #ffffff;
        }

        /* ===== MISSION ===== */
        .mission-banner {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            padding: 25px 28px;
            /* more breathing space */
            margin-bottom: 25px;
            gap: 30px;
            /* more separation between left & right */
            align-items: center;
        }

        /* LEFT SIDE */
        .mission-callout {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mission-pill {
            align-self: flex-start;
            /* prevents stretching */
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .mission-callout h2 {
            color: #4caf50;
            font-size: 1.5rem;
            line-height: 1.3;
        }

        .mission-callout p {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.5;
            max-width: 90%;
        }

        /* RIGHT SIDE (OBJECTIVES) */
        .mission-objectives {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .objective-chip {
            background: #f5f5f5;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.85rem;

            display: flex;
            align-items: center;
            gap: 8px;

            transition: 0.2s ease;
        }

        .objective-chip.active {
            background: rgba(76, 175, 80, 0.15);
            border: 1px solid #4caf50;
        }

        /* ===== STATS ===== */
        .game-stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            padding: 15px;
            margin-bottom: 15px;
            gap: 15px;
        }

        .stat {
            background: #f5f5f5;
            padding: 12px;
            border-radius: 12px;
        }

        .stat .value {
            color: #4caf50;
            font-weight: bold;
        }

        /* ===== PROGRESS ===== */
        .progress-bar-container {
            height: 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.2);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4caf50, #00e676);
            transition: width 0.3s ease;
        }

        /* ===== LAYOUT ===== */
        .game-content {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 20px;
            align-items: start;
        }

        /* ===== SIDEBAR ===== */
        .scenario-card,
        .badges-earned {
            padding: 18px;
        }

        .badges-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .badge-item {
            background: #f5f5f5;
            opacity: 1;
            color: #333;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            font-size: 0.85rem;
        }

        .badge-item.earned {
            opacity: 1;
            background: linear-gradient(135deg, #ffd700, #ff9800);
            color: #000;
        }

        /* ===== TABS ===== */
        .task-tabs {
            display: flex;
            gap: 10px;
            padding: 10px;
            border-radius: 14px;
            background: #f1f3f5;
            margin-bottom: 10px;
            flex-shrink: 0;
            /* position: sticky; */
            top: 0;
            z-index: 1;
        }


        .tab-btn {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            background: transparent;
            border: none;
            transition: 0.2s ease;
            display: flex;
            flex-direction: column;
            gap: 2px;
            font-size: 0.85rem;
        }

        .tab-btn:hover {
            background: #e8f5e9;
        }

        .tab-btn.active {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-bottom: none;
        }

        /* ===== CONTENT ===== */
        .tab-contents {
            padding: 30px 35px;
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
            flex: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .instructions {
            background: #f9f9f9;
            color: #333;
        }

        /* ===== ITEMS ===== */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 18px;
            margin-top: 10px;
        }

        .item-card {
            min-height: 110px;
            padding: 12px;
            border-radius: 14px;
            border: 1px solid #e5e5e5;
            transition: 0.25s ease;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.12);
        }

        .item-card.selected {
            background: #e8f5e9;
            border: 2px solid #4caf50;
        }

        .item-icon {
            font-size: 22px;
        }

        .item-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .item-info {
            font-size: 0.75rem;
            color: #777;
        }

        .item-points {
            font-size: 0.75rem;
            color: #4caf50;
            font-weight: bold;
            margin-top: auto;
        }

        .selected-items {
            margin-top: 20px;
            padding: 15px;
            border-radius: 12px;
            background: #f9fafb;
        }

        .items-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .item-tag {
            background: #e8f5e9;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
            cursor: pointer;
        }

        /* ===== QUESTIONS ===== */
        .question-card {
            background: #ffffff;
            color: #333;
            border: 1px solid #ddd;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e5e5;
            display: flex;
            gap: 12px;
        }

        .question-text {
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        /* ===== BUTTONS ===== */
        .submit-btn,
        .save-btn {
            background: linear-gradient(135deg, #4caf50, #00e676);
            border: none;
            padding: 12px 24px;
            border-radius: 999px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover,
        .save-btn:hover {
            transform: translateY(-2px);
        }

        /* ===== MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            /* lighter overlay */
            backdrop-filter: blur(4px);

            z-index: 9999;
            /* FORCE ABOVE EVERYTHING */
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            width: 90%;
            max-width: 800px;
            max-height: 90vh;

            background: #ffffff;
            /* instead of #111 */
            border-radius: 20px;
            padding: 25px;

            display: flex;
            flex-direction: column;
            gap: 20px;

            overflow: hidden;
        }

        /* Scroll only body */
        .modal-body {
            overflow-y: auto;
            padding-right: 8px;
        }

        /* Header */
        .modal-header h2 {
            text-align: center;
            font-size: 1.6rem;
        }


        /* ===== RESULT ===== */
        /* Stats spacing */
        .result-stats {
            background: #f0f0f0;
            padding: 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Feedback */
        .result-feedback {
            background: rgba(76, 175, 80, 0.2);
            border-left: 4px solid #4caf50;
            padding: 12px;
            border-radius: 10px;
            font-size: 0.95rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .game-content {
                grid-template-columns: 1fr;
            }

            .mission-banner {
                grid-template-columns: 1fr;
            }

            .task-tabs {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Badges */
        .result-badges {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .result-badge {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            font-size: 0.85rem;
        }

        .badge-emoji {
            font-size: 20px;
        }

        /* Footer buttons */
        .modal-footer {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }



        .section-header {
            margin-bottom: 20px;
        }

        .section-header h3 {
            margin-bottom: 6px;
        }

        .questions-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .question-num {
            font-weight: bold;
            color: #4caf50;
        }

        .option-label {
            display: block;
            padding: 4px 8px;
            font-size: 0.85rem;
            border-radius: 8px;
            transition: 0.2s;
            cursor: pointer;
        }

        .option-label:hover {
            background: #f1f3f5;
        }

        .scenario-sidebar {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .scenario-card,
        .badges-earned {
            padding: 20px;
        }

        .submit-section {
            margin-top: 25px;
            text-align: center;
        }

        .submit-info {
            margin-top: 8px;
            font-size: 0.85rem;
            color: #666;
        }

        /* Smooth scrollbar */
        .tab-content::-webkit-scrollbar {
            width: 6px;
        }

        .tab-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Score circle centered */
        .final-score {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .score-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4caf50, #00e676);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
        }

        .score-value {
            font-size: 1.8rem;
        }

        .score-max {
            font-size: 0.8rem;
        }
    </style>

    <div class="performance-task-container">

        <!-- ================= HEADER ================= -->
        <header class="task-header">
            <h1>🎮 Gawain sa Pagganap: Hamon sa Paghahanda sa Sakuna</h1>
            <p class="subtitle">
                Tapusin ang misyon, kumita ng <i>XP</i>, magbukas ng mga <i>badge</i>, at bumuo ng plano ng kaligtasan ng
                pamilya.
            </p>
        </header>

        <!-- ================= MISSION ================= -->
        <section class="mission-banner">
            <div class="mission-callout">
                <span class="mission-pill">BUOD NG MISYON</span>
                <h2>⚡ Misyon sa Pagtugon sa Sakuna</h2>
                <p>
                    Ihanda ang iyong pamilya bago dumating ang bagyo. Bawat desisyon ay may katumbas na XP.
                    Bawat seksyon na natapos ay may gantimpala.
                </p>
            </div>

            <div class="mission-objectives">
                <div class="objective-chip active">🎒 Bumuo ng Emergency Kit</div>
                <div class="objective-chip active">🚪 Gumawa ng Plano sa Paglikas</div>
                <div class="objective-chip active">📱 Siguraduhin ang Komunikasyon</div>
                <div class="objective-chip active">🏠 Tukuyin ang Ligtas na Lugar</div>
            </div>
        </section>

        <!-- ================= STATS + PROGRESS ================= -->
        <section class="stats-section">

            <div class="game-stats-bar">
                <div class="stat">
                    <span class="label">Iskor</span>
                    <span class="value" id="totalScore">0</span>
                </div>

                <div class="stat">
                    <span class="label">Progreso</span>
                    <span class="value" id="progressPercent">0%</span>
                </div>

                <div class="stat">
                    <span class="label">Natitirang Oras</span>
                    <span class="value" id="timeLeft">30:00</span>
                </div>

                <div class="stat">
                    <span class="label">Mga <i>Badge</i></span>
                    <span class="value" id="badgeCount">0/5</span>
                </div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>

        </section>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="game-content">
            <!-- ===== SIDEBAR ===== -->
            <aside class="scenario-sidebar">

                <div class="scenario-card">
                    <h3>📍 Iyong Sitwasyon</h3>
                    <p>
                        Ikaw ang pinuno ng isang pamilya sa lugar na madalas tamaan ng sakuna.
                        May babala ng bagyo...
                    </p>
                </div>

                <div class="badges-earned">
                    <h3>🏆 <i>Badges Earned</i></h3>
                    <div class="badges-list" id="badgesList"></div>
                </div>

            </aside>

            <!-- ===== MAIN INTERFACE ===== -->
            <main class="planning-interface">
                <!-- ---------- TABS ---------- -->
                <div class="task-tabs">

                    <button class="tab-btn active" data-tab="emergency-kit">
                        <span class="tab-icon">🎒</span>
                        <span class="tab-title"><i>Emergency Kit</i></span>
                        <span class="tab-score" id="kit-score">0/25</span>
                    </button>

                    <button class="tab-btn" data-tab="evacuation-plan">
                        <span class="tab-icon">🚪</span>
                        <span class="tab-title"><i>Plano sa Paglikas</i></span>
                        <span class="tab-score" id="evacuation-score">0/25</span>
                    </button>

                    <button class="tab-btn" data-tab="communication">
                        <span class="tab-icon">📱</span>
                        <span class="tab-title">Komunikasyon</span>
                        <span class="tab-score" id="communication-score">0/25</span>
                    </button>

                    <button class="tab-btn" data-tab="safe-areas">
                        <span class="tab-icon">🏠</span>
                        <span class="tab-title">Mga Ligtas na Lugar</span>
                        <span class="tab-score" id="safe-score">0/25</span>
                    </button>

                </div>

                <!-- ---------- TAB CONTENT ---------- -->
                <div class="tab-contents">

                    <!-- ===== EMERGENCY KIT ===== -->
                    <section class="tab-content active" id="emergency-kit">

                        <div class="section-header">
                            <h3>🎒 Bumuo ng Iyong Emergency Kit</h3>
                            <p class="instructions">
                                Pumili ng hindi bababa sa 5 mahahalagang gamit para sa iyong emergency kit.
                            </p>
                        </div>

                        <div class="items-grid">
                            <div class="item-card" data-item="water" data-points="5">
                                <div class="item-icon">💧</div>
                                <div class="item-name">Tubig</div>
                                <div class="item-info">1-2 litro bawat tao</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="food" data-points="5">
                                <div class="item-icon">🥫</div>
                                <div class="item-name">Pagkaing Hindi Napapanis</div>
                                <div class="item-info">De-lata, biskwit</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="medical" data-points="5">
                                <div class="item-icon">⚕️</div>
                                <div class="item-name"><i>First Aid Kit</i></div>
                                <div class="item-info">Mga benda, gamot</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="flashlight" data-points="5">
                                <div class="item-icon">🔦</div>
                                <div class="item-name"><i>Flashlight</i></div>
                                <div class="item-info">May ekstrang baterya</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="documents" data-points="5">
                                <div class="item-icon">📄</div>
                                <div class="item-name">Mahahalagang Dokumento</div>
                                <div class="item-info">Mga ID, papeles ng insurance</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="cash" data-points="5">
                                <div class="item-icon">💵</div>
                                <div class="item-name">Pera at Card</div>
                                <div class="item-info">Para sa emerhensiya</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="radio" data-points="5">
                                <div class="item-icon">📻</div>
                                <div class="item-name">Radyo/Charger ng Telepono</div>
                                <div class="item-info">Manatiling may impormasyon</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="baby-items" data-points="5">
                                <div class="item-icon">👶</div>
                                <div class="item-name">Gamit ng Sanggol</div>
                                <div class="item-info">Diaper, gatas</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                            <div class="item-card" data-item="pet-supplies" data-points="5">
                                <div class="item-icon">🐾</div>
                                <div class="item-name">Gamit ng Alagang Hayop</div>
                                <div class="item-info">Pagkain, tali</div>
                                <div class="item-points">+5 pts</div>
                            </div>
                        </div>

                        <div class="selected-items">
                            <p>Mga Napiling Gamit: <span id="kit-count">0</span>/5</p>
                            <div class="items-list" id="kitList"></div>
                        </div>

                    </section>

                    <!-- ===== EVACUATION ===== -->
                    <section class="tab-content" id="evacuation-plan">

                        <div class="section-header">
                            <h3>🚪 Gumawa ng Plano sa Paglikas</h3>
                            <p class="instructions">
                                Sagutin ang mga sumusunod na tanong tungkol sa iyong plano sa paglikas.
                            </p>
                        </div>

                        <div class="questions-list">
                            <div class="question-card">
                                <div class="question-num">1.</div>
                                <div class="question-content">
                                    <p class="question-text">Saan ang iyong itinalagang lugar ng paglikas?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-1" value="school" data-points="5">
                                            <span class="option-text">🏫 Pinakamalapit na paaralan/center ng
                                                komunidad</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-1" value="relative" data-points="5">
                                            <span class="option-text">👥 Bahay ng kamag-anak sa mas mataas na lugar</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-1" value="unknown" data-points="0">
                                            <span class="option-text">❓ Hindi ko pa alam</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">2.</div>
                                <div class="question-content">
                                    <p class="question-text">Paano kayo makakarating doon?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-2" value="walk" data-points="5">
                                            <span class="option-text">🚶 Nakaplano ang paglalakad na ruta</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-2" value="vehicle" data-points="5">
                                            <span class="option-text">🚗 Handa ang sasakyan na may sapat na gasolina</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-2" value="unsure" data-points="0">
                                            <span class="option-text">❓ Hindi pa napagdesisyunan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">3.</div>
                                <div class="question-content">
                                    <p class="question-text">Mayroon ka bang mapa ng ruta ng paglikas?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-3" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, nakamarka sa mapa</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-3" value="planning" data-points="3">
                                            <span class="option-text">📋 Nagpaplanong gumawa</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-3" value="no" data-points="0">
                                            <span class="option-text">❌ Wala pa</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">4.</div>
                                <div class="question-content">
                                    <p class="question-text">Sino ang mamumuno sa paglikas?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-4" value="designated" data-points="5">
                                            <span class="option-text">👤 Itinalagang miyembro ng pamilya</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-4" value="unclear" data-points="0">
                                            <span class="option-text">❓ Hindi pa napagdesisyunan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">5.</div>
                                <div class="question-content">
                                    <p class="question-text">Gaano katagal dapat ang paglikas?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-5" value="estimated" data-points="5">
                                            <span class="option-text">⏱️ May tinatayang oras na nakalkula</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="evacuation-5" value="unknown" data-points="0">
                                            <span class="option-text">❓ Hindi pa nakalkula</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ===== COMMUNICATION ===== -->
                    <section class="tab-content" id="communication">

                        <div class="section-header">
                            <h3>📱 Plano sa Komunikasyon</h3>
                            <p class="instructions">
                                Ihanda ang paraan ng komunikasyon ng inyong pamilya.
                            </p>
                        </div>

                        <div class="questions-list">
                            <div class="question-card">
                                <div class="question-num">1.</div>
                                <div class="question-content">
                                    <p class="question-text">Mayroon ba kayong pangunahing taong kokontakin sa labas ng
                                        inyong lugar?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="communication-1" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, may itinalagang kontak</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-1" value="no" data-points="0">
                                            <span class="option-text">❌ Wala</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">2.</div>
                                <div class="question-content">
                                    <p class="question-text">Alam ba ng lahat ng miyembro ng pamilya ang numerong ito?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="communication-2" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, alam ng lahat</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-2" value="partial" data-points="3">
                                            <span class="option-text">🟡 Ilan lamang</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-2" value="no" data-points="0">
                                            <span class="option-text">❌ Hindi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">3.</div>
                                <div class="question-content">
                                    <p class="question-text">Paano kayo makikipag-ugnayan kung hindi gumagana ang mga
                                        telepono?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="communication-3" value="planned" data-points="5">
                                            <span class="option-text">📍 May nakaplanong tagpuan o radyo</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-3" value="unsure" data-points="0">
                                            <span class="option-text">❓ Hindi pa napag-isipan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">4.</div>
                                <div class="question-content">
                                    <p class="question-text">Mayroon ba kayong nakasulat na listahan ng emergency contacts?
                                    </p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="communication-4" value="yes" data-points="5">
                                            <span class="option-text">✅ Nakasulat at naipamahagi</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-4" value="phone" data-points="3">
                                            <span class="option-text">📱 Nasa telepono lamang</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-4" value="no" data-points="0">
                                            <span class="option-text">❌ Wala</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">5.</div>
                                <div class="question-content">
                                    <p class="question-text">Gaano kadalas ninyo nire-review ang inyong plano sa
                                        komunikasyon?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="communication-5" value="monthly" data-points="5">
                                            <span class="option-text">🔄 Buwan-buwan o regular</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="communication-5" value="rarely" data-points="0">
                                            <span class="option-text">❓ Bihira o hindi kailanman</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ===== SAFE AREAS ===== -->
                    <section class="tab-content" id="safe-areas">

                        <div class="section-header">
                            <h3>🏠 Tukuyin ang Ligtas na Lugar</h3>
                            <p class="instructions">
                                Tukuyin ang mga ligtas na lugar sa inyong tahanan at komunidad.
                            </p>
                        </div>

                        <div class="questions-list">
                            <div class="question-card">
                                <div class="question-num">1.</div>
                                <div class="question-content">
                                    <p class="question-text">Saan ang pinakaligtas na silid sa inyong tahanan?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="safe-1" value="interior" data-points="5">
                                            <span class="option-text">🛡️ Loob na silid na malayo sa bintana</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-1" value="basement" data-points="5">
                                            <span class="option-text">🏚️ Basement/pinakamababang bahagi</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-1" value="unknown" data-points="0">
                                            <span class="option-text">❓ Hindi pa natutukoy</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">2.</div>
                                <div class="question-content">
                                    <p class="question-text">Ang inyong bahay ba ay malayo sa mga lugar na madaling bahain?
                                    </p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="safe-2" value="yes" data-points="5">
                                            <span class="option-text">✅ Nasa mataas na lugar, ligtas sa baha</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-2" value="partial" data-points="3">
                                            <span class="option-text">🟡 Bahagyang nanganganib</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-2" value="risk" data-points="0">
                                            <span class="option-text">⚠️ Lugar na madaling bahain</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">3.</div>
                                <div class="question-content">
                                    <p class="question-text">Alam mo ba kung saan matatagpuan ang mga pampublikong
                                        evacuation center?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="safe-3" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, napuntahan at natukoy na</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-3" value="vague" data-points="3">
                                            <span class="option-text">🟡 May kaunting ideya sa lokasyon</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-3" value="no" data-points="0">
                                            <span class="option-text">❌ Hindi alam</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">4.</div>
                                <div class="question-content">
                                    <p class="question-text">Mayroon bang ligtas na lugar para sa mga alagang hayop tuwing
                                        sakuna?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="safe-4" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, may itinalagang lugar</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-4" value="flexible" data-points="3">
                                            <span class="option-text">🟡 Maaaring makahanap ng pansamantalang
                                                matutuluyan</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-4" value="no" data-points="0">
                                            <span class="option-text">❌ Wala pang plano</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="question-card">
                                <div class="question-num">5.</div>
                                <div class="question-content">
                                    <p class="question-text">Nasubukan na ba ninyong pumunta sa inyong ligtas na lugar?</p>
                                    <div class="answer-options">
                                        <label class="option-label">
                                            <input type="radio" name="safe-5" value="yes" data-points="5">
                                            <span class="option-text">✅ Oo, regular na isinasagawa</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-5" value="once" data-points="3">
                                            <span class="option-text">🟡 Isa o dalawang beses pa lamang</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="safe-5" value="no" data-points="0">
                                            <span class="option-text">❌ Hindi pa nasusubukan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="submit-section">
                        <button class="submit-btn" id="submitBtn">
                            📤 Ipasa ang Gawain
                        </button>
                        <p class="submit-info">
                            Kumpletuhin ang lahat ng bahagi upang maipasa ang gawain!
                        </p>
                    </div>

                </div>
            </main>
        </div>

        <!-- ================= MODALS ================= -->

        <!-- RESULTS -->
        <div class="modal" id="resultsModal">
            <div class="modal-content">

                <header class="modal-header">
                    <h2>🎉 Natapos ang Gawain!</h2>
                </header>

                <div class="modal-body">

                    <div class="final-score">
                        <div class="score-circle">
                            <div class="score-value" id="finalScore">0</div>
                            <div class="score-max">/100</div>
                        </div>
                    </div>

                    <div class="result-stats">
                        <p><strong>Antas ng Pagkakumpleto:</strong> <span id="resultCompletion">0%</span></p>
                        <p><strong>Nakuhang Badge:</strong> <span id="resultBadges">0/5</span></p>
                        <p><strong>Oras na Ginamit:</strong> <span id="resultTime">0m 0s</span></p>
                    </div>

                    <div class="result-feedback" id="resultFeedback"></div>

                    <div class="result-badges-section">
                        <h4>🏆 Mga Nakuhang Badge:</h4>
                        <div class="result-badges" id="resultBadgesDisplay"></div>
                    </div>

                </div>

                <footer class="modal-footer">
                    <button class="save-btn" id="saveResultBtn">💾 I-save at Magpatuloy</button>
                    <a href="{{ route('module3.buod') }}" class="save-btn">➡️ Pumunta sa Buod</a>
                </footer>

            </div>
        </div>

        <!-- RUBRICS -->
        <div class="modal" id="rubricsModal">
            <div class="modal-content">

                <header class="modal-header">
                    <h2>📊 Rubrics</h2>
                </header>

                <div class="modal-body">
                    <img src="{{ asset('pictures/Module 3/mod3_rubrics.jpg') }}" alt="Module 3 Rubrics"
                        style="width:100%; border-radius:12px;">
                </div>

                <footer class="modal-footer">
                    <button class="save-btn" onclick="closeRubrics()">✔ Naiintindihan ko</button>
                </footer>

            </div>
        </div>
    </div>

    <script>
        // Game State
        const gameState = {
            score: 0,
            selectedItems: [],
            answers: {},
            timeLeft: 1800, // 30 minutes in seconds
            startTime: Date.now(),
            badges: [],
            completed: false
        };

        // Badge Definitions
        const badgeDefinitions = {
            kitmaster: {
                name: 'Dalubhasa sa Kit',
                emoji: '🎒',
                description: 'Kumpletuhin ang iyong emergency kit',
                condition: () => gameState.selectedItems.length >= 5
            },
            evacuationexpert: {
                name: 'Eksperto sa Paglikas',
                emoji: '🚪',
                description: 'Gumawa ng detalyadong plano sa paglikas',
                condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('evacuation')).length >= 5
            },
            communicationpro: {
                name: 'Dalubhasa sa Komunikasyon',
                emoji: '📱',
                description: 'Iayos ang iyong plano sa komunikasyon',
                condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('communication')).length >= 5
            },
            safehaven: {
                name: 'Ligtas na Kanlungan',
                emoji: '🏠',
                description: 'Tukuyin ang lahat ng ligtas na lugar',
                condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('safe')).length >= 5
            },
            preparednessmaster: {
                name: 'Ganap na Handa',
                emoji: '🌟',
                description: 'Kumpletuhin ang lahat ng bahagi nang maayos',
                condition: () => gameState.score >= 90
            }
        };

        // Initialize Game
        document.addEventListener('DOMContentLoaded', function () {
            setupTabNavigation();
            setupItemSelection();
            setupRadioButtons();
            setupTimer();
            updateScore();
        });

        // Tab Navigation
        function setupTabNavigation() {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const tabId = this.dataset.tab;

                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        }

        // Item Selection for Emergency Kit
        function setupItemSelection() {
            const itemCards = document.querySelectorAll('.item-card');

            itemCards.forEach(card => {
                card.addEventListener('click', function () {
                    const item = this.dataset.item;
                    const points = parseInt(this.dataset.points);

                    if (this.classList.contains('selected')) {
                        this.classList.remove('selected');
                        gameState.selectedItems = gameState.selectedItems.filter(i => i.item !== item);
                        gameState.score -= points;
                    } else {
                        if (gameState.selectedItems.length < 9) { // Max 9 items
                            this.classList.add('selected');
                            gameState.selectedItems.push({ item, points });
                            gameState.score += points;
                        }
                    }

                    updateItemsList();
                    updateScore();
                });
            });
        }

        // Update Items List
        function updateItemsList() {
            const listContainer = document.getElementById('kitList');
            const countSpan = document.getElementById('kit-count');
            const scoreSpan = document.getElementById('kit-score');

            listContainer.innerHTML = '';
            gameState.selectedItems.forEach(item => {
                const tag = document.createElement('div');
                tag.className = 'item-tag';
                tag.innerHTML = `${item.item} <span class="remove">✕</span>`;
                tag.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove')) {
                        const card = document.querySelector(`[data-item="${item.item}"]`);
                        card.click();
                    }
                });
                listContainer.appendChild(tag);
            });

            countSpan.textContent = gameState.selectedItems.length;
            const kitPoints = gameState.selectedItems.reduce((sum, item) => sum + item.points, 0);
            scoreSpan.textContent = `${kitPoints}/25`;
        }

        // Setup Radio Buttons
        function setupRadioButtons() {
            const radioButtons = document.querySelectorAll('input[type="radio"]');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function () {
                    const questionName = this.name;
                    const points = parseInt(this.dataset.points);

                    // Remove previous points for this question
                    if (gameState.answers[questionName]) {
                        gameState.score -= gameState.answers[questionName];
                    }

                    // Add new points
                    gameState.answers[questionName] = points;
                    gameState.score += points;

                    updateScore();
                    updateTabScores();
                });
            });
        }

        // Update Tab Scores
        function updateTabScores() {
            // Calculate evacuation score
            let evacuationScore = 0;
            for (let i = 1; i <= 5; i++) {
                const checked = document.querySelector(`input[name="evacuation-${i}"]:checked`);
                if (checked) {
                    evacuationScore += parseInt(checked.dataset.points);
                }
            }

            // Calculate communication score
            let communicationScore = 0;
            for (let i = 1; i <= 5; i++) {
                const checked = document.querySelector(`input[name="communication-${i}"]:checked`);
                if (checked) {
                    communicationScore += parseInt(checked.dataset.points);
                }
            }

            // Calculate safe areas score
            let safeScore = 0;
            for (let i = 1; i <= 5; i++) {
                const checked = document.querySelector(`input[name="safe-${i}"]:checked`);
                if (checked) {
                    safeScore += parseInt(checked.dataset.points);
                }
            }

            document.getElementById('evacuation-score').textContent = `${evacuationScore}/25`;
            document.getElementById('communication-score').textContent = `${communicationScore}/25`;
            document.getElementById('safe-score').textContent = `${safeScore}/25`;
        }

        // Update Score Display
        function updateScore() {
            document.getElementById('totalScore').textContent = gameState.score;

            // Calculate progress
            const maxScore = 100;
            const progressPercent = Math.round((gameState.score / maxScore) * 100);
            document.getElementById('progressPercent').textContent = progressPercent + '%';
            document.getElementById('progressBar').style.width = progressPercent + '%';

            // Check badges
            updateBadges();

            // Enable/disable submit button
            updateSubmitButton();
        }

        // Update Badges
        function updateBadges() {
            const badgesList = document.getElementById('badgesList');
            const badgeCount = document.getElementById('badgeCount');
            const earnedBadges = [];

            for (const [key, badge] of Object.entries(badgeDefinitions)) {
                if (badge.condition()) {
                    if (!gameState.badges.includes(key)) {
                        gameState.badges.push(key);
                    }
                    earnedBadges.push(key);
                }
            }

            badgesList.innerHTML = '';
            for (const [key, badge] of Object.entries(badgeDefinitions)) {
                const badgeDiv = document.createElement('div');
                badgeDiv.className = 'badge-item';
                if (earnedBadges.includes(key)) {
                    badgeDiv.classList.add('earned');
                }
                badgeDiv.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="emoji">${badge.emoji}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="name">${badge.name}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `;
                badgesList.appendChild(badgeDiv);
            }

            badgeCount.textContent = earnedBadges.length + '/5';
        }

        // Update Submit Button
        function updateSubmitButton() {
            const submitBtn = document.getElementById('submitBtn');
            const kitComplete = gameState.selectedItems.length >= 5;
            const evacuationComplete = Object.keys(gameState.answers).filter(k => k.startsWith('evacuation')).length >= 5;
            const communicationComplete = Object.keys(gameState.answers).filter(k => k.startsWith('communication')).length >= 5;
            const safeComplete = Object.keys(gameState.answers).filter(k => k.startsWith('safe')).length >= 5;

            if (kitComplete && evacuationComplete && communicationComplete && safeComplete) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        // Timer
        function setupTimer() {
            setInterval(function () {
                gameState.timeLeft--;

                const minutes = Math.floor(gameState.timeLeft / 60);
                const seconds = gameState.timeLeft % 60;
                document.getElementById('timeLeft').textContent =
                    String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

                if (gameState.timeLeft <= 0) {
                    submitTask(true); // Force submission
                }
            }, 1000);
        }

        // Submit Task
        document.getElementById('submitBtn').addEventListener('click', function () {
            submitTask(false);
        });

        function submitTask(timeoutSubmit) {
            gameState.completed = true;

            // Show results modal
            const modal = document.getElementById('resultsModal');
            modal.classList.add('show');
            document.body.classList.add('modal-open');

            // Calculate final score
            document.getElementById('finalScore').textContent = gameState.score;

            // Calculate completion percentage
            const completion = Math.round((gameState.score / 100) * 100);
            document.getElementById('resultCompletion').textContent = completion + '%';

            // Badges
            document.getElementById('resultBadges').textContent = gameState.badges.length + '/5';

            // Time taken
            const timeTaken = Math.floor((Date.now() - gameState.startTime) / 1000);
            const minutes = Math.floor(timeTaken / 60);
            const seconds = timeTaken % 60;
            document.getElementById('resultTime').textContent = minutes + 'm ' + seconds + 's';

            // Feedback
            let feedback = '';
            if (gameState.score >= 90) {
                feedback = '🌟 Napakahusay! Ang iyong plano sa paghahanda sa sakuna ay kumpleto at pinag-isipang mabuti! Tunay kang handa sa anumang emerhensiya.';
            } else if (gameState.score >= 75) {
                feedback = '👍 Magaling! Saklaw ng iyong plano sa paghahanda sa sakuna ang mahahalagang bahagi. Maaaring balikan ang mga bahaging nakaligtaan para sa mas mahusay na paghahanda.';
            } else if (gameState.score >= 60) {
                feedback = '📋 Magandang simula! Mayroon ka nang pangunahing plano. Suriin ang lahat ng bahagi upang matiyak ang ganap na kaligtasan ng pamilya.';
            } else {
                feedback = '💡 Nagsisimula ka pa lamang sa iyong paghahanda. Kumpletuhin ang lahat ng bahagi upang makabuo ng isang komprehensibong plano sa sakuna para sa iyong pamilya.';
            }
            document.getElementById('resultFeedback').textContent = feedback;

            // Display badges
            const badgesDisplay = document.getElementById('resultBadgesDisplay');
            badgesDisplay.innerHTML = '';
            gameState.badges.forEach(badgeKey => {
                const badge = badgeDefinitions[badgeKey];
                const badgeDiv = document.createElement('div');
                badgeDiv.className = 'result-badge';
                badgeDiv.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="badge-emoji">${badge.emoji}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="badge-name">${badge.name}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `;
                badgesDisplay.appendChild(badgeDiv);
            });

            // Close modal
            document.getElementById('closeModal').addEventListener('click', function () {
                modal.classList.remove('show');
                document.body.classList.remove('modal-open');
            });

            // Save result
            document.getElementById('saveResultBtn').addEventListener('click', function () {
                // Save to database
                fetch("{{ route('student.module3.performance-task.save') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        score: gameState.score,
                        badges: gameState.badges,
                        completionTime: timeTaken
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log("Performance Task saved:", data);
                        alert('Performance Task submitted! Score: ' + gameState.score + '/100');
                        modal.classList.remove('show');
                        document.body.classList.remove('modal-open');
                    })
                    .catch(err => console.error(err));
            });
        }

        // SHOW RUBRICS ON FIRST LOAD ONLY
        document.addEventListener("DOMContentLoaded", function () {
            if (!sessionStorage.getItem("module3RubricsShown")) {
                const modal = document.getElementById("rubricsModal");
                modal.classList.add("show");
                document.body.classList.add("modal-open");
                sessionStorage.setItem("module3RubricsShown", "true");
            }
        });

        function closeRubrics() {
            document.getElementById("rubricsModal").classList.remove("show");
            document.body.classList.remove("modal-open");
        }
    </script>

@endsection