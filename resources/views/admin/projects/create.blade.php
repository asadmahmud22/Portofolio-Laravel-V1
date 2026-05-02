@extends('layouts.admin')

@section('title', 'Tambah Project')
@section('page-title', 'Tambah Project')

@section('styles')
<style>
    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 20px;
    }
    .page-header h2 { font-size: 20px; font-weight: 600; color: #1a1a1a; }
    .page-header p  { font-size: 13px; color: #888; margin-top: 2px; }

    .btn-secondary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 18px;
        background: #fff; color: #555;
        border: 1px solid #E0E0DB;
        border-radius: 8px;
        font-size: 13px; font-family: inherit;
        text-decoration: none; cursor: pointer;
        transition: background .15s;
    }
    .btn-secondary:hover { background: #F5F5F0; }
    .btn-secondary svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

    /* Error alert */
    .alert-error {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 12px 16px;
        background: #FEF2F2; border: 1px solid #FECACA;
        border-radius: 10px; color: #991B1B;
        font-size: 13px; margin-bottom: 16px;
    }
    .alert-error svg { width: 16px; height: 16px; stroke: #EF4444; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }
    .alert-error ul { margin: 0; padding-left: 16px; }
    .alert-error li { margin-bottom: 2px; }

    /* Form card */
    .form-card {
        background: #fff;
        border: 1px solid #E8E8E3;
        border-radius: 12px;
        overflow: hidden;
    }

    .form-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #F0F0EB;
    }
    .form-card-header-title { font-size: 14px; font-weight: 500; color: #1a1a1a; }
    .form-card-header-sub   { font-size: 12px; color: #999; margin-top: 2px; }

    .form-body { padding: 20px; }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.span2 { grid-column: span 2; }

    .form-section-label {
        grid-column: span 2;
        font-size: 10px; font-weight: 500; color: #aaa;
        text-transform: uppercase; letter-spacing: .08em;
        padding-top: 4px;
    }

    .form-divider { grid-column: span 2; height: 1px; background: #F0F0EB; }

    label { font-size: 12px; font-weight: 500; color: #444; }

    .form-control {
        padding: 9px 12px;
        border: 1px solid #E0E0DB;
        border-radius: 8px;
        font-size: 13px; font-family: inherit;
        color: #1a1a1a; background: #fff; outline: none;
        transition: border-color .15s, box-shadow .15s;
    }
    .form-control:focus {
        border-color: #1D9E75;
        box-shadow: 0 0 0 3px rgba(29, 158, 117, .1);
    }
    .form-control.is-error { border-color: #EF4444; }
    textarea.form-control { resize: vertical; min-height: 100px; }

    .form-hint { font-size: 11px; color: #aaa; }
    .field-error { font-size: 11px; color: #EF4444; }

    /* Upload */
    .upload-area {
        border: 1.5px dashed #D0D0CB; border-radius: 8px;
        padding: 24px 20px; text-align: center; cursor: pointer;
        transition: border-color .15s, background .15s;
        display: block;
    }
    .upload-area:hover { border-color: #1D9E75; background: #F8FDFB; }
    .upload-area input[type="file"] { display: none; }
    .upload-icon {
        width: 40px; height: 40px; background: #E1F5EE; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;
    }
    .upload-icon svg { width: 18px; height: 18px; stroke: #0F6E56; fill: none; stroke-width: 2; }
    .upload-area p { font-size: 13px; color: #555; margin-bottom: 4px; }
    .upload-area span { font-size: 11px; color: #aaa; }

    .img-preview {
        display: none;
        margin-top: 12px;
    }
    .img-preview img {
        max-width: 200px; max-height: 140px;
        border-radius: 8px; border: 1px solid #E8E8E3;
        object-fit: cover;
    }

    /* Footer */
    .form-card-footer {
        padding: 14px 20px;
        border-top: 1px solid #F0F0EB;
        display: flex; align-items: center; justify-content: flex-end; gap: 10px;
    }

    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px;
        background: #1D9E75; color: #fff;
        border: none; border-radius: 8px;
        font-size: 13.5px; font-weight: 500; font-family: inherit;
        cursor: pointer; transition: background .15s;
    }
    .btn-primary:hover { background: #178a64; }
    .btn-primary svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    @media (max-width: 700px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-group.span2 { grid-column: span 1; }
        .form-section-label, .form-divider { grid-column: span 1; }
    }
</style>
@endsection

@section('content')

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h2>Tambah Project</h2>
            <p>Isi detail project baru yang ingin ditambahkan.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn-secondary">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-header-title">Informasi Project</div>
            <div class="form-card-header-sub">Semua field bertanda * wajib diisi.</div>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <div class="form-grid">

                    {{-- Judul --}}
                    <div class="form-group span2">
                        <label for="title">Judul Project *</label>
                        <input type="text" id="title" name="title"
                               class="form-control {{ $errors->has('title') ? 'is-error' : '' }}"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Website Portofolio v2">
                        @error('title')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group span2">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description"
                                  class="form-control {{ $errors->has('description') ? 'is-error' : '' }}"
                                  placeholder="Jelaskan tentang project ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tags --}}
                    <div class="form-group span2">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags"
                               class="form-control"
                               value="{{ old('tags') }}"
                               placeholder="Laravel, Vue.js, MySQL">
                        <span class="form-hint">Pisahkan tag dengan koma.</span>
                    </div>

                    <div class="form-divider"></div>
                    <div class="form-section-label">Link & Referensi</div>

                    {{-- URL Demo --}}
                    <div class="form-group">
                        <label for="url">Link Demo / Live</label>
                        <input type="url" id="url" name="url"
                               class="form-control {{ $errors->has('url') ? 'is-error' : '' }}"
                               value="{{ old('url') }}"
                               placeholder="https://project-demo.com">
                        @error('url')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- GitHub --}}
                    <div class="form-group">
                        <label for="github_url">Link GitHub</label>
                        <input type="url" id="github_url" name="github_url"
                               class="form-control {{ $errors->has('github_url') ? 'is-error' : '' }}"
                               value="{{ old('github_url') }}"
                               placeholder="https://github.com/user/repo">
                        @error('github_url')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-divider"></div>
                    <div class="form-section-label">Gambar Project</div>

                    {{-- Upload Gambar --}}
                    <div class="form-group span2">
                        <label class="upload-area" for="imageInput">
                            <input type="file" id="imageInput" name="image"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="upload-icon">
                                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                            <p>Klik untuk upload gambar</p>
                            <span id="fileName">PNG, JPG, WEBP — Maks 2MB</span>
                        </label>

                        <div class="img-preview" id="imgPreview">
                            <img id="previewImg" src="" alt="Preview">
                        </div>

                        @error('image')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>{{-- /form-grid --}}
            </div>{{-- /form-body --}}

            <div class="form-card-footer">
                <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Project
                </button>
            </div>

        </form>
    </div>

@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('fileName').textContent = file.name;

            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imgPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection