<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Landslide Alert: Rescue Mission | Libon, Albay</title>
  <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --emergency-orange: #FF6B00;
      --forest-dark: #1A2F23;
      --earth-brown: #4A3728;
      --safe-green: #27AE60;
      --danger-red: #EB5757;
      --glass-bg: rgba(255, 255, 255, 0.95);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f0f2f0;
      background-image: radial-gradient(#1a2f23 0.5px, transparent 0.5px);
      background-size: 20px 20px;
      font-family: 'Inter', sans-serif;
      color: #1E2A2F;
      padding: 2rem 1rem;
    }

    .game-container {
      max-width: 800px;
      margin: 0 auto;
      background: var(--glass-bg);
      border-radius: 1.5rem;
      box-shadow: 0 30px 60px rgba(0,0,0,0.12);
      overflow: hidden;
      border: 1px solid rgba(26, 47, 35, 0.1);
    }

    /* Tactical Header */
    .game-header {
      background: var(--forest-dark);
      padding: 2rem;
      color: white;
      text-align: center;
      position: relative;
      border-bottom: 4px solid var(--emergency-orange);
    }

    .game-header h1 {
      font-family: 'Chakra Petch', sans-serif;
      font-size: 2.2rem;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-bottom: 0.5rem;
      color: #FFFFFF;
    }

    .subhead {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-weight: 500;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .role-badge {
      background: var(--emergency-orange);
      padding: 3px 12px;
      border-radius: 4px;
      font-size: 0.75rem;
      font-weight: 700;
    }

    /* Sensor Monitor Panel */
    .disaster-visual {
      background: #e1e8e4;
      padding: 1rem;
      display: flex;
      justify-content: center;
    }

    .visual-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px dashed var(--earth-brown);
    }

    .landslide-icon {
      font-size: 3rem;
      animation: tremor 0.5s infinite;
    }

    @keyframes tremor {
      0% { transform: translate(0,0); }
      25% { transform: translate(1px, -1px); }
      50% { transform: translate(-1px, 1px); }
      100% { transform: translate(0,0); }
    }

    .visual-caption {
      text-align: right;
    }

    .location-tag {
      font-weight: 700;
      color: var(--earth-brown);
      display: block;
    }

    .status-alert {
      color: var(--danger-red);
      font-size: 0.75rem;
      font-weight: 800;
      text-transform: uppercase;
    }

    /* Mission Panel */
    .quiz-panel {
      padding: 2.5rem;
    }

    .level-badge {
      font-family: 'Chakra Petch', sans-serif;
      color: var(--emergency-orange);
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 1rem;
      display: block;
    }

    .scenario {
      background: #f8f9f8;
      border-radius: 1rem;
      padding: 2rem;
      margin-bottom: 2rem;
      border-left: 8px solid var(--forest-dark);
      box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .scenario-text {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--forest-dark);
      margin-bottom: 0.5rem;
    }

    .scenario-desc {
      color: #555;
      font-style: italic;
    }

    /* Tactical Options */
    .options-list {
      display: grid;
      gap: 1rem;
    }

    .option-btn {
      background: white;
      border: 2px solid #ddd;
      border-radius: 12px;
      padding: 1.2rem 1.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 15px;
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      color: var(--forest-dark);
    }

    .option-prefix {
      background: var(--forest-dark);
      color: white;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      flex-shrink: 0;
    }

    .option-btn:hover:not(:disabled) {
      border-color: var(--emergency-orange);
      transform: translateX(10px);
      background: #fffcf9;
    }

    .option-btn.correct-feedback {
      border-color: var(--safe-green);
      background: #f0fff4;
      color: var(--safe-green);
    }

    .option-btn.wrong-feedback {
      border-color: var(--danger-red);
      background: #fff5f5;
      color: var(--danger-red);
    }

    /* Feedback Display */
    .feedback-message {
      margin-top: 1.5rem;
      padding: 1.5rem;
      border-radius: 12px;
      background: var(--forest-dark);
      color: white;
      font-weight: 500;
      line-height: 1.6;
      border-bottom: 4px solid var(--emergency-orange);
    }

    .next-btn {
      background: var(--emergency-orange);
      color: white;
      border: none;
      padding: 1rem 2.5rem;
      border-radius: 8px;
      font-weight: 800;
      text-transform: uppercase;
      cursor: pointer;
      margin-top: 1.5rem;
      float: right;
      box-shadow: 0 4px 14px rgba(255, 107, 0, 0.4);
    }

    /* Results Screen */
    .result-area {
      text-align: center;
      padding: 4rem 2rem;
    }

    .score-badge {
      font-size: 4rem;
      font-family: 'Chakra Petch', sans-serif;
      color: var(--forest-dark);
      margin: 1rem 0;
    }

    .restart-btn {
      background: var(--forest-dark);
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 2rem;
      text-decoration: none;
      display: inline-block;
    }

    footer {
      text-align: center;
      padding: 2rem;
      color: #888;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    @media (max-width: 600px) {
      .game-header h1 { font-size: 1.5rem; }
      .quiz-panel { padding: 1.5rem; }
      .scenario-text { font-size: 1.1rem; }
    }
  </style>
