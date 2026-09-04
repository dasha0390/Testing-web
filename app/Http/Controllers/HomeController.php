<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Pengaturan;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::current();
        $beritaTerbaru = Berita::published()->latest('tanggal_publish')->take(3)->get();
        $pengumumanTerbaru = Pengumuman::published()->latest('tanggal')->take(5)->get();
        $galeriTerbaru = Galeri::latest()->take(8)->get();
        $guruUnggulan = Guru::orderBy('urutan')->take(4)->get();

        return view('home.index', compact(
            'pengaturan', 'beritaTerbaru', 'pengumumanTerbaru', 'galeriTerbaru', 'guruUnggulan'
        ));
    }

    public function profil()
    {
        $pengaturan = Pengaturan::current();

        return view('home.profil', compact('pengaturan'));
    }
}
