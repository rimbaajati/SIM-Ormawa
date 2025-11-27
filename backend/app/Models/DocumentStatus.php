<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    protected $fillable = ['document_id', 'text', 'done', 'detail'];
}
