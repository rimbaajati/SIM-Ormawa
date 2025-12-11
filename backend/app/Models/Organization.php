<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\ManagementOrganization; 
use App\Models\Period;
use App\Models\Proposal;

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
        'visi',
        'misi',
        'ketua',
        'pembimbing',
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
                $existingCode = $latestOrg->id_organization ?? 'UKM-000';
                $lastNumber = (int) substr($existingCode, -3);
                $newNumber = $lastNumber + 1;
                $model->id_organization = $prefix . sprintf('%03d', $newNumber);
            }
        });
    }
    
    public function events()
    {
        return $this->hasMany(Event::class, 'id_organization', 'id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'id_organization', 'id');
    }

    public function managements()
    {
        return $this->hasMany(ManagementOrganization::class, 'id_organization', 'id');
    }

    public function currentManagement()
    {
        return $this->hasOne(ManagementOrganization::class, 'id_organization', 'id')
            ->ofMany([
                'id' => 'max', 
            ], function ($query) {
                $query->whereHas('period', function ($q) {
                    $q->where('is_active', true);
                });
            });
    }
}