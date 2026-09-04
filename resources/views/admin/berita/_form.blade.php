<div>
    <label class="text-sm font-medium text-ink-700">Judul Berita</label>
    <input type="text" name="judul" value="{{ old('judul', $berita?->judul ?? '') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
</div>

<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="text-sm font-medium text-ink-700">Kategori</label>
        <select name="kategori_berita_id" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            <option value="">— Tanpa kategori —</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}" @selected(old('kategori_berita_id', $berita?->kategori_berita_id ?? '') == $k->id)>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Penulis</label>
        <input type="text" name="penulis" value="{{ old('penulis', $berita?->penulis ?? 'Admin Sekolah') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
    </div>
</div>

<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="text-sm font-medium text-ink-700">Tanggal Publikasi</label>
        <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', isset($berita) ? $berita->tanggal_publish->format('Y-m-d') : now()->format('Y-m-d')) }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
    </div>
    <div>
        <label class="text-sm font-medium text-ink-700">Status</label>
        <select name="status" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            <option value="draft" @selected(old('status', $berita?->status ?? 'draft') === 'draft')>Draft</option>
            <option value="published" @selected(old('status', $berita?->status ?? '') === 'published')>Terbitkan</option>
        </select>
    </div>
</div>

<div>
    <label class="text-sm font-medium text-ink-700">Thumbnail</label>
    <input type="file" name="thumbnail" accept="image/*" class="mt-1.5 w-full text-sm">
    @if(isset($berita) && $berita->thumbnail)
        <img src="{{ asset('storage/'.$berita->thumbnail) }}" class="mt-2 h-24 rounded-lg object-cover">
    @endif
</div>

<div>
    <label class="text-sm font-medium text-ink-700">Konten Berita</label>
    <textarea name="konten" rows="10" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>{{ old('konten', $berita?->konten ?? '') }}</textarea>
</div>
