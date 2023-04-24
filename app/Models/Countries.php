<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'country_code',
        'country_phone_code',
        'country_flag',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
