<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'slug', 'kategori_berita_id', 'thumbnail', 'konten',
        'penulis', 'tanggal_publish', 'status', 'views',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getExcerptAttribute(): string
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->konten), 150);
    }
}
