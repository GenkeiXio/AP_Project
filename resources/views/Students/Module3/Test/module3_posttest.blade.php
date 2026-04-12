<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huling Pagsusulit: Pinal na Misyon</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=JetBrains+Mono:wght@400;700&family=Lexend:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --neon-blue: #00d4ff;
            --neon-green: #39ff14;
            --neon-red: #ff3131;
            --warning-orange: #ffaa00;
            --terminal-dark: #0a0f18;
            --panel-bg: rgba(15, 23, 42, 0.9);
        }

        body {
            background-color: var(--terminal-dark);
            color: #e2e8f0;
            font-family: 'Lexend', sans-serif;
            min-height: 100vh;
            margin: 0;
            background-image: 
                linear-gradient(rgba(0, 212, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 212, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        /* HEADER */
        .terminal-header {
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid var(--neon-blue);
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .status-light {
            width: 12px; height: 12px; border-radius: 50%; display: inline-block;
            background: var(--neon-green); box-shadow: 0 0 10px var(--neon-green); margin-right: 10px;
        }

        /* MAIN BOX */
        .quiz-box {
            max-width: 850px; margin: 40px auto; background: var(--panel-bg);
            border: 1px solid rgba(0, 212, 255, 0.2); border-radius: 20px; padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
        }

        .question-text { font-size: 1.4rem; font-weight: 700; margin-bottom: 30px; line-height: 1.4; }

        /* OPTIONS */
        .option-btn {
            display: block; width: 100%; padding: 18px 25px; margin-bottom: 12px;
            background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px; color: white; text-align: left; transition: 0.2s; font-size: 1.1rem;
        }

        .option-btn:hover:not(:disabled) { background: rgba(0, 212, 255, 0.1); border-color: var(--neon-blue); }

        .active-selection {
            border-color: var(--warning-orange) !important;
            background: rgba(255, 170, 0, 0.1) !important;
            box-shadow: 0 0 15px rgba(255, 170, 0, 0.2);
        }

        .correct-ans { background: rgba(57, 255, 20, 0.2) !important; border-color: var(--neon-green) !important; }
        .wrong-ans { background: rgba(255, 49, 49, 0.2) !important; border-color: var(--neon-red) !important; }

        /* CONFIRM BUTTON */
        .confirm-container { text-align: right; margin-top: 20px; min-height: 60px; }
        .btn-confirm {
            display: none; background: var(--warning-orange); color: black; font-family: 'Bungee';
            padding: 12px 30px; border-radius: 50px; border: none; transition: 0.3s;
        }

        /* PROGRESS BAR */
        .progress-bar { background: var(--neon-blue); box-shadow: 0 0 15px var(--neon-blue); transition: width 0.4s; }

        /* SYNTHESIS STYLES */
        .synthesis-box {
            margin-top: 30px; padding: 25px; background: rgba(0, 212, 255, 0.05);
            border: 1px solid rgba(0, 212, 255, 0.2); border-radius: 15px; text-align: left;
        }
        .synthesis-title {
            font-family: 'Bungee'; color: var(--warning-orange); font-size: 1.2rem;
            margin-bottom: 15px; border-bottom: 1px solid rgba(255, 170, 0, 0.3); padding-bottom: 5px;
        }
        .synthesis-content { font-size: 0.95rem; line-height: 1.6; color: #cbd5e1; }
        .highlight-text { color: var(--neon-green); font-weight: 700; }

        /* RESULT SCREEN */
        #result-screen { display: none; text-align: center; }
        .final-score-circle { font-family: 'Bungee'; font-size: 4rem; color: var(--neon-green); }
        .btn-action { 
            background: linear-gradient(180deg, #21d4ff 0%, #10c6f2 100%);
            color: #0b1020;
            font-family: 'Bungee';
            padding: 18px 38px;
            border-radius: 999px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            min-width: 360px;
            box-shadow: 0 10px 24px rgba(33, 212, 255, 0.24);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(33, 212, 255, 0.32);
        }

        @media (max-width: 576px) {
            .quiz-box { padding: 20px; margin: 20px 10px; }
            .question-text { font-size: 1.1rem; }
            .option-btn { font-size: 0.95rem; }
        }
    </style>
</head>
<body>

<div class="terminal-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="status-light"></span>
            <span style="font-family: 'JetBrains Mono'; color: var(--neon-blue);">SISTEMA: AKTIBO // MISYON: PINAL_NA_PAGSUSULIT</span>
        </div>
        <div style="font-family: 'Bungee'; color: var(--warning-orange);">
            PANGUNAHING DATA: <span id="current-score">0</span>
        </div>
    </div>
</div>

<div class="container">
    <div class="quiz-box animate__animated animate__fadeIn">
        
        <div id="quiz-content">
            <div class="progress mb-4" style="height: 6px; background: #1e293b;">
                <div id="bar" class="progress-bar" style="width: 0%"></div>
            </div>
            
            <div class="question-meta" style="font-family: 'JetBrains Mono'; color: var(--neon-blue);">PROTOKOL_ID: <span id="q-number">1</span>/15</div>
            <div class="question-text" id="q-text">Kinakarga...</div>
            
            <div id="options-container"></div>

            <div class="confirm-container">
                <button id="confirm-btn" class="btn-confirm animate__animated animate__fadeInRight">IPASA ANG SAGOT ➜</button>
            </div>
        </div>

        <div id="result-screen" class="animate__animated animate__zoomIn">
            <h2 style="font-family: 'Bungee'; color: var(--neon-blue);">BUOD NG MISYON</h2>
            
            <div class="badge-container" id="badge-display"></div>
            <div class="final-score-circle" id="final-score">0</div>
            <p id="feedback-text" class="fs-5 mt-3 px-md-5"></p>

            <div class="synthesis-box animate__animated animate__fadeInUp animate__delay-1s">
                <div class="synthesis-title">VII. SYNTHESIS</div>
                <div class="synthesis-content">
                    <p><strong>BUOD NG ARALIN:</strong></p>
                    <p>Sa araling ito, natutunan mo ang kahalagahan ng <strong>disaster preparedness</strong> at ang mga konsepto tulad ng <em>hazard, vulnerability, risk,</em> at <em>resilience</em>. Napag-alaman mo na ang sakuna ay hindi lamang dulot ng kalikasan kundi ng kahinaan ng komunidad na humarap dito.</p>
                    <p>Natutuhan mo rin ang pagkakaiba ng <strong>top-down</strong> at <strong>bottom-up approach</strong>, at kung paano nakatutulong ang <strong>CBDRRM</strong> sa pagbibigay-lakas sa komunidad.</p>
                    <p>Sa pamamagitan ng tamang paghahanda bago, habang, at pagkatapos ng sakuna, at pakikiisa sa komunidad, maaaring mabawasan ang pinsala at mailigtas ang buhay.</p>
                    <p class="highlight-text">👉 Tandaan: Ang handa ay ligtas, at ang may alam ay may kakayahang makapagliligtas ng buhay.</p>
                </div>
            </div>

            <div id="result-actions" class="mt-4"></div>
        </div>
    </div>
</div>

<script>
    const questions = [
        { q: "May babala ng malakas na bagyo at pagbaha. Ano ang unang dapat gawin?", o: ["Maghintay lang sa loob", "Maghanda at makinig sa mga babala", "Lumabas para tignan ang baha", "Mag-video para sa social media"], a: 1 },
        { q: "Alin ang nagpapakita ng ugnayan ng hazard, vulnerability, at disaster?", o: ["Malakas na ulan lamang", "Malakas na ulan + mahinang bahay = pinsala", "Kawalan ng tao sa lugar", "Malamig na panahon"], a: 1 },
        { q: "Bakit mahalaga ang early warning system?", o: ["Para gumawa ng ingay", "Para makapaghanda ang komunidad", "Para sa libangan", "Para lang may magawa"], a: 1 },
        { q: "Kung mabilis tumataas ang tubig-baha, ano ang dapat gawin?", o: ["Maghintay na humupa", "Lumikas agad sa ligtas na lugar", "Subukang tumawid sa baha", "Maglaro sa tubig"], a: 1 },
        { q: "Ano ang maaaring mangyari kung hindi pinatay ang kuryente bago lumikas?", o: ["Walang mangyayari", "Maaaring magdulot ng sunog o pagkakuryente", "Mas magiging maliwanag ang bahay", "Mas bibilis ang paghupa ng baha"], a: 1 },
        { q: "Alin ang nagpapakita ng pagiging resilient?", o: ["Pag-iyak na lang sa sulok", "Paghahanda at mabilis na pagbangon", "Pag-iwas sa pakikinig ng balita", "Pagtakas sa responsibilidad"], a: 1 },
        { q: "Ano ang epekto ng kawalan ng emergency kit?", o: ["Magiging mas ligtas", "Walang epekto sa kaligtasan", "Mas mataas ang panganib sa pamilya", "Mas bibilis ang pagdating ng tulong"], a: 2 },
        { q: "Bakit mahalagang sumunod sa evacuation order kahit hindi pa mataas ang baha?", o: ["Para lang makapasyal", "Para maiwasan ang panganib sa buhay", "Para maghintay ng rasyon", "Para makipaglaro sa mga kapitbahay"], a: 1 },
        { q: "Ano ang pinakamalaking panganib sa paglusong sa baha?", o: ["Pagkabasa ng damit", "Hindi alam na lalim at posibleng kuryente", "Pagkapagod sa paglakad", "Mainit na panahon"], a: 1 },
        { q: "Paano nakatutulong ang bottom-up approach?", o: ["Walang naitutulong ito", "Nakabatay sa karanasan at partisipasyon ng komunidad", "Nagpapabagal sa desisyon", "Nagdudulot ng gulo sa pamamahala"], a: 1 },
        { q: "Ano ang kahinaan ng top-down approach sa disaster management?", o: ["Masyadong mabilis ang aksyon", "Kulang sa partisipasyon ng mismong komunidad", "Masyadong malakas ang suporta", "Kumpleto ang mga kagamitan"], a: 1 },
        { q: "Ano ang pangunahing layunin ng CBDRRM?", o: ["Maghintay lang ng tulong", "Palakasin ang kahandaan at partisipasyon ng komunidad", "Maglaro habang walang pasok", "Magtago sa mga awtoridad"], a: 1 },
        { q: "Habang lumilindol at nasa loob ng bahay, ano ang tamang gawin?", o: ["Tumakbo agad palabas", "Magtago sa ilalim ng matibay na mesa at kumapit", "Tumalon sa bintana", "Sumigaw nang sumigaw"], a: 1 },
        { q: "Pagkatapos ng sakuna, ano ang unang hakbang bago pumasok sa bahay?", o: ["Pumasok agad para matulog", "Suriin ang kaligtasan ng istraktura at kuryente", "Maglaro sa loob", "Huwag nang tignan ang paligid"], a: 1 },
        { q: "Ano ang pinakamahalagang aral sa disaster preparedness?", o: ["Umasa sa 'Bahala Na' system", "Maging handa, maingat, at makiisa sa lahat", "Maghintay na lang ng mangyayari", "Huwag makinig sa mga payo"], a: 1 }
    ];

    let currentQ = 0;
    let score = 0;
    let selectedIdx = null;
    let isLocked = false;
    let answers = [];

    function loadQuestion() {
        if (currentQ >= questions.length) { showResults(); return; }

        isLocked = false;
        selectedIdx = null;
        document.getElementById('confirm-btn').style.display = 'none';
        
        const q = questions[currentQ];
        document.getElementById('q-number').innerText = currentQ + 1;
        document.getElementById('q-text').innerText = q.q;
        document.getElementById('bar').style.width = (currentQ / questions.length * 100) + "%";
        
        const container = document.getElementById('options-container');
        container.innerHTML = '';
        
        q.o.forEach((opt, index) => {
            const btn = document.createElement('button');
            btn.className = 'option-btn animate__animated animate__fadeInUp';
            btn.style.animationDelay = (index * 0.1) + 's';
            btn.innerText = opt;
            btn.onclick = () => selectOption(index, btn);
            container.appendChild(btn);
        });
    }

    function selectOption(index, btn) {
        if (isLocked) return;
        selectedIdx = index;
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active-selection'));
        btn.classList.add('active-selection');
        document.getElementById('confirm-btn').style.display = 'inline-block';
    }

    document.getElementById('confirm-btn').onclick = function() {
        if (selectedIdx === null || isLocked) return;
        validateAnswer();
    };

    function validateAnswer() {
        isLocked = true;
        document.getElementById('confirm-btn').style.display = 'none';
        
        const correctIndex = questions[currentQ].a;
        const allBtns = document.querySelectorAll('.option-btn');

        // SAVE ANSWER
        answers.push({
            question: currentQ,
            selected: selectedIdx,
            correct: correctIndex
        });

        allBtns.forEach(btn => btn.disabled = true);

        if (selectedIdx === correctIndex) {
            score++;
            allBtns[selectedIdx].classList.add('correct-ans');
            document.getElementById('current-score').innerText = score;
        } else {
            allBtns[selectedIdx].classList.add('wrong-ans');
            allBtns[correctIndex].classList.add('correct-ans');
        }

        setTimeout(() => {
            currentQ++;
            loadQuestion();
        }, 1500);
    }

    function showResults() {

        // SAVE TO DATABASE
        savePosttest();

        document.getElementById('bar').style.width = "100%";
        document.getElementById('quiz-content').style.display = 'none';
        document.getElementById('result-screen').style.display = 'block';
        document.getElementById('final-score').innerText = score + "/15";
        
        const badgeDisplay = document.getElementById('badge-display');
        const feedback = document.getElementById('feedback-text');

        if (score >= 12) {
            badgeDisplay.innerHTML = `<img src="https://cdn-icons-png.flaticon.com/512/6198/6198527.png" style="width: 120px;" class="animate__animated animate__tada">`;
            feedback.innerText = "Napakahusay! Nakatala ka bilang isang Disaster Commander. Ipagpatuloy ang pagiging handa!";
            document.getElementById('result-actions').innerHTML = `<a href="{{ route('student.module3.performance-task') }}" class="btn-action">MAGPATULOY SA SUSUNOD →</a>`;
        } else {
            badgeDisplay.innerHTML = `<div class="display-1">🔁</div>`;
            feedback.innerText = "Kailangan mo pa ng kaunting paghahanda. Balikan ang mga aralin at subukan muli.";
            document.getElementById('result-actions').innerHTML = `<button onclick="location.reload()" class="btn-action">ULITIN ANG MISYON</button>`;
        }
    }

    function savePosttest() {
        fetch("{{ route('student.module3.posttest.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                score: score,
                answers: answers
            })
        })
        .then(res => res.json())
        .then(data => console.log("Saved:", data))
        .catch(err => console.error(err));
    }

    loadQuestion();
</script>

</body>
</html>