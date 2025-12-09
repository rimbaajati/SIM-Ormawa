<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_proposal';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_proposal',
        'id_organization',
        'id_user',
        'judul',
        'deskripsi',
        'waktu',
        'tempat',
        'anggaran',
        'file_proposal',
        'status',
        'catatan_revisi',
        'approved_by',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'anggaran' => 'decimal:2',
    ];

    // ================= RELASI =================
    
   public function user()
    {
        // 'id_user' adalah foreign key di tabel proposals
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Organization
    public function organization()
    {
        // 'id_organization' adalah foreign key di tabel proposals
        return $this->belongsTo(Organization::class, 'id_organization');
    }

    public function budgets()
    {
        return $this->hasMany(ProposalBudget::class, 'id_proposal', 'id_proposal');
    }
}