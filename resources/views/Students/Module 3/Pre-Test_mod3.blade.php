@extends('Students.studentslayout')
@section('title', 'Pre-Test Module 3')

@push('styles')
<style>
.mod3-pretest-wrap {
    max-width: 1000px;
    margin: 24px auto;
    padding: 0 16px 28px;
}

.mod3-head {
    background: #ffffff;
    border: 2px solid #d8eadb;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 10px 22px rgba(29, 92, 52, 0.1);
}

.mod3-head h1 {
    margin: 0;
    color: #1f4f32;
    font-size: clamp(1.2rem, 2.4vw, 1.8rem);
}

.mod3-head p {
    margin: 8px 0 0;
    color: #40624b;
    line-height: 1.5;
}

.mod3-score-guide {
    margin-top: 12px;
    padding: 12px;
    border-radius: 12px;
    background: #f6fff7;
    border: 1px solid #d7e7da;
    color: #305942;
}

.mod3-questions {
    margin-top: 16px;
    display: grid;
    gap: 12px;
}

.mod3-q {
    background: #fff;
    border: 1px solid #dfece1;
    border-radius: 14px;
    padding: 14px;
}

.mod3-q-title {
    margin: 0 0 10px;
    color: #214a33;
    font-weight: 800;
}

.mod3-opt {
    display: block;
    padding: 8px 10px;
    border: 1px solid #dde9e0;
    border-radius: 10px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: 0.15s;
}

.mod3-opt:hover {
    background: #f6fff7;
}

.mod3-opt.correct {
    border-color: #3ca75e;
    background: #ebfff0;
}

.mod3-opt.wrong {
    border-color: #d94141;
    background: #fff0f0;
}

