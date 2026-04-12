<div class="story" id="baha">

<style>
    .gamified-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #0d6efd;
    }

    .story-title {
        font-size: 24px;
        font-weight: 800;
        color: #222;
    }

    .story-xp {
        background: linear-gradient(135deg, #0d6efd, #0056b3);
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
        background: #0d6efd;
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
        background: #e7f1ff;
        border-left: 4px solid #0d6efd;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #333;
    }

    .learning-objective strong {
        color: #0d6efd;
    }

    .fact-box {
        background: linear-gradient(135deg, #eef7ff, #dbeeff);
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #0d6efd;
    }

    .fact-box strong {
        color: #0d6efd;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }

    .stat-card {
        background: white;
        border: 2px solid #0d6efd;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        font-weight: 700;
    }

    .stat-number {
        font-size: 24px;
        color: #0d6efd;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }

    .quick-check {
        background: #f1f7ff;
        border-radius: 10px;
        padding: 15px;
        margin: 15px 0;
        border-left: 4px solid #0056b3;
    }

    .quick-check-title {
        font-weight: 700;
        color: #0056b3;
        margin-bottom: 8px;
    }

    .quick-check-btn {
        background: #0056b3;
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
        background: #0d6efd;
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
    <div class="story-title">🌊 Baha sa Guinobatan</div>
    <div class="story-xp" id="totalXP">Total XP: 0</div>
</div>

<div class="story-progress">
    <div class="progress">
        <div id="bahaProgressBar" class="progress-bar bg-success" style="width: 16.67%;"></div>
    </div>
    <div id="bahaProgressLabel" class="story-progress-label">Step 1 / 6</div>
</div>

<p>
    <small>
        📍 Location: Guinobatan, Albay | 
        Source: 
        <a href="https://www.gmanetwork.com/regionaltv/news/109662/flashflood-hits-guinobatan-albay/story/" 
           target="_blank" 
           style="color:#0d6efd; text-decoration:underline;">
            Abordo, V. J. (2025, August 13). GMA Regional TV News
        </a>
    </small>
</p>

<!-- CARD 1 -->
<div class="step active" id="baha-step1">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">1</div>
            <h5 style="margin: 0;">🧩 ANO ANG NANGYARI?</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Layuning Pangkatuto:</strong> Alamin ang biglaang pagragasa ng baha at lahar mula sa Bulkang Mayon
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/baha/card1_1.png') }}" alt="Baha sa Guinobatan - Card 1 Image 1">
        <img src="{{ asset('pictures/Module4/baha/card1_2.jpg') }}" alt="Baha sa Guinobatan - Card 1 Image 2">
    </div>

    <div class="fact-box">
        <strong>💡 Obserbasyon:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Ipinapakita dito ang biglaang pagragasa ng baha na naging parang ilog ang kalsada dahil sa malakas na ulan at lahar mula sa Mayon Volcano.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Mabilis na Pagsusuri</div>
        <p style="margin: 8px 0; font-size: 14px;">Paano nagiging peligro ang paglabas ng baha sa kalsada?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Nagiging daan ang kalsada para sa malaki at mabilis na agos ng putik at bato.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" disabled>← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step1', 100); nextStep(2); updateStoryProgress(currentStory, 2);">Susunod →</button>
    </div>
</div>

<!-- CARD 2 -->
<div class="step" id="baha-step2">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">2</div>
            <h5 style="margin: 0;">🧩 DALUYAN NG BAHA</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Layuning Pangkatuto:</strong> Ipakita ang panganib ng maputik na baha at lahar sa tao at sasakyan
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/baha/card2_1.jpg') }}" alt="Baha sa Guinobatan - Card 2 Image 1">
        <img src="{{ asset('pictures/Module4/baha/card2_2.jpg') }}" alt="Baha sa Guinobatan - Card 2 Image 2">
        <img src="{{ asset('pictures/Module4/baha/card1_2.jpg') }}" alt="Baha sa Guinobatan - Card 2 Image 3">
    </div>

    <div class="fact-box">
        <strong>💡 Danger Zone:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Makikita ang maputik na baha na may kasamang bato at buhangin (lahar), na delikado sa tao at sasakyan.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Kritikal na Pag-iisip</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang dapat iwasan kapag may baha na may halong lahar?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Iwasan ang pagpunta sa baha at putik dahil sa madulas at mabigat na agos.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(1);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step2', 100); nextStep(3); updateStoryProgress(currentStory, 3);">Susunod →</button>
    </div>
</div>

<!-- CARD 3 -->
<div class="step" id="baha-step3">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">3</div>
            <h5 style="margin: 0;">🧩 SANHI NG SAKUNA</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Layuning Pangkatuto:</strong> Tuklasin kung paano nagsimula ang flashflood sa sobrang pag-ulan
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/baha/card3_1.jpg') }}" alt="Baha sa Guinobatan - Card 3 Image 1">
        <img src="{{ asset('pictures/Module4/baha/card3_2.jpg') }}" alt="Baha sa Guinobatan - Card 3 Image 2">
        <img src="{{ asset('pictures/Module4/baha/card3_3.jpg') }}" alt="Baha sa Guinobatan - Card 3 Image 3">
    </div>

    <div class="fact-box">
        <strong>💡 Root Cause:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Ang matinding ulan na tumagal ng mahigit isang oras ang nagpasimula ng pag-agos ng baha mula sa bulkan.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Aral</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang tumulong magpasimula ng flashflood dito?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Ang matinding ulan at lahar mula sa bulkan ay bumuo ng delubyong baha.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(2);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step3', 100); nextStep(4); updateStoryProgress(currentStory, 4);">Susunod →</button>
    </div>
</div>

<!-- CARD 4 -->
<div class="step" id="baha-step4">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">4</div>
            <h5 style="margin: 0;">🧩 EPEKTO SA KOMUNIDAD</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Layuning Pangkatuto:</strong> Tingnan ang epekto ng flashflood sa mga residente at kabuhayan
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/baha/card4_1.jpg') }}" alt="Baha sa Guinobatan - Card 4 Image 1">
        <img src="{{ asset('pictures/Module4/baha/card4_2.jpg') }}" alt="Baha sa Guinobatan - Card 4 Image 2">
    </div>

    <div class="fact-box">
        <strong>💡 Epekto sa Komunidad:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Ipinapakita ang epekto sa mga residente—hirap sa paglikas at panganib sa tahanan at kabuhayan.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Awareness</div>
        <p style="margin: 8px 0; font-size: 14px;">Anong dapat unahin ng mga residente sa ganitong sitwasyon?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Ang paglikas at pagsunod sa babala ang unang gawin.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(3);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step4', 100); nextStep(5); updateStoryProgress(currentStory, 5);">Susunod →</button>
    </div>
</div>

<!-- CARD 5 -->
<div class="step" id="baha-step5">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">5</div>
            <h5 style="margin: 0;">🧩 PAGTUGON AT PAG-IINGAT</h5>
        </div>
        <div class="card-points">+100 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Layuning Pangkatuto:</strong> Ipakita ang mga ginawa ng pamahalaan at kung paano nag-ingat ang komunidad
    </div>

    <div class="img-grid">
        <img src="{{ asset('pictures/Module4/baha/card5_1.jpg') }}" alt="Baha sa Guinobatan - Card 5 Image 1">
        <img src="{{ asset('pictures/Module4/baha/card5_2.jpg') }}" alt="Baha sa Guinobatan - Card 5 Image 2">
        <img src="{{ asset('pictures/Module4/baha/card5_3.jpg') }}" alt="Baha sa Guinobatan - Card 5 Image 3">
    </div>

    <div class="fact-box">
        <strong>💡 Mga Tugon:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Ipinapakita ang pagtugon ng pamahalaan—clearing operations, relief goods, at pagbibigay babala sa mga residente.</p>
    </div>

    <div class="quick-check">
        <div class="quick-check-title">❓ Response Check</div>
        <p style="margin: 8px 0; font-size: 14px;">Ano ang unang kailangan gawin pagkatapos ng flashflood?</p>
        <button class="quick-check-btn" onclick="alert('✅ Tama! Ang mabilis na pagtulong at pagbibigay ng babala ay mahalaga.')">Sagutin</button>
    </div>

    <div class="step-nav">
        <button class="btn btn-secondary" onclick="nextStep(4);">← Nakaraan</button>
        <button class="btn btn-primary" onclick="awardStepXP(currentStory+'-step5', 100); nextStep(6); updateStoryProgress(currentStory, 6);">Susunod →</button>
    </div>
</div>

<!-- CARD 6 -->
<div class="step" id="baha-step6">
    <div class="card-header-gamified">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div class="card-number">6</div>
            <h5 style="margin: 0;">🧩 BUOD</h5>
        </div>
        <div class="card-points">+200 XP</div>
    </div>

    <div class="learning-objective">
        <strong>📖 Pangwakas na Layunin:</strong> Ibuod ang flashflood at ang kahalagahan ng paghahanda at pagtutulungan
    </div>

    <div class="fact-box" style="background: linear-gradient(135deg, #d4f1e8, #bde7d5); border-left-color: #28a745;">
        <strong style="color: #155724;">📚 Buod:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px; color: #155724;">
            Ang flashflood sa Guinobatan ay dulot ng matinding pag-ulan na tumagal ng halos isa’t kalahating oras, na nagpasimula ng rumaragasang baha na may kasamang lahar mula sa Mayon Volcano. Dahil dito, ang mga kalsada ay naging parang ilog na may dalang putik, bato, at buhangin na nagdulot ng panganib sa mga residente, bahay, at kabuhayan. Agad namang kumilos ang mga awtoridad sa pamamagitan ng clearing operations, pagbibigay ng babala, at paghahanda ng tulong para sa mga apektado. Ipinapakita ng pangyayaring ito ang kahalagahan ng maagap na paghahanda, pagsunod sa babala, at pagtutulungan ng komunidad upang maiwasan ang mas matinding pinsala at mapanatili ang kaligtasan ng lahat.
        </p>
    </div>

    <div class="fact-box" style="background: #fff9e6; border-left-color: #ff9800;">
        <strong>🎥 Opsyonal na Video:</strong>
        <p style="margin: 8px 0 0 0; font-size: 14px;">Panoorin lamang kung may libreng data. Kung wala, maaari ka nang magpatuloy sa susunod na bahagi.</p>
    </div>

    <iframe width="100%" height="315"
            src="https://www.youtube.com/embed/RzG1kbeyS-g"
            title="Opsyonal na Video"
            allowfullscreen></iframe>

    <div class="step-nav final-summary" style="margin-top: 30px;">
        <a href="{{ route('module4.baha.game') }}" onclick="awardStepXP(currentStory+'-step6', 200)" class="btn btn-success final-game-cta">Maglaro ng Baha Game</a>
    </div>
</div>

</div>
