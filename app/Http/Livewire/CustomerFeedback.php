<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Crms;

class CustomerFeedback extends Component
{

    public $showNewCFModal=false,$showCFDetailsModal=false;

    public function render()
    {
        return view('livewire.customer-feedback');
    }

    public function newFeedBackForm(){
        $this->showNewCFModal=true;
        $this->crmTitle="New Customer Feedback";
        
        $this->dispatchBrowserEvent('showNewCFModal');
    }
}
