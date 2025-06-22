@extends('layouts.app')

@section('title', 'show Classes')

@section('content')
@include('partials.header')
@include('partials.nav')

<div class="container" style="background-color:rgba(255, 255, 255, 0.62);margin:80px auto; padding:80px;border-radius:10px;">
    <h3 class="mb-4">Registered Classes</h3>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Sample class card (repeat this block for each class) --}}
        <div class="col" style="border-radius: 20px;">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="card-footer d-flex justify-content-between">
                        <span style="font-size:25px;">#1</span><br>
                        <a class="btn btn-sm btn-outline-primary {{ request()->routeIs('classes.edit') ? 'active' : '' }}" href="{{ route('classes.edit') }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this class?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <span class="card-text">

                        <h1 class="card-title" style="color:rgb(240, 14, 101);">Yoga 01</h1>
                        <span><i class="fas fa-user me-1 text-muted"></i>Alice Chan</span> <br>
                        <span><i class="fas fa-clock me-1 text-muted"></i>08:00 AM <i class="fas fa-arrow-right"></i>10:00 AM</span><br>
                        <span style="font-weight: bold;font-size:20px;">Beginner</span>
                    </span>
                </div>

            </div>
        </div>

        {{-- Add New Class Card --}}
        <div class="col " style="border-radius: 20px;">
            <a class="text-decoration-none {{ request()->routeIs('classes.add') ? 'active' : '' }}" href="{{ route('classes.add') }}">
                <div class="card h-100 d-flex justify-content-center align-items-center border-dashed" style="border: 2px dashed #6c757d;">
                    <div class="card-body text-center">
                        <h3 style="color:rgb(240, 14, 101);">Add Class</h3>
                        <i class="fas fa-plus-circle fa-2x text-secondary mb-2 text-dark" style="font-size:80px;"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection