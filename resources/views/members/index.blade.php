@extends('layouts.app')

@section('title', 'Members List')

@section('content')
@include('partials.header')



<div class="container my-5">
    <div class="card shadow-sm" style="background-color:rgba(255, 255, 255, 0.62);">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-dark">Members</h3>
            <input type="text" class="form-control w-25" placeholder="Search...">
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th># <i class="fas fa-sort"></i></th>
                        <th>Name <i class="fas fa-sort"></i></th>
                        <th>Contact <i class="fas fa-sort"></i></th>
                        <th>Plan <i class="fas fa-sort"></i></th>
                        <th>Status <i class="fas fa-sort"></i></th>
                        <th>Join Date <i class="fas fa-sort"></i></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                    <!-- class="click-row" data-href="{{ route('members.show', $member->member_id) }}" -->
                        <tr class="align-middle">
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->first_name . " ". $member->last_name }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span>{{ $member->phone}}</span>
                                    <span>{{ $member->email }}</span>
                                </div>
                            </td>
                            <!-- <td>Plan Name</td>
                            <td><span class="badge bg-success">Active</span></td> -->
                            <td>
                                {{ $member->latestSubscription?->membershipPlan?->name ?? 'No Subscription' }}
                            </td>
                            <td>
                                @php
                                    $status = $member->latestSubscription?->status ?? null;
                                @endphp

                                @if ($status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif ($status === 'expired')
                                    <span class="badge bg-secondary">Expired</span>
                                @elseif ($status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-warning text-dark">No Plan</span>
                                @endif
                            </td>

                            <td>{{ $member->joined_date }}</td>
                            <td class="text-center">
                                <!-- <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-arrow-up"></i> Upgrade Plan
                                </button> -->
                                <button type="button" class="btn btn-primary btn-sm me-3 upgrade-btn" 
                                    data-member-id="{{ $member->member_id }}" 
                                    data-name="{{ $member->first_name }} {{ $member->last_name }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal">
                                    <i class="fas fa-arrow-up"></i> Upgrade Plan
                                </button>
                                <a class="text-info me-2 " href="{{ route('members.show',$member->member_id) }}" title="Preview"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('members.edit', $member) }}" class="text-warning me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                <!-- <a href="javascript:void(0);" title="Delete" onclick="showConfirm(this)" data-member-id="{{ $member->member_id }}"  class="text-danger"><i class="fas fa-trash-alt"></i></a> -->
                                <!-- <button type="button" class="text-danger" data-bs-toggle="modal" data-bs-target="#mdlDel" data-member-id="{{ $member->member_id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button> -->
                                <button type="button" class="text-danger delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#mdlDel"
                                        data-member-id="{{ $member->member_id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="mdlDel" tabindex="-1" aria-labelledby="mdlDelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <form id="deleteForm"  method="Post" {{ route('members.destroy',$member) }}>
        @csrf

        <input type="hidden" value="1" name="is_deleted">
        <div class="modal-body">
          <h5 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
          <p class="mb-4">Do you really want to delete this member?</p>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit"  class="btn btn-primary">Yes</button>
        </div>
      </form> -->
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




<!-- modal upgrade plan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upgrade Plan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <div class="card-body">
            <form id="subscriptionForm" method="POST" action="{{ route('subscriptions.upgrade') }}">
                @csrf
                <div class="row">
                    
                    <!-- Member ID -->
                    <div class="mb-3 col-6">
                        <label class="form-label">Member ID</label>
                        <input type="text" name="member_id" class="form-control" id="memberIdInput" readonly>
                    </div>
                    <!-- Member Name -->
                    <div class="mb-3 col-6">
                        <label class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="memberNameInput" readonly>
                    </div>

                    <!-- Plan -->
                    <div class="mb-3 col-12">
                        <label class="form-label">Plan</label>
                        <select class="form-select" id="planSelect" name="membership_plan_id">
                            <option value="">-- Select Plan --</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->membership_plan_id }}" data-duration="{{ $plan->duration_month }}">{{ $plan->name . ' / $' . $plan->price}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Start Date -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDateInput" name="start_date">
                        </div>

                        <!-- End Date -->
                        <div class="mb-3 col-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDateInput" readonly name="end_date">
                        </div>
                    <div class="col-12">
                            <label class="form-label mb-2">Payment Method<span class="text-danger">*</span></label>
                                <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
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

               <div class="modal-footer">
            <div class="text-end">
                <button type="submit" class="btn btn-success" style="background-color:rgb(240, 14, 101); border:none;">Update Subscription</button>
            </div>
      </div>
            </form>
        </div>
      </div>
      
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/member-show.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".click-row").forEach(function (row) {
            row.addEventListener("click", function () {
                window.location.href = this.dataset.href;
            });
        });
    });



    document.addEventListener("DOMContentLoaded", function () {
    
        document.querySelectorAll(".click-row").forEach(function (row) {
            row.addEventListener("click", function () {
                window.location.href = this.dataset.href;
            });
        });

        document.querySelectorAll(".upgrade-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const memberId = this.getAttribute("data-member-id");
                const memberName = this.getAttribute("data-name");

                document.getElementById("memberIdInput").value = memberId;
                document.getElementById("memberNameInput").value = memberName;
            });
        });

        
        const planSelect = document.getElementById("planSelect");
        const startDateInput = document.getElementById("startDateInput");
        const endDateInput = document.getElementById("endDateInput");

        function calculateEndDate() {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            const duration = selectedOption.getAttribute("data-duration");
            const startDate = startDateInput.value;

            if (duration && startDate) {
                const start = new Date(startDate);
                start.setMonth(start.getMonth() + parseInt(duration));

                // Format date as yyyy-mm-dd
                const yyyy = start.getFullYear();
                const mm = String(start.getMonth() + 1).padStart(2, '0');
                const dd = String(start.getDate()).padStart(2, '0');

                endDateInput.value = `${yyyy}-${mm}-${dd}`;
            } else {
                endDateInput.value = '';
            }
        }

        // Trigger when plan changes or start date changes
        planSelect.addEventListener("change", calculateEndDate);
        startDateInput.addEventListener("change", calculateEndDate);
    });


    // Delete
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const memberId = this.getAttribute('data-member-id');
            deleteForm.action = `/members/delete/${memberId}`;
        });
    });
});

</script>

@endsection