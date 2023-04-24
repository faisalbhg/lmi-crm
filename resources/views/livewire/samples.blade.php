@push('custom_css')
@endpush
<main class="main-content position-relative h-100 border-radius-lg">
<div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class=" flex-row justify-content-between">
                        <div class="float-start">
                            <h6>Samples List</h6>                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class=" text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Cutomer</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Item</th>
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$samples->partDescription}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$samples->partNum}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$samples->prodCode}}</p>
                                    </td>
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
                                        @if($samples->status==0)
                                            @if(Session::get('user')->usertype == config('common.sample_status_action_userType')[$samples->status])
                                                <a wire:click="updateSample('{{$samples->id}}','{{$samples->status+1}}')">
                                                    <button type="button" class="btn btn-{{config('common.sample_status_class')[$samples->status+1]}} btn-sm">{{config('common.sample_status_action')[$samples->status+1]}}</button>
                                                </a>
                                                <a wire:click="updateSample('{{$samples->id}}','5')">
                                                    <button type="button" class="btn btn-{{config('common.sample_status_class')[5]}} btn-sm">{{config('common.sample_status_action')[5]}}</button>
                                                </a>
                                            @endif
                                        @elseif($samples->status!=5)
                                            @if(session()->get('usertype') == config('common.sample_status_action_userType')[$samples->status])
                                                <a wire:click="updateSample('{{$samples->id}}','{{$samples->status+1}}')" >
                                                    <button type="button" class="btn btn-{{config('common.sample_status_class')[$samples->status+1]}} btn-sm">{{config('common.sample_status_action')[$samples->status+1]}}</button>
                                                </a>
                                            @endif
                                        @endif
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
            </div>
        </div>
    </div>
</div>
</main>
@push('custom_script')
@endpush