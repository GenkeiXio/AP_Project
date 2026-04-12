<div class="story" id="rolly">

<style>
    .gamified-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
    }

    .story-title {
        font-size: 24px;
        font-weight: 800;
        color: #222;
    }

    .story-xp {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 14px;
    }

    .card-header-gamified {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .card-number {
        background: #667eea;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .card-points {
        background: #ffc107;
        color: #222;
        padding: 5px 12px;
        border-radius: 15px;
        font-weight: 700;
        font-size: 12px;
    }

    .learning-objective {
        background: #e3f2fd;
        border-left: 4px solid #667eea;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #333;
    }

    .learning-objective strong {
        color: #667eea;
    }

    .fact-box {
        background: linear-gradient(135deg, #fff5e1, #ffe0b2);
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #ff9800;
    }

    .fact-box strong {
        color: #e65100;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }

    .stat-card {
        background: white;
        border: 2px solid #667eea;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        font-weight: 700;
    }

    .stat-number {
        font-size: 24px;
        color: #667eea;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }

    .quick-check {
        background: #f3e5f5;
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #764ba2;
    }

    .quick-check-title {
        font-weight: 700;
        color: #764ba2;
        margin-bottom: 8px;
    }

    .quick-check-btn {
        background: #764ba2;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        margin-top: 8px;
        transition: all 0.3s ease;
    }

    .quick-check-btn:hover {
        background: #667eea;
        transform: translateY(-2px);
    }

    .achievement-badge {
        display: inline-block;
        background: gold;
        color: #222;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        margin: 5px 5px 5px 0;
        animation: pulse 0.5s ease-in-out;
    }

    @keyframes pulse {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .step-nav {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
    }

    .step-nav button {
        flex: 1;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: 600;
        background: #f8fafc;
        color: #1f2937;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }

    .step-nav button:hover {
        background: #edf2f7;
        transform: translateY(-1px);
    }

    .final-game-cta {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 14px 22px;
        background: linear-gradient(135deg, #0d6efd, #6bc1ff);
        color: white !important;
        border: none !important;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 14px 30px rgba(13, 110, 253, 0.22);
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .final-game-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 36px rgba(13, 110, 253, 0.26);
    }
</style>

<div class="gamified-header">
    <div class="story-title">🌀 Super Typhoon Rolly</div>
    <div class="story-xp" id="totalXP">Total XP: 0</div>
</div>

<div class="story-progress">
    <div class="progress">
        <div id="rollyProgressBar" class="progress-bar bg-warning" style="width: 12.5%;"></div>
    </div>
    <div id="rollyProgressLabel" class="story-progress-label">Step 1 / 8</div>
</div>

<p>
    <small>
        📍 Location: Tabaco, Albay | 
        Source: 
        <a href="https://www.gmanetwork.com/news/topstories/nation/762951/rolly-worst-to-hit-tabaco-in-albay-since-1952-says-mayor/story/" 
           target="_blank" 
           style="color:#0d6efd; text-decoration:underline;">
            GMA News Online (2020)
        </a>
    </small>
</p>

<!-- CARD 1 -->
<div class="step active" id="rolly-step1">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">1</div>
            <h5 style="margin: 0;">🧩 ANO ANG NANGYARI?</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Alamin ang kahulugan at lakas ng Super Typhoon Rolly
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/rolly/card1_1.jpg') }}">
        <img src="{{ asset('pictures/Module4/rolly/card1_2.jpg') }}">
        <img src="{{ asset('pictures/Module4/rolly/card1_3.jpg') }}">
    </div>

    <div class="fact-box">
        <strong>💡 Key Facts:</strong>
        <ul style="margin: 8px 0 0 20px; padding: 0;">
            <li>Pinakamalakas na bagyo sa Tabaco mula 1952</li>
            <li>Mas malakas kaysa Reming at Niña</li>
            <li>Classified as Super Typhoon (Super Taifun)</li>
        </ul>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-number">68</div>
            <div class="stat-label">Taon simula 1952</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">🌪️</div>
            <div class="stat-label">Maximum Strength</div>
        </div>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Mabilis na Ideya</div>
        <p style="margin: 8px 0; font-size: 14px;">Isang makasaysayan at napakalakas na sakuna na nagbago ng kapalaran ng Tabaco</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Ngayon alam mo na ang kahalagahan ng storm classification.')">Maintindihan ✓</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" disabled>← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step1', 100); nextStep(2); updateStoryProgress(currentStory, 2);">Susunod →</button>
    </div>
</div>

<!-- CARD 2 -->
<div class="step" id="rolly-step2">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">2</div>
            <h5 style="margin: 0;">🧩 ULAT NG PINSALA</h5>
        </div>
        <!-- <div class="card-points">+100 XP</div> -->
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Maintindihan ang malaking pinsala sa nangailalang aspeto ng buhay
    </div>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card2_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card2_2.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card2_3.jpg') }}">
</div>

<div class="stat-grid">
<div class="stat-card">
<div class="stat-number">₱2.5B</div>
<div class="stat-label">Pinsala</div>
</div>
<div class="stat-card">
<div class="stat-number">3,500</div>
<div class="stat-label">Nasirong Bahay</div>
</div>
<div class="stat-card">
<div class="stat-number">15,500</div>
<div class="stat-label">Napinsalang Bahay</div>
</div>
<div class="stat-card">
<div class="stat-number">90%</div>
<div class="stat-label">Nasirong Bangka</div>
</div>
</div>

<div class="fact-box">
<strong>💡 Impact Assessment:</strong>
<p style="margin: 8px 0 0 0; font-size: 14px;">Malubhang naapektuhan ang tirahan ng mga pamilya at ang pangunahing industriya ng pangingisda sa lugar.</p>
</div>

<div class="quick-check">
<div class="quick-check-title">❓ Critical Thinking</div>
<p style="margin: 8px 0; font-size: 14px;">Bakit mahalagang i-monitor ang ebolusyon ng sakuna?</p>
<button class="quick-check-btn" onclick="alert('✅ Tama! Para makapag-plano ng mabuting solusyon at makatulong ng mas marami.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(1);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step2', 100); nextStep(3); updateStoryProgress(currentStory, 3);">Susunod →</button>
</div>
</div>

<!-- CARD 3 -->
<div class="step" id="rolly-step3">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">3</div>
<h5 style="margin: 0;">🧩 KAKULANGAN SA PANGANGAILANGAN</h5>
</div>
<div class="card-points">+100 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Learning Goal:</strong> Maintindihan ang humanitarian crisis pagkatapos ng sakuna
</div>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card3_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card3_2.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card3_3.jpg') }}">
</div>

<div class="stat-grid">
<div class="stat-card">
<div class="stat-number">⚡</div>
<div class="stat-label">Walang Kuryente</div>
</div>
<div class="stat-card">
<div class="stat-number">💧</div>
<div class="stat-label">Kulang na Tubig</div>
</div>
<div class="stat-card">
<div class="stat-number">15</div>
<div class="stat-label">Barangay Apektado</div>
</div>
</div>

<div class="fact-box">
<strong>⚠️ Humanitarian Crisis:</strong>
<p style="margin: 8px 0 0 0; font-size: 14px;">Naging mahirap ang pamumuhay at kaligtasan ng mga pamilya. Ang walang kuryente at tubig ay nagdulot ng health risks.</p>
</div>

<div class="achievement-badge">🏆 Awareness Champion</div>

<div class="quick-check">
<div class="quick-check-title">❓ Real-World Application</div>
<p style="margin: 8px 0; font-size: 14px;">Ano ang mga pangangailangan na dapat bigyan ng priyoridad pagkatapos ng sakuna?</p>
<button class="quick-check-btn" onclick="alert('✅ Tama! Tubig, pagkain, kuryente, at medikal na tulong ang priority.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(2);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step3', 100); nextStep(4); updateStoryProgress(currentStory, 4);">Susunod →</button>
</div>
</div>

<!-- CARD 4 -->
<div class="step" id="rolly-step4">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">4</div>
<h5 style="margin: 0;">🧩 KARANASAN SA BAHA</h5>
</div>
<div class="card-points">+100 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Learning Goal:</strong> Unawain ang mga peligrong dala ng extreme flooding
</div>

<div class="img-grid">
    <img src="{{ asset('pictures/Module4/rolly/card4_1.png') }}">
    <img src="{{ asset('pictures/Module4/rolly/card4_2.png') }}">
    <img src="{{ asset('pictures/Module4/rolly/card4_3.png') }}">
</div>

<div class="fact-box">
<strong>🌊 Flood Characteristics:</strong>
<ul style="margin: 8px 0 0 20px; padding: 0;">
<li>Abot leeg ang baha</li>
<li>Napilitang lumangoy ang mga tao</li>
<li>Maraming bahay ang tinangay</li>
</ul>
</div>

<div class="stat-grid">
<div class="stat-card">
<div class="stat-number">🏠</div>
<div class="stat-label">Bahay Tinangay</div>
</div>
<div class="stat-card">
<div class="stat-number">⚠️</div>
<div class="stat-label">Life-Threatening</div>
</div>
</div>

<div class="quick-check">
<div class="quick-check-title">❓ Safety Awareness</div>
<p style="margin: 8px 0; font-size: 14px;">Bakit HINDI dapat lumangoy ang mga tao sa baha?</p>
<button class="quick-check-btn" onclick="alert('✅ Tama! Mabilis na agos, kontaminasyon, at mga nakatagong obstacle ang naghihintay.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(3);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step4', 100); nextStep(5); updateStoryProgress(currentStory, 5);">Susunod →</button>
</div>
</div>

<!-- CARD 5 -->
<div class="step" id="rolly-step5">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">5</div>
<h5 style="margin: 0;">🧩 EPEKTO SA MGA TAO</h5>
</div>
<div class="card-points">+100 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Learning Goal:</strong> Kilalanin ang kahalagahan ng disaster preparedness
</div>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card5_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card5_2.jpg') }}">
</div>

<div class="fact-box">
<strong>🎯 Silver Lining:</strong>
<ul style="margin: 8px 0 0 20px; padding: 0;">
<li>Hirap ang mga residente</li>
<li>Kulang ang suplay</li>
<li><strong style="color: green;">✅ Walang naitalang namatay</strong></li>
</ul>
</div>

<div class="stat-grid">
<div class="stat-card">
<div class="stat-number">0</div>
<div class="stat-label">Namatay</div>
</div>
<div class="stat-card">
<div class="stat-number">💪</div>
<div class="stat-label">Community Resilience</div>
</div>
</div>

<div class="achievement-badge">🎖️ Preparedness Master</div>

<div class="quick-check">
<div class="quick-check-title">❓ Critical Insight</div>
<p style="margin: 8px 0; font-size: 14px;">Bakit walang namatay kahit napakalakas ng bagyo?</p>
<button class="quick-check-btn" onclick="alert('✅ Tama! Ang kahandaan, mabilis na paglikas, at disiplina ang nag-save ng buhay.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(4);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step5', 100); nextStep(6); updateStoryProgress(currentStory, 6);">Susunod →</button>
</div>
</div>

<!-- CARD 6 -->
<div class="step" id="rolly-step6">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">6</div>
<h5 style="margin: 0;">🧩 PINSALA SA PAMANA</h5>
</div>
<div class="card-points">+100 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Learning Goal:</strong> Maunawaan ang kahalagahan ng cultural preservation
</div>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card6_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card6_2.png') }}">
<img src="{{ asset('pictures/Module4/rolly/card6_3.png') }}">
</div>

<div class="fact-box">
<strong>🏛️ Cultural Heritage Loss:</strong>
<ul style="margin: 8px 0 0 20px; padding: 0;">
<li>Nasira ang 160 taong gulang na simbahan</li>
<li>Nasira ang makasaysayang bahay</li>
</ul>
</div>

<div class="quick-check">
<div class="quick-check-title">❓ Community Values</div>
<p style="margin: 8px 0; font-size: 14px;">Bakit mahalaga i-restore ang mga historical structures?</p>
<button class="quick-check-btn" onclick="alert('✅ Tama! Ito ay bahagi ng ating identity at history na dapat ipasa sa susunod na henerasyon.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(5);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step6', 100); nextStep(7); updateStoryProgress(currentStory, 7);">Susunod →</button>
</div>
</div>

<!-- CARD 7 -->
<div class="step" id="rolly-step7">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">7</div>
<h5 style="margin: 0;">🧩 PAGTUGON NG KOMUNIDAD</h5>
</div>
<div class="card-points">+100 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Learning Goal:</strong> Makita ang kapangyarihan ng bayanihan at community unity
</div>

<div class="img-grid">
<img src="{{ asset('pictures/Module4/rolly/card7_1.jpg') }}">
<img src="{{ asset('pictures/Module4/rolly/card7_2.jpg') }}">
</div>

<div class="fact-box">
<strong>🤝 Community Spirit:</strong>
<ul style="margin: 8px 0 0 20px; padding: 0;">
<li>Pagkakaisa at pagtutulungan</li>
<li>Itinuring na pagsubok ng pananampalataya</li>
</ul>
</div>

<div class="achievement-badge">🏆 Bayanihan Champion</div>
<div class="achievement-badge">❤️ Community Leader</div>

<div class="quick-check">
<div class="quick-check-title">❓ Personal Reflection</div>
<p style="margin: 8px 0; font-size: 14px;">Paano ka makakatulong sa iyong komunidad sa panahon ng sakuna?</p>
<button class="quick-check-btn" onclick="alert('✅ Maganda! Ang iyong malasakit at voluntarismo ay magagamit.')">Sagutin</button>
</div>

<div class="step-nav">
<button class="btn btn-secondary" onclick="nextStep(6);">← Nakaraan</button>
<button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step7', 100); nextStep(8); updateStoryProgress(currentStory, 8);">Susunod →</button>
</div>
</div>

<!-- CARD 8 - SUMMARY & GAME -->
<div class="step" id="rolly-step8">
<div class="card-header-gamified">
<div style="display: flex; gap: 10px; align-items: center;">
<div class="card-number">8</div>
<h5 style="margin: 0;">🧩 BUOD & PAGSUSULIT</h5>
</div>
<div class="card-points">+200 XP</div>
</div>

<div class="learning-objective">
<strong>📖 Final Goal:</strong> I-apply ang natutunan sa interactive game scenario
</div>

<div class="fact-box" style="background: linear-gradient(135deg, #d4edda, #c3e6cb); border-left-color: #28a745;">
<strong style="color: #155724;">📚 Complete Summary:</strong>
<p style="margin: 8px 0 0 0; font-size: 14px; color: #155724;">
Ang Super Typhoon Rolly ay itinuturing na pinakamalakas na bagyong tumama sa Tabaco, Albay mula pa noong 1952, na nagdulot ng humigit-kumulang ₱2.5 bilyong pinsala sa mga bahay, kabuhayan, at imprastruktura. Libu-libong tahanan ang nawasak o napinsala, at halos lahat ng bangka ng mga mangingisda ay nasira, habang nawalan ng kuryente at sapat na suplay ng tubig ang maraming barangay. Naranasan din ng mga residente ang matinding pagbaha kung saan ang ilan ay napilitang lumangoy upang makaligtas. Nasira rin ang mga makasaysayang gusali, kabilang ang isang lumang simbahan at bahay, na nagpapakita ng epekto ng sakuna sa kultura at kasaysayan. Sa kabila ng matinding pinsala at paghihirap, <strong>walang naitalang nasawi</strong>, na nagpapatunay sa kahalagahan ng kahandaan, disiplina, at pagtutulungan ng komunidad sa pagharap sa kalamidad.
</p>
</div>

<div style="background: #e3f2fd; border: 2px solid #667eea; border-radius: 10px; padding: 15px; margin: 15px 0; text-align: center;">
<div style="font-size: 24px; font-weight: 800; color: #667eea; margin-bottom: 10px;">🎯 Key Takeaways</div>
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px;">
<div style="background: white; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 12px;">✅ Disaster Preparedness Saves Lives</div>
<div style="background: white; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 12px;">🤝 Community Unity Matters</div>
<div style="background: white; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 12px;">🏛️ Preserve Our Heritage</div>
<div style="background: white; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 12px;">💪 Build Resilience</div>
</div>
</div>

<!-- OPTIONAL VIDEO -->
<p><strong>🎥 Optional Video:</strong></p>
<iframe width="100%" height="315"
src="https://www.youtube.com/embed/mtf1JAQ2hq4"
title="YouTube video"
allowfullscreen></iframe>

<div style="display: grid; grid-template-columns: 1fr; gap: 10px; margin-top: 30px;">
    <a href="{{ route('module4.rolly.game') }}" onclick="awardStepXP(currentStory+'-step8', 200)" class="btn btn-warning final-game-cta" style="text-decoration: none; display: flex; align-items: center; justify-content: center; font-weight: 600;">🎮 Maglaro ng Game</a>
</div>

</div>

</div>
