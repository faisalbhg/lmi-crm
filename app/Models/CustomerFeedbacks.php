<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedbacks extends Model
{
    use HasFactory;

    protected $fillable = [
        'Company',
        'CustID',
        'CustNum',
        'Name',
        'City',
        'State',
        'Zip',
        'Country',
        'Address1',
        'Address2',
        'Address3',
        'PhoneNum',
        'EMailAddress',
        'AddrList',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
