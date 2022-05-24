<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @include('dashboard.components.header')
    @yield('header')

</head>

<body>
    @include('dashboard.components.sideBar')
    @yield('sideBar')





    @include('dashboard.components.footer')
    @yield('footer')
</body>

</html>
