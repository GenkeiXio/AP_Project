<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module 4 - Performance Task</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#eef7ff,#f4fff8);
}

.container-box{
    max-width:1000px;
    margin:auto;
    padding:20px;
}

.section{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

h1{
    font-weight:900;
}

.title{
    font-size:20px;
    font-weight:700;
    color:#2d6a4f;
}

.highlight{
    font-weight:700;
    color:#1b4332;
}

ul{
    margin-top:10px;
}

.format-box{
    background:#f0fff4;
    padding:15px;
    border-radius:10px;
}

.reflection-box textarea,
select{
    width:100%;
    padding:10px;
    border-radius:10px;
    border:1px solid #ccc;
}

.btn-submit{
    margin-top:20px;
    padding:12px 25px;
    background:linear-gradient(135deg,#28a745,#1e7e34);
    border:none;
    color:white;
    font-weight:700;
    border-radius:10px;
}

.final-message{
    margin-top:20px;
    padding:15px;
    background:#e6ffed;
    border-radius:10px;
    font-weight:700;
}
</style>
</head>

<body>

<div class="container-box">

<h1>🎯 FINAL PERFORMANCE TASK</h1>

<div class="section">
<div class="title">🧩 Pamagat:</div>
<p><strong>“Ligtas na Komunidad: Plano ng Isang Lider”</strong></p>
</div>

<div class="section">
<div class="title">🎯 Sitwasyon:</div>
<p>👉 Ikaw ay isang Punong Barangay na haharap sa iba’t ibang hamong pangkapaligiran tulad ng bagyo, baha, lindol, at pagputok ng bulkan.</p>
<p>👉 Kailangan mong bumuo ng konkretong plano upang matiyak ang:</p>
<ul>
<li>Kahandaan</li>
<li>Disiplina</li>
<li>Kooperasyon ng iyong komunidad</li>
</ul>
</div>

<div class="section">
<div class="title">📝 Gawain:</div>

<p class="highlight">📌 1. KAHANDAAN (Preparedness Plan)</p>
<p>Ano ang iyong gagawin bago ang sakuna?</p>

<p class="highlight">📌 2. DISIPLINA (Rules & Protocols)</p>
<p>Anong mga patakaran ang ipatutupad mo?</p>

<p class="highlight">📌 3. KOOPERASYON (Community Action)</p>
<p>Paano mo hihikayatin ang bayanihan?</p>

<p class="highlight">📌 4. PAGTUGON (Response Plan)</p>
<p>Ano ang gagawin habang may sakuna?</p>

<p class="highlight">📌 5. PAGBANGON (Recovery Plan)</p>
<p>Ano ang gagawin pagkatapos ng sakuna?</p>

</div>

<!-- ✅ FORM START -->
<form method="POST" action="{{ route('module4.performance.submit') }}">
@csrf

<div class="section format-box">
<div class="title">🎨 FORMAT (PUMILI NG ISA):</div>

<select name="format" required>
    <option value="">-- Pili ng Format --</option>
    <option value="written">📄 Written Plan</option>
    <option value="poster">📊 Poster / Infographic</option>
    <option value="video">🎥 Video</option>
    <option value="slides">📱 Slides</option>
</select>

</div>

<div class="section reflection-box">
<div class="title">💬 REFLECTION (REQUIRED)</div>

<p>👉 Sagutin sa 2–3 pangungusap:</p>
<p><strong>“Ano ang pinakamahalagang natutunan mo sa gawaing ito bilang isang lider?”</strong></p>

<textarea name="reflection" rows="4" required placeholder="Isulat ang iyong sagot dito...">{{ old('reflection') }}</textarea>

<button type="submit" class="btn-submit">Ipasa ang Gawain</button>

</div>

</form>
<!-- ✅ FORM END -->

<!-- ✅ SUCCESS MESSAGE -->
@if(session('success'))
<div class="final-message">
    ✅ {{ session('success') }}

    <div style="margin-top: 20px;">
        <a href="{{ route('module4.buod') }}" class="btn-submit" style="text-decoration: none; display:inline-block;">
            📖 Proceed to Buod ng Aralin →
        </a>
    </div>
</div>
@endif

<!-- ✅ VALIDATION ERRORS -->
@if($errors->any())
<div class="alert alert-danger mt-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

</div>

</body>
</html>