<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('css/main.css') }} ">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons/bootstrap-icons.css') }} ">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    @include('dashboard.components.sideBar')
    @yield('sideBar')

    <h1>Home page</h1>
</body>

</html>
