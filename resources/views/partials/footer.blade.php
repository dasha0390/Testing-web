<footer class="bg-ink-800 text-ink-100 mt-24">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-16 grid gap-10 md:grid-cols-4">
        <div class="md:col-span-2">
            <p class="font-display text-2xl text-white">{{ $pengaturanGlobal->nama_sekolah ?? 'Nama Sekolah' }}</p>
            <p class="mt-3 text-sm text-ink-200 max-w-sm leading-relaxed">{{ $pengaturanGlobal->deskripsi_singkat ?? '' }}</p>
            <div class="mt-5 flex gap-3">
                @if($pengaturanGlobal->facebook ?? false)
                <a href="{{ $pengaturanGlobal->facebook }}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">FB</a>
                @endif
                @if($pengaturanGlobal->instagram ?? false)
                <a href="{{ $pengaturanGlobal->instagram }}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">IG</a>
                @endif
                @if($pengaturanGlobal->youtube ?? false)
                <a href="{{ $pengaturanGlobal->youtube }}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">YT</a>
                @endif
            </div>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-gold-500 mb-4">Navigasi</p>
            <ul class="space-y-2 text-sm text-ink-200">
                <li><a href="{{ route('profil') }}" class="hover:text-white">Profil Sekolah</a></li>
                <li><a href="{{ route('berita.index') }}" class="hover:text-white">Berita</a></li>
                <li><a href="{{ route('pengumuman.index') }}" class="hover:text-white">Pengumuman</a></li>
                <li><a href="{{ route('galeri.index') }}" class="hover:text-white">Galeri</a></li>
                <li><a href="{{ route('guru.index') }}" class="hover:text-white">Guru &amp; Staff</a></li>
            </ul>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-gold-500 mb-4">Kontak</p>
            <ul class="space-y-2 text-sm text-ink-200 leading-relaxed">
                <li>{{ $pengaturanGlobal->alamat ?? '' }}</li>
                <li>{{ $pengaturanGlobal->telepon ?? '' }}</li>
                <li>{{ $pengaturanGlobal->email ?? '' }}</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 py-5 text-center text-xs text-ink-300">
        &copy; {{ date('Y') }} {{ $pengaturanGlobal->nama_sekolah ?? 'Sekolah' }}. Seluruh hak cipta dilindungi.
        <a href="{{ route('login') }}" class="ml-2 text-ink-400 hover:text-gold-400">Login Admin</a>
    </div>
</footer>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
