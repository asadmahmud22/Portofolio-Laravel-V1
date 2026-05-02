@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('styles')
<style>
    /* --- Gunakan style yang SAMA PERSIS dengan halaman create --- */
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

    /* Upload Area */
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
        margin-top: 12px;
    }
    .img-preview img {
        max-width: 200px; max-height: 140px;
        border-radius: 8px; border: 1px solid #E8E8E3;
        object-fit: cover;
    }
    
    /* Tambahan style untuk gambar lama */
    .current-img {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
        padding: 8px;
        background: #F9F9F6;
        border-radius: 8px;
    }
    .current-img span {
        font-size: 12px;
        color: #666;
    }
    .img-remove-hint {
        font-size: 11px;
        color: #999;
        margin-top: 5px;
    }

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
        .form-group.span2, .form-section-label, .form-divider { grid-column: span 1; }
    }
</style>
@endsection

@section('content')
    @php
        // Helper: Ubah string tags menjadi array untuk ditampilkan di input
        $tagsString = old('tags', $project->tags ?? '');
        if(is_array($tagsString)) $tagsString = implode(', ', $tagsString);
    @endphp

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h2>Edit Project</h2>
            <p>Perbarui informasi project yang sudah ada.</p>
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

        {{-- 
            KIRIM METHOD SPOOFING "PUT" atau "PATCH"
            Route untuk update biasanya menggunakan method PUT/PATCH.
            Pastikan route di web.php menggunakan ->put() atau ->patch().
            Contoh: Route::put('/admin/projects/{project}', ...)->name('admin.projects.update');
        --}}
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">
                <div class="form-grid">

                    {{-- Judul --}}
                    <div class="form-group span2">
                        <label for="title">Judul Project *</label>
                        <input type="text" id="title" name="title"
                               class="form-control {{ $errors->has('title') ? 'is-error' : '' }}"
                               value="{{ old('title', $project->title) }}"
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
                                  placeholder="Jelaskan tentang project ini...">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tags --}}
                    <div class="form-group span2">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags"
                               class="form-control"
                               value="{{ $tagsString }}"
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
                               value="{{ old('url', $project->url) }}"
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
                               value="{{ old('github_url', $project->github_url) }}"
                               placeholder="https://github.com/user/repo">
                        @error('github_url')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-divider"></div>
                    <div class="form-section-label">Gambar Project</div>

                    {{-- Upload Gambar BARU (opsional) --}}
                    <div class="form-group span2">
                        <label class="upload-area" for="imageInput">
                            <input type="file" id="imageInput" name="image"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="upload-icon">
                                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                            <p>Klik untuk upload gambar baru <span style="color:#1D9E75;">(opsional)</span></p>
                            <span id="fileName">PNG, JPG, WEBP — Maks 2MB</span>
                        </label>

                        {{-- Preview gambar BARU (setelah user memilih file) --}}
                        <div class="img-preview" id="imgPreview" style="display: none;">
                            <img id="previewImg" src="" alt="Preview Gambar Baru">
                            <span class="img-remove-hint">*Preview gambar yang baru dipilih</span>
                        </div>

                        {{-- Menampilkan gambar LAMA (jika ada) --}}
                        @if($project->image)
                            <div class="current-img" id="currentImageWrapper">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2.18"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="22 17 15 10 2.5 22.5"/></svg>
                                <span>Gambar saat ini:</span>
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Current image" style="max-width: 80px; max-height: 60px; border-radius: 6px;">
                                <span class="form-hint" style="margin-left: auto;">Kosongkan jika tidak ingin mengubah gambar</span>
                            </div>
                        @else
                            <div class="current-img" style="background: #FEF2F2;">
                                <span>Belum ada gambar untuk project ini.</span>
                            </div>
                        @endif

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
                    Update Project
                </button>
            </div>

        </form>
    </div>

@endsection

@section('scripts')
<script>
    function previewImage(input) {
        const previewDiv = document.getElementById('imgPreview');
        const previewImg = document.getElementById('previewImg');
        const fileNameSpan = document.getElementById('fileName');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            fileNameSpan.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
                
                // Sembunyikan indikator gambar lama agar tidak membingungkan
                const oldImgWrapper = document.getElementById('currentImageWrapper');
                if(oldImgWrapper) {
                    oldImgWrapper.style.opacity = '0.5';
                    oldImgWrapper.style.filter = 'grayscale(0.3)';
                    // Tambahkan tooltip kecil
                    let hint = oldImgWrapper.querySelector('.form-hint');
                    if(hint) hint.textContent = 'Akan diganti dengan gambar baru';
                }
            };
            reader.readAsDataURL(file);
        } else {
            // Jika user membatalkan pilihan file
            previewDiv.style.display = 'none';
            previewImg.src = '';
            fileNameSpan.textContent = 'PNG, JPG, WEBP — Maks 2MB';
            
            const oldImgWrapper = document.getElementById('currentImageWrapper');
            if(oldImgWrapper) {
                oldImgWrapper.style.opacity = '1';
                oldImgWrapper.style.filter = 'none';
                let hint = oldImgWrapper.querySelector('.form-hint');
                if(hint) hint.textContent = 'Kosongkan jika tidak ingin mengubah gambar';
            }
        }
    }
</script>
@endsection