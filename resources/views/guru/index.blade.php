@extends('layouts.app')
@section('title', 'Guru & Staff — ' . ($pengaturanGlobal->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Tim Kami</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Guru &amp; Staff</h1>
    </div>
</section>

<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16">
    @if($guru->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($guru as $item)
        <div class="text-center">
            <div class="aspect-square rounded-2xl overflow-hidden bg-ink-100 mb-4">
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                @else
                    <div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-3xl">{{ mb_substr($item->nama,0,1) }}</div>
                @endif
            </div>
            <p class="font-display text-lg text-ink-800">{{ $item->nama }}</p>
            <p class="text-sm text-gold-600">{{ $item->jabatan }}</p>
            @if($item->mapel && $item->mapel !== '-')
                <p class="text-xs text-ink-500 mt-1">{{ $item->mapel }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <p class="text-ink-500 text-center py-20">Belum ada data guru.</p>
    @endif
</section>
@endsection
