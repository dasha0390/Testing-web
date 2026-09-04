<?php

namespace App\Http\Controllers;

use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::orderBy('urutan')->get();

        return view('guru.index', compact('guru'));
    }
}
