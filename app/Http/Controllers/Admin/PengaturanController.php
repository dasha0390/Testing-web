<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function edit()
    {
        $pengaturan = Pengaturan::current();

        return view('admin.pengaturan.edit', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $pengaturan = Pengaturan::current();

        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'singkatan' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'maps_embed' => ['nullable', 'string'],
            'jumlah_siswa' => ['nullable', 'integer'],
            'jumlah_guru' => ['nullable', 'integer'],
            'jumlah_prestasi' => ['nullable', 'integer'],
            'tahun_berdiri' => ['nullable', 'integer'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'hero_image' => ['nullable', 'image', 'max:3072'],
        ]);

        if ($request->hasFile('logo')) {
            if ($pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }
            $data['logo'] = $request->file('logo')->store('pengaturan', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($pengaturan->hero_image) {
                Storage::disk('public')->delete($pengaturan->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('pengaturan', 'public');
        }

        $pengaturan->update($data);

        return back()->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
