<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagputok ng Bulkan Activity</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --lava: #ff4d00;
            --magma: #cf1010;
            --ash: #2c3e50;
            --smoke: #1a1a1b;
        }

        body {
            background: radial-gradient(circle at top, #343a40 0%, #1a1a1b 100%);
            font-family: 'Lexend', sans-serif;
            color: #ffffff;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            color: var(--lava);
            text-shadow: 0 0 15px rgba(255, 77, 0, 0.5);
            font-weight: 800;
            letter-spacing: -1px;
        }

        .guide {
            text-align: center;
            background: rgba(0,0,0,0.3);
            padding: 20px;
            border-radius: 15px;
            border-bottom: 3px solid var(--magma);
            margin-bottom: 30px;
        }

        .guide strong {
            color: var(--lava);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .video-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        iframe {
            width: 100%;
            height: 200px;
            border-radius: 15px;
            border: 2px solid var(--ash);
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .instruction {
            color: #2dd4bf;
            font-weight: 600;
            background: rgba(45, 212, 191, 0.1);
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* Image grid */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .image-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            background: #000;
            border: 3px solid transparent;
            cursor: pointer;
            height: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .image-card img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .image-card:hover {
            border-color: rgba(255, 77, 0, 0.4);
            transform: translateY(-5px);
        }

        .image-card.selected {
            border-color: var(--lava);
            box-shadow: 0 0 20px rgba(255, 77, 0, 0.6);
            background: #111;
        }

        .image-card.selected::after {
            content: '✓ Selected';
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--lava);
            color: white;
            padding: 2px 10px;
            font-size: 0.7rem;
            border-radius: 5px;
            font-weight: bold;
        }

        /* STATUS COLORS */
        .correct {
            border-color: #10b981 !important;
            animation: pulse-green 0.6s ease;
        }

        .wrong {
            border-color: #ef4444 !important;
            animation: shake 0.4s ease;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        /* BUTTONS */
        .btn-submit {
            background: var(--lava);
            border: none;
            padding: 15px 40px;
            font-weight: 800;
            text-transform: uppercase;
            border-radius: 12px;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(255, 77, 0, 0.3);
        }

        .btn-submit:hover {
            background: var(--magma);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 77, 0, 0.5);
        }

        #feedback {
            margin-top: 30px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #d1fae5;
            border-radius: 20px;
            padding: 25px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .next-btn {
            background: #10b981;
            color: white;
            border: none;
            padding: 20px 40px;
            border-radius: 15px;
            font-weight: 800;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .next-btn:hover {
            background: #059669;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">

    <h2 class="mb-2">🌋 Gawain: Pagputok ng Bulkan</h2>

    <div class="guide">
        <strong>Gabay na Tanong</strong>
        <p class="mb-0">Paano nakapagliligtas ng buhay ang maagap na paglikas?</p>
    </div>

    <div class="video-section">
        <iframe src="https://www.youtube.com/embed/Hg1ktHeXaPU" allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/UFz2fLrqZuk" allowfullscreen></iframe>
    </div>

    <div class="text-center">
        <p class="instruction">
            📍 Panuto: I-click ang mga larawang nagpapakita ng TAMA at LIGTAS na gawain.
        </p>
    </div>

    <div class="image-grid">
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan1.png">
        </div>
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan2.png">
        </div>
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan3.png">
        </div>
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan4.png">
        </div>
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan5.png">
        </div>
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan6.png">
        </div>
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan7.jpg">
        </div>
    </div>

    <div class="text-center mt-5">
        <button class="btn btn-primary btn-submit" onclick="checkAnswers()">Isubmit ang Sagot</button>
    </div>

    <div id="feedback" class="d-none">
        <h4 class="text-success fw-bold">🔥 Napakahusay!</h4>
        Bilang isang manlalaro, natutunan mo na mahalagang sundin ang mga babala at agad na lumikas kapag kinakailangan upang maiwasan ang panganib. 
        Nauunawaan mo rin na dapat magdala lamang ng mahahalagang kagamitan tulad ng tubig, flashlight, at radyo upang maging handa sa anumang sitwasyon. 
        Bukod dito, natutunan mong pahalagahan ang kaligtasan ng bawat isa sa pamamagitan ng pagsunod sa mga paalala ng kinauukulan at pananatili sa evacuation center hangga’t hindi pa ligtas. Ang mga aral na ito ay makatutulong upang maging responsable at handa ka sa panahon ng sakuna.

    </div>

    <div class="text-center mt-4 d-none" id="nextActivity">
        <a href="{{ route('flood.activity') }}" class="next-btn">
            👉 SUSUNOD NA ARALIN (PAGBAHA)
        </a>
    </div>

</div>

<script>
    function checkAnswers() {
        const cards = document.querySelectorAll('.image-card');
        let allCorrect = true;

        cards.forEach(card => {
            const isSelected = card.classList.contains('selected');
            const answer = card.dataset.answer;

            card.classList.remove('correct', 'wrong');
            void card.offsetWidth; 

            if (isSelected && answer === "correct") {
                card.classList.add('correct');
            } 
            else if (isSelected && answer === "wrong") {
                card.classList.add('wrong');
                allCorrect = false;
            } 
            else if (!isSelected && answer === "correct") {
                allCorrect = false;
            }
        });

        if (allCorrect) {
            document.getElementById('feedback').classList.remove('d-none');
            document.getElementById('nextActivity').classList.remove('d-none');
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        } else {
            alert("May kulang o maling napili. Subukan muli!");
        }
    }

    document.querySelectorAll('.image-card').forEach(card => {
        card.addEventListener('click', () => {
            card.classList.toggle('selected');
        });
    });
</script>

</body>
</html>