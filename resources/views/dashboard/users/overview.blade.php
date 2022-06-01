<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Users
    </title>
    <link rel="stylesheet" href="{{ asset('css/scrollBar.css') }} ">
    @include('dashboard.components.header')
    @yield('header')
</head>



<body class="g-sidenav-show  bg-page main-scrollBar">

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
                            <form action="{{ route('users.search') }}" method="get">
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
        <div class="container-fluid py-4 ">
            @if (session('Success'))
                @include('dashboard.components.alerts')
                @yield('success.alert')
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">

                        <div class=" row px-4 py-3" style="justify-content: space-between">
                            <div class="col-auto">
                                <h6>Users Table</h6>
                            </div>
                            {{-- <div class="col-auto">
                                <a href="#" class="createBtn" style="color:forestgreen; font-size: 16px; font-weight: 600"
                                    data-toggle="modal" data-target="#createBtn">Create</a>
                            </div> --}}
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                USER</th>
                                            <th
                                                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 ps-2">
                                                Phone</th>
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Status</th> --}}
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Created at</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Updated at</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        {{-- <div>
                                                            <img src="../assets/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div> --}}
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $user->first_name }}
                                                                {{ $user->last_name }}
                                                            </h6>
                                                            <p class="text-s text-secondary mb-0">
                                                                {{ $user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-s font-weight-bold mb-0">{{ $user->phone }}</p>
                                                </td>
                                                {{-- <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">Online</span>
                                                </td> --}}
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-s font-weight-bold">{{ $user->created_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-s font-weight-bold">{{ $user->updated_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    {{-- <button class=" btn btn-link text-secondary mb-0"> --}}
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content">
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#sendModal"><i
                                                                        class="fa-solid fa-paper-plane send"></i></a>
                                                                <a
                                                                    href="{{ route('users.profile', ['id' => $user->id]) }}"><i
                                                                        class="fa-solid fa-address-card profile"></i></a>
                                                                {{-- <a href=""><i class="fa-solid fa-trash delete"></i></a> --}}
                                                            </div>
                                                        </i>
                                                    </div>

                                                    {{-- </button> --}}
                                                </td>
                                                {{-- <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-start pagination-margin "> {{ $users->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @include('dashboard.components.footer')
            @yield('footer') --}}
        </div>
    </main>

    @include('dashboard.users.modals.create')
    @yield('createModal')

    @include('dashboard.users.script')
    @yield('script')
</body>

</html>
