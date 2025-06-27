@extends('layouts.app')

@section('title', 'Member Details')

@section('content')
@include('partials.header')

<div class="row my-4 px-4 gx-0" >

    <div class="col-4 pe-4">
        <div class="row">
            <!-- Member Info Card -->
<div class="col-12 mb-3">
    <div class="card border-0 shadow-lg rounded-4 bg-white">
        <div class="card-body py-4 px-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-semibold mb-1">
                        {{ $member->first_name . ' ' . $member->last_name }}
                        @php
                            $isActive = \Carbon\Carbon::parse($latestSubscription->end_date)->isFuture();
                        @endphp
                        <span class="badge {{ $isActive ? 'bg-success' : 'bg-secondary' }} ms-2">
                            {{ $isActive ? 'Active' : 'Expired' }}
                        </span>
                    </h4>
                    <p class="text-muted mb-0">Member ID: #{{ $member->member_id }}</p>
                </div>
                <a href="{{ route('members.edit', $member) }}" title="Edit Member">
                    <i class="fas fa-edit fs-4 text-primary"></i>
                </a>
            </div>

            <hr>

            <div class="row g-3 fs-6">
                <div class="col-md-6 d-flex align-items-start gap-2 text-secondary">
                    <i class="fas fa-envelope text-muted mt-1"></i>
                    <div class="text-break">{{ $member->email }}</div>
                </div>
                <div class="col-md-6 d-flex align-items-start gap-2 text-secondary">
                    <i class="fas fa-phone-alt text-muted mt-1"></i>
                    <div class="text-break">{{ $member->phone }}</div>
                </div>
                <div class="col-md-6 d-flex align-items-start gap-2 text-secondary">
                    <i class="fa-solid fa-calendar-week text-muted mt-1"></i>
                    <div class="text-break">{{ \Carbon\Carbon::parse($member->dob)->format('M d Y') }}</div>
                </div>
                <div class="col-md-6 d-flex align-items-start gap-2 text-secondary">
                    <i class="fas fa-map-marker-alt text-muted mt-1"></i>
                    <div class="text-break">{{ $member->address }}</div>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-12 d-flex align-items-start gap-2 text-secondary">
                    <i class="fas fa-calendar-alt text-muted mt-1"></i>
                    <div class="text-break">Member Since: {{ \Carbon\Carbon::parse($member->joined_date)->format('M d Y') }}</div>
                </div>
            </div>

        </div>
    </div>
</div>


            <!-- Current Subscription Card -->
            <div class="col-12 mt-5">
    <div class="card border-0 shadow-lg rounded-4" style="background-color: #f9f9f9;">
        <div class="card-body py-4 px-5">
            <h4 class="card-title mb-4 text-primary fw-bold">
                <i class="fas fa-id-card-alt me-2"></i> Current Plan
            </h4>

            @if($isActive)
                <div class="d-flex justify-content-between align-items-center mb-4 px-3 py-2 bg-light rounded-3 border">
                    <div class="text-success">
                        <div class="fw-bold fs-4">{{ $latestSubscription->membershipPlan->name }}</div>
                        <small class="text-muted">Active Plan</small>
                    </div>
                    <div class="text-danger text-end">
                        <div class="fw-bold fs-4">${{ $latestSubscription->membershipPlan->price }}</div>
                        <small class="text-muted">Price</small>
                    </div>
                </div>

                <div class="text-center text-dark">
                    <i class="fas fa-calendar-alt me-1 text-secondary"></i>
                    <span>{{ \Carbon\Carbon::parse($latestSubscription->start_date)->format('M d, Y') }}</span>
                    <i class="fas fa-arrow-right mx-2 text-muted"></i>
                    <span>{{ \Carbon\Carbon::parse($latestSubscription->end_date)->format('M d, Y') }}</span>
                </div>
            @else
                <div class="alert alert-warning text-center mx-auto my-4 shadow-sm rounded-3" style="max-width: 600px;">
                    <h5 class="text-danger mb-3">
                        <i class="fas fa-exclamation-circle me-1"></i> Subscription Expired
                    </h5>
                    <p class="mb-1">
                        Your <strong>{{ $latestSubscription->membershipPlan->name }}</strong> plan ended on 
                        <strong>{{ \Carbon\Carbon::parse($latestSubscription->end_date)->format('M d, Y') }}</strong>.
                    </p>
                    <p class="mb-3">Renew now to regain access to all features and classes.</p>
                    <a href="{{ route('members.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-redo me-1"></i> Renew Now
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>

        </div>
    </div>
   <div class="col-8">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body px-5 py-4">
            <!-- Header with Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 id="toggleTitle" class="mb-0 text-primary fw-bold">Payment History</h5>
                <div class="btn-group" role="group" aria-label="Toggle views">
    <button type="button" 
            class="btn btn-sm btn-outline-primary active" 
            id="btn-payment" 
            onclick="toggleView('payment')">
        Payment History
    </button>
    <button type="button" 
            class="btn btn-sm btn-outline-secondary" 
            id="btn-attendance" 
            onclick="toggleView('attendance')">
        Attendance
    </button>
    <button type="button" 
            class="btn btn-sm btn-outline-secondary" 
            id="btn-classes" 
            onclick="toggleView('classes')">
        Class History
    </button>
