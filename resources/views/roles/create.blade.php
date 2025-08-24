@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('roles.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Add New Role</h1>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Role Details:</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" id="name" placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            Please enter Name.
                                        </div>
                                    @enderror
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
