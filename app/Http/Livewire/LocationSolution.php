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

class LocationSolution extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showLSDetailsModal=false;
    public $referenceNumber,$order_id,$lsaddress,$filter_from_date, $filter_to_date,$orderDetailsImage;

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

        $data['lsattachments'] = $lsQuery->orderBy('lsattachment_models.id','DESC')->paginate(20);
        return view('livewire.location-solution',$data);
    }

    public function lsDetailsView($order){
        //dd($order);
        $this->showLSDetailsModal=true;
        $this->orderDetailsImage = $order['image'];
        $this->dispatchBrowserEvent('showLSDetailsModal');
    }
}
