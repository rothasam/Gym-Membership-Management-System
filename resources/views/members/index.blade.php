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
                                <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-arrow-up"></i> Upgrade Plan
                                </button>
                                <a class="text-info me-2 " href="{{ route('members.show',$member->member_id) }}" title="Preview"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('members.edit', $member) }}" class="text-warning me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0);" title="Delete" onclick="showConfirm(this)" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Card (hidden by default) -->
<!-- Backdrop -->
<div id="deleteBackdrop"
     class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"
     style="z-index: 1040;">
</div>

<!-- Delete Confirmation Card -->
<div id="deleteConfirmCard"
     class="card shadow-sm position-fixed top-50 start-50 translate-middle w-25 d-none"
     style="z-index: 1050; background-color: #fff;">
    <div class="card-body text-center">
        <h5 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
        <p class="mb-4">Do you really want to delete this member?</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-secondary" onclick="cancelDelete()">No</button>
            <button class="btn btn-danger" onclick="confirmDelete()">Yes</button>
        </div>
    </div>
</div>



<!-- modal edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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

               
            </form>
        </div>
      </div>
      <div class="modal-footer">
            <div class="text-end">
                <button type="submit" class="btn btn-success" style="background-color:rgb(240, 14, 101); border:none;">Update Subscription</button>
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
</script>
@endsection