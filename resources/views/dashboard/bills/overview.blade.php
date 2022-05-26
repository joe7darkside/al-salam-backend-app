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
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                                payment status</th>
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
                                                        {{ $bill->user->first_name }}
                                                        {{ $bill->user->last_name }}
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
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-s font-weight-bold mb-0">{{ $bill->payment_status }}</span>
                                                </td>

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
                                                                <a href="">
                                                                    <i class="bi bi-info-circle-fill send"></i></a>
                                                                <a href="#"><i class="fa-solid fa-pen edit"></i></a>

                                                                <a
                                                                    href="{{ route('bills.delete', ['bill' => $bill]) }}"><i
                                                                        class="fa-solid fa-trash delete">
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


    @include('dashboard.components.script')
    @yield('script')
</body>

</html>







{{-- <table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th
                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                user</th>

            <th
                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                water bill</th>

            <th
                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                gas bill</th>

            <th
                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                electricity</th>
            <th
                class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 ps-2">
                Payment date</th>
            <th
                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                Month</th>
            <th
                class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                Payment status</th>
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
        @foreach ($bills as $bill)
            <tr>
                <td>
                    <p class="text-s text-secondary mb-0">
                        {{ $bill->user_id }}
                    </p>
                </td>

                <td>
                    <p class="text-s text-secondary mb-0">
                        {{ $bill->waterBill->cost }}
                    </p>
                </td>

                <td>
                    <p class="text-s text-secondary mb-0">
                        {{ $bill->gasBill->cost }}
                    </p>
                </td>

                <td>
                    <p class="text-s text-secondary mb-0">
                        {{ $bill->electricityBill->cost }}
                    </p>
                </td>
                <td>
                    <p class="text-s font-weight-bold mb-0">{{ $bill->payment_date }}
                    </p>
                </td>

                <td class="align-middle text-center">
                    <span
                        class="text-secondary text-s font-weight-bold">{{ $bill->created_at->diffForHumans() }}</span>
                </td>
                <td class="align-middle text-center">
                    <span
                        class="text-secondary text-s font-weight-bold">{{ $bill->updated_at->diffForHumans() }}</span>
                </td>
                <td class="align-middle">
                    <div class="dropdown">
                        <i class="fa fa-ellipsis-v ">
                            <div class="dropdown-content">
                                <a href="#"><i
                                        class="fa-solid fa-paper-plane send"></i></a>
                                <a
                                    href="{{ route('bills.profile', ['id' => $bill->id]) }}"><i
                                        class="fa-solid fa-address-card profile"></i></a>
                                <a href=""><i class="fa-solid fa-trash delete"></i></a>
                            </div>
                        </i>
                    </div>

                    {{-- </button> --}}
{{-- </td>

</tr>
@endforeach --}}
</tbody>
</table> --}}
