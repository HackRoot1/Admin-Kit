<h2>Payment successful 🎉</h2>
<p>Order: {{ $payment->order_id }}</p>
<p>Payment: {{ $payment->payment_id }}</p>
<p>Amount: ₹{{ number_format($payment->amount/100, 2) }}</p>
