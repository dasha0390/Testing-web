@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')
@section('page_title', 'Kelola Pengumuman')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.pengumuman.create') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-5 py-2.5 text-sm hover:bg-gold-400">+ Buat Pengumuman</a>
</div>

<div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-ink-50 text-ink-500 text-left">
            <tr><th class="px-5 py-3">Judul</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-ink-50">
            @forelse($pengumuman as $item)
            <tr>
                <td class="px-5 py-3 text-ink-800 font-medium">{{ $item->judul }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->tanggal->format('d/m/Y') }}</td>
                <td class="px-5 py-3"><span class="px-2.5 py-1 rounded-full text-xs {{ $item->status === 'published' ? 'bg-green-50 text-green-600' : 'bg-ink-50 text-ink-500' }}">{{ $item->status }}</span></td>
                <td class="px-5 py-3 text-right space-x-2 whitespace-nowrap">
                    <a href="{{ route('pengumuman.show', $item->slug) }}" target="_blank" class="text-ink-400 hover:text-ink-700">Lihat</a>
                    <a href="{{ route('admin.pengumuman.edit', $item) }}" class="text-gold-600 font-medium hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-8 text-center text-ink-400">Belum ada pengumuman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $pengumuman->links() }}</div>
@endsection
