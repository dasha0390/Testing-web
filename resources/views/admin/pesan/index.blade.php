@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page_title', 'Pesan Masuk dari Pengunjung')

@section('content')
<div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-ink-50 text-ink-500 text-left">
            <tr><th class="px-5 py-3">Pengirim</th><th class="px-5 py-3">Subjek</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-ink-50">
            @forelse($pesan as $item)
            <tr class="{{ !$item->dibaca ? 'bg-gold-50/40' : '' }}">
                <td class="px-5 py-3 text-ink-800 font-medium">{{ $item->nama }}<br><span class="text-xs text-ink-400">{{ $item->email }}</span></td>
                <td class="px-5 py-3 text-ink-600">{{ $item->subjek ?: '-' }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-5 py-3"><span class="px-2.5 py-1 rounded-full text-xs {{ $item->dibaca ? 'bg-ink-50 text-ink-500' : 'bg-gold-100 text-gold-600' }}">{{ $item->dibaca ? 'Dibaca' : 'Baru' }}</span></td>
                <td class="px-5 py-3 text-right space-x-2 whitespace-nowrap">
                    <a href="{{ route('admin.pesan.show', $item) }}" class="text-gold-600 font-medium hover:underline">Baca</a>
                    <form method="POST" action="{{ route('admin.pesan.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-8 text-center text-ink-400">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $pesan->links() }}</div>
@endsection
