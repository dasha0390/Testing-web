<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Pesan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::current();

        return view('kontak.index', compact('pengaturan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subjek' => ['nullable', 'string', 'max:255'],
            'pesan' => ['required', 'string'],
        ]);

        Pesan::create($data);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }
}
