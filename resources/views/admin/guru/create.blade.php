@extends('layouts.admin')
@section('title', 'Tambah Guru')
@section('page_title', 'Tambah Guru / Staff')

@section('content')
<form method="POST" action="{{ route('admin.guru.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-ink-100 p-8 max-w-3xl space-y-5">
    @csrf
    @include('admin.guru._form', ['guru' => null])
    <button class="rounded-full bg-ink-700 text-white px-8 py-3 font-semibold hover:bg-gold-600 transition">Simpan Data</button>
</form>
@endsection
