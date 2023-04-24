<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'crm_id',
        'subject',
        'message',
        'attachment',
        'toEmail',
        'ccEmail',
        'bccEmail',
        'user_id'
    ];
}
