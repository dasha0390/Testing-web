@extends('layouts.admin')
@section('title', 'Kategori Berita')
@section('page_title', 'Kategori Berita')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-ink-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-ink-50 text-ink-500 text-left">
                <tr><th class="px-5 py-3">Nama Kategori</th><th class="px-5 py-3">Jumlah Berita</th><th class="px-5 py-3 text-right">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-ink-50">
                @forelse($kategori as $item)
                <tr>
                    <td class="px-5 py-3 text-ink-800 font-medium">{{ $item->nama }}</td>
                    <td class="px-5 py-3 text-ink-500">{{ $item->berita_count }}</td>
                    <td class="px-5 py-3 text-right">
                        <form method="POST" action="{{ route('admin.kategori.destroy', $item) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-5 py-8 text-center text-ink-400">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="bg-white rounded-2xl border border-ink-100 p-6 h-fit">
        <h3 class="font-display text-lg text-ink-800 mb-4">Tambah Kategori</h3>
        <form method="POST" action="{{ route('admin.kategori.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama kategori" class="w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
            <button class="w-full rounded-full bg-ink-700 text-white py-2.5 font-semibold hover:bg-gold-600 transition">Tambah</button>
        </form>
    </div>
</div>
@endsection
