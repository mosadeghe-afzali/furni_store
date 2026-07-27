<?php

namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\ProductVariant;

class productVariantRepository
{
    public function index($input)
    {
        $products = ProductVariant::filter($input)
            ->paginate(10);
        return new ProductCollection($products);
    }

    public function show($input)
    {
        $product = ProductVariant::with(['variantAttributeValues'])
            ->first();

        return new ProductResource($product);
    }

    public function create($input)
    {
        return ProductVariant::create($input);
    }

    public function find($productId)
    {
        return ProductVariant::find($productId);
    }

    public function update($input)
    {

        $productId = $input['productId'];
        unset($input['productId']);

        ProductVariant::where('id', $productId)->update($input);
    }

    public function getVariantsKeyById($variantIds)
    {
        return ProductVariant::whereIn('id', $variantIds)
            ->where('status', 1)
            ->get()
            ->keyBy('id');
    }
}
