<div class="story" id="landslide">

  <div class="story-header" style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 2px dashed #dce3ec;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
      <h4 style="font-size: 1.8rem; font-weight: 700; color: #1e2f4b; margin: 0;">⛰️ Landslide sa Albay</h4>
    </div>
    <p style="margin: 0;">
      <small>
        Source: 
        <a href="https://www.abs-cbn.com/regions/2024/10/24/20-bahay-nabaon-sa-landslides-sa-libon-albay-1331" target="_blank" style="color:#0d6efd; text-decoration:underline;">
          ABS-CBN News
        </a>
        (Dagos, R. - Oktubre 24, 2024)
      </small>
    </p>
  </div>

  <!-- CARD 1: ANO ANG NANGYARI? -->
  <div class="step active" id="landslide-step1">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 1: ANO ANG NANGYARI?</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C1 - 1.png') }}" alt="Landslide sa Burabod">
      <img src="{{ asset('pictures/Module4/landslide/C1 - 2.jpg') }}" alt="Pinsala ng landslide">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Dalawang landslide ang naganap sa Barangay Burabod, Libon, Albay</li>
      <li>Dulot ng matinding ulan mula sa bagyong Kristine</li>
      <li>Gumuho ang lupa mula sa mataas na bahagi at umagos ang putik pababa sa mga bahay</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Dalawang landslide ang naganap sa Barangay Burabod dahil sa matinding ulan dulot ng bagyong Kristine. Gumuho ang lupa mula sa mataas na bahagi at umagos ang putik pababa sa mga bahay.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn btn-primary" onclick="landslideNextStep(2)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 2: LAWAK NG PINSALA -->
  <div class="step" id="landslide-step2">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 2: LAWAK NG PINSALA</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C2 - 1.jpg') }}" alt="Mga bahay na natabunan">
      <img src="{{ asset('pictures/Module4/landslide/C2 - 2.jpg') }}" alt="Apektadong lugar">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa</li>
      <li>Ang unang landslide ay nakaapekto sa 10 bahay</li>
      <li>Nadagdagan pa ang pinsala kinabukasan dahil sa patuloy na pagguho</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa. Ang unang landslide ay nakaapekto sa 10 bahay, nadagdagan pa kinabukasan.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(1)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="landslideNextStep(3)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 3: KALAGAYAN NG MGA RESIDENTE -->
  <div class="step" id="landslide-step3">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 3: KALAGAYAN NG MGA RESIDENTE</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C3 - 1.jpg') }}" alt="Evacuation center">
      <img src="{{ asset('pictures/Module4/landslide/C3 - 2.jpg') }}" alt="Mga residente">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Walang naiulat na nasaktan dahil nakalikas agad ang mga residente</li>
      <li>Inilipat sila sa evacuation center sa San Vicente Elementary School</li>
      <li>Ligtas ang lahat ng nakatakas sa sakuna</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Walang naiulat na nasaktan dahil nakalikas agad ang mga residente. Inilipat sila sa evacuation center sa San Vicente Elementary School.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(2)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="landslideNextStep(4)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 4: KARAGDAGANG PANGYAYARI -->
  <div class="step" id="landslide-step4">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 4: KARAGDAGANG PANGYAYARI</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C4 - 1.jpg') }}" alt="Clearing operations">
      <img src="{{ asset('pictures/Module4/landslide/C4 - 2.jpg') }}" alt="Marupok na lupa">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Muling nagkaroon ng landslide habang may clearing operations ang mga awtoridad</li>
      <li>Nagpatuloy ang panganib dahil sa basa at marupok na lupa</li>
      <li>Kailangan ng dobleng pag-iingat sa mga rescue at clearing operations</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Muling nagkaroon ng landslide habang may clearing operations ang mga awtoridad. Nagpatuloy ang panganib dahil sa basa at marupok na lupa.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(3)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="landslideNextStep(5)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 5: MGA NAWAWALA AT RESCUE -->
  <div class="step" id="landslide-step5">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 5: MGA NAWAWALA AT RESCUE</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C5.jpg') }}" alt="Search and rescue">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Isang 60-anyos na lalaki ang naiulat na nawawala</li>
      <li>Patuloy ang search and rescue operations ng mga awtoridad</li>
      <li>Umaasa ang pamilya at komunidad na matatagpuan siya</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Isang 60-anyos na lalaki ang naiulat na nawawala. Patuloy ang search and rescue operations ng mga awtoridad.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(4)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="landslideNextStep(6)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 6: MAHALAGANG PAALALA -->
  <div class="step" id="landslide-step6">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 6: MAHALAGANG PAALALA</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C6 - 1.jpg') }}" alt="Babala sa landslide">
      <img src="{{ asset('pictures/Module4/landslide/C6 - 2.png') }}" alt="Pag-iingat">
    </div>

    <p><strong>📌 Mahahalagang Punto:</strong></p>
    <ul>
      <li>Ang landslide ay dulot ng matinding ulan at pagguho ng lupa</li>
      <li>Mahalaga ang maagap na paglikas bago pa lumala ang sitwasyon</li>
      <li>Makinig at sumunod sa abiso ng awtoridad</li>
    </ul>

    <p><strong>🧠 Mabilis na Ideya:</strong><br>
    👉 Ang landslide ay dulot ng matinding ulan at pagguho ng lupa. Mahalaga ang maagap na paglikas at pakikinig sa abiso ng awtoridad.</p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(5)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-primary" onclick="landslideNextStep(7)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #1e3a5f; color: white;">Susunod →</button>
    </div>
  </div>

  <!-- CARD 7: BUOD -->
  <div class="step" id="landslide-step7">
    <h5 style="font-size: 1.4rem; font-weight: 700; color: #1e3a5f; margin-bottom: 16px; border-left: 6px solid #8B4513; padding-left: 16px;">🧩 CARD 7: BUOD</h5>

    <div class="img-grid">
      <img src="{{ asset('pictures/Module4/landslide/C7.png') }}" alt="Buod ng landslide">
    </div>

    <p><strong>📌 Buod ng Pangyayari:</strong></p>
    <p>Nagkaroon ng dalawang landslide sa Barangay Burabod, Libon, Albay dulot ng matinding ulan mula sa bagyong Kristine. Umabot sa 20 bahay ang naapektuhan o natabunan ng lupa habang patuloy ang pagguho sa lugar dahil sa basa at marupok na lupa.</p>
    
    <p>Sa kabila ng pinsala, ligtas ang mga residente dahil agad silang nakalikas at pansamantalang nanunuluyan sa evacuation center. Gayunpaman, isang 60-anyos na lalaki ang naiulat na nawawala kaya nagpapatuloy ang search and rescue operations.</p>
    
    <p>Ipinapakita ng insidenteng ito ang kahalagahan ng maagap na paglikas at pagsunod sa mga babala ng awtoridad upang maiwasan ang mas malalang sakuna.</p>

    <p><strong>📺 Opsyonal na Video:</strong><br>
    <a href="https://www.youtube.com/watch?v=ibI0oImzDSs" target="_blank" rel="noopener" style="color:#0d6efd; text-decoration:underline;">Panoorin ang video tungkol sa landslide</a> 
    <small>(hindi required, puwedeng laktawan kung limitado ang data)</small></p>

    <div style="display: flex; gap: 10px; margin-top: 24px; justify-content: flex-end;">
      <button class="btn" onclick="landslidePrevStep(6)" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #6c757d; color: white;">← Nakaraan</button>
      <button class="btn btn-success" onclick="landslideFinishStory()" style="padding: 10px 20px; font-size: 1rem; font-weight: 600; border: none; border-radius: 30px; cursor: pointer; background: #2e7d32; color: white;">🎮 Tapusin at Pumunta sa Laro</button>
    </div>
  </div>

</div>

<script>
  function landslideNextStep(stepNumber) {
    const steps = document.querySelectorAll('#landslide .step');
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById('landslide-step' + stepNumber).classList.add('active');
  }

  function landslidePrevStep(stepNumber) {
    const steps = document.querySelectorAll('#landslide .step');
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById('landslide-step' + stepNumber).classList.add('active');
  }

  function landslideFinishStory() {
    // Call the parent's finishStory function
    if (typeof finishStory === 'function') {
      finishStory();
    }
  }
</script>