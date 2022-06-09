@section('editModal')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>

                </div>
                <div class="modal-body">
                    {{-- users.register --}}
                    <form action="{{ route('users.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="user_edit_id" name="user_edit_id">

                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"
                                        aria-describedby="emailHelp" required>

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}

                        {{-- Phone --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" required>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control" required>
                                </div>

                            </div>
                        </div>



                        {{-- Block --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Block</label>
                                    <input type="text" id="block" name="block" class="form-control" required>
                                </div>
                            </div>

                            {{-- Unit --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" id="unit" name="unit" class="form-control" required>
                                </div>

                            </div>
                        </div>



                        {{-- Password --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="form-group">
                                <label>Password confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div> --}}

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
