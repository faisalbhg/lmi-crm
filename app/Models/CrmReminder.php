<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'crm_id',
        'subject',
        'message',
        'toEmail',
        'toName',
        'date_on',
        'user_id',
        'status',
        'is_open',
        'is_sound',
        'is_send'
    ];
}
