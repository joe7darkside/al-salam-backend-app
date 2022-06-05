@section('infoModal')
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Captain Information</h5>
                </div>

                <div class="modal-body"  >
                    <div class="row">


                        <div class="avatar avatar-xl position-relative">
                            <img src="/images/user.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <input type="text" id="captain_show_id" name="captain_show_id">

                        <p id="info"> </p>
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
