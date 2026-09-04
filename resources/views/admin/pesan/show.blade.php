@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')

@section('content')
<div class="bg-white rounded-2xl border border-ink-100 p-8 max-w-2xl">
    <a href="{{ route('admin.pesan.index') }}" class="text-sm text-gold-600 font-semibold">← Kembali</a>
    <h2 class="font-display text-2xl text-ink-800 mt-4">{{ $pesan->subjek ?: 'Tanpa Subjek' }}</h2>
    <p class="mt-2 text-sm text-ink-500">Dari <strong>{{ $pesan->nama }}</strong> ({{ $pesan->email }}) — {{ $pesan->created_at->format('d F Y, H:i') }}</p>
    <div class="mt-6 p-5 bg-ink-50 rounded-xl text-ink-700 leading-relaxed whitespace-pre-line">{{ $pesan->pesan }}</div>
    <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="mt-6 inline-flex rounded-full bg-ink-700 text-white px-6 py-3 text-sm font-semibold hover:bg-gold-600 transition">Balas via Email</a>
</div>
@endsection
