@extends('layouts.app')

@section('title', 'Show Classes')

@section('content')
@include('partials.header')

<div class="container py-3 px-4 my-5 rounded-2" style=" background-color:rgba(255, 255, 255, 0.62);">
    <h3 class="mb-4 fw-medium text-dark">
        <i class="fas fa-book-open me-2 " style="color: rgb(240, 14, 101);"></i> Class Management
    </h3>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($classes as $index => $class)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-4 position-relative">
                <div class="card-body p-4">
                    <h4 class="card-title textPrimary mb-3 fw-semibold">
                        <i class="fas fa-chalkboard-teacher me-2 text-muted"></i>{{ $class->class_name }}
                    </h4>
                    <p class="mb-2 text-muted">
                        <i class="fas fa-clock me-1"></i>
                        {{ date('h:i A', strtotime($class->start_time)) }}
                        <i class="fas fa-arrow-right mx-1"></i>
                        {{ date('h:i A', strtotime($class->end_time)) }}
                    </p>
                    <p class="mb-2 text-muted">
                        <i class="fas fa-users me-1"></i> Max: {{ $class->total_member }}
                    </p>
                    <p class="text-secondary small">{{ $class->description }}</p>
                </div>
                <div class="card-footer bg-transparent border-0 px-4 pb-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Delete this class?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Add New Class Card --}}
        <div class="col">
            <a href="{{ route('classes.add') }}" class="text-decoration-none">
                <div class="card h-100 d-flex justify-content-center align-items-center shadow-sm border-dashed rounded-4" style="border: 2px dashed #ced4da; transition: 0.3s;">
                    <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-plus-circle text-primary mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-dark">Add New Class</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection