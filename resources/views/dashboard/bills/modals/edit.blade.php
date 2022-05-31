@section('editModal')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Bill</h5>

                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('bills.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" id="bill_id" name="bill_id">


                        {{-- Second ROW --}}
                        {{-- Payment date --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payment date </label>
                                <input type="date" id="payment_date" name="payment_date" class="form-control" required>

                            </div>
                        </div>


                        {{-- SECOND ROW --}}
                        <div class="row">

                            {{-- Payment Status --}}
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="floatingSelectGrid">Payment Status</label>
                                    <select class="form-select" id="payment_status" name="payment_status" required>
                                        <option value="0">Unpaid</option>
                                        <option value="1">Paid</option>

                                    </select>

                                </div>

                            </div>

                            {{-- Water bill --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Water bill</label>
                                    <input type="text" id="water_bill" name="water_bill" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        {{-- Thired ROW --}}

                        {{-- Gas bill --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Gas bill</label>
                                    <input type="text" id="gas_bill" name="gas_bill" class="form-control" required>
                                </div>
                            </div>
                            {{-- Electricity bill --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Electricity bill</label>
                                    <input type="text" id="electricity_bill" name="electricity_bill" class="form-control"
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
