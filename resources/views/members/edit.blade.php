@extends('layouts.app')

@section('title', 'Member Edit')

@section('content')
@include('partials.header')

<div class="d-flex justify-content-center mt-4">

    <div class=" card shadow-sm" style="margin:50px auto; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; position:relative;">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h4 class="mb-0">Update</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('members.update', $member) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Information</h1>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $member->first_name }}">
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $member->last_name }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $member->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ $member->dob }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $member->phone }}">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $member->email }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $member->address }}">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success px-4" style="background-color: rgb(240, 14, 101); border:none;">Update</button>
    </div>
</form>

        </div>
    </div>
    <!-- Backdrop -->
<div id="deleteBackdrop"
     class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"
     style="z-index: 1040;">
</div>
    <!-- Success Message Card (Hidden Initially) -->
    <div id="successCard" class="card shadow-sm w-25 mx-auto h-50 d-none" style="background-color:#ffffff;position:absolute; z-index:1041;">
        <div class="card-body">
            <div class="card-header h-25 d-flex flex-column justify-content-center align-items-center p-4" style="background-color: rgb(235, 30, 108);">
                <div><i class="fas fa-check-circle text-center text-light" style="font-size: 70px;"></i></div>
                <h4 class="card-title text-success mb-2 text-light">Success</h4>
            </div>
            <p class="card-text p-3 text-center">Congradulation, your account has been sucsessfully Updated</p>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-success px-3">Continue</button>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/member-edit.js') }}"></script>
@endsection