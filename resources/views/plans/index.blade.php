@extends('layouts.app')

@section('title', 'Membership Plans')

@section('content')
@include('partials.header')

<div class="container my-5">
     <div class="card shadow-sm p-4 mx-auto" style="background-color:rgba(255, 255, 255, 0.62);">
  
          <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-id-card me-2 textPrimary"></i>Membership Plans</h2>
        <a href="{{ route('plans.create') }}" class="btn btn-primary" style="background-color: rgb(240, 14, 101); border: none;">
            <i class="fas fa-plus"></i> Create New Plan
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($plans as $plan)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title" style="color: rgb(240, 14, 101);">{{ $plan->name }}</h3>
                    <p class="card-text">{{ $plan->description }}</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>Price:</strong> ${{ number_format($plan->price, 2) }}</li>
                        <li class="list-group-item"><strong>Duration:</strong> {{ $plan->duration_month }} months</li>
                        @if($plan->total_class)
                        <li class="list-group-item"><strong>Total Classes:</strong> {{ $plan->total_class }}</li>
                        @endif
                    </ul>
                </div>
                <div class="card-footer bg-white d-flex justify-content-end">
                    <a href="{{ route('plans.edit', $plan->membership_plan_id) }}" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('plans.destroy', $plan->membership_plan_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this plan?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
   
</div>
@endsection