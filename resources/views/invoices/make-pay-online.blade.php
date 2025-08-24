@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Payment Using Online(QR/UPI)</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Payment Details:</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                @csrf 
                                @method('POST')
                                <div class="mb-3">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" placeholder="Full Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="contact">Contact</label>
                                    <input type="text" class="form-control" id="contact" placeholder="Contact">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" placeholder="1000">
                                </div>

                                <button type="submit" class="btn btn-primary">Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
