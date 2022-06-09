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
                        <input type="hidden" id="bill_id" name="bill_id">

                        {{-- FIRST ROW --}}

                      
                        <div class="row">

                            {{-- Payment Status --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bill from </label>
                                    <input type="date" name="payment_from" id="payment_from" class="form-control"
                                        required>

                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bill to</label>
                                    <input type="date" name="payment_to" id="payment_to" class="form-control" required>
                                </div>
                            </div>
                            {{-- Water bill --}}

                        </div>

                        {{-- Thired ROW --}}

                        {{-- Gas bill --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Gas bill</label>
                                    <input type="number" name="gas_bill" id="gas_bill" class="form-control" required>
                                </div>
                            </div>
                            {{-- Electricity bill --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Electricity bill</label>
                                    <input type="number" name="electricity_bill" id="electricity_bill"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Water bill</label>
                                    <input type="number" name="water_bill" id="water_bill" class="form-control" required>
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
