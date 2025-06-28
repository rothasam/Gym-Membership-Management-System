@extends('layouts.app')

@section('title', 'Members List')

@section('content')
@include('partials.header')



<div class="container my-5">
    <div class="card shadow-sm" style="background-color:rgba(255, 255, 255, 0.62);">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-dark"><i class="fas fas fa-user me-2 textPrimary"></i>Member Management</h3>
            <form method="GET" action="{{ route('members.index') }}" id="searchForm" class="d-flex align-items-center w-50 my-3" role="search">
            <input 
                type="search" 
                name="search" 
                id="searchInput"
                class="form-control rounded-pill shadow-sm border-0 px-4 py-2"
                placeholder="Search members here..."
                value="{{ request('search') }}"
                aria-label="Search members"
            />
            <button type="submit" class="btn btn-primary ms-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-search"></i>
            </button>
            </form>

        </div>

        <div class="card-body px-4 table-responsive" style="overflow-x: auto;">
    <table class="table table-hover table-bordered align-middle text-nowrap" style="min-width: 1000px;">
        <thead class="table-light text-uppercase small text-muted">
            <tr>
                <th># <i class="fas fa-sort text-muted"></i></th>
                <th>Name <i class="fas fa-sort text-muted"></i></th>
                <th>Contact <i class="fas fa-sort text-muted"></i></th>
                <th>Plan <i class="fas fa-sort text-muted"></i></th>
                <th>Status</th>
                <th>Join Date <i class="fas fa-sort text-muted"></i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                @php
                    $endDate = \Carbon\Carbon::parse($member->latestSubscription->end_date);
                    $isActive = $endDate->isFuture();
                @endphp
                <tr class="align-middle">
                    <td class="fw-semibold text-secondary">#{{ $member->member_id }}</td>
                    
                    <td class="fw-bold">{{ $member->first_name }} {{ $member->last_name }}</td>
                    
                    <td>
                        <div class="d-flex flex-column">
                            <span><i class="fas fa-phone-alt me-1 text-muted"></i> {{ $member->phone }}</span>
                            <span><i class="fas fa-envelope me-1 text-muted"></i> {{ $member->email }}</span>
                        </div>
                    </td>

                    <td>
                        <span class="fw-semibold text-primary">
                            {{ $member->latestSubscription?->membershipPlan?->name ?? 'No Subscription' }}
                        </span>
                    </td>

                    <td>
                        <span class="badge {{ $isActive ? 'bg-success' : 'bg-secondary' }}">
                            {{ $isActive ? 'Active' : 'Expired' }}
                        </span>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($member->joined_date)->format('M d, Y') }}</td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm {{ $isActive ? 'btn-outline-primary' : 'btn-outline-danger' }} upgrade-btn"
                                data-member-id="{{ $member->member_id }}"
                                data-name="{{ $member->first_name }} {{ $member->last_name }}"
                                data-is-active="{{ $isActive ? '1' : '0' }}"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="{{ $isActive ? 'fas fa-arrow-up' : 'fas fa-redo' }}"></i>
                                {{ $isActive ? 'Upgrade' : 'Renew' }}
                            </button>

                            <a href="{{ route('members.show', $member->member_id) }}" class="btn btn-sm btn-outline-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#mdlDel"
                                data-member-id="{{ $member->member_id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
  <td colspan="7" class="text-center text-danger py-4" style="background-color: #fff3f3; font-weight: 600; font-size: 1.1rem;">
    <i class="fas fa-exclamation-circle me-2"></i> No members found.
  </td>
</tr>
            @endforelse
        </tbody>
    </table>
</div>

    </div>
</div>



<div class="modal fade" id="mdlDel" tabindex="-1" aria-labelledby="mdlDelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="is_deleted" value="1">
    <div class="modal-body">
        <h5 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
        <p class="mb-4">Do you really want to delete this member?</p>
        <div class="d-flex gap-4">
            <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger w-50">Yes</button> 
        </div>
    </div>
