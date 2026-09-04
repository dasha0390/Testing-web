@extends('layouts.app')
@section('title', 'Profil Sekolah — ' . ($pengaturan->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Tentang Kami</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Profil {{ $pengaturan->nama_sekolah }}</h1>
    </div>
</section>

<section class="max-w-5xl mx-auto px-5 sm:px-8 py-16 space-y-16">
    <div class="grid md:grid-cols-2 gap-10">
        <div class="bg-white rounded-2xl p-8 border border-ink-100">
            <h2 class="font-display text-2xl text-ink-800 mb-3">Visi</h2>
            <p class="text-ink-600 leading-relaxed">{{ $pengaturan->visi }}</p>
        </div>
        <div class="bg-white rounded-2xl p-8 border border-ink-100">
            <h2 class="font-display text-2xl text-ink-800 mb-3">Misi</h2>
            <ul class="text-ink-600 leading-relaxed space-y-2 list-disc list-inside">
                @foreach(explode("\n", $pengaturan->misi ?? '') as $misi)
                    @if(trim($misi) !== '')
                        <li>{{ trim($misi) }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div>
        <h2 class="font-display text-3xl text-ink-800 mb-4">Sejarah Singkat</h2>
        <p class="text-ink-600 leading-relaxed whitespace-pre-line">{{ $pengaturan->sejarah }}</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
        <div class="bg-ink-50 rounded-2xl py-8">
            <p class="font-display text-3xl text-ink-800">{{ number_format($pengaturan->jumlah_siswa) }}+</p>
            <p class="text-sm text-ink-600 mt-1">Siswa Aktif</p>
        </div>
        <div class="bg-ink-50 rounded-2xl py-8">
            <p class="font-display text-3xl text-ink-800">{{ number_format($pengaturan->jumlah_guru) }}+</p>
            <p class="text-sm text-ink-600 mt-1">Guru &amp; Staff</p>
        </div>
        <div class="bg-ink-50 rounded-2xl py-8">
            <p class="font-display text-3xl text-ink-800">{{ number_format($pengaturan->jumlah_prestasi) }}+</p>
            <p class="text-sm text-ink-600 mt-1">Prestasi</p>
        </div>
        <div class="bg-ink-50 rounded-2xl py-8">
            <p class="font-display text-3xl text-ink-800">{{ $pengaturan->tahun_berdiri }}</p>
            <p class="text-sm text-ink-600 mt-1">Tahun Berdiri</p>
        </div>
    </div>

    @if($pengaturan->maps_embed)
        <div class="rounded-2xl overflow-hidden border border-ink-100 maps-embed">
            {!! $pengaturan->maps_embed !!}
        </div>
    @endif
</section>
@endsection
