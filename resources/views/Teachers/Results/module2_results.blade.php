@extends('Teachers.teacherslayout')

@section('title', 'Module 2 Results')
@section('page-title', 'Module 2')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #f8fafc, #eef2ff);
}

/* BACK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s;
}
.back-link:hover {
    color: #111827;
    transform: translateX(-3px);
}

/* HEADER */
.top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.page-title {
    font-size: 34px;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.page-sub {
    color: #6b7280;
    margin-top: 4px;
}

/* BUTTON */
.export-btn {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    border: none;
    padding: 11px 20px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.25s;
    box-shadow: 0 8px 20px rgba(59,130,246,0.3);
}
.export-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(59,130,246,0.4);
}

/* SEARCH */
.search-bar input {
    width: 100%;
    padding: 15px 18px;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    outline: none;
    transition: 0.25s;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
}
.search-bar input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}

/* GRID */
.students-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

/* CARD */
.student-card {
    position: relative;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(14px);
    border-radius: 18px;
    padding: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transition: all 0.35s ease;
    cursor: pointer;
    opacity: 0;
    transform: translateY(30px);
    overflow: hidden;
}

/* glow effect */
.student-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.5), transparent);
    opacity: 0;
    transition: 0.4s;
}

.student-card:hover::before {
    opacity: 1;
}

.student-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* INFO */
.student-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* AVATAR */
.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #3b82f6);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    letter-spacing: 1px;
    transition: 0.3s;
}

.student-card:hover .avatar {
    transform: scale(1.1);
}

/* TEXT */
.student-name {
    font-weight: 700;
    font-size: 15px;
}

.student-sub {
    font-size: 13px;
    color: #6b7280;
}

/* ARROW */
.arrow {
    font-size: 18px;
    color: #9ca3af;
    transition: 0.3s;
}

.student-card:hover .arrow {
    transform: translateX(6px);
    color: #6366f1;
}

/* BACK LINK (UPGRADED) */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;

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

/* HOVER */
.back-link:hover {
    background: white;
    color: #111827;
    transform: translateX(-4px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
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
    <i data-lucide="arrow-left"></i> Back to Results
</a>

<!-- HEADER -->
<div class="top-row">
    <div>
        <div class="page-title">Module 2</div>
        <div class="page-sub">
            Sanhi at Bunga — {{ count($students) }} students
        </div>
    </div>
</div>

<!-- SEARCH -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search students...">
</div>

<!-- STUDENTS -->
<div class="students-grid" id="studentsGrid">

@foreach($students as $s)
    <div class="student-card" onclick="window.location='{{ route('teacher.module2.student', $s->id) }}'">
        <div class="student-info">
            <div class="avatar">
                {{ strtoupper(substr($s->username, 0, 2)) }}
            </div>
            <div>
                <div class="student-name">{{ $s->username }}</div>

                <div class="student-sub">
                    Pre: {{ $s->pre_score ?? '-' }} 
                    | Post: {{ $s->post_score ?? '-' }} 
                    | XP: {{ $s->total_xp ?? '-' }}
                </div>
            </div>
        </div>

        <div class="arrow">›</div>
    </div>
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
        }, index * 120);
    });

    // SEARCH FILTER (WITH FADE)
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function () {
        let value = this.value.toLowerCase();

        cards.forEach(card => {
            let text = card.innerText.toLowerCase();

            if (text.includes(value)) {
                card.style.display = "flex";
                setTimeout(() => {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(0)";
                }, 50);
            } else {
                card.style.opacity = "0";
                card.style.transform = "translateY(20px)";
                setTimeout(() => {
                    card.style.display = "none";
                }, 200);
            }
        });
    });
</script>
@endpush