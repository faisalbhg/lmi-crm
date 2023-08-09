<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="sampleDetailModal" tabindex="-1" role="dialog" aria-labelledby="sampleDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sampleDetailModalLabel"> Sample Update </h5>
                
            </div>
            <div class="modal-body">
                @if($sampleInfo)
                <div class="row">
                    <div class="col-md-7 mt-4">
                        <div class="card">
                            <div class="card-header pb-0 px-3">
                                <h6 class="mb-0">Samples Information</h6>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <ul class="list-group">
                                    @foreach($sampleItems as $key => $sample)
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="row">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0 text-sm">{{$sample->partDescription}}</h6>
                                                <h6 class="mb-0 text-sm text-dark">Quantity: {{$sample->itemQty}}</h6>
                                                <h6 class="mb-3 text-sm text-dark">Brand: {{$sample->itemBrand}}</h6>
                                                <span class="mb-2 text-xs">Part Num: <span
                                                        class="text-dark font-weight-bold ms-2">{{$sample->partNum}}</span></span>
                                                <span class="text-xs">Product Code: <span class="text-dark ms-2 font-weight-bold">{{$sample->prodCode}}</span></span>
                                                <hr class="horizontal dark">
                                                <span class="badge bg-gradient-{{config('common.sample_status_class')[$sample->status]}}">{{config('common.sample_status')[$sample->status]}}</span>
                                                <p class="text-xs text-secondary mb-0">Now in: {{config('common.sample_department')[$sample->department]}}</p>
                                            </div>
                                            <div class="ms-auto">
                                                @if($sample->status==0)
                                                
                                                    @if(Session::get('user')->usertype == config('common.sample_status_action_userType')[$sample->status])
                                                    
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea{{$sample->id}}">Update Command</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea{{$sample->id}}" rows="3" wire:model="sample_comment.{{$sample->id}}"></textarea>
                                                        @error('sample_comment.'.$sample->id) <span class="mb-4 text-danger">Command is required</span> @enderror
                                                    </div>
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;" wire:click=updateSample('{{$sample->id}}','5')><i class="far fa-trash-alt me-2"></i>Reject</a>
                                                    <a class="btn btn-link text-success px-3 mb-0" href="javascript:;" wire:click=updateSample('{{$sample->id}}','{{$sample->status+1}}')><i class="fas fa-pencil-alt text-success me-2" aria-hidden="true"></i>Aprove</a>
                                                     @endif
                                                @elseif($sample->status!=5)
                                                
                                                    @if(Session::get('user')->usertype == config('common.sample_status_action_userType')[$sample->status])
                                                    <h6 class="mb-0">Make Action </h6>
                                                    <hr class="horizontal dark">
                                                    <a href="javascript:;" wire:click="updateSample('{{$sample->id}}','{{$sample->status+1}}')" >
                                                        <button type="button" class="btn btn-{{config('common.sample_status_class')[$samples->status+1]}} btn-sm">{{config('common.sample_status_action')[$samples->status+1]}}</button>
                                                    </a>

                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        @if(count($sample->samplelogs)>0)
                                        <div class="row">
                                            <div class="col-md-12">
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
                                        </div>
                                        @endif
                                        
                                        
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-4">
                        <div class="card h-100 mb-4">
                            <div class="card-header pb-0 px-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Your Transaction's</h6>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        <small>{{ \Carbon\Carbon::parse($sampleInfo->created_at)->format('dS M Y H:i A') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Customer Info</h6>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">{{$sampleInfo->cutomer_name}}</h6>
                                                <span class="text-xs">{{$sampleInfo->customer_address}}</span>
                                                <span class="text-xs">{{$sampleInfo->teritoryInfo['territory_name'].', '.$sampleInfo->countryInfo['country_name']}}</span>
                                                <span class="text-xs">{{$sampleInfo->phone_num}}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                            
                                        </div>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p class="text-center text-danger">No available</p>
                @endif
            </div>
            <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 m-0">
                    <button type="button" class="float-end btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </div>
        
    </div>
</div>
