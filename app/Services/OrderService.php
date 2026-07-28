<?php

namespace App\Services;

use App\Models\Payment;
use App\OrderStatusEnum;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use Illuminate\Validation\ValidationException;

class OrderService
{

    private $orderRepository;
    private $productService;
    private $paymentService;

    public function __construct(
        OrderRepository $productRepostory,
        ProductService $productService,
        PaymentSerice $paymentService
    ) {
        $this->orderRepository = $productRepostory;
        $this->productService = $productService;
        $this->paymentService = $paymentService;
    }

    public function submit(array $input)
    {
        return DB::transaction(function () use ($input) {
            $totalAmount = 0;
            $orderItemsToInsert = [];
            $items = $input['items'];
            $userId = $input['userId'];

            $variantIds = array_column($items, 'variant_id');

            $variants = $this->productService->getVariantsKeyById($variantIds);

            foreach ($items as $item) {
                $variantId = $item['variant_id'];
                $quantity = $item['quantity'];

                if (!isset($variants[$variantId])) {
                    throw ValidationException::withMessages([
                        'items' => "تنوع محصول با شناسه {$variantId} یافت نشد یا غیرفعال است.",
                    ]);
                }

                $variant = $variants[$variantId];

                if ($variant->inventory < $quantity) {
                    throw ValidationException::withMessages([
                        'items' => "موجودی کافی برای محصول '{$variant->title}' وجود ندارد. موجودی فعلی: {$variant->inventory}",
                    ]);
                }

                $unitPrice = $variant->price;
                $itemTotalPrice = $unitPrice * $quantity;
                $totalAmount += $itemTotalPrice;

                $variant->decrement('inventory', $quantity);

                $orderItemsToInsert[] = [
                    'product_variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $itemTotalPrice,
                ];
            }
            $order = $this->orderRepository->create([
                'user_id' => $userId,
                'total_amount' => $totalAmount
            ]);
            $transactionId = random_int(100000000, 999999999);

            $this->paymentService->create([
                'order_id' => $order->id,
                'status' => Payment::PAYING,
                'amount' => $totalAmount,
                'transaction_id' => $transactionId
            ]);

            foreach ($orderItemsToInsert as $orderItem) {
                $order->items()->create($orderItem);
            }

            return [
                'transaction_id' => $transactionId
            ];
        });
    }

    public function callback($input)
    {
        return DB::transaction(function () use ($input) {

            $orderId = $input['order_id'];
            $transactionId = $input['transaction_id'];
            $refNumber = $input['ref_number'];
            $status = $input['status'];

            $payment = $this->paymentService->show([
                'id' => $input['order_id'],
                'transaction_idd' => $transactionId,
                'status' => Payment::PAYING
            ]);

            if (!$payment) {
                throw ValidationException::withMessages([
                    'payment' => 'این پرداخت قبلاً پردازش شده است'
                ]);
            }

            if ($payment->created_at->diffInMinutes(now()) > 20) {
                throw ValidationException::withMessages([
                    'payment' => 'زمان پرداخت بیش از ۲۰ دقیقه قبل بوده است. لطفاً مجدداً تلاش کنید.'
                ]);
            }

            $order = $payment->order;

            if ($order->status != OrderStatusEnum::PAYING->value) {
                throw ValidationException::withMessages([
                    'order' => "این سفارش قبلاً پردازش شده است. وضعیت فعلی: {$order->status}",
                ]);
            }

            if ($status === 'success') {
                $order->update([
                    'status' => OrderStatusEnum::SUCCESSUL->value,
                    'paid_at' => now(),
                ]);
                $payment->update([
                    'status' => Payment::SUCCESSUL,
                    'ref_number' => $refNumber
                ]);
            } else {
                foreach ($order->items as $item) {
                    $item->productVariant->increment('inventory', $item->quantity);
                }

                $order->update([
                    'status' => OrderStatusEnum::CANCELD->value
                ]);
                $payment->update([
                    'status' => Payment::CANCELD
                ]);
            }

            return $order;
        });
    }
}
