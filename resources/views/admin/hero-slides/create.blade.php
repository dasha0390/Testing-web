@extends('layouts.admin')
@section('title', 'Tambah Slide Hero')
@section('page_title', 'Tambah Slide Hero')

@section('content')
<form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-xl space-y-5">
    @csrf
    <div>
        <label class="text-sm font-medium text-ink-700">Gambar Slide <span class="text-red-500">*</span></label>
        <input type="file" name="gambar" accept="image/*" class="mt-1.5 w-full text-sm" required>
        <p class="mt-1 text-xs text-ink-400">Disarankan ukuran landscape (mis. 1600×900 px).</p>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Judul</label>
        <input type="text" name="judul" value="{{ old('judul') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" placeholder="Contoh: Penerimaan Siswa Baru 2026">
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Subjudul / Deskripsi</label>
        <textarea name="subjudul" rows="3" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" placeholder="Teks singkat yang mendampingi gambar">{{ old('subjudul') }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium text-ink-700">Teks Tombol</label>
            <input type="text" name="tombol_teks" value="{{ old('tombol_teks') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" placeholder="Daftar Sekarang">
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Link Tombol</label>
            <input type="text" name="tombol_link" value="{{ old('tombol_link') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" placeholder="/kontak">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium text-ink-700">Urutan Tampil</label>
            <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm font-medium text-ink-700">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }} class="rounded border-ink-300 text-gold-500 focus:ring-gold-500">
                Tampilkan slide ini
            </label>
        </div>
    </div>
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Simpan Slide</button>
</form>
@endsection
