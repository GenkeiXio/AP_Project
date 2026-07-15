@extends('Teachers.teacherslayout')

@section('title', 'Module 2 Results')
@section('page-title', 'Module 2')

@push('styles')
<style>
:root {
    --m2-accent: #3a9e8c;
    --m2-accent-dark: #2a7a6c;
}

body { background: linear-gradient(135deg, #f8fafc, #eef4f3); color: #1e293b; }

/* BACK LINK */
.back-link {
    display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px;
    padding: 8px 14px; border-radius: 10px;
    background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);
    color: #334155; font-size: 14px; font-weight: 600; text-decoration: none;
    border: 1px solid #e5e7eb; transition: all 0.25s ease;
}
.back-link:hover { background: #fff; color: #111827; transform: translateX(-4px); box-shadow: 0 8px 18px rgba(0,0,0,0.08); }
.back-link i { width: 16px; height: 16px; }

/* HEADER */
.top-row { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 10px; margin-bottom: 18px; }
.page-title { font-size: 28px; font-weight: 800; }
.page-sub { color: #64748b; font-size: 14px; margin-top: 4px; }
.result-count { font-size: 13px; font-weight: 700; color: var(--m2-accent-dark); background: #e6f4f1; padding: 5px 12px; border-radius: 999px; white-space: nowrap; }

/* SEARCH */
.search-wrap { position: relative; margin-bottom: 22px; }
.search-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: #94a3b8; pointer-events: none; }
.search-wrap input {
    width: 100%; padding: 13px 16px 13px 44px; border-radius: 12px; border: 1px solid #e5e7eb;
    font-size: 14px; outline: none; background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);
    transition: 0.25s ease; font-family: inherit;
}
.search-wrap input:focus { border-color: var(--m2-accent); box-shadow: 0 0 0 3px rgba(58,158,140,0.15); }

/* GRID */
.students-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; }

/* CARD */
.student-card {
    position: relative; background: #fff; border-radius: 16px; padding: 16px;
    display: flex; align-items: center; justify-content: space-between; gap: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05); transition: all 0.25s ease;
    text-decoration: none; color: inherit;
    opacity: 0; transform: translateY(18px);
}
.student-card:hover, .student-card:focus-visible { transform: translateY(-5px); box-shadow: 0 16px 30px rgba(0,0,0,0.09); outline: none; }
.student-card:focus-visible { box-shadow: 0 0 0 3px rgba(58,158,140,0.3), 0 16px 30px rgba(0,0,0,0.09); }

.student-info { display: flex; align-items: center; gap: 12px; min-width: 0; }

.avatar {
    width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--m2-accent), var(--m2-accent-dark));
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px; transition: 0.3s ease;
}
.student-card:hover .avatar { transform: scale(1.08); }

.student-text { min-width: 0; }
.student-name { font-weight: 700; font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.student-sub { font-size: 12.5px; color: #64748b; margin-top: 2px; }

.arrow { font-size: 20px; color: #9ca3af; transition: 0.3s; flex-shrink: 0; }
.student-card:hover .arrow { transform: translateX(5px); color: var(--m2-accent); }

/* EMPTY STATE */
.empty-state { display: none; text-align: center; padding: 60px 20px; color: #64748b; }
.empty-state i { width: 40px; height: 40px; color: #cbd5e1; margin-bottom: 12px; }
.empty-state p { font-size: 14px; }

@media (max-width: 560px) {
    .page-title { font-size: 22px; }
    .students-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<a href="{{ route('teacher.results') }}" class="back-link">
    <i data-lucide="arrow-left"></i> Back to Results
</a>

<div class="top-row">
    <div>
        <div class="page-title">Module 2</div>
        <div class="page-sub">Sanhi at Bunga</div>
    </div>
    <div class="result-count" id="resultCount">{{ count($students) }} student{{ count($students) === 1 ? '' : 's' }}</div>
</div>

<div class="search-wrap">
    <i data-lucide="search"></i>
    <input
        type="text"
        id="studentSearch"
        name="studentSearch"
        placeholder="Search students by name..."
        aria-label="Search students"
        autocomplete="off"
    >
</div>

<div class="students-grid" id="studentsGrid">
    @foreach($students as $s)
        <a href="{{ route('teacher.module2.student', $s->id) }}" class="student-card" data-name="{{ strtolower($s->username) }}">
            <div class="student-info">
                <div class="avatar">{{ strtoupper(substr($s->username, 0, 2)) }}</div>
                <div class="student-text">
                    <div class="student-name">{{ $s->username }}</div>
                    <div class="student-sub">
                        Last played:
                        {{ isset($s->last_played) && $s->last_played
                            ? \Carbon\Carbon::parse($s->last_played)->diffForHumans()
                            : 'N/A' }}
                    </div>
                </div>
            </div>
            <div class="arrow">›</div>
        </a>
    @endforeach
</div>

<div class="empty-state" id="emptyState">
    <i data-lucide="user-search"></i>
    <p>No students match your search.</p>
</div>

@endsection

@push('scripts')
<script>
(function () {
    const cards = Array.from(document.querySelectorAll('.student-card'));
    const searchInput = document.getElementById('studentSearch');
    const emptyState = document.getElementById('emptyState');
    const resultCount = document.getElementById('resultCount');

    // Staggered entrance animation
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 60);
    });

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const value = this.value.trim().toLowerCase();
            let visibleCount = 0;

            cards.forEach(card => {
                const matches = card.dataset.name.includes(value);
                card.style.display = matches ? 'flex' : 'none';
                if (matches) {
                    visibleCount++;
                    requestAnimationFrame(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    });
                }
            });

            if (resultCount) {
                resultCount.textContent = `${visibleCount} student${visibleCount === 1 ? '' : 's'}`;
            }
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    }
})();
</script>
@endpush
