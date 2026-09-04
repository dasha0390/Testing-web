<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = [
        'nama_sekolah', 'singkatan', 'alamat', 'telepon', 'email',
        'deskripsi_singkat', 'visi', 'misi', 'sejarah', 'logo', 'hero_image',
        'facebook', 'instagram', 'youtube', 'maps_embed',
        'jumlah_siswa', 'jumlah_guru', 'jumlah_prestasi', 'tahun_berdiri',
    ];

    /**
     * Ambil satu-satunya baris pengaturan situs (buat default jika belum ada).
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'nama_sekolah' => 'SMA Negeri Harapan Bangsa',
            'singkatan' => 'SMAN Harapan Bangsa',
            'alamat' => 'Jl. Pendidikan No. 1, Jakarta',
            'telepon' => '(021) 1234-5678',
            'email' => 'info@smaharapanbangsa.sch.id',
            'deskripsi_singkat' => 'Mencetak generasi unggul, berkarakter, dan berdaya saing global.',
            'visi' => 'Menjadi sekolah unggul yang menghasilkan lulusan berprestasi, berakhlak mulia, dan siap bersaing di era global.',
            'misi' => "Menyelenggarakan pembelajaran yang aktif, kreatif, dan menyenangkan.\nMengembangkan potensi siswa melalui kegiatan akademik dan non-akademik.\nMenumbuhkan karakter disiplin, jujur, dan bertanggung jawab.",
            'sejarah' => 'Sekolah ini didirikan dengan semangat mencerdaskan kehidupan bangsa dan terus berkembang menjadi lembaga pendidikan terpercaya.',
            'jumlah_siswa' => 850,
            'jumlah_guru' => 60,
            'jumlah_prestasi' => 120,
            'tahun_berdiri' => 1985,
        ]);
    }
}
