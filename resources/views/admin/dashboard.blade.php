@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
    @php
        $cards = [
            ['label' => 'Berita', 'value' => $stats['berita'], 'icon' => '📰', 'color' => 'bg-ink-700'],
            ['label' => 'Pengumuman', 'value' => $stats['pengumuman'], 'icon' => '📢', 'color' => 'bg-gold-500'],
            ['label' => 'Foto Galeri', 'value' => $stats['galeri'], 'icon' => '🖼️', 'color' => 'bg-ink-600'],
            ['label' => 'Guru & Staff', 'value' => $stats['guru'], 'icon' => '👩‍🏫', 'color' => 'bg-ink-700'],
            ['label' => 'Pesan Baru', 'value' => $stats['pesan_baru'], 'icon' => '✉️', 'color' => 'bg-red-500'],
        ];
    @endphp
    @foreach($cards as $c)
    <div class="bg-white rounded-2xl border border-ink-100 p-5">
        <span class="h-10 w-10 rounded-xl {{ $c['color'] }} text-white flex items-center justify-center text-lg">{{ $c['icon'] }}</span>
        <p class="font-display text-3xl text-ink-800 mt-4">{{ $c['value'] }}</p>
        <p class="text-sm text-ink-500">{{ $c['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-ink-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display text-lg text-ink-800">Berita Terbaru</h2>
            <a href="{{ route('admin.berita.index') }}" class="text-xs font-semibold text-gold-600">Lihat semua</a>
        </div>
        <div class="space-y-3">
            @forelse($beritaTerbaru as $b)
            <div class="flex items-center justify-between text-sm py-2 border-b border-ink-50 last:border-0">
                <span class="text-ink-700 truncate pr-4">{{ $b->judul }}</span>
                <span class="shrink-0 px-2.5 py-1 rounded-full text-xs {{ $b->status === 'published' ? 'bg-green-50 text-green-600' : 'bg-ink-50 text-ink-500' }}">{{ $b->status }}</span>
            </div>
            @empty
            <p class="text-ink-400 text-sm">Belum ada berita.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-ink-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display text-lg text-ink-800">Pesan Masuk Terbaru</h2>
            <a href="{{ route('admin.pesan.index') }}" class="text-xs font-semibold text-gold-600">Lihat semua</a>
        </div>
        <div class="space-y-3">
            @forelse($pesanTerbaru as $p)
            <a href="{{ route('admin.pesan.show', $p) }}" class="flex items-center justify-between text-sm py-2 border-b border-ink-50 last:border-0 hover:text-gold-600">
                <span class="text-ink-700 truncate pr-4">{{ $p->nama }} — {{ $p->subjek ?: 'Tanpa subjek' }}</span>
                @if(!$p->dibaca)<span class="shrink-0 h-2 w-2 rounded-full bg-red-500"></span>@endif
            </a>
            @empty
            <p class="text-ink-400 text-sm">Belum ada pesan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
