@extends('layouts.app')

@section('title', 'Register Member')

@section('content')
@include('partials.header')

<!-- style="margin:50px auto; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; -->
<div class="d-flex justify-content-center mt-2">

    <div class=" card shadow-sm w-75" style="margin:50px auto; background-color:rgba(255, 255, 255, 0.62); border-radius: 10px ; position:relative;">
        <div class="card-header text-light" style="background-color: rgb(240, 14, 101);">
            <h4 class="mb-0">Register New Member</h4>
        </div>
        <div class="card-body">
                <form method="POST" action="{{ route('members.store') }}" id="frmRegister">
                @csrf
                <div class="row">
                    {{-- Column 1 --}}
                    <div class="col-md-8 pe-4" style="border-right: 2px solid #ddd;">
                        <h1 class=" text-center">Information</h1>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>First Name<span class="red">*</span></label>
                                 <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Enter first name" >
                                @error('first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <label>Last Name<span class="red">*</span></label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Enter last name">
                                @error('last_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Gender<span class="red">*</span></label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">-- Select --</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="male" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="male" {{ old('gender') == 'none' ? 'selected' : '' }}>None</option>
                                </select>
                                 @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth<span class="red">*</span></label>
                                <input name="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                @error('dob')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Phone<span class="red">*</span></label>
                                <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="e.g. 012345678">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="e.g. example@mail.com">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter address">
                            </div>
                        </div>
                    </div>

                    {{-- Column 2 --}}
                    <div class="col-md-4 ps-4">
                        <h1 class=" text-center">Plan</h1>
                        <div class="mb-3">
                            <label>Choose Plan<span class="red">*</span></label>
                            <select class="form-control @error('membership_plan_id') is-invalid @enderror" id="plan-select" name="membership_plan_id" >
                                <option value="">-- Select Plan --</option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->membership_plan_id }}" data-price="{{ $plan->price }}">{{ $plan->name . ' / $' . $plan->price }}</option>
                                @endforeach
                            </select>
                             @error('membership_plan_id')
                                    <small class="text-danger">The plan field is required</small>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label>Total Price</label>
                            <input type="text" class="form-control mb-2" id="plan-price" readonly placeholder="$0.00">
                            <input type="hidden" name="price" id="plan-price-hidden">
                            
                        </div>
                        <div class="">
                            <label>Start Date<span class="red">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"  name="start_date" >
                            @error('start_date')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label mb-2">Payment Method<span class="red">*</span></label>
                                <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_cash" value="cash" checked >
                                <label class="form-check-label" for="payment_cash">
                                    <i class="fas fa-money-bill-wave text-success me-1"></i> Cash
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} >
                                <label class="form-check-label" for="payment_bank">
                                    <i class="fas fa-university text-primary me-1"></i> Bank Payment
                                </label>
                            </div>

                            @error('payment_method')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-secondary" id="btnClearForm">
                        Clear <span><i class="fa-solid fa-arrow-rotate-right"></i></span>
                    </button>
                    <button type="submit" class="btn text-white"  style="background-color: rgb(240, 14, 101); border:none;">
                        Register
                    </button>
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




<!-- Modal choose payment method -->
 <div class="modal fade" id="regis" tabindex="-1" aria-labelledby="regisLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="regisLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_aba" value="bank_transfer">
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

                            <input type="hidden" name="payment_method" id="selected-payment-method">

                        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
         <button type="button" class="btn btn-primary" id="confirmPayment">Confirm & Register</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- <script src="{{ asset('js/member-register.js') }}"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const planSelect = document.getElementById('plan-select');
            const planPriceInput = document.getElementById('plan-price');
            const planPriceHidden = document.getElementById('plan-price-hidden');

            // Update plan price display
            planSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                planPriceInput.value = `$${price}`;
                planPriceHidden.value = price;
            });

            // Always sync selected payment method to hidden input
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('selected-payment-method').value = this.value;
                });
            });

            // Submit form when confirm button is clicked in modal
            document.getElementById('confirmPayment').addEventListener('click', function () {
                const modal = bootstrap.Modal.getInstance(document.getElementById('regis'));
                modal.hide();
                document.getElementById('frmRegister').submit();
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('frmRegister');
            const planSelect = document.getElementById('plan-select');
            const planPriceInput = document.getElementById('plan-price');
            const planPriceHidden = document.getElementById('plan-price-hidden');
            const selectedPaymentInput = document.getElementById('selected-payment-method');

            // Update displayed plan price on plan select change
            planSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                planPriceInput.value = price ? `$${price}` : '';
                planPriceHidden.value = price || '';
            });

            // Sync selected radio payment method to hidden input
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    selectedPaymentInput.value = this.value;
                });
            });

            // Submit form when Confirm button in modal is clicked
            document.getElementById('confirmPayment').addEventListener('click', function () {
                const modal = bootstrap.Modal.getInstance(document.getElementById('regis'));
                modal.hide();
                form.submit();
            });

            // Clear form fields when Clear button is clicked
            document.getElementById('btnClearForm').addEventListener('click', function () {
                form.reset(); // Reset all form inputs

                // Clear dynamic fields manually
                planPriceInput.value = '';
                planPriceHidden.value = '';
                selectedPaymentInput.value = '';

                // Optional: remove validation error messages
                const errorTexts = form.querySelectorAll('.text-danger');
                errorTexts.forEach(el => el.innerText = '');

                // Optional: remove is-invalid class from all fields
                const invalidFields = form.querySelectorAll('.is-invalid');
                invalidFields.forEach(el => el.classList.remove('is-invalid'));
            });
        });
    </script>

@endsection