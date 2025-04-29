<?php

namespace App\Repositories;

use App\Models\PaymentLog;

class PaymentLogRepository
{
    public function store(array $request)
    {
        return PaymentLog::create($request);
    }

    public function update(array $request)
    {
        return PaymentLog::find($request['id'])->update($request);
    }
}
