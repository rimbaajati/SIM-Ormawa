<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use App\Models\JenisSurat;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_organization',
        'id_jenis_surat',
        'tujuan_organization_id',
        'kepada', 
        'tanggal',
        'perihal',
        'file'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'id_organization', 'id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat', 'id');
    }
}