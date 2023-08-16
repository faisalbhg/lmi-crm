<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\CustmerFeedbackValues;
use App\Models\CustmerFeedback;

class CustomerFeedback extends Component
{

    public $showNewCFModal=false,$showCFDetailsModal=false;
    public $customerFeedbackValues=[];

    public function render()
    {
        return view('livewire.customer-feedback');
    }

    public function newFeedBackForm(){
        $this->showNewCFModal=true;
        $this->crmTitle="New Customer Feedback";
        $this->customerFeedbackValues = CustmerFeedbackValues::get();
        $this->dispatchBrowserEvent('showNewCFModal');
    }
}
