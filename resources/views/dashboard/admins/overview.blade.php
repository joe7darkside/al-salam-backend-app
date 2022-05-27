<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        admins
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
                        <li class="breadcrumb-item text-s">Customers
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
                            <form action="{{ route('admins.search') }}" method="get">
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
        <div class="container-fluid py-4">
            @if (session('Message'))
                <div class="deleted">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';"
                        class="deleted">&times;</span>
                    <p style="color: crimson">{{ session('Message') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Admins Table</h6>
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
                                                name</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                rule</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                phone</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Created at</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Updated at</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">


                                                <!-- Button trigger modal -->
                                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> --}}



                                                {{-- <button type="submit" style="color:forestgreen "
                                                    id="createModal">Create</button> --}}

                                                <a href="#" style="color:forestgreen; font-size: 15px"
                                                    data-toggle="modal" data-target="#createModal">Create</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>


                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->id }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->first_name }}
                                                        {{ $admin->last_name }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->rule }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->phone }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->email }}</span>
                                                </td>


                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->created_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $admin->updated_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content">
                                                                {{-- <a href="">
                                                                    <i class="bi bi-info-circle-fill send"></i></a> --}}
                                                                {{-- <button value="{{ $captain->id }}"
                                                                    class="infoBtn "
                                                                    style="border: 0ch; color: blue"><i
                                                                        class="bi bi-info-circle-fill"></i></button> --}}

                                                                <button value="{{ $admin->id }}"
                                                                    class="editBtn "
                                                                    style="border: 0ch; color: darkgoldenrod"><i
                                                                        class="fa fa-pen "></i></button>
                                                                {{-- <a href="#edit{{ $captain->id }}"><i
                                                                        class="fa-solid fa-pen update "
                                                                        data-toggle="modal"></i></a> --}}
                                                                {{-- {{ route('captains.delete', ['captain' => $captain]) }} --}}
                                                                {{-- <a href=""><i class="fa-solid fa-trash delete">
                                                                        @method('DELETE')</i>
                                                                </a> --}}
                                                                <button value="{{ $admin->id }} "
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
                                <div class="float-start pagination-margin "> {{ $admins->links() }}</div>
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
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        {{-- FIRST ROW --}}
                        <div class="row">
                            {{-- First name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input type="text" name="first_name" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Last name --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- SECOND ROW --}}
                        <div class="row">
                            {{-- Phone --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" aria-describedby="emailHelp">

                                </div>
                            </div>

                            {{-- Rule --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Rule</label>
                                    <input type="text" name="rule" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        {{-- Password --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        {{-- Password conformition --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control">
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
    <!--Start Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Captain</h5>
                </div>
                <form action="{{ route('admins.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_admin_id" id="delete_admin_id">
                    <div class="modal-body">
                        Confirm Delete Admin?
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
    <!--End Create Modal -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="/js/dashboard/modal/modal.js"></script> --}}

    <script src="{{ asset('js/dashboard/modal/admin.js') }}"></script>

    @include('dashboard.components.script')
    @yield('script')




</body>

</html>
