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

    .timeline-filter {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .filter-btn {
        font-size: 12px;
        font-weight: 600;
        color: #4b6281;
        background: #0f1729;
        border: 1px solid #1a2540;
        border-radius: 999px;
        padding: 5px 14px;
        cursor: pointer;
        transition: all 0.15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .filter-btn:hover,
    .filter-btn.active { background: #1e3a8a; color: #60a5fa; border-color: #3b82f6; }

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

    /* ─── TIMELINE LABEL ─── */
    .timeline-label {
        font-size: 11px;
        font-weight: 700;
        color: #3b82f6;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 14px;
        margin-top: 32px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .timeline-label:first-child { margin-top: 0; }
    .timeline-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #1a2540;
    }

    /* ─── ACHIEVEMENT GRID ─── */
    .achievement-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 8px;
    }

    /* ─── ACHIEVEMENT CARD ─── */
    .achievement-card {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .achievement-card:hover {
        border-color: #3b82f655;
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(59, 130, 246, 0.1);
    }

    /* Card thumb / image area */
    .achievement-thumb {
        width: 100%;
        height: 140px;
        background: linear-gradient(135deg, #151f38, #0d1117);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 44px;
        border-bottom: 1px solid #1a2540;
        overflow: hidden;
        flex-shrink: 0;
        position: relative;
    }

    .achievement-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .achievement-thumb .thumb-icon {
        font-size: 44px;
        line-height: 1;
    }

    /* Year badge on thumb */
    .achievement-year-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 11px;
        font-weight: 700;
        color: #60a5fa;
        background: #1e3a8acc;
        border: 1px solid #3b82f666;
        padding: 3px 10px;
        border-radius: 999px;
        backdrop-filter: blur(4px);
    }

    /* Card body */
    .achievement-body {
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .achievement-title {
        font-size: 14px;
        font-weight: 700;
        color: #f0f4ff;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .achievement-desc {
        font-size: 12.5px;
        color: #4b6281;
        line-height: 1.65;
        margin-bottom: 10px;
        flex: 1;
    }

    .achievement-issuer {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        color: #60a5fa;
        margin-bottom: 8px;
        font-weight: 600;
    }
    .achievement-issuer svg { width: 12px; height: 12px; flex-shrink: 0; }

    .achievement-category {
        display: inline-block;
        padding: 2px 9px;
        background: #1e3a8a33;
        border: 1px solid #1e3a8a66;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        color: #60a5fa;
        margin-bottom: 12px;
    }

    .achievement-link {
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
        transition: all 0.2s;
        align-self: flex-start;
    }
    .achievement-link:hover {
        border-color: #3b82f6;
        color: #60a5fa;
        background: #1e3a8a22;
    }
    .achievement-link svg { width: 12px; height: 12px; }

    /* ─── EMPTY STATE ─── */
    .empty-achievements {
        text-align: center;
        padding: 80px 0;
        color: #4b6281;
        font-size: 14px;
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 14px;
    }
    .empty-achievements svg {
        width: 48px; height: 48px;
        stroke: #1a2540;
        margin-bottom: 14px;
    }
    .empty-achievements h3 { font-size: 16px; color: #e2e8f0; margin-bottom: 6px; }

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
        transition: all 0.2s;
    }
    .btn-action-primary { border-color: #3b82f6; color: #60a5fa; }
    .btn-action-primary:hover { background: #3b82f6; color: #fff; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1100px) {
        .achievement-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .portfolio-page { padding: 24px 20px 60px; }
        .achievement-grid { grid-template-columns: 1fr; }
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
    <div class="page-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="6"/>
            <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/>
        </svg>
        Achievements
    </div>
    <p class="page-subtitle">Pencapaian & sertifikat yang telah saya raih</p>

    {{-- Toolbar --}}
    <div class="toolbar">
        {{-- Year filter buttons (generated from data) --}}
        <div class="timeline-filter" id="filterWrap">
            <button class="filter-btn active" onclick="filterYear('all', this)">Semua</button>
            @if(isset($achievements) && $achievements->count() > 0)
                @foreach($achievements->pluck('year')->filter()->unique()->sortDesc() as $yr)
                    <button class="filter-btn" onclick="filterYear('{{ $yr }}', this)">{{ $yr }}</button>
                @endforeach
            @endif
        </div>

        {{-- Zoom --}}
        <div class="zoom-controls">
            <span class="zoom-label">Tampilan:</span>
            <button class="zoom-btn" id="zoomOut" onclick="changeColumns(-1)">−</button>
            <span class="zoom-value" id="zoomVal">3 col</span>
            <button class="zoom-btn" id="zoomIn" onclick="changeColumns(1)">+</button>
        </div>
    </div>

    <hr class="section-divider">

    @if(isset($achievements) && $achievements->count() > 0)
        @php
            $grouped = $achievements->groupBy(fn($item) => $item->year ?? 'Lainnya')
                                    ->sortKeysDesc();
        @endphp

        @foreach($grouped as $year => $items)
            <p class="timeline-label" data-year="{{ $year }}">{{ $year }}</p>

            <div class="achievement-grid" id="achievementGrid">
                @foreach($items as $achievement)
                <div class="achievement-card" data-year="{{ $achievement->year ?? 'Lainnya' }}">

                    {{-- Thumb --}}
                    <div class="achievement-thumb">
                        @if($achievement->image)
                            <img src="{{ asset('storage/'.$achievement->image) }}" alt="{{ $achievement->title }}">
                        @else
                            @php
                                $icon = match($achievement->category ?? '') {
                                    'Programming', 'Development' => '💻',
                                    'Design', 'UI/UX'           => '🎨',
                                    'Certificate', 'Sertifikat' => '📜',
                                    'Course', 'Kursus'          => '📚',
                                    default                     => '🏆'
                                };
                            @endphp
                            <span class="thumb-icon">{{ $icon }}</span>
                        @endif
                        @if($achievement->year)
                            <span class="achievement-year-badge">{{ $achievement->year }}</span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="achievement-body">
                        <div class="achievement-title">{{ $achievement->title }}</div>
                        <div class="achievement-desc">{{ $achievement->description ?? '—' }}</div>

                        @if($achievement->issuer)
                        <div class="achievement-issuer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            {{ $achievement->issuer }}
                        </div>
                        @endif

                        @if($achievement->category)
                            <span class="achievement-category">{{ $achievement->category }}</span>
                        @endif

                        @if($achievement->link)
                        <a href="{{ $achievement->link }}" target="_blank" class="achievement-link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                            Lihat Sertifikat
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach

    @else
        <div class="empty-achievements">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 6v6l4 2"/>
            </svg>
            <h3>Belum ada achievement</h3>
            <p>Achievement akan ditampilkan di sini nanti.</p>
        </div>
    @endif

    <div style="margin-top: 40px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ url('/projects') }}" class="btn-action btn-action-primary">
            Lihat Projects →
        </a>
    </div>

</div>

<script>
    /* ── ZOOM ── */
    const minCols = 1, maxCols = 4;
    let currentCols = 3;
    const colLabels = { 1:'1 col', 2:'2 col', 3:'3 col', 4:'4 col' };

    function changeColumns(delta) {
        currentCols = Math.min(maxCols, Math.max(minCols, currentCols + delta));
        document.querySelectorAll('.achievement-grid').forEach(g => {
            g.style.gridTemplateColumns = `repeat(${currentCols}, 1fr)`;
        });
        document.getElementById('zoomVal').textContent = colLabels[currentCols];
        document.getElementById('zoomIn').disabled  = currentCols >= maxCols;
        document.getElementById('zoomOut').disabled = currentCols <= minCols;
    }

    document.getElementById('zoomIn').disabled  = currentCols >= maxCols;
    document.getElementById('zoomOut').disabled = currentCols <= minCols;

    /* ── YEAR FILTER ── */
    function filterYear(year, btn) {
        // update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // show/hide cards and labels
        document.querySelectorAll('.achievement-card').forEach(card => {
            card.style.display = (year === 'all' || card.dataset.year === year) ? '' : 'none';
        });

        document.querySelectorAll('.timeline-label').forEach(label => {
            label.style.display = (year === 'all' || label.dataset.year === year) ? '' : 'none';
        });

        // hide empty grids
        document.querySelectorAll('.achievement-grid').forEach(grid => {
            const visible = [...grid.querySelectorAll('.achievement-card')].some(c => c.style.display !== 'none');
            grid.style.display = visible ? '' : 'none';
        });
    }
</script>

@endsection