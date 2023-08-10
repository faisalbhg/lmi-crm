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
        'sample_feedback',
        'sample_feedback_reason',
        'status',
        'department',
        'command',
        'created_by'
    ];

    public function userInfo()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    
}
