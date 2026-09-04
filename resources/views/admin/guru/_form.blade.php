<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="text-sm font-medium text-ink-700">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama', $guru?->nama ?? '') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">NIP (opsional)</label>
        <input type="text" name="nip" value="{{ old('nip', $guru?->nip ?? '') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
    </div>
</div>
<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="text-sm font-medium text-ink-700">Jabatan</label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $guru?->jabatan ?? '') }}" placeholder="Guru / Kepala Sekolah / dsb" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Mata Pelajaran</label>
        <input type="text" name="mapel" value="{{ old('mapel', $guru?->mapel ?? '') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
    </div>
</div>
<div>
    <label class="text-sm font-medium text-ink-700">Urutan Tampil</label>
    <input type="number" name="urutan" value="{{ old('urutan', $guru?->urutan ?? 0) }}" class="mt-1.5 w-32 rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
</div>
<div>
    <label class="text-sm font-medium text-ink-700">Foto</label>
    <input type="file" name="foto" accept="image/*" class="mt-1.5 w-full text-sm">
    @if(isset($guru) && $guru->foto)
        <img src="{{ asset('storage/'.$guru->foto) }}" class="mt-2 h-20 w-20 rounded-lg object-cover">
    @endif
</div>
<div>
    <label class="text-sm font-medium text-ink-700">Deskripsi Singkat</label>
    <textarea name="deskripsi" rows="4" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">{{ old('deskripsi', $guru?->deskripsi ?? '') }}</textarea>
</div>
