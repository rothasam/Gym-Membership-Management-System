@extends('layouts.app')

@section('title', 'Register Member')

@section('content')
@include('partials.header')

<div class="d-flex justify-content-center mt-2">

   <div class="container py-5">
    <div class="card shadow border-0 mx-auto" style="max-width: 1100px; background-color:rgba(255, 255, 255, 0.62); border-radius: 12px;">
        <div class="card-header  text-white rounded-top" style="background-color: rgb(240, 14, 101);">
            <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i> Register New Member</h4>
        </div>

        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('members.store') }}" id="frmRegister">
                @auth
                    <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                @endauth
                @csrf
                <div class="row g-4">

                    {{-- Column 1: Member Info --}}
                    <div class="col-md-8 border-end">
                        <h5 class="text-primary mb-4"><i class="fas fa-info-circle me-2"></i> Member Information</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name <span class="red">*</span></label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name">
                                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name <span class="red">*</span></label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name">
                                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Gender <span class="red">*</span></label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">-- Select Gender --</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="none" {{ old('gender') == 'none' ? 'selected' : '' }}>None</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date of Birth <span class="red">*</span></label>
                                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone <span class="red">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="e.g. 012345678">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="red">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="e.g. example@mail.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Street, City, etc.">
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Plan --}}
                    <div class="col-md-4">
                        <h5 class="text-primary mb-4"><i class="fas fa-dumbbell me-2"></i> Membership Plan</h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Choose Plan <span class="red">*</span></label>
                            <select class="form-select @error('membership_plan_id') is-invalid @enderror" name="membership_plan_id" id="plan-select">
                                <option value="">-- Select Plan --</option>
                                @foreach($plans as $plan)
                                    <option 
                                        value="{{ $plan->membership_plan_id }}" 
                                        data-price="{{ $plan->price }}" 
                                        data-duration="{{ $plan->duration_month }}">
                                        {{ $plan->name . ' / $' . $plan->price }}
                                    </option>
                                @endforeach

                            </select>
                            @error('membership_plan_id') <div class="invalid-feedback">Please select a plan.</div> @enderror
                        </div>

                        <div class="mb-3">
                          
                            {{-- <label class="form-label fw-semibold">Total Price</label> --}}
                            <input type="hidden" id="plan-price" class="form-control" readonly placeholder="$0.00">
                          
                            <input type="hidden" name="price" id="plan-price-hidden">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Start Date <span class="red">*</span></label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" readonly placeholder="Auto calculated">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold mb-2">Payment Method <span class="red">*</span></label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                                <label class="form-check-label" for="payment_cash">
                                    <i class="fas fa-money-bill text-success me-1"></i> Cash
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_bank">
                                    <i class="fas fa-university text-primary me-1"></i> Bank Transfer
                                </label>
                            </div>
                            @error('payment_method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="button" class="btn btn-outline-secondary" id="btnClearForm">
                        <i class="fas fa-redo me-1"></i> Clear
                    </button>
                    <button type="submit" class="btn text-white" style="background-color: rgb(240, 14, 101);">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </button>
                </div>
            </form>
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

        document.addEventListener("DOMContentLoaded", function () {
            const planSelect = document.getElementById('plan-select');
            const startDate = document.querySelector('[name="start_date"]');
            const endDate = document.getElementById('end_date');

            function calculateEndDate() {
                const selectedOption = planSelect.options[planSelect.selectedIndex];
                const duration = selectedOption?.getAttribute("data-duration"); // Make sure duration is set in option
                const start = startDate.value;

                if (start && duration) {
                    const date = new Date(start);
                    date.setMonth(date.getMonth() + parseInt(duration));

                    const yyyy = date.getFullYear();
                    const mm = String(date.getMonth() + 1).padStart(2, '0');
                    const dd = String(date.getDate()).padStart(2, '0');

                    endDate.value = `${yyyy}-${mm}-${dd}`;
                } else {
                    endDate.value = '';
                }
            }

            planSelect.addEventListener("change", calculateEndDate);
            startDate.addEventListener("change", calculateEndDate);
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