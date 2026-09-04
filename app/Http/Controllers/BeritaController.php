<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::published()->with('kategori')->latest('tanggal_publish')->paginate(9);
        $kategori = KategoriBerita::all();

        return view('berita.index', compact('berita', 'kategori'));
    }

    public function show(string $slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();
        $berita->increment('views');

        $terkait = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }
}
