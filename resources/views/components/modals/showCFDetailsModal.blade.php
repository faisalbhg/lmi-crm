<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->

<div wire:ignore.self class="modal fade" id="showCFDetails" tabindex="-1" role="dialog" aria-labelledby="showCFDetailsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCFDetailsModal"></h5>
            </div>
            <div class="modal-body">
                <div class="row my-0">
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">{{$feedbacks->Name}} ({{$feedbacks->CustID}})</h6>
                                    <span class="mb-2 text-xs">City: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->City}}</span></span>
                                    <span class="mb-2 text-xs">State: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->State}}</span></span>
                                    <span class="mb-2 text-xs">Zip: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Zip}}</span></span>
                                    <span class="mb-2 text-xs">Country: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Country}}</span></span>
                                    <span class="mb-2 text-xs">Address: <span class="text-dark font-weight-bold ms-2">{{$feedbacks->Address1.', '.(isset($feedbacks->Address2)?$feedbacks->Address2:'').', '.(isset($feedbacks->Address3)?$feedbacks->Address3:'')}}</span></span>
                                    <span class="mb-2 text-xs"><span class="text-dark font-weight-bold ms-2">{{$feedbacks->Name}}</span></span>
                                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">{{$feedbacks->EMailAddress}}</span></span>
                                    <span class="text-xs">Phone Number: <span class="text-dark ms-2 font-weight-bold">{{$feedbacks->PhoneNum}}</span></span>
                                </div>
                            </div>
                            <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                @foreach($feedbackAnswerDetails as $feedbackAnswer)
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h5 class="text-dark text-sm font-weight-bold mb-0">{{$feedbackAnswer->qtnInfo['feedback_question']}}</h5>
                                        <h6>{{$feedbackAnswer->feedback_answer}}</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ \Carbon\Carbon::parse($feedbackAnswer->created_at)->format('dS M Y H:i A') }}</p>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            </div>
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
