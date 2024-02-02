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
                        <div class=" flex-row justify-content-between">
                            <div class="float-start">
                                <h6>Samples</h6>
                                
                            </div>
                            <div class="float-end">
                                <span class="mx-2 btn btn-sm btn-success active mb-0 text-white float-end" wire:click="exportExcelSample" >Export Excel</span>
                                <div wire:loading wire:target="exportExcelSample">
                                    <div style="display: flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index:999999; width:100%; height:100%; opacity: .75;" >
                                        <div class="la-ball-beat">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class=" text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer</th>
                                    <!-- <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Item</th> -->
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Sales Person</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($samplesList as $key => $samples)
                                <tr>
                                    <td class="text-xxs text-center">{{$key+1}}</td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?=$samples->cutomer_name;?></h6>
                                                @if($samples->customer_address)
                                                <p class="text-xs text-secondary mb-0">{{$samples->customer_address}}</p>
                                                @endif
                                                <p class="text-xs text-secondary mb-0">{{$samples->teritory.', '.$samples->country}}</p>
                                                <p class="text-xs text-secondary mb-0">{{$samples->phone_num}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$samples->partDescription}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$samples->partNum}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$samples->prodCode}}</p>
                                    </td> -->
                                    <td>
                                        <p class="text-xxs text-secondary mb-0">
                                            <span class="badge badge-dot me-4">
                                                <span class="text-dark text-xxs">
                                                    {{$samples->userInfo['name']}}
                                                </span>
                                            </span>
                                        </p>
                                        <p class="text-xxs text-secondary mb-0">
                                            <span class="badge badge-dot me-4">
                                                <span class="text-dark text-xxs">
                                                    {{$samples->userInfo['email']}}
                                                </span>
                                            </span>
                                        </p>

                                    </td>
                                    <td class="align-middle text-sm">
                                        <span class="badge bg-gradient-{{config('common.sample_status_class')[$samples->status]}}">{{config('common.sample_status')[$samples->status]}}</span>
                                        <p class="text-xs text-secondary mb-0">Now in: {{config('common.sample_department')[$samples->department]}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <button wire:click="openSample('{{$samples->crm_id}}')" class="btn bg-gradient-primary btn-sm">Open</button>
                                    </td>
                                @empty
                                <tr>
                                  <td colspan="7">No Record Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{$samplesList->onEachSide(1)->links()}}</div>
                    </div>
                </div>
                @if($showsampleDetails)
                @include('components.modals.sampleDetails')
                @endif
            </div>
        </div>
    </div>
</div>
</main>
@push('custom_script')

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

<script type="text/javascript">
    window.addEventListener('showSampleDetailModal',event=>{
        $('#sampleDetailModal').modal('show');
    });
    window.addEventListener('hideSampleDetailModal',event=>{
        $('#sampleDetailModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      @if($showsampleDetails)
        $('#sampleDetailModal').modal('show');
      @endif
      
    });
</script>
@endpush