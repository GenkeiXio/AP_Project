@extends('Teachers.teacherslayout')

@section('title', 'Student Progress')
@section('page-title', 'Student Progress')

@push('styles')
<style>
body { background: #f8fafc; }

.student-header {
    display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
}

.student-info { display: flex; align-items: center; gap: 15px; }

.avatar {
    width: 60px; height: 60px; border-radius: 50%;
    background: #e0e7ff; display: flex; align-items: center;
    justify-content: center; font-weight: 700; color: #4f46e5;
}

.filter-box {
    background: white; border-radius: 16px; padding: 20px; margin-bottom: 25px;
}

.tabs { display: flex; gap: 10px; flex-wrap: wrap; }

.tab {
    padding: 8px 16px; border-radius: 999px;
    background: #e5e7eb; cursor: pointer;
}

.tab.active { background: #3b82f6; color: white; }

.table-box {
    background: white; border-radius: 16px;
    padding: 20px; margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

.badge {
    padding: 5px 10px; border-radius: 999px; font-size: 12px;
}

.correct { background: #dcfce7; color: #16a34a; }
.wrong { background: #fee2e2; color: #dc2626; }

.btn {
    border: none;
    outline: none;
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

/* PRIMARY BUTTON */
.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    box-shadow: 0 8px 18px rgba(59, 130, 246, 0.25);
}

/* HOVER EFFECT */
.btn-primary:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 12px 25px rgba(59, 130, 246, 0.35);
}

/* CLICK EFFECT */
.btn-primary:active {
    transform: scale(0.96);
}

/* OPTIONAL ICON SPACE */
.btn-primary::before {
    content: "⬇";
    font-size: 13px;
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
            <tr><th>Status</th><td>{{ $node1->is_completed ? 'Completed' : 'Not Completed' }}</td></tr>
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
            <tr><th>Status</th><td>{{ $node2->is_passed ? 'Passed' : 'Failed' }}</td></tr>
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
        'Status'=>$elnino->is_completed ? 'Completed':'Not Completed'
    ],
    'explore' => [
        'XP'=>$explore->xp ?? 0,
        'Badge'=>$explore->badge ?? 'None'
    ],
    'flood' => [
        'Score'=>$flood->score ?? 0,
        'HP'=>$flood->hp_remaining ?? 0,
        'Game Over'=>$flood->is_game_over ? 'Yes':'No'
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
        'Perfect'=>$safehome->is_perfect ? 'Yes':'No'
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