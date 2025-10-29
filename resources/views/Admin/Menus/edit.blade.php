@extends('Admin.layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-3" style="background-color: #fff9f1;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f5e6d3;">
            <h4 class="mb-0 text-dark"><i class="fa fa-utensils me-2"></i> Edit Menu</h4>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            {{-- Tampilkan error validasi --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Menu</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                           value="{{ old('nama', $menu->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @php
                            $kats = ['Makanan','Minuman','Snack','Lainnya'];
                        @endphp
                        @foreach($kats as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $menu->kategori) == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control"
                               value="{{ old('harga', $menu->harga) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control"
                               value="{{ old('stok', $menu->stok) }}" required>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check">
                            <input type="checkbox" name="is_available" id="is_available" class="form-check-input"
                                   {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                            <label for="is_available" class="form-check-label">Tersedia untuk dijual</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    <div>
                        @if($menu->gambar && file_exists(public_path('images/menus/'.$menu->gambar)))
                            <img src="{{ asset('images/menus/'.$menu->gambar) }}" alt="Gambar Menu" width="140" class="rounded mb-2">
                        @else
                            <div class="text-muted">Belum ada gambar uploaded.</div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label for="gambar" class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    <small class="text-muted">Jenis: jpeg,png,jpg,gif. Maks 2MB.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('menus.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Batal
                    </a>

                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fa fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
