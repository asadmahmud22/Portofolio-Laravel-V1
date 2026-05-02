@extends('layouts.sidebar')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .portfolio-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #0d1117;
        color: #e2e8f0;
        min-height: 100vh;
        padding: 40px 48px 80px;
    }

    /* ─── PAGE BACK ─── */
    .page-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #4b6281;
        text-decoration: none;
        margin-bottom: 28px;
        transition: color 0.2s;
    }
    .page-back:hover { color: #60a5fa; }
    .page-back svg { width: 14px; height: 14px; }

    /* ─── PAGE HEADER ─── */
    .page-header { margin-bottom: 6px; }

    .page-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 22px;
        font-weight: 800;
        color: #f0f4ff;
        margin-bottom: 6px;
    }
    .page-title svg { color: #3b82f6; }

    .page-subtitle {
        font-size: 13px;
        color: #4b6281;
        margin-bottom: 20px;
    }

    /* ─── TOOLBAR ─── */
    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent, #3b82f6);
        color: #fff;
        padding: 8px 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-add:hover { background: #2563eb; }

    /* ─── ZOOM CONTROLS ─── */
    .zoom-controls {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #0f1729;
        border: 1px solid #1a2540;
        border-radius: 10px;
        padding: 5px 10px;
    }

    .zoom-label {
        font-size: 12px;
        color: #4b6281;
        font-weight: 600;
        margin-right: 4px;
    }

    .zoom-btn {
        width: 28px; height: 28px;
        background: #151f38;
        border: 1px solid #1a2540;
        border-radius: 7px;
        color: #94a3b8;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.15s, color 0.15s;
        line-height: 1;
        font-family: monospace;
    }
    .zoom-btn:hover { background: #1e3a8a; color: #60a5fa; border-color: #3b82f6; }
    .zoom-btn:disabled { opacity: 0.35; cursor: not-allowed; }

    .zoom-value {
        font-size: 12px;
        font-weight: 700;
        color: #60a5fa;
        min-width: 36px;
        text-align: center;
    }

    /* ─── SECTION DIVIDER ─── */
    .section-divider {
        border: none;
        border-top: 1px solid #1a2540;
        margin-bottom: 28px;
    }

    /* ─── PROJECT GRID ─── */
    .project-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        transition: grid-template-columns 0.2s;
    }

    /* ─── PROJECT CARD ─── */
    .project-card {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        border-color: #3b82f655;
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(59, 130, 246, 0.1);
    }

    .project-thumb {
        width: 100%;
        height: 160px;
        background: linear-gradient(135deg, #151f38, #0d1117);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        border-bottom: 1px solid #1a2540;
        overflow: hidden;
        flex-shrink: 0;
    }

    .project-thumb img { width: 100%; height: 100%; object-fit: cover; }

    .project-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .project-title {
        font-size: 15px;
        font-weight: 700;
        color: #f0f4ff;
        margin-bottom: 7px;
    }

    .project-desc {
        font-size: 13px;
        color: #4b6281;
        line-height: 1.65;
        margin-bottom: 14px;
        flex: 1;
    }

    .project-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 14px;
    }

    .project-tag {
        font-size: 11px;
        font-weight: 600;
        color: #60a5fa;
        background: #1e3a8a33;
        border: 1px solid #1e3a8a66;
        border-radius: 5px;
        padding: 3px 8px;
    }

    .project-links {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .project-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: #94a3b8;
        text-decoration: none;
        border: 1px solid #1a2540;
        border-radius: 999px;
        padding: 5px 12px;
        transition: border-color 0.2s, color 0.2s, background 0.2s;
        background: transparent;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .project-link:hover { border-color: #3b82f6; color: #60a5fa; background: #1e3a8a22; }
    .project-link svg   { width: 12px; height: 12px; }

    .project-link.link-edit   { border-color: #1e3a8a; color: #60a5fa; }
    .project-link.link-edit:hover { background: #1e3a8a; color: #fff; }

    .project-link.link-delete { border-color: #3f1515; color: #f87171; }
    .project-link.link-delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

    .project-link.link-live   { border-color: #14532d; color: #4ade80; }
    .project-link.link-live:hover { background: #16a34a; color: #fff; border-color: #16a34a; }

    /* ─── EMPTY STATE ─── */
    .no-projects {
        text-align: center;
        padding: 80px 0;
        color: #4b6281;
        font-size: 14px;
    }
    .no-projects-icon { font-size: 48px; margin-bottom: 14px; }
    .no-projects a { color: #60a5fa; }

    /* ─── BOTTOM ACTION ─── */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: transparent;
        border: 1.5px solid #1a2540;
        color: #94a3b8;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 20px;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s, background 0.2s;
    }
    .btn-action-primary {
        border-color: #3b82f6;
        color: #60a5fa;
    }
    .btn-action-primary:hover {
        background: #3b82f6;
        color: #fff;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1100px) {
        .project-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .portfolio-page { padding: 24px 20px 60px; }
        .project-grid { grid-template-columns: 1fr; }
        .toolbar { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="portfolio-page">

    {{-- Back --}}
    <a href="{{ url('/') }}" class="page-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Back to Home
    </a>

    {{-- Header --}}
    <div class="page-header">
        <div class="page-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
            </svg>
            Projects
        </div>
        <p class="page-subtitle">Proyek yang telah saya kerjakan</p>
    </div>

    {{-- Toolbar: Add + Zoom --}}
    <div class="toolbar">

        <div class="zoom-controls">
            <span class="zoom-label">Tampilan:</span>
            <button class="zoom-btn" id="zoomOut" onclick="changeColumns(-1)" title="Lebih besar">−</button>
            <span class="zoom-value" id="zoomVal">3 col</span>
            <button class="zoom-btn" id="zoomIn" onclick="changeColumns(1)" title="Lebih kecil">+</button>
        </div>
    </div>

    <hr class="section-divider">

    @if($projects->isEmpty())
        <div class="no-projects">
            <div class="no-projects-icon">🗂️</div>
            <p>Belum ada proyek yang ditambahkan.</p>
            <p style="margin-top: 8px; font-size: 13px;">
                Tambahkan melalui
                <a href="{{ route('admin.dashboard') }}">admin panel</a>.
            </p>
        </div>
    @else
        <div class="project-grid" id="projectGrid">
            @foreach($projects as $project)
            <div class="project-card">
                <div class="project-thumb">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                    @else
                        🖥️
                    @endif
                </div>
                <div class="project-body">
                    <div class="project-title">{{ $project->title }}</div>
                    <div class="project-desc">{{ $project->description }}</div>

                    @if(!empty($project->tags))
                    <div class="project-tags">
                        @foreach(explode(',', $project->tags) as $tag)
                        <span class="project-tag">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="project-links">
                        @if($project->url)
                        <a href="{{ $project->url }}" target="_blank" class="project-link link-live">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            Live
                        </a>
                        @endif

                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="project-link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
                            GitHub
                        </a>
                        @endif

                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="project-link link-edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </a>

                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin hapus project ini?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="project-link link-delete">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div style="margin-top: 40px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ url('/contact') }}" class="btn-action btn-action-primary">
            Hubungi Saya →
        </a>
    </div>

</div>

<script>
    // Columns: 1 = biggest cards, 4 = smallest cards
    const minCols = 1;
    const maxCols = 4;
    let currentCols = 3;

    const colLabels = { 1: '1 col', 2: '2 col', 3: '3 col', 4: '4 col' };

    function changeColumns(delta) {
        currentCols = Math.min(maxCols, Math.max(minCols, currentCols + delta));
        const grid = document.getElementById('projectGrid');
        if (grid) {
            grid.style.gridTemplateColumns = `repeat(${currentCols}, 1fr)`;
        }
        document.getElementById('zoomVal').textContent = colLabels[currentCols];
        document.getElementById('zoomIn').disabled  = currentCols >= maxCols;
        document.getElementById('zoomOut').disabled = currentCols <= minCols;
    }

    // Init button states
    document.getElementById('zoomIn').disabled  = currentCols >= maxCols;
    document.getElementById('zoomOut').disabled = currentCols <= minCols;
</script>

@endsection