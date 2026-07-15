@extends('Teachers.teacherslayout')

@section('title', 'Module 4 Results')
@section('page-title', 'Module 4')

@push('styles')
<style>
:root {
    --m4-accent: #5b8dae;
    --m4-accent-dark: #3f6c8a;
}

body { background: linear-gradient(135deg, #f8fafc, #eaf1f6); color: #1e293b; }

/* BACK BUTTON */
.back-link {
    display: inline-flex; align-items: center; gap: 8px; margin-bottom: 18px;
    padding: 8px 14px; border-radius: 10px;
    background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);
    color: #334155; font-size: 14px; font-weight: 600; text-decoration: none;
    border: 1px solid #e5e7eb; transition: all 0.25s ease;
}
.back-link:hover { background: #fff; transform: translateX(-3px); box-shadow: 0 8px 18px rgba(0,0,0,0.08); }
.back-link i { width: 16px; height: 16px; }

/* HEADER */
.header-row { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 10px; margin-bottom: 20px; }
.header-row h2 { font-size: 28px; font-weight: 800; }
.header-row p { color: #64748b; margin-top: 4px; }
.result-count { font-size: 13px; font-weight: 700; color: var(--m4-accent-dark); background: #e5eef4; padding: 5px 12px; border-radius: 999px; white-space: nowrap; }

/* SEARCH */
.search-wrap { position: relative; margin-bottom: 22px; }
.search-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: #94a3b8; pointer-events: none; }
.search-wrap input {
    width: 100%; padding: 14px 18px 14px 44px; border-radius: 14px; border: 1px solid #e5e7eb;
    outline: none; font-size: 14px; transition: 0.25s; font-family: inherit; background: #fff;
}
.search-wrap input:focus { border-color: var(--m4-accent); box-shadow: 0 0 0 3px rgba(91,141,174,0.15); }

/* GRID */
.students-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; }

/* CARD */
.student-card {
    display: flex; align-items: center; gap: 14px;
    background: rgba(255,255,255,0.85); backdrop-filter: blur(12px);
    border-radius: 18px; padding: 16px;
    text-decoration: none; color: inherit;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: all 0.3s ease;
    opacity: 0; transform: translateY(18px);
}
.student-card:hover, .student-card:focus-visible { transform: translateY(-5px) scale(1.02); box-shadow: 0 18px 35px rgba(0,0,0,0.08); outline: none; }
.student-card:focus-visible { box-shadow: 0 0 0 3px rgba(91,141,174,0.3), 0 18px 35px rgba(0,0,0,0.08); }

.avatar {
    width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--m4-accent), var(--m4-accent-dark));
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px;
}

.student-text { min-width: 0; }
.student-name { font-weight: 700; font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.student-sub { font-size: 12.5px; color: #64748b; }

.arrow { margin-left: auto; font-size: 20px; color: #9ca3af; transition: 0.3s; flex-shrink: 0; }
.student-card:hover .arrow { transform: translateX(5px); color: var(--m4-accent); }

/* EMPTY STATE */
.empty-state { display: none; text-align: center; padding: 60px 20px; color: #64748b; }
.empty-state i { width: 40px; height: 40px; color: #cbd5e1; margin-bottom: 12px; }
.empty-state p { font-size: 14px; }

@media (max-width: 560px) {
    .header-row h2 { font-size: 22px; }
    .students-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<a href="{{ route('teacher.results') }}" class="back-link">
    <i data-lucide="arrow-left"></i> Back to Results
</a>

<div class="header-row">
    <div>
        <h2>Module 4</h2>
        <p>Pagsusuri ng Datos</p>
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
        <a href="{{ route('teacher.module4.student', $s->id) }}" class="student-card" data-name="{{ strtolower($s->username) }}">
            <div class="avatar">{{ strtoupper(substr($s->username, 0, 2)) }}</div>
            <div class="student-text">
                <div class="student-name">{{ $s->username }}</div>
                <p class="student-sub">Last played: {{ $s->last_played ? \Carbon\Carbon::parse($s->last_played)->diffForHumans() : 'N/A' }}</p>
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
