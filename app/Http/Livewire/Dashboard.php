<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Crms;
use App\Models\CrmLogs;
use App\Models\CrmReminder;
use App\Models\User;
use App\Models\Countries;
use App\Models\Territories;
use App\Models\Sample;
use App\Models\SampleLogs;
use App\Models\EmailLog;
use App\Models\CompetitorBrand;

use Carbon\Carbon;
use Session;

class Dashboard extends Component
{
    public function render()
    {
        
        $data['status'] = Crms::select(
            array(
                \DB::raw('count(DISTINCT(customer_name)) customers'),
                \DB::raw('count(case when crm_status = 1 then crm_status end) new'),
                \DB::raw('count(case when crm_status = 2 then crm_status end) quotation'),
                \DB::raw('count(case when crm_status = 3 then crm_status end) followup'),
                \DB::raw('count(case when crm_status = 4 then crm_status end) won'),
                \DB::raw('count(case when crm_status = 5 then crm_status end) loss'),
                \DB::raw('count(case when crm_status in (1,2,3,4,5) then crm_status end) total'),
            )
        )->where(['is_deleted' => 0])->first();

        $crmLogs = CrmLogs::select('crm_logs.*','crms.related_to','crms.crm_description','crms.customer_name as company','crms.company_address')
        ->leftjoin('crms','crms.id','=','crm_logs.crm_id');
        if(!Session::get('user')->isadmin)
        {
            $crmLogs = $crmLogs->where(['crms.assigned_id'=>Session::get('user')->id,'crms.is_deleted' => 0]);
        }
        else
        {
            $crmLogs = $crmLogs->where(['crms.is_deleted' => 0]);
        }

        $data['crmEntries'] = $crmLogs->orderBy('crm_logs.id','DESC')->paginate(10);
        //dd($data['crmEntries']);
        return view('livewire.dashboard',$data);
    }
}
