<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagementOrganization extends Model
{
    protected $table = 'management_organizations';
    protected $guarded = ['id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
