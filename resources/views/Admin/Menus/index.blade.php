@extends('Admin.layouts.app')

@section('title', 'Kelola Menu Angkringan')

@section('content')
<style>
    /* Warna latar lembut (cream) */
    body {
        background-color: #fff9f1 !important;
    }

    .table-container {
        background: #fff9f1;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .table th {
        background-color: #f4e1c1;
        color: #5a3e1b;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-add {
        background-color: #f4c27f;
        color: #4b2e06;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 16px;
        transition: 0.2s;
    }

    .btn-add:hover {
        background-color: #f0b86e;
    }

    .btn-edit {
        background-color: #ffd580;
        color: #4b2e06;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .btn-edit:hover {
        background-color: #ffc65c;
    }

    .btn-delete {
        background-color: #ddb680ff;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .btn-delete:hover {
        background-color: #d86363;
    }

    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-bar input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 8px;
    }

    .search-bar button {
        background-color: #d8a25a;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .search-bar button:hover {
        background-color: #c8924d;
    }
</style>

<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-brown">Kelola Menu Angkringan</h4>
        <a href="{{ route('menus.create') }}" class="btn-add">
            <i class="fa fa-plus me-1"></i> Tambah Menu
        </a>
    </div>

<div class="search-bar mb-3 d-flex align-items-center">
    <form action="{{ route('menus.index') }}" method="GET" class="d-flex w-100" role="search">
        <input 
            type="text" 
            name="search" 
            class="form-control me-2" 
            placeholder="Cari nama menu..." 
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-warning text-white fw-bold">
            <i class="fa fa-search me-1"></i> Cari
        </button>
    </form>
</div>


    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $index => $menu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>{{ $menu->stok }}</td>
                    <td>
<a href="{{ route('menus.edit', $menu->id) }}" 
   class="btn btn-sm d-inline-flex align-items-center justify-content-center"
   style="width:42px; height:42px; border-radius:10px; background-color:#f5d7a1; color:#6b4e16;">
    <i class="fa fa-pen"></i>
</a>


<form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button" 
        class="btn btn-sm btn-delete d-inline-flex align-items-center justify-content-center"
        style="width:42px; height:42px; border-radius:10px; background-color:#e0b98a; color:#fff;"
        data-nama="{{ $menu->nama }}">
        <i class="fa fa-trash"></i>
    </button>
</form>


                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        Belum ada data menu.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-end mt-3">
        <small class="text-secondary">
            Total: {{ $menus->count() }} menu
        </small>
    </div>
</div>
@endsection
{{-- CDN SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const namaMenu = this.dataset.nama;

            Swal.fire({
                title: 'Hapus Menu?',
                text: `Yakin ingin menghapus "${namaMenu}"? Data ini tidak bisa dikembalikan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

