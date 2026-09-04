<div>
    <label class="text-sm font-medium text-ink-700">Judul Pengumuman</label>
    <input type="text" name="judul" value="{{ old('judul', $pengumuman?->judul ?? '') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
</div>
<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="text-sm font-medium text-ink-700">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', isset($pengumuman) ? $pengumuman->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Status</label>
        <select name="status" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            <option value="draft" @selected(old('status', $pengumuman?->status ?? 'draft') === 'draft')>Draft</option>
            <option value="published" @selected(old('status', $pengumuman?->status ?? '') === 'published')>Terbitkan</option>
        </select>
    </div>
</div>
<div>
    <label class="text-sm font-medium text-ink-700">Lampiran (opsional)</label>
    <input type="file" name="file" class="mt-1.5 w-full text-sm">
    @if(isset($pengumuman) && $pengumuman->file)
        <a href="{{ asset('storage/'.$pengumuman->file) }}" target="_blank" class="text-xs text-gold-600 underline">Lihat lampiran saat ini</a>
    @endif
</div>
<div>
    <label class="text-sm font-medium text-ink-700">Isi Pengumuman</label>
    <textarea name="konten" rows="8" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>{{ old('konten', $pengumuman?->konten ?? '') }}</textarea>
</div>
