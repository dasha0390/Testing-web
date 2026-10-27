@extends('layouts.app')

@section('title', ($pengaturan->nama_sekolah ?? 'Sekolah') . ' — Beranda')
@section('meta_description', $pengaturan->deskripsi_singkat ?? '')

@section('content')

{{-- HERO --}}
@php
    $heroItems = collect();
    if ($pengaturan->hero_bg_video || $pengaturan->hero_image) {
        $heroItems->push((object)[
            'tipe' => 'utama',
            'video' => $pengaturan->hero_bg_video,
            'gambar' => $pengaturan->hero_image,
        ]);
    }
    foreach ($heroSlides as $slide) {
        $heroItems->push((object)[
            'tipe' => 'slide',
            'video' => null,
            'gambar' => $slide->gambar,
            'judul' => $slide->judul,
            'subjudul' => $slide->subjudul,
            'tombol_teks' => $slide->tombol_teks,
            'tombol_link' => $slide->tombol_link,
        ]);
    }
@endphp

<section x-data="heroCarousel({{ $heroItems->count() ?: 1 }})" x-init="start()" class="relative overflow-hidden bg-ink-800 min-h-[520px] lg:min-h-[640px]">
    @forelse($heroItems as $i => $item)
        <div x-show="active === {{ $i }}" x-transition.opacity.duration.700ms class="absolute inset-0" {{ $i === 0 ? '' : 'x-cloak' }}>
            @if($item->tipe === 'utama' && $item->video)
                <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
                    <source src="{{ asset('storage/'.$item->video) }}" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-ink-800/70"></div>
            @elseif($item->tipe === 'utama' && $item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" alt="" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-ink-800/70"></div>
            @elseif($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" alt="" class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px); background-size: 22px 22px;"></div>
            @endif
        </div>
    @empty
        <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px); background-size: 22px 22px;"></div>
    @endforelse

    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-20 lg:py-28 grid lg:grid-cols-5 gap-12 items-center relative min-h-[520px] lg:min-h-[640px]">
        @if($heroItems->isNotEmpty())
            @foreach($heroItems as $i => $item)
                <div x-show="active === {{ $i }}" x-transition.opacity.duration.700ms class="contents" {{ $i === 0 ? '' : 'x-cloak' }}>
                    @if($item->tipe === 'utama')
                        <div class="lg:col-span-5 fade-up text-center max-w-3xl mx-auto">
                            <span class="inline-flex items-center gap-2 text-gold-400 text-xs tracking-[0.2em] uppercase font-semibold">
                                <span class="h-px w-8 bg-gold-400"></span> Sejak {{ $pengaturan->tahun_berdiri ?? '—' }}
                            </span>
                            <h1 class="mt-5 font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.08]">
                                Welcome to Eagle School
                            </h1>
                            <p class="mt-6 text-ink-100/90 text-lg mx-auto leading-relaxed" style="font-family:'Poppins',sans-serif;">
                                {{ $pengaturan->deskripsi_singkat }}
                            </p>
                            <div class="mt-8 flex flex-wrap gap-4 justify-center">
                                <a href="{{ route('profil') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-7 py-3.5 hover:bg-gold-400 transition">Kenali Sekolah Kami</a>
                                <a href="{{ route('kontak.index') }}" class="rounded-full border border-white/30 text-white px-7 py-3.5 hover:bg-white/10 transition">Hubungi Kami</a>
                            </div>
                        </div>
                    @else
                        <div class="lg:col-span-5 fade-up text-center max-w-3xl mx-auto">
                            @if($item->judul)
                                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.08]">{{ $item->judul }}</h1>
                            @endif
                            @if($item->subjudul)
                                <p class="mt-6 text-ink-100/90 text-lg leading-relaxed">{{ $item->subjudul }}</p>
                            @endif
                            @if($item->tombol_teks)
                                <a href="{{ $item->tombol_link ?: '#' }}" class="mt-8 inline-block rounded-full bg-gold-500 text-ink-800 font-semibold px-7 py-3.5 hover:bg-gold-400 transition">{{ $item->tombol_teks }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="lg:col-span-5 fade-up text-center max-w-3xl mx-auto">
                <span class="inline-flex items-center gap-2 text-gold-400 text-xs tracking-[0.2em] uppercase font-semibold">
                    <span class="h-px w-8 bg-gold-400"></span> Sejak {{ $pengaturan->tahun_berdiri ?? '—' }}
                </span>
                <h1 class="mt-5 font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.08]">
                    Welcome to Eagle School
                </h1>
                <p class="mt-6 text-ink-100/90 text-lg mx-auto leading-relaxed" style="font-family:'Poppins',sans-serif;">
                    {{ $pengaturan->deskripsi_singkat }}
                </p>
                <div class="mt-8 flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('profil') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-7 py-3.5 hover:bg-gold-400 transition">Kenali Sekolah Kami</a>
                    <a href="{{ route('kontak.index') }}" class="rounded-full border border-white/30 text-white px-7 py-3.5 hover:bg-white/10 transition">Hubungi Kami</a>
                </div>
            </div>
        @endif
    </div>

    @if($heroItems->count() > 1)
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            <template x-for="n in total" :key="n">
                <button @click="go(n - 1)" :class="active === (n - 1) ? 'w-8 bg-gold-500' : 'w-3 bg-white/50'" class="h-3 rounded-full transition-all duration-300" :aria-label="'Ke slide ' + n"></button>
            </template>
        </div>
        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center backdrop-blur" aria-label="Sebelumnya">‹</button>
        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center backdrop-blur" aria-label="Berikutnya">›</button>
    @endif
</section>

<script>
function heroCarousel(total) {
    return {
        active: 0,
        total: total,
        timer: null,
        start() {
            if (this.total <= 1) return;
            this.timer = setInterval(() => this.next(), 15000);
        },
        go(i) {
            this.active = (i + this.total) % this.total;
            this.restart();
        },
        next() { this.go(this.active + 1); },
        prev() { this.go(this.active - 1); },
        restart() {
            clearInterval(this.timer);
            this.timer = setInterval(() => this.next(), 6000);
        }
    }
}
</script>
<style>[x-cloak]{display:none!important}</style>

{{-- PENGUMUMAN BERJALAN --}}
@if($pengumumanTerbaru->count())
<div class="bg-gold-500 text-ink-800 overflow-hidden">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-2.5 flex items-center gap-4 text-sm font-medium">
        <span class="shrink-0 uppercase tracking-widest text-xs font-bold bg-ink-800 text-gold-400 px-3 py-1 rounded-full">Pengumuman</span>
        <div class="flex gap-10 overflow-x-auto no-scrollbar whitespace-nowrap">
            @foreach($pengumumanTerbaru as $p)
                <a href="{{ route('pengumuman.show', $p->slug) }}" class="hover:underline">{{ $p->judul }}</a>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- GALERI PREVIEW --}}
