@extends('layouts.app')

@section('title', 'Class Edit')
@include('partials.header')
@section('content')
@include('partials.nav')

<div class="container my-5">
    <div class="card shadow-sm w-50 mx-auto" style="background-color:rgba(255, 255, 255, 0.62);">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h5 class="mb-0">Update Class</h5>
        </div>
        <div class="card-body">
            <form>
                {{-- Class Name --}}
                <div class="mb-3">
                    <label for="className" class="form-label">Class Name</label>
                    <input type="text" class="form-control" id="className" placeholder="Enter class name">
                </div>

                {{-- Max Members --}}
                <div class="mb-3">
                    <label for="maxMembers" class="form-label">Maximum Members</label>
                    <input type="number" class="form-control" id="maxMembers" placeholder="Enter max number of members">
                </div>

                {{-- Start and End Time --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="startTime" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="startTime">
                    </div>
                    <div class="col-md-6">
                        <label for="endTime" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="endTime">
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="Enter class description (optional)"></textarea>
                </div>

                {{-- Submit --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4" style="background-color: rgb(240, 14, 101); border:none;;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection