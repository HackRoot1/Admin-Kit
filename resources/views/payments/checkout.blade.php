<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Processing Payment...</title>
</head>
<body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
(function () {
    const options = {
        key: "{{ $key }}",
        amount: "{{ $order['amount'] }}",
        currency: "{{ $order['currency'] }}",
        name: "{{ config('app.name') }}",
        description: "Payment for Order {{ $order['id'] }}",
        order_id: "{{ $order['id'] }}", // ties payment to server-created order
        prefill: {
            name:   @json($prefill['full_name']),
            email:  @json($prefill['email']),
            contact:@json($prefill['contact']),
        },
        notes: {
            payment_db_id: "{{ $payment->id }}"
        },
        handler: function (response) {
            // Send payment_id, order_id & signature to server for verification
            fetch(@json(route('payment.verify')), {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(response)
            })
            .then(r => r.json())
            .then(({redirect_url}) => window.location.href = redirect_url)
            .catch(() => window.location.href = @json(route('payments.failed', ['payment' => $payment->id])));
        },
        modal: {
            ondismiss: function () {
                window.location.href = @json(route('payments.failed', ['payment' => $payment->id]));
            }
        }
    };
    const rzp = new Razorpay(options);
    rzp.on('payment.failed', function () {
        window.location.href = @json(route('payments.failed', ['payment' => $payment->id]));
    });
    rzp.open();
})();
</script>
</body>
</html>
