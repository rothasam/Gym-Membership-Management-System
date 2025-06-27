@extends('layouts.app')

@section('title', 'Member Edit')

@section('content')
@include('partials.header')

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bgPrimary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i> Active Members - Attendance
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Expire Date</th>
                            <th scope="col">Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>{{ $member->member_id }}</td>
                                <td class="fw-semibold">{{ $member->first_name }} {{ $member->last_name }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $member->latestSubscription?->membershipPlan?->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $member->latestSubscription?->end_date 
                                        ? \Carbon\Carbon::parse($member->latestSubscription->end_date)->format('d M Y') 
                                        : 'N/A' }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('daily_attendance.store', $member->member_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="member_id" value="{{ $member->member_id }}">
                                            <button class="btn btn-success btn-sm">
                                                <i class="fas fa-sign-in-alt me-1"></i> Check In
                                            </button>
                                        </form>
                                        <a href="{{ route('members.show', $member) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No active members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script src="{{ asset('js/member-edit.js') }}"></script>
<script>
    const toastEl = document.querySelector('.toast');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
</script>

@endsection
