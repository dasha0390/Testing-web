@extends('layouts.app')
@section('title', 'Galeri — ' . ($pengaturanGlobal->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Dokumentasi</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Galeri Sekolah</h1>
    </div>
</section>

<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16">
    @if($galeri->count())
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach($galeri as $item)
        <div class="group relative aspect-square rounded-xl overflow-hidden bg-ink-100">
            <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $item->judul }}">
            <div class="absolute inset-0 bg-gradient-to-t from-ink-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-3">
                <div>
                    <p class="text-white text-sm font-semibold">{{ $item->judul }}</p>
                    <p class="text-gold-300 text-xs uppercase tracking-wide">{{ $item->kategori }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-12">{{ $galeri->links() }}</div>
    @else
    <p class="text-ink-500 text-center py-20">Belum ada foto di galeri.</p>
    @endif
</section>
@endsection
