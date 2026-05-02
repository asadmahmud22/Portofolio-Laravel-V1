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

    /* ─── STATUS BAR ─── */
    .status-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 0 16px;
        border-bottom: 1px solid #1a2540;
        margin-bottom: 40px;
    }

    .status-label {
        font-size: 12px;
        color: #4b6281;
        font-weight: 500;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .status-available {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: #60a5fa;
        font-weight: 600;
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

    /* ─── HERO ─── */
    .hero-name {
        font-size: 38px;
        font-weight: 800;
        color: #f0f4ff;
        line-height: 1.15;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .hero-name span {
        color: #60a5fa;
    }

    .hero-location {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #4b6281;
        margin-bottom: 24px;
    }

    .hero-location svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        color: #3b82f6;
    }

    .location-badge {
        display: inline-block;
        background: #1e3a8a;
        border: 1px solid #3b82f633;
        color: #60a5fa;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 4px;
        letter-spacing: 0.5px;
    }

    .hero-bio {
        font-size: 14.5px;
        line-height: 1.85;
        color: #94a3b8;
        margin-bottom: 32px;
        max-width: 680px;
    }

    /* ─── ACTION BUTTONS ─── */
    .hero-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 52px;
        flex-wrap: wrap;
    }

    .btn-action {
        display: flex;
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

    .btn-action svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .btn-action-primary {
        border-color: #3b82f6;
        color: #60a5fa;
    }

    .btn-action-primary:hover {
        background: #3b82f6;
        color: #fff;
    }

    /* ─── SECTION DIVIDER ─── */
    .section-divider {
        border: none;
        border-top: 1px solid #1a2540;
        margin-bottom: 40px;
    }

    /* ─── SECTION HEADER ─── */
    .section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 16px;
        font-weight: 700;
        color: #f0f4ff;
        margin-bottom: 6px;
        letter-spacing: -0.2px;
    }

    .section-title svg { color: #3b82f6; }

    .section-subtitle {
        font-size: 13px;
        color: #4b6281;
        margin-bottom: 24px;
    }

  /* ─── SKILLS ─── */
.skills-section { margin-bottom: 52px; }

.skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.skill-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #1a2540;
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 12.5px;
    font-weight: 600;
    color: #64748b;
    background: #0f1729;
    letter-spacing: 0.3px;
    opacity: 0;
    transform: translateY(8px);
    animation: fadeUp 0.4s ease forwards;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
    cursor: default;
    user-select: none;
}

.skill-pill:hover {
    border-color: #3b82f640;
    color: #94a3b8;
    background: #111d35;
}

@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}

/* stagger tiap pill */
.skill-pill:nth-child(1)  { animation-delay: 0.05s; }
.skill-pill:nth-child(2)  { animation-delay: 0.10s; }
.skill-pill:nth-child(3)  { animation-delay: 0.15s; }
.skill-pill:nth-child(4)  { animation-delay: 0.20s; }
.skill-pill:nth-child(5)  { animation-delay: 0.25s; }
.skill-pill:nth-child(6)  { animation-delay: 0.30s; }
.skill-pill:nth-child(7)  { animation-delay: 0.35s; }
.skill-pill:nth-child(8)  { animation-delay: 0.40s; }
.skill-pill:nth-child(9)  { animation-delay: 0.45s; }
.skill-pill:nth-child(10) { animation-delay: 0.50s; }
.skill-pill:nth-child(11) { animation-delay: 0.55s; }
.skill-pill:nth-child(12) { animation-delay: 0.60s; }
.skill-pill:nth-child(13) { animation-delay: 0.65s; }
.skill-pill:nth-child(14) { animation-delay: 0.70s; }

