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

    public function index(array $input) {
        return $this->productRepository->index($input);
    }

    public function show(int $productId) {
        return $this->productRepository->show($productId);
    }

    public function getVariantsKeyById(array $variantIds) {
        return $this->productVariantRepository->getVariantsKeyById($variantIds);
    }

}
