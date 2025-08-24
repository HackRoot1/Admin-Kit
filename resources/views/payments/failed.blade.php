<h2>Payment failed or cancelled</h2>
@if($payment)
    <p>Order: {{ $payment->order_id }}</p>
    <p>Status: {{ $payment->status }}</p>
@endif
<a href="{{ route('pay.form') }}">Try again</a>
