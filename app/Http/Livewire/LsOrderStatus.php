<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\LocationSolution as LocationSolutionModel;
use App\Models\LsattachmentimageModel;
use App\Models\LsattachmentModel;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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

class LsOrderStatus extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showLSDetailsModal=false;
    public $filter_from_date, $filter_to_date;
    public $referenceNumber,$order_id,$lsaddress,$orderDetailsImage;
    public $getLsOrderModal=false;
    public $order_number, $fromdatelsatchment;
    public $showAttachemntCompleteMessage = false, $attachemntCompleteMessage;
    public $getOrderResponse, $lsOStatus = '', $distributionCentreReference, $clientName;
    public $statusList=['UNALLOCATED','ALLOCATED','LOCKED','SENDING','SENT','ACCEPTED','DELIVERED','COMPLETED','FAILED','DRIVING','ARRIVED','IN_PROGRESS','WORK_COMPLETED','DEPARTED','SUSPENDED'];

    public function render()
    {
        $this->filter_from_date = Carbon::yesterday()->format('Y-m-d');
        $this->filter_to_date = Carbon::now()->format('Y-m-d');
        $this->getSearchData();
        return view('livewire.ls-order-status');
    }

    public function getFilterStatus(){

    }

    public function getSearchData(){
        
        $this->search_from_date = Carbon::createFromFormat('Y-m-d', $this->filter_from_date)->format('Y-m-d\TH:i:s\Z');
        $this->search_to_date = Carbon::createFromFormat('Y-m-d', $this->filter_to_date)->format('Y-m-d\TH:i:s\Z');
        if($this->lsOStatus!='')
        {
            $statusFilter='&statuses='.$this->lsOStatus;
        }
        else
        {
            $statusFilter='';
        }
        $getOrderStatusUrl = "https://lamarquise.maxoptra.com/api/v6/orders?limit=200&expand=STATUS&timeWindowFrom=".$this->search_from_date."&timeWindowTo=".$this->search_to_date.$statusFilter;
        
        $getOrderResponse = Http::withToken(getenv('maxoptraTOKEN'))->get($getOrderStatusUrl);
        $response = $getOrderResponse->getBody()->getContents();
        $getOrderResponse = (array)json_decode($response,true);
        $this->getOrderResponse = $getOrderResponse['data'];
    }

    
}
