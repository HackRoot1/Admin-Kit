@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Add New Permission</h1>

            <div class="row">
                <div class="col-md-12">
                    <form>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Permission Details:</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control is-invalid" id="name" placeholder="Name">
                                    <div class="invalid-feedback">
                                        Please enter Name.
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
