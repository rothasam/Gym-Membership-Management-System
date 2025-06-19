<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>

    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.62);
            padding: 1rem;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: rgb(138, 131, 131);
        }

        .sidebar .nav-link:hover {
            background-color: rgb(240, 14, 101);
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: rgb(240, 14, 101);
            color: #ffffff;
        }

        .main-content {
            margin-left: 220px;
            /* same width as sidebar */
            padding: 2rem;
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="text-black">C4FINESS</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members.register') ? 'active' : '' }}" href="{{ route('members.register') }}">Register Member</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('classes.index') ? 'active' : '' }}" href="{{ route('classes.index') }}">Class</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('classes.register') ? 'active' : '' }}" href="{{ route('classes.register') }}">Class Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('plans.index') ? 'active' : '' }}" href="{{ route('plans.index') }}">Membership Plan</a>
            </li>
        </ul>
    </div>



</body>

</html>