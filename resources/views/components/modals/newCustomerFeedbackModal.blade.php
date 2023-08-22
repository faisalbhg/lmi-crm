<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->

<div wire:ignore.self class="modal fade" id="newCFModal" tabindex="-1" role="dialog" aria-labelledby="newCFModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCFModalLabel">{{$crmTitle}}</h5>
            </div>
            <div class="modal-body">

                <div class="row mt-4">
                    <h6 class="mb-0">Customer Information</h6>
                    <hr class="mt-0">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="crmRelatedTo1" class="form-control-label  required">Customer ID</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Customer ID..." aria-label="Recipient's username" aria-describedby="searchCustomerNameBtn" name="customer_name" wire:model="CustID" id="customer_name">
                            <button class="btn btn-outline-primary mb-0" type="button" id="searchCustomerNameBtn" wire:click="searchCustomerName">Search</button>
                            <div wire:loading wire:target="searchCustomerName">
                                <div style="display: flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index:999999; width:100%; height:100%; opacity: .75;" >
                                    <div class="la-ball-beat">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
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
                                <h6 class="mt-3 mb-1 d-md-block d-none">Customer ID: {{$customerVal['CustID']}}</h5>
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

                @if($customerFeedbackQtn)
                <div class="row">
                    <div class="card-body px-1 pb-0">
                        <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                        <a href="javascript:;">
                            <h5>{{$customer_name}}</h5>
                        </a>
                        <p class="mb-0 text-sm">
                            {{$company_address}}
                        </p>
                        <p class="mb-0 text-sm">
                            {{$customer_email}}
                        </p>
                        <p class="mb-4 text-sm">
                            {{$mobile_no}}
                        </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Conversations</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    @foreach($customerFeedbackValues as $krycfV => $customerFeedbacks)
                                    
                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                            <div class="avatar me-3">
                                                <h4></h4>
                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?=$krycfV+1;?>. {{$customerFeedbacks->feedback_question}}</h6>
                                                <input type="text" class="form-control" placeholder="Answer..!" aria-label="Answer..!" wire:model="customer_feedback_qtn.{{$customerFeedbacks->id}}"  name="customer_feedback_qtn">
                                                <!-- <button type="button" class="float-end btn bg-gradient-info mt-2" wire:click="saveCF()">Submit</button> --><!-- 
                                                <a class="btn bg-gradient-info pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Save Reply</a> -->
                                            </div>
                                            
                                            
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            <div class="card-footer mt-0 pt-0">
                                <button type="button" class="float-end btn bg-gradient-info" wire:click="saveCF()">Submit</button>
                                <div wire:loading wire:target="saveCF">
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
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="float-start btn bg-gradient-danger" data-bs-dismiss="modal">Close</button>
                
            </div>
       </div>
    </div>
</div>
