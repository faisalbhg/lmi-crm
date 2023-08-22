<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedbackEntries extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'feedback_question_id',
        'feedback_question_qtn',
        'feedback_answer',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function qtnInfo()
    {
        return $this->belongsTo(CustomerFeedbackQtn::class,'feedback_question_id','id');
    }
}
