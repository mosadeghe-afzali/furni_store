<?php

namespace App\Repositories;

use App\Models\Order;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class OrderRepository
{
    public function index($input)
    {
        $products = Order::with(['category', 'variants'])
            ->filter($input)
            ->paginate(10);
        return new ProductCollection($products);
    }
    public function show($input)
    {
        $product = Order::with(['category', 'variants', 'variants.variantAttributeValues'])
            ->first();

        return new ProductResource($product);
    }

    public function create($input)
    {
        return Order::create($input);
    }

    public function find($orderId)
    {
        return Order::find($orderId);
    }

    public function update($input)
    {

        $orderId = $input['orderId'];
        unset($input['orderId']);

        Order::where('id', $orderId)->update($input);
    }
}