@if($galeriTerbaru->count())
<section class="bg-ink-700 py-20">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Dokumentasi</span>
                <h2 class="font-display text-3xl sm:text-4xl text-white mt-2">Momen di Sekolah Kami</h2>
            </div>
            <a href="{{ route('galeri.index') }}" class="hidden sm:inline-flex text-sm font-semibold text-white hover:text-gold-400">Lihat galeri lengkap →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galeriTerbaru as $g)
            <div class="aspect-square rounded-xl overflow-hidden bg-white/10">
                <img src="{{ asset('storage/'.$g->gambar) }}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="{{ $g->judul }}">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="max-w-7xl mx-auto px-5 sm:px-8 pt-20 pb-24">
    <div class="rounded-3xl bg-gold-500 px-8 py-14 sm:px-16 text-center">
        <h2 class="font-display text-3xl sm:text-4xl text-ink-800">Tertarik Bergabung dengan Kami?</h2>
        <p class="mt-3 text-ink-800/80 max-w-xl mx-auto">Tim kami siap membantu menjawab pertanyaan seputar pendaftaran dan program sekolah.</p>
        <a href="{{ route('kontak.index') }}" class="mt-7 inline-flex rounded-full bg-ink-800 text-white px-8 py-3.5 font-semibold hover:bg-ink-700 transition">Hubungi Kami Sekarang</a>
    </div>
</section>

<style>.no-scrollbar::-webkit-scrollbar{display:none}.no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}</style>
@endsection
