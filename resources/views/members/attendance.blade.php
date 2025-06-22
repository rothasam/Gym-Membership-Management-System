@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
@include('partials.header')
@include('partials.nav')

@php
    $members = [
        ['id' => 1, 'name' => 'John Doe', 'plan' => 'Premium', 'expire' => '2025-12-31'],
        ['id' => 2, 'name' => 'Jane Smith', 'plan' => 'Standard', 'expire' => '2025-11-15'],
        ['id' => 3, 'name' => 'Alice Brown', 'plan' => 'Basic', 'expire' => '2025-10-20'],
        ['id' => 4, 'name' => 'Bob Gray', 'plan' => 'Standard', 'expire' => '2025-09-01'],
        ['id' => 5, 'name' => 'David White', 'plan' => 'Premium', 'expire' => '2025-08-30'],
        ['id' => 6, 'name' => 'Emma Lee', 'plan' => 'Basic', 'expire' => '2025-07-25'],
        ['id' => 7, 'name' => 'Chris Green', 'plan' => 'Standard', 'expire' => '2025-06-20'],
        ['id' => 8, 'name' => 'Sara Black', 'plan' => 'Premium', 'expire' => '2025-05-10'],
        ['id' => 9, 'name' => 'Tom Hall', 'plan' => 'Basic', 'expire' => '2025-04-01'],
        ['id' => 10, 'name' => 'Lina Chan', 'plan' => 'Standard', 'expire' => '2025-03-15'],
        ['id' => 11, 'name' => 'Lina Chan', 'plan' => 'Standard', 'expire' => '2025-03-15'],
        ['id' => 12, 'name' => 'Lina Chan', 'plan' => 'Standard', 'expire' => '2025-03-15'],
        ['id' => 13, 'name' => 'Lina Chan', 'plan' => 'Standard', 'expire' => '2025-03-15'],
        ['id' => 14, 'name' => 'Lina Chan', 'plan' => 'Standard', 'expire' => '2025-03-15'],
    ];

    $perPage = 5;
    $currentPage = request()->get('page', 1);
    $pagedData = collect($members)->forPage($currentPage, $perPage);
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $pagedData,
        count($members),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );
@endphp

<div class="container my-5">
    <!-- Stat Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white shadow-sm bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Present</h5>
                    <h2 id="presentCount">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white shadow-sm bg-danger">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Active</h5>
                    <h2 id="activeCount">{{ count($members) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.62);">
        <div class="card-header text-white" style="background-color:rgb(240, 14, 101);">
            <h4 class="mb-0">Attendance Form</h4>
        </div>
        <div class="card-body">
            <form id="attendanceForm">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>Expire Date</th>
                            <th class="text-center">Present</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagedData as $member)
                        <tr>
                            <td>{{ $member['id'] }}</td>
                            <td>{{ $member['name'] }}</td>
                            <td>{{ $member['plan'] }}</td>
                            <td>{{ $member['expire'] }}</td>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input present-checkbox" name="present[]" value="{{ $member['id'] }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        {{ $paginator->links('pagination::bootstrap-5') }}
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" style="background-color:rgb(240, 14, 101);border:none;">Submit Attendance</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const STORAGE_KEY = "presentMembers";
    let checkedMembers = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    
    // Initialize checkboxes from storage
    document.querySelectorAll('.present-checkbox').forEach(checkbox => {
        // Set checkbox state if member is in storage
        checkbox.checked = checkedMembers.includes(checkbox.value);
        
        // Update storage when checkbox changes
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                if (!checkedMembers.includes(this.value)) {
                    checkedMembers.push(this.value);
                }
            } else {
                checkedMembers = checkedMembers.filter(id => id !== this.value);
            }
            localStorage.setItem(STORAGE_KEY, JSON.stringify(checkedMembers));
            updateTotalCount();
        });
    });
    
    // Update the total present count
    function updateTotalCount() {
        document.getElementById('presentCount').textContent = checkedMembers.length;
    }
    
    // Initialize the count
    updateTotalCount();
});

</script>
@endsection
