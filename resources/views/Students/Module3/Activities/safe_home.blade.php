<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Safe Home Activity</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    padding: 0;
    background: #f4f6f9;
}

/* MAIN CARD */
.container {
    max-width: 1200px;
    margin: 30px auto;
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* HEADER */
h2 {
    margin-bottom: 10px;
}

.instructions {
    font-size: 18px;
    margin-bottom: 15px;
}

/* LAYOUT */
.content {
    display: flex;
    gap: 20px;
}

/* IMAGE */
.house-img {
    width: 50%;
    border-radius: 15px;
}

/* OPTIONS */
.options {
    width: 50%;
}

.option {
    position: relative;
    background: linear-gradient(145deg, #f5f7fa, #e4e7ec);
    padding: 15px 20px;
    border-radius: 15px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.25s ease;

    box-shadow: 0 5px 12px rgba(0,0,0,0.1);
    font-size: 15px;
}

.option:hover {
    transform: translateY(-5px) scale(1.02);
    background: linear-gradient(145deg, #e3f2fd, #bbdefb);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* CLICK EFFECT */
.option:active {
    transform: scale(0.97);
}

/* SELECTED STATE */
.option.selected {
    opacity: 0.8;
    cursor: not-allowed;
}

/* ICON (✔ ❌) */
.option::after {
    content: "";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
}

/* SHOW ✔ */
.option.correct::after {
    content: "✔";
    color: green;
}

/* SHOW ❌ */
.option.wrong::after {
    content: "✖";
    color: red;
}


/* CORRECT */
.correct {
    background: linear-gradient(135deg, #c8e6c9, #a5d6a7) !important;
    border-left: 6px solid green;
}

/* WRONG */
.wrong {
    background: linear-gradient(135deg, #ffcdd2, #ef9a9a) !important;
    border-left: 6px solid red;
}

/* SCORE */
#progress {
    font-weight: bold;
    margin-bottom: 10px;
}

/* RESULT */
#result {
    display: none;
    margin-top: 20px;
    padding: 20px;
    border-radius: 15px;
    background: #e8f5e9;
}

#result h3 {
    color: green;
}

/* BUTTON */
.next-btn {
    margin-top: 15px;
    padding: 10px 20px;
    border: none;
    background: #0d6efd;
    color: white;
    border-radius: 10px;
    cursor: pointer;
}
</style>

</head>

<body>

<div class="container">

    <h2>🏠 SAFE HOME</h2>

    <div class="instructions">
        Piliin ang <strong>5 tamang paraan</strong> upang maging ligtas ang bahay bago ang bagyo.<br>
        👉 I-click lamang ang mga tamang gawain.
    </div>

    <div id="progress">Napili: 0 / 5</div>

    <div class="content">

        <div id="leftPanel" class="house-img" style="display:flex; align-items:center; justify-content:center;">

        <!-- DEFAULT IMAGE -->
        <img id="mainImage" src="{{ asset('pictures/Module 3/Safe_Home/normal.png') }}" 
            style="width:100%; border-radius:15px;">

        <!-- RESULT (HIDDEN FIRST) -->
        <div id="result" style="display:none; text-align:center; width:100%;">

            <h3 id="resultTitle"></h3>

            <img id="resultImage" style="width:100%; border-radius:15px; margin-top:10px;">

            <p id="resultText" style="margin-top:10px;"></p>

            <button id="resultBtn" class="next-btn"></button>

        </div>

    </div>

        <!-- OPTIONS -->
        <div class="options">

            <div class="option" data-correct="true">
                Ayusin ang sirang bubong upang maiwasan ang pagpasok ng tubig.
            </div>

            <div class="option" data-correct="true">
                Takpan ang mga bintana upang maprotektahan ang loob ng bahay.
            </div>

            <div class="option" data-correct="true">
                Linisin ang paligid at alisin ang mga debris.
            </div>

            <div class="option" data-correct="true">
                Ayusin ang mga bitak sa pader.
            </div>

            <div class="option" data-correct="true">
                Siguraduhing maayos ang drainage.
            </div>

            <div class="option" data-correct="false">
                Mag-iwan ng gamit sa labas ng bahay.
            </div>

            <div class="option" data-correct="false">
                Huwag ayusin ang bubong kahit sira.
            </div>

            <div class="option" data-correct="false">
                Magbukas ng bintana habang may bagyo.
            </div>

            <div class="option" data-correct="false">
                Manatili sa sirang bahay.
            </div>

            <div class="option" data-correct="false">
                Balewalain ang babala ng bagyo.
            </div>

        </div>
    </div>

    <!-- RESULT -->
    <div id="result" style="display:none; text-align:center;">

        <h3 id="resultTitle"></h3>

        <img id="resultImage" style="width:100%; border-radius:15px; margin-top:10px;">

        <p id="resultText" style="margin-top:10px;"></p>

        <button id="resultBtn" class="next-btn"></button>

    </div>

</div>

<script>

    function shuffleOptions() {
        const container = document.querySelector('.options');
        const items = Array.from(container.children);

        for (let i = items.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [items[i], items[j]] = [items[j], items[i]];
        }

        items.forEach(item => container.appendChild(item));
    }

    shuffleOptions();

    let correct = 0;
    let wrong = 0;
    let totalSelected = 0;
    let maxSelect = 5;

    document.querySelectorAll('.option').forEach(opt => {
        opt.addEventListener('click', function() {

            if (this.classList.contains('selected')) return;
            if (totalSelected >= maxSelect) return; // LIMIT TO 5

            this.classList.add('selected');
            totalSelected++;

            if (this.dataset.correct === "true") {
                this.classList.add('correct');
                correct++;
            } else {
                this.classList.add('wrong');
                wrong++;
            }

            document.getElementById('progress').innerText =
                "Napili: " + totalSelected + " / " + maxSelect;

            // CHECK AFTER 5 SELECTIONS
            if (totalSelected === maxSelect) {

            // 🔒 Disable all remaining options
            document.querySelectorAll('.option').forEach(o => {
                o.style.pointerEvents = "none";
                o.style.opacity = "0.6";
            });

            setTimeout(() => {
                showResult();
            }, 500); // slight delay = game feel
        }
        });
    });

    function showResult() {
        let title = "";
        let text = "";
        let img = "";
        let btnText = "";
        let btnAction = "";

        // ❌ FAIL
        if (wrong >= 2) {
            title = "❌ Hindi ligtas ang bahay!";
            text = "Maraming maling desisyon ang napili kaya naging mahina ang bahay laban sa bagyo.";
            img = "{{ asset('pictures/Module 3/Safe_Home/destroyed.png') }}";

            btnText = "🔁 Subukan muli";
            btnAction = () => location.reload();
        }
        // ✅ SUCCESS
        else if (correct >= 4) {
            title = "🎉 Magaling! Ligtas ang bahay!";
            text = "🎉 Magaling! Ang pagpili ng tamang gawain tulad ng pag-aayos ng bubong, bintana, at paligid ay nakakatulong upang maging matibay at ligtas ang bahay laban sa malakas na hangin at ulan. Sa pamamagitan ng tamang paghahanda, nababawasan ang panganib at napoprotektahan ang buhay at ari-arian.";
            img = "{{ asset('pictures/Module 3/Safe_Home/safe.png') }}";

            btnText = "➡️ Magpatuloy";
            btnAction = () => window.location.href = "{{ route('gabay.activity') }}";
        }

        document.getElementById('resultTitle').innerText = title;
        document.getElementById('resultText').innerText = text;
        document.getElementById('resultImage').src = img;

        let btn = document.getElementById('resultBtn');
        btn.innerText = btnText;
        btn.onclick = btnAction;

        // 🔥 SWITCH LEFT PANEL
        document.getElementById('mainImage').style.display = "none";
        document.getElementById('result').style.display = "block";
    }
</script>

</body>
</html>