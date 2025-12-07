<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_proposal',
        'organization_id',
        'user_id',
        'judul',
        'deskripsi',
        'waktu',
        'tempat',
        'file_proposal',
        'anggaran',
        'status',
        'catatan_revisi',
        'approved_by',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'anggaran' => 'decimal:2',
    ];

    // ================= LOGIC NOMOR OTOMATIS =================
    protected static function booted()
    {
        static::creating(function ($model) {
            // 1. Ambil data Organisasi Pengaju
            // Kita cari organisasi berdasarkan organization_id yang dikirim dari form
            $organization = Organization::find($model->organization_id);
            
            // Ambil kodenya (misal: UKM-001), jika error/notfound kasih default 'ORG'
            $orgCode = $organization ? $organization->id_organization : 'ORG';

            // 2. Cari Proposal Terakhir DARI ORGANISASI INI SAJA
            // Kita filter 'where organization_id' agar nomor urutnya reset per organisasi
            $latestProposal = static::where('organization_id', $model->organization_id)
                                    ->latest('id')
                                    ->first();

            if (!$latestProposal) {
                // Jika ini proposal pertama organisasi tersebut
                $sequence = '001';
            } else {
                // 3. Ambil nomor terakhir
                // Format di database: UKM-001/PROP/005
                // Kita pecah string berdasarkan garis miring '/'
                $parts = explode('/', $latestProposal->nomor_proposal);
                
                // Ambil angka paling belakang (005)
                $lastNumber = (int) end($parts);
                
                // Tambah 1 dan format 3 digit
                $sequence = sprintf('%03d', $lastNumber + 1);
            }

            // 4. Gabungkan Format: UKM-001/PROP/001
            $model->nomor_proposal = $orgCode . '/PROP/' . $sequence;
        });
    }

    // ================= RELASI =================
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}