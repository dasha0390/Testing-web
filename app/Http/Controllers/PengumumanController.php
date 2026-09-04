<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::published()->latest('tanggal')->paginate(10);

        return view('pengumuman.index', compact('pengumuman'));
    }

    public function show(string $slug)
    {
        $pengumuman = Pengumuman::published()->where('slug', $slug)->firstOrFail();

        return view('pengumuman.show', compact('pengumuman'));
    }
}
