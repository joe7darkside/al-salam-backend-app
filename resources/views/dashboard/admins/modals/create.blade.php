@section('createModal')
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Admin</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" name="first_name" class="form-control" aria-describedby="emailHelp"
                                        required>

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}

                        {{-- Phone --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" required>
                                </div>
                            </div>

                            {{-- Role --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-select" name="role" required>
                                        <option value="super">Super</option>
                                        <option value="notifications">Notifications</option>
                                        <option value="captains">Captains</option>
                                        <option value="invitations">Invitations</option>
                                        <option value="trips">Trips</option>
                                        <option value="bills">Bills</option>
                                        <option value="users">Users</option>

                                    </select>

                                </div>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email"  class="form-control" required>
                            </div>
                        </div>
                        {{-- Password --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
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
