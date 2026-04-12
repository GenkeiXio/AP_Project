<div class="story" id="lindol">

<style>
    .gamified-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #28a745;
    }

    .story-title {
        font-size: 24px;
        font-weight: 800;
        color: #222;
    }

    .story-xp {
        background: linear-gradient(135deg, #28a745, #1e7e34);
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
        background: #28a745;
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
        background: #e8f5e9;
        border-left: 4px solid #28a745;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #333;
    }

    .learning-objective strong {
        color: #28a745;
    }

    .fact-box {
        background: linear-gradient(135deg, #f1f8f4, #e0f2f1);
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #28a745;
    }

    .fact-box strong {
        color: #28a745;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }

    .stat-card {
        background: white;
        border: 2px solid #28a745;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        font-weight: 700;
    }

    .stat-number {
        font-size: 24px;
        color: #28a745;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }

    .quick-check {
        background: #f1faf8;
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #1e7e34;
    }

    .quick-check-title {
        font-weight: 700;
        color: #1e7e34;
        margin-bottom: 8px;
    }

    .quick-check-btn {
        background: #1e7e34;
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
        background: #28a745;
        transform: translateY(-2px);
    }

    .achievement-badge {
        display: inline-block;
        background: #ffc107;
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
    }

    .story-progress {
        margin-top: 18px;
    }

    .story-progress .progress {
        height: 10px;
        border-radius: 999px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .story-progress-label {
        font-size: 14px;
        font-weight: 700;
        color: #28a745;
    }

    .final-game-cta {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 14px 22px;
        background: linear-gradient(135deg, #28a745, #45b358);
        color: white !important;
        border: none !important;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 14px 30px rgba(40, 167, 69, 0.22);
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .final-game-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 36px rgba(40, 167, 69, 0.26);
    }

    .symmetric-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin: 10px 0;
    }

    .symmetric-grid img {
        width: 100%;
        border-radius: 10px;
        aspect-ratio: 1;
        object-fit: cover;
    }

    .two-image-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin: 10px 0;
    }

    .two-image-grid img {
        width: 100%;
        border-radius: 10px;
        aspect-ratio: 1;
        object-fit: cover;
    }
</style>

<div class="gamified-header">
    <div class="story-title">🌍 Malakas na Lindol</div>
    <div class="story-xp" id="totalXP">Total XP: 0</div>
</div>

<div class="story-progress">
    <div class="progress">
        <div id="lindolProgressBar" class="progress-bar bg-success" style="width: 12.5%;"></div>
    </div>
    <div id="lindolProgressLabel" class="story-progress-label">Step 1 / 8</div>
</div>

<p>
    <small>
        📍 Location: Bogo City, Cebu | 
        Source: 
        <a href="https://www.abs-cbn.com/news/regions/2026/1/7/lindol-sa-manay-davao-oriental-1404" 
           target="_blank" 
           style="color:#28a745; text-decoration:underline;">
            ABS-CBN News. (2026, January 7). Mga estudyante sa Davao Region, lumikas sa lindol.
        </a>
    </small>
</p>

<!-- CARD 1 -->
<div class="step active" id="lindol-step1">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">1</div>
            <h5 style="margin: 0;">🧩 ANO ANG NANGYARI?</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Maunawaan ang epicenter at lawak ng pinsala mula sa magnitude 6.9 na lindol
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card1_1.jpg') }}" alt="Lindol - Card 1 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card1_2.jpg') }}" alt="Lindol - Card 1 Image 2">
        <img src="{{ asset('pictures/Module4/lindol/card1_3.jpg') }}" alt="Lindol - Card 1 Image 3">
    </div>

    <div class="fact-box">
        <strong>💡 Observation:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Ang magnitude 6.9 na lindol ay umabot na sa Bogo City at nagdulot ng malawak na pinsala sa iba't ibang bahagi ng lungsod.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Quick Insight</div>
        <p style="margin: 8px 0; font-size: 14px;">Bakit mahalaga ang unang kahulugan ng lindol?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Ang mabilis na pag-intindi ay tumutulong sa mabilis na response.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" disabled>← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step1', 100); nextStep(2); updateStoryProgress(currentStory, 2);">Susunod →</button>
    </div>
</div>

<!-- CARD 2 -->
<div class="step" id="lindol-step2">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">2</div>
            <h5 style="margin: 0;">🧩 ULAT NG KASUALTI</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Malaman ang epekto sa buhay ng mga tao at komunidad
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card2_1.jpg') }}" alt="Lindol - Card 2 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card2_2.jpg') }}" alt="Lindol - Card 2 Image 2">
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-number">69</div>
            <div class="stat-label">Nasawi</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">175</div>
            <div class="stat-label">Nasugatan</div>
        </div>
    </div>

    <div class="fact-box">
        <strong>💡 Casualty Report:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Maraming tao ang nasawi at nasugatan dahil sa mga gumuhong gusali at bahay sa lindol.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Critical Thinking</div>
        <p style="margin: 8px 0; font-size: 14px;">Bakit importante ang mabilis na ulat ng casualty?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Para makapag-deploy ng rescue teams at medical assistance agad.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(1);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step2', 100); nextStep(3); updateStoryProgress(currentStory, 3);">Susunod →</button>
    </div>
