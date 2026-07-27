<?php
namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository {
    public function index($input) {
        $products = Product::with(['category', 'variants'])
            ->where('status', 1)
            ->filter($input)
            ->paginate(10);
        return new ProductCollection($products);
    }
    public function show($input) {
        $product = Product::with(['category', 'variants', 'variants.variantAttributeValues'])
        ->first();

        return new ProductResource($product);
    }

    public function create($input) {
        return Product::create($input);
    }

    public function find($productId) {
        return Product::find($productId);
    }

    public function update($input) {

        $productId = $input['productId'];
        unset($input['productId']);

        Product::where('id', $productId)->update($input);
    }
}
