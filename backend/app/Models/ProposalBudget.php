<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id', 
        'nama_barang',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }
}