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
                    {{-- <h6 class="font-weight-bolder mb-0">Dashboard</h6> --}}
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
                                    <div
                                        class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
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
                                            {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="bi bi-people-fill"></i>
                                        {{-- class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> --}}
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
                                            {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa fa-suitcase-rolling"></i>
                                        {{-- class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i> --}}
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
                                            {{-- <span class="text-success text-sm font-weight-bolder">+2%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="bi bi-person-lines-fill"></i>
                                        {{-- <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i> --}}
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
                            {{-- <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week
                            </p> --}}
                            <div class="container border-radius-lg">
                                <div class="row">
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="align-middle bi bi-people-fill text-white"
                                                    style="height: 5px; width: 10px;"></i>
                                                {{-- <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>document</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-1870.000000, -591.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(154.000000, 300.000000)">
                                                                    <path class="color-background"
                                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                        opacity="0.603585379"></path>
                                                                    <path class="color-background"
                                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg> --}}
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
                                                {{-- <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>document</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-1870.000000, -591.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(154.000000, 300.000000)">
                                                                    <path class="color-background"
                                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                        opacity="0.603585379"></path>
                                                                    <path class="color-background"
                                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg> --}}
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
                                                {{-- <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>spaceship</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-1720.000000, -592.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(4.000000, 301.000000)">
                                                                    <path class="color-background"
                                                                        d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                                    </path>
                                                                    <path class="color-background"
                                                                        d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                                    </path>
                                                                    <path class="color-background"
                                                                        d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                                                                        opacity="0.598539807"></path>
                                                                    <path class="color-background"
                                                                        d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                                                                        opacity="0.598539807"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg> --}}
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
                                                {{-- <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>settings</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2020.000000, -442.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(304.000000, 151.000000)">
                                                                    <polygon class="color-background"
                                                                        opacity="0.596981957"
                                                                        points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                                    </polygon>
                                                                    <path class="color-background"
                                                                        d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                                        opacity="0.596981957"></path>
                                                                    <path class="color-background"
                                                                        d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg> --}}
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
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more than</span> 2021
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas " height="370"></canvas>
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
                                <div class="col-lg-6 col-5 my-auto text-end ">
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
                                </div>
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
                                                Phone</th>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Email</th>
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Completion</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($table_customer as $customer)
                                            <tr>

                                                <td class="align-middle text-center text-s">
                                                    <span
                                                        class="text-xs font-weight-bold">{{ $customer->first_name }}</span>

                                                </td>
                                                <td class="align-middle text-center text-s">
                                                    <span
                                                        class="text-xs font-weight-bold">{{ $customer->phone }}</span>

                                                </td>
                                                <td class="align-middle text-center text-s">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $customer->email }}</span>
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
                                                        {{ $invitation->visiter_name }}</h6>
                                                </div>

                                                @switch($invitation->permission)
                                                    @case(0)
                                                        <div class="col-4">
                                                            <h6 class="text-danger text-sm font-weight-bold mb-0 align-middle">
                                                                Denied</h6>
                                                        </div>
                                                    @break

                                                    @case(1)
                                                        <div class="col-4">
                                                            <h6
                                                                class="text-success text-sm font-weight-bold mb-0 align-middle">
                                                                Approved</h6>
                                                        </div>
                                                    @break

                                                    @default
                                                @endswitch

                                            </div>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $invitation->created_at->format('d M H:i ') }}
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

    <script src="{{ asset('/js/plugins/chartjs.min.js') }}"></script>
   <script src="{{ asset('/js/dashboard/chart/chart.js') }}" ></script>
    @include('dashboard.components.script')
    @yield('script')

</body>

</html>
