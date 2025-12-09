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
            $latestOrg = static::orderBy('id', 'desc')->first();
            
            if (!$latestOrg) {
                $model->id_organization = $prefix . '001';
            } else {
                // Ambil 3 digit terakhir
                $lastNumber = (int) substr($latestOrg->id_organization, -3);
                $newNumber = $lastNumber + 1;
                $model->id_organization = $prefix . sprintf('%03d', $newNumber);
            }
        });
    }

    public function events()
    {
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
        // Saya tambahkan 'id_organization' agar lebih pasti
        return $this->hasOne(ManagementOrganization::class, 'id_organization')->ofMany([
            'id' => 'max',
        ], function ($query) {
            $query->whereHas('period', function ($q) {
                $q->where('is_active', true);
            });
        });
    }
}