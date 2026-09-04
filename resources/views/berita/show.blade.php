@extends('layouts.app')
@section('title', $berita->judul)
@section('meta_description', $berita->excerpt)

@section('content')
<article class="max-w-3xl mx-auto px-5 sm:px-8 py-16">
    <a href="{{ route('berita.index') }}" class="text-sm text-gold-600 font-semibold">← Kembali ke Berita</a>

    @if($berita->kategori)
        <span class="inline-block mt-6 text-xs uppercase tracking-wider text-gold-600 font-semibold">{{ $berita->kategori->nama }}</span>
    @endif
    <h1 class="font-display text-3xl sm:text-4xl text-ink-800 mt-3 leading-tight">{{ $berita->judul }}</h1>
    <p class="mt-3 text-sm text-ink-400">
        {{ $berita->tanggal_publish->translatedFormat('d F Y') }}
        @if($berita->penulis) &middot; oleh {{ $berita->penulis }} @endif
        &middot; {{ $berita->views }} dilihat
    </p>

    @if($berita->thumbnail)
    <div class="mt-8 rounded-2xl overflow-hidden">
        <img src="{{ asset('storage/'.$berita->thumbnail) }}" class="w-full object-cover" alt="{{ $berita->judul }}">
    </div>
    @endif

    <div class="mt-8 prose prose-ink max-w-none text-ink-700 leading-relaxed whitespace-pre-line">{!! linkify($berita->konten) !!}</div>
</article>

@if($terkait->count())
<section class="bg-ink-50 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8">
        <h2 class="font-display text-2xl text-ink-800 mb-8">Berita Lainnya</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($terkait as $item)
            <a href="{{ route('berita.show', $item->slug) }}" class="block bg-white rounded-xl p-5 border border-ink-100 hover:shadow-lg transition">
                <h3 class="font-display text-lg text-ink-800">{{ $item->judul }}</h3>
                <p class="mt-2 text-xs text-ink-400">{{ $item->tanggal_publish->translatedFormat('d F Y') }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
