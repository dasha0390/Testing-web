<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'gambar', 'judul', 'subjudul', 'tombol_teks', 'tombol_link', 'urutan', 'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function getGambarUrlAttribute(): string
    {
        return asset('storage/' . $this->gambar);
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeTerurut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}
