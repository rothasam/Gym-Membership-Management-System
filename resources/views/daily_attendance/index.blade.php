@extends('layouts.app')

@section('title', 'Member Edit')

@section('content')
@include('partials.header')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Active Members - Attendance</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Expire Date</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                            <td>
                                {{ $member->latestSubscription?->membershipPlan?->name ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $member->latestSubscription?->end_date ?? 'N/A' }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('daily_attendance.store', $member->member_id) }}" method="POST" class="me-2">
                                        @csrf
                                        <input type="hidden" name="member_id" value="{{ $member->member_id }}">
                                        <button class="btn btn-success btn-sm">Check In</button>
                                    </form>
                                    <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('js/member-edit.js') }}"></script>
@endsection