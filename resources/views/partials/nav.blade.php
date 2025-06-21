<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>

    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            margin: 2px 0;
            color: rgb(138, 131, 131);
            border-bottom-left-radius: 10px;
            border-top-left-radius: 10px;
            transition: 0.3 linear;
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
        <h4 class="text-black mb-5">C4FINESS</h4>
        <ul class="nav flex-column ">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members.register') ? 'active' : '' }}" href="{{ route('members.register') }}">
                    <i class="fas fa-user-plus me-2"></i>
                    Register
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members.show') ? 'active' : '' }}" href="{{ route('members.show') }}">
                    <i class="fas fas fa-user me-2"></i>
                    Member
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('classes.index') ? 'active' : '' }}" href="{{ route('classes.index') }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Class
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('classes.create') ? 'active' : '' }}" href="{{ route('classes.create') }}">
                    <i class="fas fa-edit me-2"></i>
                    Class Register
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('plans.create') ? 'active' : '' }}" href="{{ route('plans.create') }}">
                    <i class="fas fa-id-card me-2"></i>
                    Membership Plan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members.attendance') ? 'active' : '' }}" href="{{ route('members.attendance') }}">
                    <i class="fas fa-id-card me-2"></i>
                    Attendance
                </a>
            </li>
        </ul>
    </div>



</body>

</html>