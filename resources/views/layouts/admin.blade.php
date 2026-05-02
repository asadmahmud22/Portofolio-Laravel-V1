<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @yield('styles')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F5F5F0;
            min-height: 100vh;
        }

        .layout { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #E8E8E3;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 20px 20px 16px;
            border-bottom: 1px solid #E8E8E3;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 32px; height: 32px;
            background: #1D9E75;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .logo-icon svg { width: 18px; height: 18px; stroke: white; fill: none; stroke-width: 2; }
        .logo-text { font-size: 15px; font-weight: 600; color: #1a1a1a; }

        .sidebar-nav { padding: 12px 0; flex: 1; overflow-y: auto; }

        .nav-section {
            padding: 8px 16px 4px;
            font-size: 10px;
            font-weight: 500;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 16px;
            margin: 2px 8px;
            border-radius: 8px;
            font-size: 13.5px;
            color: #666;
            text-decoration: none;
            transition: background .15s, color .15s;
        }

        .nav-item:hover { background: #F5F5F0; color: #1a1a1a; }

        .nav-item.active {
            background: #E1F5EE;
            color: #0F6E56;
            font-weight: 500;
        }

        .nav-item svg {
            width: 16px; height: 16px;
            flex-shrink: 0;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            opacity: .7;
        }

        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #E8E8E3;
        }

        .user-card { display: flex; align-items: center; gap: 10px; }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: #E1F5EE;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: #0F6E56;
            flex-shrink: 0;
        }

        .user-info .user-name { font-size: 13px; font-weight: 500; color: #1a1a1a; }
        .user-info .user-role { font-size: 11px; color: #999; }

        /* ── Main ── */
        .main {
            flex: 1;
            margin-left: 240px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #E8E8E3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title { font-size: 16px; font-weight: 600; color: #1a1a1a; }
        .topbar-sub   { font-size: 11px; color: #999; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .btn-site {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            border: 1px solid #E0E0DB;
            font-size: 13px; color: #555;
            background: #fff;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            transition: background .15s;
        }

        .btn-site:hover { background: #F5F5F0; }
        .btn-site svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        .notif-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid #E8E8E3;
            display: flex; align-items: center; justify-content: center;
            background: #fff; cursor: pointer;
            position: relative;
        }

        .notif-btn:hover { background: #F5F5F0; }
        .notif-btn svg { width: 15px; height: 15px; stroke: #555; fill: none; stroke-width: 2; }

        .notif-dot {
            width: 7px; height: 7px;
            background: #1D9E75; border-radius: 50%;
            position: absolute; top: 6px; right: 6px;
            border: 1.5px solid #fff;
        }

        /* ── Content wrapper ── */
        .content { padding: 24px; flex: 1; }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); transition: transform .25s; }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,.35);
                z-index: 99;
            }
            .overlay.show { display: block; }
            .mobile-toggle { display: flex !important; }
        }

        .mobile-toggle {
            display: none;
            align-items: center; justify-content: center;
            width: 32px; height: 32px;
            border: 1px solid #E8E8E3;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
        }

        .mobile-toggle svg { width: 16px; height: 16px; stroke: #555; fill: none; stroke-width: 2; }
    </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<div class="layout">

    {{-- ── Sidebar ── --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <span class="logo-text">AdminPanel</span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">Menu</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.profile') }}"
               class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                Profile
            </a>

            <a href="{{ route('admin.achievements.index') }}"
            class="nav-item {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                Achievement
            </a>

            <a href="{{ route('admin.projects.index') }}"
               class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                Project
            </a>


            <a href="{{ route('admin.statistics') }}"
               class="nav-item {{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                Statistik
            </a>

            <a href="{{ route('admin.settings') }}"
               class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Pengaturan
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="main">

        {{-- Topbar --}}
        <header class="topbar">
            <div style="display:flex; align-items:center; gap:12px;">
                <button class="mobile-toggle" onclick="openSidebar()">
                    <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                    <div class="topbar-sub">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</div>
                </div>
            </div>
            <div class="topbar-right">
                @yield('topbar-actions')
                <a href="/" class="btn-site">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    Ke Website
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <div class="content">
            @yield('content')
        </div>

    </div>{{-- /main --}}
</div>{{-- /layout --}}

@yield('scripts')

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('overlay').classList.add('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }
</script>

</body>
</html>