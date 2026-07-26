<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\PaymentRepository;
use Illuminate\Validation\ValidationException;

class PaymentSerice
{

    private $orderRepository;
    private $paymentRepository;

    public function __construct(
        PaymentRepository $paymentRepository,
    ) {
        $this->paymentRepository = $paymentRepository;
    }

    public function callback($input) {
         return DB::transaction(function () use ($input) {

            $orderId = $input['orderId'];
            $transactionId = $input['transactionId'];
            $status = $input['status'];
            $failureReason = $input['failureReason'];

            $order = Order::where('id', $orderId)
                ->with('items.variant')
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->status !== 'pending') {
                throw new ValidationException("این سفارش قبلاً پردازش شده است. وضعیت فعلی: {$order->status}");
            }

            if ($status === 'success') {
                $order->update([
                    'status' => 'processing', // یا completed
                    'transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);
            } else {
                foreach ($order->items as $item) {
                    $item->variant->increment('stock', $item->quantity);
                }

                $order->update([
                    'status' => 'cancelled',
                    'transaction_id' => $transactionId,
                    'failure_reason' => $failureReason ?? 'پرداخت توسط کاربر لغو شد یا ناموفق بود.',
                ]);
            }

            return $order;
        });
    }
}
