<main class="main-content position-relative h-100 border-radius-lg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        @if($showCFSaveMessage)
                            <div class="text-light alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><strong>Success!</strong> {{$cFSaveMessage}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class=" flex-row justify-content-between">
                            <div class="float-start">
                                <h6>Feedback Information</h6>
                            </div>
                            <div class="float-end">
                                <button class="btn btn-primary btn-sm active mb-0 text-white float-end" role="button" aria-pressed="true" wire:click="newFeedBackForm()"> New FeedBack </button>
                                <button class="btn btn-success btn-sm active mx-2 mb-0 text-white float-end" role="button" aria-pressed="true" wire:click="exportExcelCRM">Export</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach($getCustomerFeedbacks as $feedbacks)
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg" wire:click="openFeedBack({{$feedbacks}})">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{$feedbacks->Name}} ({{$feedbacks->CustID}})</h6>
                                    <span class="mb-2 text-xs">City: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->City}}</span></span>
                                    <span class="mb-2 text-xs">State: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->State}}</span></span>
                                    <span class="mb-2 text-xs">Zip: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Zip}}</span></span>
                                    <span class="mb-2 text-xs">Country: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Country}}</span></span>
                                    <span class="mb-2 text-xs">Address: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Address1.', '.(isset($feedbacks->Address2)?$feedbacks->Address2:'').', '.(isset($feedbacks->Address3)?$feedbacks->Address3:'')}}</span></span>
                                    <span class="mb-2 text-xs"><span class="text-dark font-weight-bold ms-2">{{$feedbacks->Name}}</span></span>
                                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">{{$feedbacks->EMailAddress}}</span></span>
                                    <span class="text-xs">Phone Number: <span class="text-dark ms-2 font-weight-bold">{{$feedbacks->PhoneNum}}</span></span>
                                </div>
                                <div class="ms-auto">
                                    <a class="btn bg-gradient-info text-info text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>View</a><br>
                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($feedbacks->created_at)->format('dS M Y H:i A') }}</a>
                                </div>
                            </li>
                            @endforeach
                            <!-- <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">Lucas Harper</h6>
                                    <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-2">Stone Tech Zone</span></span>
                                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">lucas@stone-tech.com</span></span>
                                    <span class="text-xs">VAT Number: <span class="text-dark ms-2 font-weight-bold">FRB1235476</span></span>
                                </div>
                                <div class="ms-auto">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a>
                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">Ethan James</h6>
                                    <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-2">Fiber Notion</span></span>
                                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">ethan@fiber.com</span></span>
                                    <span class="text-xs">VAT Number: <span class="text-dark ms-2 font-weight-bold">FRB1235476</span></span>
                                </div>
                                <div class="ms-auto">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a>
                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
                @if($showNewCFDetailsModal)
                @include('components.modals.newCustomerFeedbackModal')
                @endif
                @if($showCFDetailsModal)
                @include('components.modals.showCFDetailsModal')
                @endif
            </div>
        </div>
    </div>
</main>

@push('custom_script')

<script type="text/javascript">
    window.addEventListener('showNewCFModal',event=>{
        $('#newCFModal').modal('show');
    });

    window.addEventListener('hideNewCFModal',event=>{
        $('#newCFModal').modal('hide');
    });

    window.addEventListener('showCFDetailsModal',event=>{
        $('#showCFDetails').modal('show');
    });

    window.addEventListener('hideCFDetailsModal',event=>{
        $('#showCFDetails').modal('hide');
    });

    

    
</script>
@endpush
