<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Traits\ResponseTrait;
use App\Http\Requests\SubmitOrderRequest;

class OrderController extends Controller
{
    use ResponseTrait;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function submit(SubmitOrderRequest $request)
    {

        $input = $request->validated();
        $input['userId'] = $request->user()->id ?? 1;
        $output = $this->orderService->submit($input);

        return $this->showResponse($output);
    }
}
