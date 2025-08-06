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
                            <form action="{{ route('staffs.edit') }}" method="POST" enctype="multipart/form-data">
                                @csrf 
                                @method('POST')

                                <div class="mb-3">
                                    <label class="form-label" for="profile">Profile Pic</label>
                                    <input class="form-control" name="profile" id="profile"
                                        accept=".png, .jpg, .jpeg, .webp" type="file">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputEmail4">Email</label>
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputPassword4">Password</label>
                                        <input type="password" class="form-control" id="inputPassword4"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone_number">Contact Number</label>
                                        <input type="number" class="form-control" id="phone_number"
                                            placeholder="Contact Number">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="emergency_contact">Emergency Contact Number</label>
                                        <input type="tel" class="form-control" id="emergency_contact"
                                            placeholder="Emergency Contact Number">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="dob">Date Of Birth</label>
                                    <input type="text" class="form-control" id="dob" placeholder="2000-01-15">
                                </div>

                                <fieldset class="mb-3">
                                    <div class="row">
                                        <label class="col-form-label col-sm-12 text-sm-start pt-sm-0">Gender</label>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="gender" value="male" type="radio"
                                                            class="form-check-input" checked>
                                                        <span class="form-check-label">Male</span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="gender" value="female" type="radio"
                                                            class="form-check-input">
                                                        <span class="form-check-label">Female</span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="gender" value="other" type="radio"
                                                            class="form-check-input">
                                                        <span class="form-check-label">Other</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-3">
                                    <div class="row">
                                        <label class="col-form-label col-sm-12 text-sm-start pt-sm-0">Skills</label>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="skills[]" value="html" type="checkbox"
                                                            class="form-check-input" checked>
                                                        <span class="form-check-label">HTML</span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="skills[]" value="css" type="checkbox"
                                                            class="form-check-input">
                                                        <span class="form-check-label">CSS</span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-check">
                                                        <input name="skills[]" value="js" type="checkbox"
                                                            class="form-check-input">
                                                        <span class="form-check-label">JS</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="mb-3">
                                    <label class="form-label" for="department">Department</label>
                                    <select id="department" name="department" class="form-control">
                                        <option selected>--Select--</option>
                                        <option value="it">IT</option>
                                        <option value="hr">HR</option>
                                        <option value="sales">Sales</option>
                                        <option value="marketing">Marketing</option>
                                    </select>
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

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
