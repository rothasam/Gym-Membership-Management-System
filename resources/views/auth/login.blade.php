@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class=" card shadow p-4" style="min-width: 450px; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; border: 1px solid rgba(13, 112, 143, 0.49);">
        <h3 class="mb-3 text-black">Login</h3>
        <p class="mb-4">Welcome to C4FINESS</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>

            <div class="d-flex justify-content-center w-100">
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection