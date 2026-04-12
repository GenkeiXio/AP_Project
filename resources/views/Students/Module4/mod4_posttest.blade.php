@extends('Students.studentslayout')
@section('title', 'Post-Test Modyul 4')

@push('styles')
<style>
.mod4-pretest-wrap { max-width:1000px; margin:24px auto; padding:0 16px 28px;}
.mod4-head { background:#fff; border:2px solid #d8eadb; border-radius:18px; padding:18px;}
.mod4-questions { margin-top:16px; display:grid; gap:12px;}
.mod4-q { background:#fff; border:1px solid #dfece1; border-radius:14px; padding:14px;}
.mod4-opt { display:block; padding:8px; border:1px solid #dde9e0; border-radius:10px; margin-bottom:8px; cursor:pointer;}
.mod4-actions{margin-top:16px;}
.mod4-btn{padding:10px 16px;border-radius:10px;border:none;font-weight:700;}
.mod4-btn-primary{background:#59ab44;color:#fff;}
.mod4-result{margin-top:16px;padding:14px;border-radius:12px;background:#fff;display:none;}
.mod4-result.show{display:block;}
</style>
@endpush

@section('content')
<div class="mod4-pretest-wrap">

<section class="mod4-head">
<h1>V. POST-TEST: “Handa Ka Na Ba?”</h1>
<p><strong>Panuto:</strong> Basahin ang bawat sitwasyon. Piliin ang PINAKATAMANG sagot.</p>

<div class="mod4-score-guide">
<strong>Passing Score:</strong><br>
12–15 → ✅ Handa ka na!<br>
0–11 → 🔁 Subukan muli
</div>
</section>

<section id="questionsRoot" class="mod4-questions"></section>

<div class="mod4-actions">
<button id="checkBtn" class="mod4-btn mod4-btn-primary">Ipakita ang Resulta</button>
</div>

<section id="resultBox" class="mod4-result">
<p id="scoreText"></p>
<p id="levelText"></p>

<!-- ✅ EMPTY CONTAINER (IMPORTANT FIX) -->
<div class="mt-3" id="nextContainer"></div>

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

function renderQuiz(){
root.innerHTML = quizItems.map((item,i)=>`
<div class="mod4-q">
<p><strong>${item.q}</strong></p>
${item.options.map((opt,j)=>`
<label class="mod4-opt">
<input type="radio" name="q${i}" value="${j}"> ${opt}
</label>
`).join('')}
</div>
`).join('');
}

function getScore(){
let score=0;
quizItems.forEach((q,i)=>{
let val=document.querySelector(`input[name="q${i}"]:checked`);
if(val && Number(val.value)===q.answer) score++;
});
return score;
}

document.getElementById('checkBtn').onclick=()=>{
let score=getScore();

document.getElementById('resultBox').classList.add('show');
document.getElementById('scoreText').innerText=`Iskor: ${score}/15`;

let nextHTML="";

/* PASS */
if(score >= 12){
document.getElementById('levelText').innerText="✅ Handa ka na!";

nextHTML = `
<a href="{{ route('module4.performance') }}" class="mod4-btn mod4-btn-primary">
🎯 Proceed to Performance Task →
</a>
`;
}

/* FAIL */
else{
document.getElementById('levelText').innerText="🔁 Subukan muli";

nextHTML = `
<div style="color:#d94141;font-weight:700;">
⚠️ Kailangan mong makakuha ng 12 pataas upang magpatuloy.
</div>
<button onclick="location.reload()" class="mod4-btn mod4-btn-primary mt-2">
🔄 Ulitin ang Post-Test
</button>
`;
}

document.getElementById('nextContainer').innerHTML = nextHTML;
};

renderQuiz();

</script>
@endsection