<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        bills
    </title>

    @include('dashboard.components.header')
    @yield('header')
</head>

<body class="g-sidenav-show  bg-page">

    @include('dashboard.components.sideBar')
    @yield('sideBar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-s">Bills
                        </li>
                        <li class="breadcrumb-item text-s text-dark active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                {{-- Search bar --}}
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <form action="{{ route('bills.search') }}" method="get">
                                @csrf
                                <input type="text" class="form-control" name="search" placeholder="Type here...">
                            </form>
                        </div>
                    </div>

                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item d-flex align-items-center">
                            @include('dashboard.components.adminName')
                            @yield('admin.name')
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Bills Table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">

                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                #</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Customer</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                total cost</th>
                                            {{-- <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                water bill</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                gas bill</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                electricity bill</th> --}}
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                payment status</th> --}}
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                payment date</th>


                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Created at</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Updated at</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                <a href="#" style="color:forestgreen; font-size: 15px"
                                                    data-toggle="modal" data-target="#createModal">Create</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bills as $bill)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->id }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-s font-weight-bold mb-0">
                                                        {{-- {{ $bill->user->first_name }}
                                                        {{ $bill->user->last_name }} --}}
                                                    </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->bill_cost }}</span>
                                                </td>
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->waterBill->cost }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->gasBill->cost }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->electricityBill->cost }}</span>
                                                </td> --}}
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->payment_status }}</span>
                                                </td> --}}

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->payment_date }}</span>
                                                </td>


                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->created_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->updated_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content">
                                                                {{-- <a href="">
                                                                    <i class="bi bi-info-circle-fill send"></i></a> --}}
                                                                {{-- <button value="{{ $bill->id }}"
                                                                    class="infoBtn "
                                                                    style="border: 0ch; color: blue"><i
                                                                        class="bi bi-info-circle-fill"></i></button> --}}

                                                                {{-- <button value="{{ $bill->id }}"
                                                                    class="editBtn "
                                                                    style="border: 0ch; color: darkgoldenrod"><i
                                                                        class="fa fa-pen "></i></button> --}}
                                                                {{-- <a href="#edit{{ $captain->id }}"><i
                                                                        class="fa-solid fa-pen update "
                                                                        data-toggle="modal"></i></a> --}}
                                                                {{-- {{ route('captains.delete', ['captain' => $captain]) }} --}}
                                                                {{-- <a href=""><i class="fa-solid fa-trash delete">
                                                                        @method('DELETE')</i>
                                                                </a> --}}
                                                                <button value="{{ $bill->id }} "
                                                                    class="deleteBtn"
                                                                    style="border: 0ch; color: crimson"><i
                                                                        class="fa fa-trash update "></i></button>
                                                            </div>
                                                        </i>
                                                    </div>


                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                                <div class="float-start pagination-margin "> {{ $bills->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('dashboard.components.footer')
            @yield('footer')
        </div>
    </main>




    <!--Start Create Modal -->

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Admin</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('bills.add') }}" method="POST">
                        @csrf
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" name="user_first_name" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="user_last_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- Second ROW --}}
                        {{-- <div class="row"> --}}
                        {{-- First name --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payment date </label>
                                <input type="text" name="Payment_date" class="form-control"
                                    aria-describedby="emailHelp">

                            </div>
                        </div>
                        {{-- Last name --}}
                        {{-- <div class="col-6">
                                <div class="form-group">
                                    <label>Month Name</label>
                                    <input type="text" name="month_name" class="form-control">
                                </div>
                            </div> --}}
                        {{-- </div> --}}

                        {{-- SECOND ROW --}}
                        <div class="row">
                            {{-- Phone --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Payment Status</label>
                                    <input type="text" name="payment_status" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>

                            {{-- Rule --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Water bill</label>
                                    <input type="text" name="water_bill" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Gas bill</label>
                                <input type="text" name="gas_bill" class="form-control">
                            </div>
                        </div>
                        {{-- Password --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Electricity bil</label>
                                <input type="text" name="electricity_bill" class="form-control">
                            </div>
                        </div>
                        {{-- Password conformition --}}
                        {{-- <div class="col-12">
                            <div class="form-group">
                                <label>user id</label>
                                <input type="text" name="user_id" class="form-control">
                            </div>
                        </div> --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--End Create Modal -->




    <!--Start Delete Modal -->
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
    <!--End Delete Modal -->

    <!--Start Update Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Captain</h5>

                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('captains.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="captain_id" name="captain_id" value="">
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

                        {{-- Password --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        {{-- Password conformition --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
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





    @include('dashboard.components.script')
    @yield('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/dashboard/modal/bills.js') }}"></script>

</body>

</html>