</form>

    </div>
  </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0 shadow">
      <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
        <h5 class="modal-title fw-semibold text-primary" id="exampleModalLabel">
          <i class="fas fa-arrow-up me-2 text-danger"></i> Upgrade Member Plan
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-4 py-2">
        <form id="subscriptionForm" method="POST" action="{{ route('subscriptions.upgrade') }}">

         @auth
              <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
          @endauth

          @csrf
          <div class="row g-3">
            
            <div class="col-md-6">
              <label class="form-label">Member ID</label>
              <input type="text" name="member_id" class="form-control" id="memberIdInput" readonly>
            </div>

          
            <div class="col-md-6">
              <label class="form-label">Member Name</label>
              <input type="text" class="form-control" id="memberNameInput" readonly>
            </div>

           
            <div class="col-12">
              <label class="form-label">Membership Plan</label>
              <select class="form-select" id="planSelect" name="membership_plan_id">
                <option value="">-- Select Plan --</option>
                @foreach($plans as $plan)
                  <option value="{{ $plan->membership_plan_id }}" data-duration="{{ $plan->duration_month }}">
                    {{ $plan->name }} — ${{ $plan->price }}
                  </option>
                @endforeach
              </select>
            </div>

          
            <div class="col-md-6">
              <label class="form-label">Start Date</label>
              <input type="date" class="form-control" id="startDateInput" name="start_date">
            </div>

         
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="date" class="form-control" id="endDateInput" name="end_date" readonly>
            </div>

     
            <div class="col-12">
              <label class="form-label">Payment Method <span class="text-danger">*</span></label>
              <div class="d-flex gap-4 flex-wrap mt-1">
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                  <label class="form-check-label" for="payment_cash">
                    <i class="fas fa-money-bill-wave text-success me-1"></i> Cash
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                  <label class="form-check-label" for="payment_bank">
                    <i class="fas fa-university text-primary me-1"></i> Bank Transfer
                  </label>
                </div>
              </div>
              @error('payment_method')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

       
          <div class="modal-footer border-top-0 px-0 mt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Cancel
            </button>
            <button type="submit" id="submitButton" class="btn btn-danger px-4" disabled>
    <i class="fas fa-save me-1"></i> Update Subscription
</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('js/member-show.js') }}"></script>
<script>
//     document.addEventListener('DOMContentLoaded', function () {
//     const searchInput = document.getElementById('searchInput');
//     const searchForm = document.getElementById('searchForm');

//     let typingTimer;
//     const typingInterval = 300; 
//     searchInput.addEventListener('input', function () {
//         clearTimeout(typingTimer);
//         typingTimer = setTimeout(() => {
//             searchForm.submit();
//         }, typingInterval);
//     });
// });


    document.addEventListener("DOMContentLoaded", function () {

    // Delete modal setup
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const memberId = this.getAttribute('data-member-id');
            deleteForm.action = `/members/delete/${memberId}`;
        });
    });

    // Upgrade modal and form logic
    const planSelect = document.getElementById('planSelect');
    const startDateInput = document.getElementById('startDateInput');
    const endDateInput = document.getElementById('endDateInput');
    const submitButton = document.getElementById('submitButton');
    const memberIdInput = document.getElementById("memberIdInput");
    const memberNameInput = document.getElementById("memberNameInput");
    const modalTitle = document.getElementById("exampleModalLabel");

    function validateForm() {
        const planSelected = planSelect.value.trim() !== '';
        const endDateFilled = endDateInput.value.trim() !== '';
        submitButton.disabled = !(planSelected && endDateFilled);
    }

    function calculateEndDate() {
        const selectedOption = planSelect.options[planSelect.selectedIndex];
        const duration = selectedOption.getAttribute("data-duration");
        const startDate = startDateInput.value;

        if (duration && startDate) {
            const start = new Date(startDate);
            start.setMonth(start.getMonth() + parseInt(duration));

            const yyyy = start.getFullYear();
            const mm = String(start.getMonth() + 1).padStart(2, '0');
            const dd = String(start.getDate()).padStart(2, '0');

            endDateInput.value = `${yyyy}-${mm}-${dd}`;
        } else {
            endDateInput.value = '';
        }

        validateForm(); // <-- Call validateForm here to update button state when endDate changes programmatically
    }

    // Reset form fields and validation when modal opens with new member data
    document.querySelectorAll(".upgrade-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const memberId = this.getAttribute("data-member-id");
            const memberName = this.getAttribute("data-name");
            const isActive = this.getAttribute("data-is-active") === '1';

            // Set member info fields
            memberIdInput.value = memberId;
            memberNameInput.value = memberName;

            // Reset form fields for new entry
            planSelect.value = '';
            startDateInput.value = '';
            endDateInput.value = '';

            // Update modal title
            modalTitle.textContent = isActive ? "Upgrade Plan" : "Renew Plan";

            // Disable submit button initially
            validateForm();
        });
    });

    // Event listeners
    planSelect.addEventListener("change", function () {
        calculateEndDate();
        validateForm();
    });

    startDateInput.addEventListener("change", function () {
        calculateEndDate();
        validateForm();
    });

    // Also listen for manual input changes on endDate (if needed)
    endDateInput.addEventListener("input", validateForm);

    // Initial disable on page load
    validateForm();
});


</script>

@endsection