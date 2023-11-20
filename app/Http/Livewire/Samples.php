<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Sample;
use App\Models\SampleLogs;
use App\Models\Crms;
use App\Models\User;

use Livewire\WithPagination;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Http;
use Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use URL;
use App\Exports\Sample as SampleExport;
use Maatwebsite\Excel\Facades\Excel;


class Samples extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showsampleDetails=false;
    public $sampleInfo=[],$sampleItems=[], $sampleCrmId,$sample_comment=[], $sampleLogs=[];
    public $filter_from_date,$filter_to_date;

    function mount( Request $request) {
        $id = $request->id;
        if($id)
        {
            $this->showsampleDetails=true;
            $this->openSample($id);

        }

    }

    public function render()
    {
        $sampleQuery = Sample::with('userInfo');
        if(Session::get('user')->usertype==7)
        {
            $sampleQuery->where(['status'=>1]);
        }
        else if(!in_array(Session::get('user')->usertype,config('common.sampleshowAll')))
        {
            $sampleQuery->where(['created_by'=>Session::get('user')->id]);
        }
        
        $data['samplesList'] = $sampleQuery->orderBy('id','DESC')->groupBy('crm_id')->paginate(20);
        //dd($data);
        return view('livewire.samples',$data);
    }

    public function openSample($crms_id)
    {
        $this->showsampleDetails = true;
        $sampleQuery = Sample::with('userInfo')->with('teritoryInfo')->with('countryInfo')->with('samplelogs');
        if(!in_array(Session::get('user')->usertype,config('common.sampleshowAll')))
        {
            $sampleQuery = $sampleQuery->where(['created_by'=>Session::get('user')->id]);
        }
        $sampleQuery = $sampleQuery->where('crm_id','=',$crms_id);

        $this->sampleItems = $sampleQuery->get();
        if(count($this->sampleItems))
        {
            $this->sampleInfo = $this->sampleItems[0];
        }

        $this->dispatchBrowserEvent('showSampleDetailModal');
    }

    public function updateSample($sampleId,$status)
    {
        if($status==5)
        {
            $validatedData = $this->validate([
                'sample_comment.'.$sampleId => 'required',
            ]);
        }
        
        $uppdatData = Sample::find($sampleId)->update(['status'=>$status,'department'=>$status]);
        $sampleInsertLog = [
            'sample_order_id'=>$sampleId,
            'status'=>$status,
            'department'=>$status,
            'command'=>isset($this->sample_comment[$sampleId])?$this->sample_comment[$sampleId]:'',
            'updates'=>json_encode(['status'=>$status,'department'=>$status]),
            'created_by'=>Session::get('user')->id
        ];
        SampleLogs::create($sampleInsertLog);
        

        $sampleOrderDtls = Sample::with('userInfo')->find($sampleId);
        Crms::where(['id'=>$sampleOrderDtls->crm_id])->update(['sample_status'=>$status, 'sample_department'=>$status]);
        $this->sampleItems = Sample::where('crm_id','=',$sampleOrderDtls->crm_id)->get();
        $this->sampleInfo = Sample::with('userInfo')->with('teritoryInfo')->with('countryInfo')->where('crm_id','=',$sampleOrderDtls->crm_id)->first();

        if($status==1){
            if($sampleOrderDtls->userInfo['company'] =='CO03')
            {
                $files=null;
                $mailData1 = [
                    'name' => 'FAITH JOAN CALAGUAN',
                    'body' => 'New Sample Preparation Request are created, check the below link to view the sample requests '.URL::to("/sample-details/".$sampleOrderDtls->crm_id),
                    'title' => 'CRM Samples Preparation Requests Approvals',
                    'email' => 'admin@lmi.om',
                ];
                Mail::send('emails.crm_email', $mailData1, function($message)use($mailData1, $files) {
                    $message->subject($mailData1['title']);
                    $message->to($mailData1["email"]);
                    $message->bcc('faisal@buhaleeba.ae');
                    if($files){
                        foreach ($files as $file){
                            $message->attach($file);
                        }
                    }            
                });
            }
            else if($sampleOrderDtls->userInfo['company'] =='CO05')
            {
                $files=null;
                $mailData1 = [
                    'name' => 'Ahtasham Khan',
                    'body' => 'New Sample Preparation Request are created, check the below link to view the sample requests '.URL::to("/sample-details/".$sampleOrderDtls->crm_id),
                    'title' => 'CRM Samples Preparation Requests Approvals',
                    'email' => 'cs@masdar-lmi.com',
                ];
                Mail::send('emails.crm_email', $mailData1, function($message)use($mailData1, $files) {
                    $message->subject($mailData1['title']);
                    $message->to($mailData1["email"]);
                    $message->bcc('faisal@buhaleeba.ae');
                    if($files){
                        foreach ($files as $file){
                            $message->attach($file);
                        }
                    }            
                });
            }
            else
            {

                $userDetails = User::where(['sample_showroom_aprove'=>1])->get();
                $files=null;
                foreach($userDetails as $sendUser){
                    $mailData2 = [
                        'name' => $sendUser->name,
                        'body' => 'New Sample Preparation Request are created, check the below link to view the sample requests '.URL::to("/sample-details/".$sampleOrderDtls->crm_id),
                        'title' => 'CRM Samples Preparation Requests Approvals',
                        'email' => $sendUser->email,
                    ];
                    Mail::send('emails.crm_email', $mailData2, function($message)use($mailData2, $files) {
                        $message->subject($mailData2['title']);
                        $message->to($mailData2["email"]);
                        $message->bcc('faisal@buhaleeba.ae');
                        if($files){
                            foreach ($files as $file){
                                $message->attach($file);
                            }
                        }            
                    });
                }
            }


        }

        $files = null;
        $mailData3 = [
            'name' => $sampleOrderDtls->userInfo['name'],
            'body' => 'Your sample request is '.config('common.sample_status')[$status].', please find the Sample request details '.URL::to("/crm-details/".$sampleOrderDtls->crm_id),
            'title' => 'Sample Status: '.config('common.sample_status')[$status],
            'email' => $sampleOrderDtls->userInfo['email'],
        ];
        Mail::send('emails.crm_email', $mailData3, function($message)use($mailData3, $files) {
            $message->subject($mailData3['title']);
            $message->to($mailData3["email"]);
            $message->bcc('faisal@buhaleeba.ae');
            if($files){
                foreach ($files as $file){
                    $message->attach($file);
                }
            }            
        });

        
    }

    public function exportExcelSample(){

        $sampleQuery = SampleLogs::select('samples.crm_id','samples.id',
            \DB::raw('(CASE 
                WHEN sample_logs.status = 0 THEN "Sample Requested" 
                WHEN sample_logs.status = 1 THEN "Brand Aproved" 
                WHEN sample_logs.status = 2 THEN "Showroom Forwarded to Sales" 
                WHEN sample_logs.status = 3 THEN "Dispatched" 
                WHEN sample_logs.status = 4 THEN "Delivered" 
                WHEN sample_logs.status = 5 THEN "Rejected"
                END) AS sample_status'),
            \DB::raw('(CASE 
                WHEN sample_logs.sample_feedback = 0 THEN "" 
                WHEN sample_logs.sample_feedback = 13 THEN "Approved" 
                WHEN sample_logs.sample_feedback = 14 THEN "Pending" 
                WHEN sample_logs.sample_feedback = 19 THEN "Not Approved" 
                END) AS sample_feedback'),
            \DB::raw('(CASE 
                WHEN sample_logs.sample_feedback_reason = 0 THEN "" 
                WHEN sample_logs.sample_feedback_reason = 1 THEN "Not Approved due to price" 
                WHEN sample_logs.sample_feedback_reason = 2 THEN "Not Aproved due to Quality" 
                WHEN sample_logs.sample_feedback_reason = 3 THEN "Client don’t want to add to menu" 
                END) AS sample_feedback_reason'),
            'samples.partNum','samples.partDescription','samples.prodCode','samples.itemBrand','samples.itemQty',
            \DB::raw('(CASE 
                WHEN crms.newCustomer = 0 THEN "Existing Customer" 
                WHEN crms.newCustomer = 1 THEN "New Customer" 
                WHEN crms.newCustomer = 2 THEN "Existing Customer"
                END) AS newCustomer'),
            'crms.customer_name','crms.company_address','crms.customer_email','crms.mobile_no','crms.phone_no','countries.country_name','territories.territory_name','users.name as created_by','sample_logs.created_at','sample_logs.updated_at')
        ->leftjoin('samples','samples.id','=','sample_logs.sample_order_id')
        ->leftjoin('crms','crms.id','=','samples.crm_id')
        ->leftjoin('users','users.id','=','samples.created_by')
        ->leftjoin('territories','territories.id','=','samples.teritory')
        ->leftjoin('countries','countries.id','=','samples.country');
        //dd($sampleQuery);
        

        if(!empty($this->filter_from_date) && !empty($this->filter_to_date)){
            $this->filter_from_date = $this->filter_from_date.' 00:00:00';
            $this->filter_to_date = $this->filter_to_date.' 23:59:59';
            $sampleQuery = $sampleQuery->where('sample_logs.updated_at','>=', $this->filter_from_date)->where('sample_logs.updated_at','<=',$this->filter_to_date);
        }
        $sampleQuery = $sampleQuery->groupBy('sample_logs.id')->get();
        return Excel::download(new SampleExport($sampleQuery), 'samples_report.xlsx');
    
    }
}
