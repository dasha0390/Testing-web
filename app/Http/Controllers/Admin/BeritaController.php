<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with('kategori')->latest();

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%'.$request->q.'%');
        }

        $berita = $query->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();

        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = $this->generateSlug($data['judul']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $kategori = KategoriBerita::all();

        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->validateData($request, $berita->id);

        if ($data['judul'] !== $berita->judul) {
            $data['slug'] = $this->generateSlug($data['judul'], $berita->id);
        }

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori_berita_id' => ['nullable', 'exists:kategori_beritas,id'],
            'konten' => ['required', 'string'],
            'penulis' => ['nullable', 'string', 'max:255'],
            'tanggal_publish' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function generateSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i = 1;

        while (Berita::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
