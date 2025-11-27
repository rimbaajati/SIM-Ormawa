<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['judul'];

    public function statuses()
    {
        return $this->hasMany(DocumentStatus::class);
    }
}
