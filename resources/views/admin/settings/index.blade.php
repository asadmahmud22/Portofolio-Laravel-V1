{{-- resources/views/admin/settings.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('page-title', 'Pengaturan')

@section('topbar-actions')
    {{-- Optional topbar buttons can be added here --}}
@endsection

@section('styles')
    <style>
        /* Settings-specific styles */
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

        /* Settings Grid */
        .settings-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Settings Sidebar Navigation */
        .settings-sidebar {
            background: #fff;
            border: 1px solid #E8E8E3;
            border-radius: 12px;
            overflow: hidden;
            position: sticky;
            top: 80px;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            width: 100%;
            border: none;
            background: transparent;
            font-size: 13.5px;
            font-family: inherit;
            color: #555;
            cursor: pointer;
            transition: all .15s;
            text-align: left;
            border-bottom: 1px solid #F0F0EB;
        }

        .settings-nav-item:last-child {
            border-bottom: none;
        }

        .settings-nav-item:hover {
            background: #F5F5F0;
            color: #1a1a1a;
        }

        .settings-nav-item.active {
            background: #E1F5EE;
            color: #0F6E56;
            font-weight: 500;
            border-left: 3px solid #1D9E75;
        }

        .settings-nav-item svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
        }

        /* Card */
        .card {
            background: #fff;
            border: 1px solid #E8E8E3;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 24px;
            border-bottom: 1px solid #F0F0EB;
        }

        .card-header-title {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .card-header-sub {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .card-body {
            padding: 24px;
        }

        .card-footer {
            padding: 14px 24px;
            border-top: 1px solid #F0F0EB;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            background: #FAFAF8;
        }

        /* Form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.span2 {
            grid-column: span 2;
        }

        label {
            font-size: 12px;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            padding: 10px 14px;
            border: 1px solid #E0E0DB;
            border-radius: 8px;
            font-size: 13.5px;
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

        select.form-control {
            cursor: pointer;
        }

        .form-hint {
            font-size: 11px;
            color: #aaa;
            margin-top: 2px;
        }

        /* Toggle Switch */
        .toggle-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #F0F0EB;
        }

        .toggle-switch:last-child {
            border-bottom: none;
        }

        .toggle-info {
            flex: 1;
        }

        .toggle-title {
            font-size: 13px;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .toggle-desc {
            font-size: 11px;
            color: #999;
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #1D9E75;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(20px);
        }

        /* Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: #1D9E75;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-primary:hover {
            background: #178a64;
        }

        .btn-primary svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: #fff;
            color: #555;
            border: 1px solid #E0E0DB;
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-secondary:hover {
            background: #F5F5F0;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #FEF2F2;
            color: #B91C1C;
            border: 1px solid #FECACA;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: background .12s;
        }

        .btn-danger:hover {
            background: #FEE2E2;
        }

        /* Danger Zone */
        .danger-card {
            background: #fff;
            border: 1px solid #FECACA;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 24px;
        }

        .danger-header {
            padding: 14px 20px;
            border-bottom: 1px solid #FEE2E2;
            background: #FEF2F2;
        }

        .danger-header-title {
            font-size: 14px;
            font-weight: 500;
            color: #991B1B;
        }

        .danger-header-sub {
            font-size: 12px;
            color: #EF4444;
            margin-top: 2px;
        }

        .danger-body {
            padding: 20px;
        }

        .danger-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #FEE2E2;
        }

        .danger-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .danger-item-info .danger-title {
            font-size: 13px;
            font-weight: 500;
            color: #1a1a1a;
        }

        .danger-item-info .danger-desc {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        /* Password Strength */
        .strength-bar {
            height: 4px;
            background: #F0F0EB;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            width: 0%;
            transition: width .3s, background .3s;
        }

        /* Session List */
        .session-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #F0F0EB;
        }

        .session-item:last-child {
            border-bottom: none;
        }

        .session-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .session-icon {
            width: 36px;
            height: 36px;
            background: #F5F5F0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .session-icon svg {
            width: 16px;
            height: 16px;
            stroke: #666;
        }

        .session-details .session-device {
            font-size: 13px;
            font-weight: 500;
            color: #1a1a1a;
        }

        .session-details .session-meta {
            font-size: 11px;
            color: #999;
            margin-top: 2px;
        }

        .session-current {
            font-size: 10px;
            padding: 2px 8px;
            background: #E1F5EE;
            color: #0F6E56;
            border-radius: 12px;
            font-weight: 500;
        }

        @media (max-width: 900px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
            
            .settings-sidebar {
                position: static;
                display: flex;
                overflow-x: auto;
                gap: 4px;
                padding: 8px;
            }
            
            .settings-nav-item {
                border: 1px solid #E8E8E3;
                border-radius: 8px;
                white-space: nowrap;
                width: auto;
            }
            
            .settings-nav-item.active {
                border-left: 1px solid #E8E8E3;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.span2 {
                grid-column: span 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-header" style="margin-bottom: 20px;">
        <h2 style="font-size: 20px; font-weight: 600; color: #1a1a1a;">Pengaturan</h2>
        <p style="font-size: 13px; color: #888; margin-top: 2px;">Kelola profil, keamanan, dan preferensi akun Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-success" style="background: #FEF2F2; border-color: #FECACA; color: #991B1B;">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="settings-grid">
        {{-- Settings Navigation Sidebar --}}
        <div class="settings-sidebar">
            <button class="settings-nav-item active" data-tab="profile">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                Profil Saya
            </button>
            <button class="settings-nav-item" data-tab="security">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Keamanan
            </button>
            <button class="settings-nav-item" data-tab="preferences">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Preferensi
            </button>
            <button class="settings-nav-item" data-tab="sessions">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                Perangkat & Sesi
            </button>
        </div>

        {{-- Settings Content --}}
        <div>

            {{-- Tab: Profile --}}
            <div id="tab-profile" class="settings-tab active-tab">
                {{-- Avatar Section --}}
                <div class="card" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <div class="card-header-title">Foto Profil</div>
                        <div class="card-header-sub">Format: JPG, PNG, maks 2MB</div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                            <div class="profile-avatar" style="width: 80px; height: 80px; font-size: 26px;">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data" style="flex: 1;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="section" value="profile">
                                <label class="upload-area" for="avatarInput" style="padding: 12px 20px;">
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="previewAvatar(this)">
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                        <span>Pilih file baru</span>
                                    </div>
                                    <span id="fileName" style="font-size: 11px; margin-left: 10px;"></span>
                                </label>
                                <button type="submit" class="btn-primary" style="margin-top: 12px;">Upload Foto</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Profile Information Form --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Informasi Akun</div>
                        <div class="card-header-sub">Perbarui data diri Anda.</div>
                    </div>
                    <form action="{{ route('admin.settings') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="section" value="profile">
                        
                        <div class="card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control" 
                                           value="{{ old('name', auth()->user()->name) }}">
                                    @error('name')
                                        <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" 
                                           value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" 
                                           value="{{ old('username', auth()->user()->username ?? '') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">No. Telepon</label>
                                    <input type="text" id="phone" name="phone" class="form-control" 
                                           value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                </div>
                                
                                <div class="form-group span2">
                                    <label for="bio">Bio</label>
                                    <textarea id="bio" name="bio" class="form-control" rows="3" 
                                              placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', auth()->user()->bio ?? '') }}</textarea>
                                    <span class="form-hint">Tampil di halaman publik portofolio Anda.</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn-primary">
                                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tab: Security --}}
            <div id="tab-security" class="settings-tab" style="display: none;">
                {{-- Change Password --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Ganti Password</div>
                        <div class="card-header-sub">Pastikan menggunakan password yang kuat dan unik.</div>
                    </div>
                    <form action="{{ route('admin.settings') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="section" value="security">
                        
                        <div class="card-body">
                            <div class="form-grid">
                                <div class="form-group span2">
                                    <label for="current_password">Password Saat Ini</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password lama">
                                    @error('current_password')
                                        <span style="font-size:11px; color:#EF4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" id="password" name="password" class="form-control" 
                                           placeholder="Min. 8 karakter" oninput="checkStrength(this.value)">
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
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
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

                {{-- Two-Factor Authentication --}}
                <div class="card" style="margin-top: 24px;">
                    <div class="card-header">
                        <div class="card-header-title">Autentikasi Dua Faktor (2FA)</div>
                        <div class="card-header-sub">Tingkatkan keamanan akun Anda.</div>
                    </div>
                    <div class="card-body">
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Aktifkan 2FA</div>
                                <div class="toggle-desc">Membutuhkan kode verifikasi tambahan saat login.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="twoFactorToggle" {{ auth()->user()->two_factor_enabled ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        @if(!auth()->user()->two_factor_enabled)
                            <div style="margin-top: 16px; padding: 12px; background: #F5F5F0; border-radius: 8px;">
                                <p style="font-size: 12px; color: #666;">Belum mengaktifkan 2FA. Klik tombol di bawah untuk memulai setup.</p>
                                <button type="button" class="btn-secondary" style="margin-top: 12px;">Setup 2FA</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tab: Preferences --}}
            <div id="tab-preferences" class="settings-tab" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Preferensi Tampilan</div>
                        <div class="card-header-sub">Sesuaikan tampilan dashboard Anda.</div>
                    </div>
                    <div class="card-body">
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Mode Gelap</div>
                                <div class="toggle-desc">Mengubah tema menjadi gelap.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="darkModeToggle">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Animasi UI</div>
                                <div class="toggle-desc">Aktifkan animasi dan transisi halus.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="animationsToggle" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div style="margin-top: 16px;">
                            <label for="language">Bahasa</label>
                            <select id="language" class="form-control" style="margin-top: 6px; width: 200px;">
                                <option value="id">Bahasa Indonesia</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn-primary" onclick="savePreferences()">Simpan Preferensi</button>
                    </div>
                </div>

                {{-- Notifications --}}
                <div class="card" style="margin-top: 24px;">
                    <div class="card-header">
                        <div class="card-header-title">Notifikasi</div>
                        <div class="card-header-sub">Atur notifikasi yang ingin Anda terima.</div>
                    </div>
                    <div class="card-body">
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Notifikasi Email</div>
                                <div class="toggle-desc">Terima notifikasi melalui email.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="emailNotifications" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Notifikasi Project</div>
                                <div class="toggle-desc">Dapatkan update tentang proyek Anda.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="projectNotifications" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-switch">
                            <div class="toggle-info">
                                <div class="toggle-title">Newsletter</div>
                                <div class="toggle-desc">Kirim update dan tips bulanan.</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="newsletterToggle">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn-primary" onclick="saveNotifications()">Simpan Notifikasi</button>
                    </div>
                </div>
            </div>

            {{-- Tab: Sessions --}}
            <div id="tab-sessions" class="settings-tab" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Perangkat Aktif</div>
                        <div class="card-header-sub">Kelola perangkat yang terhubung ke akun Anda.</div>
                    </div>
                    <div class="card-body">
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-icon">
                                    <svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
                                </div>
                                <div class="session-details">
                                    <div class="session-device">Chrome on Windows</div>
                                    <div class="session-meta">Jakarta, Indonesia • Aktif sekarang</div>
                                </div>
                            </div>
                            <span class="session-current">Perangkat Ini</span>
                        </div>
                        
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-icon">
                                    <svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
                                </div>
                                <div class="session-details">
                                    <div class="session-device">Safari on Mac</div>
                                    <div class="session-meta">Bandung, Indonesia • 2 jam yang lalu</div>
                                </div>
                            </div>
                            <button class="btn-danger" style="padding: 4px 12px; font-size: 11px;">Cabut</button>
                        </div>
                        
                        <div class="session-item">
                            <div class="session-info">
                                <div class="session-icon">
                                    <svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
                                </div>
                                <div class="session-details">
                                    <div class="session-device">Firefox on Linux</div>
                                    <div class="session-meta">Surabaya, Indonesia • 3 hari yang lalu</div>
                                </div>
                            </div>
                            <button class="btn-danger" style="padding: 4px 12px; font-size: 11px;">Cabut</button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn-danger" onclick="if(confirm('Cabut semua perangkat kecuali yang ini?')) { /* logout all other devices */ }">
                            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Cabut Semua Perangkat Lain
                        </button>
                    </div>
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
                                <div class="danger-title">Hapus Akun</div>
                                <div class="danger-desc">Semua data akan dihapus permanen dan tidak bisa dipulihkan.</div>
                            </div>
                            <button type="button" class="btn-danger"
                                    onclick="if(confirm('Yakin ingin menghapus akun? Tindakan ini TIDAK BISA dibatalkan.')) { document.getElementById('deleteForm').submit(); }">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                Hapus Akun
                            </button>
                            <form id="deleteForm" action="{{ route('admin.settings') }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

