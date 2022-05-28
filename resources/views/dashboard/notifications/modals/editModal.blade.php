@section('editModal')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Notification</h5>

                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('notifications.update') }}" method="POST">
                        <input type="hidden" name="notification_id" id="notification_id">
                        @csrf
                        @method('PUT')
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title EN</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control"
                                        aria-describedby="emailHelp" required>

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title AR</label>
                                    <input type="text" name="title_ar" id="title_ar" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}
                        <div class="row">
                            {{-- Phone --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <input type="text" name="description_en" id="description_en" class="form-control"
                                        aria-describedby="emailHelp" required>

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description AR</label>
                                    <input type="text" name="description_ar" id="description_ar" class="form-control"
                                        required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
