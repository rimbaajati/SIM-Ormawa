<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagementOrganization extends Model
{
    protected $table = 'management_organizations';
    protected $fillable = [
        'id_organization', 
        'id_period',       
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'id_organization');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'id_period', 'id_period');
    }
}
