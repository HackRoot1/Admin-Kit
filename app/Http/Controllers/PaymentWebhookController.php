<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Utility;
use Symfony\Component\HttpFoundation\Response;

class PaymentWebhookController extends Controller
{
    //
    public function handle(Request $request)
    {
        $secret    = config('services.razorpay.webhook_secret');
        $signature = $request->header('X-Razorpay-Signature');
        $payload   = $request->getContent(); // raw body is required

        try {
            Utility::verifyWebhookSignature($payload, $signature, $secret); // throws on failure

            $event = $request->input('event');
            $data  = $request->input('payload');

            if ($event === 'payment.captured') {
                $orderId   = $data['payment']['entity']['order_id'] ?? null;
                $paymentId = $data['payment']['entity']['id'] ?? null;
                if ($orderId && $payment = Payment::where('order_id', $orderId)->first()) {
                    $payment->update([
                        'status'     => 'paid',
                        'payment_id' => $paymentId,
                        'payload'    => $request->all(),
                    ]);
                }
            }

            return response()->json(['ok' => true]);
        } catch (\Throwable $e) {
            // log $e->getMessage()
            return response()->json(['ok' => false], Response::HTTP_BAD_REQUEST);
        }
    }
}
