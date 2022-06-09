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

                        <div class="row">
                            {{-- Block Number --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Block Number </label>
                                    <input type="text" name="block" class="form-control" required>
                                </div>
                            </div>

                            {{-- Unit Number --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Unit Number</label>
                                    <input type="text" name="unit" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            {{-- Bill from --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bill from </label>
                                    <input type="date" name="payment_from" class="form-control" required>
                                </div>
                            </div>
                            {{-- Bill to --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Bill to</label>
                                    <input type="date" name="payment_to" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        {{-- Gas bill --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Gas bill</label>
                                    <input type="number" name="gas_bill" class="form-control" required>
                                </div>
                            </div>
                            {{-- Electricity bill --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Electricity bill</label>
                                    <input type="number" name="electricity_bill" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        {{-- Water bill --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Water bill</label>
                                    <input type="number" name="water_bill" class="form-control" required>
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
