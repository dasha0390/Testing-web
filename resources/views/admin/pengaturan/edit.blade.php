@extends('layouts.admin')
@section('title', 'Pengaturan Situs')
@section('page_title', 'Pengaturan Situs')

@section('content')
<form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
    @csrf @method('PUT')

    <div class="bg-white rounded-2xl border border-ink-100 p-8 space-y-5">
        <h3 class="font-display text-lg text-ink-800">Informasi Umum</h3>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="text-sm font-medium text-ink-700">Nama Lengkap Sekolah</label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $pengaturan->nama_sekolah) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Singkatan / Nama Tampil</label>
                <input type="text" name="singkatan" value="{{ old('singkatan', $pengaturan->singkatan) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Deskripsi Singkat (tagline)</label>
            <textarea name="deskripsi_singkat" rows="2" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('deskripsi_singkat', $pengaturan->deskripsi_singkat) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="text-sm font-medium text-ink-700">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $pengaturan->alamat) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $pengaturan->telepon) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $pengaturan->email) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="text-sm font-medium text-ink-700">Logo Sekolah</label>
                <input type="file" name="logo" accept="image/*" class="mt-1.5 w-full text-sm">
                @if($pengaturan->logo)<img src="{{ asset('storage/'.$pengaturan->logo) }}" class="mt-2 h-16 w-16 rounded-full object-cover">@endif
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Foto Hero Beranda</label>
                <input type="file" name="hero_image" accept="image/*" class="mt-1.5 w-full text-sm">
                @if($pengaturan->hero_image)<img src="{{ asset('storage/'.$pengaturan->hero_image) }}" class="mt-2 h-16 rounded-lg object-cover">@endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-ink-100 p-8 space-y-5">
        <h3 class="font-display text-lg text-ink-800">Profil Sekolah</h3>
        <div>
            <label class="text-sm font-medium text-ink-700">Visi</label>
            <textarea name="visi" rows="2" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('visi', $pengaturan->visi) }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Misi <span class="text-ink-400 font-normal">(satu baris = satu poin misi)</span></label>
            <textarea name="misi" rows="4" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('misi', $pengaturan->misi) }}</textarea>
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Sejarah Singkat</label>
            <textarea name="sejarah" rows="5" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('sejarah', $pengaturan->sejarah) }}</textarea>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            <div>
                <label class="text-sm font-medium text-ink-700">Jumlah Siswa</label>
                <input type="number" name="jumlah_siswa" value="{{ old('jumlah_siswa', $pengaturan->jumlah_siswa) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Jumlah Guru</label>
                <input type="number" name="jumlah_guru" value="{{ old('jumlah_guru', $pengaturan->jumlah_guru) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Jumlah Prestasi</label>
                <input type="number" name="jumlah_prestasi" value="{{ old('jumlah_prestasi', $pengaturan->jumlah_prestasi) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Tahun Berdiri</label>
                <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri', $pengaturan->tahun_berdiri) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-ink-100 p-8 space-y-5">
        <h3 class="font-display text-lg text-ink-800">Media Sosial &amp; Peta</h3>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="text-sm font-medium text-ink-700">Facebook (URL)</label>
                <input type="text" name="facebook" value="{{ old('facebook', $pengaturan->facebook) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Instagram (URL)</label>
                <input type="text" name="instagram" value="{{ old('instagram', $pengaturan->instagram) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">YouTube (URL)</label>
                <input type="text" name="youtube" value="{{ old('youtube', $pengaturan->youtube) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-ink-700">Kode Embed Google Maps</label>
            <textarea name="maps_embed" rows="3" placeholder="<iframe src='...'></iframe>" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('maps_embed', $pengaturan->maps_embed) }}</textarea>
        </div>
    </div>

    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Simpan Pengaturan</button>
</form>
@endsection
