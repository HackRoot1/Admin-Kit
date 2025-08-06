@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="make-payment.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> Make Payment</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Payments List</h1>
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
                            <h5 class="card-title mb-0">Payments List</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-orders" class="table table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction Id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Card Number</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>TXN1234567890</td>
                                        <td>Amit Sharma</td>
                                        <td>amit.sharma@example.com</td>
                                        <td>**** **** **** 1234</td>
                                        <td>₹1,200.00</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                        <td><button class="btn btn-primary btn-sm">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>TXN2345678901</td>
                                        <td>Priya Verma</td>
                                        <td>priya.verma@example.com</td>
                                        <td>**** **** **** 5678</td>
                                        <td>₹3,450.00</td>
                                        <td><span class="badge bg-danger">Failed</span></td>
                                        <td><button class="btn btn-primary btn-sm">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>TXN3456789012</td>
                                        <td>Rohit Mehta</td>
                                        <td>rohit.mehta@example.com</td>
                                        <td>**** **** **** 9876</td>
                                        <td>₹760.00</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td><button class="btn btn-primary btn-sm">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>TXN4567890123</td>
                                        <td>Neha Joshi</td>
                                        <td>neha.joshi@example.com</td>
                                        <td>**** **** **** 4321</td>
                                        <td>₹2,100.00</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                        <td><button class="btn btn-primary btn-sm">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>TXN5678901234</td>
                                        <td>Karan Patel</td>
                                        <td>karan.patel@example.com</td>
                                        <td>**** **** **** 6543</td>
                                        <td>₹500.00</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                        <td><button class="btn btn-primary btn-sm">View</button></td>
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
