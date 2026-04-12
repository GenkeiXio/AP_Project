{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 4\Pre-Test_mod4.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Paunang Pagsusulit Modyul 4')

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

.mod4-opt.correct {
    border-color: #3ca75e;
    background: #ebfff0;
}

.mod4-opt.wrong {
    border-color: #d94141;
    background: #fff0f0;
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
            <h1>🎮 PRE-TEST: Pamumuno at Pagtugon sa Sakuna</h1>
            <p><strong>Panuto:</strong> Basahin at unawain ang bawat sitwasyon. Piliin ang pinakaangkop na sagot.</p>

            <div class="mod4-score-guide">
                <strong>Pagpapakahulugan ng Iskor:</strong><br>
                0–5 → 🔴 Kailangan ng gabay<br>
                6–10 → 🟡 May kaalaman<br>
                11–15 → 🟢 Handa sa sakuna
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
            <button class="mod4-btn mod4-btn-primary" id="checkBtn" type="button" disabled>Ipakita ang Iskor at Tamang Sagot</button>
            <a class="mod4-btn mod4-btn-ghost" href="{{ route('module4.home') }}" style="text-decoration:none;display:inline-flex;align-items:center;">⬅ Bumalik</a>
        </div>

        <section class="mod4-result" id="resultBox">
            <p class="mod4-score" id="scoreText"></p>
            <p class="mod4-level" id="levelText"></p>
            <p class="mod4-feedback">Ang iyong paunang pagsusulit ay magsisilbing panimulang batayan ng iyong kaalaman. Handa ka na bang mas pagyamanin pa ito?</p>
            <div class="mod4-next">
                <a class="mod4-btn mod4-btn-primary" href="{{ route('module4.balikaral') }}">
                    Magpatuloy sa Balik-Aral →
                </a>
            </div>
        </section>
    </div>

    <script>
        const quizItems = [
            {
                q: '1) May paparating na bagyo ngunit ayaw lumikas ng mga residente. Ano ang pinakamainam na gawin bilang lider?',
                options: ['A. Hayaan sila', 'B. Magbigay ng malinaw na babala at ipaliwanag ang panganib', 'C. Pilitin agad nang walang paliwanag', 'D. Maghintay ng utos'],
                answer: 1
            },
            {
                q: '2) Sa isang barangay, maraming tao ang hindi sumusunod sa evacuation plan. Ano ang pangunahing problema?',
                options: ['A. Kakulangan sa pera', 'B. Kakulangan sa disiplina', 'C. Kakulangan sa bahay', 'D. Kakulangan sa pagkain'],
                answer: 1
            },
            {
                q: '3) Sa gitna ng baha, may mga taong gustong bumalik sa bahay para kumuha ng gamit. Ano ang dapat mong gawin?',
                options: ['A. Payagan sila', 'B. Ipaliwanag ang panganib at pigilan sila', 'C. Sumama sa kanila', 'D. Iwanan sila'],
                answer: 1
            },
            {
                q: '4) Matapos ang lindol, may bitak ang gusali ngunit may gustong pumasok. Ano ang tamang desisyon?',
                options: ['A. Pahintulutan', 'B. I-inspect muna ang kaligtasan bago papasukin', 'C. Balewalain', 'D. Ipagpatuloy ang normal na gawain'],
                answer: 1
            },
            {
                q: '5) Sa isang komunidad, may maling balita tungkol sa sakuna. Ano ang epekto nito?',
                options: ['A. Nagiging kalmado ang tao', 'B. Nagdudulot ng takot at kalituhan', 'C. Walang epekto', 'D. Nakakatulong sa paghahanda'],
                answer: 1
            },
            {
                q: '6) Sa panahon ng bagyo, may mga taong hindi nakikinig sa babala. Ano ang dapat gawin ng lider?',
                options: ['A. Huwag na silang pansinin', 'B. Palakasin ang information drive at babala', 'C. Iwanan sila', 'D. Maghintay'],
                answer: 1
            },
            {
                q: '7) Sa isang lugar, may sapat na kagamitan ngunit kulang ang koordinasyon. Ano ang magiging epekto?',
                options: ['A. Mas mabilis ang pagtugon', 'B. Magiging magulo ang operasyon', 'C. Walang epekto', 'D. Mas magiging maayos'],
                answer: 1
            },
            {
                q: '8) Sa isang evacuation center, may kaguluhan sa pamamahagi ng relief goods. Ano ang solusyon?',
                options: ['A. Magbigay agad nang walang sistema', 'B. Magpatupad ng maayos na organisasyon at listahan', 'C. Itigil ang pamamahagi', 'D. Hayaan ang kaguluhan'],
                answer: 1
            },
            {
                q: '9) Sa Guinobatan flashflood, ano ang pinakaunang hakbang upang maiwasan ang pinsala?',
                options: ['A. Maghintay', 'B. Magbigay agad ng babala at magpa-evacuate', 'C. Mag-record ng video', 'D. Magpahinga'],
                answer: 1
            },
            {
                q: '10) Sa pagputok ng bulkan, bakit mahalaga ang pagsunod sa alert level?',
                options: ['A. Para sa dokumento', 'B. Dahil ito ay base sa siyentipikong pagsusuri ng panganib', 'C. Para sa media', 'D. Walang dahilan'],
                answer: 1
            },
            {
                q: '11) Kung may aftershock matapos ang lindol, ano ang tamang kilos?',
                options: ['A. Bumalik agad sa bahay', 'B. Manatili sa ligtas na lugar', 'C. Maglakad-lakad', 'D. Magpahinga'],
                answer: 1
            },
            {
                q: '12) Sa isang barangay, may kahandaan ngunit walang kooperasyon. Ano ang posibleng mangyari?',
                options: ['A. Magiging ligtas lahat', 'B. Hindi magiging epektibo ang plano', 'C. Walang epekto', 'D. Mas magiging mabilis'],
                answer: 1
            },
            {
                q: '13) Bakit mahalaga ang emergency kit kahit hindi pa dumarating ang sakuna?',
                options: ['A. Para sa display', 'B. Para sa agarang pangangailangan kung may sakuna', 'C. Para sa laro', 'D. Para sa dekorasyon'],
                answer: 1
            },
            {
                q: '14) Sa isang sitwasyon, may sapat na kaalaman ngunit walang aksyon. Ano ang kakulangan?',
                options: ['A. Kahandaan', 'B. Disiplina', 'C. Kooperasyon', 'D. Lahat ng nabanggit'],
                answer: 3
            },
            {
                q: '15) Bilang lider, alin ang nagpapakita ng pinakamataas na antas ng kahandaan, disiplina, at kooperasyon?',
                options: ['A. Maghintay ng tulong', 'B. Magbigay ng plano, sumunod sa protocol, at hikayatin ang komunidad', 'C. Umalis sa lugar', 'D. Sariling pamilya lang ang tulungan'],
                answer: 1
            }
        ];

        const root = document.getElementById('questionsRoot');
        const checkBtn = document.getElementById('checkBtn');
        const resultBox = document.getElementById('resultBox');
        const scoreText = document.getElementById('scoreText');
        const levelText = document.getElementById('levelText');
        const errorMessage = document.getElementById('errorMessage');
        const answeredCountSpan = document.getElementById('answeredCount');
        const totalCountSpan = document.getElementById('totalCount');
        
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
                // Question is unanswered - show nothing (no red X)
                statusIcon.innerHTML = '';
                questionCard.classList.add('missing');
            }
        }

        function checkAllQuestionsAnswered() {
            let allAnswered = true;
            const missingQuestions = [];

            for (let i = 0; i < quizItems.length; i++) {
                const selected = getChosenValue(i);
                if (selected === -1) {
                    allAnswered = false;
                    missingQuestions.push(i + 1);
                    updateQuestionStatus(i);
                } else {
                    answeredStatus[i] = true;
                    updateQuestionStatus(i);
                }
            }

            return { allAnswered, missingQuestions };
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
            if (score <= 5) return '🔴 Kailangan ng gabay';
            if (score <= 10) return '🟡 May kaalaman';
            return '🟢 Handa sa sakuna';
        }

        function revealAnswersAndScore() {
            let score = 0;

            quizItems.forEach((item, index) => {
                const selectedValue = getChosenValue(index);
                if (selectedValue === item.answer) score += 1;

                const optionLabels = root.querySelectorAll(`label[data-q="${index}"]`);
                optionLabels.forEach((label) => {
                    const opt = Number(label.dataset.opt);
                    label.classList.remove('correct', 'wrong');
                    if (opt === item.answer) {
                        label.classList.add('correct');
                    }
                    if (selectedValue === opt && selectedValue !== item.answer) {
                        label.classList.add('wrong');
                    }
                });
            });

            scoreText.textContent = `Iskor: ${score} / 15`;
            levelText.textContent = `Pagpapakahulugan: ${interpretScore(score)}`;
            resultBox.classList.add('show');
            resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            return score;
        }

        function submitToLocalStorage(score, answers) {
            // Save to localStorage since no DB/controller yet for Module 4
            const module4Result = {
                score: score,
                answers: answers,
                totalItems: quizItems.length,
                timestamp: new Date().toISOString(),
                completed: true
            };
            localStorage.setItem('module4_pretest_result', JSON.stringify(module4Result));
            console.log("Saved to localStorage:", module4Result);
        }

        // Main check button handler
        checkBtn.addEventListener('click', () => {
            // Prevent multiple submissions
            if (isSubmitted) {
                return;
            }
            
            // Check if all questions are answered
            const { allAnswered, missingQuestions } = checkAllQuestionsAnswered();
            
            if (!allAnswered) {
                // Show error message
                errorMessage.classList.add('show');
                // Scroll to first missing question
                scrollToFirstMissing();
                return;
            }
            
            // Hide error message if all are answered
            errorMessage.classList.remove('show');
            
            // Get all answers
            const answers = quizItems.map((_, index) => getChosenValue(index));
            
            // Calculate score and reveal answers
            const score = revealAnswersAndScore();
            
            // Mark as submitted
            isSubmitted = true;
            
            // Disable all radio buttons after submission
            for (let i = 0; i < quizItems.length; i++) {
                const radios = document.querySelectorAll(`input[name="q_${i}"]`);
                radios.forEach(radio => {
                    radio.disabled = true;
                });
            }
            
            // Save to localStorage (no DB for Module 4 yet)
            submitToLocalStorage(score, answers);
            
            // Change button text and disable it
            checkBtn.textContent = '✓ Naisumite na';
            checkBtn.disabled = true;
            checkBtn.style.opacity = '0.7';
            checkBtn.style.cursor = 'not-allowed';
        });

        // Initial render
        renderQuiz();
        
        // Initialize status icons (no X's, just empty)
        setTimeout(() => {
            for (let i = 0; i < quizItems.length; i++) {
                updateQuestionStatus(i);
            }
            updateProgress();
        }, 100);
    </script>
@endsection