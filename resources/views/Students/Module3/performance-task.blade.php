@extends('Students.studentslayout')

@section('content')
    <div class="performance-task-container">
        <div class="task-header">
            <h1>🎮 Gawain sa Pagganap: Hamon sa Paghahanda sa Sakuna</h1>
            <p class="subtitle">Tapusin ang misyon, kumita ng <i>XP</i>, magbukas ng mga <i>badge</i>, at bumuo ng plano ng
                kaligtasan ng pamilya.
            </p>
        </div>

        <div class="mission-banner">
            <div class="mission-callout">
                <span class="mission-pill">BUOD NG MISYON</span>
                <h2>⚡ Misyon sa Pagtugon sa Sakuna</h2>
                <p>Ihanda ang iyong pamilya bago dumating ang bagyo. Bawat desisyon ay may katumbas na XP. Bawat seksyon na
                    natapos ay
                    may gantimpala.</p>
            </div>
            <div class="mission-objectives">
                <div class="objective-chip active">🎒 Bumuo ng Emergency Kit</div>
                <div class="objective-chip active">🚪 Gumawa ng Plano sa Paglikas</div>
                <div class="objective-chip active">📱 Siguraduhin ang Komunikasyon</div>
                <div class="objective-chip active">🏠 Tukuyin ang Ligtas na Lugar</div>
            </div>
        </div>

        <!-- Game Statistics Bar -->
        <div class="game-stats-bar">
            <div class="stat">
                <span class="label">Iskor:</span>
                <span class="value" id="totalScore">0</span>
            </div>
            <div class="stat">
                <span class="label">Progreso:</span>
                <span class="value" id="progressPercent">0%</span>
            </div>
            <div class="stat">
                <span class="label">Natitirang Oras:</span>
                <span class="value" id="timeLeft">30:00</span>
            </div>
            <div class="stat">
                <span class="label">Mga <i>Badge:</i></span>
                <span class="value" id="badgeCount">0/5</span>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-bar-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <!-- Main Game Content -->
        <div class="game-content">
            <!-- Left Sidebar - Scenario Context -->
            <div class="scenario-sidebar">
                <div class="scenario-card">
                    <h3>📍 Iyong Sitwasyon</h3>
                    <p>Ikaw ang pinuno ng isang pamilya sa lugar na madalas tamaan ng sakuna. May babala ng bagyo...</p>
                </div>

                <div class="badges-earned">
                    <h3>🏆 <i>Badges Earned</i></h3>
                    <div class="badges-list" id="badgesList">
                        <!-- Badges will be dynamically added here -->
                    </div>
                </div>
            </div>

            <!-- Main Planning Interface -->
            <div class="planning-interface">
                <!-- Task Tabs -->
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

                <!-- Tab Contents -->
                <div class="tab-contents">
                    <!-- Emergency Kit Tab -->
                    <div class="tab-content active" id="emergency-kit">
                        <h3>🎒 Bumuo ng Iyong Emergency Kit</h3>
                        <p class="instructions">Pumili ng hindi bababa sa 5 mahahalagang gamit para sa iyong emergency kit.
                        </p>
                        </p>

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
                    </div>

                    <!-- Evacuation Plan Tab -->
                    <div class="tab-content" id="evacuation-plan">
                        <h3>🚪 Gumawa ng Plano sa Paglikas</h3>
                        <p class="instructions">Sagutin ang mga sumusunod na tanong tungkol sa iyong plano sa paglikas.</p>

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
                    </div>

                    <!-- Communication Tab -->
                    <div class="tab-content" id="communication">
                        <h3>📱 Plano sa Komunikasyon</h3>
                        <p class="instructions">Ihanda ang paraan ng komunikasyon ng inyong pamilya.</p>

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
                    </div>

                    <!-- Safe Areas Tab -->
                    <div class="tab-content" id="safe-areas">
                        <h3>🏠 Tukuyin ang Ligtas na Lugar</h3>
                        <p class="instructions">Tukuyin ang mga ligtas na lugar sa inyong tahanan at komunidad.</p>

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
                    </div>

                    <!-- Submit Button -->
                    <div class="submit-section">
                        <button class="submit-btn" id="submitBtn">
                            <span>📤 Ipasa ang Gawain</span>
                        </button>
                        <p class="submit-info">Kumpletuhin ang lahat ng bahagi upang maipasa ang gawain!</p>
                    </div>
                </div>
            </div>

            <!-- Results Modal -->
            <div class="modal" id="resultsModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>🎉 Natapos ang Gawain!</h2>
                    </div>

                    <div class="modal-body">
                        <!-- SCORE -->
                        <div class="final-score">
                            <div class="score-circle">
                                <div class="score-value" id="finalScore">0</div>
                                <div class="score-max">/100</div>
                            </div>
                        </div>

                        <!-- STATS -->
                        <div class="result-stats">
                            <p><strong>Antas ng Pagkakumpleto:</strong> <span id="resultCompletion">0%</span></p>
                            <p><strong>Nakuhang Badge:</strong> <span id="resultBadges">0/5</span></p>
                            <p><strong>Oras na Ginamit:</strong> <span id="resultTime">0m 0s</span></p>
                        </div>

                        <!-- FEEDBACK -->
                        <div class="result-feedback" id="resultFeedback"></div>

                        <!-- BADGES -->
                        <div class="result-badges-section">
                            <h4>🏆 Mga Nakuhang Badge:</h4>
                            <div class="result-badges" id="resultBadgesDisplay"></div>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="modal-footer" style="gap:10px; flex-wrap:wrap;">
                        <button class="save-btn" id="saveResultBtn">
                            💾 I-save at Magpatuloy
                        </button>

                        <a href="{{ route('module3.buod') }}" class="save-btn" style="text-decoration:none;">
                            ➡️ Pumunta sa Buod
                        </a>
                    </div>
                </div>
            </div>

            <!-- RUBRICS MODAL (IMAGE ONLY) -->
            <div class="modal" id="rubricsModal">
                <div class="modal-content" style="max-width:900px; overflow:hidden;">

                    <!-- HEADER -->
                    <div class="modal-header" style="justify-content:center; position:relative;">
                        <h2 style="text-align:center; width:100%;">📊 Rubrics</h2>
                    </div>

                    <!-- BODY (IMAGE ONLY) -->
                    <div class="modal-body" style="padding:20px; text-align:center;">
                        <img src="{{ asset('pictures/Module 3/mod3_rubrics.jpg') }}" alt="Module 3 Rubrics"
                            style="width:100%; border-radius:12px;">
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer" style="justify-content:center;">
                        <button class="save-btn" onclick="closeRubrics()">
                            ✔ Naiintindihan ko
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .performance-task-container {
                position: relative;
                background:
                    radial-gradient(circle at top left, rgba(0, 242, 255, 0.14) 0, transparent 24%),
                    radial-gradient(circle at top right, rgba(188, 19, 254, 0.12) 0, transparent 20%),
                    linear-gradient(160deg, #020617 0%, #0b1020 45%, #10172c 100%);
                min-height: 100vh;
                padding: 20px;
                font-family: 'Lexend', sans-serif;
                color: #e2e8f0;
            }

            .performance-task-container::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(0, 242, 255, 0.04) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(0, 242, 255, 0.04) 1px, transparent 1px);
                background-size: 32px 32px;
                opacity: 0.65;
                pointer-events: none;
            }

            .performance-task-container>* {
                position: relative;
                z-index: 1;
            }

            .task-header {
                text-align: center;
                color: white;
                margin-bottom: 18px;
                padding: 24px 18px;
                background: linear-gradient(180deg, rgba(15, 23, 42, 0.88), rgba(2, 6, 23, 0.8));
                border: 1px solid rgba(0, 242, 255, 0.18);
                border-radius: 22px;
                box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
            }

            .task-header h1 {
                font-family: 'Bungee', cursive;
                font-size: clamp(1.8rem, 3vw, 2.7rem);
                margin-bottom: 10px;
                letter-spacing: 1px;
                text-shadow: 0 0 20px rgba(0, 242, 255, 0.18);
            }

            .task-header .subtitle {
                font-size: 1rem;
                opacity: 0.9;
                color: #cbd5e1;
            }

            .mission-banner {
                display: grid;
                grid-template-columns: 1.4fr 1fr;
                gap: 16px;
                margin-bottom: 18px;
                padding: 18px;
                border-radius: 22px;
                background: rgba(15, 23, 42, 0.86);
                border: 1px solid rgba(0, 242, 255, 0.14);
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.03), 0 18px 40px rgba(0, 0, 0, 0.28);
            }

            .mission-callout h2 {
                font-family: 'Bungee', cursive;
                color: #00f2ff;
                margin: 10px 0 8px;
                font-size: clamp(1.1rem, 2vw, 1.65rem);
            }

            .mission-callout p {
                color: #cbd5e1;
                line-height: 1.65;
            }

            .mission-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 12px;
                border-radius: 999px;
                background: rgba(0, 242, 255, 0.14);
                color: #7defff;
                border: 1px solid rgba(0, 242, 255, 0.28);
                font-weight: 800;
                font-size: 0.82rem;
                letter-spacing: 0.8px;
            }

            .mission-objectives {
                display: grid;
                gap: 10px;
                align-content: center;
            }

            .objective-chip {
                padding: 12px 14px;
                border-radius: 14px;
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
                color: #dbeafe;
                font-weight: 700;
            }

            .objective-chip.active {
                background: linear-gradient(90deg, rgba(0, 242, 255, 0.16), rgba(188, 19, 254, 0.14));
                border-color: rgba(0, 242, 255, 0.18);
                box-shadow: 0 0 18px rgba(0, 242, 255, 0.08);
            }

            .game-stats-bar {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
                margin-bottom: 16px;
                background: rgba(15, 23, 42, 0.88);
                border: 1px solid rgba(0, 242, 255, 0.12);
                padding: 16px;
                border-radius: 20px;
                box-shadow: 0 16px 35px rgba(0, 0, 0, 0.28);
            }

            .stat {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 14px 14px;
                background: rgba(255, 255, 255, 0.04);
                border-radius: 14px;
                border: 1px solid rgba(255, 255, 255, 0.06);
            }

            .stat .label {
                font-weight: 700;
                color: #94a3b8;
            }

            .stat .value {
                font-size: 1.4em;
                font-weight: 900;
                color: #00f2ff;
            }

            .progress-bar-container {
                background: rgba(15, 23, 42, 0.88);
                height: 20px;
                border-radius: 999px;
                overflow: hidden;
                margin-bottom: 18px;
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.26);
                border: 1px solid rgba(0, 242, 255, 0.16);
            }

            .progress-bar {
                height: 100%;
                background: linear-gradient(90deg, #00f2ff 0%, #39ff14 55%, #ffcc00 100%);
                width: 0%;
                transition: width 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
            }

            .game-content {
                display: grid;
                grid-template-columns: 260px 1fr;
                gap: 20px;
                margin-bottom: 30px;
            }

            .scenario-sidebar,
            .leaderboard-sidebar {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .scenario-card,
            .leaderboard-card,
            .badges-earned {
                background: rgba(15, 23, 42, 0.88);
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 16px 35px rgba(0, 0, 0, 0.22);
                border: 1px solid rgba(0, 242, 255, 0.12);
            }

            .scenario-card h3,
            .leaderboard-card h3,
            .badges-earned h3 {
                margin-bottom: 15px;
                color: #e2e8f0;
                font-size: 1.1em;
                font-family: 'Bungee', cursive;
                letter-spacing: 0.4px;
            }

            .scenario-card p {
                color: #cbd5e1;
                line-height: 1.6;
            }

            .scenario-card::before,
            .leaderboard-card::before,
            .badges-earned::before {
                content: '';
                display: block;
                height: 3px;
                border-radius: 999px;
                background: linear-gradient(90deg, #00f2ff, #bc13fe);
                margin-bottom: 14px;
            }

            .badges-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .badge-item {
                text-align: center;
                padding: 10px;
                background: rgba(255, 255, 255, 0.04);
                border-radius: 14px;
                opacity: 0.5;
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .badge-item.earned {
                opacity: 1;
                background: linear-gradient(135deg, #ffd700, #ffed4e);
                color: #111827;
                box-shadow: 0 8px 18px rgba(255, 215, 0, 0.22);
            }

            .badge-item .emoji {
                font-size: 2em;
                margin-bottom: 5px;
            }

            .badge-item .name {
                font-size: 0.9em;
                font-weight: 600;
                color: #333;
            }

            .planning-interface {
                background: rgba(15, 23, 42, 0.88);
                border-radius: 22px;
                padding: 0;
                box-shadow: 0 16px 35px rgba(0, 0, 0, 0.26);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                border: 1px solid rgba(0, 242, 255, 0.12);
            }

            .task-tabs {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                background: rgba(255, 255, 255, 0.02);
            }

            .tab-btn {
                padding: 20px 15px;
                border: none;
                background: transparent;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                border-bottom: 3px solid transparent;
                transition: all 0.3s ease;
                position: relative;
                color: #cbd5e1;
            }

            .tab-btn:hover {
                background: rgba(0, 242, 255, 0.05);
            }

            .tab-btn.active {
                border-bottom-color: #00f2ff;
                color: #00f2ff;
                background: rgba(0, 242, 255, 0.06);
            }

            .tab-icon {
                font-size: 1.8em;
            }

            .tab-title {
                font-weight: 600;
                font-size: 0.95em;
            }

            .tab-score {
                font-size: 0.8em;
                color: #94a3b8;
                font-weight: 600;
            }

            .tab-btn.active .tab-score {
                color: #7defff;
            }

            .tab-contents {
                padding: 28px;
                overflow-y: auto;
                max-height: 600px;
                flex: 1;
                background:
                    radial-gradient(circle at top right, rgba(188, 19, 254, 0.08), transparent 35%),
                    radial-gradient(circle at bottom left, rgba(0, 242, 255, 0.06), transparent 30%);
            }

            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .tab-content h3 {
                margin-bottom: 10px;
                color: #f8fafc;
                font-size: 1.5em;
                font-family: 'Bungee', cursive;
            }

            .instructions {
                color: #cbd5e1;
                margin-bottom: 20px;
                padding: 10px 15px;
                background: rgba(255, 255, 255, 0.04);
                border-left: 4px solid #00f2ff;
                border-radius: 14px;
            }

            .items-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 15px;
                margin-bottom: 20px;
            }

            .item-card {
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 18px;
                padding: 15px;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s ease;
                backdrop-filter: blur(8px);
            }

            .item-card:hover {
                border-color: #00f2ff;
                box-shadow: 0 8px 20px rgba(0, 242, 255, 0.16);
                transform: translateY(-3px);
            }

            .item-card.selected {
                background: linear-gradient(135deg, rgba(0, 242, 255, 0.18), rgba(188, 19, 254, 0.22));
                color: white;
                border-color: #00f2ff;
                box-shadow: 0 0 0 1px rgba(0, 242, 255, 0.18), 0 10px 24px rgba(0, 242, 255, 0.18);
            }

            .item-icon {
                font-size: 2em;
                margin-bottom: 8px;
            }

            .item-name {
                font-weight: 600;
                font-size: 0.95em;
                margin-bottom: 5px;
            }

            .item-info {
                font-size: 0.8em;
                color: #94a3b8;
                margin-bottom: 8px;
            }

            .item-card.selected .item-info {
                color: rgba(255, 255, 255, 0.92);
            }

            .item-points {
                font-weight: bold;
                color: #00f2ff;
                font-size: 0.9em;
            }

            .item-card.selected .item-points {
                color: #ffed4e;
            }

            .selected-items {
                background: rgba(255, 255, 255, 0.04);
                padding: 15px;
                border-radius: 16px;
                margin-top: 20px;
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .selected-items p {
                margin-bottom: 10px;
                font-weight: 600;
                color: #e2e8f0;
            }

            .items-list {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .items-list .item-tag {
                background: linear-gradient(135deg, #00f2ff, #bc13fe);
                color: white;
                padding: 8px 12px;
                border-radius: 20px;
                font-size: 0.9em;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .items-list .item-tag .remove {
                cursor: pointer;
                font-weight: bold;
            }

            .questions-list {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .question-card {
                background: rgba(255, 255, 255, 0.04);
                padding: 20px;
                border-radius: 18px;
                display: flex;
                gap: 15px;
                border-left: 4px solid #00f2ff;
                border: 1px solid rgba(255, 255, 255, 0.07);
                box-shadow: 0 10px 18px rgba(0, 0, 0, 0.12);
            }

            .question-num {
                font-size: 1.5em;
                font-weight: bold;
                color: #00f2ff;
                min-width: 30px;
                text-align: center;
            }

            .question-content {
                flex: 1;
            }

            .question-text {
                font-weight: 600;
                margin-bottom: 12px;
                color: #f8fafc;
            }

            .answer-options {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .option-label {
                display: flex;
                align-items: center;
                gap: 12px;
                cursor: pointer;
                padding: 10px;
                border-radius: 6px;
                transition: all 0.2s ease;
            }

            .option-label:hover {
                background: rgba(0, 242, 255, 0.06);
            }

            .option-label input[type="radio"] {
                cursor: pointer;
                width: 18px;
                height: 18px;
                accent-color: #667eea;
            }

            .option-label input[type="radio"]:checked+.option-text {
                color: #7defff;
                font-weight: 600;
            }

            .option-text {
                flex: 1;
                color: #cbd5e1;
            }

            .submit-section {
                padding: 20px 30px;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                background: rgba(255, 255, 255, 0.02);
            }

            .submit-btn {
                background: linear-gradient(135deg, #00f2ff, #39ff14);
                color: white;
                border: none;
                padding: 15px 40px;
                font-size: 1em;
                border-radius: 999px;
                cursor: pointer;
                transition: all 0.3s ease;
                font-weight: 600;
                box-shadow: 0 10px 20px rgba(0, 242, 255, 0.18);
            }

            .submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            }

            .submit-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
                transform: none;
            }

            .submit-info {
                color: #94a3b8;
                font-size: 0.95em;
            }

            .leaderboard-list {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .leaderboard-entry {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px;
                background: rgba(255, 255, 255, 0.04);
                border-radius: 14px;
                font-size: 0.95em;
                border: 1px solid rgba(255, 255, 255, 0.06);
            }

            .leaderboard-rank {
                font-weight: bold;
                min-width: 25px;
                text-align: center;
                font-size: 1.2em;
            }

            .leaderboard-rank.rank-1 {
                color: #ffd700;
            }

            .leaderboard-rank.rank-2 {
                color: #c0c0c0;
            }

            .leaderboard-rank.rank-3 {
                color: #cd7f32;
            }

            .leaderboard-info {
                flex: 1;
            }

            .leaderboard-name {
                font-weight: 600;
                color: #e2e8f0;
            }

            .leaderboard-score {
                font-weight: bold;
                color: #00f2ff;
            }

            /* Modal Styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 9999;
                inset: 0;
                background: rgba(2, 6, 23, 0.75);
                backdrop-filter: blur(6px);
                animation: fadeIn 0.3s ease;
            }

            .modal.show {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                overflow-y: auto;
                /* ✅ allow modal container scroll */
            }

            /* CARD */
            .modal-content {
                max-height: 90vh;
                /* ✅ limits height */
                display: flex;
                flex-direction: column;
                width: 100%;
                max-width: 700px;
                border-radius: 26px;
                overflow: hidden;

                background: linear-gradient(180deg, #0f172a, #020617);
                border: 1px solid rgba(0, 242, 255, 0.15);

                box-shadow:
                    0 25px 60px rgba(0, 0, 0, 0.6),
                    0 0 0 1px rgba(0, 242, 255, 0.08);

                animation: modalPop 0.35s ease;
            }

            /* HEADER */
            .modal-header {
                padding: 20px 24px;
                background: linear-gradient(90deg, rgba(0, 242, 255, 0.1), rgba(188, 19, 254, 0.1));
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .modal-header h2 {
                font-size: 1.3rem;
                color: #e2e8f0;
            }

            /* CLOSE BUTTON */
            .close-btn {
                font-size: 1.8rem;
                color: #94a3b8;
            }

            .close-btn:hover {
                color: #fff;
            }

            /* BODY */
            .modal-body {
                overflow-y: auto;
                /* ✅ enables scroll */
                max-height: 65vh;
                /* ✅ scroll area */
            }


            .final-score {
                text-align: center;
                margin-bottom: 30px;
            }

            .score-circle {
                width: 140px;
                height: 140px;
                border-radius: 50%;

                background: radial-gradient(circle at center, #00f2ff 0%, #0f172a 70%);
                border: 4px solid rgba(0, 242, 255, 0.3);

                box-shadow: 0 0 25px rgba(0, 242, 255, 0.3);

                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;

                margin: 0 auto;
            }

            .score-value {
                font-size: 2.5rem;
                font-weight: 900;
                color: #fff;
            }

            .score-max {
                font-size: 1rem;
                color: #94a3b8;
            }

            /* STATS */
            .result-stats {
                margin-top: 20px;
                padding: 15px;
                border-radius: 14px;

                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .result-stats p {
                margin: 10px 0;
                color: #cbd5e1;
            }

            /* FEEDBACK */
            .result-feedback {
                margin-top: 20px;
                padding: 15px;
                border-radius: 14px;

                background: rgba(0, 242, 255, 0.08);
                border-left: 4px solid #00f2ff;
            }

            .result-badges-section {
                margin-top: 20px;
            }

            .result-badges-section h4 {
                margin-bottom: 15px;
                color: #333;
            }

            .result-badges {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 10px;
            }

            .result-badge {
                background: linear-gradient(135deg, #ffd700, #ffed4e);
                padding: 15px;
                border-radius: 14px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
            }

            .result-badge .badge-emoji {
                font-size: 2.5em;
                margin-bottom: 8px;
            }

            .result-badge .badge-name {
                font-weight: 600;
                font-size: 0.9em;
                color: #333;
            }

            /* FOOTER */
            .modal-footer {
                padding: 20px;
                display: flex;
                justify-content: center;
                gap: 12px;
                flex-wrap: wrap;
            }

            /* BUTTON */
            .save-btn {
                padding: 12px 28px;
                border-radius: 999px;
                border: none;

                background: linear-gradient(135deg, #00f2ff, #bc13fe);
                color: white;
                font-weight: 600;

                cursor: pointer;
                transition: 0.3s;
            }

            .save-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 242, 255, 0.3);
            }

            /* ANIMATION */
            @keyframes modalPop {
                from {
                    transform: scale(0.9) translateY(20px);
                    opacity: 0;
                }

                to {
                    transform: scale(1) translateY(0);
                    opacity: 1;
                }
            }

            /* Responsive Design */
            @media (max-width: 1200px) {
                .game-content {
                    grid-template-columns: 1fr;
                }

                .scenario-sidebar,
                .leaderboard-sidebar {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 20px;
                    margin-bottom: 20px;
                }
            }

            @media (max-width: 768px) {
                .task-header h1 {
                    font-size: 1.8em;
                }

                .game-stats-bar {
                    grid-template-columns: repeat(2, 1fr);
                }

                .task-tabs {
                    grid-template-columns: repeat(2, 1fr);
                    overflow-x: auto;
                }

                .items-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .rubric-header,
                .rubric-row {
                    grid-template-columns: 1fr;
                }

                .rubric-header div {
                    text-align: left;
                }
            }

            @media (max-width: 480px) {
                .performance-task-container {
                    padding: 10px;
                }

                .task-header {
                    padding: 15px;
                    margin-bottom: 15px;
                }

                .task-header h1 {
                    font-size: 1.5em;
                }

                .game-stats-bar {
                    grid-template-columns: 1fr;
                    padding: 15px;
                }

                .task-tabs {
                    grid-template-columns: 1fr;
                }

                .tab-btn {
                    padding: 15px;
                }

                .tab-contents {
                    padding: 15px;
                    max-height: 500px;
                }

                .items-grid {
                    grid-template-columns: 1fr;
                }

                .scenario-sidebar,
                .leaderboard-sidebar {
                    grid-template-columns: 1fr;
                }

                .modal-content {
                    width: 95%;
                }
            }

            @media (max-width: 1024px) {

                .mission-banner,
                .game-content {
                    grid-template-columns: 1fr;
                }

                .scenario-sidebar,
                .leaderboard-sidebar {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 20px;
                }
            }

            @media (max-width: 768px) {
                .performance-task-container {
                    padding: 12px;
                }

                .task-tabs {
                    grid-template-columns: repeat(2, 1fr);
                }

                .game-stats-bar {
                    grid-template-columns: repeat(2, 1fr);
                }

                .items-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .scenario-sidebar,
                .leaderboard-sidebar {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 520px) {

                .task-tabs,
                .game-stats-bar,
                .items-grid {
                    grid-template-columns: 1fr;
                }

                .task-header h1 {
                    font-size: 1.5rem;
                }

                .tab-contents {
                    padding: 16px;
                }

                .question-card {
                    flex-direction: column;
                }
            }

            body.modal-open {
                overflow: auto;
            }
        </style>

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