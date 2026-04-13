@extends('Teachers.teacherslayout')

@section('title', 'Modules')
@section('page-title', 'Modules')

@push('styles')
<style>
body {
    background: #f8fafc;
}

/* HEADER */
.page-header {
    margin-bottom: 25px;
}

.page-header h2 {
    font-size: 26px;
    font-weight: 700;
}

.page-header p {
    color: #64748b;
    margin-top: 4px;
}

/* GRID */
.modules-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

/* CARD */
.module-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.25s;
    position: relative;
}

.module-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 35px rgba(0,0,0,0.08);
}

/* TOP COLORS */
.module-card.blue { border-top: 6px solid #3b82f6; }
.module-card.green { border-top: 6px solid #22c55e; }
.module-card.purple { border-top: 6px solid #8b5cf6; }

/* HEADER ROW */
.module-head {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.module-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.blue .module-icon { background:#dbeafe; color:#2563eb; }
.green .module-icon { background:#dcfce7; color:#16a34a; }
.purple .module-icon { background:#ede9fe; color:#7c3aed; }

.module-title {
    font-size: 18px;
    font-weight: 700;
}

.module-desc {
    font-size: 14px;
    color: #64748b;
}

/* DOWNLOAD BUTTON */
.download-btn {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;

    font-size: 14px;
    font-weight: 600;
    color: #334155;
    text-decoration: none;

    transition: 0.2s;
}

.download-btn:hover {
    background: #f1f5f9;
}

/* ICON COLORS */
.pdf { color: #ef4444; }
</style>
@endpush

@section('content')

<div class="page-header">
    <h2>Available Modules</h2>
    <p>Download modules in PDF format for your classes.</p>
</div>

<div class="modules-grid">

@foreach($modules as $m)
<div class="module-card {{ $m['color'] }}">

    <div class="module-head">
        <div class="module-icon">
            <i data-lucide="book-open"></i>
        </div>
        <div>
            <div class="module-title">{{ $m['title'] }}</div>
        </div>
    </div>

    <!-- DOWNLOAD -->
    <a href="{{ asset($m['pdf']) }}" download class="download-btn">
        <span>
            <i data-lucide="file-text" class="pdf"></i>
            Download PDF
        </span>
        <i data-lucide="download"></i>
    </a>

</div>
@endforeach

</div>

@endsection