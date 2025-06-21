@extends('layouts.app')

@section('title', 'Create Membership Plan')

@section('content')
@include('layouts.header')
@include('partials.nav')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.62);;">
                <div class="card-header text-white" style="background-color: rgb(240, 14, 101);;">
                    <h5 class="mb-0">Create Membership Plan</h5>
                </div>
                <div class="card-body">
                    <form>
                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Plan Name</label>
                            <input type="text" class="form-control" placeholder="Enter plan name">
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" class="form-control" placeholder="Enter price">
                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">
                            <label class="form-label">Duration (in months)</label>
                            <input type="number" class="form-control" placeholder="e.g. 1, 3, 6">
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>

                        {{-- Total Classes --}}
                        <div class="mb-3">
                            <label class="form-label">Total Classes</label>
                            <input type="number" class="form-control" placeholder="e.g. 20">
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center ">
                            <button type="submit" class="btn btn-success px-4" style="background-color: rgb(240, 14, 101);border:none;">Save Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection