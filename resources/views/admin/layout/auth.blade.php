<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Dashboard | Sign In</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('dashboard/img/svg/logo.svg')}}" type="image/x-icon">
    <!-- Custom styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('dashboard/css/style.min.css')}}">
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        @yield('content')

    </main>
    <!-- Chart library -->
    <script src="{{asset('dashboard/plugins/chart.min.js')}}"></script>
    <!-- Icons library -->
    <script src="{{asset('dashboard/plugins/feather.min.js')}}"></script>
    <!-- Custom scripts -->
    <script src="{{asset('dashboard/js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
