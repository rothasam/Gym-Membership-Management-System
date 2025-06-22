@extends('layouts.app')

@section('title', 'Member Details')

@section('content')
@include('partials.header')
@include('partials.nav')

<div class="row g-4 d-flex justify-content-evenly mt-3">
    <!-- Member Info Card -->
    <div class="col-md-4 d-flex">
        <div class="card shadow-sm w-100">
            <div class="card-body">
                <h3 class="card-title d-flex justify-content-between align-items-center">
                    John Doe
                    {{-- <a href="#" title="Edit"><i class="fas fa-edit text-primary"></i></a> --}}
                    <a title="Edit" class=" {{ request()->routeIs('members.edit') ? 'active' : '' }}" href="{{ route('members.edit') }}"><i class="fas fa-edit text-primary"></i></a>
                </h3>
                <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                <p><i class="fas fa-envelope text-muted me-2"></i>john@example.com</p>
                <p><i class="fas fa-phone-alt text-muted me-2"></i>012345678</p>
                <p><i class="fas fa-map-marker-alt text-muted me-2"></i>Phnom Penh</p>
                <p><i class="fas fa-calendar-alt text-muted me-2"></i>Joined: 2025-06-01</p>
            </div>
        </div>
    </div>

    <!-- Current Subscription Card -->
    <div class="col-md-4 d-flex">
        <div class="card shadow-sm w-50">
            <div class="card-body">
                <h5 class="card-title">Current Plan</h5>
                
                <div style="margin: 20px auto;" class="text-center d-flex justify-content-between align-items-center">
                        <div class="text-success"><span style="font-size:30px; font-weight:bold;">Premium</span></div>
                        <div class="text-danger"><span style="font-size:30px; font-weight:bold;"">$500</span></div>
                    </div>
                    <div style="margin:20px auto;">
                        <i class="fas fa-calendar"></i>
                        <span>2025-06-01</span>
                        <i class="fas fa-arrow-right"></i>
                        <span> 2025-12-01</span>
                    </div>
                <div class="text-end mt-3">
                    <a  class="btn btn-primary btn-sm  {{ request()->routeIs('subcriptions.update') ? 'active' : '' }}" href="{{ route('subcriptions.update') }}" style="background-color:rgb(240, 14, 101); border:none;">{{--{{ route('plans.upgrade', ['member_id' => 1]) }}--}}
                        <i class="fas fa-arrow-up"></i> Upgrade Plan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8 m-auto mt-5">
    <div class="card shadow-sm w-100">
        <div class="card-body">
            <!-- Header with Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 id="toggleTitle" class="mb-0">Payment History</h5>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary active" id="btn-payment" onclick="toggleView('payment')">Payment History</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-attendance" onclick="toggleView('attendance')">Attendance</button>
                </div>
            </div>
            
            <!-- Payment Table -->
            <div id="paymentTable">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Paid ID</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Duration</th>
                            <th>Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Premium</td>
                            <td>$500</td>
                            <td>2025-01-01</td>
                            <td>2025-06-01</td>
                            <td>6 months</td>
                            <td>ABA Pay</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Attendance List -->
            <div id="attendanceTable" class="d-none">
                <ul class="list-group">
                    <li class="list-group-item">2025-06-01 - ✔ Present</li>
                    <li class="list-group-item">2025-06-02 - ✔ Present</li>
                    <li class="list-group-item">2025-06-03 - ❌ Absent</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/member-detail.js') }}"></script>
@endsection