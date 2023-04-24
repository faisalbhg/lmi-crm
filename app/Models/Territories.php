<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territories extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'territory_name',
        'territory_code',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