</div>


            </div>

            <!-- Payment Table -->
            <div id="paymentTable" class="table-responsive" style="overflow-x: auto;" >
                <table class="table table-hover table-bordered align-middle" style="min-width: 1000px;">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Method</th>
                            <th scope="col">Paid Date</th>
                            <th scope="col">Cashier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member->payments as $pay)
                        <tr>
                            <td>{{ $pay->payment_id }}</td>
                            <td>
                                <strong>{{ $pay->planSubscription->membershipPlan->name ?? 'N/A' }}</strong><br>
                                <small class="text-muted">${{ number_format($pay->amount, 2) }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pay->planSubscription->start_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pay->planSubscription->end_date)->format('M d, Y') }}</td>
                            <td>
                                @php
                                    $start = \Carbon\Carbon::parse($pay->planSubscription->start_date);
                                    $end = \Carbon\Carbon::parse($pay->planSubscription->end_date);

                                    $months = $start->diffInMonths($end);
                                    $remainingDays = $start->addMonths($months)->diffInDays($end);
                                @endphp

                                @if ($months > 0)
                                    {{ $months }} {{ Str::plural('month', $months) }}
                                @endif

                                @if ($remainingDays > 0)
                                    {{ $months > 0 ? ', ' : '' }}{{ $remainingDays }} {{ Str::plural('day', $remainingDays) }}
                                @endif
                            </td>

                            <td class="text-capitalize">{{ str_replace('_', ' ', $pay->payment_method) }}</td>
                            <td>{{ \Carbon\Carbon::parse($pay->paid_date)->format('M d, Y - H:i') }}</td>
                            <td>
                                @if ($pay->user)
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <small class="fw-semibold">#{{ $pay->user->user_id }}  {{ $pay->user->first_name }} {{ $pay->user->last_name }}</small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Attendance List -->
            <div id="attendanceTable" class="d-none table-responsive mt-4">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th scope="col">Attendance ID</th>
                            <th scope="col">Check In</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($member->dailyAttendances->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center text-muted fst-italic">No attendance records found.</td>
                            </tr>
                        @else
                            @foreach ($member->dailyAttendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->daily_attendance_id }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($attendance->start_time)->format('Y-m-d H:i:s') }} -
                                        @if ($attendance->end_time)
                                            <span class="text-success fw-semibold">✔ Present</span>
                                        @else
                                            <span class="text-warning fw-semibold">⏳ In Progress</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Class History List -->
            <div id="classTable" class="d-none table-responsive mt-4">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th scope="col">Register ID</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($member->classRegisterations as $reg)
                            <tr>
                                <td>{{ $reg->class_registeration_id }}</td>
                                <td>{{ optional($reg->gymClass)->class_name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reg->registered_date)->format('M d, Y - H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted fst-italic">No class registrations found.</td>
                            </tr>
                        @endforelse
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