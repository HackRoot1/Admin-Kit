@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">

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
                                    <img src="img/avatars/avatar-5.jpg" width="100" height="100" class="rounded ms-2"
                                        alt="Avatar">
                                </div>
                                <div class="col-md-6">
                                    <span><b>First Name:</b></span>
                                    <span>Saurabh</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Last Name:</b></span>
                                    <span>Damale</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Email:</b></span>
                                    <span>Saurabh@gmail.com</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Contact Number:</b></span>
                                    <span>9879879877</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Emergency Contact Number:</b></span>
                                    <span>9879879877</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Date Of Birth:</b></span>
                                    <span>23 June 2000</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Gender:</b></span>
                                    <span>Male</span>
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
                                    <span>IT</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Skills:</b></span>
                                    <span>HTML, CSS, JS</span>
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
                                    <span>At. post Khardi, Tal.- Shahapur</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Address Line 2:</b></span>
                                    <span>Dist.- Thane</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Country:</b></span>
                                    <span>India</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>State:</b></span>
                                    <span>Maharashtra</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>City:</b></span>
                                    <span>Thane</span>
                                </div>
                                <div class="col-md-6">
                                    <span><b>Zip:</b></span>
                                    <span>421601</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
