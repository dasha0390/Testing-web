@extends('layouts.admin')
@section('title', 'Kelola Berita')
@section('page_title', 'Kelola Berita')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berita..." class="rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500 text-sm">
        <button class="rounded-xl bg-ink-100 px-4 text-sm text-ink-700">Cari</button>
    </form>
    <a href="{{ route('admin.berita.create') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-5 py-2.5 text-sm hover:bg-gold-400">+ Tulis Berita</a>
</div>

<div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-ink-50 text-ink-500 text-left">
            <tr>
                <th class="px-5 py-3">Judul</th>
                <th class="px-5 py-3">Kategori</th>
                <th class="px-5 py-3">Tanggal</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Dilihat</th>
                <th class="px-5 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-ink-50">
            @forelse($berita as $item)
            <tr>
                <td class="px-5 py-3 text-ink-800 font-medium max-w-xs truncate">{{ $item->judul }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->kategori->nama ?? '-' }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->tanggal_publish->format('d/m/Y') }}</td>
                <td class="px-5 py-3">
                    <span class="px-2.5 py-1 rounded-full text-xs {{ $item->status === 'published' ? 'bg-green-50 text-green-600' : 'bg-ink-50 text-ink-500' }}">{{ $item->status }}</span>
                </td>
                <td class="px-5 py-3 text-ink-500">{{ $item->views }}</td>
                <td class="px-5 py-3 text-right space-x-2 whitespace-nowrap">
                    <a href="{{ route('berita.show', $item->slug) }}" target="_blank" class="text-ink-400 hover:text-ink-700">Lihat</a>
                    <a href="{{ route('admin.berita.edit', $item) }}" class="text-gold-600 font-medium hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.berita.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-8 text-center text-ink-400">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $berita->links() }}</div>
@endsection
