@extends('layouts.app')

@section('title', 'Show Classes')

@section('content')
@include('partials.header')

<div class="container" style="background-color:rgba(255, 255, 255, 0.62);margin:80px auto; padding:80px;border-radius:10px; ">
    <h3 class="mb-4">Registered Classes</h3>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($classes as $index => $class)
        <div class="col" style="border-radius: 20px;">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="card-footer d-flex justify-content-between">
                        <span style="font-size:25px;">#{{ $index + 1 }}</span><br>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('classes.edit', $class) }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('classes.destroy', $class) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this class?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <span class="card-text">
                        <h1 class="card-title" style="color:rgb(240, 14, 101);">{{ $class->class_name }}</h1>
                        <span><i class="fas fa-clock me-1 text-muted"></i>
                            {{ date('h:i A', strtotime($class->start_time)) }} 
                            <i class="fas fa-arrow-right"></i>
                            {{ date('h:i A', strtotime($class->end_time)) }}
                        </span><br>
                        <span><i class="fas fa-users me-1 text-muted"></i>Max: {{ $class->total_member }}</span><br>
                        <p class="mt-2">{{ $class->description }}</p>
                    </span>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Add New Class Card --}}
        <div class="col" style="border-radius: 20px;">
            <a class="text-decoration-none" href="{{ route('classes.add') }}">
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