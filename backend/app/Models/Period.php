<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_period';
    protected $fillable = ['name', 'start_date', 'end_date', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
