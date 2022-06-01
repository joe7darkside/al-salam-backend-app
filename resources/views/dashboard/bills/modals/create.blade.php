@section('createModal')
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Bill</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('bills.add') }}" method="POST">
                        @csrf
                        <input type="hidden" id="create_bill_id" name="create_bill_id">
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" name="user_first_name" class="form-control" required>

                                </div>
                            </div> --}}
                            {{-- Last name --}}
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="user_last_name" class="form-control" required>
                                </div>
                            </div>
                        </div> --}}

                            {{-- Second ROW --}}
                            {{-- Payment date --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Payment date </label>
                                    <input type="date" name="Payment_date" class="form-control" required>

                                </div>
                            </div>


                            {{-- SECOND ROW --}}
                            <div class="row">

                                {{-- Payment Status --}}
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="floatingSelectGrid">Payment Status</label>
                                        <select class="form-select" id="floatingSelectGrid" name="payment_status"
                                            required>
                                            {{-- <option>Select payment status</option> --}}
                                            <option value="0">Unpaid</option>
                                            <option value="1">Paid</option>

                                        </select>

                                    </div>

                                </div>

                                {{-- Water bill --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Water bill</label>
                                        <input type="text" name="water_bill" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Thired ROW --}}

                            {{-- Gas bill --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Gas bill</label>
                                        <input type="text" name="gas_bill" class="form-control" required>
                                    </div>
                                </div>
                                {{-- Electricity bill --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Electricity bill</label>
                                        <input type="text" name="electricity_bill" class="form-control" required>
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
