@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('partials.header')

<div class="container my-5 p-5" style="background-color: rgba(255, 255, 255, 0.62);border-radius:10px;">
    <h4 class="mb-4">Gym Membership Dashboard</h4>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Total Members --}}
        <div class="col">
            <div class="card shadow-sm border-left-primary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Total Members</h6>
                        <h4 class="mb-0">{{ $t_member }}</h4> {{-- Replace with dynamic data --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Classes --}}
        <div class="col">
            <div class="card shadow-sm border-left-info h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-dumbbell fa-2x text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Classes</h6>
                        <h4 class="mb-0">{{ $t_class }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Active Members --}}
        <div class="col">
            <div class="card shadow-sm border-left-success h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-user-check fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Active Members</h6>
                        <h4 class="mb-0">210</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Staff --}}
        <div class="col">
            <div class="card shadow-sm border-left-warning h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-user-tie fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Staff</h6>
                        <h4 class="mb-0">{{ $t_staff }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="col">
            <div class="card shadow-sm border-left-danger h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Total Revenue</h6>
                        <h4 class="mb-0">${{ $t_revenue }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Attendance --}}
        <div class="col">
            <div class="card shadow-sm border-left-secondary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-check fa-2x text-secondary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Present Attendance </h6>
                        <h4 class="mb-0">89</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection