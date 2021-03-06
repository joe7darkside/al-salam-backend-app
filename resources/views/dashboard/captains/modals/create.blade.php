@section('createModal')
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Captain</h5>

                </div>

                <div class="modal-body">
                    <form action="{{ route('captains.register') }}" method="POST" class="validate-form"
                        enctype="multipart/form-data">
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
                        <div class="row">
                            {{-- Phone --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" aria-describedby="emailHelp"
                                        required>

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                            </div>

                        </div>


                        {{-- Thired ROW --}}
                        <div class="row">
                            {{-- vehicle --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>vehicle</label>
                                    <input type="text" name="vehicle" class="form-control" aria-describedby="emailHelp"
                                        required>

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Licence plate</label>
                                    <input type="text" name="licence_plate" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        {{-- Image --}}
                        <div class=" col-12">
                            <label>Image</label>
                            <input class="form-control" type="file" name="img" required>
                        </div>

                        <div class="row">
                            {{-- Password --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            {{-- Password conformition --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
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
