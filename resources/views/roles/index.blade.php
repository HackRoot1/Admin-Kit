@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <a href="{{ route('roles.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Role</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Roles List</h1>
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
                            <h5 class="card-title mb-0">Roles</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#0001</strong></td>
                                        <td>Super Admin</td>
                                        <td>Brian</td>
                                        <td><span class="badge badge-success-light">Active</span></td>
                                        <td>
                                            <a href="{{ route('roles.view') }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('roles.edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('roles.edit') }}" class="btn btn-primary btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>#0001</strong></td>
                                        <td>Admin</td>
                                        <td>Brian Smith</td>
                                        <td><span class="badge badge-success-light">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">View</a>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-primary btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>#0001</strong></td>
                                        <td>Staff</td>
                                        <td>Brian Smith</td>
                                        <td><span class="badge badge-danger-light">Inactive</span></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">View</a>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-primary btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
