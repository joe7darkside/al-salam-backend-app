@section('infoModal')
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trip Information</h5>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto avatar avatar-xxl position-relative">
                            <img id="captain_img" class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <div class="col-4 pt-3">
                            <span class=" text-ms" id="captain_name"></span>
                            <span class=" text-ms" id="captain_phone"></span>
                            <span class=" text-ms" id="captain_email"></span>
                        </div>

                    </div>
                    <hr>
                    <div class="col-auto">
                        <span class=" text-ms">Pick up:</span>
                        <span class=" text-ms" id="pick_up"></span>
                    </div>

                    <div class="col-auto">
                        <span class=" text-ms">Drop of:</span>
                        <span class=" text-ms" id="drop_of"></span>
                    </div>

                    <div class="col-auto">
                        <span class=" text-ms">Payment Method:</span>
                        <span class=" text-ms" id="payment_method"></span>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
