@extends('layouts.admin')

@section('title', 'Manajemen Achievement')
@section('page-title', 'Achievement & Sertifikat')

@section('content')
<div class="content">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h2>Manajemen Achievement</h2>
            <p>Kelola semua sertifikat dan penghargaan yang telah kamu dapatkan.</p>
        </div>
        <a href="{{ route('admin.achievements.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Achievement
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card">
        <div class="card-header">
            <span class="card-header-title">
                Semua Achievement
                <span style="margin-left:8px; font-size:11px; font-weight:400; color:#aaa;">
                    ({{ $achievements->total() }} data)
                </span>
            </span>
            <div class="search-input">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="searchInput" placeholder="Cari achievement...">
            </div>
        </div>

        <table id="achievementTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($achievements as $achievement)
                <tr>
                    <td style="color:#bbb; font-size:12px;">{{ $loop->iteration }}</td>

                    <td>
                        @if($achievement->image)
                            <img src="{{ asset('storage/'.$achievement->image) }}"
                                 alt="{{ $achievement->title }}"
                                 class="achievement-thumb">
                        @else
                            <div class="no-img">
                                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                    </td>

                    <td class="td-title">{{ $achievement->title }}</td>
                    <td class="td-issuer">{{ $achievement->issuer ?? '—' }}</td>
                    <td class="td-date">{{ $achievement->formatted_date }}</td>

                    <td>
                        @if($achievement->category)
                            <span class="tag">{{ $achievement->category }}</span>
                        @else
                            <span style="color:#ccc; font-size:12px;">—</span>
                        @endif
                    </td>

                    <td class="td-link">
                        @if($achievement->link)
                            <a href="{{ $achievement->link }}" target="_blank">
                                <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                Lihat
                            </a>
                        @else
                            <span style="color:#ccc; font-size:12px;">—</span>
                        @endif
                    </td>

                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.achievements.edit', $achievement->id) }}" class="btn-edit">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.achievements.destroy', $achievement->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus achievement ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                            </div>
                            <h3>Belum ada achievement</h3>
                            <p>Mulai tambahkan sertifikat atau penghargaan pertama kamu.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($achievements->hasPages())
        <div class="pagination">
            <span>Menampilkan {{ $achievements->firstItem() }}–{{ $achievements->lastItem() }} dari {{ $achievements->total() }} achievement</span>
            <div class="pag-links">{{ $achievements->links() }}</div>
        </div>
        @endif

    </div>{{-- /card --}}
</div>{{-- /content --}}
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
    .btn-primary svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2.5; }

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

    /* Card */
    .card {
        background: #fff;
        border: 1px solid #E8E8E3;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        padding: 14px 20px;
        border-bottom: 1px solid #F0F0EB;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-title { font-size: 14px; font-weight: 500; color: #1a1a1a; }

    .search-input {
        display: flex; align-items: center; gap: 8px;
        padding: 7px 12px;
        border: 1px solid #E0E0DB;
        border-radius: 8px;
        background: #F5F5F0;
        font-size: 13px; color: #555;
    }

    .search-input svg { width: 14px; height: 14px; stroke: #aaa; fill: none; stroke-width: 2; }
    .search-input input {
        border: none; background: transparent; outline: none;
        font-size: 13px; color: #333; font-family: inherit;
        width: 180px;
    }

    /* Table */
    table { width: 100%; border-collapse: collapse; }

    thead th {
        padding: 10px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 500;
        color: #999;
        text-transform: uppercase;
        letter-spacing: .06em;
        background: #FAFAF8;
        border-bottom: 1px solid #F0F0EB;
        white-space: nowrap;
    }

    tbody tr {
        border-bottom: 1px solid #F5F5F0;
        transition: background .1s;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #FAFAF8; }

    tbody td {
        padding: 12px 16px;
        font-size: 13px;
        color: #333;
        vertical-align: middle;
    }

    .td-title  { font-weight: 500; color: #1a1a1a; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .td-issuer { color: #666; max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 12px; }
    .td-date   { font-size: 12px; color: #888; white-space: nowrap; }

    .achievement-thumb {
        width: 52px; height: 40px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #E8E8E3;
        display: block;
    }

    .no-img {
        width: 52px; height: 40px;
        background: #F0F0EB;
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
    }

    .no-img svg { width: 16px; height: 16px; stroke: #bbb; fill: none; stroke-width: 2; }

    .tag {
        display: inline-block;
        padding: 2px 8px;
        background: #F0F0EB;
        color: #555;
        border-radius: 20px;
        font-size: 11px;
    }

    .td-link a {
        color: #1D9E75;
        text-decoration: none;
        font-size: 12px;
        display: inline-flex; align-items: center; gap: 4px;
    }

    .td-link a:hover { text-decoration: underline; }
    .td-link a svg { width: 11px; height: 11px; stroke: currentColor; fill: none; stroke-width: 2; }

    /* Action buttons */
    .action-group { display: flex; align-items: center; gap: 6px; }

    .btn-edit, .btn-delete {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid;
        transition: background .12s, color .12s;
    }

    .btn-edit {
        background: #F0FAF6; color: #0F6E56;
        border-color: #A5DECA;
    }

    .btn-edit:hover { background: #E1F5EE; }

    .btn-delete {
        background: #FEF2F2; color: #B91C1C;
        border-color: #FECACA;
    }

    .btn-delete:hover { background: #FEE2E2; }

    .btn-edit svg, .btn-delete svg {
        width: 12px; height: 12px;
        stroke: currentColor; fill: none; stroke-width: 2.5;
    }

    /* Empty state */
    .empty-state {
        padding: 48px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 52px; height: 52px;
        background: #F0F0EB;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }

    .empty-icon svg { width: 24px; height: 24px; stroke: #bbb; fill: none; stroke-width: 2; }
    .empty-state h3 { font-size: 15px; font-weight: 500; color: #555; margin-bottom: 6px; }
    .empty-state p  { font-size: 13px; color: #aaa; }

    /* Pagination */
    .pagination {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 20px;
        border-top: 1px solid #F0F0EB;
        font-size: 12px; color: #888;
        flex-wrap: wrap; gap: 8px;
    }

    .pag-links { display: flex; gap: 4px; }

    @media (max-width: 768px) {
        .td-title  { max-width: 120px; }
        .td-issuer { max-width: 100px; }
        .search-input input { width: 130px; }
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#achievementTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endsection