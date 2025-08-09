@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('roles.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Update Role</h1>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Role Details:</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $role->name) }}" id="name"
                                        placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            Please enter Name.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="name">Display Name</label>
                                    <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                        name="display_name" value="{{ old('display_name', $role->display_name) }}"
                                        id="name" placeholder="Display Name">
                                    @error('display_name')
                                        <div class="invalid-feedback">
                                            Please enter Display Name.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="name">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description" value="{{ old('description', $role->description) }}"
                                        id="name" placeholder="Description">
                                    @error('description')
                                        <div class="invalid-feedback">
                                            Please enter Description.
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
