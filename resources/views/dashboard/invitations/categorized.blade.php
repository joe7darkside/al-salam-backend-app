<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        invitations
    </title>

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
                        <li class="breadcrumb-item text-s">Invitations
                        </li>
                        <li class="breadcrumb-item text-s text-dark active" aria-current="page">{{ $category_name }}
                        </li>
                    </ol>
                </nav>
                {{-- Search bar --}}
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <form action="{{ route('invitations.category.search', ['category' => $category]) }}"
                                method="get">
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
                            <h6>Invitations Table</h6>
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
                                                Visiter </th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                Date</th>

                                            {{-- <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                gas invitation</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                electricity invitation</th> --}}
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                payment status</th> --}}
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                payment method</th> --}}


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
                                        @foreach ($invitations as $invitation)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->id }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->user->first_name }}
                                                        {{ $invitation->user->last_name }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-s font-weight-bold mb-0">
                                                        {{ $invitation->guest_name }}

                                                    </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->visit_date }}</span>
                                                </td>
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->email }}</span>
                                                </td> --}}
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->waterinvitation->cost }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->gasinvitation->cost }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->electricityinvitation->cost }}</span>
                                                </td> --}}
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->payment_status }}</span>
                                                </td> --}}

                                                {{-- <td class="align-middle text-center">
                                                    @switch($invitation->payment_method)
                                                        @case(0)
                                                            <span class="text-s font-weight-bold mb-0">Cash</span>
                                                        @break

                                                        @case(1)
                                                            <span class="text-s font-weight-bold mb-0">Visa Card</span>
                                                        @break

                                                        @case(2)
                                                            <span class="text-s font-weight-bold mb-0">Al Salam Card</span>
                                                        @break

                                                        @default
                                                    @endswitch

                                                </td> --}}


                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->created_at->diffForHumans() }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $invitation->updated_at->diffForHumans() }}</span>
                                                </td>

                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content col-auto">

                                                                <button value="{{ $invitation->id }}"
                                                                    class="infoBtn "><i
                                                                        class="fa fa-info"></i></button>

                                                                <button value="{{ $invitation->id }}"
                                                                    class="actionBtn "><i
                                                                        class="fa fa-pen"></i></button>

                                                                {{-- <button value="{{ $invitation->id }} "
                                                                    class="deleteBtn"><i
                                                                        class="fa fa-trash update "></i></button> --}}
                                                            </div>
                                                        </i>
                                                    </div>
                                                </td>
                                                {{-- <td class="align-middle">
                                                    <div class="dropdown">
                                                        <i class="fa fa-ellipsis-v ">
                                                            <div class="dropdown-content">
                                                                <a href="">
                                                                    <i class="bi bi-info-circle-fill send"></i></a>
                                                                <a href="#"><i class="fa-solid fa-pen edit"></i></a>
                                                                {{ route('invitations.delete', ['invitation' => $invitation]) }}
                                                                <a href=""><i class="fa-solid fa-trash delete">
                                                                        @method('DELETE')</i>
                                                                </a>
                                                            </div>
                                                        </i>
                                                    </div>


                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                                <div class="float-start pagination-margin "> {{ $invitations->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @include('dashboard.components.footer')
            @yield('footer') --}}
        </div>
    </main>

    @include('dashboard.invitations.modals.info')
    @yield('infoModal')
    
    @include('dashboard.invitations.modals.action')
    @yield('actionModal')

    @include('dashboard.invitations.script')
    @yield('script')

    {{-- @include('dashboard.components.script')
    @yield('script') --}}
</body>

</html>
