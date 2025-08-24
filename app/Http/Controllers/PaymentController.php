<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{

    // Razorpay Api object 
    protected Api $api;

    // Creating Razorpay Api object so we can use it in anywhere in this controller 
    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    // Show the form  -- checkout form or any other form from where we have button of making payments
    public function form()
    {
        return view('payments.form');
    }

    // 1) Create an order on server (REQUIRED by Razorpay)
    public function createOrder(Request $request)
    {
        // form validation
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email'     => ['required', 'email', 'max:120'],
            'contact'   => ['required', 'regex:/^[0-9]{10,15}$/'],
            'amount'    => ['required', 'numeric', 'min:1'], // amount in INR rupees
        ]);

        // convert amount from rupees to paise. razorpay accepts in paise
        $amountPaise = (int) round($data['amount'] * 100);

        // Create order via API - This will return an array with id, amount, currency, etc.
        $order = $this->api->order->create([
            'amount'   => $amountPaise,
            'currency' => config('services.razorpay.currency', 'INR'),
            'receipt'  => 'rcpt_' . now()->timestamp,
            'notes'    => [
                'customer_name'  => $data['full_name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['contact'],
            ],
        ]);

        // Save to DB
        $payment = Payment::create([
            'name'     => $data['full_name'],
            'email'    => $data['email'],
            'contact'  => $data['contact'],
            'amount'   => $amountPaise,
            'currency' => 'INR',
            'status'   => 'created',
            'order_id' => $order['id'],
        ]);

        // Redirect to the checkout page with razorpay key, payment details, order details and form filled data
        // Render a page that immediately opens Razorpay Checkout
        return view('payments.checkout', [
            'key'     => config('services.razorpay.key'),
            'order'   => $order,
            'payment' => $payment,
            'prefill' => $data,
        ]);
    }

    // 2) Verify the signature (MANDATORY)
    public function verify(Request $request)
    {
        // validate data that are coming from payments.checkout page 
        // that page makes a fetch api request
        $attrs = $request->validate([
            'razorpay_order_id'   => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature'  => 'required|string',
        ]);

        // get details of payment from db
        $payment = Payment::where('order_id', $attrs['razorpay_order_id'])->firstOrFail();

        // try-catch for error handling
        try {
            // Throws exception if invalid. Returns null on success.
            $this->api->utility->verifyPaymentSignature($attrs);

            // Optional: confirm status via API and (if needed) capture
            $rpPayment = $this->api->payment->fetch($attrs['razorpay_payment_id']);

            //check for verified or not 
            if (($rpPayment['status'] ?? null) !== 'captured') {
                // If your Dashboard capture setting is Auto, this should already be captured.
                // Capture manually only if Auto Capture is OFF.
                $this->api->payment
                    ->fetch($attrs['razorpay_payment_id'])
                    ->capture(['amount' => $payment->amount]);
            }

            // if payment is verified update records in db
            $payment->update([
                'payment_id' => $attrs['razorpay_payment_id'],
                'signature'  => $attrs['razorpay_signature'],
                'status'     => 'paid',
                'payload'    => $attrs,
            ]);

            // send response back to the payments.checkout page where our fetch api request gets this response
            return response()->json([
                'ok' => true,
                'redirect_url' => route('payments.success', $payment),
            ]);
        } catch (SignatureVerificationError $e) {
            // if payments verification fails then update record in db as failed
            $payment->update([
                'status'  => 'signature_failed',
                'payload' => $attrs,
            ]);


            // send response back to the payments.checkout page where our fetch api request gets this response
            return response()->json([
                'ok' => false,
                'redirect_url' => route('payments.failed', ['payment' => $payment->id]),
            ], 422);
        }
    }

    public function success(Payment $payment)
    {
        // return redirect()->route('make.card.payments');
        // return view('payments.success', compact('payment'));
        return view('invoices.payments', compact('payment'));
    }

    public function failed($paymentId = null)
    {
        $payment = $paymentId ? Payment::find($paymentId) : null;
        return view('payments.failed', compact('payment'));
    }
}
