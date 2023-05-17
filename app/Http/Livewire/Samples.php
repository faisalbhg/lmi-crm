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


class Samples extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showsampleDetails=false;
    public $sampleInfo=[],$sampleItems=[], $sampleCrmId,$sample_comment=[], $sampleLogs=[];

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
            $userDetails = User::where(['usertype'=>7])->get();
            $files=null;
            foreach($userDetails as $sendUser){
                $mailData = [
                    'name' => $sendUser->name,
                    'body' => 'New Sample Preparation Request are created, check the below link to view the sample requests '.URL::to("/sample-details/".$sampleOrderDtls->crm_id),
                    'title' => 'CRM Samples Preparation Requests Approvals',
                    'email' => $sendUser->email,
                ];
                Mail::send('emails.crm_email', $mailData, function($message)use($mailData, $files) {
                    $message->subject($mailData['title']);
                    $message->to($mailData["email"]);
                    $message->bcc('faisal@buhaleeba.ae');
                    if($files){
                        foreach ($files as $file){
                            $message->attach($file);
                        }
                    }            
                });
            }
        }

        $files = null;
        $mailData = [
            'name' => $sampleOrderDtls->userInfo['name'],
            'body' => 'Your sample request is '.config('common.sample_status')[$status].', please find the Sample request details '.URL::to("/crm-details/".$sampleOrderDtls->crm_id),
            'title' => 'Sample Status: '.config('common.sample_status')[$status],
            'email' => $sampleOrderDtls->userInfo['email'],
        ];
        Mail::send('emails.crm_email', $mailData, function($message)use($mailData, $files) {
            $message->subject($mailData['title']);
            $message->to($mailData["email"]);
            $message->bcc('faisal@buhaleeba.ae');
            if($files){
                foreach ($files as $file){
                    $message->attach($file);
                }
            }            
        });

        
    }
}
