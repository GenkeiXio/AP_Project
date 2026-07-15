@extends('Teachers.teacherslayout')

@section('title', 'Teacher Dashboard')
@section('page-title', 'My Students')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #1a5a50, #3a9e8c);
        border-radius: 18px;
        padding: 26px 30px;
        color: #fff;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .welcome-banner h2 { font-family: 'Baloo 2', cursive; font-size: 1.4rem; font-weight: 800; }
    .welcome-banner p  { font-size: 0.88rem; opacity: 0.85; margin-top: 4px; }
    .welcome-banner .wave { font-size: 2.6rem; flex-shrink: 0; }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff; border-radius: 14px; padding: 18px; box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        text-align: center; transition: transform 0.18s ease, box-shadow 0.18s ease;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,0.09); }
    .stat-card .val { font-family: 'Baloo 2', cursive; font-size: 1.9rem; font-weight: 800; color: #1a5a50; line-height: 1.1; }
    .stat-card .lbl { font-size: 0.78rem; color: #9a8060; font-weight: 600; margin-top: 2px; }

    .section-card { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
    .section-header {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        margin-bottom: 18px; flex-wrap: wrap;
    }
    .section-header h2 { font-family: 'Baloo 2', cursive; font-size: 1.05rem; font-weight: 800; color: #3d2a1a; }

    .search-input {
        padding: 9px 16px;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
        width: 220px;
        max-width: 100%;
    }
    .search-input:focus { border-color: #3a9e8c; }

    .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    table { width: 100%; border-collapse: collapse; min-width: 520px; }
    th { text-align: left; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #9a8060; padding: 0 12px 10px; border-bottom: 2px solid #f0e8d8; white-space: nowrap; }
    td { padding: 13px 12px; font-size: 0.9rem; border-bottom: 1px solid #f5ede0; color: #5a4030; }
    tbody tr { transition: background 0.15s ease; }
    tbody tr:hover { background: #fbf8f2; }
    tr:last-child td { border-bottom: none; }

    .avatar-chip { display: inline-flex; align-items: center; gap: 6px; background: #f0f9f5; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 700; color: #2a7a6a; white-space: nowrap; }

    .empty-state { text-align: center; padding: 40px 16px; color: #b5a48a; }
    .empty-state .emoji { font-size: 3rem; margin-bottom: 10px; }

    .no-results { display: none; text-align: center; padding: 30px 16px; color: #b5a48a; font-size: 0.9rem; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 640px) {
        .welcome-banner { padding: 20px 22px; }
        .welcome-banner h2 { font-size: 1.2rem; }
        .section-card { padding: 18px; border-radius: 14px; }
        .search-input { width: 100%; }
        .section-header { flex-direction: column; align-items: stretch; }

        /* Card-style table on small screens */
        .table-scroll { overflow-x: visible; }
        table, thead, tbody, th, td, tr { display: block; }
        table { min-width: 0; }
        thead { display: none; }
        tbody tr {
            background: #fdfbf7; border: 1px solid #f0e8d8; border-radius: 12px;
            padding: 12px 14px; margin-bottom: 10px;
        }
        tbody tr:hover { background: #fdfbf7; }
        td {
            display: flex; justify-content: space-between; align-items: center;
            padding: 6px 0; border-bottom: none; font-size: 0.87rem; gap: 10px;
        }
        td::before {
            content: attr(data-label);
            font-size: 0.68rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.6px; color: #b5a48a; flex-shrink: 0;
        }
        td:first-child { display: none; } /* hide the row-number cell on mobile cards */
    }
</style>
@endpush

@section('content')

<div class="welcome-banner">
    <div>
        <h2>Kumusta, {{ $teacher->name }}! 👋</h2>
        <p>Here's an overview of your students' activity.</p>
    </div>
    <div class="wave">🧭</div>
</div>

<div class="stats-row">
    <div class="stat-card">
        <div class="val">{{ $students->count() }}</div>
        <div class="lbl">Total Students</div>
    </div>
    <div class="stat-card">
        <div class="val">{{ $students->whereNotNull('last_played')->count() }}</div>
        <div class="lbl">Have Played</div>
    </div>
    <div class="stat-card">
        <div class="val">{{ $students->whereNull('avatar')->count() }}</div>
        <div class="lbl">No Avatar Yet</div>
    </div>
</div>

<div class="section-card">
    <div class="section-header">
        <h2>🎒 Student List</h2>
        <input type="text" class="search-input" id="searchStudents" placeholder="🔍 Search students..." oninput="filterStudents()" />
    </div>

    @if($students->isEmpty())
        <div class="empty-state">
            <div class="emoji">🌱</div>
            <p>No students have joined yet. Share the game link with your class!</p>
        </div>
    @else
        <div class="table-scroll">
            <table id="studentTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Avatar</th>
                        <th>Last Played</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $i => $student)
                    <tr>
                        <td data-label="#" style="color:#b5a48a; font-weight:700;">{{ $i + 1 }}</td>
                        <td data-label="Username"><strong>{{ $student->username }}</strong></td>
                        <td data-label="Avatar">
                            @if($student->avatar)
                                <span class="avatar-chip">
                                    @php $icons = ['explorer_boy'=>'🧭','explorer_girl'=>'🗺️','scientist'=>'🔬','adventurer'=>'⚔️']; @endphp
                                    {{ $icons[$student->avatar] ?? '👤' }} {{ ucwords(str_replace('_', ' ', $student->avatar)) }}
                                </span>
                            @else
                                <span style="color:#c0ad90; font-size:0.82rem;">Not set</span>
                            @endif
                        </td>
                        <td data-label="Last Played">
                            @if($student->last_played)
                                <span style="color:#3a9e8c; font-weight:600;">{{ $student->last_played->diffForHumans() }}</span>
                            @else
                                <span style="color:#c0ad90;">Never</span>
                            @endif
                        </td>
                        <td data-label="Joined" style="color:#9a8060; font-size:0.82rem;">{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="no-results" id="noResultsMsg">No students match your search.</div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function filterStudents() {
    const query = document.getElementById('searchStudents').value.toLowerCase();
    const rows  = document.querySelectorAll('#studentTable tbody tr');
    let visibleCount = 0;
    rows.forEach(row => {
        const name = row.querySelector('[data-label="Username"]')?.textContent.toLowerCase() || '';
        const isMatch = name.includes(query);
        row.style.display = isMatch ? '' : 'none';
        if (isMatch) visibleCount++;
    });
    const noResultsMsg = document.getElementById('noResultsMsg');
    if (noResultsMsg) {
        noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}
</script>
@endpush