<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg-app:           #0d1117;
            --bg-sidebar:       #0f1729;
            --bg-sidebar-hover: #151f38;
            --bg-active:        #1e3a8a;
            --border:           #1a2540;
            --accent:           #3b82f6;
            --accent-light:     #60a5fa;
            --text-primary:     #e2e8f0;
            --text-secondary:   #94a3b8;
            --text-muted:       #4b6281;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-app);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 0;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 100;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .sidebar-header {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid var(--border);
            min-height: 60px;
        }

        .brand { display: flex; align-items: center; gap: 10px; }

        .brand-logo {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 800; color: white; flex-shrink: 0;
        }

        .brand-name { font-size: 15px; font-weight: 700; color: var(--text-primary); }

        .sidebar-profile {
            width: 100%;
            display: flex; flex-direction: column; align-items: center;
            padding: 24px 16px 18px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-avatar {
            width: 76px; height: 76px;
            border-radius: 50%; overflow: hidden;
            margin-bottom: 12px;
            border: 2px solid var(--border);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .sidebar-avatar-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; font-weight: 700; color: #fff;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        }

        .sidebar-name { font-size: 14px; font-weight: 700; color: var(--text-primary); text-align: center; margin-bottom: 3px; }
        .sidebar-username { font-size: 11.5px; color: var(--text-muted); text-align: center; margin-bottom: 16px; }

        .sidebar-actions { display: flex; gap: 8px; width: 100%; }

        .btn-hire {
            flex: 1;
            display: flex; align-items: center; justify-content: center; gap: 6px;
            background: transparent;
            border: 1.5px solid var(--accent);
            color: var(--accent-light);
            font-size: 12.5px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-radius: 999px; padding: 7px 12px;
            cursor: pointer; transition: background 0.2s, color 0.2s; text-decoration: none;
        }

        .btn-hire:hover { background: var(--accent); color: #fff; }

        .btn-hire .dot {
            width: 6px; height: 6px;
            background: var(--accent-light); border-radius: 50%;
            animation: pulse 1.8s infinite; flex-shrink: 0;
        }

        .btn-hire:hover .dot { background: #fff; }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(1.3); }
        }

        .btn-id {
            background: transparent; border: 1.5px solid var(--border);
            color: var(--text-secondary); font-size: 12px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-radius: 999px; padding: 7px 16px;
            cursor: pointer; transition: border-color 0.2s, color 0.2s; text-decoration: none;
        }

        .btn-id:hover { border-color: var(--accent); color: var(--accent-light); }

        .sidebar-nav-wrap { width: 100%; flex: 1; overflow-y: auto; padding: 12px 10px; }
        .sidebar-nav-wrap::-webkit-scrollbar { width: 0; }

        .nav-section-label {
            font-size: 10px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.8px; padding: 8px 8px 4px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 9px;
            font-size: 13.5px; font-weight: 500; color: var(--text-secondary);
            text-decoration: none; transition: background 0.15s, color 0.15s;
            margin-bottom: 1px; width: 100%;
        }

        .nav-item:hover { background: var(--bg-sidebar-hover); color: var(--text-primary); }
        .nav-item.active { background: var(--bg-active); color: #93c5fd; font-weight: 600; }

        .nav-icon { width: 18px; height: 18px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
        .nav-label { flex: 1; }

        .sidebar-footer {
            width: 100%; text-align: center; padding: 14px 16px;
            border-top: 1px solid var(--border);
            font-size: 10.5px; color: var(--text-muted); line-height: 1.7;
        }

        .main-content { margin-left: 240px; flex: 1; min-height: 100vh; }

        .mobile-header {
            display: none; position: fixed;
            top: 0; left: 0; right: 0; height: 56px;
            background: var(--bg-sidebar); border-bottom: 1px solid var(--border);
            align-items: center; justify-content: space-between;
            padding: 0 16px; z-index: 200;
        }

        .mobile-logo { font-size: 15px; font-weight: 700; color: var(--text-primary); }
        .mobile-toggle { background: none; border: none; color: var(--text-secondary); cursor: pointer; padding: 4px; }

        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 99; }

        @media (max-width: 768px) {
            .mobile-header { display: flex; }
            .sidebar { transform: translateX(-100%); top: 0; }
            .sidebar.open { transform: translateX(0); }
            .overlay.show { display: block; }
            .main-content { margin-left: 0; padding-top: 56px; }
        }
    </style>
</head>
<body>

    <div class="mobile-header">
        <span class="mobile-logo">{{ auth()->user()->name ?? 'Portfolio' }}</span>
        <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="3" y1="6"  x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <div class="brand">
                <div class="brand-logo">A</div>
                <span class="brand-name">{{ auth()->user()->name ?? "As'ad" }}</span>
            </div>
        </div>

        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                @if(auth()->check() && auth()->user()->profile_photo_url)
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar">
                @else
                    <div class="sidebar-avatar-placeholder">
                        {{ auth()->check() ? auth()->user()->initials() : 'AA' }}
                    </div>
                @endif
            </div>
            <div class="sidebar-name">{{ auth()->user()->name ?? "As'ad Mahmud Akram" }}</div>
            <div class="sidebar-username">@{{ auth()->user()->username ?? 'asadmahmudakram' }}</div>
            <div class="sidebar-actions">
                <a href="mailto:{{ auth()->user()->email ?? 'admin@gmail.com' }}" class="btn-hire">
                    <span class="dot"></span> Hire me
                </a>
                <a href="{{ url('/settings/profile') }}" class="btn-id">ID</a>
            </div>
        </div>

        <div class="sidebar-nav-wrap">
            <div class="nav-section-label">Menu</div>

            <a href="{{ url('/') }}" class="nav-item {{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </span>
                <span class="nav-label">Home</span>
            </a>

            <a href="{{ url('/about') }}" class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </span>
                <span class="nav-label">About</span>
            </a>

            {{-- <a href="{{ url('/skills') }}" class="nav-item {{ request()->is('skills') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"/>
                        <polyline points="8 6 2 12 8 18"/>
                    </svg>
                </span>
                <span class="nav-label">Skills</span>
            </a> --}}

            <a href="{{ url('/achievements') }}" class="nav-item {{ request()->is('achievements') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"/>
                        <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/>
                    </svg>
                </span>
                <span class="nav-label">Achievements</span>
            </a>

            <a href="{{ url('/projects') }}" class="nav-item {{ request()->is('projects') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                        <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                    </svg>
                </span>
                <span class="nav-label">Projects</span>
            </a>

            <a href="{{ url('/contact') }}" class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="M2 8l10 6 10-6"/>
                    </svg>
                </span>
                <span class="nav-label">Contact</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <span>© {{ date('Y') }} {{ auth()->user()->name ?? "As'ad Mahmud Akram" }}</span>
            <span>All rights reserved</span>
        </div>

    </aside>

    <main class="main-content">
        @yield('content')
    </main>

    @fluxScripts

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('show');
        }
    </script>

</body>
</html>