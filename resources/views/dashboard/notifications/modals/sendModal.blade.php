@section('sendModal')
    <div class="modal fade" id="sendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Notification</h5>
                </div>
                <form action="{{ route('notifications.send') }}">
                    @csrf
                    <input type="hidden" name="notification_id" id="notification_id">
                    <div class="modal-body">
                        Confirm Send Notification?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
