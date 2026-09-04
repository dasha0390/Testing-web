<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = KategoriBerita::withCount('berita')->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama' => ['required', 'string', 'max:255']]);
        $data['slug'] = Str::slug($data['nama']);

        KategoriBerita::create($data);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(KategoriBerita $kategori)
    {
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
