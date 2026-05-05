@extends('layouts.admin')

@section('title', 'Tambah Achievement')
@section('page-title', 'Tambah Achievement')

@section('content')
<div class="content">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h2>Tambah Achievement</h2>
            <p>Isi detail sertifikat atau penghargaan baru.</p>
        </div>
        <a href="{{ route('admin.achievements.index') }}" class="btn-secondary">
            <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali
        </a>
    </div>

    {{-- Alert Error --}}
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
    <div class="card">
        <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <div class="form-grid">

                    <div class="form-group span2">
                        <label for="title">Judul Achievement <span class="req">*</span></label>
                        <input type="text" id="title" name="title" class="form-control"
                               value="{{ old('title') }}" required placeholder="Contoh: React Developer Certificate">
                    </div>

                    <div class="form-group span2">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control"
                                  rows="4" placeholder="Deskripsi singkat tentang sertifikat ini...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="issuer">Penerbit / Lembaga</label>
                        <input type="text" id="issuer" name="issuer" class="form-control"
                               value="{{ old('issuer') }}" placeholder="Dicoding, Coursera, Google...">
                    </div>

                    <div class="form-group">
                        <label for="issued_date">Tanggal Terbit</label>
                        <input type="date" id="issued_date" name="issued_date" class="form-control"
                               value="{{ old('issued_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" id="category" name="category" class="form-control"
                               value="{{ old('category') }}" placeholder="Programming, Design, dll">
                    </div>

                    <div class="form-group">
                        <label for="link">Link Sertifikat <span class="opt">(opsional)</span></label>
                        <input type="url" id="link" name="link" class="form-control"
                               value="{{ old('link') }}" placeholder="https://...">
                    </div>

                    <div class="form-group span2">
                        <label>Gambar Sertifikat</label>
                        <label class="upload-area" for="imageInput" id="uploadLabel">
                            <input type="file" id="imageInput" name="image"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <div class="upload-icon">
                                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                </div>
                                <p>Klik untuk upload gambar sertifikat</p>
                                <span id="fileName" class="upload-hint">PNG, JPG, WEBP — Maks 2MB</span>
                            </div>
                        </label>
                        <div class="img-preview" id="imgPreview" style="display: none;">
                            <img id="previewImg" src="" alt="Preview">
                            <button type="button" class="remove-img" onclick="removeImage()">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                Hapus Gambar
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('admin.achievements.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Achievement
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('styles')
<style>
    /* Page Header */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .page-header h2 { font-size: 20px; font-weight: 600; color: #1a1a1a; }
    .page-header p  { font-size: 13px; color: #888; margin-top: 2px; }

    /* Buttons */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 18px;
        background: #1D9E75;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        text-decoration: none;
        transition: background .15s;
    }

    .btn-primary:hover { background: #178a64; }
    .btn-primary svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    .btn-secondary {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 16px;
        background: #fff;
        border: 1px solid #E0E0DB;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        font-family: inherit;
        color: #555;
        text-decoration: none;
        cursor: pointer;
        transition: background .15s;
    }

    .btn-secondary:hover { background: #F4F4EF; }
    .btn-secondary svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

    /* Alert Error */
    .alert-error {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 12px 16px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-radius: 10px;
        color: #B91C1C;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .alert-error svg { width: 16px; height: 16px; stroke: #DC2626; fill: none; stroke-width: 2; flex-shrink: 0; margin-top: 1px; }
    .alert-error ul  { margin: 0; padding-left: 16px; }
    .alert-error li  { margin-bottom: 2px; }

    /* Card */
    .card {
        background: #fff;
        border: 1px solid #E8E8E3;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Form Body */
    .form-body { padding: 24px; }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.span2 { grid-column: span 2; }

    label {
        font-size: 13px;
        font-weight: 500;
        color: #444;
    }

    .req { color: #DC2626; }
    .opt { font-size: 11px; font-weight: 400; color: #aaa; }

    .form-control {
        padding: 9px 12px;
        border: 1px solid #E0E0DB;
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        color: #333;
        background: #fff;
        transition: border-color 0.15s;
        outline: none;
    }

    .form-control:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,.08); }
    textarea.form-control { resize: vertical; }

    /* Upload area */
    .upload-area {
        display: block;
        border: 2px dashed #D8D8D3;
        border-radius: 10px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.15s, background 0.15s;
        background: #FAFAF8;
    }

    .upload-area:hover { border-color: #1D9E75; background: #F5FDF9; }
    .upload-area input[type="file"] { display: none; }

    .upload-icon {
        width: 40px; height: 40px;
        background: #F0F0EB;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px;
    }

    .upload-icon svg { width: 18px; height: 18px; stroke: #aaa; fill: none; stroke-width: 2; }

    .upload-placeholder p {
        font-size: 13px;
        color: #666;
        margin: 0 0 4px;
    }

    .upload-hint { font-size: 11px; color: #aaa; }

    /* Image preview */
    .img-preview {
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .img-preview img {
        width: 120px; height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #E8E8E3;
        display: block;
    }

    .remove-img {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px;
        font-weight: 500;
        font-family: inherit;
        color: #B91C1C;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-radius: 7px;
        padding: 6px 12px;
        cursor: pointer;
        transition: background .12s;
    }

    .remove-img:hover { background: #FEE2E2; }
    .remove-img svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    /* Form Footer */
    .form-footer {
        padding: 16px 24px;
        border-top: 1px solid #F0F0EB;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        background: #FAFAF8;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-group.span2 { grid-column: span 1; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    }
</style>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imgPreview').style.display = 'flex';
                document.getElementById('fileName').textContent = input.files[0].name;
                document.getElementById('uploadPlaceholder').style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imgPreview').style.display = 'none';
        document.getElementById('uploadPlaceholder').style.display = 'block';
        document.getElementById('fileName').textContent = 'PNG, JPG, WEBP — Maks 2MB';
    }
</script>
@endsection