</head>
<body>

<div class="game-container">
  <div class="game-header">
    <h1>⛰️ Landslide Alert</h1>
    <div class="subhead">
      <span>Command Center: Libon, Albay</span>
      <span class="role-badge">Lead Responder</span>
    </div>
  </div>

  <div class="disaster-visual">
    <div class="visual-card">
      <div class="landslide-icon">🏔️⚠️</div>
      <div class="visual-caption">
        <span class="location-tag">Sector 7-B | High Hazard</span>
        <span class="status-alert">● Heavy Rainfall Detected</span>
      </div>
    </div>
  </div>

  <div class="quiz-panel" id="quizPanel">
    </div>

  <div class="result-area" id="resultArea" style="display: none;">
    </div>
  
  <footer>Tactical Disaster Response Simulation | 2026</footer>
</div>

<script>
  const levels = [
    {
      id: 1,
      title: "🌧️ PHASE 1: INITIAL WARNING",
      situation: "Patuloy ang malakas na ulan dulot ng bagyo.",
      question: "Ano ang unang hakbang mo?",
      options: [
        { text: "A. Maghintay muna", correct: false },
        { text: "B. Maghanda at magbabala sa mga residente", correct: true },
        { text: "C. Matulog na lang", correct: false }
      ],
      feedback: "PROMPT ACTION: Ang maagang babala ang pinakamahalagang depensa laban sa sakuna."
    },
    {
      id: 2,
      title: "⛰️ PHASE 2: SLOPE FAILURE",
      situation: "May lupa at putik na gumuho mula sa bundok.",
      question: "Ano ang ibig sabihin nito?",
      options: [
        { text: "A. Ligtas pa rin", correct: false },
        { text: "B. May landslide na nagaganap", correct: true },
        { text: "C. Normal lang", correct: false }
      ],
      feedback: "SENSORY DATA: Ito ay isang visual confirmation ng gumuguhong slope."
    },
    {
      id: 3,
      title: "🏠 PHASE 3: IMPACT ZONE",
      situation: "May mga bahay na natatabunan na ng lupa.",
      question: "Ano ang dapat gawin?",
      options: [
        { text: "A. Pabayaan muna", correct: false },
        { text: "B. Ilikas agad ang mga residente", correct: true },
        { text: "C. Mag-video lang", correct: false }
      ],
      feedback: "LIFE SAFETY: Sa yugtong ito, bawat segundo ay mahalaga para sa evacuation."
    },
    {
      id: 4,
      title: "🏫 PHASE 4: EVACUATION LOGISTICS",
      situation: "Ililipat ang mga residente sa ligtas na lugar.",
      question: "Saan sila dapat dalhin?",
      options: [
        { text: "A. Sa delikadong lugar", correct: false },
        { text: "B. Sa evacuation center (paaralan)", correct: true },
        { text: "C. Sa tabi ng bundok", correct: false }
      ],
      feedback: "STRATEGIC BASE: Ang mga pre-designated centers ay may supply at proteksyon."
    },
    {
      id: 5,
      title: "⚠️ PHASE 5: SECONDARY THREAT",
      situation: "May panibagong landslide habang may clearing operations.",
      question: "Ano ang gagawin mo?",
      options: [
        { text: "A. Ipagpatuloy kahit delikado", correct: false },
        { text: "B. Itigil muna at tiyakin ang kaligtasan", correct: true },
        { text: "C. Balewalain", correct: false }
      ],
      feedback: "OPERATIONAL SAFETY: Huwag hayaang maging biktima ang mga responders."
    },
    {
      id: 6,
      title: "🔍 PHASE 6: SEARCH & RESCUE",
      situation: "May nawawalang 60-anyos na lalaki sa impact zone.",
      question: "Ano ang tamang aksyon?",
      options: [
        { text: "A. Huwag pansinin", correct: false },
        { text: "B. Maglunsad ng search and rescue", correct: true },
        { text: "C. Umuwi na lang", correct: false }
      ],
      feedback: "MISSION PRIORITY: Walang maiiwan. Bawat buhay ay may halaga."
    },
    {
      id: 7,
      title: "📢 PHASE 7: FUTURE MITIGATION",
      situation: "Nais mong maiwasan ang sakuna sa susunod na panahon.",
      question: "Ano ang dapat gawin ng komunidad?",
      options: [
        { text: "A. Huwag makinig sa babala", correct: false },
        { text: "B. Sumunod sa abiso at lumikas agad", correct: true },
        { text: "C. Manatili sa bahay", correct: false }
      ],
      feedback: "CULTURE OF SAFETY: Ang disiplina ang pinakamabisang kagamitan sa kaligtasan."
    }
  ];

  let currentLevelIndex = 0;
  let score = 0;
  let userAnswers = new Array(levels.length).fill(null);
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const gameSaveUrl = "{{ route('student.module4.games.save') }}";

  const quizPanel = document.getElementById('quizPanel');
  const resultArea = document.getElementById('resultArea');

  async function saveGameResult(rank) {
    try {
      await fetch(gameSaveUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          game_type: 'landslide',
          score: score,
          total_items: levels.length,
          rank: rank,
          is_completed: true
        })
      });
    } catch (error) {
      console.error('Failed to save Landslide game result:', error);
    }
  }

  function renderLevel() {
    if (currentLevelIndex >= levels.length) {
      showResults();
      return;
    }

    const level = levels[currentLevelIndex];
    const answered = userAnswers[currentLevelIndex] !== null;

    let optionsHtml = level.options.map((opt, idx) => {
      let css = '';
      if (answered) {
        if (opt.correct) css = 'correct-feedback';
        else if (userAnswers[currentLevelIndex] === idx) css = 'wrong-feedback';
      }
      return `
        <button class="option-btn ${css}" onclick="handleChoice(${idx})" ${answered ? 'disabled' : ''}>
          <span class="option-prefix">${String.fromCharCode(65 + idx)}</span>
          <span>${opt.text}</span>
        </button>
      `;
    }).join('');

    quizPanel.innerHTML = `
      <span class="level-badge">OBJECTIVE ${currentLevelIndex + 1} OF ${levels.length}</span>
      <div class="scenario">
        <div class="scenario-text">${level.title}</div>
        <div class="scenario-desc">${level.situation}</div>
        <div style="margin-top:1.5rem; font-weight:800; color:var(--emergency-orange)">QUESTION: ${level.question}</div>
      </div>
      <div class="options-list">${optionsHtml}</div>
      ${answered ? `
        <div class="feedback-message">
          <strong>MISSION DEBRIEF:</strong> ${level.feedback}
        </div>
        <button class="next-btn" onclick="nextLevel()">
          ${currentLevelIndex === levels.length - 1 ? 'Finish Mission' : 'Next Objective ➡️'}
        </button>
      ` : ''}
    `;
  }

  function handleChoice(idx) {
    userAnswers[currentLevelIndex] = idx;
    if (levels[currentLevelIndex].options[idx].correct) score++;
    renderLevel();
  }

  function nextLevel() {
    currentLevelIndex++;
    renderLevel();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function showResults() {
    quizPanel.style.display = 'none';
    resultArea.style.display = 'block';
    
    let rank = score >= 6 ? 'LANDSLIDE RESPONSE EXPERT' : (score >= 3 ? 'RELIABLE RESPONDER' : 'TRAINEE');
    let msg = score >= 6 ? "Kahanga-hanga! Nailigtas mo ang komunidad." : "Kailangan pa ng pagsasanay para sa kaligtasan.";

    resultArea.innerHTML = `
      <div style="font-size: 3rem;">🎖️</div>
      <div class="score-badge">${score} / ${levels.length}</div>
      <h2 style="color:var(--emergency-orange); text-transform:uppercase;">${rank}</h2>
      <p style="margin: 1.5rem 0; font-weight:500;">${msg}</p>
      <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap; margin-top:10px;">
        <button class="restart-btn" onclick="location.reload()">🔄 Restart Mission</button>
        <a href="{{ route('module4.explore', ['completed' => 'landslide']) }}" class="restart-btn" style="background: var(--emergency-orange);">📚 Back to Explore</a>
      </div>
    `;

    saveGameResult(rank);
  }

  renderLevel();
</script>
</body>
</html>