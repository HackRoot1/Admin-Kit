@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('permissions.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Permission Detail</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Permission Details:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <span><b>Name:</b></span>
                                    <span>{{ $permission->name }}</span>
                                </div>
                                
                                <div class="col-md-6">
                                    <span><b>Display Name:</b></span>
                                    <span>{{ $permission->display_name }}</span>
                                </div>
                                
                                <div class="col-md-6">
                                    <span><b>Description:</b></span>
                                    <span>{{ $permission->description }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
