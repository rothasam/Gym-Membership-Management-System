<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'C4FINESS')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        * {

            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        .header {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 60px;
            /* background-color: #f8f9fa; */
            display: flex;
            align-items: center;
            padding: 0 1rem;
            z-index: 1040;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            position: relative;
            height: 100vh;
            background-position: center;
            background: url("{{ asset('images/background.webp') }}") no-repeat center center;
        }

        .blur {
            top: 0;
            left: 0;
            position: absolute;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.49);
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>