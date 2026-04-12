<div class="story" id="mayon">

  <div class="story-header" style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 2px dashed #dce3ec;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
      <h4 style="font-size: 1.8rem; font-weight: 700; color: #1e2f4b; margin: 0;">🌋 Bulkang Mayon · Pagputok 2023</h4>
    </div>
    <p style="margin: 0;">
      <small>
        Source: 
        <a href="#" target="_blank" style="color:#0d6efd; text-decoration:underline;">
          PHIVOLCS / News Reports
        </a>
      </small>
    </p>
  </div>

  <!-- CARD 1: ANO ANG NANGYARI? -->
  <div class="step active" id="mayon-step1">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 1: ANO ANG NANGYARI?</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C1 - 1.jpg') }}" alt="Mayon lava glow">
      <img src="{{ asset('pictures/Module4/mayon/C1 - 2.jpg') }}" alt="Mayon night eruption">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Nakunan ng video ang pag-agos at pagguho ng nagliliwanag na lava</li>
      <li>Naganap noong gabi ng Hunyo 8, 2023</li>
      <li>Mula sa tuktok ng Bulkang Mayon</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Nakunan ng video ang pag-agos at pagguho ng nagliliwanag na lava mula sa tuktok ng Bulkang Mayon noong gabi ng Hunyo 8, 2023.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn btn-primary" onclick="mayonNextStep(2)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 2: URI NG AKTIBIDAD -->
  <div class="step" id="mayon-step2">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 2: URI NG AKTIBIDAD NG BULKAN</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C2 - 1.jpg') }}" alt="Incandescent rockfalls">
      <img src="{{ asset('pictures/Module4/mayon/C2 - 2.jpg') }}" alt="Rockfall closeup">
      <img src="{{ asset('pictures/Module4/mayon/C2 - 3.jpg') }}" alt="Lava dome">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>"Incandescent rockfalls" o nagliliyab na mga bato na bumabagsak</li>
      <li>Mula sa lava dome ng bulkan</li>
      <li>Senyales ng aktibong paggalaw ng magma</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Nakita ang "incandescent rockfalls" o nagliliyab na mga bato na bumabagsak mula sa lava dome—senyales ng aktibong paggalaw ng magma.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(1)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(3)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 3: LAWAK NG EPEKTO -->
  <div class="step" id="mayon-step3">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 3: LAWAK NG EPEKTO</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C3 - 1.jpg') }}" alt="Lava flow down slope">
      <img src="{{ asset('pictures/Module4/mayon/C3 - 2.jpg') }}" alt="Rock debris">
      <img src="{{ asset('pictures/Module4/mayon/C3 - 3.jpg') }}" alt="Nearby areas">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Lava at gumuguhong bato ay umagos pababa sa mga dalisdis</li>
      <li>Posibleng umabot sa mga kalapit na lugar</li>
      <li>Patuloy na pagsubaybay sa apektadong lugar</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Ang lava at mga gumuguhong bato ay umagos pababa sa mga dalisdis ng bulkan, na posibleng umabot sa mga kalapit na lugar.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(2)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(4)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 4: ALERT LEVEL AT BABALA -->
  <div class="step" id="mayon-step4">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 4: ANTAS NG BABALA</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C4 - 1.jpg') }}" alt="Alert Level 3 sign">
      <img src="{{ asset('pictures/Module4/mayon/C4 - 2.jpg') }}" alt="Warning advisory">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Itinaas sa Alert Level 3 ang bulkan</li>
      <li>May nagaganap nang pagputok</li>
      <li>Maaaring lumakas pa ang aktibidad</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Itinaas sa Alert Level 3 ang bulkan, ibig sabihin ay may nagaganap nang pagputok at maaaring lumakas pa ito.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(3)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(5)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 5: PANGANIB SA KOMUNIDAD -->
  <div class="step" id="mayon-step5">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 5: PANGANIB SA KOMUNIDAD</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C5 - 1.jpg') }}" alt="Ashfall">
      <img src="{{ asset('pictures/Module4/mayon/C5 - 2.jpg') }}" alt="Pyroclastic flow">
      <img src="{{ asset('pictures/Module4/mayon/C5 - 3.jpg') }}" alt="Residents at risk">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Posibilidad ng lava flow</li>
      <li>Ashfall o pagbagsak ng abo</li>
      <li>Pyroclastic flows na maaaring magdulot ng matinding pinsala</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Nanganganib ang mga residente dahil sa posibilidad ng lava flow, ashfall, at pyroclastic flows na maaaring magdulot ng matinding pinsala.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(4)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(6)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 6: KALAGAYAN SA GABI -->
  <div class="step" id="mayon-step6">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 6: KALAGAYAN SA GABI</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C6 - 1.jpg') }}" alt="Glowing lava at night">
      <img src="{{ asset('pictures/Module4/mayon/C6 - 2.jpg') }}" alt="Fire-like appearance">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Mas malinaw ang pag-agos ng lava sa gabi</li>
      <li>Dahil sa liwanag ng nagliliyab na lava</li>
      <li>Tila nag-aapoy ang gilid ng bulkan</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Mas malinaw na nakita ang pag-agos ng lava sa gabi dahil sa liwanag nito, na tila nag-aapoy ang gilid ng bulkan.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(5)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(7)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 7: PAGTUGON AT PAG-IINGAT -->
  <div class="step" id="mayon-step7">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 7: PAGTUGON AT PAG-IINGAT</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C7 - 1.jpg') }}" alt="Safety precautions">
      <img src="{{ asset('pictures/Module4/mayon/C7 - 2.jpg') }}" alt="Evacuation preparation">
      <img src="{{ asset('pictures/Module4/mayon/C7 - 3.jpg') }}" alt="Emergency response">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Pinag-iingat ang mga residente</li>
      <li>Inihahanda ang posibleng paglikas</li>
      <li>Patuloy na pagbabantay ng mga awtoridad</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Pinag-iingat ang mga residente at inihahanda ang posibleng paglikas upang maiwasan ang panganib mula sa patuloy na aktibidad ng bulkan.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(6)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="mayonNextStep(8)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 8: BUOD -->
  <div class="step" id="mayon-step8">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #f97316; padding-left: 16px;">🧩 KARD 8: BUOD</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/mayon/C8.png') }}" alt="Mayon summary">
    </div>

    <p><strong>📌 Buod ng Pangyayari:</strong></p>
    <p>Noong Hunyo 8, 2023, nakunan ang pag-agos at pagguho ng nagliliwanag na lava mula sa Bulkang Mayon, lalo na kapansin-pansin sa gabi dahil sa liwanag nito. Ipinakita ng aktibidad ang tuloy-tuloy na paglabas ng magma, kabilang ang mga "incandescent rockfalls," na senyales ng aktibong pagputok. Dahil dito, itinaas ang Alert Level 3 at nagbabala ang mga awtoridad sa posibleng panganib tulad ng lava flow, ashfall, at pyroclastic flows. Pinag-iingat ang mga residente at inihahanda ang mga hakbang sa paglikas upang mapanatili ang kaligtasan ng mga komunidad sa paligid ng bulkan.</p>

    <p><strong>📺 Opsyonal na Video:</strong><br>
    <a href="https://www.youtube.com/watch?v=UR7cTKlugFM" target="_blank" rel="noopener" style="color:#0d6efd; text-decoration:underline;">Panoorin ang video ng pagputok</a> 
    <small>(hindi required, puwedeng laktawan kung limitado ang data)</small></p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="mayonPrevStep(7)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <a href="{{ route('module4.mayon.game') }}" onclick="awardStepXP(currentStory+'-step8', 200)" class="btn btn-success" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #2e7d32; color: white; text-decoration: none; display: inline-flex; align-items: center;">🎮 Tapusin at Pumunta sa Laro</a>
    </div>
  </div>

</div>

<script>
  function mayonNextStep(stepNumber) {
    const steps = document.querySelectorAll('#mayon .step');
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById('mayon-step' + stepNumber).classList.add('active');
  }

  function mayonPrevStep(stepNumber) {
    const steps = document.querySelectorAll('#mayon .step');
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById('mayon-step' + stepNumber).classList.add('active');
  }

  function mayonFinishStory() {
    // Call the parent's finishStory function
    if (typeof finishStory === 'function') {
      finishStory();
    }
  }
</script>