</div>

<!-- CARD 3 -->
<div class="step" id="lindol-step3">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">3</div>
            <h5 style="margin: 0;">🧩 LAWAK NG PINSALA</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Unawain ang pagkasira ng mga gusali at imprastruktura
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card3_1.jpg') }}" alt="Lindol - Card 3 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card3_2.jpg') }}" alt="Lindol - Card 3 Image 2">
        <img src="{{ asset('pictures/Module4/lindol/card3_3.jpg') }}" alt="Lindol - Card 3 Image 3">
    </div>

    <div class="fact-box">
        <strong>🏚️ Structural Damage:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Maraming gusali at bahay ang gumuho dahil sa lakas ng lindol, na nag-iwan ng libu-libong tao na walang tahanan.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Lesson</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang dapat gawin para maiwasan ang pagsisira ng gusali sa lindol?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Earthquake-resistant na disenyo at matibay na pundasyon.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(2);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step3', 100); nextStep(4); updateStoryProgress(currentStory, 4);">Susunod →</button>
    </div>
</div>

<!-- CARD 4 -->
<div class="step" id="lindol-step4">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">4</div>
            <h5 style="margin: 0;">🧩 SITWASYON SA MGA OSPITAL</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Kilalanin ang hamon sa healthcare system sa oras ng disaster
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card4_1.jpg') }}" alt="Lindol - Card 4 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card4_2.jpg') }}" alt="Lindol - Card 4 Image 2">
    </div>

    <div class="fact-box">
        <strong>🏥 Hospital Crisis:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Napuno ang mga ospital ng mga biktima kaya maraming pasyente ang ginagamot sa labas. Kailangan ng temporary medical facilities.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Problem Solving</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang solusyon kapag puno ang ospital?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Mag-set up ng temporary treatment areas at mag-triage.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(3);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step4', 100); nextStep(5); updateStoryProgress(currentStory, 5);">Susunod →</button>
    </div>
</div>

<!-- CARD 5 -->
<div class="step" id="lindol-step5">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">5</div>
            <h5 style="margin: 0;">🧩 PAGLIKAS AT KALIGTASAN</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Maintindihan ang evacuation at temporary shelter protocols
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card5_1.jpg') }}" alt="Lindol - Card 5 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card5_2.jpg') }}" alt="Lindol - Card 5 Image 2">
        <img src="{{ asset('pictures/Module4/lindol/card5_3.jpg') }}" alt="Lindol - Card 5 Image 3">
    </div>

    <div class="fact-box">
        <strong>🏕️ Evacuation & Sheltering:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Maraming residente ang napilitang lumikas at nanirahan pansamantala sa evacuation centers habang inaayos ang kanilang mga tahanan.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Safety Awareness</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang kailangan sa evacuation centers?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Pagkain, tubig, medical kit, at psychosocial support.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(4);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step5', 100); nextStep(6); updateStoryProgress(currentStory, 6);">Susunod →</button>
    </div>
</div>

