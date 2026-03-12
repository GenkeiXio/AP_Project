@extends('Teachers.teacherslayout')

@section('title', 'Teacher Dashboard')
@section('page-title', 'My Students')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #1a5a50, #3a9e8c);
        border-radius: 18px;
        padding: 28px 32px;
        color: #fff;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .welcome-banner h2 { font-family: 'Baloo 2', cursive; font-size: 1.5rem; font-weight: 800; }
    .welcome-banner p  { font-size: 0.9rem; opacity: 0.8; margin-top: 4px; }
    .welcome-banner .wave { font-size: 3rem; }

    .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 28px; }

    .stat-card { background: #fff; border-radius: 14px; padding: 20px; box-shadow: 0 3px 12px rgba(0,0,0,0.06); text-align: center; }
    .stat-card .val { font-family: 'Baloo 2', cursive; font-size: 2rem; font-weight: 800; color: #1a5a50; }
    .stat-card .lbl { font-size: 0.8rem; color: #9a8060; font-weight: 600; }

    .section-card { background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
    .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
    .section-header h2 { font-family: 'Baloo 2', cursive; font-size: 1.1rem; font-weight: 800; color: #3d2a1a; }

    .search-input {
        padding: 9px 16px;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
        width: 220px;
    }
    .search-input:focus { border-color: #3a9e8c; }

    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #9a8060; padding: 0 12px 10px; border-bottom: 2px solid #f0e8d8; }
    td { padding: 13px 12px; font-size: 0.9rem; border-bottom: 1px solid #f5ede0; color: #5a4030; }
    tr:last-child td { border-bottom: none; }

    .avatar-chip { display: inline-flex; align-items: center; gap: 6px; background: #f0f9f5; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 700; color: #2a7a6a; }

    .empty-state { text-align: center; padding: 40px; color: #b5a48a; }
    .empty-state .emoji { font-size: 3rem; margin-bottom: 10px; }
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
                    <td style="color:#b5a48a; font-weight:700;">{{ $i + 1 }}</td>
                    <td><strong>{{ $student->username }}</strong></td>
                    <td>
                        @if($student->avatar)
                            <span class="avatar-chip">
                                @php $icons = ['explorer_boy'=>'🧭','explorer_girl'=>'🗺️','scientist'=>'🔬','adventurer'=>'⚔️']; @endphp
                                {{ $icons[$student->avatar] ?? '👤' }} {{ ucwords(str_replace('_', ' ', $student->avatar)) }}
                            </span>
                        @else
                            <span style="color:#c0ad90; font-size:0.82rem;">Not set</span>
                        @endif
                    </td>
                    <td>
                        @if($student->last_played)
                            <span style="color:#3a9e8c; font-weight:600;">{{ $student->last_played->diffForHumans() }}</span>
                        @else
                            <span style="color:#c0ad90;">Never</span>
                        @endif
                    </td>
                    <td style="color:#9a8060; font-size:0.82rem;">{{ $student->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

@push('scripts')
<script>
function filterStudents() {
    const query = document.getElementById('searchStudents').value.toLowerCase();
    const rows  = document.querySelectorAll('#studentTable tbody tr');
    rows.forEach(row => {
        const name = row.cells[1]?.textContent.toLowerCase() || '';
        row.style.display = name.includes(query) ? '' : 'none';
    });
}
</script>
@endpush
