@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Add New Task</h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url()->previous() }}" class="btn btn-primary float-end mt-n1">Back</a>
                            <h5 class="card-title">Task Details:</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" placeholder="Title">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <input type="text" name="description"
                                        class="form-control @error('description') is-invalid @enderror" id="description"
                                        placeholder="Description">
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="due_date">Due Date</label>
                                    <input type="date" name="due_date"
                                        class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                                        placeholder="01/17/2000">
                                    @error('due_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
