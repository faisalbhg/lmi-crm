<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsattachmentimageModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordder_id',
        'referenceNumber',
        'image',
        'created_by',
    ];

}
