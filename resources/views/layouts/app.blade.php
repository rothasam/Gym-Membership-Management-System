<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'C4FINESS')</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" /> -->

    <!-- @vite(['resources/css/main.css']); -->
    @vite(['resources/css/app.css','resources/css/main.css'])
     <!-- @vite(['resources/css/main.css']) -->
    <style>
        .main-content{
            background: url("{{ asset('images/background.webp') }}") no-repeat center center;
        }
    </style>
</head>

<body>

    <main class="container-fluid g-0">
        <div class="row gx-0 ">
            <div class="col-2">
                @include('partials.nav')
            </div>
            <div class="col-10 bg-primary main-content">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- @vite(['resources/js/app.js']) -->
    @yield('scripts')
</body>

</html>