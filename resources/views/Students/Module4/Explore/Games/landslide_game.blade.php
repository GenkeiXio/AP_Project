<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Landslide Alert: Rescue Mission | Barangay Response Leader</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #FFFFFF;
      font-family: 'Poppins', 'Segoe UI', system-ui, -apple-system, 'Roboto', sans-serif;
      color: #1E2A2F;
      line-height: 1.4;
      padding: 2rem 1rem;
    }

    /* main game container */
    .game-container {
      max-width: 880px;
      margin: 0 auto;
      background: white;
      border-radius: 2rem;
      box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.02);
      overflow: hidden;
      transition: all 0.2s ease;
    }

    /* header with earthy/landslide theme */
    .game-header {
      background: #FEF8EE;
      padding: 1.6rem 2rem 1.2rem;
      border-bottom: 2px solid #C28B5E;
      text-align: center;
    }

    .game-header h1 {
      font-size: 1.9rem;
      font-weight: 700;
      letter-spacing: -0.3px;
      background: linear-gradient(135deg, #6B4226, #A5643A);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      margin-bottom: 0.3rem;
    }

    .subhead {
      color: #8B5A3C;
      font-weight: 500;
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .role-badge {
      background: #F3E5D8;
      border-radius: 40px;
      padding: 0.2rem 0.8rem;
      font-size: 0.85rem;
      font-weight: 600;
      color: #8B4C2C;
    }

    /* visual context area - landslide alert illustration */
    .disaster-visual {
      background: #FCF6EA;
      padding: 1.2rem;
      text-align: center;
      border-bottom: 1px solid #F0DFC7;
    }

    .visual-card {
      background: #FFF7EE;
      border-radius: 28px;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      box-shadow: inset 0 0 0 1px rgba(190, 130, 70, 0.2), 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .landslide-icon {
      font-size: 4rem;
      filter: drop-shadow(2px 6px 8px rgba(0,0,0,0.1));
    }

    .visual-caption {
      font-size: 0.8rem;
      font-weight: 500;
      color: #9B6A42;
      background: #F9EFE3;
      padding: 4px 14px;
      border-radius: 40px;
    }

    /* quiz panel */
    .quiz-panel {
      padding: 2rem 2rem 2rem;
    }

    .level-badge {
      display: inline-block;
      background: #F1F3F4;
      padding: 0.3rem 1rem;
      border-radius: 40px;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      color: #5E3A22;
      margin-bottom: 1rem;
      border: 1px solid #E7DFD3;
    }

    .scenario {
      background: #FAF7F2;
      padding: 1.4rem 1.6rem;
      border-radius: 32px;
      margin-bottom: 2rem;
      border-left: 6px solid #B86F3C;
      box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }

    .scenario-text {
      font-size: 1.35rem;
      font-weight: 600;
      color: #4A2F1E;
      line-height: 1.4;
    }

    .scenario-desc {
      margin-top: 12px;
      font-size: 1rem;
      color: #6A4E32;
      font-weight: 500;
    }

    .options-list {
      display: flex;
      flex-direction: column;
      gap: 0.9rem;
      margin: 1.5rem 0 1.8rem;
    }

    .option-btn {
      background: white;
      border: 2px solid #E6DDD2;
      border-radius: 60px;
      padding: 0.9rem 1.4rem;
      font-size: 1rem;
      font-weight: 500;
      text-align: left;
      cursor: pointer;
      transition: all 0.2s ease;
      font-family: inherit;
      display: flex;
      align-items: center;
      gap: 12px;
      color: #3A2A1F;
      background: #FFFFFF;
    }

    .option-prefix {
      font-weight: 800;
      background: #F2EBE2;
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 60px;
      color: #B66F3C;
    }

    .option-btn:hover:not(:disabled) {
      background: #FFF8F0;
      border-color: #B86F3C;
      transform: translateY(-1px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.03);
    }

    .option-btn.correct-feedback {
      background: #EAF7E6;
      border-color: #2F7D32;
    }

    .option-btn.wrong-feedback {
      background: #FFEFEF;
      border-color: #D9534F;
    }

    .disabled-opt {
      cursor: default;
      opacity: 0.9;
    }

    .feedback-message {
      background: #FFF0E2;
      border-radius: 28px;
      padding: 1rem 1.4rem;
      margin: 0.5rem 0 1rem;
      font-size: 0.95rem;
      font-weight: 500;
      color: #A45925;
      border-left: 4px solid #DC8E4A;
    }

    .next-btn-wrapper {
      text-align: right;
      margin-top: 12px;
    }

    .next-btn {
      background: #B86F3C;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 60px;
      font-weight: 700;
      font-size: 1rem;
      color: white;
      cursor: pointer;
      transition: 0.2s;
      font-family: inherit;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .next-btn:hover {
      background: #9B582E;
      transform: scale(0.97);
    }

    .result-area {
      background: #FCF6ED;
      margin: 1.5rem 2rem 2rem;
      border-radius: 32px;
      padding: 1.5rem;
      text-align: center;
      border-top: 1px solid #F3E1CD;
    }

    .score-badge {
      font-size: 1.7rem;
      font-weight: 800;
    }

    .restart-btn {
      background: #4A2F1E;
      color: white;
      border: none;
      padding: 0.6rem 1.8rem;
      border-radius: 60px;
      font-weight: 600;
      margin-top: 1rem;
      cursor: pointer;
      transition: all 0.2s;
    }

    footer {
      text-align: center;
      font-size: 0.7rem;
      color: #C1A17A;
      padding: 1rem;
    }

    @media (max-width: 550px) {
      .quiz-panel {
        padding: 1.2rem;
      }
      .scenario-text {
        font-size: 1.1rem;
      }
      .option-btn {
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
<div class="game-container">
  <div class="game-header">
    <h1>⛰️ LANDSLIDE ALERT</h1>
    <div class="subhead">
      <span>🚨 RESCUE MISSION · Libon, Albay</span>
      <span class="role-badge">🛡️ Barangay Disaster Response Leader</span>
    </div>
    <div style="font-size:0.85rem; margin-top: 8px;">Iligtas ang komunidad mula sa landslide at mabawasan ang pinsala</div>
  </div>

  <!-- Visual context inspired by document: landslide & rescue awareness -->
  <div class="disaster-visual">
    <div class="visual-card">
      <div class="landslide-icon">🏔️💧⚠️🌧️</div>
      <div class="visual-caption">📍 Libon, Albay · Heavy Rainfall & Landslide Hazard Zone</div>
    </div>
  </div>

  <div class="quiz-panel" id="quizPanel">
    <!-- dynamic game content injected -->
  </div>

  <div class="result-area" id="resultArea" style="display: none;">
    <!-- final score and ranking -->
  </div>
  <footer>🌱 "Bawat buhay mahalaga, handa ang komunidad laban sa landslide"</footer>
</div>

<script>
  // ---------- GAME DATA based on provided content ----------
  const levels = [
    {
      id: 1,
      title: "🌧️ LEVEL 1: MALAKAS NA ULAN (Early Warning Phase)",
      situation: "📢 Sitwasyon: Patuloy ang malakas na ulan dulot ng bagyo",
      question: "Ano ang unang hakbang mo?",
      options: [
        { text: "A. Maghintay muna", correct: false },
        { text: "B. Maghanda at magbabala sa mga residente", correct: true },
        { text: "C. Matulog na lang", correct: false }
      ],
      feedback: "💡 Ang maagang babala ay nakapagliligtas ng buhay."
    },
    {
      id: 2,
      title: "⛰️ LEVEL 2: PAGGUHO NG LUPA (Hazard Recognition)",
      situation: "📢 Sitwasyon: May lupa at putik na gumuho mula sa bundok",
      question: "Ano ang ibig sabihin nito?",
      options: [
        { text: "A. Ligtas pa rin", correct: false },
        { text: "B. May landslide na nagaganap", correct: true },
        { text: "C. Normal lang", correct: false }
      ],
      feedback: "💡 Ito ay malinaw na senyales ng panganib."
    },
    {
      id: 3,
      title: "🏠 LEVEL 3: MGA BAHAY NA NATATAMAAN (Impact Response)",
      situation: "📢 Sitwasyon: May mga bahay na natatabunan ng lupa",
      question: "Ano ang dapat gawin?",
      options: [
        { text: "A. Pabayaan muna", correct: false },
        { text: "B. Ilikas agad ang mga residente", correct: true },
        { text: "C. Mag-video lang", correct: false }
      ],
      feedback: "💡 Ang agarang paglikas ay nakapagliligtas ng buhay."
    },
    {
      id: 4,
      title: "🏫 LEVEL 4: EVACUATION CENTER (Safety Management)",
      situation: "📢 Sitwasyon: Ililipat ang mga residente",
      question: "Saan sila dapat dalhin?",
      options: [
        { text: "A. Sa delikadong lugar", correct: false },
        { text: "B. Sa evacuation center (paaralan)", correct: true },
        { text: "C. Sa tabi ng bundok", correct: false }
      ],
      feedback: "💡 Ang evacuation center ay ligtas na lugar."
    },
    {
      id: 5,
      title: "⚠️ LEVEL 5: PATULOY NA PANGANIB (Critical Thinking)",
      situation: "📢 Sitwasyon: May panibagong landslide habang may clearing",
      question: "Ano ang gagawin mo?",
      options: [
        { text: "A. Ipagpatuloy kahit delikado", correct: false },
        { text: "B. Itigil muna at tiyakin ang kaligtasan", correct: true },
        { text: "C. Balewalain", correct: false }
      ],
      feedback: "💡 Mas mahalaga ang buhay kaysa sa operasyon."
    },
    {
      id: 6,
      title: "🔍 LEVEL 6: NAWAWALANG TAO (Rescue Decision)",
      situation: "📢 Sitwasyon: May nawawalang 60-anyos na lalaki",
      question: "Ano ang tamang aksyon?",
      options: [
        { text: "A. Huwag pansinin", correct: false },
        { text: "B. Maglunsad ng search and rescue", correct: true },
        { text: "C. Umuwi na lang", correct: false }
      ],
      feedback: "💡 Ang bawat buhay ay mahalaga."
    },
    {
      id: 7,
      title: "📢 LEVEL 7: MAHALAGANG ARAL (Preparedness Mindset)",
      situation: "📢 Sitwasyon: Gusto mong maiwasan ang ganitong sakuna sa susunod",
      question: "Ano ang dapat gawin ng komunidad?",
      options: [
        { text: "A. Huwag makinig sa babala", correct: false },
        { text: "B. Sumunod sa abiso at lumikas agad", correct: true },
        { text: "C. Manatili sa bahay", correct: false }
      ],
      feedback: "💡 Ang disiplina at kahandaan ay susi sa kaligtasan."
    }
  ];

  // Game state
  let currentLevelIndex = 0;
  let score = 0;
  let answerLock = false;
  let selectedOptionIndex = null;
  let userAnswers = new Array(levels.length).fill(null);

  const quizPanel = document.getElementById('quizPanel');
  const resultArea = document.getElementById('resultArea');

  // Helper: render current level
  function renderCurrentLevel() {
    if (currentLevelIndex >= levels.length) {
      showFinalResults();
      return;
    }

    const level = levels[currentLevelIndex];
    const isAnswered = userAnswers[currentLevelIndex] !== undefined && userAnswers[currentLevelIndex] !== null;
    const userWasCorrect = userAnswers[currentLevelIndex];

    let optionsHtml = '';
    level.options.forEach((opt, idx) => {
      let additionalClass = '';
      const disabledAttr = isAnswered ? 'disabled' : '';
      const prefixLetter = String.fromCharCode(65 + idx);

      if (isAnswered) {
        if (opt.correct) {
          additionalClass = 'correct-feedback';
        } else if (selectedOptionIndex === idx && !opt.correct) {
          additionalClass = 'wrong-feedback';
        }
      }

      optionsHtml += `
        <button class="option-btn ${additionalClass}" data-opt-index="${idx}" ${disabledAttr}>
          <span class="option-prefix">${prefixLetter}</span>
          <span>${opt.text}</span>
        </button>
      `;
    });

    let feedbackHtml = '';
    if (isAnswered) {
      const correctnessMsg = userWasCorrect ? '✅ Tamang sagot! ' : '❌ Mali. ';
      feedbackHtml = `
        <div class="feedback-message">
          ${correctnessMsg} ${level.feedback}
        </div>
      `;
    }

    let nextButtonHtml = '';
    if (isAnswered && currentLevelIndex < levels.length - 1) {
      nextButtonHtml = `<div class="next-btn-wrapper"><button class="next-btn" id="nextLevelBtn">➡️ Susunod na Antas</button></div>`;
    } else if (isAnswered && currentLevelIndex === levels.length - 1) {
      nextButtonHtml = `<div class="next-btn-wrapper"><button class="next-btn" id="finishGameBtn">🏁 Tapusin ang Misyon</button></div>`;
    }

    const progressText = `Antas ${currentLevelIndex+1} ng ${levels.length}`;

    const fullHtml = `
      <div class="level-badge">🎯 ${progressText} | Barangay Response Leader</div>
      <div class="scenario">
        <div class="scenario-text">${level.title}</div>
        <div class="scenario-desc">${level.situation}</div>
        <div style="margin-top: 12px; font-weight: 500;">❓ ${level.question}</div>
      </div>
      <div class="options-list" id="optionsContainer">
        ${optionsHtml}
      </div>
      ${feedbackHtml}
      ${nextButtonHtml}
    `;

    quizPanel.innerHTML = fullHtml;

    if (!isAnswered) {
      const optionBtns = document.querySelectorAll('.option-btn');
      optionBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          if (answerLock) return;
          const optIndex = parseInt(btn.dataset.optIndex);
          handleAnswer(optIndex);
        });
      });
    } else {
      if (document.getElementById('nextLevelBtn')) {
        document.getElementById('nextLevelBtn').addEventListener('click', goToNextLevel);
      }
      if (document.getElementById('finishGameBtn')) {
        document.getElementById('finishGameBtn').addEventListener('click', finishGame);
      }
    }
  }

  function handleAnswer(optIndex) {
    if (answerLock) return;
    const level = levels[currentLevelIndex];
    const isCorrect = level.options[optIndex].correct;
    answerLock = true;
    selectedOptionIndex = optIndex;
    if (isCorrect) {
      score++;
      userAnswers[currentLevelIndex] = true;
    } else {
      userAnswers[currentLevelIndex] = false;
    }
    renderCurrentLevel();
  }

  function goToNextLevel() {
    if (currentLevelIndex + 1 < levels.length) {
      currentLevelIndex++;
      answerLock = false;
      selectedOptionIndex = null;
      renderCurrentLevel();
    } else {
      finishGame();
    }
  }

  function finishGame() {
    showFinalResults();
  }

  function showFinalResults() {
    const totalQuestions = levels.length;
    const correctCount = score;
    let rank = '';
    let rankEmoji = '';
    if (correctCount >= 6) {
      rank = 'Landslide Response Expert';
      rankEmoji = '🏆⛰️🛡️';
    } else if (correctCount >= 3) {
      rank = 'Developing Responder';
      rankEmoji = '📈⚠️🌱';
    } else {
      rank = 'Needs More Training';
      rankEmoji = '📚🔄';
    }

    // hide quiz panel, show result
    quizPanel.style.display = 'none';
    resultArea.style.display = 'block';
    resultArea.innerHTML = `
      <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎖️ ${rankEmoji}</div>
      <div class="score-badge">${correctCount} / ${totalQuestions} tamang sagot</div>
      <div style="font-size: 1.4rem; font-weight: 700; margin: 0.6rem 0; color:#BD7442;">${rank}</div>
      <p style="margin: 1rem 0 0.5rem; background:#FFF2E6; padding: 10px; border-radius: 28px;">
        📋 <strong>Debrief ng Misyon:</strong> ${getFinalMessage(correctCount)}
      </p>
      <button class="restart-btn" id="restartGameBtn">🔄 I-restart ang Rescue Mission</button>
    `;
    document.getElementById('restartGameBtn').addEventListener('click', () => {
      resetGame();
    });
  }

  function getFinalMessage(scoreCount) {
    if (scoreCount >= 6) return "Kahanga-hanga! Ang iyong mabilis na pagtugon at tamang desisyon ay nagligtas ng maraming buhay mula sa landslide. Patuloy na maging huwaran sa kahandaan!";
    if (scoreCount >= 3) return "Magandang simula! May potensyal ka, pero kailangan pang pagbutihin ang pagkilala sa panganib at tamang aksyon. Magsanay pa para maging eksperto!";
    return "Kailangan ng karagdagang pagsasanay. Balikan ang mga tamang sagot at alamin ang wastong pagtugon sa landslide. Ang buhay ng komunidad ay nakasalalay sa iyong kahandaan.";
  }

  function resetGame() {
    currentLevelIndex = 0;
    score = 0;
    answerLock = false;
    selectedOptionIndex = null;
    userAnswers = new Array(levels.length).fill(null);
    quizPanel.style.display = 'block';
    resultArea.style.display = 'none';
    renderCurrentLevel();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // initial render
  renderCurrentLevel();
  resultArea.style.display = 'none';
</script>
</body>
</html>