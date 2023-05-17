@push('custom_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .select2-container--default .select2-selection--single{
        border: 1px solid #d2d6da !important;
        border-radius: 0.5rem !important;
    }
    .select2-container .select2-selection--single
    {
        height: 40px;
    }
    .right{
      direction: rtl;
    }
    .right li{
        list-style: arabic-indic;
    }
    .left li{
        list-style: binary;
    }
    .select2-container
    {
        z-index: 999999 !important;
        width: 100% !important;
    }
</style>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

@endpush
<main class="main-content position-relative h-100 border-radius-lg">

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class=" flex-row justify-content-between">
                        <div class="float-start">
                            <h6>CRM Lists</h6>
                            
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary active mb-0 text-white float-end" role="button" aria-pressed="true" wire:click="newCrm()">
                                New CRM
                            </button>
                            <span class="mx-2 btn btn-sm btn-success active mb-0 text-white float-end" wire:click="exportExcelCRM" >Export Excel</span>
                        </div>

                        
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="row">
                        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-3 d-flex justify-content-end float-end" >
                            
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control datepicker" autocomplete="off" id="from_date" wire:model="filter_from_date" placeholder="CRM Start Date...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control datepicker"  autocomplete="off" id="to_date" wire:model="filter_to_date"  placeholder="CRM End Date..."> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_crm_id" placeholder="ID.." >
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <select class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_related_to" >
                                        <option value="">-Select-</option>
                                        @foreach(config('common.crmRelatedTo') as $crmRelatedToKey => $crmRelatedToValue)
                                        <option value="{{$crmRelatedToKey}}">{{$crmRelatedToValue}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_delegated_to" placeholder="Name" >
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <select class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_status" >
                                        <option value="">-Select-</option>
                                        @foreach(config('common.crm_status') as $crmStatusKey => $crmStatusValue)
                                        @if($crmStatusKey)
                                        <option value="{{$crmStatusKey}}">{{$crmStatusValue}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <select class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_new_customer" >
                                        <option value="">-Select-</option>
                                        @foreach(config('common.new_customer') as $crmNCusKey => $crmNCusValue)
                                        <option value="{{$crmNCusKey}}">{{$crmNCusValue}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="filter_search" placeholder="Customer">
                                </th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-center text-sm font-weight-bolder"></th>
                                @if(Session::get('user')->isadmin)
                                <th class="text-uppercase text-left text-sm font-weight-bolder">
                                    <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="crm_search_created_by" placeholder="Name...">
                                </th>
                                @endif
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">CRM Id.</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">CRM Related</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Delegated To</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Status</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Last Action</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">New/Existing Customer</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Name</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Address</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Email</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Mobile</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Phone</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Country</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Teritory</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Source</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Business Category</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Marketing Channel</th>
                                
                                <th class="text-uppercase text-left text-sm font-weight-bolder">CRM Start Date & time</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">CRM End Date & time</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">CRM Followup Date & time</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Brand and Competitor Brand</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Quote Estimated Value</th>
                                <th class="text-uppercase text-center text-sm font-weight-bolder">Description</th>
                                @if(Session::get('user')->isadmin)
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Created by</th>
                                @endif
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Created at</th>
                                <th class="text-uppercase text-left text-sm font-weight-bolder">Last Modified</th>
                            </tr>
                        </thead>
                      <tbody>
                        @forelse( $crmlists as $key => $crmData)
                        <tr>
                            <td class="text-left">
                                <button class="badge badge-sm btn-outline-info text-dark py-1" wire:click="crmView({{$crmData->id}})"> Open</button>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-sm font-weight-bold mb-0">
                                <span class="text-dark">
                                    {{$crmData->id}}
                                </span>
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0"><span class="text-dark">
                                    {{config('common.crmRelatedTo')[$crmData->related_to]}}
                                </span>
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0"><span class="text-dark">@if($crmData->userInfo['name']){{$crmData->userInfo['name']}}@endif</span>
                                </p>
                            </td>
                            <td class="text-center text-xs text-dark">
                                
                                <span class="badge badge-sm {{config('common.crm_status_btn')[$crmData->crm_status]}}"> {{config('common.crm_status')[$crmData->crm_status]}}</span>
                                
                            </td>
                            <td class="text-center text-xs text-dark">
                                <span class="badge badge-sm {{config('common.crm_status_btn')[$crmData->crm_action]}}"> {{config('common.crm_action')[$crmData->crm_action]}}</span>
                            </td>

                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0 {{config('common.new_customer_class')[$crmData->newCustomer]}}">{{config('common.new_customer')[$crmData->newCustomer]}}</p>
                            </td>

                            <td class="text-left text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->customer_name}}</p>
                            </td>
                            
                            <td class="text-left text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->company_address}}</p>
                            </td>
                            <td class="text-left text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">
                                    @if($crmData->customer_email != 'empty@empty.com')
                                    {{$crmData->customer_email}}
                                    @endif
                                </p>
                            </td>
                            <td class="text-left text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">
                                    @if($crmData->country_code_no!='empty@empty.com')
                                    {{$crmData->country_code_no}}{{$crmData->mobile_no}}
                                    @endif
                                </p>
                            </td>
                            <td class="text-left text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->phone_no}}</p>
                            </td>
                            <td class="text-center">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->countryInfo['country_name']}}</p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->teritoryInfo['territory_name']}}</p>
                            </td>
                            <td class="text-center">
                                @if($crmData->customer_type)
                                <p class="text-xs font-weight-bold btn-link text-dark mb-0">
                                    {{config('common.customer_type')[$crmData->customer_type]}}
                                </p>
                                @endif
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold btn-link text-dark mb-0">
                                @if($crmData->business_category)
                                {{config('common.business_category')[$crmData->business_category]}}
                                @endif
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold btn-link text-dark mb-0">
                                @if($crmData->marketing_channel)
                                {{config('common.marketing_channel')[$crmData->marketing_channel]}}
                                @endif
                                </p>
                            </td>
                            
                            
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0"><span class="text-dark">
                                    {{ \Carbon\Carbon::parse($crmData->crm_start_date_time)->format('dS M Y H:i A') }}</span>
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0"><span class="text-dark">
                                    {{ \Carbon\Carbon::parse($crmData->crm_end_date_time)->format('dS M Y H:i A') }}</span>
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0"><span class="text-dark">{{ \Carbon\Carbon::parse($crmData->crm_followup_date_time)->format('dS M Y H:i A') }}</span>
                                </p>
                            </td>
                            <td class="text-center text-dark text-xs">
                                <table>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <?php
                                $our_brands = json_decode($crmData->our_brand);
                                if(is_array($our_brands))
                                {
                                    foreach($our_brands as $our_brand)
                                    {
                                    ?>
                                    <span class="text-xs text-dark">{{$our_brand}}</span><br>
                                    <?php
                                    }
                                }else
                                {
                                    echo $crmData->our_brand;
                                }
                                ?>
                             
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->competitor_brand}}</p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->quote_estimated_value}}</p>
                            </td>
                            <td class="text-center text-dark">
                                <p class="text-xs font-weight-bold mb-0 text-dark">{{$crmData->crm_description}}</p>
                            </td>
                            
                            @if(Session::get('user')->isadmin)
                            <td class="text-center text-dark">
                                <button type="button" class="text-xs btn btn-sm bg-gradient-default btn-outline-dark">{{$crmData->userName}}</button>
                            </td>
                            @endif
                            <td>
                                <p class="text-xs font-weight-bold mb-0">
                                {{ \Carbon\Carbon::parse($crmData->created_at)->format('dS M Y H:i A') }}
                                </p>
                            </td>
                            <td class="text-center text-dark">
                                <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($crmData->updated_at)->format('dS M Y H:i A') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="26">No Record Found</td>
                        </tr>
                        @endforelse
                        
                      </tbody>
                    </table>
                    <div class="float-end">{{$crmlists->onEachSide(1)->links()}}</div>
                  </div>
                </div>
                @if($showNewCrmModal)
                @include('components.modals.crmmodal')
                @endif
                @if($showCrmDetailsModal)
                @include('components.modals.crmDetailsModal')
                @endif
            </div>
        </div>
    </div>
    
