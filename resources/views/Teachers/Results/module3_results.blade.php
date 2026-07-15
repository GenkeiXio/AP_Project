@extends('Teachers.teacherslayout')

@section('title', 'Module 3 Results')
@section('page-title', 'Module 3')

@push('styles')
<style>
:root {
    --m3-accent: #e8922a;
    --m3-accent-dark: #c97418;
}

body { background: linear-gradient(135deg, #f8fafc, #fdf3e8); color: #1e293b; }

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
.header-row { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 10px; margin-bottom: 18px; }
.header-row h1 { font-size: 28px; font-weight: 800; }
.header-row p { color: #64748b; font-size: 14px; margin-top: 4px; }
.result-count { font-size: 13px; font-weight: 700; color: var(--m3-accent-dark); background: #fdecd2; padding: 5px 12px; border-radius: 999px; white-space: nowrap; }

/* SEARCH */
.search-wrap { position: relative; margin-bottom: 22px; }
.search-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: #94a3b8; pointer-events: none; }
.search-wrap input {
    width: 100%; padding: 12px 16px 12px 44px; border-radius: 12px; border: 1px solid #e2e8f0;
    outline: none; font-size: 14px; background: #fff; transition: 0.25s ease; font-family: inherit;
}
.search-wrap input:focus { border-color: var(--m3-accent); box-shadow: 0 0 0 3px rgba(232,146,42,0.15); }

/* GRID */
.students-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; }

/* CARD */
.student-card {
    display: flex; align-items: center; gap: 14px; background: #fff; border-radius: 16px; padding: 16px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.04); transition: 0.25s ease; cursor: pointer;
    text-decoration: none; color: inherit; opacity: 0; transform: translateY(18px);
}
.student-card:hover, .student-card:focus-visible { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.07); outline: none; }
.student-card:focus-visible { box-shadow: 0 0 0 3px rgba(232,146,42,0.3), 0 15px 30px rgba(0,0,0,0.07); }

.avatar {
    width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--m3-accent), var(--m3-accent-dark));
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px; transition: 0.3s ease;
}
.student-card:hover .avatar { transform: scale(1.08); }

.student-info { min-width: 0; }
.student-info h3 { margin: 0; font-size: 15px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.student-info p { margin: 0; font-size: 12.5px; color: #64748b; margin-top: 2px; }

.arrow { margin-left: auto; font-size: 20px; color: #9ca3af; transition: 0.3s; flex-shrink: 0; }
.student-card:hover .arrow { transform: translateX(5px); color: var(--m3-accent); }

/* EMPTY STATE */
.empty-state { display: none; text-align: center; padding: 60px 20px; color: #64748b; }
.empty-state i { width: 40px; height: 40px; color: #cbd5e1; margin-bottom: 12px; }
.empty-state p { font-size: 14px; }

@media (max-width: 560px) {
    .header-row h1 { font-size: 22px; }
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
        <h1>Module 3</h1>
        <p>Pag-unawa sa Teksto</p>
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
    @foreach($students as $student)
        <a href="{{ route('teacher.module3.student', $student->id) }}" class="student-card" data-name="{{ strtolower($student->username) }}">
            <div class="avatar">{{ strtoupper(substr($student->username, 0, 2)) }}</div>
            <div class="student-info">
                <h3>{{ $student->username }}</h3>
                <p>Last played: {{ $student->last_played ? \Carbon\Carbon::parse($student->last_played)->diffForHumans() : 'N/A' }}</p>
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
