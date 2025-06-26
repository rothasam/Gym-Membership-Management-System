@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="min-width: 450px; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px;">
        <div class="d-flex flex-column justify-content-start align-items-center py-3 mb-3">
            <img src="{{ asset('images/logo.png') }}" class="card-img-top" alt="Logo" style="width: 70px; height: 70px;">
            <span class="fw-bold fs-4 ms-2">G4<span style="color: rgb(240, 14, 101);">FITNESS</span></span>
        </div>
        
        <h5 class="mb-4 text-center">Welcome back to G4FINESS</h5>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', 'admin@gmail.com') }}" 
                       id="email" name="email" placeholder="user@example.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                
                <div class="position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror pe-5" 
                        value="{{ old('password', 'admin@123') }}" 
                        id="password" name="password" placeholder="password">
                    
                    <span class="position-absolute top-50 translate-middle-y end-0 me-3" style="cursor: pointer;" onclick="togglePassword()">
                        <i class="fa-solid fa-eye-slash" id="togglePasswordIcon"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-center w-100 mt-4">
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </div>
        </form>
    </div>
</div>


<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
