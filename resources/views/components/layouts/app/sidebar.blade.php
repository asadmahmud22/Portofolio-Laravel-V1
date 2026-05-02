<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f0f13;
            color: #e2e2e2;
            min-height: 100vh;
            display: flex;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #141418;
            border-right: 1px solid #1e1e26;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 20px 24px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        /* Avatar */
        .sidebar-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9b1c1c, #c0392b);
            overflow: hidden;
            margin-bottom: 14px;
            border: 3px solid #1e1e26;
            box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.2);
        }

        .sidebar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #7f1d1d, #b91c1c);
        }

        /* Name & Username */
        .sidebar-name {
            font-size: 15px;
            font-weight: 700;
            color: #f0f0f0;
            text-align: center;
            margin-bottom: 4px;
            letter-spacing: -0.2px;
        }

        .sidebar-username {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Hire me + ID button row */
        .sidebar-actions {
            display: flex;
            gap: 8px;
            margin-bottom: 28px;
            width: 100%;
        }

        .btn-hire {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: transparent;
            border: 1.5px solid #34d399;
            color: #34d399;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-radius: 999px;
            padding: 8px 14px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
        }

        .btn-hire:hover {
            background: #34d399;
            color: #0f0f13;
        }

        .btn-hire .dot {
            width: 7px;
            height: 7px;
            background: #34d399;
            border-radius: 50%;
            animation: pulse 1.8s infinite;
        }

        .btn-hire:hover .dot {
            background: #0f0f13;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .btn-id {
            background: transparent;
            border: 1.5px solid #2a2a35;
            color: #9ca3af;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-radius: 999px;
            padding: 8px 16px;
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
            text-decoration: none;
        }

        .btn-id:hover {
            border-color: #4b5563;
            color: #e2e2e2;
        }

        /* Divider */
        .sidebar-divider {
            width: 100%;
            height: 1px;
            background: #1e1e26;
            margin-bottom: 8px;
        }

        /* Nav */
        .sidebar-nav {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #9ca3af;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            position: relative;
            cursor: pointer;
        }

        .nav-item:hover {
            background: #1e1e28;
            color: #e2e2e2;
        }

        .nav-item.active {
            background: #1a2e24;
            color: #34d399;
            font-weight: 600;
        }

        .nav-item .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-item .nav-dot {
            width: 6px;
            height: 6px;
            background: #34d399;
            border-radius: 50%;
            margin-left: auto;
        }

        /* Footer */
        .sidebar-footer {
            width: 100%;
            text-align: center;
            padding-top: 16px;
            border-top: 1px solid #1e1e26;
            font-size: 11px;
            color: #4b5563;
            line-height: 1.7;
        }

        .sidebar-footer span {
            display: block;
        }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
        }

        /* ─── MOBILE HEADER ─── */
        .mobile-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            background: #141418;
            border-bottom: 1px solid #1e1e26;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            z-index: 200;
        }

        .mobile-logo {
            font-size: 15px;
            font-weight: 700;
            color: #f0f0f0;
        }

        .mobile-toggle {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 99;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .mobile-header { display: flex; }

            .sidebar {
                transform: translateX(-100%);
                top: 0;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .overlay.show { display: block; }

            .main-content {
                margin-left: 0;
                padding-top: 56px;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <span class="mobile-logo">{{ auth()->user()->name ?? 'Portfolio' }}</span>
        <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <!-- Overlay (mobile) -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- ─── SIDEBAR ─── -->
    <aside class="sidebar" id="sidebar">

        <!-- Avatar -->
        <div class="sidebar-avatar">
            @if(auth()->check() && auth()->user()->profile_photo_url)
                <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar">
            @else
                <div class="sidebar-avatar-placeholder">
                    {{ auth()->check() ? auth()->user()->initials() : 'AA' }}
                </div>
            @endif
        </div>

        <!-- Name & Username -->
        <div class="sidebar-name">{{ auth()->user()->name ?? 'Frontend Developer' }}</div>
        <div class="sidebar-username">@{{ auth()->user()->username ?? 'asadmahmudakram' }}</div>

        <!-- Actions -->
        <div class="sidebar-actions">
            <a href="mailto:{{ auth()->user()->email ?? '#' }}" class="btn-hire">
                <span class="dot"></span>
                Hire me
            </a>
            <a href="{{ Route::has('settings.profile') ? route('settings.profile') : '#' }}" class="btn-id">ID</a>
        </div>

        <div class="sidebar-divider"></div>

        <!-- Navigation -->
        <nav class="sidebar-nav">

            <a href="#home" class="nav-item active" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </span>
                Home
                <span class="nav-dot"></span>
            </a>

            <a href="/about" class="nav-item" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </span>
                About
            </a>

            <a href="/skills" class="nav-item" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"/>
                        <polyline points="8 6 2 12 8 18"/>
                    </svg>
                </span>
                Skills
            </a>

            <a href="/achievements" class="nav-item" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"/>
                        <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/>
                    </svg>
                </span>
                Achievements
            </a>

            <a href="/projects" class="nav-item" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                        <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                    </svg>
                </span>
                Projects
            </a>

            <a href="/contact" class="nav-item" onclick="setActive(this)">
                <span class="nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="M2 8l10 6 10-6"/>
                    </svg>
                </span>
                Contact
            </a>

        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <span>© {{ date('Y') }}</span>
            <span>{{ auth()->user()->name ?? "As'ad Mahmud Akram" }}</span>
            <span>All rights reserved</span>
        </div>

    </aside>

    <!-- ─── MAIN CONTENT ─── -->
    <main class="main-content">
        {{ $slot }}
    </main>

    @fluxScripts

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        function setActive(el) {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                const dot = item.querySelector('.nav-dot');
                if (dot) dot.remove();
            });
            el.classList.add('active');
            const dot = document.createElement('span');
            dot.className = 'nav-dot';
            el.appendChild(dot);

            // Close sidebar on mobile after click
            if (window.innerWidth <= 768) toggleSidebar();
        }
    </script>

</body>
</html>