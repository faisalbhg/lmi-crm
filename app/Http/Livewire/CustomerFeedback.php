<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\CustomerFeedbackQtn;
use App\Models\CustomerFeedbacks;
use App\Models\CustomerFeedbackEntries;

use App\Models\Crms;
use App\Models\Countries;
use App\Models\Territories;

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

class CustomerFeedback extends Component
{

    public $showNewCFModal=false,$showNewCFDetailsModal=false;
    public $customerFeedbackValues=[];
    public $customersList = [],$showSearchCustomers=false;
    public $selectedCustomer;
    public $customer_name, $customer_email, $country = 237, $country_code = 971, $territory, $mobile_no, $phone_no, $company_address;
    public $Company, $CustID, $CustNum, $Name, $City, $State, $Zip, $Country, $Address1, $Address2, $Address3, $PhoneNum, $EMailAddress, $AddrList;
    public $customerFeedbackQtn=false;
    public $customer_feedback_answer=[],$customer_feedback_qtn=[];
    public $showCFSaveMessage=false, $cFSaveMessage;
    public $getCustomerFeedbacks=[];
    public $showCFDetailsModal=false;
    public $feedbackDetails=[],$feedbackAnswerDetails=[];

    public function render()
    {
        $this->getCustomerFeedbacks = CustomerFeedbacks::get();
        return view('livewire.customer-feedback');
    }

    public function newFeedBackForm(){
        $this->showNewCFDetailsModal=true;
        $this->crmTitle="New Customer Feedback";
        $this->customerFeedbackValues = CustomerFeedbackQtn::get();
        //dd($this->customerFeedbackValues);
        $this->dispatchBrowserEvent('showNewCFModal');
    }

    public function searchCustomerName()
    {
        $select = '$select';
        $filter = '$filter';
        $top = '$top';
        $apiUrl = "https://lmi-epic-app02.buhaleeba.ae/erp11live/api/v1/Erp.BO.CustomerSvc/Customers";
        $customerName = str_replace(" ","%20",$this->CustID);
        $getCustDtlsApiUrl = $apiUrl."?$select=Company,CustID,CustNum,Name,City,State,Zip,Country,Address1,Address2,Address3,PhoneNum,EMailAddress,AddrList&$filter=indexof%28CustID%2C%20%27".$customerName."%27%29%20eq%201%20and%20(Company%20eq%20'CO01'%20or%20Company%20eq%20'CO02'%20or%20Company%20eq%20'CO03'%20or%20Company%20eq%20'CO04'%20or%20Company%20eq%20'CO05')%20and%20SalesRepCode%20ne%20%27LMI-CLOS%27";
        //dd($getCustDtlsApiUrl);
        //$getCustDtlsApiUrl = $apiUrl."?$select=Company,CustID,CustNum,Name,City,State,Zip,Country,Address1,Address2,Address3,PhoneNum,EMailAddress,AddrList&$filter=indexof%28CustID%2C%20%27".$customerName."%27%29%20eq%201";
        $response = Http::withBasicAuth('manager', 'manager')->get($getCustDtlsApiUrl);
        $response = json_decode((string) $response->getBody(), true);
        $this->customersList = $response['value'];
        
        $this->showSearchCustomers=true;
    }

    public function selectCustomer($customer)
    {
        $existingCstmr = json_decode($customer);
        $this->Company = $existingCstmr->Company;
        $this->CustID = $existingCstmr->CustID;
        $this->CustNum = $existingCstmr->CustNum;
        $this->Name = $existingCstmr->Name;
        $this->City = $existingCstmr->City;
        $this->State = $existingCstmr->State;
        $this->Zip = $existingCstmr->Zip;
        $this->Country = $existingCstmr->Country;
        $this->Address1 = $existingCstmr->Address1;
        $this->Address2 = $existingCstmr->Address2;
        $this->Address3 = $existingCstmr->Address3;
        $this->PhoneNum = $existingCstmr->PhoneNum;
        $this->EMailAddress = $existingCstmr->EMailAddress;
        $this->AddrList = $existingCstmr->AddrList;

        
        $this->selectedCustomer = $customer;
        if(isset($existingCstmr->customer_in))
        {
            $this->country = $existingCstmr->Country;
            $this->country_code = $existingCstmr->country_code_no;
            $this->territory = $existingCstmr->State;
            $this->phone_no = $existingCstmr->phone_no;
        }
        else
        {
            $country = Countries::where('country_name', 'like', "%{$existingCstmr->Country}%")->first();
            $this->country = $country->id;
            $this->country_code = $country->country_phone_code;
        }
        
        //dd($country);
        $this->newCustomer=false;
        $this->customer_name = $existingCstmr->Name;
        $this->customer_email = $existingCstmr->EMailAddress;
        $this->company_address = $existingCstmr->Address1.', '.(isset($existingCstmr->Address2)?$existingCstmr->Address2:'').', '.(isset($existingCstmr->Address3)?$existingCstmr->Address3:'');
        
        $this->mobile_no = $existingCstmr->PhoneNum;
        $this->showSearchCustomers=false;

        $this->customerFeedbackQtn=true;
    }

    public function saveCF()
    {
        foreach($this->customerFeedbackValues as $keyCFQQQTn => $customer_feedback_answerQtn){
            $validateCrmSave['customer_feedback_qtn.'.$customer_feedback_answerQtn->id] = 'required';
        }
        $validatedData = $this->validate($validateCrmSave);
        
        $newCFMain['Company']=$this->Company;
        $newCFMain['CustID'] = $this->CustID;
        $newCFMain['CustNum'] = $this->CustNum;
        $newCFMain['Name'] = $this->Name;
        $newCFMain['City'] = $this->City;
        $newCFMain['State'] = $this->State;
        $newCFMain['Zip'] = $this->Zip;
        $newCFMain['Country'] = $this->Country;
        $newCFMain['Address1'] = $this->Address1;
        $newCFMain['Address2'] = $this->Address2;
        $newCFMain['Address3'] = $this->Address3;
        $newCFMain['PhoneNum'] = $this->PhoneNum;
        $newCFMain['EMailAddress'] = $this->EMailAddress;
        $newCFMain['AddrList'] = $this->AddrList;
        $cFBInsertResponse = CustomerFeedbacks::create($newCFMain);
        $cFBInsertResponseId = $cFBInsertResponse->id;

        foreach($this->customer_feedback_qtn as $keyCFQ => $customer_feedback_answer){
            $newCFData['feedback_id'] = $cFBInsertResponseId;
            $newCFData['feedback_question_id']=$keyCFQ;
            //$newCFData['feedback_question']=$customer_feedback_answer
            $newCFData['feedback_answer']=$customer_feedback_answer;
            $newCFData['created_by'] = Session::get('user')->id;
            CustomerFeedbackEntries::create($newCFData);
        }
        $this->dispatchBrowserEvent('hideNewCFModal');
        $this->showCFSaveMessage = true;
        $this->cFSaveMessage = 'Custmer Feedback Updated Successfully..!';
    }

    public function openFeedBack($feedbacks)
    {
        $this->feedbackDetails = $feedbacks;
        $this->feedbackAnswerDetails = CustomerFeedbackEntries::with(['qtnInfo'])->where(['feedback_id'=>$feedbacks['id']])->get();
        //($this->feedbackAnswerDetails);
        $this->showCFDetailsModal=true;
        $this->dispatchBrowserEvent('showCFDetailsModal');
    }
}
