@extends('layouts.admin')
@section('title', 'Kelola Guru & Staff')
@section('page_title', 'Kelola Guru & Staff')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.guru.create') }}" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-5 py-2.5 text-sm hover:bg-gold-400">+ Tambah Guru</a>
</div>

<div class="bg-white rounded-2xl border border-ink-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-ink-50 text-ink-500 text-left">
            <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Jabatan</th><th class="px-5 py-3">Mapel</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-ink-50">
            @forelse($guru as $item)
            <tr>
                <td class="px-5 py-3 text-ink-800 font-medium">{{ $item->nama }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->jabatan }}</td>
                <td class="px-5 py-3 text-ink-500">{{ $item->mapel ?: '-' }}</td>
                <td class="px-5 py-3 text-right space-x-2 whitespace-nowrap">
                    <a href="{{ route('admin.guru.edit', $item) }}" class="text-gold-600 font-medium hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.guru.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus data guru ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-8 text-center text-ink-400">Belum ada data guru.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $guru->links() }}</div>
@endsection
