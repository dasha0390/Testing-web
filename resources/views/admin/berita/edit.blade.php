@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('page_title', 'Edit Berita')

@section('content')
<form method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-3xl space-y-5">
    @csrf @method('PUT')
    @include('admin.berita._form')
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Perbarui Berita</button>
</form>
@endsection
