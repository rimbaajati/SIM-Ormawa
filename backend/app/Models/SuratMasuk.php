<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use App\Models\JenisSurat;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_organization',
        'id_jenis_surat',
        'tanggal',
        'asal',
        'perihal',
        'file'
    ];

    // Agar tanggal otomatis jadi objek Carbon (mudah diformat)
    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke Organisasi
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'id_organization', 'id');
    }

    // Relasi ke Jenis Surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat', 'id');
    }
}