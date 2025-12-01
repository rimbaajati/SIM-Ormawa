<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Izinkan kolom-kolom ini diisi
    protected $fillable = [
        'judul',
        'isi',
        'ringkasan',
        'gambar',
        'user_id'
    ];

    // Relasi: Berita dimiliki oleh User (Penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}