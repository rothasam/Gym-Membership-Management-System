<div class="d-flex justify-between align-items-center py-2 px-4 bg-white">
    <h3>Gym Membership Management System</h3>
    <div>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    
        <button class="d-flex fs-4 justify-content-center align-items-center gap-2" type="button" data-bs-toggle="offcanvas" 
        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <span class="fw-medium">Admin</span> <i class="fa-solid fa-circle-user pt-1" style="font-size: 20px;"></i>
        </button>
        
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">
                        <span class="fw-medium">Admin</span> <i class="fa-solid fa-circle-user pt-1" style="font-size: 20px;"></i>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    ...
                    <button class="btn btn-sm btn-outline-danger" type="submit">Logout</button>
                </div>
            </div>
        </div>

    </form>
</div>