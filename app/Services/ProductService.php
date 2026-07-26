<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\productVariantRepository;
class ProductService {

    private $productRepository;
    private $productVariantRepository;

    public function __construct
    (
        ProductRepository $productRepostory,
        productVariantRepository $productVariantRepository
    ) {
        $this->productRepository = $productRepostory;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function index($input) {
        return $this->productRepository->index($input);
    }

    public function show($productId) {
        return $this->productRepository->show($productId);
    }

    public function getVariantsKeyById($variantIds) {
        return $this->productVariantRepository->getVariantsKeyById($variantIds);
    }

}
