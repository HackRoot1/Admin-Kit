@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('staffs.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Update Staff</h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Staff Details:</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('staff.update', $staff->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Show existing profile picture --}}
                                @if ($staff->profile)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $staff->profile) }}" alt="Profile"
                                            style="width: 100px; height: auto;">
                                    </div>
                                @endif

                                {{-- Profile Pic --}}
                                <div class="mb-3">
                                    <label class="form-label" for="profile">Profile Pic</label>
                                    <input class="form-control @error('profile') is-invalid @enderror" name="profile"
                                        id="profile" accept=".png, .jpg, .jpeg, .webp" type="file">
                                    @error('profile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    {{-- First Name --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="first_name">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            name="first_name" id="first_name" placeholder="First Name"
                                            value="{{ old('first_name', $staff->first_name) }}">
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- Last Name --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            name="last_name" id="last_name" placeholder="Last Name"
                                            value="{{ old('last_name', $staff->last_name) }}">
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Email --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputEmail4">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="inputEmail4" placeholder="Email"
                                            value="{{ old('email', $staff->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputPassword4">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="inputPassword4" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- Contact Number --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="contact_number">Contact Number</label>
                                        <input type="number"
                                            class="form-control @error('contact_number') is-invalid @enderror"
                                            name="contact_number" id="contact_number"
                                            value="{{ old('contact_number', $staff->contact_number) }}">
                                        @error('contact_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Emergency Contact --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="emergency_contact_number">Emergency Contact</label>
                                        <input type="tel"
                                            class="form-control @error('emergency_contact_number') is-invalid @enderror"
                                            name="emergency_contact_number" id="emergency_contact_number"
                                            value="{{ old('emergency_contact_number', $staff->emergency_contact_number) }}">
                                        @error('emergency_contact_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- DOB --}}
                                <div class="mb-3">
                                    <label class="form-label" for="dob">Date Of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        name="dob" id="dob" value="{{ old('dob', $staff->dob) }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gender --}}
                                <fieldset class="mb-3">
                                    <label class="col-form-label">Gender</label>
                                    <div class="row">
                                        @foreach (['male', 'female', 'other'] as $gender)
                                            <div class="col-4">
                                                <label class="form-check">
                                                    <input name="gender" value="{{ $gender }}" type="radio"
                                                        class="form-check-input @error('gender') is-invalid @enderror"
                                                        {{ old('gender', $staff->gender) === $gender ? 'checked' : '' }}>
                                                    <span class="form-check-label">{{ ucfirst($gender) }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                {{-- Skills --}}
                                <fieldset class="mb-3">
                                    <label class="col-form-label">Skills</label>
                                    <div class="row">
                                        {{-- @php
                                            $skills = json_decode($staff->skills, true) ?? [];
                                        @endphp --}}
                                        @foreach (['html', 'css', 'js'] as $skill)
                                            <div class="col-4">
                                                <label class="form-check">
                                                    <input name="skills[]" value="{{ $skill }}" type="checkbox"
                                                        class="form-check-input @error('skills') is-invalid @enderror"
                                                        {{ in_array($skill, $staff->skills, true) ? 'checked' : '' }}>
                                                    <span class="form-check-label">{{ strtoupper($skill) }}</span>
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    @error('skills')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                {{-- Department --}}
                                <div class="mb-3">
                                    <label class="form-label" for="department">Department</label>
                                    <select id="department" name="department"
                                        class="form-control @error('department') is-invalid @enderror">
                                        <option value="">--Select--</option>
                                        @foreach (['it', 'hr', 'sales', 'marketing'] as $dept)
                                            <option value="{{ $dept }}"
                                                {{ old('department', $staff->department) === $dept ? 'selected' : '' }}>
                                                {{ ucfirst($dept) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress">Address</label>
                                    <input type="text" class="form-control" id="inputAddress"
                                        placeholder="1234 Main St">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress2">Address 2</label>
                                    <input type="text" class="form-control" id="inputAddress2"
                                        placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="state">State</label>
                                        <select id="state" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="city">City</label>
                                        <select id="city" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="zip">Zip</label>
                                        <input type="text" class="form-control" id="zip">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
