<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'C4FINESS')</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" /> -->

    <!-- @vite(['resources/css/app.css']); -->
    @vite(['resources/css/main.css']);
    <style>
        .main-content{
            background: url("{{ asset('images/background.webp') }}") no-repeat center center;
        }
    </style>
</head>

<body>

    {{-- Header --}}


    {{-- Page Content --}}
    <main class="main-content">
        <div class="blur">
            @yield('content')
        </div>
    </main>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    @yield('scripts')
</body>

</html>