@auth
<div class="d-flex justify-content-between align-items-center px-4 bg-white" style="height: 80px; box-shadow: 0 4px 6px -6px #222; position: sticky; top: 0; z-index: 1000;">
    <h3 class="mb-0">Gym Membership Management System</h3>
    <div>
   
    
        <button class="admin-btn gap-2" type="button" data-bs-toggle="offcanvas" 
        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
           <span>
             <i class="fa-solid fa-circle-user" ></i>
           </span>
            <div class="d-flex flex-column align-items-start me-2">
                <span style="margin-bottom: -6px;" class="fw-bold">
                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                </span>
                <span class="text-secondary" style="font-size: 14px;">{{ auth()->user()->email }}</span> 
            </div>
        </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header d-flex justify-content-between">
                   
                    <div class="gap-2 d-flex justify-content-between align-items-center">
                          <span style="font-size: 38px;">
                            <i class="fa-solid fa-circle-user" ></i>
                        </span>
                    
                        <div class="d-flex flex-column align-items-start me-2">
                            <span style="margin-bottom: -3px;" class="fw-bold">
                            <span style="color: rgb(240, 14, 101);" >Hello!! </span> {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                            </span>
                            <span class="text-secondary" style="font-size: 14px;">{{ auth()->user()->email }}</span> 
                        </div>
                      
                    </div>
                     <div>
                        <button type="button" class="btn-close w-auto me-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('admin.update.profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="offcanvas-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" class="form-control">
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" class="form-control">
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="none" {{ auth()->user()->gender == 'none' ? 'selected' : '' }}>Prefer not to say</option>
                                        <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <!-- <div class="col-6 mb-3">
                                    <label>New Password <small>(optional)</small></label>
                                    <input type="password" name="password" class="form-control">
                                </div> -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success w-100">Save</button>
                                </div>
                            </div>

                            
                        </div>
                    </form>

                </div>
            </div>
        </div>

   
</div>
@endauth