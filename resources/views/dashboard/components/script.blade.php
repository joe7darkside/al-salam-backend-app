@section('script')
    {{-- Dashboard Script --}}
    <script src="{{ asset('/js/dashboard/soft-ui-dashboard.min.js?v=1.0.5') }}"></script>
    <script src="{{ asset('/js/sideBar/sideBar.js') }}"></script>

    {{-- SideBar Script --}}
    {{-- <script src="{{ asset('/js/dashboard/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/dashboard/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script> --}}
@endsection
