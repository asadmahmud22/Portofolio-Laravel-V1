<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
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

        .sidebar-nav { padding: 12px 0; flex: 1; }

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
        }

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
        .topbar-sub { font-size: 11px; color: #999; }

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

        /* ── Content ── */
        .content { padding: 24px; }

        /* Page Header */
        .page-header {
            margin-bottom: 20px;
        }

        .page-header h2 { font-size: 20px; font-weight: 600; color: #1a1a1a; }
        .page-header p  { font-size: 13px; color: #888; margin-top: 2px; }

        /* Alert */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px;
            background: #E1F5EE;
            border: 1px solid #A5DECA;
            border-radius: 10px;
            color: #085041;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .alert-success svg { width: 16px; height: 16px; stroke: #0F6E56; fill: none; stroke-width: 2; flex-shrink: 0; }

        /* Profile Grid */
        .profile-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 16px;
            align-items: start;
        }

        /* Card */
        .card {
            background: #fff;
            border: 1px solid #E8E8E3;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #F0F0EB;
        }

        .card-header-title {
            font-size: 14px; font-weight: 500; color: #1a1a1a;
        }

        .card-header-sub {
            font-size: 12px; color: #999; margin-top: 2px;
        }

        .card-body { padding: 20px; }

        /* Avatar Card */
        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 28px 20px 20px;
        }

        .profile-avatar {
            width: 88px; height: 88px;
            border-radius: 50%;
            background: #E1F5EE;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; font-weight: 600; color: #0F6E56;
            margin-bottom: 14px;
            border: 3px solid #F0F0EB;
            overflow: hidden;
            flex-shrink: 0;
        }

        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .avatar-name { font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
        .avatar-email { font-size: 12px; color: #999; margin-bottom: 16px; }

        .avatar-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px;
            background: #E1F5EE;
            color: #0F6E56;
            border-radius: 20px;
            font-size: 12px; font-weight: 500;
            margin-bottom: 20px;
        }

        .avatar-badge::before {
            content: '';
            width: 6px; height: 6px;
            background: #1D9E75;
            border-radius: 50%;
        }

        .avatar-divider {
            width: 100%;
            height: 1px;
            background: #F0F0EB;
            margin-bottom: 16px;
        }

        .avatar-stats {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .avatar-stat {
            background: #FAFAF8;
            border: 1px solid #F0F0EB;
            border-radius: 8px;
            padding: 10px 12px;
            text-align: center;
        }

        .avatar-stat .stat-num { font-size: 18px; font-weight: 600; color: #1a1a1a; }
        .avatar-stat .stat-lbl { font-size: 11px; color: #999; margin-top: 2px; }

        /* Form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid.full { grid-template-columns: 1fr; }

        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.span2 { grid-column: span 2; }

        label {
            font-size: 12px; font-weight: 500; color: #444;
        }

        .form-control {
            padding: 9px 12px;
            border: 1px solid #E0E0DB;
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            color: #1a1a1a;
            background: #fff;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .form-control:focus {
            border-color: #1D9E75;
            box-shadow: 0 0 0 3px rgba(29, 158, 117, .1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        .form-hint { font-size: 11px; color: #aaa; }

        .form-divider {
            grid-column: span 2;
            height: 1px;
            background: #F0F0EB;
            margin: 4px 0;
        }

        .form-section-label {
            grid-column: span 2;
            font-size: 11px; font-weight: 500; color: #aaa;
            text-transform: uppercase; letter-spacing: .08em;
            padding-top: 4px;
        }

        /* Upload area */
        .upload-area {
            border: 1.5px dashed #D0D0CB;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
        }

        .upload-area:hover { border-color: #1D9E75; background: #F8FDFB; }

        .upload-area input[type="file"] { display: none; }

        .upload-icon {
            width: 38px; height: 38px;
            background: #E1F5EE;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px;
        }

        .upload-icon svg { width: 18px; height: 18px; stroke: #0F6E56; fill: none; stroke-width: 2; }

        .upload-area p { font-size: 13px; color: #555; }
        .upload-area span { font-size: 11px; color: #aaa; }

        /* Password strength */
        .strength-bar {
            height: 4px;
            background: #F0F0EB;
            border-radius: 2px;
            margin-top: 6px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            width: 0%;
            transition: width .3s, background .3s;
        }

        /* Footer buttons */
        .card-footer {
            padding: 14px 20px;
            border-top: 1px solid #F0F0EB;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 20px;
            background: #1D9E75;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-primary:hover { background: #178a64; }
        .btn-primary svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        .btn-secondary {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px;
            background: #fff;
            color: #555;
            border: 1px solid #E0E0DB;
            border-radius: 8px;
            font-size: 13.5px;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-secondary:hover { background: #F5F5F0; }

        /* Danger zone */
        .danger-card {
            background: #fff;
            border: 1px solid #FECACA;
            border-radius: 12px;
            overflow: hidden;
        }

        .danger-header {
            padding: 14px 20px;
            border-bottom: 1px solid #FEE2E2;
            background: #FEF2F2;
        }

        .danger-header-title { font-size: 14px; font-weight: 500; color: #991B1B; }
        .danger-header-sub   { font-size: 12px; color: #EF4444; margin-top: 2px; }

        .danger-body { padding: 20px; }

        .danger-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #FEE2E2;
        }

        .danger-item:last-child { border-bottom: none; padding-bottom: 0; }

        .danger-item-info .danger-title { font-size: 13px; font-weight: 500; color: #1a1a1a; }
        .danger-item-info .danger-desc  { font-size: 12px; color: #888; margin-top: 2px; }

        .btn-danger {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            background: #FEF2F2;
            color: #B91C1C;
            border: 1px solid #FECACA;
            border-radius: 8px;
            font-size: 12.5px; font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: background .12s;
            white-space: nowrap;
        }

        .btn-danger:hover { background: #FEE2E2; }
        .btn-danger svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        @media (max-width: 900px) {
            .profile-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.span2 { grid-column: span 1; }
            .form-divider, .form-section-label { grid-column: span 1; }
        }

        @media (max-width: 640px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="layout">

    {{-- ── Sidebar ── --}}
    <aside class="sidebar">
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

            <a href="{{ route('admin.projects.index') }}"
               class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                Project
            </a>

            <div class="nav-section" style="margin-top:8px">Lainnya</div>

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
            <div>
                <div class="topbar-title">Profile</div>
                <div class="topbar-sub">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</div>
            </div>
            <div class="topbar-right">
                <a href="/" class="btn-site">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    Ke Website
                </a>
            </div>
        </header>

        {{-- Content --}}
        <div class="content">

            <div class="page-header">
                <h2>Profile Saya</h2>
                <p>Kelola informasi akun dan pengaturan profil kamu.</p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="profile-grid">

                {{-- ── Kolom Kiri: Avatar Card ── --}}
                <div style="display:flex; flex-direction:column; gap:16px;">

                    <div class="card">
                        <div class="avatar-section">
                            <div class="profile-avatar">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="Avatar">
                                @else
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="avatar-name">{{ auth()->user()->name }}</div>
                            <div class="avatar-email">{{ auth()->user()->email }}</div>
                            <div class="avatar-badge">Administrator</div>

                            <div class="avatar-divider"></div>

                            <div class="avatar-stats">
                                <div class="avatar-stat">
                                    <div class="stat-num">{{ $totalProjects ?? 0 }}</div>
                                    <div class="stat-lbl">Projects</div>
                                </div>
                                <div class="avatar-stat">
                                    <div class="stat-num">{{ auth()->user()->created_at->diffInDays() }}d</div>
                                    <div class="stat-lbl">Bergabung</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-title">Foto Profil</div>
                            <div class="card-header-sub">Format: JPG, PNG, maks 2MB</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <label class="upload-area" for="avatarInput">
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*"
                                           onchange="previewAvatar(this)">
                                    <div class="upload-icon">
                                        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    </div>
                                    <p>Klik untuk upload foto</p>
                                    <span id="fileName">atau drag & drop di sini</span>
                                </label>

                                <div style="margin-top:12px; text-align:right;">
                                    <button type="submit" class="btn-primary">
                                        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                {{-- ── Kolom Kanan: Form ── --}}
                <div style="display:flex; flex-direction:column; gap:16px;">

                    {{-- Informasi Dasar --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-title">Informasi Akun</div>
                            <div class="card-header-sub">Perbarui nama dan email akun kamu.</div>
                        </div>

                        <form action="{{ route('admin.profile') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="card-body">
                                <div class="form-grid">

                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" id="name" name="name"
                                               class="form-control"
                                               value="{{ old('name', auth()->user()->name) }}"
                                               placeholder="Masukkan nama lengkap">
                                        @error('name')
                                            <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email"
                                               class="form-control"
                                               value="{{ old('email', auth()->user()->email) }}"
                                               placeholder="nama@email.com">
                                        @error('email')
                                            <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username"
                                               class="form-control"
                                               value="{{ old('username', auth()->user()->username ?? '') }}"
                                               placeholder="username">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">No. Telepon</label>
                                        <input type="text" id="phone" name="phone"
                                               class="form-control"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                               placeholder="+62 xxx xxxx xxxx">
                                    </div>

                                    <div class="form-group span2">
                                        <label for="bio">Bio</label>
                                        <textarea id="bio" name="bio"
                                                  class="form-control"
                                                  placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', auth()->user()->bio ?? '') }}</textarea>
                                        <span class="form-hint">Tampil di halaman publik portofolio kamu.</span>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn-secondary"
                                        onclick="document.getElementById('name').value='{{ auth()->user()->name }}'">
                                    Reset
                                </button>
                                <button type="submit" class="btn-primary">
                                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Ganti Password --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-title">Ganti Password</div>
                            <div class="card-header-sub">Pastikan menggunakan password yang kuat dan unik.</div>
                        </div>

                        <form action="{{ route('admin.profile') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="change_password">

                            <div class="card-body">
                                <div class="form-grid">

                                    <div class="form-group span2">
                                        <label for="current_password">Password Saat Ini</label>
                                        <input type="password" id="current_password" name="current_password"
                                               class="form-control"
                                               placeholder="Masukkan password lama">
                                        @error('current_password')
                                            <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password Baru</label>
                                        <input type="password" id="password" name="password"
                                               class="form-control"
                                               placeholder="Min. 8 karakter"
                                               oninput="checkStrength(this.value)">
                                        <div class="strength-bar">
                                            <div class="strength-fill" id="strengthFill"></div>
                                        </div>
                                        <span class="form-hint" id="strengthText">Masukkan password baru</span>
                                        @error('password')
                                            <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control"
                                               placeholder="Ulangi password baru">
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn-primary">
                                    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    Perbarui Password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="danger-card">
                        <div class="danger-header">
                            <div class="danger-header-title">Zona Bahaya</div>
                            <div class="danger-header-sub">Tindakan di bawah tidak dapat dibatalkan. Harap berhati-hati.</div>
                        </div>
                        <div class="danger-body">

                            <div class="danger-item">
                                <div class="danger-item-info">
                                    <div class="danger-title">Logout dari semua perangkat</div>
                                    <div class="danger-desc">Mengakhiri semua sesi aktif di perangkat lain.</div>
                                </div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-danger">
                                        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>

                            <div class="danger-item">
                                <div class="danger-item-info">
                                    <div class="danger-title">Hapus Akun</div>
                                    <div class="danger-desc">Semua data akan dihapus permanen dan tidak bisa dipulihkan.</div>
                                </div>
                                <button type="button" class="btn-danger"
                                        onclick="if(confirm('Yakin ingin menghapus akun? Tindakan ini TIDAK BISA dibatalkan.')) { document.getElementById('deleteForm').submit(); }">
                                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                    Hapus Akun
                                </button>
                                <form id="deleteForm" action="{{ route('admin.profile') }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>

                        </div>
                    </div>

                </div>{{-- /kolom kanan --}}
            </div>{{-- /profile-grid --}}

        </div>{{-- /content --}}
    </div>{{-- /main --}}
</div>{{-- /layout --}}

<script>
    // Preview avatar sebelum upload
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('fileName').textContent = file.name;

            const reader = new FileReader();
            reader.onload = e => {
                const avatar = document.querySelector('.profile-avatar');
                avatar.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }
    }

    // Password strength checker
    function checkStrength(val) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        let score = 0;

        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { w: '0%',   bg: '#E0E0DB', label: 'Masukkan password baru' },
            { w: '25%',  bg: '#EF4444', label: 'Lemah' },
            { w: '50%',  bg: '#F59E0B', label: 'Sedang' },
            { w: '75%',  bg: '#3B82F6', label: 'Kuat' },
            { w: '100%', bg: '#1D9E75', label: 'Sangat kuat' },
        ];

        const lv = levels[val.length === 0 ? 0 : score];
        fill.style.width = lv.w;
        fill.style.background = lv.bg;
        text.textContent = lv.label;
        text.style.color = val.length === 0 ? '#aaa' : lv.bg;
    }
</script>

</body>
</html>