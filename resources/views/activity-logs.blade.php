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
                                        <th>#</th>
                                        <th>Date & Time</th>
                                        <th>User Name</th>
                                        <th>Activity Type</th>
                                        <th>Module</th>
                                        <th>Record ID</th>
                                        <th>Description</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>30 Jul 2025 10:00AM</td>
                                        <td>John Smith</td>
                                        <td>Login</td>
                                        <td>Auth</td>
                                        <td>-</td>
                                        <td>User logged into the system</td>
                                        <td>192.168.1.1</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>30 Jul 2025 10:05AM</td>
                                        <td>John Smith</td>
                                        <td>Create</td>
                                        <td>Leads</td>
                                        <td>15</td>
                                        <td>Created a new lead: "John Doe"</td>
                                        <td>192.168.1.1</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>30 Jul 2025 11:00AM</td>
                                        <td>Jane Doe</td>
                                        <td>Update</td>
                                        <td>Contacts</td>
                                        <td>22</td>
                                        <td>Updated contact email for Jane Smith</td>
                                        <td>10.0.0.2</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>30 Jul 2025 11:15AM</td>
                                        <td>John Smith</td>
                                        <td>Delete</td>
                                        <td>Deals</td>
                                        <td>37</td>
                                        <td>Deleted deal: "High Priority Lead"</td>
                                        <td>192.168.1.1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
