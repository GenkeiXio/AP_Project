@extends('Students.studentslayout')
@section('title', 'Post-Test Modyul 4')

@push('styles')
<style>
.mod4-pretest-wrap {
    max-width: 1000px;
    margin: 24px auto;
    padding: 0 16px 28px;
}

.mod4-head {
    background: #ffffff;
    border: 2px solid #d8eadb;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 10px 22px rgba(29, 92, 52, 0.1);
}

.mod4-head h1 {
    margin: 0;
    color: #1f4f32;
    font-size: clamp(1.2rem, 2.4vw, 1.8rem);
}

.mod4-head p {
    margin: 8px 0 0;
    color: #40624b;
    line-height: 1.5;
}

.mod4-score-guide {
    margin-top: 12px;
    padding: 12px;
    border-radius: 12px;
    background: #f6fff7;
    border: 1px solid #d7e7da;
    color: #305942;
}

.mod4-questions {
    margin-top: 16px;
    display: grid;
    gap: 12px;
}

.mod4-q {
    background: #fff;
    border: 1px solid #dfece1;
    border-radius: 14px;
    padding: 14px;
    transition: all 0.2s ease;
}

.mod4-q.missing {
    border: 2px solid #d94141;
    background: #fff8f8;
    box-shadow: 0 0 0 2px rgba(217, 65, 65, 0.2);
}

.mod4-q-title {
    margin: 0 0 10px;
    color: #214a33;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.mod4-q-title .status-icon {
    font-size: 0.9rem;
}

.mod4-opt {
    display: block;
    padding: 8px 10px;
    border: 1px solid #dde9e0;
    border-radius: 10px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: 0.15s;
}

.mod4-opt:hover {
    background: #f6fff7;
}

.mod4-opt input[type="radio"] {
    margin-right: 10px;
    cursor: pointer;
}

