<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {

    private $productRepository;

    public function __construct
    (
        ProductRepository $productRepostory,
    ) {
        $this->productRepository = $productRepostory;
    }

    public function index($input) {
        return $this->productRepository->index($input);
    }

    public function show($productId) {
        return $this->productRepository->show($productId);
    }

}
