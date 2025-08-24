@extends('layouts.app')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Payment Using Card Details</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Payment Details:</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pay.order') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" id="full_name"
                                        value="{{ old('full_name') }}" placeholder="Full Name" required>
                                    @error('full_name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}" placeholder="Email" required>
                                    @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="contact">Contact</label>
                                    <input type="text" name="contact" class="form-control" id="contact"
                                        value="{{ old('contact') }}" placeholder="10–15 digits" pattern="[0-9]{10,15}"
                                        required>
                                    @error('contact')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="amount">Amount (INR)</label>
                                    <input type="number" name="amount" class="form-control" id="amount"
                                        value="{{ old('amount', 1000) }}" placeholder="1000" min="1" step="1"
                                        required>
                                    @error('amount')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
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
