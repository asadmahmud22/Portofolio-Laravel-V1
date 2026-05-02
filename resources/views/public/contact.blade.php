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

    .page-back svg {
        width: 16px;
        height: 16px;
    }

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

    /* ─── BIO ─── */
    .contact-bio {
        font-size: 14.5px;
        line-height: 1.85;
        color: #94a3b8;
        max-width: 580px;
        margin-bottom: 32px;
    }

    /* ─── CONTACT GRID ─── */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 36px;
        max-width: 640px;
    }

    .contact-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 12px;
        padding: 16px 18px;
        text-decoration: none;
        transition: border-color 0.2s, transform 0.2s;
    }

    .contact-card:hover {
        border-color: #3b82f655;
        transform: translateY(-2px);
    }

    .contact-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #1e3a8a22;
        border: 1px solid #3b82f633;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .contact-card-label {
        font-size: 11px;
        font-weight: 600;
        color: #4b6281;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 3px;
    }

    .contact-card-value {
        font-size: 13px;
        font-weight: 600;
        color: #e2e8f0;
    }

    /* ─── FORM ─── */
    .contact-form {
        background: #0f1729;
        border: 1.5px solid #1a2540;
        border-radius: 14px;
        padding: 28px;
        max-width: 640px;
    }

    .form-title {
        font-size: 15px;
        font-weight: 700;
        color: #f0f4ff;
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 12px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #4b6281;
        letter-spacing: 0.3px;
    }

    .form-input,
    .form-textarea {
        background: #0d1117;
        border: 1.5px solid #1a2540;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13.5px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #e2e8f0;
        outline: none;
        transition: border-color 0.2s;
        width: 100%;
    }

    .form-input:focus,
    .form-textarea:focus { border-color: #3b82f6; }

    .form-input::placeholder,
    .form-textarea::placeholder { color: #4b6281; }

    .form-textarea {
        resize: vertical;
        min-height: 110px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        border: 1.5px solid #3b82f6;
        color: #60a5fa;
        border-radius: 999px;
        padding: 11px 28px;
        font-size: 13.5px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        margin-top: 4px;
        transition: background 0.2s, color 0.2s, transform 0.2s;
    }

    .btn-submit:hover {
        background: #3b82f6;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-submit svg {
        width: 15px;
        height: 15px;
    }

    /* ─── ALERTS ─── */
    .alert-success {
        background: #1e3a8a22;
        border: 1px solid #3b82f644;
        color: #60a5fa;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .alert-error {
        background: #2e1a1a;
        border: 1px solid #ef444444;
        color: #f87171;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .portfolio-page { padding: 24px 20px 60px; }
        .contact-grid   { grid-template-columns: 1fr; }
        .form-row       { grid-template-columns: 1fr; }
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
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/>
            </svg>
            Contact
        </div>
        <p class="page-subtitle">Mari terhubung dan berkolaborasi</p>
    </div>

    <hr class="section-divider">

    <p class="contact-bio">
        Saya selalu terbuka untuk peluang baru, proyek menarik, atau sekadar obrolan tentang teknologi.
        Jangan ragu untuk menghubungi saya melalui email atau media sosial di bawah ini.
    </p>

    {{-- Social Links --}}
    <div class="contact-grid">
        <a href="mailto:{{ $profile->email ?? 'asadmahmudakram@gmail.com' }}" class="contact-card">
            <div class="contact-card-icon">✉️</div>
            <div>
                <div class="contact-card-label">Email</div>
                <div class="contact-card-value">{{ $profile->email ?? 'asadmahmudakram@gmail.com' }}</div>
            </div>
        </a>
        <a href="https://github.com/{{ $profile->github ?? 'asadmahmud22' }}" target="_blank" class="contact-card">
            <div class="contact-card-icon">🐙</div>
            <div>
                <div class="contact-card-label">GitHub</div>
                <div class="contact-card-value">github.com/{{ $profile->github ?? 'asadmahmudakram' }}</div>
            </div>
        </a>
        <a href="https://linkedin.com/in/{{ $profile->linkedin ?? 'as-ad-mahmud-akram' }}" target="_blank" class="contact-card">
            <div class="contact-card-icon">💼</div>
            <div>
                <div class="contact-card-label">LinkedIn</div>
                <div class="contact-card-value">linkedin.com/in/{{ $profile->linkedin ?? 'asadmahmudakram' }}</div>
            </div>
        </a>
        <a href="https://instagram.com/{{ $profile->instagram ?? 'asaddakram' }}" target="_blank" class="contact-card">
            <div class="contact-card-icon">📸</div>
            <div>
                <div class="contact-card-label">Instagram</div>
                <div class="contact-card-value">&#64;{{ $profile->instagram ?? 'asaddakram' }}</div>
            </div>
        </a>
    </div>

    {{-- Contact Form --}}
    <div class="contact-form">
        <div class="form-title">💬 Kirim Pesan</div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text"
                           name="name"
                           class="form-input"
                           placeholder="Nama lengkap kamu"
                           value="{{ old('name') }}"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-input"
                           placeholder="email@kamu.com"
                           value="{{ old('email') }}"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Subjek</label>
                <input type="text"
                       name="subject"
                       class="form-input"
                       placeholder="Tentang apa pesan ini?"
                       value="{{ old('subject') }}"
                       required>
            </div>
            <div class="form-group">
                <label class="form-label">Pesan</label>
                <textarea name="message"
                          class="form-textarea"
                          placeholder="Tuliskan pesan kamu di sini..."
                          required>{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                Kirim Pesan
            </button>
        </form>
    </div>

</div>
@endsection