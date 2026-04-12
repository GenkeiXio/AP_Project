<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module 4 - Welcome</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    overflow:hidden;
}

/* MAIN CONTAINER */
.page{
    position:relative;
    width:100%;
    height:100vh;
}

/* BACKGROUND IMAGE */
.bg-img{
    position:absolute;
    width:100%;
    height:100%;
    object-fit:cover; /* ✅ better than contain */
}

/* HEADER */
.header{
    position:absolute;
    top:10px;
    left:20px;
    font-weight:800;
    z-index:2;
    color:#222;
}

/* CONTENT CENTER */
.content{
    position:absolute;
    top:45%; /* adjusted for better placement */
    left:50%;
    transform:translate(-50%, -50%);
    text-align:center;
    z-index:2;
}

/* OVERLAY TEXT */
.overlay{
    background:rgba(0,0,0,0.4);
    padding:20px 30px;
    border-radius:15px;
    color:white;
    max-width:700px;
    font-size:20px;
    line-height:1.6;
}

/* BUTTON */
.btn-next{
    margin-top:30px;
    display:inline-block;
    padding:12px 30px;
    border-radius:12px;
    background:linear-gradient(135deg,#28a745,#1e7e34);
    color:white;
    font-weight:700;
    text-decoration:none;
    transition:.2s;
}

.btn-next:hover{
    transform:scale(1.05);
    color:white;
}
</style>
</head>

<body>

<div class="page">

    <!-- BACKGROUND IMAGE -->
    <img src="{{ asset('pictures/Module4/welcome_bg.png') }}" class="bg-img">

    <!-- HEADER -->
    <div class="header">
        🧠 TRANSITION TO MODULE 4
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="overlay">
            Ngayon na alam mo na ang mga dapat gawin bago, habang, at pagkatapos ng kalamidad,
            handa ka nang matutunan kung bakit mahalaga ang
            <strong>kahandaan</strong>, <strong>disiplina</strong>, at <strong>kooperasyon</strong>
            sa pagharap sa mga hamong pangkapaligiran.
        </div>

        <a href="{{ route('module4.explore') }}" class="btn-next">
            Magpatuloy ➜
        </a>

    </div>

</div>

</body>
</html>