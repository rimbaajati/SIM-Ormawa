<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\ManagementOrganization; 
use App\Models\Period;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    // --- PERBAIKAN 1: KONFIGURASI PRIMARY KEY ---
    // Karena kita pakai 'id_organization' (String), bukan 'id' (Integer)
    protected $primaryKey = 'id_organization';
    public $incrementing = false;
    protected $keyType = 'string';
    // --------------------------------------------

    protected $fillable = [
        'id_organization', 
        'name',
        'full_name',
        'logo',
        'deskripsi',
        // --- Catatan: Field di bawah ini nanti bisa dihapus jika sudah full pindah ke tabel management ---
        'visi',
        'misi',
        'ketua',
        'pembimbing',
        // -----------------------------------------------------------------------------------------------
        'kontak',
        'email',
        'instagram',
        'is_active',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $prefix = 'UKM-';
            
            // --- PERBAIKAN 2: LOGIKA GENERATE ID ---
            // Error sebelumnya terjadi di sini karena mencari 'id'. 
            // Kita ubah menjadi urutkan berdasarkan 'id_organization'.
            $latestOrg = static::orderBy('id_organization', 'desc')->first();
            
            if (!$latestOrg) {
                $model->id_organization = $prefix . '001';
            } else {
                // Ambil 3 digit terakhir dari id_organization (bukan id)
                $lastNumber = (int) substr($latestOrg->id_organization, -3);
                $newNumber = $lastNumber + 1;
                $model->id_organization = $prefix . sprintf('%03d', $newNumber);
            }
        });
    }

    public function events()
    {
        // Pastikan relasi merujuk ke id_organization
        return $this->hasMany(Event::class, 'id_organization');
    }

    // 1. Relasi ke SEMUA riwayat kepengurusan
    public function managements()
    {
        return $this->hasMany(ManagementOrganization::class, 'id_organization');
    }

    // 2. Relasi KHUSUS kepengurusan yang sedang AKTIF sekarang
    public function currentManagement()
    {
        return $this->hasOne(ManagementOrganization::class, 'id_organization')->ofMany([
            'id' => 'max', // Ini OK pakai 'id' tabel management (karena tabel management masih punya id auto increment)
        ], function ($query) {
            $query->whereHas('period', function ($q) {
                $q->where('is_active', true);
            });
        });
    }
}