@section('deleteUserModal')
    <div class="modal fade" id="delete_User_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User!</h5>
                </div>
                <form action="{{ route('users.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_user_id" id="delete_user_id">
                    <div class="modal-body">
                        Confirm Delete User?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
