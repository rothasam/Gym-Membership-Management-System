@extends('layouts.app')

@section('title', 'Add Class')
@section('content')
@include('partials.header')

<div class="container my-5">
    <div class="card shadow-sm w-50 mx-auto" style="background-color:rgba(255, 255, 255, 0.62);">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h5 class="mb-0">Add Class</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf
                {{-- Class Name --}}
                <div class="mb-3">
                    <label for="class_name" class="form-label">Class Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="class_name" name="class_name" required>
                </div>

                {{-- Max Members --}}
                <div class="mb-3">
                    <label for="total_member" class="form-label">Maximum Members</label>
                    <input type="number" class="form-control" id="total_member" name="total_member">
                </div>

                {{-- Start and End Time --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                         <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time">
                    </div>
                    <div class="col-md-6">
                         <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time">
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                {{-- Submit --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn px-4 text-light" style="background-color: rgb(240, 14, 101); border:none;">
                        <i class="fas fa-plus-circle me-1"></i> Add Class
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection