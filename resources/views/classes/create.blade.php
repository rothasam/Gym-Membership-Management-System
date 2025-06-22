@extends('layouts.app')

@section('title', 'Class Register')
@include('partials.header')
@section('content')
@include('partials.nav')

<div class="d-flex justify-content-center mt-5">
    <div class="card shadow w-25 mt-5" style="border-radius: 10px;background-color: rgba(255, 255, 255, 0.62);">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h5 class="mb-0 text-center ">Register Class</h5>
        </div>
        <div class="card-body">
            <form>
                {{-- Member ID --}}
                <div class="mb-3">
                    <label for="member_id" class="form-label">Member ID</label>
                    <input type="text" class="form-control" id="member_id" placeholder="Enter Member ID">
                </div>

                {{-- Class ID --}}
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class ID</label>
                    <input type="text" class="form-control" id="class_id" placeholder="Enter Class ID">
                </div>

                {{-- Register Date --}}
                <div class="mb-3">
                    <label for="register_date" class="form-label">Register Date</label>
                    <input type="date" class="form-control" id="register_date" value="{{ date('Y-m-d') }}">
                </div>

                {{-- Register Button --}}
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn px-4 text-light" style="background-color: rgb(240, 14, 101); border:none;">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection