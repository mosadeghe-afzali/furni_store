<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    public function index($input) {
        return Product::filter($input)->paginate(10);
    }
    public function show($input) {
        return Product::filter($input)->first();
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
