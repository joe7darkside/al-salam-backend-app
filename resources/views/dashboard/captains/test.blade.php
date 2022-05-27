<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        captains
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
                        <li class="breadcrumb-item text-s">captains
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
                            <form action="{{ route('captains.search') }}" method="get">
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
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>captains Table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">

                                <table class="table align-items-center mb-0" id="datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                #</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                captains</th>

                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                phone</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                email</th>

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
                                        @foreach ($captains as $captain)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $captain->id }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-s font-weight-bold mb-0">
                                                        {{ $captain->first_name }}
                                                        {{ $captain->last_name }}
                                                    </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $captain->phone }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $captain->email }}</span>
                                                </td>


                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $captain->created_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $captain->updated_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content">
                                                                <a href="">
                                                                    <i class="bi bi-info-circle-fill send"></i></a>
                                                                <a href="#"><i
                                                                        class="fa-solid fa-pen update edit"></i></a>
                                                                {{-- {{ route('captains.delete', ['captain' => $captain]) }} --}}
                                                                <a href=""><i class="fa-solid fa-trash delete">
                                                                        @method('DELETE')</i>
                                                                </a>
                                                            </div>
                                                        </i>
                                                    </div>


                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                                <div class="float-start pagination-margin "> {{ $captains->links() }}</div>
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
                    <form action="{{ route('captains.register') }}" method="POST">
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
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>

                        </div>


                        {{-- Thired ROW --}}
                        <div class="row">
                            {{-- vehicle --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>vehicle</label>
                                    <input type="text" name="vehicle" class="form-control"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Licence plate</label>
                                    <input type="text" name="licence_plate" class="form-control">
                                </div>
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

    <!--End Create Modal -->

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

    <!--End Update Modal -->



</body>

</html>
