@section('footer')
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-s text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Aswar
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            Al Salam App
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </footer>
    {{-- <script src="{{ asset('/js/sideBar/sideBar.js') }}"></script>
    <script src="{{ asset('/js/dashboard/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/dashboard/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script src="{{ asset('/js/dashboard/soft-ui-dashboard.min.js?v=1.0.5') }}"></script> --}}
@endsection
