@push('custom_css')
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
                        <h6>Location Solution Orders Lists</h6>
                        
                    </div>
                    <div class="float-end">
                        <button class="btn btn-primary active mb-0 text-white float-end" role="button" aria-pressed="true" wire:click="getNewLsOrders()">
                            Get New LS Orders
                        </button>
                    </div>

                    
                </div>
            </div>
            <div class="card-body px-2 pt-2 pb-2">
              <div class="row d-none">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-3 d-flex justify-content-start float-start" >
                  <div class="col-md-3 float-start"></div>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-3 d-flex justify-content-end float-end" >
                  <div class="col-md-3">
                      <div class="input-group">
                          <span class="input-group-text text-body"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                          <input type="text" class="form-control datepicker" autocomplete="off" id="from_date" wire:model="filter_from_date" placeholder="From Date...">
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="input-group">
                          <span class="input-group-text text-body"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                          <input type="text" class="form-control datepicker"  autocomplete="off" id="to_date" wire:model="filter_to_date"  placeholder="To Date..."> 
                      </div>
                  </div>
                </div>
              </div>
                
              <div class="table-responsive p-0">

                <table id="example" class="table align-items-center justify-content-center mb-0" style="width:100%">
                  <thead>
                    <tr>
                        <th>
                          Sl.No
                        </th>
                        
                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                            <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="order_id" placeholder="Order ID.." >
                        </th>
                        
                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                            <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="referenceNumber" placeholder="Reference Number.." >
                        </th>
                        
                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                            <input type="text" class="form-control" style="margin-left: 2px !important;padding: 2px 5px !important;" wire:model="lsaddress" placeholder="Address.." >
                        </th>
                    </tr>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reference Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Attachments</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">orderLsDate</th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse( $lsattachments as $key => $lsAttachment)
                      <tr>
                        <td class="align-middle">
                          {{$key+1}}
                        </td>
                        

                        <td>
                          {{$lsAttachment->ordder_id}}
                        </td>
                        <td>
                          @foreach($lsAttachment->lsImages as $lsImageAttach)
                          <img class="col-3" wire:click="lsDetailsView({{$lsImageAttach}})" src="{{ url('ls-order-attachment/'.$lsImageAttach->image)}}" alt="...">
                          @endforeach
                        </td>
                        <td>
                            {{$lsAttachment->referenceNumber}}
                        </td>
                        
                        <td>
                            {{$lsAttachment->address}}
                          
                        </td>

                        <td class="text-center text-dark">
                            <p class="text-xs font-weight-bold mb-0"><span class="text-dark">
                              {{ $lsAttachment->dropWindow_endTime }}</span>
                            </p>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4">No Record Found</td>
                      </tr>
                      @endforelse
                    
                  </tbody>
                  <!-- <tfoot>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Business</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Acction</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Process</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created On</th>
                      <th>Update</th>
                    </tr>
                  </tfoot> -->
                </table>
                <div class="float-end"> <small>{{ $lsattachments->count() }} rows from {{ $lsattachments->total() }} records</small> {{$lsattachments->onEachSide(1)->links()}}</div>
              </div>
            </div>
          </div>
          @if($showLSDetailsModal)
                @include('components.modals.lsDetails')
          @endif

          @if($getLsOrderModal)
                @include('components.modals.getLsOrderModal')
          @endif
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

  window.addEventListener('showLSDetailsModal',event=>{
        $('#lsDetailsModal').modal('show');
  });
  window.addEventListener('hideLSDetailsModal',event=>{
        $('#lsDetailsModal').modal('hide');
  });

  window.addEventListener('showGetLsOrderModal', event=>{
      $('#getLsOrdersModal').modal('show');
  });
  window.addEventListener('hideGetLsOrderModal', event=>{
      $('#getLsOrdersModal').modal('hide');
  });
</script>


@endpush