@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Task Detail</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Task Details:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <span><b>Title:</b></span>
                                    <span>Task 1</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Description:</b></span>
                                    <span>This is a dummy task.</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Due Date:</b></span>
                                    <span>2023-12-05</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Status:</b></span>
                                    <span class="badge badge-danger-light">Inactive</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Created At:</b></span>
                                    <span>2023-12-05</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
