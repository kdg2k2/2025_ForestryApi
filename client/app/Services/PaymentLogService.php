<?php

namespace App\Services;

use App\Repositories\PaymentLogRepository;

class PaymentLogService extends BaseService
{
    protected $paymentLogRepository;
    public function __construct()
    {
        $this->paymentLogRepository = app(PaymentLogRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->paymentLogRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->paymentLogRepository->update($request);
        });
    }
}
