<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\LocationSolution as LocationSolutionModel;
use App\Models\LsattachmentimageModel;
use App\Models\LsattachmentModel;

use Livewire\WithPagination;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Http;
use Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use URL;
use Livewire\WithFileUploads;
use App\Exports\CrmExport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Illuminate\Http\UploadedFile;


class LocationSolution extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showLSDetailsModal=false;
    public $referenceNumber,$order_id,$lsaddress,$filter_from_date, $filter_to_date,$orderDetailsImage;
    public $getLsOrderModal=false;
    public $order_number, $fromdatelsatchment;
    public $showAttachemntCompleteMessage = false, $attachemntCompleteMessage;

    public function render()
    {
        $lsQuery = LsattachmentModel::with(['lsImages'])->select('*');
        
        
        if(!empty($this->referenceNumber)){

            $lsQuery = $lsQuery->where('lsattachment_models.referenceNumber', 'like', "%{$this->referenceNumber}%");
        }

        if(!empty($this->order_id)){

            $lsQuery = $lsQuery->where('lsattachment_models.ordder_id', 'like', "%{$this->order_id}%");
        }
        if(!empty($this->lsaddress)){

            $lsQuery = $lsQuery->where('lsattachment_models.address', 'like', "%{$this->lsaddress}%");
        }

        if(!empty($this->filter_from_date) && !empty($this->filter_to_date)){
            $lsQuery = $lsQuery->where('lsattachment_models.orderLsDate','>=', $this->filter_from_date)->where('lsattachment_models.orderLsDate','<=',$this->filter_to_date);
        }

        $data['lsattachments'] = $lsQuery->orderBy('lsattachment_models.orderLsDate','DESC')->paginate(20);
        //dd($data);
        return view('livewire.location-solution',$data);
    }

    public function lsDetailsView($order){
        //dd($order);
        $this->showLSDetailsModal=true;
        $this->orderDetailsImage = $order['image'];
        $this->dispatchBrowserEvent('showLSDetailsModal');
    }


    

    public function getNewLsOrders(){
        $this->showAttachemntCompleteMessage = false;
        $this->attachemntCompleteMessage = '';
        $this->getLsOrderModal=true;
        $this->dispatchBrowserEvent('showGetLsOrderModal');
    }

    public function saveSubmit(){

        $fromdatelsatchment = Carbon::parse($this->fromdatelsatchment)->format('d/m/Y');
        $sessionUrl = 'https://lamarquise.maxoptra.com/rest/2/authentication/createSession?accountID=lamarquise&user=Integration&password=integration@lmi';
        $sessionResponse = simplexml_load_string(Http::post($sessionUrl));
        $sessionResponseJson = json_encode($sessionResponse);
        $sessionResponseBody= json_decode($sessionResponseJson, true);
        $sessionID = $sessionResponseBody['authResponse']['sessionID'];


        $getOrderUrl = "https://lamarquise.maxoptra.com/rest/2/distribution-api/orders/getOrdersWithZone?sessionID=".$sessionID."&date=".$fromdatelsatchment."&aocID=1109";
        $getOrderResponse = simplexml_load_string(Http::post($getOrderUrl));
        $getOrderResponseJson = json_encode($getOrderResponse);
        $getOrderResponseBody= json_decode($getOrderResponseJson, true);
        if(@$getOrderResponseBody['error']['errorCode'])
        {
            $atachementVal=array();
        }
        else
        {
            $lsorderattachement = $getOrderResponseBody['OrdersWithZoneResponse']['orders']['order'];
            //dd($lsorderattachement);
            
            foreach($lsorderattachement as $atachementVal)
            {
                if(!empty($atachementVal['attachments'])){

                    $referenceNumber = $atachementVal['@attributes']['referenceNumber'];
                    $getAttachmentRows = LsattachmentModel::where(['referenceNumber'=>$referenceNumber])->get()->count();
                    //dd($referenceNumber.$getAttachmentRows);
                    
                    if($getAttachmentRows==0){
                        $saveData = $atachementVal['@attributes'];
                        $saveData['ordder_id']= $atachementVal['@attributes']['id'];
                        $saveData['dropWindow_startTime'] = Carbon::parse($atachementVal['dropWindows']['dropWindow']['@attributes']['startTime'])->format('Y-m-d H:i:s');
                        $saveData['dropWindow_endTime'] = Carbon::parse($atachementVal['dropWindows']['dropWindow']['@attributes']['endTime'])->format('Y-m-d H:i:s');


                        unset($saveData['id']);
                        $saveLsOrderDetails = LsattachmentModel::create($saveData);
                        $lsAttachmentInsertId = $saveLsOrderDetails->id;
                        

                        $atachementVal['attachments']['attachment'] = (array)$atachementVal['attachments']['attachment'];
                        //dd($atachementVal['attachments']['attachment']);
                        foreach($atachementVal['attachments']['attachment'] as $attachmentImgVal)
                        {
                            $imageSaveData['ls_id'] = $lsAttachmentInsertId;
                            $imageSaveData['ordder_id'] = $saveData['ordder_id'];
                            $imageSaveData['referenceNumber'] = $saveData['referenceNumber'];
                            $imageSaveData['image'] = $atachementVal['@attributes']['id'].$atachementVal['@attributes']['referenceNumber'].rand().'.jpg';
                            LsattachmentimageModel::create($imageSaveData);

                            $url = $attachmentImgVal;
                            $info = pathinfo($url);
                            $contents = file_get_contents($url);
                            $file = $_SERVER['DOCUMENT_ROOT'].'ls-order-attachment/' . $imageSaveData['image'];
                            file_put_contents($file, $contents);
                            $uploaded_file = new UploadedFile($file, $imageSaveData['image']);
                        }
                    }
                }
            }
        }

        $this->showAttachemntCompleteMessage = true;
        $this->attachemntCompleteMessage = 'Atachemnts are added to the system from Location Solution successfully..!';


    }
}
