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



class Crm extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $crmTitle;

    public $crm_search_crm_id, $crm_search_related_to, $crm_search_delegated_to, $crm_search_status, $crm_search_new_customer, $filter_search, $crm_search_created_by, $filter_from_date, $filter_to_date;

    public $showNewCrmModal=false, $showCrmDetailsModal = false, $showCrmUpdateModel = false, $showSampleItemSelected=false, $showCrmEndDateTime = true;

    public $searchSampleItems=[], $selectedSampleItemPartDescription=[], $deligatedToValue=[], $customersList = [], $countriesList = [], $territoriesList = [], $brandsList=[], $competitorBrandLists = [];

    public $search_brand;

    public $selectedSamples = [];
    

    public $crmId, $related_to, $search_sample_item, $deligated_to;
    public $selectedSampleItemCompany=[], $selectedSampleItemPartNum=[], $selectedSampleItemSearchWord=[], $selectedSampleItemProdCode=[];
    public $newCustomer=true, $selectedCustomer;
    public $crm_start_date_time, $crm_end_date_time, $crm_followup_date_time;
    public $customer_name, $customer_email, $country = 237, $country_code = 971, $territory, $mobile_no, $phone_no, $company_address, $customer_type, $business_category, $marketing_channel, $quote_estimated_value, $brands_list = [], $competitor_brands_list = [], $othre_brands_list = [], $selected_brands_list = [], $our_brand=[], $competitor_brand=[], $othre_brand = [], $crm_description;
    public $showQuoteEstimatedValue=false, $showSampleItemName=false,$showSampleItemResult=false, $showCrmFollowupDateTime=false,$showDeligatedTo=false, $showSearchCustomers=false;
    public $brandInputs = [];
    public $brandCount = 1;

    public $dtl_crm_id, $dtl_related_to, $dtl_deligated_to, $dtl_deligated_by, $dtl_crm_start_date_time, $dtl_crm_end_date_time, $dtl_crm_followup_date_time, $dtl_our_brand, $dtl_competitor_brand, $dtl_quote_estimated_value, $dtl_customer_name, $dtl_customer_email, $dtl_alternative_email, $dtl_country_code_no, $dtl_mobile_no, $dtl_company_name, $dtl_company_address, $dtl_phone_no, $dtl_customer_type, $dtl_newCustomer, $dtl_crm_description, $dtl_business_category, $dtl_marketing_channel, $dtl_teritory, $dtl_country, $dtl_crm_status, $dtl_crm_reminder, $dtl_crm_remind_on, $dtl_crm_action, $dtl_crm_quatation, $dtl_crm_followup, $dtl_crm_negosiation, $dtl_crm_attachment, $dtl_order_number, $dtl_created_at, $dtl_updated_at, $dtl_userName, $dtl_useremail;
    public $dtl_crmLogs, $dtl_crmReminderLogs, $dtl_emailLogs;
    public $showcrmUpdateMessage = false,$crmUpdateMessage,$showReminderUpdateMessage = false,$reminderUpdateMessage, $showEmailUpdateMessage = false,$emailUpdateMessage;
    public $upd_crm_status, $crm_updation_date_time,$updation_attachment, $log_quote_estimated_value, $order_number, $action_message;
    public $upd_crm_remind_on,$reminderEmailSubject,$reminderEmailMessage;
    public $dontSendToCustomer, $other_email_address, $sendEailCC, $sendEailBCC, $sendEailSubject, $customerEmailMessage, $customerEmailInputFile;

    public $crmSamplesDisplay = false;
    public $crmsampleItems=[];
    public $crm_sample_update_status=[], $crm_sample_updation_date_time=[], $crm_sample_action_message=[];

    public $crmComplaintsDisplay=false, $labelTileRelate;
    public $crm_complaints_update_status, $crm_complaints_updation_date_time,$crm_complaints_action_message;

    function mount( Request $request) {
        $id = $request->id;
        if($id)
        {
            $this->showCrmUpdateModel=true;
            $this->crmView($id);

        }

    }

    public function render()
    {

        $this->countriesList = Countries::all();
        $this->territoriesList = Territories::where(['country_id'=>$this->country])->get();

        $crmQuery = Crms::select('crms.*','users.name as userName','users.email as userEmail')
        ->leftjoin('users','users.id','=','crms.created_by')
        ->with('teritoryInfo')
        ->with('countryInfo')
        ->with('userInfo');
        $crmQuery->where(['is_deleted' => 0]);

        if(Session::get('user')->usertype==5)
        {
            $crmQuery = $crmQuery->whereIn('related_to',['9','12']);
        }
        else if(!Session::get('user')->isadmin)
        {
            $crmQuery = $crmQuery->where(['assigned_id'=>Session::get('user')->id]);
        }
        

        if(!empty($this->filter_search)){

            $crmQuery = $crmQuery->where('crms.customer_name', 'like', "%{$this->filter_search}%");
        }
        if(!empty($this->crm_search_crm_id)){

            $crmQuery = $crmQuery->where('crms.id', 'like', "%{$this->crm_search_crm_id}%");
        }

        if(!empty($this->crm_search_related_to)){

            $crmQuery = $crmQuery->where('crms.related_to', '=', $this->crm_search_related_to);
        }
        if(!empty($this->crm_search_delegated_to))
        {
            $crm_search_delegated_to = $this->crm_search_delegated_to;
            $crmQuery = $crmQuery->whereHas('userInfo', function ($q) use ($crm_search_delegated_to)
                {
                    $q->where('name', 'like', "%{$this->crm_search_delegated_to}%");
                }
            );
        }
        if(!empty($this->crm_search_status))
        {
            $crmQuery = $crmQuery->where('crms.crm_status', '=', $this->crm_search_status);
        }
        if(!empty($this->crm_search_new_customer))
        {
            $crmQuery = $crmQuery->where('crms.newCustomer', '=', $this->crm_search_new_customer);
        }
        if(!empty($this->crm_search_created_by)){

            $crmQuery = $crmQuery->where('users.name', 'like', "%{$this->crm_search_created_by}%");
        }
        

        

        if(!empty($this->filter_from_date) && !empty($this->filter_to_date)){
            $crmQuery = $crmQuery->where('crms.crm_start_date_time','>=', $this->filter_from_date)->where('crms.crm_end_date_time','<=',$this->filter_to_date);
        }

        $data['crmlists'] = $crmQuery->orderBy('crms.id','DESC')->paginate(20);
        //dd($data);
        return view('livewire.crm',$data);
    }

    public function newCrm()
    {
        $this->crmTitle = 'Add New CRM';
        $this->showNewCrmModal=true;

        $select = '$select';
        $filter = '$filter';
        $top = '$top';
        $firscom=true;
        $companyFilter="(";
        foreach(explode(",",Session::get('user')->company) as $companies)
        {
            if($firscom==false)
            {
                $companyFilter.="%20or%20";
            }
            $companyFilter.="Company%20eq%20'".$companies."'";
            $firscom=false;
        }
        $companyFilter.=")";

        $brandapiUrl = 'https://lmi-epic-app02.buhaleeba.ae/erp11live/api/v1/Erp.BO.PartClassSvc/PartClasses';
        $apiBrandUrl = $brandapiUrl."?$select=Description&$filter=".$companyFilter."&$top=1000";
        $brandResponse = Http::withBasicAuth('manager', 'manager')->get($apiBrandUrl);
        $brandResponse = json_decode((string) $brandResponse->getBody(), true);

        $brandUniqArray=['ROASTERY STN'];
        foreach($brandResponse['value'] as $brandsEp)
        {
            $brandnNew = explode("-",$brandsEp['Description']);
            if(!empty($brandnNew[1]))
            {
                if($brandnNew[1][0]==' '){
                    $brandnNew[1] = substr($brandnNew[1], 1);
                }
                if(($brandnNew[1]!='') && !in_array($brandnNew[1], $brandUniqArray))
                {
                    array_push($brandUniqArray, $brandnNew[1]);
                }
            }
            
        }
        asort($brandUniqArray);
        
        $this->brandsList = $brandUniqArray;
        
        $this->dispatchBrowserEvent('showNewCrmModal');

    }

    public function chnageCountry($val)
    {
        $country_info = Countries::find($val);
        $this->country_code = $country_info->country_phone_code;
        $this->country = $country_info->id;
    }

    public function addNewBrand($i)
    {
        $validatedData = $this->validate([
            'search_brand' => 'required',
            //'competitor_brand' => 'required',
        ]);
        
        //dd($this->othre_brand);
       
        $this->brands_list[] = $this->search_brand;
        $this->competitor_brands_list[] = json_encode($this->competitor_brand);
        if(!$this->othre_brand)
        {
            $this->othre_brands_list[] = []; 
        }
        else{
            $this->othre_brands_list[] = $this->othre_brand;
        }

        
        $this->search_brand = '';
        $this->competitorBrandLists = [];
        $this->competitor_brand = '';
        $this->othre_brand = '';
        
    }

    public function removeBrandSelected($key)
    {
        unset($this->brands_list[$key]);
        unset($this->competitor_brands_list[$key]);
        unset($this->othre_brands_list[$key]);
    }

    public function removeBrand($i)
    {
        unset($this->brandInputs[$i]);
    }

    public function relatedToChangeEvent($val)
    {
        $this->related_to = $val;
        switch($this->related_to)
        {
            case '2':
                $this->showQuoteEstimatedValue=true;
                $this->showSampleItemName=false;
                $this->showCrmFollowupDateTime=false;
                $this->showDeligatedTo=false;
                $this->showCrmEndDateTime=true;
                break;
            case '4':
                $this->showQuoteEstimatedValue=false;
                $this->showSampleItemName=true;
                $this->showCrmFollowupDateTime=false;
                $this->showDeligatedTo=false;
                $this->showCrmEndDateTime=false;
                break;
            case '7':
                $this->showQuoteEstimatedValue=false;
                $this->showSampleItemName=false;
                $this->showCrmFollowupDateTime=true;
                $this->showDeligatedTo=false;
                $this->showCrmEndDateTime=true;
                break;
            case '9':
                $this->showQuoteEstimatedValue=false;
                $this->showSampleItemName=false;
                $this->showCrmFollowupDateTime=false;
                $this->showDeligatedTo=true;
                $this->showCrmEndDateTime=true;
                $this->deligatedToValue = User::where('id', '!=' , Session::get('user')->id)->where(['active'=>1])->get();
                break;

            case '12':
                $this->showQuoteEstimatedValue=false;
                $this->showSampleItemName=false;
                $this->showCrmFollowupDateTime=false;
                $this->showDeligatedTo=true;
                $this->showCrmEndDateTime=true;
                $this->deligatedToValue = User::where('id', '!=' , Session::get('user')->id)->where(['active'=>1])->get();
                break;

            default:
                $this->showQuoteEstimatedValue=false;
                $this->showSampleItemName=false;
                $this->showCrmFollowupDateTime=false;
                $this->showDeligatedTo=false;
                $this->showCrmEndDateTime=true;
        }
    }

    public function sampleItemSearch()
    {
        $select = '$select';
        $filter = '$filter';
        $top = '$top';
        $apiUrl = "https://lmi-epic-app02.buhaleeba.ae/erp11live/api/v1/Erp.BO.PartSvc/Parts";
        $itemName = str_replace(" ","%20",$this->search_sample_item);
        $getSamplePartApiUrl = $apiUrl."?$select=Company,PartNum,SearchWord,PartDescription,ProdCode&$filter=indexof%28PartDescription%2C%20%27".$itemName."%27%29%20eq%201";
        $response = Http::withBasicAuth('manager', 'manager')->get($getSamplePartApiUrl);
        $response = json_decode((string) $response->getBody(), true);
        $this->searchSampleItems = $response['value'];

        $this->showSampleItemResult = true;
    }

    public function selectedSample($sample)
    {
        //dd($sample);
        $sample = (object)($sample);
        $this->selectedSamples[$sample->PartNum] = $sample;
        //$this->search_sample_item = $sample->PartDescription;
        $this->selectedSampleItemCompany[$sample->PartNum] = isset($sample->Company)?$sample->Company:' ';
        $this->selectedSampleItemPartNum[$sample->PartNum] = $sample->PartNum;
        $this->selectedSampleItemSearchWord[$sample->PartNum] = $sample->SearchWord;
        $this->selectedSampleItemPartDescription[$sample->PartNum] = $sample->PartDescription;
        $this->selectedSampleItemProdCode[$sample->PartNum] = $sample->ProdCode;
        $this->showSampleItemSelected = true;

    }

    public function removeSelectedSample($keyId)
    {
        unset($this->selectedSampleItemCompany[$keyId]);
        unset($this->selectedSampleItemPartNum[$keyId]);
        unset($this->selectedSampleItemSearchWord[$keyId]);
        unset($this->selectedSampleItemPartDescription[$keyId]);
        unset($this->selectedSampleItemProdCode[$keyId]);
        if(count($this->selectedSampleItemPartDescription)==0)
        {
            $this->showSampleItemSelected = false;
        }
    }

    public function closeSampleSearchResult(){
        $this->showSampleItemResult = false; 
        $this->search_sample_item = '';

    }

    public function searchCustomerName()
    {
        $crmDbCustomers = Crms::select('customer_name as Name','country as Country','country_code_no','mobile_no as PhoneNum','phone_no','teritory as State','company_address as Address1','customer_email as EMailAddress',
            \DB::raw("(SELECT ' ') as Address2"),
            \DB::raw("(SELECT ' ') as Address3"),
            \DB::raw("(SELECT 'existing') as customer_in"),
            'customer_type','business_category','marketing_channel',
        )
        ->where('customer_name', 'like', "%{$this->customer_name}%" )->groupBy('customer_name')->orderBy('id','DESC')->get();
        if(count($crmDbCustomers)>0)
        {
            foreach($crmDbCustomers as $keyDbc => $dbcust)
            {
                $this->customersList[$keyDbc]['Name'] = $dbcust->Name;
                $this->customersList[$keyDbc]['Country'] = $dbcust->Country;
                $this->customersList[$keyDbc]['country_code_no'] = $dbcust->country_code_no;
                $this->customersList[$keyDbc]['PhoneNum'] = $dbcust->PhoneNum;
                $this->customersList[$keyDbc]['phone_no'] = $dbcust->phone_no;
                $this->customersList[$keyDbc]['EMailAddress'] = $dbcust->EMailAddress;
                $this->customersList[$keyDbc]['State'] = $dbcust->State;
                $this->customersList[$keyDbc]['Address1'] = $dbcust->Address1;
                $this->customersList[$keyDbc]['Address2'] = $dbcust->Address2;
                $this->customersList[$keyDbc]['Address3'] = $dbcust->Address3;
                $this->customersList[$keyDbc]['customer_in'] = $dbcust->customer_in;
                $this->customersList[$keyDbc]['customer_type'] = $dbcust->customer_type;
                $this->customersList[$keyDbc]['business_category'] = $dbcust->business_category;
                $this->customersList[$keyDbc]['marketing_channel'] = $dbcust->marketing_channel;
            }
        }
        else
        {
            $select = '$select';
            $filter = '$filter';
            $top = '$top';
            $apiUrl = "https://lmi-epic-app02.buhaleeba.ae/erp11live/api/v1/Erp.BO.CustomerSvc/Customers";
            $customerName = str_replace(" ","%20",$this->customer_name);
            $getCustDtlsApiUrl = $apiUrl."?$select=Company,CustID,CustNum,Name,City,State,Zip,Country,Address1,Address2,Address3,PhoneNum,EMailAddress,AddrList&$filter=indexof%28Name%2C%20%27".$customerName."%27%29%20eq%201";
            $response = Http::withBasicAuth('manager', 'manager')->get($getCustDtlsApiUrl);
            $response = json_decode((string) $response->getBody(), true);
            $this->customersList = $response['value'];
        }
        
        $this->showSearchCustomers=true;
    }
    public function selectCustomer($customer)
    {
        $existingCstmr = json_decode($customer);
        $this->selectedCustomer = $customer;
        if(isset($existingCstmr->customer_in))
        {
            $this->country = $existingCstmr->Country;
            $this->country_code = $existingCstmr->country_code_no;
            $this->territory = $existingCstmr->State;
            $this->phone_no = $existingCstmr->phone_no;
            $this->customer_type = $existingCstmr->customer_type;
            $this->business_category = $existingCstmr->business_category;
            $this->marketing_channel = $existingCstmr->marketing_channel;
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
    }

    public function ourBrandChangeEvent($val,$select)
    {
        $this->competitorBrandLists=CompetitorBrand::where('brand', 'like', "%{$val}%" )->get();
    }

    public function saveCRM()
    {
        $validateCrmSave = [
            'related_to' => 'required',
            'crm_start_date_time' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'country' => 'required',
            'territory' => 'required',
            'mobile_no' => 'required|min:9|max:15',
            'phone_no' => 'required|min:9|max:15',
            'company_address' => 'required',
            'customer_type' => 'required',
            'business_category' => 'required',
            'marketing_channel' => 'required',
            'brands_list' => 'required',
            'crm_description' => 'required',
        ];
        $newCrmData['assigned_id'] =  Session::get('user')->id;

        if($this->related_to!=4){
            $validateCrmSave['crm_end_date_time']= 'required';
        }

        if($this->related_to==2)
        {
            $newCrmData['quote_estimated_value'] = $this->quote_estimated_value;
            $validateCrmSave['quote_estimated_value']= 'required';
        }
        else if($this->related_to==7)
        {
            $newCrmData['crm_followup_date_time'] = $this->crm_followup_date_time;
            $validateCrmSave['crm_followup_date_time']= 'required';
        }
        else if($this->related_to==9)
        {
            $newCrmData['deligated_to'] = $this->deligated_to;
            $newCrmData['deligated_by'] = Session::get('user')->id;
            $newCrmData['assigned_id'] =  $this->deligated_to;
            $validateCrmSave['deligated_to']= 'required';
        }
        else if($this->related_to==12)
        {
            
            $newCrmData['deligated_to'] = $this->deligated_to;
            $newCrmData['deligated_by'] = Session::get('user')->id;
            $newCrmData['assigned_id'] =  $this->deligated_to;
            $validateCrmSave['deligated_to']= 'required';
        }
        
        $validatedData = $this->validate($validateCrmSave);

        //dd($this);
        foreach($this->brands_list as $keyBl => $brands_list)
        {
            if($this->othre_brands_list[$keyBl])
            {
                $this->othre_brands_list[$keyBl] = json_decode($this->othre_brands_list[$keyBl]);
                if (str_contains($this->othre_brands_list[$keyBl], ',')) { 
                    $this->othre_brands_list[$keyBl] = explode(",", $this->othre_brands_list[$keyBl]);
                }
                else
                {
                    $this->othre_brands_list[$keyBl] = [$this->othre_brands_list[$keyBl]];
                }
            }
            
            foreach($this->othre_brands_list[$keyBl] as $othre_brands_listInsert)
            {
                CompetitorBrand::firstOrCreate(['competitor_brands'=>$othre_brands_listInsert,'brand'=>$brands_list]);
            }
            if(!empty(json_decode($this->competitor_brands_list[$keyBl])))
            {
                $this->competitor_brands_list[$keyBl] = json_decode($this->competitor_brands_list[$keyBl]);
            }
            else
            {
                $this->competitor_brands_list[$keyBl] = [];
            }
            $this->competitor_brands_list[$keyBl] = array_merge($this->competitor_brands_list[$keyBl],$this->othre_brands_list[$keyBl]);

        }

        $newCrmData['related_to'] = $this->related_to;
        $newCrmData['newCustomer'] = $this->newCustomer;
        $newCrmData['crm_start_date_time'] = $this->crm_start_date_time;
        $newCrmData['crm_end_date_time'] = $this->crm_end_date_time;
        $newCrmData['customer_name'] = $this->customer_name;
        $newCrmData['customer_email'] = $this->customer_email;
        $newCrmData['country'] = $this->country;
        $newCrmData['teritory'] = $this->territory;
        $newCrmData['country_code_no'] = $this->country_code;
        $newCrmData['mobile_no'] = $this->mobile_no;
        $newCrmData['phone_no'] = $this->phone_no;
        $newCrmData['company_address'] = $this->company_address;
        $newCrmData['customer_type'] = $this->customer_type;
        $newCrmData['business_category'] = $this->business_category;
        $newCrmData['marketing_channel'] = $this->marketing_channel;
        
        $newCrmData['our_brand'] = json_encode($this->brands_list);
        $newCrmData['competitor_brand'] = json_encode($this->competitor_brands_list);
        $newCrmData['crm_description'] = $this->crm_description;
        
        
        $newCrmData['crm_status'] = 1;
        $newCrmData['crm_action'] = 1;
        $newCrmData['user_id'] =  Session::get('user')->id;
        $newCrmData['created_by'] =  Session::get('user')->id;
        $crmInsertResponse = Crms::create($newCrmData);
        $this->crmId = $crmInsertResponse->id;

        if($this->related_to==4)
        {
            
            foreach($this->selectedSampleItemPartDescription as $samKey => $sampleItemList)
            {
                $sampleData=[];
                $sampleData['company'] = $this->selectedSampleItemCompany[$samKey];
                $sampleData['crm_id'] = $this->crmId;
                $sampleData['partNum'] = $this->selectedSampleItemPartNum[$samKey];
                $sampleData['partDescription'] = $sampleItemList;
                $sampleData['prodCode'] = $this->selectedSampleItemProdCode[$samKey];

                if(!$this->newCustomer)
                {
                    $customerDetails = json_decode($this->selectedCustomer);
                    $sampleData['cust_id'] = isset($customerDetails->CustID)?$customerDetails->CustID:'';
                    $sampleData['cust_num'] = isset($customerDetails->CustNum)?$customerDetails->CustNum:'';
                    $sampleData['zip'] = isset($customerDetails->Zip)?$customerDetails->Zip:'';
                }
                $sampleData['cutomer_name'] = $this->customer_name;
                $sampleData['teritory'] = $this->territory;
                $sampleData['state'] = $this->territory;
                $sampleData['country'] = $this->country;
                $sampleData['company_address'] = $this->company_address;
                $sampleData['phone_num'] = $this->phone_no;
                $sampleData['email_address'] = $this->customer_email;
                $sampleData['mobile_no'] = $this->mobile_no;
                $sampleData['status'] = 0;
                $sampleData['department'] = 0;
                $sampleData['created_by'] = Session::get('user')->id;
                $this->saveSampleRequest($sampleData);
            }
            $this->emailSampleRequest($this->crmId);
            
        }
        else if($this->related_to==9){
            $this->assignDeligatedTo($this->deligated_to);
        }
        if($this->related_to==12){
            $this->assignComplaintsTo($this->deligated_to);
        }

        $inquiryLogsData = [
            'status' =>1,
            'crm_id' => $this->crmId,
            'description' => json_encode($newCrmData),
            'action_message' => $this->crm_description,
            'crm_updation_date_time'=>Carbon::now(),
            'crm_status' =>1,
            'crm_action' =>1,
        ];
        if($this->related_to==2){
            $inquiryLogsData['quote_estimated_value'] = $this->quote_estimated_value;
        }
        CrmLogs::create($inquiryLogsData);//Inserting inquiry Detaisl
        $this->showNewCrmModal=false;
        $this->dispatchBrowserEvent('hideNewCrmModal', [
            'type' => 'success',
            'message' => 'CRM Created Successfully..!',
        ]);
        
        
        
    }
    public function closeCrmModel()
    {
        
    }

    public function assignDeligatedTo($userId)
    {
        $userDetails = User::find($userId);
        $files=null;
        $mailData = [
            'name' => $userDetails->name,
            'body' => 'New CRM is deligated to you, check the below link to view your CRM '.URL::to("/crm-details/".$this->crmId),
            'title' => 'CRM Inquiry Deligation',
            'email' => $userDetails->email,
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

    public function assignComplaintsTo($userId){
        $userDetails = User::find($userId);
        $files=null;
        $mailData = [
            'name' => $userDetails->name,
            'body' => 'New CRM is complaint deligated to you, check the below link to view your CRM '.URL::to("/crm-details/".$this->crmId),
            'title' => 'CRM Complaints Deligation',
            'email' => $userDetails->email,
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

    public function saveSampleRequest($sampleData)
    {
        $sampleInsertResponse = Sample::create($sampleData);
        $sampleInsertLog = [
            'sample_order_id'=>$sampleInsertResponse->id,
            'updates'=>json_encode($sampleData),
            'status'=>0,
            'department'=>0,
            'created_by'=>Session::get('user')->id,
        ];
        SampleLogs::create($sampleInsertLog);
    }

    public function emailSampleRequest($crmId)
    {
        $userDetails = User::where(['usertype'=>6])->get();
        $files=null;
        foreach($userDetails as $sendEMail){
            $mailData = [
                'name' => $sendEMail->name,
                'body' => 'New Sample Request are created, check the below link to view the sample requests '.URL::to("/sample-details/".$crmId),
                'title' => 'CRM Samples Requests Approvals',
                'email' => $sendEMail->email,
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

    public function crmView($id){

        $crmDetails = Crms::select('crms.*','users.name as userName','users.email as userEmail')
        ->leftjoin('users','users.id','=','crms.created_by')
        ->with('teritoryInfo')
        ->with('countryInfo')
        ->with('userInfo')
        ->where(['crms.id'=>$id])
        ->first();

        //dd($crmDetails->teritoryInfo['territory_name']);
        $this->showcrmUpdateMessage = false;
        $this->showReminderUpdateMessage = false;
        $this->showEmailUpdateMessage = false;
        $this->crmUpdateMessage = null;
        $this->upd_crm_status = null;
        $this->crmSamplesDisplay = false;
        $this->crmComplaintsDisplay = false;
        
        $this->showCrmDetailsModal=true;
        $crmDetails = (object)$crmDetails;
        $this->crmTitle =  'CRM #'.$crmDetails->id;

        if($crmDetails->related_to==4)
        {
            $this->crmSamplesDisplay = true;
            $sampleQuery = Sample::with('userInfo')->with('teritoryInfo')->with('countryInfo')->with('samplelogs');
            if(!in_array(Session::get('user')->usertype,config('common.sampleshowAll')))
            {
                $sampleQuery = $sampleQuery->where(['created_by'=>Session::get('user')->id]);
            }
            $sampleQuery = $sampleQuery->where('crm_id','=',$id);
            $this->crmsampleItems = $sampleQuery->get();
            //dd($this->sampleItems);
        }

        if($crmDetails->related_to==12 || $crmDetails->related_to==9)
        {
            $this->crmSamplesDisplay = false;
            $this->crmComplaintsDisplay = true;
            if($crmDetails->related_to==12){
                $this->labelTileRelate = 'Complaint';
            }
            else
            {
                $this->labelTileRelate = 'Inquiry';
            }
        }

        $this->dtl_crm_id = $crmDetails->id;
        $this->dtl_related_to = $crmDetails->related_to;
        $this->dtl_deligated_to = $crmDetails->deligated_to;
        $this->dtl_deligated_by = $crmDetails->deligated_by;
        $this->dtl_crm_start_date_time = $crmDetails->crm_start_date_time;
        $this->dtl_crm_end_date_time = $crmDetails->crm_end_date_time;
        $this->dtl_crm_followup_date_time = $crmDetails->crm_followup_date_time;
        $this->dtl_our_brand = $crmDetails->our_brand;
        $this->dtl_competitor_brand = $crmDetails->competitor_brand;
        $this->dtl_quote_estimated_value = $crmDetails->quote_estimated_value;
        $this->dtl_customer_name = $crmDetails->customer_name;
        $this->dtl_customer_email = $crmDetails->customer_email;
        $this->dtl_alternative_email = $crmDetails->alternative_email;
        $this->dtl_country_code_no = $crmDetails->country_code_no;
        $this->dtl_mobile_no = $crmDetails->mobile_no;
        $this->dtl_company_name = $crmDetails->company_name;
        $this->dtl_company_address = $crmDetails->company_address;
        $this->dtl_phone_no = $crmDetails->phone_no;
        $this->dtl_customer_type = $crmDetails->customer_type;
        $this->dtl_newCustomer = $crmDetails->newCustomer;
        $this->dtl_crm_description = $crmDetails->crm_description;
        $this->dtl_business_category = $crmDetails->business_category;
        $this->dtl_marketing_channel = $crmDetails->marketing_channel;
        $this->dtl_teritory = $crmDetails->teritoryInfo['territory_name'];
        $this->dtl_country = $crmDetails->countryInfo['country_name'];
        $this->dtl_crm_status = $crmDetails->crm_status;
        $this->dtl_crm_reminder = $crmDetails->crm_reminder;
        $this->dtl_crm_remind_on = $crmDetails->crm_remind_on;
        $this->dtl_crm_action = $crmDetails->crm_action;
        $this->dtl_crm_quatation = $crmDetails->crm_quatation;
        $this->dtl_crm_followup = $crmDetails->crm_followup;
        $this->dtl_crm_negosiation = $crmDetails->crm_finalstatus;
        $this->dtl_crm_attachment = $crmDetails->crm_attachment;
        $this->dtl_order_number = $crmDetails->order_number;
        $this->dtl_created_at = $crmDetails->created_at;
        $this->dtl_updated_at = $crmDetails->updated_at;
        $this->dtl_userName = $crmDetails->userName;
        $this->dtl_userEmail = $crmDetails->userEmail;
        $this->dtl_teritory_info = $crmDetails->teritoryInfo;
        $this->dtl_country_info = $crmDetails->countryInfo;
        $this->dtl_user_info = $crmDetails->userInfo;
        $this->reminderEmailSubject = 'Reminder of #'.$crmDetails->id;

        $this->sendEailSubject = '#'.$crmDetails->id.' CRM Updates EMail';

        $this->dtl_crmLogs = CrmLogs::where(['crm_id'=>$crmDetails->id])->orderBy('id','DESC')->get();
        $this->dtl_crmReminderLogs = CrmLogs::where(['crm_id'=>$crmDetails->id])->where('crm_reminder','!=',Null)->orderBy('id','DESC')->get();
        $this->dtl_emailLogs = EmailLog::where(['crm_id'=>$crmDetails->id])->orderBy('id','DESC')->get();
        $this->dispatchBrowserEvent('showCrmDetailsModal');
    }

    public function saveCrmStatus(){

        $validatedData = $this->validate([
            'upd_crm_status' => 'required',
            'crm_updation_date_time' => 'required',
            'action_message' => 'required',
        ]);

        $crmUpdateData['crm_status'] = $this->upd_crm_status;
        $crmUpdateData['crm_action'] = $this->upd_crm_status;
        $crmUpdateData['crm_updation_date_time'] = $this->crm_updation_date_time;

        $crmUpdateData['quote_estimated_value'] = $this->log_quote_estimated_value;
        $crmUpdateData['order_number'] = $this->order_number;
        //dd($crmUpdateData);
        Crms::find($this->dtl_crm_id)->update($crmUpdateData);
        
        $crmUpdateLogData['crm_id']=$this->dtl_crm_id;
        $crmUpdateLogData['description'] = json_encode($crmUpdateData);
        if($this->updation_attachment)
        {
            $crmUpdateLogData['updation_attachment'] = $this->updation_attachment->store('crm', 'public');
        }
        $crmUpdateLogData['action_message'] = $this->action_message;
        $crmUpdateLogData['crm_status'] = $this->upd_crm_status;
        $crmUpdateLogData['crm_action'] = $this->upd_crm_status;
        $crmUpdateLogData['crm_updation_date_time'] = $this->crm_updation_date_time;
        $crmUpdateLogData['quote_estimated_value'] = $this->log_quote_estimated_value;
        CrmLogs::create($crmUpdateLogData);
        $this->dtl_crm_status=$this->upd_crm_status;
        $this->crm_updation_date_time=null;
        $this->log_quote_estimated_value=null;
        $this->order_number=null;
        $this->action_message=null;
        $this->action_message=null;
        $this->dtl_crmLogs = CrmLogs::where(['crm_id'=>$this->dtl_crm_id,'crm_reminder'=>Null])->orderBy('id','DESC')->get();
        $this->showcrmUpdateMessage = true;
        $this->crmUpdateMessage = 'CRM Status Updated Successfully..!';
    }

    public function saveCrmReminder()
    {
        $validatedData = $this->validate([
            'upd_crm_remind_on' => 'required',
        ]);
        
        $crmUpdateRemindData['crm_id']=$this->dtl_crm_id;
        $crmUpdateRemindData['subject']=$this->reminderEmailSubject;
        $crmUpdateRemindData['message']=$this->reminderEmailMessage;
        $crmUpdateRemindData['toEmail']=$this->dtl_user_info['email'];
        $crmUpdateRemindData['toName']=$this->dtl_user_info['name'];
        $crmUpdateRemindData['date_on']=$this->upd_crm_remind_on;
        $crmUpdateRemindData['user_id']=$this->dtl_user_info['id'];
        $crmUpdateRemindData['status']=0;
        $crmUpdateRemindData['is_open']=0;
        $crmUpdateRemindData['is_sound']=0;
        $crmUpdateRemindData['is_send']=0;
        CrmReminder::create($crmUpdateRemindData);

        $crmUpdateLogData['crm_id']=$this->dtl_crm_id;
        $crmUpdateLogData['description'] = json_encode($crmUpdateRemindData);
        $crmUpdateLogData['action_message'] = $this->reminderEmailMessage;
        $crmUpdateLogData['crm_reminder'] = 1;
        $crmUpdateLogData['crm_remind_on'] = $this->upd_crm_remind_on;
        CrmLogs::create($crmUpdateLogData);


        $this->reminderEmailMessage=null;
        $this->upd_crm_remind_on=null;
        $this->reminderEmailSubject=null;
        $this->dtl_crmReminderLogs = CrmLogs::where(['crm_id'=>$this->dtl_crm_id])->where('crm_reminder','!=',Null)->orderBy('id','DESC')->get();
        $this->dtl_crmLogs = CrmLogs::where(['crm_id'=>$this->dtl_crm_id,'crm_reminder'=>Null])->orderBy('id','DESC')->get();

        $this->showReminderUpdateMessage = true;
        $this->reminderUpdateMessage = 'CRM Reminder Created Successfully..!';
    }

    public function sendCrmEmail(){
        $validateEmail['customerEmailMessage'] = 'required';

        if($this->dontSendToCustomer)
        {
            $validateEmail['other_email_address'] = 'required';
            $crmEmailData['toEmail'] = $this->other_email_address;
            $emailSenderName = $this->other_email_address;
        }
        else
        {
            $crmEmailData['toEmail'] = $this->dtl_customer_email;
            $emailSenderName = $this->dtl_customer_name;
        }
        $validatedData = $this->validate($validateEmail);

        $crmEmailData['crm_id']=$this->dtl_crm_id;
        $crmEmailData['subject']=$this->sendEailSubject;
        $crmEmailData['message']=$this->customerEmailMessage;
        $files = null;
        if($this->customerEmailInputFile)
        {
            $crmEmailData['attachment'] = $this->customerEmailInputFile->store('crm_email', 'public');
            $files = [
                public_path('storage/'.$crmEmailData['attachment']),
            ];
        }

        $crmEmailData['bccEmail']=$this->sendEailCC;
        $crmEmailData['ccEmail']=$this->sendEailBCC;
        $crmEmailData['user_id']=$this->dtl_user_info['id'];
        //dd($crmEmailData);
        EmailLog::create($crmEmailData);
        
        $mailData = [
            'name' => $emailSenderName,
            'body' => $this->customerEmailMessage,
            'title' => $crmEmailData['subject'],
            'email' => $crmEmailData['toEmail'],
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

        
        $this->showEmailUpdateMessage = true;
        $this->emailUpdateMessage = 'CRM Email Send Successfully..!';
    }

    
    public function exportExcel() 
    {
        $crmQuery = Crms::select('crms.id','crms.crm_status','crms.crm_action','crms.newCustomer','crms.customer_name','crms.company_address','crms.customer_email','crms.mobile_no','crms.phone_no','countries.country_name','territories.territory_name','crms.customer_type','crms.business_category','crms.marketing_channel', 'crms.related_to','crms.crm_start_date_time','crms.crm_end_date_time','crms.crm_followup_date_time','crms.our_brand','crms.competitor_brand','crms.crm_description','u2.name as created_by','u3.name as assigned_to','crms.created_at','crms.updated_at')
        ->leftjoin('users','users.id','=','crms.created_by')
        ->leftjoin('territories','territories.id','=','crms.teritory')
        ->join('countries','countries.id','=','crms.country')
        ->join('users as u1','u1.id','=','crms.assigned_id')
        ->join('users as u2','u1.id','=','crms.created_by')
        ->join('users as u3','u1.id','=','crms.assigned_id')
        ->orderBy('crms.id','DESC')
        ->paginate(1);
        dd($crmQuery);
        //return Excel::download(new CrmExport($crmQuery), 'crms.xlsx');
    }

    public function exportExcelCRM()
    {
        $crmQuery = CrmLogs::select('crms.id',
            \DB::raw('(CASE 
                WHEN crm_logs.crm_status = 1 THEN "New" 
                WHEN crm_logs.crm_status = 2 THEN "Quotation" 
                WHEN crm_logs.crm_status = 3 THEN "Followup" 
                WHEN crm_logs.crm_status = 4 THEN "Won" 
                WHEN crm_logs.crm_status = 5 THEN "Loss" 
                WHEN crm_logs.crm_status = 6 THEN "Addressed and solved"
                WHEN crm_logs.crm_status = 7 THEN "Addressed but unsolved"
                WHEN crm_logs.crm_status = 8 THEN "Not addressed"
                WHEN crm_logs.crm_status = 9 THEN "Complaints Not relevant"
                WHEN crm_logs.crm_status = 10 THEN "Followed up with customer"
                WHEN crm_logs.crm_status = 11 THEN "Did not follow-up"
                WHEN crm_logs.crm_status = 12 THEN "Inquiry Not relevant"
                WHEN crm_logs.crm_status = 13 THEN "Approved and order placed"
                WHEN crm_logs.crm_status = 14 THEN "Approved awaiting order"
                WHEN crm_logs.crm_status = 15 THEN "Approved but don’t want to add to menu"
                WHEN crm_logs.crm_status = 16 THEN "Not Approved due to Price"
                WHEN crm_logs.crm_status = 17 THEN "Not Approved due to Quality"
                WHEN crm_logs.crm_status = 18 THEN "Awaiting owners confirmation"
                WHEN crm_logs.crm_status = 19 THEN "Sample not tried yet"
                WHEN crm_logs.crm_status = 20 THEN "Followed and converted"
                END) AS crm_status'),
            \DB::raw('(CASE 
                WHEN crm_logs.crm_action = 1 THEN "New CRM Created" 
                WHEN crm_logs.crm_action = 2 THEN "Updated to Quotation" 
                WHEN crm_logs.crm_action = 3 THEN "Created Followup" 
                WHEN crm_logs.crm_action = 4 THEN "Marked as CRM Won" 
                WHEN crm_logs.crm_action = 5 THEN "Marked as CRM Loss"
                WHEN crm_logs.crm_action = 6 THEN "Addressed and solved"
                WHEN crm_logs.crm_action = 7 THEN "Addressed but unsolved"
                WHEN crm_logs.crm_action = 8 THEN "Not addressed"
                WHEN crm_logs.crm_action = 9 THEN "Complaints Not relevant"
                WHEN crm_logs.crm_action = 10 THEN "Followed up with customer"
                WHEN crm_logs.crm_action = 11 THEN "Did not follow-up"
                WHEN crm_logs.crm_action = 12 THEN "Inquiry Not relevant"
                WHEN crm_logs.crm_action = 13 THEN "Approved and order placed"
                WHEN crm_logs.crm_action = 14 THEN "Approved awaiting order"
                WHEN crm_logs.crm_action = 15 THEN "Approved but don’t want to add to menu"
                WHEN crm_logs.crm_action = 16 THEN "Not Approved due to Price"
                WHEN crm_logs.crm_action = 17 THEN "Not Approved due to Quality"
                WHEN crm_logs.crm_action = 18 THEN "Awaiting owners confirmation"
                WHEN crm_logs.crm_action = 19 THEN "Sample not tried yet"
                WHEN crm_logs.crm_action = 20 THEN "Followed and converted" 
                END) AS crm_action'),
            \DB::raw('(CASE 
                WHEN crms.newCustomer = 0 THEN "Existing Customer" 
                WHEN crms.newCustomer = 1 THEN "New Customer" 
                WHEN crms.newCustomer = 2 THEN "Existing Customer"
                END) AS newCustomer'),
            'crms.customer_name','crms.company_address','crms.customer_email','crms.mobile_no','crms.phone_no','countries.country_name','territories.territory_name',
            \DB::raw('(CASE 
                WHEN crms.customer_type = 0 THEN "None" 
                WHEN crms.customer_type = 1 THEN "Walk In" 
                WHEN crms.customer_type = 2 THEN "Email"
                WHEN crms.customer_type = 3 THEN "Telphone"
                WHEN crms.customer_type = 4 THEN "Social Media"
                END) AS customer_type'),
            \DB::raw('(CASE 
                WHEN crms.business_category = 1 THEN "Ice Cream Shops" 
                WHEN crms.business_category = 2 THEN "Coffee Shops"
                WHEN crms.business_category = 3 THEN "Restaurants"
                WHEN crms.business_category = 4 THEN "Trade & Retail"
                WHEN crms.business_category = 5 THEN "Hotels"
                WHEN crms.business_category = 6 THEN "Chocolates"
                WHEN crms.business_category = 7 THEN "Corporate Office"
                WHEN crms.business_category = 8 THEN "Home Use- Private Individual"
                WHEN crms.business_category = 9 THEN "Government"
                WHEN crms.business_category = 10 THEN "Shisha Shops / Parlours"
                WHEN crms.business_category = 11 THEN "Cafeterias"
                WHEN crms.business_category = 12 THEN "Groceries"
                WHEN crms.business_category = 13 THEN "Supermarket"
                END) AS business_category'),
            \DB::raw('(CASE 
                WHEN crms.marketing_channel = 1 THEN "None" 
                WHEN crms.marketing_channel = 1 THEN "Social Media" 
                WHEN crms.marketing_channel = 2 THEN "Referral"
                WHEN crms.marketing_channel = 3 THEN "Digital Screen"
                WHEN crms.marketing_channel = 4 THEN "Web Site"
                WHEN crms.marketing_channel = 5 THEN "Exhibition"
                END) AS marketing_channel'),
            \DB::raw('(CASE 
                WHEN crms.related_to = 1 THEN "Meeting" 
                WHEN crms.related_to = 2 THEN "Quotation"
                WHEN crms.related_to = 3 THEN "Demo"
                WHEN crms.related_to = 4 THEN "Samples"
                WHEN crms.related_to = 5 THEN "Delivery"
                WHEN crms.related_to = 6 THEN "Cheque Collection"
                WHEN crms.related_to = 7 THEN "Follow-up Meeting"
                WHEN crms.related_to = 8 THEN "Exhibition"
                WHEN crms.related_to = 9 THEN "Inquiry"
                WHEN crms.related_to = 10 THEN "Training"
                WHEN crms.related_to = 11 THEN "Orientation"
                WHEN crms.related_to = 12 THEN "Complaint"
                WHEN crms.related_to = 13 THEN "Cold Calling"
                END) AS related_to'),
            'crms.crm_description',
            'crms.crm_start_date_time','crms.crm_end_date_time','crm_logs.crm_updation_date_time','crm_logs.action_message','crms.our_brand','crms.competitor_brand','users.name as created_by','assu.name as assigned_user','crms.created_at','crms.updated_at')
        ->leftjoin('crms','crms.id','=','crm_logs.crm_id')
        ->leftjoin('users','users.id','=','crms.created_by')
        ->leftjoin('users as assu','assu.id','=','crms.assigned_id')
        ->leftjoin('territories','territories.id','=','crms.teritory')
        ->join('countries','countries.id','=','crms.country');

        if(!Session::get('user')->isadmin)
        {
            $crmQuery = $crmQuery->where(['assigned_id'=>Session::get('user')->id,'is_deleted' => 0]);
        }
        else
        {
            $crmQuery = $crmQuery->where(['is_deleted' => 0]);
        }

        if(!empty($this->filter_search)){

            $crmQuery = $crmQuery->where('crms.customer_name', 'like', "%{$this->filter_search}%");
        }
        if(!empty($this->crm_search_crm_id)){

            $crmQuery = $crmQuery->where('crms.id', 'like', "%{$this->crm_search_crm_id}%");
        }

        if(!empty($this->crm_search_related_to)){

            $crmQuery = $crmQuery->where('crms.related_to', '=', $this->crm_search_related_to);
        }
        if(!empty($this->crm_search_delegated_to))
        {
            $crm_search_delegated_to = $this->crm_search_delegated_to;
            $crmQuery = $crmQuery->whereHas('userInfo', function ($q) use ($crm_search_delegated_to)
                {
                    $q->where('name', 'like', "%{$this->crm_search_delegated_to}%");
                }
            );
        }
        if(!empty($this->crm_search_status))
        {
            $crmQuery = $crmQuery->where('crms.crm_status', '=', $this->crm_search_status);
        }
        if(!empty($this->crm_search_new_customer))
        {
            $crmQuery = $crmQuery->where('crms.newCustomer', '=', $this->crm_search_new_customer);
        }
        if(!empty($this->crm_search_created_by)){

            $crmQuery = $crmQuery->where('users.name', 'like', "%{$this->crm_search_created_by}%");
        }

        if(!empty($this->filter_from_date) && !empty($this->filter_to_date)){
            $crmQuery = $crmQuery->where('crm_logs.crm_updation_date_time','>=', $this->filter_from_date)->where('crm_logs.crm_updation_date_time','<=',$this->filter_to_date);
        }
        $crmQuery = $crmQuery->groupBy('crm_logs.id')->get();
        //dd($crmQuery);
        return Excel::download(new CrmExport($crmQuery), 'crms.xlsx');
    }

    public function crmUpdateSample($sample)
    {
        $sampleId = $sample['id'];
        $crm_id = $sample['crm_id'];
        $validatedData = $this->validate([
            'crm_sample_update_status.'.$sampleId => 'required',
            'crm_sample_updation_date_time.'.$sampleId => 'required',
            'crm_sample_action_message.'.$sampleId => 'required',
        ]);

        $crmUpdateData['crm_status'] = $this->crm_sample_update_status[$sampleId];
        $crmUpdateData['crm_action'] = $this->crm_sample_update_status[$sampleId];
        $crmUpdateData['crm_updation_date_time'] = $this->crm_sample_updation_date_time[$sampleId];
        Crms::find($crm_id)->update($crmUpdateData);
        
        $crmUpdateLogData['crm_id']=$crm_id;
        $crmUpdateLogData['description'] = json_encode($crmUpdateData);
        $crmUpdateLogData['action_message'] = $this->crm_sample_action_message[$sampleId];
        $crmUpdateLogData['crm_status'] = $this->crm_sample_update_status[$sampleId];
        $crmUpdateLogData['crm_action'] = $this->crm_sample_update_status[$sampleId];
        $crmUpdateLogData['crm_updation_date_time'] = $this->crm_sample_updation_date_time[$sampleId];
        CrmLogs::create($crmUpdateLogData);

        $this->dtl_crm_status=$this->crm_sample_update_status[$sampleId];
        $this->crm_updation_date_time=null;
        $this->log_quote_estimated_value=null;
        $this->order_number=null;
        $this->action_message=null;
        $this->action_message=null;
        $this->dtl_crmLogs = CrmLogs::where(['crm_id'=>$crm_id,'crm_reminder'=>Null])->orderBy('id','DESC')->get();
        $this->showcrmUpdateMessage = true;
        $this->crmUpdateMessage = 'CRM Sample Status Updated Successfully..!';
    }

    public function crmUpdateComplaints($crmId){
        $validatedData = $this->validate([
            'crm_complaints_update_status' => 'required',
            'crm_complaints_updation_date_time' => 'required',
            'crm_complaints_action_message' => 'required',
        ]);
        
        $crmUpdateData['crm_status'] = $this->crm_complaints_update_status;
        $crmUpdateData['crm_action'] = $this->crm_complaints_update_status;
        $crmUpdateData['crm_updation_date_time'] = $this->crm_complaints_updation_date_time;
        Crms::find($crmId)->update($crmUpdateData);
        
        $crmUpdateLogData['crm_id']=$crmId;
        $crmUpdateLogData['description'] = json_encode($crmUpdateData);
        $crmUpdateLogData['action_message'] = $this->crm_complaints_action_message;
        $crmUpdateLogData['crm_status'] = $this->crm_complaints_update_status;
        $crmUpdateLogData['crm_action'] = $this->crm_complaints_update_status;
        $crmUpdateLogData['crm_updation_date_time'] = $this->crm_complaints_updation_date_time;
        CrmLogs::create($crmUpdateLogData);

        $this->dtl_crm_status=$this->crm_complaints_update_status;
        $this->crm_updation_date_time=null;
        $this->log_quote_estimated_value=null;
        $this->order_number=null;
        $this->action_message=null;
        $this->action_message=null;
        $this->dtl_crmLogs = CrmLogs::where(['crm_id'=>$crmId,'crm_reminder'=>Null])->orderBy('id','DESC')->get();
        $this->showcrmUpdateMessage = true;
        $this->crmUpdateMessage = 'CRM Sample Status Updated Successfully..!';
    }
}
