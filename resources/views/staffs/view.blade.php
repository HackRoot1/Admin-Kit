@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('staffs.index') }}" class="btn btn-primary float-end mt-n1">Back</a>

            <h1 class="h3 mb-3">Staff Detail</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Personal Details:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <span><b>Profile:</b></span>
                                    <img src="{{ asset('uploads/profile/small/' . $staff->profile) ?? Avatar::create($staff->first_name . ' ' . $staff->last_name)->toBase64() }}"
                                        width="100" height="100" class="rounded ms-2" alt="Avatar">
                                </div>
                                <div class="col-md-6">
                                    <span><b>Roles:</b></span>
                                    @if ($staff->roles->isNotEmpty())
                                        @foreach ($staff->roles as $role)
                                            <span class="badge bg-primary">{{ $role->display_name }}</span>
                                        @endforeach
                                    @else
                                        <span>No roles assigned</span>
                                    @endif
                                </div>

                                <!-- Assign Role Button -->
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#assignRoleModal">
                                        @if ($staff->roles->isNotEmpty())
                                            Change Role
                                        @else
                                            Assign Role
                                        @endif
                                    </button>
                                </div>

                                <!-- Assign Role Modal -->
                                <div class="modal fade" id="assignRoleModal" tabindex="-1"
                                    aria-labelledby="assignRoleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('users.assignRole', $staff->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignRoleModalLabel">Assign Role to
                                                        {{ $staff->first_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="role_id" class="form-label">Select Role</label>
                                                        <select name="role_id" id="role_id" class="form-control" required>
                                                            <option value="">-- Select Role --</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}"
                                                                    {{ $staff->roles->contains($role->id) ? 'selected' : '' }}>
                                                                    {{ $role->display_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Assign</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <span><b>First Name:</b></span>
                                    <span>{{ $staff->first_name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Last Name:</b></span>
                                    <span>{{ $staff->last_name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Email:</b></span>
                                    <span>{{ $staff->email }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Contact Number:</b></span>
                                    <span>{{ $staff->contact_number }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Emergency Contact Number:</b></span>
                                    <span>{{ $staff->emergency_contact_number }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Date Of Birth:</b></span>
                                    <span>{{ $staff->dob ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Gender:</b></span>
                                    <span>{{ $staff->gender }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Professional Details:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <span><b>Department:</b></span>
                                    <span>{{ $staff->department }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Skills:</b></span>
                                    {{-- @php
                                        $skills = json_decode($staff->skills, true) ?? [];
                                    @endphp --}}

                                    @isset($staff->skills)
                                        @forelse ($staff->skills as $skill)
                                            <span class="badge bg-secondary">{{ strtoupper($skill) }}</span>
                                        @empty
                                            <span>No skills listed</span>
                                        @endforelse
                                    @endisset

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Address Details:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <span><b>Address Line 1:</b></span>
                                    <span>{{ $staff->address->address_line_1 ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Address Line 2:</b></span>
                                    <span>{{ $staff->address->address_line_2 ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Country:</b></span>
                                    <span>{{ $staff->address->country->name ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>State:</b></span>
                                    <span>{{ $staff->address->state ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>City:</b></span>
                                    <span>{{ $staff->address->city ?? '' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Zip:</b></span>
                                    <span>{{ $staff->address->zip_code ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
