<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="crmDetailModal" tabindex="-1" role="dialog" aria-labelledby="crmDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceUpdateModalLabel">{{$crmTitle}} </h5>
                <p class="float-end mb-0">CRM Status: <span class=" badge {{config('common.crm_status_btn')[$dtl_crm_status]}}">{{config('common.crm_status')[$dtl_crm_status]}}</span></p>
                <p class="float-end mb-0">Last Action In: <span class=" badge {{config('common.crm_status_btn')[$dtl_crm_status]}}">{{config('common.crm_action')[$dtl_crm_action]}}</span></p>
            </div>
            <div class="modal-body">
                <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pt-0 pb-0">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-5 mt-0">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">CRM Details - ({{config('common.new_customer')[$dtl_newCustomer]}})</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
                                <small>{{ \Carbon\Carbon::parse($dtl_created_at)->format('dS M Y H:i A') }}</small>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>
                    <div class="card-body pt-2 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex flex-column w-100">
                                    <h6 class="mb-1 text-dark text-sm">Description:</h6>
                                    <span class="text-xs">{{$dtl_crm_description}}</span>
                                </div>
                            </li>

                            <hr class="horizontal dark">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg py-0">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Related To: </h6>
                                        
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                    {{config('common.crmRelatedTo')[$dtl_related_to]}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg py-0">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-xs">Created By: </h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold text-xs">
                                    {{$dtl_userName}}
                                </div>
                            </li>
                            @if($dtl_related_to==9 || $dtl_related_to==12)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg py-0 pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Deligated To: </h6>
                                        
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_user_info['name']}}
                                </div>
                            </li>
                            @endif
                            <hr class="horizontal dark">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-calendar-alt"></i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Last Updated at</h6>
                                        <span class="text-xs">{{ \Carbon\Carbon::parse($dtl_updated_at)->format('dS M Y H:i A') }}</span>
                                    </div>
                                </div>
                            </li>
                            <hr class="horizontal dark">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-calendar-alt"></i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">CRM Start at</h6>
                                        <span class="text-xs">{{ \Carbon\Carbon::parse($dtl_crm_start_date_time)->format('dS M Y H:i A') }}</span>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-calendar-alt"></i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">CRM Ends at</h6>
                                        <span class="text-xs">{{ \Carbon\Carbon::parse($dtl_crm_end_date_time)->format('dS M Y H:i A') }}</span>
                                    </div>
                                </div>
                            </li>
                            <hr class="horizontal dark">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Customer Details</h6>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Customer Name:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_customer_name}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Customer Email:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_customer_email}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Contact Number:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_mobile_no}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Company Address:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_company_address}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Territory:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_teritory_info['territory_name']}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Country:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_country_info['country_name']}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Phone:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{$dtl_phone_no}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Customer Type:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{config('common.customer_type')[$dtl_customer_type]}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Business Category:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                    {{config('common.business_category')[$dtl_business_category]}}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Marketing Channel:</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                                     @if($dtl_marketing_channel)
                                    {{config('common.crmRelatedTo')[$dtl_marketing_channel]}}
                                    @endif
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Description:</h6>
                                    </div>
                                </div>
                                <div class="align-items-left text-sm text-dark text-gradient text-sm ">
                                    {{$dtl_crm_description}}
                                </div>
                            </li>
                            

                            
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-7 mt-0">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Updates</h6>
                        <hr class="mt-0">
                    </div>
                    <div class="card-body pt-0 p-3">
                        @if($showcrmUpdateMessage)
                            <div class="text-light alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><strong>Success!</strong> {{$crmUpdateMessage}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(!$crmSamplesDisplay && !$crmComplaintsDisplay)
                            <ul class="list-group">
                                <li class="list-group-item border-0  p-2 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="row p-0 m-0">
                                        <h6 class="mb-3 text-sm">CRM Progress and Updates</h6>
                                        <div class="col-md-6">
                                            <div class="row p-0 m-0">
                                                <label for="followupAttachmentInputFile" class="form-control-label required">New Status</label>
                                                <div class="col-md-4">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" wire:model="upd_crm_status" value="3" id="flexRadio3">
                                                        <label class="custom-control-label {{config('common.crm_status_textClass')[3]}}" for="flexRadio3">{{config('common.crm_status')[3]}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" wire:model="upd_crm_status" value="4" id="flexRadio4">
                                                        <label class="custom-control-label {{config('common.crm_status_textClass')[4]}}" for="flexRadio4">{{config('common.crm_status')[4]}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" wire:model="upd_crm_status" value="5" id="flexRadio5">
                                                        <label class="custom-control-label {{config('common.crm_status_textClass')[5]}}" for="flexRadio5">{{config('common.crm_status')[5]}}</label>
                                                    </div>
                                                </div>
                                                @error('upd_crm_status') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="row p-0 m-0 mt-2">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-0" id="form-inputcrmFollowupDateTime">
                                                        <label for="inputcrmFollowupDateTime" class="form-control-label required">Update Date & Time</label>
                                                        <input class="form-control" type="datetime-local" name="crm_updation_date_time" wire:model="crm_updation_date_time" id="inputcrmFollowupDateTime" value="<?=date('Y-m-d',strtotime(' +2 day'));?>T<?=date('H:i');?>">
                                                        @error('crm_updation_date_time') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="followupAttachmentInputFile" class="form-control-label required">Attachment</label>
                                                        <input type="file" class="form-control" name="updation_attachment" wire:model="updation_attachment" id="followupAttachmentInputFile"/>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-12">
                                                    <div class="form-group mb-0" id="form-inputQuoteEstimatedValue">
                                                        <label for="inputQuoteEstimatedValue" class="form-control-label required">Quote Estimated Value</label>
                                                        <input class="form-control" type="number" name="quote_estimated_value" wire:model="log_quote_estimated_value" id="inputQuoteEstimatedValue">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                      <label for="orderNumberInput" class="form-control-label required">Order Number (ERP)</label>
                                                      <input type="text" name="order_number" class="form-control" id="orderNumberInput" wire:model="order_number" placeholder="Order Number (#ERP)" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="action_message" class="form-control-label required">Notes</label>
                                                        <textarea class="form-control" name="action_message" id="action_message" wire:model="action_message" rows="3"></textarea>
                                                        @error('action_message') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div><button type="button" class="btn btn-sm bg-gradient-info" wire:click="saveCrmStatus()" >Save CRM Status</button></div>
                                    </div>
                                </li>
                            </ul>
                        @endif

                        @if($crmComplaintsDisplay)
                            <div class="row">
                                <div class="col-md-12">

                                    <ul class="list-group">
                                        <li class="list-group-item border-0 p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <h6 class="mb-3 text-sm">Complaints Updates</h6>
                                            <div class="row p-0 m-0 mt-2">

                                                <div class="col-md-12 ps-0">
                                                    <div class="form-group">
                                                        <label for="selectCrmComplaintsUpdateStatus">Complaints Status Updation</label>
                                                        <select class="form-control chosen-select" wire:model="crm_complaints_update_status" name="crm_complaints_update_status" id="selectCrmComplaintsUpdateStatus" >
                                                            <option value="">-Select-</option>
                                                            @if($dtl_related_to==12)
                                                            @foreach(config('common.complaints_status_updation') as $cuKey => $complaintsUpdation)
                                                            <option value="{{$cuKey}}">{{$complaintsUpdation}}</option>
                                                            @endforeach
                                                            @elseif($dtl_related_to==9)
                                                            @foreach(config('common.inquiry_status_updation') as $iuKey => $inquiryUpdation)
                                                            <option value="{{$iuKey}}">{{$inquiryUpdation}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @error('crm_complaints_update_status') <span class="mb-4 text-danger"> {{ $message }} </span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ps-0">
                                                    <div class="form-group mb-0" id="form-inputCrmSampleUpdateDateTime">
                                                        <label for="inputCrmcomplaintsUpdateDateTime" class="form-control-label required">Update Date & Time</label>
                                                        <input class="form-control" type="datetime-local" name="crm_complaints_updation_date_time" wire:model="crm_complaints_updation_date_time" id="inputCrmcomplaintsUpdateDateTime" value="<?=date('Y-m-d',strtotime(' +2 day'));?>T<?=date('H:i');?>">
                                                        @error('crm_complaints_updation_date_time') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ps-0">
                                                    <div class="form-group">
                                                        <label for="textareaCrmComplaintsActionMessage" class="form-control-label required">Notes</label>
                                                        <textarea class="form-control" name="crm_complaints_action_message" id="textareaCrmComplaintsActionMessage" wire:model="crm_complaints_action_message" rows="3"></textarea>
                                                        @error('crm_complaints_action_message') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <a href="javascript:;" wire:click="crmUpdateComplaints({{$dtl_crm_id}})" class=" ps-0" >
                                                    <button type="button" class="btn bg-gradient-primary btn-sm ">Update</button>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if($crmSamplesDisplay)
                            <h6 class="mb-3 text-sm">Sample Updates</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        @foreach($crmsampleItems as $key => $sample)
                                        <li class="list-group-item border-0 p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-3 text-sm">{{$sample->partDescription}}</h6>
                                                        <span class="mb-2 text-xs">Part Num: <span class="text-dark font-weight-bold ms-2">{{$sample->partNum}}</span></span>
                                                        <span class="text-xs">Product Code: <span class="text-dark ms-2 font-weight-bold">{{$sample->prodCode}}</span></span>
                                                        <hr class="horizontal dark">
                                                        <div><span class="badge bg-gradient-{{config('common.sample_status_class')[$sample->status]}}">{{config('common.sample_status')[$sample->status]}}</span></div>
                                                        <p class="text-xs text-secondary mb-0">Now in: {{config('common.sample_department')[$sample->department]}}</p>
                                                        <hr class="horizontal dark">
                                                        @if($sample->status==0)
                                                            
                                                        @elseif($sample->status!=5)
                                                            @if(Session::get('user')->usertype == config('common.sample_status_action_userType')[$sample->status])
                                                            <h6 class="mb-0">Make Action </h6>
                                                            
                                                            

                                                            <div class="row p-0 m-0 mt-2">
                                                                <div class="col-md-12 ps-0">
                                                                    <div class="form-group">
                                                                        <label for="selectCrmSampleUpdateStatus">Status Updation</label>
                                                                        <select class="form-control chosen-select" wire:model="crm_sample_update_status.{{$sample->id}}" name="crm_sample_update_status" id="selectCrmSampleUpdateStatus" >
                                                                            <option value="">-Select-</option>
                                                                            @foreach(config('common.sampleUpdation') as $spKey => $sampleUpdation)
                                                                            <option value="{{$spKey}}">{{$sampleUpdation}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('crm_sample_update_status.'.$sample->id) <span class="mb-4 text-danger">Select Sample Status.</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 ps-0">
                                                                    <div class="form-group mb-0" id="form-inputCrmSampleUpdateDateTime">
                                                                        <label for="inputCrmSampleUpdateDateTime" class="form-control-label required">Update Date & Time</label>
                                                                        <input class="form-control" type="datetime-local" name="crm_sample_updation_date_time" wire:model="crm_sample_updation_date_time.{{$sample->id}}" id="inputCrmSampleUpdateDateTime" value="<?=date('Y-m-d',strtotime(' +2 day'));?>T<?=date('H:i');?>">
                                                                        @error('crm_sample_updation_date_time.'.$sample->id) <span class="mb-4 text-danger">Select Sample Updation Date and Time.</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 ps-0">
                                                                    <div class="form-group">
                                                                        <label for="textareaCrmActionMessage" class="form-control-label required">Notes</label>
                                                                        <textarea class="form-control" name="crm_sample_action_message" id="textareaCrmActionMessage" wire:model="crm_sample_action_message.{{$sample->id}}" rows="3"></textarea>
                                                                        @error('crm_sample_action_message.'.$sample->id) <span class="mb-4 text-danger">Enter sample note.</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <a href="javascript:;" wire:click="crmUpdateSample({{$sample}})" class=" ps-0" >
                                                                    <button type="button" class="btn bg-gradient-primary btn-sm ">Update</button>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(count($sample->samplelogs)>0)
                                                    <div class="col-md-6">
                                                        <h6 class="mb-0">Track</h6>
                                                        @foreach($sample->samplelogs as $samplelog)
                                                            <figure>
                                                                <blockquote class="blockquote">
                                                                <p class="ps-2 text-{{config('common.sample_status_class')[$samplelog['status']]}}"><b> {{config('common.sample_status')[$samplelog['status']]}}</b>  @if($samplelog['command'])- <small>({{$samplelog['command']}})</small>@endif</p>

                                                                </blockquote>
                                                                <figcaption class="blockquote-footer ps-3"><span class="text-{{config('common.sample_status_class')[$samplelog['status']]}}">Now in {{config('common.sample_department')[$samplelog['department']]}}</span>
                                                                </figcaption>
                                                                <figcaption class="blockquote-footer ps-3">Updated By: {{$samplelog->userInfo['name']}}<br><small><cite title="Source Title">On: {{ \Carbon\Carbon::parse($samplelog['created_at'])->format('dS M Y H:i A') }}</cite></small>
                                                                </figcaption>
                                                            </figure>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <hr>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if(count($dtl_crmLogs)>0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-md">CRM Updates History </h4>
                                    @foreach($dtl_crmLogs as $crmKey => $crmLog)
                                        <figure>
                                            <blockquote class="blockquote">
                                                <p class="ps-2 {{config('common.crm_status_textClass')[$crmLog->crm_action]}} ">{{config('common.crm_action')[$crmLog->crm_action]}}</p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer ps-3">
                                                {{$crmLog->action_message}}
                                                @if($crmLog->crm_followup_date_time)
                                                    <br> Crm Followup Date & Time: <b> {{$crmLog->crm_followup_date_time}}</b>
                                                @endif
                                                @if($crmLog->quote_estimated_value)
                                                    <br> Quote estimated value: <b>{{$crmLog->quote_estimated_value}}</b>
                                                @endif
                                                @if($crmLog->crm_action==0)
                                                <br><small><cite title="Source Title">Created On: {{ \Carbon\Carbon::parse($crmLog->created_at)->format('dS M Y H:i A') }} </cite></small>
                                                @else
                                                <br><small><cite title="Source Title">Updated On: {{ \Carbon\Carbon::parse($crmLog->created_at)->format('dS M Y H:i A') }} </cite></small>
                                                @endif
                                                
                                                @if($crmLog->updation_attachment)
                                                    <!-- Button trigger modal -->
                                                    <div class="row">
                                                        <?php
                                                        $docType = explode(".",$crmLog->updation_attachment);
                                                        //echo $docType[1];
                                                        $expensions= array("jpeg","jpg","png","gif","webp","tiff","ssvg","pdf");
                                                        if(in_array($docType[1],$expensions)=== true){
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <button type="button" class="btn btn-block btn-default mb-2 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$crmKey}}">Open Attachment</button>
                                                                </div>
                                                            </div>
                                                            <embed data-bs-toggle="modal" data-bs-target="#exampleModal{{$crmKey}}" src="{{url('storage/'.$crmLog->updation_attachment)}}" data-bs-toggle="modal" data-bs-target="#exampleModal{{$crmKey}}"  style="width: 200px;" />
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$crmKey}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" style="height;700px;">
                                                                            <embed data-bs-toggle="modal" data-bs-target="#exampleModal{{$crmKey}}" src="{{url('storage/'.$crmLog->updation_attachment)}}" width="100%" height="100%" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <iframe class="doc" src="https://docs.google.com/gview?url={{url('storage/'.$crmLog->crm_attachment)}}&embedded=true"></iframe>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                @endif
                                            </figcaption>
                                        </figure>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                            
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Reminder</h6>
                        <hr class="mt-0">
                    </div>
                    <div class="card-body pt-0 p-3">
                        @if($showReminderUpdateMessage)
                        <div class="text-light alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success!</strong> {{$reminderUpdateMessage}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <ul class="list-group">
                            <li class="list-group-item border-0 p-2 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <div class="row p-0 m-0">
                                    
                                    <h6 class="mb-3 text-sm">CRM Reminder</h6>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch ps-0">
                                            <div class="form-check form-switch ps-0" >
                                                <?php
                                                if(@$crmData->crm_remind_on!=null){
                                                    $crm_reminder_date = date('Y-m-d',strtotime($crmData->crm_remind_on));
                                                    $crm_reminder_time = date('H:i',strtotime($crmData->crm_remind_on));
                                                }
                                                else
                                                {
                                                  $crm_reminder_date = date('Y-m-d');
                                                  $crm_reminder_time = date('H:i');
                                                }
                                                
                                                $crm_reminderDT =  date("Y-m-d",strtotime($crm_reminder_date)).'T'.date("H:i",strtotime($crm_reminder_time));

                                                ?>
                                                <input class="form-control" type="datetime-local" value="<?=$crm_reminderDT;?>" name="crm_remind_on" wire:model="upd_crm_remind_on" id="example-datetime-local-input"> 
                                                @error('upd_crm_remind_on') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden"  name="reminderEmailSubject" wire:model="reminderEmailSubject" value="Reminder of #<?php printf("%01d", $dtl_crm_id); ?> <?=substr($dtl_crm_description,0,40);?>">
                                                <label for="reminderEmailMessageTextarea">Message of Reminder</label>
                                                <textarea class="form-control" id="reminderEmailMessageTextarea" name="reminderEmailMessage" wire:model="reminderEmailMessage" rows="3">Reminder of #<?php printf("%01d", $dtl_crm_id); ?> <?=substr($dtl_crm_description,0,40);?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div><button type="button" class="btn btn-sm bg-gradient-info"  wire:click="saveCrmReminder()" >Save Reminder</button></div>
                                    </div>
                                    
                                    @if(count($dtl_crmReminderLogs)>0)
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Reminders</h6>
                                        @foreach($dtl_crmReminderLogs as $reminderLog)
                                            <figure>
                                                <blockquote class="blockquote">
                                                <p class="ps-2"><b>crm Reminder for: </b>#<?php printf("%01d", $dtl_crm_id); ?> <?=substr($dtl_crm_description,0,40);?></p>
                                                </blockquote>
                                                <figcaption class="blockquote-footer ps-3">Crm Reminder On: {{ \Carbon\Carbon::parse($reminderLog->date_on)->format('dS M Y H:i A') }}<br><small><cite title="Source Title">Created On: {{ \Carbon\Carbon::parse($reminderLog->created_at)->format('dS M Y H:i A') }}</cite></small>
                                                </figcaption>
                                            </figure>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card  mt-3">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Communication</h6>
                        <hr class="mt-0">
                    </div>
                    <div class="card-body pt-0 p-3">
                        @if($showEmailUpdateMessage)
                        <div class="text-light alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success!</strong> {{$emailUpdateMessage}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <ul class="list-group">
                            <li class="list-group-item border-0 p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <h6 class="mb-0">Email</h6>
                                <div class="row p-0 m-0">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sendToCustomer" wire:model="dontSendToCustomer"  value="1" >
                                            <label class="custom-control-label text-danger text-gradient" for="sendToCustomerCheck">Don't Send Email to Customer</label>
                                            <p class="text-xs">Customer Email: <b>{{$dtl_customer_email}}</b></p>
                                        </div>
                                        <div class="form-group" >
                                            <label for="sendEailOtherInput">Other Email address</label>
                                            <input type="email" class="form-control" id="sendEailOtherInput" name="sendEailOther" wire:model="other_email_address" placeholder="name@example.com">
                                            @error('other_email_address') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sendEailCCInput">Add CC</label>
                                            <input type="email" class="form-control" id="sendEailCCInput" name="sendEailCC" wire:model="sendEailCC" placeholder="name@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="sendEailBCCInput">Bcc Email address</label>
                                            <input type="email" class="form-control" id="sendEailBCCInput" name="sendEailBCC" wire:model="sendEailBCC" placeholder="name@example.com">
                                        </div>
                                        <div class="form-group" >
                                            <label for="sendEailSubjectInput">Subject</label>
                                            <input type="text" class="form-control" id="sendEailSubjectInput" name="sendEailSubject" wire:model="sendEailSubject" placeholder="Email Subject" value="#<?php printf("%01d", $dtl_crm_id); ?> <?=substr($dtl_crm_description,0,40);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="customerEmailMessageTextarea">Message</label>
                                            <textarea class="form-control" id="customerEmailMessageTextarea" required="required" name="customerEmailMessage" wire:model="customerEmailMessage" rows="3"></textarea>
                                            @error('customerEmailMessage') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="customerEmailInputFile" class="form-control-label required">Attachment</label>
                                            <input type="file" class="form-control" name="customerEmail_attachment" id="customerEmailInputFile" wire:model="customerEmailInputFile"/>
                                        </div>
                                        
                                        <button type="submit" class="align-items-center btn bg-gradient-danger btn-sm" wire:click="sendCrmEmail()" >Send Email</button>
                                    </div>

                                    <div class="col-md-6">
                                        @if(count($dtl_emailLogs)>0)
                                        <h6 class="mb-0">Email History</h6>
                                        @foreach($dtl_emailLogs as $keyeL => $emailLog)
                                            <figure>
                                                <blockquote class="blockquote">
                                                    <h5 class="ps-2">{{$emailLog->subject}}</h5>
                                                </blockquote>
                                                <figcaption class="blockquote-footer ps-3">
                                                    <b>Email to</b>:{{$emailLog->toEmail}}<br>
                                                    @if($emailLog->ccEmail)
                                                        <b>Email CC</b>:<?=$emailLog->ccEmail;?><br>
                                                    @endif
                                                    @if($emailLog->bccEmail)
                                                        <b>Email BCC</b>:<?=$emailLog->bccEmail;?><br>
                                                    @endif
                                                </figcaption>
                                                <figcaption class="blockquote-footer ps-3">
                                                    <?=$emailLog->message;?>
                                                    @if($emailLog->attachment)
                                                        <!-- Button trigger modal -->
                                                        <div class="row">
                                                            <embed data-bs-toggle="modal" data-bs-target="#exampleModal{{$keyeL}}" src="{{url('storage/'.$emailLog->attachment)}}" data-bs-toggle="modal" data-bs-target="#exampleModal{{$keyeL}}"  style="width: 200px;" />

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$keyeL}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <p id="exampleModalLabel">{{$emailLog->subject}}</p>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <embed data-bs-toggle="modal" data-bs-target="#exampleModal{{$keyeL}}" src="{{url('storage/'.$emailLog->attachment)}}" height="100%" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <small>
                                                        <cite title="Source Title">On: {{ \Carbon\Carbon::parse($emailLog->created_at)->format('dS M Y H:i A') }}</cite>
                                                    </small>
                                                </figcaption>
                                            </figure>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
