
<!-- Modal -->

<div wire:ignore.self class="modal fade" id="getLsOrdersModal" tabindex="-1" role="dialog" aria-labelledby="lsDetailsModalModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lsDetailsModalModal"><p id="exampleModalLabel">Get Orders from Location Solutions</p></h5>
            </div>
            <div class="modal-body">
                <div class="row my-0">
                    <div class="card">

                <div class="card-body p-3">
                    @if($showAttachemntCompleteMessage)
                    <div class="text-light alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Success!</strong> {{$attachemntCompleteMessage}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                       <h5 class="font-weight-bolder mb-0">
                          

                          <div class="form-group">
                            <label>Order Number</label>
                            <input type="text" class="form-control" name="order_number" wire:model="order_number" placeholder="Order Number" />
                          </div>
                          
                          <div class="form-group">
                            <label>From Date</label>
                            <input type="date" class="form-control" name="fromdatelsatchment" wire:model="fromdatelsatchment" placeholder="Date" required />
                          </div>

                          
                          
                          
                         
                        </h5>

                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="float-start btn bg-gradient-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="float-end btn bg-gradient-info"  wire:click="saveSubmit()">Save & Submit</button>
                <div wire:loading wire:target="saveSubmit">
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
