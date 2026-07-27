<?php

namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

class ProductRepository
{
    public function index(array $input)
    {
        $perPage = $input['per_page'] ?? 10;
        $products = Product::with(
            [
                'category',
                'variants',
                'variants.attributeValues'
            ]
        )
            ->where('status', Product::STATUS_ACTIVE)
            ->filter($input)
            ->paginate($perPage);
        return new ProductCollection($products);
    }
    public function show($productId)
    {
        $product = Product::with(['category', 'variants.attributeValues.attribute', 'variants.media'])
            ->where('id', $productId)
            ->first();

        if (empty($product)) {
            throw  ValidationException::withMessages([
                'product' => "محصول یافت نشد.",
            ]);
        }

        return new ProductResource($product);
    }

    public function create($input)
    {
        return Product::create($input);
    }

    public function find($productId)
    {
        return Product::find($productId);
    }

    public function update($input)
    {

        $productId = $input['productId'];
        unset($input['productId']);

        Product::where('id', $productId)->update($input);
    }
}
