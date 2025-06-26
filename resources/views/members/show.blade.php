@extends('layouts.app')

@section('title', 'Member Details')

@section('content')
@include('partials.header')

<div class="row my-4 px-4 gx-0" >

    <div class="col-4 pe-4">
        <div class="row">
            <!-- Member Info Card -->
            <div class="col-12 ">
                <div class="card shadow-sm w-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="gap-3 d-flex justify-content-center align-items-center">
                                <span class="fs-4 fw-medium">{{ $member->first_name . ' ' . $member->last_name }}</span>
                                <span class="badge bg-success">{{ $latestSubscription->status }}</span>
                            </div>
                            {{-- <a href="#" title="Edit"><i class="fas fa-edit text-primary"></i></a> --}}
                            <a title="Edit" href="{{ route('members.edit', $member) }}"><i class="fas fa-edit text-primary"></i></a>
                        </div>
                        
                        <p><i class="fas fa-envelope text-muted me-2"></i>{{ $member->email }}</p>
                        <p><i class="fas fa-phone-alt text-muted me-2"></i>{{ $member->phone }}</p>
                        <p><i class="fa-solid fa-calendar-week text-muted me-2"></i>{{ $member->dob }}</p>
                        <p><i class="fas fa-map-marker-alt text-muted me-2"></i>{{ $member->address }}</p>
                        <p><i class="fas fa-calendar-alt text-muted me-2"></i>Joined: {{ $member->joined_date }}</p>
                    </div>
                </div>
            </div>

            <!-- Current Subscription Card -->
            <div class="col-12 mt-5">
                <div class="card shadow-sm ">
                    <div class="card-body">
                        <h5 class="card-title">Current Plan</h5>
                        
                        <div style="margin: 20px auto;" class="text-center d-flex justify-content-between align-items-center">
                                <!-- <div class="text-success"><span style="font-size:30px; font-weight:bold;">{{ $member->latestSubscription->membershipPlan->name }}</span></div> -->
                                <div class="text-success"><span style="font-size:30px; font-weight:bold;">{{ $latestSubscription->membershipPlan->name }}</span></div>
                                <div class="text-danger"><span style="font-size:30px; font-weight:bold;">${{ $latestSubscription->membershipPlan->price }}</span></div>
                            </div>
                            <div style="margin:20px auto;">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $latestSubscription->start_date }}</span>
                                <i class="fas fa-arrow-right"></i>
                                <span>{{ $latestSubscription->end_date }}</span>
                            </div>
                        <!-- <div class="text-end mt-3">
                            <a  class="btn btn-primary btn-sm  {{ request()->routeIs('subcriptions.update') ? 'active' : '' }}" href="{{ route('subcriptions.update') }}" style="background-color:rgb(240, 14, 101); border:none;">{{--{{ route('plans.upgrade', ['member_id' => 1]) }}--}}
                                <i class="fas fa-arrow-up"></i> Upgrade Plan
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
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
                <div id="paymentTable" class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Paid ID</th>
                                <!-- <th>Subscription ID</th> -->
                                <th>Plan ID</th>
                                <th>Price</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Duration</th>
                                <th>Method</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($member->payments as $pay)
                                <tr>
                                    <td>{{ $pay->payment_id }}</td>
                                    <!-- <td>{{ $pay->planSubscription->plan_subscription_id }}</td> -->
                                    <td>{{ $pay->planSubscription->membership_plan_id }}</td>
                                    <td>${{ $pay->amount }}</td>
                                    <td>{{ $pay->planSubscription->start_date }}</td>
                                    <td>{{ $pay->planSubscription->end_date }}</td>
                                    <td>ot dg</td>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>{{ $pay->paid_date }}</td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>

                <!-- Attendance List -->
                <div id="attendanceTable" class="d-none table-responsive">
                    <table  class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Attendance ID</th>
                                <th>Check In</th>
                            </tr>
                        </thead>
                        <tbody>
                             @if ($member->dailyAttendances->isEmpty())
                                <p class="text-muted">No attendance records found.</p>
                            @else
                            @foreach ($member->dailyAttendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->daily_attendance_id }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($attendance->start_time)->format('Y-m-d H:i:s') }} -
                                            @if ($attendance->end_time)
                                                ✔ Present
                                            @else
                                                ⏳ In Progress
                                            @endif
                                        </td>
                                    </tr>
                                    
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                   
                </div>
            </div>
    </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/member-detail.js') }}"></script>
@endsection