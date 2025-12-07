<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    // 1. Pastikan id_organization masuk ke fillable
    protected $fillable = [
        'id_organization', 
        'name',
        'logo',
        'deskripsi',
        'ketua',
        'kontak',
        'email',
        'instagram',
        'is_active',
    ];
    // 2. Tambahkan logika otomatisasi ID di sini
    protected static function booted()
    {
        static::creating(function ($model) {
            // Tentukan Prefix
            $prefix = 'UKM-';
            
            // Cari data terakhir untuk melihat nomor terakhir
            $latestOrg = static::orderBy('id', 'desc')->first();

            if (!$latestOrg) {
                // Jika belum ada data, mulai dari UKM-001
                $model->id_organization = $prefix . '001';
            } else {
                // Jika sudah ada, ambil nomor terakhir (misal UKM-015)
                // Ambil 3 karakter terakhir, ubah jadi integer
                $lastNumber = (int) substr($latestOrg->id_organization, -3);
                // Tambah 1
                $newNumber = $lastNumber + 1;
                // Gabungkan lagi: UKM- + 016
                $model->id_organization = $prefix . sprintf('%03d', $newNumber);
            }
        });
    }
}