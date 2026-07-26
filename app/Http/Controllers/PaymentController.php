<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPaymentCallbackRequest;
use App\Services\PaymentSerice;
use App\Traits\ResponseTrait;

class PaymentController extends Controller
{
    use ResponseTrait;
    protected $paymentService;

    public function __construct(PaymentSerice $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function callback(OrderPaymentCallbackRequest $request)
    {
        $input = $request->validated();
        $output = $this->paymentService->callback($input);
        return $this->showResponse();
    }
}
