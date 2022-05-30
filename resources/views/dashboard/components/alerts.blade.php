@section('success.alert')
    <div class="alert alert-success row mx-1" style="justify-content: space-between; ">
        <div class="col-auto">
            <strong>{{ session()->get('Success') }}</strong>
        </div>
        <div class="col-auto">
            <button type="button" class="close" data-dismiss="alert"
                style="background-color: transparent; border: none;">&times;</button>
        </div>
    </div>
@endsection


@section('warning.alert')
    <div class="alert alert-warning row mx-1" style="justify-content: space-between; ">
        <div class="col-auto">
            <strong>{{ session()->get('Warning') }}</strong>
        </div>
        <div class="col-auto">
            <button type="button" class="close" data-dismiss="alert"
                style="background-color: transparent; border: none;">&times;</button>
        </div>
    </div>
@endsection



@section('error.alert')
    <div class="alert alert-danger row mx-1" style="justify-content: space-between; ">
        <div class="col-auto">
            <strong>{{ session()->get('Error') }}</strong>
        </div>
        <div class="col-auto">
            <button type="button" class="close" data-dismiss="alert"
                style="background-color: transparent; border: none;">&times;</button>
        </div>
    </div>
@endsection

@section('validation')
    <div class="alert alert-danger row mx-1" style="justify-content: space-between; ">
        <div class="col-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
        </ul>
        <div class="col-auto">
            <button type="button" class="close" data-dismiss="alert"
                style=" background-color: transparent; border: none;">&times;</button>
        </div>
    </div>
@endsection
