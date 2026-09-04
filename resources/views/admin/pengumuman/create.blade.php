@extends('layouts.admin')
@section('title', 'Buat Pengumuman')
@section('page_title', 'Buat Pengumuman')

@section('content')
<form method="POST" action="{{ route('admin.pengumuman.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-3xl space-y-5">
    @csrf
    @include('admin.pengumuman._form', ['pengumuman' => null])
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Simpan Pengumuman</button>
</form>
@endsection
