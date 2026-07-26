<?php
namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository {
    public function index($input) {
        $products = Product::with(['category', 'variants'])
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

    public function find($user_id) {
        return Product::find($user_id);
    }

    public function update($input) {

        $product_id = $input['product_id'];
        unset($input['product_id']);

        Product::where('id', $product_id)->update($input);
    }
}
