@section('deleteModal')
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Bill</h5>
                </div>
                <form action="{{ route('bills.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_bill_id" id="delete_bill_id">
                    <div class="modal-body">
                        Confirm Delete Bill?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
