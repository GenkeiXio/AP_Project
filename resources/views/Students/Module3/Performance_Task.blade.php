@extends('Students.studentslayout')

@section('content')
<div class="performance-task-container">
    <div class="task-header">
        <h1>🎮 Performance Task: Disaster Preparedness Challenge</h1>
        <p class="subtitle">Complete the mission, earn XP, unlock badges, and build a family disaster survival plan.</p>
    </div>

    <div class="mission-banner">
        <div class="mission-callout">
            <span class="mission-pill">MISSION BRIEF</span>
            <h2>⚡ Disaster Response Quest</h2>
            <p>Prepare your family before the storm hits. Every choice gives XP. Every section completed unlocks rewards.</p>
        </div>
        <div class="mission-objectives">
            <div class="objective-chip active">🎒 Build Emergency Kit</div>
            <div class="objective-chip active">🚪 Set Evacuation Plan</div>
            <div class="objective-chip active">📱 Secure Communication</div>
            <div class="objective-chip active">🏠 Mark Safe Zones</div>
        </div>
    </div>

    <!-- Game Statistics Bar -->
    <div class="game-stats-bar">
        <div class="stat">
            <span class="label">Score:</span>
            <span class="value" id="totalScore">0</span>
        </div>
        <div class="stat">
            <span class="label">Progress:</span>
            <span class="value" id="progressPercent">0%</span>
        </div>
        <div class="stat">
            <span class="label">Time Left:</span>
            <span class="value" id="timeLeft">30:00</span>
        </div>
        <div class="stat">
            <span class="label">Badges:</span>
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
                <h3>📍 Your Scenario</h3>
                <p id="scenarioText">You are the head of a household in a disaster-prone area. A typhoon warning has been issued. You have 30 minutes to prepare your family's disaster response plan.</p>
            </div>

            <div class="badges-earned">
                <h3>🏆 Badges Earned</h3>
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
                    <span class="tab-title">Emergency Kit</span>
                    <span class="tab-score" id="kit-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="evacuation-plan">
                    <span class="tab-icon">🚪</span>
                    <span class="tab-title">Evacuation Plan</span>
                    <span class="tab-score" id="evacuation-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="communication">
                    <span class="tab-icon">📱</span>
                    <span class="tab-title">Communication</span>
                    <span class="tab-score" id="communication-score">0/25</span>
                </button>
                <button class="tab-btn" data-tab="safe-areas">
                    <span class="tab-icon">🏠</span>
                    <span class="tab-title">Safe Areas</span>
                    <span class="tab-score" id="safe-score">0/25</span>
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="tab-contents">
                <!-- Emergency Kit Tab -->
                <div class="tab-content active" id="emergency-kit">
                    <h3>🎒 Build Your Emergency Kit</h3>
                    <p class="instructions">Select at least 5 essential items for your emergency kit. (Max 25 points)</p>
                    
                    <div class="items-grid">
                        <div class="item-card" data-item="water" data-points="5">
                            <div class="item-icon">💧</div>
                            <div class="item-name">Water</div>
                            <div class="item-info">1-2 liters per person</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="food" data-points="5">
                            <div class="item-icon">🥫</div>
                            <div class="item-name">Non-perishable Food</div>
                            <div class="item-info">Canned goods, biscuits</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="medical" data-points="5">
                            <div class="item-icon">⚕️</div>
                            <div class="item-name">First Aid Kit</div>
                            <div class="item-info">Bandages, medicines</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="flashlight" data-points="5">
                            <div class="item-icon">🔦</div>
                            <div class="item-name">Flashlight</div>
                            <div class="item-info">With extra batteries</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="documents" data-points="5">
                            <div class="item-icon">📄</div>
                            <div class="item-name">Important Documents</div>
                            <div class="item-info">IDs, insurance papers</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="cash" data-points="5">
                            <div class="item-icon">💵</div>
                            <div class="item-name">Cash & Cards</div>
                            <div class="item-info">For emergencies</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="radio" data-points="5">
                            <div class="item-icon">📻</div>
                            <div class="item-name">Radio/Phone Charger</div>
                            <div class="item-info">Stay informed</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="baby-items" data-points="5">
                            <div class="item-icon">👶</div>
                            <div class="item-name">Baby Items</div>
                            <div class="item-info">Diapers, formula</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                        <div class="item-card" data-item="pet-supplies" data-points="5">
                            <div class="item-icon">🐾</div>
                            <div class="item-name">Pet Supplies</div>
                            <div class="item-info">Food, leashes</div>
                            <div class="item-points">+5 pts</div>
                        </div>
                    </div>

                    <div class="selected-items">
                        <p>Selected Items: <span id="kit-count">0</span>/5</p>
                        <div class="items-list" id="kitList"></div>
                    </div>
                </div>

                <!-- Evacuation Plan Tab -->
                <div class="tab-content" id="evacuation-plan">
                    <h3>🚪 Create Your Evacuation Plan</h3>
                    <p class="instructions">Answer the following questions about your evacuation plan. (Max 25 points)</p>
                    
                    <div class="questions-list">
                        <div class="question-card">
                            <div class="question-num">1.</div>
                            <div class="question-content">
                                <p class="question-text">Where is your designated evacuation area?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-1" value="school" data-points="5">
                                        <span class="option-text">🏫 Nearest School/Community Center</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-1" value="relative" data-points="5">
                                        <span class="option-text">👥 Relative's house on higher ground</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-1" value="unknown" data-points="0">
                                        <span class="option-text">❓ I don't know yet</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">2.</div>
                            <div class="question-content">
                                <p class="question-text">How will you get there?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-2" value="walk" data-points="5">
                                        <span class="option-text">🚶 Walking route planned</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-2" value="vehicle" data-points="5">
                                        <span class="option-text">🚗 Vehicle ready with fuel</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-2" value="unsure" data-points="0">
                                        <span class="option-text">❓ Haven't decided</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">3.</div>
                            <div class="question-content">
                                <p class="question-text">Do you have an evacuation route map?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-3" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, marked on map</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-3" value="planning" data-points="3">
                                        <span class="option-text">📋 Planning to make one</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-3" value="no" data-points="0">
                                        <span class="option-text">❌ No, not yet</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">4.</div>
                            <div class="question-content">
                                <p class="question-text">Who will lead the evacuation?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-4" value="designated" data-points="5">
                                        <span class="option-text">👤 A designated family member</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-4" value="unclear" data-points="0">
                                        <span class="option-text">❓ Not decided yet</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">5.</div>
                            <div class="question-content">
                                <p class="question-text">How long should evacuation take?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-5" value="estimated" data-points="5">
                                        <span class="option-text">⏱️ Estimated time calculated</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="evacuation-5" value="unknown" data-points="0">
                                        <span class="option-text">❓ Not calculated</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Communication Tab -->
                <div class="tab-content" id="communication">
                    <h3>📱 Communication Plan</h3>
                    <p class="instructions">Set up your family communication strategy. (Max 25 points)</p>
                    
                    <div class="questions-list">
                        <div class="question-card">
                            <div class="question-num">1.</div>
                            <div class="question-content">
                                <p class="question-text">Do you have a central contact person outside the area?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="communication-1" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, designated contact</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-1" value="no" data-points="0">
                                        <span class="option-text">❌ No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">2.</div>
                            <div class="question-content">
                                <p class="question-text">Do all family members know this contact number?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="communication-2" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, everyone knows it</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-2" value="partial" data-points="3">
                                        <span class="option-text">🟡 Some do</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-2" value="no" data-points="0">
                                        <span class="option-text">❌ No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">3.</div>
                            <div class="question-content">
                                <p class="question-text">How will you communicate if phones don't work?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="communication-3" value="planned" data-points="5">
                                        <span class="option-text">📍 Meeting point or radio planned</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-3" value="unsure" data-points="0">
                                        <span class="option-text">❓ Haven't thought about it</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">4.</div>
                            <div class="question-content">
                                <p class="question-text">Do you have emergency contacts written down?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="communication-4" value="yes" data-points="5">
                                        <span class="option-text">✅ Written & distributed</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-4" value="phone" data-points="3">
                                        <span class="option-text">📱 Only in phones</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-4" value="no" data-points="0">
                                        <span class="option-text">❌ No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">5.</div>
                            <div class="question-content">
                                <p class="question-text">How often do you review your communication plan?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="communication-5" value="monthly" data-points="5">
                                        <span class="option-text">🔄 Monthly or regularly</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="communication-5" value="rarely" data-points="0">
                                        <span class="option-text">❓ Rarely or never</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safe Areas Tab -->
                <div class="tab-content" id="safe-areas">
                    <h3>🏠 Identify Safe Areas</h3>
                    <p class="instructions">Mark safe areas in your home and community. (Max 25 points)</p>
                    
                    <div class="questions-list">
                        <div class="question-card">
                            <div class="question-num">1.</div>
                            <div class="question-content">
                                <p class="question-text">Where is the safest room in your home?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="safe-1" value="interior" data-points="5">
                                        <span class="option-text">🛡️ Interior room away from windows</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-1" value="basement" data-points="5">
                                        <span class="option-text">🏚️ Basement/lowest area</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-1" value="unknown" data-points="0">
                                        <span class="option-text">❓ Not identified yet</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">2.</div>
                            <div class="question-content">
                                <p class="question-text">Is your home away from flood-prone areas?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="safe-2" value="yes" data-points="5">
                                        <span class="option-text">✅ On high ground, safe from floods</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-2" value="partial" data-points="3">
                                        <span class="option-text">🟡 Partially at risk</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-2" value="risk" data-points="0">
                                        <span class="option-text">⚠️ Flood-prone area</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">3.</div>
                            <div class="question-content">
                                <p class="question-text">Do you know where public shelters are located?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="safe-3" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, visited and mapped</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-3" value="vague" data-points="3">
                                        <span class="option-text">🟡 Vaguely know location</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-3" value="no" data-points="0">
                                        <span class="option-text">❌ Don't know</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">4.</div>
                            <div class="question-content">
                                <p class="question-text">Is there a safe area for pets during disasters?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="safe-4" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, designated area</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-4" value="flexible" data-points="3">
                                        <span class="option-text">🟡 Can find temporary shelter</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-4" value="no" data-points="0">
                                        <span class="option-text">❌ Not planned</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="question-card">
                            <div class="question-num">5.</div>
                            <div class="question-content">
                                <p class="question-text">Have you practiced moving to your safe area?</p>
                                <div class="answer-options">
                                    <label class="option-label">
                                        <input type="radio" name="safe-5" value="yes" data-points="5">
                                        <span class="option-text">✅ Yes, regularly drilled</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-5" value="once" data-points="3">
                                        <span class="option-text">🟡 Once or twice</span>
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="safe-5" value="no" data-points="0">
                                        <span class="option-text">❌ Never practiced</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit-section">
                <button class="submit-btn" id="submitBtn">
                    <span>📤 Submit Performance Task</span>
                </button>
                <p class="submit-info">Complete all sections to unlock the final submission!</p>
            </div>
        </div>

        <!-- Right Sidebar - Leaderboard -->
        <div class="leaderboard-sidebar">
            <div class="leaderboard-card">
                <h3>🏅 Leaderboard</h3>
                <div class="leaderboard-list" id="leaderboard">
                    <!-- Leaderboard entries will be added here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Results Modal -->
    <div class="modal" id="resultsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>🎉 Performance Task Complete!</h2>
                <button class="close-btn" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="final-score">
                    <div class="score-circle">
                        <div class="score-value" id="finalScore">0</div>
                        <div class="score-max">/100</div>
                    </div>
                </div>
                <div class="result-stats">
                    <p><strong>Completion Rate:</strong> <span id="resultCompletion">0%</span></p>
                    <p><strong>Badges Earned:</strong> <span id="resultBadges">0/5</span></p>
                    <p><strong>Time Taken:</strong> <span id="resultTime">0m 0s</span></p>
                </div>
                <div class="result-feedback" id="resultFeedback"></div>
                <div class="result-badges-section">
                    <h4>🏆 Your Badges:</h4>
                    <div class="result-badges" id="resultBadgesDisplay"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="save-btn" id="saveResultBtn">Save & Continue</button>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.task-header {
    text-align: center;
    color: white;
    margin-bottom: 30px;
    padding: 20px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.task-header h1 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.task-header .subtitle {
    font-size: 1.1em;
    opacity: 0.9;
}

.game-stats-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.stat {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: #f5f5f5;
    border-radius: 8px;
}

.stat .label {
    font-weight: 600;
    color: #666;
}

.stat .value {
    font-size: 1.5em;
    font-weight: bold;
    color: #667eea;
}

.progress-bar-container {
    background: white;
    height: 30px;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
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
    grid-template-columns: 250px 1fr 250px;
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
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.scenario-card h3,
.leaderboard-card h3,
.badges-earned h3 {
    margin-bottom: 15px;
    color: #333;
    font-size: 1.2em;
}

.scenario-card p {
    color: #666;
    line-height: 1.6;
}

.badges-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.badge-item {
    text-align: center;
    padding: 10px;
    background: #f0f0f0;
    border-radius: 8px;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.badge-item.earned {
    opacity: 1;
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
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
    background: white;
    border-radius: 10px;
    padding: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.task-tabs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
    border-bottom: 2px solid #e0e0e0;
    background: #f5f5f5;
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
}

.tab-btn:hover {
    background: #ececec;
}

.tab-btn.active {
    border-bottom-color: #667eea;
    color: #667eea;
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
    color: #999;
    font-weight: 600;
}

.tab-btn.active .tab-score {
    color: #667eea;
}

.tab-contents {
    padding: 30px;
    overflow-y: auto;
    max-height: 600px;
    flex: 1;
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
    color: #333;
    font-size: 1.5em;
}

.instructions {
    color: #666;
    margin-bottom: 20px;
    padding: 10px 15px;
    background: #f0f0f0;
    border-left: 4px solid #667eea;
    border-radius: 4px;
}

.items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.item-card {
    background: #f9f9f9;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.item-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.item-card.selected {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
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
    color: #999;
    margin-bottom: 8px;
}

.item-card.selected .item-info {
    color: rgba(255, 255, 255, 0.9);
}

.item-points {
    font-weight: bold;
    color: #667eea;
    font-size: 0.9em;
}

.item-card.selected .item-points {
    color: #ffed4e;
}

.selected-items {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.selected-items p {
    margin-bottom: 10px;
    font-weight: 600;
    color: #333;
}

.items-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.items-list .item-tag {
    background: #667eea;
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
    background: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    display: flex;
    gap: 15px;
    border-left: 4px solid #667eea;
}

.question-num {
    font-size: 1.5em;
    font-weight: bold;
    color: #667eea;
    min-width: 30px;
    text-align: center;
}

.question-content {
    flex: 1;
}

.question-text {
    font-weight: 600;
    margin-bottom: 12px;
    color: #333;
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
    background: #ececec;
}

.option-label input[type="radio"] {
    cursor: pointer;
    width: 18px;
    height: 18px;
    accent-color: #667eea;
}

.option-label input[type="radio"]:checked + .option-text {
    color: #667eea;
    font-weight: 600;
}

.option-text {
    flex: 1;
    color: #666;
}

.submit-section {
    padding: 20px 30px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.submit-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 15px 40px;
    font-size: 1em;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
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
    color: #999;
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
    background: #f5f5f5;
    border-radius: 8px;
    font-size: 0.95em;
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
    color: #333;
}

.leaderboard-score {
    font-weight: bold;
    color: #667eea;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
}

.modal.show {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 0;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.modal-header {
    padding: 25px;
    border-bottom: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    color: #333;
}

.close-btn {
    background: none;
    border: none;
    font-size: 2em;
    cursor: pointer;
    color: #999;
    transition: color 0.2s ease;
}

.close-btn:hover {
    color: #333;
}

.modal-body {
    padding: 25px;
}

.final-score {
    text-align: center;
    margin-bottom: 30px;
}

.score-circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    margin: 0 auto;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.score-value {
    font-size: 3em;
    font-weight: bold;
}

.score-max {
    font-size: 1.2em;
    opacity: 0.9;
}

.result-stats {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.result-stats p {
    margin: 10px 0;
    color: #666;
}

.result-feedback {
    background: #e8f5e9;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid #4caf50;
    color: #2e7d32;
    line-height: 1.6;
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
    border-radius: 8px;
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

.modal-footer {
    padding: 20px 25px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: center;
}

.save-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 12px 35px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1em;
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
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
        name: 'Kit Master',
        emoji: '🎒',
        description: 'Complete your emergency kit',
        condition: () => gameState.selectedItems.length >= 5
    },
    evacuationexpert: {
        name: 'Evacuation Expert',
        emoji: '🚪',
        description: 'Create a detailed evacuation plan',
        condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('evacuation')).length >= 5
    },
    communicationpro: {
        name: 'Communication Pro',
        emoji: '📱',
        description: 'Set up your communication plan',
        condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('communication')).length >= 5
    },
    safehaven: {
        name: 'Safe Haven',
        emoji: '🏠',
        description: 'Identify all safe areas',
        condition: () => Object.keys(gameState.answers).filter(k => k.startsWith('safe')).length >= 5
    },
    preparednessmaster: {
        name: 'Preparedness Master',
        emoji: '🌟',
        description: 'Complete all sections perfectly',
        condition: () => gameState.score >= 90
    }
};

// Initialize Game
document.addEventListener('DOMContentLoaded', function() {
    setupTabNavigation();
    setupItemSelection();
    setupRadioButtons();
    setupTimer();
    updateLeaderboard();
    updateScore();
});

// Tab Navigation
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

// Item Selection for Emergency Kit
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
        tag.addEventListener('click', function(e) {
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
        radio.addEventListener('change', function() {
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
    setInterval(function() {
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
document.getElementById('submitBtn').addEventListener('click', function() {
    submitTask(false);
});

function submitTask(timeoutSubmit) {
    gameState.completed = true;

    // Show results modal
    const modal = document.getElementById('resultsModal');
    modal.classList.add('show');

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
        feedback = '🌟 Excellent! Your disaster preparedness plan is comprehensive and well-thought-out! You are truly ready for any emergency situation.';
    } else if (gameState.score >= 75) {
        feedback = '👍 Great job! Your disaster preparedness plan covers the essential areas. Consider reviewing the areas you missed for even better preparation.';
    } else if (gameState.score >= 60) {
        feedback = '📋 Good start! You have a basic plan in place. Review all sections to ensure complete family protection.';
    } else {
        feedback = '💡 You\'ve begun your preparedness journey. Complete all sections to create a comprehensive disaster plan for your family.';
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
    document.getElementById('closeModal').addEventListener('click', function() {
        modal.classList.remove('show');
    });

    // Save result
    document.getElementById('saveResultBtn').addEventListener('click', function() {
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
        })
        .catch(err => console.error(err));
    });
}

// Leaderboard
function updateLeaderboard() {
    const leaderboard = document.getElementById('leaderboard');
    const sampleLeaderboard = [
        { rank: 1, name: 'Maria Santos', score: 98 },
        { rank: 2, name: 'Juan Dela Cruz', score: 95 },
        { rank: 3, name: 'Grace Lee', score: 92 },
        { rank: 4, name: 'Miguel Reyes', score: 88 },
        { rank: 5, name: 'Ana Garcia', score: 85 }
    ];

    leaderboard.innerHTML = '';
    sampleLeaderboard.forEach(entry => {
        const div = document.createElement('div');
        div.className = 'leaderboard-entry';
        div.innerHTML = `
            <div class="leaderboard-rank rank-${entry.rank}">${entry.rank}</div>
            <div class="leaderboard-info">
                <div class="leaderboard-name">${entry.name}</div>
            </div>
            <div class="leaderboard-score">${entry.score}</div>
        `;
        leaderboard.appendChild(div);
    });
}
</script>

@endsection