.mod4-actions {
    margin-top: 16px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.mod4-btn {
    border: none;
    border-radius: 12px;
    padding: 11px 16px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s ease;
}

.mod4-btn-primary {
    background: linear-gradient(180deg, #7fd46a, #59ab44);
    color: #11351f;
}

.mod4-btn-primary:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(89, 171, 68, 0.3);
}

.mod4-btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.mod4-btn-ghost {
    background: #eef8ef;
    color: #2f5a40;
    border: 1px solid #c9dfcd;
}

.mod4-btn-ghost:hover {
    background: #e2f0e4;
}

.mod4-result {
    margin-top: 16px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid #d8eadb;
    background: #fff;
    display: none;
}

.mod4-result.show {
    display: block;
}

.mod4-score {
    margin: 0;
    font-weight: 900;
    color: #1e4d31;
}

.mod4-level {
    margin: 8px 0 0;
    font-weight: 800;
}

.mod4-feedback {
    margin: 10px 0 0;
    color: #3f604a;
}

.mod4-next {
    margin-top: 14px;
}

.mod4-error-message {
    margin-top: 12px;
    padding: 10px;
    background: #fff0f0;
    border: 1px solid #d94141;
    border-radius: 10px;
    color: #b33;
    font-weight: 600;
    display: none;
}

.mod4-error-message.show {
    display: block;
}

.mod4-progress {
    margin-top: 16px;
    padding: 10px;
    background: #f0f7f2;
    border-radius: 10px;
    text-align: center;
    font-weight: 600;
    color: #2f5a40;
}

.mod4-progress span {
    color: #1f7a47;
    font-size: 1.2rem;
    font-weight: 800;
}
</style>
@endpush

@section('content')
    <div class="mod4-pretest-wrap">
        <section class="mod4-head">
            <h1>📝 POST-TEST: "Handa Ka Na Ba?"</h1>
            <p><strong>Panuto:</strong> Basahin ang bawat sitwasyon. Piliin ang PINAKATAMANG sagot.</p>

            <div class="mod4-score-guide">
                <strong>Passing Score:</strong><br>
                12–15 → ✅ Handa ka na!<br>
                0–11 → 🔁 Subukan muli
            </div>
        </section>

        <section class="mod4-questions" id="questionsRoot"></section>

        <div class="mod4-progress" id="progressBar">
            Nasagot na: <span id="answeredCount">0</span> / <span id="totalCount">15</span> na tanong
        </div>

        <div class="mod4-error-message" id="errorMessage">
            ⚠️ Pakisagutan muna ang lahat ng tanong bago ipasa ang pagsusulit.
        </div>

        <div class="mod4-actions">
            <button class="mod4-btn mod4-btn-primary" id="checkBtn" type="button" disabled>Ipakita ang Resulta</button>
            <a class="mod4-btn mod4-btn-ghost" href="{{ route('module4.home') }}" style="text-decoration:none;display:inline-flex;align-items:center;">⬅ Bumalik</a>
        </div>

        <section class="mod4-result" id="resultBox">
            <p class="mod4-score" id="scoreText"></p>
            <p class="mod4-level" id="levelText"></p>
            <p class="mod4-feedback">Ang iyong post-test ay magsisilbing pagtataya ng iyong natutunan sa modyul na ito.</p>
            <div class="mod4-next" id="nextContainer"></div>
        </section>
    </div>

    <script>
        const quizItems = [
            {q:"1. May paparating na bagyo at may sapat pang oras. Ano ang pinakamahusay na unang hakbang?",
            options:["A. Maghintay ng anunsyo","B. Maghanda ng emergency kit at magbigay babala","C. Magpahinga muna","D. Maglaro"],answer:1},

            {q:"2. Sa isang evacuation center, may kakulangan sa koordinasyon. Ano ang dapat gawin?",
            options:["A. Hayaan ang sitwasyon","B. Magtalaga ng lider at sistema ng pamamahala","C. Itigil ang operasyon","D. Maghintay ng tulong"],answer:1},

            {q:"3. Matapos ang baha, maraming kable ng kuryente ang nakakalat. Ano ang tamang aksyon?",
            options:["A. Hawakan agad","B. Iwasan at ipagbigay-alam sa awtoridad","C. Lakaran lamang","D. Balewalain"],answer:1},

            {q:"4. Sa gitna ng lindol, alin ang tamang kilos?",
            options:["A. Tumakbo agad palabas","B. Drop, Cover, and Hold","C. Magpanic","D. Sumigaw"],answer:1},

            {q:"5. Sa isang komunidad, may mga hindi sumusunod sa babala. Ano ang dapat gawin ng lider?",
            options:["A. Iwanan sila","B. Magpatuloy sa pagbibigay ng impormasyon at paalala","C. Maghintay","D. Umalis"],answer:1},

            {q:"6. Sa panahon ng sakuna, bakit mahalaga ang kooperasyon?",
            options:["A. Para sa kasikatan","B. Para mapabilis ang pagtugon at pagbangon","C. Para kumita","D. Para maglibang"],answer:1},

            {q:"7. Sa isang sitwasyon, may sapat na kagamitan ngunit walang disiplina. Ano ang magiging resulta?",
            options:["A. Maayos ang operasyon","B. Magiging magulo at delikado ang sitwasyon","C. Walang epekto","D. Mas mabilis ang aksyon"],answer:1},

            {q:"8. Sa pagputok ng bulkan, bakit mahalaga ang maagang paglikas?",
            options:["A. Para makapaglakbay","B. Para maiwasan ang panganib at masave ang buhay","C. Para sa aliwan","D. Para makakita ng lava"],answer:1},

            {q:"9. Sa Guinobatan flashflood, alin ang nagpapakita ng kahandaan?",
            options:["A. Pagtawid sa baha","B. Pagsunod sa babala at paglikas","C. Paglalaro sa tubig","D. Pananatili sa bahay kahit delikado"],answer:1},

            {q:"10. Sa isang lindol, maraming sugatan. Ano ang dapat unahin?",
            options:["A. Mag-record ng video","B. Magbigay ng agarang tulong sa mga kritikal","C. Maghintay","D. Umalis"],answer:1},

            {q:"11. Ano ang pinakamahalagang papel ng tamang impormasyon?",
            options:["A. Magdulot ng kaba","B. Magbigay ng gabay sa tamang desisyon","C. Magpalaganap ng tsismis","D. Walang silbi"],answer:1},

            {q:"12. Sa isang barangay, may kahandaan at disiplina ngunit walang kooperasyon. Ano ang epekto?",
            options:["A. Mas magiging maayos","B. Hindi magiging ganap ang pagtugon","C. Walang epekto","D. Mas mabilis ang aksyon"],answer:1},

            {q:"13. Sa panahon ng sakuna, bakit mahalaga ang pagsunod sa awtoridad?",
            options:["A. Dahil utos lamang","B. Dahil nakabatay ito sa kaligtasan ng lahat","C. Dahil tradisyon","D. Dahil uso"],answer:1},

            {q:"14. Ang lider ay may plano ngunit hindi ipinatupad. Ano ang kakulangan?",
            options:["A. Kahandaan","B. Disiplina","C. Kooperasyon","D. Aksyon"],answer:3},

            {q:"15. Bilang mamamayan, alin ang pinakamainam na kontribusyon?",
            options:["A. Maghintay lamang","B. Maging handa, sumunod, at makiisa","C. Umalis agad","D. Sarili lamang ang isipin"],answer:1}
        ];

        const root = document.getElementById('questionsRoot');
        const checkBtn = document.getElementById('checkBtn');
        const resultBox = document.getElementById('resultBox');
        const scoreText = document.getElementById('scoreText');
        const levelText = document.getElementById('levelText');
        const errorMessage = document.getElementById('errorMessage');
        const answeredCountSpan = document.getElementById('answeredCount');
        const totalCountSpan = document.getElementById('totalCount');
        const nextContainer = document.getElementById('nextContainer');
        
        totalCountSpan.textContent = quizItems.length;

        // Store submitted flag to prevent double submission
        let isSubmitted = false;
        let answeredStatus = new Array(quizItems.length).fill(false);

        function updateProgress() {
            const answered = answeredStatus.filter(status => status === true).length;
            answeredCountSpan.textContent = answered;
            
            // Enable button only when all questions are answered AND not yet submitted
            if (answered === quizItems.length && !isSubmitted) {
                checkBtn.disabled = false;
            } else if (answered !== quizItems.length) {
                checkBtn.disabled = true;
            }
        }

        function renderQuiz() {
            root.innerHTML = quizItems.map((item, index) => {
                const optionsHtml = item.options.map((opt, optIndex) => `
                    <label class="mod4-opt" data-q="${index}" data-opt="${optIndex}">
                        <input type="radio" name="q_${index}" value="${optIndex}"> ${opt}
                    </label>
                `).join('');

                return `
                    <article class="mod4-q" id="q_${index}" data-q-index="${index}">
                        <p class="mod4-q-title">
                            <span>${item.q}</span>
                            <span class="status-icon" id="status_${index}"></span>
                        </p>
                        <div class="options-container">${optionsHtml}</div>
                    </article>
                `;
            }).join('');

            // Add event listeners to each radio button to update status
            quizItems.forEach((_, index) => {
                const radios = document.querySelectorAll(`input[name="q_${index}"]`);
                radios.forEach(radio => {
                    radio.addEventListener('change', () => {
                        answeredStatus[index] = true;
                        updateQuestionStatus(index);
                        updateProgress();
                        // Hide error message when user starts answering
                        errorMessage.classList.remove('show');
                    });
                });
            });
        }

        function updateQuestionStatus(qIndex) {
            const selected = getChosenValue(qIndex);
            const statusIcon = document.getElementById(`status_${qIndex}`);
            const questionCard = document.getElementById(`q_${qIndex}`);
            
            if (selected !== -1) {
                // Question is answered - show green check
                statusIcon.innerHTML = '✅';
                statusIcon.style.color = '#3ca75e';
                questionCard.classList.remove('missing');
            } else {
                // Question is unanswered - show nothing
                statusIcon.innerHTML = '';
                questionCard.classList.add('missing');
            }
        }

        function checkAllQuestionsAnswered() {
            let allAnswered = true;

            for (let i = 0; i < quizItems.length; i++) {
                const selected = getChosenValue(i);
                if (selected === -1) {
                    allAnswered = false;
                    updateQuestionStatus(i);
                } else {
                    answeredStatus[i] = true;
                    updateQuestionStatus(i);
                }
            }

            return allAnswered;
        }

        function scrollToFirstMissing() {
            for (let i = 0; i < quizItems.length; i++) {
                const selected = getChosenValue(i);
                if (selected === -1) {
                    const questionElement = document.getElementById(`q_${i}`);
                    if (questionElement) {
                        questionElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        questionElement.style.transition = 'all 0.3s ease';
                        setTimeout(() => {
                            questionElement.style.borderColor = '#d94141';
                        }, 300);
                        setTimeout(() => {
                            questionElement.style.borderColor = '';
                        }, 2000);
                    }
                    break;
                }
            }
        }

        function getChosenValue(qIndex) {
            const selected = document.querySelector(`input[name="q_${qIndex}"]:checked`);
            return selected ? Number(selected.value) : -1;
        }

        function interpretScore(score) {
            if (score >= 12) return '✅ Handa ka na!';
            return '🔁 Subukan muli';
        }

        function calculateScore() {
            let score = 0;
            quizItems.forEach((item, index) => {
                const selectedValue = getChosenValue(index);
                if (selectedValue === item.answer) score += 1;
            });
            return score;
        }

        function getAnswers() {
            let answers = [];

            for (let i = 0; i < quizItems.length; i++) {
                answers.push(getChosenValue(i));
            }

            return answers;
        }

        function generateNextButtons(score) {
            let nextHTML = "";
            
            if (score >= 12) {
                nextHTML = `
                    <a href="{{ route('module4.performance') }}" class="mod4-btn mod4-btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;">
                        🎯 Proceed to Performance Task →
                    </a>
                `;
            } else {
                nextHTML = `
                    <div style="color:#d94141;font-weight:700; margin-bottom:12px;">
                        ⚠️ Kailangan mong makakuha ng 12 pataas upang magpatuloy.
                    </div>
                    <button onclick="location.reload()" class="mod4-btn mod4-btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;">
                        🔄 Ulitin ang Post-Test
                    </button>
                `;
            }
            
            nextContainer.innerHTML = nextHTML;
        }

        // Main check button handler
        checkBtn.addEventListener('click', () => {
            // Prevent multiple submissions
            if (isSubmitted) {
                return;
            }
            
            // Check if all questions are answered
            const allAnswered = checkAllQuestionsAnswered();
            
            if (!allAnswered) {
                // Show error message
                errorMessage.classList.add('show');
                // Scroll to first missing question
                scrollToFirstMissing();
                return;
            }
            
            // Hide error message if all are answered
            errorMessage.classList.remove('show');
            
            // Calculate score
            const score = calculateScore();
            const answers = getAnswers();

            fetch("{{ route('module4.posttest.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    score: score,
                    total_items: quizItems.length,
                    answers: answers
                })
            })
            .then(async res => {
                const data = await res.json();

                if (!res.ok) {
                    console.error("ERROR:", data);
                    alert("Failed to save!");
                    return;
                }

                console.log("Saved:", data);
            })
            .catch(err => {
                console.error("FETCH ERROR:", err);
                alert("Something went wrong!");
            });
            
            // Display score and feedback (NO ANSWER REVELATION)
            scoreText.textContent = `Iskor: ${score} / 15`;
            levelText.textContent = `Pagpapakahulugan: ${interpretScore(score)}`;
            resultBox.classList.add('show');
            resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Generate next buttons based on score
            generateNextButtons(score);
            
            // Mark as submitted
            isSubmitted = true;
            
            // Disable all radio buttons after submission
            for (let i = 0; i < quizItems.length; i++) {
                const radios = document.querySelectorAll(`input[name="q_${i}"]`);
                radios.forEach(radio => {
                    radio.disabled = true;
                });
            }
            
            // Change button text and disable it
            checkBtn.textContent = '✓ Naisumite na';
            checkBtn.disabled = true;
            checkBtn.style.opacity = '0.7';
            checkBtn.style.cursor = 'not-allowed';
        });

        // Initial render
        renderQuiz();
        
        // Initialize status icons
        setTimeout(() => {
            for (let i = 0; i < quizItems.length; i++) {
                updateQuestionStatus(i);
            }
            updateProgress();
        }, 100);
    </script>
@endsection