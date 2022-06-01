<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Captains</title>

    @include('dashboard.components.header')
    @yield('header')
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('icons/iconic/css/material-design-iconic-font.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons/bootstrap-icons.css') }} ">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dropdown-menu.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> --}}






</head>

<body class="g-sidenav-show bg-page">



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
            @if (session('Success'))
                @include('dashboard.components.alerts')
                @yield('success.alert')
            @endif

            @if (session('Error'))
                @include('dashboard.components.alerts')
                @yield('error.alert')
            @endif

            @if (session('Send'))
                @include('dashboard.components.alerts')
                @yield('send.alert')
            @endif
            @if (session('Warning'))
                @include('dashboard.components.alerts')
                @yield('warning.alert')
            @endif

            @if ($errors->any())
                @include('dashboard.components.alerts')
                @yield('validation')
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class=" row px-4 py-3" style="justify-content: space-between">
                            <div class="col-auto">
                                <h6>Captains Table</h6>
                            </div>
                            <div class="col-auto">
                                <a href="#" style="color:forestgreen; font-size: 16px; font-weight: 600"
                                    data-toggle="modal" data-target="#createModal">Create</a>
                            </div>
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

                                                                <button value="{{ $captain->id }}"
                                                                    class="infoBtn "><i
                                                                        class="bi bi-info-circle-fill"></i></button>
                                                                <button value="{{ $captain->id }}"
                                                                    class="editBtn "><i
                                                                        class="fa fa-pen "></i></button>

                                                                <button value="{{ $captain->id }} "
                                                                    class="deleteBtn"><i
                                                                        class="fa fa-trash update "></i></button>
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
        </div>
    </main>


    {{-- Modals --}}
    <!-- Create Modal -->
    @include('dashboard.captains.modals.create')
    @yield('createModal')


    <!-- Update Modal -->
    @include('dashboard.captains.modals.edit')
    @yield('editModal')


    <!-- Delete Modal -->
    @include('dashboard.captains.modals.delete')
    @yield('deleteModal')


    <!-- Info Modal -->
    @include('dashboard.captains.modals.info')
    @yield('infoModal')

    {{-- Modals --}}

    {{-- Script --}}
    @include('dashboard.captains.script')
    @yield('script')
</body>

</html>
