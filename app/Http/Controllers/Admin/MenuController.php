<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
public function index(Request $request)
{
    $query = Menu::query();

    // Fitur cari
    if ($request->has('search') && !empty($request->search)) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $menus = $query->latest()->paginate(10);

    return view('admin.menus.index', compact('menus'));
}



    public function create()
    {
        $kategories = ['Makanan', 'Minuman', 'Snack', 'Lainnya'];
        return view('admin.menus.create', compact('kategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambarName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/menus'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        Menu::create($data);

        return redirect()->route('menus.index')
                        ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

public function edit(Menu $menu)
{
    $kategories = ['Makanan', 'Minuman', 'Snack', 'Lainnya'];
    return view('Admin.Menus.edit', compact('menu', 'kategories'));
}

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar && file_exists(public_path('images/menus/' . $menu->gambar))) {
                unlink(public_path('images/menus/' . $menu->gambar));
            }
            
            $gambarName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/menus'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        $menu->update($data);

        return redirect()->route('menus.index')
                        ->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy(Menu $menu)
    {
        // Hapus gambar jika ada
        if ($menu->gambar && file_exists(public_path('images/menus/' . $menu->gambar))) {
            unlink(public_path('images/menus/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('menus.index')
                        ->with('success', 'Menu berhasil dihapus!');
    }
}