@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Payment Checkout</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Payment Checkout Details:</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" placeholder="Full Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="card_number">Card Number</label>
                                    <input type="text" class="form-control" id="card_number"
                                        placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expiry_date">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiry_date" placeholder="MM/YY">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="cvv">CVV</label>
                                    <input type="number" class="form-control" id="cvv" placeholder="123">
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
