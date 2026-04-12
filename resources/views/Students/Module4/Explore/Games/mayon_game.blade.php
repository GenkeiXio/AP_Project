<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Mayon Alert: Disaster Response Mission</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #FFFFFF;   /* pure white background as requested */
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

    /* header with volcano vibe */
    .game-header {
      background: #FFF6E8;
      padding: 1.6rem 2rem 1.2rem;
      border-bottom: 2px solid #FFD966;
      text-align: center;
    }

    .game-header h1 {
      font-size: 1.9rem;
      font-weight: 700;
      letter-spacing: -0.3px;
      background: linear-gradient(135deg, #B7410E, #E67E22);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      margin-bottom: 0.3rem;
    }

    .subhead {
      color: #A55B2C;
      font-weight: 500;
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .role-badge {
      background: #FFE0B5;
      border-radius: 40px;
      padding: 0.2rem 0.8rem;
      font-size: 0.85rem;
      font-weight: 600;
      color: #AA5E2B;
    }

    /* volcanic visual context (simulated image area / illustration) */
    .volcano-visual {
      background: #FEF5E7;
      padding: 1.2rem;
      text-align: center;
      border-bottom: 1px solid #FFE2B5;
    }

    .volcano-card {
      background: #FFF2E0;
      border-radius: 28px;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      box-shadow: inset 0 0 0 1px rgba(255, 215, 150, 0.6), 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .volcano-icon {
      font-size: 4.2rem;
      filter: drop-shadow(2px 6px 8px rgba(0,0,0,0.1));
    }

    .visual-caption {
      font-size: 0.8rem;
      font-weight: 500;
      color: #B45F2B;
      background: #FFEED9;
      padding: 4px 14px;
      border-radius: 40px;
    }

    /* main quiz area */
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
      color: #2C3E2F;
      margin-bottom: 1rem;
      border: 1px solid #E7E2D7;
    }

    .scenario {
      background: #FAF9F6;
      padding: 1.4rem 1.6rem;
      border-radius: 32px;
      margin-bottom: 2rem;
      border-left: 6px solid #E67E22;
      box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }

    .scenario-text {
      font-size: 1.35rem;
      font-weight: 600;
      color: #2C3E2F;
      line-height: 1.4;
    }

    .scenario-desc {
      margin-top: 12px;
      font-size: 1rem;
      color: #4B5C5F;
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
      border: 2px solid #E6E0D4;
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
      color: #2C3A2F;
      background: #FFFFFF;
    }

    .option-prefix {
      font-weight: 800;
      background: #F4EFE6;
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 60px;
      color: #B45F2B;
    }

    .option-btn:hover:not(:disabled) {
      background: #FFF7EF;
      border-color: #E67E22;
      transform: translateY(-1px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.03);
    }

    .option-btn.correct-feedback {
      background: #E9F7EB;
      border-color: #2C8C3E;
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
      background: #FEF2E0;
      border-radius: 28px;
      padding: 1rem 1.4rem;
      margin: 0.5rem 0 1rem;
      font-size: 0.95rem;
      font-weight: 500;
      color: #A4581C;
      border-left: 4px solid #F4A261;
    }

    .next-btn-wrapper {
      text-align: right;
      margin-top: 12px;
    }

    .next-btn {
      background: #E67E22;
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
      background: #C95F0F;
      transform: scale(0.97);
    }

    .result-area {
      background: #FCF8F0;
      margin: 1.5rem 2rem 2rem;
      border-radius: 32px;
      padding: 1.5rem;
      text-align: center;
      border-top: 1px solid #FDE2B4;
    }

    .score-badge {
      font-size: 1.7rem;
      font-weight: 800;
    }

    .restart-btn {
      background: #2C3E2F;
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
      color: #B7A17A;
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
    <h1>🌋 MAYON ALERT</h1>
    <div class="subhead">
      <span>🎮 DISASTER RESPONSE MISSION</span>
      <span class="role-badge">🏅 DRR Officer - Albay</span>
    </div>
    <div style="font-size:0.85rem; margin-top: 8px;">Panatilihing ligtas ang komunidad sa gitna ng pagputok ng Bulkang Mayon</div>
  </div>

  <!-- visual context inspired by document -->
  <div class="volcano-visual">
    <div class="volcano-card">
      <div class="volcano-icon">🌋✨🌙</div>
      <div class="visual-caption">📍 Mayon Volcano • Alert Status Monitor</div>
    </div>
  </div>

  <div class="quiz-panel" id="quizPanel">
    <!-- dynamic content injected -->
  </div>

  <div class="result-area" id="resultArea" style="display: none;">
    <!-- dynamic final result -->
  </div>
  <footer>⚡ "Ligtas na komunidad, handa sa sakuna"</footer>
</div>

<script>
  // ----------------------------- GAME DATA (based on document content) ---------------------------------
  const levels = [
    {
      id: 1,
      title: "🌋 LEVEL 1: MAY NAKITANG PAGPUTOK (Observation Phase)",
      situation: "📢 Sitwasyon: May balita ng pag-agos ng lava mula sa Mayon",
      question: "Ano ang iyong unang gagawin?",
      options: [
        { text: "A. I-ignore dahil normal lang", correct: false },
        { text: "B. I-report agad sa awtoridad at mag-monitor", correct: true },
        { text: "C. Maghintay na lang", correct: false }
      ],
      feedback: "💡 Ang maagang pag-monitor ay mahalaga upang maiwasan ang sakuna."
    },
    {
      id: 2,
      title: "🔥 LEVEL 2: INCANDESCENT ROCKFALLS (Hazard Recognition)",
      situation: "📢 Sitwasyon: May nagliliyab na batong bumabagsak mula sa bulkan",
      question: "Ano ang ibig sabihin nito?",
      options: [
        { text: "A. Ligtas pa rin", correct: false },
        { text: "B. Aktibong paggalaw ng magma", correct: true },
        { text: "C. Wala lang epekto", correct: false }
      ],
      feedback: "💡 Senyal ito ng aktibong bulkan na maaaring lumala."
    },
    {
      id: 3,
      title: "🌄 LEVEL 3: PAG-AGOS NG LAVA (Impact Prediction)",
      situation: "📢 Sitwasyon: Umaagos ang lava pababa",
      question: "Ano ang dapat mong gawin?",
      options: [
        { text: "A. Papuntahin ang tao sa paanan ng bulkan", correct: false },
        { text: "B. Ilikas ang mga residente sa danger zone", correct: true },
        { text: "C. Maghintay muna", correct: false }
      ],
      feedback: "💡 Ang paglikas ay susi sa pag-iwas sa panganib."
    },
    {
      id: 4,
      title: "🚨 LEVEL 4: ALERT LEVEL 3 (Decision-Making)",
      situation: "📢 Sitwasyon: Itinaas sa Alert Level 3",
      question: "Ano ang ibig sabihin nito?",
      options: [
        { text: "A. Wala pang panganib", correct: false },
        { text: "B. May pagputok at maaaring lumakas", correct: true },
        { text: "C. Tapos na ang panganib", correct: false }
      ],
      feedback: "💡 Kailangan ang mataas na kahandaan sa ganitong alert level."
    },
    {
      id: 5,
      title: "⚠️ LEVEL 5: MGA PANGANIB (Risk Awareness)",
      situation: "📢 Sitwasyon: May banta ng lava flow, ashfall, at pyroclastic flow",
      question: "Ano ang pinaka-dapat gawin ng komunidad?",
      options: [
        { text: "A. Manatili sa bahay kahit delikado", correct: false },
        { text: "B. Sumunod sa evacuation plan", correct: true },
        { text: "C. Mag-selfie sa bulkan", correct: false }
      ],
      feedback: "💡 Ang pagsunod sa babala ay nagliligtas ng buhay."
    },
    {
      id: 6,
      title: "🌙 LEVEL 6: SITWASYON SA GABI (Critical Awareness)",
      situation: "📢 Sitwasyon: Mas maliwanag ang lava sa gabi",
      question: "Ano ang tamang interpretasyon?",
      options: [
        { text: "A. Mas ligtas sa gabi", correct: false },
        { text: "B. Mas malinaw lang ang panganib", correct: true },
        { text: "C. Walang epekto", correct: false }
      ],
      feedback: "💡 Hindi ibig sabihin ng maganda ay ligtas."
    },
    {
      id: 7,
      title: "🤝 LEVEL 7: PAGTUGON NG KOMUNIDAD (Preparedness & Action)",
      situation: "📢 Sitwasyon: Inihahanda ang evacuation",
      question: "Ano ang papel mo?",
      options: [
        { text: "A. Balewalain ang utos", correct: false },
        { text: "B. Tumulong sa maayos na paglikas", correct: true },
        { text: "C. Umuwi na lang", correct: false }
      ],
      feedback: "💡 Ang organisadong pagtugon ay nagbabawas ng panganib."
    }
  ];

  // game state
  let currentLevelIndex = 0;          // 0-index
  let score = 0;                      // total correct answers
  let answerLock = false;             // already answered current level?
  let selectedOptionIndex = null;     // store which option was selected (for styling)
  let userAnswers = new Array(levels.length).fill(null); // store correct status (bool)
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const gameSaveUrl = "{{ route('student.module4.games.save') }}";

  // DOM elements
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
          game_type: 'mayon',
          score: score,
          total_items: levels.length,
          rank: rank,
          is_completed: true
        })
      });
    } catch (error) {
      console.error('Failed to save Mayon game result:', error);
    }
  }

  function getLevelTheme(levelId) {
    const themes = {
      1: { accent: '#D9480F', softBg: '#FFF1E8', badgeBg: '#FFE2CC', text: '#7A2E0E' },
      2: { accent: '#B65A00', softBg: '#FFF4E6', badgeBg: '#FFE7C2', text: '#704100' },
      3: { accent: '#CC3F2D', softBg: '#FFF0EE', badgeBg: '#FFDCD7', text: '#7A261B' },
      4: { accent: '#C53A3A', softBg: '#FFF0F0', badgeBg: '#FFD9D9', text: '#7D2525' },
      5: { accent: '#9C2F45', softBg: '#FFF0F5', badgeBg: '#FFD7E5', text: '#612032' },
      6: { accent: '#4B5BA8', softBg: '#EEF1FF', badgeBg: '#DCE3FF', text: '#2F3B77' },
      7: { accent: '#1F8A70', softBg: '#EAFBF6', badgeBg: '#D2F4E9', text: '#145B4A' }
    };
    return themes[levelId] || themes[1];
  }

  // helper: render current level
  function renderCurrentLevel() {
    if (currentLevelIndex >= levels.length) {
      // game finished, show results
      showFinalResults();
      return;
    }

    const level = levels[currentLevelIndex];
    const theme = getLevelTheme(level.id);
    const isAnswered = userAnswers[currentLevelIndex] !== undefined && userAnswers[currentLevelIndex] !== null;
    const userWasCorrect = userAnswers[currentLevelIndex];

    // Build options html with dynamic classes (if answered, mark correct/wrong style)
    let optionsHtml = '';
    level.options.forEach((opt, idx) => {
      let additionalClass = '';
      let disabledAttr = isAnswered ? 'disabled' : '';
      let prefixLetter = String.fromCharCode(65 + idx); // A, B, C

      // if already answered, highlight correct answer (green) and if selected wrong show red
      if (isAnswered) {
        if (opt.correct) {
          additionalClass = 'correct-feedback';
        } else if (selectedOptionIndex === idx && !opt.correct) {
          additionalClass = 'wrong-feedback';
        } else {
          additionalClass = '';
        }
        disabledAttr = 'disabled';
      }

      optionsHtml += `
        <button class="option-btn ${additionalClass}" data-opt-index="${idx}" ${disabledAttr}>
          <span class="option-prefix">${prefixLetter}</span>
          <span>${opt.text}</span>
        </button>
      `;
    });

    // feedback display if answered
    let feedbackHtml = '';
    if (isAnswered) {
      const feedbackMsg = level.feedback;
      const correctnessMsg = userWasCorrect ? '✅ Tamang sagot! ' : '❌ Mali. ';
      const feedbackBg = userWasCorrect ? theme.softBg : '#FFEFEF';
      const feedbackText = userWasCorrect ? theme.text : '#9A2E2A';
      const feedbackBorder = userWasCorrect ? theme.accent : '#D9534F';
      feedbackHtml = `
        <div class="feedback-message" style="background:${feedbackBg}; color:${feedbackText}; border-left-color:${feedbackBorder};">
          ${correctnessMsg} ${feedbackMsg}
        </div>
      `;
    }

    // next button only if answered and not final level (or final but we show after)
    let nextButtonHtml = '';
    if (isAnswered && currentLevelIndex < levels.length - 1) {
      nextButtonHtml = `<div class="next-btn-wrapper"><button class="next-btn" id="nextLevelBtn" style="background:${theme.accent};">➡️ Susunod na Antas</button></div>`;
    } else if (isAnswered && currentLevelIndex === levels.length - 1) {
      nextButtonHtml = `<div class="next-btn-wrapper"><button class="next-btn" id="finishGameBtn" style="background:${theme.accent};">🏁 Tapusin ang Misyon</button></div>`;
    }

    const progressText = `Antas ${currentLevelIndex+1} ng ${levels.length}`;

    const fullHtml = `
      <div class="level-badge" style="background:${theme.badgeBg}; border-color:${theme.accent}; color:${theme.text};">🎯 ${progressText} | DRR Officer</div>
      <div class="scenario" style="background:${theme.softBg}; border-left-color:${theme.accent};">
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

    // attach event listeners to option buttons if not locked
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
      // if answered attach next/finish listeners if present
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
    // lock the question
    answerLock = true;
    selectedOptionIndex = optIndex;
    if (isCorrect) {
      score++;
      userAnswers[currentLevelIndex] = true;
    } else {
      userAnswers[currentLevelIndex] = false;
    }
    // re-render with feedback
    renderCurrentLevel();
  }

  function goToNextLevel() {
    if (currentLevelIndex + 1 < levels.length) {
      currentLevelIndex++;
      answerLock = false;
      selectedOptionIndex = null;
      renderCurrentLevel();
    } else {
      // finish if somehow next is called on last
      finishGame();
    }
  }

  function finishGame() {
    // final results
    showFinalResults();
  }

  function showFinalResults() {
    // calculate total correct (score)
    const totalQuestions = levels.length;
    const correctCount = score;
    let rank = '';
    let rankEmoji = '';
    if (correctCount >= 6) {
      rank = 'Volcano Response Expert';
      rankEmoji = '🏆🌋✨';
    } else if (correctCount >= 3) {
      rank = 'Developing Responder';
      rankEmoji = '📈⚠️';
    } else {
      rank = 'Needs More Training';
      rankEmoji = '📚🔄';
    }

    // hide quiz panel content and show result
    quizPanel.style.display = 'none';
    resultArea.style.display = 'block';
    resultArea.innerHTML = `
      <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎖️ ${rankEmoji}</div>
      <div class="score-badge">${correctCount} / ${totalQuestions} correct</div>
      <div style="font-size: 1.4rem; font-weight: 700; margin: 0.6rem 0; color:#D9690F;">${rank}</div>
      <p style="margin: 1rem 0 0.5rem; background:#FFF3E6; padding: 10px; border-radius: 28px;">
        📋 <strong>Mission debrief:</strong> ${getFeedbackMessageByScore(correctCount)}
      </p>
      <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap; margin-top:12px;">
        <button class="restart-btn" id="restartGameBtn">🔄 Mag-restart ng Misyon</button>
        <a href="{{ route('module4.explore', ['completed' => 'mayon']) }}" class="restart-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; background:#E67E22;">📚 Balik sa Explore</a>
      </div>
    `;

    saveGameResult(rank);

    document.getElementById('restartGameBtn').addEventListener('click', () => {
      resetGame();
    });
  }

  function getFeedbackMessageByScore(scoreCount) {
    if (scoreCount >= 6) return "Kahanga-hanga! Iyong kahandaan at tamang desisyon ay nagligtas ng maraming buhay. Patuloy na maging bantay sa peligro!";
    if (scoreCount >= 3) return "Magandang simula! Kailangan mo pang pataasin ang iyong kaalaman sa pagtugon sa banta ng bulkan. Magsanay pa!";
    return "Kailangan ng karagdagang pagsasanay. Suriin ang mga tamang sagot at maging handa sa susunod na pagsubok. Ligtas na komunidad ay may tamang kaalaman!";
  }

  function resetGame() {
    // reset all state
    currentLevelIndex = 0;
    score = 0;
    answerLock = false;
    selectedOptionIndex = null;
    userAnswers = new Array(levels.length).fill(null);
    quizPanel.style.display = 'block';
    resultArea.style.display = 'none';
    renderCurrentLevel();
    // scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // initial render
  renderCurrentLevel();
  resultArea.style.display = 'none';

  // additional safeguard for direct style changes
  window.addEventListener('load', () => {
    // ensure any possible mismatch
    if (quizPanel.style.display === 'none') quizPanel.style.display = 'block';
  });
</script>
</body>
</html>