.mod3-actions {
    margin-top: 16px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.mod3-btn {
    border: none;
    border-radius: 12px;
    padding: 11px 16px;
    font-weight: 800;
    cursor: pointer;
}

.mod3-btn-primary {
    background: linear-gradient(180deg, #7fd46a, #59ab44);
    color: #11351f;
}

.mod3-btn-ghost {
    background: #eef8ef;
    color: #2f5a40;
    border: 1px solid #c9dfcd;
}

.mod3-result {
    margin-top: 16px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid #d8eadb;
    background: #fff;
    display: none;
}

.mod3-result.show {
    display: block;
}

.mod3-score {
    margin: 0;
    font-weight: 900;
    color: #1e4d31;
}

.mod3-level {
    margin: 8px 0 0;
    font-weight: 800;
}

.mod3-feedback {
    margin: 10px 0 0;
    color: #3f604a;
}

.mod3-next {
    margin-top: 14px;
}
</style>
@endpush

@section('content')
<div class="mod3-pretest-wrap">
    <section class="mod3-head">
        <h1>🎮 PRE-TEST: Gaano Ka Kahanda? (Advanced Level)</h1>
        <p><strong>Panuto:</strong> Basahin at unawain ang bawat sitwasyon. Piliin ang pinakaangkop na sagot.</p>

        <div class="mod3-score-guide">
            <strong>Score Interpretation:</strong><br>
            0–5 → 🔴 Kailangan ng gabay<br>
            6–10 → 🟡 May kaalaman<br>
            11–15 → 🟢 Handa sa sakuna
        </div>
    </section>

    <section class="mod3-questions" id="questionsRoot"></section>

    <div class="mod3-actions">
        <button class="mod3-btn mod3-btn-primary" id="checkBtn" type="button">Ipakita ang Iskor at Tamang Sagot</button>
        <a class="mod3-btn mod3-btn-ghost" href="{{ route('module3.home') }}" style="text-decoration:none;display:inline-flex;align-items:center;">⬅ Bumalik</a>
    </div>

    <section class="mod3-result" id="resultBox">
        <p class="mod3-score" id="scoreText"></p>
        <p class="mod3-level" id="levelText"></p>
        <p class="mod3-feedback">Ang iyong pre-test ay magsisilbing panimulang batayan ng iyong kaalaman. Handa ka na bang mas pagyamanin pa ito?</p>
        <div class="mod3-next">
            <a class="mod3-btn mod3-btn-primary" href="{{ route('module3.next') }}" style="text-decoration:none;display:inline-flex;align-items:center;">Magpatuloy sa Susunod na Pahina →</a>
        </div>
    </section>
</div>

<script>
const quizItems = [
    {
        q: '1) Ano ang pinakaangkop na paglalarawan ng hazard?',
        options: ['A. Pangyayaring nakalipas na', 'B. Banta na maaaring magdulot ng pinsala', 'C. Plano ng pamahalaan', 'D. Uri ng komunidad'],
        answer: 1
    },
    {
        q: '2) Kailan nagiging disaster ang isang hazard?',
        options: ['A. Kapag may ulan', 'B. Kapag may tao sa lugar', 'C. Kapag may pinsala dahil sa kahinaan ng komunidad', 'D. Kapag gabi'],
        answer: 2
    },
    {
        q: '3) Ano ang ibig sabihin ng vulnerability?',
        options: ['A. Kakayahang tumulong', 'B. Kahinaan ng tao o lugar sa panganib', 'C. Uri ng hazard', 'D. Plano ng barangay'],
        answer: 1
    },
    {
        q: '4) Kung ang isang komunidad ay matibay ang bahay ngunit nasa flood-prone area, ano ito?',
        options: ['A. Walang hazard', 'B. Mataas na vulnerability pa rin', 'C. Walang risk', 'D. Ligtas na lugar'],
        answer: 1
    },
    {
        q: '5) Ano ang layunin ng disaster preparedness?',
        options: ['A. Maghintay ng tulong', 'B. Mabawasan ang epekto ng sakuna', 'C. Maglaro', 'D. Magtago'],
        answer: 1
    },
    {
        q: '6) Alin ang pinakamahalagang gawin bago ang bagyo?',
        options: ['A. Lumabas', 'B. Maghanda ng emergency kit at makinig sa balita', 'C. Matulog', 'D. Mag-video'],
        answer: 1
    },
    {
        q: '7) Ano ang pinakaangkop na gawin kapag may evacuation order?',
        options: ['A. Maghintay muna', 'B. Sumunod agad upang maiwasan ang panganib', 'C. Huwag pansinin', 'D. Lumabas mag-isa'],
        answer: 1
    },
    {
        q: '8) Bakit mahalaga ang early warning system?',
        options: ['A. Para sa ingay', 'B. Para mabigyan ng oras ang tao na maghanda', 'C. Para maglibang', 'D. Para maghintay'],
        answer: 1
    },
    {
        q: '9) Ano ang katangian ng top-down approach?',
        options: ['A. Komunidad ang lider', 'B. Pamahalaan ang pangunahing nagdedesisyon', 'C. Walang plano', 'D. Walang aksyon'],
        answer: 1
    },
    {
        q: '10) Ano ang limitasyon ng top-down approach?',
        options: ['A. Mabilis', 'B. Hindi isinasaalang-alang ang lokal na pangangailangan', 'C. Malakas', 'D. Kumpleto'],
        answer: 1
    },
    {
        q: '11) Ano ang pangunahing ideya ng bottom-up approach?',
        options: ['A. Walang lider', 'B. Aktibong pakikilahok ng komunidad', 'C. Walang plano', 'D. Mabagal'],
        answer: 1
    },
    {
        q: '12) Ano ang layunin ng CBDRRM?',
        options: ['A. Maghintay ng tulong', 'B. Palakasin ang kakayahan ng komunidad sa sakuna', 'C. Magtago', 'D. Maglaro'],
        answer: 1
    },
    {
        q: '13) Ano ang tamang gawin habang lumilindol?',
        options: ['A. Tumakbo palabas agad', 'B. Magtago sa ilalim ng matibay na mesa', 'C. Tumalon', 'D. Sumigaw'],
        answer: 1
    },
    {
        q: '14) Ano ang pinakamainam gawin pagkatapos ng baha?',
        options: ['A. Pumasok agad', 'B. Suriin muna ang kuryente at paligid', 'C. Matulog', 'D. Maglaro'],
        answer: 1
    },
    {
        q: '15) Ano ang ibig sabihin ng resilience?',
        options: ['A. Kahinaan', 'B. Kakayahang makabangon at makapag-adjust', 'C. Uri ng sakuna', 'D. Uri ng lupa'],
        answer: 1
    }
];

const root = document.getElementById('questionsRoot');
const checkBtn = document.getElementById('checkBtn');
const resultBox = document.getElementById('resultBox');
const scoreText = document.getElementById('scoreText');
const levelText = document.getElementById('levelText');

function renderQuiz() {
    root.innerHTML = quizItems.map((item, index) => {
        const optionsHtml = item.options.map((opt, optIndex) => `
            <label class="mod3-opt" data-q="${index}" data-opt="${optIndex}">
                <input type="radio" name="q_${index}" value="${optIndex}"> ${opt}
            </label>
        `).join('');

        return `
            <article class="mod3-q" id="q_${index}">
                <p class="mod3-q-title">${item.q}</p>
                <div>${optionsHtml}</div>
            </article>
        `;
    }).join('');
}

function getChosenValue(qIndex) {
    const selected = document.querySelector(`input[name="q_${qIndex}"]:checked`);
    return selected ? Number(selected.value) : -1;
}

function interpretScore(score) {
    if (score <= 5) return '🔴 Kailangan ng gabay';
    if (score <= 10) return '🟡 May kaalaman';
    return '🟢 Handa';
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
    levelText.textContent = `Interpretasyon: ${interpretScore(score)}`;
    resultBox.classList.add('show');
    resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

checkBtn.addEventListener('click', revealAnswersAndScore);
renderQuiz();
</script>
@endsection
