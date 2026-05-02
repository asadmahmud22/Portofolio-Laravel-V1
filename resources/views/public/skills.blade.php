<x-layouts.sidebar>


<style>
    /* ─── MARQUEE TRACKS ─── */
    .skills-track-wrap {
        overflow: hidden;
        position: relative;
        margin: 0 -48px;
        padding: 0 48px;
        margin-bottom: 48px;
    }

    .skills-track-wrap::before,
    .skills-track-wrap::after {
        content: '';
        position: absolute;
        top: 0; bottom: 0;
        width: 100px;
        z-index: 1;
        pointer-events: none;
    }

    .skills-track-wrap::before { left: 0;  background: linear-gradient(to right, #0f0f13, transparent); }
    .skills-track-wrap::after  { right: 0; background: linear-gradient(to left,  #0f0f13, transparent); }

    .skills-track {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        width: max-content;
        animation: scrollLeft 28s linear infinite;
    }

    .skills-track:nth-child(2) { animation-direction: reverse; animation-duration: 32s; }
    .skills-track:hover        { animation-play-state: paused; }

    @keyframes scrollLeft {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .skill-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1.5px solid #1e1e26;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #9ca3af;
        white-space: nowrap;
        background: #141418;
        transition: border-color 0.2s, color 0.2s;
        user-select: none;
    }

    .skill-pill:hover { border-color: #34d39966; color: #e2e2e2; }
    .skill-icon { font-size: 14px; line-height: 1; }

    .skill-pill[data-skill="html"]         { border-left: 3px solid #e34c26; }
    .skill-pill[data-skill="js"]           { border-left: 3px solid #f0db4f; }
    .skill-pill[data-skill="php"]          { border-left: 3px solid #8892bf; }
    .skill-pill[data-skill="sqlite"]       { border-left: 3px solid #44a1c9; }
    .skill-pill[data-skill="nextjs"]       { border-left: 3px solid #e2e2e2; }
    .skill-pill[data-skill="vite"]         { border-left: 3px solid #9333ea; }
    .skill-pill[data-skill="github"]       { border-left: 3px solid #6b7280; }
    .skill-pill[data-skill="kotlin"]       { border-left: 3px solid #7f52ff; }
    .skill-pill[data-skill="tailwind"]     { border-left: 3px solid #38bdf8; }
    .skill-pill[data-skill="css"]          { border-left: 3px solid #2965f1; }
    .skill-pill[data-skill="mysql"]        { border-left: 3px solid #00758f; }
    .skill-pill[data-skill="laravel"]      { border-left: 3px solid #f05340; }
    .skill-pill[data-skill="react"]        { border-left: 3px solid #61dafb; }
    .skill-pill[data-skill="autoprefixer"] { border-left: 3px solid #e0493d; }

    /* ─── SKILL DETAIL GRID ─── */
    .skill-detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    .skill-detail-card {
        background: #141418;
        border: 1.5px solid #1e1e26;
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: border-color 0.2s, transform 0.2s;
    }

    .skill-detail-card:hover { border-color: #34d39944; transform: translateY(-2px); }

    .skill-detail-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #1a2e24;
        border: 1px solid #34d39933;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .skill-detail-name  { font-size: 13px; font-weight: 700; color: #f0f0f0; margin-bottom: 3px; }
    .skill-detail-level { font-size: 11px; color: #6b7280; }

    .section-label {
        font-size: 11px;
        font-weight: 700;
        color: #34d399;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }

    @media (max-width: 768px) {
        .skills-track-wrap { margin: 0 -20px; padding: 0 20px; }
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
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
            </svg>
            Skills
        </div>
        <p class="page-subtitle">Teknologi & tools yang saya gunakan</p>
    </div>

    <hr class="section-divider">

    @php
    $skills = [
        ['name' => 'HTML',         'key' => 'html',         'icon' => '🔶', 'level' => 'Advanced'],
        ['name' => 'JavaScript',   'key' => 'js',           'icon' => '🟨', 'level' => 'Intermediate'],
        ['name' => 'PHP',          'key' => 'php',          'icon' => '🐘', 'level' => 'Intermediate'],
        ['name' => 'SQLite',       'key' => 'sqlite',       'icon' => '🗄️', 'level' => 'Intermediate'],
        ['name' => 'Next.js',      'key' => 'nextjs',       'icon' => '▲',  'level' => 'Learning'],
        ['name' => 'Vite',         'key' => 'vite',         'icon' => '⚡', 'level' => 'Intermediate'],
        ['name' => 'GitHub',       'key' => 'github',       'icon' => '🐙', 'level' => 'Intermediate'],
        ['name' => 'Kotlin',       'key' => 'kotlin',       'icon' => '🎯', 'level' => 'Learning'],
        ['name' => 'TailwindCSS',  'key' => 'tailwind',     'icon' => '🎨', 'level' => 'Advanced'],
        ['name' => 'CSS',          'key' => 'css',          'icon' => '💠', 'level' => 'Advanced'],
        ['name' => 'Laravel',      'key' => 'laravel',      'icon' => '🔴', 'level' => 'Intermediate'],
        ['name' => 'React',        'key' => 'react',        'icon' => '⚛️', 'level' => 'Intermediate'],
        ['name' => 'MySQL',        'key' => 'mysql',        'icon' => '🐬', 'level' => 'Intermediate'],
        ['name' => 'Autoprefixer', 'key' => 'autoprefixer', 'icon' => '🔧', 'level' => 'Intermediate'],
    ];
    $row1 = array_merge($skills, $skills);
    $row2 = array_merge(array_reverse($skills), array_reverse($skills));
    @endphp

    {{-- Marquee --}}
    <div class="skills-track-wrap">
        <div class="skills-track">
            @foreach($row1 as $skill)
            <div class="skill-pill" data-skill="{{ $skill['key'] }}">
                <span class="skill-icon">{{ $skill['icon'] }}</span>{{ $skill['name'] }}
            </div>
            @endforeach
        </div>
        <div class="skills-track">
            @foreach($row2 as $skill)
            <div class="skill-pill" data-skill="{{ $skill['key'] }}">
                <span class="skill-icon">{{ $skill['icon'] }}</span>{{ $skill['name'] }}
            </div>
            @endforeach
        </div>
    </div>

    {{-- Detail Grid --}}
    <p class="section-label">All Technologies</p>
    <div class="skill-detail-grid">
        @foreach($skills as $skill)
        <div class="skill-detail-card">
            <div class="skill-detail-icon">{{ $skill['icon'] }}</div>
            <div>
                <div class="skill-detail-name">{{ $skill['name'] }}</div>
                <div class="skill-detail-level">{{ $skill['level'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top: 40px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('achievements') }}" class="btn-action btn-action-primary">
            Lihat Achievements →
        </a>
    </div>

</div>
</x-layouts.sidebar>