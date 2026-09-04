<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\Pesan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita' => Berita::count(),
            'pengumuman' => Pengumuman::count(),
            'galeri' => Galeri::count(),
            'guru' => Guru::count(),
            'pesan_baru' => Pesan::where('dibaca', false)->count(),
        ];

        $beritaTerbaru = Berita::latest()->take(5)->get();
        $pesanTerbaru = Pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'beritaTerbaru', 'pesanTerbaru'));
    }
}
