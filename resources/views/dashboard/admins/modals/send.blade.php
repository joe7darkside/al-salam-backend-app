@section('sendModal')
    <div class="modal fade" id="sendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Notification</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.send') }}" method="POST">
                        @csrf

                        <input type="hidden" id="send_admin_id" name="send_admin_id">
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input type="text" name="title" class="form-control" aria-describedby="emailHelp"
                                        required>

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" name="message" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info">Send</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
