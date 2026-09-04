@extends('layouts.admin')
@section('title', 'Unggah Foto Galeri')
@section('page_title', 'Unggah Foto Galeri')

@section('content')
<form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-xl space-y-5">
    @csrf
    <div>
        <label class="text-sm font-medium text-ink-700">Judul Foto</label>
        <input type="text" name="judul" value="{{ old('judul') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Kategori</label>
        <select name="kategori" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            <option value="kegiatan">Kegiatan</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="prestasi">Prestasi</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Foto</label>
        <input type="file" name="gambar" accept="image/*" class="mt-1.5 w-full text-sm" required>
    </div>
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Unggah</button>
</form>
@endsection