/* accent kiri per skill */
.skill-pill[data-skill="html"]         { border-left: 2px solid #e34c2660; }
.skill-pill[data-skill="js"]           { border-left: 2px solid #f0db4f60; }
.skill-pill[data-skill="php"]          { border-left: 2px solid #8892bf60; }
.skill-pill[data-skill="sqlite"]       { border-left: 2px solid #44a1c960; }
.skill-pill[data-skill="nextjs"]       { border-left: 2px solid #e2e8f040; }
.skill-pill[data-skill="vite"]         { border-left: 2px solid #9333ea60; }
.skill-pill[data-skill="github"]       { border-left: 2px solid #6b728060; }
.skill-pill[data-skill="kotlin"]       { border-left: 2px solid #7f52ff60; }
.skill-pill[data-skill="tailwind"]     { border-left: 2px solid #38bdf860; }
.skill-pill[data-skill="css"]          { border-left: 2px solid #2965f160; }
.skill-pill[data-skill="mysql"]        { border-left: 2px solid #00758f60; }
.skill-pill[data-skill="laravel"]      { border-left: 2px solid #f0534060; }
.skill-pill[data-skill="react"]        { border-left: 2px solid #61dafb60; }
.skill-pill[data-skill="autoprefixer"] { border-left: 2px solid #e0493d60; }

    /* ─── SERVICE SECTION ─── */
    .service-section { margin-bottom: 52px; }

    .service-bio {
        font-size: 14.5px;
        line-height: 1.85;
        color: #94a3b8;
        max-width: 680px;
        margin-bottom: 28px;
    }

    .service-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 14px;
    }

    .service-card {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 12px;
        padding: 20px 18px;
        transition: border-color 0.2s, transform 0.2s;
        cursor: default;
    }

    .service-card:hover {
        border-color: #3b82f655;
        transform: translateY(-2px);
    }

    .service-card-icon { font-size: 22px; margin-bottom: 12px; }

    .service-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #f0f4ff;
        margin-bottom: 7px;
    }

    .service-card-desc {
        font-size: 12.5px;
        color: #4b6281;
        line-height: 1.65;
    }

    /* ─── RESPONSIVE ─── */

@media (max-width: 768px) {
    .portfolio-page { padding: 24px 20px 60px; }
    .hero-name { font-size: 26px; }
    /* skills-track-wrap tidak perlu override lagi */
    .service-cards { grid-template-columns: 1fr 1fr; }
}

    @media (max-width: 480px) {
        .service-cards { grid-template-columns: 1fr; }
    }
</style>

<div class="portfolio-page">

    <!-- Status Bar -->
    <div class="status-bar">
        <span class="status-label">Status</span>
        <span class="status-available">
            <span class="dot"></span>
            Available for work
        </span>
    </div>

    <!-- Hero -->
    <h1 class="hero-name">Hi, I'm <span>As'ad Mahmud Akram</span></h1>

    <div class="hero-location">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
            <circle cx="12" cy="9" r="2.5"/>
        </svg>
        Based in Klaten, Indonesia
        <span class="location-badge">ID</span>
    </div>

    <p class="hero-bio">
        Saya adalah mahasiswa Teknologi Komputer di Universitas Teknologi Digital Indonesia angkatan 2023.
        Sebagai seorang pengembang perangkat lunak yang antusias, saya memiliki fokus utama pada pengembangan
        frontend dengan pengalaman menggunakan React serta pemahaman berbagai teknologi web. Selain itu, saya
        juga memiliki ketertarikan dan pengalaman dalam desain UI/UX, dengan tujuan menciptakan antarmuka yang
        fungsional sekaligus menarik secara visual.
    </p>

    <div class="hero-actions">
        <a href="{{ url('/projects') }}" class="btn-action btn-action-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                <polyline points="7 10 12 15 17 10"/>
                <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Portfolio
        </a>
        <a href="#" class="btn-action">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            Resume
        </a>
    </div>

    <hr class="section-divider">

    <!-- Skills Section -->
<section class="skills-section" id="skills">
    <div class="section-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
        </svg>
        Skills
    </div>
    <p class="section-subtitle">Teknologi & tools yang saya gunakan</p>

    @php
    $skills = [
        ['name' => 'HTML',         'key' => 'html'],
        ['name' => 'CSS',          'key' => 'css'],
        ['name' => 'JavaScript',   'key' => 'js'],
        ['name' => 'PHP',          'key' => 'php'],
        ['name' => 'Laravel',      'key' => 'laravel'],
        ['name' => 'React',        'key' => 'react'],
        ['name' => 'Next.js',      'key' => 'nextjs'],
        ['name' => 'TailwindCSS',  'key' => 'tailwind'],
        ['name' => 'Vite',         'key' => 'vite'],
        ['name' => 'MySQL',        'key' => 'mysql'],
        ['name' => 'SQLite',       'key' => 'sqlite'],
        ['name' => 'Kotlin',       'key' => 'kotlin'],
        ['name' => 'GitHub',       'key' => 'github'],
        ['name' => 'Autoprefixer', 'key' => 'autoprefixer'],
    ];
    @endphp

    <div class="skills-grid">
        @foreach($skills as $skill)
        <div class="skill-pill" data-skill="{{ $skill['key'] }}">
            {{ $skill['name'] }}
        </div>
        @endforeach
    </div>
</section>

    <hr class="section-divider">

    <!-- Service Section -->
    <section class="service-section" id="service">
        <div class="section-title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
            </svg>
            Service
        </div>
        <p class="section-subtitle">Apa yang bisa saya bantu</p>

        <p class="service-bio">
            Sebagai seorang pengembang frontend lepas, saya berdedikasi untuk menciptakan situs web yang luar biasa
            dan solusi web strategis untuk merek, perusahaan, institusi, dan startup. Dengan pengalaman yang mendalam
            dalam pengembangan web modern, saya siap membantu mewujudkan visi digital Anda.
        </p>

        <div class="service-cards">
            <div class="service-card">
                <div class="service-card-icon">🖥️</div>
                <div class="service-card-title">Web Development</div>
                <div class="service-card-desc">Membangun website modern, responsif, dan cepat menggunakan teknologi terkini.</div>
            </div>
            <div class="service-card">
                <div class="service-card-icon">🎨</div>
                <div class="service-card-title">UI/UX Design</div>
                <div class="service-card-desc">Merancang antarmuka yang intuitif, menarik, dan berpusat pada pengalaman pengguna.</div>
            </div>
            <div class="service-card">
                <div class="service-card-icon">📱</div>
                <div class="service-card-title">Mobile-First</div>
                <div class="service-card-desc">Memastikan tampilan optimal di semua perangkat, dari mobile hingga desktop.</div>
            </div>
            <div class="service-card">
                <div class="service-card-icon">⚡</div>
                <div class="service-card-title">Performance</div>
                <div class="service-card-desc">Optimasi kecepatan dan performa untuk pengalaman pengguna terbaik.</div>
            </div>
        </div>
    </section>

</div>
@endsection