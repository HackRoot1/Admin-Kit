@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <a href="{{ route('staff.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New
                Staff</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Staffs List</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                        <i class="align-middle" data-feather="more-horizontal"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Orders</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Added Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $staff)
                                        <tr>
                                            <td><strong>{{ $staff->id }}</strong></td>
                                            <td><img src="{{ $staff->profile ?? Avatar::create($staff->first_name . ' ' . $staff->last_name)->toBase64() }}"
                                                    width="50" alt=""></td>
                                            <td>{{ $staff->first_name }}</td>
                                            <td>{{ $staff->last_name }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" checked type="checkbox" id="view_admin">
                                                </div>
                                            </td>
                                            <td>
                                                @permission('view-staff')
                                                    <a href="{{ route('staff.show', $staff->id) }}"
                                                        class="btn btn-primary btn-sm">View</a>
                                                @endpermission
                                                @permission('update-staff')
                                                    <a href="{{ route('staff.edit', $staff->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endpermission
                                                @permission('delete-staff')
                                                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
