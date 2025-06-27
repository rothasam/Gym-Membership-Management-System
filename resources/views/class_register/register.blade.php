@extends('layouts.app')

@section('title', 'Class Register')

@section('content')
@include('partials.header')

<div class="container py-4" >
    <div class="card shadow-sm" style="background-color:rgba(255, 255, 255, 0.62);">
        <div class="card-header bgPrimary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Class Register</h4>
        </div>

        <div class="card-body" >
            <form method="POST" action="{{ route('class_register.store') }}">
                @csrf

                <!-- Select Member -->
                <div class="mb-4">
                    <label for="member_id" class="form-label fw-semibold">Select Member <span class="red">*</span></label>
                    <select name="member_id" id="member_id" class="form-select" required>
                        <option disabled selected>-- Select Active Member --</option>
                        @foreach ($members as $member)
                            <option 
                                value="{{ $member->member_id }}" 
                                data-name="{{ $member->first_name }} {{ $member->last_name }}"
                                data-plan="{{ $member->plan_name }}" 
                                data-limit="{{ $member->latestSubscription->membershipPlan->total_class ?? 0 }}" 
                                data-used="{{ $member->latestSubscription->used ?? 0 }}"
                            >
                                {{'#' . $member->member_id }} {{ $member->first_name }} {{ $member->last_name }} ({{ $member->plan_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Member Info Summary -->
                <div id="memberInfo" class="mb-4 d-none">
                    <div class="card bg-light p-3 shadow-sm">
                        <p><strong>Name:</strong> <span id="memberName"></span></p>
                        <p><strong>Plan:</strong> <span id="memberPlan"></span></p>
                        <p><strong>Allowed Classes:</strong> <span id="memberLimit"></span></p>
                        <!-- <p><strong>Registered:</strong> <span id="memberUsed"></span></p> -->
                        <!-- <p><strong>Remaining:</strong> <span id="memberRemaining"></span></p> -->
                    </div>
                </div>
                
                <!-- Class List -->
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
    @foreach ($classes as $class)
        @php
            $registered = \App\Models\ClassRegisteration::where('gym_class_id', $class->gym_class_id)
                ->where('is_deleted', false)
                ->count();
            $isFull = $registered >= $class->total_member;
        @endphp

        <div class="col">
            <div class="card h-100 shadow-sm {{ $isFull ? 'border-danger bg-light' : '' }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title textPrimary mb-0">{{ $class->class_name }}</h5>
                        <span class="badge {{ $isFull ? 'bg-danger' : 'bg-success' }}">
                            <i class="fas fa-users me-1"></i> {{ $registered }}/{{ $class->total_member }}
                        </span>
                    </div>

                    <p class="text-muted small">{{ $class->description }}</p>
                    <p class="mb-2"><i class="fas fa-clock me-1"></i><strong>{{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}</strong></p>

                    <div class="form-check form-switch">
                        <input 
                            class="form-check-input class-checkbox" 
                            type="checkbox" 
                            name="class_ids[]" 
                            value="{{ $class->gym_class_id }}" 
                            id="gym_class_{{ $class->gym_class_id }}"
                            data-full="{{ $isFull ? '1' : '0' }}"
                            {{ $isFull ? 'disabled' : '' }}
                        >
                        <label class="form-check-label {{ $isFull ? 'text-danger fw-bold' : '' }}" for="gym_class_{{ $class->gym_class_id }}">
                            {{ $isFull ? 'Class Full' : 'Join Class' }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" id="registerBtn" class="btn btn-danger bgPrimary px-4" disabled>
                        <i class="fas fa-paper-plane me-1"></i> Register Classes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const memberSelect = document.getElementById("member_id");
    const infoBox = document.getElementById("memberInfo");

    const memberName = document.getElementById("memberName");
    const memberPlan = document.getElementById("memberPlan");
    const memberLimit = document.getElementById("memberLimit");
    // const memberUsed = document.getElementById("memberUsed");
    // const memberRemaining = document.getElementById("memberRemaining"); 


    const classCheckboxes = document.querySelectorAll(".class-checkbox");
    const registerBtn = document.getElementById("registerBtn");

    let remaining = 0;

    memberSelect.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];

        const name = selectedOption.dataset.name;
        const plan = selectedOption.dataset.plan;
        const limit = parseInt(selectedOption.dataset.limit) || 0;
        const used = parseInt(selectedOption.dataset.used) || 0;

       remaining = limit - used;
        // memberRemaining.textContent = remaining; 

        memberName.textContent = name;
        memberPlan.textContent = plan;
        memberLimit.textContent = limit;
        // memberUsed.textContent = used;

        infoBox.classList.remove("d-none");

        // Enable register button when member selected
        registerBtn.disabled = false;

        // Reset class checkboxes
        classCheckboxes.forEach(cb => {
            const isFull = cb.dataset.full === "1";
            cb.checked = false;
            cb.disabled = remaining <= 0 || isFull;
        });

        updateCheckboxState();
    });

    function updateCheckboxState() {
        const selectedCount = document.querySelectorAll(".class-checkbox:checked").length;

        classCheckboxes.forEach(cb => {
            const isFull = cb.dataset.full === "1";
            if (!cb.checked) {
                cb.disabled = selectedCount >= remaining || isFull;
            }
        });
    }

    classCheckboxes.forEach(cb => {
        cb.addEventListener("change", updateCheckboxState);
    });
});
</script>
@endsection
