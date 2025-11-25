<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    Use HasFactory;
    protected $table = 'proposals';
    protected $fillable = [
        'judul',
        'deskripsi',
        'waktu',
        'tempat',
        'file_proposal',
        'anggaran',
        'status',
        'user_id',
    ];
}
