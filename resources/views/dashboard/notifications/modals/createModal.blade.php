@section('createModal')
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Notification</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('notifications.add') }}" method="POST">
                        @csrf
                        {{-- FIRST ROW --}}
                        <div class="row">

                            {{-- Title EN --}}
                            <div class="col-6">

                                <div class="form-group " data-validate="Title EN is reauired">
                                    <label>Title EN</label>
                                    <input type="text" name="title_en" class="form-control " aria-describedby="emailHelp"
                                        placeholder="Type english Title" required>

                                </div>
                            </div>
                            {{-- Title AR --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title AR</label>
                                    <input type="text" name="title_ar" class="form-control"
                                        placeholder="Type Arabic Title" required>
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}

                        <div class="row">
                            {{-- Description EN --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description EN</label>
                                    <input type="text" name="description_en" class="form-control"
                                        aria-describedby="emailHelp" placeholder="Type English Description" required>

                                </div>
                            </div>
                            {{-- Description AR --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description AR</label>
                                    <input type="text" name="description_ar" class="form-control"
                                        placeholder="Type Arabic Description" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
