@section('editModal')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Captain</h5>

                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('captains.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="captain_id" name="captain_id"  >
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}
                        <div class="row">
                            {{-- Phone --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>

                        </div>


                        {{-- Thired ROW --}}
                        <div class="row">
                            {{-- vehicle --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>vehicle</label>
                                    <input type="text" name="vehicle" id="vehicle" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Licence plate</label>
                                    <input type="text" name="licence_plate" id="licence_plate" class="form-control">
                                </div>
                            </div>

                        </div>

                        {{-- Image --}}
                        <div class=" col-12">
                            <label>Image</label>
                            <input class="form-control" type="file" name="img" id="img" >
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
