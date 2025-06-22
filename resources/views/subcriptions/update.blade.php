@extends('layouts.app')

@section('title', 'Update Subcription')

@section('content')
@include('partials.header')

<div class="container my-5">
    <div class="card shadow-sm w-50 mx-auto" style="border-radius: 10px;background-color:rgba(255, 255, 255, 0.62);position:relative;">
        <div class="card-header text-white" style="background-color:rgb(240, 14, 101);">
            <h4 class="mb-0">Update Subscription</h4>
        </div>
        <div class="card-body">
            <form>
                <!-- Member ID -->
                <div class="mb-3">
                    <label class="form-label">Member ID</label>
                    <!-- You can use input readonly or select dropdown -->
                    <!-- Readonly input: -->
                    <input type="text" class="form-control" value="M001" readonly>

                    <!-- Or use dropdown if choosing from list -->
                    <!--
                    <select class="form-select">
                        <option value="">-- Select Member --</option>
                        <option value="1">M001 - John Doe</option>
                        <option value="2">M002 - Jane Smith</option>
                    </select>
                    -->
                </div>

                <!-- Plan -->
                <div class="mb-3">
                    <label class="form-label">Plan</label>
                    <select class="form-select">
                        <option value="">-- Select Plan --</option>
                        <option value="basic">Basic ($150)</option>
                        <option value="standard">Standard ($250)</option>
                        <option value="premium">Premium ($500)</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control">
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" class="form-control">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label d-block mb-2">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="expired" value="expired">
                        <label class="form-check-label" for="expired">Expired</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success" style="background-color:rgb(240, 14, 101); border:none;">Update Subscription</button>
                </div>
            </form>
        </div>
    </div>
    <<!-- Success Message Card (Hidden Initially) -->
<div id="successCard" class="card shadow-sm w-25 mx-auto h-50 d-none"
     style="background-color:#ffffff; position:fixed; top:20%; left:0; right:0; z-index:1051;">
    <div class="card-body">
        <div class="card-header h-25 d-flex flex-column justify-content-center align-items-center p-4"
             style="background-color: rgb(235, 30, 108);">
            <div>
                <i class="fas fa-check-circle text-center text-light" style="font-size: 70px;"></i>
            </div>
            <h4 class="card-title text-success mb-2 text-light">Success</h4>
        </div>
        <p class="card-text p-3 text-center">
            Congratulations, your account has been successfully updated.
        </p>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-success px-3" id="btnContinue">Continue</button>
        </div>
    </div>
</div>

<!-- Backdrop -->
<div id="deleteBackdrop"
     class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"
     style="z-index: 1050;">
</div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/subcription-update.js') }}"></script>
@endsection