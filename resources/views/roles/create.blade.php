@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('roles.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Add New Role</h1>

            <div class="row">
                <div class="col-md-12">
                    <form>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Role Details:</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control is-invalid" id="name" placeholder="Name">
                                    <div class="invalid-feedback">
                                        Please enter Name.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Permissions Details:</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="view_admin">
                                                <label class="form-check-label" for="view_admin">View Admin </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="create_admin">
                                                <label class="form-check-label" for="create_admin">Create Admin </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="update_admin">
                                                <label class="form-check-label" for="update_admin">Update Admin </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="delete_admin">
                                                <label class="form-check-label" for="delete_admin">Delete Admin </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
   

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
 