<!-- CARD 6 -->
<div class="step" id="lindol-step6">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">6</div>
            <h5 style="margin: 0;">🧩 AFTERSHOCKS AT EPEKTO</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Kilalanin ang secondary hazards ng aftershocks
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card6_1.jpg') }}" alt="Lindol - Card 6 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card6_2.jpg') }}" alt="Lindol - Card 6 Image 2">
    </div>

    <div class="fact-box">
        <strong>⚠️ Aftershock Hazards:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Patuloy ang mga aftershocks na nagdulot ng karagdagang pinsala, may mga bitak sa kalsada at pagkawala ng kuryente sa buong lungsod.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Risk Awareness</div>
        <p style="margin: 8px 0; font-size: 14px;">Saan ang ligtas na lugar sa panahon ng aftershocks?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Sa open spaces, malayo sa mga gusali at tulay.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(5);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step6', 100); nextStep(7); updateStoryProgress(currentStory, 7);">Susunod →</button>
    </div>
</div>

<!-- CARD 7 -->
<div class="step" id="lindol-step7">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">7</div>
            <h5 style="margin: 0;">🧩 PAGTUGON NG KOMUNIDAD AT PAMAHALAAN</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Learning Goal:</strong> Makita ang kapangyarihan ng rescue operations at community resilience
    </div>

    <div class="two-image-grid">
        <img src="{{ asset('pictures/Module4/lindol/card7_1.jpg') }}" alt="Lindol - Card 7 Image 1">
        <img src="{{ asset('pictures/Module4/lindol/card7_2.jpg') }}" alt="Lindol - Card 7 Image 2">
    </div>

    <div class="fact-box">
        <strong>🤝 Community Response:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Aktibong tumutulong ang rescue teams, volunteers, at komunidad sa pagkuha ng mga nabaon, pagbibigay ng emergency aid, at pagbangon ng komunidad.</p>
    </div>

    <div class="achievement-badge">🏆 Bayanihan Champion</div>
    <div class="achievement-badge">❤️ Community Hero</div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Personal Reflection</div>
        <p style="margin: 8px 0; font-size: 14px;">Paano ka makakatulong sa iyong komunidad kapag may sakuna?</p>
        <button class="quick-check-btn" onclick="alert('✅ Maganda! Ang voluntarismo at pagkakaisa ay ang susi sa pagbangon.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(6);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step7', 100); nextStep(8); updateStoryProgress(currentStory, 8);">Susunod →</button>
    </div>
</div>

<!-- CARD 8 - SUMMARY & GAME -->
<div class="step" id="lindol-step8">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">8</div>
            <h5 style="margin: 0;">🧩 BUOD</h5>
        </div>
        <div class="card-points">+200 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Final Goal:</strong> Ibuod ang magnitude 6.9 na lindol at ang kahalagahan ng disaster preparedness
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/lindol/card8_1.png') }}" alt="Lindol - Card 8 Image" style="width: 100%; max-width: 600px; margin: 0 auto; display: block;">
    </div>

    <div class="fact-box" style="background: linear-gradient(135deg, #d4f1e8, #bde7d5); border-left-color: #28a745;">
        <strong style="color: #155724;">📚 Summary:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px; color: #155724;">
            Ang magnitude 6.9 na lindol na tumama sa Bogo City ay nagdulot ng matinding pinsala sa buhay at ari-arian, kung saan umabot sa 69 ang nasawi at 175 ang nasugatan dahil sa mga gumuhong gusali at bahay. Maraming residente ang napilitang lumikas habang ang mga ospital ay napuno ng mga biktima. Naramdaman ang pagyanig sa iba't ibang bahagi ng Visayas at Bicol, at sinundan ito ng daan-daang aftershocks na nagpalala ng sitwasyon. Sa kabila nito, mabilis na kumilos ang pamahalaan at mga rescue teams upang magbigay ng tulong, magsagawa ng search and rescue operations, at tiyakin ang kaligtasan ng mga apektadong komunidad, na nagpapakita ng kahalagahan ng kahandaan at pagtutulungan sa panahon ng sakuna.
        </p>
    </div>

    <div class="fact-box" style="background: #fff9e6; border-left-color: #ff9800;">
        <strong>🎥 Optional Video:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Panoorin lamang kung may libreng data. Kung wala, maaari ka nang magpatuloy sa susunod na bahagi.</p>
    </div>

    <iframe width="100%" height="315"
            src="https://www.youtube.com/embed/48qGLqpyutQ"
            title="Optional Video"
            allowfullscreen></iframe>

    <div class="step-nav final-summary" style="margin-top: 30px;">
        <a href="{{ route('module4.lindol.game') }}" onclick="awardStepXP(currentStory+'-step8', 200)" class="btn btn-success final-game-cta">Maglaro ng Lindol Game</a>
    </div>
</div>

</div>
