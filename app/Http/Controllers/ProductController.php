<?php

namespace App\Http\Controllers;

use App\Services\V1\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
    public function index(Request $request) {
        
    }
}
