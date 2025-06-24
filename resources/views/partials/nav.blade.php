 <div class="sidebar w-100 pe-0 py-0 ">
        
        <div class="d-flex flex-column justify-content-between ms-4">
            <div class="d-flex justify-content-start align-items-center py-3 mb-3">
                <img src="{{ asset('images/logo.png') }}" class="card-img-top" alt="Logo" style="width: 50px; height: 50px;">
                <span class="fw-bold fs-4 ms-2">G4<span style="color: rgb(240, 14, 101);">FITNESS</span> </span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('members.create') ? 'active' : '' }}" href="{{ route('members.create') }}">
                        <i class="fas fa-user-plus me-2"></i>
                        Register
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('members.index') ? 'active' : '' }}" href="{{ route('members.index') }}">
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
         <div class="px-4">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button class="btn btn-sm btn-outline-danger w-100 mb-4" type="submit">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
