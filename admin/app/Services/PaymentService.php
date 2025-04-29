<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService extends BaseService
{
    protected $paymentRepository;
    public function __construct()
    {
        $this->paymentRepository = app(PaymentRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->paymentRepository->store($request);
        });
    }

    public function findByVnpTxnRef(string $vnp_TxnRef)
    {
        return $this->tryThrow(function () use ($vnp_TxnRef) {
            return $this->paymentRepository->findByVnpTxnRef($vnp_TxnRef);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->paymentRepository->update($request);
        });
    }
}
