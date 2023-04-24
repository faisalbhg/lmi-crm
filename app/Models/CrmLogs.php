<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmLogs extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'crm_id',
        'description',
        'crm_reminder',
        'crm_remind_on',
        'status',
        'crm_status',
        'crm_action',
        'crm_quatation',
        'crm_followup',
        'crm_negosiation',
        'crm_finalstatus',
        'quatation_attachment',
        'action_message',
        'crm_updation_date_time',
        'updation_attachment',
        'quote_estimated_value',
        'followup_attachment',
        'crm_attachment',
        'crm_followup_date_time',
        'crm_end_date_time',
        'quatation_action_message',
        'followup_action_message',
        'negosiation_action_message',
        'win_action_message',
        'loss_action_message',
    ];
}
