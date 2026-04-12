@extends('Teachers.teacherslayout')

@section('title', 'Module 3 Results')
@section('page-title', 'Module 3')

@push('styles')
<style>
body {
    background: #f8fafc;
}

/* HEADER */
.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header-row h1 {
    font-size: 26px;
    font-weight: 700;
}

.header-row p {
    color: #64748b;
}

/* SEARCH */
.search-bar {
    width: 100%;
    margin-bottom: 25px;
}

.search-bar input {
    width: 100%;
    padding: 12px 18px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    outline: none;
    font-size: 14px;
}

/* STUDENTS GRID */
.students-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

/* CARD */
.student-card {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.04);
    transition: 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.06);
}

/* AVATAR */
.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e0e7ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #4f46e5;
}

/* TEXT */
.student-info h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.student-info p {
    margin: 0;
    font-size: 13px;
    color: #64748b;
}

/* BACK LINK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;

    padding: 8px 14px;
    border-radius: 10px;

    background: #ffffff;
    color: #334155;

    font-size: 14px;
    font-weight: 500;
    text-decoration: none;

    border: 1px solid #e2e8f0;

    transition: all 0.25s ease;
}

/* HOVER */
.back-link:hover {
    background: #f1f5f9;
    color: #1e293b;
    transform: translateX(-3px);
    box-shadow: 0 5px 12px rgba(0,0,0,0.05);
}

/* ACTIVE */
.back-link:active {
    transform: scale(0.96);
}
</style>
@endpush

@section('content')

<!-- BACK -->
<a href="{{ route('teacher.results') }}" class="back-link">
    ← Back to Results
</a>


<div class="header-row">
    <div>
        <h1>Module 3</h1>
        <p>Pag-unawa sa Teksto — {{ count($students) }} students</p>
    </div>
</div>

<!-- SEARCH -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search students...">
</div>

<!-- STUDENTS -->
<div class="students-grid" id="studentsGrid">

    @foreach($students as $student)
    <a href="{{ route('teacher.module3.student', $student->id) }}" class="student-card">

        <!-- Avatar -->
        <div class="avatar">
            {{ strtoupper(substr($student->username, 0, 2)) }}
        </div>

        <!-- Info -->
        <div class="student-info">
            <h3>{{ $student->username }}</h3>
            <p>Last played: 
                {{ $student->last_played ? \Carbon\Carbon::parse($student->last_played)->diffForHumans() : 'N/A' }}
            </p>
        </div>

    </a>
    @endforeach

</div>

@endsection

@push('scripts')
<script>
    // SEARCH FILTER
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.student-card');

    searchInput.addEventListener('keyup', function () {
        let value = this.value.toLowerCase();

        cards.forEach(card => {
            let name = card.innerText.toLowerCase();

            if (name.includes(value)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });

    // ANIMATION
    const allCards = document.querySelectorAll('.student-card');

    allCards.forEach((card, index) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(20px)";

        setTimeout(() => {
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, index * 100);
    });
</script>
@endpush