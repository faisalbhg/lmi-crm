<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsattachmentModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordder_id',
        'referenceNumber',
        'aocId',
        'address',
        'latitude',
        'longitude',
        'isVerified',
        'lastVerifiedByUser',
        'lastVerifiedTime',
        'locationGlobalId',
        'capacity',
        'volume',
        'dropDuration',
        'zoneId',
        'zoneName',
        'collection',
        'priority',
        'factCost',
        'area',
        'orderNumberLm',
        'nameOfSalesPerson',
        'modeOfPayment',
        'temperature',
        'invoiceAmount',
        'dropWindow_startTime',
        'dropWindow_endTime',
        'created_by',
    ];

    public function lsImages()
    {
        return $this->hasMany(LsattachmentimageModel::class,'ordder_id','ordder_id');
    }
}
