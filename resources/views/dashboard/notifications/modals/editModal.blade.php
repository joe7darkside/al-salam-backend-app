@section('editModal')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Notification</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('notifications.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="_id" id="_id">

                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        aria-describedby="emailHelp" required>

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description </label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        aria-describedby="emailHelp" required>

                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
