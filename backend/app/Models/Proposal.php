<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_proposal',      
        'id_organization',  
        'id_user',        
        'judul',
        'deskripsi',
        'waktu_mulai',  
        'waktu_selesai',
        'tempat',
        'anggaran',
        'file_proposal',
        'status',
        'catatan_revisi',
        'approved_by',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'anggaran' => 'decimal:2',
    ];

    // ================= RELASI ================
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'id_organization', 'id');
    }

    public function budgets()
    {
        return $this->hasMany(ProposalBudget::class, 'proposal_id', 'id');
    }
}