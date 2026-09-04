<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\KategoriBerita;
use App\Models\Pengaturan;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::firstOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Pengaturan default
        Pengaturan::current();

        // Kategori berita
        $kategoriData = ['Akademik', 'Prestasi', 'Kegiatan', 'Pengumuman Umum'];
        $kategoris = collect($kategoriData)->map(function ($nama) {
            return KategoriBerita::firstOrCreate(['slug' => Str::slug($nama)], ['nama' => $nama]);
        });

        // Contoh berita
        $contohBerita = [
            [
                'judul' => 'Penerimaan Peserta Didik Baru Tahun Ajaran 2026/2027 Resmi Dibuka',
                'konten' => "Sekolah kami dengan bangga mengumumkan bahwa pendaftaran Peserta Didik Baru (PPDB) untuk tahun ajaran 2026/2027 telah resmi dibuka. Calon siswa dapat mendaftar secara online melalui website sekolah mulai hari ini.\n\nProses seleksi akan mempertimbangkan nilai rapor, prestasi non-akademik, serta hasil tes wawancara. Panitia PPDB siap membantu calon siswa dan orang tua yang membutuhkan informasi lebih lanjut melalui kontak yang tertera di halaman ini.\n\nKami mengundang seluruh calon siswa terbaik untuk bergabung dan menjadi bagian dari keluarga besar sekolah kami.",
            ],
            [
                'judul' => 'Tim Olimpiade Sains Sekolah Raih Juara 1 Tingkat Provinsi',
                'konten' => "Prestasi membanggakan kembali ditorehkan oleh siswa-siswi sekolah kami. Tim Olimpiade Sains berhasil meraih Juara 1 pada ajang Olimpiade Sains Nasional (OSN) tingkat provinsi yang diselenggarakan minggu lalu.\n\nKeberhasilan ini merupakan hasil kerja keras siswa, bimbingan guru pembina, serta dukungan penuh dari seluruh warga sekolah. Selanjutnya, tim akan melaju ke babak final tingkat nasional.\n\nSelamat kepada seluruh siswa yang telah berjuang dan mengharumkan nama sekolah!",
            ],
            [
                'judul' => 'Kegiatan Class Meeting Semester Ganjil Berlangsung Meriah',
                'konten' => "Menyambut akhir semester ganjil, sekolah menggelar rangkaian kegiatan Class Meeting yang diikuti oleh seluruh siswa dari berbagai jenjang kelas. Kegiatan ini meliputi pertandingan olahraga, lomba kesenian, dan berbagai perlombaan kreatif lainnya.\n\nKegiatan ini bertujuan untuk mempererat kebersamaan antar siswa sekaligus menjadi ajang penyaluran bakat dan minat di luar kegiatan akademik.",
            ],
        ];

        foreach ($contohBerita as $i => $item) {
            Berita::firstOrCreate(
                ['slug' => Str::slug($item['judul'])],
                [
                    'judul' => $item['judul'],
                    'kategori_berita_id' => $kategoris->random()->id,
                    'konten' => $item['konten'],
                    'penulis' => 'Admin Sekolah',
                    'tanggal_publish' => now()->subDays($i * 3),
                    'status' => 'published',
                    'views' => rand(50, 500),
                ]
            );
        }

        // Contoh pengumuman
        $contohPengumuman = [
            'Jadwal Ujian Akhir Semester Ganjil 2026',
            'Libur Sekolah dalam Rangka Hari Raya',
            'Pengumuman Kelulusan Kelas XII',
        ];

        foreach ($contohPengumuman as $i => $judul) {
            Pengumuman::firstOrCreate(
                ['slug' => Str::slug($judul)],
                [
                    'judul' => $judul,
                    'konten' => 'Diberitahukan kepada seluruh siswa, orang tua, dan wali murid mengenai informasi penting terkait '.strtolower($judul).'. Mohon untuk memperhatikan jadwal dan ketentuan yang berlaku. Informasi lebih lanjut dapat menghubungi pihak sekolah.',
                    'tanggal' => now()->subDays($i * 5),
                    'status' => 'published',
                ]
            );
        }

        // Contoh guru
        $contohGuru = [
            ['nama' => 'Drs. Ahmad Sutrisno, M.Pd', 'jabatan' => 'Kepala Sekolah', 'mapel' => '-'],
            ['nama' => 'Siti Nurhaliza, S.Pd', 'jabatan' => 'Wakil Kepala Sekolah', 'mapel' => 'Matematika'],
            ['nama' => 'Budi Hartono, S.Pd', 'jabatan' => 'Guru', 'mapel' => 'Bahasa Indonesia'],
            ['nama' => 'Rina Wijaya, S.Pd', 'jabatan' => 'Guru', 'mapel' => 'Bahasa Inggris'],
            ['nama' => 'Andi Saputra, S.Kom', 'jabatan' => 'Guru', 'mapel' => 'Informatika'],
            ['nama' => 'Dewi Lestari, S.Pd', 'jabatan' => 'Guru', 'mapel' => 'Biologi'],
        ];

        foreach ($contohGuru as $i => $g) {
            Guru::firstOrCreate(['nama' => $g['nama']], [
                'jabatan' => $g['jabatan'],
                'mapel' => $g['mapel'],
                'deskripsi' => 'Berdedikasi dalam mendidik dan membimbing siswa untuk mencapai prestasi terbaik.',
                'urutan' => $i,
            ]);
        }
    }
}
