<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_order_id',
        'updates',
        'status',
        'department',
        'created_by'
    ];
}
