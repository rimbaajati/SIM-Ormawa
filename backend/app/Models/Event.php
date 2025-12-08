<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['organization_id', 'nama', 'event_date', 'lokasi', 'deskripsi', 'foto'];

    protected $casts = [
        'event_date' => 'date', // Agar bisa diformat tanggalnya nanti
    ];

    public function organization()
    {
        // Event ini MILIK satu organisasi
        return $this->belongsTo(Organization::class);
    }
}
