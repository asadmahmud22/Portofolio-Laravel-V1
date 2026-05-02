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

    /* ─── BACK LINK ─── */
    .page-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #4b6281;
        text-decoration: none;
        margin-bottom: 32px;
        transition: color 0.2s;
    }

    .page-back:hover { color: #60a5fa; }
    .page-back svg { width: 16px; height: 16px; }

    /* ─── HEADER ─── */
    .page-header { margin-bottom: 28px; }

    .page-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 24px;
        font-weight: 800;
        color: #f0f4ff;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .page-title svg { color: #60a5fa; }

    .page-subtitle {
        font-size: 13px;
        color: #4b6281;
    }

    /* ─── DIVIDER ─── */
    .section-divider {
        border: none;
        border-top: 1px solid #1a2540;
        margin-bottom: 32px;
    }

    /* ─── STATUS ─── */
    .status-available {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: #60a5fa;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .status-available .dot {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        animation: pulse 1.8s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.4; transform: scale(1.4); }
    }

    /* ─── INFO CARDS ─── */
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 32px;
    }

    .card {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 12px;
        padding: 18px 20px;
        transition: border-color 0.2s, transform 0.2s;
    }

    .card:hover {
        border-color: #3b82f655;
        transform: translateY(-2px);
    }

    .card-label {
        font-size: 12px;
        font-weight: 600;
        color: #4b6281;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .card-value {
        font-size: 14px;
        font-weight: 700;
        color: #e2e8f0;
        margin-bottom: 4px;
    }

    .card-sub {
        font-size: 12px;
        color: #4b6281;
    }

    /* ─── BIO ─── */
    .about-bio {
        font-size: 14.5px;
        line-height: 1.85;
        color: #94a3b8;
        max-width: 680px;
        margin-bottom: 36px;
    }

    /* ─── SERVICE CARDS ─── */
    .service-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 14px;
    }

    .service-card {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 12px;
        padding: 20px 18px;
        transition: border-color 0.2s, transform 0.2s;
    }

    .service-card:hover { border-color: #3b82f655; transform: translateY(-2px); }
    .service-card-icon  { font-size: 22px; margin-bottom: 12px; }
    .service-card-title { font-size: 14px; font-weight: 700; color: #f0f4ff; margin-bottom: 7px; }
    .service-card-desc  { font-size: 12.5px; color: #4b6281; line-height: 1.65; }

    /* ─── ACHIEVEMENTS ─── */
    .achievement-list { display: flex; flex-direction: column; gap: 14px; }

    .achievement-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 12px;
        padding: 18px 20px;
        transition: border-color 0.2s, transform 0.2s;
    }

    .achievement-item:hover { border-color: #3b82f644; transform: translateX(4px); }

    .achievement-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #1e3a8a22;
        border: 1px solid #3b82f633;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .achievement-body      { flex: 1; }
    .achievement-title     { font-size: 14px; font-weight: 700; color: #f0f4ff; margin-bottom: 4px; }
    .achievement-desc      { font-size: 13px; color: #4b6281; line-height: 1.6; }

    .achievement-year {
        font-size: 12px;
        font-weight: 600;
        color: #60a5fa;
        background: #1e3a8a22;
        border: 1px solid #3b82f633;
        padding: 3px 10px;
        border-radius: 999px;
        white-space: nowrap;
        align-self: center;
    }

    .timeline-label {
        font-size: 11px;
        font-weight: 700;
        color: #60a5fa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
        margin-top: 32px;
    }

    .timeline-label:first-child { margin-top: 0; }

    /* ─── ACTION BUTTONS ─── */
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

    .btn-action:hover {
        border-color: #3b82f6;
        color: #60a5fa;
        background: #1e3a8a22;
    }

    .btn-action svg { width: 14px; height: 14px; flex-shrink: 0; }

    .btn-action-primary {
        border-color: #3b82f6;
        color: #60a5fa;
    }

    .btn-action-primary:hover {
        background: #3b82f6;
        color: #fff;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .portfolio-page { padding: 24px 20px 60px; }
        .about-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="portfolio-page">

    {{-- Back --}}
    <a href="{{ route('home') }}" class="page-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Back to Home
    </a>

    {{-- Header --}}
    <div class="page-header">
        <div class="page-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            About Me
        </div>
        <p class="page-subtitle">Sedikit tentang saya</p>
    </div>

    <hr class="section-divider">

    {{-- Status --}}
    <div class="status-available">
        <span class="dot"></span>
        Open to Work — Freelance & Remote
    </div>

    {{-- Info Cards --}}
    <div class="about-grid">
        <div class="card">
            <div class="card-label">🎓 Pendidikan</div>
            <div class="card-value">Universitas Teknologi Digital Indonesia</div>
            <div class="card-sub">Teknologi Komputer · Angkatan 2023</div>
        </div>
        <div class="card">
            <div class="card-label">📍 Lokasi</div>
            <div class="card-value">Klaten, Jawa Tengah</div>
            <div class="card-sub">Indonesia 🇮🇩</div>
        </div>
        <div class="card">
            <div class="card-label">💼 Fokus</div>
            <div class="card-value">Frontend Development</div>
            <div class="card-sub">React · Laravel · UI/UX</div>
        </div>
        <div class="card">
            <div class="card-label">🌐 Status</div>
            <div class="card-value" style="color:#60a5fa;">Open to Work</div>
            <div class="card-sub">Freelance & Remote</div>
        </div>
    </div>

    {{-- Bio --}}
    <p class="about-bio">
        Sebagai seorang pengembang frontend lepas, saya berdedikasi untuk menciptakan situs web yang luar biasa
        dan solusi web strategis untuk merek, perusahaan, institusi, dan startup. Dengan pengalaman yang mendalam
        dalam pengembangan web modern, saya siap membantu mewujudkan visi digital Anda.
    </p>

    {{-- Services --}}
    <div class="service-cards">
        <div class="service-card">
            <div class="service-card-icon">🖥️</div>
            <div class="service-card-title">Web Development</div>
            <div class="service-card-desc">Website modern, responsif, dan cepat menggunakan teknologi terkini.</div>
        </div>
        <div class="service-card">
            <div class="service-card-icon">🎨</div>
            <div class="service-card-title">UI/UX Design</div>
            <div class="service-card-desc">Antarmuka intuitif, menarik, dan berpusat pada pengalaman pengguna.</div>
        </div>
        <div class="service-card">
            <div class="service-card-icon">📱</div>
            <div class="service-card-title">Mobile-First</div>
            <div class="service-card-desc">Tampilan optimal di semua perangkat, dari mobile hingga desktop.</div>
        </div>
        <div class="service-card">
            <div class="service-card-icon">⚡</div>
            <div class="service-card-title">Performance</div>
            <div class="service-card-desc">Optimasi kecepatan dan performa untuk pengalaman pengguna terbaik.</div>
        </div>
    </div>

    <hr class="section-divider" style="margin-top: 40px;">

    {{-- Achievements --}}
    <div class="page-header" style="margin-bottom: 0;">
        <div class="page-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="6"/>
                <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/>
            </svg>
            Achievements
        </div>
        <p class="page-subtitle">Pencapaian & pengalaman yang telah saya raih</p>
    </div>

    <p class="timeline-label" style="margin-top: 28px;">2023</p>
    <div class="achievement-list">
        <div class="achievement-item">
            <div class="achievement-icon">🎓</div>
            <div class="achievement-body">
                <div class="achievement-title">Mahasiswa Aktif — Teknologi Komputer</div>
                <div class="achievement-desc">Menempuh studi di Universitas Teknologi Digital Indonesia dengan fokus pada pengembangan perangkat lunak dan teknologi web.</div>
            </div>
            <span class="achievement-year">2023</span>
        </div>
    </div>

    <p class="timeline-label">2024</p>
    <div class="achievement-list">
        <div class="achievement-item">
            <div class="achievement-icon">⚛️</div>
            <div class="achievement-body">
                <div class="achievement-title">Menguasai React & Frontend Ecosystem</div>
                <div class="achievement-desc">Berhasil membangun beberapa proyek menggunakan React, TailwindCSS, Vite, dan Next.js secara mandiri.</div>
            </div>
            <span class="achievement-year">2024</span>
        </div>
        <div class="achievement-item">
            <div class="achievement-icon">🔴</div>
            <div class="achievement-body">
                <div class="achievement-title">Pengembangan Fullstack dengan Laravel</div>
                <div class="achievement-desc">Membangun aplikasi web fullstack menggunakan Laravel, termasuk autentikasi, CRUD, dan integrasi database MySQL/SQLite.</div>
            </div>
            <span class="achievement-year">2024</span>
        </div>
        <div class="achievement-item">
            <div class="achievement-icon">🎨</div>
            <div class="achievement-body">
                <div class="achievement-title">UI/UX Design Portfolio</div>
                <div class="achievement-desc">Merancang antarmuka aplikasi dengan pendekatan mobile-first yang berfokus pada kemudahan penggunaan dan estetika visual.</div>
            </div>
            <span class="achievement-year">2024</span>
        </div>
    </div>

    <p class="timeline-label">2025</p>
    <div class="achievement-list">
        <div class="achievement-item">
            <div class="achievement-icon">🤝</div>
            <div class="achievement-body">
                <div class="achievement-title">Proyek Freelance Pertama</div>
                <div class="achievement-desc">Berhasil menyelesaikan proyek freelance pertama — membangun website untuk klien dengan hasil yang memuaskan.</div>
            </div>
            <span class="achievement-year">2025</span>
        </div>
    </div>

    <div style="margin-top: 40px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('skills') }}" class="btn-action btn-action-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
            </svg>
            Lihat Skills →
        </a>
        <a href="{{ route('projects') }}" class="btn-action btn-action-primary">
            Lihat Projects →
        </a>
        <a href="{{ route('contact') }}" class="btn-action">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/>
            </svg>
            Contact Me
        </a>
    </div>

</div>
@endsection