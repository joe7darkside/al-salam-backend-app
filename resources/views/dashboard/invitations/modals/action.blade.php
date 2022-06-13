@section('actionModal')
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                <form action="{{ route('invitations.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="invitation_id" id="action_id">
                    <div class="modal-body">
                        <div class="row" style="justify-content: start">
                            <div class="col-auto" id="name">
                                {{-- <p id="name"></p> --}}
                            </div>
                            <div class="col-auto">
                                Wants to get visit approval, granted?
                                {{-- <p>Wants to get visit approval, granted?</p> --}}
                            </div>


                        </div>

                    </div>
                    {{-- <p>Confirm Invitation Request?</p> --}}
                    {{-- data-dismiss="modal" --}}
                    <div class="modal-footer">
                       
                        <button type="submit" name="permission" value="2" class="btn btn-danger">Denied</button>
                        <button type="submit" name="permission" value="1" class="btn btn-success">Approved</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
