<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
    ];

    // Tambahan: Agar saat dipanggil frontend, URL gambarnya sudah lengkap
    // Contoh output: http://localhost:8000/storage/berita/foto.jpg
    protected $appends = ['gambar_url'];

    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return url('storage/' . $this->gambar);
        }
        return null;
    }
}