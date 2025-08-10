@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Activity List</h1>
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
                            <h5 class="card-title mb-0">Activity List</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>Action By</th>
                                        <th>Event</th>
                                        <th>Description</th>
                                        <th>Action On</th>
                                        <th>Properties</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->causer?->first_name ?? 'System' }}</td>
                                            <td>{{ $activity->event }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->subject?->first_name }}
                                            </td>
                                            <td>
                                                <pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                            </td>
                                            <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            No Activity Found
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
