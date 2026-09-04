<header x-data="{ open: false }" class="sticky top-0 z-50 bg-paper/90 backdrop-blur border-b border-ink-100">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @if($pengaturanGlobal->logo ?? false)
                    <img src="{{ asset('storage/'.$pengaturanGlobal->logo) }}" alt="Logo" class="h-11 w-11 rounded-full object-cover">
                @else
                    <span class="h-11 w-11 rounded-full bg-ink-700 text-gold-100 flex items-center justify-center font-display text-lg">
                        {{ mb_substr($pengaturanGlobal->singkatan ?? 'S', 0, 1) }}
                    </span>
                @endif
                <div class="leading-tight">
                    <p class="font-display text-lg text-ink-800">{{ $pengaturanGlobal->singkatan ?? 'Sekolah Kita' }}</p>
                    <p class="text-[11px] tracking-widest uppercase text-ink-600/70">Berprestasi &amp; Berkarakter</p>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-ink-700">
                <a href="{{ route('home') }}" class="hover:text-gold-600 transition {{ request()->routeIs('home') ? 'text-gold-600' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="hover:text-gold-600 transition {{ request()->routeIs('profil') ? 'text-gold-600' : '' }}">Profil Sekolah</a>
                <a href="{{ route('berita.index') }}" class="hover:text-gold-600 transition {{ request()->routeIs('berita.*') ? 'text-gold-600' : '' }}">Berita</a>
                <a href="{{ route('pengumuman.index') }}" class="hover:text-gold-600 transition {{ request()->routeIs('pengumuman.*') ? 'text-gold-600' : '' }}">Pengumuman</a>
                <a href="{{ route('galeri.index') }}" class="hover:text-gold-600 transition {{ request()->routeIs('galeri.*') ? 'text-gold-600' : '' }}">Galeri</a>
                <a href="{{ route('guru.index') }}" class="hover:text-gold-600 transition {{ request()->routeIs('guru.*') ? 'text-gold-600' : '' }}">Guru &amp; Staff</a>
                <a href="{{ route('kontak.index') }}" class="ml-2 inline-flex items-center rounded-full bg-ink-700 text-white px-5 py-2.5 hover:bg-gold-600 transition">Kontak</a>
            </nav>

            <button @click="open = !open" class="lg:hidden p-2 text-ink-700" aria-label="Buka menu">
                <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <nav x-show="open" x-cloak class="lg:hidden pb-5 flex flex-col gap-4 text-sm font-medium text-ink-700">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('profil') }}">Profil Sekolah</a>
            <a href="{{ route('berita.index') }}">Berita</a>
            <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
            <a href="{{ route('galeri.index') }}">Galeri</a>
            <a href="{{ route('guru.index') }}">Guru &amp; Staff</a>
            <a href="{{ route('kontak.index') }}" class="inline-flex w-fit items-center rounded-full bg-ink-700 text-white px-5 py-2.5">Kontak</a>
        </nav>
    </div>
</header>
