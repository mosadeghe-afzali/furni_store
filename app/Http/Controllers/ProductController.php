<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductIndexRequest;
use App\Traits\ResponseTrait;

class ProductController extends Controller
{
    use ResponseTrait;
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(ProductIndexRequest $request)
    {
        $input = $request->validated();
        $output = $this->productService->index($input);

        return $this->showResponse($output);
    }

    public function show($productId) {
        $output = $this->productService->show($productId);

        return $this->showResponse($output);

    }
}
