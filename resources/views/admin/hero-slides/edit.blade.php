@extends('layouts.admin')
@section('title', 'Edit Slide Hero')
@section('page_title', 'Edit Slide Hero')

@section('content')
<form method="POST" action="{{ route('admin.hero-slides.update', $heroSlide) }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-xl space-y-5">
    @csrf @method('PUT')
    <div>
        <label class="text-sm font-medium text-ink-700">Gambar Slide Saat Ini</label>
        @if($heroSlide->gambar)
            <div class="mt-2 flex items-center gap-4">
                <img src="{{ $heroSlide->gambar_url }}" alt="" class="h-28 w-48 object-cover rounded-xl border border-ink-100">
                <label class="flex items-center gap-2 text-sm text-ink-500">
                    <input type="checkbox" name="remove_gambar" value="1" class="rounded border-ink-300 text-red-500 focus:ring-red-500">
                    Hapus gambar
                </label>
            </div>
        @else
            <p class="mt-1 text-xs text-ink-400">Belum ada gambar.</p>
        @endif
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*" class="mt-1.5 w-full text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $heroSlide->judul) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Subjudul / Deskripsi</label>
        <textarea name="subjudul" rows="3" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('subjudul', $heroSlide->subjudul) }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium text-ink-700">Teks Tombol</label>
            <input type="text" name="tombol_teks" value="{{ old('tombol_teks', $heroSlide->tombol_teks) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Link Tombol</label>
            <input type="text" name="tombol_link" value="{{ old('tombol_link', $heroSlide->tombol_link) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium text-ink-700">Urutan Tampil</label>
            <input type="number" name="urutan" value="{{ old('urutan', $heroSlide->urutan) }}" min="0" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm font-medium text-ink-700">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $heroSlide->aktif) ? 'checked' : '' }} class="rounded border-ink-300 text-gold-500 focus:ring-gold-500">
                Tampilkan slide ini
            </label>
        </div>
    </div>
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Simpan Perubahan</button>
</form>
@endsection
