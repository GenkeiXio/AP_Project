@extends('Teachers.teacherslayout')

@section('title', 'Module 2 Results')
@section('page-title', 'Module 2')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #f8fafc, #eef2ff);
    color: #1e293b;
}

/* BACK LINK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;

    padding: 8px 14px;
    border-radius: 10px;

    background: rgba(255,255,255,0.8);
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
    color: #111827;
    transform: translateX(-4px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

/* HEADER */
.top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
}

.page-sub {
    color: #64748b;
    font-size: 14px;
    margin-top: 4px;
}

/* SEARCH */
.search-bar {
    margin-bottom: 20px;
}
.search-bar input {
    width: 100%;
    padding: 13px 16px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;

    font-size: 14px;
    outline: none;

    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);

    transition: 0.25s ease;
}
.search-bar input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
}

/* GRID */
.students-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* CARD */
.student-card {
    position: relative;
    background: white;
    border-radius: 16px;

    padding: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;

    box-shadow: 0 8px 20px rgba(0,0,0,0.05);

    transition: all 0.3s ease;
    cursor: pointer;

    opacity: 0;
    transform: translateY(25px);
}

/* HOVER */
.student-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(0,0,0,0.08);
}

/* INFO */
.student-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

/* AVATAR */
.avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;

    background: linear-gradient(135deg, #6366f1, #3b82f6);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 700;
    font-size: 14px;

    transition: 0.3s ease;
}

.student-card:hover .avatar {
    transform: scale(1.08);
}

/* TEXT */
.student-name {
    font-weight: 700;
    font-size: 15px;
}

.student-sub {
    font-size: 13px;
    color: #64748b;
    margin-top: 2px;
}

/* ARROW */
.arrow {
    font-size: 18px;
    color: #9ca3af;
    transition: 0.3s;
}

.student-card:hover .arrow {
    transform: translateX(5px);
    color: #6366f1;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .students-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .students-grid {
        grid-template-columns: 1fr;
    }

    .top-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
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
    <input type="text" id="" placeholder="">
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
                <p>Last played: 
                    {{ isset($s->last_played) && $s->last_played 
                        ? \Carbon\Carbon::parse($s->last_played)->diffForHumans() 
                        : 'N/A' 
                    }}
                </p>
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