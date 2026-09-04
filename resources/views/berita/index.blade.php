@extends('layouts.app')
@section('title', 'Berita — ' . ($pengaturanGlobal->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Kabar Sekolah</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Berita &amp; Kegiatan</h1>
    </div>
</section>

<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16">
    @if($berita->count())
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($berita as $item)
        <a href="{{ route('berita.show', $item->slug) }}" class="group block bg-white rounded-2xl overflow-hidden border border-ink-100 hover:shadow-xl transition">
            <div class="aspect-[4/3] bg-ink-100 overflow-hidden">
                @if($item->thumbnail)
                    <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $item->judul }}">
                @else
                    <div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-4xl">Aa</div>
                @endif
            </div>
            <div class="p-6">
                @if($item->kategori)
                <span class="text-xs uppercase tracking-wider text-gold-600 font-semibold">{{ $item->kategori->nama }}</span>
                @endif
                <h3 class="mt-2 font-display text-xl text-ink-800 leading-snug group-hover:text-gold-600 transition">{{ $item->judul }}</h3>
                <p class="mt-2 text-sm text-ink-600 line-clamp-2">{{ $item->excerpt }}</p>
                <p class="mt-4 text-xs text-ink-400">{{ $item->tanggal_publish->translatedFormat('d F Y') }} &middot; {{ $item->views }} dilihat</p>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-12">{{ $berita->links() }}</div>
    @else
    <p class="text-ink-500 text-center py-20">Belum ada berita yang dipublikasikan.</p>
    @endif
</section>
@endsection
