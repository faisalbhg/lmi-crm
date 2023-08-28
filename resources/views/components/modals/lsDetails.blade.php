<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->

<div wire:ignore.self class="modal fade" id="lsDetailsModal" tabindex="-1" role="dialog" aria-labelledby="lsDetailsModalModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lsDetailsModalModal"><p id="exampleModalLabel">Order : <?=$lsAttachment->referenceNumber;?></p></h5>
            </div>
            <div class="modal-body">
                <div class="row my-0">
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <img class="col-12"  src="{{ url('ls-order-attachment/'.$orderDetailsImage)}}" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="float-start btn bg-gradient-danger" data-bs-dismiss="modal">Close</button>
                
            </div>
       </div>
    </div>
</div>