</div>
</main>

@push('custom_script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    window.addEventListener('showNewCrmModal',event=>{
        $('#newCrmModal').modal('show');
    });
    
    window.addEventListener('hideNewCrmModal',event=>{
        $('#newCrmModal').modal('hide');
        
        Swal.fire({
            position: 'top-end',
            icon: event.detail.type,
            title: event.detail.message,
            showConfirmButton: false,
            timer: 1500
        });
         
        setTimeout( function(){ 
            location.reload();
        }  , 2000 );

    });

    window.addEventListener('showCrmDetailsModal',event=>{
        $('#crmDetailModal').modal('show');
    });

    

</script>
<script type="text/javascript">
    $(document).ready(function(){
      @if($showCrmUpdateModel)
        $('#crmDetailModal').modal('show');
      @endif
      
    });
</script>



<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- jQuery UI JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){

    $("#from_date").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onSelect: function (selected) {
             var dt = new Date(selected);

             @this.set('filter_from_date', selected);

             dt.setDate(dt.getDate() + 1);
             $("#to_date").datepicker("option", "minDate", dt);
        }
    });

    $("#to_date").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onSelect: function (selected) {
             var dt = new Date(selected);

             @this.set('filter_to_date', selected);

             dt.setDate(dt.getDate() - 1);
             $("#from_date").datepicker("option", "maxDate", dt);
        }
    });
});
</script>

@endpush