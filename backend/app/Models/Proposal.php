<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Karena kita hanya butuh satu, kita asumsikan Organization adalah Ormawa
use App\Models\Organization; 
// use App\Models\Ormawa; // Hapus impor yang tidak perlu

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'organization_id',
        // 'activity_name', 'date', 'ormawa_id' - tambahkan field lain sesuai tabel kamu
    ];

    /**
     * Relasi ke Ormawa/Organization.
     * Menggunakan nama 'ormawa' agar sesuai dengan panggilan di Controller/View.
     * MENGGUNAKAN foreign key 'organization_id'.
     */
    public function ormawa()
{
    return $this->belongsTo(Ormawa::class); 
}

    /*
    // HAPUS relasi organization() yang duplikat
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    */
}