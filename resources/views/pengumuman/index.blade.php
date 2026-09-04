@extends('layouts.app')
@section('title', 'Pengumuman — ' . ($pengaturanGlobal->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Informasi Resmi</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Pengumuman</h1>
    </div>
</section>

<section class="max-w-3xl mx-auto px-5 sm:px-8 py-16">
    @if($pengumuman->count())
    <div class="space-y-4">
        @foreach($pengumuman as $item)
        <a href="{{ route('pengumuman.show', $item->slug) }}" class="flex items-start gap-5 bg-white p-6 rounded-2xl border border-ink-100 hover:shadow-lg transition">
            <div class="shrink-0 w-16 text-center bg-gold-50 rounded-xl py-2">
                <p class="font-display text-xl text-ink-800">{{ $item->tanggal->format('d') }}</p>
                <p class="text-[11px] uppercase text-ink-500">{{ $item->tanggal->translatedFormat('M Y') }}</p>
            </div>
            <div>
                <h3 class="font-display text-lg text-ink-800">{{ $item->judul }}</h3>
                <p class="mt-1 text-sm text-ink-600 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 140) }}</p>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-12">{{ $pengumuman->links() }}</div>
    @else
    <p class="text-ink-500 text-center py-20">Belum ada pengumuman.</p>
    @endif
</section>
@endsection
