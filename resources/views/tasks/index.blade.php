@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New
                Task</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Tasks List</h1>
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
                            <h5 class="card-title mb-0">Tasks</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $statuses = [
                                            'pending' => 'Pending',
                                            'in_progress' => 'In Progress',
                                            'completed' => 'Completed',
                                        ];
                                    @endphp
                                    @forelse ($tasks as $task)
                                        <tr>
                                            <td><strong>#{{ $task->id }}</strong></td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->due_date }}</td>
                                            <td>
                                                @if ($task->status === 'pending')
                                                    <span
                                                        class="badge badge-danger-light">{{ $statuses[$task->status] ?? 'Unknown' }}</span>
                                                @elseif($task->status === 'in_progress')
                                                    <span
                                                        class="badge badge-warning-light">{{ $statuses[$task->status] ?? 'Unknown' }}</span>
                                                @elseif($task->status === 'completed')
                                                    <span
                                                        class="badge badge-success-light">{{ $statuses[$task->status] ?? 'Unknown' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('tasks.view', $task->id) }}"
                                                    class="btn btn-primary btn-sm">View</a>
                                                <a href="{{ route('tasks.edit', $task->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    class="d-inline">
                                                    {{-- Assuming you have a route for deleting tasks --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                                                </form>
                                                {{-- <a href="#" class="btn btn-primary btn-sm">Delete</a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="6" class="text-center">No Tasks Found</td>
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
