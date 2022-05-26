@section('sideBar')
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">



        <div id="app ">

            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <div class="d-flex justify-content-between">
                            <div class="logo">

                                App Logo

                            </div>
                            <!-- <div class="toggler">
                                                                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                                                                </div> -->
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title"><strong>Menu</strong></li>

                            <li class="sidebar-item">
                                <a href="{{ route('home') }}" class='sidebar-link'>
                                    <i class="bi bi-house-door-fill"></i>
                                    <span>Home</span>
                                </a>
                            </li>


                            <li class="sidebar-item ">
                                <a href="" class='sidebar-link'>
                                    <i class="bi bi-bell-fill"></i> <span>Notifications</span>
                                </a>
                            </li>

                            <li class="sidebar-item ">
                                <a href="{{ route('admins.overView') }}" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i> <span>Admins</span>
                                </a>
                            </li>
                            <br>


                            {{-- <li class="sidebar-title"><strong>Admins</strong></li> --}}

                            {{-- <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-tools"></i>
                                    <span>Admins</span>
                                </a>

                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="{{ route('admins.overView') }}">Overview</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Captains Admins</a>
                                    </li>

                                    <li class="submenu-item ">
                                        <a href="">Monitoring
                                            System</a>
                                    </li>

                                    <li class="submenu-item ">
                                        <a href="">DoorPhone</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Satelite
                                            System</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Internal
                                            Telephone</a>
                                    </li>
                                </ul>
                            </li> --}}

                            {{-- <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope-fill"></i>
                                    <span>Guest Invitation</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="">Overview</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Pandding</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Confirmed</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Dismissed</a>
                                    </li>


                                </ul>
                            </li> --}}
                            {{-- <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Customer Bills</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="">Overview</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Electricity </a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Gas </a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Water </a>
                                    </li>




                                </ul>
                            </li> --}}
                            {{-- <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-truck"></i>
                                    <span>Transportation & Delivery</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                    <a href="">Overview</a>
                                </li>
                                    <li class="submenu-item ">
                                        <a href="">Captains </a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Customers </a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Trips </a>
                                    </li>
                                    <li class="submenu-item ">
                                    <a href="">Trips </a>
                                </li>




                                </ul>
                            </li> --}}

                            <li class="sidebar-title"><strong>Bills</strong></li>
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-cart-plus-fill"></i>
                                    <span>Bills Menu</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="{{ route('bills.overView') }}">Overview</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Paid</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Unpaid</a>
                                    </li>
                                    {{-- <li class="submenu-item ">
                                        <a href="">Confirmed</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">Done</a>
                                    </li> --}}
                                </ul>
                            </li>

                            {{-- <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-cart-fill"></i>
                                <span>Orders Record</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="layout-default.html">page</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-1-column.html">page</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-navbar.html">page</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-horizontal.html">page</a>
                                </li>
                            </ul>
                        </li> --}}

                            <li class="sidebar-title"> <strong>Compounds </strong> </li>

                            <li class="sidebar-item  has-sub">
                                <a href="" class='sidebar-link'>
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span>All Supported Compounds</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="">AL Salam</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="">AL Bador</a>
                                    </li>
                                </ul>

                            </li>
                            {{-- <li class="sidebar-item  ">
                            <a href="{{ route('compounds.index') }}" class='sidebar-link'>
                                <i class="bi bi-building"></i>
                                <span>All Supported Compounds</span>
                            </a>
                        </li> --}}


                            <li class="sidebar-title"> <strong> Customers </strong></li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span>Customers</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="{{ route('users.overView') }}">Overview</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="sidebar-title"> <strong> Locations </strong></li>
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-map-fill"></i>
                                    <span>Centers</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="">Overview</a>
                                    </li>
                                    {{-- <li class="submenu-item ">
                                    <a href="ui-map-jsvectormap.html">page</a>
                                </li> --}}
                                </ul>
                            </li>

                            <li class="sidebar-title "> <strong> Account Setting </strong></li>

                            {{-- <li class="sidebar-item  ">
                            <a href="application-email.html" class='sidebar-link'>
                                <i class="bi bi-person-check"></i>
                                <span>Account Setting </span>
                            </a>
                        </li> --}}

                            <li class="sidebar-item">

                                <a href="{{ route('logout') }}" class='sidebar-link'> <i
                                        class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out </span></a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </aside>
@endsection
