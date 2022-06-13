@section('infoModal')
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invitation Details</h5>
                </div>


                <input type="hidden" name="invitation_id" id="info_id">
                <div class="modal-body">
                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            Guest Name:
                        </div>
                        <div class="col-auto" id="guest_name">

                        </div>

                    </div>

                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            User Name:
                        </div>
                        <div class="col-auto" id="user_name">

                        </div>

                    </div>


                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            Email:
                        </div>
                        <div class="col-auto" id="user_email">

                        </div>

                    </div>


                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            Phone:
                        </div>
                        <div class="col-auto" id="user_phone">

                        </div>

                    </div>

                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            Block:
                        </div>
                        <div class="col-auto" id="user_block">

                        </div>

                    </div>
                    <div class="row" style="justify-content: start">

                        <div class="col-auto">
                            Unit:
                        </div>
                        <div class="col-auto" id="user_unit">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
@endsection
