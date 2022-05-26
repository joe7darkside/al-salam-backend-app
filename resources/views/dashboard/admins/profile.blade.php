<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('dashboard.components.header')
    @yield('header')
    <title>
        Profile
    </title>

</head>

<body class="g-sidenav-show bg-gray-100">
    @include('dashboard.components.sideBar')
    @yield('sideBar')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav
            class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
            <div class="container-fluid py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-m"><a class="text-white opacity-5">Customers</a>
                        </li>
                        <li class="breadcrumb-item text-m text-white active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <ul class="navbar-nav  justify-content-end">

                    <li class="nav-item d-flex align-items-center">

                        <i class="fa fa-user me-sm-1 text-white px-2"></i>
                        <span class="d-sm-inline d-none text-white">Admin Name</span>
                    </li>

                </ul>

            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('/images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-info opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        {{-- <div class="avatar avatar-xl position-relative">
                            <img src="/images/user.png" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div> --}}
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->first_name }}
                                {{ $user->last_name }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-m">
                                {{ $user->email }}
                            </p>
                            <p class="mb-0 font-weight-bold text-m">
                                {{ $user->phone }}
                            </p>
                            {{-- <p class="mb-0 font-weight-bold text-sm">
                                {{ $rule }}
                            </p> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">

                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab"
                                        href="{{ route('users.send', ['id' => $user->id]) }}" role="tab"
                                        aria-selected="true">

                                        <i class="fa fa-paper-plane me-sm-1 text-gray-600 "></i>
                                        <span class="ms-1">Notification</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#" role="tab"
                                        aria-selected="false">
                                        <i class="fa fa-trash me-sm-1 text-gray-600"></i>
                                        <span class="ms-1">Delete</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card h-60 ">
                        <div class="card-header pb-0 p-3">
                            <h5 class="mb-0">Invitations</h5>
                        </div>
                        <div class="scrollable-container p-3">

                            <ul class="list-group">
                                @foreach ($user->invitaion as $invite)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $invite->visiter_name }}</h6>
                                            <p class="mb-0 text-xs">{{ $invite->created_at }}</p>
                                        </div>
                                        @if ($invite->permission == 0)
                                            <a class="delete pe-3 ps-0 mb-0 ms-auto">Denied</a>
                                        @else
                                            <a class="profile pe-3 ps-0 mb-0 ms-auto">Approved</a>
                                        @endif

                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card h-60 ">
                        <div class="card-header pb-0 p-3">
                            <h5 class="mb-0">Trips</h5>
                        </div>
                        <div class="scrollable-container p-3">
                            <ul class="list-group">
                                @for ($i = 0; $i <= $user->trip->count(); $i++)
                                @endfor
                                @foreach ($user->trip as $trip)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            {{-- <h6 class="mb-0 text-m">{{ $trip->captain_id }}</h6> --}}
                                            <p class="mb-0 text-s">{{ $trip->cost }} IQ</p>
                                            <p class="mb-0 text-s">{{ $trip->created_at }} </p>
                                            {{-- <p class="mb-0 text-xs">{{ $trip->payment_method }}</p> --}}
                                        </div>
                                        @switch($trip->payment_method)
                                            @case(0)
                                                <a class="profile pe-3 ps-0 mb-0 ms-auto">Cash</a>
                                            @break

                                            @case(1)
                                                <a class="profile pe-3 ps-0 mb-0 ms-auto">Visa card</a>
                                            @break

                                            @case(2)
                                                <a class="profile pe-3 ps-0 mb-0 ms-auto">Al salam card</a>
                                            @break

                                            @default
                                        @endswitch
                                        {{-- @if ($trip->payment_method == 0)
                                            <a class="delete pe-3 ps-0 mb-0 ms-auto">Cash</a>
                                        @if
                                            <a class="profile pe-3 ps-0 mb-0 ms-auto">Visa card</a>
                                        @else
                                            <a class="profile pe-3 ps-0 mb-0 ms-auto">Al salam card</a>
                                        @endif --}}

                                    </li>
                                @endforeach



                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card h-60 ">
                        <div class="card-header pb-0 p-3">
                            <h5 class="mb-0">Bills</h5>
                        </div>
                        <div class="scrollable-container p-3">
                            <ul class="list-group">
                                @foreach ($user->bill as $bill)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-m">{{ $bill->month_name }}</h6>
                                            <p class="mb-0 text-s">{{ $bill->bill_cost }} IQ</p>
                                            <p class="mb-0 text-xs">{{ $bill->payment_date }}</p>
                                        </div>
                                        @if ($bill->payment_status == 0)
                                            <a class="delete pe-3 ps-0 mb-0 ms-auto">Incomplete</a>
                                        @else
                                            <a class="profile pe-3 ps-0 mb-0 ms-auto">Complete</a>
                                        @endif

                                    </li>
                                @endforeach



                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            @include('dashboard.components.footer')
            @yield('footer')

        </div>

    </div>


    @include('dashboard.components.script')
    @yield('script')

</body>

</html>
