<?php

namespace App\Services;

use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use Illuminate\Validation\ValidationException;

class OrderService
{

    private $orderRepository;
    private $productService;

    public function __construct(
        OrderRepository $productRepostory,
        ProductService $productService
    ) {
        $this->orderRepository = $productRepostory;
        $this->productService = $productService;
    }

    public function store(array $input)
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
                    throw new ValidationException("تنوع محصول با شناسه {$variantId} یافت نشد یا غیرفعال است.");
                }

                $variant = $variants[$variantId];

                if ($variant->inventory < $quantity) {
                    throw new ValidationException("موجودی کافی برای محصول '{$variant->title}' وجود ندارد. موجودی فعلی: {$variant->stock}");
                }

                $unitPrice = $variant->price;
                $itemTotalPrice = $unitPrice * $quantity;
                $totalAmount += $itemTotalPrice;

                $variant->decrement('inventory', $quantity);

                $orderItemsToInsert[] = [
                    'variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $itemTotalPrice,
                ];
            }
            $order = $this->orderRepository->create([
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            foreach ($orderItemsToInsert as $orderItem) {
                $order->items()->create($orderItem);
            }

            return $order->load('items');
        });
    }

    pubclic function callback($input) {
         return DB::transaction(function () use ($input) {

            $orderId = $input['orderId'];
            $transactionId = $input['transactionId'];
            $status = $input['status'];
            $failureReason = $input['failureReason'];

            $order = Order::where('id', $orderId)
                ->with('items.variant')
                ->lockForUpdate()
                ->firstOrFail();

            // ۱. بررسی Idempotency: اگر سفارش قبلاً تعیین تکلیف شده است
            if ($order->status !== 'pending') {
                throw new Exception("این سفارش قبلاً پردازش شده است. وضعیت فعلی: {$order->status}");
            }

            if ($status === 'success') {
                // ۲. پرداخت موفق
                $order->update([
                    'status' => 'processing', // یا completed
                    'transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);
            } else {
                // ۳. پرداخت ناموفق -> برگشت موجودی انبار (Restock)
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
