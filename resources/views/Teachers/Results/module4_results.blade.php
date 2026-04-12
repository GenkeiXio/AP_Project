@extends('Teachers.teacherslayout')

@section('title', 'Module 4 Results')
@section('page-title', 'Module 4')

@push('styles')
<style>
body {
    background: #f8fafc;
}

/* BACK BUTTON */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;

    padding: 8px 14px;
    border-radius: 10px;

    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);

    color: #334155;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;

    border: 1px solid #e5e7eb;
    transition: all 0.25s ease;
}
.back-link:hover {
    background: white;
    transform: translateX(-3px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

/* HEADER */
.header-row {
    margin-bottom: 20px;
}
.header-row h2 {
    font-size: 28px;
    font-weight: 800;
}
.header-row p {
    color: #64748b;
    margin-top: 4px;
}

/* SEARCH */
.search-bar {
    margin-bottom: 22px;
}
.search-bar input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    outline: none;
    font-size: 14px;
    transition: 0.25s;
}
.search-bar input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}

/* GRID */
.students-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* CARD */
.student-card {
    display: flex;
    align-items: center;
    gap: 14px;

    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(12px);

    border-radius: 18px;
    padding: 18px;

    text-decoration: none;
    color: inherit;

    box-shadow: 0 10px 25px rgba(0,0,0,0.05);

    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
}

/* hover */
.student-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 18px 35px rgba(0,0,0,0.08);
}

/* AVATAR */
.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;

    background: linear-gradient(135deg, #6366f1, #3b82f6);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 700;
    font-size: 14px;
}

/* TEXT */
.student-name {
    font-weight: 700;
    font-size: 15px;
}
.student-sub {
    font-size: 13px;
    color: #64748b;
}

/* ARROW */
.arrow {
    margin-left: auto;
    font-size: 18px;
    color: #9ca3af;
    transition: 0.3s;
}
.student-card:hover .arrow {
    transform: translateX(5px);
    color: #6366f1;
}
</style>
@endpush

@section('content')

<!-- BACK -->
<a href="{{ route('teacher.results') }}" class="back-link">
    <i data-lucide="arrow-left"></i> Back to Results
</a>

<!-- HEADER -->
<div class="header-row">
    <h2>Module 4</h2>
    <p>Pagsusuri ng Datos — {{ count($students) }} students</p>
</div>

<!-- SEARCH -->
<div class="search-bar">
    <input type="text"  placeholder="">
</div>

<!-- GRID -->
<div class="students-grid" id="studentsGrid">

@foreach($students as $s)
<a href="{{ route('teacher.module4.student', $s->id) }}" class="student-card">

    <div class="avatar">
        {{ strtoupper(substr($s->username,0,2)) }}
    </div>

    <div>
        <div class="student-name">{{ $s->username }}</div>
        <div class="student-sub">ID: {{ $s->id }}</div>
    </div>

    <div class="arrow">›</div>

</a>
@endforeach

</div>

@endsection

@push('scripts')
<script>
const cards = document.querySelectorAll('.student-card');

// STAGGER ANIMATION
cards.forEach((card, index) => {
    setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
    }, index * 100);
});

// SEARCH
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function () {
    let value = this.value.toLowerCase();

    cards.forEach(card => {
        let text = card.innerText.toLowerCase();

        if (text.includes(value)) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }
    });
});
</script>
@endpush