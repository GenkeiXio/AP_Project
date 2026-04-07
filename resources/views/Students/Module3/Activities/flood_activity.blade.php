<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Flood Activity</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f7fb;
    font-family: Arial;
}

.container {
    max-width: 1000px;
}

h2, p {
    text-align: center;
}

.statement-card {
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    transition: 0.3s;
}

.buttons {
    margin-top: 10px;
    text-align: center;
}

.btn-choice {
    margin: 5px;
    width: 130px;
}

.btn-lg {
    width: 180px;
    font-size: 18px;
}

/* Correct animation */
.correct {
    border: 4px solid #28a745;
    animation: pulse 0.5s;
}

/* Wrong animation */
.wrong {
    border: 4px solid #dc3545;
    animation: shake 0.4s;
}
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(40,167,69,0.7); }
    100% { box-shadow: 0 0 0 15px rgba(40,167,69,0); }
}

@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    50% { transform: translateX(6px); }
    75% { transform: translateX(-6px); }
    100% { transform: translateX(0); }
}

#feedback {
    display: none;
}

.video-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.video-card {
    background: white;
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.video-card iframe {
    width: 100%;
    height: 220px;
    border-radius: 10px;
}
</style>
</head>
<body>

<div class="container py-4">

<h2 class="fw-bold">E. Mga Dapat Gawin sa Banta ng Pagbaha at Flash Flood</h2>

<p><strong>Guiding Question:</strong> Ano ang maaaring mangyari kung hindi susundin ang safety measures?</p>

<!-- Video Section -->
<div class="video-section mb-4">

    <div class="video-card">
        <p><strong>Ano ang Pagbaha at Flashflood?</strong><br>Panoorin ang video presentation.</p>
        <iframe src="https://www.youtube.com/embed/9hQZCiZ21fk" allowfullscreen></iframe>
    </div>

    <div class="video-card">
        <p><strong>Ano ang dapat na gawin tuwing may pagbabaha?</strong><br>Panoorin ang video.</p>
        <iframe src="https://www.youtube.com/embed/AoraXNrMp48" allowfullscreen></iframe>
    </div>

</div>

<p><strong>Panuto:</strong> Piliin kung ang gawain ay LIGTAS o DELIKADO.</p>

<div id="quiz"></div>

<div class="text-center mt-4">
    <button class="btn btn-primary" onclick="checkAnswers()">Submit</button>
</div>

<div id="feedback" class="alert alert-success mt-4">
    🎉 <strong>Magaling!</strong> Natutunan mo ang mga ligtas at delikadong gawain sa panahon ng baha.
</div>

</div>

<script>
    const data = [
    { text:"Maging handa sa posibilidad na pagbaha kung patuloy ang pag-ulan.", answer:"safe"},
    { text:"Makinig sa radyo o TV para sa emergency instructions.", answer:"safe"},
    { text:"Hindi na kailangang mag-imbak ng tubig kahit may bagyo.", answer:"danger"},
    { text:"Mag-imbak ng malinis na tubig.", answer:"safe"},
    { text:"Ilagay ang gamit sa mababang bahagi.", answer:"danger"},
    { text:"Ilagay ang gamit sa mataas na bahagi.", answer:"safe"},
    { text:"Dalhin ang alagang hayop sa mataas na lugar.", answer:"safe"},
    { text:"Iwan ang alagang hayop sa labas.", answer:"danger"},
    { text:"Manatili sa loob ng bahay.", answer:"safe"},
    { text:"Lumabas habang may bagyo.", answer:"danger"},
    { text:"Patayin ang kuryente bago lumikas.", answer:"safe"},
    { text:"Maghintay bago lumikas.", answer:"danger"},
    { text:"Iwasan ang baha na hindi alam ang lalim.", answer:"safe"},
    { text:"Tumawid sa baha kahit di alam lalim.", answer:"danger"},
    { text:"Huwag pilitin ang sasakyan sa baha.", answer:"safe"},
    { text:"Pakuluan ang tubig.", answer:"safe"},
    { text:"Huwag pakuluan ang tubig.", answer:"danger"},
    { text:"Siguraduhing walang live wire.", answer:"safe"},
    { text:"Ipakita sa elektrisyan ang kuryente.", answer:"safe"},
    ];

    let current = 0;
    let score = 0;

    const quiz = document.getElementById("quiz");

    function renderQuestion() {
        const item = data[current];

        quiz.innerHTML = `
            <div class="statement-card text-center p-4">

                <h5 class="mb-3">Tanong ${current+1} / ${data.length}</h5>

                <p style="font-size:18px;">${item.text}</p>

                <div class="buttons mt-3">
                    <button class="btn btn-success btn-lg m-2"
                        onclick="answer('safe')">✅ LIGTAS</button>

                    <button class="btn btn-danger btn-lg m-2"
                        onclick="answer('danger')">❌ DELIKADO</button>
                </div>

                <div id="nextBtn" class="mt-3 d-none">
                    <button class="btn btn-primary" onclick="nextQuestion()">Next ➡</button>
                </div>

            </div>
        `;
    }

    function answer(choice){
        const item = data[current];
        const card = document.querySelector('.statement-card');

        // disable buttons after answer
        document.querySelectorAll('.btn-success, .btn-danger').forEach(btn => btn.disabled = true);

        if(choice === item.answer){
            card.classList.add('correct');
            score++;
        } else {
            card.classList.add('wrong');
        }

        // show next button
        document.getElementById('nextBtn').classList.remove('d-none');
    }

    function nextQuestion(){
        current++;

        if(current < data.length){
            renderQuestion();
        } else {
            showResult();
        }
    }

    function showResult(){
        quiz.innerHTML = `
            <div class="text-center p-4">

                <h3>🎉 Natapos mo ang Activity!</h3>

                <p class="mt-3">Score: <strong>${score} / ${data.length}</strong></p>

                <div class="alert alert-success mt-3">
                    Mahusay! Natutunan mo kung alin ang ligtas at delikadong gawain sa panahon ng baha.
                </div>

                <a href="{{ route('module3.closing') }}" class="btn btn-success btn-lg mt-3">
                    👉 Tapusin ang Module
                </a>

            </div>
        `;
    }

    // start
    renderQuestion();
</script>

</body>
</html>