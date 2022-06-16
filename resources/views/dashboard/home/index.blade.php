<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/dropdown-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scrollBar.css') }} ">
    @include('dashboard.components.header')
    @yield('header')

</head>

</body>

<body class="g-sidenav-show bg-page main-scrollBar  bg-gray-100">
    @include('dashboard.components.sideBar')
    @yield('sideBar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Home</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Bills</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $new_bills }} IQD
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Customers</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $new_customers }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Trips</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $new_trips }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa fa-suitcase-rolling"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Invitations</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $new_invitations }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="bi bi-person-lines-fill"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">

            </div>
            <div class="row mt-4">
                <div class="col-lg-6 mb-lg-0 mb-4 pb-3">
                    <div class="card z-index-2">
                        <div class="card-body p-3">
                            <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas " height="170"></canvas>
                                </div>
                            </div>
                            <h6 class="ms-2 mt-4 mb-0">Activities Overview </h6>

                            <div class="container border-radius-lg">
                                <div class="row">
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="align-middle bi bi-people-fill text-white"
                                                    style="height: 5px; width: 10px;"></i>

                                            </div>
                                            <p class="text-s mt-1 mb-0 font-weight-bold">Customers</p>
                                        </div>
                                        <h5 class="font-weight-bolder">{{ $overview_customer }}</h5>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-dark w-100" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">

                                                <i class="align-middle  bi bi-person-lines-fill text-white"
                                                    style="height: 5px; width: 10px;"></i>

                                            </div>
                                            <p class="text-s mt-1 mb-0 font-weight-bold">Captains</p>
                                        </div>
                                        <h5 class="font-weight-bolder">{{ $overview_captains }}</h5>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-dark w-100" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="align-middle fa fa-suitcase-rolling text-white"
                                                    style="height: 5px; width: 10px;"></i>

                                            </div>
                                            <p class="text-s mt-1 mb-0 font-weight-bold">Trips</p>
                                        </div>
                                        <h5 class="font-weight-bolder">{{ $overview_trip }}</h5>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-dark w-100" role="progressbar"
                                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="align-middle bi bi-envelope-fill text-white"
                                                    style="height: 5px; width: 10px;"></i>

                                            </div>
                                            <p class="text-s mt-1 mb-0 font-weight-bold">Invitations</p>
                                        </div>
                                        <h5 class="font-weight-bolder">{{ $overview_invitation }}</h5>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-dark w-100" role="progressbar"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <svg width="10px" height="10px" viewBox="0 0 43 36" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <p class="text-s mt-1 mb-0 font-weight-bold">Bills</p>
                                        </div>
                                        <h5 class="font-weight-bolder">{{ $overview_bill }} IQD</h5>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-dark w-100" role="progressbar"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h6>Bills overview</h6>
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more than</span> 2021
                            </p> --}}
                        </div>
                        <div class="card-body p-3">
                          
                            <div class="chart">
                                <canvas id="chart-lines" class="chart-canvas " height="410"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4 ">
                <div class="col-lg-6 col-md-6 mb-4 ">
                    <div class="card card-body ">
                        <div class="card-header pb-0">
                            <div class="row ">
                                <div class="col-lg-6 col-7 ">
                                    <h6>Latest Customers</h6>
                                    {{-- <p class="text-sm mb-0">
                                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1">Latest 5</span>
                                    </p> --}}
                                </div>
                                {{-- <div class="col-lg-6 col-5 my-auto text-end ">
                                    <div class="dropdown float-lg-end pe-4">
                                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-secondary"></i>
                                        </a>
                                        <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                            aria-labelledby="dropdownTable">
                                            <li><a class="dropdown-item border-radius-md"
                                                    href="javascript:;">Action</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Another
                                                    action</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Something
                                                    else here</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Full Name</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                Cost (IQD)</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Payment date</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($table_bills as $bill)
                                            <tr>

                                                <td class="align-middle text-center text-s">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $bill->user->first_name }}
                                                        {{ $bill->user->last_name }}
                                                    </span>

                                                </td>
                                                <td class="align-middle text-center text-s">
                                                    <span
                                                        class="text-xs font-weight-bold">{{ $bill->bill_cost }}</span>

                                                </td>
                                                <td class="align-middle text-center text-s">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $bill->payment_date }}</span>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 ">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Latest Trips</h6>
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">24%</span> this month
                            </p> --}}
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">Latest 5</span>
                            </p> --}}
                        </div>
                        <div class="card-body p-2">
                            <div class="timeline timeline-one-side">
                                @foreach ($table_trip as $trip)
                                    {{-- @endforeach --}}
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-bell-55 text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $trip->cost }}
                                                IQD
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $trip->created_at->format('d M H:i ') }}

                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-4 ">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Latest Invitations</h6>
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">24%</span> this month
                            </p> --}}
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">Latest 5</span>
                            </p> --}}
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                @foreach ($table_invitation as $invitation)
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-bell-55 text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <div class="row" style="justify-content: space-between;">
                                                <div class="col-5">
                                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                        {{ $invitation->guest_name }}</h6>
                                                </div>

                                                @switch($invitation->permission)
                                                    @case(0)
                                                        <div class="col-4">
                                                            <h6
                                                                class="text-secondary text-sm font-weight-bold mb-0 align-middle">
                                                                Pending</h6>
                                                        </div>
                                                    @break

                                                    @case(1)
                                                        <div class="col-4">
                                                            <h6
                                                                class="text-success text-sm font-weight-bold mb-0 align-middle">
                                                                Approved</h6>
                                                        </div>
                                                    @break

                                                    @case(2)
                                                        <div class="col-4">
                                                            <h6 class="text-danger text-sm font-weight-bold mb-0 align-middle">
                                                                Denied</h6>
                                                        </div>
                                                    @break

                                                    @default
                                                @endswitch

                                            </div>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $invitation->created_at->format('d M H ') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('dashboard.components.footer')
            @yield('footer')
        </div>
    </main>

    @include('dashboard.home.script')
    @yield('script')

</body>

</html>
