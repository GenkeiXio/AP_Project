<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pagputok ng Bulkan Activity</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .guide {
            text-align: center;
            margin-bottom: 25px;
        }

        .video-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        iframe {
            width: 100%;
            height: 220px;
            border-radius: 10px;
        }

        .instruction {
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Image grid */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px; /* smaller spacing */
        }

        .image-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
            background: white;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .image-card {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 250px; /* controls card size */
            background: #000;

            transition: all 0.3s ease;
        }

        .image-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* CLICK ANIMATION */
        .image-card:active {
            transform: scale(0.97);
        }

        /* Checkbox overlay */
        .check-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .correct {
            outline: 4px solid #28a745;
        }

        .wrong {
            outline: 4px solid #dc3545;
        }

        #feedback {
            margin-top: 25px;
            text-align: center;
        }

        .selected {
            outline: 4px solid #0d6efd;
            transform: scale(1.02);
        }

        /* CORRECT ANIMATION */
        @keyframes correctPulse {
            0% { box-shadow: 0 0 0 0 rgba(40,167,69,0.7); }
            70% { box-shadow: 0 0 0 15px rgba(40,167,69,0); }
            100% { box-shadow: 0 0 0 0 rgba(40,167,69,0); }
        }

        .correct {
            outline: 4px solid #28a745;
            animation: correctPulse 0.6s ease;
        }

        /* WRONG ANIMATION */
        @keyframes shake {
            0% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-6px); }
            80% { transform: translateX(6px); }
            100% { transform: translateX(0); }
        }

        .wrong {
            outline: 4px solid #dc3545;
            animation: shake 0.4s ease;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <h2 class="fw-bold">D. Mga Dapat Gawin sa Pagputok ng Bulkan</h2>

    <p class="guide">
        <strong>Guiding Question:</strong><br>
        Paano nakapagliligtas ng buhay ang maagap na paglikas?
    </p>

    <!-- Videos -->
    <div class="video-section">

        <!-- Replace video -->
        <iframe src="https://www.youtube.com/embed/Hg1ktHeXaPU"></iframe>

        <!-- Replace video -->
        <iframe src="https://www.youtube.com/embed/UFz2fLrqZuk"></iframe>

    </div>

    <p class="instruction">
        Panuto: Lagyan ng check kung ang larawan ay nagpapakita ng tamang gawain sa oras ng Pagputok ng Bulkan.
    </p>

    <!-- Image Grid -->
    <div class="image-grid">

        <!-- IMAGE 1 -->
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan1.png">
        </div>

        <!-- IMAGE 2 -->
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan2.png">
            
        </div>

        <!-- IMAGE 3 -->
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan3.png">
            
        </div>

        <!-- IMAGE 4 -->
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan4.png">
            
        </div>

        <!-- IMAGE 5 -->
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan5.png">
            
        </div>

        <!-- IMAGE 6 -->
        <div class="image-card" data-answer="correct">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan6.png">
            
        </div>

        <!-- IMAGE 7 -->
        <div class="image-card" data-answer="wrong">
            <img src="/pictures/Module 3/Bulkan_Activity/bulkan7.jpg">
            
        </div>

    </div>

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="checkAnswers()">Submit</button>
    </div>

    <!-- Feedback -->
    <div id="feedback" class="alert alert-success d-none">
        <strong>Mahusay!</strong> Bilang isang manlalaro, natutunan mo na mahalagang sundin ang mga babala at agad na lumikas kapag kinakailangan upang maiwasan ang panganib. 
        Nauunawaan mo rin na dapat magdala lamang ng mahahalagang kagamitan tulad ng tubig, flashlight, at radyo upang maging handa sa anumang sitwasyon. 
        Bukod dito, natutunan mong pahalagahan ang kaligtasan ng bawat isa sa pamamagitan ng pagsunod sa mga paalala ng kinauukulan at pananatili sa evacuation center hangga’t hindi pa ligtas. 
        Ang mga aral na ito ay makatutulong upang maging responsable at handa ka sa panahon ng sakuna.
    </div>

    <div class="text-center mt-3 d-none" id="nextActivity">
        <a href="{{ route('flood.activity') }}" class="btn btn-success btn-lg">
            👉 Susunod na Activity (Pagbaha)
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

            // reset animation
            card.classList.remove('correct', 'wrong');

            void card.offsetWidth; // 🔥 force reflow (important for animation replay)

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

            // show next activity button
            document.getElementById('nextActivity').classList.remove('d-none');
        }
    }

    // CLICK TO TOGGLE SELECTION
    document.querySelectorAll('.image-card').forEach(card => {
        card.addEventListener('click', () => {

            card.classList.toggle('selected');

            // small bounce effect
            card.style.transform = "scale(0.95)";
            setTimeout(() => {
                card.style.transform = "";
            }, 100);
        });
    });
</script>

</body>
</html>