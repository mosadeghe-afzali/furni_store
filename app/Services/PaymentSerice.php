<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\PaymentRepository;
use Illuminate\Validation\ValidationException;

class PaymentSerice
{

    private $orderRepository;
    private $paymentRepository;

    public function __construct(
        PaymentRepository $paymentRepository,
    ) {
        $this->paymentRepository = $paymentRepository;
    }

    public function findOrFail($id)
    {
        return $this->paymentRepository->findOrFail($id);
    }
    public function show($input)
    {
        return $this->paymentRepository->show($input);
    }

    public function create($input)
    {
        return $this->paymentRepository->create($input);
    }
}
