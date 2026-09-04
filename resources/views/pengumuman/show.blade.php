@extends('layouts.app')
@section('title', $pengumuman->judul)

@section('content')
<article class="max-w-3xl mx-auto px-5 sm:px-8 py-16">
    <a href="{{ route('pengumuman.index') }}" class="text-sm text-gold-600 font-semibold">← Kembali ke Pengumuman</a>
    <h1 class="font-display text-3xl sm:text-4xl text-ink-800 mt-6 leading-tight">{{ $pengumuman->judul }}</h1>
    <p class="mt-3 text-sm text-ink-400">{{ $pengumuman->tanggal->translatedFormat('d F Y') }}</p>

    <div class="mt-8 prose prose-ink max-w-none text-ink-700 leading-relaxed whitespace-pre-line">{!! linkify($pengumuman->konten) !!}</div>

    @if($pengumuman->file)
    <a href="{{ asset('storage/'.$pengumuman->file) }}" target="_blank" class="mt-8 inline-flex items-center gap-2 rounded-full bg-ink-700 text-white px-6 py-3 text-sm font-semibold hover:bg-gold-600 transition">
        📎 Unduh Lampiran
    </a>
    @endif
</article>
@endsection
