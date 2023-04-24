<?php

namespace App\Exports;

use App\Models\Crms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CrmExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Status", "Last Aaction", "New Customer","Customer Name","Address","Email","Mobile No","Phone No","Country","Territory","Customer Type","Business Category","Marketing Channel","Related To","CRM Start Date Time","CRM End Date Time","CRM Followup Date Time","Our Brand","Competitor Brand","Description","Created by","Assigned To","Created At","Last Updated At"];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
            },
        ];
    }
}
