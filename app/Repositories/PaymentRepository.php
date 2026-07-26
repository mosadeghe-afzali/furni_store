<?php
namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Payment;

class PaymentRepository {
    public function index($input) {
        $products = Payment::with(['category', 'variants'])
            ->filter($input)
            ->paginate(10);
        return new ProductCollection($products);
    }
    public function show($input) {
        $product = Payment::with(['category', 'variants', 'variants.variantAttributeValues'])
        ->first();

        return new ProductResource($product);
    }

    public function create($input) {
        return Payment::create($input);
    }

    public function find($paymentId) {
        return Payment::find($paymentId);
    }

    public function update($input) {

        $paymentId = $input['paymentId'];
        unset($input['paymentId']);

        Payment::where('id', $paymentId)->update($input);
    }
}
