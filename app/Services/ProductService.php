<?php
namespace App\Services\V1;

use App\Repositories\ProductRepository;

class ProductService {

    private $productRepository;

    public function __construct
    (
        ProductRepository $productRepostory,
    ) {
        $this->productRepository = $productRepostory;
    }

    public function index() {
        
    }


    

}
