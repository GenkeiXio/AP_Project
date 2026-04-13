@extends('Teachers.teacherslayout')

@section('title', 'Student Progress')
@section('page-title', 'Module 4 Student')

@push('styles')
<style>
body {
    background: #f8fafc;
    color: #1e293b;
}

/* BACK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;

    padding: 8px 14px;
    border-radius: 10px;

    background: white;
    border: 1px solid #e5e7eb;

    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    color: #64748b;

    transition: all 0.2s ease;
}
.back-link:hover {
    color: #111827;
    transform: translateX(-3px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

/* HEADER CARD */
.student-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;

    background: white;
    padding: 18px 22px;
    border-radius: 16px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-bottom: 22px;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.student-info h2 {
    font-size: 20px;
    font-weight: 700;
}

/* AVATAR */
.avatar {
    width: 55px;
    height: 55px;
    border-radius: 50%;

    background: linear-gradient(135deg, #6366f1, #3b82f6);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 700;
    font-size: 16px;
}

/* BUTTON */
.btn {
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    border-radius: 12px;
    padding: 10px 16px;

    display: inline-flex;
    align-items: center;
    gap: 6px;

    transition: 0.25s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    box-shadow: 0 8px 18px rgba(59,130,246,0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(59,130,246,0.35);
}

.btn-primary:active {
    transform: scale(0.96);
}

.btn-primary::before {
    content: "⬇";
    font-size: 12px;
}

/* TABS */
.tabs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.tab {
    padding: 8px 14px;
    border-radius: 999px;

    background: #e5e7eb;
    color: #475569;

    cursor: pointer;
    font-size: 13px;
    font-weight: 600;

    transition: all 0.2s ease;
}

.tab:hover {
    background: #d1d5db;
}

.tab.active {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    box-shadow: 0 6px 14px rgba(59,130,246,0.25);
}

/* CONTENT */
.content {
    display: none;
}
.content.active {
    display: block;
}

/* CARD */
.table-box {
    background: white;
    padding: 20px;
    border-radius: 16px;
    margin-top: 18px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}

/* SECTION TITLE */
.table-box h4 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 12px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th {
    text-align: left;
    font-weight: 600;
    color: #64748b;
    width: 160px;
}

td {
    font-weight: 500;
    color: #111827;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #f1f5f9;
}

/* TABLE HOVER */
tbody tr:hover {
    background: #f9fafb;
}

/* EMPTY STATE */
.empty {
    text-align: center;
    padding: 20px;
    color: #94a3b8;
    font-size: 14px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .student-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .tabs {
        gap: 8px;
    }

    th {
        width: 120px;
    }
}
</style>
@endpush

@section('content')

<a href="{{ route('teacher.module4.results') }}" class="back-link">
    ← Back to student list
</a>

<div class="student-header">
    <div class="student-info">
        <div class="avatar">
            {{ strtoupper(substr($student->username,0,2)) }}
        </div>
        <h2>{{ $student->username }}</h2>
    </div>

    <a href="{{ route('teacher.module4.export', $student->id) }}" class="btn btn-primary">
        Export CSV
    </a>
</div>

<!-- TABS -->
<div class="tabs">
    <div class="tab active" data-tab="pretest">Pretest</div>
    <div class="tab" data-tab="balikaral">Balikaral</div>
    <div class="tab" data-tab="explore">Explore</div>
    <div class="tab" data-tab="games">Games</div>
    <div class="tab" data-tab="poll">Poll</div>
    <div class="tab" data-tab="performance">Performance Task</div>
    <div class="tab" data-tab="posttest">Post Test</div>
</div>

<!-- PRETEST -->
<div class="content active" id="pretest">
    <div class="table-box">
        <table>
            <tr><th>Score</th><td>{{ $pretest->score ?? 0 }}</td></tr>
            <tr><th>Total</th><td>{{ $pretest->total_items ?? 0 }}</td></tr>
            <tr><th>Level</th><td>{{ $pretest->level ?? 'N/A' }}</td></tr>
        </table>
    </div>

    <div class="table-box">
        <h4 style="margin-bottom:10px;">Answers</h4>

        @if($pretestAnswers->count())
        <table>
            <tr>
                <th>Q#</th>
                <th>Selected</th>
                <th>Correct</th>
                <th>Result</th>
            </tr>

            @foreach($pretestAnswers as $a)
            <tr>
                <td>{{ $a->question_number }}</td>
                <td>{{ $a->selected_option }}</td>
                <td>{{ $a->correct_option }}</td>
                <td>{{ $a->is_correct ? 'Correct' : 'Wrong' }}</td>
            </tr>
            @endforeach
        </table>
        @else
        <div class="empty">No answers recorded</div>
        @endif
    </div>
</div>

<!-- BALIK ARAL -->
<div class="content" id="balikaral">
    <div class="table-box">
        <table>
            <tr><th>Score</th><td>{{ $balikaral->score ?? 0 }}</td></tr>
            <tr><th>Correct</th><td>{{ $balikaral->correct_answers ?? 0 }}</td></tr>
            <tr><th>Total</th><td>{{ $balikaral->total_items ?? 0 }}</td></tr>
            <tr><th>Time</th><td>{{ $balikaral->time_spent ?? 0 }}</td></tr>
        </table>
    </div>
</div>

<!-- EXPLORE -->
<div class="content" id="explore">
    <div class="table-box">
        <table>
            <tr><th>Progress</th><td>{{ $explore->progress_percent ?? 0 }}%</td></tr>
            <tr><th>Status</th>
                <td>{{ ($explore && $explore->is_completed) ? 'Completed' : 'Not Completed' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- GAMES -->
<div class="content" id="games">
    <div class="table-box">
        @forelse($games as $g)
        <table>
            <tr>
                <th>Game</th>
                <th>Score</th>
                <th>Total</th>
                <th>Rank</th>
            </tr>
            <tr>
                <td>{{ $g->game_type }}</td>
                <td>{{ $g->score }}</td>
                <td>{{ $g->total_items }}</td>
                <td>{{ $g->rank }}</td>
            </tr>
        </table>
        @empty
        <div class="empty">No game data</div>
        @endforelse
    </div>
</div>

<!-- POLL -->
<div class="content" id="poll">
    <div class="table-box">
        <table>
            <tr><th>Selected Count</th><td>{{ $poll->selected_count ?? 0 }}</td></tr>
            <tr><th>Options</th>
                <td>{{ $poll ? json_encode($poll->selected_options) : 'N/A' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- PERFORMANCE TASK -->
<div class="content" id="performance">
    <div class="table-box">
        @if($performance)
        <table>
            <tr><th>Status</th>
                <td>{{ $performance->is_submitted ? 'Submitted' : 'Not Submitted' }}</td>
            </tr>
            <tr><th>Format</th><td>{{ $performance->format ?? 'N/A' }}</td></tr>
            <tr><th>Reflection</th><td>{{ $performance->reflection ?? 'N/A' }}</td></tr>
            <tr><th>File</th>
                <td>
                    @if($performance->file_path)
                        <a href="{{ asset('storage/' . $performance->file_path) }}" target="_blank">View File</a>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr><th>Submitted At</th><td>{{ $performance->created_at ?? 'N/A' }}</td></tr>
        </table>
        @else
        <div class="empty">No performance task submitted</div>
        @endif
    </div>
</div>

<!-- POST TEST -->
<div class="content" id="posttest">
    <div class="table-box">
        @if($posttest)
        <table>
            <tr><th>Score</th><td>{{ $posttest->score }} / {{ $posttest->total_items }}</td></tr>
            <tr><th>Status</th>
                <td>
                    @if($posttest->status === 'passed')
                        ✅ Passed
                    @else
                        ❌ Failed
                    @endif
                </td>
            </tr>
            <tr><th>Attempt</th><td>{{ $posttest->attempt }}</td></tr>
            <tr><th>Date Taken</th><td>{{ $posttest->created_at }}</td></tr>
        </table>
        @else
        <div class="empty">No post-test record</div>
        @endif
    </div>

    <div class="table-box">
        <h4>Answers</h4>

        @if($posttest && $posttest->answers)
        <table>
            <tr>
                <th>#</th>
                <th>Selected Answer</th>
            </tr>

            @foreach(json_decode($posttest->answers) as $index => $ans)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ans }}</td>
            </tr>
            @endforeach
        </table>
        @else
        <div class="empty">No answers recorded</div>
        @endif
    </div>
</div>



@endsection

@push('scripts')
<script>
const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {

        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        contents.forEach(c => c.classList.remove('active'));

        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});
</script>
@endpush