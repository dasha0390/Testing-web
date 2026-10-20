@extends('layouts.admin')
@section('title', 'Kelola Slide Hero')
@section('page_title', 'Slide Hero Beranda')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-sm text-ink-500">Tambahkan informasi berupa gambar yang akan tampil bergantian (auto-slide) di bagian hero beranda.</p>
        <a href="{{ route('admin.hero-slides.create') }}" class="rounded-full bg-ink-700 text-white px-6 py-3 font-semibold hover:bg-gold-600 transition">+ Tambah Slide</a>
    </div>

    <div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
        @if($slides->count())
        <table class="w-full text-sm">
            <thead class="bg-ink-50 text-ink-600 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Urutan</th>
                    <th class="px-5 py-3 font-medium">Gambar</th>
                    <th class="px-5 py-3 font-medium">Judul</th>
                    <th class="px-5 py-3 font-medium">Tombol</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100">
                @foreach($slides as $slide)
                <tr>
                    <td class="px-5 py-3 text-ink-500">{{ $slide->urutan }}</td>
                    <td class="px-5 py-3">
                        @if($slide->gambar)
                            <img src="{{ $slide->gambar_url }}" alt="" class="h-12 w-20 object-cover rounded-lg">
                        @else
                            <span class="text-ink-300">—</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 font-medium text-ink-800">{{ $slide->judul ?? '—' }}</td>
                    <td class="px-5 py-3 text-ink-500">{{ $slide->tombol_teks ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($slide->aktif)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full">Aktif</span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-ink-400 bg-ink-100 px-2.5 py-1 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="text-gold-600 font-semibold hover:underline mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" class="inline" onsubmit="return confirm('Hapus slide ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 font-semibold hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-10 text-center text-ink-400">Belum ada slide hero. Klik "Tambah Slide" untuk mulai.</div>
        @endif
    </div>
</div>
@endsection
