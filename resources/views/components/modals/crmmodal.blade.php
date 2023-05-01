<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="newCrmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newCrmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCrmModalLabel">{{$crmTitle}}</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12  col-sm-12 col-xs-12 col-xxs-12">
                        <div class="card p-0 m-0" >
                            <div class="card-body">
                                <form  autocomplete="off" wire:submit.prevent="saveCustomer" method="POST"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="departmentCodeInput">Related To</label>
                                                <select class="form-control chosen-select" wire:model="related_to" wire:click="relatedToChangeEvent($event.target.value)" name="related_to" id="relatedToSelect" >
                                                    <option value="">-Select-</option>
                                                    @foreach(config('common.crmRelatedTo') as $crmRelatedToKey => $crmRelatedToValue)
                                                    <option value="{{$crmRelatedToKey}}">{{$crmRelatedToValue}}</option>
                                                    @endforeach
                                                </select>
                                                @error('related_to') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        @if($showSampleItemName)
                                        <div class="col-md-4" >
                                            <label for="crmRelatedTo1" class="form-control-label  required">Search Sample Item</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Sample Item Name..!" aria-label="Sample Item Name..!" aria-describedby="searchSampleItem" id="sampleItemInput" wire:model="search_sample_item"  name="search_sample_item">
                                                <button class="btn btn-outline-primary mb-0" type="button" id="searchSampleItem" wire:click="sampleItemSearch">Search</button>
                                            </div>
                                            @if($showSampleItemSelected)
                                            <div class="card">
                                                <div class="card-header text-center pt-4 pb-3">
                                                    <span class="badge rounded-pill bg-light text-dark">Selected Sample Items</span>
                                                </div>
                                                <div class="card-body text-lg-left text-left pt-0">
                                                    @foreach($selectedSampleItemPartDescription as $keySelSampl => $selectedItem)
                                                    <div class="justify-content-lg-start justify-content-left p-2" >
                                                        <div class="icon icon-shape icon-xs bg-gradient-success shadow text-center">
                                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                                        </div>
                                                        <span class="ps-3">{{$selectedItem}}</span><small wire:click="removeSelectedSample('{{$keySelSampl}}')" class="float-end cursor-pointer text-danger text-xxs">Remove</small><hr class="m-0">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif 
                                        </div>
                                            @if($showSampleItemResult)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header text-center pt-4 pb-3">
                                                        <span class="badge rounded-pill bg-light text-dark">Search Item Results</span>
                                                        <div class="cursor-pointer icon icon-shape icon-xs shadow text-center" wire:click="closeSampleSearchResult">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-lg-left text-left pt-0">
                                                        @foreach($searchSampleItems as $searchItem)
                                                        @if($searchItem['PartNum']!=Null)
                                                        <div class="justify-content-lg-start justify-content-left p-2" wire:click="selectedSample({{json_encode($searchItem,true)}})">
                                                            <div class="icon icon-shape icon-xs bg-gradient-secondary shadow text-center" >
                                                                <i class="fas fa-minus" aria-hidden="true"></i>
                                                            </div>
                                                            <span class="ps-3"> {{$searchItem['PartDescription']}}</span><hr class="m-0">
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>                                         
                                            </div>
                                            @endif
                                        @endif
                                        @if($showDeligatedTo)
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-deligatedToSelect">
                                                <label for="crmRelatedTo1" class="form-control-label  required">Deligated to To</label>
                                                <select class="form-control" name="deligated_to" wire:model="deligated_to" id="deligatedToSelect" >
                                                    <option value="">-Select-</option>
                                                    @foreach($deligatedToValue as $dtVal)
                                                    <option value="{{$dtVal->id}}">{{$dtVal->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-0" id="form-inputcrmStartDateTime">
                                                <label for="inputcrmStartDateTime" class="form-control-label required">CRM Start Date & Time</label>
                                                <input class="form-control" type="datetime-local" value="<?=date('Y-m-d');?>T<?=date('H:i');?>" name="crm_start_date_time" wire:model="crm_start_date_time" id="inputcrmStartDateTime">
                                                @error('crm_start_date_time') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-0" id="form-inputcrmEndDateTime">
                                                <label for="inputcrmEndDateTime" class="form-control-label required">CRM End Date & Time</label>
                                                <input class="form-control" type="datetime-local" name="crm_end_date_time" wire:model="crm_end_date_time" id="inputcrmEndDateTime" value="<?=date('Y-m-d');?>T<?=date('H:i');?>">
                                                @error('crm_end_date_time') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        @if($showCrmFollowupDateTime)
                                        <div class="col-md-4">
                                            <div class="form-group mb-0" id="form-inputcrmFollowupDateTime">
                                                <label for="inputcrmFollowupDateTime" class="form-control-label required">CRM FollowUp Date & Time</label>
                                                <input class="form-control" type="datetime-local" name="crm_followup_date_time" wire:model="crm_followup_date_time" id="inputcrmFollowupDateTime" value="<?php date('Y-m-d',strtotime(' +2 day')).'T'.date('H:i');?>
                                                 ">
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row mt-4">
                                        <h6 class="mb-0">Customer Information</h6>
                                        <hr class="mt-0">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="crmRelatedTo1" class="form-control-label  required">Customer Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Customer Name..." aria-label="Recipient's username" aria-describedby="searchCustomerNameBtn" name="customer_name" wire:model="customer_name" id="customer_name">
                                                <button class="btn btn-outline-primary mb-0" type="button" id="searchCustomerNameBtn" wire:click="searchCustomerName">Search</button>
                                            </div>
                                            @error('customer_name') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        @if($showSearchCustomers)
                                        <div class="col-md-8" >
                                            <div class="row">
                                            <label for="crmRelatedTo1" class="form-control-label  required">Customers</label>
                                            <hr class="mt-0">
                                            @forelse($customersList as $customerVal)
                                            <div class="col-md-4 mb-2" wire:click="selectCustomer('{{json_encode($customerVal)}}')" >
                                                <div class="card card-profile card-plain">
                                                  <div class="card-body text-center bg-white shadow border-radius-lg p-3">
                                                    <h5 class="mt-3 mb-1 d-md-block d-none">{{$customerVal['Name']}}</h5>
                                                    <p class="mb-1 d-block text-sm font-weight-bold text-darker">
                                                    @if($customerVal['Address1'])
                                                    {{$customerVal['Address1']}}
                                                    @endif
                                                    @if($customerVal['Address2'])
                                                    , {{$customerVal['Address2']}}
                                                    @endif
                                                    @if($customerVal['Address3'])
                                                    ,  {{$customerVal['Address3']}}
                                                    @endif

                                                    @if($customerVal['State'])
                                                    <p class="mb-1 d-block text-sm font-weight-bold text-darker">{{$customerVal['State']}}</p>  
                                                    @endif
                                                    @if($customerVal['Country'])
                                                    <p class="mb-1 d-block text-sm font-weight-bold text-darker">{{$customerVal['Country']}}</p>
                                                    @endif
                                                    @if($customerVal['PhoneNum'])
                                                    <p class="mb-1 d-block text-sm font-weight-bold text-darker">{{$customerVal['PhoneNum']}}</p>
                                                    @endif
                                                    </p>
                                                    <p class="mb-1 d-block text-sm font-weight-bold text-darker">{{$customerVal['EMailAddress']}}</p>
                                                    <a href="javascript:;" wire:click="selectCustomer('{{json_encode($customerVal)}}')" class="text-primary icon-move-right pull-right">Select
                                                        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                  </div>
                                                </div>
                                            </div>
                                            
                                            @empty
                                            <p class="text-left text-danger">Not Found..!</p>
                                            @endforelse
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-emailInput">
                                                <label for="example-search-input" class="form-control-label required">Customer Email</label>
                                                <input class="form-control" type="email" placeholder="Your Email" id="emailInput" wire:model="customer_email" name="email"  value="" >
                                                @error('customer_email') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-countrySelect">
                                                <label for="example-text-input" class="form-control-label ">Country</label>
                                                <select class="form-control chosen-select" name="country" wire:model="country" wire:change="chnageCountry($event.target.value)" id="countrySelect" >
                                                    <option value="">-Select-</option>
                                                    @foreach($countriesList as $countryVal)
                                                    <option value="{{$countryVal->id}}" @if($countryVal->id==$country) selected @endif >{{$countryVal->country_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('country') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-teritorySelect">
                                                <label for="example-text-input" class="form-control-label required">Territory </label>
                                                <select class="form-control"  wire:model="territory" name="territory" id="teritory" >
                                                    <option value="">-Select-</option>
                                                    @foreach($territoriesList as $territoryVal)
                                                    <option value="{{$territoryVal->id}}">{{$territoryVal->territory_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('territory') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 mt-0">
                                                <div class="form-group" id="form-countryCodeInput">
                                                    <label for="example-email-input" class="form-control-label required">Country Code</label>
                                                    <input class="form-control" type="text" placeholder="Your Mobile Number" readonly id="countryCodeInput" autcomplete="off" name="country_code" wire:model="country_code" >
                                                    @error('country_code') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-10 mt-0">
                                                <div class="form-group" id="form-mobileInput">
                                                    <label for="example-email-input" class="form-control-label required">Mobile Number</label>
                                                    <span id="validate-mobile-input"></span>
                                                    <input class="form-control" type="text" placeholder="Your Mobile Number" id="mobileInput" name="mobile_no" wire:model="mobile_no" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" >
                                                    @error('mobile_no') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <label for="example-tel-input" class="form-control-label">Phone</label>
                                                    <input class="form-control" type="tel" placeholder="Phone Number" id="example-tel-input" name="phone_no" wire:model="phone_no" value="">
                                                    @error('phone_no') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form-companyAddressInput">
                                                <label for="example-search-input" class="form-control-label required">Company Address</label>
                                                <input type="text" class="form-control" name="company_address" wire:model="company_address" id="companyAddressInput" >
                                                @error('company_address') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4" >
                                            <div class="form-group" id="form-customerTypeSelect">
                                                <label for="example-text-input" class="form-control-label required">Type of Customer</label>
                                                <select class="form-control" name="customer_type" wire:model="customer_type" id="customerTypeSelect">
                                                    @foreach(config('common.customer_type') as $key_ct => $customer_type)
                                                    <option value="{{$key_ct}}">{{$customer_type}}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_type') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-businessCategorySelect">
                                                <label for="example-text-input" class="form-control-label required">Business Category</label>
                                                <select class="form-control" name="business_category" wire:model="business_category" id="businessCategorySelect" >
                                                    <option value="">-Select-</option>
                                                    @foreach(config('common.business_category') as $key_bc => $business_category)
                                                    <option value="{{$key_bc}}">{{$business_category}}</option>
                                                    @endforeach
                                                </select>
                                                @error('business_category') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-businessCategorySelect">
                                                <label for="example-text-input" class="form-control-label required">Marketing Channel</label>
                                                <select class="form-control" name="marketing_channel" wire:model="marketing_channel" id="businessCategorySelect" >
                                                    @foreach(config('common.marketing_channel') as $key_mc => $marketing_channel)
                                                    <option value="{{$key_mc}}">{{$marketing_channel}}</option>
                                                    @endforeach
                                                </select>
                                                @error('marketing_channel') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if($showQuoteEstimatedValue)
                                        <div class="col-md-4">
                                            <div class="form-group mb-0" id="form-inputQuoteEstimatedValue">
                                                <label for="inputQuoteEstimatedValue" class="form-control-label required">Quote Estimated Value</label>
                                                <input class="form-control" type="number" name="quote_estimated_value" wire:model="quote_estimated_value" id="inputQuoteEstimatedValue">
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row mt-4">
                                        <h6 class="mb-0">Business Details</h6>
                                        <hr class="mt-0">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="ourBrandSelect" class="form-control-label required">Our Brand</label>
                                            <div class="form-group mb-0">
                                                
                                                <select class="form-control brandSelect" name="search_brand" id="search_brand" wire:model="search_brand" wire:change="ourBrandChangeEvent($event.target.value,'0')">
                                                    <option value="">-Select-</option>
                                                    <option value="ROASTERY STN">ROASTERY STN</option>
                                                    <?php $brandUniqArray=array(); 
                                                    ?>
                                                    @foreach($brandsList as $brandsDetail)

                                                        <?php $brandnNew = explode("-",$brandsDetail['Description']); ?>
                                                        @if(!empty($brandnNew[1]))
                                                            @if(($brandnNew[1]!='') && !in_array($brandnNew[1], $brandUniqArray))
                                                                <?php array_push($brandUniqArray, $brandnNew[1]);?>
                                                                <option value="{{$brandnNew[1]}}">{{$brandnNew[1]}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('search_brand') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-0" id="form-inputCompetitorBrand0">
                                                <label for="inputCompetitorBrand" class="form-control-label required">Competitor Brand</label>
                                                <select class="form-control" wire:model="competitor_brand" id="competitor_brand0" multiple>
                                                    <option> -Select-</option>
                                                    @foreach($competitorBrandLists as $coBrand)
                                                    <option value="{{$coBrand->competitor_brands}}">{{$coBrand->competitor_brands}}</option>
                                                    @endforeach
                                                </select>
                                                @error('competitor_brand') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-0" id="form-inputOtherBrand">
                                                <label for="inputOtherBrand" class="form-control-label required">Other</label>
                                                <input type="text" class="form-control" wire:model="othre_brand" id="othre_brand0" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-0" id="form-addNewBrand">
                                                <label for="addNewBrand" class="form-control-label required">Add Brand</label>
                                                <div>
                                                <button class="btn btn-icon btn-3 btn-info" type="button" wire:click="addNewBrand({{$brandCount}})">
                                                    <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                                    <span class="btn-inner--text">Add Your Brand</span>
                                                </button></div>
                                            </div>
                                        </div>
                                        @error('brands_list') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    @if(count($brands_list)>0)
                                    <div class="row">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                              <thead>
                                                <tr>
                                                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Our Brand</th>
                                                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Competitor Brand</th>
                                                  <th class="text-center text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Other</th>
                                                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Remove</th>
                                                  <th class="text-center text-secondary opacity-7"></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($brands_list as $keyB => $selectedBrand)
                                                <tr>
                                                    <td class="text-center">
                                                        <h6 class="mb-0 text-sm">{{$selectedBrand}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{$competitor_brands_list[$keyB]}}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                        {{json_encode($othre_brands_list[$keyB])}}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="javascript:;" wire:click="removeBrandSelected('{{$keyB}}')" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"> Remove </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    
                                    @endif
                                    

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                            <div class="form-group"  id="form-crmDescriptionTextarea">
                                                <label for="example-search-input" class="form-control-label required">Crm Description</label>
                                                <textarea class="form-control" name="crm_description" wire:model="crm_description" id="crmDescriptionTextarea" rows="3"></textarea>
                                                @error('crm_description') <span class="mb-4 text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr class="mb-0">
                            </div>
                            <div class="card-footer mt-0 pt-0">
                                <button type="button" class="btn bg-gradient-primary" wire:click="saveCRM()">Submit</button>
                                <button type="button" class="float-end btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
