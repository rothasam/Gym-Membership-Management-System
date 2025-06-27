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
        @if ($errors->has('auth'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ $errors->first('auth') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
       <form method="POST" action="{{ route('login') }}" class="p-4 border rounded shadow-sm bg-white" style="max-width: 400px; margin: auto;">
            @csrf


            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                    {{-- @error('email') is-invalid @enderror --}}
                    <input
                        type="email"
                        class="form-control "
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="{{ old('email', 'admin@gmail.com') }}"
                        required
                    >
                </div>
                {{-- 
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror 
                --}}
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        id="password"
                        placeholder="Password"
                        value="admin@123"
                        required
                    >
                    <button class="btn btn-outline-secondary" \ type="button" onclick="togglePassword()" tabindex="-1">
                        <i class="fas fa-eye-slash" id="togglePasswordIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </button>
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
