<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crms extends Model
{
    use HasFactory;

    protected $fillable = [
        'related_to',
        'deligated_to',
        'deligated_by',
        'crm_start_date_time',
        'crm_end_date_time',
        'crm_followup_date_time',
        'our_brand',
        'competitor_brand',
        'quote_estimated_value',
        'customer_name',
        'customer_email',
        'alternative_email',
        'country_code_no',
        'mobile_no',
        'company_name',
        'company_address',
        'phone_no',
        'customer_type',
        'newCustomer',
        'crm_description',
        'business_category',
        'marketing_channel',
        'teritory',
        'country',
        'status',
        'crm_status',
        'crm_reminder',
        'crm_remind_on',
        'crm_action',
        'crm_updation_date_time',
        'sample_status',
        'sample_department',
        'sample_feedback',
        'crm_quatation',
        'crm_followup',
        'crm_negosiation',
        'crm_finalstatus',
        'crm_attachment',
        'order_number',
        'user_id',
        'created_by',
        'assigned_id',
        'is_deleted',
        'post_to_epicor',
        'post_epicor_update'
    ];

    public function teritoryInfo()
    {
        return $this->belongsTo(Territories::class,'teritory','id');
    }
    public function countryInfo()
    {
        return $this->belongsTo(Countries::class,'country','id');
    }
    public function userInfo()
    {
        return $this->belongsTo(User::class,'assigned_id','id');
    }
}
