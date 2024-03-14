@push('custom_css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

@endpush
<main class="main-content position-relative h-100 border-radius-lg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class=" flex-row justify-content-between">
                            <div class="float-start">
                                <h3>Location Solution Orders Status Lists</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
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
                            <div class="col-md-3">
                                <div class="input-group">

                                </div>
                            </div>
                            <div class="col-md-3 float-start">
                                <button type="button" class="btn btn-outline-primary" wire:click="getSearchData">Filter</button>
                                <div wire:loading wire:target="getSearchData">
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
                        <div class="row">
                            <div class="col-md-3">
                                Order Count: {{ count($getOrderResponse) }}
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>

        <hr class="ct-docs-hr ">

        <div class="row">
        
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-2 pt-2 pb-2">
                        <div class="table-responsive p-0">
                            <table id="example" class="table align-items-center justify-content-center mb-0" style="width:100%">
                                <thead>
                                    
                                    <tr>
                                        <th class="text-dark text-lg font-weight-bolder">No.</th>
                                        <th class="text-dark text-lg font-weight-bolder">Status</th>
                                        <th class="text-dark text-lg font-weight-bolder">Reference Number</th>
                                        <th class="text-dark text-lg font-weight-bolder">Distribution Centre Reference</th>
                                        <th class="text-dark text-lg font-weight-bolder">Client Name</th>
                                        <th class="text-dark text-lg font-weight-bolder">Task Priority </th>
                                    </tr>
                                    <tr>
                                        <th>
                                          
                                        </th>
                                        
                                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                                            <select class="form-control" wire:model="lsOStatus" style="margin-left: 2px; padding-left: 5px !important;" >
                                                <option value="">Select Status</option>
                                                @foreach($statusList as $statusVal)
                                                <option value="{{$statusVal}}">{{$statusVal}}</option>
                                                @endforeach
                                            </select>
                                            <div wire:loading wire:target="lsOStatus">
                                                <div style="display: flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index:999999; width:100%; height:100%; opacity: .75;" >
                                                    <div class="la-ball-beat">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        
                                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                                            <!-- <input type="text" class="form-control" style="margin-left: 2px !important;padding-left:5px !important;" wire:model="referenceNumber" placeholder="Reference Number.." > -->
                                        </th>
                                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                                            <!-- <input type="text" class="form-control" style="margin-left: 2px !important;padding-left: 5px !important;" wire:model="distributionCentreReference" placeholder="Distribution Centre Reference Number.." > -->
                                        </th>
                                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                                            <!-- <input type="text" class="form-control" style="margin-left: 2px !important;padding-left: 5px !important;" wire:model="clientName" placeholder="clientName.." > -->
                                        </th>
                                        <th class="text-uppercase text-left text-sm font-weight-bolder">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($getOrderResponse as $key => $lsStatusOrder)
                                    {
                                        ?>
                                        <tr>
                                            <td class="text-center align-middle text-dark text-sm ">
                                              <?=$key+1;?>
                                            </td>
                                            <td class="align-middle text-dark text-sm ">
                                              <?php if($lsStatusOrder['status'] == 'COMPLETED')
                                              {
                                                ?>
                                                <lable class="badge badge-lg bg-gradient-success"><?=$lsStatusOrder['status'];?></lable>
                                                <?php
                                              }
                                              else if($lsStatusOrder['status'] == 'FAILED')
                                              {
                                                ?>
                                                <lable class="badge badge-lg bg-gradient-danger"><?=$lsStatusOrder['status'];?></lable>
                                                <?php
                                              }
                                              else if($lsStatusOrder['status'] == 'ACCEPTED')
                                              {
                                                ?>
                                                <lable class="badge badge-lg bg-gradient-info"><?=$lsStatusOrder['status'];?></lable>
                                                <?php
                                              }
                                              else if($lsStatusOrder['status'] == 'ARRIVED')
                                              {
                                                ?>
                                                <lable class="badge badge-lg bg-gradient-dark"><?=$lsStatusOrder['status'];?></lable>
                                                <?php
                                              }
                                              else
                                              {
                                                ?>
                                                <lable class="badge badge-lg bg-gradient-light"><?=$lsStatusOrder['status'];?></lable>
                                                <?php
                                              }
                                              
                                              ?>
                                              
                                              
                                            </td>
                                            <td class="text-center align-middle text-dark text-sm ">
                                              <?=$lsStatusOrder['referenceNumber'];?>
                                            </td>

                                            <td class="text-center align-middle text-dark text-sm ">
                                              <?=$lsStatusOrder['distributionCentreReference'];?>
                                            </td>


                                            <td class="align-middle text-dark text-sm ">
                                              <?=$lsStatusOrder['clientName'];?>
                                            </td>

                                            <td class="text-center align-middle text-dark text-sm ">
                                              <?=$lsStatusOrder['task'];?> - <?=$lsStatusOrder['priority'];?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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