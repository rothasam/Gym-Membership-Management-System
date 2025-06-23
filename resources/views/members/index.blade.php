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
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>012345678</td>
                        <td>Premium</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>2025-06-01</td>
                        <td class="text-center">
                            <a class="text-info me-2 {{ request()->routeIs('members.show') ? 'active' : '' }}" href="{{ route('members.show') }}" title="Preview"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('members.edit') }}" class="text-warning me-2" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" title="Delete" onclick="showConfirm(this)" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>098765432</td>
                        <td>Standard</td>
                        <td><span class="badge bg-secondary">Expired</span></td>
                        <td>2025-05-21</td>
                        <td class="text-center">
                            <a class="text-info me-2 {{ request()->routeIs('members.register') ? 'active' : '' }}" href="{{ route('members.show') }}" title="detail"><i class="fas fa-eye"></i></a>
                            <a class="text-warning me-2 {{ request()->routeIs('members.edit') ? 'active' : '' }}" href="{{ route('members.edit') }}"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" title="Delete" onclick="showConfirm()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <!-- Add more static rows as needed -->
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

@endsection

@section('scripts')
<script src="{{ asset('js/member-show.js') }}"></script>
@endsection