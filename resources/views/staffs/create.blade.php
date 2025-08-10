@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

            <a href="{{ route('staffs.index') }}" class="btn btn-primary float-end mt-n1">Back</a>
            <h1 class="h3 mb-3">Add New Staff</h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Staff Details:</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

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
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            name="last_name" id="last_name" placeholder="Last Name"
                                            value="{{ old('last_name') }}">
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
                                            name="email" id="inputEmail4" placeholder="Email" value="{{ old('email') }}">
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
                                            name="contact_number" id="contact_number" placeholder="Contact Number"
                                            value="{{ old('contact_number') }}">
                                        @error('contact_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Emergency Contact --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="emergency_contact_number">Emergency Contact
                                            Number</label>
                                        <input type="tel"
                                            class="form-control @error('emergency_contact_number') is-invalid @enderror"
                                            name="emergency_contact_number" id="emergency_contact_number"
                                            placeholder="Emergency Contact Number"
                                            value="{{ old('emergency_contact_number') }}">
                                        @error('emergency_contact_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- DOB --}}
                                <div class="mb-3">
                                    <label class="form-label" for="dob">Date Of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        name="dob" id="dob" placeholder="2000-01-15" value="{{ old('dob') }}">
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
                                                        {{ old('gender') === $gender ? 'checked' : '' }}>
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
                                        @foreach (['html', 'css', 'js'] as $skill)
                                            <div class="col-4">
                                                <label class="form-check">
                                                    <input name="skills[]" value="{{ $skill }}" type="checkbox"
                                                        class="form-check-input @error('skills') is-invalid @enderror"
                                                        {{ is_array(old('skills')) && in_array($skill, old('skills')) ? 'checked' : '' }}>
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
                                                {{ old('department') === $dept ? 'selected' : '' }}>
                                                {{ ucfirst($dept) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Address 1 --}}
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress">Address</label>
                                    <input type="text"
                                        class="form-control @error('address_line_1') is-invalid @enderror"
                                        name="address_line_1" id="inputAddress" placeholder="1234 Main St"
                                        value="{{ old('address_line_1') }}">
                                    @error('address_line_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Address 2 --}}
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress2">Address 2</label>
                                    <input type="text"
                                        class="form-control @error('address_line_2') is-invalid @enderror"
                                        name="address_line_2" id="inputAddress2"
                                        placeholder="Apartment, studio, or floor" value="{{ old('address_line_2') }}">
                                    @error('address_line_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Country --}}
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" name="country"
                                            class="form-control @error('country') is-invalid @enderror">
                                            <option value="">Choose...</option>
                                            {{-- populate dynamically --}}
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- State --}}
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="state">State</label>
                                        <select id="state" name="state"
                                            class="form-control @error('state') is-invalid @enderror">
                                            <option value="">Choose...</option>
                                        </select>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- City --}}
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="city">City</label>
                                        <select id="city" name="city"
                                            class="form-control @error('city') is-invalid @enderror">
                                            <option value="">Choose...</option>
                                        </select>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Zip --}}
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label" for="zip">Zip</label>
                                        <input type="text" name="zip_code" id="zip"
                                            class="form-control @error('zip_code') is-invalid @enderror"
                                            value="{{ old('zip_code') }}">
                                        @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load countries
            $.get('/countries', function(data) {
                data.data.forEach(function(country) {
                    $('#country').append('<option value="' + country.name + '">' + country.name +
                        '</option>');
                });
            });

            // Load states when country changes
            $('#country').on('change', function() {
                let countryId = $(this).val();
                $('#state').empty().append('<option value="">Choose...</option>');
                $('#city').empty().append('<option value="">Choose...</option>');

                if (countryId) {
                    $.get('/states/' + countryId, function(data) {
                        data.data.forEach(function(state) {
                            $('#state').append('<option value="' + state.name + '">' + state
                                .name + '</option>');
                        });
                    });
                }
            });

            // Load cities when state changes
            $('#state').on('change', function() {
                let stateId = $(this).val();
                $('#city').empty().append('<option value="">Choose...</option>');

                if (stateId) {
                    $.get('/cities/' + stateId, function(data) {
                        data.data.forEach(function(city) {
                            $('#city').append('<option value="' + city.name + '">' + city
                                .name + '</option>');
                        });
                    });
                }
            });
        });
    </script>
@endsection
