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
        'itemCategory',
        'itemBrand',
        'itemQty',
        'status',
        'sample_feedback',
        'sample_feedback_reason',
        'department',
        'is_emailed',
        'is_deleted',
        'created_by'
    ];

    public function userInfo()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function teritoryInfo()
    {
        return $this->belongsTo(Territories::class,'teritory','id');
    }
    public function countryInfo()
    {
        return $this->belongsTo(Countries::class,'country','id');
    }

    public function samplelogs()
    {
        return $this->hasMany(SampleLogs::class,'sample_order_id','id');
    }
}
