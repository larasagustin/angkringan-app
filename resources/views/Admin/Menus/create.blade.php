@extends('Admin.layouts.app')

@section('title', 'Tambah Menu Baru')

@section('content')
<style>
    body {
        background-color: #fff9f1 !important;
    }

    .form-container {
        background: #fff9f1;
        border-radius: 15px;
        padding: 30px 40px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: auto;
    }

    .form-title {
        font-weight: 700;
        color: #5a3e1b;
        margin-bottom: 25px;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
        color: #5a3e1b;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #d1bfa3;
        background-color: #fffdfa;
        transition: 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f0b86e;
        box-shadow: 0 0 0 0.15rem rgba(240,184,110,0.3);
    }

    .btn-submit {
        background-color: #f4c27f;
        color: #4b2e06;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 20px;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background-color: #f0b86e;
    }

    .btn-cancel {
        background-color: #e97a7a;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 20px;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        background-color: #d86363;
    }
</style>

<div class="form-container mt-4">
    <h4 class="form-title"><i class="fa fa-utensils me-2"></i>Tambah Menu Baru</h4>

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Menu</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama menu..." required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Snack">Snack</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga menu..." required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan stok menu..." required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Tulis deskripsi menu..."></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Menu (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_available" id="is_available" class="form-check-input">
            <label for="is_available" class="form-check-label">Tersedia untuk dijual</label>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('menus.index') }}" class="btn-cancel">
                <i class="fa fa-arrow-left me-1"></i> Batal
            </a>
            <button type="submit" class="btn-submit">
                <i class="fa fa-save me-1"></i> Simpan Menu
            </button>
        </div>
    </form>
</div>
@endsection
