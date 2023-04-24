<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'crm_id',
        'cust_id',
        'cust_num',
        'cutomer_name',
        'teritory',
        'state',
        'zip',
        'country',
        'customer_address',
        'phone_num',
        'email_address',
        'mobile_no',
        'partNum',
        'partDescription',
        'prodCode',
        'status',
        'department',
        'is_emailed',
        'is_deleted',
        'created_by'
    ];

    public function userInfo()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
