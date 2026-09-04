@extends('layouts.admin')
@section('title', 'Edit Guru')
@section('page_title', 'Edit Guru / Staff')

@section('content')
<form method="POST" action="{{ route('admin.guru.update', $guru) }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-3xl space-y-5">
    @csrf @method('PUT')
    @include('admin.guru._form')
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Perbarui Data</button>
</form>
@endsection
