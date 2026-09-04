@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.galeri.create') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-5 py-2.5 text-sm hover:bg-gold-400">+ Unggah Foto</a>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
    @forelse($galeri as $item)
    <div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
        <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full aspect-square object-cover">
        <div class="p-3">
            <p class="text-sm font-medium text-ink-800 truncate">{{ $item->judul }}</p>
            <p class="text-xs text-ink-500">{{ $item->kategori }}</p>
            <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini?')" class="mt-2">
                @csrf @method('DELETE')
                <button class="text-xs text-red-500 hover:underline">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <p class="col-span-full text-center text-ink-400 py-12">Belum ada foto di galeri.</p>
    @endforelse
</div>
<div class="mt-6">{{ $galeri->links() }}</div>
@endsection
