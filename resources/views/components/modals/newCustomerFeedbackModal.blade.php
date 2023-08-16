<style>
    .modal-dialog {
        max-width: 98%;
    }
    .modal{
        z-index: 99999;
    }
</style>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="newCFModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newCFModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCFModalLabel">{{$crmTitle}}</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Conversations</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                        <div class="avatar me-3">
                                            <h4>1.</h4>
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Sophie B.</h6>
                                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                                    </li>
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                        <div class="avatar me-3">
                                            <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Anne Marie</h6>
                                            <p class="mb-0 text-xs">Awesome work, can you..</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                                    </li>
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                        <div class="avatar me-3">
                                            <img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Ivanna</h6>
                                            <p class="mb-0 text-xs">About files I can..</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                                    </li>
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                        <div class="avatar me-3">
                                            <img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Peterson</h6>
                                            <p class="mb-0 text-xs">Have a great afternoon..</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                                    </li>
                                    <li class="list-group-item border-0 d-flex align-items-center px-0">
                                        <div class="avatar me-3">
                                            <img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Nick Daniel</h6>
                                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer mt-0 pt-0">
                                <button type="button" class="float-start btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
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
            </div>
       </div>
    </div>
</div>
