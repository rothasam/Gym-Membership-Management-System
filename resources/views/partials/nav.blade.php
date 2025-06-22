 <div class="sidebar w-100 pe-0">
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
