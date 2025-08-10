@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('permission.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New
                Permission</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Permissions List</h1>
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
                            <h5 class="card-title mb-0">Permissions</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td><strong># {{ $permission->id }}</strong></td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->display_name }}</td>
                                            <td>{{ $permission->description }}</td>
                                            <td><span class="badge badge-success-light">Active</span></td>
                                            <td>
                                                <a href="{{ route('permission.show', $permission->id) }}"
                                                    class="btn btn-primary btn-sm">View</a>
                                                <a href="{{ route('permission.edit', $permission->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('permission.destroy', $permission->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this role?')">
                                                        Delete
                                                    </button>
                                                </form>
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
