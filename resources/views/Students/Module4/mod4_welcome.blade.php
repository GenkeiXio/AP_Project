<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module 4 - Welcome</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background-color:#f0f0f0;
}

/* MAIN CONTAINER */
.page{
    position:relative;
    width:100%;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    overflow-x:hidden;
}

/* BACKGROUND IMAGE */
.bg-img{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    object-fit:cover;
    z-index:0;
}

/* HEADER */
.header{
    position:absolute;
    top:20px;
    left:20px;
    font-weight:800;
    z-index:3;
    color:#222;
    font-size:18px;
    background:rgba(255,255,255,0.9);
    padding:10px 15px;
    border-radius:8px;
}

/* CONTENT CENTER */
.content{
    position:relative;
    z-index:2;
    text-align:center;
    padding:20px;
    width:100%;
    max-width:800px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

/* OVERLAY TEXT */
.overlay{
    background:rgba(0,0,0,0.6);
    padding:40px 30px;
    border-radius:15px;
    color:white;
    font-size:20px;
    line-height:1.8;
    margin:20px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.1);
}

.overlay strong{
    color:#ffd700;
    font-weight:700;
}

/* BUTTON */
.btn-next{
    margin-top:40px;
    display:inline-block;
    padding:14px 40px;
    border-radius:12px;
    background:linear-gradient(135deg,#28a745,#1e7e34);
    color:white;
    font-weight:700;
    text-decoration:none;
    transition:all 0.3s ease;
    box-shadow:0 4px 15px rgba(40,167,69,0.3);
    font-size:16px;
    border:2px solid transparent;
}

.btn-next:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(40,167,69,0.5);
    background:linear-gradient(135deg,#1e7e34,#155724);
    color:white;
    text-decoration:none;
}

.btn-next:active{
    transform:translateY(0);
    box-shadow:0 4px 15px rgba(40,167,69,0.3);
}

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
    .header {
        font-size:16px;
        padding:8px 12px;
        top:15px;
        left:15px;
    }

    .overlay {
        padding:30px 20px;
        font-size:18px;
        margin:15px;
    }

    .btn-next {
        padding:12px 30px;
        font-size:15px;
        margin-top:30px;
    }

    .content {
        padding:15px;
    }
}

@media (max-width: 480px) {
    .header {
        font-size:14px;
        padding:6px 10px;
        top:10px;
        left:10px;
    }

    .overlay {
        padding:25px 15px;
        font-size:16px;
        margin:10px;
        line-height:1.6;
    }

    .btn-next {
        padding:11px 25px;
        font-size:14px;
        margin-top:25px;
    }

    .content {
        padding:10px;
    }

    .page {
        min-height:calc(100vh + 50px);
    }
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