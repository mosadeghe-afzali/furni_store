<?php

namespace App\Http\Controllers;

use App\Services\V1\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|integer',
            'name' => 'nullable|string',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
            'in_stock' => 'nullable|in:0,1',
            'attribute_values' => 'nullable|array',
            'attribute_values.*' => 'integer|exists:attribute_values,id',
            'order_by' => 'nullable|string|in:price_asc,price_desc,created_at_asc,created_at_desc',
        ]);

        $products = $this->productService->index($validated);

        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products,
        ]);
    }
}
