<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Sample;
use App\Models\SampleLogs;

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

    public function render()
    {
        $data['samplesList'] = Sample::with('userInfo')->orderBy('id','DESC')->paginate(20);
        //dd($data);
        return view('livewire.samples',$data);
    }

    public function updateSample($sampleId,$status)
    {
        $uppdatData = Sample::find($sampleId)->update(['status'=>$status,'department'=>$status]);
        $sampleInsertLog = [
            'sample_order_id'=>$sampleId,
            'status'=>$status,
            'department'=>$status,
            'updates'=>json_encode($uppdatData),
        ];
        SampleLogs::create($sampleInsertLog);
        $sampleOrderDtls = Sample::with('userInfo')->find($sampleId);

        $files = null;
        $mailData = [
            'name' => $sampleOrderDtls->userInfo['name'],
            'body' => 'Your sample request is '.config('common.sample_status')[$status].' please find the Sample request details '.URL::to("/sample-details/".$sampleId),
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
