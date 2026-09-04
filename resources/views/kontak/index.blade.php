@extends('layouts.app')
@section('title', 'Kontak — ' . ($pengaturan->nama_sekolah ?? ''))

@section('content')
<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Kami Siap Membantu</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Hubungi Kami</h1>
    </div>
</section>

<section class="max-w-6xl mx-auto px-5 sm:px-8 py-16 grid lg:grid-cols-5 gap-12">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-ink-100">
            <p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Alamat</p>
            <p class="text-ink-700">{{ $pengaturan->alamat }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-ink-100">
            <p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Telepon</p>
            <p class="text-ink-700">{{ $pengaturan->telepon }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-ink-100">
            <p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Email</p>
            <p class="text-ink-700">{{ $pengaturan->email }}</p>
        </div>
        @if($pengaturan->maps_embed)
        <div class="rounded-2xl overflow-hidden border border-ink-100 maps-embed">
            {!! $pengaturan->maps_embed !!}
        </div>
        @endif
    </div>

    <div class="lg:col-span-3">
        @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 text-green-700 px-5 py-4 text-sm">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('kontak.store') }}" class="bg-white p-8 rounded-2xl border border-ink-100 space-y-5">
            @csrf
            <div>
                <label class="text-sm font-medium text-ink-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Subjek</label>
                <input type="text" name="subjek" value="{{ old('subjek') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500">
            </div>
            <div>
                <label class="text-sm font-medium text-ink-700">Pesan</label>
                <textarea name="pesan" rows="5" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>{{ old('pesan') }}</textarea>
                @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="rounded-full bg-ink-700 text-white px-8 py-3.5 font-semibold hover:bg-gold-600 transition">Kirim Pesan</button>
        </form>
    </div>
</section>
@endsection
