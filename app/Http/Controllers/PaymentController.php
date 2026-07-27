<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPaymentCallbackRequest;
use App\Services\OrderService;
use App\Traits\ResponseTrait;

class PaymentController extends Controller
{
    use ResponseTrait;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function callback(OrderPaymentCallbackRequest $request)
    {
        $input = $request->validated();
        $output = $this->orderService->callback($input);
        return $this->showResponse();
    }
}
