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
                                    <span>{{ $task->title }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Description:</b></span>
                                    <span>{{ $task->description }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Due Date:</b></span>
                                    <span>{{ date('d-M-Y', strtotime($task->due_date)) }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Status:</b></span>
                                    @if ($task->status == 'pending')
                                        <span class="badge badge-danger-light">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    @elseif($task->status == 'in_progress')
                                        <span class="badge badge-warning-light">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    @elseif($task->status == 'completed')
                                        <span class="badge badge-success-light">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span><b>Created At:</b></span>
                                    <span>{{ $task->created_at->format('d-M-Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
