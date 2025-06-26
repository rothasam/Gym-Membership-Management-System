@extends('layouts.app')

@section('title', 'Create Membership Plan')

@section('content')
@include('partials.header')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.62);;">
                <div class="card-header text-white" style="background-color: rgb(240, 14, 101);;">
                    <h5 class="mb-0">Create Membership Plan</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('plans.store') }}">
                        @csrf
                        
                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Plan Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter plan name" required>
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" required>
                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">
                            <label for="duration_month" class="form-label">Duration (in months)</label>
                            <input type="number" class="form-control" id="duration_month" name="duration_month" placeholder="e.g. 1, 3, 6" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                        </div>

                        {{-- Total Classes --}}
                        <div class="mb-3">
                            <label for="total_class" class="form-label">Total Classes</label>
                            <input type="number" class="form-control" id="total_class" name="total_class" placeholder="e.g. 20">
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4" style="background-color: rgb(240, 14, 101);border:none;">Save Plan</button>
                            <a href="{{ route('plans.index') }}" class="btn btn-secondary px-4">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection