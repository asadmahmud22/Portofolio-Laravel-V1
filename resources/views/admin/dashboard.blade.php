@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('topbar-actions')
    <button class="notif-btn" title="Notifikasi">
        <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        <div class="notif-dot"></div>
    </button>
@endsection

@section('styles')
<style>
    .welcome-banner {
        background: #E1F5EE;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 24px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .welcome-banner h2 { font-size: 17px; font-weight: 600; color: #085041; margin-bottom: 4px; }
    .welcome-banner p  { font-size: 13px; color: #0F6E56; }

    .welcome-icon {
        width: 48px; height: 48px;
        background: #9FE1CB; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .welcome-icon svg { width: 24px; height: 24px; stroke: #085041; fill: none; stroke-width: 2; }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #E8E8E3;
        border-radius: 12px;
        padding: 16px;
    }
    .stat-label { font-size: 12px; color: #888; margin-bottom: 8px; }
    .stat-value { font-size: 22px; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
    .stat-badge {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 11px; padding: 2px 8px; border-radius: 20px;
    }
    .badge-up   { background: #E1F5EE; color: #0F6E56; }
    .badge-down { background: #FCEBEB; color: #A32D2D; }

    .section-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }
    .card {
        background: #fff;
        border: 1px solid #E8E8E3;
        border-radius: 12px;
        padding: 16px 20px;
    }
    .card-title {
        font-size: 14px; font-weight: 500; color: #1a1a1a;
        margin-bottom: 14px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .card-title a { font-size: 12px; color: #1D9E75; text-decoration: none; font-weight: 400; }
    .card-title a:hover { text-decoration: underline; }

    .project-item {
        display: flex; align-items: center; gap: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #F0F0EB;
    }
    .project-item:last-child { border-bottom: none; padding-bottom: 0; }
    .project-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
    .project-info { flex: 1; }
    .project-info .proj-name { font-size: 13px; font-weight: 500; color: #1a1a1a; }
    .project-info .proj-time { font-size: 11px; color: #999; }
    .project-status { font-size: 11px; padding: 3px 8px; border-radius: 20px; font-weight: 500; }
    .status-active { background: #E1F5EE; color: #0F6E56; }
    .status-review { background: #FAEEDA; color: #854F0B; }
    .status-draft  { background: #F0F0EB; color: #888; }

    .activity-item { display: flex; gap: 10px; padding: 8px 0; border-bottom: 1px solid #F0F0EB; }
    .activity-item:last-child { border-bottom: none; }
    .act-icon { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
    .act-icon svg { width: 14px; height: 14px; fill: none; stroke-width: 2; }
    .act-text .act-title { font-size: 13px; color: #1a1a1a; }
    .act-text .act-time  { font-size: 11px; color: #999; margin-top: 2px; }

    .chart-wrap { display: flex; align-items: flex-end; gap: 3px; height: 48px; margin-top: 8px; }
    .bar { flex: 1; background: #9FE1CB; border-radius: 3px 3px 0 0; transition: background .15s; cursor: pointer; }
    .bar:hover { background: #1D9E75; }
    .chart-labels { display: flex; justify-content: space-between; margin-top: 6px; }
    .chart-labels span { font-size: 11px; color: #aaa; }

    /* notif-btn (topbar) */
    .notif-btn {
        width: 32px; height: 32px;
        border-radius: 8px; border: 1px solid #E8E8E3;
        display: flex; align-items: center; justify-content: center;
        background: #fff; cursor: pointer; position: relative;
    }
    .notif-btn:hover { background: #F5F5F0; }
    .notif-btn svg { width: 15px; height: 15px; stroke: #555; fill: none; stroke-width: 2; }
    .notif-dot { width: 7px; height: 7px; background: #1D9E75; border-radius: 50%; position: absolute; top: 6px; right: 6px; border: 1.5px solid #fff; }

    @media (max-width: 900px) {
        .stats { grid-template-columns: repeat(2, 1fr); }
        .section-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        <div>
            <h2>Selamat datang, {{ auth()->user()->name }}</h2>
            <p>Semua sistem berjalan normal. Berikut ringkasan aktivitas hari ini.</p>
        </div>
        <div class="welcome-icon">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Total Project</div>
            <div class="stat-value">{{ $totalProjects ?? 24 }}</div>
            <span class="stat-badge badge-up">+3 bulan ini</span>
        </div>
        <div class="stat-card">
            <div class="stat-label">Project Aktif</div>
            <div class="stat-value">{{ $activeProjects ?? 8 }}</div>
            <span class="stat-badge badge-up">+1 minggu ini</span>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pengunjung</div>
            <div class="stat-value">{{ $visitorCount ?? '1.2k' }}</div>
            <span class="stat-badge badge-up">+12% bulan ini</span>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pesan Masuk</div>
            <div class="stat-value">{{ $messageCount ?? 5 }}</div>
            <span class="stat-badge badge-down">−2 kemarin</span>
        </div>
    </div>

    {{-- Project & Activity Row --}}
    <div class="section-row">

        {{-- Project Terbaru --}}
        <div class="card">
            <div class="card-title">
                Project Terbaru
                <a href="{{ route('admin.projects.index') }}">Lihat semua →</a>
            </div>

            @forelse($recentProjects ?? [] as $project)
                <div class="project-item">
                    <div class="project-dot" style="background: {{ $project->color ?? '#1D9E75' }}"></div>
                    <div class="project-info">
                        <div class="proj-name">{{ $project->title }}</div>
                        <div class="proj-time">Diperbarui {{ $project->updated_at->diffForHumans() }}</div>
                    </div>
                    <span class="project-status status-{{ $project->status }}">{{ ucfirst($project->status) }}</span>
                </div>
            @empty
                <div class="project-item">
                    <div class="project-dot" style="background:#1D9E75"></div>
                    <div class="project-info"><div class="proj-name">Website Portofolio v2</div><div class="proj-time">Diperbarui 2 jam lalu</div></div>
                    <span class="project-status status-active">Aktif</span>
                </div>
                <div class="project-item">
                    <div class="project-dot" style="background:#EF9F27"></div>
                    <div class="project-info"><div class="proj-name">Aplikasi Mobile Shop</div><div class="proj-time">Diperbarui kemarin</div></div>
                    <span class="project-status status-review">Review</span>
                </div>
                <div class="project-item">
                    <div class="project-dot" style="background:#888780"></div>
                    <div class="project-info"><div class="proj-name">Landing Page Kopi</div><div class="proj-time">Diperbarui 3 hari lalu</div></div>
                    <span class="project-status status-draft">Draft</span>
                </div>
                <div class="project-item">
                    <div class="project-dot" style="background:#1D9E75"></div>
                    <div class="project-info"><div class="proj-name">Dashboard Analytics</div><div class="proj-time">Diperbarui seminggu lalu</div></div>
                    <span class="project-status status-active">Aktif</span>
                </div>
            @endforelse
        </div>

        {{-- Aktivitas Terkini --}}
        <div class="card">
            <div class="card-title">Aktivitas Terkini</div>

            <div class="activity-item">
                <div class="act-icon" style="background:#E1F5EE">
                    <svg viewBox="0 0 24 24" stroke="#0F6E56"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="act-text"><div class="act-title">Project baru ditambahkan</div><div class="act-time">2 jam yang lalu</div></div>
            </div>
            <div class="activity-item">
                <div class="act-icon" style="background:#FAEEDA">
                    <svg viewBox="0 0 24 24" stroke="#854F0B"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                </div>
                <div class="act-text"><div class="act-title">Profile diperbarui</div><div class="act-time">5 jam yang lalu</div></div>
            </div>
            <div class="activity-item">
                <div class="act-icon" style="background:#E6F1FB">
                    <svg viewBox="0 0 24 24" stroke="#185FA5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div class="act-text"><div class="act-title">Pesan baru masuk</div><div class="act-time">Kemarin, 15:30</div></div>
            </div>
            <div class="activity-item">
                <div class="act-icon" style="background:#EEEDFE">
                    <svg viewBox="0 0 24 24" stroke="#534AB7"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <div class="act-text"><div class="act-title">Traffic naik 12% minggu ini</div><div class="act-time">Kemarin, 09:00</div></div>
            </div>
        </div>
    </div>

    {{-- Chart Pengunjung --}}
    <div class="card">
        <div class="card-title">Pengunjung 7 Hari Terakhir</div>
        <div class="chart-wrap" id="chart-bars"></div>
        <div class="chart-labels">
            <span>Sen</span><span>Sel</span><span>Rab</span>
            <span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    const data = [45, 72, 58, 90, 63, 80, 52];
    const max  = Math.max(...data);
    const wrap = document.getElementById('chart-bars');
    data.forEach(v => {
        const bar = document.createElement('div');
        bar.className = 'bar';
        bar.style.height = Math.round((v / max) * 100) + '%';
        bar.title = v + ' pengunjung';
        wrap.appendChild(bar);
    });
</script>
@endsection