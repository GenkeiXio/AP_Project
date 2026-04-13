@extends('Teachers.teacherslayout')

@section('title', 'Student Progress')
@section('page-title', 'Student Progress')

@push('styles')
<style>
body { 
    background: #f8fafc; 
    color: #1e293b;
}

/* BACK LINK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
    color: #64748b;
    text-decoration: none;
    transition: 0.2s;
}
.back-link:hover {
    color: #111827;
    transform: translateX(-3px);
}

/* HEADER */
.student-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    background: white;
    padding: 18px 22px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.student-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #3b82f6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 18px;
}

/* FILTER BOX */
.filter-box {
    background: white;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}

.filter-box h4 {
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 10px;
}

/* TABS */
.tabs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.tab {
    padding: 8px 14px;
    border-radius: 999px;
    background: #e5e7eb;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: 0.2s;
}

.tab:hover {
    background: #d1d5db;
}

.tab.active {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    box-shadow: 0 6px 15px rgba(59,130,246,0.25);
}

/* TABLE BOX */
.table-box {
    background: white;
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}

.table-box h4 {
    margin-bottom: 12px;
    font-size: 16px;
    font-weight: 700;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th {
    text-align: left;
    color: #64748b;
    font-weight: 600;
    width: 180px;
}

td {
    color: #111827;
    font-weight: 500;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #f1f5f9;
}

/* TABLE HOVER (for answer table) */
tbody tr:hover {
    background: #f9fafb;
}

/* BADGES */
.badge {
    padding: 5px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.correct {
    background: #dcfce7;
    color: #16a34a;
}

.wrong {
    background: #fee2e2;
    color: #dc2626;
}

/* BUTTON */
.btn {
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    border-radius: 12px;
    padding: 10px 18px;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    box-shadow: 0 8px 18px rgba(59, 130, 246, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(59, 130, 246, 0.35);
}

.btn-primary:active {
    transform: scale(0.96);
}

/* ICON BEFORE BUTTON */
.btn-primary::before {
    content: "⬇";
    font-size: 13px;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .student-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .tabs {
        gap: 8px;
    }

    th {
        width: 120px;
    }
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 20px;

    padding: 8px 14px;
    border-radius: 10px;

    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);

    border: 1px solid #e5e7eb;

    font-size: 13px;
    font-weight: 600;
    color: #475569;

    text-decoration: none;

    transition: all 0.25s ease;
}

/* hover */
.back-link:hover {
    background: #ffffff;
    color: #111827;

    transform: translateX(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.06);
}

/* click */
.back-link:active {
    transform: scale(0.96);
}

/* optional icon fix */
.back-link i {
    font-size: 14px;
}
</style>
@endpush

@section('content')

<!-- BACK -->
<a href="{{ route('teacher.module3.results') }}" class="back-link">
    ← Back to Student List
</a>


<div class="student-header">
    <div class="student-info">
        <div class="avatar">
            {{ strtoupper(substr($student->username,0,2)) }}
        </div>
        <div>
            <h2>{{ $student->username }}</h2>
            <p>ID: {{ $student->id }}</p>
        </div>
    </div>

    <!-- ✅ EXPORT BUTTON -->
    <a href="{{ route('teacher.module3.export', $student->id) }}" class="btn btn-primary">
        Export Full Report
    </a>
</div>

<!-- FILTER (UNCHANGED) -->
<div class="filter-box">

    <h4>MODULE</h4>
    <div class="tabs">
        <div class="tab">Module 2</div>
        <div class="tab active">Module 3</div>
        <div class="tab">Module 4</div>
    </div>

    <br>

    <h4>ACTIVITY</h4>
    <div class="tabs">
        <div class="tab active" data-tab="pretest">Pretest</div>
        <div class="tab" data-tab="node1">Node 1</div>
        <div class="tab" data-tab="node2">Node 2</div>
        <div class="tab" data-tab="node3">Node 3</div>

        <div class="tab" data-tab="balikaral">Balikaral</div>
        <div class="tab" data-tab="bulkan">Bulkan</div>
        <div class="tab" data-tab="elnino">El Niño</div>
        <div class="tab" data-tab="explore">Explore</div>
        <div class="tab" data-tab="flood">Flood</div>
        <div class="tab" data-tab="gabay">Gabay</div>
        <div class="tab" data-tab="gobag">Go Bag</div>
        <div class="tab" data-tab="lindol">Lindol</div>
        <div class="tab" data-tab="safehome">Safe Home</div>

        <div class="tab" data-tab="final">Final</div>
    </div>

</div>

<!-- ================= PRETEST ================= -->
<div class="activity-content" id="pretest">
    <div class="table-box">
        <h4>Pretest Summary</h4>
        <table>
            <tr><th>Score</th><td>{{ $pretest->score ?? 0 }}</td></tr>
            <tr><th>Percentage</th><td>{{ round($pretest->percentage ?? 0) }}%</td></tr>
            <tr><th>Status</th><td>{{ ($pretest && $pretest->percentage >= 75) ? 'Passed' : 'Needs Improvement' }}</td></tr>
        </table>
    </div>

    <div class="table-box">
        <h4>Answer Breakdown</h4>
        <table>
            <thead>
                <tr>
                    <th>Q#</th>
                    <th>Selected</th>
                    <th>Correct</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pretestAnswers as $ans)
                <tr>
                    <td>{{ $ans->question_number }}</td>
                    <td>{{ $ans->selected_answer }}</td>
                    <td>{{ $ans->correct_answer }}</td>
                    <td>
                        <span class="badge {{ $ans->is_correct ? 'correct' : 'wrong' }}">
                            {{ $ans->is_correct ? 'Correct' : 'Wrong' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ================= NODE 1 ================= -->
<div class="activity-content" id="node1" style="display:none;">
    <div class="table-box">
        <table>
            <tr><th>Score</th><td>{{ $node1->score ?? 0 }}</td></tr>
            <tr><th>Total Items</th><td>{{ $node1->total_items ?? 0 }}</td></tr>
            <tr><th>Accuracy</th><td>{{ $node1->accuracy ?? 0 }}%</td></tr>
            <tr><th>Attempts</th><td>{{ $node1->attempts ?? 0 }}</td></tr>
            <th>Status</th><td>{{ ($node1 && $node1->is_completed) ? 'Completed' : 'Not Completed' }}</td>
        </table>
    </div>
</div>

<!-- ================= NODE 2 ================= -->
<div class="activity-content" id="node2" style="display:none;">
    <div class="table-box">
        <table>
            <tr><th>Score</th><td>{{ $node2->score ?? 0 }}</td></tr>
            <tr><th>Chosen Side</th><td>{{ $node2->chosen_side ?? 'N/A' }}</td></tr>
            <tr><th>Lives</th><td>{{ $node2->lives_remaining ?? 0 }}</td></tr>
            <tr><th>Attempts</th><td>{{ $node2->attempts ?? 0 }}</td></tr>
            <th>Status</th><td>{{ ($node2 && $node2->is_passed) ? 'Passed' : 'Failed' }}</td>
        </table>
    </div>
</div>

<!-- ================= NODE 3 ================= -->
<div class="activity-content" id="node3" style="display:none;">
    <div class="table-box">
        <table>
            <tr><th>Budget</th><td>{{ $node3->final_budget ?? 0 }}</td></tr>
            <tr><th>Safety Score</th><td>{{ $node3->safety_score ?? 0 }}</td></tr>
            <tr><th>Status</th><td>{{ $node3->status ?? 'N/A' }}</td></tr>
            <tr><th>Attempts</th><td>{{ $node3->attempts ?? 0 }}</td></tr>
        </table>
    </div>
</div>

<!-- ================= ACTIVITIES ================= -->
@php
$activityTables = [
    'balikaral' => [
        'Score'=>$balikaral->score ?? 0,
        'Correct'=>$balikaral->correct_answers ?? 0,
        'Total'=>$balikaral->total_items ?? 0,
        'Time'=>$balikaral->time_spent ?? 0
    ],
    'bulkan' => [
        'Correct'=>$bulkan->total_correct ?? 0,
        'Total'=>$bulkan->total_items ?? 0
    ],
    'elnino' => [
        'Score'=>$elnino->score ?? 0,
        'Status'=>($elnino && $elnino->is_completed) ? 'Completed':'Not Completed'
    ],
    'explore' => [
        'XP'=>$explore->xp ?? 0,
        'Badge'=>$explore->badge ?? 'None'
    ],
    'flood' => [
        'Score'=>$flood->score ?? 0,
        'HP'=>$flood->hp_remaining ?? 0,
        'Game Over'=>($flood && $flood->is_game_over) ? 'Yes':'No'
    ],
    'gabay' => [
        'Score'=>$gabay->score ?? 0,
        'Accuracy'=>$gabay->accuracy ?? 0,
        'Level'=>$gabay->performance_level ?? 'N/A'
    ],
    'gobag' => [
        'Score'=>$gobagact->score ?? 0,
        'Rating'=>$gobagact->rating ?? 'N/A',
        'Time'=>$gobagact->time_taken ?? 0
    ],
    'lindol' => [
        'Score'=>$lindol->score ?? 0,
        'Correct'=>$lindol->correct_items ?? 0,
        'Total'=>$lindol->total_items ?? 0
    ],
    'safehome' => [
        'Correct'=>$safehome->correct_count ?? 0,
        'Wrong'=>$safehome->wrong_count ?? 0,
        'Perfect'=>($safehome && $safehome->is_perfect) ? 'Yes':'No'
    ],
];
@endphp

@foreach($activityTables as $key => $rows)
<div class="activity-content" id="{{ $key }}" style="display:none;">
    <div class="table-box">
        <table>
            @foreach($rows as $label => $value)
            <tr>
                <th>{{ $label }}</th>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endforeach

<!-- ================= FINAL ================= -->
<div class="activity-content" id="final" style="display:none;">
    <div class="table-box">
        <table>
            <tr><th>Score</th><td>{{ $performance->score ?? 0 }}</td></tr>
            <tr><th>Completion Time</th><td>{{ $performance->completion_time ?? 0 }}s</td></tr>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
const tabs = document.querySelectorAll('.tab[data-tab]');
const contents = document.querySelectorAll('.activity-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        contents.forEach(c => c.style.display = "none");
        document.getElementById(tab.dataset.tab).style.display = "block";
    });
});
</script>
@endpush