@extends('layouts.app')

@section('title', 'Register Member')



@section('content')
@include('partials.header')

<!-- style="margin:50px auto; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; -->
<div class="d-flex justify-content-center mt-4">

    <div class=" card shadow-sm w-75" style="margin:50px auto; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; position:relative;">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h4 class="mb-0">Register New Member</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    {{-- Column 1 --}}
                    <div class="col-md-8">
                        <h1 class=" text-center">Information</h1>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter last name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Gender</label>
                                <select class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="e.g. 012345678">
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="e.g. example@mail.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Enter address">
                            </div>
                            <div class="col-md-6">
                                <label>Join Date</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Column 2 --}}
                    <div class="col-md-4">
                        <h1 class=" text-center">Plan</h1>
                        <div class="mb-3">
                            <label>Choose Plan</label>
                            <select class="form-control" id="plan-select">
                                <option value="">-- Select Plan --</option>
                                <option data-price="150" value="1">Basic Plan 150$/month</option>
                                <option data-price="250" value="2">Standard Plan 250$/month</option>
                                <option data-price="500" value="3">Premium Plan 500$/month</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="text" class="form-control" id="plan-price" readonly placeholder="$0.00">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-2">Payment Method</label>

                            <div class="form-check d-flex mb-4 align-items-center justify-content-evenly w-75" style="background-color: #ffffff;padding-right:80px;border-radius:10px;">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                                <label class="form-check-label" for="payment_cash">
                                    <span style="padding:10px;display:inline-block;margin:2px;">Cash</span>
                                    <i class=" fas fa-money-bill-wave me-2 text-success" style="font-size: 25px;"></i>
                                </label>
                            </div>

                            <div class="form-check d-flex align-items-center justify-content-evenly w-75" style="background-color: #ffffff;margin:2px 0;border-radius:10px;">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_aba" value="aba_pay">
                                <label class="form-check-label d-flex align-items-center" for="payment_aba" style="font-weight: bold;">
                                    <span style="padding:10px;display:inline-block;margin:2px;">
                                        ABA
                                        <span style="font-size: small;">
                                            ABA'
                                            <span style="font-weight: bold;">
                                                Pay
                                                <span style="color:#5F5AF0;">way</span>
                                            </span>
                                            <i class="fas fa-university me-2 text-primary " style="font-size: 25px;"></i>
                                        </span>
                                    </span>
                                </label>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4" style="background-color: rgb(240, 14, 101); border:none;">Register</button>
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
            <p class="card-text p-3 text-center">Congradulation, your account has been sucsessfully Created</p>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-success px-3">Continue</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/member-register.js') }}"></script>
@endsection