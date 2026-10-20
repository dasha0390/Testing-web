<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::terurut()->get();

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar' => ['required', 'image', 'max:5120'],
            'judul' => ['nullable', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string', 'max:500'],
            'tombol_teks' => ['nullable', 'string', 'max:100'],
            'tombol_link' => ['nullable', 'string', 'max:255'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'aktif' => ['nullable', 'boolean'],
        ]);

        $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');
        $data['urutan'] = $request->input('urutan', 0);
        $data['aktif'] = $request->boolean('aktif');

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'gambar' => ['nullable', 'image', 'max:5120'],
            'judul' => ['nullable', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string', 'max:500'],
            'tombol_teks' => ['nullable', 'string', 'max:100'],
            'tombol_link' => ['nullable', 'string', 'max:255'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'aktif' => ['nullable', 'boolean'],
            'remove_gambar' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_gambar') && !$request->hasFile('gambar')) {
            if ($heroSlide->gambar) {
                Storage::disk('public')->delete($heroSlide->gambar);
            }
            $data['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($heroSlide->gambar) {
                Storage::disk('public')->delete($heroSlide->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');
        }

        $data['urutan'] = $request->input('urutan', $heroSlide->urutan);
        $data['aktif'] = $request->boolean('aktif');

        unset($data['remove_gambar']);

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->gambar) {
            Storage::disk('public')->delete($heroSlide->gambar);
        }
        $heroSlide->delete();

        return back()->with('success', 'Slide hero berhasil dihapus.');
    }
}
